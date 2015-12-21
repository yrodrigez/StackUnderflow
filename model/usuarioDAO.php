  <?php
// file: model/pinchoMapper.php
require_once(__DIR__."/../core/PDOConnection.php");
require_once(__DIR__."/../model/usuario.php");
/**
 * Class usuarioMapper
 *
 * Database interface for User entities
 * 
 * @author José Miguel Meilán Maldonado 
 */

class UsuarioDAO {
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
   * @param Usuario $user The user to be saved
   * @throws PDOException if a database error occurs
   * @return true if the user was successfully saved
   */      
  public function createUser(
    $user
    ) {
    $stmt = $this->db->prepare(
      "INSERT INTO users (id, username, password, name, email, foto, descripcion, tipo) 
      VALUES (?, ?, ?, ?, ?, ?, ?, ?);"
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
   * Gets the user specified by the username
   * 
   * @param string $username The username of the user we want to retrieve
   * @throws PDOException if a database error occurs
   * @return Usuario The user with the specified Username, NULL if its not found
   */
  public function getUser(
        $username
  ) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE username=?");
    $stmt->execute(array($username));
    if(
      $stmt->rowCount()>0
    ){
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
                $user["name"],
                array()
            );
      }
    }
    return false;
  }

  /**
   * Gets the user specified by the id
   * 
   * @param $id $id The username of the user we want to retrieve
   * @throws PDOException if a database error occurs
   * @return Usuario The user with the specified id, NULL if its not found
   */
  public function fill(
        $id
  ) {
    $stmt = $this->db->prepare("SELECT * FROM users WHERE id=?");
    $stmt->execute(array($id));
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
                $user["name"],
                array()
            );
      }
    }
    return false;
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
    }
    return false;
  }

  /**
   * Gets all the users in the database
   * 
   * @throws PDOException if a database error occurs
   * @return array of Users An array with all the users inside it, else Null
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
   * @param Usuario $user The user we want to modify
   * @throws PDOException if a database error occurs
   * @return True if the user was successfully modified
   */
  public function modificarUser(
    $user
    ) {
        if($user->getFotoPath() != NULL) {
            $stmt = $this->db->prepare("UPDATE users Set email = ?,
                                                     foto = ?,
                                                     descripcion = ? WHERE id = ?;");
            return $stmt->execute(array($user->getEmail(),
                $user->getFotoPath(),
                $user->getDescripcion(),
                $user->getId())
            );
        }else{
            $stmt = $this->db->prepare("UPDATE users Set email = ?,
                                                     descripcion = ? WHERE id = ?;");
            return $stmt->execute(array($user->getEmail(),
                $user->getDescripcion(),
                $user->getId())
            );
        }

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

  /**
   * @param $usuario Usuario
   * @return bool
   */
  public function isValid (
      $usuario
  ) {
      $stmt= $this->db->prepare(
          "SELECT count(username) FROM users where username=? and password=?"
      );
      $stmt->execute(array($usuario->getUsername(), $usuario->getPassword()));
      return $stmt->fetchColumn() > 0;
    }

  /**
   * @param $usuario Usuario
   * @return bool
   */
  public function exists (
      $usuario
  ) {
      $stmt= $this->db->prepare(
          "SELECT username FROM users where username=?;"
      );
      $stmt->execute(array($usuario->getUsername()));
      if($stmt->rowCount()>0) {
        return true;
      } else {
        return false;
      }
  }

  /**
   * @param $idUsuario string correspondiente al usuario
   * @param $idRespuesta string respuesta en la que se quiere comprobas si ha votado o no
   * @return int 0 en caso de que no haya votado, 1 en otro caso
   */
  public function noHaVotado(
      $idUsuario,
      $idRespuesta
  ) {
      $stmt = $this->db->prepare("SELECT count(*) FROM votos WHERE id_user= ? and id_respuesta= ?");
      $stmt->execute(array($idUsuario, $idRespuesta));
      $cont= $stmt->fetch(PDO::FETCH_ASSOC)["count(*)"] == 0;
      return $cont == 0 ? 0 : 1;
  }
}
