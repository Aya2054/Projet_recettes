<?php

/*class Recettedb {
    const UPLOAD_DIR = "uploads_ingredient/";

    /**
     * @var PDO
     */
    /*private $conn;

    function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=isa_cuisine", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function exec($statement, $params, $classname = null)
    {
        $res = $this->conn->prepare($statement);
        $res->execute($params) or die(print_r($res->errorInfo()));

        if ($classname != null) {
            //// Récupération de la réponse sous forme d'un tableau d'instances de classe
            $data = $res->fetchAll(PDO::FETCH_CLASS, $classname);
        } else {
            // Récupération de la réponse sous forme d'un tableau d'objets
            $data = $res->fetchAll(PDO::FETCH_OBJ);
        }

        return $data;
    }

    //la fonction qui permet de generer automatiquement les ingredients
    public function generer_auto()
    {
        return $this->exec(
            "SELECT * FROM ingredients ORDER BY nom",
            null,
            'gdb\ingrRenderer'
        );
    }

    //la fonction qui permet de creer unnouveau ingredient
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
        } else {
            echo "NO IMAGE !!!!";
        }

        $query = 'INSERT INTO ingredients(nom, image) VALUES (:nom, :image)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':image', $imgName);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }

    // fonction qui permet d'ajouter une recette
    /*function ajouterRecette($titre, $description, $image) {
        $stmt = $this->conn->prepare("INSERT INTO recette (titre, description, image) VALUES (:titre, :description, :image)");
        $stmt->bindParam(':titre', $titre);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':image', $image);
        $stmt->execute();
        echo "Recette ajoutée avec succès";
    }*/
   /* public function create_recette($title, $description = null, $imgFile = null, $ingredients = null, $tags = null) {
        // Code pour insérer la nouvelle recette dans la base de données ou effectuer toute autre action nécessaire
    
        // Exemple de code pour l'insertion en base de données avec PDO
        $db = new PDO("mysql:host=localhost;dbname=isa_cuisine", "root", "");
    
        // Préparation de la requête d'insertion
        $stmt = $db->prepare("INSERT INTO recettes (title, description, imgFile, ingredients, tags) VALUES (:title, :description, :imgFile, :ingredients, :tags)");
    
        // Liaison des paramètres
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':imgFile', $imgFile);
        $stmt->bindParam(':ingredients', $ingredients);
        $stmt->bindParam(':tags', $tags);
    
        // Exécution de la requête
        $stmt->execute();
    
        // Code supplémentaire si nécessaire, par exemple pour vérifier le succès de l'insertion
    
        // Retourner une valeur, un message ou effectuer toute autre action souhaitée
    }
    

    // foncton qui permet de modifier une recette
        // foncton qui permet de modifier une recette
        function modifierRecette($id_recette, $titre, $description, $image) {
            $stmt = $this->conn->prepare("UPDATE recette SET titre=:titre, description=:description, image=:image WHERE id_recette=:id_recette");
            $stmt->bindParam(':id_recette', $id_recette);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            echo "Recette modifiée avec succès";
        }
    
        // fonction qui permet de supprimer une recette
        function supprimerRecette($id_recette) {
            $stmt = $this->conn->prepare("DELETE FROM recette WHERE id_recette=:id_recette");
            $stmt->bindParam(':id_recette', $id_recette);
            $stmt->execute();
            echo "Recette supprimée avec succès";
        }

        
        // fonction qui permet de récupérer la liste des recettes
        function getRecettes() {
            $stmt = $this->conn->prepare("SELECT * FROM recette");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    
        // fonction qui permet de récupérer une recette à partir de son identifiant
        function getRecetteById($id_recette) {
            $stmt = $this->conn->prepare("SELECT * FROM recette WHERE id_recette=:id_recette");
            $stmt->bindParam(':id_recette', $id_recette);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        }
    }

    class RecetteDb {
    const UPLOAD_DIR = "uploads_ingredient/";

    /**
     * @var PDO
     */
    class RecetteDb {
        const UPLOAD_DIR = "uploads_ingredient/";
    
    private $conn;

    function __construct() {
        try {
            $this->conn = new PDO("mysql:host=localhost;dbname=isa_cuisine", "root", "");
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function exec($statement, $params, $classname = null) {
        $res = $this->conn->prepare($statement);
        $res->execute($params) or die(print_r($res->errorInfo()));

        if ($classname != null) {
            //// Récupération de la réponse sous forme d'un tableau d'instances de classe
            $data = $res->fetchAll(PDO::FETCH_CLASS, $classname);
        } else {
            // Récupération de la réponse sous forme d'un tableau d'objets
            $data = $res->fetchAll(PDO::FETCH_OBJ);
        }

        return $data;
    }


    //la fonction qui permet de generer automatiquement les ingredients
    public function generer_auto() {
        return $this->exec(
            "SELECT * FROM ingredients ORDER BY nom",
            null,
            'gdb\ingrRenderer'
        );
    }

    public function rechercherRecette($nom = null, $tag = null, $ingredient = null) {
        $params = array();
        $conditions = array();
    
        if ($nom != null) {
            $conditions[] = "titre LIKE :nom";
            $params[':nom'] = "%$nom%";
        }
    
        if ($tag != null) {
            $conditions[] = "tag = :tag";
            $params[':tag'] = $tag;
        }
    
        if ($ingredient != null) {
            // Rechercher les recettes contenant l'ingrédient spécifié
            
            $conditions[] = "list_ingredients LIKE :ingredient";
            $params[':ingredient'] = "%$ingredient%";
        }
    
        $query = "SELECT * FROM recette";
        if (!empty($conditions)) {
            $query .= " WHERE " . implode(" AND ", $conditions);
        }
    
        $stmt = $this->conn->prepare($query);
        $stmt->execute($params);
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
        return $results;
    }
    
    

    //la fonction qui permet de creer un nouveau ingredient
    public function create_ingredient($nom, $imgFile = null) {
        $nom = htmlspecialchars($nom);

        $imgName = null;
        // enregistrement du fichier uploadé
        if ($imgFile != null) {
            $tmpName = $imgFile['tmp_name'];
            $imgName = $imgFile['name'];
            $imgName = urlencode(htmlspecialchars($imgName));

            $dirname = self::UPLOAD_DIR;
            if (!is_dir($dirname)) mkdir($dirname);
            $uploaded = move_uploaded_file($tmpName, $dirname . $imgName);
            if (!$uploaded) die("FILE NOT UPLOADED");
        } else {
            echo "NO IMAGE !!!!";
        }

        $query = 'INSERT INTO ingredients(nom, image) VALUES (:nom, :image)';
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':nom', $nom);
        $stmt->bindParam(':image', $imgName);
        $stmt->execute();
        return $this->conn->lastInsertId();
    }
// foncton qui permet de modifier une recette
        // foncton qui permet de modifier une recette
        function modifierRecette($id_recette, $titre, $description, $image) {
            $stmt = $this->conn->prepare("UPDATE recette SET titre=:titre, description=:description, image=:image WHERE id_recette=:id_recette");
            $stmt->bindParam(':id_recette', $id_recette);
            $stmt->bindParam(':titre', $titre);
            $stmt->bindParam(':description', $description);
            $stmt->bindParam(':image', $image);
            $stmt->execute();
            echo "Recette modifiée avec succès";
        }


       

    // Vos autres fonctions et méthodes existantes...

    /*public function genere_recherche($title = null, $ingredient = null, $tag = null)
    {
        // Code SQL pour rechercher les recettes correspondantes
        // ...

        // Exemple de résultats fictifs
        $recettes = array(
            array(
                'titre' => 'Pizza Margherita',
                'description' => 'Une délicieuse pizza à la sauce tomate et au fromage mozzarella',
                'image' => 'pizza_margherita.jpg',
                'list_ingredients' => 'tomates, fromage mozzarella',
                'tag' => 'pizza'
            ),
            array(
                'titre' => 'Salade César',
                'description' => 'Une salade rafraîchissante avec de la laitue, des croûtons et du poulet grillé',
                'image' => 'salade_cesar.jpg',
                'list_ingredients' => 'laitue, croûtons, poulet',
                'tag' => 'salade'
            )
        );

        return $recettes;
    }*/




        // fonction qui permet de récupérer la liste des recettes
        function getRecettes() {
            $stmt = $this->conn->prepare("SELECT * FROM recette");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }
    // fonction qui permet d'ajouter une recette
    public function create_recette($title, $description = null, $imgFile = null, $ingredients = null, $tags = null) {
        // Code pour insérer la nouvelle recette dans la base de données ou effectuer toute autre action nécessaire
    
        // Préparation de la requête d'insertion
        $stmt = $this->conn->prepare("INSERT INTO recette (titre, image, description) VALUES (:title, :imgFile, :description)");
    
        // Liaison des paramètres
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':imgFile', $imgFile);
        $stmt->bindParam(':description', $description);
    
        // Exécution de la requête
        $stmt->execute();
    
        // Code supplémentaire si nécessaire, par exemple pour vérifier le succès de l'insertion
    
        // Retourner une valeur, un message ou effectuer toute autre action souhaitée
    }
    
    
}

    
    
