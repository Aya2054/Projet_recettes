<?php

namespace gdb;

class recetteDetails
{
    private $id_recette;

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

    public function getHTML()
    { ?>
        <div class="recipe-container">
        <div class="recipe-header">
        <div class="recipe">
            <h1 class="recipe-title"><?= $this->titre ?></h1>
            <div class="recipe-buttons">
                <button class="recipe-button edit-button">Modifier</button>
                <button class="recipe-button delete-button">Supprimer</button>
            </div>
        </div>
            <div class="recipe-image">
                <?php if ($this->image != null) : ?>
                    <img src="/Projet_recettes/PHP/uploads/recettes/<?= $this->image ?>" alt="Description de l'image">
                <?php endif; ?>
                <div class="recipe-ingredients">
                    <h2>Ingrédients</h2>
                    <ol>
                        <li>500g de pâtes</li>
                        <li>1 oignon émincé</li>
                        <li>2 gousses d'ail émincées</li>
                        <li>1 boîte de tomates pelées (400g)</li>
                        <li>Sel et poivre</li>
                    </ol>
                </div>
            </div>
            <div class="recipe-directions">
                <h2>Instructions</h2>
                <p><?= $this->description ?></p>
            </div>
        </div>
            </div>

    <?php }



}
