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
<!-- inicio pregunta-->
<div class="whiteBackground">
	<div class="row cuerpoPregunta">
		<span class="col-lg-9 col-md-8 col-sm-7 col-xs-7 tituloPregunta">¿Por que inkScape arranca tan lento?</span>
		<span class="col-lg-3 col-md-4 col-sm-5 col-xs-5 usuarioPregunta">Preguntado por: Yonyon</span>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<p align="justify">
				Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non sem felis. Fusce convallis mi in dolor ornare interdum. Integer non quam rutrum, pulvinar mi ut, pulvinar enim. Aenean mollis consectetur pellentesque. Mauris vestibulum sed nisl in fermentum. Proin mi neque, ornare et dignissim sed, vestibulum laoreet libero. Aenean fringilla vel purus id euismod. Quisque ac posuere diam. Aenean semper sed lorem nec vehicula. Praesent semper tempor vulputate. Pellentesque non ex at lacus ultricies congue. Phasellus ultrices aliquam tempor.
			</p>

			<p  align="justify">
				Nam vel nisl dolor. Quisque ac nulla venenatis, lacinia urna iaculis, molestie est. Vivamus nunc purus, venenatis ac fringilla ac, hendrerit quis urna. Aenean placerat purus venenatis porta hendrerit. Suspendisse finibus ipsum tortor, ac efficitur magna auctor non. Duis aliquet varius nisi, fermentum tincidunt dui mollis vel. Morbi scelerisque lectus vel scelerisque iaculis. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Cras vestibulum bibendum auctor. Maecenas eu velit nibh. Curabitur ligula justo, ornare sit amet fringilla sit amet, fringilla id nunc. Phasellus urna lorem, faucibus non risus ut, lobortis sagittis lectus. In semper nisl libero. Mauris in metus ut tellus pulvinar convallis nec ut elit. Aenean malesuada ligula leo, nec pharetra dolor hendrerit id. Suspendisse elit lectus, lacinia a luctus elementum, venenatis at turpis.
			</p>
		</div>
	</div>
</div>
<!-- final pregunta -->
<!-- inicio respuestas -->
<div class="tituloRespuesta col-md-12">
	<span>Respuestas</span>
	<hr>
</div>
<div class="row">

	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 w">
		<img alt="Foto usuario" class="img-responsive img-circle sizePhotoAnswer" src="../img/users/el papa.jpg"/>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 whiteBackground">
		<p align="justify">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non sem felis. Fusce convallis mi in dolor ornare interdum. Integer non quam rutrum, pulvinar mi ut, pulvinar enim. Aenean mollis consectetur pellentesque. Mauris vestibulum sed nisl in fermentum. Proin mi neque, ornare et dignissim sed, vestibulum laoreet libero. Aenean fringilla vel purus id euismod. Quisque ac posuere diam. Aenean semper sed lorem nec vehicula. Praesent semper tempor vulputate. Pellentesque non ex at lacus ultricies congue. Phasellus ultrices aliquam tempor.
		</p>
		<div class="usuarioRespuesta">
			<span>Respondido por: Schztroedingher a las: 32:81 p.m</span>
		</div>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4">
		<img alt="Foto usuario" class="img-responsive img-circle sizePhotoAnswer" src="../img/users/Ratael.jpg"/>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 whiteBackground">
		<p align="justify">
			Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc non sem felis. Fusce convallis mi in dolor ornare interdum. Integer non quam rutrum, pulvinar mi ut, pulvinar enim. Aenean mollis consectetur pellentesque. Mauris vestibulum sed nisl in fermentum. Proin mi neque, ornare et dignissim sed, vestibulum laoreet libero. Aenean fringilla vel purus id euismod. Quisque ac posuere diam. Aenean semper sed lorem nec vehicula. Praesent semper tempor vulputate. Pellentesque non ex at lacus ultricies congue. Phasellus ultrices aliquam tempor.
		</p>
		<div class="usuarioRespuesta">
			<span>Respondido por: Ratael, 32:00 p.m</span>
		</div>
	</div>
</div>
<!-- Final respuestas -->
<!-- Visitas -->
<div class="col-md-12 botonera-xs">
	<hr>
	<span class="glyphicon glyphicon-eye-open elemPregunta"></span>
	<span class="elemPregunta">799k</span> 
	<span>Visitas</span>
</div>
<!--Fin visitas-->
<!-- Inicio textarea -->
<form>
	<div class="col-md-12 textBox">
		<textarea id="textEditor" rows="10"></textarea> 
	</div>
	<!-- Fin textArea -->
	<!-- BOTON Enviar -->
	<div  class ="row">
		<div id="preguntaDiv" class="preguntaContainer col-lg-3 col-md-3 col-sm-3 col-xs-4">
			<button id="preguntaButton" type="button" class="btn btn-primary preguntaButton">Enviar</button>
		</div>
	</div>
	<!-- FIN BOTON ENviar -->
</form>