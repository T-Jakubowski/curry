<?php

namespace app\models;

class DAOPompier {

    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function find($matricule) {
        $sql = 'SELECT * FROM pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
        $data = $prepared_Statement->fetch(\PDO::FETCH_ASSOC);
        echo "<pre>" . print_r($data, true) . "</pre>";
        return $data;
    }

    public function save(Caserne $pompier): void {
        
    }

    public function remove($matricule): void {
        $sql = 'delete from pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
    }

    public function findAll($offset = 0, $limit = 10): Array {
        $sql = 'SELECT * FROM pompiers LIMIT=:limit;';
        $prepared_Statement = $cnx->prepare($sql);
        $prepared_Statement->bindParam('limit', $limit);
        $prepared_Statement->execute();
        $firemen = [];
        while ($fireman = $prepared_Statement->fetchObject(Pompier::Pompier)) {
            $firemen[] = $fireman;
        }
        echo '<pre>' . print_r($firemen, true) . '</pre>';
        return $firemen;
    }

    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbPompiers from pompiers p ;';
        $statement = $cnx->query($sql);
        $nbPompiers = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbPompier = $nbPompiers['nbPompiers'];
        echo '<pre>' . print_r($nbPompier, true) . '</pre>';
        return $nbPompier;
    }

    public function findFireHouseFromFireman($matricule) {
        $sql = 'SELECT NumCaserne FROM pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
        $data = $prepared_Statement->fetch(\PDO::FETCH_ASSOC);
        echo "<pre>" . print_r($data, true) . "</pre>";
        return $data;
    }

}

?>