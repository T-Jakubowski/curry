<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\utils\filtre;

/**
 * Description of Prenom
 *
 * @author student
 */
class PrenomUser {
    public function checkUser(string $data): bool {
        $prenomUser = preg_match('~[A-Za-z]~', $data);
        if ($prenomUser && strlen($data) < 21) {
            return true;
        } else {
            return false;
        }
    }

}
