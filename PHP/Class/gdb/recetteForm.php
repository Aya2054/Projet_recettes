<?php

namespace gdb;

use gdb\Recette;
use gdb\Test;


class recetteForm
{
    private $gdb;
    private $test;

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
    public function generateForm()
    { ?>
        <section id="form-ajouter">
            <h1>Ajouter une recette</h1>
            <form method="POST" enctype="multipart/form-data">
                <label for="title">Titre :</label>
                <input type="text" id="title" name="title" required>

                <label for="description">Description :</label>
                <textarea id="description" name="description" required></textarea>

                <label for="image">Image :</label>
                <div id="grand-image">
                    <div>

                        <input type="file" id="image" name="image" accept="image/*" required>
                    </div>
                    <div>
                        <img src="" alt="">
                    </div>
                </div>

                <div>
                    <div>
                        <div class="ingredient-title">
                            <label for="ingredients">Ingrédients :</label>
                            <div class="ingredient-buttons">
                                <button class="ingredient-add" type="button">+</button>
                                <button class="ingredient-remove" type="button">-</button>
                            </div>
                        </div>
                        <div class="ingredient-container">
                            <div class="ingredient-input">
                                <select name="ingredients[0][unit]">
                                    <option value="g">grammes (g)</option>
                                    <option value="ml">kilogrammes (kg)</option>
                                    <option value="ml">litres (l)</option>
                                    <option value="ml">millilitres (ml)</option>
                                </select>
                            </div>
                            <div class="ingredient-input">
                                <input type="text" name="ingredients[0][quantity]" placeholder="Quantité">
                            </div>
                            <div class="ingredient-input">
                                <input list="list-ingredient" name="ingredients[0][name]">
                                <datalist id="list-ingredient">
                                    <?php
                                    $ingredient = new \gdb\ingredient();
                                    $ingredients = $ingredient->generer_auto();

                                    foreach ($ingredients as $ingr) {
                                        echo '<option value="' . $ingr->nom . '">';
                                    }
                                    ?>
                                </datalist>
                            </div>

                            <div class="ingredient-image">
                                <input type="file" id="image-ing" name="ingredients[]" accept="image/*">
                            </div>
                        </div>

                    </div>
                </div>

                <div class="ingredient-buttons">
                    <label for="tags">Tags :</label>
                    <button class="tag-add ingredient-add" type="button">+</button>
                    <button class="tag-remove ingredient-remove" type="button">-</button>
                </div>

                <div class="tag-container">
                    <input list="list-tag" id="tags" name="tags[]">

                    <datalist id="list-tag">
                        <?php
                        $tag = new \gdb\tag();
                        $tags = $tag->generer_auto();
                        foreach ($tags as $t) {
                            echo '<option value="' . $t->nom . '">';
                        }
                        ?>
                    </datalist>
                </div>
                <br>

                <div></div>
                <br>
                <input type="submit" value="Ajouter">
            </form>
        </section>

        <script src="/../../Projet_recettes/JS/edit.js"></script>
        <?php
    }
    private $titre, $description, $image;

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param mixed $image
     */
    public function setImage($image): void
    {
        $this->image = $image;
    }

    /**
     * @return mixed
     */
    public function getTitre()
    {
        return $this->titre;
    }

    /**
     * @param mixed $titre
     */
    public function setTitre($titre): void
    {
        $this->titre = $titre;
    }



    public function generateEditForm($id){
        $rec = new \gdb\Recette();
        $recette=$rec->getRecetteById($id);
        $this->titre = $recette->titre;
        $this->description= $recette->description;
        $this->image= $recette->image;
        if (!$recette) {
            echo "n'existe pas";
            return;
        }
        ?>

<section id="form-ajouter">
    <h1>Editer la recette</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" value="<?=$this->titre?>" required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" required><?=$this->description?></textarea>

        <label for="image">Image :</label>
        <input type="file" id="image-input" name="image" accept="image/*" required>
        <div id="preview-container">
            <img id="preview-image" src="/Projet_recettes/PHP/uploads/recettes/<?= $this->image ?>">
        </div>
        <div>
            <div>
                <div class="ingredient-title">
                    <label for="ingredients">Ingrédients :</label>
                    <div class="ingredient-buttons">
                        <button class="ingredient-add" type="button">+</button>
                        <button class="ingredient-remove" type="button">-</button>
                    </div>
                </div>
                <div class="ingredient-container">
                    <?php
                    $ingredients = $rec->getIgredientsById($id);

                    foreach ($ingredients as $index => $ingredient) {
                        ?>
                        <div class="ingredient-input">
                            <select name="ingredients[<?php echo $index; ?>][unit]">
                                <option value="g">grammes (g)</option>
                                <option value="kg">kilogrammes (kg)</option>
                                <option value="l">litres (l)</option>
                                <option value="ml">millilitres (ml)</option>
                            </select>
                        </div>
                        <div class="ingredient-input">
                            <input type="text" name="ingredients[<?php echo $index; ?>][quantity]" placeholder="Quantité" value="<?php echo $ingredient->quantite; ?>">
                        </div>
                        <div class="ingredient-input">
                            <input list="list-ingredient" name="ingredients[<?php echo $index; ?>][name]" value="<?php echo $ingredient->nom; ?>">
                            <datalist id="list-ingredient">
                                <?php
                                $ingredientObject = new \gdb\ingredient();
                                $allIngredients = $ingredientObject->generer_auto();

                                foreach ($allIngredients as $ingr) {
                                    echo '<option value="' . $ingr->nom . '">';
                                }
                                ?>
                            </datalist>
                        </div>

                        <div class="ingredient-image">
                            <input type="file" id="image-ing" name="ingredients[<?php echo $index; ?>][image]" accept="image/*">
                        </div>
                        <?php
                    }
                    ?>
                </div>


            </div>
        </div>


        <div class="ingredient-buttons">
            <label for="tags">Tags :</label>
            <button class="tag-add ingredient-add" type="button">+</button>
            <button class="tag-remove ingredient-remove" type="button">-</button>
        </div>

        <?php
        $tags = $rec->getTagsById($id);

        foreach ($tags as $index => $tag) {
        ?>
        <div class="tag-container">
            <input list="list-tag" id="tags" name="tags[<?php echo $index; ?>] value="<?php echo $tag->nom; ?>">

            <datalist id="list-tag">
                <?php
                $tag = new \gdb\tag();
                $tags = $tag->generer_auto();
                foreach ($tags as $t) {
                    echo '<option value="' . $t->nom . '">';
                }
                ?>
            </datalist>
        </div>
        <?php }?>
        <br>

        <div></div>
        <br>

        <input type="submit" value="Editer">
    </form>
</section>
        <script src="/../../Projet_recettes/JS/main.js"></script>
<?php }


    public function createRecette($titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
    {
        if ($this->gdb == null) $this->gdb = new \gdb\Recette();
        $this->gdb->create_recette($titre, $description, $imgFile, $ingredients,$tag);
        header('location: recettes.php');
        exit();
    }




    public function editRecette($id, $titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
    {
        if ($this->gdb == null) $this->gdb = new \gdb\Recette();
        $this->gdb->edit_recette($id, $titre, $description, $imgFile, $ingredients, $tag);
        header('location: recettes.php');
        exit();
    }

    public function deleteRecette($id)
    {

        if ($this->gdb == null) $this->gdb = new Recette();
        $this->gdb->delete_recette($id);
        header('location: recettes.php');
        exit();
    }

}