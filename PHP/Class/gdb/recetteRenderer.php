<?php

namespace gdb;

class recetteRenderer
{
    public function getHTML()
    { ?>
        <div class="recipe">
            <h3><?= $this->titre ?></h3>
        <div class="recipe-details">
                <?php if ($this->image != null) : ?>
                    <img src="/Projet_recettes/PHP/uploads/recettes/<?= $this->image ?>" alt="Description de l'image">

                <?php endif; ?>
            <p><?= $this->description ?></p>
        </div>
            <a href="#">Voir la recette</a>

            </div>
    <?php }
}