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

class usuarioDAO {
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
      "INSERT INTO users (id, username, password, name, email, foto, descripcion, tipo) 
      VALUES (?, ?, ?, ?, ?, ?, ?);"
      );
    return $stmt->execute(array(0,
     $user->getUsername(), 
     $user->getPassword(), 
     $user->getNombre(),
     $user->getEmail(), 
     $user->getFotoPath(), 
     $user->getDescripcion(),  
     $user->getTipoUsuario()));
}

  /**
   * Gets the user specified by the id
   * 
   * @param string $idUserThe id of the user we want to retrieve
   * @throws PDOException if a database error occurs
   * @return User The user with the specified Username, NULL if its not found
   */
  public function getUser(
        $idUser
  ) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
    $stmt->execute(array($idUser));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $user
        ) {
            return new Usuario(
                $user["id"],
                $user["username"],
                $user["password"],
                $user["tipo"],
                $user["email"],
                $user["descripcion"],
                $user["foto"],
                $user["name"]
            );
      }
    } else {
        return NULL;
    }
  }

  /**
   * Gets the id of the username
   * 
   * @param string $username The username of the user we want to get the id from
   * @throws PDOException if a database error occurs
   * @return Int The id of the user, NULL if its not found
   */
  public function getIdOfUser(
        $username
  ) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute(array($username));
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $user
      ) {
            return $user["id"];
                
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
    $stmt = $this->db->prepare("SELECT * FROM users");
    $stmt->execute();
    if($stmt->rowCount()>0) {
      foreach (
        $stmt as $user
      ) {
        array_push($users, new Usuario(
                $user["id"],
                $user["username"],
                $user["password"],
                $user["tipo"],
                $user["email"],
                $user["descripcion"],
                $user["foto"],
                $user["name"]
            )
        ); 
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
    $stmt = $this->db->prepare("UPDATE users Set email = ?, 
                                                 foto = ?, 
                                                 descripcion = ? WHERE id = ?;");
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
    $stmt = $this->db->prepare("DELETE FROM users WHERE id= ?;");
    return $stmt->execute(array($idUser));
  }
}
?>