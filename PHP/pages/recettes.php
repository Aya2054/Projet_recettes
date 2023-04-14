<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();
echo "hello";
$gdb = new \gdb\recette("gamesdb");
$data = $gdb->generer_auto();
//var_dump($data);

?>

<!-- Démarre le buffering -->
<?php ob_start() ?>

<div class="title">GAMES</div>
<section class="games-list">
    <?php foreach ($data as $d): ?>
        <?= $d->getHTML(); ?>
    <?php endforeach; ?>
</section>

<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content = ob_get_clean() ?>
<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

