<?php

namespace app\controllers;

use app\models\DAOCaserne;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Caserne;
use app\utils\Auth;
use app\utils\filtre\filtreCaserne\FiltreCaserne;

class Casernecontroller extends BaseController {

    private DAOCaserne $daocaserne;

    public function __construct() {
        $cnx = SingletonDBMaria::getInstance()->getConnection();
        $DAOCaserne = new DAOCaserne($cnx);
        $this->DAOCaserne = $DAOCaserne;
    }

    /*
      Affiche la page caserne
      @return void
     */

    public function show(): void {
        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $readPerm = $auth->can('read');
            if ($readPerm == true) {
                if (isset($_GET["page"])) {
                    $Offset = ($_GET["page"] * 10) - 10;
                } else {
                    $Offset = 0;
                }
                if (isset($_GET["search"])) {
                    $NumC = ($_GET["search"]);
                    $LstCaserne = $this->DAOCaserne->findAllWhereNum($NumC, $Offset, 10);
                    $CountCaserne = $this->DAOCaserne->countWhereNum($NumC);
                } else {
                    $LstCaserne = $this->DAOCaserne->findAll($Offset, 10);
                    $CountCaserne = $this->DAOCaserne->count();
                }

                $insertPerm = $auth->can('write');
                $updatePerm = $auth->can('update');
                $deletePerm = $auth->can('delete');
                $page = Renderer::render("view_caserne.php", compact("LstCaserne", "CountCaserne", "insertPerm", "updatePerm", "deletePerm"));
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

    /*
      Créer une caserne
      @return void
     */

    public function insert(): void {
        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
<<<<<<< HEAD

=======
>>>>>>> 13e9fd10166c12d7015fe970e13674ef115f8447
            $insertPerm = $auth->can('write');
                if ($insertPerm == true) {
                $NumCaserne = htmlspecialchars($_POST['AddCaserne_NumCaserne']);
                $Addresse = htmlspecialchars($_POST['AddCaserne_Addresse']);
                $CP = htmlspecialchars($_POST['AddCaserne_CP']);
                $Ville = htmlspecialchars($_POST['AddCaserne_Ville']);
                $CodeTypeC = htmlspecialchars($_POST['AddCaserne_CodeTypeC']);
                $data = array(
                    "num" => $NumCaserne,
                    "addresse" => $Addresse,
                    "cp" => $CP,
                    "ville" => $Ville,
                    "codetypec" => $CodeTypeC
                );
                $f = new FiltreCaserne($data);
                $data = $f->caser();
                $isSuccess = true;
                foreach ($data as $key => $value) {
                    if ($value == false) {
                        $isSuccess = false;
                        $valueError[] = $key;
                    }
                }
                if ($isSuccess == true) {

                    $caserneToAdd = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']), htmlspecialchars($_POST['AddCaserne_Addresse']), htmlspecialchars($_POST['AddCaserne_CP']), htmlspecialchars($_POST['AddCaserne_Ville']), htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
                    $this->DAOCaserne->save($caserneToAdd);
                    $resultMessage = "la caserne numéro '" . $NumCaserne . "' a bien été ajouter";
                    $page = Renderer::render("view_AddCaserne.php", compact("resultMessage"));
                } else {
                    $page = Renderer::render("view_AddCaserne.php", compact("valueError"));
                }
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

    /*
      Modifie une caserne
      @return void
     */

    public function update(): void {
        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $updatePerm = $auth->can('update');
            if ($updatePerm == true) {
                $NumCaserne = htmlspecialchars($_POST['UpdateCaserne_NumCaserne']);
                $isExist = $this->DAOCaserne->findIfNumCaserneExist($NumCaserne);
                $isSuccess = false;
                if ($isExist == true) {
                    $Addresse = htmlspecialchars($_POST['UpdateCaserne_Addresse']);
                    $CP = htmlspecialchars($_POST['UpdateCaserne_CP']);
                    $Ville = htmlspecialchars($_POST['UpdateCaserne_Ville']);
                    $CodeTypeC = htmlspecialchars($_POST['UpdateCaserne_CodeTypeC']);
                    $data = array(
                        "num" => $NumCaserne,
                        "addresse" => $Addresse,
                        "cp" => $CP,
                        "ville" => $Ville,
                        "codetypec" => $CodeTypeC
                    );
                    $f = new FiltreCaserne($data);
                    $data = $f->caser();
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
                    $caserneToUpdate = new Caserne(htmlspecialchars($_POST['UpdateCaserne_NumCaserne']), htmlspecialchars($_POST['UpdateCaserne_Addresse']), htmlspecialchars($_POST['UpdateCaserne_CP']), htmlspecialchars($_POST['UpdateCaserne_Ville']), htmlspecialchars($_POST['UpdateCaserne_CodeTypeC']));
                    $this->DAOCaserne->update($caserneToUpdate);
                    $resultMessage = "la caserne numéro '" . $NumCaserne . "' a bien été modifier";
                    $page = Renderer::render("view_UpdateCaserne.php", compact("resultMessage"));
                } else {
                    $page = Renderer::render("view_UpdateCaserne.php", compact("valueError"));
                }
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
        }
        echo $page;
    }

    /*
      Supprime une caserne
      @return void
     */

    public function delete(): void {
        $auth = new Auth();
        $isactive = $auth->is_session_active();
        if ($isactive == true) {
            $deletePerm = $auth->can('delete');
            if ($deletePerm == true) {
                $id = htmlspecialchars($_POST['idCaserneToDelete']);
                $isExist = $this->DAOCaserne->findIfNumCaserneExist($id);
                if ($isExist == true) {
                    $PompierOnCaserne = $this->DAOCaserne->findPompierFromCaserne($id);
                    if (empty($PompierOnCaserne)) {
                        $resultMessage = "la caserne numéro '" . $id . "' a bien été Supprimer";
                        $CaserneDetail = $this->DAOCaserne->remove($id);
                        $page = Renderer::render("view_DeleteCaserne.php", compact("resultMessage"));
                    } else {
                        $valueError = "La caserne numéro " . $id . " possede des pompier et ne peut donc pas etre supprimer";
                        $page = Renderer::render("view_DeleteCaserne.php", compact("valueError"));
                    }
                } else {
                    $valueError = "Vous ne pouvez pas supprimer la caserne " . $id . " pour l'instant";
                    $page = Renderer::render("view_DeleteCaserne.php", compact("valueError"));
                }
            } else {
                $page = Renderer::render("view_denyAccess.php");
            }
        } else {
            $page = Renderer::render("view_login.php");
            }
            echo $page;
        }
<<<<<<< HEAD
=======










    public function showDetails(string $id){
        $isExist = $this->DAOCaserne->findIfNumCaserneExist($id);
        if ($isExist==true){
            $Caserne = $this->DAOCaserne->find($id);
            $PompierOnCaserne = $this->DAOCaserne->findPompierFromCaserne($id);//TODO
            $page=Renderer::render("view_ShowDetail_Caserne.php", compact("Caserne","PompierOnCaserne"));
        }else{
            $errMessage="il n'existe pas de caserne avec le numero : ".$id;
            $page=Renderer::render("view_ShowDetail_Caserne.php", compact("errMessage"));
        }
        echo $page;
        //afficher plus de détail sur un pompier
    }



>>>>>>> 13e9fd10166c12d7015fe970e13674ef115f8447
}

?>