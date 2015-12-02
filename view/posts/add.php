				<?php 
				//file: view/posts/view.php
				require_once(__DIR__."/../../core/ViewManager.php");
				$view = ViewManager::getInstance();
				?>

				<!--SEARCHBAR-->
				<form action='index.php?controller=posts&action=search' method="POST"> 
					<div class= "row">
						<div id="searchBar" class="input-group col-md-12">
							<input id="busqueda" type="text"  name="busqueda" class="form-control" placeholder="Search for...">
							<span class="input-group-btn">
								<button type="submit" class="btn btn-default" type="button"><i class="glyphicon glyphicon-search"></i></button>
							</div>
						</div>
					</form>
					<!--FIN SEARCHBAR-->
					<!--INICIO CREACION PREGUNTA-->
					<div id="registroBody" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
						<form class="form-horizontal" action='index.php?controller=posts&action=add' method="POST">
							<fieldset>
								<div id="legend">
									<h2>Pregunta</h2>
									<hr/>
								</div>
								<div class="control-group">
									<!-- Titulo Pregunta-->
									<label class="control-label"  for="titulo">Titulo de la Pregunta</label>
									<div class="controls">
										<input type="text" id="tituloPregunta" name="tituloPregunta" placeholder="" class="input-xlarge" required="true">
										<p class="help-block">Introduzca el titulo de su pregunta. Sea especifico</p>
									</div>
									<!--Fin titulo pregunta -->
								</div>

								<div class="control-group">
									<label class="control-label" for="tags">Tags</label>
									<div class="controls">
										<input type="text" id="tags" name="tags" placeholder="" class="input-xlarge" required="true">
										<p class="help-block">Tags relacionadas con su pregunta</p>
									</div>
								</div>
								<div class="control-group">
									<label class="control-label" for="cuerpo">Descripción del problema</label>
									<div class="controls textBox">
										<textarea id="cuerpo" name="cuerpo" rows="10" required="true"></textarea> 
										<p class="help-block">Descripción de su problema. De la mayor cantidad de detalles posible.</p>
									</div>
								</div>
								<div class="control-group">
									<!-- Button -->
									<div id="divButtonPreguntar" class="controls">
										<button class="btn btn-success buttonRegistro">Preguntar</button>
									</div>
								</div>
							</fieldset>
						</form>
					</div>
				<!--FIN CREACION PREGUNTA-->