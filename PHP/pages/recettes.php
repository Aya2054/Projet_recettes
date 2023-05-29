<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
$logged = isset($_SESSION['nickname']);
$gdb = new \gdb\Recette($logged);
$data = $gdb->generer_auto();

?>

<!-- Démarre le buffering -->
<?php ob_start() ?>

<div>Recettes</div>

<div class="recipes-list">
    <?php foreach ($data as $d): ?>
        <?= $d->getHTML(); ?>
    <?php endforeach; ?>
</div>

<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content = ob_get_clean() ?>
<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

