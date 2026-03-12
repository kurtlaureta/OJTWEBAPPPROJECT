<?php
session_start();
include "db.php";
date_default_timezone_set('Asia/Manila');

    if(isset($_SESSION["user_id"])){
        $uid = (int) $_SESSION["user_id"];

        $sql = "UPDATE users
                SET status = 'offline', last_activity = NOW()
                WHERE id = ?";

                $stmt = $conn->prepare($sql);
                $stmt->bind_param("i", $uid);
                $stmt->execute();
    }

$_SESSION = [];
session_unset();
session_destroy();

header("cache-control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

header("Location: login.php");
exit;
?>