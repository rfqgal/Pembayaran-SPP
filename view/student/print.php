<?php
session_start();
include('../route.php');

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
  <!-- Define User ID for Javascript -->
  <input type="text" name="userId" id="userId" value="<?= $_SESSION['id'] ?>" hidden>
  <main>
    <h1 class="t-center">Data Pembayaran</h1>
    <article>
      <div class="lists">
        <table id="listObjects">
          <tr class="thead">
            <th>NISN</th>
            <th>Nama Siswa</th>
            <th>Tanggal Bayar</th>
            <th>Bulan Bayar</th>
            <th>Tahun Bayar</th>
            <th>Nominal SPP</th>
            <th>Jumlah Bayar</th>
          </tr>
        </table>
      </div>
    </article>
  </main>
</body>
<script src="<?= $javascript ?>/student/read_payment.js"></script>

</html>