<?php
namespace app\views;

?>
<html>
    <head>
      <link href="/html/css/bootstrap.css" rel="stylesheet">
      <script src="/html/js/bootstrap.bundle.js"></script>
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

      <meta lang="fr">
      <meta charset="UTF-8">
    </head>



    <body>
        <header>
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff8787;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navigation</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="/">Home</a>
                        <a class="nav-link" href="/pompier/affiche">Pompier</a>
                        <a class="nav-link" href="/caserne/affiche">Caserne</a>

                        <a class="nav-link disabled">Prochainement...</a>

                    </div>
                    
                    </div>
                    
                </div><form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-success" type="submit">Search</button>
      </form>
                
            </nav>
        </header>
<?php
if (isset($resultMessage)){
  if ($resultMessage==1){
    ?>
<div class="alert alert-success mt-5" role="alert">
<h2><img class="fit-picture" src="/img/check_black_24dp.svg" alt="success">Caserne ajouter avec succes !</h2>
</div>
    <?php
  }
  else{
    ?>
    <h2>Nous avons actuellement des probléme technique veuillez reessayer plus tard</h2>
    <?php
    }
  }
  elseif(isset($valueError)){
    ?>
    
    <h2>vous avez entré une valeur non valide :</h2><br><h3>
    <?php foreach($valueError as $key=>$value){ 
      ?>
      La valeur pour "<?php echo $value ?>" n'est pas valide<br>
      <?php
    }
    ?></h3><?php
}else{
  echo "Erreur";
}
?>










    <script>




    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
    </body>
</html>