<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';


try {
    // Récupérer l'ID de la catégorie depuis les paramètres de l'URL
    if (isset($_GET['id'])) {
        $categoryId = $_GET['id'];

        // Récupérer les détails de la catégorie à partir de l'ID
        $categoryDetails = Category::getById($categoryId);

        if (!$categoryDetails) {
            // Gérer le cas où la catégorie avec cet ID n'existe pas
            echo "La catégorie avec l'ID spécifié n'existe pas.";
            exit();
        }
    } else {
        // Gérer le cas où l'ID n'est pas spécifié dans l'URL
        echo "L'ID de la catégorie n'est pas spécifié.";
        exit();
    }

    // Traitement du formulaire de modification si soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les nouvelles valeurs du formulaire
        $newName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        // Valider les nouvelles valeurs si nécessaire

        // Mettre à jour la catégorie dans la base de données
        $categoryToUpdate = new Category($newName, $categoryId);
        $result = $categoryToUpdate->update();
        
        if ($result !== false) {
            // Rediriger vers la liste des catégories ou afficher un message de succès
            header('Location: /controllers/dashboard/categories/list-ctrl.php');
            exit();
        } else {
            // Afficher un message d'erreur si la mise à jour a échoué
            echo "La mise à jour de la catégorie a échoué.";
        }
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/dashboard/categories/update.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
