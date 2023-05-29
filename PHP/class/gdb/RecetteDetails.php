<?php

namespace gdb;

class RecetteDetails
{
    public $id_recette;
    public $ingredients=[];
    public $tags=[];


    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id_recette;
    }

    /**
     * @param mixed $id_recette
     */
    public function setId($id_recette): void
    {
        $this->id_recette = $id_recette;
    }
    public function getIngredients()
    {
        return $this->ingredients;
    }

    public function setIngredients($ingredients)
    {
        $this->ingredients = $ingredients;
    }

    public function getTags()
    {
        return $this->tags;
    }

    public function setTags($tags)
    {
        $this->tags = $tags;
    }
    public function setTitre($nouveauTitre) {
        $this->titre = $nouveauTitre;
    }
    public function setDescription($nouvelleDescription) {
        $this->description = $nouvelleDescription;
    }
    public function setImage($nouvelleImage) {
        $this->image = $nouvelleImage;
    }




    public function getHTML()
    { ?>
        <div class="recipe-container">
        <div class="recipe-header">
            <h1 class="recipe-title"><?= $this->titre ?></h1>
        </div>
            <div class="recipe-image">
                <?php if ($this->image != null) : ?>
                    <img src="/Projet_recettes/PHP/uploads/recettes/<?= $this->image ?>" alt="Description de l'image">
                <?php endif; ?>
                <div class="recipe-ingredients">
                    <h2>Ingrédients</h2>
                    <ol>
                        <?php
                        foreach ($this->ingredients as $ingredient) : ?>
                            <li><?=$ingredient->quantite?> <?= $ingredient->unite?> de <?= $ingredient->nom?></li>
                        <?php endforeach; ?>
                    </ol>
                </div>

                <div class="recipe-tags">
                    <h2>Tags</h2>
                    <ul>
                        <?php foreach ($this->tags as $tag) : ?>
                            <li><?= $tag->nom ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>

            </div>
            <div class="recipe-directions">
                <h2>Instructions</h2>
                <p><?= $this->description ?></p>
            </div>
        </div>

    <?php }



}
