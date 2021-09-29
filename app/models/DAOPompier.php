<?php

namespace app\models;

class DAOPompier {

    private $cnx;

    public function __construct() {
        //$this->cnx = $cnx;
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

    public function save(Pompier $p): void {
        $sql = "INSERT INTO pompiers(Matricule, Prenom, Nom, ChefAgret, DateNaissance, NumCaserne, CodeGrade, matriculeRespo)
                Values (:matricule, :prenom, :nom, :chefAgret, :dateNaissance, :numCaserne, :codeGrade, :matriculeRespo);";
        $matricule = $p->getMatricule();
        $prenom = $p->getPrenom();
        $nom = $p->getNom();
        $chefAgret = $p->getChefAgret();
        $dateNaissance = $p->getDateNaissance();
        $numCaserne = $p->getNumCaserne();
        $codeGrade = $p->getCodeGrade();
        $matriculeRespo = $p->getMatriculeRespo();

        $prepared_Statement = $cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->bindParam("prenom", $prenom);
        $prepared_Statement->bindParam("nom", $nom);
        $prepared_Statement->bindParam("chefAgret", $chefAgret);
        $prepared_Statement->bindParam("dateNaissance", $dateNaissance);
        $prepared_Statement->bindParam("numCaserne", $numCaserne);
        $prepared_Statement->bindParam("codeGrade", $codeGrade);
        $prepared_Statement->bindParam("matriculeRespo", $matriculeRespo);
        $prepared_Statement->execute();
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