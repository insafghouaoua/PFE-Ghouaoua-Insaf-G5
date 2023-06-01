<?php
session_start();

require_once('bd.php');

if(isset($_POST['produit_id']) && isset($_POST['quantite'])) {
    $produit_id = $_POST['produit_id'];
    $quantite = $_POST['quantite'];

        $panier = $_SESSION['panier'];
        foreach($panier as &$produit) {
            if($produit['produit_id'] == $produit_id) {
                $produit['quantite'] = $quantite;
                break;
            }
        }
        $_SESSION['panier'] = $panier;

        header('Location: panier.php');
        exit();
    
} else {
    // Si le produit_id et la quantité ne sont pas définis, rediriger l'utilisateur vers la page d'accueil
    header('Location: accueil.php');
    exit();
}
?>
