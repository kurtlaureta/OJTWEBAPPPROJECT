<?php
session_start();
include "db.php";
date_default_timezone_set('Asia/Manila');

header("cache-control: no-store, no-cache, must-revalidate, max-age=0");
header("Pragma: no-cache");
header("Expires: 0");

if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST["username"] ?? "");
    $password = trim($_POST["password"] ?? "");

    if ($username === "" || $password === "") {
        $error = "Please enter username and password.";
    } else {
        $username = $conn->real_escape_string($username);

        $sql = "SELECT * FROM users WHERE username = '$username' LIMIT 1";
        $result = $conn->query($sql);

        if ($result && $result->num_rows === 1) {
            $user = $result->fetch_assoc();

            if ($password === $user["password"]) {
                $role = strtolower(trim($user["role"] ?? "user"));

                $_SESSION["user_id"] = $user["id"];
                $_SESSION["username"] = $user["username"];
                $_SESSION["role"] = $role;

                $updateSql = "UPDATE users SET status = 'online', last_activity = NOW() WHERE id = ?";
                $stmt = $conn->prepare($updateSql);
                $stmt->bind_param("i", $user["id"]);
                $stmt->execute();

                if ($role === "admin") {
                    header("Location: home.php");
                } else {
                    header("Location: user_home.php");
                }
                exit;
            } else {
                $error = "Invalid password.";
            }
        } else {
            $error = "Username not found.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
    <title>Login</title>
    <style type="text/tailwindcss">
        @theme{
            --font-roboto: "Roboto", sans-serif;
        }
        @layer base{
            body{
                @apply font-roboto;
            }
        }
    </style>
</head>
<body>
    <div class="min-h-screen bg-gray-400 text-black flex justify-center items-center">
        <div class="flex bg-white p-8 h-auto w-[400px] items-center flex-col rounded-2xl shadow-xl">
            <h1 class="text-2xl font-bold m-8">LOGIN</h1>

            <?php if (!empty($error)): ?>
                <div class="w-full mb-4 rounded-xl bg-red-100 text-red-700 px-4 py-2 text-sm text-center">
                    <?php echo htmlspecialchars($error); ?>
                </div>
            <?php endif; ?>

            <form method="POST" action="" class="w-full">
                <div class="relative mb-3">
                    <input type="text" name="username" placeholder="Username"
                        class="w-full rounded-2xl border border-gray-300 bg-gray-300 py-3 pl-12 pr-3 text-gray-900 placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 h-5 w-5 transform -translate-y-1/2 text-black pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 6a3.75 3.75 0 1 1-7.5 0 3.75 3.75 0 0 1 7.5 0ZM4.501 20.118a7.5 7.5 0 0 1 14.998 0A17.933 17.933 0 0 1 12 21.75c-2.676 0-5.216-.584-7.499-1.632Z" />
                    </svg>
                </div>

                <div class="relative mb-3">
                    <input type="password" name="password" placeholder="Password"
                        class="w-full rounded-2xl border border-gray-300 bg-gray-300 py-3 pl-12 pr-3 text-gray-900 placeholder-black focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="absolute left-3 top-1/2 h-5 w-5 transform -translate-y-1/2 text-black pointer-events-none">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M16.5 10.5V6.75a4.5 4.5 0 1 0-9 0v3.75m-.75 11.25h10.5a2.25 2.25 0 0 0 2.25-2.25v-6.75a2.25 2.25 0 0 0-2.25-2.25H6.75a2.25 2.25 0 0 0-2.25 2.25v6.75a2.25 2.25 0 0 0 2.25 2.25Z" />
                    </svg>
                </div>

                <button type="submit" class="border-4 w-full py-2 px-4 mt-2 rounded-4xl text-green-700 font-medium duration-100 transition-all hover:bg-green-400 hover:border-green-400 hover:text-green-950 text-center">
                    Login
                </button>
            </form>
        </div>
    </div>
</body>
</html>