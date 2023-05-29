<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();



$gdb = new \gdb\Recette("isa_cuisine");
$gdbT= new \gdb\Tag();
$id=$_GET['id'];
$data = $gdb->getRecetteById($id);
// Créez une instance de la classe recetteDetails
$recette = new gdb\RecetteDetails();


?>

<!-- Démarre le buffering -->
<?php ob_start() ;?>
<h2>Voici les informations concernant la recette</h2>

<?php
// Assigner les données de la recette à l'objet $recette
$recette->setId($data->id_recette);
$recette->setTitre($data->titre);
$recette->setDescription($data->description);
$recette->setImage($data->image);


// Récupérer les données des ingrédients de la recette à partir de la base de données
$ingredients = $gdb->getIgredientsById($id); // Remplacez cela avec votre propre logique de récupération des ingrédients

// Assigner les ingrédients à la propriété correspondante de l'objet recetteDetails
$recette->setIngredients($ingredients);

// Récupérer les données des tags de la recette à partir de la base de données
$tags = $gdbT->getTagsForRecette($id); // Remplacez cela avec votre propre logique de récupération des tags

// Assigner les tags à la propriété correspondante de l'objet recetteDetails
$recette->setTags($tags);

// Appeler la méthode getHTML() pour afficher les données de la recette
$recette->getHTML();
 ?>


<!-- Récupère le contenu du buffer (et le vide) -->
<?php $content = ob_get_clean() ?>
<!-- Utilisation du contenu bufferisé -->
<?php Template::render($content) ?>

