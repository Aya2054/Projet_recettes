<?php

namespace gdb;

class tag
{
    public const UPLOAD_DIR = "uploads/";

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

    public function generer_auto()
    {
        return $this->exec(
            "SELECT * FROM tag ORDER BY titre",
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

}