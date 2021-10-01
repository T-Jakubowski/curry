<?php

namespace app\models;

class DAOPompier {

    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    public function find($matricule) {
        $sql = 'SELECT * FROM pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
        $data = $prepared_Statement->fetch(\PDO::FETCH_ASSOC);
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

        $prepared_Statement = $this->cnx->prepare($sql);
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
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
    }

    public function findAll($offset = 0, $limit = 10): Array {

        $sql = 'SELECT * FROM pompiers LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $prepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $prepared_Statement->execute();
        $firemen = [];
        foreach($prepared_Statement as $ps){
            array_unshift($firemen, $ps);
        }
        return $firemen;
    }

    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbPompiers from pompiers p ;';
        $statement = $this->cnx->prepare($sql);
        $nbPompiers = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbPompier = $nbPompiers['nbPompiers'];
        return $nbPompier;
    }

    public function findFireHouseFromFireman($matricule) {
        $sql = 'SELECT NumCaserne FROM pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
        $data = $prepared_Statement->fetch(\PDO::FETCH_ASSOC);
        return $data;
    }
}

?>