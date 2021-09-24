<?php

namespace app\models;

class DAOCaserne{

    private $cnx;
   public function __construct($connect)
   {
       
   }

    public function find($id) : Caserne {

    }

    public function save(Caserne $pompier) : void{

    }

    public function remove(Caserne $pompier) : void{ 
        // supprimer object pompier plus dans la bdd
        // 
    }
    public function findAll($offset=0,$limit=10) : Array{

    }
    public function count() : int {

    }
    public function findFireHouseFromFireman(Pompier $pompier) : Pompier {

    }

}
?>