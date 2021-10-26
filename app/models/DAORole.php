<?php
namespace app\models;
class DAORole {
    private $cnx;
    

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function find($Id) : Role{
        $sql = 'SELECT * FROM Roles WHERE Id=:Id;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
        while($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $Role = new Role($row['Id'],$row['Role'],$row['Permission']);
        }
        return $Role;
    }

    public function save(Role $r): void {
        $sql = "INSERT INTO Roles(Id, Role, Permission)
                Values (:Id, :Role, :Permission);";
        $Id = $r->getId();
        $Role = $r->getRole();
        $Permission = $r->getPermission();

        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->bindParam("Role", $Role);
        $prepared_Statement->bindParam("Permission", $Permission);

        $prepared_Statement->execute();
    }
    
    public function edit(Role $r) : void{
        $sql = 'UPDATE Roles
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

    public function remove($Id): void {
        $sqldelete2 = 'DELETE from Roles WHERE Id=:id;';
        $prepared_Statement = $this->cnx->prepare($sqldelete2);
        $prepared_Statement->bindParam("Id", $Id);
        $prepared_Statement->execute();
    }

    public function findAll($offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM Roles LIMIT :limit OFFSET :offset';
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

    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbRoles from Roles p ;';
        $statement = $this->cnx->prepare($sql);
        $nbRoles = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbRole = $nbRoles['nbRoles'];
        return $nbRole;
    }

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