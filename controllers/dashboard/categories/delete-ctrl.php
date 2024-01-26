<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';


try {
     $categoryId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

    //  Category::getById($categoryId);
 
     $isOk = Category::delete($categoryId);
 
     if ($isOk) {
         header('location: /controllers/dashboard/categories/list-ctrl.php');
         die;
     }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
