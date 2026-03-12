<?php
include "admin_only.php";
date_default_timezone_set('Asia/Manila');

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: users.php");
    exit;
}

$username = trim($_POST["username"] ?? "");
$password = trim($_POST["password"] ?? "");
$role     = trim($_POST["role"] ?? "user");

if ($username === "" || $password === "") {
    die("Username and password are required.");
}

$allowedRoles = ["admin", "user", "staff", "employee", "manager"];
if (!in_array(strtolower($role), $allowedRoles)) {
    $role = "user";
}

$checkSql = "SELECT id FROM users WHERE username = ? LIMIT 1";
$checkStmt = $conn->prepare($checkSql);
$checkStmt->bind_param("s", $username);
$checkStmt->execute();
$checkResult = $checkStmt->get_result();

if ($checkResult->num_rows > 0) {
    die("Username already exists.");
}

/*
For now plain text to match your current system.
Better later:
$hashedPassword = password_hash($password, PASSWORD_DEFAULT);
*/

$insertSql = "INSERT INTO users (username, password, role, status, last_activity)
              VALUES (?, ?, ?, 'offline', NULL)";
$insertStmt = $conn->prepare($insertSql);
$insertStmt->bind_param("sss", $username, $password, $role);
$insertStmt->execute();

header("Location: users.php");
exit;
?>