<?php
namespace app\utils\filtre;
use app\models\DAORole;
use app\utils\SingletonDBMaria;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
abstract class AbstractRole {
    private DAORole $DAORole;
    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $DAORole=new DAORole($cnx);
        $this->DAORole = $DAORole;
    }
    abstract public function checkRole(string $data) : bool;
}