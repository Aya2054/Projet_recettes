<?php

require_once 'recette.php';

$recetteDb = new RecetteDb();

// Ajouter une recette
$recetteDb->ajouterRecette("Pizza Margherita", "Une délicieuse pizza à la sauce tomate et au fromage mozzarella", "pizza.jpg");

// Modifier une recette
$recetteDb->modifierRecette(1, "Pizza Napolitaine", "Une pizza traditionnelle napolitaine avec de la sauce tomate, des anchois et des olives", "pizza_napo.jpg");

// Afficher toutes les recettes
$recetteDb->listerRecettes();

// Ajouter un nouvel ingrédient
//$recetteDb->create_ingredient("Pâte à pizza", $_FILES['ingredient_img']);

// Générer la liste des ingrédients automatiquement
//echo $recetteDb->generer_auto();
 //echo $recetteDb->generer_auto_tag();

?>

