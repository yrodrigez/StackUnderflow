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
    }

    public function view()
    {
        $posts = $this->postDAO->getHotPosts(PostsController::HOT_POST_SIZE);
        /** @var Post $post */
        foreach($posts as $post){
            $post->setTags($this->tagDAO->getAllPostTags($post->getId()));
        }
        $this->view->setVariable("posts", $posts);
        $this->view->render("posts", "index");
    }



}