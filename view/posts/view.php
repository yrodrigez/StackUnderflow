<?php
//file: view/posts/view.php
require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$post = $view->getVariable("post");
$autor = $view->getVariable("autor");
$respuestas = $view->getVariable("respuestas");



/**
 * @var Respuesta $respuesta
 * @var Post $post
 */
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
  <!-- inicio pregunta-->
  <div class="whiteBackground caja-post-respuesta">
    <div class="row cuerpoPregunta">
      <span class="col-lg-9 col-md-8 col-sm-7 col-xs-7 tituloPregunta"><?= $post->getTitulo();?></span>
      <span class="col-lg-3 col-md-4 col-sm-5 col-xs-5 usuarioPregunta"><?php echo sprintf(i18n("Preguntado por: %s"), $autor->getUsername());?></span>
    </div>
    <hr>
    <?php if(isset($_SESSION["user"]) && isset($_GET["editPost"])): ?>
      <?php if($_SESSION["user"] == $post->getIdUsuario() && $_GET["editPost"] == $post->getId()):
        /*Entonces puede modificar*/
        ?>
        <div class="row">
          <form action='?controller=posts&action=modify&id=<?=$post->getId();?>' method="POST">
            <div class="col-md-12 textBox">
              <textarea  name="cuerpo" rows="10" required="true"><?=$post->getCuerpo() ?></textarea>
            </div>
            <!-- Fin textArea -->
            <!-- BOTON Enviar -->
            <div  class ="row">
              <div id="preguntaDiv" class="preguntaContainer col-lg-3 col-md-3 col-sm-3 col-xs-4">
                <input type="submit" class="btn btn-primary btn-modificar" value="<?= i18n("Modificar");?>">
              </div>
            </div>
          </form>
        </div>
      <?php endif; ?>
    <?php else: ?>
      <div class="row">
        <div class="col-md-12">
          <p align="justify">
            <?=$post->getCuerpo() ?>
          </p>
        </div>
      </div>
    <?php endif ?>
    <?php
    if(isset($_SESSION["user"]) && !isset($_GET["editPost"])):
      if($post->getIdUsuario() == $_SESSION["user"]): ?>
        <div class="row">
          <div class="col-md-12 div-modificar">
            <a class="btn btn-default btn-modificar"
               href="?controller=posts&action=view&id=<?=$post->getId()?>&editPost=<?=$post->getId()?>"
            >
              <?= i18n("Modificar") ?>
            </a>
          </div>
        </div>
      <?php endif ?>
    <?php endif ?>
  </div>
  <!-- final pregunta -->
  <!-- inicio respuestas -->
  <div class="tituloRespuesta col-md-12">
    <span><?= i18n("Respuestas");?></span>
    <hr>
  </div>
  <div class="row">
    <?php if($respuestas==NULL) {
      echo "<div class='col-md-12'>".i18n("Esta pregunta no tiene respuestas")."</div>";
    } else {
      foreach ($respuestas as $respuesta) { ?>
        <div class="col-lg-2 col-md-2 col-sm-3 col-xs-4 w">
          <img
            alt="<?= i18n("Foto de usuario");?>"
            class="img-responsive img-circle sizePhotoAnswer"
            src="img/users/<?=$respuesta->getUsuarioCreador()->getFotoPath(); ?>"/>
        </div>
        <div class="col-lg-10 col-md-10 col-sm-9 col-xs-8 whiteBackground caja-post-respuesta">
          <p align="justify">
            <?= $respuesta->getCuerpo(); ?>
          </p>
          <div class="row">
            <div class="col-md-12 likes">
              <a href="index.php?controller=respuestas&action=addLike&id=<?=$respuesta->getIdRespuesta()?>">
                <label class="glyphicon glyphicon-thumbs-up">
                  <?= $respuesta->getLikes(); ?>
                </label></a>
              <a href="index.php?controller=respuestas&action=addDislike&id=<?=$respuesta->getIdRespuesta();?>">
                <label class="glyphicon glyphicon-thumbs-down">
                  <?= $respuesta->getDislikes(); ?>
                </label></a>
            </div>
          </div>
          <div class="row">
            <div class="usuarioRespuesta col-md-12">
				<span>
					<?php echo sprintf(i18n("Respondido por: %s, el dia %s"),
            $respuesta->getUsuarioCreador()->getUsername(),
            $respuesta->getFechaCreacion());//revisar que no tenga la hora...?>
				</span>
            </div>
          </div>
          <?php
          if(isset($_GET["editRespuesta"])){
            if(isset($_SESSION["user"]) && $_GET["editRespuesta"] != $respuesta->getIdRespuesta()){
              if($respuesta->getUserId() == $_SESSION["user"]) { ?>
                <div class="row">
                  <div class="col-md-12 div-modificar">
                    <a class="btn btn-default btn-modificar"
                       href="?controller=posts&action=view&id=<?= $post->getId() ?>&editRespuesta=<?= $respuesta->getIdRespuesta() ?>"
                    >
                      <?= i18n("Modificar") ?>
                    </a>
                  </div>
                </div>
                <?php
              }
            }
          }else{
            if(isset($_SESSION["user"])){
              if($respuesta->getUserId() == $_SESSION["user"]) { ?>
                <div class="row">
                  <div class="col-md-12 div-modificar">
                    <a class="btn btn-default btn-modificar"
                       href="?controller=posts&action=view&id=<?= $post->getId() ?>&editRespuesta=<?= $respuesta->getIdRespuesta() ?>"
                    >
                      <?= i18n("Modificar") ?>
                    </a>
                  </div>
                </div>
                <?php
              }
            }
          }
          ?>
        </div>
        <?php
      }
    } ?>
  </div>
  <!-- Final respuestas -->
  <!-- Visitas -->
  <div class="col-md-12 botonera-xs">
    <hr>
    <span class="glyphicon glyphicon-eye-open elemPregunta"></span>
    <span class="elemPregunta"><?=$post->getNumVisitas();?></span>
    <span><?= i18n("Visitas");?></span>
  </div>
  <!--Fin visitas-->
  <!-- Inicio textarea -->
<?php if(isset($_SESSION["user"])) { ?>
  <form action='index.php?controller=respuestas&action=add&id=<?=$post->getId();?>' method="POST">
    <div class="col-md-12 textBox">
      <textarea id="textEditor" name="respuesta" rows="10" required="true"></textarea>
    </div>
    <!-- Fin textArea -->
    <!-- BOTON Enviar -->
    <div  class ="row">
      <div id="preguntaDiv" class="preguntaContainer col-lg-3 col-md-3 col-sm-3 col-xs-4">
        <input type="submit" class="btn btn-primary preguntaButton" value="<?= i18n("Enviar");?>">
      </div>
    </div>
    <!-- FIN BOTON ENviar -->
  </form>
<?php } ?>