<?php
namespace app\models;
use PDO;
use FFI\Exception;
require_once "Caserne.php";
use app\models\Caserne;
use app\utils\SingletonDBMaria;

$dbhost="127.0.0.1";
$dbname="Pompier";
$dbuser="Pompier_dbuser";
$dbpassword="123123";
//SOLID ET GRASP A cherché
// loger et object de connexion unique

try{
    $cnx = new PDO("mysql:host=". $dbhost.";dbname=".$dbname, $dbuser, $dbpassword);
}catch(Exception $e){
    echo "<pre>" . print_r($e, true) ."</pre>";
    } 



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
        @return caserne $data
    */
    public function find($id) : Caserne {
            $SQL = 'SELECT NumCaserne ,Adresse ,CP ,Ville ,CodeTypeC FROM casernes c 
            WHERE NumCaserne=:id;';
            //$SQL='SELECT * FROM casernes WHERE Matricule=? ';
            //$preparedStatement=$connect->query($SQL);
            
            $cnx=$this->cnx;

            $preparedStatement=$cnx->prepare($SQL);
            $preparedStatement->bindParam("id",$id);
            $preparedStatement->execute();
            var_dump($preparedStatement);
            while($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)){
                $NumCaserne = $row['NumCaserne'];
                $Adresse = $row['Adresse'];
                $CP = $row['CP'];
                $Ville = $row['Ville'];
                $CodeTypeC = $row['CodeTypeC'];
                $Caserne = new caserne($NumCaserne,$Adresse,$CP,$Ville,$CodeTypeC);
            }
            
            //$data=$preparedStatement->fetchObject("Caserne");
        
            return $Caserne;
            //$preparedStatement->bindValue(1,$mat); comme bindparam mais presque

    }
    
    
    /*
        Enregistre une caserne dans la bdd Toute les caserne
        @param Caserne $Caserne
        @return void
    */
    public function save(Caserne $Caserne) : void{
        $sql = 'INSERT INTO caserne (NumCaserne,Adresse,CP,Ville,CodeTypeC) VALUES(":NumCaserne",":Adresse",":CP",":Ville",":CodeTypeC")';
        
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("NumCaserne", $Caserne->getNumCaserne());
        $prepared_Statement->bindParam("Adresse", $Caserne->getadresse());
        $prepared_Statement->bindParam("CP", $Caserne->getCP());
        $prepared_Statement->bindParam("Ville", $Caserne->getville());
        $prepared_Statement->bindParam("CodeTypeC", $Caserne->getCodeTypeC());
        $prepared_Statement->execute();

        //$statement=$cnx->query($SQL);
        
        //$preparedStatement=$cnx->prepare($SQL);
        //$preparedStatement->bindParam(1,$mat);
        //$preparedStatement->bindValue(1,$mat); comme bindparam mais presque


    }
    /*
        Supprime une caserne
        @param int $id
        @return void
    */
    public function remove($id) : void{
        $sql = 'DELETE FROM casernes c WHERE NumCaserne=:id;';
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
        $x=[];
        return $x;
    }
    /*
        Renvoie le nombre de caserne
        @return int
    */
    public function count() : int {
        $x=1;
        return $x;



    }
/*
$pompiers = getCountPompiers();
echo $pompiers['nbPompiers'] .'<br>';
echo "<br>Done !";

*/

    }

    



?>