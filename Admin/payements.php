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

    <title>Document</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">

 <img src="images/developpement.jpg" alt="">

</section>
</body>
</html>