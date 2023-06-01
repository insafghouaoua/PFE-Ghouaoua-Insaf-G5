<?php
session_start();
require_once('bd.php');

if(!isset($_SESSION['administrateur_id'])) {
    $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
    header('location:../connexion.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Commandes</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">
    <table>
        <thead>
            <tr>
                <th>Commande ID</th>
                <th>Type</th>
                <th>Produit ID</th>
                <th>Quantité</th>
                <th>Prix total</th>
                <th>Client</th>
                <th>Téléphone</th>
                <th>Wilaya</th>
                <th>Créé le</th>
                <th>Imprimer facturation/contrat</th>
                <th>Supprimer</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $commandes = $pdo->query('SELECT c.*, cp.produit_id, cp.nom AS nom_produit, cp.prix_vente, cp.quantite FROM commande AS c INNER JOIN commande_produit AS cp ON c.commande_id = cp.commande_id ORDER BY c.commande_id');
            if ($commandes->rowCount() == 0) {
                echo '<tr>';
                echo '<td colspan="16">Aucune commande.</td>';
                echo '</tr>';
            } else {
                $last_commande_id = null;
                $total = 0;

                while ($ligne = $commandes->fetch()) {
                    if ($last_commande_id != $ligne['commande_id']) {
                        if ($last_commande_id != null) {
                            echo '<tr class="total">';
                            echo '<td colspan="6"></td>';
                            echo '<td>' . $total . '</td>';
                            echo '<td colspan="9"></td>';
                            echo '</tr>';
                            $total = 0;
                        }
                        $last_commande_id = $ligne['commande_id'];
                    }
                    $prix_total = $ligne['quantite'] * $ligne['prix_vente'];
                    $total += $prix_total;
                    echo '<tr>';
                    echo '<td>' . $ligne['commande_id'] . '</td>';
                    echo '<td>' . $ligne['type'] . '</td>';
                    echo '<td>' . $ligne['produit_id'] . '</td>';
                    echo '<td>' . $ligne['quantite'] . '</td>';
                    echo '<td>' . $prix_total . '</td>';
                    echo '<td>' . $ligne['nom'] .' '. $ligne['prenom'] . '</td>';
                    echo '<td>' . $ligne['telephone'] . '</td>';
                    echo '<td>' . $ligne['wilaya'] . '</td>';
                    echo '<td>' . $ligne['cree_le'] . '</td>';
                    echo '<td><a href="tcpdf/generatepdf.php?commande_id=' . $ligne['commande_id'] . '&produit_id=' . $ligne['produit_id'] . '" class="print-button"><i class="bx bx-printer"></i></a></td>';
                    echo '<td><a href="supprimer-commandes.php?supprimerid=' . $ligne['commande_id'] . '" class="supprimer-button"><i class="bx bx-trash"></i></a></td>';
                    echo '</tr>';
                }

                if ($last_commande_id != null) {
                    echo '<tr class="total">';
                    echo '<td colspan="6" class="gris"></td>';
                    echo '<td class="gris">' . $total . '</td>';
                    echo '<td colspan="9" class="gris"></td>';
                    echo '</tr>';
                }
            }
            ?>
        </tbody>
    </table>
</section>
</body>
</html>
