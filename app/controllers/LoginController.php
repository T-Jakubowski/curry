<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;
use app\utils\Renderer;
use app\models\DAOAuth;
use app\utils\Auth;
use app\utils\SingletonDBMaria;
/*
 * Description of LoginController
 * @author student
 */
class LoginController {
    
    private DAOAuth $DAOAuth;

    public function __construct() {
        $cnx = SingletonDBMaria::getInstance()->getConnection();
        $DAOAuth = new DAOAuth($cnx);
        $this->DAOAuth = $DAOAuth;
    }
    public function show(){
        
        $page=Renderer::render("view_login.php");
        echo $page;
    }
    
    public function login() : void {
        $identifiant = htmlspecialchars($_POST['identifiant']);
        $password =  htmlspecialchars($_POST['password']);
        if ($this->DAOAuth->isLoginValide($identifiant, $password)){
            $user = $this->DAOAuth->findUserByLogin($identifiant, $password);
            $auth = new Auth();
            $auth->login($user);
            $page=Renderer::render("home.php", compact($auth));
            echo $page;
        }
    }
}
