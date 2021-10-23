<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class AdresseCaserne {
    public function checkCaserne(string $data) : bool {
        $isValid=true;
        $SQL = 'SELECT * FROM Caserne
        WHERE Adresse=:Adresse;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("Adresse",$data);
        $preparedStatement->execute();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isValid=false;
        }
        if ($isValid==true){
            $mot = preg_match('@\w@', $data);
            if($mot && strlen($data) > 5)
            {
                $isValid == true;
            }
            else {
                $isValid == false;
            }
        }
        return $isValid;
    }
}
?>