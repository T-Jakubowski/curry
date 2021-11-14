<?php
namespace app\utils\filtre\filtrePompier;

class NumCasernePompier extends AbstractPompier {

    public function checkPompier(string $data): bool {
        $IsExistInDB = $this->daopompier->findIfCaserneExist($data);
        return $IsExistInDB;
    }

}

?>