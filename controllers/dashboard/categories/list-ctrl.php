<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';

try {
    $title = "Liste des catégories";
    $categories = Category::getAll();
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}

include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/dashboard/categories/list.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
