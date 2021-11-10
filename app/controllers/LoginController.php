<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use app\utils\Renderer;
/**s
 * Description of BaseController
 * @author student
 */
class LoginController {
    public function __construct() {

    }
    public function login(){
        
        $page=Renderer::render("view_login.php");
        echo $page;
    }
}
