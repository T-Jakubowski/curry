<?php
namespace app\models;
class DAOUser {
    private $cnx;
    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function find($Id) : User{
        $sql = 'SELECT * FROM user WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $user = new User($row['Id'],$row['Identifiant'],$row['Password'],$row['IdRole']);
        }
        return $user;
    }

    public function findByidentifiant($Identifiant) : User{
        $sql = 'SELECT * FROM User WHERE Identifiant=:Identifiant;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $Identifiant);
        $prepared_Statement->execute();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $user = new User($row['IdUser'],$row['Identifiant'],$row['Password'],$row['Id']);
        }
        return $user;
    }

    public function save(User $u): void {
        $sql = "INSERT INTO user(Identifiant, Password, IdRole)
                Values (:Identifiant, :Password, :IdRole);";
        $Identifiant = $u->getId();
        $Password = $u->getPassword();
        $IdRole = $u->getidRole();

        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $Identifiant);
        $prepared_Statement->bindParam("Password", $Password);
        $prepared_Statement->bindParam("IdRole", $IdRole);

        $prepared_Statement->execute();
    }

    
    public function edit(User $u) : void{
        
        $sql = 'UPDATE user
                SET Identifiant=:Identifiant, Password=:Password, IdRole=:IdRoless
                Where Id=:Id';
        
        $Identifiant = $u->getIdentifiant();
        $Password = $u->getPassword();
        $IdRole = $u->getIdRole();
        $Id = $u->getId();
        
        $prepared_Statement = $this->cnx->prepare($sql);
        
        $prepared_Statement->bindParam("Identifiant", $Identifiant);
        $prepared_Statement->bindParam("Password", $Password);
        $prepared_Statement->bindParam("IdRole", $IdRole);
        $prepared_Statement->bindParam("Id", $Id);
        
        $prepared_Statement->execute();
    }

    public function remove($Id): void {
        $sql = 'delete from user WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
    }

    public function findAll($offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM user LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $prepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $prepared_Statement->execute();
        
        $desUser=array();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $desUser[] = new User($row['IdUser'],$row['Identifiant'],$row['Password'],$row['IdRole']);
        }
        return $desUser;
    }

    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbUser from user u ;';
        $statement = $this->cnx->prepare($sql);
        $nbUser = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbUser = $nbUser['nbUser'];
        return $nbUser;
    }

    public function findIfRoleExiste($idRole){
        $SQL = 'SELECT * FROM role
        WHERE Id=:Id;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("Id",$idRole);
        $preparedStatement->execute();
        $isExist=false;
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isExist=true;
        }
        return $isExist;
    }
    public function findifUserExist($Identifiant){
        $sql = 'SELECT * FROM User WHERE Identifiant=:Identifiant;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $Identifiant);
        $prepared_Statement->execute();
        $isExist = false;
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $isExist = true;
        }
        return $isExist;
    }

}

?>