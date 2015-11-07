<? php
class Usuario {

  private $username;
  private $passwd;
  private $tipoUsuario;
 	private $email;
 	private $descripcion;
 	private $fotoPath;

  public function __construct(
  	$username=NULL, 
  	$passwd=NULL, 
  	$tipoUsuario=NULL,
  	$email= NULL
  	$descripcion= NULL,
  	$fotoPath= NULL
  	) {
    $this->username = $username;
    $this->passwd = $passwd; 
    $this->tipoUsuario= $tipoUsuario
    $this->email= $email;
    $this->descripcion= $descripcion;
    $this->fotoPath= $fotoPath;
  }
  
  public function getUsername() 
  {
    return $this->username;
  }
  
  public function getPasswd() 
  {
    return $this->passwd;
  }  
  
  public function getTipoUsuario() 
  {
    return $this->tipoUsuario;
  }

  public function getEmail()
  {
  	return $this->email;
  }

  public function getDescripcion()
  {
  	return $this->descripcion;
  }

  public function getFotoPath()
  {
  	return $this->fotoPath;
  }

  public function setUsername(
  	$username
  ) {
    $this->username = $username;
  }

  public function setUsername(
  	$username
  ) {
    $this->username = $username;
  }

  public function setPassword(
  	$passwd
  ) {
    $this->passwd = $passwd;
  }

  public function setDescripcion(
  	$descripcion
  ) {
  	$this->descripcion= $descripcion;
  }

  public function setEmail(
  	$email
  ) {
  	$this->email= $email;
  }

  public function setFotoPath(
  	$fotoPath
  ) {
  	$this->fotoPath= $fotoPath;
  }

  /*
  public function checkIsValidForRegister() {
      $errors = array();
      if (strlen($this->username) < 5) {
	$errors["username"] = "Username must be at least 5 characters length";
	
      }
      if (strlen($this->passwd) < 5) {
	$errors["passwd"] = "Password must be at least 5 characters length";	
      }
      if (sizeof($errors)>0){
	throw new ValidationException($errors, "user is not valid");
      }
  } 
  */
}