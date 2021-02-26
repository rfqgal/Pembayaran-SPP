<?php
session_start();
include('../../route.php');

if (@$_SESSION['level'] != "admin") {
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
      <a href="<?= $index_admin ?>">
        <img src="<?= $img ?>/logo-white.svg" alt="Dashboard">
      </a>
    </header>
    <section class="mt-32">
      <a class="flex links" href="<?= $index_admin_student ?>">
        <img src="<?= $img ?>/student-white.svg" alt="">
        <span>Manajemen Siswa</span>
      </a>
      <a class="flex links" href="<?= $index_admin_grade ?>">
        <img src="<?= $img ?>/grade-white.svg" alt="">
        <span>Manajemen Kelas</span>
      </a>
      <a class="flex links" href="<?= $index_admin_administrator ?>">
        <img src="<?= $img ?>/admin-white.svg" alt="">
        <span>Manajemen Petugas</span>
      </a>
      <a class="flex links" href="<?= $index_admin_tuition ?>">
        <img src="<?= $img ?>/tuition-white.svg" alt="">
        <span>Manajemen SPP</span>
      </a>
      <a class="flex links active" href="<?= $index_admin ?>">
        <img src="<?= $img ?>/entry-white.svg" alt="">
        <span>Manajemen Pembayaran</span>
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
    <div class="flex">
      <a href="../" class="button-back">
        <img src="<?= $img ?>/back.svg" alt="Back">
      </a>
      <h1>Manajemen Pembayaran</h1>
    </div>
    <article class="card">
      <header class="flex">
        <input tabindex="1" type="text" name="search" id="search" autocomplete="off"
        placeholder="Cari Petugas, NISN, Nama Siswa, Bulan atau Tahun Bayar">
        <button id="btnSearch" class="img-search" onclick="read()">
          <img src="<?= $img ?>/search-white.svg" alt="Search">
        </button>
        <div class="right">
          <a href="./create.php">
            <button>Tambah</button>
          </a>
          <a href="./print.php">
            <button class="secondary">Cetak</button>
          </a>
        </div>
      </header>
      <div class="mt-20">
        <table>
          <thead>
            <tr>
              <th>Nama Petugas</th>
              <th>NISN</th>
              <th>Nama Siswa</th>
              <th>Tanggal Bayar</th>
              <th>Bulan Bayar</th>
              <th>Tahun Bayar</th>
              <th>Nominal SPP</th>
              <th>Jumlah Bayar</th>
              <th class="action-2">Aksi</th>
            </tr>
          </thead>
          <tbody id="listObjects"></tbody>
        </table>
      </div>
    </article>
  </main>
</body>
<script src="<?= $javascript ?>/admin/payment.js"></script>
<script src="<?= $javascript ?>/utilities.js"></script>

</html>