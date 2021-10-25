<?php
require_once '../autoloader.php';

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
        <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff8787;">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Navigation</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                    <div class="navbar-nav">
                        <a class="nav-link" href="/">Home</a>
                        <a class="nav-link active" aria-current="page" href="#">Pompier</a>
                        <a class="nav-link" href="../caserne/affiche">Caserne</a>
                        <a class="nav-link disabled">Prochainement...</a>
                    </div>
                </div>
            </div>
        </nav>
        <br><br><br>


    <center><button type="button" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#createPompierModal">Ajouter un pompier</button>
        <button type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editPompierModal">Modifier un pompier</button>
        <button type="button" class="btn btn-outline-warning" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal">Supprimer un pompier</button>
    </center><br>


    <div id="tableau" name="tableau">
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
                </tr>
            </thead>
            <tbody>


                <?php foreach ($pompiers as $value) { ?>
                    <tr>
                        <td><?php echo $value->GetMatricule(); ?></td>
                        <td><?php echo $value->GetPrenom(); ?></td>
                        <td><?php echo $value->GetNom(); ?></td>
                        <td><?php echo $value->GetChefAgret(); ?></td>
                        <td><?php echo $value->GetDateNaissance(); ?></td>
                        <td><?php echo $value->GetNumCaserne(); ?></td>
                        <td><?php echo $value->GetCodeGrade(); ?></td>
                        <td><?php echo $value->GetMatriculeRespo(); ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>


    <script>
        $(document).ready(function () {
            $('#table_id').DataTable();
        });
    </script>



    <!-- Modal edit Pompier-->
    <form id="editPompier" method="post" action="/pompier/edit">
        <div class="modal fade" id="editPompierModal" tabindex="-1" aria-labelledby="editCaserneModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPompierModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                            <span class="input-group-text">Matricule</span>
                            <input name='editMatricule' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                            <span class="input-group-text">Prenom</span>
                            <input name='editPrenom' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                            <span class="input-group-text">Nom</span>
                            <input name='editNom' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue" readonly>
                            <span class="input-group-text">ChefAgret</span>
                            <input name='editChefAgret' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                            <span class="input-group-text">Date Naissance</span>
                            <input name='editDateNaissance' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                            <span class="input-group-text">NumCaserne</span>
                            <input name="editNumCaserne" type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                            <span class="input-group-text">Code Grade</span>
                            <input name='editCodeGrade' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                        <div class="input-group mb-3">
                            <input type="text" class="form-control" placeholder="LastValue" aria-label="lastValue"readonly>
                            <span class="input-group-text">Matricule Responsable</span>
                            <input name='editMatriculeRespo' type="text" class="form-control" placeholder="Nouvelle valeur" aria-label="newValue">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <input type="submit" class="btn btn-primary" name="save_pompier" value="Save">
                    </div>
                </div>
            </div>
        </div>
    </form>

    <!-- Delete -->
    <form id="deletePompier" method="post" action="/pompier/delete">
        <div class="modal fade" id="confirmDeleteCaserneModal" tabindex="-1" aria-labelledby="confirmDeleteCaserneModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeleteCaserneModalLabel">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Quelle pompier voulez vous supprimmer</h3>
                    </div>
                    <div class="input-group mb-3">
                        <span class="input-group-text" id="basic-addon2">Matricule</span>
                        <input name="deleteMatricule" type="text" class="form-control" placeholder="ex: Ma0021" aria-label="Recipient's username" aria-describedby="basic-addon2">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Fermer</button>
                        <input type="submit" class="btn btn-success" value="Valider"></input>
                    </div>
                </div>
            </div>
        </div>
        <form>
            <!-- Create -->
            <!-- Modal create Pompier-->
            <form id="addPompier" method="post" action="/pompier/add">
                <div class="modal fade" id="createPompierModal" tabindex="-1" aria-labelledby="createCaserneModalLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="createCaserneModalLabel">Create Pompier</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <div class="input-group mb-3">
                                    <input name="addMatricule" type="text" class="form-control" placeholder="ex: 128" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Matricule</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addPrenom" type="text" class="form-control" placeholder="ex: 12 rue arla" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Prenom</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addNom" type="text" class="form-control" placeholder="ex: 69100" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Nom</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addChefAgret" ype="text" class="form-control" placeholder="ex: Lyon" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Chef Agret</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addDateNaissance" type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Date Naissance</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addNumCaserne" type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">NumCaserne</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addCodeGrade" type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">CodeGrade</span>
                                </div>
                                <div class="input-group mb-3">
                                    <input name="addMatriculeRespo" type="text" class="form-control" placeholder="ex: 2" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                    <span class="input-group-text" id="basic-addon2">Matricule Responsable</span>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <input type="submit" class="btn btn-primary" name="add_pompier" value="Save">
                            </div>
                        </div>
                    </div>
                </div>
            </form>

            </body>
            </html>