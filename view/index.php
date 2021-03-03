<?php
include('./assets/php/function.php');

check_login();
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login SPPku</title>
  <link rel="stylesheet" href="./assets/style.css">
</head>

<body>
  <div class="bg-login">
    <header class="title-login">
      <span class="title-login-1">Pembayaran SPP</span>
      <br>
      <span class="title-login-2">UKK 2021</span>
    </header>
    <main class="content float-right bg-white login">
      <form action="login.php" method="post">
        <h1>Login</h1>
        <label class="mt-40" for="id">Username / NISN</label>
        <input type="text" name="id" id="inputId" autocomplete="off" required>
        <label class="mt-24" for="password">Password / NIS</label>
        <input type="password" name="password" id="inputPassword" autocomplete="off" required>
        <input type="submit" value="Login">
      </form>
    </main>
    <footer>
      <span>Rifky Galuh &copy; 24, XII RPL 1</span>
  </div>
  </div>
</body>

</html>