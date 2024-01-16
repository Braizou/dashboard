<div class="container mt-5">
<h1>Modifier une entrée</h1>
    <a href="/controllers/dashboard/categories/list-ctrl.php"><button type="button" class="btn btn-primary">Retour à la liste des catégories</button></a>
    <h1>Modifier Catégorie</h1>
    <form method="post" action="">
        <input type="text" name="name" placeholder="ex: Nouveau nom" value="<?= isset($categoryDetails->name) ? htmlspecialchars($categoryDetails->name) : '' ?>" required>
        <button type="submit" class="btn btn-primary">Enregistrer la modification</button>
    </form>
</div>