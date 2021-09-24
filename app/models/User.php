<?php
namespace app\models;

class User{

    private $nom;
    private $prenom;
    public function __construct($nom,$prenom="")
    {
        $this->nom = $nom;
        $this->prenom = $prenom;

    }
}


?>