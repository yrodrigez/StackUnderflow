<?php
	//file: view/layouts/default.php
require_once(__DIR__."/../../core/ViewManager.php");
	//Meter requires de cosas que hagan falta para mostrar datos
$view = ViewManager::getInstance();
$currentuser = $view->getVariable("currentusername");
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Stack Underflow</title>
	<link rel="stylesheet" href="css/css/bootstrap.min.css">
	<!--<link rel="stylesheet" href="css/css/bootstrap-theme.min.css" type="text/css">-->
	<link rel="stylesheet" href="css/css/fileinput.min.css" type="text/css">
	<link rel="stylesheet" href="css/css/jquery.tagsinput.css" type="text/css">
	<link href='https://fonts.googleapis.com/css?family=Press+Start+2P' rel='stylesheet' type='text/css'>
	<link rel="stylesheet" href="css/style.css" type="text/css">
	<script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
	<script src="css/js/bootstrap.min.js"></script>
	<script src="css/js/fileinput.min.js"></script>
	<script src="css/js/jquery.tagsinput.js"></script>
</head>

<body background="img/stachBackground3.jpg">
	<div id="msg-container">
		<?php
		$msg = $view->popFlash();
		if($msg):
			foreach($msg as $m):
				if($m[0] == "success"):
					echo '<div class="alert alert-success flash"><button type="button" class="close" data-dismiss="alert">&nbsp;×</button>' . $m[1] . '</div>';
				endif;
				if($m[0] == "error"):
					echo '<div class="alert alert-danger flash"><button type="button" class="close" data-dismiss="alert">&nbsp;×</button>' . $m[1] . '</div>';
				endif;
				endforeach;
				endif;
				?>
			</div>
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

									<?php if(!isset($_SESSION["user"])) {
										echo i18n("Entrar"); }
									else {
										if (strlen($_SESSION["username"]) > 8) {
											echo substr($_SESSION["username"], 0, 5) . "...";
										} else {
											echo $_SESSION["username"];
										}
									}?></a>
										<div class="dropdown-menu">
											<form class="form" id="formLogin" action="index.php?controller=usuarios&action=login" method="POST">
												<?php if(!isset($_SESSION["user"])) { ?>
												<input name="username" id="username" placeholder="<?=i18n("Usuario")?>" type="text" required="true">
												<input name="password" id="password" placeholder="<?=i18n("Contraseña")?>" type="password" required="true">
												<br>
												<div class="divBotonesLogin">
													<a href="index.php?controller=usuarios&action=add"><button type="button" id="registro" class="btn buttonStackLoginClicked"><?=i18n("Registrar");?></button></a>
													<button type="submit" id="btnLogin" class="btn buttonStackLoginClicked"><?=i18n("Entrar");?></button>
												</div>
												<?php } else { ?>
												<div class="divBotonesLogin row">
													<div class ="col-md-12">
														<span class="titleMenuLogged"><?= $_SESSION["username"] ?></span>
													</div>
													<a href="index.php?controller=usuarios&action=view">
													<div class="col-md-12 itemLoged">
														<label class="glyphicon glyphicon glyphicon-user"></label><?=i18n("Perfil")?>
													</div>
													</a>
													<a href="index.php?controller=usuarios&action=logout">
														<div class="col-md-12 itemLoged">
															<label class="glyphicon glyphicon-log-out"></label><?=i18n("Salir")?>
														</div>
													</a>
												</div>
												<?php } ?>
											</form>
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
										<button id="loginButtonMobile" type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#myModal"><?php if(!isset($_SESSION["user"])) {
											echo i18n("Entrar"); } else {
												echo $_SESSION["username"];} ?></button>

												<!-- Modal -->
												<div id="myModal" class="modal fade" role="dialog">
													<div class="modal-dialog">

														<!-- Modal content-->
														<div class="modal-content">
															<div class="modal-header">
																<button type="button" class="close modalCloseButton" data-dismiss="modal">&times;</button>
																<span class="modal-title"><?php if(!isset($_SESSION["user"])) {
																	echo i18n("Identificacion"); } else {
																		echo $_SESSION["username"];} ?></span>
																	</div>
																	<div class="modal-body">
																		<!-- formulario login -->
																		<form class="form" id="formLogin" action="index.php?controller=usuarios&action=login" method="POST">
																			<?php if(!isset($_SESSION["user"])) { ?>
																			<div class="form-group">
																				<label for="inputEmail"><?= i18n("Nombre de usuario")?></label>
																				<input name="username" type="text" class="form-control"  placeholder="<?= i18n("Nombre de usuario")?>">
																			</div>
																			<div class="form-group">
																				<label for="inputPassword"><?= i18n("Contraseña")?></label>
																				<input name="password" type="password" class="form-control" placeholder="<?= i18n("Contraseña")?>">
																			</div>
																			<div class="modal-footer">
																				<a href="index.php?controller=usuarios&action=add"><button type="button" id="registro" class="btn buttonStack"><?= i18n("Registrar")?></button></a>
																				<button type="submit" class="btn buttonStack"><?= i18n("Entrar")?></button>
																			</div>
																			<?php } else { ?>
																			<div class="divBotonesLogin row">
																				<div class ="col-md-12">
																					<span class="titleMenuLogged"><?= $_SESSION["username"] ?></span>
																				</div>
																				<a href="index.php?controller=usuarios&action=view">
																					<div class="col-md-12 itemLoged">
																						<label class="glyphicon glyphicon glyphicon-user"></label><?=i18n("Perfil")?>
																					</div>
																				</a>
																				<a href="index.php?controller=usuarios&action=logout">
																					<div class="col-md-12 itemLoged">
																						<label class="glyphicon glyphicon-log-out"></label><?=i18n("Salir")?>
																					</div>
																				</a>
																			</div>
																			<?php } ?>
																		</form>
																		<!-- fin formulario login -->
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
																	<li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#"><span class="dropdownMenu"><?= i18n("Menu")?></span><span class="caret"></span></a>
																		<ul class="dropdown-menu dropdownMenu listaMenu">
																			<li><a href="index.php?controller=posts&action=index"><?=i18n("Inicio")?></a></li>
																			<li><a href="index.php?controller=posts&action=sinContestar"><?=i18n("Sin contestar")?></a></li>
																			<li><a href="index.php?controller=usuarios&action=index"><?=i18n("Usuarios")?></a></li>
																			<li><a href="#"><?=i18n("Categorias")?></a></li>
																			<li><a href="#"><?=i18n("Ayuda")?></a></li>
																		</ul>
																	</li>
																</ul>
															</div>
														</div>
													</nav>
												</div>
												<!--FIN MENU PAL MOVIL PAPAS-->

												<?= $view->getFragment(ViewManager::DEFAULT_FRAGMENT) ?>
											</div>
											<!-- Inicio sidebar -->
											<nav class="col-md-2 col-lg-2  visible-lg visible-md" id="sideBar">
												<ul class="nav nav-pills nav-stacked" data-spy="affix" data-offset-top="205">
													<li><span class="compSideBar"><a class="enlaceSideBar" href="index.php?controller=posts&action=index"><?=i18n("Inicio")?></a></span></li>
													<hr/>
													<li><span class="compSideBar"><a class="enlaceSideBar" href="index.php?controller=posts&action=sinContestar"><?=i18n("Sin contestar")?></a></span></li>
													<hr/>
													<li><span class="compSideBar"><a class="enlaceSideBar" href="index.php?controller=usuarios&action=index"><?=i18n("Usuarios")?></a></span></li>
													<hr/>
													<li><span class="compSideBar"><a class="enlaceSideBar" href="#"><?=i18n("Categorias")?></a></span></li>
													<hr/>
													<li><span class="compSideBar"><a class="enlaceSideBar" href="#"><?=i18n("Ayuda")?></a></span></li>	
												</ul>
											</nav>
											<!--final sidebar-->
										</div>
										<!-- FOOTER -->

										<div class="row finalPagina">
											<div class="linksFooter col-md-10">
											<span class="elemFooter"><a href='#'><?=i18n("Empleos");?></a></span>
												<span class="verticalSeparator"></span>
												<span class="elemFooter"><a href='#'><?=i18n("Informacion");?></a></span>
												<span class="verticalSeparator"></span>
												<span class="elemFooter"><a href='#'><?=i18n("Privacidad");?></a></span>
												<span class="verticalSeparator"></span>
												<span class="elemFooter"><a href='#'><?=i18n("Terminos");?></a></span>
											</div>
											<div class="dropup col-md-2">
												<a class="dropdown-toggle elemFooter" data-toggle="dropdown" href="#">
													<?=i18n("Idiomas")?>
												</a>
												<?php
													include(__DIR__."/language_select_element.php");
												?>
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
									<script>
										$(document).ready(function() {
											$("#msg-container").delay(3000).fadeOut('slow');
										});

										<?= $view->getFragment("script") ?>
									</script>
								</body>
								</html>
