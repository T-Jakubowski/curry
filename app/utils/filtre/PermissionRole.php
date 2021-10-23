<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class PermissionRole {
    public function checkRole(string $data) : bool {
        $chiffre = preg_match('@[0-1]{8}@', $data);
        if($chiffre && strlen($data) == 8)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
?>