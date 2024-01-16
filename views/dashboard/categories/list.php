
<div class="container mt-5">
    <a href="/controllers/dashboard/categories/add-ctrl.php"><button type="button" class="btn btn-primary">Ajouter une catégorie</button></a>
    <h1>Liste des catégories</h1>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($categories as $categorie): ?>
            <tr>
            <td><?= isset($categorie->id_category) ? htmlspecialchars($categorie->id_category) : 'N/A' ?></td>
            <td><?= htmlspecialchars($categorie->name) ?></td>
            <td>
                <a href="/controllers/dashboard/categories/update-ctrl.php?id=<?= $categorie->id_category ?>" class="btn btn-primary">Modifier</a>
                <button type="button" class="btn btn-danger" onclick="confirmDelete(<?= $categorie->id_category ?>)">Supprimer</button>
            </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <?php
    ?>
</div>

