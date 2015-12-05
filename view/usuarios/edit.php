<?php
//file: view/users/login.php

/**
 * @var $usuario Usuario
 * @var $post Post
 */
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$usuario= $view->getVariable("usuario");
?>


<!--INICIO PERFIL-->
<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
        <h3><?= $usuario->getNombre() ?></h3>
        <div class="row">
            <div class="col-md-3 col-lg-3 fotoProfile" align="center">
                <img alt="Foto usuario" src="img/users/<?= $usuario->getFotoPath() ?>" class="img-circle img-responsive">
            </div>

            <div class=" col-md-9 col-lg-9 ">
                <form action="index.php?controller=usuarios&action=editUser" method="post" enctype="multipart/form-data">
                <table class="table">
                    <tbody>
                    <tr>
                        <td>Username: </td>
                        <td><input type="text" value="<?= $usuario->getUsername() ?>" disabled="true"/></td>
                        <input type="hidden" value="<?= $usuario->getUsername() ?>" name="username">
                    </tr>

                    <tr>
                        <td>Email: </td>
                        <td><input
                                type="text"
                                value="<?= $usuario->getEmail() ?>"
                                name="email"
                            >
                        </td>
                    </tr>
                    <tr>
                        <td>Password: </td>
                        <td><input
                                type="password"
                                value="<?= $usuario->getPassword() ?>"
                                name="password"
                            >
                        </td>
                    </tr>
                    <tr>
                        <td>Nombre: </td>
                        <td><input
                                type="text"
                                value="<?= $usuario->getNombre() ?>"
                                name="nombre"
                            >
                        </td>
                    </tr>
                    <tr>
                        <td>Descripcion:</td>
                        <td>
                            <textarea
                                  type="text"
                                  name="descripcion"
                            ><?= $usuario->getDescripcion() ?></textarea>

                        </td>
                    </tr>
                    <tr>
                        <td>Foto:</td>
                        <td>
                            <input
                                type="file"
                                class="file file-loading"
                                name="avatar" id="avatar"
                                data-show-upload="false"
                                data-allowed-file-extensions='["jpg", "png", "gif"]'
                            >
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-12 text-right">
                <input type="button" class="btn btn-primary buttonEditar" value="Cancelar" onclick="history.go(-1);return true;">
                <input class="btn btn-primary buttonEditar" type="submit" value="Editar">
            </div>
            </form>
        </div>
    </div>
</div>