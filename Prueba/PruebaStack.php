<?php

require_once("C:\Users\Jose Miguel\Desktop\WebTSW\StackUnderflow\Model\usuarioMapper.php");
require_once("C:\Users\Jose Miguel\Desktop\WebTSW\StackUnderflow\Model/tagMapper.php");
require_once("C:\Users\Jose Miguel\Desktop\WebTSW\StackUnderflow\Model\usuario.php");
require_once("C:\Users\Jose Miguel\Desktop\WebTSW\StackUnderflow\Model/tag.php");



$user = new Usuario (0,"unNombre","unaPass",1,"unEmail","unaDescrip","unPath");
$tag = new Tag ("C++");
$userMapper = new usuarioMapper();
$tagMapper = new tagMapper();
    /*$saveBoolean = $userMapper->createUser($user);
    $saveBoolean = $saveBoolean && $tagMapper->createTag($tag);
    echo $saveBoolean;*/

    $userActual = $userMapper->getUser(1);
    $tagActual = $tagMapper->getTag("%++%");
    /*echo $userActual->getUsername().$userActual->getDescripcion();
    echo $tagActual->getTag();*/

    $allUsers = $userMapper->getAllUsers();
    $allTags = $tagMapper->getAllTags();
    foreach($allUsers as $user){
     echo $user->getUsername();
 }
 foreach($allTags as $tag){
     echo $tag->getTag();
 }

$user = new Usuario (0,"unNombre","unaPass",1,"unEmailXD","unaDescripXD","unPathXD");
$modifyBoolean = $userMapper->modificarUser($user);
$userMapper->borrarUser(2);
$tagMapper->borrarTag("C++");

?>