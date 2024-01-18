<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';


try {
    if (isset($_GET['id_vehicle'])) {
        $vehicleId = $_GET['id_vehicle'];

        $vehicleToDelete = new Vehicle('', '', '', 0, NULL, NULL, NULL, NULL, $vehicleId, NULL);
        $result = $vehicleToDelete->delete();

        if ($result !== false) {
            header('Location: /controllers/dashboard/vehicles/list-ctrl.php');
            exit();
        } else {
            echo "La suppression du véhicule a échoué.";
        }
    } else {
        echo "L'ID du véhicule n'est pas spécifié.";
    }
    } catch (Throwable $e) {
    echo "Erreur : " . $e->getMessage();
    }


include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
