<?php
namespace app\models;

class Pompier{
   private $matricule;
   private $prenom;
   private $nom;
   private $chefAgret;
   private $dateNaissance;
   private $numCaserne;
   private $codeGrade;
   private $matriculeRespo;

   public function __construct($matricule, $prenom, $nom, $chefAgret, $dateNaissance, $numCaserne, $codeGrade, $matriculeRespo) {
       $this->matricule=$matricule;
       $this->prenom=$prenom;
       $this->nom=$nom;
       $this->chefAgret=$chefAgret;
       $this->dateNaissance=$dateNaissance;
       $this->numCaserne=$numCaserne;
       $this->codeGrade=$codeGrade;
       $this->matriculeRespo=$matriculeRespo;
   }
}

?>