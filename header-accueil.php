<?php

require_once('bd.php');
$panier_count = '';

$panier_count = 0;

if (isset($_SESSION['panier'])) {
  $nb_produits_session = count($_SESSION['panier']);
  $panier_count += $nb_produits_session;
}
if (isset($_SESSION['utilisateur_id'])) {

	$utilisateur_id = $_SESSION['utilisateur_id'];
$panier_count_query = $pdo->prepare('SELECT COUNT(*) FROM panier WHERE utilisateur_id = :utilisateur_id');
$panier_count_query->execute(['utilisateur_id' => $utilisateur_id]);
$panier_count += $panier_count_query->fetchColumn();


}


?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>header-accueil</title>

	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
	
	<!-- Web Font -->
	<link href="https://fonts.googleapis.com/css?family=Poppins:200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i&display=swap" rel="stylesheet">
	
	<!-- StyleSheet -->
	
	<!-- Bootstrap -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Font Awesome -->
    <link rel="stylesheet" href="css/font-awesome.css">

	<!-- Themify Icons -->
    <link rel="stylesheet" href="css/themify-icons.css">
	<!-- Nice Select CSS -->
    <link rel="stylesheet" href="css/niceselect.css">
	<!-- Animate CSS -->
    <link rel="stylesheet" href="css/animate.css">


	
	<!-- Eshop StyleSheet -->
	<link rel="stylesheet" href="css/reset.css">
	<link rel="stylesheet" href="css/header-footer.css">
    <link rel="stylesheet" href="css/responsive.css">

	
	
</head>
<body class="js">

	
	
	<!-- Header -->
	<header class="header header shop">
		<!-- Topbar -->
		<div class="topbar">
			<div class="container">
				<div class="row">
					<div class="col-lg-4 col-md-12 col-12">
						<!-- Top Left -->
						<div class="top-left">
							<ul class="list-main">
								<li><i class="ti-mobile"></i>+213 55 30 89 17</li>
								<li><i class="ti-email"></i>info@partageonsbiens.com</li>
							</ul>
						</div>
						<!--/ End Top Left -->
					</div>
					<div class="col-lg-8 col-md-12 col-12">
						<!-- Top Right -->
						<div class="right-content">
							<ul class="list-main">
								<li><i class="ti-location-pin"></i> Annaba.Algerie</li>
								<li><i class="ti-alarm-clock"></i>7/24</li>
								<li id="profile-button"><i class="ti-user"></i> <a href="profile.php">Mon compte</a></li>
								<li><i class="ti-power-off"></i><a id="login-button" href="connexion.php" >Se connecter</a></li>
							</ul>
						</div>
						<!-- End Top Right -->
					</div>
				</div>
			</div>
		</div>
		<!-- End Topbar -->
		<div class="middle-inner">
			<div class="container">
				<div class="row">
					<div class="col-lg-2 col-md-2 col-12">
						<!-- Logo -->
						<div class="logo">
							<a href="accueil.php"><img src="images/logo.png" alt="logo"></a>
						</div>
						<!--/ End Logo -->
						<!-- Search Form -->
						<div class="search-top">
							<div class="top-search"><a href="#0"><i class="ti-search"></i></a></div>
							<!-- Search Form -->
							<div class="search-top">
							<form class="search-form" action="search.php" method="GET">
									<input type="text" placeholder="Chercher des produits..." name="search">
									<button value="search" type="submit"><i class="ti-search"></i></button>
								    </form>
										
								</div>
								<!--/ End Search Form -->
							</div>
							<!--/ End Search Form -->
							<div class="mobile-nav"></div>
						</div>
						<div class="col-lg-8 col-md-7 col-12">
							<div class="search-bar-top">
								<form action="search.php" method="GET">
								<div class="search-bar">

									<select class="nice-select" name="categorie">
										<option class="option" value="produits" selected="selected">Categories</option>
										<option class="option" value="produits-jardinage">Produits de jardinage et d'extérieur</option>
										<option class="option" value="produits-maison">Articles pour la maison</option>
										<option class="option" value="produits-loisirs">Produits de loisirs</option>
									</select>
									<input name="search" placeholder="Chercher des produits..." type="search">
									<button class="btnn" type="submit"><i class="ti-search"></i></button>
								</form>
							</div>
						</div>
					</div>
					<div class="col-lg-2 col-md-3 col-12">
						<div class="right-bar">
							<!-- Search Form -->
						
							<div class="sinlge-bar">
								<a href="profile.php" class="single-icon"><i class="fa fa-user-circle-o" aria-hidden="true"></i></a>
							</div>
							<div class="sinlge-bar shopping">
								<a href="panier.php" class="single-icon"><i class="ti-shopping-cart"></i> 
								<?php if($panier_count > 0): ?>
									<span class="total-count"><?php echo $panier_count; ?></span>
									<?php endif; ?></a>
							   </a>

							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Header Inner -->
		<div class="header-inner">
			<div class="container">
				<div class="cat-nav-head">
					<div class="row">
						<div class="col-lg-3">
							<div class="all-category">
								<h3 class="cat-heading"><i class="fa fa-bars" aria-hidden="true"></i>Categories</h3>
								<ul class="main-category">

									
									<li><a href="produits-jardinage.php">Produits de jardinage et d'extérieur</a></li>
									<li><a href="produits-maison.php">Articles pour la maison</a></li>
									<li><a href="produits-loisirs.php">Produits de loisirs</a></li>

								</ul>
							</div>
						</div>
						<div class="col-lg-9 col-12">
							<div class="menu-area">
								<!-- Main Menu -->
								<nav class="navbar navbar-expand-lg">
									<div class="navbar-collapse">	
										<div class="nav-inner">	
											<ul class="nav main-menu menu navbar-nav">
													<li class="active"><a href="accueil.php">Accueil</a></li>
													<li><a href="produits.php">Produits</a></li>												
													<li><a href="a-propos.php">A propos</a></li>
													<li><a href="#">Achat<i class="ti-angle-down"></i></a>
														<ul class="dropdown">
															<li><a href="produits.php">Produits</a></li>
															<li><a href="panier.php">Panier</a></li>
														</ul>
													</li>

													<li><a href="aide.php">Aide</a></li>

													<li><a href="contactez-nous.php">Contactez-nous</a></li>
												</ul>
										</div>
									</div>
								</nav>
								<!--/ End Main Menu -->	
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--/ End Header Inner -->
	</header>
	<!--/ End Header -->




	<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/js.js"></script>

	<script>
$(document).ready(function(){
  <?php if(isset($_SESSION['utilisateur_id'])): ?>
    $('#login-button').text('Se deconnecter').attr('href', 'deconnexion.php');
	$('#profile-button').show();
  <?php else: ?>
    $('#profile-button').hide();
  <?php endif; ?>
});
</script>

    </body>
    </html>