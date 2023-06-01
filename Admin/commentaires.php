<?php
session_start();
require_once('bd.php');

if(!isset($_SESSION['administrateur_id'])) {
  $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
  header('location:../connexion.php');
  exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <title>Commentaire</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">

<table>
  <tr>    
    <th>Commentaire id</th>
    <th>Produit id</th>
    <th>Utilisateur id</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Commentaire</th>
    <th>Cree_le</th>
    <th>Supprimer</th>

  </tr>

  <?php

$commentaire = $pdo->query('SELECT * FROM commentaire ORDER BY produit_id');
              
if ($commentaire->rowCount() == 0) {
  echo '<tr>';

  echo '<td colspan="8">Aucun commentaire.</td>';
  echo '</tr>';

} else {
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

                             echo '<a href="supprimer-commentaires.php?supprimerid='.$ligne['commentaire_id'].'" class="supprimer-button"><i class="bx bx-trash"></i></a>';

                             echo '</td>';

                                 echo '</tr>';
                              }}
?>



</table>

</section>



</body>
</html>