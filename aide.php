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
      <section class="hero">
        <div class="hero-content">
          <h1>Aide pour les utilisateurs</h1>
        </div>
      </section>
      <section class="faq">
        <div class="faq-content">
          <h2>Questions fréquentes</h2>
          <ul>
            <li>
            <h3>Comment ouvrir un compte?</h3>
<p>Pour ouvrir un compte, cliquez sur le bouton "Se connecter" dans le coin supérieur droit de l'en-tête, puis cliquez sur "S'inscrire" et remplissez le formulaire d'inscription. Une fois votre compte créé, vous pourrez vous connecter et accéder à toutes les fonctionnalités du site.</p>
<li>
  <h3>Comment voir les produits?</h3>
  <p>Pour voir les produits, parcourez les différentes catégories de produits sur la page d'accueil ou utilisez la barre de recherche pour trouver un produit spécifique, ou accédez directement à la page des produits en utilisant le bouton dans l'en-tête.</p>
</li>
<li>
  <h3>Comment laisser des commentaires?</h3>
  <p>Pour laisser des commentaires, accédez à la page du produit que vous souhaitez commenter et trouvez la section "Commentaires". Vous pouvez alors écrire et soumettre votre commentaire.</p>
</li>
<li>
  <h3>Comment gérer le panier?</h3>
  <p>Pour gérer le panier, cliquez sur l'icône "Panier" dans le coin supérieur droit de la page. Vous pouvez alors ajouter ou supprimer des produits de votre panier, modifier les quantités et passer une commande lorsque vous le souhaitez, si vous êtes connecté(e).</p>
</li>
<li>
  <h3>Comment passer une commande?</h3>
  <p>Pour passer une commande, assurez-vous d'être connecté(e) et cliquez sur "Passer une commande". Remplissez ensuite le formulaire de commande pour finaliser votre commande.</p>
</li>
<li>
  <h3>Comment proposer un offre?</h3>
  <p>Pour proposer un offre, accédez à la page du produit pour lequel vous souhaitez proposer un offre et trouvez la section "Proposer un offre". Vous pouvez alors soumettre votre offre. Notez que si vous avez déjà participé à un offre ou proposé un offre pour ce produit, vous ne pourrez pas proposer une autre offre pour ce même produit.</p>
</li>
<li>
  <h3>Comment participer à un offre?</h3>
  <p>Pour participer à un offre, accédez à la page du produit dans la section "Proposer/Participer à un offre". Vous pouvez choisir l'offre à laquelle vous souhaitez participer et remplir un formulaire de participation. Vous pouvez ensuite soumettre votre participation. Notez que si vous avez déjà participé à un offre ou proposé un offre pour ce produit, vous ne pourrez pas proposer une autre offre pour ce même produit.</p>
</li>
          </ul>
        </div>
      </section>
    </main>

    <?php include 'footer.php';?>

</body>
</html>