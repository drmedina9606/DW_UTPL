<?php
  session_start();

  require 'database.php';

  if (isset($_SESSION['user_id'])) {
    $records = $conn->prepare('SELECT id, email, password FROM users WHERE id = :id');
    $records->bindParam(':id', $_SESSION['user_id']);
    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);

    $user = null;

    if (count($results) > 0) {
      $user = $results;
    }
  }
?>

<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Welcome to you WebApp</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
  </head>
  <body>
    <?php require 'Header/header.php' ?>

    <?php if(!empty($user)): ?>
      <br> Bienvenid@. <?= $user['email']; ?>
      <br>Has iniciado sesión correctamente
      <a href="logout.php">
        Logout
      </a>
    <?php else: ?>
      <h1>Por favor, inicia sesión o regístrate</h1>

      <a href="login.php">login</a> o
      <a href="signup.php">regístrate</a>
    <?php endif; ?>
  </body>
</html>
