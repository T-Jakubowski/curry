<?php
namespace app\views;


//LISTE POMPIERS
//en + recherche par nom
//Systeme de pagination (en bas)
//bouton en bout de ligne pour supprimer pompier + confirmation
//Bouton pour éditer

?>

<html>
<?php include "Head.php" ;?>


    <body>
    <?php $ActivePageName="home"; include "view_NavBarre.php"; ?>
   <br>


   <div class="row row-cols-1 row-cols-md-4 g-4">
  <div class="col">
    <div class="card">
      <img src="/img/PompierImg.jpg" class="card-img-top" alt="..." height="200">
      <div class="card-body">
        <h5 class="card-title">Pompier</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="/img/CaserneImg.png" class="card-img-top" alt="..." height="200">
      <div class="card-body">
        <h5 class="card-title">Caserne</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="..." class="card-img-top" alt="..." height="200">
      <div class="card-body">
        <h5 class="card-title">User</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content.</p>
      </div>
    </div>
  </div>
  <div class="col">
    <div class="card">
      <img src="/img/role_black_24dp.svg" class="card-img-top" alt="..." height="200">
      <div class="card-body">
        <h5 class="card-title">Role</h5>
        <p class="card-text">This is a longer card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
      </div>
    </div>
  </div>
</div>




    <div class="d-flex justify-content-center">
    <span class="mx-4"><a type="button" href="/caserne/affiche" class="btn btn-danger"><img class="fit-picture" src="/img/CaserneImg.png" width="400" height="500" alt="Caserne"></a></span>
    <span class="mx-4"><a type="button" href="/pompier/affiche" class="btn btn-danger"><img class="fit-picture" src="/img/PompierImg.jpg" width="400" height="500" alt="Pompier"></a></span>
    </div>

    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
    </body>
</html>