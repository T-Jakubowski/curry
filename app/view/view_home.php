<?php

namespace app\views;

//LISTE POMPIERS
//en + recherche par nom
//Systeme de pagination (en bas)
//bouton en bout de ligne pour supprimer pompier + confirmation
//Bouton pour éditer
?>

<html>
    <?php require "Head.php"; ?>


    <body>
<?php $ActivePageName = "home";
require "view_NavBarre.php"; ?>
        <br>


        <div class="row row-cols-1 row-cols-md-4 g-4">
            <div class="col">
                <div class="card">
                    <a href="/pompier/affiche">
                        <img src="/img/firefighter_black_24dp.svg" class="card-img-top" alt="Icon Pompier" height="200">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Pompier</h5>
                        <p class="card-text">Contient la liste des pompiers dans la base de données.</p>
                    </div>
                </div>
            </div>
            <div class="col">
                <div class="card">
                    <a href="/caserne/affiche">
                        <img src="/img/caserne_black_24dp.svg" class="card-img-top" alt="Icon Caserne" height="200">
                    </a>
                    <div class="card-body">
                        <h5 class="card-title">Caserne</h5>
                        <p class="card-text">Contient la liste des casernes dans la base de données.</p>
                    </div>
                </div>
            </div>
<?php
if ($permission_manage) {
    ?>
                <div class="col">
                    <div class="card">
                        <a href="/user/affiche">
                            <img src="/img/user_black_24dp.svg" class="card-img-top" alt="Icon User" height="200">
                        </a>

                        <div class="card-body">
                            <h5 class="card-title">User</h5>
                            <p class="card-text">Contient la liste des utilisateur de l'application.</p>
                        </div>
                    </div>
                </div>
                <div class="col">
                    <div class="card">
                        <a href="/role/affiche">
                            <img src="/img/role_black_24dp.svg" class="card-img-top" alt="Icon Role" height="200">
                        </a>
                        <div class="card-body">
                            <h5 class="card-title">Role</h5>
                            <p class="card-text">Contient la liste des role pouvant etre utilisé a des utilisateurs.</p>
                        </div>
                    </div>
                </div>
<?php } ?>
        </div>


    </body>
</html>