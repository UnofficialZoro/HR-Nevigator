<?php
require_once('tcpdf/tcpdf.php');

// Retrieve form data
$employee_name = $_POST['employee_name'];
$position = $_POST['position'];
$salary = $_POST['salary'];
$bonus = $_POST['bonus'];
$slip_date = $_POST['slip_date'];
$working_hours = $_POST['working_hours'];

// Create new PDF document
$pdf = new TCPDF();
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetTitle('Employee Salary Slip');

$pdf->AddPage();

// Add content to PDF
$content = "
<h2>Employee Information</h2>
<p><strong>Employee Name:</strong> $employee_name</p>
<p><strong>Position:</strong> $position</p>
<h2>Salary Details</h2>
<p><strong>Base Salary:</strong> $salary</p>
<p><strong>Bonus:</strong> $bonus</p>
<p><strong>Salary Slip Date:</strong> $slip_date</p>
<h2>Working Hours</h2>
<p><strong>Work Hours:</strong> $working_hours</p>
";

$pdf->writeHTML($content, true, false, true, false, '');

// Output PDF
$pdf->Output('salary_slip.pdf', 'D');
?>
