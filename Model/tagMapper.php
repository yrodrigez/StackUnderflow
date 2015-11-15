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

class tagMapper {
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
  		"INSERT INTO TAG (TAG) 
  		VALUES (?);"
  		);
  	return $stmt->execute(array($tag->getTag()));
  }

  /**
   * Gets the tag specified by the string
   * 
   * @param string $tagName The name of the tag we want to find
   * @throws PDOException if a database error occurs
   * @return Tag The tag with the specified name, NULL if its not found
   */
  public function getTag(
  	$tagName
  	) {
  	$stmt = $this->db->prepare("SELECT * FROM TAG WHERE TAG LIKE ?");
  	$stmt->execute(array($tagName));
  	if($stmt->rowCount()>0) {
  		foreach (
  			$stmt as $tag
  			) {
  			return new Tag(
  				$tag["TAG"]
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
  	$stmt = $this->db->prepare("SELECT * FROM TAG");
  	$stmt->execute();
  	if($stmt->rowCount()>0) {
  		foreach (
  			$stmt as $tag
  			) {
  			array_push($tags, new Tag(
  				$tag["TAG"]
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
  	$stmt = $this->db->prepare("DELETE FROM TAG WHERE TAG= ?;");
  	return $stmt->execute(array($tagName));
  }
}
?>