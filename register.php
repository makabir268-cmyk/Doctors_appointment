<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Register - HealthDesk</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background-image: url('SASIM.png');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: 100% 100%;
            
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
    }

    .register-box {
      background: rgba(255, 255, 255, 0.95);
      padding: 30px 40px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0, 0, 0, 0.3);
      width: 100%;
      max-width: 400px;
    }

    .register-box h2 {
      text-align: center;
      margin-bottom: 20px;
    }

    .register-box input,
    .register-box select {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border-radius: 5px;
      border: 1px solid #ccc;
      box-sizing: border-box;
    }

    .register-box input[type="submit"] {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
      font-weight: bold;
    }

    .register-box input[type="submit"]:hover {
      background-color: #218838;
    }

    .error {
      color: red;
      text-align: center;
      margin-top: 10px;
    }

    .success {
      color: green;
      text-align: center;
      margin-top: 10px;
    }

    a {
      color: #28a745;
      text-decoration: none;
      font-weight: bold;
    }

    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>

  <div class="register-box">
    <h2>User Registration</h2>
    <form method="post" action="">
      <select name="role" required>
        <option value="">Select Role</option>
        <option value="patient">Patient</option>
        <option value="doctor">Doctor</option>
      </select>

      <input type="text" name="name" placeholder="Full Name" required>
      <input type="email" name="email" placeholder="Email" required>
      <input type="text" name="phone" placeholder="Phone Number" required>
      <input type="text" name="address" placeholder="Address" required>
      <input type="text" name="office" placeholder="Doctor Office (if applicable)">
      <input type="password" name="password" placeholder="Password" required>
      <input type="password" name="confirm_password" placeholder="Confirm Password" required>
      <input type="submit" name="register" value="Register">
    </form>

    <?php
    if (isset($_POST['register'])) {
      $role    = $_POST['role'];
      $name    = trim($_POST['name']);
      $email   = trim($_POST['email']);
      $phone   = trim($_POST['phone']);
      $address = trim($_POST['address']);
      $office  = trim($_POST['office']);
      $pass    = $_POST['password'];
      $confirm = $_POST['confirm_password'];

      if ($pass !== $confirm) {
        echo "<div class='error'>❌ Passwords do not match!</div>";
      } else {
        // Check if email already exists
        $stmt_check = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $stmt_check->bind_param("s", $email);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
          echo "<div class='error'>❌ Email already registered!</div>";
        } else {
          $hash = password_hash($pass, PASSWORD_DEFAULT);

          $stmt = $conn->prepare("INSERT INTO users (role, name, email, phone, address, office, password) VALUES (?, ?, ?, ?, ?, ?, ?)");
          $stmt->bind_param("sssssss", $role, $name, $email, $phone, $address, $office, $hash);

          if ($stmt->execute()) {
            echo "<div class='success'>✅ Registered successfully! <a href='index.php'>Login here</a></div>";
          } else {
            echo "<div class='error'>❌ Registration failed: " . htmlspecialchars($stmt->error) . "</div>";
          }
          $stmt->close();
        }
        $stmt_check->close();
      }
    }
    ?>

  </div>

</body>
</html>
