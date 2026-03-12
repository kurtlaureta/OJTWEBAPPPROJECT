<?php
include "admin_only.php";
date_default_timezone_set('Asia/Manila');

$sql = "SELECT id, username, role, status, last_activity, created_at,
        CASE
            WHEN last_activity IS NOT NULL AND last_activity >= (NOW() - INTERVAL 5 MINUTE)
            THEN 'online'
            ELSE 'offline'
        END AS live_status
        FROM users
        ORDER BY created_at DESC";

$result = $conn->query($sql);

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
    <title>Users Management</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-950 text-white min-h-screen">

    <div class="max-w-7xl mx-auto p-6">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h1 class="text-3xl font-bold">Users Management</h1>
                <p class="text-gray-400">Admin-only user monitoring and account creation</p>
            </div>

            <div class="flex items-center gap-3">
                <a href="home.php"
                class="px-4 py-2 rounded-xl bg-gray-700 hover:bg-gray-600 transition text-white">
                ← Back to Home
                </a>

                <button onclick="openCreateModal()"
                        class="px-4 py-2 rounded-xl bg-green-600 hover:bg-green-700 transition">
                    + Create User
                </button>
            </div>
        </div>

        <div class="overflow-x-auto bg-gray-900 rounded-2xl shadow-lg border border-gray-800">
            <table class="w-full text-left">
                <thead class="bg-gray-800 text-gray-200">
                    <tr>
                        <th class="px-4 py-3">ID</th>
                        <th class="px-4 py-3">Username</th>
                        <th class="px-4 py-3">Role</th>
                        <th class="px-4 py-3">Status</th>
                        <th class="px-4 py-3">Last Activity</th>
                        <th class="px-4 py-3">How Long Ago</th>
                        <th class="px-4 py-3">Created</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if ($result && $result->num_rows > 0): ?>
                        <?php while ($user = $result->fetch_assoc()): ?>
                            <tr class="border-t border-gray-800 hover:bg-gray-800/60">
                                <td class="px-4 py-3"><?php echo $user["id"]; ?></td>
                                <td class="px-4 py-3"><?php echo htmlspecialchars($user["username"]); ?></td>
                                <td class="px-4 py-3 capitalize"><?php echo htmlspecialchars($user["role"]); ?></td>
                                <td class="px-4 py-3">
                                    <?php if ($user["live_status"] === "online"): ?>
                                        <span class="px-3 py-1 rounded-full text-sm bg-green-500/20 text-green-400 border border-green-500/30">
                                            Online
                                        </span>
                                    <?php else: ?>
                                        <span class="px-3 py-1 rounded-full text-sm bg-red-500/20 text-red-400 border border-red-500/30">
                                            Offline
                                        </span>
                                    <?php endif; ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?php echo $user["last_activity"] ? date("M d, Y h:i A", strtotime($user["last_activity"])) : "No activity"; ?>
                                </td>
                                <td class="px-4 py-3 text-gray-300">
                                    <?php echo timeAgo($user["last_activity"]); ?>
                                </td>
                                <td class="px-4 py-3">
                                    <?php echo date("M d, Y h:i A", strtotime($user["created_at"])); ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="7" class="px-4 py-6 text-center text-gray-400">No users found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Create User Modal -->
    <div id="createUserModal" class="hidden fixed inset-0 bg-black/60 z-50 items-center justify-center">
        <div class="bg-white text-black w-[90%] max-w-lg rounded-2xl p-6 shadow-2xl">
            <div class="flex items-center justify-between mb-4">
                <h2 class="text-2xl font-bold">Create User Account</h2>
                <button onclick="closeCreateModal()" class="text-gray-500 hover:text-black text-xl">✕</button>
            </div>

            <form action="create_user.php" method="POST" class="space-y-4">
                <div>
                    <label class="block mb-1 font-medium">Username</label>
                    <input type="text" name="username" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Password</label>
                    <input type="password" name="password" required
                           class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <div>
                    <label class="block mb-1 font-medium">Role</label>
                    <select name="role"
                            class="w-full border border-gray-300 rounded-xl px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="user">User</option>
                        <option value="staff">Staff</option>
                        <option value="employee">Employee</option>
                        <option value="manager">Manager</option>
                        <option value="admin">Admin</option>
                    </select>
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" onclick="closeCreateModal()"
                            class="px-4 py-2 rounded-xl bg-gray-300 hover:bg-gray-400 transition">
                        Cancel
                    </button>
                    <button type="submit"
                            class="px-4 py-2 rounded-xl bg-green-600 text-white hover:bg-green-700 transition">
                        Create Account
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openCreateModal() {
            const modal = document.getElementById("createUserModal");
            modal.classList.remove("hidden");
            modal.classList.add("flex");
        }

        function closeCreateModal() {
            const modal = document.getElementById("createUserModal");
            modal.classList.remove("flex");
            modal.classList.add("hidden");
        }

        window.addEventListener("click", function(e) {
            const modal = document.getElementById("createUserModal");
            if (e.target === modal) {
                closeCreateModal();
            }
        });
    </script>

</body>
</html>