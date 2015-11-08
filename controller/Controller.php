<?php
/**
 * User: Yago
 * Date: 08/11/2015
 * Time: 12:43
 * Controller
 * Contendrá todas las funciones necesarias para insertar,
 * crear usuarios, tags y almacenar en base de datos.
 */

include_once("../classes/usuario.php");
include_once("../classes/respuesta.php");
include_once("../classes/post.php");
include_once("../classes/tag.php");
include_once("DBManager.php");

class Controller
{
    /**
     * @param $username
     * @param $email
     * @param $password
     */
    public static function registrarUsuario(
        $username,
        $email,
        $password
    ){
        $usuario= new Usuario(
            $username,
            $password,
            NULL,
            $email,
            NULL,
            NULL
        );
        $dbManager= new DBManager();
        $dbManager->createBasicUser($usuario);
    }

    /**
     * @param $username
     * @param $password
     * @return Usuario
     */
    public static function login(
        $username,
        $password
    ) {
        $usuario = new Usuario($username, $password);
        $dbManager= new DBManager();
        return $dbManager->login($usuario);
    }

}