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
      <?php $ActivePageName="caserne"; include "view_NavBarre.php"; ?>
        
<?php
if (isset($isSuccess)){
  if ($isSuccess==1){
    ?>

<div class="alert alert-success alert-dismissible fade show" role="alert">
<img class="fit-picture" src="/img/check_black_24dp.svg" alt="success"><strong>Success Action !</strong>
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>

    <?php
  }
  else{
    
  }
}
?>

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
        <table id="tableCaserne" class="table table-striped table-hover table-Secondary .table-responsive" >
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
    <?php 
foreach ($LstCaserne as $Caserne){
  /* @var Caserne $Caserne */
  ?>
  <tr>
    <td><?php $id = $Caserne->getNumCaserne();echo $id;?></td>
    <td><?php echo $Caserne->getAdresse(); ?></td>
    <td><?php echo $Caserne->getCP(); ?></td>
    <td><?php echo $Caserne->getVille(); ?></td>
    <td><?php echo $Caserne->getCodeTypeC(); ?></std>
    <td><button id="<?php echo $id."edit"; ?>" type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editCaserneModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button></td>
      <td><button id="<?php echo $id."del"; ?>" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></td>
  </tr>
  <?php


  
}


  ?>

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
      <form id="InsertCaserne" method="post" action="/caserne/add">
      <div class="modal-body">
      <div class="input-group mb-3">
            <input id="AddCaserne_NumCaserne" name="AddCaserne_NumCaserne" type="text" class="form-control" placeholder="ex: 128" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">NumCaserne</span>
        </div>
        <div class="input-group mb-3">
            <input id="AddCaserne_Addresse" name="AddCaserne_Addresse" type="text" class="form-control" placeholder="ex: 12 rue arla" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">Addresse</span>
        </div>
        <div class="input-group mb-3">
            <input id="AddCaserne_Code Postal" name="AddCaserne_CP" type="text" class="form-control" placeholder="ex: 69100" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">Code Postal</span>
        </div>
        <div class="input-group mb-3">
            <input id="AddCaserne_Ville" name="AddCaserne_Ville" type="text" class="form-control" placeholder="ex: Lyon" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">Ville</span>
        </div>
        <div class="input-group mb-3">
            <input id="AddCaserne" name="AddCaserne_CodeTypeC" type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
            <span class="input-group-text" id="basic-addon2">CodeTypeC</span>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <input type="submit" class="btn btn-primary" value="save">
      </div>
    </form>
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
      <h3>Etes-vous sur de vouloir supprimé la caserne <span id="wantToDelete"></span> ?</h3>
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