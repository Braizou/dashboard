<div class="container mt-5">
<h1>Modifier une entrée</h1>
    <a href="/controllers/dashboard/vehicles/list-ctrl.php"><button type="button" class="btn btn-primary">Retour à la liste des véhicules</button></a>
    <h1>Modifier véhicule</h1>
    <form method="post" action="" enctype="multipart/form-data" novalidate>
                <div class="mb-3">
                    <label for="brand" class="form-label">Marque</label>
                    <input type="text" class="form-control" id="brand" name="brand"value="<?= isset($vehicleDetails->brand) ? htmlspecialchars($vehicleDetails->brand) : '' ?>" required >
                    <h4><?=$errors['brand'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Modèle</label>
                    <input type="text" class="form-control" id="model" name="model"value="<?= isset($vehicleDetails->model) ? htmlspecialchars($vehicleDetails->model) : '' ?>" required >
                    <h4><?=$errors['model'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="registration" class="form-label">Immatriculation</label>
                    <input type="text" class="form-control" id="registration" name="registration"value="<?= isset($vehicleDetails->registration) ? htmlspecialchars($vehicleDetails->registration) : '' ?>" required >
                    <h4><?=$errors['registration'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="mileage" class="form-label">Kilométrage</label>
                    <input type="number" class="form-control" id="mileage" name="mileage" value="<?= isset($vehicleDetails->mileage) ? htmlspecialchars($vehicleDetails->mileage) : '' ?>" required>
                    <h4><?=$errors['mileage'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Image</label>
                    <input type="file" class="form-control" id="picture" name="picture" >
                    <td><img src="/public/uploads/vehicles/<?= $vehicleDetails->picture ? $vehicleDetails->picture : ''; ?>"class=" listImg" alt="Image du véhicule"></td>

                    <h4><?=$errors['picture'] ?? ''?></h4>
                </div>
                
                <div class="mb-3">
                    <label for="id_category" class="form-label">Catégorie</label>
                    <select class="form-select" id="id_category" name="id_category" >
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id_category ?>"<?= ($category->id_category == $vehicleDetails->id_category) ? 'selected' : '' ?>><?= htmlspecialchars($category->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <h4><?=$errors['id_category'] ?? ''?></h4>
                </div>
                <button type="submit" class="btn btn-primary">Modifier</button>
                <h4><?=$errors['add'] ?? ''?></h4>
                <h4><?=$successes['add'] ?? ''?></h4>
    </form>
</div>