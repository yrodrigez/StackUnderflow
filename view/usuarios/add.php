<?php 
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
?>

<!--SEARCHBAR-->
<div class= "row">
	<div id="searchBar" class="input-group col-md-12">
		<input id="busqueda" type="text" class="form-control" placeholder="Search for...">
		<span class="input-group-btn">
			<button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
		</span>
	</div>
</div>
<!--FIN SEARCHBAR-->
<!--INICIO REGISTRO-->
<div id="registroBody" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
	<form class="form-horizontal" action='index.php?controller=usuarios&action=add' method="POST" enctype="multipart/form-data">
		<fieldset>
			<div id="legend">
				<h2>Registro</h2>
				<hr/>
			</div>
			<div class="control-group">
				<!-- Username -->
				<label class="control-label"  for="username">Nombre de usuario</label>
				<div class="controls">
					<input type="text" id="nombreUsuario" name="username" placeholder="" class="input-xlarge" required="true">
					<p class="help-block">El nombre de usuario puede contener letras y numeros, sin espacios</p>
				</div>
			</div>
			<div class="control-group">
				<!-- Password-->
				<label class="control-label" for="password">Contraseña</label>
				<div class="controls">
					<input type="password" id="contraseña" name="password" placeholder="" class="input-xlarge" required="true">
					<p class="help-block">La contraseña debe tener al menos cinco(5) caracteres</p>
				</div>
			</div>

			<div class="control-group">
				<!-- Password -->
				<label class="control-label"  for="password_confirm">Repetir contraseña</label>
				<div class="controls">
					<input type="password" id="password_confirm" name="password_confirm" placeholder="" class="input-xlarge" required="true">
					<p class="help-block">Confirme su contraseña</p>
				</div>
			</div>
			<div class="control-group">
				<!-- Username -->
				<label class="control-label"  for="name">Nombre completo</label>
				<div class="controls">
					<input type="text" id="name" name="name" placeholder="" class="input-xlarge">
					<p class="help-block">Introduzca su nombre</p>
				</div>
			</div>
			<div class="control-group">
				<!-- E-mail -->
				<label class="control-label" for="email">E-mail</label>
				<div class="controls">
					<input type="text" id="email" name="email" placeholder="" class="input-xlarge" required="true">
					<p class="help-block">Por favor introduzca su e-mail</p>
				</div>
			</div>

			<div class="control-group">
				<!-- Descripcion -->
				<label class="control-label" for="descripcion">Descripción</label>
				<div class="controls">
					<textarea id ="descripcion" name="descripcion" rows ="10"></textarea>
					<p class="help-block">Una breve descripcion sobre usted</p>
				</div>
			</div>
			<div class="form-group">
				<label for="avatar">Foto de perfil:</label>
				<input type="file" class="file file-loading" name="avatar" id="avatar" data-show-upload="false" data-allowed-file-extensions='["jpg", "png", "gif"]'>
			</div>
			<div class="control-group">
				<div id="divButtonRegistro"class="controls">
					<button class="btn btn-success buttonRegistro">Registrarse</button>
				</div>
			</div>
		</fieldset>
	</form>
</div>
			<!--FIN REGISTRO-->