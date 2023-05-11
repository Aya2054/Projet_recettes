<?php
require_once "../Config/config.php";

require ".." . DIRECTORY_SEPARATOR . 'class' . DIRECTORY_SEPARATOR . 'Autoloader.php';
Autoloader::register();

$gf = new \gdb\recetteForm();
?>

<!-- Démarre le buffering -->
<?php ob_start() ?>

<?php
if (empty($_POST['title'])) {
    $gf->generateForm();
} else {
    //recuperer l'image de la recette
    $imgFile = isset($_FILES['image']) ? $_FILES['image'] : null;

    //recupérer les ingredients
    if($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les données des ingrédients depuis le formulaire
        $ingredientData = $_POST['ingredients'];
        $tagsData=$_POST['tags'];

        // Tableau pour stocker les ingrédients
        $ingredients = array();
        $tags= array();

        // Parcourir chaque ingrédient
        foreach ($ingredientData as $data) {
            $i = 0;
            $name = $data['name'];
            $quantity = $data['quantity'];
            $unit = $data['unit'];
            $image = isset($_FILES['ingredients[' . $i . '][image]']) ? $_FILES['ingredients[' . $i . '][image]'] : null;

            // Créer une instance d'ingrédient et l'ajouter au tableau
            $ingredient = new \gdb\ingredient($name, $quantity, $unit, $image);
            $ingredients[] = $ingredient;
            $i++;
        }

        //parcourir chaque tags
        foreach ($tagsData as $data) {

            // Créer une instance de tag et l'ajouter au tableau
            $tag = new \gdb\tag($data);
            $tags[] = $tag;
        }

        if ($imgFile != null) {
            $gf->createRecette($_POST['title'], $_POST['description'], $imgFile, $ingredients, $tags);
        } else {
            echo "img vide";
        }
    }

}
?>

<?php $content = ob_get_clean() ?>
<?php Template::render($content) ?>

