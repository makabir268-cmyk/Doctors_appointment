<?php
use Dompdf\Dompdf;

session_start();

if (!isset($_SESSION['user_id'])) {
    http_response_code(401);
    exit("Access denied. Please log in.");
}

if (!isset($_GET['id']) || filter_var($_GET['id'], FILTER_VALIDATE_INT) === false) {
    http_response_code(400);
    exit("Invalid appointment ID.");
}

if (!is_file(__DIR__ . '/vendor/autoload.php')) {
    http_response_code(500);
    exit("PDF library is not installed. Run 'composer install' in the project folder.");
}

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/db.php';

$appointment_id = (int) $_GET['id'];
$user_id = (int) $_SESSION['user_id'];

$sql = "SELECT a.id, a.appointment_date, a.appointment_time, a.comments,
               d.name AS doctor_name, d.department,
               u.name AS patient_name, u.phone, u.serial_number, u.address
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        JOIN users u ON a.user_id = u.id
        WHERE a.id = ? AND a.user_id = ?";

$stmt = mysqli_prepare($conn, $sql);
if (!$stmt) {
    http_response_code(500);
    exit("Unable to prepare appointment lookup.");
}

mysqli_stmt_bind_param($stmt, 'ii', $appointment_id, $user_id);
if (!mysqli_stmt_execute($stmt)) {
    http_response_code(500);
    exit("Unable to load appointment.");
}

$result = mysqli_stmt_get_result($stmt);
$row = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$row) {
    http_response_code(404);
    exit("Appointment not found or access denied.");
}

$escape = static function ($value) {
    return htmlspecialchars((string) $value, ENT_QUOTES | ENT_SUBSTITUTE, 'UTF-8');
};

$html = '<h2 style="color: green;">Appointment Confirmed</h2>'
    . '<p><strong>Patient Name:</strong> ' . $escape($row['patient_name']) . '</p>'
    . '<p><strong>Phone:</strong> ' . $escape($row['phone']) . '</p>'
    . '<p><strong>Address:</strong> ' . $escape($row['address'] ?? 'Not provided') . '</p>'
    . '<p><strong>Serial Number:</strong> ' . $escape($row['serial_number']) . '</p>'
    . '<hr>'
    . '<p><strong>Doctor:</strong> ' . $escape($row['doctor_name']) . ' (' . $escape($row['department']) . ')</p>'
    . '<p><strong>Appointment ID:</strong> ' . $escape($row['id']) . '</p>'
    . '<p><strong>Date:</strong> ' . $escape($row['appointment_date']) . '</p>'
    . '<p><strong>Time:</strong> ' . $escape($row['appointment_time']) . '</p>'
    . '<p><strong>Comments:</strong> ' . $escape($row['comments']) . '</p>';

$dompdf = new Dompdf();
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();
$dompdf->stream("Appointment_$appointment_id.pdf", ["Attachment" => 1]);
