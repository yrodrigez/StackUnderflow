<?php
/**
 * Created by PhpStorm.
 * User: Yago
 * Date: 15/11/2015
 * Time: 13:38
 */

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
            $respuesta->getIdUsuario(),
            $respuesta->getIdPost(),
            $respuesta->getCuerpo(),
            $respuesta->getFechaCreacion()
        ));
    }

    /* Funciones para manejar la tabla votos */

  /**
   * Gets the votes of a given answer by an user
   * 
   * @param Int $idUser The id of the user
   * @param Int $idRespuesta The id of the answer 
   * @throws PDOException if a database error occurs
   * @return Int The votes of the answer
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
        return $votes; 
      }
    } else {
        return NULL;
    }
  }

  public function addVote(
      $idUsuario,
      $idRespuesta
  ) {
      $stmt = $this->db->prepare(
          "INSERT INTO votos VALUES id_user=?, id_respuesta= ?, votos= ?"
      );
      if($stmt->execute(array($idUsuario, $idRespuesta, 1))){
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
    $stmt = $this->db->prepare("SELECT * FROM respuestas, votos WHERE respuestas.id=votos.id_respuesta AND idpost = ? ORDER BY votos.votos DESC;");
    $stmt->execute(array($idPost));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $respuesta
      ) {
        array_push($respuestas, new Respuesta(
                $respuesta["id"],
                $respuesta["idpost"],
                $respuesta["cuerpo"],
                $respuesta["created"],
                $respuesta["user_id"]
            )
        ); 
      }
      return $respuestas;
    } else {
      return NULL;
    }
  }

}