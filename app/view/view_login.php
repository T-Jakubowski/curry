<?php

namespace app\views;
?>

<html>
    <?php
    require "Head.php"; ?>
    <body>
        <script type="text/javascript">
            function TurnVisibility() {
                var x = document.getElementById("password");
                var y = document.getElementById("VisibilityImg")

                if (x.type === "password") {
                    x.type = "text";
                    y.src = "/img/visibility_off_black_24dp.svg"
                } else {
                    x.type = "password";
                    y.src = "/img/visibility_black_24dp.svg"
                }
            }
        </script>
        <style>
            body {
                background-color:#ff3333;
            }
            #turnVisibilityPass:hover {
                background-color: #ccc;
                cursor: pointer;
            }
        </style>
        <div class="d-flex justify-content-center" style="margin-top: 2rem;">
            <div class="card text-center bg-light" style="width: 35rem;">
                <div class="card-header">
                    <img src="/img/iconFireman.png" class="img-fluid" alt="Icon">
                </div>
                <form id="Connexion" method="post" action="/login/login">
                    <div class="card-body">

                        <h5 class="card-title">Identifiant</h5>
                        <input type="text" class="form-control" id="identifiant" name="identifiant">
                        <h5 class="card-title">Password</h5>
                        <div class="input-group mb-3">
                            <input type="password" class="form-control" id="password" name="password">
                            <span id="turnVisibilityPass" onclick="TurnVisibility()" class="input-group-text"><img id="VisibilityImg" class="fit-picture" src="/img/visibility_black_24dp.svg" alt="Turn Visibility"></span>
                        </div>
                    </div>
                    <div class="card-footer text-muted">
                        <div class="d-grid gap-2 col-6 mx-auto">
                            <button type="submit" class="btn btn-success btn-lg">Login</button>
                        </div>
                        <?php if (isset($WrongConnection)){?>
                        <br>
                        <div class="alert alert-danger" role="alert">
                            Echec de la connection
                        </div>
                        <?php }
                        if (isset($DestroyConnection)){?>
                        <br>
                        <div class="alert alert-success" role="alert">
                            Déconnexion réussi
                        </div>
                        <?php } ?>
                        
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>