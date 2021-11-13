<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class PermissionRole extends AbstractRole{
    public function checkRole(string $data) : bool {
        $chiffre = preg_match('@[0-1]@', $data);
        if($chiffre && strlen($data) < 9 && strlen($data) > 0)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
?>