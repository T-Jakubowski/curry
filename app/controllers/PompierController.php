<?php

namespace app\controllers;

use app\models\DAOPompier;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Pompier;
use app\utils\filtre\FiltrePompier;

/**
 * Description of PompierController
 *
 * @author student
 */
class PompierController extends BaseController {
    private DAOPompier $daoPompier;

    public function __construct() {
        $cnx = \app\utils\SingletonDBMaria::getInstance()->getConnection();
        $DAOPompier = new \app\models\DAOPompier($cnx);
        $this->daoPompier = $DAOPompier;
    }

    //Renvoie la page de tous les pompiers
    public function Show(): void {
        $pompiers = $this->daoPompier->findAll('0', '1000');
        $page = \app\utils\Renderer::render('view_pompier.php', compact('pompiers'));
        echo $page;
    }

    public function Add(): void {

        $matricule = htmlspecialchars($_POST['addMatricule']);
        $prenom = htmlspecialchars($_POST['addPrenom']);
        $nom = htmlspecialchars($_POST['addNom']);
        $chefAgret = htmlspecialchars($_POST['addChefAgret']);
        $dateNaissance = htmlspecialchars($_POST['addDateNaissance']);
        $numCaserne = htmlspecialchars($_POST['addNumCaserne']);
        $codeGrade = htmlspecialchars($_POST['addCodeGrade']);
        $matriculeRespo = htmlspecialchars($_POST['addMatriculeRespo']);

        $p = new Pompier($matricule, $prenom, $nom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo);
        $pompier = $this->daoPompier->save($p);
        
        $page = \app\utils\Renderer::render('view_pompier_add.php', compact('pompier'));
        echo $page;
    }

    public function edit() {
        
        $matricule = htmlspecialchars($_POST['editMatricule']);
        $prenom = htmlspecialchars($_POST['editPrenom']);
        $nom = htmlspecialchars($_POST['editNom']);
        $chefAgret = htmlspecialchars($_POST['editChefAgret']);
        $dateNaissance = htmlspecialchars($_POST['editDateNaissance']);
        $numCaserne = htmlspecialchars($_POST['editNumCaserne']);
        $codeGrade = htmlspecialchars($_POST['editCodeGrade']);
        $matriculeRespo = htmlspecialchars($_POST['editMatriculeRespo']);

        $p = new Pompier($matricule, $prenom, $nom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo);
        $pompier = $this->daoPompier->edit($p);
        
        $page = \app\utils\Renderer::render('view_pompier_edit.php', compact('pompier'));
        echo $page;

        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function delete(): void {
        
        $matricule = htmlspecialchars($_POST['deleteMatricule']);
        
        $pompiers = $this->daoPompier->remove($matricule);
        $page = \app\utils\Renderer::render('view_pompier_delete.php', compact('pompiers'));
        echo $page;
        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function ShowDetails() {
        
    }

}
