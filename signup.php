<?php

  require 'database.php';

  $message = '';

  if (!empty($_POST['email']) && !empty($_POST['password'])) {
    $sql = "INSERT INTO users (email, password) VALUES (:email, :password)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':email', $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $stmt->bindParam(':password', $password);

    if ($stmt->execute()) {
      $message = 'Successfully created new user';
    } else {
      $message = 'Sorry there must have been an issue creating your account';
    }
  }
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Regístrate</title>
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="CSS/style.css">
  </head>
  <body>

    <?php require 'Header/header.php' ?>

    <?php if(!empty($message)): ?>
      <p> <?= $message ?></p>
    <?php endif; ?>

    <h1>Regístrate</h1>
    <span>o <a href="login.php">Login</a></span>

    <form action="signup.php" method="POST">
      <input name="email" type="text" placeholder="Ingresa tu correo electrónico">
      <input name="password" type="password" placeholder="Ingresa tu contraseña">
      <input name="confirm_password" type="password" placeholder="Confirme su contraseña">
      <input type="submit" value="Enviar">
    </form>

  </body>
</html>
