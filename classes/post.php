<?php
class Post {

	private $titulo;
	private $contestada;
	private $cuerpo;
	private $numVisitas;
	private $fechaCreacion;

	public function __construct(
		$titulo= NULL,
		$contestada=NULL,
		$cuerpo= NULL,
		$numVisitas= NULL,
		$fechaCreacion= NULL
		) {
		$this->titulo = $titulo;
		$this->contestada = $contestada; 
		$this->cuerpo= $cuerpo;
		$this->numVisitas= $numVisitas;   
		$this->fechaCreacion= $fechaCreacion;
	}

	public function getTitulo()
	{
		return $this->titulo;
	}
	public function getContestada()
	{
		return $this->contestada;
	}
	public function getNumVisitas()
	{
		return $this->numVisitas;
	}
	public function getCuerpo()
	{
		return $this->cuerpo;
	}
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}
	public function setTitulo(
		$titulo= NULL
		) {
		$this->titulo= $titulo;
	}
	public function setContestada(
		$contestada= NULL
		) {
		$this->contestada= $contestada;
	}

	public function setCuerpo(
		$cuerpo= NULL
		) {
		$this->cuerpo= $cuerpo;
	}
	public function setNumVisitas(
		$numVisitas= NULL
		) {
		$this->numVisitas= $numVisitas;
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