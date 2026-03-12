<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$sort = trim($_GET["sort"] ?? "");

$sql = "SELECT * FROM employees WHERE is_archived = 0";

switch ($sort) {
    case "az":
        $sql .= " ORDER BY first_name ASC, last_name ASC";
        break;
    case "za":
        $sql .= " ORDER BY first_name DESC, last_name DESC";
        break;
    case "newest":
        $sql .= " ORDER BY hire_date DESC";
        break;
    case "oldest":
        $sql .= " ORDER BY hire_date ASC";
        break;
    case "empid_asc":
        $sql .= " ORDER BY employee_id ASC";
        break;
    case "empid_desc":
        $sql .= " ORDER BY employee_id DESC";
        break;
    default:
        $sql .= " ORDER BY id DESC";
        break;
}

$result = $conn->query($sql);
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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Employee List</title>
</head>
<body class="flex bg-white">
    <?php include 'navbar.php'; ?>

    <section id="EmployeeList" class="flex-1 min-h-screen ml-47">
        <div class="bg-gray-200 w-full h-fit p-3 flex shadow-xl border-b border-gray-300 justify-between">
            <div class="text-black font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mr-2 text-green-800">
                    <path fill-rule="evenodd" d="M7.502 6h7.128A3.375 3.375 0 0 1 18 9.375v9.375a3 3 0 0 0 3-3V6.108c0-1.505-1.125-2.811-2.664-2.94a48.972 48.972 0 0 0-.673-.05A3 3 0 0 0 15 1.5h-1.5a3 3 0 0 0-2.663 1.618c-.225.015-.45.032-.673.05C8.662 3.295 7.554 4.542 7.502 6ZM13.5 3A1.5 1.5 0 0 0 12 4.5h4.5A1.5 1.5 0 0 0 15 3h-1.5Z" clip-rule="evenodd" />
                    <path fill-rule="evenodd" d="M3 9.375C3 8.339 3.84 7.5 4.875 7.5h9.75c1.036 0 1.875.84 1.875 1.875v11.25c0 1.035-.84 1.875-1.875 1.875h-9.75A1.875 1.875 0 0 1 3 20.625V9.375ZM6 12a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V12Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 15a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V15Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75ZM6 18a.75.75 0 0 1 .75-.75h.008a.75.75 0 0 1 .75.75v.008a.75.75 0 0 1-.75.75H6.75a.75.75 0 0 1-.75-.75V18Zm2.25 0a.75.75 0 0 1 .75-.75h3.75a.75.75 0 0 1 0 1.5H9a.75.75 0 0 1-.75-.75Z" clip-rule="evenodd" />
                </svg>
                EMPLOYEE LIST
            </div>

            <div id="liveDateTime" class="font-bold text-black"></div>
        </div>
        <!-- employee-navbar -->
        <div class="w-full max-w-7xl mx-auto bg-gray-200 p-4 m-4 rounded-3xl flex flex-col lg:flex-row lg:items-center gap-3">
    
            <div class="w-full lg:flex-1 flex items-center border px-2 py-2 rounded-2xl hover:shadow-gray-400 hover:shadow-md bg-white">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search for ID Num, Employee ID, First Name, etc..."
                    class="w-full p-1 outline-none bg-transparent text-sm md:text-base"
                >
            </div>

            <select id="filterSelect"
                class="w-full sm:w-full md:w-full lg:w-auto p-2 rounded-2xl border appearance-none text-center border-black bg-white hover:border-red-400 hover:bg-red-50 text-sm">
                <option value="all">Filter All</option>
                <option value="employee_id">Employee ID</option>
                <option value="name">Name</option>
                <option value="department">Department</option>
                <option value="position">Position</option>
            </select>

            <form method="GET" action="" class="w-full sm:w-full md:w-full lg:w-auto">
                <select name="sort" onchange="this.form.submit()"
                    class="w-full lg:w-auto appearance-none border border-black rounded-2xl text-sm bg-white p-2 text-center cursor-pointer hover:border-red-400 hover:bg-red-50">
                    <option value="">SORT</option>
                    <option value="az" <?php echo ($sort === "az") ? "selected" : ""; ?>>A-Z Name</option>
                    <option value="za" <?php echo ($sort === "za") ? "selected" : ""; ?>>Z-A Name</option>
                    <option value="newest" <?php echo ($sort === "newest") ? "selected" : ""; ?>>Date Hired: Newest</option>
                    <option value="oldest" <?php echo ($sort === "oldest") ? "selected" : ""; ?>>Date Hired: Oldest</option>
                    <option value="empid_asc" <?php echo ($sort === "empid_asc") ? "selected" : ""; ?>>EmployeeID Ascending</option>
                    <option value="empid_desc" <?php echo ($sort === "empid_desc") ? "selected" : ""; ?>>EmployeeID Descending</option>
                </select>
            </form>

            <a href="importemployee.php"
            class="w-full sm:w-full md:w-full lg:w-auto inline-flex justify-center items-center bg-green-500 p-2 px-6 rounded-3xl text-white duration-200 transition-all hover:bg-green-700 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                    <path fill-rule="evenodd" d="M11.47 3.97a.75.75 0 0 1 1.06 0l3.75 3.75a.75.75 0 1 1-1.06 1.06L12.75 6.31v8.94a.75.75 0 0 1-1.5 0V6.31L8.78 8.78a.75.75 0 1 1-1.06-1.06l3.75-3.75ZM4.5 14.25A2.25 2.25 0 0 1 6.75 12h1.5a.75.75 0 0 1 0 1.5h-1.5A.75.75 0 0 0 6 14.25v3A2.25 2.25 0 0 0 8.25 19.5h7.5A2.25 2.25 0 0 0 18 17.25v-3a.75.75 0 0 0-.75-.75h-1.5a.75.75 0 0 1 0-1.5h1.5a2.25 2.25 0 0 1 2.25 2.25v3A3.75 3.75 0 0 1 15.75 21h-7.5A3.75 3.75 0 0 1 4.5 17.25v-3Z" clip-rule="evenodd" />
                </svg>
                Import
            </a>

            <a href="exportemployee.php"
            class="w-full sm:w-full md:w-full lg:w-auto inline-flex justify-center items-center bg-purple-500 p-2 px-6 rounded-3xl text-white duration-200 transition-all hover:bg-purple-700 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                    <path fill-rule="evenodd" d="M12.53 20.03a.75.75 0 0 1-1.06 0l-3.75-3.75a.75.75 0 1 1 1.06-1.06l2.47 2.47V8.75a.75.75 0 0 1 1.5 0v8.94l2.47-2.47a.75.75 0 1 1 1.06 1.06l-3.75 3.75ZM4.5 6.75A3.75 3.75 0 0 1 8.25 3h7.5a3.75 3.75 0 0 1 3.75 3.75v3a.75.75 0 0 1-1.5 0v-3A2.25 2.25 0 0 0 15.75 4.5h-7.5A2.25 2.25 0 0 0 6 6.75v3a.75.75 0 0 1-1.5 0v-3Z" clip-rule="evenodd" />
                </svg>
                Export
            </a>

            <a href="addemployee.php"
            class="w-full sm:w-full md:w-full lg:w-auto inline-flex justify-center items-center bg-blue-400 p-2 px-6 rounded-3xl text-white duration-200 transition-all hover:bg-blue-700 text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2">
                    <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                </svg>
                Add Employee
            </a>
        </div>

        <div class="w-full max-w-7xl mx-auto">
            <div class="bg-gray-200 border border-gray-200 rounded-3xl shadow-sm p-3">
                <h2 class="text-lg font-bold text-center text-gray-800 mb-2">Employee List</h2>

                <div class="overflow-x-auto rounded-3xl overflow-hidden border border-gray-300">
                    <table class="w-full text-sm text-center border-collapse">
                        <thead>
                            <tr class="bg-gray-800 text-white">
                                <th class="p-3 border-b">Employee ID</th>
                                <th class="p-3 border-b">Full Name</th>
                                <th class="p-3 border-b">Birthdate</th>
                                <th class="p-3 border-b">Gender</th>
                                <th class="p-3 border-b">Contact Number</th>
                                <th class="p-3 border-b">Department</th>
                                <th class="p-3 border-b">Position</th>
                                <th class="p-3 border-b">Status</th>
                                <th class="p-3 border-b">Branch / Area</th>
                            </tr>
                        </thead>
                        <tbody id="employeeTableBody">
                            <?php if ($result && $result->num_rows > 0): ?>
                                <?php while ($row = $result->fetch_assoc()): ?>
                                    <?php
                                        $fullName = trim(
                                            ($row["first_name"] ?? "") . " " .
                                            ($row["middle_name"] ?? "") . " " .
                                            ($row["last_name"] ?? "")
                                        );
                                    ?>
                                    <tr
                                        class="hover:bg-green-200 employee-row cursor-pointer"
                                        data-id="<?php echo (int)$row["id"]; ?>"
                                        data-employee_id="<?php echo htmlspecialchars($row["employee_id"] ?? ""); ?>"
                                        data-fullname="<?php echo htmlspecialchars($fullName); ?>"
                                        data-first_name="<?php echo htmlspecialchars($row["first_name"] ?? ""); ?>"
                                        data-middle_name="<?php echo htmlspecialchars($row["middle_name"] ?? ""); ?>"
                                        data-last_name="<?php echo htmlspecialchars($row["last_name"] ?? ""); ?>"
                                        data-birthdate="<?php echo htmlspecialchars($row["birthdate"] ?? ""); ?>"
                                        data-gender="<?php echo htmlspecialchars($row["gender"] ?? ""); ?>"
                                        data-civil_status="<?php echo htmlspecialchars($row["civil_status"] ?? ""); ?>"
                                        data-birthplace="<?php echo htmlspecialchars($row["birthplace"] ?? ""); ?>"
                                        data-contact_number="<?php echo htmlspecialchars($row["contact_number"] ?? ""); ?>"
                                        data-permanent_address="<?php echo htmlspecialchars($row["permanent_address"] ?? ""); ?>"
                                        data-present_address="<?php echo htmlspecialchars($row["present_address"] ?? ""); ?>"
                                        data-father_name="<?php echo htmlspecialchars($row["father_name"] ?? ""); ?>"
                                        data-mother_name="<?php echo htmlspecialchars($row["mother_name"] ?? ""); ?>"
                                        data-emergency_person="<?php echo htmlspecialchars($row["emergency_person"] ?? ""); ?>"
                                        data-emergency_number="<?php echo htmlspecialchars($row["emergency_number"] ?? ""); ?>"
                                        data-education="<?php echo htmlspecialchars($row["education"] ?? ""); ?>"
                                        data-course="<?php echo htmlspecialchars($row["course"] ?? ""); ?>"
                                        data-department="<?php echo htmlspecialchars($row["department"] ?? ""); ?>"
                                        data-position="<?php echo htmlspecialchars($row["position"] ?? ""); ?>"
                                        data-hire_date="<?php echo htmlspecialchars($row["hire_date"] ?? ""); ?>"
                                        data-employment_status="<?php echo htmlspecialchars($row["employment_status"] ?? ""); ?>"
                                        data-assigned_area="<?php echo htmlspecialchars($row["assigned_area"] ?? ""); ?>"
                                    >
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["employee_id"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($fullName); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["birthdate"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["gender"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["contact_number"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["department"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["position"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["employment_status"]); ?></td>
                                        <td class="p-3 border-b"><?php echo htmlspecialchars($row["assigned_area"]); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            <?php else: ?>
                                <tr id="noDataRow">
                                    <td colspan="9" class="p-4 text-gray-500">No employee records found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div id="noMatchMessage" class="hidden text-center text-gray-500 py-4">
                        No matching employees found.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- EMPLOYEE DETAIL MODAL -->
    <div id="employeeModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
        <div class="bg-white w-full max-w-3xl rounded-3xl shadow-2xl relative overflow-hidden">
            <button id="closeModalBtn" class="absolute top-4 right-4 bg-red-500 hover:bg-red-700 text-white w-10 h-10 rounded-full flex items-center justify-center text-xl font-bold">
                ×
            </button>

            <div class="bg-gray-900 text-white px-6 py-5">
                <h2 class="text-2xl font-bold" id="modalFullName">Employee Name</h2>
                <p class="text-sm text-gray-300 mt-1" id="modalEmployeeId">EMP-000</p>
            </div>

            <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-4 max-h-[70vh] overflow-y-auto">
                <div class="bg-gray-100 rounded-2xl p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Personal Details</h3>
                    <p><strong>First Name:</strong> <span id="modalFirstName"></span></p>
                    <p><strong>Middle Name:</strong> <span id="modalMiddleName"></span></p>
                    <p><strong>Last Name:</strong> <span id="modalLastName"></span></p>
                    <p><strong>Birthdate:</strong> <span id="modalBirthdate"></span></p>
                    <p><strong>Gender:</strong> <span id="modalGender"></span></p>
                    <p><strong>Civil Status:</strong> <span id="modalCivilStatus"></span></p>
                    <p><strong>Birthplace:</strong> <span id="modalBirthplace"></span></p>
                    <p><strong>Contact Number:</strong> <span id="modalContactNumber"></span></p>
                    <p><strong>Permanent Address:</strong> <span id="modalPermanentAddress"></span></p>
                    <p><strong>Present Address:</strong> <span id="modalPresentAddress"></span></p>
                </div>

                <div class="bg-gray-100 rounded-2xl p-4">
                    <h3 class="font-bold text-gray-800 mb-3">Family / Company Details</h3>
                    <p><strong>Father's Name:</strong> <span id="modalFatherName"></span></p>
                    <p><strong>Mother's Name:</strong> <span id="modalMotherName"></span></p>
                    <p><strong>Emergency Contact:</strong> <span id="modalEmergencyPerson"></span></p>
                    <p><strong>Emergency Number:</strong> <span id="modalEmergencyNumber"></span></p>
                    <p><strong>Education:</strong> <span id="modalEducation"></span></p>
                    <p><strong>Course:</strong> <span id="modalCourse"></span></p>
                    <p><strong>Department:</strong> <span id="modalDepartment"></span></p>
                    <p><strong>Position:</strong> <span id="modalPosition"></span></p>
                    <p><strong>Hire Date:</strong> <span id="modalHireDate"></span></p>
                    <p><strong>Status:</strong> <span id="modalEmploymentStatus"></span></p>
                    <p><strong>Assigned Area:</strong> <span id="modalAssignedArea"></span></p>
                </div>
            </div>

            <div class="px-6 py-4 border-t flex justify-end gap-3">
                <a id="modalEditBtn" href="#" class="px-5 py-3 rounded-2xl bg-blue-500 text-white hover:bg-blue-700 transition">
                    Edit
                </a>
                <a id="modalArchiveBtn" href="#" class="px-5 py-3 rounded-2xl bg-yellow-500 text-white hover:bg-yellow-600 transition" onclick="return confirm('Are you sure you want to archive this employee?')">
                    Archive
                </a>
            </div>
        </div>
    </div>

    <script>
        function updateDateTime() {
        const now = new Date();
        document.getElementById('liveDateTime').textContent =
            now.toLocaleString('en-US', {
                year: 'numeric',
                month: 'long',
                day: 'numeric',
                hour: 'numeric',
                minute: '2-digit',
                second: '2-digit',
                hour12: true
            });
        }

    updateDateTime();
    setInterval(updateDateTime, 1000);

        const searchInput = document.getElementById("searchInput");
        const filterSelect = document.getElementById("filterSelect");
        const rows = document.querySelectorAll(".employee-row");
        const noMatchMessage = document.getElementById("noMatchMessage");

        function filterTable() {
            const query = searchInput.value.toLowerCase().trim();
            const filter = filterSelect.value;
            let visibleCount = 0;

            rows.forEach(row => {
                let targetText = "";

                if (filter === "employee_id") {
                    targetText = (row.dataset.employee_id || "").toLowerCase();
                } else if (filter === "department") {
                    targetText = (row.dataset.department || "").toLowerCase();
                } else if (filter === "position") {
                    targetText = (row.dataset.position || "").toLowerCase();
                } else if (filter === "name") {
                    targetText = (row.dataset.fullname || "").toLowerCase();
                } else {
                    targetText =
                        (row.dataset.employee_id || "").toLowerCase() + " " +
                        (row.dataset.fullname || "").toLowerCase() + " " +
                        (row.dataset.department || "").toLowerCase() + " " +
                        (row.dataset.position || "").toLowerCase();
                }

                if (targetText.includes(query)) {
                    row.style.display = "";
                    visibleCount++;
                } else {
                    row.style.display = "none";
                }
            });

            noMatchMessage.classList.toggle("hidden", visibleCount !== 0);
        }

        searchInput.addEventListener("input", filterTable);
        filterSelect.addEventListener("change", filterTable);

        const modal = document.getElementById("employeeModal");
        const closeModalBtn = document.getElementById("closeModalBtn");
        const modalEditBtn = document.getElementById("modalEditBtn");
        const modalArchiveBtn = document.getElementById("modalArchiveBtn");

        rows.forEach(row => {
            row.addEventListener("click", function(e) {
                if (e.target.closest("a")) return;

                const id = this.dataset.id || "";

                document.getElementById("modalFullName").textContent = this.dataset.fullname || "";
                document.getElementById("modalEmployeeId").textContent = this.dataset.employee_id || "";

                document.getElementById("modalFirstName").textContent = this.dataset.first_name || "";
                document.getElementById("modalMiddleName").textContent = this.dataset.middle_name || "";
                document.getElementById("modalLastName").textContent = this.dataset.last_name || "";
                document.getElementById("modalBirthdate").textContent = this.dataset.birthdate || "";
                document.getElementById("modalGender").textContent = this.dataset.gender || "";
                document.getElementById("modalCivilStatus").textContent = this.dataset.civil_status || "";
                document.getElementById("modalBirthplace").textContent = this.dataset.birthplace || "";
                document.getElementById("modalContactNumber").textContent = this.dataset.contact_number || "";
                document.getElementById("modalPermanentAddress").textContent = this.dataset.permanent_address || "";
                document.getElementById("modalPresentAddress").textContent = this.dataset.present_address || "";

                document.getElementById("modalFatherName").textContent = this.dataset.father_name || "";
                document.getElementById("modalMotherName").textContent = this.dataset.mother_name || "";
                document.getElementById("modalEmergencyPerson").textContent = this.dataset.emergency_person || "";
                document.getElementById("modalEmergencyNumber").textContent = this.dataset.emergency_number || "";
                document.getElementById("modalEducation").textContent = this.dataset.education || "";
                document.getElementById("modalCourse").textContent = this.dataset.course || "";
                document.getElementById("modalDepartment").textContent = this.dataset.department || "";
                document.getElementById("modalPosition").textContent = this.dataset.position || "";
                document.getElementById("modalHireDate").textContent = this.dataset.hire_date || "";
                document.getElementById("modalEmploymentStatus").textContent = this.dataset.employment_status || "";
                document.getElementById("modalAssignedArea").textContent = this.dataset.assigned_area || "";

                modalEditBtn.href = "editemployee.php?id=" + id;
                modalArchiveBtn.href = "archive_process.php?id=" + id;

                modal.classList.remove("hidden");
                modal.classList.add("flex");
            });
        });

        function closeModal() {
            modal.classList.add("hidden");
            modal.classList.remove("flex");
        }

        closeModalBtn.addEventListener("click", closeModal);

        modal.addEventListener("click", function(e) {
            if (e.target === modal) {
                closeModal();
            }
        });

        document.addEventListener("keydown", function(e) {
            if (e.key === "Escape") {
                closeModal();
            }
        });
    </script>
</body>
</html>