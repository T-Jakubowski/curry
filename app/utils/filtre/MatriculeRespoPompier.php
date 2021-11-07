<?php

namespace app\utils\filtre;

class MatriculeRespoPompier extends AbstractPompier {

    public function checkPompier(string $data): bool {
        $IsExistInDB = $this->daopompier->findIfMatriculePompierExist($data);
        return $IsExistInDB;
    }

}

?>