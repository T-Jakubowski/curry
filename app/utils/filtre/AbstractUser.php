<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
abstract class AbstractUser {
    abstract public function checkUser(string $data) : bool;
}