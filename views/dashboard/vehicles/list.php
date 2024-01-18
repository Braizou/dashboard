
<div class="container mt-5">
    <a href="/controllers/dashboard/vehicles/add-ctrl.php"><button type="button" class="btn btn-primary">Ajouter un Véhicule</button></a>
    <h1>Liste des Véhicules</h1>
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
            <td><img src="/../../../public/uploads/vehicles/<?= $vehicle->picture ? $vehicle->picture : ''; ?>" alt="Image du véhicule"></td>
            <td><img src="<?=__DIR__ . '/../../../public/uploads/vehicles/'?><?= $vehicle->picture ? $vehicle->picture : ''; ?>" alt="Image du véhicule"></td>
            <td><a href="/controllers/dashboard/vehicles/update-ctrl.php?id_vehicle=<?=$vehicle->id_vehicle?>" class="btn btn-primary">Modifier</a>
            <button type="button" class="btn btn-danger" onclick="confirmDeleteVehicle(<?= $vehicle->id_vehicle?>)">Supprimer</button></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    ?>
</div>

