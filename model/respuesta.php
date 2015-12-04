<?php
class Respuesta 
{
	private $idRespuesta;
	private $idPost;
	private $userId;
	private $cuerpo;
	private $fechaCreacion;
	private $votos;
	private $usuarioCreador;
	private $likes;
	private $dislikes;

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
		$this->likes= 0;
		$this->dislikes= 0;
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
	/**
	 * @return Usuario
	 */
	public function getUsuarioCreador()
	{
		return $this->usuarioCreador;
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
	public function setUsuarioCreador(
		$usuarioCreador= NULL
	) {
		$this->usuarioCreador= $usuarioCreador;
	}

	public function getDislikes()
	{
		return $this->dislikes;
	}

	public function addDislike()
	{
		$this->dislikes++;
	}

	public function getLikes()
	{
		return $this->likes;
	}

	public function addLike()
	{
		$this->likes++;
	}
}