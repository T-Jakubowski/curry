<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class RoleRole extends AbstractRole{
    public function checkRole(string $data) : bool {
        $isValid=false;
        $isExist=$this->DAOUser->findifRoleExist($data);

        if ($isExist==false) {
            $Lettre = preg_match('@[a-z]@i', $data);
            $noSpecialChara = preg_match('#^[a-z0-9]+$#i', $data);
            if($Lettre && $noSpecialChara && strlen($data) > 0 && strlen($data) < 21)
            {
                $isValid= true;
            }
            else {
                $isValid= false;
            }
        }
        return $isValid;
    }
}
?>