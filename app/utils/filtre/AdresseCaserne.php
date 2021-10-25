<?php
namespace app\utils\filtre;

/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class AdresseCaserne extends AbstractCaserne{

    public function checkCaserne(string $data) : bool {
        $IsExistInDB=$this->DAOCaserne->findIfAdresseExist($data);
        $isValid = false;
        if ($IsExistInDB==false){
            $mot = preg_match('@\w@', $data);
            if($mot && strlen($data) > 5)
            {
                $isValid = true;
            }
            else {
                $isValid = false;
            }
        }
        return $isValid;
    }
}
?>