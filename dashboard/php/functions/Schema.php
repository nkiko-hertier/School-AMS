<?
class UserHandler {
    private $user;
    private $tableName;
    private $action;

    public function __construct($user, $tableName, $action) {
        $this->user = $user;
        $this->tableName = $tableName;
        $this->action = $action;
    }

    public function createOrUpdate() {
        // Handle form data
        $user = $this->user;
        $columnValuePairs = array();
        foreach ($user as $key => $value) {
            $columnValuePairs[] = "`$key` = '$value'";
        }
        $sql = "INSERT INTO {$this->tableName} SET " . implode(", ", $columnValuePairs);

        // You can return or execute $sql as per your needs
        return $sql;
    }

    public function Update() {
        // Handle form data
        $user = $this->user;
        $columnValuePairs = array();
        foreach ($user as $key => $value) {
            $columnValuePairs[] = "`$key` = '$value'";
        }

        // Define the SQL statement based on action
        $sql = "UPDATE {$this->tableName} SET " . implode(", ", $columnValuePairs);

        // You can return or execute $sql as per your needs
        return $sql;
    }
}
?>