<?php
session_start();


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
    <link rel="stylesheet" href="css/aide.css">

    <title>Aide</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">

<main>
      <section class="hero">
        <div class="hero-content">
          <h1>Aide et FAQ</h1>
        </div>
      </section>
      <section class="faq">
        <div class="faq-content">
          <h2>Questions fréquentes</h2>
          <ul>
          <li>
              <h3>Comment gérer les produits?</h3>
              <p>Pour gérer les produits et les offres, accédez à la section "Produits" dans le menu. Vous pouvez voir les details des produits, ajouter, modifier ou supprimer des produits.</p>
            </li>

            <li>
              <h3>Comment gérer les offres et les participations?</h3>
              <p>Pour gérer les offres, accédez à la section "offres" dans le menu. Vous pouvez supprimer des participations et des offres.</p>
            </li>

            <li>
              <h3>Comment gérer les commentaires?</h3>
              <p>Pour gérer les commentaires, accédez à la section "Commentaires" dans le menu. Vous pouvez supprimer des commentaires.</p>
            </li>

            <li>
              <h3>Comment gérer les utilisateurs?</h3>
              <p>Pour gérer les utilisateurs, accédez à la section "Utilisateurs" dans le menu. Vous pouvez voir les details des utilisateurs, modifier ou supprimer des utilisateurs selon vos besoins.</p>
            </li>

            <li>
              <h3>Comment gérer les commandes?</h3>
              <p>Pour gérer les commandes, accédez à la section "Commandes" dans le menu. Vous pouvez afficher le pdf des factures pour les commandes simples et des factures + contrats pour les commandes partagées, vous pouvez les supprimer selon vos besoins.</p>
            </li>

            <li>
              <h3>Comment gérer les messages de contacts?</h3>
              <p>Pour gérer les messages de contacts, accédez à la section "Contacts" dans le menu. Vous pouvez afficher ou supprimer les messages des clients.</p>
            </li>
          </ul>
        </div>
      </section>
    </main>


</body>
</html>