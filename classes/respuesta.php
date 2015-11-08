<?php
class Respuesta 
{
	/*Es necesario cambiar el idRespuesta???*/
	private $idRespuesta;
	private $cuerpo;
	private $fechaCreacion;

	public function __construct( 
		$idRespuesta=NULL,
		$cuerpo=NULL,
		$fechaCreacion= NULL
	) {
		$this->cuerpo= $cuerpo;
		$this->idRespuesta= $idRespuesta;   
		$this->fechaCreacion= $fechaCreacion;
	}
	public function getIdRespuesta()
	{
		return $this->idRespuesta;
	}

	public function getCuerpo()
	{
		return $this->cuerpo;
	}
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}
	
	public function setCuerpo(
		$cuerpo= NULL
		) {
		$this->cuerpo= $cuerpo;
	}
	
	public function setFechaCreacion(
		$fechaCreacion= NULL
		) {
		$this->fechaCreacion= $fechaCreacion;
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