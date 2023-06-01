<?php

require_once('bd.php');

session_start(); 

// Vérifier si l'ID d'produit à supprimer est présent dans l'URL
if (isset($_GET['supprimerid'])) {
    $produit_id = $_GET['supprimerid'];


        // Supprimer l'produit avec l'ID correspondant de la session
        if(isset($_SESSION['panier'][$produit_id])) {
            unset($_SESSION['panier'][$produit_id]);
        }
    

    header('Location: panier.php');
    exit();
}


?>