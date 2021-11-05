<?php
namespace app\utils\filtre;
use app\models\DAOUser;
use app\utils\SingletonDBMaria;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
abstract class AbstractUser {
    private DAOUser $daouser;
    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $DAOUser=new DAOUser($cnx);
        $this->DAOUser = $DAOUser;
    }
    abstract public function checkUser(string $data) : bool;
}