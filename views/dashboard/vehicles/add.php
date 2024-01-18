<div class="container">
    <div class="row">
        <div class="col py-3">
            <a href="/controllers/dashboard/vehicles/list-ctrl.php">
                <button type="button" class="btn btn-primary">Retour à la liste des véhicules</button>
            </a>
            <h1>Ajout de Véhicule</h1>

            <form method="post" action="" enctype="multipart/form-data" novalidate>
                <div class="mb-3">
                    <label for="brand" class="form-label">Marque</label>
                    <input type="text" class="form-control" id="brand" name="brand" >
                    <h4><?=$errors['brand'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="model" class="form-label">Modèle</label>
                    <input type="text" class="form-control" id="model" name="model" >
                    <h4><?=$errors['model'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="registration" class="form-label">Immatriculation</label>
                    <input type="text" class="form-control" id="registration" name="registration" >
                    <h4><?=$errors['registration'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="mileage" class="form-label">Kilométrage</label>
                    <input type="number" class="form-control" id="mileage" name="mileage" >
                    <h4><?=$errors['mileage'] ?? ''?></h4>
                </div>
                <div class="mb-3">
                    <label for="picture" class="form-label">Image</label>
                    <input type="file" class="form-control" id="picture" name="picture" >
                    <h4><?=$errors['picture'] ?? ''?></h4>
                </div>
                
                <div class="mb-3">
                    <label for="id_category" class="form-label">Catégorie</label>
                    <select class="form-select" id="id_category" name="id_category" >
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category->id_category ?>"><?= htmlspecialchars($category->name) ?></option>
                        <?php endforeach; ?>
                    </select>
                    <h4><?=$errors['id_category'] ?? ''?></h4>
                </div>
                <button type="submit" class="btn btn-primary">Ajouter</button>
                <h4><?=$errors['add'] ?? ''?></h4>
                <h4><?=$successes['add'] ?? ''?></h4>
        
            </form>
        </div>
    </div>
</div>
