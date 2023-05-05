<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
$gdb = new \gdb\recette("gamesdb");
$data = $gdb->generer_auto();

?>

<!-- Démarre le buffering -->
<?php ob_start() ?>

<div class="title">Recettes</div>
<section class="">
    <?php foreach ($data as $d): ?>
        <?= $d->getHTML(); ?>
    <?php endforeach; ?>
</section>

<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content = ob_get_clean() ?>
<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

