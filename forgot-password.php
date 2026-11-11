<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Forgot Password</title>
  <style>
    body {
      font-family: Arial;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-image: url('SASIM.png');
      background-size: 100% 100%;
    }
    .box {
      background-color: rgba(255,255,255,0.95);
      padding: 25px;
      border-radius: 8px;
      width: 350px;
      box-shadow: 0px 0px 15px #333;
    }
    input[type=email], input[type=submit] {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
    }
    input[type=submit] {
      background: #28a745;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Forgot Password</h2>
    <form method="post">
      <input type="email" name="email" placeholder="Enter your email" required><br>
      <input type="submit" name="send" value="Send Reset Link">
    </form>

    <?php
    if (isset($_POST['send'])) {
      $email = $_POST['email'];
      $token = bin2hex(random_bytes(16));
      $res = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
      if (mysqli_num_rows($res) > 0) {
        mysqli_query($conn, "UPDATE users SET reset_token='$token' WHERE email='$email'");
        $link = "http://localhost/SAS/reset-password.php?token=$token";
        echo "<p>✅ Reset link (demo): <a href='$link'>$link</a></p>";
      } else {
        echo "<p style='color:red;'>❌ Email not found!</p>";
      }
    }
    ?>
  </div>
</body>
</html>
