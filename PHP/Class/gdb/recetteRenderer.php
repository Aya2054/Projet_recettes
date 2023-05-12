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
            <h3><?= $this->titre ?></h3>
            <div class="mes-items">
                <a href="editer.php?id=<?php echo $this->id_recette; ?>"><i class="bi bi-pen" id="pen"></i></a>
                <a href="supp.php?id=<?php echo $this->id_recette; ?>"><i class="bi bi-trash" id="trash"></i></a>
            </div>
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