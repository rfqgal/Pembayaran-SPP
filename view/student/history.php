<?php
session_start();
include('../assets/php/route.php');

if (@$_SESSION['level'] != "student") {
  echo "
    <script>
      alert('Anda tidak memiliki akses di halaman ini!');
      window.location.href = '$login';
    </script>
  ";
}
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPPku</title>
  <link rel="stylesheet" href="<?= $css ?>">
</head>

<body onload="read()">
  <!-- Define User ID for Javascript -->
  <input type="text" name="userId" id="userId" value="<?= $_SESSION['id'] ?>" hidden>
  <input type="text" name="userId" id="userName" value="<?= $_SESSION['name'] ?>" hidden>

  <nav class="float-left student">
    <header class="t-center">
      <a href="<?= $index_student ?>">
        <img src="<?= $img ?>/logo-black.svg" alt="Dashboard">
      </a>
    </header>
    <section class="mt-24">
      <a class="flex links active" href="<?= $index_student ?>">
        <img src="<?= $img ?>/history-black.svg" alt="">
        <span>Histori Pembayaran</span>
      </a>
      <a class="flex links" href="<?= $logout ?>">
        <img src="<?= $img ?>/logout-black.svg" alt="">
        <span>Logout</span>
      </a>
    </section>
    <footer class="t-center">
      <span>Rifky Galuh &copy; 24, XII RPL 1</span>
    </footer>
  </nav>
  <main>
    <header class="flex">
      <a onclick="window.history.back()" class="button-back">
        <img src="<?= $img ?>/back.svg" alt="Back">
      </a>
      <h1>Histori Pembayaran</h1>
    </header>
    <article id="history" class="card"></article>
  </main>
</body>
<script src="<?= $javascript ?>/student/payment.js"></script>
<script src="<?= $javascript ?>/utilities.js"></script>

</html>