<?php

namespace app\views;
?>
<html>
    <?php include "Head.php"; ?>
    <script>
        function ConfirmDelete(id) {
            var x = document.getElementById("idCaserneToDelete");
            x.value = id;
        }
        function Edit(id) {
            var x = document.getElementById("UpdateCaserne_NumCaserne");
            x.value = id;
            x.innerHTML = id;
            var Adresse = document.getElementById(id + ":Adresse").innerHTML;
            var CP = document.getElementById(id + ":CP").innerHTML;
            var Ville = document.getElementById(id + ":Ville").innerHTML;
            var CodeTypeC = document.getElementById(id + ":CodeTypeC").innerHTML;

            document.getElementById("ULastValueCaserne_Adresse").value = Adresse;
            document.getElementById("ULastValueCaserne_CP").value = CP;
            document.getElementById("ULastValueCaserne_Ville").value = Ville;
            document.getElementById("ULastValueCaserne_CodeTypeC").value = CodeTypeC;
            document.getElementById("UpdateCaserne_Adresse").value = Adresse;
            document.getElementById("UpdateCaserne_CP").value = CP;
            document.getElementById("UpdateCaserne_Ville").value = Ville
            document.getElementById("UpdateCaserne_CodeTypeC").value = CodeTypeC;
        }
    </script>
    <body>
        <?php $ActivePageName = "caserne";
        include "view_NavBarre.php"; ?>
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
        <br>
        <div><h3>Liste des Casernes :</h3></div>

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
        <table id="tableCaserne" class="table table-striped table-hover table-Secondary .table-responsive" >
            <thead>
                <tr>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="NumCaserne Int(11)">#</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(15)">Addresse</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(5)">CP</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Varchar(10)">Ville</th>
                    <th data-bs-toggle="tooltip" data-bs-placement="top" title="Int(11)">CodeTypeC</th>
                    <th>Edit/Delete</th>

                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($LstUser as $User) {
                    /* @var Caserne $Caserne */
                    ?>
                    <tr>
                        <td><?php $id = $User->getId();
                    echo $id; ?></td>
                        <td id="<?php echo $id . ":Identifiant"; ?>"><?php echo $User->getIdentifiant(); ?></td>
                        <td id="<?php echo $id . ":Password"; ?>"><?php echo $User->getPassword(); ?></td>
                        <td id="<?php echo $id . ":IdRole"; ?>"><?php echo $User->getIdRole(); ?></td>td>
                        <td><button id="<?php echo $id . ":edit"; ?>" onclick="Edit(<?php echo $id; ?>)" type="button" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#editCaserneModal"><img class="fit-picture" src="/img/edit_black_24dp.svg" alt="edit"></button>
                            <button id="<?php echo $id . ":del"; ?>" onclick="ConfirmDelete(<?php echo $id; ?>)" type="button" class="btn btn-outline-danger" data-bs-toggle="modal" data-bs-target="#confirmDeleteCaserneModal"><img class="fit-picture" src="/img/delete_black_24dp.svg" alt="delete"></button></td>
                    </tr>
                    <?php
                }
                ?>

            </tbody>
        </table>














        <!-- Modal create Caserne-->
        <div class="modal fade" id="createUserModal" tabindex="-1" aria-labelledby="createUsModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createUserModalLabel">Create User</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form id="InsertUser" method="post" action="/User/add">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input id="addidentifiant" name="addidentifiant" type="text" class="form-control" placeholder="ex: t.jakubowski" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Identifiant</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addpassword" name="addpassword" type="text" class="form-control" placeholder="ex: *******" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Password</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="addidrole" name="addidrole" type="text" class="form-control" placeholder="ex: 1" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Id Role</span>
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
                    <form id="UpdateCaserne" method="post" action="/caserne/update">
                        <div class="modal-body">
                            <div class="input-group mb-3">
                                <input id="editidentifiant" name="editidentifiant" type="text" class="form-control" placeholder="ex: t.jakubowski" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Identifiant</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editpassword" name="editpassword" type="text" class="form-control" placeholder="ex: *******" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Password</span>
                            </div>
                            <div class="input-group mb-3">
                                <input id="editidrole" name="editidrole" type="text" class="form-control" placeholder="ex: 1" aria-label="Recipient's username" aria-describedby="basic-addon2">
                                <span class="input-group-text" id="basic-addon2">Id Role</span>
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
                        <form id="DeleteCaserne" method="post" action="/caserne/delete">
                            <input id="idCaserneToDelete" name="idCaserneToDelete" value="none" hidden>
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

$nbPage = round_up($CountCaserne / 10);
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