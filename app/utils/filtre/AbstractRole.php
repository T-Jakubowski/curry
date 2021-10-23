<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
abstract class AbstractRole {
    abstract public function checkRole(string $data) : bool;
}