<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class IdRoleUser extends AbstractUser{
    public function checkUser(string $data) : bool {
        $IsExistInDB=$this->DAOUser->findIfRoleExiste($data);
    return $IsExistInDB;
    }
}
?>