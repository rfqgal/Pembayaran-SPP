<?php
session_start();
include_once('../../assets/php/route.php');
$conn = mysqli_connect("localhost", "root", "", "pra-ukk");

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

<body onload="readPagingPrint()">
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
      <a class="flex links active" href="<?= $index_admin_payment ?>">
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
      <h1>Cari Siswa</h1>
    </div>
    <article class="card">
      <header class="flex">
        <input tabindex="1" type="text" name="search" id="search" placeholder="Cari NISN, NIS, Nama, atau Kelas" autocomplete="off">
        <button id="btnSearch" class="img-search" onclick="search()">
          <img src="<?= $img ?>/search-white.svg" alt="Search">
        </button>
        <div class="right">
          <select class="search" name="grade" id="grade" onchange="select()">
            <option value="">Kelas</option>
            <?php
            $grades = mysqli_query(
              $conn,
              "SELECT * FROM kelas"
            );
            while (@$grade = mysqli_fetch_assoc($grades)) {
            ?>
              <option value="<?= $grade['nama_kelas'] ?>">
                <?= $grade['nama_kelas'] ?>
              </option>
            <?php
            }
            ?>
          </select>
        </div>
      </header>
      <div class="mt-20">
        <table>
          <thead>
            <tr>
              <th>NISN</th>
              <th>NIS</th>
              <th>Nama</th>
              <th style="width: 10%;">Kelas</th>
              <th>Alamat</th>
              <th>Telepon</th>
              <th>Nominal SPP</th>
              <th class="action-1">Aksi</th>
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
<script>
  document.getElementById("grade").addEventListener("change", () => {
    let input = document.getElementById("grade");
    let find = input.value.toLowerCase();
    listObjects.innerHTML = "";

    const xhr = new XMLHttpRequest();
    xhr.addEventListener("load", () => {
      const responseJson = JSON.parse(xhr.responseText);
      listObjects.innerHTML = "";
      console.log(find);

      responseJson.records.forEach(object => {
        listObjects.innerHTML += `
      <tr class="listObject">
        <td>${object.nisn}</td>
        <td>${object.nis}</td>
        <td>${object.name}</td>
        <td>${object.grade}</td>
        <td>${object.address}</td>
        <td>${object.phone}</td>
        <td>${object.tuition}</td>
        <td class="action-1">
          <a href="./print.php?nisn=${object.nisn}">
            <button>Cetak</button>
          </a>
        </td>
      </tr>
    `;
      })
    });
    xhr.open("GET", `${studentLink}/search.php?search=${find}`);
    xhr.send();
  });
</script>

</html>