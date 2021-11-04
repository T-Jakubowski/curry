<?php
namespace app\controllers;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Role;

class RoleController extends BaseController{
    private DAORole $daouser;

    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $daouser= new DAOUser($cnx);
        $this->daouser = $daouser;
    }
    
    //renvoie la page avec la liste de tout les pompier
    public function show(){
        if (isset($_GET["page"])){
            $Offset=($_GET["page"]*10)-10;
          }else{
            $Offset=0;
          }
          if (isset($_GET["search"])){
            $NumC=($_GET["search"]);
            $LstUser = $this->daouser->findAllWhereNum($NumC,$Offset,10);
            $CountUser = $this->daouser->countWhereNum($NumC);
          }else{
            $LstUser = $this->daouser->findAll($Offset,10);
            $CountUser = $this->daouser->count();
          }
        $page=Renderer::render("view_user.php", compact("LstUser","CountUser"));
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