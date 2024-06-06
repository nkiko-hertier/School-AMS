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

// Insert a new student
$studentsTable->insert([
    'name' => 'John Doe',
    'email' => 'john@example.com',
    'date_of_birth' => '2000-01-01',
    'enrollment_date' => '2024-06-06'
]);

// Fetch all students
$students = $studentsTable->fetchAll();
print_r($students);
