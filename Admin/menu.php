<?php

require_once('bd.php');
if (isset($_SESSION['administrateur_id'])) {
  $administrateur_id = $_SESSION['administrateur_id'];

  $req = $pdo->prepare('SELECT * FROM administrateur WHERE administrateur_id = :administrateur_id');
  $req->execute(['administrateur_id' => $administrateur_id]);
  $admin = $req->fetch();
  $nom_administrateur = $admin['nom'];
  $image_profile = $admin['image_profile'];
  if(empty($image_profile)) {
    $image_profile = "image-profile.png"; 
  }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
    <link rel="stylesheet" href="css/style.css">
    <!-- Boxiocns CDN Link -->
    <link href='https://unpkg.com/boxicons@2.0.7/css/boxicons.min.css' rel='stylesheet'>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
	<script>
		$(document).ready(function() {
			$('a').click(function(event) {
				var aText = $(this).text();
				$('.text').text(aText);
				localStorage.setItem('textValue', aText); 
			});
			var savedTextValue = localStorage.getItem('textValue'); 
			if (savedTextValue) {
				$('.text').text(savedTextValue); 
			}
		});

	</script>
   </head>
<body>
  <div class="sidebar">

    <div class="logo-details">
      <i class='bx '> <img src="images/favicon.png" alt=""></i>
      <span class="logo_name">PartageaonsNosBiens</span>
    </div>

    <ul class="nav-links">
      <li>
        <a href="accueil.php">
          <i class='bx bx-grid-alt' ></i>
          <span class="link_name">Accueil</span>
        </a>
      </li>


      <li id="produits">
        <div class="iocn-link">
          <a href="produits.php">
            <i class='bx bx-collection' ></i>
            <span class="link_name">Produits</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="produits.php">Produits</a></li>
          <li><a href="produits-jardinage.php">Produits de jardinage</a></li>
          <li><a href="produits-maison.php">Produits de maison</a></li>
          <li><a href="produits-loisirs.php">Produits de loisirs</a></li>
        </ul>
      </li>




      <li id="offres">
        <div class="iocn-link">
          <a href="offres.php">
            <i class='bx bx-group' ></i>
            <span class="link_name">Offres</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="offres.php">Offres</a></li>
          <li><a href="offres-produits-jardinage.php">Produits de jardinage</a></li>
          <li><a href="offres-produits-maison.php">Produits de maison</a></li>
          <li><a href="offres-produits-loisirs.php">Produits de loisirs</a></li>
        </ul>
      </li>


      

      
      <li id="commentaires">
        <div class="iocn-link">
          <a href="commentaires.php">
            <i class='bx bxs-comment' ></i>
            <span class="link_name">Commentaires</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="commentaires.php">Commentaires</a></li>
          <li><a href="commentaires-produits-jardinage.php">Produits de jardinage</a></li>
          <li><a href="commentaires-produits-maison.php">Produits de maison</a></li>
          <li><a href="commentaires-produits-loisirs.php">Produits de loisirs</a></li>
        </ul>
      </li>


      <li id="utilisateurs">
        <a href="utilisateurs.php">
        <i class='bx bx-user' ></i>
          <span class="link_name">Utilisateurs</span>
        </a>
      </li>



      <li id='commandes'>
        <div class="iocn-link">
          <a href="commandes.php">
          <i class='bx bx-line-chart'></i>
            <span class="link_name">Commandes</span>
          </a>
          <i class='bx bxs-chevron-down arrow' ></i>
        </div>
        <ul class="sub-menu">
          <li><a class="link_name" href="commandes.php">Commandes</a></li>
          <li><a href="commandes-simple.php">Simple</a></li>
          <li><a href="commandes-partagee.php">Partagée</a></li>
        </ul>
      </li>

      <li id="Livraisons">
        <a href="livraisons.php">
        <i class='bx bxs-truck' ></i>
          <span class="link_name">Livraisons</span>
        </a>
      </li>

      <li id="Payements">
        <a href="payements.php">
        <i class='bx bx-money' ></i>
          <span class="link_name">Payements</span>
        </a>
      </li>


      <li id="contact">
        <a href="contact.php">
        <i class='bx bx-envelope'></i>
          <span class="link_name">Contact</span>
        </a>
      </li>


      <li>
        <a href="aide.php">
          <i class='bx bx-cog' ></i>
          <span class="link_name">Aide</span>
        </a>

      </li>
      <li id="deconnexion">
    <div class="profile-details">

      <div class="profile-content">
      <a href="profile.php">
        <img src="images/<?php echo $image_profile; ?>" alt="profileImg" ></a>
      </div>
      <div class="name-job">
      <a href="profile.php">
        <div class="profile_name"><?php echo $nom_administrateur; ?></div></a>
        <div class="job">Administratrice</div>
      </div>
      <a href="deconnexion.php"><i class='bx bx-log-out'></i></a>
  
    </div>
  </li>
</ul>
  </div>
  <section class="home-section">
    <div class="home-content header">
      <i class='bx bx-menu' ></i>
      <span class="text"></span>
    </div>
  </section>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="js/js.js"></script>
  <script>
    


  let arrow = document.querySelectorAll(".arrow");
  for (var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
   let arrowParent = e.target.parentElement.parentElement;
   arrowParent.classList.toggle("showMenu");
    });
  }
  let sidebar = document.querySelector(".sidebar");
  let sidebarBtn = document.querySelector(".bx-menu");
  console.log(sidebarBtn);
  sidebarBtn.addEventListener("click", ()=>{
    sidebar.classList.toggle("close");
  });




</script>
</body>
</html>
