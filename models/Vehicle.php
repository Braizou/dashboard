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
    public static function getAll(bool $paginate = false, int $limit = null, int $offset = null, int $categoryId = 0, string $search = NULL): array|false
{
    $pdo = Database::connect();

    $sql = 'SELECT *
            FROM `vehicles`
            INNER JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category`';
    $sql .= ' WHERE 1 = 1 ';

    if ($categoryId !== 0) {
        $sql .= ' AND `categories`.`id_category` = :category_id';
    }

    if ($search !== NULL) {
        $sql .= ' AND (`brand` LIKE :search OR `model` LIKE :search)';
    }

    $sql .= ' ORDER BY `categories`.`name`';

    if ($paginate) {
        $sql .= ' LIMIT :limit OFFSET :offset';
    }

    $sth = $pdo->prepare($sql);

    if ($categoryId !== 0) {
        $sth->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    }

    if ($search !== NULL) {
        $sth->bindvalue(':search', "%$search%", PDO::PARAM_STR);  
    }

    if ($paginate) {
        $sth->bindValue(':limit', $limit, PDO::PARAM_INT);
        $sth->bindValue(':offset', $offset, PDO::PARAM_INT);
    }

    $sth->execute();

    $result = $sth->fetchAll(PDO::FETCH_OBJ);

    return $result;
}



public static function countVehicle(int $categoryId = 0, string $search = NULL): int
{
    $pdo = Database::connect();

    $sql = 'SELECT COUNT(*) AS count
            FROM `vehicles`
            INNER JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category`';
    $sql .= ' WHERE 1 = 1 ';

    if ($categoryId !== 0) {
        $sql .= ' AND `categories`.`id_category` = :category_id';
    }

    if ($search !== NULL) {
        $sql .= ' AND (`brand` LIKE :search OR `model` LIKE :search)';
    }

    $sth = $pdo->prepare($sql);

    if ($categoryId !== 0) {
        $sth->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
    }

    if ($search !== NULL) {
        $sth->bindvalue(':search', "%$search%", PDO::PARAM_STR);  // Modifié : ajout de % pour utiliser LIKE correctement
    }

    $sth->execute();

    $result = $sth->fetchColumn();

    return $result;
}

    

    // GET
    // Récupère toutes les colonnes de la table 'vehicles' en fonction de l'id du véhicule
    public static function get(int $vehicleId): object | false {
        $pdo = Database::connect();
        $sql = 'SELECT *
                FROM `vehicles`
                WHERE `id_vehicle` = :id_vehicle';

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_vehicle', $vehicleId, PDO::PARAM_INT);
        $sth->execute();
        $result = $sth->fetch(PDO::FETCH_OBJ); // Va chercher la table et la retourne sous forme d'objet
        
        return $result;
    }

    // UPDATE
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

    public static function delete($vehicleId): bool
    {
        $pdo = Database::connect();
        $sql = 'DELETE FROM `vehicles` WHERE `id_vehicle` = :id_vehicle;';
        $sth = $pdo->prepare($sql);
        $sth->bindValue(':id_vehicle', $vehicleId);
        $sth->execute();
        if ($sth->rowCount() <= 0) {
            return false;
        } else {
            return true;
        }
    }
    
    public static function isExist(string $registration): bool
    {
        $pdo = Database::connect();

        $sql = 'SELECT COUNT(`id_vehicle`) AS "count"
        FROM `vehicles`
        WHERE `registration` = :registration;'; // on compte le nbe de lignes identiques

        $sth = $pdo->prepare($sql);

        $sth->bindValue(':registration', $registration);

        $result = $sth->execute(); // retourne true ou false sur la bonne exécution de la requête

        $result = $sth->fetchColumn(); // on récupère la valeur retournée par le COUNT (si on obtient 0 c'est false sinon c'est true)

        return (bool) $result > 0; // donc retourne true si c'est supérieur à 0
    }

    public static function getByCategory(int $categoryId): array|false {
        $pdo = Database::connect();

        $sql = 'SELECT *
                FROM `vehicles`
                INNER JOIN `categories` ON `vehicles`.`id_category` = `categories`.`id_category`
                WHERE `categories`.`id_category` = :category_id
                ORDER BY `categories`.`name`';

        $sth = $pdo->prepare($sql);
        $sth->bindValue(':category_id', $categoryId, PDO::PARAM_INT);
        $sth->execute();

        $result = $sth->fetchAll(PDO::FETCH_OBJ);

        return $result;
    }   

    
}