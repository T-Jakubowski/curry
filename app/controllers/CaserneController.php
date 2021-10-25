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
        
        $LstCaserne = $this->DAOCaserne->findAll();
        $page=Renderer::render("view_caserne.php", compact("LstCaserne"));
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
        var_dump($data);
        $isSuccess=true;
        foreach($data as $key=>$value){
            if ($value==false){
                $isSuccess=false;
                $valueError=$key;
                echo $value;
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
        $matricule = htmlspecialchars($_POST['AddCaserne_NumCaserne']);//pas sur numaddresse pour le update
        $prenom = htmlspecialchars($_POST['AddCaserne_Addresse']);
        $nom = htmlspecialchars($_POST['AddCaserne_CP']);
        $chefAgret = htmlspecialchars($_POST['AddCaserne_Ville']);
        $dateNaissance = htmlspecialchars($_POST['AddCaserne_CodeTypeC']);

        $p = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']),htmlspecialchars($_POST['AddCaserne_Addresse']),htmlspecialchars($_POST['AddCaserne_CP']),htmlspecialchars($_POST['AddCaserne_Ville']),htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
        $pompier = $this->daoPompier->save($p);
        
        $page = \app\utils\Renderer::render('view_pompier_add.php', compact('pompier'));
        echo $page;
    }


        





    public function delete($id) : void{//methode del du protocole http
        $CaserneDetail = $this->DAOCaserne->remove($id);
        $page=Renderer::render("view_caserne.php", compact("LstCaserne"));
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