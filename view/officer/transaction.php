<?php
session_start();

include('./function.php');
include('../route.php');
$conn = mysqli_connect("localhost", "root", "", "pra-ukk");

if (@$_SESSION['level'] != "officer") {
  echo "
    <script>
      alert('Anda tidak memiliki akses di halaman ini!');
      window.location.href = '$login';
    </script>
  ";
}

$nisn = $_GET['nisn'];

$get_payment_month = "SELECT tgl_dibayar FROM siswa 
  INNER JOIN pembayaran ON siswa.nisn = pembayaran.nisn 
  WHERE siswa.nisn = $nisn
  ORDER BY id_pembayaran DESC LIMIT 1
";
$payment_month = mysqli_query($conn, $get_payment_month);

$get_payment_year = "SELECT tgl_dibayar FROM siswa 
  INNER JOIN pembayaran ON siswa.nisn = pembayaran.nisn 
  WHERE siswa.nisn = $nisn
  ORDER BY id_pembayaran DESC LIMIT 1
";
$payment_year = mysqli_query($conn, $get_payment_year);

// Tahun Ajaran 2020/2021
$first_period = "2020-07-01"; // Ubah untuk menentukan Tahun Ajaran
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>SPPku</title>
  <link rel="stylesheet" href="<?= $css ?>">
</head>

<body onload="getStudent(<?= $nisn ?>)">
  <nav class="float-left admin">
    <header class="t-center">
      <a href="<?= $index_officer ?>">
        <img src="<?= $img ?>/logo-white.svg" alt="Dashboard">
      </a>
    </header>
    <section class="mt-32">
      <a class="flex links active" href="<?= $entry_officer ?>">
        <img src="<?= $img ?>/entry-white.svg" alt="">
        <span>Entri Transaksi</span>
      </a>
      <a class="flex links" href="<?= $index_officer ?>">
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
    <div class="flex">
      <a onclick="window.history.back()" class="button-back">
        <img src="<?= $img ?>/back.svg" alt="Back">
      </a>
      <h1>Entri Transaksi</h1>
    </div>
    <article class="card in">
      <h2 style="margin-bottom: 0;">Validasi Data</h2>
      <hr>
      <div id="form">
        <input type="hidden" id="admin_id" value="<?= $_SESSION['id'] ?>">
        <div class="flex mt-16">
          <label for="nisn">NISN</label>
          <input type="number" name="nisn" id="nisn" disabled>
        </div>
        <div class="flex mt-16">
          <label for="nis">NIS</label>
          <input type="number" name="nis" id="nis" disabled>
        </div>
        <div class="flex mt-16">
          <label for="name">Nama Siswa</label>
          <input type="text" name="name" id="name" disabled>
        </div>
        <div class="flex mt-16">
          <label for="grade">Kelas</label>
          <input type="text" name="grade" id="grade" disabled>
        </div>
        <div class="flex mt-16">
          <label for="date">Tanggal Bayar</label>
          <input type="text" name="date" id="date" disabled>
        </div>
        <div class="flex mt-16">
          <label for="month">Bulan SPP</label>
          <?php
          if (mysqli_num_rows($payment_month) > 0) {
            while ($payment = mysqli_fetch_assoc($payment_month)) {
                ?>
                <input type="text" name="month" id="month" 
                value="<?= $months[plus_one_month($payment['tgl_dibayar'], "m")] ?>" disabled>
            <?php
            }
          } else {
            ?>
            <input type="text" name="month" id="month" 
            value="<?= $months[first_period($first_period, "m")] ?>" disabled>
            <?php
          }
          ?>
        </div>
        <div class="flex mt-16">
          <label for="year">Tahun SPP</label>
          <?php
          if (mysqli_num_rows($payment_year) > 0) {
            while ($payment = mysqli_fetch_assoc($payment_year)) {
                ?>
                <input type="hidden" name="date_paid" id="date_paid" 
                  value="<?= date_one_month($payment['tgl_dibayar']) ?>">
                <input type="text" name="year" id="year" 
                  value="<?= plus_one_month($payment['tgl_dibayar'], "Y") ?>" disabled>
            <?php
            }
          } else {
            ?>
            <input type="hidden" name="date_paid" id="date_paid" 
              value="<?= $first_period ?>">
            <input type="text" name="year" id="year" 
              value="<?= first_period($first_period, "Y") ?>" disabled>
            <?php
          }
          ?>
        </div>
        <input type="hidden" id="tuition_id">
        <div class="flex mt-16">
          <label for="tuition">Nominal</label>
          <input type="number" name="tuition" id="tuition" disabled>
        </div>
        <div class="flex mt-32">
          <label for=""></label>
          <button type="submit" id="pay" tabindex="8">Bayar</button>
        </div>
      </div>
    </article>
  </main>
</body>
<script src="<?= $javascript ?>/officer/payment.js"></script>
<script src="<?= $javascript ?>/utilities.js"></script>

</html>