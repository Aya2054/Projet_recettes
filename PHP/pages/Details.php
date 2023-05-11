<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();



$gdb = new \gdb\recette("isa_cuisine");
$id=$_GET['id'];
$data = $gdb->getRecetteById($id);

?>

<!-- Démarre le buffering -->
<?php ob_start() ;
 foreach ($data as $a){
     $a->getHTML();
 }
 ?>


<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content = ob_get_clean() ?>
<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

