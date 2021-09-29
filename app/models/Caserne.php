<?php
namespace app\models;

class Caserne{
   private $NumCaserne;
   private $Adresse;
   private $CP;
   private $Ville;
   private $CodeTypeC;

   public function __construct($NumCaserne,$Adresse="",$CP="",$Ville="",$CodeTypeC)
   {
       $this->NumCaserne = $NumCaserne;
       $this->Adresse = $Adresse;
       $this->CP = $CP;
       $this->Ville = $Ville;
       $this->CodeTypeC = $CodeTypeC;
   }
    public function getNumCaserne(){
        return $this->NumCaserne;
    }
    public function getAdresse(){
        return $this->Adresse;
    }
    public function getCP(){
        return $this->CP;
    }
    public function getVille(){
        return $this->Ville;
    }
    public function getCodeTypeC(){
        return $this->CodeTypeC;
    }

    public function setNumCaserne($NumCaserne){
        $this->NumCaserne = $NumCaserne;
        return $this;
    }
    public function setAdresse($Adresse){
        $this->Adresse = $Adresse;
        return $this;
    }
    public function setCP($CP){
        $this->CP = $CP;
        return $this;
    }
    public function setVille($Ville){
        $this->Ville = $Ville;
        return $this;
    }
    public function setNumCodeTypeC($CodeTypeC){
        $this->CodeTypeC = $CodeTypeC;
        return $this;
    }
}

?>