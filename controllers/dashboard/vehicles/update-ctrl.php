<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';


try {
    $title = "Modifier Véhicule";
    // Récupérer l'ID du véhicule depuis les paramètres de l'URL
    if (isset($_GET['id_vehicle'])) {
        $vehicleId = $_GET['id_vehicle'];

        // Récupérer les détails du véhicule à partir de l'ID
        $vehicleDetails = Vehicle::get($vehicleId);

        if (!$vehicleDetails) {
            // Gérer le cas où le véhicule avec cet ID n'existe pas
            echo "Le véhicule avec l'ID spécifié n'existe pas.";
            exit();
        }

        // Récupérer toutes les catégories
        $categories = Category::getAll();
    } else {
        // Gérer le cas où l'ID n'est pas spécifié dans l'URL
        echo "L'ID du véhicule n'est pas spécifié.";
        exit();
    }

    // Traitement du formulaire de modification si soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        // Récupérer les nouvelles valeurs du formulaire
        $newBrand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS);
        $newModel = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_SPECIAL_CHARS);
        $newRegistration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_SPECIAL_CHARS);
        $newMileage = filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_SPECIAL_CHARS);
        $newPicture = filter_input(INPUT_POST, 'picture', FILTER_SANITIZE_SPECIAL_CHARS);
        $newCategoryId = filter_input(INPUT_POST, 'id_category', FILTER_VALIDATE_INT);

        // Récupérer le nom de fichier existant s'il n'y a pas de nouveau fichier téléchargé
        $existingPicture = $vehicleDetails->picture;

        // Vérifier s'il y a un nouveau fichier téléchargé
        if (isset($_FILES['picture']['name']) && $_FILES['picture']['name'] !== '') {
            // Un nouveau fichier a été téléchargé, utiliser le nouveau nom de fichier
            $newPicture = $_FILES['picture']['name'];

            // Ajouter le code pour gérer l'upload du fichier, par exemple :
            // move_uploaded_file($_FILES['picture']['tmp_name'], 'chemin/vers/dossier/upload/' . $newPicture);
        } else {
            // Aucun nouveau fichier téléchargé, conserver le nom de fichier existant
            $newPicture = $existingPicture;
        }

            // Mettre à jour le véhicule dans la base de données
            $vehicleToUpdate = new Vehicle($newBrand, $newModel, $newRegistration, $newMileage, $newPicture, NULL, NULL, NULL, $vehicleId, $newCategoryId);

        $result = $vehicleToUpdate->update();

        if ($result !== false) {
            // Rediriger vers la liste des véhicules ou afficher un message de succès
            header('Location: /controllers/dashboard/vehicles/list-ctrl.php');
            exit();
        } else {
            // Afficher un message d'erreur si la mise à jour a échoué
            echo "La mise à jour du véhicule a échoué.";
        }
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/dashboard/vehicles/update.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
