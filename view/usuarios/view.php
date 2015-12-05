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
				<table class="table">
					<tbody>
						<tr>
							<td><?= i18n("Nombre de Usuario")?>:</td>
							<td><?= $usuario->getUsername() ?></td>
						</tr>

						<tr>
							<td>Email:</td>
							<td><a href="#"><?= $usuario->getEmail() ?></a></td>
						</tr>
						<tr>
							<td><?= i18n("Descripción")?>:</td>
							<td>
								<p>
									<?= $usuario->getDescripcion() ?>
								</p>
							</p>
						</td>
					</tbody>
				</table>
			</div>
			<?php if($_SESSION["user"] == $usuario->getId()): ?>
			<div class="col-md-12 text-right">
				<a class="btn btn-primary buttonEditar" href="index.php?controller=usuarios&action=edit"><?= i18n("Editar")?></a>
			</div>
			<div class="col-md-12 col-lg-12">
				<span class="tituloPosts"> Posts (<?= count( $usuario->getPosts() ) ?>) </span>
				<hr>
			</div>
			<?php endif; ?>
		</div>
		<!--Inicio post usuarios-->

			<?php if(count($usuario->getPosts()) > 0): ?>
				<?php foreach($usuario->getPosts() as $post): ?>
				<div id="divPostsUsuario" class="row whiteBackgroundPost">
					<div class="col-md-9 col-lg-9">
						<span class="cuerpoPost"><a href="index.php?controller=posts&action=view&id=<?= $post->getId() ?>"><?= $post->getTitulo() ?></a></span>
					</div>
					<div class="col-md-3 col-lg-3">
						<span> <?= $post->getFechaCreacion() ?> </span>
					</div>
				</div>
				<?php endforeach; ?>
			<?php else: ?>
				<div id="divPostsUsuario" class="row whiteBackgroundPost">
					<h2><?= i18n("Aún no has hecho ninguna pregunta")?></h2>
				</div>
			<?php endif; ?>


		<!--Final post usuarios-->
	</div>
</div>