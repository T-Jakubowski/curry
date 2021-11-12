<?php
use app\models\User;
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
    public function findPermissionById(int $id) : int {
        $sql = 'SELECT * FROM role WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            return $row['permission'];
        } 
    }
    
    public function isLoginValide(string $identifiant, string $password) : bool {
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
        $sql = 'SELECT * FROM user WHERE Identifiant=:Identifiant and password=:password;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $identifiant);
        $prepared_Statement->bindParam("password", $password);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $user = new User ($row['Identifiant'], $row['Nom'], $row['Prenom'], $row['password'], $row['idRole']);
        }
        return $user;
    }
}
