<?php
namespace app\utils\filtre;
use app\models\DAOPompier;
use app\utils\SingletonDBMaria;

abstract class AbstractPompier{
    public DAOPompier $daopompier;
    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $DAOPompier=new DAOPompier($cnx);
        $this->daopompier = $DAOPompier;
    }
    abstract public function checkPompier(string $data) : bool;
}
