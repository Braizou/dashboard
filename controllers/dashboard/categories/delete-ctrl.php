<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';


try {
    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];

        $categoryToDelete = new Category('', $categoryId);
        $result = $categoryToDelete->delete();

        if ($result !== false) {
            header('Location: /controllers/dashboard/categories/list-ctrl.php');
            exit();
        } else {
            echo "La suppression de la catégorie a échoué.";
        }
    } else {
        echo "L'ID de la catégorie n'est pas spécifié.";
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
