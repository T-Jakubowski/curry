<?php
namespace app\models;
class DAORole {
    private $cnx;
    

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }
    /*
        Renvoie un role par rapport a son id
        @param int $Id
        @return Role $Role
    */
    public function find($Id) : Role{
        $sql = 'SELECT * FROM role WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $Role = new Role($row['Id'],$row['Role'],$row['Permission']);
        }
        return $Role;
    }
    /*
        Enregistre un role  dans la bdd
        @param Role $r
        @return void
    */
    public function save(Role $r): void {
        $sql = "INSERT INTO role(Id, Role, Permission)
                Values (:Role, :Permission);";
        $Role = $r->getRole();
        $Permission = $r->getPermission();

        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Role", $Role);
        $prepared_Statement->bindParam("Permission", $Permission);

        $prepared_Statement->execute();
    }
    /*
        Met a jour un role existant
        @param Role $r
        @return void
    */
    public function edit(Role $r) : void{
        $sql = 'UPDATE role
                SET Role=:Role, Permission=:Permission, Role=:Role, DateNaissance=:dateNaissance, NumCaserne=:numCaserne, CodeGrade=:codeGrade, idRespo=:idRespo
                Where Id=:Id';
        $Id = $r->getid();
        $Role = $r->getRole();
        $Permission = $r->getPermission();
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->bindParam("Role", $Role);
        $prepared_Statement->bindParam("Permission", $Permission);
        $prepared_Statement->execute();
    }
    /*
        Supprime un role
        @param int $Id
        @return void
    */
    public function remove($Id): void {
        $sqldelete2 = 'DELETE from role WHERE Id=:id;';
        $prepared_Statement = $this->cnx->prepare($sqldelete2);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
    }
    /*
        Renvoie Tout les roles
        @param int $offset
        @param int $limit
        @return array<Role>
    */
    public function findAll($offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM role LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $prepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $prepared_Statement->execute();
        
        $desRoles=array();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $desRoles[] = new Role($row['Id'],$row['Role'],$row['Permission']);
        }
        return $desRoles;
    }

    /*
        Renvoie le nombre de role
        @return int
    */
    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbRoles from role p ;';
        $statement = $this->cnx->prepare($sql);
        $nbRoles = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbRole = $nbRoles['nbRoles'];
        return $nbRole;
    }
    /*
        Renvoie Si le nom du role en entré existe
        @return bool
    */
    public function findifRoleExist($roleName){
        $sql = 'SELECT * FROM role WHERE Role=:roleName;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("roleName", $roleName);
        $prepared_Statement->execute();
        $isExist = false;
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $isExist = true;
        }
        return $isExist;
    }
}

?>