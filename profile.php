<?php
session_start();
require_once('bd.php');

if(isset($_SESSION['utilisateur_id'])) {
} else {
    $_SESSION['error_message'] ="Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
    header('location:connexion.php');
}


$utilisateur_id = $_SESSION['utilisateur_id'];

$req = $pdo->prepare('SELECT * FROM utilisateur WHERE utilisateur_id = :utilisateur_id');
$req->execute(['utilisateur_id' => $utilisateur_id]);

$user = $req->fetch();

$nom = $user['nom'];
$prenom = $user['prenom'];
$email = $user['email'];
$image_profile = $user['image_profile'];

if(empty($image_profile)) {
    $image_profile = "image-profile.png"; // Specify the path of your default profile picture
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/profile.css">

    <title>Document</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
 
</head>
<body>

<?php include 'header.php';?>

    <section class="home-section">

    <div class="profile-container">
            <div class="profile-picture">
                <img src="images/<?php echo $image_profile;?>" alt="Profile Picture">
            </div>
            <div class="user-details">
                <div class="field">
                    <label for="nom">utilisateur</label>
                </div>
                <div class="field">
                    <label for="nom">Id:</label>
                    <span id="nom"> <?php echo $utilisateur_id; ?></span>
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
                <button class="edit-profile-button"><a href="modifier-profile.php?modifierid=<?php echo $utilisateur_id; ?>">Modifier le profil</a></button>
            </div>
        </div>
    </section>
</section>
<?php include 'footer.php';?>
</body>

</body>

</html>

