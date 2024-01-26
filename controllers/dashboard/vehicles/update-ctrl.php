<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';


try {
    $title = "Modifier Véhicule";
    // Récupérer l'ID du véhicule depuis les paramètres de l'URL
    $vehicleId = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT)); 

        // Récupérer les détails du véhicule à partir de l'ID
        $vehicleDetails = Vehicle::get($vehicleId);

        if (!$vehicleDetails) {
            // Gérer le cas où le véhicule avec cet ID n'existe pas
            echo "Le véhicule avec l'ID spécifié n'existe pas.";
            exit();
        }

        // Récupérer toutes les catégories
        $categories = Category::getAll();
    
    // Traitement du formulaire de modification si soumis
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $errors = [];
        // Récupérer les nouvelles valeurs du formulaire
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS); // nettoyage
        if (empty($brand)) {
            $errors['brand'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($brand, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
            if (!$isOk) {
                $errors['brand'] = 'La marque doit contenir 2 à 30 caractères alphabétiques et/ou numériques.';
            }
        }
        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_SPECIAL_CHARS); // nettoyage
        if (empty($model)) {
            $errors['model'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($model, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
            if (!$isOk) {
                $errors['model'] = 'Le modèle doit contenir 1 à 30 caractères alphabétiques et/ou numériques.';
            }
        }
        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_SPECIAL_CHARS); // nettoyage
        if (empty($registration)) {
            $error['registration'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($registration, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_REGISTRATION . '/')));
            if (!$isOk) {
                $error['registration'] = 'La plaque d\'immatriculation doit être de format AA-111-AA ou 1111-AA-11.';
            }
        }
        $mileage = intval(filter_input(INPUT_POST, 'mileage', FILTER_SANITIZE_NUMBER_INT)); // nettoyage
        if (empty($mileage)) {
            $error['mileage'] = 'Le champ ne peut pas être vide';
        } else {
            $isOk = filter_var($mileage, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MILEAGE . '/')));
            if (!$isOk || $isOk > 1500000) { // ne pas accepter un nombre de Kms > 1M5
                $error['mileage'] = 'Le nombre de kilomètres est invalide.';
            }
        }
        $id_category = intval(filter_input(INPUT_POST, 'id_category', FILTER_SANITIZE_NUMBER_INT));
        if (empty($id_category)) {
            $error['id_category'] = 'Le champ ne peut pas être vide.';
        } else {
            $categoriesId = array_column($categories, 'id_category'); // création d'un tableau contenant les ID pour vérifier qu'un ID entré par un utilisateur corresponde bien à l'un des ID qui existent dans notre BDD
            $isOk = in_array($id_category, $categoriesId); // réponds true si l'id correspond bien à l'un de nos ID existant dans la BDD => pas besoin de filtre de validation
            if (!$isOk) {
                $error['id_category'] = 'Erreur, le choix est invalide.';
            }
        }

        $picture = $vehicleDetails->picture;
        if (!empty($_FILES['picture']['name'])) { // si l'utilisateur rentre une image dans le formulaire
            try {
                @unlink(__DIR__ . '/../../../public/uploads/vehicles/' . $picture); // supprime l'image du disque si on la modifie par une autre
                if ($_FILES['picture']['error'] != 0) {
                    throw new Exception("Une erreur est survenue lors du transfert.");
                }
                if (!in_array($_FILES['picture']['type'], ARRAY_TYPES)) {
                    throw new Exception("Ce fichier n'est pas au bon format.");
                }
                if ($_FILES['picture']['size'] > UPLOAD_MAX_SIZE) {
                    throw new Exception("Ce fichier est trop volumineux.");
                }
                // Upload de l'image sur le serveur dans le bon dossier
                $from = $_FILES['picture']['tmp_name']; // chemin temporaire où a été déposée la photo
                $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION); // pathinfo_exrtensions pour récupérer l'extension du fichier uniquement (et pas en plus de ça le MIME etc)
                $picture = uniqid('img_') . '.' . $extension;
                $to = __DIR__ . '/../../../public/uploads/vehicles/' . $picture;
                move_uploaded_file($from, $to);
                // $picture = $filename; // pour n'envoyer en BDD que le nom du fichier et pas le chemin (important sinon on reçoit NULL en BDD)
            } catch (\Throwable $th) {
                $error['picture'] = $th->getMessage();
            }
        }

            // Mettre à jour le véhicule dans la base de données
            $vehicleToUpdate = new Vehicle($brand, $model, $registration, $mileage, $picture, NULL, NULL, NULL, $vehicleId, $id_category);

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
