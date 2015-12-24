<?php
// file: model/pinchoMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/tag.php");
/**
 * Class tagMapper
 *
 * Database interface for tag entities
 * 
 * @author José Miguel Meilán Maldonado 
 */

class TagDAO{
  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;
  
  public function __construct() {
  	$this->db = PDOConnection::getInstance();
  }

  /**
   * Creates a Tag into the database
   * 
   * @param Tag $tag The tag to be saved
   * @throws PDOException if a database error occurs
   * @return true if the tag was successfully saved, false if the tag already exists in the DB
   */      
  public function createTag(
  	$tag
  	) {
    if($this->getIdOfTag($tag->getTag())==NULL){
      $stmt = $this->db->prepare(
      "INSERT INTO tags (id,tag)
      VALUES (?,?);"
      );
      return $stmt->execute(array($tag->getId(), $tag->getTag()));
    } else {
      return false;
    }	
  }

  /**
   * Gets the tag specified by the id
   * 
   * @param string $idTag The id of the tag we want to find
   * @throws PDOException if a database error occurs
   * @return Tag The tag with the specified id, NULL if its not found
   */
  public function getTag(
  	$idTag
  	) {
  	$stmt = $this->db->prepare("SELECT * FROM tags WHERE id= ?");
  	$stmt->execute(array($idTag));
  	if($stmt->rowCount()>0) {
  		foreach (
  			$stmt as $tag
  			) {
  			return new Tag(
          $tag["id"],
  				$tag["tag"]
  		);
  	 }
    }
    return NULL;
  }


  /**
   * Gets all the tags in the database
   * 
   * @throws PDOException if a database error occurs
   * @return array of Tags An array with all the users inside it, else Null
   */
  public function getAllTags() {
  	$tags = array();
  	$stmt = $this->db->prepare("SELECT * FROM tags");
  	$stmt->execute();
  	if($stmt->rowCount()>0) {
  		foreach (
  			$stmt as $tag
  			) {
  			array_push($tags, new Tag(
          $tag["id"],
  				$tag["tag"]
  		  )); 
  	  }
  	 return $tags;
    }
  	return NULL;
  }

  /**
   * Gets the id of a tag
   * 
   * @param $tagName string $tagname The name of the tag we want to get the id from
   * @throws PDOException if a database error occurs
   * @return Int The id of the tag, NULL if its not found
   */
  public function getIdOfTag(
        $tagName
  ) {
    $stmt = $this->db->prepare("SELECT * FROM tags WHERE tag=?");
    $stmt->execute(array($tagName));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $tag
      ) {
            return $tag["id"];     
      } 
    }
    return false;
  }

  /**
   * Deletes a Tag
   * 
   * @param int $idTag The id of the tag we want to delete
   * @throws PDOException if a database error occurs
   * @return True if the tag was successfully deleted
   */
  public function borrarTag(
  	$idTag
  	) {
  	$stmt = $this->db->prepare("DELETE FROM tags WHERE id= ?;");
  	return $stmt->execute(array($idTag));
  }

  /**
   * Gets all the tags of a post
   * 
   * @param Int $idPost The id of the post we want to get the tags from 
   * @throws PDOException if a database error occurs
   * @return array of Tags All the tags from a Post, else return NULL
   */
	public function getAllPostTags(
		$idPost
	){
    $tags = array();
		$stmt = $this->db->prepare("SELECT tags.id, tags.tag FROM post_tag, tags WHERE post_tag.tag_id=tags.id AND post_tag.post_id= ?;");
    	$stmt->execute(array($idPost));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $tag
      ) {
        array_push($tags, new Tag(
          $tag["id"],
          $tag["tag"]
        )); 
      }
     return $tags;
    }
    return NULL;
	}

  public function getAllPostsByTag(
   $idTag
  ){
    $posts= array();

    $stmt= $this->db->prepare(
      "SELECT posts.*
       FROM post_tag, tags, posts
       WHERE post_tag.tag_id=tags.id
       AND post_tag.post_id=posts.id
       AND post_tag.tag_id= ?"
    );
    $stmt->execute(array($idTag));
    foreach ($stmt as $post) {
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

}
