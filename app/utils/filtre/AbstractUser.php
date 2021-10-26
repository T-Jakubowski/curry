<?php
namespace app\utils\filtre;
use app\models\DAOuser;
use app\utils\SingletonDBMaria;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
abstract class AbstractUser {
    private DAOuser $DAOuser;
    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $DAOuser=new DAOuser($cnx);
        $this->DAOuser = $DAOuser;
    }
    abstract public function checkUser(string $data) : bool;
}