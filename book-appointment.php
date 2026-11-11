<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f3f3f3;
      padding: 20px;
    }
    .container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 25px;
      border-radius: 8px;
      box-shadow: 0px 0px 12px rgba(0,0,0,0.1);
    }
    input, select, textarea {
      width: 100%;
      margin: 10px 0;
      padding: 10px;
    }
  </style>
</head>
<body>
<div class="container">
  <h2>Book an Appointment</h2>
  <form method="post">
    <label>Doctor</label>
    <select name="doctor_id" required>
      <option value="">-- Select Doctor --</option>
      <?php
        $doctors = mysqli_query($conn, "SELECT * FROM doctors");
        while($doc = mysqli_fetch_assoc($doctors)) {
          echo "<option value='{$doc['id']}'>{$doc['name']} ({$doc['department']})</option>";
        }
      ?>
    </select>

    <label>Date</label>
    <input type="date" name="date" required>

    <label>Time</label>
    <input type="time" name="time" required>

    <label>Comments</label>
    <textarea name="comments" rows="3"></textarea>

    <input type="submit" name="book" value="Book Appointment">
  </form>

  <?php
  if (isset($_POST['book'])) {
    $user_id = 1; // Replace with session user ID
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    $insert = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, comments)
               VALUES ('$user_id', '$doctor_id', '$date', '$time', '$comments')";
    
    if (mysqli_query($conn, $insert)) {
      header("Location: appointments.php");
      exit();
    } else {
      echo "<p style='color:red;'>❌ Booking failed: " . mysqli_error($conn) . "</p>";
    }
  }
  ?>
</div>
</body>
</html>
