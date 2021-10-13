<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use app\models\Pompier;

/**
 * Description of PompierController
 *
 * @author student
 */
class PompierController extends BaseController {
    
    private $daoPompier;

    public function __construct() {
        $cnx = \app\utils\SingletonDBMaria::getInstance()->getConnection();
        $DAOPompier = new \app\models\DAOPompier($cnx);
        $this->daoPompier = $DAOPompier;
    }

    //Renvoie la page de tous les pompiers
    public function Show(): void {
        $pompiers = $this->daoPompier->findAll('0', '100');
        $page = \app\utils\Renderer::render('vue_pompier.php', compact('pompiers'));
        echo $page;
    }

    public function Add(): void {

        $matricule = $_POST['addMatricule'];
        $prenom = $_POST['addPrenom'];
        $nom = $_POST['addNom'];
        $chefAgret = $_POST['addChefAgret'];
        $dateNaissance = $_POST['addDateNaissance'];
        $numCaserne = $_POST['addNumCaserne'];
        $codeGrade = $_POST['addCodeGrade'];
        $matriculeRespo = $_POST['addMatriculeRespo'];

        $p = new Pompier($matricule, $prenom, $nom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo);
        $pompier = $this->daoPompier->save($p);
        
        $page = \app\utils\Renderer::render('add.php', compact('pompier'));
        echo $page;
    }

    public function edit() {
        
        $matricule = $_POST['editMatricule'];
        $prenom = $_POST['editPrenom'];
        $nom = $_POST['editNom'];
        $chefAgret = $_POST['editChefAgret'];
        $dateNaissance = $_POST['editDateNaissance'];
        $numCaserne = $_POST['editNumCaserne'];
        $codeGrade = $_POST['editCodeGrade'];
        $matriculeRespo = $_POST['editMatriculeRespo'];

        $p = new Pompier($matricule, $prenom, $nom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo);
        $pompier = $this->daoPompier->edit($p);
        
        $page = \app\utils\Renderer::render('edit.php', compact('pompier'));
        echo $page;

        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function delete(): void {
        
        $matricule = $_POST['deleteMatricule'];
        
        $pompiers = $this->daoPompier->remove($matricule);
        $page = \app\utils\Renderer::render('delete.php', compact('pompiers'));
        echo $page;
        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function ShowDetails() {
        
    }

}
