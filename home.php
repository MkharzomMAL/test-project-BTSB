<?php
session_start();

if (!isset($_SESSION['email'])) {
    header('Location: index.php');
    exit();
}

require_once './src/config/config.php';

// Fetch user information from the database
$stmt = $db->prepare('SELECT * FROM users WHERE email = ?');
$stmt->bind_param('s', $_SESSION['email']);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();
$stmt->close();
mysqli_close($db);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>BTSB TEST Project - Home</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="./src/css/style.css">
</head>
<body>
  <div class="container p-4">
    <h2 class="text-center m-3">Welcome, <?php echo $user['username']; ?>!</h2>
    <div class="user-info">
      <p><strong>Name:</strong> <?php echo $user['username']; ?></p>
      <p><strong>Email:</strong> <?php echo $user['email']; ?></p>
      <p><strong>Registered at:</strong> <?php echo $user['created_at']; ?></p>
    </div>
    <div class="logout">
      <a href="./src/config/logout.php" class="btn btn-primary">Logout</a>
    </div>
  </div>
</body>
</html>
