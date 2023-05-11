<?php
session_start() ;
$logged = isset($_SESSION['nickname']) ;
include "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR .'class'.DIRECTORY_SEPARATOR.'Autoloader.php' ;
Autoloader::register();
?>

<!-- Démarre le buffering -->
<?php ob_start() ?>

<?php if($logged): ?>
    <h1>Hi <?php echo $_SESSION['nickname'] ?>, </h1>
<?php endif; ?>

<section id="pageprincipal">
    <div class="centre">
        <h2>Bienvenue chez <span id="isa-total">ISA-Recettes</span></h2>
        <p>Découvrez des recettes simples et savoureuses sur notre site. Trouvez votre inspiration culinaire dès maintenant et ajoutez une touche de saveur à votre vie quotidienne.</p>
        <form class="form-inline">
            <div class="input-group">
        <input type="text"style="border-radius: 10px; border:none; margin-top: 40px; width: 90%;padding:7px" placeholder="recettes, ingredients, tags......">
            </div>
        </form>
    </div>
</section>

    <!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>
    <!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>