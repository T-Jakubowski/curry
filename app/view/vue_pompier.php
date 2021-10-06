<?php 

require_once '../autoloader.php';
use app\models\DAOPompier;
use app\utils\SingletonDBMaria;
$cnx = app\utils\SingletonDBMaria::getInstance()->getConnection();
$connexion = new app\models\DAOPompier($cnx);


?>


<!doctype html>
<html lang="fr">
    <head>
        <meta charset="utf-8">
        <title>Titre de la page</title>

        <link href="/html/css/bootstrap.css" rel="stylesheet">
        <script src="/html/js/bootstrap.bundle.js"></script>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>


        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">
        <link href="https://cdn.datatables.net/1.11.3/css/jquery.dataTables.min.css" rel="stylesheet">


        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/1.11.3/js/jquery.dataTables.min.js"></script>
    </head>
    <body>
        <table id="table_id" class="display">
            <thead>
                <tr>
                    <th>Matricule</th>
                    <th>Prenom</th>
                    <th>Nom</th>
                    <th>Chef Agret</th>
                    <th>DateNaissance</th>
                    <th>Num Caserne</th>
                    <th>Code Grade</th>
                    <th>Matricule Responsable</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>

                    
                <?php foreach ($pompiers as $value) { ?>
                <tr>
                    <td><?php echo $value->GetMatricule() ;?></td>
                    <td><?php echo $value->GetPrenom() ;?></td>
                    <td><?php echo $value->GetNom() ;?></td>
                    <td><?php echo $value->GetChefAgret() ;?></td>
                    <td><?php echo $value->GetDateNaissance() ;?></td>
                    <td><?php echo $value->GetNumCaserne() ;?></td>
                    <td><?php echo $value->GetCodeGrade() ;?></td>
                    <td><?php echo $value->GetMatriculeRespo() ;?></td>
                    <th><button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editCaserneModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button></th>
                    <th><button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></th>
                </tr>
                <?php }  ?>
            </tbody>
        </table>
        <script>
            $(document).ready(function () {
                $('#table_id').DataTable();
            });
        </script>

    <br><center><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createCaserneModal">Ajouter un pompier</button></center>


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
                        <span class="input-group-text">Matricule</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                        <span class="input-group-text">Prenom</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                        <span class="input-group-text">Nom</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                        <span class="input-group-text">ChefAgret</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                        <span class="input-group-text">Date Naissance</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                        <span class="input-group-text">NumCaserne</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                        <span class="input-group-text">Code Grade</span>
                        <input type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                        <span class="input-group-text">Matricule Responsable</span>
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
    <!-- Delete -->
    <div class="modal fade" id="confirmDeleteCaserneModal" tabindex="-1" aria-labelledby="confirmDeleteCaserneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteCaserneModalLabel">Delete</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <h3>Etes-vous sur de vouloir supprimé le pompier $$$ ?</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NON</button>
                    <button type="button" class="btn btn-success">OUI</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Create -->
    <!-- Modal create Caserne-->
    <div class="modal fade" id="createCaserneModal" tabindex="-1" aria-labelledby="createCaserneModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createCaserneModalLabel">Create Pompier</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 128" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">Matricule</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 12 rue arla" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">Prenom</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 69100" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">Nom</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: Lyon" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">Chef Agret</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">Date Naissance</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">NumCaserne</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">CodeGrade</span>
                    </div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                        <span class="input-group-text" id="basic-addon2">Matricule Responsable</span>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <style>
        body{
            margin:50px;
        }
    </style>

</body>
</html>
