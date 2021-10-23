<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
abstract class AbstractCaserne{
    abstract public function checkCaserne(string $data) : bool;
}