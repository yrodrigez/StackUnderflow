<?php
session_start();
require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/respuesta.php");
require_once(__DIR__."/../model/respuestaDAO.php");

require_once(__DIR__."/../controller/BaseController.php");


class RespuestasController extends BaseController {
  
	private $respuestaDAO;    
  
	public function __construct() {    
		parent::__construct();

		$this->respuestaDAO = new RespuestaDAO();
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
