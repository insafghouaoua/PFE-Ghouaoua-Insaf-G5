<?php
session_start();
require_once('bd.php');

if(isset($_SESSION['utilisateur_id'])) {
} else {
}
$sql = "SELECT * FROM produit";
$stmt = $pdo->prepare($sql);
$stmt->execute();

$produit = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">
			<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/accueil.css">
    <link rel="stylesheet" href="css/responsive.css">

    <title>Document</title>
		<!-- Favicon -->
		<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'header-accueil.php';?>

	<!-- Slider Area -->
	<section class="header hero-slider">
		<!-- Single Slider -->
		<div class="single-slider">
			<div class="container">
				<div class="row no-gutters">
					<div class="col-lg-9 offset-lg-3 col-12">
						<div class="text-inner">
							<div class="row">
								<div class="col-lg-7 col-12">
									<div class="hero-text">
										<h1><span>Partagez vos achats et divisez les coûts. </span>Économisez jusqu'à +50%</h1>
										<p>Rejoignez notre communauté d'acheteurs malins et partagez vos achats ! <br> Proposez ou participez à des offres. <br> Profitez de locasion!</p>
										<div class="button">
											<a href="produits.php" class="btn">Acheter maintenant!</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Single Slider -->
	</section>
	<!--/ End Slider Area -->
	<main class="accueil">




	<section>
		<h2>En promotion</h2>
			<h7>Découvrez les produits en promotion ci-dessous.</h7>
			<ul>
			<?php
            $produit = $pdo->query('SELECT * FROM produit');
			while($ligne = $produit->fetch()){ 
			if($ligne['statut'] == 'en_promo'){ 

			echo'<li>';

			echo	'<img  src="images produits/'.$ligne['image'].'" alt="'.$ligne['image'].'">';
			echo'<h3>'.$ligne['nom'].'</h3>';
					echo'<p>'.$ligne['petite_description'].'</p>';
					echo'<a  href="page-produit.php?afficherproduitid='.$ligne['produit_id'].'">Voir les détails</a>';
					echo'</li>';
				}}?>
				</ul>
					</section>



					<section>
		<h2>Les nouveautés</h2>
			<h7>Découvrez nos nouveautés ci-dessous.</h7>
			<ul>
			<?php
            $produit = $pdo->query('SELECT * FROM produit');
			while($ligne = $produit->fetch()){ 
            if($ligne['statut'] == 'nouveaute'){ 
			echo'<li>';
			echo	'<img  src="images produits/'.$ligne['image'].'" alt="'.$ligne['image'].'">';
			echo'<h3>'.$ligne['nom'].'</h3>';
					echo'<p>'.$ligne['petite_description'].'</p>';
					echo'<a  href="page-produit.php?afficherproduitid='.$ligne['produit_id'].'">Voir les détails</a>';
					echo'</li>';
				}}?>
				</ul>
					</section>
</main>
    <?php include 'footer.php';?>

</body>
</html>