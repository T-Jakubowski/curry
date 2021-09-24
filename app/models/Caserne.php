<?php
namespace app\models;

class Caserne{
   private $NumCaserne;
   private $Adresse;
   private $CP;
   private $Ville;
   private $CodeTypeC;

   public function __construct($NumCaserne,$Adresse="")
   {
       $this->NumCaserne = $NumCaserne;
       $this->Adresse = $Adresse;

   }
}

?>