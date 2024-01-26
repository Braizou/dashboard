
<div class="container mt-5 col-md-8">
    <a href="/controllers/dashboard/vehicles/add-ctrl.php"><button type="button" class="btn btn-primary">Ajouter un Véhicule</button></a>
    <h1>Liste des <?= $total_vehicles ?> Véhicules</h1>
<table class="table table-striped">
        <thead>
            <tr>
                <th>Catégorie</th>
                <th>Marque</th>
                <th>Modèle</th>
                <th>Immatriculation</th>
                <th>Kilométrage</th>
                <th>Photo</th>
                <th>Modifier/Supprimer</th>
            </tr>
        </thead>    
        <tbody>
        <?php foreach ($vehicles as $vehicle): ?>
            <tr>
            <td><?= htmlspecialchars($vehicle->name) ?></td>
            <td><?= htmlspecialchars($vehicle->brand) ?></td>
            <td><?= htmlspecialchars($vehicle->model) ?></td>
            <td><?= htmlspecialchars($vehicle->registration) ?></td>
            <td><?= htmlspecialchars($vehicle->mileage) ?> KM</td>
            <td><img src="/public/uploads/vehicles/<?= $vehicle->picture ? $vehicle->picture : ''; ?>"class=" listImg" alt="Image du véhicule"></td>
            <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicle=<?=$vehicle->id_vehicle?>" class="btn btn-primary"><i class="bi bi-pencil-square"></i></a>
            <button type="button" class="btn btn-danger" onclick="confirmDeleteVehicle(<?= $vehicle->id_vehicle?>)"><i class="bi bi-trash3"></i></button></td>
            </tr> 
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    ?>
</div>

