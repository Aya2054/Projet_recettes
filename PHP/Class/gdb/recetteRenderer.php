<?php

namespace gdb;

class recetteRenderer
{

    private $id_recette;

    /**
     * @return mixed
     */
    public function getIdRecette()
    {
        return $this->id_recette;
    }

    /**
     * @param mixed $id_recette
     */
    public function setIdRecette($id_recette): void
    {
        $this->id_recette = $id_recette;
    }


    public function getHTML()
    { ?>
        <div class="recipe">
            <a href="editer.php?id=<?php echo $this->id_recette; ?>" class="m-2">
                <i class="fa fa-edit fa-2x"></i>
            </a>
            <h3><?= $this->titre ?></h3>
        <div class="recipe-details">
                <?php if ($this->image != null) : ?>
                    <img src="/Projet_recettes/PHP/uploads/recettes/<?= $this->image ?>" alt="Description de l'image">

                <?php endif; ?>
            <p><?= $this->description ?></p>
        </div>
            <a href="Details.php?id=<?php echo $this->id_recette; ?>">Voir la recette</a>

            </div>
    <?php }
}