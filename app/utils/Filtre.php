<?php
namespace App;
class Filtre{
    private $visitors=[];
    private $formData=[];
    private $results=[];

    public function __construct($formData){
        $this->formData=$formData;
    }
    public function acceptVisitors(string $key,AbstractVisitor $visitor){
        $data=$this->formData;
        foreach($data as $keys=>$value){
            if ($keys==$key){
                $datas=$visitor->visit($value);
            }
        }
        return $datas;
    }

    public function visit() : array {
        $data=$this->formData;
        $datas=array();
        foreach($data as $key){
            switch ($key) {
                case "pass":
                    $datas[$key]=$this->acceptVisitors("pass",new PasswordVisitor());
                    break;
                case "phone":
                    $datas[$key]=$this->acceptVisitors("phone",new PhoneVisitor());
                    break;
            }
        }
        return $datas;
    }
    public function getStatus(string $key){
        $datas=$this->visit();
        $value=$datas[$key];
        return $value;
    }
}