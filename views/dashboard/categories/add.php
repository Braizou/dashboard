<div class="container">
    <div class="row">
        <!-- Première div sur la première row -->
        <div class="col py-3">
        <a href="/controllers/dashboard/categories/list-ctrl.php"><button type="button" class="btn btn-primary">Retour à la liste des catégories</button></a>
            <h1>Ajout Catégorie</h1>
            <form method="post" action="">
                <input type="text" name="name" placeholder="ex: voiture">
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </form>
            <h4><?=$successes['name'] ?? ''?></h4>
            <h4><?=$errors['name'] ?? ''?></h4>
        </div>
    </div>