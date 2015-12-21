<?php
/**
 * Created by PhpStorm.
 * User: Yago
 * Date: 15/11/2015
 * Time: 13:38
 */
require_once(__DIR__ . "/../model/respuesta.php");

class RespuestaDAO {
  private $db;

  public function __construct()
  {
    $this->db= PDOConnection::getInstance();
  }


  /**
   * @param Respuesta array $respuestas
   * @var $ids string id's de las respuestas para hacer la consulta
   * @var $sql string consulta concatenada para todos los votos
   * @var Respuesta $respuesta
   * @return bool
   */
  public function getAllRespuestasLikes(
    $respuestas
  ) {
    $size= count($respuestas);
    if($size > 0) {
      $sql = "SELECT * FROM votos WHERE ";
      $ids= array();
      for($i= 0; $i<$size ; ++$i){
        if($i == $size-1)
          $sql.=" id_respuesta= ?;";
        else
          $sql.=" id_respuesta= ? or";
        array_push($ids, $respuestas[$i]->getIdRespuesta());
      }
      $stmt = $this->db->prepare($sql);
      if($stmt->execute($ids)){
        foreach($stmt as $voto){
          /**
           * * @var Respuesta $respuesta
           */
          foreach($respuestas as $respuesta){
            if($respuesta->getIdRespuesta() == $voto["id_respuesta"]){
              if($voto["votos"] > 0){

                $respuesta->addLike();
              }
              if($voto["votos"] == -1){

                $respuesta->addDislike();
              }
            }
          }
        }
        return true;
      }
      return false;
    }
    return $respuestas;
  }
    /**
     * @param $idUsuario
     * @return array
     */
  public function getAllRespuestasUsuario(
    $idUsuario
  ) {
    $stmt = $this->db->prepare(
      "SELECT * FROM respuestas WHERE user_id= ?"
    );
    if($stmt->execute(array( $idUsuario))){
      $ret = array();
      foreach($stmt as $respuesta){
        array_push(
          $ret,
          new Respuesta(
            $respuesta["id"],
            $respuesta["idpost"],
            $respuesta["cuerpo"],
            $respuesta["created"],
            $respuesta["user_id"],
            NULL
          )
        );
      }
      return $ret;
    }
  }

  /**
   * @param $respuesta Respuesta
   * guarda la respuesta y cambia el campo contestada a 1 del post correspondiente
   * @return boolean
   */
  public function save(
    $respuesta
    ) {
    $stmt = $this->db->prepare(
      "INSERT INTO respuestas(
        id,
        user_id,
        idpost,
        cuerpo,
        created
        ) VALUES
        (?,?,?,?,?)"
    );
    $stmt->execute(
      array(
        $respuesta->getIdRespuesta(),
        $respuesta->getUserId(),
        $respuesta->getIdPost(),
        $respuesta->getCuerpo(),
        $respuesta->getFechaCreacion()
      )
    );
    return $this->setContestado($respuesta->getIdPost());
  }

  /**
   * @param $idPost
   * @return bool
   */
  public function setContestado(
      $idPost
  ){
    $stmt= $this->db->prepare(
        "UPDATE posts AS post
        INNER JOIN respuestas AS respuesta ON post.id = respuesta.idpost
        SET post.contestada= 1
        WHERE  (post.id=respuesta.idpost) and
        respuesta.idpost = ?;"
    );
    return $stmt->execute(array($idPost));
  }


  /* Funciones para manejar la tabla votos */

  /**
   * Gets the vote (positive or neg) of a given answer by an user
   * 
   * @param Int $idUser The id of the user
   * @param Int $idRespuesta The id of the answer 
   * @throws PDOException if a database error occurs
   * @return Int The vote of the answer
   */
  public function getVotes(
    $idUser,
    $idRespuesta
    ) {
    $stmt = $this->db->prepare("SELECT votos FROM votos WHERE id_user = ? AND id_respuesta = ?;");
    $stmt->execute(array($idUser,$idRespuesta));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $votes
        ) {
        return $votes["votos"]; 
      }
    } else {
      return NULL;
    }
  }

  /**
   * @param $idRespuesta string
   * @return array
   */
  public function getTotalVotes(
    $idRespuesta
    ) {
    $stmt = $this->db->prepare(
      "SELECT count(votos) FROM votos WHERE id_respuesta = ? AND votos = 1;"
      );
    if($stmt->execute(array($idRespuesta))){
      $positivos = $stmt->fetchColumn();
    }
    $stmt = $this->db->prepare(
      "SELECT count(*) FROM votos WHERE id_respuesta = ? AND votos = -1;"
      );
    if($stmt->execute(array($idRespuesta))){
      $negativos = $stmt->fetchColumn();
    }
    return array($positivos, $negativos);
  }

  /**
   * @param $idUsuario string el usuario que vota
   * @param $idRespuesta string la respuesta a la que se vota
   * @param $valor int 1 para añadir voto
   * @return bool
   */
  public function addVote(
    $idUsuario,
    $idRespuesta,
    $valor
    ) {
    $stmt = $this->db->prepare(
      "INSERT INTO votos(id_user, id_respuesta, votos) VALUES (?,?,?)"
      );
    if($stmt->execute(array($idUsuario, $idRespuesta, $valor))){
      return true;
    }else{
      return false;
    }
  }

  /**
   * @param $idPost correspondiente para su busqueda
   * @return Post el post al que pertenece esta respuesta.
   */
  public function dameMiPost(
      $idPost
  ) {
    $stmt= $this->db->prepare(
        "SELECT posts.* from posts, respuestas where respuestas.idpost=posts.id and respuestas.id= ?"
    );
    $stmt->execute(array($idPost));
    $row= $stmt->fetch(PDO::FETCH_ASSOC);
    return new Post(
      $row["id"],
      $row["titulo"],
      $row["contestada"],
      $row["cuerpo"],
      $row["numvisitas"],
      $row["created"],
      $row["user_id"],
      array()
    );


  }

  /**
   * Gets the answers (ordered by date) of a post
   * 
   * @param Int $idPost The id of the post 
   * @throws PDOException if a database error occurs
   * @return array of Answers of the specified post
   */
  public function getRespuestasDePost(
    $idPost
    ) {
    $respuestas = array();
    $stmt = $this->db->prepare("SELECT * FROM respuestas WHERE idpost = ?;");
    $stmt->execute(array($idPost));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $respuesta
        ) {
        $votos = $this->getTotalVotes($respuesta["id"]);
        if ($votos == NULL){
          $votos = array(0,0);
        }
        array_push($respuestas, new Respuesta(
          $respuesta["id"],
          $respuesta["idpost"],
          $respuesta["cuerpo"],
          $respuesta["created"],
          $respuesta["user_id"],
          $votos 
          )
        ); 
    }
      return $this->quick_sort($respuestas);
    } else {
      return NULL;
    }
  }

  /**
   * @param $id string
   * @return array
   */
  public function fill(
    $id
  ) {
    $stmt = $this->db->prepare("SELECT * FROM respuestas WHERE id= ?;");
    $stmt->execute($id);
    $respuestas= array();
    if($stmt->rowCount()>0) {
      foreach (
          $stmt as $respuesta
      ) {
        $votos = $this->getTotalVotes($respuesta["id"]);
        if ($votos == NULL) {
          $votos = array(0, 0);
        }
        array_push(
          $respuestas,
          new Respuesta(
            $respuesta["id"],
            $respuesta["idpost"],
            $respuesta["cuerpo"],
            $respuesta["created"],
            $respuesta["user_id"],
            $votos
          )
        );
      }
      return $respuestas;
    }
  }


  /**
   * @param $array array Post
   * @return array
   */
  private function quick_sort($array)
  {
    // find array size
    $length = count($array);
    
    // base case test, if array of length 0 then just return array to caller
    if($length <= 1){
      return $array;
    }
    else{

      // select an item to act as our pivot point, since list is unsorted first position is easiest
      $pivot = $array[0];
      
      // declare our two arrays to act as partitions
      $left = $right = array();
      
      // loop and compare each item in the array to the pivot value, place item in appropriate partition
      for($i = 1; $i < count($array); $i++)
      {
        if($array[$i]->getVotos()[0] - $array[$i]->getVotos()[1] < $pivot->getVotos()[0] - $pivot->getVotos()[1]){
          $left[] = $array[$i];
        }
        else{
          $right[] = $array[$i];
        }
      }
      
      // use recursion to now sort the left and right lists
      return array_merge($this->quick_sort($right), array($pivot), $this->quick_sort($left));
    }
  }


  /**
   * @param $idUser
   * @param $idRespuesta
   * @return bool
   */
  public function addLike(
    $idUser,
    $idRespuesta
  ) {
    $stmt= $this->db->prepare("INSERT INTO votos(id_user, id_respuesta, votos) VALUES (?,?,?)");
    return $stmt->execute(array($idUser, $idRespuesta, 1));
  }

  /**
   * @param $idUser
   * @param $idRespuesta
   * @return bool
   */
  public function addDislike(
      $idUser,
      $idRespuesta
  ) {
    $stmt= $this->db->prepare("INSERT INTO votos(id_user, id_respuesta, votos) VALUES (?,?,?)");
    return $stmt->execute(array($idUser,$idRespuesta, -1));
  }


}