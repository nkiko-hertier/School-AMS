<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "school_ams";

$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
function counter($table, $conn){
    $sql = "SELECT * FROM " . $table;
    $result = mysqli_query($conn, $sql);
    if(mysqli_num_rows($result)>0){
        return mysqli_num_rows($result);
    }
}
?>