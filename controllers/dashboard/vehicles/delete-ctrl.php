<?php
// ! fichier init
require_once __DIR__ . '/../../../config/init.php';
require_once __DIR__ . '/../../../models/Vehicle.php';



    try {
        $vehicleId = intval(filter_input(INPUT_GET, 'id_vehicle', FILTER_SANITIZE_NUMBER_INT));
    
        // Vehicle::get($vehicleId);
    
        $isOk = Vehicle::delete($vehicleId);

        if (!$isOk) {
            echo "L'ID séléctionné n'éxiste pas";
        }
        if ($isOk) {
            // @unlink(__DIR__ . '/../../../public/uploads/vehicles/' . $picture);
            header('location: /controllers/dashboard/vehicles/list-ctrl.php');
            die;
        }
   } catch (Throwable $e) {
       echo "Erreur : " . $e->getMessage();
   }
   
include_once __DIR__.'/../../../views/templates/dashboard/header.php';
include_once __DIR__.'/../../../views/templates/dashboard/navbar.php';
include_once __DIR__.'/../../../views/templates/dashboard/footer.php';
?>
