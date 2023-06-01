<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $produit_id = $_GET['supprimerid'];
    

    $stmt = $pdo->prepare('SELECT COUNT(*) FROM panier_produit WHERE produit_id = ?');
    $stmt->execute([$produit_id]);
    $count = $stmt->fetchColumn();

    if ($count > 0) {
        $stmt = $pdo->prepare('DELETE FROM panier_produit WHERE produit_id = ?');
        $stmt->execute([$produit_id]);
    
        $stmt = $pdo->prepare('DELETE FROM panier WHERE produit_id = ?');
        $stmt->execute([$produit_id]);
    }

    $stmt = $pdo->prepare('DELETE FROM produit WHERE produit_id = ?');
    $stmt->execute([$produit_id]);

    header('Location: confirmation-supprimer-produits.php');
    exit();
}

$produit = $pdo->query('SELECT * FROM produit');

while($ligne = $produit->fetch()){ 
    echo '<tr>';
    echo '<td>' . $ligne['produit_id'] . '</td>';
    echo '<td>' . $ligne['categorie'] . '</td>';
    echo '<td>' . $ligne['nom'] . '</td>';
    echo '<td>' . $ligne['marque'] . '</td>';
    echo '<td>' . $ligne['slogan'] . '</td>';
    echo '<td>' . $ligne['petite_description'] . '</td>';
    echo '<td>' . $ligne['description'] . '</td>';
    echo '<td>' . $ligne['image'] . '</td>';
    echo '<td>' . $ligne['prix_initial'] . '</td>';
    echo '<td>' . $ligne['prix_vente'] . '</td>';
    echo '<td>' . $ligne['quantite'] . '</td>';
    echo '<td>' . $ligne['statut'] . '</td>';

    echo '<td><button><a href="modifier-produits.php?id=' . $ligne['produit_id'] . '">Modifier</a></button></td>';
    echo '<td><button><a href="supprimer-produits.php?supprimerid=' . $ligne['produit_id'] . '">Supprimer</a></button></td>';
    echo '</tr>';
}

?>