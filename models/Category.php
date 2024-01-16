<?php
require_once __DIR__ . '/../../dashboard/config/init.php';

class Category{
    // ATTRIBUTS
    protected ?int $id_category;
    protected string $name;

    // METHODES
    // CONSTRUCT
    public function __construct(string $name = '', ?int $id_category = null ){
        $this->id_category = $id_category;
        $this->name = $name;
    }

    // SETTERS / GETTERS
    // $name
    public function setName(string $name){
        $this->name = $name;
    }
    public function getName(): string{
        return $this->name;
    }

    // $idCategory
    public function setIdCategory(?int $id_category){
        $this->id_category = $id_category;
    }
    public function getIdCategory(): ?int{
        return $this->id_category;
    }

    public function insert(){
        $pdo = new PDO(DSN, USER, PASSWORD);

        $sql = 'INSERT INTO
        categories(name)
        VALUES
        (:name);'; // on utilise les marqueurs dans la classe PDO et non pas les variables (sécurité)

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':name', $this->getName());

        $sth->execute();

    }

    public static function getAll() {
        
            $pdo = new PDO(DSN, USER, PASSWORD);

            $sql = 'SELECT id_category, name FROM categories';

            $sth = $pdo->query($sql);

            $results = $sth->fetchAll(PDO::FETCH_OBJ);

            return $results;
        
    }

    public function update() {

        $pdo = new PDO(DSN, USER, PASSWORD);

        $sql = 'UPDATE categories SET name = :name WHERE id_category = :id';

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':name', $this->getName());
        $sth->bindValue(':id', $this->getIdCategory());

        $sth->execute();
    }

    public static function getById($id) {
        $pdo = new PDO(DSN, USER, PASSWORD);
        $sql = 'SELECT * FROM `categories` WHERE `id_category` = :id';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id', $id, PDO::PARAM_INT);    
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ);

            return $result;

    }

    public function delete() {
        try {
            $pdo = new PDO(DSN, USER, PASSWORD);
    
            $sql = 'DELETE FROM categories WHERE id_category = :id';
    
            $sth = $pdo->prepare($sql);
    
            $sth->bindValue(':id', $this->getIdCategory());
    
            return $sth->execute();
        } catch (PDOException $e) {
            // Gérer les erreurs PDO si nécessaire
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        }
    }
    
}




