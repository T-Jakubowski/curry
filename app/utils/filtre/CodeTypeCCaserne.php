<?php
namespace app\utils\filtre;
/*
* @author Baptiste Coquelet <b.coquelet@eleve.leschartreux.net>
*/
class CodeTypeCCaserne {
    public function checkCaserne(string $data) : bool {
        $isValid=false;
        $SQL = 'SELECT * FROM typecasernes
        WHERE CodeTypeC=:CodeTypeC;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("CodeTypeC",$data);
        $preparedStatement->execute();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isValid=true;
        }
        return $isValid;
    }
}
?>