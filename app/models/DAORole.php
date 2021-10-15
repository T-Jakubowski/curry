<?php
namespace app\models;
class DAORole {
    private $cnx;
    

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function find($id) : Role{
        $sql = 'SELECT * FROM Roles WHERE id=:id;';
        $urepared_Statement = $this->cnx->prepare($sql);
        $urepared_Statement->bindParam("id", $id);
        $urepared_Statement->execute();
        while($row = $urepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $Role = new Role($row['id'],$row['role'],$row['permission']);
        }
        return $Role;
    }

    public function save(Role $u): void {
        $sql = "INSERT INTO Roles(id, role, permission)
                Values (:id, :role, :pssermission);";
        $id = $u->getId();
        $role = $u->getRole();
        $permission = $u->getPermission();

        $urepared_Statement = $this->cnx->prepare($sql);
        $urepared_Statement->bindParam("id", $id);
        $urepared_Statement->bindParam("role", $role);
        $urepared_Statement->bindParam("permission", $permission);

        $urepared_Statement->execute();
    }
    
    public function edit(Role $u) : void{
        
        $sql = 'UPDATE Roles
                SET id=:id, role=:role, permission=:permission, ChefAgret=:chefAgret, DateNaissance=:dateNaissance, NumCaserne=:numCaserne, CodeGrade=:codeGrade, idRespo=:idRespo
                Where id=:id';
        
        $id = $u->getid();
        $urenom = $u->getPrenom();
        $nom = $u->getNom();
        $chefAgret = $u->getChefAgret();
        $dateNaissance = $u->getDateNaissance();
        $numCaserne = $u->getNumCaserne();
        $codeGrade = $u->getCodeGrade();
        $idRespo = $u->getidRespo();
        
        $urepared_Statement = $this->cnx->prepare($sql);
        
        $urepared_Statement->bindParam("id", $id);
        $urepared_Statement->bindParam("prenom", $urenom);
        $urepared_Statement->bindParam("nom", $nom);
        $urepared_Statement->bindParam("chefAgret", $chefAgret);
        $urepared_Statement->bindParam("dateNaissance", $dateNaissance);
        $urepared_Statement->bindParam("numCaserne", $numCaserne);
        $urepared_Statement->bindParam("codeGrade", $codeGrade);
        $urepared_Statement->bindParam("idRespo", $idRespo);
        
        $urepared_Statement->execute();
    }

    public function remove($id): void {

        $sqldelete2 = 'delete from Roles WHERE id=:id;';
        $urepared_Statement = $this->cnx->prepare($sqldelete2);
        $urepared_Statement->bindParam("id", $id);
        $urepared_Statement->execute();
    }

    public function findAll($offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM Roles LIMIT :limit OFFSET :offset';
        $urepared_Statement = $this->cnx->prepare($sql);
        $urepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $urepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $urepared_Statement->execute();
        
        $desRoles=array();
        while($row = $urepared_Statement->fetch(\PDO::FETCH_ASSOC)){
            $desRoles[] = new Role($row['id'],$row['Prenom'],$row['Nom'],$row['ChefAgret'],$row['DateNaissance'],$row['NumCaserne'],$row['CodeGrade'],$row['idRespo']);
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
}

?>