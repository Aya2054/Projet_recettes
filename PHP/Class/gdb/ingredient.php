<?php

namespace gdb;

use \pdo_wrapper\PdoWrapper;

include __DIR__ . "../../../Config/DB_config.php";

class ingredient extends PdoWrapper
{
    public const UPLOAD_DIR = "uploads_ingredient/";

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

    //la fonction qui permet de generer automatiquement les ingredients
    public function generer_auto()
    {
        return $this->exec(
            "SELECT * FROM ingredients ORDER BY nom",
            null,
            'gdb\ingrRenderer');
    }


    //la fonction qui permet d'ajouter un nouveau ingredient
    public function create_ingredient($nom, $imgFile = null)
    {

        $nom = htmlspecialchars($nom);

        $imgName = null;
        // enregistrement du fichier uploadé
        if ($imgFile != null) {
            $tmpName = $imgFile['tmp_name'];
            $imgName = $imgFile['name'];
            $imgName = urlencode(htmlspecialchars($imgName));

            $dirname = $GLOBALS['PHP_DIR'] . self::UPLOAD_DIR;
            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
        } else echo "NO IMAGE !!!!";

        $query = 'INSERT INTO ingredients(nom, image) VALUES (:nom, :image)';
        $params = [
            'nom' => htmlspecialchars($nom),
            'image' => $imgName
        ];
        return $this->exec($query, $params);
    }

}