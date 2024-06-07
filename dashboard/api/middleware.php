<?php 

class Database {
    private $pdo;

    public function __construct($host, $dbname, $username, $password) {
        try {
            $this->pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function getTable($table) {
        return new Table($this->pdo, $table);
    }
}

class Table {
    private $pdo;
    private $table;

    public function __construct($pdo, $table) {
        $this->pdo = $pdo;
        $this->table = $table;
    }

    public function insert($data) {
        $columns = implode(", ", array_keys($data));
        $placeholders = implode(", ", array_fill(0, count($data), "?"));
        $stmt = $this->pdo->prepare("INSERT INTO $this->table ($columns) VALUES ($placeholders)");
        return $stmt->execute(array_values($data));
    }

    public function update($data, $where) {
        $set = "";
        foreach ($data as $key => $value) {
            $set .= "$key = ?, ";
        }
        $set = rtrim($set, ", ");
        $stmt = $this->pdo->prepare("UPDATE $this->table SET $set WHERE $where");
        return $stmt->execute(array_values($data));
    }

    public function fetchAll($where = "1") {
        $stmt = $this->pdo->query("SELECT * FROM $this->table WHERE $where");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function delete($where) {
        $stmt = $this->pdo->prepare("DELETE FROM $this->table WHERE $where");
        return $stmt->execute();
    }
}

// Example usage:
$db = new Database('localhost', 'school_accounting', 'root', '');
$studentsTable = $db->getTable('students');
