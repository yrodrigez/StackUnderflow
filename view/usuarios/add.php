<?php 
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
?>

<!--SEARCHBAR-->
<form action='index.php?controller=posts&action=search' method="POST"> 
	<div class= "row">
		<div id="searchBar" class="input-group col-md-12">
			<input id="busqueda" type="text"  name="busqueda" class="form-control" placeholder="<?=i18n("Buscar...")?>" required="true">
			<span class="input-group-btn">
			<button type="submit" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
		</div>
	</div>
</form>
<!--FIN SEARCHBAR-->
<!--INICIO REGISTRO-->
<div id="registroBody" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<form class="form-horizontal" action='index.php?controller=usuarios&action=add' method="POST" enctype="multipart/form-data">
		<fieldset>
			<div id="legend">
				<h2><?= i18n("Registro");?></h2>
				<hr/>
			</div>
			<div class="control-group">
				<!-- Username -->
				<label class="control-label"  for="username"><?=i18n("Nombre de usuario");?></label>
				<div class="controls">
					<input type="text" id="nombreUsuario" name="username" class="input-xlarge" required="true">
					<p class="help-block"><?=i18n("El nombre de usuario puede contener letras y numeros, sin espacios");?></p>
				</div>
			</div>
			<div class="control-group">
				<!-- Password-->
				<label class="control-label" for="password"><?= i18n("Contraseña");?></label>
				<div class="controls">
					<input type="password" id="contraseña" name="password" class="input-xlarge" required="true">
					<p class="help-block"><?= i18n("La contraseña debe tener al menos cinco(5) caracteres")?></p>
				</div>
			</div>

			<div class="control-group">
				<!-- Password -->
				<label class="control-label"  for="password_confirm"><?= i18n("Repetir contraseña")?></label>
				<div class="controls">
					<input type="password" id="password_confirm" name="password_confirm" class="input-xlarge" required="true">
					<p class="help-block"><?= i18n("Confirme su contraseña")?></p>
				</div>
			</div>
			<div class="control-group">
				<!-- Username -->
				<label class="control-label"  for="name"><?= i18n("Nombre completo")?></label>
				<div class="controls">
					<input type="text" id="name" name="name" class="input-xlarge">
					<p class="help-block"><?= i18n("Introduzca su nombre")?></p>
				</div>
			</div>
			<div class="control-group">
				<!-- E-mail -->
				<label class="control-label" for="email"><?= i18n("E-mail")?></label>
				<div class="controls">
					<input type="text" id="email" name="email" placeholder="" class="input-xlarge" required="true">
					<p class="help-block"><?= i18n("Introduzca su e-mail")?></p>
				</div>
			</div>

			<div class="control-group">
				<!-- Descripcion -->
				<label class="control-label" for="descripcion"><?= i18n("Descripción")?></label>
				<div class="controls">
					<textarea id ="descripcion" name="descripcion" rows ="10"></textarea>
					<p class="help-block"><?= i18n("Una breve descripcion sobre usted")?></p>
				</div>
			</div>
			<div class="control-group">
				<label for="avatar"><?= i18n("Foto de perfil");?></label>
				<div class="controls">
					<input type="file" class="file file-loading" name="avatar" id="avatar" data-show-upload="false" data-allowed-file-extensions='["jpg", "png", "gif"]'>
				</div>
			</div>
			<div class="control-group">
				<div id="divButtonRegistro"class="controls">
					<button class="btn btn-success buttonRegistro"><?= i18n("Registrarse");?></button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
			<!--FIN REGISTRO-->