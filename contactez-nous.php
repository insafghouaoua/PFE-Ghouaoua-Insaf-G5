<?php
session_start();
if(isset($_SESSION['utilisateur_id'])) {
} else {

}


require_once('bd.php');

$errors = array();

if(isset($_POST['submit']))
{
    
    if(empty($_POST['email']))
    {
        $errors['email'] = "Veuillez saisir votre adresse email.";
    }

    elseif(!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", trim($_POST['email'])))
    {
        $errors['email'] = "L'adresse email n'est pas valide.";
    }
    else{
        $success['email']="";
    }
    if(empty($_POST['message']))
    {
        $errors['message'] = "Veuillez saisir un message.";
    }
    else{
        $success['message']="";
    }

    if(empty($errors))
    {
        $email = trim($_POST['email']);
        $message = trim($_POST['message']);

        $sql = 'SELECT * from contact where email = :email';
        $stmt = $pdo->prepare($sql);
        $p = ['email'=>$email];
        $stmt->execute($p);

        $sql = "INSERT into contact (email, message) values(:email,:message)";
        $stmt = $pdo->prepare($sql);
        $stmt->execute(['email' => $email, 'message' => $message]);

         $success['envoi']="Votre message a été envoyé avec succès.";
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



    if(isset($errors['message'])) {
        foreach($errors as $error) {
          echo "$('.form-control.message').addClass('error');\n";
        }
      }
      if(isset($success['message'])) {
        foreach($success as $suc) {
          echo "$('.form-control.message').addClass('success');\n";
        }
      }
      ?>
    });
    
    </script></head>
<body>
    <?php include 'header.php';?>

    <?php 
if(isset($success['envoi']))
    {
        echo '<div class="alert alert-success">'.$success['envoi'].'</div>';
    }
    ?>

    <main>
        <div class="connexion">
            <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">
                <div class="content">
                    <p>Vous avez une question ou un commentaire? Envoyez-nous un message et nous vous répondrons dès que possible.</p>
                    <div class="form-control email">
                    <label for="email">Email :</label>
                        <input type="email" placeholder="Votre adresse email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : ''; ?>">
                        <small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
                        <small><?php echo isset($success['email']) ? $success['email'] : ''; ?></small>

                    </div>
                    <div class="form-control message">
                    <label for="message">Message :</label>
                        <input type="text" placeholder="Votre message" name="message" id="message" value="<?php echo isset($_POST['message']) ? $_POST['message'] : ''; ?>">
                        <small><?php echo isset($errors['message']) ? $errors['message'] : ''; ?></small>
                        <small><?php echo isset($success['message']) ? $success['message'] : ''; ?></small>

                    </div>
                    <div class="button">
                        <br>
                        <br>
                        <button class="inscription-button" type="submit" name="submit" id="submit"> Envoyer</button>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <?php include 'footer.php';?>
</body>
</html>
