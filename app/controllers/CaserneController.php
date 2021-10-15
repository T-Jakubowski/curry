<?php
namespace app\controllers;
use app\models\DAOCaserne;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Caserne;

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

        //A AJOUTER SECURITER VERIFIACTION DATA
        $caserneToAdd = new Caserne(htmlspecialchars($_POST['AddCaserne_NumCaserne']),htmlspecialchars($_POST['AddCaserne_Addresse']),htmlspecialchars($_POST['AddCaserne_CP']),htmlspecialchars($_POST['AddCaserne_Ville']),htmlspecialchars($_POST['AddCaserne_CodeTypeC']));
        $isSuccess=$this->DAOCaserne->save($caserneToAdd);
        $page=Renderer::render("view_AddCaserne.php", compact("isSuccess"));
        echo $page;

        
        //$page=Renderer::render("view_caserne.php", compact("isSuccess"));
        //echo $page;

        //$page=Renderer::render("view_caserne.php"/*, compact("")*/);
        //echo $page;

        //methode get du protocole http
        //pareil que update ...

    }
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