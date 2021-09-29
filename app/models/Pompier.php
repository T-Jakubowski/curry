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

   public function getMatricule() {
       return $this->matricule;
   }

   public function getPrenom() {
       return $this->prenom;
   }

   public function getNom() {
       return $this->nom;
   }

   public function getChefAgret() {
       return $this->chefAgret;
   }

   public function getDateNaissance() {
       return $this->dateNaissance;
   }

   public function getNumCaserne() {
       return $this->numCaserne;
   }

   public function getCodeGrade() {
       return $this->codeGrade;
   }

   public function getMatriculeRespo() {
       return $this->matriculeRespo;
   }

   public function setMatricule($matricule) {
       $this->matricule = $matricule;
       return $this;
   }

   public function setPrenom($prenom) {
       $this->prenom = $prenom;
       return $this;
   }

   public function setNom($nom) {
       $this->nom = $nom;
       return $this;
   }

   public function setChefAgret($chefAgret) {
       $this->chefAgret = $chefAgret;
       return $this;
   }

   public function setDateNaissance($dateNaissance) {
       $this->dateNaissance = $dateNaissance;
       return $this;
   }

   public function setNumCaserne($numCaserne) {
       $this->numCaserne = $numCaserne;
       return $this;
   }

   public function setCodeGrade($codeGrade) {
       $this->codeGrade = $codeGrade;
       return $this;
   }

   public function setMatriculeRespo($matriculeRespo) {
       $this->matriculeRespo = $matriculeRespo;
       return $this;
   }
}



?>