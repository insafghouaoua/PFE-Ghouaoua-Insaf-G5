<?php
session_start();

if(isset($_SESSION['utilisateur_id'])) {
} else {

}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/aide.css">

    <title>Document</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'header.php';?>

<main>

    <div class="container">
      <div class="section">
      <h2>Qui Sommes-Nous</h2>
<p>Nous sommes un nouveau site de commerce électronique offrant une large gamme de produits à des prix compétitifs. Notre plateforme propose également une fonctionnalité unique qui permet le partage des biens entre utilisateurs.</p>
<div class="section">
  <h2>Notre Histoire</h2>
  <p>Nous avons été fondés récemment en 2022 avec une vision claire en tête : créer une plateforme de commerce électronique moderne et innovante. Bien que nous soyons nouveaux sur le marché, notre équipe expérimentée travaille avec passion pour offrir des produits de qualité et des services exceptionnels à nos clients.</p>
</div>
<div class="section">
  <h2>Notre Équipe</h2>
  <p>Notre équipe est composée de personnes passionnées dévouées à offrir la meilleure expérience possible à nos clients. Du service client à notre personnel d'entrepôt, nous travaillons tous ensemble pour nous assurer que nos clients sont satisfaits de leurs achats.</p>
</div>
<div class="section">
  <h2>Les avantages de notre site</h2>
  <ul>
    <li>Acheter des produits.</li>
    <li>Proposer des offres partagés.</li>
    <li>Participer à des offres d'achats partagés.</li>
  </ul>
</div>
<div class="section">
  <h2>Achat en Groupe</h2>
  <p>Qu'est-ce que l'achat en groupe ? L'achat en groupe consiste à ce qu'un groupe de personnes rassemble leur argent pour acheter un produit collectivement. Chaque membre du groupe paie une partie du coût total du produit.</p>
</div>
<div class="section">
  <h2>Comment fonctionne l'achat en groupe sur ce site Web ?</h2>
  <p>Sur notre site Web, pour chaque produit, vous avez la possibilité de déposer un offre ou de participer à un offre existant en remplissant un formulaire. Ce formulaire comprend des informations telles que le pourcentage à payer, l'adresse e-mail, l'adresse postale, si vous le souhaitez, un commentaire facultatif.</p>
</div>
  </main>
  <?php include 'footer.php';?>

</body>
</html>