<?php
session_start();
include('db.php');

// Simulate logged-in user (patient)
$_SESSION['user_id'] = 1;
$patient_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['book'])) {
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $date = mysqli_real_escape_string($conn, $_POST['date']);
    $time = mysqli_real_escape_string($conn, $_POST['time']);
    $comments = mysqli_real_escape_string($conn, $_POST['comments']);

    $insert = "INSERT INTO appointments (user_id, doctor_id, appointment_date, appointment_time, comments)
               VALUES ('$patient_id', '$doctor_id', '$date', '$time', '$comments')";

    if (mysqli_query($conn, $insert)) {
        $last_id = mysqli_insert_id($conn);
        header("Location: appointment-success.php?id=$last_id");
        exit();
    } else {
        echo "<p style='color:red;'>❌ Error: " . mysqli_error($conn) . "</p>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Book Appointment</title>
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
        login-container {
             background: rgba(255,255,255,0.95);
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
            width: 300px;
        }
    .container {
      max-width: 600px;
      margin: auto;
      background: #fff;
      padding: 20px;
      border-radius: 8px;
      box-shadow: 0px 0px 10px rgba(0,0,0,0.1);
    }
    input, select, textarea {
      width: 95%;
      padding: 9px;
      margin: 12px 00;
    }
    input[type="submit"] {
      background: #007BFF;
      color: white;
      border: none;
      cursor: pointer;
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
        while ($doc = mysqli_fetch_assoc($doctors)) {
          echo "<option value='{$doc['id']}'>{$doc['name']} ({$doc['department']})</option>";
        }
      ?>
    </select>

    <label>Date</label>
    <input type="date" name="date" required>

    <label>Time</label>
    <input type="time" name="time" required>

    <label>Comments</label>
    <textarea name="comments" rows="3" placeholder="Any additional information..."></textarea>

    <input type="submit" name="book" value="Book Appointment">
  </form>
</div>
</body>
</html>
