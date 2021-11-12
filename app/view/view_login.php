<?php
namespace app\views;
?>

<html>
  <?php include "Head.php" ;?>
  <body>
    <script type="text/javascript">
    function TurnVisibility() {
      var x = document.getElementById("inputPassword");
      var y = document.getElementById("VisibilityImg")
      
      if (x.type === "password") {
        x.type = "text";
        y.src="/img/visibility_off_black_24dp.svg"
      } else {
        x.type = "password";
        y.src="/img/visibility_black_24dp.svg"
      }
    }
    </script>
    <style>
      body {
        background-color:#e60000;
      }
      #turnVisibilityPass:hover {
      background-color: #ccc;
      cursor: pointer;
      }
    </style>



      <div class="d-flex justify-content-center" style="margin-top: 5rem;">
        <div class="card text-center bg-light" style="width: 35rem;">
          <div class="card-header">
            <img src="/img/iconFireman.png" class="img-fluid" alt="Icon">
          </div>
          <div class="card-body">
            <h5 class="card-title">Identifiant</h5>
            <input type="text" class="form-control" id="inputidentifiant">
            <h5 class="card-title">Password</h5>
            <div class="input-group mb-3">
              <input type="password" class="form-control" id="inputPassword">
              <span id="turnVisibilityPass" onclick="TurnVisibility()" class="input-group-text"><img id="VisibilityImg" class="fit-picture" src="/img/visibility_black_24dp.svg" alt="Turn Visibility"></span>
            </div>
          </div>
          <div class="card-footer text-muted">
            <div class="d-grid gap-2 col-6 mx-auto">
              <button type="button" class="btn btn-success btn-lg">Connexion</button>
            </div>
          </div>
        </div>
      </div>


    
  </body>
</html>