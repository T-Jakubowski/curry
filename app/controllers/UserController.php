<?php

namespace app\controllers;

use app\models\DAOUser;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\User;
use app\utils\filtre\filtreUser\FiltreUser;

class UserController extends BaseController {

    private DAOUser $DAOUser;

    public function __construct() {
        $cnx = SingletonDBMaria::getInstance()->getConnection();
        $DAOUser = new DAOUser($cnx);
        $this->DAOUser = $DAOUser;
    }

    /*
        Affiche la page user
        @return void
    */
    public function show() : void{
        if (isset($_GET["page"])) {
            $Offset = ($_GET["page"] * 10) - 10;
        } else {
            $Offset = 0;
        }
        if (isset($_GET["search"])) {
            $NumU = ($_GET["search"]);
            $LstUser = $this->DAOUser->findAllWhereIdentifiant($NumU, 0, 10);
            $CountUser = $this->DAOUser->countWhere($NumU);
        } else {
            $LstUser = $this->DAOUser->findAll($Offset, 10);
            $CountUser = $this->DAOUser->count();
        }
        $page = Renderer::render("view_user.php", compact("LstUser", "CountUser"));
        echo $page;
    }

    /*
        Creer un user
        @return void
    */
    public function insert() : void{
        $identifiant = htmlspecialchars($_POST['addidentifiant']);
        $nom = htmlspecialchars($_POST['addnom']);
        $prenom = htmlspecialchars($_POST['addprenom']);
        $password = htmlspecialchars($_POST['addpassword']);
        $role = htmlspecialchars($_POST['addidrole']);
        $data = array(
            "identifiant" => $identifiant,
            "nom" => $nom,
            "prenom" => $prenom,
            "password" => $password,
            "idRole" => $role,
        );
        $f = new FiltreUser($data);
        $data = $f->use();
        $isSuccess = true;
        foreach ($data as $key => $value) {
            if ($value == false) {
                $isSuccess = false;
                $valueError[] = $key;
            }
        }
        if ($isSuccess == true) {
            $password = hash('sha256', $password);
            $userToAdd = new User($identifiant, $nom, $prenom, $password, $role);
            $this->DAOUser->save($userToAdd);
            $resultMessage = "le user numéro a bien été ajouter";
            $page = Renderer::render("view_user_add.php", compact("resultMessage"));
        } else {
            $page = Renderer::render("view_user_add.php", compact("valueError"));
        }
        echo $page;
    }

    /*
        Modifie un user
        @return void
    */
    public function update(): void {
        $identifiant = htmlspecialchars($_POST['editidentifiant']);
        $isExist = $this->DAOUser->findIfUserIdentifiantExist($identifiant);
        $isSuccess = false;
        if ($isExist == true) {
            $nom = htmlspecialchars($_POST['editnom']);
            $prenom = htmlspecialchars($_POST['editprenom']);
            $password = htmlspecialchars($_POST['editpassword']);
            $role = htmlspecialchars($_POST['editidrole']);
            $data = array(
                "identifiant" => $identifiant,
                "nom" => $nom,
                "prenom" => $prenom,
                "password" => $password,
                "idRole" => $role,
            );
            $f = new FiltreUser($data);
            $data = $f->use();
            $isSuccess = true;
            foreach ($data as $key => $value) {
                if ($value == false) {
                    if ($key != "identifiant") {
                        $isSuccess = false;
                        $valueError[] = $key;
                    }
                }
            }
        }
        if ($isSuccess == true) {
            $password = hash('sha256', $password);
            $userToUpdate = new User($identifiant, $nom, $prenom, $password, $role);
            $this->DAOUser->edit($userToUpdate);
            $resultMessage = "le user numéro '" . $identifiant . "' a bien été modifier";
            $page = Renderer::render("view_user_edit.php", compact("resultMessage"));
        } else {
            $page = Renderer::render("view_user_edit.php", compact("valueError"));
        }
        echo $page;
    }

    /*
        Supprime un user
        @return void
    */
    public function delete(): void {
        $identifiant = htmlspecialchars($_POST['idUserToDelete']);
        $isExist = $this->DAOUser->findifUserIdentifiantExist($identifiant);
        if ($_SESSION['identifiant'] == $identifiant) {
            if ($isExist == true) {
                $resultMessage = "le user numéro '" . $identifiant . "' a bien été Supprimer";
                $this->DAOUser->remove($identifiant);
                $page = Renderer::render("view_user_delete.php", compact("resultMessage"));
            } else {
                $valueError = "Vous ne pouvez pas supprimer le user " . $identifiant . " pour l'instant";
                $page = Renderer::render("view_user_delete.php", compact("valueError"));
            }
        }
        else{
            $valueError = "Vous ne pouvez pas vous supprimer";
            $page = Renderer::render("view_user_delete.php", compact("valueError"));
        }

        echo $page;
    }

}

?>