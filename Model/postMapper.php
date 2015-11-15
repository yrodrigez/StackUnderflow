<?php
/**
 * Created by PhpStorm.
 * @author
 * Date: 15/11/2015
 * Time: 12:27
 */
require_once(__DIR__ . "../core/PDOConnection.php");
require_once(__DIR__ . "post.php");
class postMapper {

    private $db;

    public function __construct()
    {
        $this->db= PDOConnection::getInstance();
    }

    /**
     * @param $userId
     * @return PDOStatement
     */
    public function getAllUserPosts(
        $userId
    ) {
        $stmt = $this->db->prepare(
            "SELECT * FROM POST WHERE IDUSUARIO= ?"
        );
        $stmt->execute(array(
            $userId
        ));
        return $stmt;
    }

    /**
     * @param $size
     * @return array
     */
    public function getHotPosts(
        $size
    ) {
        $stmt = $this->db->prepare(
          "SELECT * FROM  POST ORDER BY NUMVISITAS"
        );
        if( $stmt->rowCount() > $size ){
            $ret= array();
            for($i = 0; $i<$size; $i++){
                $ret[$i]= $stmt[$i];
            }
            return $ret;
        }else{
            $ret= array();
            for($i = 0; $stmt->rowCount(); $i++){
                $ret[$i]= $stmt[$i];
            }
            return $ret;
        }
    }

    /**
     * @param $post
     * @return bool
     */
    public function save(
        $post
    ) {
        $stmt = $this->db->prepare(
            "INSERT INTO POST(
                            IDUSUARIO,
                            CUERPO,
                            NUMVISITAS,
                            FECHA_CREACION,
                            CONTESTADA
                            ) VALUES
                            (?,?,?,?,?)"
        );
        return $stmt->execute(array(
            $post->getIdUsuario(),
            $post->getCuerpo(),
            $post->getNumVisitas(),
            $post->getFechaCreacion(),
            $post->getContestada()
        ));

    }

    /**
     * @param $idPost
     * @return Post
     */
    public function fill(
        $idPost
    ) {
        $stmt = $this->db->prepare(
            "SELECT * FROM POST WHERE IDPOST= ?"
        );

        if ($stmt->execute(array($idPost))){
            if($stmt->rowCount() > 0){
                $fillData= $stmt->fetch(PDO::FETCH_ASSOC);
                return new Post(
                    $fillData["TITULO"],
                    $fillData["CONTESTADA"],
                    $fillData["CUERPO"],
                    $fillData["NUMVISITAS"],
                    $fillData["FECHA_CREACION"],
                    $fillData["IDUSUARIO"]
                );
            }
        }

    }

    /**
     *
     * @param $idPost
     * @return bool
     *
     */
    public function delete(
        $idPost
    ) {
        $stmt= $this->db->prepare(
            "DELETE * FROM POST WHERE IDPOST= ?"
        );
        return $stmt->execute(array($idPost));
    }

}