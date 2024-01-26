<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Vehicle.php';

try {
    $title = "Détails du Véhicule";

    $selectedVehicle = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT));
    $vehicle = Vehicle::get($selectedVehicle);

    $category = Category::getById($vehicle->id_category);

} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../views/templates/front/header.php';
include_once __DIR__.'/../views/templates/front/navbar.php';
include_once __DIR__.'/../views/front/vehicles/details.php';
include_once __DIR__.'/../views/templates/front/footer.php';
?>