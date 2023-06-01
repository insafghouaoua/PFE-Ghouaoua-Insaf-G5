<?php
session_start();
require_once('bd.php');


$sql = "SELECT * FROM produit";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);


if(isset($_POST['ajouter_au_panier'])){

	$produit_id = $_POST['produit_id'];


			$sql = "SELECT * FROM produit WHERE produit_id= :produit_id";
			$stmt = $pdo->prepare($sql);
			$stmt->execute(['produit_id' => $produit_id]);
			$produit = $stmt->fetch(PDO::FETCH_ASSOC);

		// Store the product information in the session
		$_SESSION['panier'][$produit_id] = [
			'produit_id' => $produit['produit_id'],
			'nom' => $produit['nom'],
			'image' => $produit['image'],
			'quantite' => 1,
		'prix' => $produit['prix_vente']
		];
  
  }



?>

<!DOCTYPE html>
<html lang="en">
<head>
	<!-- Meta Tag -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name='copyright' content=''>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Title Tag  -->
    <title>Produits</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">
	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>
<body>
<?php include 'header.php';?>

<?php

$produit = $pdo->query("SELECT * FROM produit WHERE categorie_id='1001'");
              
     



echo'<main>';

echo'<body class="js">';


		
echo'<!-- Product Style -->';
		echo'<section class="product-area shop-sidebar shop section">';
		echo'	<div class="container">';
		echo'	<div class="row">';
		echo'		<div class="col-lg-3 col-md-4 col-12">';
		echo'			<div class="shop-sidebar">';
		echo'					<!-- Single Widget -->';
		echo'					<div class="single-widget category">';
		echo'						<h3 class="title">Categories</h3>';
		echo'						<ul class="categor-list">';

		echo'							<li><a href="produits.php">Toutes les categories</a></li>';
		echo'							<li><a href="produits-jardinage.php">Produits de jardinage et d\'extérieur</a></li>';
		echo'							<li><a href="produits-maison.php">Articles pour la maison</a></li>';
		echo'							<li><a href="produits-loisirs.php">Produits de loisirs</a></li>';
		echo'</ul>';
		echo'						</div>';
		echo'					<!--/ End Single Widget -->';


									echo'			</div>';
						echo'		</div>';
					echo'	<div class="col-lg-9 col-md-8 col-12">';
					

							echo	'<div class="row">';

							if (isset($_GET["search"])) {
								$searchTerm = $_GET["search"];
							
								$sql = "SELECT * FROM produit WHERE categorie_id = '1001' AND nom LIKE :searchTerm";
								$stmt = $pdo->prepare($sql);
								$stmt->bindValue(':searchTerm', '%' . $searchTerm . '%');
								$stmt->execute();
								$searchResults = $stmt->fetchAll(PDO::FETCH_ASSOC);
							
								if (count($searchResults) > 0) {
									foreach ($searchResults as $produit) {
									  
										echo '<div class="col-lg-4 col-md-6 col-12">';
										echo '<div class="single-product">';
										echo '<div class="product-img">';
										echo '<a href="page-produit.php?afficherproduitid='.$produit['produit_id'].'">';
										echo	'<img class="default-img" src="images produits/'.$produit['image'].'" alt="'.$produit['image'].'">';
										echo	'<img class="hover-img"  src="images produits/'.$produit['image'].'" alt="'.$produit['image'].'">';
										if ($produit['statut'] == 'nouveaute') {
										 echo '<span class="new">';
										 echo $produit['statut'];
										 echo '</span>';
									 } if ($produit['statut'] == 'en_promo') {
										 echo '<span class="price-dec">';
										 echo $produit['statut'];
										 echo '</span>';
									 } if ($produit['statut'] == 'en_rupture_de_stock') {
										 echo '<span class=" out-of-stock">';
										 echo $produit['statut'];
										 echo '</span>';
									 } 
										echo	'</a>';
										echo	' <div class="button-head">';
										echo	'<div class="product-action">';
										echo		'<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="page-produit.php?afficherproduitid='.$produit['produit_id'].'" ><i class=" ti-eye"></i><span>Voir les details</span></a>';
										echo	'</div>';
										echo' <form method="post" action="">';
 
										echo '	<div class="product-action-2">';
 
										echo	'	<button type="submit" name="ajouter_au_panier" title="Add to cart">Ajouter au panier</button>';
										echo  '   <input type="hidden" name="produit_id" value="'.$produit['produit_id'].'">';
 
										echo'	</div>';
										echo	'</div>';
										echo	'</div>';
										echo  '  </form>';
 
										echo	'<div class="product-content">';
										echo		'<h3><a href="page-produit.php?afficherproduitid='.$produit['produit_id'].'"> ';
										echo $produit['nom'];
 
										echo '</a></h3>';
										echo'	<div class="product-price">';
										echo	'	<span> ';
										echo $produit['prix_vente']." DA";
										echo'</span>';
										echo	'</div>';
										echo	'	</div>';
										echo	'</div>';
										echo  '</div>';
 
 
									}}
							else {
								echo " Désolé, aucun résultat ne correspond à votre recherche. ";
								}
								exit;

							}
             //La fonction fetch() permet de récupérer un enregistrement à chaque tour de boucle, et on stocke ce dernier dans la variable $ligne.
            else { while($ligne = $produit->fetch()){ 
									  
									   echo '<div class="col-lg-4 col-md-6 col-12">';
									   echo '<div class="single-product">';
									   echo '<div class="product-img">';
									   echo '<a href="page-produit.php?afficherproduitid='.$ligne['produit_id'].'">';
									   echo	'<img class="default-img" src="images produits/'.$ligne['image'].'" alt="'.$ligne['image'].'">';
									   echo	'<img class="hover-img"  src="images produits/'.$ligne['image'].'" alt="'.$ligne['image'].'">';
									   if ($ligne['statut'] == 'nouveaute') {
										echo '<span class="new">';
										echo $ligne['statut'];
										echo '</span>';
									} if ($ligne['statut'] == 'en_promo') {
										echo '<span class="price-dec">';
										echo $ligne['statut'];
										echo '</span>';
									} if ($ligne['statut'] == 'en_rupture_de_stock') {
										echo '<span class=" out-of-stock">';
										echo $ligne['statut'];
										echo '</span>';
									} 
									   echo	'</a>';
									   echo	' <div class="button-head">';
									   echo	'<div class="product-action">';
									   echo		'<a data-toggle="modal" data-target="#exampleModal" title="Quick View" href="page-produit.php?afficherproduitid='.$ligne['produit_id'].'" ><i class=" ti-eye"></i><span>Voir les details</span></a>';
									   echo	'	<br>';

									   echo	'</div>';
									   echo' <form method="post" action="">';

									   echo '	<div class="product-action-2">';

									   echo	'	<button class="add_cart_button" type="submit" name="ajouter_au_panier" title="Add to cart">Ajouter au panier</button>';
									   echo  '   <input type="hidden" name="produit_id" value="'.$ligne['produit_id'].'">';

									   echo'	</div>';
									   echo	'</div>';
									   echo	'</div>';
									   echo  '  </form>';

									   echo	'<div class="product-content">';
									   echo		'<h3><a href="page-produit.php?afficherproduitid='.$ligne['produit_id'].'"> ';
									   echo $ligne['nom'];

									   echo '</a></h3>';
									   echo'	<div class="product-price">';
									   echo	'	<span> ';
									   echo $ligne['prix_vente']." DA";
									   echo'</span>';
									   echo	'</div>';
									   echo	'	</div>';
									   echo	'</div>';
									   echo  '</div>';




			 }}


			 echo '</div>';

			 echo  ' </section>';
			 echo  ' </main>';
	?>










	


<?php include 'footer.php';?>
	

</body>
</html>