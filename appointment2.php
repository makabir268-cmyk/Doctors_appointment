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
    table {
      width: 100%;
      margin-top: 20px;
      border-collapse: collapse;
    }
    table, th, td {
      border: 1px solid #aaa;
    }
    th, td {
      padding: 10px;
    }
    .success { color: green; }
    .error { color: red; }
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
  ?>
</div>
</body>
</html>
