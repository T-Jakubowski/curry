<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\utils;

/**
 * Description of Renderer
 *
 * @author student
 */
class Renderer {
    public static function render($file, array $data=null){
        $path = "../app/view/".$file;//Chemin vers le fichier
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
