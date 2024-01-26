<div class="container listImg">

    <form method="post" class="my-5 col-md-6 borders shadow-lg rent p-5">
        <fieldset>
            <legend class="text-center">Réservation de la <?= $vehicle->brand ?> <?= $vehicle->model ?></legend>
            <div class="form-group  mt-4">
                <label for="lastname"></label>
                <input class="form-control bg-transparent border-0" type="text" id="lastname" name="lastname" value="<?= $lastname ?? '' ?>" placeholder="Nom">
                <span id="lastname-error" style="color: red;"><?=  $errors['lastname']??"" ?></span>

            </div>

            <div class="form-group  mt-2">
                <label for="firstname"></label>
                <input class="form-control bg-transparent border-0" type="text" id="firstname" name="firstname" value="<?= $firstname ?? '' ?>" placeholder="Prénom">
                <span id="firstname-error" style="color: red;"><?=  $errors['firstname']??"" ?></span>
            </div>

            <div class="form-group  mt-2">
                <label for="email"></label>
                <input class="form-control bg-transparent border-0" type="text" id="email" name="email" value="<?= $email ?? '' ?>" placeholder="E-mail">
                <span id="email-error" style="color: red;"><?=  $errors['email']??"" ?></span>
            </div>

            <div class="form-group  mt-2">
                <label for="birthday">Date de naissance</label>
                <input class="form-control bg-transparent border-0" type="date" id="birthday" name="birthday" value="<?= $birthday ?? '' ?>">
                <span id="birthday-error" style="color: red;"><?=  $errors['birthday']??"" ?></span>
            </div>

            <div class="form-group  mt-2">
                <label for="phone"></label>
                <input class="form-control bg-transparent border-0" type="text" id="phone" name="phone" value="<?= $phone ?? '' ?>" placeholder="Téléphone">
                <span id="phone-error" style="color: red;"><?=  $errors['phone']??"" ?></span>
            </div>

            <div class="form-row d-flex mt-2">
                <div class="form-group col-md-6 mx-1">
                    <label for="city">Ville</label>
                    <input class="form-control bg-transparent border-0" type="text" id="city" name="city" value="<?= $city ?? '' ?>" placeholder="Ex: Amiens">
                    <span id="city-error" style="color: red;"><?=  $errors['city']??"" ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="zipcode">Code Postal</label>
                    <input class="form-control bg-transparent border-0" type="text" id="zipcode" name="zipcode" value="<?= $zipcode ?? '' ?>" placeholder="Ex: 80000">
                    <span id="zipcode-error" style="color: red;"><?=  $errors['zipcode']??"" ?></span>
                </div>
            </div>

            <p class="mb-0 mt-4">Vous souhaitez réserver</p>
            <div class="form-row d-flex">
                <div class="form-group col-md-6">
                    <label for="startDate">Du</label>
                    <input class="form-control bg-transparent border-0" type="datetime-local" id="startDate" name="startDate" value="<?= $startDate ?? '' ?>">
                    <span id="startDate-error" style="color: red;"><?=  $errors['startDate']??"" ?></span>
                </div>
                <div class="form-group col-md-6">
                    <label for="endDate">Au</label>
                    <input class="form-control bg-transparent border-0" type="datetime-local" id="endDate" name="endDate" value="<?= $endDate ?? '' ?>">
                    <span id="endDate-error" style="color: red;"><?=  $errors['endDate']??"" ?></span>
                </div>
            </div>

            <button type="submit" class="btn btn-primary mt-4">Réserver</button>
    </form>
</fieldset>
<div>

<style>
    .listImg {
        background-image: url('/public/uploads/vehicles/<?= $vehicle->picture ? $vehicle->picture : '' ?>');
        width: 100%;
        object-fit: cover;
        border-radius: 10px;
        background-size:cover;
        background-position: center;
    }
</style>