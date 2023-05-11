<?php

namespace gdb;

use gdb\recette;


class recetteForm
{
    private $gdb;
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
                                <input type="file" id="image-ing" name="ingredients[0][image]" accept="image/*" required>
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

            // Fonction qui ajoute une nouvelle ligne d'ingrédient
            function addIngredient() {
                // Création des éléments HTML
                const ingredientInput = document.createElement('div');
                ingredientInput.classList.add('ingredient-container');
                ingredientInput.innerHTML = `
  <div class="ingredient-title">
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
                                <input type="file" id="image-ing" name="ingredients[0][image]" accept="image/*" required>
                            </div>
                        </div>`;

                // Ajout de la nouvelle ligne d'ingrédient dans le conteneur
                container.appendChild(ingredientInput);
            }

            // Fonction qui supprime la dernière ligne d'ingrédient
            function removeIngredient() {
                // Récupération de toutes les lignes d'ingrédient
                const ingredientInputs = document.querySelectorAll('.ingredient-container');

                // Suppression de la dernière ligne d'ingrédient
                if (ingredientInputs.length > 1) {
                    const lastIngredientInput = ingredientInputs[ingredientInputs.length - 1];
                    lastIngredientInput.remove();
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

            // Écouteur d'événement sur le bouton "+"
            addButton0.addEventListener('click', () => {
                // Création d'un nouvel élément d'entrée de balise
                const newTagInput = document.createElement('input');
                newTagInput.type = 'text';
                newTagInput.name = 'tags';
                newTagInput.required = true;

                // Ajout du nouvel élément d'entrée de balise au conteneur
                tagContainer.appendChild(newTagInput);

                // Ajout du tag au tableau
                tags.push(newTagInput);
            });

            // Ajout d'un écouteur d'événement pour le bouton de suppression
            removeButton0.addEventListener('click', () => {
                // Suppression du dernier élément du tableau de tags
                tags.pop();

                // Suppression du dernier élément du conteneur de tags
                tagContainer.lastChild.remove();
            });

            // Fonction pour mettre à jour l'affichage des tags
            function updateTags() {
                const tagsList = document.createElement('ul'); // Crée un élément HTML <ul> pour afficher la liste des tags
                tags.forEach(tag => {
                    const tagItem = document.createElement('li'); // Crée un élément HTML <li> pour chaque tag
                    tagItem.textContent = tag.value; // Ajoute le texte du tag à l'élément <li>
                    tagsList.appendChild(tagItem); // Ajoute l'élément <li> à l'élément <ul>
                });
                tagContainer.appendChild(tagsList); // Ajoute l'élément <ul> au conteneur de tags
            }

            // Mettre à jour l'affichage des tags au chargement de la page
            updateTags();


        </script>
        <?php
    }

    public function generateEditForm()
    { ?>
<section id="form-ajouter">
    <h1>Editer la recette</h1>
    <form method="POST" enctype="multipart/form-data">
        <label for="title">Titre :</label>
        <input type="text" id="title" name="title" value=<?=$this->titre?> required>

        <label for="description">Description :</label>
        <textarea id="description" name="description" value=<?=$this->descritption?> required></textarea>

        <label for="image">Image :</label>
        <input type="file" id="image-input" name="image" accept="image/*" required>
        <div id="preview-container">
            <img id="preview-image" src="/Projet_recettes/PHP/uploads/recettes/<?= $this->image ?>">
        </div>

        <div id="divIngredients" class="mt20 repeator-ingredients">
            <div class="row repeator-item">
                <div class="large-2 medium-2 small-6 columns">
                    <label>Quantité</label>
                    <input type="text" name="quantite" value="" />
                </div>
                <div class="large-3 medium-3 small-6 columns">
                    <label>Mesures</label>
                    <select class="auto-mesure" name="mesure[0]">
                        <option value="">(Rien)</option>
                        <?php
                        $unite = new \gdb\recette();
                        $unites = $unite->unites();
                        foreach ($unites as $unite) {
                            echo '<option value="' . $unite->id . '">' . $unite->unite . '</option>';
                        }
                        ?>
                    </select>
                </div>
                <div class="large-6 medium-6 small-10 columns">
                    <label for="ingredient1">Ingrédient :</label>
                    <select class="form-select form-select-lg mb-3" aria-label=".form-select-lg example" id="ingredient1" name="ingredient1">
                        <option selected>Choisir un ingredient</option>
                        <?php
                        $ingredient = new \gdb\ingredient();
                        $ingredients = $ingredient->generer_auto();
                        foreach ($ingredients as $ingr) {
                            echo '<option value="' . $ingr->id . '">' . $ingr->nom . '</option>';
                        }
                        ?>
                    </select>
                </div>

                <div class="columns">
                    <div class="pb15 row norepeat">
                        <div class="large-2 medium-2 small-6 columns">
                            <span class="help-text">ex: 120</span>
                        </div>
                        <div class="large-3 medium-3 small-6 columns">
                            <span class="help-text">grammes (gr)</span>
                        </div>
                        <div class="large-7 medium-7 small-10 columns">
                            <span class="help-text">de farine</span>
                        </div>
                    </div>
                </div>

                <div class="large-1 medium-1 small-2 columns">
                    <a href="#" class="button bg-light-gray small icon-cross circle delete repeator-delete"></a>
                </div>
            </div>
            <button type="button" class="btn btn-primary">Modifier l'un ingredient</button>

        </div>


        <label for="tags">Tags :</label>
        <input type="text" id="tags" name="tags" required>

        <input type="submit" value="Ajouter">
    </form>
</section>
<?php }

    public function createRecette($titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
    {
        if ($this->gdb == null) $this->gdb = new recette();
        $this->gdb->create_recette($titre, $description, $imgFile, $ingredients,$tag);
        header('location: recettes.php');
        exit();
    }

    public function editRecette($id, $titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
    {

        $this->gdb->edit_recette($id, $titre, $description, $imgFile, $ingredients, $tag);
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