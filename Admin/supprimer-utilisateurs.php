<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $utilisateur_id = $_GET['supprimerid'];

    $pdo->exec('SET FOREIGN_KEY_CHECKS=0');

    $stmt = $pdo->prepare('DELETE FROM utilisateur WHERE utilisateur_id = ?');
    $stmt->execute([$utilisateur_id]);

    $pdo->exec('SET FOREIGN_KEY_CHECKS=1');

    header('Location: confirmation-supprimer-utilisateurs.php');
    exit();
}

$utilisateur = $pdo->query('SELECT * FROM utilisateur');

while($ligne = $utilisateur->fetch()){ 
    echo '<tr>';
    echo '<td>' . $ligne['utilisateur_id'] . '</td>';
    echo '<td>' . $ligne['nom'] . '</td>';
    echo '<td>' . $ligne['prenom'] . '</td>';
    echo '<td>' . $ligne['datedenaissance'] . '</td>';
    echo '<td>' . $ligne['genre'] . '</td>';
    echo '<td>' . $ligne['email'] . '</td>';
    echo '<td>' . $ligne['telephone'] . '</td>';
    echo '<td>' . $ligne['mot_de_passe'] . '</td>';
    echo '<td><button><a href="modifier-utilisateurs.php?id=' . $ligne['utilisateur_id'] . '">Modifier</a></button></td>';
    echo '<td><button><a href="supprimer-utilisateurs.php?supprimerid=' . $ligne['utilisateur_id'] . '">Supprimer</a></button></td>';
    echo '</tr>';
}
?>

