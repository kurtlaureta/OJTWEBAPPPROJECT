<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

include "db.php";
require __DIR__ . '/vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle('Employee_Export');

/*
|--------------------------------------------------------------------------
| MATCH TEMPLATE LAYOUT
|--------------------------------------------------------------------------
| Row 1 = Title
| Row 2 = Instruction
| Row 3 = Blank
| Row 4 = Header row
*/

$sheet->mergeCells('A1:V1');
$sheet->setCellValue('A1', 'FASTOCK Employee Export');
$sheet->mergeCells('A2:V2');
$sheet->setCellValue('A2', 'Exported employee data using the same column order as the import template.');
$sheet->getStyle('A1:A2')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

/* HEADER ORDER EXACTLY LIKE TEMPLATE */
$headers = [
    "employee_id",
    "first_name",
    "middle_name",
    "last_name",
    "birthdate",
    "gender",
    "civil_status",
    "birthplace",
    "contact_number",
    "permanent_address",
    "present_address",
    "father_name",
    "mother_name",
    "emergency_person",
    "emergency_number",
    "education",
    "course",
    "department",
    "position",
    "hire_date",
    "employment_status",
    "assigned_area"
];

/* WRITE HEADER ON ROW 4 */
$col = 'A';
foreach ($headers as $header) {
    $sheet->setCellValue($col . '4', $header);
    $sheet->getStyle($col . '4')->getFont()->setBold(true);
    $col++;
}

/* LOAD DATA */
$sql = "SELECT * FROM employees ORDER BY id DESC";
$result = $conn->query($sql);

$rowNumber = 5;

if ($result) {
    while ($row = $result->fetch_assoc()) {
        $sheet->setCellValue('A' . $rowNumber, $row["employee_id"] ?? "");
        $sheet->setCellValue('B' . $rowNumber, $row["first_name"] ?? "");
        $sheet->setCellValue('C' . $rowNumber, $row["middle_name"] ?? "");
        $sheet->setCellValue('D' . $rowNumber, $row["last_name"] ?? "");
        $sheet->setCellValue('E' . $rowNumber, $row["birthdate"] ?? "");
        $sheet->setCellValue('F' . $rowNumber, $row["gender"] ?? "");
        $sheet->setCellValue('G' . $rowNumber, $row["civil_status"] ?? "");
        $sheet->setCellValue('H' . $rowNumber, $row["birthplace"] ?? "");
        $sheet->setCellValue('I' . $rowNumber, $row["contact_number"] ?? "");
        $sheet->setCellValue('J' . $rowNumber, $row["permanent_address"] ?? "");
        $sheet->setCellValue('K' . $rowNumber, $row["present_address"] ?? "");
        $sheet->setCellValue('L' . $rowNumber, $row["father_name"] ?? "");
        $sheet->setCellValue('M' . $rowNumber, $row["mother_name"] ?? "");
        $sheet->setCellValue('N' . $rowNumber, $row["emergency_person"] ?? "");
        $sheet->setCellValue('O' . $rowNumber, $row["emergency_number"] ?? "");
        $sheet->setCellValue('P' . $rowNumber, $row["education"] ?? "");
        $sheet->setCellValue('Q' . $rowNumber, $row["course"] ?? "");
        $sheet->setCellValue('R' . $rowNumber, $row["department"] ?? "");
        $sheet->setCellValue('S' . $rowNumber, $row["position"] ?? "");
        $sheet->setCellValue('T' . $rowNumber, $row["hire_date"] ?? "");
        $sheet->setCellValue('U' . $rowNumber, $row["employment_status"] ?? "");
        $sheet->setCellValue('V' . $rowNumber, $row["assigned_area"] ?? "");
        $rowNumber++;
    }
}

/* AUTO SIZE */
foreach (range('A', 'V') as $columnID) {
    $sheet->getColumnDimension($columnID)->setAutoSize(true);
}

/* DOWNLOAD */
$filename = "fastock_employee_export.xlsx";

header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment; filename="' . $filename . '"');
header('Cache-Control: max-age=0');

$writer = new Xlsx($spreadsheet);
$writer->save('php://output');
exit;