<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$gf = new \gdb\recetteForm();
?>

<!-- Démarre le buffering -->
<?php ob_start() ?>

<?php
if (empty($_POST['name'])) {
    $gf->generateForm();
} else {
    $imgFile = isset($_FILES['image']) ? $_FILES['image'] : null;
    $gf->createRecette($_POST['titre'], $_POST['description'], $imgFile);
}
?>

<?php $content = ob_get_clean() ?>
<?php Template::render($content) ?>

