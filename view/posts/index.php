<?php 
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$posts = $view->getVariable("posts");
/**
 * @var Post $post
 * @var Tag $tag
 */
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
<div class="row">
	<span class="col-md-12"><h2>Hot Questions</h2></span>
</div>
<?php foreach($posts as $post): ?>
	<!-- PREGUNTA PLANTILLA-->
	<hr/>
	<div class="pregunta row whiteBackgroundIndex">
		<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 botonera hidden-xs">
			<span class="glyphicon glyphicon-eye-open elemPregunta"></span>
			<span class="elemPregunta"><?= 	$post->getNumVisitas(); ?></span>
			<span class="verticalSeparator"></span>
			<span class="glyphicon glyphicon-fire elemPregunta fire"></span>
		</div>
		<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
			<!--ENLACE A PREGUNTA-->
			<a href="index.php?controller=posts&action=view&id=<?=$post->getId();?>">
				<p>
					<?= $post->getTitulo(); ?>
				</p>
			</a>
		</div>
		<div class="row tags col-lg-12 col-md-12 col-sm-3 col-xs-12 hidden-xs">
			<?php foreach($post->getTags() as $tag): ?>
			<a href="#"><span class="tag">&nbsp<?= $tag->getTag() ?>&nbsp</span></a>
			<?php endforeach; ?>
		</div>
		<div class="tags col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-xs hidden-md hidden-lg">
			<?php foreach($post->getTags() as $tag): ?>
				<a href="#"><span class="tag">&nbsp<?= $tag->getTag() ?>&nbsp</span></a>
			<?php endforeach; ?>
		</div>
		<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 botonera-xs visible-xs">
			<span class="glyphicon glyphicon-eye-open elemPregunta"></span>
			<span class="elemPregunta"><?= 	$post->getNumVisitas(); ?></span>
			<span class="verticalSeparator"></span>
			<span class="glyphicon glyphicon-fire elemPregunta fire"></span>
		</div>
	</div>
	<!-- FIN PREGUNTA PLANTILLA-->
<?php endforeach; 
	if (isset ($_SESSION['user'])){ ?>
<div id="divButtonPreguntar" class="col-lg-3 col-md-3 col-sm-3 col-xs-12">
	<a href="index.php?controller=posts&action=add"><button type="button" id="preguntar" class="btn preguntaButton">Preguntar</button></a>
</div>
<?php } ?>