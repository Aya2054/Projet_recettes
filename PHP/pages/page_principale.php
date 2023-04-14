<?php
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

<section>
    <div class="centre">
        <h2>Bienvenue dans notre site  <span id="isa-total">ISA-Recettes</span></h2>
        <p>Découvrez nos recettes <span id="maroc">100% marocaines</span> sur notre site. Commencez votre recherche dès maintenant pour savourer des plats authentiques, frais et exotiques.</p>
        <input type="text"style="border-radius: 10px; border:none; margin-top: 40px; width: 90%;padding:7px" placeholder="Rechercher ...">
    </div>
</section>

    <!-- Récupère le contenu du buffer (et le vide) -->
<?php $content=ob_get_clean() ?>
    <!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>