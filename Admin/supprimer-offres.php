<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $offre_id = $_GET['supprimerid'];
        $stmt = $pdo->prepare('DELETE FROM participation_achat_partage WHERE offre_id = ?');
        $stmt->execute([$offre_id]);
    
        $stmt = $pdo->prepare('DELETE FROM offre_achat_partage WHERE offre_id = ?');
        $stmt->execute([$offre_id]);

    header('Location: confirmation-supprimer-offres.php');
    exit();
}


?>