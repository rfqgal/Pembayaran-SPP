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

<body>
  <nav class="float-left student">
    <header class="t-center">
      <a href="<?= $index_student ?>">
        <img src="<?= $img ?>/logo-black.svg" alt="Dashboard">
      </a>
    </header>
    <section class="mt-24">
      <a class="flex links" href="<?= $history_student ?>">
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
    <h1>Dashboard</h1>
    <span class="dashboard">Selamat Datang, <?= $_SESSION['name'] ?>!</span>
  </main>
</body>

</html>