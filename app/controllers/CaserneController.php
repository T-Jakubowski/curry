<?php
namespace app\controllers;
use app\models\DAOCaserne;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;

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
        $page=Renderer::render("caserne.php", compact("LstCaserne"));
        echo $page;
    }
    public function insert(){
        $CaserneDetail = $this->DAOCaserne->save();//TODO
        $page=Renderer::render("caserne.php", compact("LstCaserne"));
        echo $page;
        //methode get du protocole http
        //pareil que update ...

    }
    public function update() : void{
        //$CaserneDetail = $this->DAOCaserne->remove();//TODO METHODE UPDATE
        //$page=Renderer::render("caserne.php", compact("LstCaserne"));
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
        $page=Renderer::render("caserne.php", compact("LstCaserne"));
        echo $page;

    }
    public function showDetails(string $id){
        $CaserneDetail = $this->DAOCaserne->find($id);
        $page=Renderer::render("caserne.php", compact("LstCaserne"));
        echo $page;
        //afficher plus de détail sur un pompier
    }



}
?>