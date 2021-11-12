<?php
namespace app\controllers;
use app\utils\Renderer;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/*
 * Description of LoginController
 * @author student
 */
class HomeController extends BaseController {
    public function __construct() {

    }
    public function index(){
        $page=Renderer::render("view_home.php");
        echo $page;
    }
}
