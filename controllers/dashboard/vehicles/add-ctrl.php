<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';

try {
    $title = "Ajout de véhicules";
    $categories = Category::getAll();

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];
    
        $brand = filter_input(INPUT_POST, 'brand', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($brand)) {
            $errors['brand'] = 'Vous devez renseigner une marque.';
        } else {
            $isOk = filter_var($brand, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
            if (!$isOk) {
                $errors['brand'] = 'Votre saisie contient des caractères non autorisés';
            }
        }

        $model = filter_input(INPUT_POST, 'model', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($model)) {
            $errors['model'] = 'Vous devez renseigner un modèle.';
        } else {
            $isOk = filter_var($model, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_CATEGORY . '/')));
            if (!$isOk) {
                $errors['model'] = 'Votre saisie contient des caractères non autorisés';
            }
        }

        $registration = filter_input(INPUT_POST, 'registration', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($registration)) {
            $errors['registration'] = 'Vous devez renseigner une immatriculation.';
        } else {
            $isOk = filter_var($registration, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_REGISTRATION . '/')));
            if (!$isOk) {
                $errors['registration'] = 'L\'immatriculation doit être au format XX-XXX-XX';
            }
        }

        $mileage = filter_input(INPUT_POST, 'mileage', FILTER_VALIDATE_INT);
        if (empty($mileage)) {
            $errors['mileage'] = 'Vous devez renseigner un kilométrage.';
        } else {
            $isOk = filter_var($mileage, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MILEAGE . '/')));
            if (!$isOk) {
                $errors['mileage'] = 'Votre saisie contient des caractères non autorisés';
            }
        }   

        $picture = null;
        if (isset($_FILES['picture']) && ($_FILES['picture']['size'] != 0)) {
            try {
                if (!isset($_FILES['picture'])) {
                    throw new Exception("Le champ picture n'existe pas.");
                }
                if ($_FILES['picture']['error'] != 0) {
                    throw new Exception("Une erreur est survenue lors du transfert.");
                }
                if (!in_array($_FILES['picture']['type'], ARRAY_TYPES)) {
                    throw new Exception("Ce fichier n'est pas au bon format.");
                }
                if ($_FILES['picture']['size'] > ARRAY_TYPES) {
                    throw new Exception("Ce fichier est trop volumineux.");
                }
                // Upload de l'image sur le serveur dans le bon dossier
                $from = $_FILES['picture']['tmp_name'];
                $extension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
                $filename = uniqid('img_') . '.' . $extension;
                $to = __DIR__ . '/../../../public/uploads/vehicles/' . $filename;
                move_uploaded_file($from, $to);
                $picture = $filename; // pour n'envoyer en BDD que le nom du fichier et pas le chemin (important sinon on reçoit NULL en BDD)
            } catch (\Throwable $th) {
                $error['picture'] = $th->getMessage();
            }
        }

       
        $id_category = filter_input(INPUT_POST, 'id_category', FILTER_VALIDATE_INT);
        if (empty($id_category)) {
            $errors['id_category'] = 'Vous devez sélèctionner un ID valable.';
        } else {
            $isOk = filter_var($id_category, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_MILEAGE . '/')));
            if (!$isOk) {
                $errors['id_category'] = 'Votre saisie contient des caractères non autorisés';
            }
        }

        // Si pas d'erreur, créer une instance de Vehicle et effectuer l'insertion
        if (empty($errors)) {
            $vehicle = new Vehicle($brand, $model, $registration, $mileage, $picture,NULL,NULL,NULL,NULL, $id_category);
            $result = $vehicle->insert();

            if ($result) {
                $successes['add'] = "Véhicule ajouté avec succès.";
            } else {
                $errors['add'] = 'Erreur de serveur : le véhicule n\'a pas été ajouté.';
            }
        }
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}

include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/dashboard/vehicles/add.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>