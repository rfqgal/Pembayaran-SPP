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

$id = $_GET['nisn'];
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPPku</title>
  <link rel="stylesheet" href="<?= $css ?>">
</head>

<body onload="get(<?= $id ?>)">
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
      <a class="flex links active" href="<?= $index_admin_administrator ?>">
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
      <a href="../" class="button-back">
        <img src="<?= $img ?>/back.svg" alt="Back">
      </a>
      <h1>Update Kelas</h1>
    </div>
    <article class="card in">
      <div id="form">
        <div class="flex">
          <label for="nisn">NISN</label>
          <input type="number" name="nisn" id="nisn" placeholder="NISN" autocomplete="off" tabindex="1" disabled>
        </div>
        <div class="flex mt-16">
          <label for="nis">NIS</label>
          <input type="number" name="nis" id="nis" placeholder="NIS" autocomplete="off" tabindex="2">
        </div>
        <div class="flex mt-16">
          <label for="name">Nama Siswa</label>
          <input type="text" name="almamater" id="name" placeholder="Nama" autocomplete="off" tabindex="3">
        </div>
        <div class="flex mt-16">
          <label for="grade">Kelas</label>
          <select name="grade" id="grade" tabindex="4">
            <option value="" hidden>Pilih</option>
          </select>
        </div>
        <div class="flex mt-16">
          <label class="textarea" for="address">Alamat Siswa</label>
          <textarea name="address" id="address" cols="30" rows="3" placeholder="Alamat" tabindex="5"></textarea>
        </div>
        <div class="flex mt-16">
          <label for="tuition">SPP</label>
          <select name="tuition" id="tuition" tabindex="6">
            <option value="" hidden>Pilih</option>
          </select>
        </div>
        <div class="flex mt-32">
          <label for=""></label>
          <button type="submit" onclick="update(<?= $id ?>)" tabindex="5">Update</button>
        </div>
      </div>
    </article>
  </main>
</body>
<script src="<?= $javascript ?>/admin/student.js"></script>
<script src="<?= $javascript ?>/utilities.js"></script>

</html>