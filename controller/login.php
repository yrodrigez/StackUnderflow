<?php
/**
 * Created by PhpStorm.
 * User: Yago
 * Date: 08/11/2015
 * Time: 16:18
 */
include_once("Controller.php");
$username = $_REQUEST["username"];
$password = $_REQUEST["password"];

if (strlen($username) <= 0 || strlen($password) <= 0) {
    header("Location:../index.html");
    exit(0);
}
//El usuario inicia sesion con sus credenciales.
$usuario = Controller::login($username, $password);
//Una vez se tiene un tipo de usuario en la variable $login, se decide que hacer segÃºn dicho contenido.
if ($usuario->getTipoUsuario() >= 0) {
    session_start();
    $_SESSION["userInstance"] = $usuario;
    $_SESSION["username"] = $usuario->getUsername();
    $_SESSION["email"]= $usuario->getEmail();
    $_SESSION["tipoUsuario"] = $usuario->getTipoUsuario() ;
    $_SESSION["foto"] = $usuario->getFotoPath();
    $_SESSION["descripcion"] = $usuario->getDescripcion();
    //echo $_SESSION["username"];
    header("Location:../index.php");
} else {
    //alguno de los datos son incorrectos. enviar a pagina de error que vuelva al login.
    header("Location: error_out.php?lang=$lang");
}
