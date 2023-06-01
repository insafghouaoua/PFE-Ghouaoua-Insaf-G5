<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $participation_id = $_GET['supprimerid'];
    
    $stmt = $pdo->prepare('DELETE FROM participation_achat_partage WHERE participation_id = ?');
    $stmt->execute([$participation_id]);

    header('Location: confirmation-supprimer-participations.php');
    exit();
}


?>