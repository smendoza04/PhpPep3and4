<?php

include_once 'DatabaseConnection.php';

/*
 * Implementació de la clase DatabaseConnection segons el model PDO, 
 * PHP Data Object.
 * @author Pep
 */

class DatabasePDO extends DatabaseConnection {

    const TABLE_START = "<table align='center'; style='border: solid 1px black;'><tr style='background: grey;'><th>Id</th><th>Modalitat</th><th>Nivell</th><th>Data</th><th>Intents</th></tr>";
    const TABLE_END = "</table>";

    private $database;

    public function __construct($servername, $username, $password, $database) {
        parent::__construct($servername, $username, $password);
        $this->database = $database;
    }

    function connect(): void {
        try {
            $this->connection = new PDO("mysql:host=$this->servername;dbname=$this->database", $this->username, $this->password);
            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function insert($modalitat, $nivell, $intents): int {
        try {
            // prepare sql and bind parameters
            $stmt = $this->connection->prepare("INSERT INTO estadistiques (modalitat, nivell, intents) VALUES (:modalitat, :nivell, :intents)");
            $stmt->bindParam(':modalitat', $modalitat);
            $stmt->bindParam(':nivell', $nivell);
            $stmt->bindParam(':intents', $intents);
            $stmt->execute();
            return $this->connection->lastInsertId();
        } catch (Exception $error) {
            throw new Exception($error->getMessage());
        }
    }

    function selectAll() {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques");
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }

    function selectByModalitat($modalitat) {
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = :modalitat");
        $stmt->bindParam(':modalitat', $modalitat);
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        return $stmt;
    }
    
    
    
    public function deleteById($lastId){
        $sql = "DELETE FROM estadistiques WHERE id = $lastId;";
        $this->connection->exec($sql);
    }
    
    public function selectById($lastId){
        $stmt = $this->connection->prepare("SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE id = :lastId");
        $stmt->bindParam(':lastId', $lastId);
        $stmt->execute();
        // set the resulting array to associative
        $stmt->setFetchMode(PDO::FETCH_ASSOC);
    }
    
    public function insertById($mode, $level, $try){
        $sql = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('$mode', $level, $try)";
        $this->connection->exec($sql);
    }
    
    public function updateById($lastId, $mode, $level, $try){
        //UPDATE estadistiques SET id = $lastId, modalitat = $mode, nivell = $level, intents = $try, data_partida = current_date()
//        $stmt = $this->connection->prepare("UPDATE ESTADISTIQUES SET ID = :lastId, MODALITAT = :mode, NIVELL = :level, INTENTS = :try, DATA_PARTIDA = current_date() WHERE ID = :lastId");
//        $stmt->bindParam(':lastId', $lastId);
//        $stmt->bindParam(':mode', $mode);
//        $stmt->bindParam(':level', $level);
//        $stmt->bindParam(':try', $try);
//        $stmt->execute();
//        // set the resulting array to associative
//        $stmt->setFetchMode(PDO::FETCH_ASSOC);
//        return $stmt;
        
        $sql = "UPDATE estadistiques SET id = $lastId, modalitat = '$mode', nivell = $level, intents = $try WHERE id = $lastId;";
        $this->connection->exec($sql);
        
    }
    
}

/*
    function createTable($table_sql) {
        try {
            $this->connection->exec($table_sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
     */

    /*
    function insert($modalitat, $nivell, $intents) {
        $sql = "INSERT INTO estadistiques (modalitat, nivell, intents) VALUES ('$modalitat', $nivell, $intents)";
        try {
            $this->connection->exec($sql);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }
     */