<?php
session_start();
require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/respuesta.php");
require_once(__DIR__."/../model/respuestaDAO.php");

require_once(__DIR__."/../model/usuarioDAO.php");
require_once(__DIR__."/../model/postDAO.php");
require_once(__DIR__."/../model/post.php");
require_once(__DIR__."/../model/usuario.php");
require_once(__DIR__."/../model/tagDAO.php");
require_once(__DIR__."/../model/tag.php");
require_once(__DIR__."/../controller/BaseController.php");


class RespuestasController extends BaseController {
  
	private $respuestaDAO;
	private $usuarioDAO;
	private $postDao;
	private $tagDAO;
  
	public function __construct() {    
		parent::__construct();
		$this->respuestaDAO = new RespuestaDAO();
		$this->usuarioDAO= new UsuarioDAO();
		$this->postDao= new PostDAO();
		$this->tagDAO= new TagDAO();
	}

	/**
	 * @var Post $post
	 */
	public function addLike(){

		if(isset($_SESSION["user"])){
			if($this->usuarioDAO->noHaVotado($_SESSION["user"], $_GET["id"]) == 1){
				$this->respuestaDAO->addLike($_SESSION["user"], $_GET["id"]);
			}
		}

		$post= $this->respuestaDAO->dameMiPost($_GET["id"]);
		$post->setTags($this->tagDAO->getAllPostTags($post->getId()));
		$autor= $this->usuarioDAO->fill($post->getIdUsuario());
		$respuestas= $this->respuestaDAO->getRespuestasDePost($post->getId());
		if($this->respuestaDAO->getAllRespuestasLikes($respuestas)){
			//ok
		}else{
			//algo no andaría bien
		}
		if ($respuestas != NULL) {
			foreach ($respuestas as $respuesta){
				$usuarioCreador = $this->usuarioDAO->fill($respuesta->getUserId());
				$respuesta->setUsuarioCreador($usuarioCreador);
			}
		}
		$this->view->setVariable("post", $post);
		$this->view->setVariable("autor", $autor);
		$this->view->setVariable("respuestas", $respuestas);
		$this->view->render("posts","view");
	}

	public function addDislike(){
		if(isset($_SESSION["user"])){
			if($this->usuarioDAO->noHaVotado($_SESSION["user"], $_GET["id"])){
				$this->respuestaDAO->addDislike($_SESSION["user"], $_GET["id"]);
			}
		}

		$post= $this->respuestaDAO->dameMiPost($_GET["id"]);
		$post->setTags($this->tagDAO->getAllPostTags($post->getId()));
		$autor = $this->usuarioDAO->fill($post->getIdUsuario());
		$respuestas = $this->respuestaDAO->getRespuestasDePost($post->getId());
		if($this->respuestaDAO->getAllRespuestasLikes($respuestas)){
			//ok
		}else{
			//algo no andaría bien
		}
		if ($respuestas != NULL) {
			foreach ($respuestas as $respuesta){
				$usuarioCreador = $this->usuarioDAO->fill($respuesta->getUserId());
				$respuesta->setUsuarioCreador($usuarioCreador);
			}
		}
		$this->view->setVariable("post", $post);
		$this->view->setVariable("autor", $autor);
		$this->view->setVariable("respuestas", $respuestas);
		$this->view->render("posts","view");

	}


	public function add() {
		if(isset($_SESSION["username"]) && ($_SESSION["type"] == 1)){
			if ($_GET["id"]) {
				if ($_POST["respuesta"] != NULL) {
					$respuesta = new Respuesta(0,
										   $_GET["id"],
										   $_POST["respuesta"],
										   date ("Y-m-d H:i:s",time()),
										   $_SESSION["user"]);
					$this->respuestaDAO->save($respuesta);
					$msg = array();
		       	    array_push($msg, array("success", i18n("Respuesta creada correctamente")));
		            $this->view->setFlash($msg);
		            $this->view->redirectToReferer(); 
	        	} else {
	        		$msg = array();
	       	    	array_push($msg, array("error", i18n("Debe rellenar la respuesta")));
	            	$this->view->setFlash($msg);
	            	$this->view->redirectToReferer(); 
				}
	        }
		} else {
			$msg = array();
	       	array_push($msg, array("error", i18n("Debe estar logueado para responder a un post")));
	        $this->view->setFlash($msg);
	        $this->view->redirect("posts","index");
		}
	}
}
