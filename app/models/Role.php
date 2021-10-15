<?php
namespace app\models;
class Role{

    private $id;
    private $role;
    private $permission;

    public function __construct($id,$role,$permission)
    {
        $this->id = $id;
        $this->role = $role;
        $this->permission = $permission;
    }
    public function getid() {
        return $this->id;
    }
    public function getrole() {
        return $this->role;
    }
    public function getpermission() {
        return $this->permission;
    }

    public function setid($id) {
        $this->id = $id;
        return $this;
    }
    public function setrole($role) {
        $this->role = $role;
        return $this;
    }
    public function setpermission($permission) {
        $this->permission = $permission;
        return $this;
    }
}



?>