<?php
namespace app\utils\filtre;
use app\utils\filtre\AbstractUser;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class FiltreUser{
    private $formData=[];
    private $results=[];

    public function __construct($formData){
        $this->formData=$formData;
    }
    public function acceptUser(string $key,AbstractUser $caserne){
        $data=$this->formData;
        foreach($data as $keys=>$value){
            if ($keys==$key){
                $datas=$caserne->checkUser($value);
            }
        }
        return $datas;
    }

    public function caser() : array {
        $data=$this->formData;
        $datas=array();
        foreach($data as $key){
            switch ($key) {
                case "num":
                    $datas[$key]=$this->acceptUser("identifiant",new IdentifiantUser());
                    break;
                case "ville":
                    $datas[$key]=$this->acceptUser("password",new PasswordUser());
                    break;
                case "cp":
                    $datas[$key]=$this->acceptUser("idRole",new IdRoleUser());
                    break;  
            }
        }
        return $datas;
    }
    public function getStatus(string $key){
        $datas=$this->caser();
        $value=$datas[$key];
        return $value;
    }
}

