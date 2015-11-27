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
<div class="row">
	<span class="col-md-12"><h2>Hot Questions</h2></span>
</div>
<!-- PREGUNTA PLANTILLA-->
<hr/>
<div class="pregunta row whiteBackgroundIndex">
	<div class="col-lg-2 col-md-3 col-sm-3 col-xs-12 botonera hidden-xs">
		<span class="glyphicon glyphicon-eye-open elemPregunta"></span>
		<span class="elemPregunta">799k</span>
		<span class="verticalSeparator"></span>
		<span class="glyphicon glyphicon-fire elemPregunta fire"></span>
	</div>
	<div class="col-lg-10 col-md-9 col-sm-9 col-xs-12">
		<!--ENLACE A PREGUNTA-->
		<a href="html/Query.html">
			<p>
				¿Donec id elit non mi porta gravida at eget metus dapibus Donec id elit non mi?
			</p>
		</a>
	</div>
	<div class="row tags col-lg-12 col-md-12 col-sm-3 col-xs-12 hidden-xs">
		<a href="#"><span class="tag">&nbspC++&nbsp</span></a>
		<a href="#"><span class="tag">&nbspJava&nbsp</span></a>
		<a href="#"><span class="tag">&nbspBison&nbsp</span></a>
	</div>
	<div class="tags col-lg-12 col-md-12 col-sm-12 col-xs-12 visible-xs hidden-md hidden-lg">
		<a href="#"><span class="tag">&nbspC++&nbsp</span></a>
		<a href="#"><span class="tag">&nbspJava&nbsp</span></a>
		<a href="#"><span class="tag">&nbspBison&nbsp</span></a>
	</div>
	<div class="col-lg-2 col-md-2 col-sm-3 col-xs-12 botonera-xs visible-xs">
		<span class="glyphicon glyphicon-eye-open elemPregunta"></span>
		<span class="elemPregunta">799k</span>
		<span class="verticalSeparator"></span>
		<span class="glyphicon glyphicon-fire elemPregunta fire"></span>
	</div>
</div>
<!-- FIN PREGUNTA PLANTILLA-->