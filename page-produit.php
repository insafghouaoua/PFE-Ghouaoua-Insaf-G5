<?php
session_start();
require_once('bd.php');


if (isset($_GET['afficherproduitid'])) {
  $produit_id = $_GET['afficherproduitid'];


$sql = "SELECT * FROM produit WHERE produit_id = :produit_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':produit_id', $produit_id, PDO::PARAM_INT);
$stmt->execute();

$ligne = $stmt->fetch(PDO::FETCH_ASSOC);
}
if(isset($_POST['ajouter_au_panier'])){
  if (isset($_SESSION['panier'][$produit_id])) {
    $errors['ajout_panier'] = 'Le produit est déjà ajouté.';
  } else {
    $_SESSION['panier'][$produit_id] = array(
      'produit_id' => $produit_id,
      'nom' => $ligne['nom'],
      'image' => $ligne['image'],
      'quantite' => $_POST['quantite'],
      'prix' => $ligne['prix_vente']
    );
    $success['ajout_panier'] = 'Le produit est ajouté au panier.';
  }}



?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/page-produit.css">



    <title>inscription</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
  </head>
  <body>



  <?php include 'header.php';?>

    <?php
       echo' <main class="product-page">';

       echo' <form method="post" action="" class="product-page">';

     echo' <div class="product-image">';
       echo ' <img src="images produits/'.$ligne['image'].'" alt="'.$ligne['image'].'">';
       echo' </div>';
       echo' <div class="product-info">';
      echo '<p>Categorie : ' . $ligne['categorie'] . '</p>';
      echo '<h1>' . $ligne['nom'] . '</h1>';
      echo '<p> <strong style=" color:#333">Marque:</strong> ' . $ligne['marque'] . '</p>';
      echo '<p> ' . $ligne['petite_description'] . '</p>';
      echo '<div class="description">';
      echo  ' <h2>Description:</h2>';
      echo  '<p>  ' . $ligne['description'] . '</p>';
      echo '</div>';
      echo '<p><strong style="color:#333">Prix:</strong> <span class="price">' . $ligne['prix_vente'] . ' DA</span></p>';
      echo '<p> <strong style=" color:#333">Statut:</strong> ' . $ligne['statut'] .  '</p>';
      echo ' <p><strong style=" color:#333">Quantité:</strong> <input  type="number" name="quantite" required min="1" value="1" max="99" maxlength="2" class="quantite"></p>';

                
      if(isset($success['ajout_panier']))
      {
          
          echo '<div class="alert alert-success">'.$success['ajout_panier'].'</div>';
          
      }
      if(isset($errors['ajout_panier']))
      {
       echo '<div class="alert alert-danger">'.$errors['ajout_panier'].'</div>';
      }
      echo '<div class="buttons-produit">';
      echo  '<button type="submit" name="ajouter_au_panier" class="orange-white-button"> <i class="ti-shopping-cart"></i> Ajouter au panier </button>';
      echo  '   <input type="hidden" name="produit_id" value="'.$ligne['produit_id'].'">';
      echo  '  </form>';
      echo  '';
      echo '<button class="white-grey-button" type="button" onclick="window.location.href=\'offre-achat-partage.php?produitid='.$ligne['produit_id'].'\'"> <i class="fa fa-handshake-o"></i> Proposer/Participer à un achat partagé </button>';
      echo '</div>';
      ?>


   </div>
   </main>


<?php include 'commentaire.php';?>

    <?php include 'footer.php';?>

  </body>
</html>