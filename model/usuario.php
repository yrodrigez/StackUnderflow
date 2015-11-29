<?php
class Usuario 
{
  private $id;
  private $username;
  private $password;
  private $tipoUsuario;
  private $email;
  private $descripcion;
  private $fotoPath;
  private $nombre;

  public function __construct(
    $id=NULL,
  	$username=NULL, 
  	$password=NULL, 
  	$tipoUsuario=NULL,
  	$email= NULL,
  	$descripcion= NULL,
  	$fotoPath= NULL,
    $nombre= NULL
  	) {
    $this->id = $id;
    $this->username = $username;
    $this->password = $password; 
    $this->tipoUsuario= $tipoUsuario;
    $this->email= $email;
    $this->descripcion= $descripcion;
    $this->fotoPath= $fotoPath;
    $this->nombre = $nombre;
  }
  
  public function getId() 
  {
    return $this->id;
  }

  public function getUsername() 
  {
    return $this->username;
  }
  
  public function getPassword()
  {
    return $this->password;
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

  public function getNombre()
  {
    return $this->nombre;
  }

  public function setId(
    $id
  ) {
    $this->id = $id;
  }

  public function setUsername(
  	$username
  ) {
    $this->username = $username;
  }

  public function setPassword(
  	$password
  ) {
    $this->password = $password;
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

  public function setTipo(
      $tipoUsuario
  ){
    $this->tipoUsuario = $tipoUsuario;
  }

  public function setNombre(
      $nombre
  ){
    $this->nombre = $nombre;
  }

  public function isValidForRegister() {
    $errors = array();
    
    if (strlen($this->username) < 5) {
            array_push($errors, array("error", "El usuario debe tener al menos cinco caracteres."));
    }
      
    if (strlen($this->password) < 5) {  // TODO: implementar verificacion de contraseña segura
            array_push($errors, array("error", "La contraseña debe tener al menos cinco caracteres"));
    }
      
    if (sizeof($errors)>0){
      return $errors;
    }
  }
}