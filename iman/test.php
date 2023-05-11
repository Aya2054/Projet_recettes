<?php

require_once 'recette.php';
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    if (isset($_GET['search_query'])) {
        $searchQuery = $_GET['search_query'];


$recetteDb = new RecetteDb();



$recettes = $recetteDb->genere_recherche($searchQuery, $searchQuery, $searchQuery);

// Afficher les résultats
foreach ($recettes as $recette) {
    echo $recette['titre'] . '<br>';
    echo $recette['description'] . '<br>';
    echo '<img src="' . $recette['image'] . '" alt="' . $recette['titre'] . '"><br>';
    echo 'Ingrédients : ' . $recette['list_ingredients'] . '<br>';
    echo 'Tags : ' . $recette['tag'] . '<br><br>';
}
}
}
?>

<form method="GET" action="test.php">
    <input type="text" name="search_query" placeholder="Rechercher une recette">
    <input type="submit" value="Rechercher">
</form>
<?php

// Ajouter une recette
//$recetteDb->ajouterRecette("Pizza Margherita", "Une délicieuse pizza à la sauce tomate et au fromage mozzarella", "pizza");

// Modifier une recette
//$recetteDb->modifierRecette(1, "Pizza Napolitaine", "Une pizza traditionnelle napolitaine avec de la sauce tomate, des anchois et des olives", "pizza_napo");

// Afficher toutes les recettes
//$recetteDb->getRecettes();


//$recetteDb->create_recette("Pizza Margherita", "Une délicieuse pizza à la sauce tomate et au fromage mozzarella", "pizza.jpg", "tomates, fromage mozzarella", "pizza");

//echo $recetteDb->generer_auto();
//
//$recetteDb->supprimerRecette(7);


//$recette = $recetteDb->getRecetteById(1);
//echo $recette['titre'] . "\n";

// Ajouter un nouvel ingrédient
//$recetteDb->create_ingredient("Pâte à pizza", $_FILES['ingredient_img']);

// Générer la liste des ingrédients automatiquement
/*echo $recetteDb->generer_auto();
$ingredients = $recetteDb->generer_auto();
foreach ($ingredients as $ingredient) {
    echo $ingredient->nom . "\n";
}
// echo $recetteDb->generer_auto_tag();*/

?>

