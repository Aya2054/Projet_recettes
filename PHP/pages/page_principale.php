<?php
session_start() ;
    $logged = isset($_SESSION['nickname']) ;
    include "../Config/config.php";

    require ".." . DIRECTORY_SEPARATOR .'class'.DIRECTORY_SEPARATOR.'Autoloader.php' ;
    Autoloader::register();
    use gdb\Recette;
    $gdb = new Recette();
    $rech = new \gdb\Recherche();


    ?>

    <!-- Démarre le buffering -->
    <?php ob_start() ?>



    <?php
    // cette fonction qui permet d'afficher le formulaire de recherche est definie dans la Classe Recherche
    $rech->recherche();

    $searchQuery= $_POST['search_query'];
    $data = $gdb->getRecetteByName($searchQuery);
    $data1=  $gdb->getRecetteByIgredient($searchQuery);
    $data2=  $gdb->getRecetteByTag($searchQuery);

            // Afficher les résultats
            if (!empty($data)) {
                // Parcourir les résultats de la recherche
                foreach ($data as $recette) {
                 $result = $gdb->getRecetteById1($recette->getIdRecette());
                    foreach ( $result as $resul) {
                        $resul->getHTML();
                    }
                }
            }
            elseif (!empty($data1)){
                // Parcourir les résultats de la recherche
                foreach ($data1 as $recette) {
                    $result = $gdb->getRecetteById1($recette->getIdRecette());
                    foreach ( $result as $resul) {
                        $resul->getHTML();
                    }
                }
            }
            elseif (!empty($data2)){
                // Parcourir les résultats de la recherche
                foreach ($data2 as $recette) {
                    $result = $gdb->getRecetteById1($recette->getIdRecette());
                    foreach ( $result as $resul) {
                        $resul->getHTML();
                    }
                }
            }
            else {
                echo "Aucune recette trouvée.";
            }
            ?>

        <!-- Récupère le contenu du buffer (et le vide) -->
    <?php $content=ob_get_clean() ?>
        <!-- Utilisation du contenu bufferisé -->
    <?php Template::render($content) ?>