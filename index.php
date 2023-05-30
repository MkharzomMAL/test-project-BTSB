<?php
session_start();

if (isset($_SESSION['username'])) {
    header('Location: home.php');
    exit();
}

require_once './src/config/config.php';

// $message = '';

// if (isset($_POST['login'])) {
//     $username = $_POST['username'];
//     $password = $_POST['password'];

//     $stmt = $db->prepare('SELECT * FROM users WHERE username = ?');
//     $stmt->bind_param('s', $username);
//     $stmt->execute();
//     $result = $stmt->get_result();
//     $user = $result->fetch_assoc();

//     if ($user && password_verify($password, $user['password'])) {
//         $_SESSION['username'] = $user['username'];
//         header('Location: home.php');
//         exit();
//     } else {
//         $message = 'Invalid username or password.';
//     }
// }

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BTSB TEST Project</title>
  <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <div class="login form">
      <header>Login</header>
      <form action="#">
        <input type="text" placeholder="Enter your email">
        <input type="password" placeholder="Enter your password">
        <a href="#">Forgot password?</a>
        <input type="button" class="button" value="Login">
      </form>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="#">
        <input type="text" placeholder="Enter your full name">
        <input type="text" placeholder="Enter your Address">
        <input type="text" placeholder="Enter your email">
        <input type="password" placeholder="Create a password">
        <input type="password" placeholder="Confirm your password">
        <input type="button" class="button" value="Signup">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>
</body>
</html>
