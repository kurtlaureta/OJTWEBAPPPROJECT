<?php
    if(session_status() === PHP_SESSION_NONE){
        session_start();
    }

    if(isset($_SESSION["user_id"])){
        $uid = (int) $_SESSION["user_id"];

        $sql = "UPDATE USERS
                SET status = 'online', last_activity = NOW()
                WHERE id = ?";
        $stmt = $conn -> prepare($sql);
        $stmt -> bind_param("i", $uid);
        $stmt -> execute();
    }
?>