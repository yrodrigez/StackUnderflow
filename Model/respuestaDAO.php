<?php
/**
 * Created by PhpStorm.
 * User: Yago
 * Date: 15/11/2015
 * Time: 13:38
 */

class RespuestaMapper {
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
            "SELECT * FROM RESPUESTA WHERE IDUSUARIO= ?"
        );
        if($stmt->execute(array(
            $idUsuario
        ))) return $stmt;
    }

    public function save(
        $respuesta
    ) {
        $stmt = $this->db->prepare(
            "INSERT INTO RESPUESTA(
                              IDPOST,
                              IDUSUARIO,
                              CUERPO,
                              FECHA_CREACION
                              ) VALUES
                              (?,?,?,?)"
        );
        $stmt->execute(array(
            $respuesta->getIdPost(),
            $respuesta->getIdUsuario(),
            $respuesta->getCuerpo(),
            $respuesta->getFechaCreacion()
        ));
    }

}