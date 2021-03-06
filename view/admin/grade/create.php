<?php
include_once('../../assets/php/route.php');
include('../../assets/php/function.php');

check_user("admin");
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
      <a class="flex links active" href="<?= $index_admin_grade ?>">
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
      <a class="flex links" href="<?= $index_admin_payment ?>">
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
      <a onclick="window.history.back()" class="button-back">
        <img src="<?= $img ?>/back.svg" alt="Back">
      </a>
      <h1>Tambah Kelas</h1>
    </div>
    <article class="card in">
      <div id="form">
        <div class="flex">
          <label for="grade">Kelas</label>
          <select name="grade" id="grade" tabindex="1">
            <option value="" hidden>Pilih</option>
            <option value="X">X</option>
            <option value="XI">XI</option>
            <option value="XII">XII</option>
          </select>
        </div>
        <div class="flex mt-16">
          <label for="major">Kompetensi Keahlian</label>
          <select name="major" id="major" tabindex="2">
            <option value="" hidden>Pilih</option>
            <option value="RPL">Rekayasa Perangkat Lunak</option>
            <option value="TKJ">Teknik Komputer dan Jaringan</option>
            <option value="TEI">Teknik Elektronika Industri</option>
            <option value="TKRO">Teknik Kendaraan Ringan Otomotif</option>
            <option value="TBSM">Teknik dan Bisnis Sepeda Motor</option>
          </select>
        </div>
        <div class="flex mt-16">
          <label for="almamater">Almamater</label>
          <input type="number" name="almamater" id="almamater" placeholder="Contoh: 1, 2, 3, dst." autocomplete="off" tabindex="3">
        </div>
        <div class="flex mt-32">
          <label for=""></label>
          <button type="submit" onclick="create()" tabindex="5">Simpan</button>
        </div>
      </div>
    </article>
  </main>
</body>
<script src="<?= $javascript ?>/admin/grade.js"></script>
<script src="<?= $javascript ?>/utilities.js"></script>

</html>