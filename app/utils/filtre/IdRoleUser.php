<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class IdRoleUser extends AbstractUser{
    public function checkUser(string $data) : bool {
        $isValid=false;
        $SQL = 'SELECT * FROM Role
        WHERE Id=:Id;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("Id",$data);
        $preparedStatement->execute();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isValid=true;
        }
    return $isValid;
    }
}
?>