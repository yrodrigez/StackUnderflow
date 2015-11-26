<?php
// file: model/pinchoMapper.php
require_once("/../core/PDOConnection.php");
require_once("/../Model/tag.php");
/**
 * Class tagMapper
 *
 * Database interface for tag entities
 * 
 * @author José Miguel Meilán Maldonado 
 */

class tagDAO{
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
   * @return true if the tag was successfully saved
   */      
  public function createTag(
  	$tag
  	) {
  	$stmt = $this->db->prepare(
  		"INSERT INTO tags (id,tag)
  		VALUES (?,?);"
  		);
  	return $stmt->execute(array($tag->getId(), $tag->getTag()));
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
    } else {
  	 return NULL;
    }
  }


  /**
   * Gets all the tags in the database
   * 
   * @throws PDOException if a database error occurs
   * @return Array of Tags An array with all the users inside it, else Null
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
    } else {
  	 return NULL;
    }
  }

  /**
   * Deletes a Tag
   * 
   * @param string $tagName The name of the tag we want to delete
   * @throws PDOException if a database error occurs
   * @return True if the user was successfully deleted
   */
  public function borrarTag(
  	$tagName
  	) {
  	$stmt = $this->db->prepare("DELETE FROM tags WHERE tag= ?;");
  	return $stmt->execute(array($tagName));
  }

  /**
   * Gets all the tags of a post
   * 
   * @param Int $idPost The id of the post we want to get the tags from 
   * @throws PDOException if a database error occurs
   * @return Array of Tags All the tags from a Post, else return NULL
   */
	public function getAllPostTags(
		$idPost
	){
    $tags = array();
		$stsmt = $this->db->prepare("SELECT tags.id, tags.tag FROM post_tag, tags WHERE post_tag.tag_id=tags.id AND post_tag.post_id= ?;");
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
    } else {
     return NULL;
    }
	}

}
