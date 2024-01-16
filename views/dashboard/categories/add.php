<div class="container">
    <div class="row">
        <!-- Première div sur la première row -->
        <div class="col py-3">
        <a href="/controllers/dashboard/categories/list-ctrl.php"><button type="button" class="btn btn-primary">Retour à la liste des catégories</button></a>
            <h1>Ajout Catégorie</h1>
            <form method="post" action="">
                <input type="text" name="name" placeholder="ex: voiture" required>
                <button type="submit">Ajouter</button>
            </form>
            <h4><?=$msg ?? ''?></h4>
        </div>
    </div>