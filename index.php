<?php include('db.php'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - HealthDesk</title>
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
    .login-container {
      background: rgba(255,255,255,0.95);
      padding: 30px;
      border-radius: 10px;
      box-shadow: 0 0 15px rgba(0,0,0,0.3);
      width: 300px;
    }
    input, button {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border-radius: 5px;
    }
    button {
      background-color: #28a745;
      color: white;
      border: none;
      cursor: pointer;
    }
    button:hover {
      background-color: #218838;
    }
    .register {
      text-align: center;
      margin-top: 10px;
    }
    a {
      color: #007bff;
      text-decoration: none;
    }
    a:hover {
      text-decoration: underline;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <h2>Welcome to HealthDesk</h2>
    <form action="login.php" method="POST">
      <input type="text" name="username" placeholder="Email or Username" required>
      <input type="password" name="password" placeholder="Password" required>
<div class="actions">
                
                <a href="forgot-password.php">Forgot Your Password?</a>
            </div>
      <button type="submit">Login</button>
    </form>
    <div class="register">
      <p>Don't have an account? <a href="register.php">Register</a></p>
    </div>
  </div>
</body>
</html>
