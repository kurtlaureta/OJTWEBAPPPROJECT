<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    $sql = "UPDATE employees SET is_archived = 1 WHERE id = $id";
    $conn->query($sql);
}

header("Location: employee.php");
exit;