<?php
namespace app\utils;
class SingletonConfigReader
{    
    public function __construct(){}
    public function getValue($key)
    {
        $ini_array = parse_ini_file("../app/utils/config.ini");
        foreach ($ini_array as $keys => $value){
            if ($key==$keys){
                $data=$value;
            }
    }
        return $data;
    }
}
?>