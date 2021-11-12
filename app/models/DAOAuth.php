<?php
class DAOCaserne{
    private PDO $cnx;
    
    public function __construct($conn){
        $this->cnx = $conn;
    }
    
}
?>