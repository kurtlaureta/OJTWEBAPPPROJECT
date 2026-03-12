<?php
session_start();
include "db.php";
date_default_timezone_set('Asia/Manila');

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION["username"] ?? "User";
$role = strtolower($_SESSION["role"] ?? "user");

/* COUNTS */
$totalUsers = 0;
$totalAdmins = 0;
$totalRegularUsers = 0;
$totalOnline = 0;

$q1 = $conn->query("SELECT COUNT(*) AS total FROM users");
if ($q1) {
    $totalUsers = (int) $q1->fetch_assoc()["total"];
}

$q2 = $conn->query("SELECT COUNT(*) AS total FROM users WHERE LOWER(role) = 'admin'");
if ($q2) {
    $totalAdmins = (int) $q2->fetch_assoc()["total"];
}

$q3 = $conn->query("SELECT COUNT(*) AS total FROM users WHERE LOWER(role) <> 'admin'");
if ($q3) {
    $totalRegularUsers = (int) $q3->fetch_assoc()["total"];
}

$q4 = $conn->query("SELECT COUNT(*) AS total FROM users WHERE last_activity IS NOT NULL AND last_activity >= (NOW() - INTERVAL 5 MINUTE)");
if ($q4) {
    $totalOnline = (int) $q4->fetch_assoc()["total"];
}

/* RECENT USERS */
$recentUsers = $conn->query("
    SELECT id, username, role, status, last_activity, created_at
    FROM users
    ORDER BY created_at DESC
    LIMIT 5
");

/* ONLINE USERS */
$onlineUsers = $conn->query("
    SELECT id, username, role, last_activity
    FROM users
    WHERE last_activity IS NOT NULL
      AND last_activity >= (NOW() - INTERVAL 5 MINUTE)
    ORDER BY last_activity DESC
    LIMIT 5
");

function timeAgo($datetime) {
    if (!$datetime) return "No activity";

    $timestamp = strtotime($datetime);
    $diff = time() - $timestamp;

    if ($diff < 0) $diff = 0;

    if ($diff < 10) return "Just now";
    if ($diff < 60) return $diff . " sec ago";
    if ($diff < 3600) return floor($diff / 60) . " min ago";
    if ($diff < 86400) return floor($diff / 3600) . " hr ago";
    if ($diff < 2592000) return floor($diff / 86400) . " day(s) ago";

    return date("M d, Y h:i A", $timestamp);
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
    <title>Home</title>
</head>
<body class="flex bg-gray-100 font-[Roboto] overflow-x-hidden">
    <?php include 'navbar.php'; ?>

    <section class="min-h-screen flex-1 bg-gray-100 ml-47">
        <div class="bg-gray-200 w-full p-4 shadow-md border-b border-gray-200">
            <div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3">
                
                <div>
                    <h1 class="text-2xl font-bold text-green-700">DASHBOARD</h1>
                    <p class="text-gray-600 text-sm">FASTOCK Employee Masterlist Overview</p>
                </div>

                <div class="text-center">
                    <div id="liveDate" class="text-sm font-semibold text-gray-700"></div>
                    <div id="liveTime" class="text-xl font-bold text-black"></div>
                </div>

                <div class="text-sm text-gray-600">
                    Logged in as:
                    <span class="font-semibold text-black"><?php echo htmlspecialchars($username); ?></span>
                    <span class="mx-1">•</span>
                    <span class="capitalize px-3 py-1 rounded-full bg-blue-100 text-blue-700 font-medium">
                        <?php echo htmlspecialchars($role); ?>
                    </span>
                </div>
            </div>
        </div>

        <div class="p-6 space-y-6">

            <!-- Top Welcome Banner -->
            <div class="rounded-3xl bg-gradient-to-r from-gray-800 to-gray-900 text-white p-6 shadow-lg">
                <h2 class="text-2xl md:text-3xl font-bold">Welcome back, <span class="text-green-400"><?php echo htmlspecialchars($username); ?>!</span></h2>
                <div class="flex items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3 text-green-400 mr-1 mt-1.5">
                        <path fill-rule="evenodd" d="M2.25 12c0-5.385 4.365-9.75 9.75-9.75s9.75 4.365 9.75 9.75-4.365 9.75-9.75 9.75S2.25 17.385 2.25 12Zm8.706-1.442c1.146-.573 2.437.463 2.126 1.706l-.709 2.836.042-.02a.75.75 0 0 1 .67 1.34l-.04.022c-1.147.573-2.438-.463-2.127-1.706l.71-2.836-.042.02a.75.75 0 1 1-.671-1.34l.041-.022ZM12 9a.75.75 0 1 0 0-1.5.75.75 0 0 0 0 1.5Z" clip-rule="evenodd" />
                    </svg>
                    <p class="mt-2 text-blue-100">
                        Monitor users, track activity, and manage the FASTOCK Employee Masterlist system from one place.
                    </p>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 xl:grid-cols-4 gap-4">
                <div class="bg-white rounded-2xl shadow p-5 border border-gray-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mb-1 text-gray-800">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                        <p class="text-sm text-black ml-1 font-medium">Total Users</p>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $totalUsers; ?></h3>
                </div>

                <div class="bg-white rounded-2xl shadow p-5 border border-gray-200">
                    <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mb-1 text-red-500">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                        <p class="text-sm text-black ml-1 font-medium">Admins</p>
                    </div>
                    <h3 class="text-3xl font-bold text-red-600 mt-2"><?php echo $totalAdmins; ?></h3>
                </div>

                <div class="bg-white rounded-2xl shadow p-5 border border-gray-200">
                     <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mb-1 text-black">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                        <p class="text-sm text-black ml-1 font-medium">Regular Users</p>
                    </div>
                    <h3 class="text-3xl font-bold text-gray-800 mt-2"><?php echo $totalRegularUsers; ?></h3>
                </div>

                <div class="bg-white rounded-2xl shadow p-5 border border-gray-200">
                     <div class="flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mb-1 text-green-600">
                            <path fill-rule="evenodd" d="M7.5 6a4.5 4.5 0 1 1 9 0 4.5 4.5 0 0 1-9 0ZM3.751 20.105a8.25 8.25 0 0 1 16.498 0 .75.75 0 0 1-.437.695A18.683 18.683 0 0 1 12 22.5c-2.786 0-5.433-.608-7.812-1.7a.75.75 0 0 1-.437-.695Z" clip-rule="evenodd" />
                            </svg>
                        <p class="text-sm text-black ml-1 font-medium">Current Online</p>
                    </div>
                    <h3 class="text-3xl font-bold text-green-600 mt-2"><?php echo $totalOnline; ?></h3>
                </div>
            </div>

            <!-- Quick Info -->
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-4">
                <div class="bg-white rounded-2xl shadow p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-black mb-3 text-center">Account Overview</h3>
                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Username</span>
                            <span class="font-medium text-gray-800"><?php echo htmlspecialchars($username); ?></span>
                        </div>
                        <div class="flex justify-between border-b pb-2">
                            <span class="text-gray-500">Role</span>
                            <span class="font-medium capitalize text-gray-800"><?php echo htmlspecialchars($role); ?></span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-gray-500">Session Status</span>
                            <span class="font-medium text-green-600">Online</span>
                        </div>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 border border-gray-200">
                    <h3 class="text-lg text-center font-bold text-black mb-3">System Summary</h3>
                    <div class="space-y-3 text-sm text-gray-600">
                        <p>• Manage staff accounts and monitor online activity.</p>
                        <p>• Track which users are active in the system.</p>
                        <p>• View recently created accounts and latest logins.</p>
                    </div>
                </div>

                <div class="bg-white rounded-2xl shadow p-6 border border-gray-200">
                    <h3 class="text-lg font-bold text-black mb-3 text-center">Quick Actions</h3>
                    <div class="flex flex-col gap-3">
                        <?php if ($role === "admin"): ?>
                            <a href="users.php" class="rounded-xl border-2 border-blue-600 bg-blue-600 text-white text-center py-3 hover:bg-white hover:text-blue-600 hover:border-blue-600 transition">
                                Manage Users
                            </a>
                        <?php endif; ?>

                        <a href="logout.php" class="rounded-xl border border-red-500 text-red-600 text-center py-3 hover:bg-red-500 hover:text-white transition">
                            Logout
                        </a>
                    </div>
                </div>
            </div>

            <!-- Tables -->
            <div class="grid grid-cols-1 xl:grid-cols-2 gap-6">

                <!-- Recent Users -->
                <div class="bg-white rounded-2xl shadow border border-gray-200 overflow-hidden">
                    <div class="px-5 py-4 border-b bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Recently Created Users</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="text-left px-4 py-3">Username</th>
                                    <th class="text-left px-4 py-3">Role</th>
                                    <th class="text-left px-4 py-3">Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($recentUsers && $recentUsers->num_rows > 0): ?>
                                    <?php while ($user = $recentUsers->fetch_assoc()): ?>
                                        <tr class="border-t">
                                            <td class="px-4 py-3 font-medium text-gray-800">
                                                <?php echo htmlspecialchars($user["username"]); ?>
                                            </td>
                                            <td class="px-4 py-3 capitalize text-gray-600">
                                                <?php echo htmlspecialchars($user["role"]); ?>
                                            </td>
                                            <td class="px-4 py-3 text-gray-500">
                                                <?php echo date("M d, Y h:i A", strtotime($user["created_at"])); ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">No users found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Online Users -->
                <div class="bg-white rounded-2xl shadow border border-gray-200 overflow-hidden">
                    <div class="px-5 py-4 border-b bg-gray-50">
                        <h3 class="text-lg font-bold text-gray-800">Users Online Now</h3>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm">
                            <thead class="bg-gray-100 text-gray-700">
                                <tr>
                                    <th class="text-left px-4 py-3">Username</th>
                                    <th class="text-left px-4 py-3">Role</th>
                                    <th class="text-left px-4 py-3">Last Activity</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($onlineUsers && $onlineUsers->num_rows > 0): ?>
                                    <?php while ($user = $onlineUsers->fetch_assoc()): ?>
                                        <tr class="border-t">
                                            <td class="px-4 py-3 font-medium text-gray-800">
                                                <?php echo htmlspecialchars($user["username"]); ?>
                                            </td>
                                            <td class="px-4 py-3 capitalize text-gray-600">
                                                <?php echo htmlspecialchars($user["role"]); ?>
                                            </td>
                                            <td class="px-4 py-3 text-green-600 font-medium">
                                                <?php echo timeAgo($user["last_activity"]); ?>
                                            </td>
                                        </tr>
                                    <?php endwhile; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="3" class="px-4 py-4 text-center text-gray-500">No users are online.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <script>
        function updateDateTime() {
            const now = new Date();

            const dateOptions = {
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };

            const timeOptions = {
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            };

            document.getElementById("liveDate").textContent =
                now.toLocaleDateString("en-US", dateOptions);

            document.getElementById("liveTime").textContent =
                now.toLocaleTimeString("en-US", timeOptions);
        }

        updateDateTime();
        setInterval(updateDateTime, 1000);
    </script>
</body>
</html>