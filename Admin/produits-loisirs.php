<?php
session_start();
require_once('bd.php');

if(!isset($_SESSION['administrateur_id'])) {
  $_SESSION['error_message'] = "Vous n'êtes pas connecté, vous devez vous connecter ou vous inscrire pour accéder à cette page.";
  header('location:../connexion.php');
  exit;
}

    if(isset($_POST['submit']))
    {


$stmt = $pdo->prepare("SELECT categorie_id FROM categorieproduit WHERE categorie = :categorie");
$stmt->bindParam(':categorie', $categorie);
$stmt->execute();

if($stmt->rowCount() > 0) {
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $categorie_id = $row['categorie_id'];
    $categorie = $row['categorie'];

  }

        $errors = array();
        $success = array();
  $selected = $_POST['categorie_id'];
  list($categorie_id, $categorie) = explode('|', $selected);
       $nom = trim($_POST['nom']);
       $marque = trim($_POST['marque']);
       $petite_description = trim($_POST['petite_description']);
       $description = trim($_POST['description']);
       $image = trim($_POST['image']);
       $prix_initial = trim($_POST['prix_initial']);
       $prix_vente = trim($_POST['prix_vente']);
       $quantite = trim($_POST['quantite']);
       $statut = trim($_POST['statut']);


        // Validate the inputs

        if (empty($_POST['nom']) ){
            $errors['nom'] = "Vous devez saisir le nom.";
        }

        else{
            $success['nom']="";
        }



        if (empty($_POST['marque']) ){
            $errors['marque'] = "Vous devez saisir le marque.";
        }
        else{
            $success['marque']="";
        }


        if (empty($_POST['petite_description']) ){
            $errors['petite_description'] = "Vous devez saisir la petite description.";
        }
        else{
            $success['petite_description']="";
        }



        if (empty($_POST['description']) ){
            $errors['description'] = "Vous devez saisir la description.";
        }
        else{
            $success['description']="";
        }


                if (empty($_POST['image']) ){
                    $errors['image'] = "Vous devez saisir l'image.";
                }
                else{
                    $success['image']="";
                }


                if (empty($_POST['prix_initial']) ){
                    $errors['prix_initial'] = "Vous devez saisir le prix initial.";
                }
                else{
                    $success['prix_initial']="";
                }


                if (empty($_POST['prix_vente']) ){
                    $errors['prix_vente'] = "Vous devez saisir le prix de vente.";
                }
                else{
                    $success['prix_vente']="";
                }



                if (empty($_POST['quantite']) ){
                    $errors['quantite'] = "Vous devez saisir la quantite.";
                }
                else{
                    $success['quantite']="";
                }


                if (empty($_POST['statut']) ){
                    $errors['statut'] = "Vous devez saisir le statut.";
                }
                else{
                    $success['statut']="";
                }


                $sql = "INSERT into produit (categorie_id, categorie, nom, marque, petite_description, description, image, prix_initial, prix_vente, quantite, statut) values(:categorie_id, :categorie, :nom, :marque, :petite_description, :description, :image, :prix_initial, :prix_vente, :quantite, :statut)";
                try{
                    $handle = $pdo->prepare($sql);
                    $params = [
                        ':categorie_id'=>$categorie_id,
                        ':categorie'=>$categorie,
                        ':nom'=>$nom,
                        ':marque'=>$marque,
                        ':petite_description'=>$petite_description,
                        ':description'=>$description,
                        ':image'=>$image,
                        ':prix_initial'=>$prix_initial,
                        ':prix_vente'=>$prix_vente,
                        ':quantite'=>$quantite,
                        ':statut'=>$statut,



                    ];
                    $handle->execute($params);
                    $success['inscription'] = 'Le produit a bien été ajouté.';
                }
                catch(PDOException $e){
                    $errors[] = $e->getMessage();
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

    <title>Produits</title>
    	<!-- Favicon -->
	<link rel="icon" type="image/png" href="images/favicon.png">
<script>

$(document).ready(function() {
  <?php




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


    if(isset($errors['marque'])) {
        foreach($errors as $error) {
          echo "$('.form-control.marque').addClass('error');\n";
        }
      }
    if(isset($success['marque'])) {
      foreach($success as $suc) {
        echo "$('.form-control.marque').addClass('success');\n";
      }
    }



    if(isset($errors['petite_description'])) {
        foreach($errors as $error) {
          echo "$('.form-control.petite_description').addClass('error');\n";
        }
      }
    if(isset($success['petite_description'])) {
      foreach($success as $suc) {
        echo "$('.form-control.petite_description').addClass('success');\n";
      }
    }



    if(isset($errors['description'])) {
        foreach($errors as $error) {
          echo "$('.form-control.description').addClass('error');\n";
        }
      }
    if(isset($success['description'])) {
      foreach($success as $suc) {
        echo "$('.form-control.description').addClass('success');\n";
      }
    }



    if(isset($errors['image'])) {
        foreach($errors as $error) {
          echo "$('.form-control.image').addClass('error');\n";
        }
      }
    if(isset($success['image'])) {
      foreach($success as $suc) {
        echo "$('.form-control.image').addClass('success');\n";
      }
    }




    if(isset($errors['prix_initial'])) {
        foreach($errors as $error) {
          echo "$('.form-control.prix_initial').addClass('error');\n";
        }
      }
    if(isset($success['prix_initial'])) {
      foreach($success as $suc) {
        echo "$('.form-control.prix_initial').addClass('success');\n";
      }
    }

    

    if(isset($errors['prix_vente'])) {
        foreach($errors as $error) {
          echo "$('.form-control.prix_vente').addClass('error');\n";
        }
      }
    if(isset($success['prix_vente'])) {
      foreach($success as $suc) {
        echo "$('.form-control.prix_vente').addClass('success');\n";
      }
    }




    if(isset($errors['quantite'])) {
        foreach($errors as $error) {
          echo "$('.form-control.quantite').addClass('error');\n";
        }
      }
    if(isset($success['quantite'])) {
      foreach($success as $suc) {
        echo "$('.form-control.quantite').addClass('success');\n";
      }
    }

    if(isset($errors['statut'])) {
        foreach($errors as $error) {
          echo "$('.form-control.statut').addClass('error');\n";
        }
      }
    if(isset($success['statut'])) {
      foreach($success as $suc) {
        echo "$('.form-control.statut').addClass('success');\n";
      }
    }

    if(isset($success['categorie']) && isset($success['nom']) && isset($success['marque']) && isset($success['petite_description']) && isset($success['description']) && isset($success['image']) && isset($success['prix_initial']) && isset($success['prix_vente']) && isset($success['quantite']) && isset($success['statut'])){
        foreach($success as $suc) {
        echo "$('.form-control.categorie').addClass('success');\n";
        echo "$('.form-control.nom').addClass('success');\n";
        echo "$('.form-control.marque').addClass('success');\n";
        echo "$('.form-control.petite_description').addClass('success');\n";
        echo "$('.form-control.description').addClass('success');\n";
        echo "$('.form-control.image').addClass('success');\n";
        echo "$('.form-control.prix_initial').addClass('success');\n";
        echo "$('.form-control.prix_vente').addClass('success');\n";
        echo "$('.form-control.quantite').addClass('success');\n";
        echo "$('.form-control.statut').addClass('success');\n";

        }
    }

  ?>
});

</script>
</head>
<body>
<?php include 'menu.php';?>
<section class="home-section">

    <button class="simple-button" id="btn-modal">Ajouter un produit</button>

<div id="modal" class="modal">
  <div class="modal-content">

    <div class="connexion">

    <form id="form" class="form" method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>">


<div class="content ">

<span class="close">&times;</span>

  <p>Ajouter un produit</p>

  <div class="form-control categorie">
        <label for="categorie">Categorie* :</label>
        
<?PHP
$stmt = $pdo->prepare("SELECT categorie_id, categorie FROM categorieproduit");
$stmt->execute();

echo '<select id="categorie" name="categorie_id">';
while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

    echo '<option name="categorie" id="categorie" value="' . $row['categorie_id']. '|' . $row['categorie']. '">' . $row['categorie'] . '</option>';
}
echo '</select>';
?>
        <small><?php echo isset($errors['categorie']) ? $errors['categorie'] : ''; ?></small>
        <small><?php echo isset($success['categorie']) ? $success['categorie'] : ''; ?></small>

      </div>



        <div class="form-control nom">
        <label for="nom">Nom* :</label>
        <input type="text" placeholder="nom" name="nom" id="nom" value="<?php echo isset($_POST['nom']) ? $_POST['nom'] : ''; ?>">
        <small><?php echo isset($errors['nom']) ? $errors['nom'] : ''; ?></small>
        <small><?php echo isset($success['nom']) ? $success['nom'] : ''; ?></small>


        </div>

            <div class="form-control marque">
            <label for="marque">Marque* :</label>
              <input type="text" placeholder="marque" name="marque" id="marque" value="<?php echo isset($_POST['marque']) ? $_POST['marque'] : ''; ?>">
              <small><?php echo isset($errors['marque']) ? $errors['marque'] : ''; ?></small>
              <small><?php echo isset($success['marque']) ? $success['marque'] : ''; ?></small>


            </div>




            <div class="form-control petite_description">
            <label for="petite_description">Petite description* :</label>
              <input type="text" placeholder="petite_description" name="petite_description" id="petite_description" value="<?php echo isset($_POST['petite_description']) ? $_POST['petite_description'] : ''; ?>">
              <small><?php echo isset($errors['petite_description']) ? $errors['petite_description'] : ''; ?></small>
              <small><?php echo isset($success['petite_description']) ? $success['petite_description'] : ''; ?></small>

            </div>




            <div class="form-control description">
            <label for="description">Description* :</label>
              <input type="text" placeholder="description" name="description" id="description" value="<?php echo isset($_POST['description']) ? $_POST['description'] : ''; ?>">
              <small><?php echo isset($errors['description']) ? $errors['description'] : ''; ?></small>
              <small><?php echo isset($success['description']) ? $success['description'] : ''; ?></small>

            </div>




            <div class="form-control image">
            <label for="image">Image* :</label>
              <input type="file" placeholder="image" name="image" id="image" value="<?php echo isset($_POST['image']) ? $_POST['image'] : ''; ?>">
              <small><?php echo isset($errors['image']) ? $errors['image'] : ''; ?></small>
              <small><?php echo isset($success['image']) ? $success['image'] : ''; ?></small>

            </div>





            <div class="form-control prix_initial">
            <label for="prix_initial">Prix initial* :</label>
              <input type="num" placeholder="prix_initial" name="prix_initial" id="prix_initial" value="<?php echo isset($_POST['prix_initial']) ? $_POST['prix_initial'] : ''; ?>">
              <small><?php echo isset($errors['prix_initial']) ? $errors['prix_initial'] : ''; ?></small>
              <small><?php echo isset($success['prix_initial']) ? $success['prix_initial'] : ''; ?></small>

            </div>




            <div class="form-control prix_vente">
            <label for="prix_vente">Prix de vente* :</label>
              <input type="num" placeholder="prix_vente" name="prix_vente" id="prix_vente" value="<?php echo isset($_POST['prix_vente']) ? $_POST['prix_vente'] : ''; ?>">
              <small><?php echo isset($errors['prix_vente']) ? $errors['prix_vente'] : ''; ?></small>
              <small><?php echo isset($success['prix_vente']) ? $success['prix_vente'] : ''; ?></small>

            </div>







            
            <div class="form-control quantite">
            <label for="quantite">Quantite* :</label>
              <input type="num" placeholder="quantite" name="quantite" id="quantite" value="<?php echo isset($_POST['quantite']) ? $_POST['quantite'] : ''; ?>">
              <small><?php echo isset($errors['quantite']) ? $errors['quantite'] : ''; ?></small>
              <small><?php echo isset($success['quantite']) ? $success['quantite'] : ''; ?></small>

            </div>





            <div class="form-control statut">
        <label for="statut">Statut* :</label>
        <select id="statut" name="statut">
        <option id="statut" name="statut" value="en_stock">En stock</option>
        <option id="statut" name="statut" value="en_rupture_de_stock">En rupture de stock</option>
        <option id="statut" name="statut" value="non_disponible">Non disponible</option>
        <option id="statut" name="statut" value="nouveaute">Nouveauté</option>
        <option id="statut" name="statut" value="en_promo">En promo</option>

        </select>
        <small><?php echo isset($errors['statut']) ? $errors['statut'] : ''; ?></small>
        <small><?php echo isset($success['statut']) ? $success['statut'] : ''; ?></small>

      </div>




                        <div class="button">


                        <button class="inscription-button" type="submit" name="submit" id="submit"> Ajouter</button>




                    </div>



</form>
  </div>
</div> 

</div>
</div>


<table>
  <tr>
  <th>Id</th>
    <th>Categorie</th>
    <th>Nom</th>
    <th>Marque</th>
    <th>Image</th>
    <th>Prix initial</th>
    <th>Prix vente</th>
    <th>Quantite</th>
    <th>Statut</th>
    <th>Détails</th>
    <th>Modifier</th>
    <th>Supprimer</th>



  </tr>

  <?php

$produit = $pdo->query("SELECT * FROM produit WHERE categorie_id='3003'");

if ($produit->rowCount() == 0) {
  echo '<tr>';

  echo '<td colspan="13">Aucun produit dans cette categorie.</td>';
  echo '</tr>';

} else {
             while($ligne = $produit->fetch()){ 
                                 echo '<tr>';
     
                                     echo '<td>';
                                     echo $ligne['produit_id'];
                                     echo '</td>';


                                     echo '<td>';
                                       echo $ligne['categorie'];
                                     echo '</td>';
                     
                                     echo '<td>';
                                     echo $ligne['nom'];
                                     echo '</td>';
                     
                                     echo '<td>';
                                     echo $ligne['marque'];
                                     echo '</td>';


                     
                                                          
                                     echo '<td>';
                                     echo  '<div class="produit-img">';
                                     echo	'<img class="produit-img" src="../images produits/'.$ligne['image'].'" alt="'.$ligne['image'].'">';
                                     echo '</div>';
                                     echo '</td>';

                                     echo '<td>';
                                     echo $ligne['prix_initial'];
                                     echo '</td>';

                                     
                                     echo '<td>';
                                     echo $ligne['prix_vente'];
                                     echo '</td>';

                                     
                                     echo '<td>';
                                     echo $ligne['quantite'];
                                     echo '</td>';

                                     
                                     echo '<td>';
                                     echo $ligne['statut'];
                                     echo '</td>';
                     

                                     echo '<td>';

                                     echo '<a href="../page-produit.php?afficherproduitid='.$ligne['produit_id'].'" class="details-button"><i class="bx bx-detail"></i></a>';

                                     echo '</td>';


                                     echo '<td>';
                                     echo '<a  class="modifier-button"" href="modifier-produits.php?modifierid='.$ligne['produit_id'].'" ><i class="bx bx-pencil"></i></a>';

                                     echo '</td>';



                                     echo '<td>';

                                     echo '<a href="supprimer-produits.php?supprimerid='.$ligne['produit_id'].'" class="supprimer-button"><i class="bx bx-trash"></i></a>';

                                     echo '</td>';


                                 echo '</tr>';
                              }}
?>



</table>

</section>


    <script>
        var btn = document.getElementById("btn-modal");
var modal = document.getElementById("modal");
var span = document.getElementsByClassName("close")[0];


btn.onclick = function() {
  modal.style.display = "block";
}

span.onclick = function() {
  modal.style.display = "none";
}

window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}

</script>
</body>
</html>