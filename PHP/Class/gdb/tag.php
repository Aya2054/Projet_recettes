<?php

namespace gdb;

use pdo_wrapper\pdoWrapper;

class tag extends PdoWrapper
{
    public const UPLOAD_DIR = "uploads/";
    public $nom;

    public function __construct($nom=null)
    {
        // appel au constructeur de la classe mère
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']);

        $this->nom=$nom;
    }

    public function generer_auto()
    {
        return $this->exec(
            "SELECT * FROM tag ORDER BY nom",
            null,
            'gdb\tagRenderer');
    }

    //la fonction qui permet d'ajouter un nouveau tag
    public function create_tag($nom)
    {

        $nom = htmlspecialchars($nom);

        $query = 'INSERT INTO ingredients(nom) VALUES (:nom)';

        $params = [
            'nom' => htmlspecialchars($nom)
        ];

        return $this->exec($query, $params);
    }
    // Fonction pour récupérer les tags d'une recette à partir de la base de données
    function getTagsForRecette($recetteId)
    {
        // Effectuer une requête SQL pour récupérer les tags associés à la recette
        $query = "SELECT * FROM recette_tag WHERE id_recette = :recetteId";
        $params = [
            'recetteId' => htmlspecialchars($recetteId)
        ];

        return $this->exec($query, $params);
    }

}