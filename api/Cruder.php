<?php
function colValuePairs($array){
    $columnValuePairs = array();
    foreach ($array as $key => $value) {
        // Escape the value to prevent SQL injection
        $escapedValue = CONN->real_escape_string($value);
        $columnValuePairs[] = "`$key` = '$escapedValue'";
    }
    return $columnValuePairs;
}

class Cruder {
    private $tableName;
    private $conn;

    public function __construct($tableName, $conn) {
        $this->tableName = $tableName;
        $this->conn = $conn;
    }

    public function create($data) {
        $columns = implode(', ', array_keys($data));
        $values = "'" . implode("', '", array_values($data)) . "'";
        $sql = "INSERT INTO $this->tableName ($columns) VALUES ($values)";
        return $this->conn->query($sql);
    }

    public function getAll() {
        $sql = "SELECT * FROM $this->tableName";
        $result = $this->conn->query($sql);
        $data = $result->fetch_all(MYSQLI_ASSOC);
        return json_encode($data);
    }

    public function getById($id) {
        $sql = "SELECT * FROM $this->tableName WHERE id = $id";
        $result = $this->conn->query($sql);
        $data = $result->fetch_assoc();
        return json_encode($data);
    }

    public function update($id, $data) {
        $columnValuePairs = colValuePairs($data);
        $sql = "UPDATE customers SET " . implode(", ", $columnValuePairs) . " WHERE id =" . $id;
        return $this->conn->query($sql);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->tableName WHERE id = $id";
        return $this->conn->query($sql);
    }
}
