<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $commande_id = $_GET['supprimerid'];

    $stmt = $pdo->prepare('DELETE FROM commande_produit WHERE commande_id = ?');
    $stmt->execute([$commande_id]);

    $stmt = $pdo->prepare('DELETE FROM commande WHERE commande_id = ?');
    $stmt->execute([$commande_id]);

    header('Location: confirmation-supprimer-commandes.php');
    exit();
}
?>
