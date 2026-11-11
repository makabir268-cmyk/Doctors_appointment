<?php
session_start();
include('db.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
  $username = $_POST['username'];
  $password = $_POST['password'];

  // Check in users table
  $sql_user = "SELECT * FROM users WHERE email = '$username' OR name = '$username' LIMIT 1";
  $result_user = mysqli_query($conn, $sql_user);

  if (mysqli_num_rows($result_user) == 1) {
    $user = mysqli_fetch_assoc($result_user);
    if (password_verify($password, $user['password'])) {
      $_SESSION['user_id'] = $user['id'];
      $_SESSION['role'] = $user['role'];
      $_SESSION['name'] = $user['name'];

      header("Location: appointment.php");
      exit();
    }
  }

  // Check in doctors table - updated to use only 'name'
  $sql_doc = "SELECT * FROM doctors WHERE name = '$username' LIMIT 1";
  $result_doc = mysqli_query($conn, $sql_doc);

  if (mysqli_num_rows($result_doc) == 1) {
    $doc = mysqli_fetch_assoc($result_doc);
    if (password_verify($password, $doc['password'])) {
      $_SESSION['user_id'] = $doc['id'];
      $_SESSION['role'] = 'doctor';
      $_SESSION['name'] = $doc['name'];

      header("Location: doctor_dashboard.php");
      exit();
    }
  }

  // If login failed
  echo "<script>alert('Invalid username or password.'); window.location.href='index.php';</script>";
}
?>
