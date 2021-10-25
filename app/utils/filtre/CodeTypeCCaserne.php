<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class CodeTypeCCaserne extends AbstractCaserne{
    public function checkCaserne(string $data) : bool {
        $IsExistInDB=$this->DAOCaserne->findIfTypeCaserneExist($data);
        return $IsExistInDB;
    }
}
?>