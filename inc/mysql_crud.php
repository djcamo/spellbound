<?php

class Database {

    private $host = "localhost";
    private $user = "root";
    private $password = "root";
    private $database = "spellbount_cart";
    private $connection;

    public function connect() {
        $this->connection = new mysqli($this->host, $this->user, $this->password, $this->database);
        if ($this->connection->connect_error) {
            return false;
        }
        return true;
    }

    public function disconnect() {
        if ($this->connection) {
            if ($this->connection->close()) {
                return true;
            }
            return false;
        }
    }

    public function query($sql) {
        $result = $this->connection->query($sql);
        if ($result) {
            return $result;
        }
        return false;
    }

    public function select($table, $rows = '*', $where = null, $order = null, $limit = null) {
        $sql = "SELECT $rows FROM $table";
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        if ($order != null) {
            $sql .= " ORDER BY $order";
        }
        if ($limit != null) {
            $sql .= " LIMIT $limit";
        }
        return $this->query($sql);
    }

    public function insert($table, $values, $columns = null) {
        $sql = "INSERT INTO $table";
        if ($columns != null) {
            $columns = implode(", ", $columns);
            $sql .= " ($columns)";
        }
        $values = implode("', '", $values);
        $sql .= " VALUES ('$values')";
        return $this->query($sql);
    }

    public function update($table, $set, $where = null) {
        $sql = "UPDATE $table SET $set";
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        return $this->query($sql);
    }

    public function delete($table, $where = null) {
        $sql = "DELETE FROM $table";
        if ($where != null) {
            $sql .= " WHERE $where";
        }
        return $this->query($sql);
    }


	// Public function to return the data to the user
    public function getResult(){
        $val = $this->result;
        $this->result = array();
        return $val;
    }
}
