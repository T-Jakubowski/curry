<?php
namespace app\models;
class DAOUser {
    private $cnx;
    public function __construct($cnx) {
        $this->cnx = $cnx;
    }
    /*
        Renvoie un user par rapport a son id
        @param int $Id
        @return User $user
    */
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
    /*
        Renvoie un user par rapport a son identifaint
        @param string $Identifiant
        @return User $user
    */
    public function findByidentifiant($Identifiant) : User{
        $sql = 'SELECT * FROM User WHERE Identifiant=:Identifiant;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $Identifiant);
        $prepared_Statement->execute();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $user = new User($row['Id'],$row['Identifiant'],$row['Password'],$row['IdRole']);
        }
        return $user;
    }
    /*
        Enregistre un user dans la bdd
        @param User $u
        @return void
    */
    public function save(User $u): void {
        $sql = "INSERT INTO user(Identifiant, Password, IdRole)
                Values (:Identifiant, :Password, :IdRole);";
        $Identifiant = $u->getIdentifiant();
        $Password = $u->getPassword();
        $IdRole = $u->getidRole();

        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Identifiant", $Identifiant);
        $prepared_Statement->bindParam("Password", $Password);
        $prepared_Statement->bindParam("IdRole", $IdRole);

        $prepared_Statement->execute();
    }

    /*
        Met a jour un user existant
        @param User $u
        @return void
    */
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
    /*
        Supprime un user
        @param int $Id
        @return void
    */
    public function remove($Id): void {
        $sql = 'delete from user WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
    }
    /*
        Renvoie Tout les user
        @param int $offset
        @param int $limit
        @return array<User>
    */
    public function findAll($offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM user LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $prepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $prepared_Statement->execute();
        
        $desUser=array();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $desUser[] = new User($row['Id'],$row['Identifiant'],$row['Password'],$row['IdRole']);
        }
        return $desUser;
    }
        /*
        Renvoie Tout les user qui contienne value
        @param string $value
        @param int $offset
        @param int $limit
        @return array<User>
    */
    public function findAllWhereIdentifiant($value,$offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM user WHERE Identifiant=:Identifiant LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $value="%$value%";
        $prepared_Statement->bindValue(':Identifiant', $value, \PDO::PARAM_STR);
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $desUser[] = new User($row['Id'],$row['Identifiant'],$row['Password'],$row['IdRole']);
        }
        return $desUser;
    }

    /*
        Renvoie le nombre de user 
        @return int
    */
    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbUser from user u ;';
        $statement = $this->cnx->prepare($sql);
        $nbUser = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbUser = $nbUser['nbUser'];
        return $nbUser;
    }
        /*
        Renvoie le nombre de user qui contienne value
        @param string $value
        @return int
    */
    public function countWhere($value): int {
        $sql = 'SELECT COUNT(*) as nbUser from user WHERE Identifiant=:Identifiant ;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $value="%$value%";
        $prepared_Statement->bindValue(':Identifiant', $value, \PDO::PARAM_STR);
        $prepared_Statement->execute();
        $nbUser = $prepared_Statement->fetch(\PDO::FETCH_ASSOC);
        $nbUser = $nbUser['nbUser'];
        return $nbUser;
    }

    /*
        Renvoie Si le role en entré existe
        @param int $idRole
        @return bool
    */
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
    /*
        Renvoie Si l'user' en entré existe
        @param string $Identifiant
        @return bool
    */
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