<?php
session_start();
if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 'doctor') {
    header('Location: ../login.php');
    exit();
}
?>
<!DOCTYPE html>
<html>
<head><title>Doctor Dashboard</title></head>
<body>
  <h1>Welcome Doctor</h1>
  <a href="../logout.php">Logout</a>




<?php
   if (isset($_POST['book'])) {
    $user_id = 1; // Replace with actual logged-in user ID
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    $insert = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, comments)
               VALUES ('$user_id', '$doctor_id', '$date', '$time', '$comments')";

    if (mysqli_query($conn, $insert)) {
      echo "<p class='success'>✅ Appointment booked successfully!</p>";
    } else {
      echo "<p class='error'>❌ Booking failed: " . mysqli_error($conn) . "</p>";
    }
  }

  echo "<h3>Your Appointments</h3>";
  $result = mysqli_query($conn, "SELECT a.*, d.name AS doctor_name, d.department FROM appointments a 
                                  JOIN doctors d ON a.doctor_id = d.id 
                                  WHERE a.user_id = 1 ORDER BY a.appointment_date DESC");

  if (mysqli_num_rows($result) > 0) {
    echo "<table>
            <tr><th>Date</th><th>Time</th><th>Doctor</th><th>Department</th><th>Comments</th></tr>";
    while ($row = mysqli_fetch_assoc($result)) {
      echo "<tr>
              <td>{$row['appointment_date']}</td>
              <td>{$row['appointment_time']}</td>
              <td>{$row['doctor_name']}</td>
              <td>{$row['department']}</td>
              <td>{$row['comments']}</td>
            </tr>";
    }
    echo "</table>";
  } else {
    echo "<p>No appointments found.</p>";
  }

  if (mysqli_query($conn, $insert)) {
      $appointment_id = mysqli_insert_id($conn);
      header("Location: appointment-success.php?id=" . $appointment_id);
      exit();
    } else {
      echo "<p style='color:red;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
  
    ?>





</body>
</html>
