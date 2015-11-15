<?php
class Respuesta 
{
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
}