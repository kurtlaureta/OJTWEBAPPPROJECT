<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$sort = trim($_GET["sort"] ?? "");

$sql = "SELECT * FROM employees WHERE is_archived = 1";

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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" rel="stylesheet">
    <title>Archived Employees</title>
</head>
<body class="flex bg-white">
    <?php include 'navbar.php'; ?>

    <section class="flex-1 min-h-screen ml-47">
        <div class="bg-gray-200 w-full h-fit p-3 flex shadow-xl border-b justify-between border-gray-300">
            <div class="text-black font-bold flex items-center">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-4 mr-2 text-green-700">
                    <path d="M3.375 3C2.339 3 1.5 3.84 1.5 4.875v.75c0 1.036.84 1.875 1.875 1.875h17.25c1.035 0 1.875-.84 1.875-1.875v-.75C22.5 3.839 21.66 3 20.625 3H3.375Z" />
                    <path fill-rule="evenodd" d="m3.087 9 .54 9.176A3 3 0 0 0 6.62 21h10.757a3 3 0 0 0 2.995-2.824L20.913 9H3.087ZM12 10.5a.75.75 0 0 1 .75.75v4.94l1.72-1.72a.75.75 0 1 1 1.06 1.06l-3 3a.75.75 0 0 1-1.06 0l-3-3a.75.75 0 1 1 1.06-1.06l1.72 1.72v-4.94a.75.75 0 0 1 .75-.75Z" clip-rule="evenodd" />
                </svg>

                ARCHIVED EMPLOYEES
            </div>

            <div id="liveDateTime" class="font-bold text-black"></div>
        </div>

        <div class="w-auto mx-auto max-w-7xl h-fit bg-gray-200 p-4 m-4 flex items-center rounded-3xl flex-wrap gap-3">
            <div class="w-auto flex items-center border m-2 px-2 py-1 rounded-2xl bg-white">
                <input
                    type="text"
                    id="searchInput"
                    placeholder="Search archived employees..."
                    class="w-96 p-1 outline-none bg-transparent"
                >
            </div>

            <div class="relative flex items-center rounded-4xl m-2 bg-white">
                <select id="filterSelect" class="appearance-none border text-center border-black rounded-full pl-4 pr-4 py-1 text-sm bg-transparent h-10 cursor-pointer hover:border-red-400 hover:bg-red-50">
                    <option value="all">ALL</option>
                    <option value="department">DEPARTMENT</option>
                    <option value="position">POSITION</option>
                    <option value="employee_id">EMPLOYEE ID</option>
                    <option value="name">NAME</option>
                </select>
            </div>

            <form method="GET" action="" class="relative flex items-center rounded-4xl m-2 bg-white">
                <select name="sort" onchange="this.form.submit()" class="appearance-none border text-center border-black rounded-full pl-4 pr-4 py-1 text-sm bg-transparent h-10 cursor-pointer hover:border-red-400 hover:bg-red-50">
                    <option value="">DEFAULT</option>
                    <option value="az" <?php echo ($sort === 'az') ? 'selected' : ''; ?>>A-Z Name</option>
                    <option value="za" <?php echo ($sort === 'za') ? 'selected' : ''; ?>>Z-A Name</option>
                    <option value="newest" <?php echo ($sort === 'newest') ? 'selected' : ''; ?>>Date Hired: Newest</option>
                    <option value="oldest" <?php echo ($sort === 'oldest') ? 'selected' : ''; ?>>Date Hired: Oldest</option>
                    <option value="empid_asc" <?php echo ($sort === 'empid_asc') ? 'selected' : ''; ?>>EmployeeID Ascending</option>
                    <option value="empid_desc" <?php echo ($sort === 'empid_desc') ? 'selected' : ''; ?>>EmployeeID Descending</option>
                </select>
            </form>
        </div>

        <div class="w-full max-w-7xl mx-auto">
            <div class="bg-gray-200 border border-gray-200 rounded-3xl shadow-sm p-3">
                <h2 class="text-lg font-bold text-center text-gray-800 mb-2">Archived Employee List</h2>

                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-center border">
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
                        <tbody id="archiveTableBody">
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
                                        class="hover:bg-gray-50 archive-row cursor-pointer"
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
                                        data-search_employee_id="<?php echo htmlspecialchars(strtolower($row["employee_id"] ?? "")); ?>"
                                        data-search_name="<?php echo htmlspecialchars(strtolower($fullName)); ?>"
                                        data-search-department="<?php echo htmlspecialchars(strtolower($row["department"] ?? "")); ?>"
                                        data-search-position="<?php echo htmlspecialchars(strtolower($row["position"] ?? "")); ?>"
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
                                    <td colspan="9" class="p-4 text-gray-500">No archived employees found.</td>
                                </tr>
                            <?php endif; ?>
                        </tbody>
                    </table>

                    <div id="noMatchMessage" class="hidden text-center text-gray-500 py-4">
                        No matching archived employees found.
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ARCHIVE DETAIL MODAL -->
    <div id="archiveModal" class="fixed inset-0 bg-black/50 hidden items-center justify-center z-50 p-4">
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
                <a id="modalRestoreBtn" href="#" class="px-5 py-3 rounded-2xl bg-green-500 text-white hover:bg-green-700 transition" onclick="return confirm('Are you sure you want to restore this employee?')">
                    Restore
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
        const rows = document.querySelectorAll(".archive-row");
        const noMatchMessage = document.getElementById("noMatchMessage");

        function filterTable() {
            const query = searchInput.value.toLowerCase().trim();
            const filter = filterSelect.value;
            let visibleCount = 0;

            rows.forEach(row => {
                let targetText = "";

                if (filter === "employee_id") {
                    targetText = row.dataset.searchEmployeeId || "";
                } else if (filter === "department") {
                    targetText = row.dataset.searchDepartment || "";
                } else if (filter === "position") {
                    targetText = row.dataset.searchPosition || "";
                } else if (filter === "name") {
                    targetText = row.dataset.searchName || "";
                } else {
                    targetText =
                        (row.dataset.searchEmployeeId || "") + " " +
                        (row.dataset.searchName || "") + " " +
                        (row.dataset.searchDepartment || "") + " " +
                        (row.dataset.searchPosition || "");
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

        const modal = document.getElementById("archiveModal");
        const closeModalBtn = document.getElementById("closeModalBtn");
        const modalRestoreBtn = document.getElementById("modalRestoreBtn");

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

                modalRestoreBtn.href = "restoreemployee.php?id=" + id;

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