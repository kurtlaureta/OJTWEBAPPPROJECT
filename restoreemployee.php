<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$id = (int)($_GET["id"] ?? 0);

if ($id > 0) {
    $stmt = $conn->prepare("UPDATE employees SET is_archived = 0 WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->close();
}

header("Location: archiveemployee.php");
exit;
?>