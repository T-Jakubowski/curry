<?php

namespace app\controllers;

use app\utils\Renderer;
use app\utils\Auth;

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

    public function index() {
        $auth = new Auth();
        $permission = $auth->can('read');
        $islogged = $auth->is_logged();
        if ($islogged) {
            if ($permission) {
                $page = Renderer::render("view_home.php");
            }
            else{
                $msg = 'Vous n\'avez pas les permissions';
                $page = Renderer::render("view_error.php");
            }
        } else {
            $page = Renderer::render("view_error.php");
        }
        echo $page;
    }

}
