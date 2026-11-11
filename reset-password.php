<?php include('db.php'); ?>
<!DOCTYPE html>
<html>
<head>
  <title>Reset Password</title>
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
    input {
      width: 90%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
    }
    input[type=submit] {
      background: #007bff;
      color: white;
      font-weight: bold;
      border: none;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="box">
    <h2>Reset Password</h2>

    <?php
    if (isset($_GET['token'])) {
      $token = $_GET['token'];
      $res = mysqli_query($conn, "SELECT * FROM users WHERE reset_token='$token'");
      if (mysqli_num_rows($res) == 1) {
        ?>

        <form method="post">
          <input type="hidden" name="token" value="<?php echo $token; ?>">
          <input type="password" name="new_password" placeholder="New Password" required>
          <input type="password" name="confirm_password" placeholder="Confirm Password" required>
          <input type="submit" name="reset" value="Reset Password">
        </form>

        <?php
      } else {
        echo "<p style='color:red;'>❌ Invalid or expired token!</p>";
      }
    }

    if (isset($_POST['reset'])) {
      $token = $_POST['token'];
      $pass1 = $_POST['new_password'];
      $pass2 = $_POST['confirm_password'];

      if ($pass1 !== $pass2) {
        echo "<p style='color:red;'>❌ Passwords do not match!</p>";
      } else {
        $hash = password_hash($pass1, PASSWORD_DEFAULT);
        mysqli_query($conn, "UPDATE users SET password='$hash', reset_token=NULL WHERE reset_token='$token'");
        echo "<p style='color:green;'>✅ Password updated! <a href='index.php'>Login</a></p>";
      }
    }
    ?>
  </div>
</body>
</html>
