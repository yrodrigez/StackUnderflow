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
    const HOT_POST_SIZE = 10;

    public function __construct()
    {
        parent::__construct();
        $this->postDAO= new PostDAO();
    }

    public function getHotPosts()
    {
        $this->postDAO->getHotPosts(PostsController::HOT_POST_SIZE);
        $this->view->render("post", "");
    }


}