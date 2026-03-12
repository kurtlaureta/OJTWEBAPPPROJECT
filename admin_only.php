<?php
session_start();
include "db.php";
date_default_timezone_set('Asia/Manila');

    if (!isset($_SESSION["user_id"])) {
        header("Location: login.php");
        exit;
    }

    if (!isset($_SESSION["role"]) || strtolower($_SESSION["role"]) !== "admin") {
        header("Location: home.php");
        exit;
    }

include "update_activity.php";
?>