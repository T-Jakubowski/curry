<?php
namespace app\utils\filtre\filtreUser;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class PasswordUser extends AbstractUser{
    public function checkUser(string $data) : bool {
        $majuscule = preg_match('@[A-Z]@', $data);
        $minuscule = preg_match('@[a-z]@', $data);
        $chiffre = preg_match('@[0-9]@', $data);
        $specialChara = preg_match('#^[a-z0-9]+$#i', $data);
        if($majuscule && $minuscule && $chiffre && !$specialChara && strlen($data) > 7 && strlen($data) < 21)
        {
            return true;
        }
        else {
            return false;
        }
    }
}
?>