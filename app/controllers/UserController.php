<?php

namespace app\controllers;

use app\models\DAOUser;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\User;
use app\utils\filtre\FiltreUser;

class Usercontroller extends BaseController {

    private DAOUser $daousers;

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
        $id = htmlspecialchars($_POST['addid']);
        $isExist = $this->DAOUser->findIfNumUserExist($id);
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
                    if ($key != "num") {
                        $isSuccess = false;
                        $valueError[] = $key;
                    }
                }
            }
        }
        if ($isSuccess == true) {
            $userToUpdate = new User(htmlspecialchars($_POST['editid']), htmlspecialchars($_POST['editidentifiant']), htmlspecialchars($_POST['editpassword']), htmlspecialchars($_POST['editrole']));
            $this->DAOUser->update($userToUpdate);
            $resultMessage = "le user numéro '" . $id . "' a bien été modifier";
            $page = Renderer::render("view_user_edit.php", compact("resultMessage"));
        } else {
            $page = Renderer::render("view_user_edit.php", compact("valueError"));
        }
        echo $page;
    }

    public function delete(): void {
        $id = htmlspecialchars($_POST['idUserToDelete']);
        $isExist = $this->DAOUser->findIfNumUserExist($id);
        if ($isExist == true) {
            $resultMessage = "le user numéro '" . $id . "' a bien été Supprimer";
            $UserDetail = $this->DAOUser->remove($id);
            $page = Renderer::render("view_user_delete.php", compact("resultMessage"), compact("UserDetail"));
        } else {
            $valueError = "Vous ne pouvez pas supprimer le user " . $id . " pour l'instant";
            $page = Renderer::render("view_user_delete.php", compact("valueError"));
        }
        echo $page;
    }

    /*public function showDetails(string $id) {
        $isExist = $this->DAOCaserne->findIfNumCaserneExist($id);
        if ($isExist == true) {
            $Caserne = $this->DAOCaserne->find($id);
            $PompierOnCaserne = $this->DAOCaserne->findPompierFromCaserne($id); //TODO
            $page = Renderer::render("view_ShowDetail_Caserne.php", compact("Caserne", "PompierOnCaserne"));
        } else {
            $errMessage = "il n'existe pas de caserne avec le numero : " . $id;
            $page = Renderer::render("view_ShowDetail_Caserne.php", compact("errMessage"));
        }
        echo $page;
        //afficher plus de détail sur un pompier
    }*/

}

?>