<?php
require_once __DIR__ . '/../config/init.php';
require_once __DIR__ . '/../models/Vehicle.php';
require_once __DIR__ . '/../models/Client.php';


try {
    $title = "Réservation";
    $selectedVehicle = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT));
    $vehicle = Vehicle::get($selectedVehicle);
    $category = Category::getById($vehicle->id_category);

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $errors = [];

        $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($lastname)) {
            $errors['lastname'] = 'Vous devez renseigner un nom.';
        } else {
            $isOk = filter_var($lastname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
            if (!$isOk) {
                $errors['lastname'] = 'Votre saisie contient des caractères non autorisés';
            }
        }

        $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($firstname)) {
            $errors['firstname'] = 'Vous devez renseigner un prénom.';
        } else {
            $isOk = filter_var($firstname, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
            if (!$isOk) {
                $errors['firstname'] = 'Votre saisie contient des caractères non autorisés';
            }
        }

        $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
        if (empty($email)) {
            $errors['email'] = 'Vous devez renseigner une adresse mail.';
        } else {
            $isOk = filter_var($email, FILTER_VALIDATE_EMAIL);
            if (!$isOk) {
                $errors['email'] = 'L\'email doit être au format xxx@xxx.xx';
            }
        }

        $birthday = filter_input(INPUT_POST, 'birthday', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($birthday)) {
            $errors['birthday'] = 'Veuillez entrer une date de naissance.';
        } else {
            $dateObj = DateTime::createFromFormat('Y-m-d', $birthday);
            $minDate = new DateTime('-100 years');
            $maxDate = new DateTime('-18 years');

            if (!$dateObj || $dateObj < $minDate || $dateObj > $maxDate) {
                $errors['birthday'] = 'Veuillez entrer une date de naissance valide entre 18 et 100 ans.';
            }
        }


        $phone = filter_input(INPUT_POST, 'phone', FILTER_SANITIZE_NUMBER_INT);
        if (empty($phone)) {
            $errors['phone'] = 'Veuillez entrer un numéro de téléphone.';
        } else {
            $isOk = filter_var($phone, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_PHONE . '/')));
            if (!$isOk) {
                $errors['phone'] = 'Veuillez entrer un numéro de téléphone valide au format "0612131415"';
            }
        }

        $city = filter_input(INPUT_POST, 'city', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
        if (empty($city)) {
            $errors['city'] = 'Veuillez entrer le nom de votre commune.';
        } else {
            $isOk = filter_var($city, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_NAME . '/')));
            if (!$isOk) {
                $errors['city'] = 'Votre saisie contient des caractères non autorisés';
            }
        }

        $zipcode = filter_input(INPUT_POST, 'zipcode', FILTER_SANITIZE_NUMBER_INT);
        if (empty($zipcode)) {
            $errors['zipcode'] = 'Veuillez entrer un Code postal.';
        } else {
            $isOk = filter_var($zipcode, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => '/' . REGEX_POSTAL   . '/')));
            if (!$isOk) {
                $errors['zipcode'] = 'Le Code postal doit être composé uniquement de cinq chiffres.';
            }
        }

        $startDate = filter_input(INPUT_POST, 'startDate', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($startDate)) {
            $errors['startDate'] = 'Veuillez entrer une date de début.';
        } else {
            $startObj = DateTime::createFromFormat('Y-m-d\TH:i', $startDate);
            $today = new DateTime();

            if (!$startObj || $startObj < $today) {
                $errors['startDate'] = 'Veuillez entrer une date de début valide, au moins à partir d\'aujourd\'hui.';
            }
        }

        $endDate = filter_input(INPUT_POST, 'endDate', FILTER_SANITIZE_SPECIAL_CHARS);
        if (empty($endDate)) {
            $errors['endDate'] = 'Veuillez entrer une date de fin.';
        } else {
            $endObj = DateTime::createFromFormat('Y-m-d\TH:i', $endDate);

            if (!$endObj || $endObj <= $startObj) {
                $errors['endDate'] = 'Veuillez entrer une date de fin valide, ultérieure à la date de début.';
            }
        }

        if (empty($errors)) {
            $client = new Client(
                0,
                $lastname,
                $firstname,
                $email,
                $birthday,
                $phone,
                $city,
                $zipcode,
                null,
                null
            );
            
            $resultClient = $client->insert();
            var_dump($client);

            $rent = new Rent(0, $startDate, $endDate, null, null, $selectedVehicle);
            $resultRent = $rent->insert();

            if ($result) {
                $successes['add'] = "Réservation effectuée avec succès.";
            } else {
                $errors['add'] = 'Erreur de serveur : la réservation a echouée.';
            }
        }
    }
} catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
}


include_once __DIR__ . '/../views/templates/front/header.php';
include_once __DIR__ . '/../views/templates/front/navbar.php';
include_once __DIR__ . '/../views/front/vehicles/rent.php';
include_once __DIR__ . '/../views/templates/front/footer.php';
