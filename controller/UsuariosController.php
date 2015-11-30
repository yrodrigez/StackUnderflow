<?php

require_once(__DIR__."/../core/ViewManager.php");

require_once(__DIR__."/../model/Usuario.php");
require_once(__DIR__."/../model/UsuarioDAO.php");

require_once(__DIR__."/../controller/BaseController.php");


class UsuariosController extends BaseController {
  
	private $userDAO;    
  
	public function __construct() {    
		parent::__construct();

		$this->userDAO = new UsuarioDAO();
	}

	public function login() {
		if (isset($_POST["username"])){ 
			$user = new Usuario(0,$_POST["username"], $_POST["password"]);
			
			if ($this->userDAO->isValid($user)) {
				$idUser = $this->userDAO->getIdOfUser($_POST["username"]);
				$_SESSION["user"]= $idUser;
				$_SESSION["username"]= $_POST["username"];
				$user = $this->userDAO->getUser($user->getUsername());
				$_SESSION["type"]=$user->getTipoUsuario();
				$this->view->redirect("posts", "index");
			} else {
				$msg = array();
                array_push($msg, array("error", "Datos de sesión inválidos"));
				$this->view->setFlash($msg);
				$this->view->redirect("posts", "index");
			}
		}   
	}


	public function add() {

		$user=NULL;
    
		if (isset($_POST["username"])){ 
			if($_POST["password"] == $_POST["password_confirm"]) {
				$user = new Usuario(0,$_POST["username"], $_POST["password"]);
				$errors = $user->isValidForRegister(); 
				if ($errors == NULL) {
					if (!$this->userDAO->exists($user)) {
						$user->setEmail($_POST["email"]);
						$user->setTipo(1);
						$user->setNombre($_POST["name"]);
						if($_FILES['avatar'] and $_FILES['avatar']['name']) {
							$name = $_POST["username"] . "." . substr(strrchr($_FILES['avatar']['name'], '.'), 1);
							$path = "img/users/" . $name;
							move_uploaded_file($_FILES['avatar']['tmp_name'], $path);
							$user->setFotoPath($name);
						} else {
							$user->setFotoPath("default.png");
						}
						$this->userDAO->createUser($user);

	                    $msg = array();
	                    array_push($msg, array("success", "El usuario se ha creado correctamente"));
	                    $this->view->setFlash($msg);
						$this->view->redirect("posts", "index");
					} else {
	                    $msg = array();
	                    array_push($msg, array("error", "El usuario ya existe"));
	                    $this->view->setFlash($msg);
					}
				} else {
					$this->view->setFlash($errors);
				}	
			} else {
				$msg = array();
                array_push($msg, array("error", "Las contraseñas deben coincidir"));
				$this->view->setFlash($msg);
				$this->view->redirect("usuarios", "add");
			}

		}

		$this->view->setVariable("user", $user);
		$this->view->render("usuarios", "add");
	}
	
	public function logout() {
		session_destroy();
		$this->view->redirect("posts", "index");
	}
}
