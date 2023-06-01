<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $message_id = $_GET['supprimerid'];
    
    $stmt = $pdo->prepare('DELETE FROM contact WHERE message_id = ?');
    $stmt->execute([$message_id]);

    header('Location: confirmation-supprimer-contact.php');
    exit();
}

$contact = $pdo->query('SELECT * FROM contact');

while($ligne = $contact->fetch()){ 
    echo '<tr>';
    echo '<td>' . $ligne['message_id'] . '</td>';
    echo '<td>' . $ligne['email'] . '</td>';
    echo '<td>' . $ligne['message'] . '</td>';


    echo '<td><button><a href="supprimer-contact.php?supprimerid=' . $ligne['message_id'] . '">Supprimer</a></button></td>';
    echo '</tr>';
}

?>
