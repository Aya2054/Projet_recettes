<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$gf = new \gdb\recetteForm();
?>

    <!-- Démarre le buffering -->
<?php ob_start() ?>

<?php
$id=$_GET['id'];
$gf->deleteRecette($id);
