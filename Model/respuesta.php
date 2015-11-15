<?php
class Respuesta 
{
	private $idPost;
	private $idUsuario;
	private $cuerpo;
	private $fechaCreacion;

	public function __construct( 
		$idPost=NULL,
		$cuerpo=NULL,
		$fechaCreacion= NULL,
		$idUsuario= NULL
	) {
		$this->cuerpo= $cuerpo;
		$this->idPost= $idPost;
		$this->idUsuario= $idUsuario;
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
}