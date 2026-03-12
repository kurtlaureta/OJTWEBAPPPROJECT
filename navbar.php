<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$username = $_SESSION['username'] ?? 'User';
$role = $_SESSION['role'] ?? 'HR MANAGER';
?>

<style type="text/tailwindcss">
    @layer base{
        li{
            @apply border border-gray-800 w-full p-2 mt-4 rounded-2xl flex items-center text-[14px] duration-300 transition-all bg-gray-800 hover:border-green-300 hover:text-green-300;
        }
        ul{
            @apply mt-3 ;
        }
    }
</style>

<script>
    function openLogoutModal() {
        const modal = document.getElementById("logoutModal");
        modal.classList.remove("hidden");
        modal.classList.add("flex");
    }

    function closeLogoutModal() {
        const modal = document.getElementById("logoutModal");
        modal.classList.remove("flex");
        modal.classList.add("hidden");
    }

    window.addEventListener("click", function(e) {
        const modal = document.getElementById("logoutModal");
        if (e.target === modal) {
            closeLogoutModal();
        }
    });
</script>
<nav class="h-screen w-fit bg-gray-900 flex flex-col justify-between fixed">
    <div>
        <div class="flex flex-col items-center border-b border-gray-700">
            <div class="m-4">
                <div class="font-bold flex flex-row-reverse justify-end text-white">
                    FASTOCK
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-6 mr-1 text-green-300">
                        <path fill-rule="evenodd" d="M4.5 3.75a3 3 0 0 0-3 3v10.5a3 3 0 0 0 3 3h15a3 3 0 0 0 3-3V6.75a3 3 0 0 0-3-3h-15Zm4.125 3a2.25 2.25 0 1 0 0 4.5 2.25 2.25 0 0 0 0-4.5Zm-3.873 8.703a4.126 4.126 0 0 1 7.746 0 .75.75 0 0 1-.351.92 7.47 7.47 0 0 1-3.522.877 7.47 7.47 0 0 1-3.522-.877.75.75 0 0 1-.351-.92ZM15 8.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15ZM14.25 12a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H15a.75.75 0 0 1-.75-.75Zm.75 2.25a.75.75 0 0 0 0 1.5h3.75a.75.75 0 0 0 0-1.5H15Z" clip-rule="evenodd" />
                    </svg>
                </div>
                <h1 class="text-[10px] font-medium text-gray-400 mt-1">FASTOCK EMPLOYEE MASTERLIST</h1>
            </div>
        </div>

        <div class="p-3">
            <ul class="flex flex-col text-white">
                <li>
                    <a href="home.php" class="w-full h-full flex items-center ">Home</a>
                </li>
                <li>
                    <a href="employee.php" class="w-full h-full flex items-center">Employee List</a>
                </li>
                <li>
                    <a href="archiveemployee.php" class="w-full h-full flex items-center">Archive Employee</a>
                </li>
                <li>
                    <a href="fastock_employee_import_export_template.xlsx" download class="w-full h-full flex items-center">
                        Download Template
                    </a>
                </li>
                <?php if (isset($_SESSION["role"]) && strtolower($_SESSION["role"]) === "admin"): ?>
                    <li>
                        <a href="users.php" class=" w-full h-full">
                            Users
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
            
        </div>
        
    </div>

    <div class="px-2 border-t border-gray-700">
        <div class="flex w-full bg-gray-800 p-3 rounded-2xl mt-4">
            <div class="ml-2">
                <h1 class="text-white text-[12px]"><?php echo htmlspecialchars($username); ?></h1>
                <h1 class="text-[8px] text-white"><?php echo htmlspecialchars($role); ?></h1>
            </div>
        </div>
        <!-- logout button -->
        <a href="#"
            onclick="openLogoutModal()"
            class="flex text-red-400 border border-red-500 rounded-[14px] justify-center mt-4 mb-4 p-1 duration-300 transition-all hover:bg-red-500 hover:text-black">
            Logout
        </a>
        <div id="logoutModal" class="hidden fixed inset-0 bg-black/50 z-50 items-center justify-center">
            <div class="bg-white w-[90%] max-w-md rounded-2xl shadow-2xl p-6 animate-[fadeIn_.2s_ease-in-out]">
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-12 h-12 rounded-full bg-red-100 flex items-center justify-center text-red-600 text-2xl">
                        ⚠
                    </div>
                    <div>
                        <h2 class="text-xl font-bold text-gray-800">Confirm Logout</h2>
                        <p class="text-sm text-gray-500">You are about to end your session.</p>
                    </div>
                </div>

                <p class="text-gray-700 mb-6">
                    Are you sure you want to log out?
                </p>

                <div class="flex justify-end gap-3">
                    <button onclick="closeLogoutModal()"
                            class="px-4 py-2 rounded-xl bg-gray-200 text-gray-700 hover:bg-gray-300 transition">
                        Cancel
                    </button>

                    <a href="logout.php"
                    class="px-4 py-2 rounded-xl bg-red-600 text-white hover:bg-red-700 transition">
                    Yes, Logout
                    </a>
                </div>
            </div>
        </div>
    </div>
</nav>