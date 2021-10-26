<?php
namespace app\views;
//FAIRE PAGE AVEC BARRE EN HAUT
//bouton caserne et pompier


//LISTE CASERNES




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