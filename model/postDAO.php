<?php
/**
 * Created by PhpStorm.
 * @author
 * Date: 15/11/2015
 * Time: 12:27
 */
require_once(__DIR__ . "/../core/PDOConnection.php");
require_once(__DIR__ . "/post.php");
class PostDAO {

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
            "SELECT * FROM posts WHERE user_id= ?"
        );
        if($stmt->execute(array(
            $userId
        ))) {
            $usuarios = array();
            for($i= 0 ; $i < $stmt->rowCount(); $i++){
                array_push(
                    $usuarios,
                    new Usuario(
                        $stmt["id"],
                        $stmt["username"],
                        $stmt["password"],
                        $stmt["tipo"],
                        $stmt["email"],
                        $stmt["descripcion"],
                        $stmt["foto"]
                    )
                );
            }
            return $usuarios;
        }
        return false;
    }

    /**
     * recibe la cantidad de posts para mostrar en la págna principal
     * @param  int $size
     * @return array
     */
    public function getHotPosts(
        $size
    ) {
        $stmt = $this->db->prepare(
          "SELECT id FROM  posts ORDER BY created DESC"
        );
        if($stmt->execute()) {
            if ($stmt->rowCount() > $size) {
                $ret = array();
                for ($i = 0; $i < $size; $i++) {
                    array_push($ret, $this->fill($stmt->fetchColumn()));
                }
                return $ret;
            } else {
                $ret = array();
                for ($i = 0; $i < $stmt->rowCount(); $i++) {
                    array_push($ret, $this->fill($stmt->fetchColumn()));
                }
                return $ret;
            }
        }
        return false;
    }

    /**
     * @param $post
     * @return bool
     */
    public function save(
        $post
    ) {
        $stmt = $this->db->prepare(
            "INSERT INTO posts(
                            titulo,
                            user_id,
                            cuerpo,
                            created,
                            contestada
                            ) VALUES
                            (?,?,?,?,?)"
        );
        return $stmt->execute(
            array(
                $post->getTitulo(),
                $post->getIdUsuario(),
                $post->getCuerpo(),
                $post->getFechaCreacion(),
                $post->getContestada()
            )
        );

    }

    public function edit(
        $post
    ) {
        $stmt = $this->db->prepare(
          "UPDATE posts SET titulo= ?, cuerpo= ?, created= ?, contestada= ? WHERE id= ?"
        );
        return $stmt->execute(
            $post->getTitulo(),
            $post->getCuerpo(),
            $post->getFechaCreacion(),
            $post->getContestada(),
            $post->getId()
        );
    }

    /**
     * @param $idPost
     * @return Post
     */
    public function fill(
        $idPost
    ) {
        $stmt = $this->db->prepare(
            "SELECT * FROM posts WHERE id= ?"
        );

        if ($stmt->execute(array($idPost))){
            if($stmt->rowCount() > 0){
                $fillData= $stmt->fetch(PDO::FETCH_ASSOC);
                return new Post(
                    $idPost,
                    $fillData["titulo"],
                    $fillData["contestada"],
                    $fillData["cuerpo"],
                    $fillData["numvisitas"],
                    $fillData["created"],
                    $fillData["user_id"],
                    NULL
                );
            }
        }
        return false;
    }

    /**
     * @param $idPost
     * @return bool
     */
    public function delete(
        $idPost
    ) {
        $stmt= $this->db->prepare(
            "DELETE * FROM post WHERE id= ?"
        );
        return $stmt->execute(array($idPost));
    }

}