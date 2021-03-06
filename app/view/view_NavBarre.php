<?php

namespace app\view;
use app\utils\Auth;
/*
 * @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
 * @param string $ActivePageName
 */
//FAKE VALUE TEST
$permEdit = true;

$IsActive1 = "";
$IsActive2 = "";
$IsActive3 = "";
$IsActive4 = "";
$IsActive5 = "";
if (isset($ActivePageName)) {
    switch ($ActivePageName) {
        case "home":
            $IsActive1 = "active";
            break;
        case "pompier":
            $IsActive2 = "active";
            break;
        case "caserne":
            $IsActive3 = "active";
            break;
        case "user":
            $IsActive4 = "active";
            break;
        case "role":
            $IsActive5 = "active";
            break;
    }
} else {
    $ActivePageName = "Undefine";
}
?>


<header>
    <nav class="navbar navbar-expand-lg navbar-light" style="background-color: #ff8787;">
        <div class="container-fluid">
            <a class="navbar-brand">Navigation</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">
                    <?php
                    $auth = new auth();
                    $permission_read = $auth->can('read');
                    $permission_manage = $auth->can('manage');
                    if ($permission_read) {
                        ?>
                        <a class="nav-link <?php echo $IsActive1; ?>" href="/home">Home</a>
                        <a class="nav-link <?php echo $IsActive2; ?>" href="/pompier/affiche">Pompier</a>
                        <a class="nav-link <?php echo $IsActive3; ?>" href="/caserne/affiche">Caserne</a>
                        <?php
                    }
                    ?>

                    <?php
                    if ($permission_manage) {
                        ?>
                        <a class="nav-link <?php echo $IsActive4; ?>" href="/user/affiche">User</a>
                        <a class="nav-link <?php echo $IsActive5; ?>" href="/role/affiche">Role</a>
                    <?php } ?>
                </div>
            </div>
            <a class="btn btn-danger" href="/logout"><img src="/img/logout_black_24dp.svg" alt="Deconnexion"></a>
        </div>

        <?php if ($ActivePageName != "home") { ?>
            <form class="d-flex" target="/<?php echo $ActivePageName ?>/affiche" id="<?php echo $ActivePageName; ?>FormSearch">
                <input class="form-control me-2" id="<?php echo $ActivePageName; ?>InputSearch" name="search" type="search" placeholder="Search <?php echo $ActivePageName ?>" aria-label="Search">
                <button class="btn btn-success" type="submit">Search</button>
            </form>
        <?php } ?>
    </nav>
</header>