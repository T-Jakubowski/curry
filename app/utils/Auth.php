<?php
namespace app\utils;
use app\utils\SingletonDBMaria;
use app\models\User;


class Auth{
    /*
    * prend un user et le met en session
    * @param User $user
    */
    public static function login(User $user) {
        
        $identifiant = $user->getIdentifiant();
        $_SESSION['identifiant']=$identifiant;
    }
    /*
    * detruit la session de l'utilisateur en entré
    * @param User $user
    */
    public static function logout() {
        if ($_SESSION['identifiant']){
            session_destroy();
            header('Location: view_login.php');
        }
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