<div class="container">
    <div class="row pt-5">
        <div class="col">
            <div class="hero-banner hero-banner-listing">
                <div class="filter">
                    <h1 class="">Louez en toute simplicité.</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="row mt-4">
        <div class="col col-md-6">
            <form class="d-flex" action="" method="get">
                <label for="category"></label>
                <select class="form-select" aria-label="Sélectionner une catégorie" name="category" id="category">
                    <option value="">Toutes les catégories</option>
                    <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id_category ?>" <?= ($category->id_category == $selectedCategoryId) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($category->name) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
        </div>
        <div class="d-flex col col-md-6">
            <input class="form-control" type="search" placeholder="Rechercher par marque ou modèle" aria-label="Rechercher" value="<?= $search ?>" name="search">
            <button type="submit" class="btn btn-outline-primary"><i class="bi bi-search"></i></button>
        </div>

        </form>
    </div>

    <div>
        <h3 class="my-3"><?= $total_vehicles ?> véhicules trouvés.</h3>
    </div>

    <div>
        <?php foreach (array_chunk($vehicles, 3) as $vehicleRow) : ?>
            <div class="row">
                <?php foreach ($vehicleRow as $vehicle) : ?>
                    <div class="col-md-4">
                        <div class="card m-3">
                            <img src="/public/uploads/vehicles/<?= $vehicle->picture ? $vehicle->picture : ''; ?>" alt="Image de <?= htmlspecialchars($vehicle->brand) ?> <?= htmlspecialchars($vehicle->model) ?>">
                            <div class="card-body text-center">
                                <h5 class="card-title"><?= htmlspecialchars($vehicle->brand) ?> <?= htmlspecialchars($vehicle->model) ?></h5>
                                <p class="card-text"></p>
                                <a href="/controllers/frontvehicles-details-ctrl.php?id_vehicle=<?= $vehicle->id_vehicle ?>" class="btn btn-outline-dark">+ D'infos</a>
                                <a href="/controllers/frontvehicles-rent-ctrl.php?id_vehicle=<?= $vehicle->id_vehicle ?>" class="btn btn-outline-success">Réserver ce véhicule <i class="bi bi-car-front-fill"></i></a>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php endforeach; ?>

        <nav aria-label="...">
            <ul class="pagination justify-content-center">
                <li class="page-item <?= ($page == 1) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= ($page - 1) . '&category=' . $selectedCategoryId . '&search=' . $search ?>" tabindex="-1" aria-disabled="true">Précédent</a>
                </li>

                <?php for ($i = 1; $i <= $nb_pages; $i++) : ?>
                    <li class="page-item <?= ($i == $page) ? 'active' : '' ?>">
                        <a class="page-link" href="?page=<?= $i . '&category=' . $selectedCategoryId . '&search=' . $search ?>"><?= $i ?></a>
                    </li>
                <?php endfor; ?>

                <li class="page-item <?= ($page == $nb_pages) ? 'disabled' : '' ?>">
                    <a class="page-link" href="?page=<?= ($page + 1) . '&category=' . $selectedCategoryId . '&search=' . $search ?>">Suivant</a>
                </li>
            </ul>
        </nav>
    </div>



</div>