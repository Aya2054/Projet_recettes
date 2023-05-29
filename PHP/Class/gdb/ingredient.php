<?php

namespace gdb;

use \pdo_wrapper\PdoWrapper;

include __DIR__ . "../../../Config/DB_config.php";

class ingredient extends PdoWrapper
{
    public const UPLOAD_DIR = "uploads/ingredients/";
    public $nom;
    public $quantite;
    public $unite;
    public $image;

    /**
     * @return mixed|null
     */
    public function getNom(): mixed
    {
        return $this->nom;
    }

    /**
     * @param mixed|null $nom
     */
    public function setNom(mixed $nom): void
    {
        $this->nom = $nom;
    }

    /**
     * @return mixed|null
     */
    public function getQuantite(): mixed
    {
        return $this->quantite;
    }

    /**
     * @param mixed|null $quantite
     */
    public function setQuantite(mixed $quantite): void
    {
        $this->quantite = $quantite;
    }

    /**
     * @return mixed|null
     */
    public function getUnite(): mixed
    {
        return $this->unite;
    }

    /**
     * @param mixed|null $unite
     */
    public function setUnite(mixed $unite): void
    {
        $this->unite = $unite;
    }

    /**
     * @return mixed|null
     */
    public function getImage(): mixed
    {
        return $this->image;
    }

    /**
     * @param mixed|null $image
     */
    public function setImage(mixed $image): void
    {
        $this->image = $image;
    }

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

    // Fonction pour récupérer les ingrédients d'une recette à partir de la base de données
    function getIngredientsForRecette($recetteId)
    {
        // Effectuer une requête SQL pour récupérer les ingrédients associés à la recette
        $query = "SELECT * FROM recette_ingredient WHERE id_recette = :recetteId";
        $params = [
            'recetteId' => htmlspecialchars($recetteId)

        ];
        return $this->exec($query, $params);
    }


}