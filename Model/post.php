<?php
class Post 
{

	private $titulo;
	private $contestada;
	private $cuerpo;
	private $numVisitas;
	private $fechaCreacion;
	private $idUsuario;

	public function __construct(
		$titulo= NULL,
		$contestada=NULL,
		$cuerpo= NULL,
		$numVisitas= NULL,
		$fechaCreacion= NULL,
		$idUsuario=NULL
		) {
		$this->titulo = $titulo;
		$this->contestada = $contestada; 
		$this->cuerpo= $cuerpo;
		$this->numVisitas= $numVisitas;   
		$this->fechaCreacion= $fechaCreacion;
		$this->idUsuario= $idUsuario;
	}

	public function getIdUsuario(){
		return $this->idUsuario;
	}

	public function setIdUsuario($idUsuario)
	{
		$this->idUsuario = $idUsuario;
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
}