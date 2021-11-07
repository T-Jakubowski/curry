<?php

namespace app\controllers;

use app\models\DAOUser;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\User;
use app\utils\filtre\FiltreUser;

class Usercontroller extends BaseController {

    private DAOUser $DAOUser;

    public function __construct() {
        $cnx = SingletonDBMaria::getInstance()->getConnection();
        $DAOUser = new DAOUser($cnx);
        $this->DAOUser = $DAOUser;
    }

    //renvoie la page avec la liste de tout les pompier
    public function show() {
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

    //
    public function insert() {
        $identifiant = htmlspecialchars($_POST['addidentifiant']);
        $password = htmlspecialchars($_POST['addpassword']);
        $role = htmlspecialchars($_POST['addidrole']);
        $data = array(
            "identifiant" => $identifiant,
            "password" => $password,
            "role" => $role,
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
            $id = 0;
            $userToAdd = new User($id, htmlspecialchars($_POST['addidentifiant']), htmlspecialchars($_POST['addpassword']), htmlspecialchars($_POST['addidrole']));
            $this->DAOUser->save($userToAdd);
            $resultMessage = "le user numéro a bien été ajouter";
            $page = Renderer::render("view_user_add.php", compact("resultMessage"));
        } else {
            $page = Renderer::render("view_user_add.php", compact("valueError"));
        }
        echo $page;
    }

    public function update(): void {
        $id = htmlspecialchars($_POST['editid']);
        $isExist = $this->DAOUser->findIfUserIdExist($id);
        $isSuccess = false;
        if ($isExist == true) {
            $identifiant = htmlspecialchars($_POST['editidentifiant']);
            $password = htmlspecialchars($_POST['editpassword']);
            $role = htmlspecialchars($_POST['editidrole']);
            $data = array(
                "id" => $id,
                "identifiant" => $identifiant,
                "password" => $password,
                "role" => $role,
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
            $userToUpdate = new User(htmlspecialchars($_POST['editid']), htmlspecialchars($_POST['editidentifiant']), htmlspecialchars($_POST['editpassword']), htmlspecialchars($_POST['editidrole']));
            $this->DAOUser->edit($userToUpdate);
            $resultMessage = "le user numéro '" . $id . "' a bien été modifier";
            $page = Renderer::render("view_user_edit.php", compact("resultMessage"));
        } else {
            $page = Renderer::render("view_user_edit.php", compact("valueError"));
        }
        echo $page;
    }

    public function delete(): void {
        $id = htmlspecialchars($_POST['idUserToDelete']);
        $isExist = $this->DAOUser->findIfUserIdExist($id);
        if ($isExist == true) {
            $resultMessage = "le user numéro '" . $id . "' a bien été Supprimer";
            $this->DAOUser->remove($id);
            $page = Renderer::render("view_user_delete.php", compact("resultMessage"));
        } else {
            $valueError = "Vous ne pouvez pas supprimer le user " . $id . " pour l'instant";
            $page = Renderer::render("view_user_delete.php", compact("valueError"));
        }
        echo $page;
    }
}

?>