<?php
require_once __DIR__ . '/../../dashboard/config/init.php';
require_once __DIR__ . '/../helpers/Database.php';
require_once __DIR__ . '/Vehicle.php';
require_once __DIR__ . '/Client.php';

class Rent{

    private ?int $id_rent;
    private string $startDate;
    private string $endDate;
    private ?string $created_at;
    private ?string $confirmed_at;
    private ?int $id_vehicle;
    private ?int $id_client;

    public function __construct(
        int $id_rent = 0,
        string $startDate = '',
        string $endDate = '',
        string $created_at = null,
        string $confirmed_at = null,
        int $id_vehicle = null,
        int $id_client = null) {

            $this->id_rent = $id_rent;
            $this->startDate = $startDate;
            $this->endDate = $endDate;
            $this->created_at = $created_at;
            $this->confirmed_at = $confirmed_at;
            $this->id_vehicle = $id_vehicle;
            $this->id_client = $id_client;
        }

    public function setIdRent(?int $id_rent){
        $this->id_rent = $id_rent;
    }
    public function getIdRent(): ?int{
        return $this->id_rent;
    }

    public function setStartDate(string $startDate){
        $this->startDate = $startDate;
    }
    public function getStartDate(): string{
        return $this->startDate;
    }

    public function setEndDate(string $endDate){
        $this->endDate = $endDate;
    }
    public function getEndDate(): string{
        return $this->endDate;
    }
    public function setCreatedAt(?string $created_at){
        $this->created_at = $created_at;
    }
    public function getCreatedAt(): ?string{
        return $this->created_at;
    }

    public function setConfirmedAt(?string $confirmed_at){
        $this->confirmed_at = $confirmed_at;
    }
    public function getConfirmedAt(): ?string{
        return $this->confirmed_at;
    }

    public function setIdVehicle(?int $id_vehicle){
        $this->id_vehicle = $id_vehicle;
    }
    public function getIdVehicle(): ?int{
        return $this->id_vehicle;
    }

    public function setIdClient(int $id_client){
        $this->id_client = $id_client;
    }
    public function getIdClient(): int{
        return $this->id_client;
    }
    
    public function insert(): bool{
        $pdo = Database::connect();
        $sql = "INSERT INTO `rents`(`startDate`, `endDate`, `id_vehicle`, `id_client`)
                VALUES(
                :startDate, 
                :endDate, 
                :id_vehicle, 
                :id_client
                );";

       
        $sth = $pdo->prepare($sql); 
        $sth->bindValue(':startDate', $this->getStartDate());
        $sth->bindValue(':endDate', $this->getEndDate());
        $sth->bindValue(':id_vehicle', $this->getIdVehicle(), PDO::PARAM_INT);
        $sth->bindValue(':id_client', $this->getIdClient(), PDO::PARAM_INT);

        $result = $sth->execute();
        return $result;

    }
}