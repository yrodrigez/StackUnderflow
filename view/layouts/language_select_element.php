<?php
// file: view/layouts/language_select_element.php
?>

<ul id="languagechooser" class="dropdown-menu" role="menu" aria-labelledby="dLabel">
  <li><a href="index.php?controller=language&amp;action=change&amp;lang=es">
  <img src="img/banderitas/latino.png" class="languageIcon"> <?= i18n("Venezolano") ?>
  </a></li>
  <li><a href="index.php?controller=language&amp;action=change&amp;lang=en">
  <img src="img/banderitas/'murica.png" class="languageIcon"><?= i18n("'Muricano") ?>
  </a></li>
</ul>