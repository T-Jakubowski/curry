<?php
namespace app\models;
use PDO;
use app\models\Caserne;
use app\utils\SingletonDBMaria;


//SOLID ET GRASP A cherché
// loger et object de connexion unique

/*$daop = new \app\models\DAOPompier($cnx);
$nb = $daop->count();
echo "nb pompier : ".$count;*/

class DAOCaserne{
    private PDO $cnx;
    
    public function __construct($conn){
        $this->cnx = $conn;
    }

    /*
        Renvoie une caserne par rapport a son id
        @param int $id
        @return caserne $Caserne
    */
    public function find($id) : Caserne {
            $SQL = 'SELECT NumCaserne ,Adresse ,CP ,Ville ,CodeTypeC FROM casernes c 
            WHERE NumCaserne=:id;';
            $cnx=$this->cnx;
            $preparedStatement=$cnx->prepare($SQL);
            $preparedStatement->bindParam("id",$id);
            $preparedStatement->execute();
            while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
                $Caserne = new Caserne($row['NumCaserne'],$row['Adresse'],$row['CP'],$row['Ville'],$row['CodeTypeC']);
            }
            return $Caserne;
    }
    /*
        Enregistre une caserne dans la bdd
        @param Caserne $Caserne
        @return void
    */
    public function save(Caserne $Caserne) {

        $sql = 'INSERT INTO casernes (NumCaserne,Adresse,CP,Ville,CodeTypeC) VALUES(:NumCaserne,:Adresse,:CP,:Ville,:CodeTypeC);';
        $NumCaserne=$Caserne->getNumCaserne();
        $Adresse=$Caserne->getadresse();
        $CP=$Caserne->getCP();
        $Ville=$Caserne->getville();
        $CodeTypeC=$Caserne->getCodeTypeC();
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("NumCaserne",$NumCaserne);
        $prepared_Statement->bindParam("Adresse",$Adresse);
        $prepared_Statement->bindParam("CP",$CP);
        $prepared_Statement->bindParam("Ville",$Ville);
        $prepared_Statement->bindParam("CodeTypeC",$CodeTypeC);
        $isSuccess=$prepared_Statement->execute();
        return $isSuccess;
    }
    /*
        Met a jour une caserne existante
        @param Caserne $Caserne
        @return void
    */
    public function update(Caserne $Caserne) : void{
        $sql = 'UPDATE caserne SET';
        $NumCaserne=$Caserne->getNumCaserne();
        $Adresse=$Caserne->getadresse();
        $CP=$Caserne->getCP();
        $Ville=$Caserne->getville();
        $CodeTypeC=$Caserne->getCodeTypeC();
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("NumCaserne",$NumCaserne);
        $prepared_Statement->bindParam("Adresse",$Adresse);
        $prepared_Statement->bindParam("CP",$CP);
        $prepared_Statement->bindParam("Ville",$Ville);
        $prepared_Statement->bindParam("CodeTypeC",$CodeTypeC);
        $prepared_Statement->execute();
    }
    /*
        Supprime une caserne
        @param int $id
        @return void
    */
    public function remove($id) : void{
        $sql = 'DELETE FROM casernes WHERE NumCaserne=:id;';
        $cnx=SingletonDBMaria::getInstance()->getConnection();
        $prepared_Statement = $cnx->prepare($sql);
        $prepared_Statement->bindParam("id", $id);
        $prepared_Statement->execute();
    }

    /*
        Renvoie Toute les caserne
        @param int $offset
        @param int $limit
        @return array<Caserne>
    */
    public function findAll($offset=0,$limit=10) : Array{
        $SQL = 'SELECT NumCaserne ,Adresse ,CP ,Ville ,CodeTypeC FROM casernes LIMIT :lim OFFSET :offs;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
       
        $preparedStatement->bindValue(':offs', $offset, PDO::PARAM_INT);
        $preparedStatement->bindValue(':lim', $limit, PDO::PARAM_INT);
        $preparedStatement->execute();
        $DesCaserne=array();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $DesCaserne[] = new Caserne($row['NumCaserne'],$row['Adresse'],$row['CP'],$row['Ville'],$row['CodeTypeC']);
        }
        return $DesCaserne;
    }
    /*
        Renvoie Toute les caserne qui ont le numero $value
        @param string $value
        @param int $offset
        @param int $limit
        @return array<Caserne>
    */
    public function findAllWhereNum($value,$offset=0,$limit=10) : Array{
        $SQL = "SELECT NumCaserne ,Adresse ,CP ,Ville ,CodeTypeC FROM casernes  WHERE NumCaserne LIKE :num LIMIT :lim OFFSET :offs;";
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $value="%$value%";
        $preparedStatement->bindParam(':num', $value, PDO::PARAM_STR);
        $preparedStatement->bindValue(':offs', $offset, PDO::PARAM_INT);
        $preparedStatement->bindValue(':lim', $limit, PDO::PARAM_INT);
        $preparedStatement->execute();
        $DesCaserne=array();
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $DesCaserne[] = new Caserne($row['NumCaserne'],$row['Adresse'],$row['CP'],$row['Ville'],$row['CodeTypeC']);
        }
        return $DesCaserne;
    }

    /*
        Renvoie le nombre de caserne
        @return int
    */
    public function count() : int {
        $sql = 'SELECT COUNT(*) as nbCaserne from casernes;';
        $statement = $this->cnx->query($sql);
        $nbCaserne = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbCaserne = $nbCaserne['nbCaserne'];
        return $nbCaserne;
    }
    
        /*
        Renvoie le nombre de caserne ou ce trouve la valeur $value
        @param int $value
        @return int
    */
    public function countWhereNum($value) : int {
        $SQL = 'SELECT COUNT(*) as nbCaserne from casernes where NumCaserne LIKE :num;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $value="%$value%";
        $preparedStatement->bindParam(':num', $value, PDO::PARAM_STR);
        $preparedStatement->execute();
        $nbCaserne = $preparedStatement->fetch(\PDO::FETCH_ASSOC);
        $nbCaserne = $nbCaserne['nbCaserne'];
        return $nbCaserne;
    }
    /*
        Renvoie si le numéro entré en argument existe déja pour une caserne dans la BDD ou non
        @param int $Num
        @return bool
    */
    public function findIfNumCaserneExist($Num){
        $SQL = 'SELECT * FROM casernes
        WHERE NumCaserne=:id;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("id",$Num);
        $preparedStatement->execute();
        $isExist=false;
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isExist=true;
        }
        return $isExist;
    }
    /*
        Renvoie si le Type de caserne entré en argument existe dans la BDD ou non
        @param int $CodeTypeC
        @return bool
    */
    public function findIfTypeCaserneExist($CodeTypeC){
        $SQL = 'SELECT * FROM typecasernes
        WHERE CodeTypeC=:CodeTypeC;';
        $cnx=$this->cnx;
        $preparedStatement=$cnx->prepare($SQL);
        $preparedStatement->bindParam("CodeTypeC",$CodeTypeC);
        $preparedStatement->execute();
        $isExist=false;
        while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
            $isExist=true;
        }
        return $isExist;
    }
}

    



?>