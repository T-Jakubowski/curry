<?php
namespace app\controllers;
use app\models\DAOUser;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\User;

class UserController extends BaseController{
    private DAOUser $daouser;

    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $daouser= new DAOUser($cnx);
        $this->daouser = $daouser;
    }
        //initialisation du dao
    public function Show(): void {
        $users = $this->daouser->findAll('0', '100');
        $page = \app\utils\Renderer::render('view_user.php', compact('users'));
        echo $page;
    }

    public function Add(): void {

        $identifiant = htmlspecialchars($_POST['addidentifiant']);
        $password = htmlspecialchars($_POST['addpassword']);
        $idrole = htmlspecialchars($_POST['addidrole']);

        $u = new DAOUser($identifiant, $password, $idrole);
        $user = $this->save($u);
        
        $page = \app\utils\Renderer::render('view_user_add.php', compact('user'));
        echo $page;
    }

    public function edit() {
        
        $identifiant = htmlspecialchars($_POST['editidentifiant']);
        $password = htmlspecialchars($_POST['editpassword']);
        $idrole = htmlspecialchars($_POST['editidrole']);


        $u = new User($identifiant, $password, $idrole);
        $user = $this->daouser->edit($u);
        
        $page = \app\utils\Renderer::render('view_user_edit.php', compact('user'));
        echo $page;

        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function delete(): void {
        
        $id = htmlspecialchars($_POST['deleteid']);
        
        $user = $this->daouser->remove($id);
        $page = \app\utils\Renderer::render('view_user_delete.php', compact('user'));
        echo $page;
        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function ShowDetails() {
        
    }
}
?>