<?php

namespace app\utils\filtre;

class CodeGradePompier extends AbstractPompier {

    public function checkPompier(string $data): bool {
        $codeGradePompier = preg_match('([A-Za-z]{2})', $data);
        if ($codeGradePompier) {
            return true;
        } 
        else {
            return false;
        }
    }

}

?>


