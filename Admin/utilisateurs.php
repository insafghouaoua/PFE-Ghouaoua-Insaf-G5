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
    <link rel="stylesheet" href="css/fenetre-form.css">
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Utilisateurs</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">



<table>
  <tr>
    <th>Id</th>
    <th>Photo profile</th>
    <th>Nom</th>
    <th>Prenom</th>
    <th>Genre</th>
    <th>Email</th>
    <th>Num de telephone</th>
    <th>Détails</th>
    <th>Modifier</th>
    <th>Supprimer</th>



  </tr>

  <?php

$utilisateur = $pdo->query('SELECT * FROM utilisateur');


if ($utilisateur->rowCount() == 0) {
  echo '<tr>';

  echo '<td colspan="11">Aucun utilisateur inscrit.</td>';
  echo '</tr>';

} else {
             while($ligne = $utilisateur->fetch()){ 
              if (empty($ligne['image_profile'])) {
                $ligne['image_profile'] = "image-profile.png";
              }
                                 echo '<tr>';
                                     echo '<td>';
                                       echo $ligne['utilisateur_id'];

                                     echo '</td>';

                                     echo '<td>';
                                     echo ' <img src="../images/'. $ligne['image_profile']. '" alt="Profile Picture" class="user_image_profile">';
                                     echo '</td>';
                     
                                     echo '<td>';
                                     echo $ligne['nom'];
                                     echo '</td>';
                     
                                     echo '<td>';
                                     echo $ligne['prenom'];
                                     echo '</td>';

                                                          
                                     echo '<td>';
                                     echo $ligne['genre'];
                                     echo '</td>';

                                     echo '<td>';
                                     echo $ligne['email'];
                                     echo '</td>';
                     
                                                          
                                     echo '<td>';
                                     echo $ligne['telephone'];
                                     echo '</td>';

                                     echo '<td>';
                                     echo '<a  class="details-button"" href="details-utilisateurs.php?detailsid='.$ligne['utilisateur_id'].'" ><i class="bx bx-detail"></i></a>';

                                     echo '</td>';
                     
                                     echo '<td>';
                                     echo '<a  class="modifier-button"" href="modifier-utilisateurs.php?modifierid='.$ligne['utilisateur_id'].'" ><i class="bx bx-pencil"></i></a>';

                                     echo '</td>';



                                     echo '<td>';

                                     echo '<a href="supprimer-utilisateurs.php?supprimerid='.$ligne['utilisateur_id'].'" class="supprimer-button"><i class="bx bx-trash"></i></a>';

                                     echo '</td>';


                                 echo '</tr>';
                              }}
?>



</table>

</section>



</body>
</html>