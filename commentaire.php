<?php

require_once('bd.php');

if (isset($_GET['afficherproduitid'])) {
  $produit_id = $_GET['afficherproduitid'];
}

if(isset($_SESSION['utilisateur_id'])) {
  $utilisateur_id = $_SESSION['utilisateur_id'];

$req = $pdo->prepare('SELECT * FROM utilisateur WHERE utilisateur_id = :utilisateur_id');
$req->execute(['utilisateur_id' => $utilisateur_id]);

$user = $req->fetch();
}


    if(isset($_POST['submit']))
    {


        $errors = array();
        $success = array();

        $produit_id = $_POST['produit_id'];
        if(isset($_SESSION['utilisateur_id'])) {
        $utilisateur_id = $_SESSION['utilisateur_id'];
        }
        else{
        $utilisateur_id = "";
        }
        if(isset($_SESSION['nom'])) {
        $nom = $_SESSION['nom'];
        }
        else{
        $nom = "Utilisateur"; 
        }
        if(isset($_SESSION['prenom'])) {
        $prenom = $_SESSION['prenom'];
        }
        else{
        $prenom = "inconnu"; 
        }
        if(isset($user['image_profile'])) {
        $image_profile = $user['image_profile'];
        }
        else{
        $image_profile = "image-profile.png"; 
        }
        $commentaire = ($_POST['commentaire']);


  

        if (empty($_POST['commentaire']) ){
          $errors['commentaire'] = "Vous devez ecrire un commentaire.";
      }
      else{
          $success['commentaire']="";
      }


      if (empty($errors)) {

                $sql = "INSERT INTO commentaire ( produit_id,utilisateur_id, nom, prenom,image_profile, commentaire, cree_le) values( :produit_id,:utilisateur_id, :nom, :prenom,:image_profile, :commentaire, :cree_le)";
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                      ':produit_id'=>$produit_id,
                        ':utilisateur_id'=>isset($_SESSION['utilisateur_id']) ? $_SESSION['utilisateur_id'] : null,
                        ':nom'=>$nom,
                        ':prenom'=>$prenom,
                        ':image_profile'=>$image_profile,
                        ':commentaire'=>$commentaire,
                        ':cree_le' => date('Y-m-d H:i:s')


                    ];
                    $handle->execute($params);

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
    <link rel="stylesheet" href="css/page-produit.css">

    <link rel="stylesheet" href="css/fenetre-form.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>


    <title>commentaire</title>
<script>

$(document).ready(function() {
  <?php

if(isset($errors['commentaire'])) {
  foreach($errors as $error) {
    echo "$('.form-control.commentaire').addClass('error');\n";
  }
}
    if(isset($success['commentaire'])) {
        foreach($success as $suc) {
          echo "$('.form-control.commentaire').addClass('success');\n";
        }
      }

    if(isset($success['commentaire'])){
        foreach($success as $suc) {

        echo "$('.form-control.commentaire').addClass('success');\n";

        }
    }
  ?>
});

</script>
  </head>
  <body>

<div class="commentaire">


  <div class="col-12">
            <div class="comments">
                <h3 class="reply-title comment-title">Commentaires: </h3>
  <?php
$sql = "SELECT * FROM commentaire WHERE produit_id = :produit_id ORDER BY cree_le DESC";
$stmt = $pdo->prepare($sql);
$stmt->bindValue(':produit_id', $produit_id, PDO::PARAM_INT);
$stmt->execute();
$commentaires = $stmt->fetchAll();
if (!empty($commentaires)) {
    foreach ($commentaires as $com) {
        $nom = $com['nom'];
        $prenom = $com['prenom'];
        $image_profile = $com['image_profile'];
        $cree_le = $com['cree_le'];
        $commentaire = $com['commentaire'];
        if(empty($image_profile)) {
          $image_profile = $com['image_profile'] = "image-profile.png"; 
          }
?>


                <div class="single-comment">
                <img src="images/<?php echo $image_profile;?>" alt="#">
                    <div class="content">
                        <h6><?php echo $com['nom']; ?> <?php echo $com['prenom']; ?><span> <?php echo $com['cree_le']; ?></span></h6>
                        <p><?php echo $com['commentaire']; ?></p>
                    </div>
                </div>

<?php
    }
} else {
    ?>
    <p>Aucun commentaire pour ce produit.</p>
<?php
}
?>
            </div>
        </div>
<div class="connexion">

<form id="form" class="form" method="POST" action="page-produit.php?afficherproduitid=<?php echo $produit_id; ?>">


  <div class="aligner">

  <input type="hidden" name="produit_id" value="<?php echo $produit_id; ?>">


                <div class="ajouter-commentaire">
                <h3 class="reply-title comment-title">Ajouter un commentaire: </h3>
                    <input type="text" placeholder="Ajouter un commentaire" name="commentaire" id="commentaire" value="<?php echo isset($_POST['commentaire']) ? $_POST['commentaire'] : ''; ?>">
                    <small><?php echo isset($errors['commentaire']) ? $errors['commentaire'] : ''; ?></small>
                    <small><?php echo isset($success['commentaire']) ? $success['commentaire'] : ''; ?></small>


                        <div class="button">

                        <button class="orange-white-button" type="submit" name="submit" id="submit"> Ajouter</button>
                        </div>

                        </div>

</form>
</div>

</div>
</div>

  </body>
</html>