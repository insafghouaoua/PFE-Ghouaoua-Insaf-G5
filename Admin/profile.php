<?php
session_start();
require_once('bd.php');


if(!isset($_SESSION['administrateur_id'])) {
    $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
    header('location:../connexion.php');
    exit;
}


$administrateur_id = $_SESSION['administrateur_id'];


$req = $pdo->prepare('SELECT * FROM administrateur WHERE administrateur_id = :administrateur_id');
$req->execute(['administrateur_id' => $administrateur_id]);
$admin = $req->fetch();

$nom = $admin['nom'];
$prenom = $admin['prenom'];
$email = $admin['email'];
$image_profile = $admin['image_profile'];

if(empty($image_profile)) {
    $image_profile = "image-profile.png";
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">
    <title>Profile</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
    <?php include 'menu.php';?>

    <section class="home-section">
        <div class="profile-container">
            <div class="profile-picture">
                <img src="images/<?php echo $image_profile;?>" alt="Profile Picture">
            </div>
            <div class="admin-details">
                <div class="field">
                    <label for="nom">Administratrice</label>
                </div>
                <div class="field">
                    <label for="nom">Id:</label>
                    <span id="nom"> <?php echo $administrateur_id; ?></span>
                </div>
                <div class="field">
                    <label for="nom">Nom:</label>
                    <span id="nom"> <?php echo $nom; ?></span>
                </div>
                <div class="field">
                    <label for="prenom">Prenom:</label>
                    <span id="prenom"> <?php echo $prenom; ?></span>
                </div>
                <div class="field">
                    <label for="email">Email:</label>
                    <span id="email"> <?php echo $email; ?></span>
                </div>
                <button class="edit-profile-button"><a href="modifier-profile.php?modifierid=<?php echo $administrateur_id; ?>">Modifier le profil</a></button>
            </div>
        </div>
    </section>
</body>
</html>
