<?php
namespace app\models;
class User{
    private $id;
    private $identifiant;
    private $password;
    private $IdRole;

    public function __construct($id="",$identifiant,$password,$IdRole)
    {
        $this->id = $id;
        $this->identifiant = $identifiant;
        $this->password = $password;
        $this->IdRole = $IdRole;
    }
    public function getId() {
        return $this->id;
    }
    public function getPassword() {
        return $this->password;
    }
    public function getIdentifiant() {
        return $this->identifiant;
    }
    public function getIdRole() {
        return $this->IdRole;
    }
    public function setId($id) {
        $this->id = $id;
        return $this;
    }
    public function setPassword($id) {
        $this->id = $id;
        return $this;
    }
    public function setIdentifiant($identifiant) {
        $this->identifiant = $identifiant;
        return $this;
    }
    public function setIdRoless($IdRole) {
        $this->IdRole = $IdRole;
        return $this;
    }
}



?>