<?php
session_start();
require_once('bd.php');
function afficherProduitsPanier($produits) {
	if(count($produits) > 0) {
        
		echo '<table>';
		echo '<thead>
        <tr>
            <th>Produit</th>
            <th>Image</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Supprimer</th>
        </tr>
    </thead>';
    $total_price = 0; // initialiser le prix total en dehors de la boucle**

		foreach($produits as $produit) {
         echo '  <tbody>';
                // calculer le prix de chaque article
                $item_price = $produit['prix'] * $produit['quantite'];
                // ajouter le prix de chaque article au prix total
                $total_price += $item_price;
                echo ' <tr>';
                echo '   <td> '.$produit['nom'].'</td>';
                echo '    <td>';
                echo '       <div class="produit-img">';
                echo '           <img class="produit-img" src="images produits/'. $produit['image'].'" alt="'.$produit['image'].' ?>">';
                echo '      </div>';
                echo '   </td>';
                echo '   <td>';
                echo '       <form method="post" action="modifier-panier.php">';
                echo '           <input type="hidden" name="produit_id" value="'. $produit['produit_id'].'">';
                echo '           <input type="number" name="quantite" min="1" max="99" value="'. $produit['quantite'].'" onchange="this.form.submit()">';
                echo '       </form>';
                echo '   </td>';
                    echo '   <td>'. $produit['prix']. " DA".'</td>';
                echo '   <td>';
                echo '           <input type="hidden" name="produit_id" value="'. $produit['produit_id'].'">';
                echo '  <button class="supprimer-button"><a href="supprimer-produits-panier.php?supprimerid='.$produit['produit_id'].' ">Supprimer</a></button>';
                echo '   </td>';
                echo '   </tr>';
        }
                echo '  <tr>';
                echo '     <td colspan="3">Prix total:</td>';
                echo '     <td colspan="1">'. number_format($total_price, 2).' DA</td>';
                echo ' </tr>';
                echo '  </tbody>';
		echo '</table>';
	 }else {
        echo '<table>';
		echo '<thead>
        <tr>
            <th>Produit</th>
            <th>Image</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Supprimer</th>
        </tr>
    </thead>';
    echo '  <tbody>';
   echo' <tr>';

   echo '<td  colspan="5"> Votre panier est vide. </td>';
   echo' </tr>';

        echo '  </tbody>';
		echo '</table>';
	}
}

?>

<!DOCTYPE html>
<html>
<head>
    
	<title>Panier</title>
	<link rel="stylesheet" type="text/css" href="style.css">
    <link rel="stylesheet" href="css/connexion.css">
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>
            <?php include 'header.php';?>
            <?php
            if(isset($_SESSION['success_commande']))
                {
                    echo '<div class="alert alert-success">'.$_SESSION['success_commande'].'</div>';
                    unset($_SESSION['success_commande']);

                }
                if (isset($_SESSION['panier_errors'])) {
                    echo '<div class="alert alert-danger">' . $_SESSION['panier_errors'] . '</div>';
                    unset($_SESSION['panier_errors']);
                  
                  }
                ?>
    <div class="connexion">

		<h2>Panier</h2>

	<main>
		<?php

    // Utilisateur non connecté
    if(isset($_SESSION['panier'])) {
        $panier = $_SESSION['panier'];
        afficherProduitsPanier($panier);
    } else {
        echo '<table>';
		echo '<thead>
        <tr>
            <th>Produit</th>
            <th>Image</th>
            <th>Quantité</th>
            <th>Prix</th>
            <th>Supprimer</th>
        </tr>
    </thead>';
    echo '  <tbody>';
   echo' <tr>';

		echo '<td colspan="5"> Votre panier est vide. </td>';
        echo' </tr>';

        echo '  </tbody>';
		echo '</table>';    }



?>
	</main>

	<footer>
        
    <button class='white-button' type='button' onclick="window.location.href='produits.php'">Continuer vos achats</button>
		<?php
		if(isset($_SESSION['utilisateur_id'])) {
            // Utilisateur connecté
            echo "<button class='inscription-button' type='button' onclick=\"window.location.href='commande.php'\">passer une commande</button>";
        } else {
            // Utilisateur non connecté
            echo "<button class='white-grey-button' type='button' onclick=\"window.location.href='connexion.php'\">Connectez-vous pour passer commande</button>";

        }
        
		?>
	</footer>

            </div>

            <?php include 'footer.php';?>
</body>
</html>