<?php
include_once("conn.php");
$sql = "SELECT 
        customers.email as email, 
        loans.loan_amount as amount,
        loans.interest_rate as rate,
        loans.term as term  
        FROM loans LEFT JOIN customers ON customers.id=loans.id";
$loans = mysqli_query($conn, $sql);