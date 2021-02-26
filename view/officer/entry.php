<?php
session_start();
include('../route.php');

if (@$_SESSION['level'] != "officer") {
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
<body>
  <nav class="float-left admin">
    <header class="t-center">
      <a href="<?= $index_officer ?>">
        <img src="<?= $img ?>/logo-white.svg" alt="Dashboard">
      </a>
    </header>
    <section class="mt-32">
      <a class="flex links active" href="<?= $index_officer ?>">
        <img src="<?= $img ?>/entry-white.svg" alt="">
        <span>Entri Transaksi</span>
      </a>
      <a class="flex links" href="<?= $history_officer ?>">
        <img src="<?= $img ?>/history-white.svg" alt="">
        <span>Histori Pembayaran</span>
      </a>
      <a class="flex links" href="<?= $logout ?>">
        <img src="<?= $img ?>/logout-white.svg" alt="">
        <span>Logout</span>
      </a>
    </section>
    <footer class="t-center">
      <span>Rifky Galuh &copy; 24, XII RPL 1</span>
    </footer>
  </nav>
  <main>
    <header class="flex">
      <h1>Entri Pembayaran</h1>
    </header>
  </main>
</body>
</html>