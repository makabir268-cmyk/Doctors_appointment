<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'patient') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Patient Dashboard</title></head>
<body>
  <h1>Welcome Patient</h1>
  <a href="../logout.php">Logout</a>
</body>
</html>
