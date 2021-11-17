<?php
namespace app\utils;
use app\utils\SingletonDBMaria;
use app\models\User;
use app\models\DAOAuth;

class Auth{
    
    private static DAOAuth $DAOAuth;

    public function __construct() {
        $cnx = SingletonDBMaria::getInstance()->getConnection();
        $DAOAuth = new DAOAuth($cnx);
        self::$DAOAuth = $DAOAuth;
    }
    
    public static function login(User $user) {
        self::start_session();
        
        $identifiant = $user->getIdentifiant();
        $nom = $user->getNom();
        $prenom = $user->getPrenom();
        $idRole = $user->getIdRole();
        
        $_SESSION['identifiant']=$identifiant;
        $_SESSION['nom']=$nom;
        $_SESSION['prenom']=$prenom;
        $_SESSION['idRole']=$idRole;
    }
    /*
    * detruit la session de l'utilisateur en entré
    * @param User $user
    */
    public static function logout() {
        if (self::is_logged() == true){ 
            session_destroy();   
        }
    }
    /*
    * Vérifie qu'il y ait bien une variable de session User
    * @return bool
    */
    public static function is_logged() {
        if (session_status() == PHP_SESSION_ACTIVE) {
            return true;
        }
        return false;
    }
    
    public static function is_session_active() {
        if (isset($_SESSION['identifiant'])) {
            return true;    
        }
        else{
            return false;        
        }
    }
    
    public static function start_session(){
        if (self::is_logged() == false) {
            session_start();
        }
    }
    /*
    * retourne si la personne logger est ce role ou non
    * @param string $role
    * @return bool
    */
    public static function has(string $role) : bool {
        self::start_session();
        $isrole = self::$DAOAuth->findRoleById($_SESSION['idRole']);
        if ($isrole == $role)
        {
            return true;
        }
        return false;
    }
    
    /*
    * retourne si la personne logger a cette permission ou non
    * @param int $perm
    * @return bool
    */
    public function can(string $perm) : bool {
        self::start_session();
        $isperm = $this->DAOAuth->findPermissionById($_SESSION['idRole']);
        switch($perm){
            case 'read':
                if ($isperm[7] == '1'){
                    return true;
                }
                else{
                    return false;
                } 
                break;
            case 'write':
                if ($isperm[6] == '1'){
                    return true;
                }
                else{
                    return false;
                } 
                break;
            case 'update':
                if ($isperm[5] == '1'){
                    return true;
                }
                else{
                    return false;
                } 
                break;
            case 'delete':
                if ($isperm[4] == '1'){
                    return true;
                }
                else{
                    return false;
                } 
                break;
            case 'manage':
                if ($isperm[3] == '1'){
                    return true;
                }
                else{
                    return false;
                } 
                break;
        }
        

        
    }
}

?>