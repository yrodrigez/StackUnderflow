<?php
/**
 * Created by PhpStorm.
 * User: Yago
 * Date: 08/11/2015
 * Time: 17:54
 */
session_start();
session_destroy();
header("Location:../index.php");
?>