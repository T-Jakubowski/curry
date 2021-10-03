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
            <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #1aa3ff;">
                <div class="container-fluid">
                    <a class="navbar-brand" href="#">Navigation</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="#">Home</a>
                        <a class="nav-link" href="#">Pompier</a>
                        <a class="nav-link active" aria-current="page" href="#">Caserne</a>
                        <a class="nav-link disabled">Prochainement...</a>
                        
                    </div>
                    
                    </div>
                    
                </div><form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
                
            </nav>
        </header>
   <br>





      <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editCaserneModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button></td>
      <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></td>
 
    <footer>
    <nav aria-label="Page navigation example">
  <ul class="pagination justify-content-center">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>
    </footer>
    <script>
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
  return new bootstrap.Tooltip(tooltipTriggerEl)
})
</script>
    </body>
</html>