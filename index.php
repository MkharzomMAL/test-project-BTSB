<?php
session_start();

if (isset($_SESSION['email'])) {
    header('Location: home.php');
    exit();
}

require_once './src/config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  if (isset($_POST['login'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
    $stmt->bind_param('s', $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['email'] = $user['email'];
        header('Location: home.php');
        // echo "done" ;
        exit();
    } else {
        $message = 'Invalid email or password.';
        $messageClass = 'text-danger';
        // echo $message ;
        // echo $user['email']; 
    }
    
} elseif (isset($_POST['signup'])) {

    $name = $_POST['name'];
    $email = $_POST['email'];
    $password =  $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if ($password !== $confirmPassword) {
      $message = 'Passwords do not match.';
      $messageClass = 'text-danger';
      // echo $message ;
    }else{

      $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

      $stmt = $db->prepare('INSERT INTO users (username, password , email) VALUES (?, ?, ?)');
      $stmt->bind_param('sss', $name, $password, $email);

      if ($stmt->execute()) {
          $message = 'Signup successful. Please login.';
          $messageClass = 'text-success';
          // echo $message ;
      } else {
          $message = 'Error creating user: ' . $db->error;
          $messageClass = 'text-danger';
          // echo $message ;
      }

      $stmt->close();

    }
    
}


}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BTSB TEST Project</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
  <div class="container">
    <input type="checkbox" id="check">
    <h2 class="text-center m-3">Welcome to BTSB Employee System</h2>
    
    <div class="login form">
      <header>Login</header>
      <form action="#" method="POST">
        <input type="text" name="email" placeholder="Enter your email" required>
        <input type="password" name="password" placeholder="Enter your password" required>
        <a href="#">Forgot password?</a>
        <input type="submit" name="login" class="button" value="Login">
      </form>
      <div id="message" class="message <?php echo $messageClass ; ?> text-center my-4">
        <?php if (isset($message)) { ?>
          <?php echo $message; ?>
        <?php } ?>
      </div>
      <div class="signup">
        <span class="signup">Don't have an account?
         <label for="check">Signup</label>
        </span>
      </div>
    </div>
    <div class="registration form">
      <header>Signup</header>
      <form action="#" method="POST">
        <div class="row">
          <div class="col-6">
              <input type="text" name="name" placeholder="Enter your full name" required>
          </div>
          <div class="col-6">
              <input type="text" name="email" placeholder="Enter your email" required>
          </div>
        </div>
        <div class="row">
          <div class="col-6">
            <input type="password" id="password" name="password" placeholder="Create a password" required>
          </div>
          <div class="col-6">
            <input type="password" id="confirm_password" name="confirm_password" placeholder="Confirm your password" required>
            <span id="password_error" class="error"></span>
          </div>
        </div>

        
        <input type="submit" name="signup" class="button" value="Signup">
      </form>
      <div class="signup">
        <span class="signup">Already have an account?
         <label for="check">Login</label>
        </span>
      </div>
    </div>
  </div>


  <script>
  const passwordField = document.getElementById('password');
  const confirmPasswordField = document.getElementById('confirm_password');
  const passwordError = document.getElementById('password_error');

  confirmPasswordField.addEventListener('input', function() {
    if (passwordField.value !== confirmPasswordField.value) {
      passwordError.textContent = 'Password does not match.';
      passwordError.classList.remove('text-success');
      passwordError.classList.add('text-danger');
    } else {
      passwordError.textContent = 'Password match.';
      passwordError.classList.remove('text-danger');
      passwordError.classList.add('text-success');
    }
  });
  </script>

</body>
</html>
