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
    <title>Offres produits loisirs</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">


<table>


  <?php



  $offre = $pdo->query('SELECT *, offre_achat_partage.nom AS offre_nom  FROM offre_achat_partage  JOIN produit ON offre_achat_partage.produit_id = produit.produit_id WHERE produit.categorie = "Produits de loisirs" ORDER BY offre_achat_partage.produit_id');
              
     
  if ($offre->rowCount() == 0) {
    echo '<tr>';
    echo '<td colspan="10"><h2>Offres<h2></td>';
    echo '</tr>';
    echo '<tr>';
    echo ' <th>Offre ID</th>';
    echo ' <th>Produit ID</th>';
    echo '<th>Utilisateur ID</th>';
    echo ' <th>Déposant</th>';
    echo ' <th>Wilaya</th>';
    echo '<th>Pourcentage</th>';
    echo ' <th>Duree utilisation (par mois)</th>';
    echo '<th>Commentaire</th>';
    echo '<th>Cree le</th>';
    echo ' <th>Supprimer</th>';
    echo '</tr>';
    echo '<tr>';
  
    echo '<td colspan="10">Aucun offre pour cette categorie.</td>';
    echo '</tr>';
  
  } else {
  while($ligne = $offre->fetch()){
    echo '<tr>';
    echo '<td colspan="12"><h2>Offres<h2></td>';
    echo '</tr>';
    echo '<tr>';
    echo ' <th>Offre ID</th>';
    echo ' <th>Produit ID</th>';
    echo '<th>Utilisateur ID</th>';
    echo ' <th>Déposant</th>';
    echo ' <th>Wilaya</th>';
    echo '<th>Pourcentage</th>';
    echo ' <th>Duree utilisation (par mois)</th>';
    echo '<th>Commentaire</th>';
    echo '<th>Cree le</th>';
    echo ' <th>Supprimer</th>';
    echo '</tr>';

    echo '<td>';
    echo $ligne['offre_id'];
    echo '</td>';
  
    echo '<td>';
    echo $ligne['produit_id'];
    echo '</td>';
  
    echo '<td>';
    echo $ligne['utilisateur_id'];
    echo '</td>';
  
    echo '<td>' . $ligne['offre_achat_partage_nom'] .' '. $ligne['prenom'] . '</td>';

  
    echo '<td>';
    echo $ligne['wilaya'];
    echo '</td>';

    echo '<td>';
    echo $ligne['pourcentage'];
    echo '</td>';

    echo '<td>';
    echo $ligne['duree_utilisation'];
    echo '</td>';

    echo '<td>';
    echo $ligne['commentaire'];
    echo '</td>';

    echo '<td>';
    echo $ligne['cree_le'];
    echo '</td>';



    echo '<td>';
    echo '<a href="supprimer-offres.php?supprimerid='.$ligne['offre_id'].'" class="supprimer-button"><i class="bx bx-trash"></i></a>';
    echo '</td>';


    echo '</tr>';


    echo '<tr>';
    echo '<td colspan="10"><h2>Participation(s)<h2></td>';
    echo '</tr>';

    echo '<tr> ';   
    echo '<th>Participation ID</th>';
    echo '<th>Produit ID</th>';
    echo '<th>Utilisateur ID</th>';
    echo '<th>Participant</th>';
    echo '<th>Wilaya</th>';
    echo '<th>Pourcentage</th>';
    echo '<th>Duree utilisation (par mois)</th>';
    echo '<th>Commentaire</th>';
    echo '<th>Cree le</th>';
    echo '<th>Supprimer</th>';
    echo '</tr>';
    $commentaire = $pdo->query('SELECT *, participation_achat_partage.nom AS participation_achat_partage_nom  FROM participation_achat_partage JOIN produit ON participation_achat_partage.produit_id = produit.produit_id WHERE produit.categorie = "Produits de loisirs" ORDER BY participation_achat_partage.produit_id');
              
     
    $participation = $pdo->prepare('SELECT * participation_achat_partage.nom AS participation_achat_partage_nom  FROM participation_achat_partage WHERE offre_id = :offre_id ORDER BY produit_id');
    $participation->execute(array('offre_id' => $ligne['offre_id']));
    if ($participation->rowCount() == 0) {
      echo '<tr>';

      echo '<td colspan="10">Aucune participation pour cet offre.</td>';
      echo '</tr>';

  } else {
while($ligne = $participation->fetch()){ 


    echo '<tr>';
  
    echo '<td>';
    echo $ligne['participation_id'];
    echo '</td>';

      
    echo '<td>';
    echo $ligne['produit_id'];
    echo '</td>';
  
    echo '<td>';
    echo $ligne['utilisateur_id'];
    echo '</td>';
  
    echo '<td>' . $ligne['participation_achat_partage_nom'] .' '. $ligne['prenom'] . '</td>';

  
    echo '<td>';
    echo $ligne['wilaya'];
    echo '</td>';

    echo '<td>';
    echo $ligne['pourcentage'];
    echo '</td>';

    echo '<td>';
    echo $ligne['duree_utilisation'];
    echo '</td>';

    echo '<td>';
    echo $ligne['commentaire'];
    echo '</td>';

    echo '<td>';
    echo $ligne['cree_le'];
    echo '</td>';





    echo '<td>';

    echo '<a href="supprimer-participations.php?supprimerid='.$ligne['participation_id'].'" class="supprimer-button"><i class="bx bx-trash"></i></a>';

    echo '</td>';

}}
  }}

  ?>

</table>

</section>

</body>
</html>
