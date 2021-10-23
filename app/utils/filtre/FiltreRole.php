<?php
namespace app\utils\filtre;
use app\utils\filtre\AbstractRole;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class FiltreRole{
    private $formData=[];
    private $results=[];

    public function __construct($formData){
        $this->formData=$formData;
    }
    public function acceptRole(string $key,AbstractRole $caserne){
        $data=$this->formData;
        foreach($data as $keys=>$value){
            if ($keys==$key){
                $datas=$caserne->checkRole($value);
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
                    $datas[$key]=$this->acceptRole("role",new RoleRole());
                    break;
                case "ville":
                    $datas[$key]=$this->acceptRole("ville",new PermissionRole());
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

