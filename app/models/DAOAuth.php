<?php

namespace app\models;

class DAOAuth {

    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }
    public function findRoleById($Id) : string {
        $sql = 'SELECT * FROM role WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            return $row['role'];
        }
    }
    public function findPermissionById(int $Id) : int {
        $sql = 'SELECT * FROM role WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            return $row['permission'];
        } 
    }
    
    public function isLoginValide(string $identifiant, string $password) : bool {
        $password=hash('sha256', $password);
        $sql = 'SELECT * FROM user WHERE Identifiant=:Identifiant and password=:password;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $identifiant);
        $prepared_Statement->bindParam("password", $password);
        $prepared_Statement->execute();
        $loginValide = false;
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $loginValide = true;
        }
        return $loginValide;
    }
    
    public function findUserByLogin(string $identifiant, string $password) {
        $password=hash('sha256', $password);
        $sql = 'SELECT * FROM user WHERE Identifiant=:Identifiant and password=:password;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $identifiant);
        $prepared_Statement->bindParam("password", $password);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User ($row['Identifiant'], $row['Nom'], $row['Prenom'], $row['password'], $row['IdRole']);
        }
        return $user;
    }
}
