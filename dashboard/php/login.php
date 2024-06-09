<?php
// Start session
session_start();
include_once "conn.php";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form data
    $email = $_POST["email"];
    $password = md5($_POST["password"]);

    // Fetch user data from the database
    $type = $_POST['type'];
    $sql = "SELECT * FROM $type WHERE email = '$email' AND password = '$password'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $role = ($type = 'customer')? 'customer' : $row["role"];
        // User found, save session data and redirect to dashboard or any other page
        $row = $result->fetch_assoc();
        $_SESSION["user_id"] = $row["id"];
        $_SESSION["role"] = $role;
        $_SESSION["username"] = $row["username"];
        $_SESSION["email"] = $row["email"];
        
        // Redirect to dashboard page
        header("Location: ../Home/");
        exit();
    } else {
        // User not found or incorrect credentials
        $_SESSION['error'] = "Invalid email or password";
        header("Location: ../");
    }
}

// Close database connection
$conn->close();
?>
