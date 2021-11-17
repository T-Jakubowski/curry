<?php

namespace app\controllers;

use app\models\DAOPompier;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Pompier;
use app\utils\filtre\filtrePompier\FiltrePompier;
use app\utils\Auth;

class PompierController extends BaseController {

    private DAOPompier $DAOPompier;

    public function __construct() {
        $cnx = SingletonDBMaria::getInstance()->getConnection();
        $DAOPompier = new DAOPompier($cnx);
        $this->DAOPompier = $DAOPompier;
    }

    //renvoie la page avec la liste de tout les pompier
    public function show() {

        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $permission = $auth->can('read');
            if ($permission) {
                if (isset($_GET["page"])) {
                    $Offset = ($_GET["page"] * 20) - 20;
                } else {
                    $Offset = 0;
                }
                if (isset($_GET["search"])) {
                    $NumP = ($_GET["search"]);
                    $LstPompier = $this->DAOPompier->findAllWhereNom($NumP, 0, 20);
                    $CountPompier = $this->DAOPompier->countWhere($NumP);
                } else {
                    $LstPompier = $this->DAOPompier->findAll($Offset, 20);
                    $CountPompier = $this->DAOPompier->count();
                }
                $page = Renderer::render("view_pompier.php", compact("LstPompier", "CountPompier"));
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

    //
    public function insert() {

        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $permission = $auth->can('write');
            if ($permission) {
                $matricule = htmlspecialchars($_POST['addmatricule']);
                $nom = htmlspecialchars($_POST['addnom']);
                $prenom = htmlspecialchars($_POST['addprenom']);
                $chefAgret = htmlspecialchars($_POST['addchefagret']);
                $dateNaissance = htmlspecialchars($_POST['adddatenaissance']);
                $numCaserne = htmlspecialchars($_POST['addnumcaserne']);
                $codeGrade = htmlspecialchars($_POST['addcodegrade']);
                $matriculeRespo = htmlspecialchars($_POST['addmatriculerespo']);
                $data = array(
                    "matricule" => $matricule,
                    "nom" => $nom,
                    "prenom" => $prenom,
                    "chefAgret" => $chefAgret,
                    "dateNaissance" => $dateNaissance,
                    "numCaserne" => $numCaserne,
                    "codeGrade" => $codeGrade,
                    "matriculeRespo" => $matriculeRespo,
                );
                $f = new FiltrePompier($data);
                $data = $f->pompie();
                $isSuccess = true;
                foreach ($data as $key => $value) {
                    if ($value == false) {
                        $isSuccess = false;
                        $valueError[] = $key;
                    }
                }
                if ($isSuccess == true) {
                    $id = 0;
                    $pompierToAdd = new Pompier($matricule, $nom, $prenom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo);
                    $this->DAOPompier->save($pompierToAdd);
                    $resultMessage = "le pompier numéro a bien été ajouter";
                    $page = Renderer::render("view_pompier_add.php", compact("resultMessage"));
                } else {
                    $page = Renderer::render("view_pompier_add.php", compact("valueError"));
                }
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

    public function update(): void {

        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $permission = $auth->can('update');
            if ($permission) {
                $matricule = htmlspecialchars($_POST['edimatricule']);
                $isExist = $this->DAOPompier->findIfMatriculePompierExist($matricule);
                $isSuccess = false;
                if ($isExist == true) {
                    $nom = htmlspecialchars($_POST['editnom']);
                    $prenom = htmlspecialchars($_POST['editprenom']);
                    $chefAgret = htmlspecialchars($_POST['editchefagret']);
                    $dateNaissance = htmlspecialchars($_POST['editdatenaissance']);
                    $numCaserne = htmlspecialchars($_POST['editnumcaserne']);
                    $codeGrade = htmlspecialchars($_POST['editcodegrade']);
                    $matriculeRespo = htmlspecialchars($_POST['editmatriculerespo']);
                    $data = array(
                        "matricule" => $matricule,
                        "nom" => $nom,
                        "prenom" => $prenom,
                        "chefAgret" => $chefAgret,
                        "dateNaissance" => $dateNaissance,
                        "numCasene" => $numCaserne,
                        "codeGrade" => $codeGrade,
                        "matriculeRespo" => $matriculeRespo,
                    );
                    $f = new FiltrePompier($data);
                    $data = $f->pompie();
                    $isSuccess = true;
                    foreach ($data as $key => $value) {
                        if ($value == false) {
                            if ($key != "matricule") {
                                $isSuccess = false;
                                $valueError[] = $key;
                            }
                        }
                    }
                }
                if ($isSuccess == true) {
                    $pompierToUpdate = new Pompier($matricule, $nom, $prenom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo);
                    $this->DAOPompier->edit($pompierToUpdate);
                    $resultMessage = "le pompier numéro '" . $matricule . "' a bien été modifier";
                    $page = Renderer::render("view_pompier_edit.php", compact("resultMessage"));
                } else {
                    $page = Renderer::render("view_pompier_edit.php", compact("valueError"));
                }
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

    public function delete(): void {

        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $permission = $auth->can('delete');
            if ($permission) {
                $id = htmlspecialchars($_POST['idPompierToDelete']);
                $isExist = $this->DAOPompier->findIfMatriculePompierExist($id);
                if ($isExist == true) {
                    $resultMessage = "le pompier numéro '" . $id . "' a bien été Supprimer";
                    $this->DAOPompier->remove($id);
                    $page = Renderer::render("view_pompier_delete.php", compact("resultMessage"));
                } else {
                    $valueError = "Vous ne pouvez pas supprimer le pompier " . $id . " pour l'instant";
                    $page = Renderer::render("view_pompier_delete.php", compact("valueError"));
                }
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

}

?>