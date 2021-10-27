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


        //initialisation du dao
    }
    public function show(){
        //renvoie la page avec la liste de tout les pompier
        //plus pagination offset ...
        //sécurité
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
        //TODO ilre issuccess (tableau) et dire ce qui est true ou false
        //A AJOUTER SECURITER VERIFIACTION DATA TODO
        if ($isSuccess==true){
            /*
            $caserneToAdd = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']),htmlspecialchars($_POST['AddCaserne_Addresse']),htmlspecialchars($_POST['AddCaserne_CP']),htmlspecialchars($_POST['AddCaserne_Ville']),htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
            $resultMessage=$this->DAOCaserne->save($caserneToAdd);
            */
            $resultMessage="testttt";
            echo $isSuccess;
            $page=Renderer::render("view_AddCaserne.php", compact("resultMessage"));
            }else{
                $page=Renderer::render("view_AddCaserne.php", compact("valueError"));
            }
            echo $page;
        }
        //$page=Renderer::render("view_caserne.php", compact("isSuccess"));
        //echo $page;

        //$page=Renderer::render("view_caserne.php"/*, compact("")*/);
        //echo $page;

        //methode get du protocole http
        //pareil que update ...

    
    public function update() : void{

        


        //$CaserneDetail = $this->DAOCaserne->remove();//TODO METHODE UPDATE
        //$page=Renderer::render("view_caserne.php", compact("LstCaserne"));
        //echo $page;
        //methode put du protocole http
        //il faut filtrer les données (Faille XSS)
        //validé les donnée (donnée coerentes)
        //faille CSRF
        //pensé la sécurité
        //Gestion des erreur PDO (try catch)
        $NumCaserne = htmlspecialchars($_POST['UpdateCaserne_NumCaserne']);
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
            $p = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']),htmlspecialchars($_POST['AddCaserne_Addresse']),htmlspecialchars($_POST['AddCaserne_CP']),htmlspecialchars($_POST['AddCaserne_Ville']),htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
            $pompier = $this->DAOCaserne->save($p);
            $page=Renderer::render("view_AddCaserne.php", compact("resultMessage"));
        }else{
            $page=Renderer::render("view_AddCaserne.php", compact("valueError"));
        }
        echo $page;
    }

    public function delete($id) : void{//methode del du protocole http
        
        $isExist = $this->DAOCaserne->findIfNumCaserneExist($id);
        if ($isExist==true){
            $CaserneDetail = $this->DAOCaserne->remove($id);
            $page=Renderer::render("view_AddCaserne.php", compact("LstCaserne"));//TODO
        }else{
            $page=Renderer::render("view_AddCaserne.php", compact("valueError"));
        }
        echo $page;

    }
    public function showDetails(string $id){
        $CaserneDetail = $this->DAOCaserne->find($id);
        $page=Renderer::render("view_DeleteCaserne.php", compact("LstCaserne"));
        echo $page;
        //afficher plus de détail sur un pompier
    }



}
?>