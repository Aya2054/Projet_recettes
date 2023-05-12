<?php

namespace gdb;

use gdb\recette;
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
                                <input type="file" id="image-ing" name="ingredients[0][image]" accept="image/*">
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

        <script>


            // Récupération de l'élément input de type file
            const inputImage = document.getElementById("image");

            // Récupération de l'élément img qui affichera l'image sélectionnée
            const imgPreview = document.querySelector("#grand-image img");

            // Ajout d'un écouteur d'événement "change" sur l'élément input de type file
            inputImage.addEventListener("change", function () {

                // Vérification que l'utilisateur a bien sélectionné un fichier
                if (this.files && this.files[0]) {

                    // Création d'un objet FileReader pour lire le contenu du fichier sélectionné
                    const reader = new FileReader();

                    // Ajout d'un écouteur d'événement "load" sur l'objet FileReader
                    reader.addEventListener("load", function () {

                        // Attribution du résultat de la lecture du fichier à la source de l'élément img
                        imgPreview.src = this.result;
                    });

                    // Lecture du fichier sélectionné en tant que URL
                    reader.readAsDataURL(this.files[0]);
                }
            });












            // Récupération des éléments HTML
            const addButton = document.querySelector('.ingredient-add');
            const removeButton = document.querySelector('.ingredient-remove');
            const container = document.querySelector('.ingredient-container');
            let i = 1;

            // Fonction qui ajoute une nouvelle ligne d'ingrédient
            function addIngredient() {
                // Création des éléments HTML
                const ingredientInput = document.createElement('div');
                ingredientInput.classList.add('ingredient-container');
                ingredientInput.innerHTML = `
<div class="ingredient-input">
  <select name="ingredients[${i}][unit]">
    <option value="g">grammes (g)</option>
                                    <option value="ml">kilogrammes (kg)</option>
                                    <option value="ml">litres (l)</option>
                                    <option value="ml">millilitres (ml)</option>
  </select>
</div>
<div class="ingredient-input">
  <input type="text" name="ingredients[${i}][quantity]" placeholder="Quantité">
</div>
<div class="ingredient-input">
                                <input list="list-ingredient" name="ingredients[${i}][name]">
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
  <input type="file" name="ingredients[${i}][image]" accept="image/*">
</div>
`;

                // Ajout de la nouvelle ligne d'ingrédient dans le conteneur
                container.appendChild(ingredientInput);

                i++;
            }

            // Fonction qui supprime la dernière ligne d'ingrédient
            function removeIngredient() {
                // Récupération de toutes les lignes d'ingrédient
                const ingredientInputs = document.querySelectorAll('.ingredient-container');

                // Suppression de la dernière ligne d'ingrédient
                if (ingredientInputs.length > 1) {
                    const lastIngredientInput = ingredientInputs[ingredientInputs.length - 1];
                    lastIngredientInput.remove();
                    i--;
                }
            }

            // Ajout d'un écouteur d'événement pour le bouton d'ajout
            addButton.addEventListener('click', addIngredient);

            // Ajout d'un écouteur d'événement pour le bouton de suppression
            removeButton.addEventListener('click', removeIngredient);













            // Récupération des éléments HTML pour la gestion des tags
            const addButton0 = document.querySelector('.tag-add');
            const removeButton0 = document.querySelector('.tag-remove');
            const tagContainer = document.querySelector('.tag-container');
            const tags = [];

            // Ajout d'un écouteur d'événement pour le bouton "+"
            addButton0.addEventListener('click', () => {
                // Ajout d'un nouvel élément de saisie de tag au tableau
                const newTagInput = document.createElement('input');
                newTagInput.type = 'text';
                newTagInput.name = 'tags[]';
                newTagInput.required = true;
                newTagInput.setAttribute('list', `tag-list-${tags.length}`);

                // Création d'une datalist pour le nouveau tag input
                const dataListHTML = `
    <datalist id="tag-list-${tags.length}">
                        <?php
                $tag = new \gdb\tag();
                $tags = $tag->generer_auto();
                foreach ($tags as $t) {
                    echo '<option value="' . $t->nom . '">';
                }
                ?>
                    </datalist>
  `;

                // Ajout du nouvel élément d'entrée de balise au conteneur
                tagContainer.innerHTML += newTagInput.outerHTML + dataListHTML;

                // Ajout du tag au tableau
                tags.push(newTagInput);

                // Mettre à jour l'affichage des tags
                updateTags();
            });

            // Ajout d'un écouteur d'événement pour le bouton "-"
            removeButton0.addEventListener('click', () => {
                // Suppression du dernier élément du tableau de tags
                tags.pop();

                // Suppression du dernier élément du conteneur de tags
                tagContainer.lastChild.remove();
                tagContainer.lastChild.remove();

                // Mettre à jour l'affichage des tags
                updateTags();
            });

            // Fonction pour mettre à jour l'affichage des tags
            function updateTags() {
                // Ne fait rien, on utilise maintenant une datalist pour afficher les tags
            }

            // Fonction utilitaire pour créer une option dans une datalist
            function createOption(value) {
                const option = document.createElement('option');
                option.value = value;
                return option;
            }

            // Mettre à jour l'affichage des tags au chargement de la page
            updateTags();

            const ingredientNameInput = document.querySelector('input[name="ingredients[0][name]"]');
            const ingredientImageDiv = document.querySelector('.ingredient-image');

            ingredientNameInput.addEventListener('change', () => {
                const listIngredient = document.querySelector('#list-ingredient');
                const options = listIngredient.querySelectorAll('option');

                let ingredientExists = false;
                options.forEach((option) => {
                    if (option.value.toLowerCase() === ingredientNameInput.value.toLowerCase()) {
                        ingredientExists = true;
                    }
                });

                if (ingredientExists) {
                    ingredientImageDiv.style.display = 'none';
                } else {
                    ingredientImageDiv.style.display = 'block';
                }
            });

        </script>
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
        $rec = new \gdb\recette();
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
        <textarea id="description" name="description" value="<?=$this->description?>" required></textarea>

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
                        <input type="file" id="image-ing" name="ingredients[0][image]" accept="image/*">
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
            <input list="list-tag" id="tags" name="tags">

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
<?php }


    public function createRecette($titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
    {
        if ($this->gdb == null) $this->gdb = new \gdb\recette();
        $this->gdb->create_recette($titre, $description, $imgFile, $ingredients,$tag);
        //header('location: recettes.php');
        //exit();
    }

    /*public function test($titre, $description = null, $imgFile = null){
        if ($this->test == null) $this->test = new Test();
        $this->test->create_recette($titre, $description, $imgFile);
        echo "reussi";
    }*/


    public function editRecette($id, $titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
    {

        $this->gdb->edit_recette($id, $titre, $description, $imgFile, $ingredients, $tag);
        header('location: recettes.php');
        exit();
    }

    public function deleteRecette($id)
    {

        if ($this->gdb == null) $this->gdb = new recette();
        $this->gdb->delete_recette($id);
        header('location: recettes.php');
        exit();
    }

}