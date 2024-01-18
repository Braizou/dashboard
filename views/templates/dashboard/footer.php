<script>
    function confirmDeleteCategory(categoryId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie?")) {
            window.location.href = "/controllers/dashboard/categories/delete-ctrl.php?id=" + categoryId;
        }
    }
    function confirmDeleteVehicle(vehicleId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer ce véhicule?")) {
            window.location.href = "/controllers/dashboard/vehicles/delete-ctrl.php?id_vehicle=" + vehicleId;
        }
    }
</script>

</body>
</html>