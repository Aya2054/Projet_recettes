<?php

namespace gdb;

use \pdo_wrapper\PdoWrapper;

include __DIR__ . "../../../Config/DB_config.php";

class Recette extends PdoWrapper
{

    public const UPLOAD_DIR = "uploads/recettes/";
    public const UPLOAD_DIR1 = "uploads/ingredients/";

    public function __construct()
    {
        // appel au constructeur de la classe mère
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']);
    }

    //la fonction qui permet de generer automatiquement toutes les recettes
    public function generer_auto()
    {
        return $this->exec(
            "SELECT * FROM recette ORDER BY titre",
            null,
            'gdb\recetteRenderer');
    }

    //la fonction qui permet d'afficher tous les unites
    public function unites()
    {
        return $this->exec(
            "SELECT * FROM recette_ingredient ORDER BY unite",
            null,
            'gdb\recetteForm');
    }
    public $id_recette;

    /**
     * @return mixed
     */
    public function getIdRecette()
    {
        return $this->id_recette;
    }

    public $titre;

    //la fonction qui permet de recuperer une recette utilisée dans details recettes
    public function getRecetteById($id) {
        $resultats= $this->exec("SELECT * FROM recette WHERE id_recette = '".$id."'",
                           null,
            'gdb\RecetteDetails');
        $recette=$resultats[0];
        return $recette;

    }

    //cette fonction est utilisée dans la recherche
    public function getRecetteById1($id) {
       return $this->exec("SELECT * FROM recette WHERE id_recette = '".$id."'",
            null,
            'gdb\RecetteRenderer');


    }
    //la fonction qui permet de recuperer recette par son nom
    public function getRecetteByName($nom) {
        return $this->exec("SELECT * FROM recette WHERE titre = '".$nom."'",
            null,
            'gdb\RecetteRenderer');


    }

    //la fonction qui permet de recuperer recette par l'un de ses ingredients
    public function getRecetteByIgredient($ingredient) {
        return $this->exec("SELECT r.* FROM recette r 
    INNER JOIN recette_ingredient ri ON r.id_recette = ri.id_recette 
    INNER JOIN ingredients i ON ri.id_ingredient = i.id_ingredient 
           WHERE i.nom = '".$ingredient."'",
            null,
            'gdb\RecetteRenderer');


    }

    //la fonction qui permet de recuperer recette par l'un de ses ingredients
    public function getRecetteByTag($tag) {
            return $this->exec("SELECT r.*
    FROM recette r
    INNER JOIN recette_tag rt ON r.id_recette = rt.id_recette
    INNER JOIN tag t ON rt.id_tag = t.id_tag
    WHERE t.nom ='".$tag."'",
            null,
            'gdb\RecetteRenderer');


    }

    //la fonction qui permet de recuperer recette par l'un de ses ingredients
    public function getIgredientsById($id_recette) {
        return $this->exec("SELECT i.*,ri.* FROM ingredients i 
    INNER JOIN recette_ingredient ri 
        ON ri.id_ingredient = i.id_ingredient 
           WHERE ri.id_recette ='".$id_recette."'",
            null,
            'gdb\RecetteRenderer');


    }
    //la fonction qui permet de recuperer recette par l'un de ses ingredients
    public function getTagsById($id_recette) {
        return $this->exec("SELECT t.*,rt.* FROM tag t 
    INNER JOIN recette_tag rt 
        ON rt.id_tag = t.id_tag 
           WHERE rt.id_recette ='".$id_recette."'",
            null,
            'gdb\RecetteRenderer');


    }





    //la fonction qui permet d'ajouter une nouvelle recette
    public function create_recette($title, $description = null, $imgFile = null, $ingredients = null, $tags = null)
    {

        $titre = htmlspecialchars($title);
        $description = htmlspecialchars($description);

        $imgName = null;
        // enregistrement du fichier uploadé
        if ($imgFile != null) {

            $tmpName = $imgFile['tmp_name'];
            //recuperer le nom d'origine
            $imgName = $imgFile['name'];
            $imgName = urlencode(htmlspecialchars($imgName));
            $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR;

            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE B22 nicolas NOT UPLOADED");
        } else echo "NO IMAGE !!!!";


        $query = 'INSERT INTO recette(titre, description, image) VALUES (:title, :description, :image)';
        $params = [
            'title' => htmlspecialchars($titre),
            'description' => htmlspecialchars($description),
            'image' => $imgName
        ];
        $this->exec($query, $params);


        if(!empty($ingredients)){
            //var_dump($titre);
            //recuperer l id de la recette q'on veut creer
            $id_recette = $this->exec(
                "SELECT id_recette FROM recette WHERE TITRE ='$titre'",
                null);

            if(!empty($ingredients)) {
                //pour affecter les ingredients à cette recette
                $this->recette_ingredients($id_recette, $ingredients);

            }

            if(!empty($tags)) {
                var_dump($tags);
                var_dump($_POST);
                //affecter les tags à cette recette
                $this->recette_tags($id_recette, $tags);
            }
        }

    }

    //ajouter des ingredients à une recette
    public function recette_ingredients($id_recette, $ingredients)
    {
        $i=0;

        foreach ($ingredients as $ingredient) {


            // Vérifier si l'ingrédient existe déjà dans la base de données
            $query = 'SELECT * FROM ingredients WHERE nom = :nom';
            $params = ['nom' => ($ingredient->getNom())];
            $result = $this->exec($query, $params);

            if (empty($result)) {
                // enregistrement du fichier uploadé
                if ($ingredient->image != null) {

                    $tmpNa = $ingredient->image['tmp_name'];
                    $tmpName= $tmpNa[$i]['image'];
                    //recuperer le nom d'origine
                    $imgNa = $ingredient->image['name'];
                    $imgName=$imgNa[$i]['image'];
                    //$imgName = urlencode(($imgName[0]));
                    $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR1;

                    if (!is_dir($dirname)) mkdir($dirname);
                    $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
                    if (!$uploaded) die("FILE B22 nicolas NOT UPLOADED");
                } else echo "NO IMAGE !!!!";

                // L'ingrédient n'existe pas, l'ajouter à la table "ingredients"
                $imgNa = $ingredient->image['name'];
                $imgName=$imgNa[$i]['image'];
                $query = 'INSERT INTO ingredients (nom, image) VALUES (:nom, :image)';
                $params = [
                    'nom' => ($ingredient->nom),
                    'image' => $imgName
                ];

                $this->exec($query, $params);
            }
            $i++;
            if(is_array($id_recette)){
                $id_recette=$id_recette[0]->id_recette;
            }

            // Ajouter la relation entre la recette et l'ingrédient dans la table "recette_ingredient"
            $this->update($id_recette,$ingredient->quantite,$ingredient->unite,$ingredient->nom);

        }


    }


    public function update($id_recette,$quantite, $unite,$nom){

           // Ajouter la relation entre la recette et l'ingrédient dans la table "recette_ingredient"
                $query = 'INSERT INTO recette_ingredient (id_recette, id_ingredient,quantite, unite) VALUES (:id_recette, (SELECT id_ingredient FROM ingredients WHERE nom = :nom), :quantite, :unite)';
                $params = [
                    'id_recette' => $id_recette,
                    'nom' => $nom,
                    'quantite' => $quantite,
                    'unite' => $unite
                ];


            $this->exec($query, $params);
}

    //ajouter des tags à une recette
    public function recette_tags($id_recette, $tags)
    {
        //var_dump($tags);

        foreach ($tags as $tag) {
            // Vérifier si l'ingrédient existe déjà dans la base de données
            $query = 'SELECT id_tag FROM tag WHERE nom = :nom';
            $params = ['nom' => htmlspecialchars($tag->nom)];
            $result = $this->exec($query, $params);

            if (empty($result)) {
                // Le tag n'existe pas, l'ajouter à la table "tag"
                $query = 'INSERT INTO tag (nom) VALUES (:nom)';
                $params = ['nom' => htmlspecialchars($tag->nom)];

                $this->exec($query, $params);
            }
            if(is_array($id_recette)){
                $id_recette=$id_recette[0]->id_recette;
            }
            $this->update1($id_recette,$tag->nom);

        }
    }

    public function update1($id_recette,$nom){
        // Ajouter la relation entre la recette et le tag dans la table "recette_tag"

        $query = 'INSERT INTO recette_tag (id_recette, id_tag) VALUES (:id_recette, (SELECT id_tag FROM tag WHERE nom = :nom))';

        $params = [
            'id_recette' => $id_recette,
            'nom' => htmlspecialchars($nom)
        ];

        $this->exec($query, $params);

    }


    //la fonction qui permet d'editer une recette
    public function edit_recette($id, $title, $description = null, $imgFile = null, $ingredients = null, $tags = null)
    {
        $titre = htmlspecialchars($title);
        $description = htmlspecialchars($description);

        // Enregistrement de l'image uploadée
        $imgName = $this->uploadImage($imgFile);

        // Mise à jour des données de la recette
        $query = 'UPDATE recette SET titre = :title, description = :description, image = :image WHERE id_recette = :id';
        $params = [
            'title' => $titre,
            'description' => $description,
            'image' => $imgName,
            'id' => $id
        ];
        $this->exec($query, $params);

        // Suppression des anciens ingrédients de la recette
        $this->delete_recette_ingredients($id);

        // Affecter les nouveaux ingrédients à cette recette
        $this->recette_ingredients($id, $ingredients);

        // Suppression des anciens tags de la recette
        $this->delete_recette_tags($id);

        // Affecter les nouveaux tags à cette recette
        $this->recette_tags($id, $tags);
    }



    //la fonction qui permet de supprimer une recette
   /* public function delete_recette($id_recette)
    {
        // Supprimer les entrées correspondantes dans les tables de liaison
        $this->exec("DELETE FROM recette_ingredient WHERE id_recette = :id_recette", ['id_recette' => $id_recette]);
        $this->exec("DELETE FROM recette_tag WHERE id_recette = :id_recette", ['id_recette' => $id_recette]);

        // Supprimer l'entrée de la recette elle-même
        $this->exec("DELETE FROM recette WHERE id_recette = :id_recette", ['id_recette' => $id_recette]);
    }*/
    public function delete_recette($id_recette)
    {
        // Supprimer les entrées correspondantes dans les tables de liaison
        $this->delete_recette_ingredients($id_recette);
        $this->delete_recette_tags($id_recette);

        // Supprimer l'entrée de la recette elle-même
        $query = 'DELETE FROM recette WHERE id_recette = :id_recette';
        $params = [
            'id_recette' => $id_recette,
        ];
        $this->exec($query, $params);
    }

    //supprimer tous les ingrédients d'une recette
    public function delete_recette_ingredients($id)
    {
        $query = 'DELETE FROM recette_ingredient WHERE id_recette = :id';
        $params = [
            'id' => htmlspecialchars($id),
        ];
        $this->exec($query, $params);
    }

//supprimer tous les tags d'une recette
    public function delete_recette_tags($id)
    {

        $query = 'DELETE FROM recette_tag WHERE id_recette = :id';
        $params = [
            'id' => htmlspecialchars($id),
        ];
        $this->exec($query, $params);
    }



    // Fonction pour l'enregistrement de l'image uploadée
    private function uploadImage($imgFile)
    {
        if ($imgFile != null) {
            $tmpName = $imgFile['tmp_name'];
            $imgName = $imgFile['name'];
            $imgName = urlencode(htmlspecialchars($imgName));

            $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR;
            if (!is_dir($dirname)) {
                mkdir($dirname);
            }
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) {
                die("FILE NOT UPLOADED");
            }
            return $imgName;
        } else {
            echo "NO IMAGE !!!!";
            return null;
        }
    }


}