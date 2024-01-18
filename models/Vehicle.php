<?php
require_once __DIR__ . '/../../dashboard/config/init.php';
require_once __DIR__ . '/../helpers/Database.php';
require_once __DIR__ . '/Category.php';

// ! création de la classe
class Vehicle{

    private ?int $id_vehicle;
    private string $brand;
    private string $model;
    private string $registration;
    private int $mileage;
    private ?string $picture;
    private ?string $created_at;
    private ?string $updated_at;
    private ?string $deleted_at;
    private ?int $id_category;

    // Méthode magique construct
    public function __construct(
        string $brand = '',
        string $model = '',
        string $registration = '',
        int $mileage = 0,
        string $picture = null,
        string $created_at = null,
        string $updated_at = null,
        string $deleted_at = null,
        int $id_vehicle = null,
        int $id_category = null) {

            $this->id_category = $id_category;
            $this->id_vehicle = $id_vehicle;
            $this->brand = $brand;
            $this->model = $model;
            $this->registration = $registration;
            $this->mileage = $mileage;
            $this->picture = $picture;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
            $this->deleted_at = $deleted_at;
        }

    // $id_vehicles
    public function setIdVehicle(?int $id_vehicle){
        $this->id_vehicle = $id_vehicle;
    }
    public function getIdVehicle(): ?int{
        return $this->id_vehicle;
    }

    // $brand
    public function setBrand(string $brand){
        $this->brand = $brand;
    }
    public function getBrand(): string{
        return $this->brand;
    }

    // $model
    public function setModel(string $model){
        $this->model = $model;
    }
    public function getModel(): string{
        return $this->model;
    }

    // $registration
    public function setRegistration(string $registration){
        $this->registration = $registration;
    }
    public function getRegistration(): string{
        return $this->registration;
    }

    // $mileage
    public function setMileage(int $mileage){
        $this->mileage = $mileage;
    }
    public function getMileage(): int{
        return $this->mileage;
    }

    // $picture
    public function setPicture(?string $picture){
        $this->picture = $picture;
    }
    public function getPicture(): ?string{
        return $this->picture;
    }

    // created_at
    public function setCreatedAt(?string $created_at){
        $this->created_at = $created_at;
    }
    public function getCreatedAt(): ?string{
        return $this->created_at;
    }

    // updated_at
    public function setUpdatedAt(?string $updated_at){
        $this->updated_at = $updated_at;
    }
    public function getUpdatedAt(): ?string{
        return $this->updated_at;
    }

    // deleted_at
    public function setDeletedAt(?string $deleted_at){
        $this->deleted_at = $deleted_at;
    }
    public function getDeletedAt(): ?string{
        return $this->deleted_at;
    }

    // id_category
    public function setIdCategory(int $id_category){
        $this->id_category = $id_category;
    }
    public function getIdCategory(): int{
        return $this->id_category;
    }

    // INSERT BDD
    public function insert(): bool{
        // Connexion BDD et envoi
        $pdo = Database::connect();
        // Requête d'insertion
        $sql = "INSERT INTO `vehicles`(`brand`, `model`, `registration`, `mileage`, `picture`, `id_category`)
                VALUES(:vehicleBrand, 
                :vehicleModel, 
                :vehicleRegistration, 
                :vehicleMileage, 
                :vehiclePicture, 
                :id_category);";

        // Préparation de la requête
        $sth = $pdo->prepare($sql); //prepare() = permet d'eviter les injections SQL / sth = statement handle
        $sth->bindValue(':vehicleBrand', $this->getBrand());
        $sth->bindValue(':vehicleModel', $this->getModel());
        $sth->bindValue(':vehicleRegistration', $this->getRegistration());
        $sth->bindValue(':vehicleMileage', $this->getMileage(), PDO::PARAM_INT);
        $sth->bindValue(':vehiclePicture', $this->getPicture());
        $sth->bindValue(':id_category', $this->getIdCategory(), PDO::PARAM_INT);

        $result = $sth->execute();
        return $result;

    }

    // GETALL
    public static function getAll(): array|false
    {
        $pdo = Database::connect();

        $sql = 'SELECT * FROM `vehicles` INNER JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category`
        ORDER BY `categories`.`name`;';

        $sth = $pdo->query($sql);

        $result = $sth->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }

    // GET
    // Récupère toutes les colonnes de la table 'vehicles' en fonction de l'id du véhicule
    public static function get(int $id): object | false {
        $pdo = Database::connect();
        $sql = 'SELECT *
                FROM `vehicles`
                WHERE `id_vehicle` = :id_vehicle';

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_vehicle', $id, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ); // Va chercher la table et la retourne sous forme d'objet
        
        return $result;
    }

    // UPDATE
    // Modifier le nom du véhicule selon l'ID passé en URL
    public function update() {
        // Connexion à la base de données
        $pdo = Database::connect();
    
        // Requête SQL pour mettre à jour le véhicule
        $sql = "UPDATE `vehicles` SET
                `brand` = :brand,
                `model` = :model,
                `registration` = :registration,
                `mileage` = :mileage,
                `picture` = :picture,
                `id_category` = :id_category
                WHERE `id_vehicle` = :id_vehicle";
    
        // Préparation de la requête
        $sth = $pdo->prepare($sql);
    
        // Liaison des valeurs
        $sth->bindValue(':brand', $this->getBrand());
        $sth->bindValue(':model', $this->getModel());
        $sth->bindValue(':registration', $this->getRegistration());
        $sth->bindValue(':mileage', $this->getMileage());
        $sth->bindValue(':picture', $this->getPicture());
        $sth->bindValue(':id_category', $this->getIdCategory(), PDO::PARAM_INT);
        $sth->bindValue(':id_vehicle', $this->getIdVehicle(), PDO::PARAM_INT);
    
        // Exécution de la requête
        $result = $sth->execute();
    
        // Retour du résultat
        return $result;
    }
    public function delete() {
        $pdo = Database::connect();
    
        $sql = 'DELETE FROM vehicles WHERE id_vehicle = :id_vehicle';
    
        $sth = $pdo->prepare($sql);
    
        $sth->bindValue(':id_vehicle', $this->getIdVehicle());
    
        return $sth->execute();
    }   
    

}