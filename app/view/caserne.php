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
    <div class="container">
        <div class="row justify-content-end">
            <div class="col-1">
                <span data-bs-toggle="tooltip" data-bs-placement="top" title="Ajout de Caserne">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createCaserneModal">+</button>
                </span>
            </div>
        </div>
    </div>




        <div>


        </div>
        <span>  <?php //echo $name ?></span>
        <br>
        <div><h3>Liste des Casernes :</h3></div>
        <table class="table table-striped table-hover table-info .table-responsive">
        <thead>
    <tr>
      <th data-bs-toggle="tooltip" data-bs-placement="top" title="NumCaserne Int(11)">#</th>
      <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(15)">Addresse</th>
      <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(5)">CP</th>
      <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(10)">Ville</th>
      <th data-bs-toggle="tooltip" data-bs-placement="top" title="Int(11)">CodeTypeC</th>
      <th>Edit</th>
      <th>Delete</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <th scope="row">1</th>
      <td>30 rue plomc</td>
      <td>69000</td>
      <td>Lyon</td>
      <td>5</td>
      <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editCaserneModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button></td>
      <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></td>
    </tr>
    <tr>
      <th scope="row">2</th>
      <td>10 rue alto</td>
      <td>30805</td>
      <td>Paris</td>
      <td>6</td>
      <td><button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#editCaserneModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button></td>
      <td><button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></td>
    </tr>

  </tbody>
        </table>














<!-- Modal create Caserne-->
<div class="modal fade" id="createCaserneModal" tabindex="-1" aria-labelledby="createCaserneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCaserneModalLabel">Create Caserne</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ex: 128" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">NumCaserne</span>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ex: 12 rue arla" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">Addresse</span>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ex: 69100" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">Code Postal</span>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ex: Lyon" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">Ville</span>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">CodeTypeC</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal edit Caserne-->
<div class="modal fade" id="editCaserneModal" tabindex="-1" aria-labelledby="editCaserneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="createCaserneModalLabel">Edit</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                <span class="input-group-text">NumCaserne</span>
            <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                <span class="input-group-text">Addresse</span>
            <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                <span class="input-group-text">Code Postal</span>
            <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                <span class="input-group-text">Ville</span>
            <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                <span class="input-group-text">CodeTypeC</span>
            <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>


<!-- Modal confirmDelete Caserne-->
<div class="modal fade" id="confirmDeleteCaserneModal" tabindex="-1" aria-labelledby="confirmDeleteCaserneModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="confirmDeleteCaserneModalLabel">Delete</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
      <h3>Etes-vous sur de vouloir supprimé la caserne $$$ ?</h3>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NON</button>
        <button type="button" class="btn btn-success">OUI</button>
      </div>
    </div>
  </div>
</div>














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