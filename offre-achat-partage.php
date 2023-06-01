<?php
session_start();
require_once('bd.php');

if(isset($_SESSION['utilisateur_id'])) {
} else {
  $_SESSION['error_message'] ="Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";

  header('location:connexion.php');

}
if (isset($_GET['produitid'])) {
  $produit_id = $_GET['produitid'];


$sql = "SELECT * FROM produit WHERE produit_id = :produit_id";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':produit_id', $produit_id, PDO::PARAM_INT);
$stmt->execute();

$ligne = $stmt->fetch(PDO::FETCH_ASSOC);
}

    if(isset($_POST['submit']))
    {

      $utilisateur_id = $_SESSION['utilisateur_id'];

      $req = $pdo->prepare('SELECT * FROM utilisateur WHERE utilisateur_id = :utilisateur_id');
      $req->execute(['utilisateur_id' => $utilisateur_id]);
      
      $user = $req->fetch();

        $errors = array();
        $success = array();

        $produit_id = $_POST['produit_id'];
        $nom = $_SESSION['nom'];
        $prenom = $_SESSION['prenom'];
        if(isset($user['image_profile'])) {
          $image_profile = $user['image_profile'];
          }
          else{
          $image_profile = "image-profile.png"; 
          }
          $wilaya = ($_POST['wilaya']);
        $email = trim($_POST['email']);
        $pourcentage = ($_POST['pourcentage']);
        $duree_utilisation = ($_POST['duree_utilisation']);
        $commentaire = ($_POST['commentaire']);




        // Validate the inputs
        if (empty($_POST['wilaya']) ){
            $errors['wilaya'] = "Vous devez mentionner la wilaya.";
        }
        else{
            $success['wilaya']="";
        }



        // vérifier si l'adresse email est valide
        // pourquoi j'ai choisi'filter_var' et non pas la verification avec l'expression reguliaure car elle est généralement considérée comme la méthode la plus simple et la plus sûre pour valider une adresse e-mail.
        if (empty($_POST['email']) ){
            $errors['email'] = "Vous devez mentionner l'adresse' email.";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse email n'est pas valide.";
        }
        else{
            $success['email']="";
        }


        if (empty($_POST['pourcentage']) ){
            $errors['pourcentage'] = "Vous devez mentionner le pourcentage à payé.";
        }
        else{
            $success['pourcentage']="";
        }



        if (empty($_POST['duree_utilisation']) ){
            $errors['duree_utilisation'] = "Vous devez mentionner la duree d'utilisation.";
        }
        else{
            $success['duree_utilisation']="";
        }


                      if (!empty($_POST['commentaire']) ){

                    $success['commentaire']="";
                }

                if (empty($errors)) {

                  $sql = 'SELECT * from participation_achat_partage where utilisateur_id = :utilisateur_id AND produit_id=:produit_id';  // préparer la requête SQL pour vérifier si l'utilisateur_id existe déjà dans la base de données
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute(['utilisateur_id'=>$utilisateur_id, 'produit_id' => $produit_id]);
                 
                  if($stmt->rowCount() == 0)  //si l'id' n'existe pas dans la base de données
                  {
                  $sql = 'SELECT * from offre_achat_partage where utilisateur_id = :utilisateur_id AND produit_id=:produit_id';  // préparer la requête SQL pour vérifier si l'utilisateur_id existe déjà dans la base de données
                  $stmt = $pdo->prepare($sql);
                  $stmt->execute(['utilisateur_id'=>$utilisateur_id, 'produit_id' => $produit_id]);
                 
                  if($stmt->rowCount() == 0)  //si l'id' n'existe pas dans la base de données
                  {

                $sql = "INSERT INTO offre_achat_partage ( produit_id, utilisateur_id, nom, prenom, image_profile, wilaya, email, pourcentage, duree_utilisation, commentaire, cree_le) values( :produit_id,:utilisateur_id, :nom, :prenom, :image_profile, :wilaya,:email,:pourcentage,:duree_utilisation,:commentaire, :cree_le)";
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                      ':produit_id'=>$produit_id,
                        ':utilisateur_id'=>$utilisateur_id,
                        ':nom'=>$nom,
                        ':prenom'=>$prenom,
                        ':image_profile'=>$image_profile,
                        ':wilaya'=>$wilaya,
                        ':email'=>$email,
                        ':pourcentage'=>$pourcentage,
                        ':duree_utilisation'=>$duree_utilisation,
                        ':commentaire'=>isset($_POST['commentaire']) ? $_POST['commentaire'] : null,
                        ':cree_le' => date('Y-m-d H:i:s'),
                    ];
                    $handle->execute($params);
                    $success['reussi'] = 'Votre proposition a bien été ajouter.';
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
                }}
                else
                {
                    $errors['offre'] = 'Vous avez déjà déposer un offre.';
                }}
                else
                {
                  $errors['offre'] = 'Vous avez déjà participer a un offre.';

                }
            
          }
          $_POST = array();
}


if(isset($_POST['submit2']))
{

  $utilisateur_id = $_SESSION['utilisateur_id'];

  $req = $pdo->prepare('SELECT * FROM utilisateur WHERE utilisateur_id = :utilisateur_id');
  $req->execute(['utilisateur_id' => $utilisateur_id]);
  
  $user = $req->fetch();

    $errors = array();
    $success = array();
    $offre_id = $_POST['offre_id'];

    $produit_id = $_POST['produit_id'];
    $nom = $_SESSION['nom'];
    $prenom = $_SESSION['prenom'];
    if(isset($user['image_profile'])) {
      $image_profile = $user['image_profile'];
      }
      else{
      $image_profile = "image-profile.png"; 
      }    $wilaya = ($_POST['wilaya']);
    $email = trim($_POST['email']);
    $pourcentage = ($_POST['pourcentage']);
    $duree_utilisation = ($_POST['duree_utilisation']);
    $commentaire = ($_POST['commentaire']);





    // Validate the inputs
    if (empty($_POST['wilaya']) ){
        $errors['wilaya'] = "Vous devez mentionner la wilaya.";
    }
    else{
        $success['wilaya']="";
    }



    // vérifier si l'adresse email est valide
    // pourquoi j'ai choisi'filter_var' et non pas la verification avec l'expression reguliaure car elle est généralement considérée comme la méthode la plus simple et la plus sûre pour valider une adresse e-mail.
    if (empty($_POST['email']) ){
        $errors['email'] = "Vous devez mentionner l'adresse' email.";
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors['email'] = "L'adresse email n'est pas valide.";
    }
    else{
        $success['email']="";
    }


    if (empty($_POST['pourcentage']) ){
        $errors['pourcentage'] = "Vous devez mentionner le pourcentage à payé.";
    }
    else{
        $success['pourcentage']="";
    }



    if (empty($_POST['duree_utilisation']) ){
        $errors['duree_utilisation'] = "Vous devez mentionner la duree d'utilisation.";
    }
    else{
        $success['duree_utilisation']="";
    }
    
            if (!empty($_POST['commentaire']) ){

                $success['commentaire']="";
            }

            if (empty($errors)) {

              $sql = 'SELECT * from offre_achat_partage where utilisateur_id = :utilisateur_id AND produit_id=:produit_id';  // préparer la requête SQL pour vérifier si l'utilisateur_id existe déjà dans la base de données
              $stmt = $pdo->prepare($sql);
              $stmt->execute(['utilisateur_id'=>$utilisateur_id, 'produit_id' => $produit_id]);
             
              if($stmt->rowCount() == 0)  //si l'id' n'existe pas dans la base de données
              {

                $sql = 'SELECT * from participation_achat_partage where utilisateur_id = :utilisateur_id AND produit_id=:produit_id';  // préparer la requête SQL pour vérifier si l'utilisateur_id existe déjà dans la base de données
                $stmt = $pdo->prepare($sql);
                $stmt->execute(['utilisateur_id'=>$utilisateur_id, 'produit_id' => $produit_id]);
               
                if($stmt->rowCount() == 0)  //si l'id' n'existe pas dans la base de données
                {
            $sql = "INSERT INTO participation_achat_partage ( offre_id, produit_id, utilisateur_id, nom, prenom, image_profile, wilaya, email, pourcentage, duree_utilisation, commentaire, cree_le) values( :offre_id,:produit_id,:utilisateur_id, :nom, :prenom, :image_profile, :wilaya,:email,:pourcentage,:duree_utilisation,:commentaire, :cree_le)";
            try{
                $handle = $pdo->prepare($sql);
                $params = [
                  ':offre_id'=>$offre_id,

                  ':produit_id'=>$produit_id,
                    ':utilisateur_id'=>$utilisateur_id,
                    ':nom'=>$nom,
                    ':prenom'=>$prenom,
                    ':image_profile'=>$image_profile,
                    ':wilaya'=>$wilaya,
                    ':email'=>$email,
                    ':pourcentage'=>$pourcentage,
                    ':duree_utilisation'=>$duree_utilisation,
                    ':commentaire'=>isset($_POST['commentaire']) ? $_POST['commentaire'] : null,
                    ':cree_le' => date('Y-m-d H:i:s'),
                ];
                $handle->execute($params);
                $success['reussi'] = 'Votre proposition a bien été ajouter.';
            }
            catch(PDOException $e){
                $errors[] = $e->getMessage();
            }}
            else
            {
                $errors['offre'] = 'Vous avez déjà participer a un offre.';
            }
          }
            else
            {
                $errors['offre'] = 'Vous avez déjà déposer un offre.';
            }
        
      }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/connexion.css">
    <link rel="stylesheet" href="css/page-produit.css">
    <link rel="stylesheet" href="css/fenetre-form.css">
    <link rel="stylesheet" href="css/offre-achat-partage.css">

    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>Achat-partage</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
<script>

$(document).ready(function() {
  <?php



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




    if(isset($errors['pourcentage'])) {
        foreach($errors as $error) {
          echo "$('.form-control.pourcentage').addClass('error');\n";
        }
      }
    if(isset($success['pourcentage'])) {
      foreach($success as $suc) {
        echo "$('.form-control.pourcentage').addClass('success');\n";
      }
    }

    if(isset($errors['duree_utilisation'])) {
        foreach($errors as $error) {
          echo "$('.form-control.duree_utilisation').addClass('error');\n";
        }
      }
    if(isset($success['duree_utilisation'])) {
      foreach($success as $suc) {
        echo "$('.form-control.duree_utilisation').addClass('success');\n";
      }
    }
    
    if(isset($success['commentaire'])) {
        foreach($success as $suc) {
          echo "$('.form-control.commentaire').addClass('success');\n";
        }
      }

    if(isset($success['wilaya']) && isset($success['email']) && isset($success['pourcentage']) && isset($success['duree_utilisation']) && isset($success['commentaire'])){
        foreach($success as $suc) {
        echo "$('.form-control.wilaya').addClass('success');\n";
        echo "$('.form-control.email').addClass('success');\n";
        echo "$('.form-control.pourcentage').addClass('success');\n";
        echo "$('.form-control.duree_utilisation').addClass('success');\n";
        echo "$('.form-control.commentaire').addClass('success');\n";

        }
    }
  ?>
});

</script>
  </head>
  <body>
  <?php include 'header.php';?>
	<main>
  <section class="home-section">
  <?php

echo' <div class="product">';
echo' <div class="product-image">';
echo'     <img  src="images produits/'.$ligne['image'].'" alt="Product Image">';
echo'   </div>';
echo'   <div class="product-informations">';
echo'     <h2 class="product-title">' . $ligne['nom'] . '</h2>';
echo'     <p class="product-description">' . $ligne['petite_description'] . '</p>';
echo  '<p>Statut:  ' . $ligne['statut'] . '</p>';

echo'     <div class="product-actions">';
echo'       <span class="product-price">Prix: ' . $ligne['prix_vente'] . ' DA</span>';
echo'       <button class="black-button"> <a  href="page-produit.php?afficherproduitid='.$ligne['produit_id'].'">Voir les détails</a></button>';
echo'       <button class="orange-button"id="btn-fenetre">Déposer un offre</button>';

echo'    </div>';
echo'  </div>';
echo' </div>';
?>







    <div id="fenetre" class="fenetre">
  <div class="fenetre-content">
<div class="connexion">

<form id="form" class="form" method="POST" action="offre-achat-partage.php?produitid=<?php echo $produit_id; ?>">
<div class="content ">


  <p>Déposer un offre</p>


  <input type="hidden" name="produit_id" value="<?php echo $produit_id; ?>">
  

        <div class="form-control n2 wilaya">
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

        <div class="form-control n2 email">
                <label for="email">Email* :</label>
                    <input type="email" placeholder="Adresse email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
                    <small><?php echo isset($success['email']) ? $success['email'] : ''; ?></small>

                </div>

                <div class="form-control n2 pourcentage">
                <label for="pourcentage">Pourcentage a payé* :</label>
                <select name="pourcentage" id="pourcentage">
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="30">30%</option>
                    <option value="40">40%</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                    <option value="100">100%</option>
                </select>
                
                <small><?php echo isset($errors['pourcentage']) ? $errors['pourcentage'] : ''; ?></small>
                    <small><?php echo isset($success['pourcentage']) ? $success['pourcentage'] : ''; ?></small>

                </div>



                <div class="form-control n2 duree_utilisation">
                <label for="duree_utilisation">La durée d'utilisation* (par mois) :</label>
                <select name="duree_utilisation" id="duree_utilisation">
                    <option value="1">1/30</option>
                    <option value="2">2/30</option>
                    <option value="3">3/30</option>
                    <option value="4">4/30</option>
                    <option value="5">5/30</option>
                    <option value="6">6/30</option>
                    <option value="7">7/30</option>
                    <option value="8">8/30</option>
                    <option value="9">9/30</option>
                    <option value="10">10/30</option>
                    <option value="11">11/30</option>
                    <option value="12">12/30</option>
                    <option value="13">13/30</option>
                    <option value="14">14/30</option>
                    <option value="15">15/30</option>
                    <option value="16">16/30</option>
                    <option value="17">17/30</option>
                    <option value="18">18/30</option>
                    <option value="19">19/30</option>
                    <option value="20">20/30</option>
                    <option value="21">21/30</option>
                    <option value="22">22/30</option>
                    <option value="23">23/30</option>
                    <option value="24">24/30</option>
                    <option value="25">25/30</option>
                    <option value="26">26/30</option>
                    <option value="27">27/30</option>
                    <option value="28">28/30</option>
                    <option value="29">29/30</option>
                    <option value="30">30/30</option>

                </select>
                <small><?php echo isset($errors['duree_utilisation']) ? $errors['duree_utilisation'] : ''; ?></small>
                    <small><?php echo isset($success['duree_utilisation']) ? $success['duree_utilisation'] : ''; ?></small>

                </div>
                <div class="form-control email">
                <label for="commentaire">Commentaire :</label>
                    <input type="text" placeholder="Ajouter un commentaire" name="commentaire" id="commentaire" value="<?php echo isset($_POST['commentaire']) ? $_POST['commentaire'] : ''; ?>">
                    <small><?php echo isset($errors['commentaire']) ? $errors['commentaire'] : ''; ?></small>
                    <small><?php echo isset($success['commentaire']) ? $success['commentaire'] : ''; ?></small>
                </div>
                        <div class="button">
                        <button class="connexion-button" type="button" onclick="window.location.href='offre-achat-partage.php?produitid=<?php echo $produit_id; ?>'">Annuler</button>

                        <button class="inscription-button" type="submit" name="submit" id="submit"> Déposer</button>

                    </div>



</form>
</div>
</div>
</div>
</div>
</div>
<?php 

                
                if(isset($errors['offre']))
                {
                    
                    echo '<div class="alert alert-danger">'.$errors['offre'].'</div>';
                }
			?>



<section class="offer">


<h2>Les offres</h2>
<ul>

<?php
$sql = "SELECT * FROM offre_achat_partage WHERE produit_id = :produit_id ORDER BY cree_le DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':produit_id', $produit_id, PDO::PARAM_INT);
$stmt->execute();
$offres = $stmt->fetchAll();
if (!empty($offres)) {
    foreach ($offres as $ofr) {
        $offre_id = $ofr['offre_id'];
        $nom = $ofr['nom'];
        $prenom = $ofr['prenom'];
        $image_profile = $ofr['image_profile'];
        $cree_le = $ofr['cree_le'];
        $wilaya = $ofr['wilaya'];
        $email = $ofr['email'];
        $pourcentage = $ofr['pourcentage'];
        $duree_utilisation = $ofr['duree_utilisation'];
        $commentaire = $ofr['commentaire']; 
  
?>

				<li>
        <div class="single-comment">
					<img src="images/<?php echo $image_profile; ?>" alt="#">

					<h3><?php echo $ofr['nom']; ?> <?php echo $ofr['prenom']; ?><p><?php echo $ofr['cree_le']; ?></p></h3>
					
          </div>
          <div class="content">
<!-- &nbsp;  pour faire lespace-->

          <h3><i class="bx bx-map"></i>&nbsp;La wilaya:<p><?php echo $ofr['wilaya']; ?></p></h3>
          <h3><i class="bx bx-envelope"></i>&nbsp;L'adresse email:<p><?php echo $ofr['email']; ?></p></h3>
          <h3><i class='bx bxs-offer'></i>&nbsp;Le pourcentage a payé:<p><?php echo $ofr['pourcentage']; ?>%</p></h3>
          <h3><i class="bx bx-time"></i>&nbsp;La duree d'utilisation (par mois):<p><?php echo $ofr['duree_utilisation']; ?>/30</p></h3>
          <?php
          if($ofr['commentaire']!= ''){
            ?>
          <h3><i class="bx bx-comment"></i>&nbsp;Commentaire:<p><?php echo $ofr['commentaire']; ?></p></h3>
          <input type="hidden" name="offre_id" value="<?php echo $offre_id; ?>">
          <?php
        }
          ?>

<?php
$query = "SELECT COUNT(*) FROM participation_achat_partage WHERE offre_id = :offre_id";
$stmt = $pdo->prepare($query);
$stmt->bindValue(':offre_id', $offre_id, PDO::PARAM_INT);
$stmt->execute();
$nb_participation = $stmt->fetchColumn();
?>

          <h3><i class="bx bx-hash"></i>&nbsp;Nombre de participants a cet offre:<p>(<?php echo $nb_participation; ?>)</p></h3>
          </div>


<div class="product-actions">

          <button class="black-button " id="btn-fenetre3-<?php echo $offre_id; ?>">Voir les participants</button>

          <button class="orange-button " id="btn-fenetre2-<?php echo $offre_id; ?>">Participer à cette offre</button>


          </div>
</li>
          
<div id="fenetre3-<?php echo $offre_id; ?>" class="fenetre">
  <div class="fenetre-content">
<div class="connexion">

<div class="content ">





  <p>Les participations</p>


  <section class="offer">


<ul>
<?php
$query = "SELECT COUNT(*) FROM participation_achat_partage WHERE offre_id = ?";
$stmt = $pdo->prepare($query);
$stmt->bindParam(1, $offre_id);
$stmt->execute();
$nb_participation = $stmt->fetchColumn();
?>

          <h6><i class="bx bx-hash"></i>&nbsp;Nombre de participants a cet offre: (<?php echo $nb_participation; ?>)</h6>
<?php
$sql = "SELECT * FROM participation_achat_partage WHERE offre_id = :offre_id ORDER BY cree_le DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':offre_id', $offre_id, PDO::PARAM_INT);
$stmt->execute();
$participations = $stmt->fetchAll();
if (!empty($participations)) {
    foreach ($participations as $part) {
        $offre_id = $part['offre_id'];
        $nom = $part['nom'];
        $prenom = $part['prenom'];
        $image_profile = $part['image_profile'];
        $cree_le = $part['cree_le'];
        $wilaya = $part['wilaya'];
        $email = $part['email'];
        $pourcentage = $part['pourcentage'];
        $duree_utilisation = $part['duree_utilisation'];
        $commentaire = $part['commentaire']; 

?>

				<li>
        <div class="single-comment">
					<img src="images/<?php echo $image_profile; ?>" alt="Produit 1">

					<h3><?php echo $part['nom']; ?> <?php echo $part['prenom']; ?><p><?php echo $part['cree_le']; ?></p></h3>
					
          </div>

          <h3><i class="bx bx-map"></i>&nbsp;La wilaya:<p><?php echo $part['wilaya']; ?></p></h3>
          <h3><i class="bx bx-envelope"></i>&nbsp;L'adresse email:<p><?php echo $part['email']; ?></p></h3>
          <h3><i class='bx bxs-offer'></i>&nbsp;Le pourcentage a payé:<p><?php echo $part['pourcentage']; ?>%</p></h3>
          <h3><i class="bx bx-time"></i>&nbsp;La duree d'utilisation (par mois):<p><?php echo $part['duree_utilisation']; ?>/30</p></h3>
          <?php
          if($part['commentaire']!= ''){
            ?>
          <h3><i class="bx bx-comment"></i>&nbsp;Commentaire:<p><?php echo $part['commentaire']; ?></p></h3>
          <input type="hidden" name="offre_id" value="<?php echo $offre_id; ?>">
          <?php
        }
          ?>




</li>

<?php
}
} else {
?>
<p>Aucune participation pour cet offre.</p>
<?php
}
?>
</ul>


</div>
</div>
</div>
</div>
</div>







<div id="fenetre2-<?php echo $offre_id; ?>" class="fenetre">
  <div class="fenetre-content">
<div class="connexion">


<form id="form" class="form" method="POST" action="offre-achat-partage.php?produitid=<?php echo $produit_id; ?>">
<div class="content ">

  <p>Participer a cet offre</p>


  <input type="hidden" name="produit_id" value="<?php echo $produit_id; ?>">
  <input type="hidden" name="offre_id" value="<?php echo $ofr['offre_id']; ?>">

        <div class="form-control n2 wilaya">
        <label for="email">Wilaya* :</label>

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

        <div class="form-control n2 email">
                <label for="email">Email* :</label>
                    <input type="email" placeholder="Adresse email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                    <small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
                    <small><?php echo isset($success['email']) ? $success['email'] : ''; ?></small>

                </div>

                <div class="form-control n2 pourcentage">
                <label for="pourcentage">Pourcentage a payé* :</label>
                <select name="pourcentage" id="pourcentage">
                    <option value="10">10%</option>
                    <option value="20">20%</option>
                    <option value="30">30%</option>
                    <option value="40">40%</option>
                    <option value="50">50%</option>
                    <option value="60">60%</option>
                    <option value="70">70%</option>
                    <option value="80">80%</option>
                    <option value="90">90%</option>
                    <option value="100">100%</option>
                </select>
                
                <small><?php echo isset($errors['pourcentage']) ? $errors['pourcentage'] : ''; ?></small>
                    <small><?php echo isset($success['pourcentage']) ? $success['pourcentage'] : ''; ?></small>

                </div>



                <div class="form-control n2 duree_utilisation">
                <label for="duree_utilisation">La durée d'utilisation* (par mois) :</label>
                <select name="duree_utilisation" id="duree_utilisation">
                    <option value="1">1/30</option>
                    <option value="2">2/30</option>
                    <option value="3">3/30</option>
                    <option value="4">4/30</option>
                    <option value="5">5/30</option>
                    <option value="6">6/30</option>
                    <option value="7">7/30</option>
                    <option value="8">8/30</option>
                    <option value="9">9/30</option>
                    <option value="10">10/30</option>
                    <option value="11">11/30</option>
                    <option value="12">12/30</option>
                    <option value="13">13/30</option>
                    <option value="14">14/30</option>
                    <option value="15">15/30</option>
                    <option value="16">16/30</option>
                    <option value="17">17/30</option>
                    <option value="18">18/30</option>
                    <option value="19">19/30</option>
                    <option value="20">20/30</option>
                    <option value="21">21/30</option>
                    <option value="22">22/30</option>
                    <option value="23">23/30</option>
                    <option value="24">24/30</option>
                    <option value="25">25/30</option>
                    <option value="26">26/30</option>
                    <option value="27">27/30</option>
                    <option value="28">28/30</option>
                    <option value="29">29/30</option>
                    <option value="30">30/30</option>

                </select>
                <small><?php echo isset($errors['duree_utilisation']) ? $errors['duree_utilisation'] : ''; ?></small>
                    <small><?php echo isset($success['duree_utilisation']) ? $success['duree_utilisation'] : ''; ?></small>

                </div>
                <div class="form-control email">
                <label for="commentaire">Commentaire :</label>
                    <input type="text" placeholder="Ajouter un commentaire" name="commentaire" id="commentaire" value="<?php echo isset($_POST['commentaire']) ? $_POST['commentaire'] : ''; ?>">
                    <small><?php echo isset($errors['commentaire']) ? $errors['commentaire'] : ''; ?></small>
                    <small><?php echo isset($success['commentaire']) ? $success['commentaire'] : ''; ?></small>
                </div>
                        <div class="button">
                        <button class="connexion-button" type="button" onclick="window.location.href='offre-achat-partage.php?produitid=<?php echo $produit_id; ?>'">Annuler</button>

                        <button class="inscription-button" type="submit" name="submit2" id="submit2"> Ajouter</button>

                    </div>



</form>
</div>
</div>
</div>
</div>
</div>

<?php
}
} else {
?>
<p>Aucun offre pour ce produit.</p>
<?php
}
?>
</ul>



      </section>
    </main>
    </section>
    <script>
      function initWindow(windowId, btnId) {
  var btn = document.getElementById(btnId);
  var window = document.getElementById(windowId);

  btn.onclick = function() {
    window.style.display = "block";
  }

  window.addEventListener("click", function(event) {
    if (event.target == window) {
      window.style.display = "none";
    } else if (event.target.parentElement == window) {
      return; 
    }
  });
}

initWindow("fenetre", "btn-fenetre");

function initWindows() {
  document.addEventListener("click", function(event) {
    if (event.target.matches("[id^='btn-fenetre2-']")) {
      var offerId = event.target.getAttribute("id").replace("btn-fenetre2-", "");
      var window = document.getElementById("fenetre2-" + offerId);
      window.style.display = "block";
    } else if (event.target.matches("[id^='btn-fenetre3-']")) {
      var offerId = event.target.getAttribute("id").replace("btn-fenetre3-", "");
      var window = document.getElementById("fenetre3-" + offerId);
      window.style.display = "block";
    } else if (event.target.matches(".fenetre")) {
      event.target.style.display = "none";
    }
  });
}

initWindows();


</script>

    <?php include 'footer.php';?>

  </body>
</html>