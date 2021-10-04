<?php
namespace app\utils;

class Renderer{
    public static function render($file,array $data=null) : string {
        $path='../app/view/home.php';//chemin vers le fichier
        ob_start();
        if($data != null){
            extract($data);
        }
        include $path;
        $content = ob_get_contents();
        ob_end_clean();
        return $content;
    }
}

?>