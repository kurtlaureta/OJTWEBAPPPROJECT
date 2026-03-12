<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$id = (int)($_GET["id"] ?? $_POST["id"] ?? 0);

if ($id <= 0) {
    die("Invalid employee ID.");
}

$message = "";

/* =========================
   UPDATE EMPLOYEE
========================= */
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $first_name = trim($_POST["first_name"] ?? "");
    $middle_name = trim($_POST["middle_name"] ?? "");
    $last_name = trim($_POST["last_name"] ?? "");
    $birthdate = trim($_POST["birthdate"] ?? "");
    $gender = trim($_POST["gender"] ?? "");
    $civil_status = trim($_POST["civil_status"] ?? "");
    $birthplace = trim($_POST["birthplace"] ?? "");
    $contact_number = trim($_POST["contact_number"] ?? "");
    $permanent_address = trim($_POST["permanent_address"] ?? "");
    $present_address = trim($_POST["present_address"] ?? "");
    $father_name = trim($_POST["father_name"] ?? "");
    $mother_name = trim($_POST["mother_name"] ?? "");
    $emergency_person = trim($_POST["emergency_person"] ?? "");
    $emergency_number = trim($_POST["emergency_number"] ?? "");
    $education = trim($_POST["education"] ?? "");
    $course = trim($_POST["course"] ?? "");
    $employee_id = trim($_POST["employee_id"] ?? "");
    $department = trim($_POST["department"] ?? "");
    $position = trim($_POST["position"] ?? "");
    $hire_date = trim($_POST["hire_date"] ?? "");
    $employment_status = trim($_POST["employment_status"] ?? "");
    $assigned_area = trim($_POST["assigned_area"] ?? "");

    if ($first_name === "" || $last_name === "" || $employee_id === "") {
        $message = "First Name, Last Name, and Employee ID are required.";
    } else {
        $stmt = $conn->prepare("UPDATE employees SET
            first_name = ?,
            middle_name = ?,
            last_name = ?,
            birthdate = ?,
            gender = ?,
            civil_status = ?,
            birthplace = ?,
            contact_number = ?,
            permanent_address = ?,
            present_address = ?,
            father_name = ?,
            mother_name = ?,
            emergency_person = ?,
            emergency_number = ?,
            education = ?,
            course = ?,
            employee_id = ?,
            department = ?,
            position = ?,
            hire_date = ?,
            employment_status = ?,
            assigned_area = ?
            WHERE id = ?");

        $stmt->bind_param(
            "ssssssssssssssssssssssi",
            $first_name,
            $middle_name,
            $last_name,
            $birthdate,
            $gender,
            $civil_status,
            $birthplace,
            $contact_number,
            $permanent_address,
            $present_address,
            $father_name,
            $mother_name,
            $emergency_person,
            $emergency_number,
            $education,
            $course,
            $employee_id,
            $department,
            $position,
            $hire_date,
            $employment_status,
            $assigned_area,
            $id
        );

        if ($stmt->execute()) {
            header("Location: employee.php");
            exit;
        } else {
            $message = "Error updating employee: " . $conn->error;
        }

        $stmt->close();
    }
}

/* =========================
   LOAD EMPLOYEE DATA
========================= */
$stmt = $conn->prepare("SELECT * FROM employees WHERE id = ? LIMIT 1");
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if (!$result || $result->num_rows === 0) {
    die("Employee not found.");
}

$row = $result->fetch_assoc();
$stmt->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../index.css">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Edit Employee</title>
</head>
<body class="flex overflow-x-hidden bg-gray-100">
    <?php include 'navbar.php'; ?>

    <section class="flex-1 min-h-screen">
        <nav class="bg-gray-200 w-full h-auto p-4 shadow-md shadow-gray-500">
            <div class="flex justify-between items-center flex-wrap gap-3">
                <div class="bg-blue-400 p-1 px-4 rounded-3xl cursor-pointer text-white duration-200 transition-all hover:bg-blue-700 w-fit">
                    <a href="employee.php" class="flex w-auto h-auto items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-1">
                            <path fill-rule="evenodd" d="M9.53 2.47a.75.75 0 0 1 0 1.06L4.81 8.25H15a6.75 6.75 0 0 1 0 13.5h-3a.75.75 0 0 1 0-1.5h3a5.25 5.25 0 1 0 0-10.5H4.81l4.72 4.72a.75.75 0 1 1-1.06 1.06l-6-6a.75.75 0 0 1 0-1.06l6-6a.75.75 0 0 1 1.06 0Z" clip-rule="evenodd" />
                        </svg>
                        Back
                    </a>
                </div>

                <div class="flex items-center font-bold text-white bg-yellow-500 p-2 px-4 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2 text-blue-900">
                        <path d="M16.862 4.487a2.625 2.625 0 1 1 3.712 3.713L8.197 20.577a4.5 4.5 0 0 1-1.897 1.13l-2.685.895a.75.75 0 0 1-.948-.948l.895-2.685a4.5 4.5 0 0 1 1.13-1.897L16.862 4.487Z" />
                    </svg>
                    EDIT EMPLOYEE
                </div>

                <div class="flex text-[10px] font-bold text-black items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-3 text-green-500 mr-1">
                        <path fill-rule="evenodd" d="m11.54 22.351.07.04.028.016a.76.76 0 0 0 .723 0l.028-.015.071-.041a16.975 16.975 0 0 0 1.144-.742 19.58 19.58 0 0 0 2.683-2.282c1.944-1.99 3.963-4.98 3.963-8.827a8.25 8.25 0 0 0-16.5 0c0 3.846 2.02 6.837 3.963 8.827a19.58 19.58 0 0 0 2.682 2.282 16.975 16.975 0 0 0 1.145.742ZM12 13.5a3 3 0 1 0 0-6 3 3 0 0 0 0 6Z" clip-rule="evenodd" />
                    </svg>
                    WH1 SANTA ROSA
                </div>
            </div>
        </nav>

        <section class="p-3 flex justify-center">
            <div class="border-2 p-3 w-full max-w-7xl bg-white rounded-2xl shadow">
                <div class="w-full mx-auto px-6 py-6">

                    <?php if (!empty($message)): ?>
                        <div class="mb-4 rounded-xl bg-red-100 text-red-700 px-4 py-3">
                            <?php echo htmlspecialchars($message); ?>
                        </div>
                    <?php endif; ?>

                    <form method="POST" action="" class="grid grid-cols-1 xl:grid-cols-2 gap-6">
                        <input type="hidden" name="id" value="<?php echo (int)$row["id"]; ?>">

                        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                            <h2 class="text-lg font-bold text-center text-black mb-5">Personal Details</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="first_name" value="<?php echo htmlspecialchars($row["first_name"] ?? ""); ?>" placeholder="First Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="text" name="middle_name" value="<?php echo htmlspecialchars($row["middle_name"] ?? ""); ?>" placeholder="Middle Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="text" name="last_name" value="<?php echo htmlspecialchars($row["last_name"] ?? ""); ?>" placeholder="Last Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <input type="date" name="birthdate" value="<?php echo htmlspecialchars($row["birthdate"] ?? ""); ?>" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                <select name="gender" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    <option value="">Gender</option>
                                    <option value="Male" <?php echo (($row["gender"] ?? "") === "Male") ? "selected" : ""; ?>>Male</option>
                                    <option value="Female" <?php echo (($row["gender"] ?? "") === "Female") ? "selected" : ""; ?>>Female</option>
                                </select>

                                <select name="civil_status" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    <option value="">Civil Status</option>
                                    <option value="Single" <?php echo (($row["civil_status"] ?? "") === "Single") ? "selected" : ""; ?>>Single</option>
                                    <option value="Married" <?php echo (($row["civil_status"] ?? "") === "Married") ? "selected" : ""; ?>>Married</option>
                                    <option value="Widowed" <?php echo (($row["civil_status"] ?? "") === "Widowed") ? "selected" : ""; ?>>Widowed</option>
                                </select>

                                <input type="text" name="birthplace" value="<?php echo htmlspecialchars($row["birthplace"] ?? ""); ?>" placeholder="Birthplace" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="tel" name="contact_number" value="<?php echo htmlspecialchars($row["contact_number"] ?? ""); ?>" placeholder="Contact Number" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <textarea name="permanent_address" placeholder="Permanent Address" rows="3" class="md:col-span-2 w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm resize-none"><?php echo htmlspecialchars($row["permanent_address"] ?? ""); ?></textarea>
                                <textarea name="present_address" placeholder="Present Address" rows="3" class="md:col-span-2 w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm resize-none"><?php echo htmlspecialchars($row["present_address"] ?? ""); ?></textarea>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                            <h2 class="text-lg font-bold text-center text-black mb-5">Family / Emergency / Education</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="father_name" value="<?php echo htmlspecialchars($row["father_name"] ?? ""); ?>" placeholder="Father's Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <input type="text" name="mother_name" value="<?php echo htmlspecialchars($row["mother_name"] ?? ""); ?>" placeholder="Mother's Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <input type="text" name="emergency_person" value="<?php echo htmlspecialchars($row["emergency_person"] ?? ""); ?>" placeholder="Emergency Contact Person" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="tel" name="emergency_number" value="<?php echo htmlspecialchars($row["emergency_number"] ?? ""); ?>" placeholder="Emergency Contact Number" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                <select name="education" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    <option value="">Educational Attainment</option>
                                    <option value="High School" <?php echo (($row["education"] ?? "") === "High School") ? "selected" : ""; ?>>High School</option>
                                    <option value="College Level" <?php echo (($row["education"] ?? "") === "College Level") ? "selected" : ""; ?>>College Level</option>
                                    <option value="College Graduate" <?php echo (($row["education"] ?? "") === "College Graduate") ? "selected" : ""; ?>>College Graduate</option>
                                    <option value="Vocational" <?php echo (($row["education"] ?? "") === "Vocational") ? "selected" : ""; ?>>Vocational</option>
                                </select>

                                <input type="text" name="course" value="<?php echo htmlspecialchars($row["course"] ?? ""); ?>" placeholder="Course" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                <div class="md:col-span-2 border-t border-gray-200 pt-5 mt-2">
                                    <h3 class="text-base font-semibold text-gray-800 mb-4">Company Details</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <input type="text" name="employee_id" value="<?php echo htmlspecialchars($row["employee_id"] ?? ""); ?>" placeholder="Employee ID" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                        <input type="text" name="department" value="<?php echo htmlspecialchars($row["department"] ?? ""); ?>" placeholder="Department" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                        <input type="text" name="position" value="<?php echo htmlspecialchars($row["position"] ?? ""); ?>" placeholder="Position" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                        <input type="date" name="hire_date" value="<?php echo htmlspecialchars($row["hire_date"] ?? ""); ?>" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                        <select name="employment_status" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                            <option value="">Employment Status</option>
                                            <option value="Active" <?php echo (($row["employment_status"] ?? "") === "Active") ? "selected" : ""; ?>>Active</option>
                                            <option value="Probationary" <?php echo (($row["employment_status"] ?? "") === "Probationary") ? "selected" : ""; ?>>Probationary</option>
                                            <option value="Resigned" <?php echo (($row["employment_status"] ?? "") === "Resigned") ? "selected" : ""; ?>>Resigned</option>
                                            <option value="Terminated" <?php echo (($row["employment_status"] ?? "") === "Terminated") ? "selected" : ""; ?>>Terminated</option>
                                        </select>

                                        <input type="text" name="assigned_area" value="<?php echo htmlspecialchars($row["assigned_area"] ?? ""); ?>" placeholder="Assigned Branch / Area" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="xl:col-span-2 flex justify-end gap-3">
                            <button
                                type="button"
                                onclick="window.location.href='employee.php'"
                                class="px-5 py-3 cursor-pointer rounded-2xl bg-red-500 text-black hover:bg-red-800 transition"
                            >
                                Cancel
                            </button>

                            <button
                                type="submit"
                                class="px-6 py-3 rounded-2xl bg-yellow-500 text-white font-medium hover:bg-yellow-600 transition cursor-pointer"
                            >
                                Update Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</body>
</html>