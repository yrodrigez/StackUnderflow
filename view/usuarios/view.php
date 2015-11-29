<?php 
 //file: view/users/login.php
 
 require_once(__DIR__."/../../core/ViewManager.php");
 $view = ViewManager::getInstance();
?>


<!--INICIO PERFIL-->
<div class="row">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" >
		<h3>Schrödinger</h3>
		<div class="row">
			<div class="col-md-3 col-lg-3 fotoProfile" align="center">
				<img alt="Foto usuario" src="../img/users/el papa.jpg" class="img-circle img-responsive">
			</div>

			<div class=" col-md-9 col-lg-9 "> 
				<table class="table">
					<tbody>
						<tr>
							<td>Username</td>
							<td>Schrödinger</td>
						</tr>

						<tr>
							<td>Email</td>
							<td><a href="#">schrödinger@schrödinger.com</a></td>
						</tr>
						<tr>
							<td>Descripcion:</td>
							<td>
								<p>
									Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam nec sem molestie, tempor libero eu, placerat purus. 
									Donec eget iaculis elit. Nam eget consectetur quam. Nam viverra ornare diam. In a ornare diam. 
									Quisque vestibulum nulla nec facilisis malesuada.
								</p>
							</p>
						</td>
					</tbody>
				</table>
			</div>
			<div class="col-md-12 text-right">
				<button type="submit" class="btn btn-primary buttonEditar">Editar</button>
			</div>
			<div class="col-md-12 col-lg-12">
				<span class="tituloPosts"> Posts (5) </span>
				<hr>
			</div>
		</div>
		<!--Inicio post usuarios-->
		<div id="divPostsUsuario" class="row whiteBackgroundPost">
			<div class="col-md-9 col-lg-9">
				<span class="cuerpoPost"><a href="#">¿Por qué InkScape arranca tan lento?</a></span>
			</div>
			<div class="col-md-3 col-lg-3">
				<span> Creado: 07/11/2015 </span>
			</div>
		</div>
		<!--Final post usuarios-->
	</div>
</div>
				<!--FIN PERFIL-->