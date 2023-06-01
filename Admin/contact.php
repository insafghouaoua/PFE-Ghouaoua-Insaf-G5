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
    <title>contact</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">

<table>
  <tr>
    <th>Email</th>
    <th>Message</th>
    <th>Supprimer</th>


  </tr>

  <?php

$contact = $pdo->query('SELECT * FROM contact');
              
if ($contact->rowCount() == 0) {
  echo '<tr>';

  echo '<td colspan="13">Aucun message.</td>';
  echo '</tr>';

} else {
             while($ligne = $contact->fetch()){ 
                                 echo '<tr>';
     
                                     echo '<td>';
                                       echo $ligne['email'];
                                     echo '</td>';
                     
                                     echo '<td>';
                                     echo $ligne['message'];
                                     echo '</td>';

                                     echo '<td>';

                                     echo '<a href="supprimer-contact.php?supprimerid='.$ligne['message_id'].'" class="supprimer-button"><i class="bx bx-trash"></i></a>';

                                     echo '</td>';
                                 echo '</tr>';
                              }}
?>



</table>

</section>



</body>
</html>