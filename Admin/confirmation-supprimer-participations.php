<?php
if (isset($_GET['supprimerid'])) {
    $participation_id = $_GET['supprimerid'];
?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Confirmation de suppression</title>
        <script>
            function confirmerSuppression() {
                var confirmation = confirm("Êtes-vous sûr de vouloir supprimer ce message ?");
                if (confirmation == true) {
                    window.location.href = "supprimer-participations.php?supprimerid=<?php echo $participation_id; ?>";
                }
            }
        </script>
    </head>
    <body>
        <h1>Confirmation de suppression</h1>
        <p>Êtes-vous sûr de vouloir supprimer ce message ?</p>
        <button onclick="confirmerSuppression()">Supprimer</button>
        <button onclick="window.history.back()">Annuler</button>
    </body>
    </html>
<?php
} else {
    header("Location: offres.php");
    exit();
}
?>