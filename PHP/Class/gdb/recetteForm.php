<?php

namespace gdb;

use gdb\recette;


class recetteForm
{
    private $gdb;

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
                <input type="file" id="image-input" name="image" accept="image/*" required>
                <div id="preview-container">
                    <img id="preview-image" src="">
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
                                <option value="grammes">grammes (g)</option>
                                <option value="kilogrammes">kilogrammes (kg)</option>
                                <option value="litres">litres (l)</option>
                                <option value="millilitres">millilitres (ml)</option>
                                <option value="centilitres">centilitres (cl)</option>
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
                    <button type="button" class="btn btn-primary">Ajouter un ingredient</button>

                </div>


                <label for="tags">Tags :</label>
                <input type="text" id="tags" name="tags" required>

                <input type="submit" value="Ajouter">
            </form>
        </section>

        <script>
            document.addEventListener('DOMContentLoaded', function (){
                // prévisualisation de l'image
                const imageInput = document.getElementById('image-input');
                const previewImage = document.getElementById('preview-image');

                imageInput.addEventListener('change', function() {
                    const file = this.files[0];
                    const reader = new FileReader();

                    reader.addEventListener('load', function() {
                        previewImage.src = reader.result;
                    });

                    if (file) {
                        reader.readAsDataURL(file);
                    } else {
                        previewImage.src = "";
                    }
                });

                // vérification du formulaire
                let form = document.querySelector("form");
                let name = document.getElementById("title");

                form.addEventListener('submit', (ev => {
                    if (name.value == ""){
                        ev.preventDefault()
                        name.classList.add("error") ;
                    }
                }))

                name.addEventListener('keydown', (ev => {
                    name.classList.remove("error") ;
                })
                // Récupérer le bouton d'ajout d'ingrédient
                var addButton = document.querySelector("#divIngredients button");

                // Ajouter un gestionnaire d'événements click sur le bouton
                addButton.addEventListener("click", function() {
                    // Récupérer le parent div contenant tous les ingrédients
                    var parentDiv = document.querySelector("#divIngredients");

                    // Récupérer le premier élément de la liste d'ingrédients (à cloner)
                    var ingredientDiv = document.querySelector(".repeator-item");

                    // Cloner l'élément et ses enfants
                    var newIngredientDiv = ingredientDiv.cloneNode(true);

                    // Effacer les champs de saisie
                    newIngredientDiv.querySelectorAll("input, select").forEach(function(input) {
                        input.value = "";
                    });

                    // Ajouter le nouvel élément en tant qu'enfant du parent div
                    parentDiv.appendChild(newIngredientDiv);
                });
            })

        </script>
        <?php
    }

    public function createRecette($titre, $description = null, $imgFile = null, $ingredients = null, $tag=null)
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