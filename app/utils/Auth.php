<?php
namespace app\utils;
use app\utils\SingletonDBMaria;
use app\models\User;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/


class Auth{
    /*
    * prend un user et le met en session
    * @param User $user
    */
    public static function login(User $user) {

    }
    /*
    * detruit la session de l'utilisateur en entré
    * @param User $user
    */
    public static function logout(User $user) {

    }
    /*
    * Vérifie qu'il y ait bien une variable de session User
    * @return bool
    */
    public static function is_logged() : bool {
        return false;
    }
    /*
    * retourne si la personne logger est ce role ou non
    * @param string $role
    * @return bool
    */
    public static function has(string $role) : bool {
        return false;
    }
    /*
    * retourne si la personne logger a cette permission ou non
    * @param int $perm
    * @return bool
    */
    public static function can(int $perm) : bool {
        return false;
    }

}

?>