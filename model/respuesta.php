<?php
class Respuesta 
{
	private $idRespuesta;
	private $idPost;
	private $userId;
	private $cuerpo;
	private $fechaCreacion;
	private $votos;

	public function __construct(
		$idRespuesta=NULL,
		$idPost=NULL,
		$cuerpo=NULL,
		$fechaCreacion= NULL,
		$idUsuario= NULL,
		$votos= NULL
	) {
		$this->idRespuesta = $idRespuesta;
		$this->cuerpo= $cuerpo;
		$this->idPost= $idPost;
		$this->userId= $idUsuario;
		$this->fechaCreacion= $fechaCreacion;
		$this->votos = $votos;
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

	public function getVotos()
	{
		return $this->votos;
	}
	
	public function setIdRespuesta(
		$idRespuesta= NULL
	) {
		$this->idRespuesta= $idRespuesta;
	}
	
	public function setIdUser(
		$idUser= NULL
	) {
		$this->userId= $idUser;
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

	public function setVotos(
		$votos= NULL
	) {
		$this->votos= $votos;
	}
}