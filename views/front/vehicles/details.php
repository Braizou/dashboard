<div class="container">
    <div class="row">
        <h3 class="category"><?= $category->name ?></h3>
        <img class="vehiclePicture" src="/public/uploads/vehicles/<?= $vehicle->picture ? $vehicle->picture : ''; ?>" alt="Image de <?= htmlspecialchars($vehicle->brand) ?> <?= htmlspecialchars($vehicle->model) ?>">
        <h1 class="text-center title"><?= $vehicle->brand ?> <?= $vehicle->model ?></h1>
    </div>
    <div>
        <h3>Location Voiture <?= $category->name ?></h3> <br>
        <h4>Nos Voitures <?= $category->name ?></h4> <br>
        <p>Notre gamme de véhicules <strong><?= $category->name ?></strong> s’adresse à l’ensemble des conducteurs désireux de se déplacer en
            agglomération pour un prix raisonnable. En effet, ces véhicules d’entrée de gamme des constructeurs automobiles
            (par exemple la Peugeot 107) sont équipés d’un moteur peu puissant, peu gourmand en carburant et sont en général
            proposés en version 3 portes au sein du réseau Rent My Ride. Malgré la petite taille de ces voitures,
            vous pouvez aisément rabattre la banquette arrière et ainsi augmenter le volume d’espace disponible au niveau du
            coffre. Les équipements sont simples, mais ils ne vous privent pas du plaisir de la conduite. Avec un petit véhicule,
            vous roulez en faisant des économies.</p> <br>
        <h4>Options disponibles sur les voitures de location</h4> <br>
        <p>Avec votre location de véhicules pas chers , vous pouvez choisir de nombreux équipements en options. Par exemple, le GPS pour vous localiser facilement ou encore des chaînes neiges, pendant les mois d’hiver.</p> <br>
        <h3>Pourquoi louer une <?= $category->name ?> ?</h3> <br>
        <p>La location de véhicules <strong><?= $category->name ?></strong> s’adresse à l’ensemble des conducteurs désireux de se déplacer en milieu urbain ou péri-urbain, dans un véhicule de petite taille. Vous avez besoin d’une petite voiture ? Vous voulez rouler sans trop dépenser ? Choisissez la location de petits véhicules ! Simples à conduire, faciles à stationner, peu gourmands en carburant, ces véhicules disposent de tous les atouts nécessaires pour que vous réalisiez des économies. Nous ne vous proposons pas de rouler dans des véhicules low-cost ou discount, mais rouler sans trop dépenser devient possible : ainsi, vous réalisez vos courts trajets en maîtrisant totalement votre budget grâce à une faible consommation de carburant. N’hésitez pas à demander conseil auprès de votre conseiller Rent My Ride pour choisir le modèle de véhicules pas chers pour votre prochaine escapade en ville. Choisissez votre location de véhicules <strong><?= $category->name ?></strong> pour rouler peu et pas cher sans pour autant renoncer au confort !</p> <br>
        <h3>Informations pratiques sur la location de voiture</h3><br>
        <p>Pour louer ce type de véhicule, vous devez être titulaire du permis de conduire B depuis plus de 3 ans. Découvrez également nos voitures citadines pour rouler en ville ou notre gamme de « voitures conforts » pour des trajets sur autoroute. Rent My Ride vous permet de trouver facilement la voiture la plus adaptée à vos besoins et ce, de la petite citadine à la grande routière. En effet, Rent My Ride vous propose un choix d’une vingtaine de catégories de voitures de tourisme et d’utilitaires au sein de son réseau d’agences de location. Ainsi, pour les trajets de courte durée, profitez de nos offres de location de véhicules de petite taille avec nos modèles de voitures économiques ou citadines. Pour vos trajets plus longs, sur route et autoroute, préférez le confort de nos berlines ou de nos grandes routières. Ces modèles de véhicules sont disponibles dans toutes les agences de location en France Métropolitaine. Rent My Ride répond également à un besoin bien spécifique en vous proposant des modèles de voitures propres à chaque agence et à chaque région. Ainsi, vous pourrez louer un cabriolet dans les régions plus ensoleillées (avec la Peugeot 308cc par exemple), ou un véhicule plus haut de gamme ou "break" dans d'autres agences. Renseignez-vous sur la disponibilité d'une catégorie de véhicules en vous rendant sur le site www.rentmyride.fr ou en contactant l'agence la plus proche de chez vous.</p><br>
    </div>
    <div class="mb-5">
            <a class="btn btn-outline-dark" role="button" onclick="history.back()">Retour à la liste des résultats</a>
            <a href="/controllers/frontvehicles-rent-ctrl.php?id_vehicle=<?= $vehicle->id_vehicle ?>" class="btn btn-outline-success">Réserver ce véhicule <i class="bi bi-car-front-fill"></i></a>
    </div>
</div>