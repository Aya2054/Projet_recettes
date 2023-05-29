<?php

namespace gdb;

class Recherche
{
public function recherche(){?>
<section id="pageprincipal">
    <div class="centre">
        <h2>Bienvenue chez <span id="isa-total">ISA-Recettes</span></h2>
        <p>Découvrez des recettes simples et savoureuses sur notre site. Trouvez votre inspiration culinaire dès maintenant et ajoutez une touche de saveur à votre vie quotidienne.</p>
        <form method="post" class="form-inline" action="../pages/page_principale.php">
            <div class="input-group">
                <input type="text" name="search_query" placeholder="recettes, ingredients, tags......">
            </div>
        </form>
    </div>
</section>

<?php }
}