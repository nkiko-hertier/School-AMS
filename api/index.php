<?php
include_once('../dashboard/php/conn.php');
// Database connection
$servername = "localhost";
$username = "root";
$password = "Afri-games123";
$dbname = "db_lms";

$conn = new mysqli($servername, $username, $password, $dbname);
define('CONN', $conn);
// Include the Cruder class
require_once 'Cruder.php';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$_POST = $data;
}
function checkExist($table, $col, $value, $id=0){
    if(!$id){
        $query = mysqli_query(CONN, "SELECT * FROM $table WHERE `$col` = '$value'");
    } else {
        $query = mysqli_query(CONN, "SELECT * FROM $table WHERE `$col` = '$value' AND id != $id");
    }
    if(mysqli_num_rows($query)){
        echo "$col with $value already exist!";
        exit();
    }
}
// Create instance of Cruder
$cruder = new Cruder($_GET['modelName'], $conn);

// Check if the request method is POST (for create operation)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $condition = $_GET['modelName'] == 'customers' || $_GET['modelName'] == 'admins';
    if($condition){
         checkExist($_GET['modelName'], 'email',    $_POST['email']);
         checkExist($_GET['modelName'], 'username', $_POST['username']);
    }
    $result = $cruder->create($_POST);
    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "Record created successfully"));
    } else {
        // Check for duplicate entry error
        if ($conn->errno == 1062) { // Error code for duplicate entry
            // Extract column name from the error message
            preg_match("/Duplicate entry '.*' for key '([^']+)'/", $conn->error, $matches);
            $duplicateColumn = $matches[1];
            http_response_code(400);
            echo json_encode(array("error" => "Duplicate entry in column: $duplicateColumn"));
        } else {
            http_response_code(500);
            echo json_encode(array("error" => "Failed to create record"));
        }
    }
    return;
}


// Check if the request method is GET and an ID is provided (for get by ID operation)
if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    // Handle get by ID operation
    $recordById = $cruder->getById($_GET['id']);
    http_response_code(200);
    echo $recordById;
    return;
}

// Check if the request method is GET (for get all operation)
if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    // Handle get all operation
    $allRecords = $cruder->getAll();
    http_response_code(200);
    echo $allRecords;
    return;
}

// Check if the request method is PUT (for update operation)
if ($_SERVER['REQUEST_METHOD'] === 'PUT') {
    // Handle update operation
$jsonData = file_get_contents('php://input');
$data = json_decode($jsonData, true);
$_PUT = $data;
    $result = $cruder->update($_GET['id'], $_PUT);
    $condition = $_GET['modelName'] == 'customers' || $_GET['modelName'] == 'admins';
    if($condition){
         checkExist($_GET['modelName'], 'email',    $_PUT['email'], $_GET['id']);
         checkExist($_GET['modelName'], 'username', $_PUT['username'], $_GET['id']);
    }
    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "Record updated successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("error" => "Failed to update record"));
    }
}

// Check if the request method is DELETE (for delete operation)
if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    // Handle delete operation
    $result = $cruder->delete($_GET['id']);
    if ($result) {
        http_response_code(200);
        echo json_encode(array("message" => "Record deleted successfully"));
    } else {
        http_response_code(500);
        echo json_encode(array("error" => "Failed to delete record"));
    }
}

// Close database connection
$conn->close();
