<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";

$message = "";

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
        $stmt = $conn->prepare("INSERT INTO employees (
            first_name, middle_name, last_name, birthdate, gender, civil_status, birthplace,
            contact_number, permanent_address, present_address, father_name, mother_name,
            emergency_person, emergency_number, education, course, employee_id, department,
            position, hire_date, employment_status, assigned_area
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

        $stmt->bind_param(
            "ssssssssssssssssssssss",
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
            $assigned_area
        );

        if ($stmt->execute()) {
            header("Location: employee.php");
            exit;
        } else {
            $message = "Error saving employee: " . $conn->error;
        }

        $stmt->close();
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
    <title>Add Employee</title>
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

                <div class="flex items-center font-bold text-white bg-green-500 p-2 px-4 rounded-2xl">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor" class="size-5 mr-2 text-red-400">
                        <path d="M5.25 6.375a4.125 4.125 0 1 1 8.25 0 4.125 4.125 0 0 1-8.25 0ZM2.25 19.125a7.125 7.125 0 0 1 14.25 0v.003l-.001.119a.75.75 0 0 1-.363.63 13.067 13.067 0 0 1-6.761 1.873c-2.472 0-4.786-.684-6.76-1.873a.75.75 0 0 1-.364-.63l-.001-.122ZM18.75 7.5a.75.75 0 0 0-1.5 0v2.25H15a.75.75 0 0 0 0 1.5h2.25v2.25a.75.75 0 0 0 1.5 0v-2.25H21a.75.75 0 0 0 0-1.5h-2.25V7.5Z" />
                    </svg>
                    ADD EMPLOYEE
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
                        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                            <h2 class="text-lg font-bold text-center text-black mb-5">Personal Details</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="first_name" placeholder="First Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="text" name="middle_name" placeholder="Middle Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="text" name="last_name" placeholder="Last Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <input type="date" name="birthdate" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                <select name="gender" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    <option value="">Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>

                                <select name="civil_status" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    <option value="">Civil Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Widowed">Widowed</option>
                                </select>

                                <input type="text" name="birthplace" placeholder="Birthplace" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="tel" name="contact_number" placeholder="Contact Number" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <textarea name="permanent_address" placeholder="Permanent Address" rows="3" class="md:col-span-2 w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm resize-none"></textarea>
                                <textarea name="present_address" placeholder="Present Address" rows="3" class="md:col-span-2 w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm resize-none"></textarea>
                            </div>
                        </div>

                        <div class="bg-white border border-gray-200 rounded-3xl shadow-sm p-6">
                            <h2 class="text-lg font-bold text-center text-black mb-5">Family / Emergency / Education</h2>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <input type="text" name="father_name" placeholder="Father's Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <input type="text" name="mother_name" placeholder="Mother's Name" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm md:col-span-2">
                                <input type="text" name="emergency_person" placeholder="Emergency Contact Person" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                <input type="tel" name="emergency_number" placeholder="Emergency Contact Number" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                <select name="education" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                    <option value="">Educational Attainment</option>
                                    <option value="High School">High School</option>
                                    <option value="College Level">College Level</option>
                                    <option value="College Graduate">College Graduate</option>
                                    <option value="Vocational">Vocational</option>
                                </select>

                                <input type="text" name="course" placeholder="Course" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                <div class="md:col-span-2 border-t border-gray-200 pt-5 mt-2">
                                    <h3 class="text-base font-semibold text-gray-800 mb-4">Company Details</h3>
                                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                        <input type="text" name="employee_id" placeholder="Employee ID" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                        <input type="text" name="department" placeholder="Department" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                        <input type="text" name="position" placeholder="Position" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                        <input type="date" name="hire_date" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">

                                        <select name="employment_status" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
                                            <option value="">Employment Status</option>
                                            <option value="Active">Active</option>
                                            <option value="Probationary">Probationary</option>
                                            <option value="Resigned">Resigned</option>
                                            <option value="Terminated">Terminated</option>
                                        </select>

                                        <input type="text" name="assigned_area" placeholder="Assigned Branch / Area" class="w-full rounded-2xl border border-gray-300 bg-gray-100 py-3 px-4 text-sm">
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
                                class="px-6 py-3 rounded-2xl bg-blue-600 text-white font-medium hover:bg-blue-800 transition cursor-pointer"
                            >
                                Save Employee
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </section>
</body>
</html>