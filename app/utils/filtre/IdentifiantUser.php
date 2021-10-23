<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class IdentifiantUser extends AbstractUser{
    public function checkUser(string $data) : bool {
        $isValid=true;
        $SQL = 'SELECT * FROM User
        WHERE Identifiant=:Identifiant;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("Identifiant",$data);
        $preparedStatement->execute();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isValid=false;
        }
        if ($isValid==true){
            $Lettre = preg_match('@[a-z]@i', $data);
            $noSpecialChara = preg_match('#^[a-z0-9]+$#i', $data);
            if($Lettre && $noSpecialChara && strlen($data) > 0)
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