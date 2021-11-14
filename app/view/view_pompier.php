<?php

namespace app\views;
?>
<html>
    <?php require "Head.php"; ?>
    <script>
        function ConfirmDelete(id) {
            var x = document.getElementById("idPompierToDelete");
            x.value = id;
        }
        function Edit(id) {
            var x = document.getElementById("editmatricule");
            x.value = id;
            x.innerHTML = id;
        }
    </script>
    <body>
        <?php
        $ActivePageName = "pompier";
        require "view_NavBarre.php";
        ?>
        <br>


        <div class="container">
            <div class="row justify-content-end">
                <div class="col-1">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#createPompierModal">+</button>
                </div>
            </div>
        </div>
        <br>
        <div><h3>Liste des Pompiers:</h3></div>

        <?php
        if (isset($_GET["page"])) {
            $NumPage = $_GET["page"];
        } else {
            $NumPage = 1;
        }
        if (isset($_GET["search"])) {
            $NumLikes = "&search=" . intval($_GET["search"]);
        } else {
            $NumLikes = "";
        }
        ?>
        <table id="tablePompier" class="table table-striped table-hover table-Secondary .table-responsive" >
            <thead>
                <tr>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="nt(11)">#</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(15)">Prenom</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(20)">Nom</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Int (8)">ChefAgret</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Int(11)">DateNaissance</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(15)">NumCaserne</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(20)">CodeGrade</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Int (8)">MatriculeRespo</th>
                    <th>Edit/Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($LstPompier as $Pompier) {
                    /* @var Pompier $Pompier */
                    ?>
                    <tr>
                        <td><?php $id = $Pompier->getMatricule();
                echo $id;
                    ?></td>
                        <td id="<?php echo $id . ":Prenom"; ?>"><?php echo $Pompier->getPrenom(); ?></td>
                        <td id="<?php echo $id . ":Nom"; ?>"><?php echo $Pompier->getNom(); ?></td>
                        <td id="<?php echo $id . ":ChefAgret"; ?>"><?php echo $Pompier->getChefAgret(); ?></td>
                        <td id="<?php echo $id . ":DateNaissance"; ?>"><?php echo $Pompier->getDateNaissance(); ?></td>
                        <td id="<?php echo $id . ":NumCaserne"; ?>"><?php echo $Pompier->getNumCaserne(); ?></td>
                        <td id="<?php echo $id . ":CodeGrade"; ?>"><?php echo $Pompier->getCodeGrade(); ?></td>
                        <td id="<?php echo $id . ":MatriculeRespo"; ?>"><?php echo $Pompier->getMatriculeRespo(); ?></td>
                        <td><button id="<?php echo $id . ":edit"; ?>" onclick="Edit('<?php echo $id; ?>')" type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editPompierModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button>
                            <button id="<?php echo $id . ":del"; ?>" onclick="ConfirmDelete('<?php echo $id; ?>')" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeletePompierModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>














        <!-- Modal create Pompier-->
        <div class="modal fade" id="createPompierModal" tabindex="-1" aria-labelledby="createPompierModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPompierModalLabel">Create Pompier</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="InsertPompier" method="post" action="/pompier/add">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input id="addmatricule" name="addmatricule" type="text" class="form-control" placeholder="Ma0001" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Matricule</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addnom" name="addnom" type="text" class="form-control" placeholder="Jakubowski" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Nom</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addprenom" name="addprenom" type="text" class="form-control" placeholder="Thomas" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Prenom</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addchefagret" name="addchefagret" type="text" class="form-control" placeholder="O" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Chef Agret</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="adddatenaissance" name="adddatenaissance" type="text" class="form-control" placeholder="1999-01-20" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Date Naissance</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addnumcaserne" name="addnumcaserne" type="text" class="form-control" placeholder="1" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Num Caserne</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addcodegrade" name="addcodegrade" type="text" class="form-control" placeholder="SP" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Code Grade</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addmatriculerespo" name="addmatriculerespo" type="text" class="form-control" placeholder="Ma0002" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Matricule Respo</span>
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


        <!-- Modal edit Pompier-->
        <div class="modal fade" id="editPompierModal" tabindex="-1" aria-labelledby="editPompierModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createPompierModalLabel">Edit</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="UpdatePompier" method="post" action="/pompier/edit">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input id="editmatricule" name="editmatricule" value="" type="text" class="form-control" placeholder="Value" readonly>
                                <span class="input-group-text">Matricule</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editnom" name="editnom" type="text" class="form-control" placeholder="Jakubowski" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Nom</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editprenom" name="editprenom" type="text" class="form-control" placeholder="Thomas" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Prenom</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editchefagret" name="editchefagret" type="text" class="form-control" placeholder="O" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Chef Agret</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editdatenaissance" name="editdatenaissance" type="text" class="form-control" placeholder="1999-01-20" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Date Naissance</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editnumcaserne" name="editnumcaserne" type="text" class="form-control" placeholder="1" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Num Caserne</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editcodegrade" name="editcodegrade" type="text" class="form-control" placeholder="SP" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Code Grade</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editmatriculerespo" name="editmatriculerespo" type="text" class="form-control" placeholder="Ma0002" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Matricule Respo</span>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <input type="submit" class="btn btn-primary" value="Save changes">
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <!-- Modal confirmDelete Pompier-->
        <div class="modal fade" id="confirmDeletePompierModal" tabindex="-1" aria-labelledby="confirmDeletePompierModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="confirmDeletePompierModalLabel">Delete</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <h3>Etes-vous sur de vouloir supprimé le Pompier <span id="wantToDelete"></span> ?</h3>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">NON</button>
                        <form id="DeletePompier" method="post" action="/pompier/delete">
                            <input id="idPompierToDelete" name="idPompierToDelete" value="none" hidden>
                            <button type="submit" class="btn btn-success">OUI</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>













        <?php

        function round_up($number, $precision = 1) {
            $fig = (int) str_pad('1', $precision, '0');
            return (ceil($number * $fig) / $fig);
        }

        $nbPage = round_up($CountPompier / 20);
        $index = 1;
        $classPreview = "";
        $classNext = "";
        if ($NumPage == 1) {
            $classPreview = "disabled";
        }
        if (strval($NumPage) == strval($nbPage)) {
            $classNext = "disabled";
        }
        ?>

        <footer>
            <nav aria-label="Page navigation">
                <ul class="pagination justify-content-center">
                    <li class="page-item <?php echo $classPreview; ?>">
                        <a class="page-link" href="?page=<?php echo $NumPage - 1, $NumLikes; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                    <?php
                    $pageLimit = $index + 20;
                    while ($index <= $nbPage) {
                        $isactive = "";
                        if ($index == $NumPage) {
                            $isactive = "active";
                        }
                        ?>
                        <li class="page-item <?php echo $isactive ?>"><a class="page-link" href="?page=<?php echo $index, $NumLikes; ?>"><?php echo $index; ?></a></li>
                        <?php
                        $index += 1;
                    }
                    ?>

                    <li class="page-item <?php echo $classNext ?>">
                        <a class="page-link" href="?page=<?php echo $NumPage + 1, $NumLikes; ?>" aria-label="Next">
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