<div class="container mt-5">
<h1>Modifier une entrée</h1>
    <a href="/controllers/dashboard/vehicles/list-ctrl.php"><button type="button" class="btn btn-primary">Retour à la liste des véhicules</button></a>
    <h1>Modifier véhicule</h1>
    <form method="post" action="">
        <input type="text" name="brand" placeholder="ex: Nouvelle Marque" value="<?= isset($vehicleDetails->brand) ? htmlspecialchars($vehicleDetails->brand) : '' ?>" required>
        <input type="text" name="model" placeholder="ex: Nouveau Modèle" value="<?= isset($vehicleDetails->model) ? htmlspecialchars($vehicleDetails->model) : '' ?>" required>
        <input type="text" name="registration" placeholder="ex: Nvel Immatriculation" value="<?= isset($vehicleDetails->registration) ? htmlspecialchars($vehicleDetails->registration) : '' ?>" required>
        <input type="text" name="mileage" placeholder="ex: Nouveau KM" value="<?= isset($vehicleDetails->mileage) ? htmlspecialchars($vehicleDetails->mileage) : '' ?>" required>
        <input type="file" name="picture" placeholder="ex: Nvelle Photo" value="<?= isset($vehicleDetails->picture) ? ($vehicleDetails->picture) : '' ?>">

        <label for="id_category" class="form-label">Catégorie</label>
            <select class="form-select" id="id_category" name="id_category">
                <?php foreach ($categories as $category): ?>
                <option value="<?= $category->id_category ?>"><?= htmlspecialchars($category->name) ?></option>
                <?php endforeach; ?>
            </select>
        <button type="submit" class="btn btn-primary">Enregistrer la modification</button>
    </form>
</div>