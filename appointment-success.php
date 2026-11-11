<?php
session_start();
include('db.php');

if (!isset($_SESSION['user_id'])) {
    die("Access denied. Please log in.");
}

if (!isset($_GET['id'])) {
    die("Invalid appointment ID.");
}

$user_id = $_SESSION['user_id'];
$appointment_id = intval($_GET['id']);

// Only fetch appointment that belongs to the logged-in user
$sql = "SELECT a.*, 
               d.name AS doctor_name, d.department, 
               u.name AS patient_name, u.phone, u.serial_number, u.address
        FROM appointments a
        JOIN doctors d ON a.doctor_id = d.id
        JOIN users u ON a.user_id = u.id
        WHERE a.id = $appointment_id AND a.user_id = $user_id";

$result = mysqli_query($conn, $sql);
if (mysqli_num_rows($result) == 1) {
    $row = mysqli_fetch_assoc($result);
} else {
    die("Appointment not found or access denied.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Appointment Confirmed</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('SASIM.png');
            background-repeat: no-repeat;
            background-attachment: fixed;
            background-size: 100% 100%;
        }

        .card {
            background: rgba(255,255,255,0.95);
            padding: 20px;
            border-radius: 10px;
            max-width: 600px;
            margin: auto;
            box-shadow: 0 0 10px rgba(0,0,0,0.2);
        }

        h2 {
            color: green;
        }
    </style>
</head>
<body>
    <div class="card">
        <h2>✅ Appointment Confirmed</h2>
        <p><strong>Patient Name :</strong> <?= htmlspecialchars($row['patient_name']); ?> </p>
        <p><strong>Phone:</strong> <?= htmlspecialchars($row['phone']); ?></p>
        <p><strong>Serial:</strong> <?= htmlspecialchars($row['id']); ?></p>
        <p><strong>Address:</strong> <?= htmlspecialchars($row['address']); ?></p>
        <hr>
        <p><strong>Doctor:</strong> <?= htmlspecialchars($row['doctor_name']); ?> </p>
        <p><strong>Department:</strong> <?= htmlspecialchars($row['department']); ?></p>
        <p><strong>Appointment ID:</strong> <?= htmlspecialchars($row['id']); ?></p>

        <p><strong>Date:</strong> <?= htmlspecialchars($row['appointment_date']); ?></p>
        <p><strong>Time:</strong> <?= htmlspecialchars($row['appointment_time']); ?></p>
        <p><strong>Comments:</strong> <?= htmlspecialchars($row['comments']); ?></p>
        <br><a href="appointment.php">← Book another appointment</a>
     <br>
   
    <br><br>
    <a href="generate-pdf.php?id=<?= $appointment_id ?>" class="btn">📄 Download PDF</a>
  </div>
</body>
</html>
