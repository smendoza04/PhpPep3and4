<?php

include_once 'DatabaseConnection.php';

/**
 * Implementació de la clase DatabaseConnection segons el model OOP,
 * Object Oriented Programming.
 *
 * @author Pep
 */
class DatabaseOOP extends DatabaseConnection {

    public function __construct($servername, $username, $password) {
        parent::__construct($servername, $username, $password);
    }

    //put your code here
    public function connect(): void {
        $this->connection = new mysqli($this->servername, $this->username, $this->password);
        // Check connection
        echo "Connection ok";
        if ($this->connection->connect_error) {
            die("Connection failed: " . $this->connection->connect_error);
            $this->connection = null;
        }
    }

    public function insert($modalitat, $nivell, $intents): int {
        $sql = "INSERT INTO ESTADISTIQUES (MODALITAT, NIVELL, INTENTS) VALUES ('$modalitat', $nivell, $intents)";
        if ($this->connection != null) {
            if ($this->connection->query($sql) === TRUE) {
                return $this->connection->insert_id;
            } else {
                return -1;
            }
        }
    }

    public function selectAll() {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }

    public function selectByModalitat($modalitat) {
        $sql = "SELECT id, modalitat, nivell, data_partida, intents FROM estadistiques WHERE modalitat = '$modalitat'";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }
    
    public function deleteById($lastId){
        $sql = "DELETE FROM estadistiques WHERE id = $lastId";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }
    
    public function selectById($lastId){
        $sql = "SELECT ID, MODALITAT, NIVELL, DATA_PARTIDA, intents FROM estadistiques WHERE id = $lastId;";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }
    
    public function insertById($mode, $level, $try){
        $sql = "INSERT INTO ESTADISTIQUES (MODALITAT, NIVELL, INTENTS) VALUES ( '$mode', $level, $try)";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }
    
    public function updateById($lastId, $mode, $level, $try){
        $sql = "UPDATE estadistiques SET id = $lastId, modalitat = $mode, nivell = $level, intents = $try, data_partida = current_date()";
        $result = null;
        if ($this->connection != null) {
            $result = $this->connection->query($sql, MYSQLI_USE_RESULT);
        }
        return $result;
    }

}
