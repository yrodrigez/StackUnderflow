
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->

	<title>Stack Underflow</title>
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="css/css/bootstrap.min.css">

	<!-- Optional theme -->
	<link rel="stylesheet" href="css/css/bootstrap-theme.min.css">

	<link href='https://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>

	<link rel="stylesheet" href="css/style.css">

	<!-- Latest compiled and minified JavaScript -->
	<script src="css/js/bootstrap.min.js"></script>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<?php
		require_once("classes/usuario.php");
	?>

</head>

<body background="img/stachBackground3.jpg">

	<div class="container">
		<div id="head" class="row">
			<div class= "col-md-9">
				<img alt="Stack Underflow logo" class="img-responsive" src="img/stackunderflow_logo.png">
			</div>
			<!--BOTON LOGIN CUANDO LA PAGINA ESTA GRANDE -->
			<div id="navbar loginContainer" class="loginContainer col-md-3 visible-lg visible-md">
				<ul class="nav pull-left " id="loginButton">
					<li class="dropdown" id="menuLogin">
						<a class="dropdown-toggle loginButton" href="#" data-toggle="dropdown" id="navLogin">
							<?php
								session_start();
							    if(isset($_SESSION["username"]))
							    {
							        echo $_SESSION["username"];
							    }
							     else
							    {
							        echo "Login";
							    }
							 ?>
						</a>
						<div class="dropdown-menu" style="padding:17px;">
							<?php if(isset($_SESSION["userInstance"])){
								?>
									<div class="containerLoged">
										<span class="containerLogedItem"><?php echo $_SESSION["userInstance"]->getEmail();?></span>
										<br><hr>
										<a href="html/Perfil.html" <span class="containerLogedItem">Cuenta</span></a>
										<br><hr>
										<button type="button" id="registro" class="btn buttonStackLoginClicked" onClick ="window.location.href ='controller/logout.php' ">Logout</button>
									</div>
								<?php
								}
							else{
							?>
								<form class="form" id="formLogin" action="controller/login.php">
									<input name="username" id="username" placeholder="Usuario" type="text">
									<input name="password" id="password" placeholder="Contraseña" type="password">
									<br>
									<div class="divBotonesLogin">
										<button type="button" id="registro" class="btn buttonStackLoginClicked">Registro</button>
										<button type="submit" id="btnLogin" class="btn buttonStackLoginClicked">Entrar</button>
									</div>
								</form>
							<?php } ?>
						</div>
					</li>
				</ul>
			</div> 
			<!-- FIN BOTON LOGIN CUANDO LA PAGINA ESTA GRANDE -->
		</div>

		
		<div class="row">
			<div id="body" class="col-lg-9 col-md-9 col-sm-12 col-xs-12 well">
				<!--BOTONAZO PAL MOVIL PAPAS-->
				<!-- Trigger the modal with a button -->
				<div class="row">
					<div id="containerLoginMobile"class="col-md-12">
						<button id="loginButtonMobile" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal">Login</button>

						<!-- Modal -->
						<div id="myModal" class="modal fade" role="dialog">
							<div class="modal-dialog">

								<!-- Modal content-->
								<div class="modal-content">
									<div class="modal-header">
										<button type="button" class="close modalCloseButton" data-dismiss="modal">&times;</button>
										<span class="modal-title">Identificacion</span>
									</div>
									<div class="modal-body">
										<!-- formulario login -->
										<form>
											<div class="form-group">
												<label for="inputEmail">Email</label>
												<input type="email" class="form-control"  placeholder="Email">
											</div>
											<div class="form-group">
												<label for="inputPassword">Contraseña</label>
												<input type="password" class="form-control" placeholder="Contraseña">
											</div>
										</form>
										<!-- fin formulario login -->
									</div>
									<div class="modal-footer">
										<button class="btn buttonStack" onclick="location.href='html/Registro.html'">Registro</button>
										<button type="submit" class="btn buttonStack">Entrar</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--FIN BOTONAZO PAL MOVIL PAPAS-->

				<!--MENU PAL MOVIL PAPAS-->

				<div class="row ">
					<nav class="navbar menuVisible col-md-12">
						<div class="container-fluid">
							<div id="menuContainerMobile">
								<ul class="nav navbar-nav listaMenu">
									<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="dropdownMenu">Menu</span><span class="caret"></span></a>
										<ul class="dropdown-menu dropdownMenu listaMenu">
											<li><a href="#">Home</a></li>
											<li><a href="#">Sin contestar</a></li>
											<li><a href="#">Usuarios</a></li>
											<li><a href="#">Categorias</a></li>
											<li><a href="#">Halp</a></li>
										</ul>
									</li>
								</ul>
							</div>
						</div>
					</nav>
				</div>
				<!--FIN MENU PAL MOVIL PAPAS-->

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
				<!-- PREGUNTA PLANTILLA-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- PREGUNTA PLANTILLA-->
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
					<!--ETIQUETAS-->
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
				<!-- BOTON PREGUNTA -->
				<div  class ="row">
					<div id="preguntaDiv" class="preguntaContainer col-lg-3 col-md-3 col-sm-3 col-xs-4">
						<button id="preguntaButton" type="button" class="btn btn-primary preguntaButton">Pregunta</button>
					</div>
				</div>
				<!-- FIN BOTON PREGUNTA -->
			</div>
			<!-- Inicio sidebar -->
			<nav class="col-md-2 col-lg-2  visible-lg visible-md" id="sideBar">
				<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
					<li><span class="compSideBar"><a class="enlaceSideBar" href="#">Home</a></span></li>
					<hr/>
					<li><span class="compSideBar"><a class="enlaceSideBar" href="#">Sin Contestar</a></span></li>
					<hr/>
					<li><span class="compSideBar"><a class="enlaceSideBar" href="#">Usuarios</a></span></li>
					<hr/>
					<li><span class="compSideBar"><a class="enlaceSideBar" href="#">Categorias</a></span></li>
					<hr/>
					<li><span class="compSideBar"><a class="enlaceSideBar" href="#">Ayuda</a></span></li>	
				</ul>
			</nav>
			<!--final sidebar-->
		</div>
		<!-- FOOTER -->

		<div class="row finalPagina">
			<div class="linksFooter col-md-12">
				<span class="elemFooter"><a href='#'>Empleos</a></span>
				<span class="verticalSeparator"></span>
				<span class="elemFooter"><a href='#'>Informacion</a></span>
				<span class="verticalSeparator"></span>
				<span class="elemFooter"><a href='#'>Privacidad</a></span>
				<span class="verticalSeparator"></span>
				<span class="elemFooter"><a href='#'>Terminos</a></span>
			</div>
			<div class="company col-md-12">
				<footer>
					<span style="color:white">&copy; Schrödinger Inc, 2015</span>
				</footer>
			</div>
		</div>
		<!-- FIN FOOTER -->
	</div>
	<!-- /container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
    <script src="../../dist/js/bootstrap.min.js"></script>
    <!-- IE10 viewport hack for Surface/desktop Windows 8 bug -->
    <script src="../../assets/js/ie10-viewport-bug-workaround.js"></script>
</body>
</html>
