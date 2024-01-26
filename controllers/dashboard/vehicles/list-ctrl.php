<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';

try {
    $title = "Liste des véhicules";
    $vehicles = Vehicle::getAll();
    $categories = Category::getAll();
    $total_vehicles = Vehicle::countVehicle(); 

} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/dashboard/vehicles/list.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
