<?php

namespace gdb;

use \pdo_wrapper\PdoWrapper;

include __DIR__ . "../../../Config/DB_config.php";

class ingredient extends PdoWrapper
{
    public const UPLOAD_DIR = "uploads/ingredients/";
    private $nom;
    private $quantite;
    private $unite;
    private $image;

    public function __construct($nom=null, $quantite=null, $unite=null, $image=null)
    {
        // appel au constructeur de la classe mère
        parent::__construct(
            $GLOBALS['db_name'],
            $GLOBALS['db_host'],
            $GLOBALS['db_port'],
            $GLOBALS['db_user'],
            $GLOBALS['db_pwd']);

        $this->nom=$nom;
        $this->quantite=$quantite;
        $this->unite=$unite;
        $this->image=$image;
    }


    //la fonction qui permet de generer automatiquement les ingredients
    public function generer_auto()
    {
        return $this->exec(
            "SELECT * FROM ingredients ORDER BY nom",
            null,
            'gdb\ingrRenderer');
    }

    //la fonction qui permet de retourner id d'un ingredient à partir de son nom
    public function getIngredientByName($nom) {
        return $this->exec("SELECT id_ingredient FROM ingredient WHERE nom = '".$nom."'",
            null);

    }


    //la fonction qui permet d'ajouter un nouveau ingredient
    public function create_ingredient($nom,$quantite, $merure, $imgFile = null)
    {

        $nom = htmlspecialchars($nom);
        $quantite= htmlspecialchars($quantite);
        $merure= htmlspecialchars($merure);

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

        $query = 'INSERT INTO ingredients(nom, quantite, mesure, image) VALUES (:nom, :quantite ,:mesure, :image)';
        $params = [
            'nom' => htmlspecialchars($nom),
            'quantite' => htmlspecialchars($quantite),
            'mesure' => htmlspecialchars($merure),
            'image' => $imgName

        ];
        return $this->exec($query, $params);
    }

}