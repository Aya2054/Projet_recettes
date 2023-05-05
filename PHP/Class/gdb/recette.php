<?php

namespace gdb;

use \pdo_wrapper\PdoWrapper;

include __DIR__ . "../../../Config/DB_config.php";

class recette extends PdoWrapper
{
    public const UPLOAD_DIR = "uploads_recette/";

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

    //la fonction qui permet d'afficher toutes les recettes qui contient les criteres donner par l'utilisateur
    //title, list_ingredients, tag
    public function genere_recherche($title = null, $list_ingredient = null, $tag = null)
    {

        return $this->exec("SELECT DISTINCT p.* FROM recette p
    INNER JOIN recette_list pi on p.id_recette=pi.id_recette 
    INNER JOIN listes i on pi.id_listes=i.id_ingredients 
    INNER JOIN plats_tag pt on p.id_recette=pt.id_tag
    INNER JOIN tags t on pt.id_tag=t.id_tag
    WHERE p.titre LIKE '$title' OR i.nom IN ' $list_ingredient' OR t.nom Like '$tag'",
            null, 'gdb\recetteRenderer');
    }


    //la fonction qui permet d'ajouter une nouvelle recette
    public function create_recette($title, $description = null, $imgFile = null, $ingredients = null, $tags = null)
    {

        $titre = htmlspecialchars($title);
        $description = htmlspecialchars($description);

        $imgName = null;
        // enregistrement du fichier uploadé
        if ($imgFile != null) {
            //recuperer le nom temporaire du fichier
            $tmpName = $imgFile['tmp_name'];
            //recuperer le nom d'origine
            $imgName = $imgFile['name'];
            //encoder le nom du fichier pour le proteger des caracteres speciaux
            $imgName = urlencode(htmlspecialchars($imgName));

            //preparer le repertoire qui doit contenir le fichier
            $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR;
            //si le repertoire n'est pas encore cree on doit le creer
            if (!is_dir($dirname)) mkdir($dirname);
            //deplacer le fichier dans le repertoire
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
        } else echo "NO IMAGE !!!!";

        $query = 'INSERT INTO recette(titre, description, image) VALUES (:title, :description, :image)';
        $params = [
            'title' => htmlspecialchars($titre),
            'description' => htmlspecialchars($description),
            'image' => $imgName
        ];

        if(!empty($ingredients) && !empty($tags)){
            //recuperer l id de la recette q'on veut creer
            $id_recette = $this->exec(
                "SELECT id_recette FROM recette WHERE TITRE ='$titre'",
                null);

            if(!empty($ingredients)) {
                //pour affecter les ingredients à cette recette
                $this->recette_ingredients($id_recette, $ingredients);
            }
            if(!empty($tags)) {
                //affecter les tags à cette recette
                $this->recette_tags($id_recette, $tags);
            }
        }


        return $this->exec($query, $params);
    }

    //ajouter des ingredients à une recette
    public function recette_ingredients($id_recette, $ingredients)
    {
        $query = 'INSERT INTO recette_ingredient (id_recette, id_ingredient) VALUES (:id_recette, :id_ingredient)';

        foreach ($ingredients as $i) {
            $params = [
                'id_recette' => htmlspecialchars($id_recette),
                'id_ingredient' => htmlspecialchars($i),
            ];

            $this->exec($query, $params);
        }
    }

    //ajouter des tags à une recette
    public function recette_tags($id_recette, $tags)
    {
        $query = 'INSERT INTO recette_tag (id_recette, id_tag) VALUES (:id_recette, :id_tag)';

        foreach ($tags as $tag) {
            $params = [
                'id_recette' => htmlspecialchars($id_recette),
                'id_ingredient' => htmlspecialchars($tag),
            ];

            $this->exec($query, $params);
        }
    }


    //la fonction qui permet d'editer une recette
    public function edit_recette($id, $title, $description = null, $imgFile = null, $ingredients = null, $tags = null)
    {

        $titre = htmlspecialchars($title);
        $description = htmlspecialchars($description);

        $imgName = null;
        // enregistrement du fichier uploadé
        if ($imgFile != null) {
            //recuperer le nom temporaire du fichier
            $tmpName = $imgFile['tmp_name'];
            //recuperer le nom d'origine
            $imgName = $imgFile['name'];
            //encoder le nom du fichier pour le proteger des caracteres speciaux
            $imgName = urlencode(htmlspecialchars($imgName));

            //preparer le repertoire qui doit contenir le fichier
            $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR;
            //si le repertoire n'est pas encore cree on doit le creer
            if (!is_dir($dirname)) mkdir($dirname);
            //deplacer le fichier dans le repertoire
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
        } else echo "NO IMAGE !!!!";

        //mise à jour des données de la recette
        $query = 'UPDATE recette SET titre = :title, description = :description, image = :image WHERE id_recette = :id';
        $params = [
            'title' => htmlspecialchars($titre),
            'description' => htmlspecialchars($description),
            'image' => $imgName,
            'id' => htmlspecialchars($id)
        ];

        $this->exec($query, $params);

        //suppression des anciens ingrédients de la recette
        $this->delete_recette_ingredients($id);

        //affecter les nouveaux ingredients à cette recette
        $this->recette_ingredients($id, $ingredients);

        //suppression des anciens tags de la recette
        $this->delete_recette_tags($id);

        //affecter les nouveaux tags à cette recette
        $this->recette_tags($id, $tags);
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


    //la fonction qui permet de supprimer une recette
    public function delete_recette($id_recette)
    {
        // Supprimer les entrées correspondantes dans les tables de liaison
        $this->exec("DELETE FROM recette_ingredient WHERE id_recette = :id_recette", ['id_recette' => $id_recette]);
        $this->exec("DELETE FROM recette_tag WHERE id_recette = :id_recette", ['id_recette' => $id_recette]);

        // Supprimer l'entrée de la recette elle-même
        $this->exec("DELETE FROM recette WHERE id_recette = :id_recette", ['id_recette' => $id_recette]);
    }


}