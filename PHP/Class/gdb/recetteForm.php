<?php

namespace gdb;

use gdb\recette;


class recetteForm
{
    private $gdb;

    public function generateForm()
    { ?>
        <section>
            <h1>Ajouter une recette</h1>
            <form method="POST" enctype="multipart/form-data">
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>

                <label for="image">Image :</label>
                <input type="file" id="image" name="image" accept="image/*" required>

                <label for="ingredients">Ingrédients :</label>
                <textarea id="ingredients" name="ingredients" required></textarea>

                <label for="tags">Tags :</label>
                <input type="text" id="tags" name="tags" required>

                <input type="submit" value="Ajouter">
            </form>
        </section>
        <?php
    }

    public function createRecette($titre, $description = null, $imgFile = null, $ingredients = null)
    {
        if ($this->gdb == null) $this->gdb = new recette();
        $this->gdb->create_recette($titre, $description, $imgFile, $ingredients);
        header('location: recettes.php');
        exit();
    }

    public function editRecette($id, $titre, $description = null, $imgFile = null, $ingredients = null)
    {

        $this->gdb->edit_recette($id, $titre, $description, $imgFile, $ingredients);
        header('location: recettes.php');
        exit();
    }

    public function deleteRecette($id)
    {

        $this->gdb->delete_recette($id);
        header('location: recettes.php');
        exit();
    }

}