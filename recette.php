<?php
class   Recettedb{
    const UPLOAD_DIR = "uploads_ingredient/";
    /**
     * @var mysqli
     */
    private $conn;

    function __construct() {
        $this->conn = new mysqli('localhost', 'root', '', 'isa_cuisine');
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
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


    // fonction qui permet d'ajouter une recette
    function ajouterRecette($titre, $description, $image) {
        $sql = "INSERT INTO recette (titre, description, image) VALUES ('$titre', '$description', '$image')";
        if ($this->conn->query($sql) === TRUE) {
            echo "Recette ajoutée avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" . $this->conn->error;
        }
    }

    // foncton qui permet de modifier une recette
    function modifierRecette($id_recette, $titre, $description, $image) {
        $sql = "UPDATE recette SET titre='$titre', description='$description', image='$image' WHERE id_recette=$id_recette";
        if ($this->conn->query($sql) === TRUE) {
            echo "Recette modifiée avec succès";
        } else {
            echo "Erreur : " . $sql . "<br>" . $this->conn->error;
        }
    }

    //La fonction listerRecettes récupère toutes les recettes stockées dans la table
    //recette de la base de données et les affiche sous la forme d'une liste.

    function listerRecettes() {
        $sql = "SELECT * FROM recette";
        $result = $this->conn->query($sql);
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                // j' affiche les informations de chaque recette en utilisant la fonction fetch_assoc().
                echo "ID: " . $row["id_recette"]. " - Titre: " . $row["titre"]. " - Description: " . $row["description"]. " - Image: " . $row["image"] . "<br>";
            }
        } else {
            echo "0 résultats";
        }
    }
    public function generer_auto_tag()
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