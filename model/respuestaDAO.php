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
     * @param $idUsuario
     * @return PDOStatement
     */
    public function getAllRespuestasUsuario(
      $idUsuario
      ) {
      $stmt = $this->db->prepare(
        "SELECT * FROM respuestas WHERE user_id= ?"
        );
      if($stmt->execute(array(
        $idUsuario
        ))) return $stmt; //Cambiar
    }

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
    $stmt->execute(array(
      $respuesta->getIdRespuesta(),
      $respuesta->getUserId(),
      $respuesta->getIdPost(),
      $respuesta->getCuerpo(),
      $respuesta->getFechaCreacion()
      ));
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
}