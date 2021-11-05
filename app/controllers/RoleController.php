<?php
namespace app\controllers;
use app\utils\SingletonDBMaria;
use app\utils\Renderer;
use app\models\Role;

class RoleController extends BaseController{
    private DAORole $daorole;

    public function __construct(){
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $daorole= new DAOUser($cnx);
        $this->daorole = $daorole;
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
            $LstRole = $this->daorole->findAllWhereNum($NumC,$Offset,10);
            $CountRole = $this->daorole->countWhereNum($NumC);
          }else{
            $LstRole = $this->daorole->findAll($Offset,10);
            $CountRole = $this->daorole->count();
          }
        $page=Renderer::render("view_role.php", compact("LstRole","CountRole"));
        echo $page;
    }

    public function Add(): void {

        $id = htmlspecialchars($_POST['addid']);
        $role = htmlspecialchars($_POST['addrole']);
        $permission = htmlspecialchars($_POST['addpermission']);

        $r = new Role($id, $role, $permission);
        $role = $this->daorole->save($r);
        
        $page = \app\utils\Renderer::render('view_role_add.php', compact('role'));
        echo $page;
    }

    public function edit() {
        
        $id = htmlspecialchars($_POST['editid']);
        $role = htmlspecialchars($_POST['editrole']);
        $permission = htmlspecialchars($_POST['editpermission']);


        $r = new Role($id, $role, $permission);
        $role = $this->daorole->edit($r);
        
        $page = \app\utils\Renderer::render('view_role_edit.php', compact('role'));
        echo $page;

        //methode put
        //filtrer les données (failles xss)
        //protéger des failles csrf
        //gestion des erreurs try catch
    }

    public function delete(): void {
        
        $id = htmlspecialchars($_POST['deleteid']);
        
        $role = $this->daorole->remove($id);
        $page = \app\utils\Renderer::render('view_role_delete.php', compact('role'));
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