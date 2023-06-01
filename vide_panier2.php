<?php
session_start();
require_once('bd.php');

if (isset($_SESSION['utilisateur_id'])) {
    $utilisateur_id = $_SESSION['utilisateur_id'];

    $stmt = $pdo->prepare('DELETE FROM panier_produit WHERE panier_id IN (SELECT panier_id FROM panier WHERE utilisateur_id = :utilisateur_id)');
    $stmt->execute(['utilisateur_id' => $utilisateur_id]);

    $stmt = $pdo->prepare('DELETE FROM panier WHERE utilisateur_id = :utilisateur_id');
    $stmt->execute(['utilisateur_id' => $utilisateur_id]);
}

$_SESSION['panier_errors'] = 'Votre panier a été vidé.';
header("Location: panier.php");
exit();
?>