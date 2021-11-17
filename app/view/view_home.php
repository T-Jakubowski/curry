<?php
namespace app\views;


//LISTE POMPIERS
//en + recherche par nom
//Systeme de pagination (en bas)
//bouton en bout de ligne pour supprimer pompier + confirmation
//Bouton pour éditer

?>

<html>
<?php
            var_dump($_SESSION['identifiant']);
            var_dump($_SESSION['nom']);
            var_dump($_SESSION['prenom']);
            var_dump($_SESSION['idRole']);

require "Head.php" ;?>


    <body>
    <?php $ActivePageName="home"; require "view_NavBarre.php"; ?>
   <br>


   <div class="row row-cols-1 row-cols-md-4 g-4">
  <div class="col">
    <div class="card">
      <a href="/pompier/affiche">
        <img src="/img/firefighter_black_24dp.svg" class="card-img-top" alt="Icon Pompier" height="200">
      </a>
      <div class="card-body">
        <h5 class="card-title">Pompier</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <a href="/caserne/affiche">
        <img src="/img/caserne_black_24dp.svg" class="card-img-top" alt="Icon Caserne" height="200">
      </a>
      <div class="card-body">
        <h5 class="card-title">Caserne</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <a href="/user/affiche">
        <img src="/img/user_black_24dp.svg" class="card-img-top" alt="Icon User" height="200">
      </a>
      <div class="card-body">
        <h5 class="card-title">User</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <a href="/role/affiche">
        <img src="/img/role_black_24dp.svg" class="card-img-top" alt="Icon Role" height="200">
      </a>
      <div class="card-body">
        <h5 class="card-title">Role</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>


    </body>
</html>