<?php
// file: model/pinchoMapper.php
require_once("/../core/PDOConnection.php");
require_once("/../Model/usuario.php");
/**
 * Class usuarioMapper
 *
 * Database interface for User entities
 * 
 * @author José Miguel Meilán Maldonado 
 */

class usuarioMapper {
  /**
   * Reference to the PDO connection
   * @var PDO
   */
  private $db;
  
  public function __construct() {
    $this->db = PDOConnection::getInstance();
}

  /**
   * Creates an User into the database
   * 
   * @param User $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return true if the user was successfully saved
   */      
  public function createUser(
    $user
    ) {
    $stmt = $this->db->prepare(
      "INSERT INTO USUARIO (USERNAME, PASSWORD, EMAIL, FOTO, DESCRIPCION, TIPO) 
      VALUES (?, ?, ?, ?, ?, ?);"
      );
    return $stmt->execute(array($user->getUsername(), 
     $user->getPassword(), 
     $user->getEmail(), 
     $user->getFotoPath(), 
     $user->getDescripcion(),  
     $user->getTipoUsuario()));
}

  /**
   * Gets the user specified by the username
   * 
   * @param string $idUser The id of the user we want to retrieve
   * @throws PDOException if a database error occurs
   * @return User The user with the specified ID, NULL if its not found
   */
  public function getUser(
        $idUser
  ) {
    $stmt = $this->db->prepare("SELECT * FROM USUARIO WHERE IDUSUARIO=?");
    $stmt->execute(array($idUser));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $user
        ) {
            return new Usuario(
                $user["IDUSUARIO"],
                $user["USERNAME"],
                $user["PASSWORD"],
                $user["TIPO"],
                $user["EMAIL"],
                $user["DESCRIPCION"],
                $user["FOTO"]
            );
      }
    } else {
        return NULL;
    }
  }

  /**
   * Gets all the users in the database
   * 
   * @throws PDOException if a database error occurs
   * @return Array of Users An array with all the users inside it, else Null
   */
  public function getAllUsers() {
    $users = array();
    $stmt = $this->db->prepare("SELECT * FROM USUARIO");
    $stmt->execute();
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $user
      ) {
        array_push($users, new Usuario(
                $user["IDUSUARIO"],
                $user["USERNAME"],
                $user["PASSWORD"],
                $user["TIPO"],
                $user["EMAIL"],
                $user["DESCRIPCION"],
                $user["FOTO"]
            )); 
      }
      return $users;
    } else {
        return NULL;
    }
  }

  /**
   * Modifies an user
   * 
   * @param User $user The user we want to modify
   * @throws PDOException if a database error occurs
   * @return True if the user was successfully modified
   */
  public function modificarUser(
    $user
    ) {
    $stmt = $this->db->prepare("UPDATE USUARIO Set EMAIL = ?, 
                                                   FOTO = ?, 
                                                   DESCRIPCION = ? WHERE IDUSUARIO = ?;");
    return $stmt->execute(array($user->getEmail(), 
     $user->getFotoPath(), 
     $user->getDescripcion(), 
     $user->getId()));
  }

  /**
   * Deletes an user
   * 
   * @param Int $idUser The id of the user we want to delete
   * @throws PDOException if a database error occurs
   * @return True if the user was successfully deleted
   */
  public function borrarUser(
    $idUser
    ) {
    $stmt = $this->db->prepare("DELETE FROM USUARIO WHERE IDUSUARIO= ?;");
    return $stmt->execute(array($idUser));
  }
}
?>