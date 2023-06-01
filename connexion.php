
<?php
session_start();
require_once('bd.php');

if(isset($_POST['submit']))
{
    $errors = array();
    $success = array();

    $email = trim($_POST['email']);
    $password = trim($_POST['mot_de_passe']);

    // Vérifier si l'utilisateur est un administrateur
    $sql = "SELECT * FROM administrateur WHERE email = :email AND mot_de_passe = :password";
    $handle = $pdo->prepare($sql);
    $params = ['email' => $email, 'password' => $password];
    $handle->execute($params);
    $adminRow = $handle->fetch(PDO::FETCH_ASSOC);

    if($handle->rowCount() > 0)
    {
        // Si l'utilisateur est un administrateur, vérifier si les informations de connexion sont correctes
        $sql = "SELECT * FROM administrateur WHERE email = :email";
        $handle = $pdo->prepare($sql);
        $params = ['email' => $email];
        $handle->execute($params);

        if($handle->rowCount() > 0)
        {
            $getRow = $handle->fetch(PDO::FETCH_ASSOC);

            if(strcmp($password, $getRow['mot_de_passe']) == 0)
            {
                unset($getRow['mot_de_passe']);
                $_SESSION = $getRow;
                header('location: admin/profile.php');
                exit();
            }
            else
            {
                $errors['mot_de_passe'] = "Mot de passe incorrect.";
            }
        }
    }
    else
    {
        // Si l'utilisateur n'est pas un administrateur, vérifier s'il existe dans la table utilisateur
        // Vérifier si l'adresse email est valide
        // J'ai utilisé 'filter_var' pour valider l'adresse email, car c'est généralement considéré comme la méthode la plus simple et la plus sûre.
        if (empty($_POST['email']))
        {
            $errors['email'] = "Vous devez saisir l'adresse email.";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        {
            $errors['email'] = "L'adresse email n'est pas valide.";
        }
        else
        {
            $sql = "SELECT * FROM utilisateur WHERE email = :email";
            $handle = $pdo->prepare($sql);
            $params = ['email' => $email];
            $handle->execute($params);

            // Vérification de l'existence de l'adresse email
            if($handle->rowCount() > 0)
            {
                $getRow = $handle->fetch(PDO::FETCH_ASSOC);
                $success['email'] = "";
            }
            else
            {
                $errors['email'] = "Compte n'existe pas.";
            }
        }

        if (empty($_POST['mot_de_passe']))
        {
            $errors['mot_de_passe'] = "Vous devez saisir le mot de passe.";
        }

        if(empty($errors))
        {
            $email = trim($_POST['email']);
            $password = trim($_POST['mot_de_passe']);

            if(strcmp($password, $getRow['mot_de_passe']) == 0)
            {
                unset($getRow['mot_de_passe']);
                $_SESSION['utilisateur_id'] = $getRow['utilisateur_id'];
                $_SESSION['nom'] = $getRow['nom'];
                $_SESSION['prenom'] = $getRow['prenom'];
                $_SESSION['image_profile'] = $getRow['image_profile'];
                if (isset($_SESSION['panier']))
                {
                    $panier = $_SESSION['panier'];
                }
                $success['mot_de_passe'] = "";
                header('location: accueil.php');
                exit();
            }
            else
            {
                $errors['mot_de_passe'] = "Mot de passe incorrect.";
            }
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Document</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
    <script>

$(document).ready(function() {
  <?php
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



    if(isset($errors['mot_de_passe'])) {
        foreach($errors as $error) {
          echo "$('.form-control.mot_de_passe').addClass('error');\n";
        }
      }
      if(isset($success['mot_de_passe'])) {
        foreach($success as $suc) {
          echo "$('.form-control.mot_de_passe').addClass('success');\n";
        }
      }
      ?>
    });
    
    </script>
</head>

<body>

<?php include 'header.php';?>
<?php
if (isset($_SESSION['error_message'])) {
    echo '<div class="alert alert-danger">' . $_SESSION['error_message'] . '</div>';
	unset($_SESSION['error_message']);
  }
  if (isset($_SESSION['success_inscription'])){
    echo '<div class="alert alert-success">' . $_SESSION['success_inscription'] . '</div>';
	unset($_SESSION['success_inscription']);
  }
  ?>


<div class="connexion">

<form class="form" id="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">

    <div class="content">

      <p>Connexion</p>

            <div class="form-control email" >
            <label for="email">Email :</label>
                <input type="email" placeholder="Adresse email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                <small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
                <small><?php echo isset($success['email']) ? $success['email'] : ''; ?></small>            </div>

                        <div class="form-control mot_de_passe">
                        <label for="mot_de_passe">Mot de passe :</label>
                         <input type="password" placeholder="Mot de passe" name="mot_de_passe" id="mot_de_passe" value="<?php echo isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : ''; ?>">
                         <small><?php echo isset($errors['mot_de_passe']) ? $errors['mot_de_passe'] : ''; ?></small>
                         <small><?php echo isset($success['mot_de_passe']) ? $success['mot_de_passe'] : ''; ?></small>                        </div>




                            <div class="button">

							<button class="connexion-button" type="button" onclick="window.location.href='inscription.php'">S'inscrire</button>
              <button class="inscription-button" type="submit" name="submit" id="submit"> Se connecter</button>



                        </div>
    </div>

</form>

</div>
<?php include 'footer.php';?>

</body>

</html>
