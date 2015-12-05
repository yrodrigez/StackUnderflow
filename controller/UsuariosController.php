<?php
session_start();
require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../model/usuario.php");
require_once(__DIR__."/../model/usuarioDAO.php");
require_once(__DIR__."/../model/postDAO.php");
require_once(__DIR__."/../controller/BaseController.php");

class UsuariosController extends BaseController {
  
	private $userDAO;
	private $postsDao;
  
	public function __construct() {    
		parent::__construct();

		$this->userDAO = new UsuarioDAO();
		$this->postsDao= new PostDAO();
	}

	/**
	 * @var Usuario $usuario
	 * Muestra el perfil del usuario llenando sus datos y posts antes
     */
	public function view(){
		$idUsuario= $_SESSION["user"];
		$usuario= $this->userDAO->fill($idUsuario);
		$usuario->setPosts($this->postsDao->getAllUserPosts($usuario->getId()));
		$this->view->setVariable("usuario", $usuario);
		$this->view->render("usuarios", "view");
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
                array_push($msg, array("error", i18n("Datos de sesión inválidos")));
				$this->view->setFlash($msg);
				$this->view->redirect("posts", "index");
			}
		}   
	}
	/**
	 * @var Usuario $usuario
	 */
	public function edit(){
		$idUsuario= $_SESSION["user"];
		$usuario= $this->userDAO->fill($idUsuario);
		$this->view->setVariable("usuario", $usuario);
		$this->view->render("usuarios", "edit");
	}

	public function editUser(){
		if(isset($_SESSION["username"]) && $_SESSION["username"] == $_POST["username"] ){
			$username= $_POST["username"];
			$password= $_POST["password"];
			$descripcion= $_POST["descripcion"];
			$nombre= $_POST["nombre"];
			$email= $_POST["email"];

			$user = new Usuario(
					$_SESSION["user"],
					$username,
					$password,
					1,
					$email,
					$descripcion,
					NULL,
					$nombre,
					array()
			);

			if($_FILES["avatar"] and $_FILES["avatar"]["name"]) {
				$name = $_POST["username"] . "." . substr(strrchr($_FILES["avatar"]["name"], '.'), 1);
				$path = "img/users/" . $name;
				move_uploaded_file($_FILES["avatar"]["tmp_name"], $path);
				$user->setFotoPath($name);
			} else {
				$user->setFotoPath($this->userDAO->fill($_SESSION["user"])->getFotoPath());
			}

			$this->userDAO->modificarUser($user);

			$user->setPosts($this->postsDao->getAllUserPosts($user->getId()));
			$this->view->setVariable("usuario", $user);
			$this->view->render("usuarios", "view");
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
	                    array_push($msg, array("success", i18n("El usuario se ha creado correctamente")));
	                    $this->view->setFlash($msg);
						$this->view->redirect("posts", "index");
					} else {
	                    $msg = array();
	                    array_push($msg, array("error", i18n("El usuario ya existe")));
	                    $this->view->setFlash($msg);
					}
				} else {
					$this->view->setFlash($errors);
				}	
			} else {
				$msg = array();
                array_push($msg, array("error", i18n("Las contraseñas deben coincidir")));
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
