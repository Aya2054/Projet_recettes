<?php

namespace gdb;

use pdo_wrapper\pdoWrapper;
include __DIR__ . "../../../Config/DB_config.php";

class Test extends PdoWrapper
{

    public const UPLOAD_DIR = "uploads/recettes/";
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

    public function create_recette($title, $description = null, $imgFile = null)
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


        return $this->exec($query, $params);
    }
}