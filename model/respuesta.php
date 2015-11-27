<?php
class Respuesta 
{
	private $idRespuesta;
	private $idPost;
	private $userId;
	private $cuerpo;
	private $fechaCreacion;

	public function __construct(
		$idRespuesta=NULL,
		$idPost=NULL,
		$cuerpo=NULL,
		$fechaCreacion= NULL,
		$idUsuario= NULL
	) {
		$this->idRespuesta = $idRespuesta;
		$this->cuerpo= $cuerpo;
		$this->idPost= $idPost;
		$this->userId= $idUsuario;
		$this->fechaCreacion= $fechaCreacion;
	}
	public function getIdRespuesta()
	{
		return $this->idRespuesta;
	}

	public function getIdPost()
	{
		return $this->idPost;
	}

	public function getUserId()
	{
		return $this->userId;
	}

	public function getCuerpo()
	{
		return $this->cuerpo;
	}
	public function getFechaCreacion()
	{
		return $this->fechaCreacion;
	}
	
	public function setIdRespuesta(
		$idRespuesta= NULL
	) {
		$this->idRespuesta= $idRespuesta;
	}
	
	public function setIdUser(
		$userId= NULL
	) {
		$this->userId= $userId;
	}

	public function setIdPost(
		$idPost= NULL
	) {
		$this->idPost= $idPost;
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