<?php
session_start();
require_once('bd.php');
if(isset($_SESSION['utilisateur_id'])) {
} else {
  $_SESSION['error_message'] ="Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";

  header('location:connexion.php');

}

if(isset($_POST['submit']))
{
    $errors = array();
    $success = array();

    $type = $_POST['type'];
    $nom = trim($_POST['nom']);
    $prenom = trim($_POST['prenom']);
    $telephone = trim($_POST['telephone']);
    $email = trim($_POST['email']);
    $wilaya = $_POST['wilaya'];
    $adresse_postale = trim($_POST['adresse_postale']);



    // Validate the inputs

    if (empty($_POST['nom']) ){
        $errors['nom'] = "Vous devez saisir le nom.";
    }
    else if(!preg_match('/^[A-Za-z]+$/', $nom)) {
        $errors['nom'] = "Le nom doit contenir seulement des lettres.";
    }
    else{
        $success['nom']="";
    }


    if (empty($_POST['prenom']) ){
        $errors['prenom'] = "Vous devez saisir le prenom.";
    }
    else if (!preg_match('/^[A-Za-z]+$/', $prenom)) {
        $errors['prenom'] = "Le prénom doit contenir seulement des lettres.";
    }
    else{
        $success['prenom']="";
    }


            if (empty($_POST['telephone']) ){
                $errors['telephone'] = "Vous devez saisir le numero de telephone.";
            }
            else{
                $success['telephone']="";
            }



    // vérifier si l'adresse email est valide
    // pourquoi j'ai choisi'filter_var' et non pas la verification avec l'expression reguliaure car elle est généralement considérée comme la méthode la plus simple et la plus sûre pour valider une adresse e-mail.
    if (empty($_POST['email']) ){
        $errors['email'] = "Vous devez saisir l'adresse email.";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email n'est pas valide.";
    }
    else{
        $success['email']="";
    }


    if (empty($_POST['wilaya']) ){
      $errors['wilaya'] = "Vous devez choisir une wilaya.";
  }
  else{
      $success['wilaya']="";
  }



  if (empty($_POST['adresse_postale']) ){
    $errors['adresse_postale'] = "Vous devez saisir l'adresse postale.";
}
else{
    $success['adresse_postale']="";
}



if (empty($errors)) {

  $stmt = $pdo->prepare("INSERT INTO commande (utilisateur_id, type, nom, prenom, telephone, email, wilaya, adresse_postale) VALUES (:utilisateur_id, :type, :nom, :prenom, :telephone, :email, :wilaya, :adresse_postale)");
  $stmt->execute([
    'utilisateur_id' => $_SESSION['utilisateur_id'],
    'type' => $type,
    'nom' => $nom,
    'prenom' => $prenom,
    'telephone' => $telephone,
    'email' => $email,
    'wilaya' => $wilaya,
    'adresse_postale' => $adresse_postale
  ]);

  // Récupérer l'identifiant de la commande générée
  $commande_id = $pdo->lastInsertId();


  $panier_id = $_SESSION['panier_id'];


  $panier = $pdo->prepare("SELECT pp.produit_id, pp.nom, pp.quantite, p.prix_vente
                        FROM panier_produit pp
                        JOIN produit p ON pp.produit_id = p.produit_id
                        WHERE pp.panier_id = :panier_id");
$panier->execute(['panier_id' => $panier_id]);




while ($ligne = $panier->fetch()) {
  $produit_id = $ligne['produit_id'];
  $nom = $ligne['nom'];
  $prix_vente = $ligne['prix_vente'];
  $quantite = $ligne['quantite'];

  $stmt = $pdo->prepare("INSERT INTO commande_produit (commande_id, produit_id, nom, prix_vente, quantite) VALUES (:commande_id, :produit_id, :nom, :prix_vente, :quantite)");
  $stmt->execute([
    'commande_id' => $commande_id,
    'produit_id' => $produit_id,
    'nom' => $nom,
    'prix_vente' => $prix_vente,
    'quantite' => $quantite
  ]);
}
unset($_SESSION['panier_id']);
$_SESSION['success_commande'] = 'Votre commande a bien été passée.';
        header('location:vide_panier.php');
}

}
else{
if(empty($_SESSION['panier'])){
  header('location:panier.php');

  $_SESSION['panier_errors'] = "Votre panier est vide, vous devez ajouter au moins un produit.";
}

  $utilisateur_id = $_SESSION['utilisateur_id'];

  if (isset($_SESSION['panier'])) {
    $panier = $_SESSION['panier'];
    $utilisateur_id = $_SESSION['utilisateur_id'];

    $sql = "INSERT INTO panier (utilisateur_id) VALUES (:utilisateur_id)";
    $handle = $pdo->prepare($sql);
    $handle->execute(['utilisateur_id' => $utilisateur_id]);
    $panier_id = $pdo->lastInsertId();

    foreach ($panier as $produits) {
        $produit_id = $produits['produit_id'];
        $produit = $produits['nom'];
        $image = $produits['image'];
        $quantite = $produits['quantite'];
        $prix = $produits['prix'];

        $sql = "INSERT INTO panier_produit (panier_id, produit_id, nom, image, quantite, prix_vente) VALUES (:panier_id, :produit_id, :nom, :image, :quantite, :prix_vente)";
        try {
            $handle = $pdo->prepare($sql);
            $params = [
                ':panier_id' => $panier_id,
                ':produit_id' => $produit_id,
                ':nom' => $produit,
                ':image' => $image,
                ':quantite' => $quantite,
                ':prix_vente' => $prix
            ];
            $handle->execute($params);
        } catch (PDOException $e) {
            $errors[] = $e->getMessage();
        }
    }
    $_SESSION['panier_id'] = $panier_id;
    unset($_SESSION['panier']);
}

$sql = "SELECT * FROM panier WHERE utilisateur_id = :utilisateur_id";
$stmt = $pdo->prepare($sql);
$stmt->execute([':utilisateur_id' => $utilisateur_id]);
$panier = $stmt->fetch(PDO::FETCH_ASSOC);
$errors = array();


}

  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Commande</title>
	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
<script>

$(document).ready(function() {
  <?php
    if(isset($errors['type'])) {
      foreach($errors as $error) {
        echo "$('.form-control.type').addClass('error');\n";
      }
    }
  if(isset($success['type'])) {
    foreach($success as $suc) {
      echo "$('.form-control.type').addClass('success');\n";
    }
  }
    if(isset($errors['nom'])) {
        foreach($errors as $error) {
          echo "$('.form-control.nom').addClass('error');\n";
        }
      }
    if(isset($success['nom'])) {
      foreach($success as $suc) {
        echo "$('.form-control.nom').addClass('success');\n";
      }
    }

    if(isset($errors['prenom'])) {
        foreach($errors as $error) {
          echo "$('.form-control.prenom').addClass('error');\n";
        }
      }
    if(isset($success['prenom'])) {
      foreach($success as $suc) {
        echo "$('.form-control.prenom').addClass('success');\n";
      }
    }


    if(isset($errors['telephone'])) {
        foreach($errors as $error) {
          echo "$('.form-control.telephone').addClass('error');\n";
        }
      }
    if(isset($success['telephone'])) {
      foreach($success as $suc) {
        echo "$('.form-control.telephone').addClass('success');\n";
      }
    }


    if(isset($errors['email'])) {
        foreach($errors as $error) {
          echo "$('.form-control.email').addClass('error');\n";
        }
      }
    if(isset($success['email'])) {
      foreach($success as $suc) {
        echo "$('.form-control.email').addClass('success');\n";
      }
    }

    



    if(isset($errors['wilaya'])) {
        foreach($errors as $error) {
          echo "$('.form-control.wilaya').addClass('error');\n";
        }
      }
    if(isset($success['wilaya'])) {
      foreach($success as $suc) {
        echo "$('.form-control.wilaya').addClass('success');\n";
      }
    }

    if(isset($errors['adresse_postale'])) {
        foreach($errors as $error) {
          echo "$('.form-control.adresse_postale').addClass('error');\n";
        }
      }
    if(isset($success['adresse_postale'])) {
      foreach($success as $suc) {
        echo "$('.form-control.adresse_postale').addClass('success');\n";
      }
    }

    if(isset($success['nom']) && isset($success['prenom']) && isset($success['telephone']) && isset($success['email']) && isset($success['wilaya']) && isset($success['adresse_postale'])){
        foreach($success as $suc) {
          echo "$('.form-control.type').addClass('success');\n";
        echo "$('.form-control.nom').addClass('success');\n";
        echo "$('.form-control.prenom').addClass('success');\n";
        echo "$('.form-control.telephone').addClass('success');\n";
        echo "$('.form-control.email').addClass('success');\n";
        echo "$('.form-control.wilaya').addClass('success');\n";
        echo "$('.form-control.adresse_postale').addClass('success');\n";
        }
    }
  ?>
});

</script>



</head>




<body>


<?php include 'header.php';?>


<?php 



                
                if(isset($success['commande']))
                {
                    
                    echo '<div class="alert alert-success">'.$success['commande'].'</div>';
                }
			?>


<div class="connexion">


<form id="form" class="form" method="POST" action="">


    <div class="content">


      <p>Passer une commande</p>



      <table>
    <tr>
        <th>Produit</th>
        <th>Quantité</th>
        <th>Prix</th>
    </tr>
    <tbody>
        <?php
        $panier_id = $_SESSION['panier_id'];

        $total_price = 0; // initialiser le prix total en dehors de la boucle
        $panier = $pdo->prepare("SELECT p.nom, pp.quantite, pp.prix_vente
                                FROM panier_produit pp
                                JOIN produit p ON pp.produit_id = p.produit_id
                                WHERE pp.panier_id = :panier_id");
        $panier->execute(['panier_id' => $panier_id]);
        while ($ligne = $panier->fetch()) {
            // calculer le prix de chaque article
            $item_price = $ligne['prix_vente'] * $ligne['quantite'];
            // ajouter le prix de chaque article au prix total
            $total_price += $item_price;
        ?>
            <tr>
                <td><?php echo $ligne['nom']; ?></td>
                <td><?php echo $ligne['quantite']; ?></td>
                <td><?php echo $ligne['prix_vente'] . " DA"; ?></td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="2">Prix total:</td>
            <td colspan="2"><?php echo number_format($total_price, 2); ?> DA</td>
        </tr>
    </tbody>
</table>







      <div class="form-control type">
            <label for="type">Type de commande* :</label>

            <select name="type" id="type">
              <option value="simple">Simple</option>
              <option value="partagee">Partagée</option>
              </select>
            <small><?php echo isset($errors['type']) ? $errors['type'] : ''; ?></small>
            <small><?php echo isset($success['type']) ? $success['type'] : ''; ?></small>


            </div>




            <div class="form-control nom">
            <label for="nom">Nom* :</label>
            <input type="text" placeholder="Votre nom" name="nom" id="nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>">
            <small><?php echo isset($errors['nom']) ? $errors['nom'] : ''; ?></small>
            <small><?php echo isset($success['nom']) ? $success['nom'] : ''; ?></small>


            </div>


                <div class="form-control prenom">
                <label for="prenom">Prenom* :</label>
                  <input type="text" placeholder="Votre prenom" name="prenom" id="prenom" value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : ''; ?>">
                  <small><?php echo isset($errors['prenom']) ? $errors['prenom'] : ''; ?></small>
                  <small><?php echo isset($success['prenom']) ? $success['prenom'] : ''; ?></small>


                </div>



                <div class="form-control telephone">
                    <label for="telephone">Numero de telephone* :</label>
                        <input type="tel" placeholder="Numero de telephone" name="telephone" id="telephone" value="<?php echo isset($_POST['telephone']) ? $_POST['telephone'] : ''; ?>">
                        <small><?php echo isset($errors['telephone']) ? $errors['telephone'] : ''; ?></small>
                        <small><?php echo isset($success['telephone']) ? $success['telephone'] : ''; ?></small>

                    </div>



                    <div class="form-control email">
                    <label for="email">Email* :</label>
                        <input type="email" placeholder="Adresse email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
                        <small><?php echo isset($success['email']) ? $success['email'] : ''; ?></small>

                    </div>






                    <div class="form-control wilaya">
                    <label for="wilaya">Wilaya* :</label>

         <select name="wilaya" id="wilaya">
              <option value="1">Adrar</option>
              <option value="2">Chlef</option>
              <option value="3">Laghouat</option>
              <option value="4">Oum El Bouaghi</option>
              <option value="5">Batna</option>
              <option value="6">Béjaïa</option>
              <option value="7">Biskra</option>
              <option value="8">Béchar</option>
              <option value="9">Blida</option>
              <option value="10">Bouira</option>
              <option value="11">Tamanrasset</option>
              <option value="12">Tébessa</option>
              <option value="13">Tlemcen</option>
              <option value="14">Tiaret</option>
              <option value="15">Tizi Ouzou</option>
              <option value="16">Alger</option>
              <option value="17">Djelfa</option>
              <option value="18">Jijel</option>
              <option value="19">Sétif</option>
              <option value="20">Saïda</option>
              <option value="21">Skikda</option>
              <option value="22">Sidi Bel Abbès</option>
              <option value="23">Annaba</option>
              <option value="24">Guelma</option>
              <option value="25">Constantine</option>
              <option value="26">Médéa</option>
              <option value="27">Mostaganem</option>
              <option value="28">M'Sila</option>
              <option value="29">Mascara</option>
              <option value="30">Ouargla</option>
              <option value="31">Oran</option>
              <option value="32">El Bayadh</option>
              <option value="33">Illizi</option>
              <option value="34">Bordj Bou Arreridj</option>
              <option value="35">Boumerdès</option>
              <option value="36">El Tarf</option>
              <option value="37">Tindouf</option>
              <option value="38">Tissemsilt</option>
              <option value="39">El Oued</option>
              <option value="40">Khenchela</option>
              <option value="41">Souk Ahras</option>
              <option value="42">Tipaza</option>
              <option value="43">Mila</option>
              <option value="44">Aïn Defla</option>
              <option value="45">Naâma</option>
              <option value="46">Aïn Témouchent</option>
              <option value="47">Ghardaïa</option>
              <option value="48">Relizane</option>
              <option value="49">Timimoune</option>
            <option value="50">Bordj Badji Mokhtar</option>
            <option value="51">Ouled Djellal</option>
            <option value="52">Beni Abbes</option>
            <option value="53">In Salah</option>
            <option value="54">In Guezzam</option>
            <option value="55">Touggourt</option>
            <option value="56">Djanet</option>
            <option value="57">M'ghair</option>
            <option value="58">El Meniaa</option>
            </select>
              <small><?php echo isset($errors['wilaya']) ? $errors['wilaya'] : ''; ?></small>
              <small><?php echo isset($success['wilaya']) ? $success['wilaya'] : ''; ?></small>


        </div>



                    <div class="form-control adresse_postale">
                <label for="adresse_postale" >Adresse postale* :</label>
                <input type="text" id="adresse_postale" name="adresse_postale" value="<?php echo isset($_POST['adresse_postale']) ? $_POST['adresse_postale'] : ''; ?>">
                <small><?php echo isset($errors['adresse_postale']) ? $errors['adresse_postale'] : ''; ?></small>
                <small><?php echo isset($success['adresse_postale']) ? $success['adresse_postale'] : ''; ?></small>

                </div>





                            <div class="button">

                            <button class="connexion-button" type="button" onclick="window.location.href='vide_panier2.php'">Annuler</button>
                              <button class="inscription-button" type="submit" name="submit" id="submit"> Valider</button>





                        </div>
    </div>


</form>



</div>


<?php include 'footer.php';?>

<script>
window.addEventListener('beforeunload', function(event) {
  // Vérifier si le bouton Annuler ou le bouton Valider a été cliqué
  var clickedButton = event.target.activeElement;
  if (clickedButton.id === 'submit' || clickedButton.innerText === 'Annuler') {
    return; // Ne rien faire si l'un des deux boutons a été cliqué
  }

  // Effectuer une requête AJAX pour exécuter le code vide_panier.php
  var xhr = new XMLHttpRequest();
  xhr.open('GET', 'vide_panier.php', true);
  xhr.send();
});
</script>


</body>


</html>