<?php
/**
 * Created by PhpStorm.
 * @author: yago
 * Date: 27/11/15
 * Time: 17:10
 */
//file: /controller/PostsController.php

session_start();
require_once(__DIR__ . "/../model/post.php");
require_once(__DIR__ . "/../model/usuario.php");
require_once(__DIR__."/../model/postDAO.php");
require_once(__DIR__."/../model/tagDAO.php");
require_once(__DIR__."/../model/usuarioDAO.php");
require_once(__DIR__."/../model/respuestaDAO.php");
require_once(__DIR__ . "/../controller/BaseController.php");

/**
 * Class CommentsController
 *
 * Controller for comments related use cases.
 *
 */
class PostsController extends BaseController
{
    private $postDAO;
    private $tagDAO;
    const HOT_POST_SIZE = 10;

    public function __construct()
    {
        parent::__construct();
        $this->postDAO= new PostDAO();
        $this->tagDAO= new TagDAO();
        $this->usuarioDAO= new UsuarioDAO();
        $this->respuestaDAO= new RespuestaDAO();
    }

    public function index()
    {
        $posts = $this->postDAO->getHotPosts(PostsController::HOT_POST_SIZE);
        /** @var Post $post */
        foreach($posts as $post){
            $post->setTags($this->tagDAO->getAllPostTags($post->getId()));
        }

        $this->view->setVariable("posts", $posts);
        $this->view->render("posts", "index");
    }

    public function search()
    {
        if($_POST["busqueda"] != NULL){
            $posts = $this->postDAO->search($_POST["busqueda"]);
            foreach($posts as $post){
                $post->setTags($this->tagDAO->getAllPostTags($post->getId()));
            }
            $this->view->setVariable("posts", $posts);
            $this->view->render("posts", "index");
        } else {
            $msg = array();
            array_push($msg, array("error", i18n("Debe indicar que desea buscar")));
            $this->view->setFlash($msg);
            $this->view->redirectToReferer(); 
        }

    }

    public function add()
    {
    	//COMPROBACIONES Q LAS COSAS NO VAYAN VACIAS
    	if(isset($_SESSION["username"]) && ($_SESSION["type"] == 1)){
    		if(isset($_POST['tituloPregunta'])){
    			$tags = explode(",", $_POST['tags']);
    			$tagsArray = array();
    			foreach ($tags as $tag){
                  array_push($tagsArray, new Tag(0,$tag));
              }
              foreach ($tagsArray as $tag){
               $this->tagDAO->createTag($tag);
               $tag->setId($this->tagDAO->getIdOfTag($tag->getTag()));
           }
           $post = new Post(0,
               $_POST['tituloPregunta'],
               0,
               $_POST['cuerpo'],
               0,
               date ("Y-m-d H:i:s",time()),
               $_SESSION["user"],
               $tagsArray);
           $this->postDAO->save($post);
           $this->view->setVariable("post", $post);
           $this->view->setVariable("autor", $this->usuarioDAO->getUser($_SESSION["username"]));
           $msg = array();
           array_push($msg, array("success", i18n("Pregunta creada correctamente")));
           $this->view->setFlash($msg);
	            $this->view->render("posts", "view"); //COMPROBAR Q REDIRIJA BNNN
          } else {
             $this->view->render("posts","add");
         }
     } else {
      $msg = array();
      array_push($msg, array("error", i18n("Debe estar logueado realizar una pregunta")));
      $this->view->setFlash($msg);
      $this->view->redirect("posts","index");
  }
}

public function view() {
   $post = $this->postDAO->fill($_GET["id"]);
   $post->setNumVisitas($post->getNumVisitas() + 1);
   $this->postDAO->aumentarVisitas($post);
   $autor = $this->usuarioDAO->fill($post->getIdUsuario());
   $respuestas = $this->respuestaDAO->getRespuestasDePost($post->getId());
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

}