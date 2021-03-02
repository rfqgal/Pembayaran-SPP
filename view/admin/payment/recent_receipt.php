<?php
session_start();
include('../../route.php');
$conn = mysqli_connect("localhost", "root", "", "pra-ukk");

if (@$_SESSION['level'] != "admin") {
  echo "
    <script>
      alert('Anda tidak memiliki akses di halaman ini!');
      window.location.href = '$login';
    </script>
  ";
}

$query = "SELECT * FROM pembayaran
  INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
  INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
  INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
  INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
  ORDER BY id_pembayaran DESC
  LIMIT 0, 1
";
$read = mysqli_query($conn, $query);
@$transaction = mysqli_fetch_assoc($read);
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>
    Riwayat Pembayaran SPP
    <?=
    $transaction['nama'] . " " . $transaction['tahun_dibayar'] .
      "/" . ($transaction['tahun_dibayar'] + 1)
    ?>
  </title>
  <link rel="stylesheet" href="<?= $css ?>">
</head>

<body>
  <main class="print">
    <article>
      <h1 class="t-center">SMK Negeri 1 Kepanjen</h1>
      <h1 class="t-center mt-4">Pembayaran SPPku</h1>
      <hr class="header">
      <div class="mt-12">
        <p>Kwitansi Pembayaran</p>
      </div>
      <table class="no-border mt-12 w-100">
        <tr>
          <td style="width: 20%;">Nama</td>
          <td style="width: 4%;">:</td>
          <td><?= $transaction['nama'] ?></td>
        </tr>
        <tr>
          <td style="width: 20%;">Kelas</td>
          <td style="width: 4%;">:</td>
          <td><?= $transaction['nama_kelas'] ?></td>
        </tr>
      </table>
      <div class="mt-12">
        <p>Rincian</p>
      </div>
      <hr>
      <table class="no-border mt-8 w-100">
        <tr>
          <td style="width: 20%;">Bulan</td>
          <td style="width: 4%;">:</td>
          <td><?= $transaction['bulan_dibayar'] ?></td>
        </tr>
        <tr>
          <td style="width: 20%;">Tahun</td>
          <td style="width: 4%;">:</td>
          <td><?= $transaction['tahun_dibayar'] ?></td>
        </tr>
        <tr>
          <td style="width: 20%;">Jumlah Pembayaran</td>
          <td style="width: 4%;">:</td>
          <td><?= "Rp. ".number_format($transaction['jumlah_bayar'],0,',','.') ?></td>
        </tr>
      </table>
      <hr>
      <table class="no-border mt-12 w-100">
        <tr>
          <td style="width: 20%;">Tanggal Pembayaran</td>
          <td style="width: 4%;">:</td>
          <td><?= date("d-m-Y", strtotime($transaction['tgl_bayar'])) ?></td>
        </tr>
      </table>
      <br><br>
      <div class="flex">
        <div class="right mt-16">
          <p>Kepanjen, ..........................................</p>
          <br><br><br><br><br><br><br>
          <hr>
        </div>
      </div>
    </article>
  </main>
</body>

<script src="<?= $javascript ?>/utilities.js"></script>
<script>
  window.print();
</script>

</html>