<?php
class Usuario 
{
  private $id;
  private $username;
  private $passwd;
  private $tipoUsuario;
 	private $email;
 	private $descripcion;
 	private $fotoPath;

  public function __construct(
    $id=NULL,
  	$username=NULL, 
  	$passwd=NULL, 
  	$tipoUsuario=NULL,
  	$email= NULL,
  	$descripcion= NULL,
  	$fotoPath= NULL
  	) {
    $this->id = $id;
    $this->username = $username;
    $this->passwd = $passwd; 
    $this->tipoUsuario= $tipoUsuario;
    $this->email= $email;
    $this->descripcion= $descripcion;
    $this->fotoPath= $fotoPath;
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

  public function setTipo(
      $tipoUsuario
  ){
    $this->tipoUsuario = $tipoUsuario;
  }
}