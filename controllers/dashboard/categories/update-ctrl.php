<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';


try {
    $title = "Modifier Catégorie";
    
    // Récupérer l'ID de la catégorie depuis les paramètres de l'URL
    $categoryId = intval(filter_input(INPUT_GET, 'id', FILTER_SANITIZE_NUMBER_INT));

        // Récupérer les détails de la catégorie à partir de l'ID
        $categoryDetails = Category::getById($categoryId);

        if (!$categoryDetails) {
            // Gérer le cas où la catégorie avec cet ID n'existe pas
            $errors['name'] = "La catégorie avec l'ID spécifié n'existe pas.";
            
        }
    
    // Traitement du formulaire de modification si soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        $successes = [];
        // Récupérer les nouvelles valeurs du formulaire
        $newName = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        // Valider les nouvelles valeurs si nécessaire
        $isOk = filter_var($newName, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
        if (!$isOk) {
            $errors['name'] = "La catégorie renseignée n'est pas valide.";
        }
        // Mettre à jour la catégorie dans la base de données
        $categoryToUpdate = new Category($newName, $categoryId);
        $result = $categoryToUpdate->update();
        
        if ($result !== false) {
            // Rediriger vers la liste des catégories ou afficher un message de succès
            header('Location: /controllers/dashboard/categories/list-ctrl.php');
            exit();
            // $successes['name'] = "La mise à jour de la catégorie a bien été prise en compte.";
        } else {
            // Afficher un message d'erreur si la mise à jour a échoué
            $errors['name'] = "La mise à jour de la catégorie a échoué.";
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
