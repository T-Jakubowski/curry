<?php

namespace app\utils\filtre;

class MatriculePompier extends AbstractPompier {

    public function checkPompier(string $data): bool {
        $isValid=false;
        $IsExistInDB=$this->daopompier->findIfMatriculePompierExist($data);
        if ($IsExistInDB==false){
            $matricule = preg_match('~Ma+[0-9]~', $data);
            if($matricule && strlen($data) == 6)
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
