<?php
session_start();
require_once('bd.php');

if(!isset($_SESSION['administrateur_id'])) {
    $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
    header('location:../connexion.php');
    exit;
}


if (isset($_GET['detailsid'])) {
    $utilisateur_id = $_GET['detailsid'];

    $sql = "SELECT * FROM utilisateur WHERE utilisateur_id = :utilisateur_id";
    $stmt = $pdo->prepare($sql);
    $stmt->bindValue(':utilisateur_id', $utilisateur_id, PDO::PARAM_INT);
    $stmt->execute();
    
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if (empty($user['image_profile'])) {
        $user['image_profile'] = "image-profile.png";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Details utilisateurs</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <?php include 'menu.php';?>

    <section class="home-section">
        <div class="profile-container">
            <div class="profile-picture">
            <?PHP
    echo ' <img src="../images/'. $user['image_profile']. '" alt="Profile Picture">';
    echo '     </div>';
    echo '       <div class="admin-details">';
    echo '            <div class="field">';
    echo '                <label for="nom">Utilisateur</label>';
    echo '           </div>';
    echo '           <div class="field">';
    echo '              <label for="nom">Id:</label>';
    echo '               <span id="nom"> '. $user['utilisateur_id']. ' </span>';
    echo '           </div>';
    echo '           <div class="field">';
    echo '               <label for="nom">Nom:</label>';
    echo '               <span id="nom"> '. $user['nom']. ' </span>';
    echo '            </div>';
    echo '            <div class="field">';
    echo '                <label for="prenom">Prenom:</label>';
    echo '                <span id="prenom"> '. $user['prenom']. ' </span>';
    echo '            </div>';
    echo '            <div class="field">';
    echo '               <label for="genre">genre:</label>';
    echo '               <span id="genre"> '. $user['genre']. ' </span>';
    echo '           </div>';
    echo '          <div class="field">';
    echo '              <label for="datedenaissance">datedenaissance:</label>';
    echo '               <span id="datedenaissance"> '. $user['datedenaissance']. ' </span>';
    echo '          </div>';
    echo '          <div class="field">';
    echo '              <label for="email">Email:</label>';
    echo '              <span id="email"> '. $user['email']. ' </span>';
    echo '          </div>';
    echo '          <div class="field">';
    echo '              <label for="telephone">Telephone:</label>';
    echo '              <span id="telephone"> '. $user['telephone']. ' </span>';
    echo '          </div>                <div class="field">';
    echo '              <label for="mot_de_passe">Mot de passe:</label>';
    echo '                <span id="mot_de_passe"> '. $user['mot_de_passe']. ' </span>';
    echo '            </div>';
    echo '           <button class="edit-profile-button"><a href="utilisateurs.php"><i class="bx bx-arrow-back"></i>Retour</a></button>';
    echo '       </div>';
    echo '    </div>';
        
         ?>
    </section>
</body>
</html>