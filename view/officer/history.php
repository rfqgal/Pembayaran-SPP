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

<body onload="read()">
  <nav class="float-left admin">
    <header class="t-center">
      <a href="<?= $index_officer ?>">
        <img src="<?= $img ?>/logo-white.svg" alt="Dashboard">
      </a>
    </header>
    <section class="mt-32">
      <a class="flex links" href="<?= $entry_officer ?>">
        <img src="<?= $img ?>/entry-white.svg" alt="">
        <span>Entri Transaksi</span>
      </a>
      <a class="flex links active" href="<?= $index_officer ?>">
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
    <h1>Histori Pembayaran</h1>
    <article class="card">
      <header class="flex">
        <input type="text" name="search" id="search" onkeyup="search()" 
        placeholder="Cari Nama Siswa, Petugas, NISN" autocomplete="off">
        <div class="right">
          <a href="<?= $print_officer ?>">
            <button>Cetak Semua Pembayaran</button>
          </a>
        </div>
      </header>
      <div class="mt-20">
        <table id="listObjects">
          <tr>
            <th>Nama Petugas</th>
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Bayar</th>
            <th>Tahun Bayar</th>
            <th>Nominal SPP</th>
            <th>Jumlah Bayar</th>
            <th class="action-1">Aksi</th>
          </tr>
        </table>
      </div>
    </article>
  </main>
</body>
<script src="<?= $javascript ?>/officer/payment.js"></script>
<script src="<?= $javascript ?>/utilities.js"></script>
</html>