<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\utils\filtre;

/**
 * Description of NomUser
 *
 * @author student
 */
class NomUser {
        public function checkUser(string $data): bool {
        $nomUser = preg_match('~[A-Za-z]~', $data);
        if ($nomUser && strlen($data) < 21) {
            return true;
        } 
        else {
            return false;
        }
    }
}
