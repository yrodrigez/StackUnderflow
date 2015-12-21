<?php 
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();

$usuarios = $view->getVariable("usuarios");

/**
 * @var $usuario Usuario
 */

?>

<!-- USUARIOS -->
<div class="row">
	<div class="well">
		<h1 class="text-center"><?= i18n("Los Usuarios") ?></h1>
		<div class="list-group">
			<!--USUARIO NUEVO-->
			<?php foreach($usuarios as $usuario): ?>
				<a href="index.php?controller=usuarios&action=view&id=<?= $usuario->getId() ?>" class="list-group-item">
					<div class="media col-md-3">
						<i><img alt="Foto usuario" class="img-responsive img-circle tamanhoFoto" src="img/users/<?= $usuario->getFotoPath() ?>"/></i>
					</div>
					<div class="col-md-9">
						<h4 class="list-group-item-heading"><?= $usuario->getUsername() ?></h4>
						<p class="list-group-item-text">
							<?php if(strlen($usuario->getDescripcion()) < 700): ?>
								<?= $usuario->getDescripcion();?>
							<?php else: ?>
								<?= substr($usuario->getDescripcion(), 0, 699) ?>
							<?php endif; ?>
						</p>
					</div>
				</a>
			<?php endforeach; ?>
			<!--FIN USUARIO NUEVO-->
		</div>
	</div>
</div>
<!-- FIN USUARIOS -->
