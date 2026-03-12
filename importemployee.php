<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\IOFactory;

$message = "";
$successCount = 0;
$errorRows = [];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (!isset($_FILES["excel_file"]) || $_FILES["excel_file"]["error"] !== UPLOAD_ERR_OK) {
        $message = "Please upload a valid Excel file.";
    } else {
        $fileTmpPath = $_FILES["excel_file"]["tmp_name"];
        $fileName = $_FILES["excel_file"]["name"];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

        if ($fileExt !== "xlsx") {
            $message = "Only .xlsx files are allowed.";
        } else {
            try {
                $spreadsheet = IOFactory::load($fileTmpPath);
                $sheet = $spreadsheet->getActiveSheet();
                $rows = $sheet->toArray(null, true, true, true);

                /*
                TEMPLATE FORMAT
                Row 1 = Title
                Row 2 = Instruction
                Row 3 = Blank
                Row 4 = Headers
                Row 5+ = Data
                */

                for ($rowIndex = 5; $rowIndex <= count($rows); $rowIndex++) {
                    $row = $rows[$rowIndex] ?? [];

                    $employee_id       = trim((string)($row['A'] ?? ''));
                    $first_name        = trim((string)($row['B'] ?? ''));
                    $middle_name       = trim((string)($row['C'] ?? ''));
                    $last_name         = trim((string)($row['D'] ?? ''));
                    $birthdate         = trim((string)($row['E'] ?? ''));
                    $gender            = trim((string)($row['F'] ?? ''));
                    $civil_status      = trim((string)($row['G'] ?? ''));
                    $birthplace        = trim((string)($row['H'] ?? ''));
                    $contact_number    = trim((string)($row['I'] ?? ''));
                    $permanent_address = trim((string)($row['J'] ?? ''));
                    $present_address   = trim((string)($row['K'] ?? ''));
                    $father_name       = trim((string)($row['L'] ?? ''));
                    $mother_name       = trim((string)($row['M'] ?? ''));
                    $emergency_person  = trim((string)($row['N'] ?? ''));
                    $emergency_number  = trim((string)($row['O'] ?? ''));
                    $education         = trim((string)($row['P'] ?? ''));
                    $course            = trim((string)($row['Q'] ?? ''));
                    $department        = trim((string)($row['R'] ?? ''));
                    $position          = trim((string)($row['S'] ?? ''));
                    $hire_date         = trim((string)($row['T'] ?? ''));
                    $employment_status = trim((string)($row['U'] ?? ''));
                    $assigned_area     = trim((string)($row['V'] ?? ''));

                    $isCompletelyEmpty =
                        $employee_id === "" &&
                        $first_name === "" &&
                        $middle_name === "" &&
                        $last_name === "" &&
                        $birthdate === "" &&
                        $gender === "" &&
                        $civil_status === "" &&
                        $birthplace === "" &&
                        $contact_number === "" &&
                        $permanent_address === "" &&
                        $present_address === "" &&
                        $father_name === "" &&
                        $mother_name === "" &&
                        $emergency_person === "" &&
                        $emergency_number === "" &&
                        $education === "" &&
                        $course === "" &&
                        $department === "" &&
                        $position === "" &&
                        $hire_date === "" &&
                        $employment_status === "" &&
                        $assigned_area === "";

                    if ($isCompletelyEmpty) {
                        continue;
                    }

                    if ($employee_id === "" || $first_name === "" || $last_name === "") {
                        $errorRows[] = "Row {$rowIndex}: employee_id, first_name, and last_name are required.";
                        continue;
                    }

                    $checkStmt = $conn->prepare("SELECT id FROM employees WHERE employee_id = ? LIMIT 1");
                    $checkStmt->bind_param("s", $employee_id);
                    $checkStmt->execute();
                    $checkResult = $checkStmt->get_result();

                    if ($checkResult && $checkResult->num_rows > 0) {
                        $errorRows[] = "Row {$rowIndex}: employee_id '{$employee_id}' already exists.";
                        $checkStmt->close();
                        continue;
                    }
                    $checkStmt->close();

                    $stmt = $conn->prepare("INSERT INTO employees (
                        employee_id,
                        first_name,
                        middle_name,
                        last_name,
                        birthdate,
                        gender,
                        civil_status,
                        birthplace,
                        contact_number,
                        permanent_address,
                        present_address,
                        father_name,
                        mother_name,
                        emergency_person,
                        emergency_number,
                        education,
                        course,
                        department,
                        position,
                        hire_date,
                        employment_status,
                        assigned_area,
                        is_archived
                    ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 0)");

                    $stmt->bind_param(
                        "ssssssssssssssssssssss",
                        $employee_id,
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
                        $department,
                        $position,
                        $hire_date,
                        $employment_status,
                        $assigned_area
                    );

                    if ($stmt->execute()) {
                        $successCount++;
                    } else {
                        $errorRows[] = "Row {$rowIndex}: failed to insert.";
                    }

                    $stmt->close();
                }

                if ($successCount > 0) {
                    $message = "{$successCount} employee(s) imported successfully.";
                } elseif (empty($errorRows)) {
                    $message = "No rows were imported.";
                } else {
                    $message = "Import finished with errors.";
                }

            } catch (Exception $e) {
                $message = "Import failed: " . $e->getMessage();
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <title>Import Employees</title>
</head>
<body class="flex bg-gray-100">
    <?php include 'navbar.php'; ?>

    <section class="flex-1 min-h-screen p-8">
        <div class="max-w-4xl mx-auto bg-white rounded-3xl shadow p-8">
            <h1 class="text-2xl font-bold mb-2">Import Employees</h1>
            <p class="text-gray-600 mb-6">
                Upload the Excel template file and import employee data into the system.
            </p>

            <div class="flex gap-3 mb-6">
                <a href="fastock_employee_import_export_template.xlsx" download class="inline-block bg-blue-500 text-white px-5 py-3 rounded-2xl hover:bg-blue-700 transition">
                    Download Template
                </a>
                <a href="employee.php" class="inline-block bg-gray-500 text-white px-5 py-3 rounded-2xl hover:bg-gray-700 transition">
                    Back to Employee List
                </a>
            </div>

            <?php if ($message !== ""): ?>
                <div class="mb-4 rounded-2xl px-4 py-3 bg-blue-100 text-blue-800">
                    <?php echo htmlspecialchars($message); ?>
                </div>
            <?php endif; ?>

            <?php if (!empty($errorRows)): ?>
                <div class="mb-6 rounded-2xl px-4 py-3 bg-red-100 text-red-800">
                    <h2 class="font-bold mb-2">Import Errors</h2>
                    <ul class="list-disc pl-5 space-y-1">
                        <?php foreach ($errorRows as $error): ?>
                            <li><?php echo htmlspecialchars($error); ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>

            <form action="" method="POST" enctype="multipart/form-data" class="space-y-4">
                <div>
                    <label class="block mb-2 font-medium">Select Excel File (.xlsx)</label>
                    <input type="file" name="excel_file" accept=".xlsx" class="block w-full border border-gray-300 p-3 rounded-2xl bg-white">
                </div>

                <button type="submit" class="bg-green-500 text-white px-6 py-3 rounded-2xl hover:bg-green-700 transition">
                    Import File
                </button>
            </form>

            <div class="mt-8 bg-gray-50 rounded-2xl p-5 border">
                <h2 class="font-bold mb-2">Important</h2>
                <p class="text-sm text-gray-700 mb-2">Your import file should follow this format:</p>
                <ul class="text-sm text-gray-700 list-disc pl-5 space-y-1">
                    <li>Row 1 = Title</li>
                    <li>Row 2 = Instruction</li>
                    <li>Row 3 = Blank</li>
                    <li>Row 4 = Headers</li>
                    <li>Row 5 and below = Employee data</li>
                </ul>
            </div>
        </div>
    </section>
</body>
</html>