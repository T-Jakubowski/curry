<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class NumCaserne {
    public function checkCaserne(string $data) : bool {
        $isValid=true;
        $SQL = 'SELECT * FROM casernes
        WHERE NumCaserne=:id;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("id",$data);
        $preparedStatement->execute();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isValid=false;
        }
        if ($isValid==true){
            $chiffre = preg_match('@[0-9]@', $data);
            $noMajuscule = preg_match('@[A-Z]@', $data);
            $noMinuscule = preg_match('@[a-z]@', $data);
            $noSpecialChara = preg_match('#^[a-z0-9]+$#i', $data);
            if($chiffre && !$noMajuscule && !$noMinuscule && $noSpecialChara && strlen($data) > 0)
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