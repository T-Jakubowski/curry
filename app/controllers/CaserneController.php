<?php
namespace app\controllers;
use app\models\DAOCaserne;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Caserne;

use app\utils\filtre\FiltreCaserne;

class Casernecontroller extends BaseController{
    private DAOCaserne $daocaserne;

    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $DAOCaserne=new DAOCaserne($cnx);
        $this->DAOCaserne = $DAOCaserne;
    }

    //renvoie la page avec la liste de tout les pompier
    public function show(){
        if (isset($_GET["page"])){
            $Offset=($_GET["page"]*10)-10;
          }else{
            $Offset=0;
          }
          if (isset($_GET["search"])){
            $NumC=($_GET["search"]);
            $LstCaserne = $this->DAOCaserne->findAllWhereNum($NumC,$Offset,10);
            $CountCaserne = $this->DAOCaserne->countWhereNum($NumC);
          }else{
            $LstCaserne = $this->DAOCaserne->findAll($Offset,10);
            $CountCaserne = $this->DAOCaserne->count();
          }
        $page=Renderer::render("view_caserne.php", compact("LstCaserne","CountCaserne"));
        echo $page;
    }

    //
    public function insert(){
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
        $f=new FiltreCaserne($data);
        $data=$f->caser();
        $isSuccess=true;
        foreach($data as $key=>$value){
            if ($value==false){
                $isSuccess=false;
                $valueError[]=$key;
            }
        }

        if ($isSuccess==true){
            /*  Ajout dans la bdd
            $caserneToAdd = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']),htmlspecialchars($_POST['AddCaserne_Addresse']),htmlspecialchars($_POST['AddCaserne_CP']),htmlspecialchars($_POST['AddCaserne_Ville']),htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
            $this->DAOCaserne->save($caserneToAdd);
            */
            $resultMessage="la caserne ".$NumCaserne."a bien été ajouter";
            $page=Renderer::render("view_AddCaserne.php", compact("resultMessage"));
        }else{
            $page=Renderer::render("view_AddCaserne.php", compact("valueError"));
        }
        echo $page;
    }


    public function update() : void{
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
        $f=new FiltreCaserne($data);
        $data=$f->caser();
        $isSuccess=true;
        foreach($data as $key=>$value){
            if ($value==false){
                $isSuccess=false;
                $valueError[]=$key;
            }
        }

        if ($isSuccess==true){
            /*  update dans la bdd
            $caserneToUpdate = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']),htmlspecialchars($_POST['AddCaserne_Addresse']),htmlspecialchars($_POST['AddCaserne_CP']),htmlspecialchars($_POST['AddCaserne_Ville']),htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
            $this->DAOCaserne->update($caserneToUpdate);
            */
            $resultMessage="la caserne ".$NumCaserne."a bien été ajouter";
            $page=Renderer::render("view_AddCaserne.php", compact("resultMessage"));
        }else{
            $page=Renderer::render("view_AddCaserne.php", compact("valueError"));
        }
        echo $page;
    }

    public function delete($id) : void{
        
        $isExist = $this->DAOCaserne->findIfNumCaserneExist($id);
        if ($isExist==true){
            $CaserneDetail = $this->DAOCaserne->remove($id);
            $page=Renderer::render(".php", compact(""));//TODO
        }else{
            $page=Renderer::render("view_AddCaserne.php", compact("valueError"));
        }
        echo $page;

    }
    public function showDetails(string $id){
        $isExist = $this->DAOCaserne->findIfNumCaserneExist($id);
        if ($isExist==true){
            $Caserne = $this->DAOCaserne->find($id);
            $PompierOnCaserne = $this->DAOPompier->findPompierFromCaserne($id);//TODO
            $page=Renderer::render("view_ShowDetail_Caserne.php", compact("Caserne","PompierOnCaserne"));
        }else{
            $errMessage="il n'existe pas de caserne avec le numero : ".$id;
            $page=Renderer::render("view_ShowDetail_Caserne.php", compact("errMessage"));
        }
        echo $page;
        //afficher plus de détail sur un pompier
    }



}
?>