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
     * @return  Post array
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
        $posts = array();
      foreach($stmt as $post){
        array_push(
          $posts,
          new Post(
           $post["id"],
           $post["titulo"],
           $post["contestada"],
           $post["cuerpo"],
           $post["numvisitas"],
           $post["created"],
           $post["user_id"],
           NULL
          )
        );
      }
      return $posts;
    }
    return false;
  }


  /**
   * retorna todos los posts sin contestar
   * @return array
   */
  public function getPostsSinContestar(){
    $stmt= $this->db->prepare("SELECT * FROM posts WHERE contestada= ?");
    if($stmt->execute(array(0))){
      $posts = array();
      foreach($stmt as $post) {
        array_push(
            $posts,
            new Post(
                $post["id"],
                $post["titulo"],
                $post["contestada"],
                $post["cuerpo"],
                $post["numvisitas"],
                $post["created"],
                $post["user_id"],
                NULL
            )
        );
      }
      return $posts;
    }else{
      return array();
    }
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
        "SELECT * FROM  posts ORDER BY created DESC"
        );
      $i=0;
      if($stmt->execute()) {
        if ($stmt->rowCount() > $size) {
          $ret = array();
          foreach ($stmt as $post) {
            array_push(
              $ret,
                new Post(
                    $post["id"],
                    $post["titulo"],
                    $post["contestada"],
                    $post["cuerpo"],
                    $post["numvisitas"],
                    $post["created"],
                    $post["user_id"],
                    NULL
                )
            );
            if($i < $size)
              $i++;
            else
              break;
          }
          return $ret;
        } else {
          $ret = array();
          foreach ($stmt as $post) {
            array_push(
                $ret,
                new Post(
                    $post["id"],
                    $post["titulo"],
                    $post["contestada"],
                    $post["cuerpo"],
                    $post["numvisitas"],
                    $post["created"],
                    $post["user_id"],
                    NULL
                )
            );
            if($i < $stmt->rowCount())
              $i++;
            else
              break;
          }
          return $ret;
        }
      }
      return false;
    }

    /**
     * Busca en el titulo y el cuerpo del post, la cadena que recibe por parametros
     * @param  String $query
     * @return array of Posts
     */
    public function search(
      $query
    ) {
      $stmt = $this->db->prepare(
        "SELECT * FROM  posts WHERE titulo LIKE ? OR cuerpo LIKE ?;"
        );
      if($stmt->execute(array("%".$query."%", "%".$query."%"))) {
          $ret = array();
          foreach($stmt as $post) {
            array_push(
                $ret,
                new Post(
                    $post["id"],
                    $post["titulo"],
                    $post["contestada"],
                    $post["cuerpo"],
                    $post["numvisitas"],
                    $post["created"],
                    $post["user_id"],
                    NULL
                )
            );
          }
          return $ret;
      } else{
        return NULL;
      }
    }

    /**
     * @param $post Post
     * @return bool
     */
    public function save(
      $post
      ) {
      $stmt = $this->db->prepare(
        "INSERT INTO posts(
          id,
          titulo,
          user_id,
          cuerpo,
          numvisitas,
          created,
          contestada
          ) VALUES
      (?,?,?,?,?,?,?)"
      );
      $stmt->execute(
        array(
          $post->getId(),
          $post->getTitulo(),
          $post->getIdUsuario(),
          $post->getCuerpo(),
          $post->getNumVisitas(),
          $post->getFechaCreacion(),
          $post->getContestada()
        )
      );

      $postInsertado = $this->db->lastInsertId();
      foreach($post->getTags() as $tag){

        $stmt = $this->db->prepare(
          "INSERT INTO post_tag(tag_id,post_id) VALUES (?, ?);"
          );
        $stmt->execute(array($tag->getId(),$postInsertado));
      }
    }


  /**
   * @param $post Post
   * @return bool
   */
  public function edit(
      $post
      ) {
      $stmt = $this->db->prepare(
        "UPDATE posts SET titulo= ?, cuerpo= ?, created= ?, contestada= ? WHERE id= ?"
        );
      return $stmt->execute(
        array(
          $post->getTitulo(),
          $post->getCuerpo(),
          $post->getFechaCreacion(),
          $post->getContestada(),
          $post->getId()
        )
      );
    }

  /**
   * @param $post Post
   * @return bool
   */
  public function aumentarVisitas(
      $post
    ) {
      $stmt = $this->db->prepare(
        "UPDATE posts SET numVisitas= ? WHERE id= ?"
        );
      return $stmt->execute(array(
        $post->getNumVisitas(),
        $post->getId()
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
        "DELETE FROM posts WHERE id= ?"
        );
      return $stmt->execute(array($idPost));
    }
}