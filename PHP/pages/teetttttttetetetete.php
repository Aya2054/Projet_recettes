<?php

class Ingredient {
    public $name;
    public $quantity;
    public $unit;
    public $image;

    public function __construct($name, $quantity, $unit, $image) {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->unit = $unit;
        $this->image = $image;
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données des ingrédients depuis le formulaire
    $ingredientData = $_POST['ingredients'];

    // Tableau pour stocker les ingrédients
    $ingredients = array();

    // Parcourir chaque ingrédient
    foreach ($ingredientData as $data) {
        $name = $data['name'];
        $quantity = $data['quantity'];
        $unit = $data['unit'];
        $image = $data['image'];

        // Créer une instance d'ingrédient et l'ajouter au tableau
        $ingredient = new Ingredient($name, $quantity, $unit, $image);
        $ingredients[] = $ingredient;
    }

    // Vous pouvez ensuite utiliser le tableau `$ingredients` pour ajouter les ingrédients à une recette ou effectuer d'autres opérations.
    // Par exemple, pour afficher les ingrédients :
    foreach ($ingredients as $ingredient) {
        echo "Ingrédient : " . $ingredient->name . "<br>";
        echo "Quantité : " . $ingredient->quantity . "<br>";
        echo "Unité de mesure : " . $ingredient->unit . "<br>";
        echo "Image : " . $ingredient->image . "<br><br>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter des ingrédients à une recette</title>
</head>
<body>
<form method="POST">
    <h2>Ajouter des ingrédients à une recette</h2>

    <div id="ingredients-container">
        <div class="ingredient">
            <label>Nom de l'ingrédient:</label>
            <input type="text" name="ingredients[0][name]" required>
            <br>

            <label>Quantité:</label>
            <input type="text" name="ingredients[0][quantity]" required>
            <br>

            <label>Unité de mesure:</label>
            <input type="text" name="ingredients[0][unit]" required>
            <br>

            <label>Image:</label>
            <input type="text" name="ingredients[0][image]" required>
            <br><br>
        </div>
    </div>

    <button type="button" onclick="addIngredient()">Ajouter un ingrédient</button>
    <br><br>
    <input type="submit" value="Ajouter à la recette">
</form>

<script>
    let ingredientCounter = 1;

    function addIngredient() {
        const container = document.getElementById("ingredients-container");
        const ingredientDiv = document.createElement("div");
        ingredientDiv.className = "ingredient";

        ingredientDiv.innerHTML = `
                <label>Nom de l'ingrédient:</label>
                <input type="text" name="ingredients[${ingredientCounter}][name]" required
