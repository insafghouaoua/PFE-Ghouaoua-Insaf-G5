<?php
session_start();
require_once('bd.php');

if(!isset($_SESSION['administrateur_id'])) {
  $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
  header('location:../connexion.php');
  exit;
}



if (isset($_GET['modifierid'])) {
  $utilisateur_id = $_GET['modifierid'];
  $stmt = $pdo->prepare('SELECT * FROM utilisateur WHERE utilisateur_id = :utilisateur_id');
  $stmt->execute (array('utilisateur_id' => $utilisateur_id));
  $utilisateur = $stmt->fetch(PDO::FETCH_ASSOC);
}

if(isset($_POST['submit'])) {


        $errors = array();
        $success = array();

        $utilisateur_id = $_POST['utilisateur_id'];
        $image_profile = $_POST['image_profile'];

        $firstName =$_POST['nom'];
        $lastName =$_POST['prenom'];
        $birthdate =$_POST['datedenaissance'];
        $email =$_POST['email'];
        $mobile =$_POST['telephone'];
        $password =$_POST['mot_de_passe'];
        $password_confirmation =$_POST['confirmation_mot_de_passe'];




        // Validate the inputs
        if (!empty($_POST['image_profile']) ){

          $success['image_profile']="";
      }
        if (empty($_POST['nom']) ){
            $errors['nom'] = "Vous devez saisir le nom.";
        }
        else if(!preg_match('/^[A-Za-z]+$/', $firstName)) {
            $errors['nom'] = "Le nom doit contenir seulement des lettres.";
        }
        else{
            $success['nom']="";
        }




        if (empty($_POST['prenom']) ){
            $errors['prenom'] = "Vous devez saisir le prenom.";
        }
        else if (!preg_match('/^[A-Za-z]+$/', $lastName)) {
            $errors['prenom'] = "Le prénom doit contenir seulement des lettres.";
        }
        else{
            $success['prenom']="";
        }




                if (empty($_POST['datedenaissance']) ){
                    $errors['datedenaissance'] = "Vous devez saisir la date de naissance.";
                }
                else{
                    $success['datedenaissance']="";
                }



        // vérifier si l'adresse email est valide
        // pourquoi j'ai choisi'filter_var' et non pas la verification avec l'expression reguliaure car elle est généralement considérée comme la méthode la plus simple et la plus sûre pour valider une adresse e-mail.
        if (empty($_POST['email']) ){
            $errors['email'] = "Vous devez saisir l'adresse' email.";
        }
        else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = "L'adresse email n'est pas valide.";
        }
        else{
            $success['email']="";
        }



        
                if (!empty($_POST['telephone']) ){

                    $success['telephone']="";
                }


        if (empty($_POST['mot_de_passe']) ){
            $errors['mot_de_passe'] = "Vous devez saisir le mot de passe.";
        }
        else if (!preg_match('/^(?=.*[A-Z])(?=.*\d).{8,}$/', $password)) {
            $errors['mot_de_passe'] = "Le mot de passe doit contenir au moins 8 caractères, une lettre majuscule et un chiffre";
        }
        else{
            $success['mot_de_passe']="";
        }




        if (empty($_POST['confirmation_mot_de_passe']) ){
            $errors['confirmation_mot_de_passe'] = "Vous devez saisir une autre fois le mot de passe.";
        }
        else if ($password !== $password_confirmation) {
            $errors['confirmation_mot_de_passe'] = "Les mots de passe ne sont pas identiques.";
        }
        else{
            $success['confirmation_mot_de_passe']="";
        }


          if (empty($errors)) {
             $sql = "UPDATE utilisateur SET image_profile=:image_profile, nom=:nom, prenom=:prenom, datedenaissance=:datedenaissance, genre=:genre, email=:email, telephone=:telephone, `mot_de_passe`=:mot_de_passe WHERE utilisateur_id=:utilisateur_id";
                try{
                  $handle = $pdo->prepare($sql);
                  $params = [
                    ':image_profile'=>isset($_POST['image_profile']) ? $_POST['image_profile'] : null,
                      ':nom'=>$firstName,
                      ':prenom'=>$lastName,
                      ':genre'=>isset($_POST['genre']) ? $_POST['genre'] : null,
                      ':datedenaissance'=>$birthdate,
                      ':telephone'=>isset($_POST['telephone']) ? $_POST['telephone'] : null,
                      ':email'=>$email,
                      ':mot_de_passe'=>$password,
                      ':utilisateur_id'=>$utilisateur_id

                  ];
                  $handle->execute($params);
                  header('Location: utilisateurs.php');
                  $success['inscription'] = 'Les informations de l\'utilisateur ont bien été modifier.';
              }
              catch(PDOException $e){
                  $errors[] = $e->getMessage();
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
    <link rel="stylesheet" href="css/fenetre-form.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <title>Modifier utilisateur</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
<script>

$(document).ready(function() {
  <?php
      if(isset($errors['image_profile'])) {
        foreach($errors as $error) {
          echo "$('.form-control.image_profile').addClass('error');\n";
        }
      }
    if(isset($success['image_profile'])) {
      foreach($success as $suc) {
        echo "$('.form-control.image_profile').addClass('success');\n";
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


    if(isset($errors['datedenaissance'])) {
        foreach($errors as $error) {
          echo "$('.form-control.datedenaissance').addClass('error');\n";
        }
      }
    if(isset($success['datedenaissance'])) {
      foreach($success as $suc) {
        echo "$('.form-control.datedenaissance').addClass('success');\n";
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

    
    if(isset($success['telephone'])) {
        foreach($success as $suc) {
          echo "$('.form-control.telephone').addClass('success');\n";
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

    if(isset($errors['confirmation_mot_de_passe'])) {
        foreach($errors as $error) {
          echo "$('.form-control.confirmation_mot_de_passe').addClass('error');\n";
        }
      }
    if(isset($success['confirmation_mot_de_passe'])) {
      foreach($success as $suc) {
        echo "$('.form-control.confirmation_mot_de_passe').addClass('success');\n";
      }
    }

    if(isset($success['nom']) && isset($success['prenom']) && isset($success['datedenaissance']) && isset($success['email']) && isset($success['telephone']) && isset($success['mot_de_passe']) && isset($success['confirmation_mot_de_passe'])){
        foreach($success as $suc) {
          echo "$('.form-control.image_profile').addClass('success');\n";

        echo "$('.form-control.nom').addClass('success');\n";
        echo "$('.form-control.prenom').addClass('success');\n";
        echo "$('.form-control.datedenaissance').addClass('success');\n";
        echo "$('.form-control.email').addClass('success');\n";
        echo "$('.form-control.telephone').addClass('success');\n";
        echo "$('.form-control.mot_de_passe').addClass('success');\n";
        echo "$('.form-control.confirmation_mot_de_passe').addClass('success');\n";
        }
    }
  ?>
});

</script>
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">


    <div class="connexion">

    <form id="form" class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">


<div class="content ">


  <p>Modifier les informations de l'utilisateur</p>

  <input type="hidden" name="utilisateur_id" value="<?php echo $utilisateur_id; ?>">

  <div class="form-control image_profile">
                    <label for="image_profile">Photo de profile :</label>
                    <input type="file" placeholder="Photo de profile" name="image_profile" id="image_profile" value="<?php echo isset($_POST['image_profile']) ? $_POST['image_profile'] : ''; ?>">
                    <small><?php echo isset($errors['image_profile']) ? $errors['image_profile'] : ''; ?></small>
                        <small><?php echo isset($success['image_profile']) ? $success['image_profile'] : ''; ?></small>

                    </div>
                    
        <div class="form-control nom">
        <label for="nom">Nom* :</label>
        <input type="text" placeholder="Nom" name="nom" id="nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : $utilisateur['nom']; ?>">
        <small><?php echo isset($errors['nom']) ? $errors['nom'] : ''; ?></small>
        <small><?php echo isset($success['nom']) ? $success['nom'] : ''; ?></small>


        </div>


            <div class="form-control prenom">
            <label for="prenom">Prenom* :</label>
              <input type="text" placeholder="Prenom" name="prenom" id="prenom" value="<?php echo isset($_POST['prenom']) ? $_POST['prenom'] : $utilisateur['prenom']; ?>">
              <small><?php echo isset($errors['prenom']) ? $errors['prenom'] : ''; ?></small>
              <small><?php echo isset($success['prenom']) ? $success['prenom'] : ''; ?></small>


            </div>




            <div class="form-control datedenaissance">
            <label for="datedenaissance" >Date de naissance* :</label>
            <input type="date" id="datedenaissance" name="datedenaissance" value="<?php echo isset($_POST['datedenaissance']) ? $_POST['datedenaissance'] : $utilisateur['datedenaissance']; ?>">
            <small><?php echo isset($errors['datedenaissance']) ? $errors['datedenaissance'] : ''; ?></small>
            <small><?php echo isset($success['datedenaissance']) ? $success['datedenaissance'] : ''; ?></small>

            </div>




            <div class="inputgenre">
            <label for="genre">Genre:</label>
            <div class="radioinputgenre">
                <div class="radioinputgenrehomme">


                  <input type="radio" id="genre" name="genre" value="homme"<?php echo (isset($_POST['genre']) && $_POST['genre'] == 'homme') ? ' checked' : ''; ?> >
                  <h7 for="homme">Homme</h7>
                </div>


                <div class="radioinputgenrefemme">


                  <input type="radio" id="genre" name="genre" value="femme"<?php echo (isset($_POST['genre']) && $_POST['genre'] == 'femme') ? ' checked' : ''; ?>>
                   <h7 for="femme">Femme</h7>
                </div>
            </div>
            </div>






           
                <div class="form-control email">
                <label for="email">Email* :</label>
                    <input type="email" placeholder="Adresse email" name="email" id="email" value="<?php echo isset($_POST['email']) ? $_POST['email'] : $utilisateur['email']; ?>">
                    <small><?php echo isset($errors['email']) ? $errors['email'] : ''; ?></small>
                    <small><?php echo isset($success['email']) ? $success['email'] : ''; ?></small>

                </div>


                <div class="form-control telephone">
                <label for="telephone">Numero de telephone :</label>
                    <input type="tel" placeholder="Numero de telephone" name="telephone" id="telephone" value="<?php echo isset($_POST['telephone']) ? $_POST['telephone'] : $utilisateur['telephone']; ?>">
                    <small><?php echo isset($errors['telephone']) ? $errors['telephone'] : ''; ?></small>
                    <small><?php echo isset($success['telephone']) ? $success['telephone'] : ''; ?></small>

                </div>




                    <div class="form-control mot_de_passe">
                    <label for="mot_de_passe">Mot de passe* :</label>
                     <input type="password" placeholder="Mot de passe" name="mot_de_passe" id="mot_de_passe" value="<?php echo isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : $utilisateur['mot_de_passe']; ?>">
                     <!--<li>Le mot de passe doit contenir au moins 8 caractères et inclure au moins une lettre minuscule, une lettre majuscule, un chiffre et un caractère spécial (par exemple @$!%*?&).</li>-->
                     <small><?php echo isset($errors['mot_de_passe']) ? $errors['mot_de_passe'] : ''; ?></small>
                     <small><?php echo isset($success['mot_de_passe']) ? $success['mot_de_passe'] : ''; ?></small>

                    </div>


                         <div class="form-control confirmation_mot_de_passe">
                         <label for="confirmation_mot_de_passe">Confirmez le mot de passe* :</label>
                           <input type="password" placeholder="Confirmez mot de passe" name="confirmation_mot_de_passe" id="confirmation_mot_de_passe" value="<?php echo isset($_POST['mot_de_passe']) ? $_POST['mot_de_passe'] : $utilisateur['mot_de_passe']; ?>">
                           <small><?php echo isset($errors['confirmation_mot_de_passe']) ? $errors['confirmation_mot_de_passe'] : ''; ?></small>
                           <small><?php echo isset($success['confirmation_mot_de_passe']) ? $success['confirmation_mot_de_passe'] : ''; ?></small>

                        </div>


                        <div class="button">


                        <button class="connexion-button" type="button" onclick="window.location.href='utilisateurs.php'">Annuler</button>
                        <button class="inscription-button" type="submit" name="submit" id="submit"> Modifier</button>



                    </div>



</form>
  </div>
</div>




</section>


</body>
</html>