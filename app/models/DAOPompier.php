<?php

namespace app\models;

class DAOPompier {

    private $cnx;

    public function __construct($cnx) {
        $this->cnx = $cnx;
    }

    /*
      Renvoie un Pompier en fonction de son matricule
      @param string $matricule
      @return Pompier $pompier
     */

    public function find(string $matricule): Pompier {
        $sql = 'SELECT * FROM pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $pompier = new Pompier($row['Matricule'], $row['Prenom'], $row['Nom'], $row['ChefAgret'], $row['DateNaissance'], $row['NumCaserne'], $row['CodeGrade'], $row['matriculeRespo']);
        }
        return $pompier;
    }

    /*
      Renvoie un Pompier en fonction de son nom
      @param string $Nom
      @return Pompier $pompier
     */

    public function findByNom(string $Nom): Pompier {
        $sql = 'SELECT * FROM pompiers WHERE Nom=:Nom;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Nom", $Nom);
        $prepared_Statement->execute();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $pompier = new Pompier($row['Matricule'], $row['Prenom'], $row['Nom'], $row['ChefAgret'], $row['DateNaissance'], $row['NumCaserne'], $row['CodeGrade'], $row['matriculeRespo']);
        }
        return $pompier;
    }

    /*
      Créer un pompier
      @param string $p
      @return void
     */

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

    /*
      Modifie un pompier
      @param string $p
      @return void
     */

    public function edit(Pompier $p): void {

        $sql = 'UPDATE pompiers
                SET Matricule=:matricule, Prenom=:prenom, Nom=:nom, ChefAgret=:chefAgret, DateNaissance=:dateNaissance, NumCaserne=:numCaserne, CodeGrade=:codeGrade, matriculeRespo=:matriculeRespo
                Where Matricule=:matricule';

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

    /*
      Supprime un pompier et ce qui lui est lié
      @param string $matricule
      @return void
     */

    public function remove(string $matricule): void {


        $sqldelete = 'delete from pompiers_dispos WHERE Matricule=:matricule;';
        $prepared_Statement_delete = $this->cnx->prepare($sqldelete);
        $prepared_Statement_delete->bindParam("matricule", $matricule);
        $prepared_Statement_delete->execute();

        $sqldelete_intervention = 'delete from pompier_intervention WHERE Matricule=:matricule;';
        $prepared_Statement_delete_intervention = $this->cnx->prepare($sqldelete_intervention);
        $prepared_Statement_delete_intervention->bindParam("matricule", $matricule);
        $prepared_Statement_delete_intervention->execute();

        $sqldelete_qualification = 'delete from pompier_qualification WHERE Matricule=:matricule;';
        $prepared_Statement_delete_qualification = $this->cnx->prepare($sqldelete_qualification);
        $prepared_Statement_delete_qualification->bindParam("matricule", $matricule);
        $prepared_Statement_delete_qualification->execute();

        $sqlupdate = 'update pompiers
            set matriculeRespo = ""
            Where matriculeRespo=:matricule';
        $prepared_Statement_Update = $this->cnx->prepare($sqlupdate);
        $prepared_Statement_Update->bindParam("matricule", $matricule);
        $prepared_Statement_Update->execute();

        $sqldelete2 = 'delete from pompiers WHERE Matricule=:matricule;';
        $prepared_Statement = $this->cnx->prepare($sqldelete2);
        $prepared_Statement->bindParam("matricule", $matricule);
        $prepared_Statement->execute();
    }

    /*
      Renvoie un nombre de pompiers
      @param int $offset, int $limit
      @return Array $desPompiers
     */

    public function findAll(int $offset = 0, int $limit = 10): Array {

        $sql = 'SELECT * FROM pompiers LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $prepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $prepared_Statement->execute();

        $desPompiers = array();
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $desPompiers[] = new Pompier($row['Matricule'], $row['Prenom'], $row['Nom'], $row['ChefAgret'], $row['DateNaissance'], $row['NumCaserne'], $row['CodeGrade'], $row['matriculeRespo']);
        }
        return $desPompiers;
    }

    /*
      Renvoie un nombre de pompiers en fonction du nom
      @param string $value, int $offset, int $limit
      @return Array $desPompiers
     */

    public function findAllWhereNom(string $value, int $offset = 0, int $limit = 10): Array {

        $sql = 'SELECT * FROM pompiers WHERE Nom LIKE :Nom LIMIT :limit OFFSET :offset';
        $prepared_Statement = $this->cnx->prepare($sql);
        $value = "%$value%";
        $prepared_Statement->bindValue(':Nom', $value, \PDO::PARAM_STR);
        $prepared_Statement->bindValue(':limit', $limit, \PDO::PARAM_INT);
        $prepared_Statement->bindValue(':offset', $offset, \PDO::PARAM_INT);
        $prepared_Statement->execute();
        $desPompiers = [];
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $desPompiers[] = new Pompier($row['Matricule'], $row['Prenom'], $row['Nom'], $row['ChefAgret'], $row['DateNaissance'], $row['NumCaserne'], $row['CodeGrade'], $row['matriculeRespo']);
        }
        return $desPompiers;
    }

    /*
      Compte le nombre de pompiers
      @return int $nbPompier
     */

    public function count(): int {
        $sql = 'SELECT COUNT(*) as nbPompier from pompiers p ;';
        $statement = $this->cnx->query($sql);
        $nbPompiers = $statement->fetch(\PDO::FETCH_ASSOC);
        $nbPompier = $nbPompiers['nbPompier'];
        return $nbPompier;
    }

    /*
      Compte le nombre de pompiers en fonction des lettres présentes
      @param string $value
      @return int $nbPompier
     */

    public function countWhere($value): int {
        $sql = 'SELECT COUNT(*) as nbPompier from pompiers where Nom LIKE :Nom;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $value = "%$value%";
        $prepared_Statement->bindValue(':Nom', $value, \PDO::PARAM_STR);
        $prepared_Statement->execute();
        $nbPompier = $prepared_Statement->fetch(\PDO::FETCH_ASSOC);
        $nbPompier = $nbPompier['nbUser'];
        return $nbPompier;
    }

    /*
      Vérifie si une caserne existe
      @param int $numCaserne
      @return bool $isExist
     */

    public function findIfCaserneExist(int $numCaserne): bool {
        $SQL = 'SELECT * FROM casernes
        WHERE NumCaserne=:num;';
        $cnx = $this->cnx;
        $preparedStatement = $cnx->prepare($SQL);
        $preparedStatement->bindParam("num", $numCaserne);
        $preparedStatement->execute();
        $isExist = false;
        while ($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)) {
            $isExist = true;
        }
        return $isExist;
    }

    /*
      Renvoie si le pompier existe en fonction de son nom
      @param string $Nom
      @return bool $isExist
     */

    public function findIfPompierExist(string $Nom): bool {
        $sql = 'SELECT * FROM pompiers WHERE Nom=:Nom;';
        $prepared_Statement = $this->cnx->prepare($sql);
        $prepared_Statement->bindParam("Nom", $Nom);
        $prepared_Statement->execute();
        $isExist = false;
        while ($row = $prepared_Statement->fetch(\PDO::FETCH_ASSOC)) {
            $isExist = true;
        }
        return $isExist;
    }

    /*
      Regarde si le matricule du pompier existe
      @param string $matricule
      @return bool $isExist
     */
    public function findIfMatriculePompierExist(string $matricule) : bool{
        $SQL = 'SELECT * FROM pompiers
        WHERE matricule=:matricule;';
        $cnx = $this->cnx;
        $preparedStatement = $cnx->prepare($SQL);
        $preparedStatement->bindParam("matricule", $matricule);
        $preparedStatement->execute();
        $isExist = false;
        while ($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)) {
            $isExist = true;
        }
        return $isExist;
    }

    /*
      Regarde si le codeGrade existe ou non
      @param string $codeGrade
      @return bool $isExist
     */
    public function iscodeGradePompierExist(string $codeGrade) : bool{
        $SQL = 'SELECT CodeGrade FROM grades
        WHERE CodeGrade=:CodeGrade;';
        $cnx = $this->cnx;
        $preparedStatement = $cnx->prepare($SQL);
        $preparedStatement->bindParam("CodeGrade", $codeGrade);
        $preparedStatement->execute();
        $isExist = false;
        while ($row = $preparedStatement->fetch(\PDO::FETCH_ASSOC)) {
            $isExist = true;
        }
        return $isExist;
    }


    

}

?>