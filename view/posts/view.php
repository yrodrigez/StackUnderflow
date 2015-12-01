<?php 
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$post = $view->getVariable("post");
$autor = $view->getVariable("autor");
$respuestas = $view->getVariable("respuestas");
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
		<span class="col-lg-9 col-md-8 col-sm-7 col-xs-7 tituloPregunta"><?= $post->getTitulo();?></span>
		<span class="col-lg-3 col-md-4 col-sm-5 col-xs-5 usuarioPregunta">Preguntado por: <?=$autor->getUsername();?></span>
	</div>
	<hr>
	<div class="row">
		<div class="col-md-12">
			<p align="justify">
				<?=$post->getCuerpo() ?>
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
	<?php if($respuestas==NULL) { 
		echo "Este post no tiene respuestas";
	} else { 
		foreach ($respuestas as $respuesta) { ?>
	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 w">
		<img alt="Foto usuario" class="img-responsive img-circle sizePhotoAnswer" src="img/users/<?=$respuesta->getUsuarioCreador()->getFotoPath(); ?>"/>
	</div>
	<div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 whiteBackground">
		<p align="justify">
			<?= $respuesta->getCuerpo(); ?>
		</p>
		<div class="usuarioRespuesta">
			<span>Respondido por: <?= $respuesta->getUsuarioCreador()->getUsername()." el dia: ".$respuesta->getFechaCreacion()?></span>
		</div>
	</div>
		<?php } 
	 } ?>
</div>
<!-- Final respuestas -->
<!-- Visitas -->
<div class="col-md-12 botonera-xs">
	<hr>
	<span class="glyphicon glyphicon-eye-open elemPregunta"></span>
	<span class="elemPregunta"><?=$post->getNumVisitas();?></span> 
	<span>Visitas</span>
</div>
<!--Fin visitas-->
<!-- Inicio textarea -->
<?php if(isset($_SESSION["user"])) { ?>
<form>
	<div class="col-md-12 textBox">
		<textarea id="textEditor" name="respuesta" rows="10"></textarea> 
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
<?php } ?>