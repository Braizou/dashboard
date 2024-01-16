<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Category.php';

try {
    $title = "Ajout de catégories";
    
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];
        $addedToDB = [];

        $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($name)) {
            $error['name'] = 'Veuillez renseigner une catégorie à ajouter.';
        } else {
            $isOk = filter_var($name, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
            if (!$isOk) {
                $error['name'] = 'La catégorie renseigné n\'est pas valide.';
            }
            if (empty($error)) {
                $category = new Category($name);
                $result = $category->insert();
                if($result){
                    $addedToDB['name'] = "Entrée insérée dans la table 'categories'";
                } else {
                    $errors['name'] = 'Erreur de serveur : la donnée n\'a pas été insérée';
                }
            }
        }
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}

include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/dashboard/categories/add.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
