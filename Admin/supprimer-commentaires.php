<?php
require_once('bd.php');

if (isset($_GET['supprimerid'])) {
    $commentaire_id = $_GET['supprimerid'];
    
    $stmt = $pdo->prepare('DELETE FROM commentaire WHERE commentaire_id = ?');
    $stmt->execute([$commentaire_id]);

    header('Location: confirmation-supprimer-commentaires.php');
    exit();
}

$commentaire = $pdo->query('SELECT * FROM commentaire');

while($ligne = $commentaire->fetch()){ 
    echo '<tr>';
    echo '<td>';
    echo $ligne['commentaire_id'];
  echo '</td>';

        echo '<td>';
          echo $ligne['produit_id'];
        echo '</td>';

        echo '<td>';
        echo $ligne['utilisateur_id'];
        echo '</td>';

        echo '<td>';
        echo $ligne['nom'];
      echo '</td>';

      echo '<td>';
      echo $ligne['prenom'];
    echo '</td>';

    echo '<td>';
    echo $ligne['commentaire'];
  echo '</td>';

  echo '<td>';
  echo $ligne['cree_le'];
echo '</td>';

        echo '<td>';
        echo '<button class="supprimer-button"><a href="supprimer-commentaires.php?supprimerid='.$ligne['commentaire_id'].' ">Supprimer</a></button>';
        echo '</td>';

    echo '</tr>';
}

?>
