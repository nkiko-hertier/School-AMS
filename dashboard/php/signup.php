<?php
// Database connection
include_once "conn.php";
define('CONN', $conn);
include_once('./functions/functions.php');
error_reporting(0);

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_GET['signup'])) {
        $user['username']   = $_POST["username"];
        $user['full_names'] = $_POST["full_names"];
        $user['email']      = $_POST["email"];
        $id = '';
        $columnValuePairs = colValuePairs($user);
        $proccess = TRUE;
        if($proccess){
                // Insert user data into the database
                if(empty($id)){
                    $sql = "INSERT INTO users SET " . implode(", ", $columnValuePairs);
                } else {
                    $sql = "UPDATE users SET " . implode(", ", $columnValuePairs) . " WHERE user_id =" . $id;
                }
                if ($conn->query($sql) === TRUE) {$object = ObjectSet("Well Done!", "success", "New Variable set successfully");}
                else {$object = ObjectSet('Opps', 'error', "Can't Set variable for now!");}
        }
        echo "data = " . json_encode($object);
        // Close database connection
        $conn->close();
    }
    if(isset($_GET['delete'])){
        $table = $_POST['table'];
        $id = $_POST['id'];
        $result = deleteItemById($table, $id);
        if($result){
            $object = ObjectSet('Awesome', 'warning', "You've successfully deleted item(permanentry)!");
        } else {
            $object = ObjectSet('Opps', 'error', "Failed to delete user");
        }
    }
    
    if (isset($_GET['variable'])) {
        $user['name']   = $_POST["name"];
        $user['type']   = $_POST["type"];
        $user['value']  = $_POST["value"];
        $id = base64_decode($_POST['uid']);
        $columnValuePairs = colValuePairs($user);
        $proccess = TRUE;
        if($proccess){
            $name = $user['name'];
            $where = "name = '" . $name . "'";
                // Insert user data into the database
                if(empty($id)){
                    if (checkExist('variables', $where)) {
                        $object = ObjectSet('Well Done!', 'warning', "Variable alredy exist!");
                    } else {
                        $sql = "INSERT INTO variables SET " . implode(", ", $columnValuePairs);
                        $msg = "New Variable set successfully";
                    }
                } else {
                    $sql = "UPDATE variables SET " . implode(", ", $columnValuePairs) . " WHERE id =" . $id;
                    $msg = "Variable Updated successfully!";
                }

                if ($conn->query($sql) === TRUE) {
                    $object = ObjectSet("Well Done!", "success", $msg);
                }
                else {
                    $object = ObjectSet('Opps', 'error', "Can't Set variable for now!");
                }
            }
        echo "data = " . json_encode($object);
        // Close database connection
        $conn->close();
    }
    }
?>
