



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
            const dataListHTML = `<datalist id="tag-list-${tags.length}">
            <?php
                $tag = new \gdb\tag();
                $tags = $tag->generer_auto();
                foreach ($tags as $t) {
                    echo '<option value="<?= $t->nom ?>">';
                }
            ?>
        </datalist>`;


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
