<?php
require_once __DIR__ . '/../../dashboard/config/init.php';
require_once __DIR__ . '/../helpers/Database.php';
require_once __DIR__ . '/Rent.php';

class Client{

    private ?int $id_client;
    private string $lastname;
    private string $firstname;
    private string $email;
    private string $birthday;
    private string $phone;
    private string $city;
    private string $zipcode;
    private ?string $created_at;
    private ?string $updated_at;

    public function __construct(
        int $id_client = 0,
        string $lastname = '',
        string $firstname = '',
        string $email = '',
        string $birthday = '',
        string $phone = '',
        string $city = '',
        string $zipcode = '',
        string $created_at = null,
        string $updated_at = null) {

            $this->id_client = $id_client;
            $this->lastname = $lastname;
            $this->firstname = $firstname;
            $this->email = $email;
            $this->birthday = $birthday;
            $this->phone = $phone;
            $this->city = $city;
            $this->zipcode = $zipcode;
            $this->created_at = $created_at;
            $this->updated_at = $updated_at;
        }

    public function setIdClient(?int $id_client){
        $this->id_client = $id_client;
    }
    public function getIdClient(): ?int{
        return $this->id_client;
    }

    public function setLastname(string $lastname){
        $this->lastname = $lastname;
    }
    public function getLastname(): string{
        return $this->lastname;
    }

    public function setFirstname(string $firstname){
        $this->firstname = $firstname;
    }
    public function getFirstname(): string{
        return $this->firstname;
    }

    public function setEmail(string $email){
        $this->email = $email;
    }
    public function getEmail(): string{
        return $this->email;
    }

    public function setBirthday(string $birthday){
        $this->birthday = $birthday;
    }
    public function getBirthday(): string{
        return $this->birthday;
    }

    public function setPhone(string $phone){
        $this->phone = $phone;
    }
    public function getPhone(): string{
        return $this->phone;
    }

    public function setCity(?string $city){
        $this->city = $city;
    }
    public function getCity(): ?string{
        return $this->city;
    }

    public function setZipcode(?string $zipcode){
        $this->zipcode = $zipcode;
    }
    public function getZipcode(): ?string{
        return $this->zipcode;
    }

    public function setCreatedAt(?string $created_at){
        $this->created_at = $created_at;
    }
    public function getCreatedAt(): ?string{
        return $this->created_at;
    }

    public function setUpdatedAt(?string $updated_at){
        $this->updated_at = $updated_at;
    }
    public function getUpdatedAt(): ?string{
        return $this->updated_at;
    }

    public function insert(): bool{
        // Connexion BDD et envoi
        $pdo = Database::connect();
        // Requête d'insertion
        $sql = "INSERT INTO `clients`(`lastname`, `firstname`, `email`, `birthday`, `phone`, `city`, `zipcode`)
                VALUES(
                :lastname, 
                :firstname, 
                :email, 
                :birthday, 
                :phone, 
                :city,
                :zipcode
                );";

        // Préparation de la requête
        $sth = $pdo->prepare($sql); //prepare() = permet d'eviter les injections SQL / sth = statement handle
        $sth->bindValue(':lastname', $this->getLastname());
        $sth->bindValue(':firstname', $this->getFirstname());
        $sth->bindValue(':email', $this->getEmail());
        $sth->bindValue(':birthday', $this->getBirthday());
        $sth->bindValue(':phone', $this->getPhone());
        $sth->bindValue(':city', $this->getCity());
        $sth->bindValue(':zipcode', $this->getZipcode());

        $result = $sth->execute();
        return $result;
    }
    
}