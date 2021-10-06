<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use app\controllers;

/**
 * Description of PompierController
 *
 * @author student
 */
class PompierController extends BaseController {
    private $daoPompier;
    
    public function __construct(){
        $cnx = \app\utils\SingletonDBMaria::getInstance()->getConnection();
        $DAOPompier = new \app\models\DAOPompier($cnx);
        $this->daoPompier = $DAOPompier;
    }
    
    //Renvoie la page de tous les pompiers
    public function Show() :void{
        $pompiers = $this->daoPompier->findAll();
        $page = \app\utils\Renderer::render('vue_pompier.php', compact('pompiers'));
        echo $page;
    }
    
    
    
    public function Update() {
           //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }
    
    public function delete():void{
          //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }
    
    public function ShowDetails(){
        
    }
}
