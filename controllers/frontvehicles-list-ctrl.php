<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Vehicle.php';

try {
    $title = "Liste des véhicules";
    $categories = Category::getAll();

    $selectedCategoryId = intval(filter_input(INPUT_GET, 'category', FILTER_SANITIZE_NUMBER_INT));
    $search = filter_input(INPUT_GET, 'search', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
    $nb_vehicles_per_page = 9;

    $total_vehicles = Vehicle::countVehicle($selectedCategoryId, $search);

    $nb_pages = ceil($total_vehicles / $nb_vehicles_per_page);

    $page = intval(filter_input(INPUT_GET, 'page', FILTER_SANITIZE_NUMBER_INT));
    if ($page <= 0 || ($page > $nb_pages)) {
        $page = 1;
    }

    $offset = ($page - 1) * $nb_vehicles_per_page;

    $vehicles = Vehicle::getAll(true, $nb_vehicles_per_page, $offset, $selectedCategoryId, $search);

    

} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../views/templates/front/header.php';
include_once __DIR__.'/../views/templates/front/navbar.php';
include_once __DIR__.'/../views/front/vehicles/list.php';
include_once __DIR__.'/../views/templates/front/footer.php';
?>