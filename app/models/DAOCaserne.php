<?php
namespace app\models;
use PDO;
use FFI\Exception;
require_once "Caserne.php";
use app\models\Caserne;

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
    
   public function __construct()
   {
    
   }

    /*
        Renvoie une caserne par rapport a son id
        @param int $id
        @return caserne $data
    */
    public function find($id) : Caserne {
        try{
            
            $SQL = 'SELECT NumCaserne ,Adresse ,CP ,Ville ,CodeTypeC FROM casernes c 
            WHERE NumCaserne=1;';
            //$SQL='SELECT * FROM casernes WHERE Matricule=? ';
            //$preparedStatement=$connect->query($SQL);
            
            $dbhost="127.0.0.1";
            $dbname="Pompier";
            $dbuser="Pompier_dbuser";
            $dbpassword="123123";


            try{
                $cnx = new PDO("mysql:host=". $dbhost.";dbname=".$dbname, $dbuser, $dbpassword);
            }catch(Exception $e){
                echo "<pre>" . print_r($e, true) ."</pre>";
                }

            
            $preparedStatement=$cnx->prepare($SQL);
            //$preparedStatement->bindParam("?",$id);
            $preparedStatement->execute();
            var_dump($preparedStatement);
            $data=$preparedStatement->fetchObject("Caserne");
            var_dump($data);
            return $data;
            //$preparedStatement->bindValue(1,$mat); comme bindparam mais presque
        }
        catch(Exception $e)
        {
            echo "<pre>" . print_r($e, true) ."</pre>";
        }

    }
    
    
    /*
        Enregistre une caserne dans la bdd Toute les caserne
        @param Caserne $Caserne
        @return void
    */
    public function save(Caserne $Caserne) : void{
        try{
            $sql = 'SELECT COUNT(*) as nbPompiers from pompiers p ;';
            $SQL='SELECT * FROM pompiers WHERE Matricule=? ';
            //$statement=$cnx->query($SQL);
            
            //$preparedStatement=$cnx->prepare($SQL);
            //$preparedStatement->bindParam(1,$mat);
            //$preparedStatement->bindValue(1,$mat); comme bindparam mais presque
        }catch(Exception $e){
            echo "<pre>" . print_r($e, true) ."</pre>";
            } 
    }
    /*
        Supprime une caserne
        @param Caserne $Caserne
        @return void
    */
    public function remove(Caserne $Caserne) : void{ 
        // supprimer object caserne plus dans la bdd
        // 
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
    $c=new DAOCaserne($cnx);
    $c->find(5);
    



?>