<script>
    function confirmDelete(categoryId) {
        if (confirm("Êtes-vous sûr de vouloir supprimer cette catégorie?")) {
            window.location.href = "/controllers/dashboard/categories/delete-ctrl.php?id=" + categoryId;
        }
    }
</script>

</body>
</html>