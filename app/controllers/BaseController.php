<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use app\utils\Renderer;
/**
 * Description of BaseController
 *
 * @author student
 */
class BaseController {
    public function __construct() {

    }
    public function index(){
        $page=Renderer::render("home.php");
        echo $page;
    }
}
