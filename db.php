<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "users_employeelist_db_test";

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die("Database connection failed! " . $conn->connect_error);
}
?>