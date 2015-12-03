<?php
//file: controller/BaseController.php

require_once(__DIR__."/../core/ViewManager.php");
require_once(__DIR__."/../core/i18n.php");
require_once(__DIR__."/../model/usuario.php");

/**
 * Class BaseController
 *
 * Implements a basic super constructor for
 * the controllers in the Blog App.
 * Basically, it provides some protected
 * attributes and view variables.
 * 
 * @author lipido <lipido@gmail.com>
 */
class BaseController {

  /**
   * The view manager instance
   * @var ViewManager
   */
  protected $view;
  
  /**
   * The current user instance
   * @var User
   */
  protected $currentUser;
  
  public function __construct() {
    
    $this->view = ViewManager::getInstance();

    // get the current user and put it to the view
    if (session_status() == PHP_SESSION_NONE) {      
		session_start();
    }

    if(isset($_SESSION["user"])) {
      $this->currentUser = new Usuario($_SESSION["user"]);
      //add current user to the view, since some views require it
      $this->view->setVariable("currentusername", 
				  $this->currentUser->getEmail());
    }
  }
}
