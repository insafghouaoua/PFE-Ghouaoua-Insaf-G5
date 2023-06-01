<?php
session_start();
require_once('bd.php');

if(!isset($_SESSION['administrateur_id'])) {
    $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
    header('location:../connexion.php');
    exit;
}

$total_commandes = $pdo->query('SELECT COUNT(*) FROM commande')->fetchColumn();
$total_stock = $pdo->query('SELECT SUM(quantite) FROM produit')->fetchColumn();
$total_clients = $pdo->query('SELECT COUNT(*) FROM utilisateur')->fetchColumn();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/accueil.css">

    <title>Accueil</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>

  
<?php include 'menu.php';?>
<section class="home-section">
    <div class="dashboard">
        <h1>Bienvenue sur la page d'accueil de l'administrateur</h1>
        <div class="dashboard-stats">
            <div class="dashboard-stat">
                <h2>Total de commandes</h2>
                <p><?= $total_commandes ?></p>
            </div>
            <div class="dashboard-stat">
                <h2>Total de produits en stock</h2>
                <p><?= $total_stock ?></p>
            </div>
            <div class="dashboard-stat">
                <h2>Total de clients inscrits</h2>
                <p><?= $total_clients ?></p>
            </div>
        </div>
    </div>
</section>
</body>
</html>