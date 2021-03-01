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
  WHERE pembayaran.nisn = '$_GET[nisn]'
";
$read = mysqli_query($conn, $query);

if (mysqli_num_rows($read) <= 12) {
  $query = "SELECT * FROM pembayaran
    INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
    INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
    INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
    INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    WHERE pembayaran.nisn = '$_GET[nisn]'
    ORDER BY pembayaran.id_pembayaran ASC
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
        <h1 class="t-center mt-4">Cetak Pembayaran SPPku</h1>
        <hr class="header">
        <div class="mt-12">
          <p>Assalamualaikum Wr. Wb.</p>
          <p>
            Berikut adalah laporan pembayaran SPP tahun ajaran <?= $transaction['tahun_dibayar'] . 
            "/" . ($transaction['tahun_dibayar'] + 1) ?> dari siswa yang dengan:
          </p>
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
          <tr>
            <td style="width: 20%;">Nominal SPP</td>
            <td style="width: 4%;">:</td>
            <td><?= $transaction['nominal'] ?></td>
          </tr>
        </table>
        <table class="print mt-16">
          <thead>
            <th style="width: 8%;">No</th>
            <th>Bulan SPP</th>
            <th>Tahun SPP</th>
            <th>Status</th>
          </thead>
          <tbody>
          <?php
          $query = "SELECT * FROM pembayaran
            INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
            INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
            INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
            INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE pembayaran.nisn = '$_GET[nisn]'
            LIMIT 0, 12
          ";
          $read = mysqli_query($conn, $query);
          for ($i = 1; $i <= 12; $i++) {
            $data = mysqli_fetch_assoc($read);

            $months = [
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
              'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
            ];
            $status = "Belum Lunas";

            if (!empty($data)) {
              $status = "Lunas";
            }
            
            if ($i < 7) {
              $year = $transaction['tahun_dibayar'];
            } else {
              $year = $transaction['tahun_dibayar'] + 1;
            }
            ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $months[($i - 1)] ?></td>
              <td><?= $year ?></td>
              <td><?= $status ?></td>
            </tr>
            <?php
          }
          ?>            
          </tbody>
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
  
  <script>
    window.print();
  </script>

  </html>
<?php
}
else if (mysqli_num_rows($read) > 12 && mysqli_num_rows($read) <= 24) {
  $query = "SELECT * FROM pembayaran
    INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
    INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
    INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
    INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    WHERE pembayaran.nisn = '$_GET[nisn]'
    ORDER BY pembayaran.id_pembayaran ASC
    LIMIT 12, 1
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
        <h1 class="t-center mt-4">Cetak Pembayaran SPPku</h1>
        <hr class="header">
        <div class="mt-12">
          <p>Assalamualaikum Wr. Wb.</p>
          <p>
            Berikut adalah laporan pembayaran SPP tahun ajaran <?= $transaction['tahun_dibayar'] . 
            "/" . ($transaction['tahun_dibayar'] + 1) ?> dari siswa yang dengan:
          </p>
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
          <tr>
            <td style="width: 20%;">Nominal SPP</td>
            <td style="width: 4%;">:</td>
            <td><?= $transaction['nominal'] ?></td>
          </tr>
        </table>
        <table class="print mt-16">
          <thead>
            <th style="width: 8%;">No</th>
            <th>Bulan SPP</th>
            <th>Tahun SPP</th>
            <th>Status</th>
          </thead>
          <tbody>
          <?php
          $query = "SELECT * FROM pembayaran
            INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
            INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
            INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
            INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE pembayaran.nisn = '$_GET[nisn]'
            LIMIT 12, 12
          ";
          $read = mysqli_query($conn, $query);
          for ($i = 1; $i <= 12; $i++) {
            $data = mysqli_fetch_assoc($read);

            $months = [
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
              'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
            ];
            $status = "Belum Lunas";

            if (!empty($data)) {
              $status = "Lunas";
            }
            
            if ($i < 7) {
              $year = $transaction['tahun_dibayar'];
            } else {
              $year = $transaction['tahun_dibayar'] + 1;
            }
            ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $months[($i - 1)] ?></td>
              <td><?= $year ?></td>
              <td><?= $status ?></td>
            </tr>
            <?php
          }
          ?>            
          </tbody>
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

  <script>
    window.print();
  </script>
  
  </html>
<?php
}
else if (mysqli_num_rows($read) > 24 && mysqli_num_rows($read) <= 36) {
  $query = "SELECT * FROM pembayaran
    INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
    INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
    INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
    INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
    WHERE pembayaran.nisn = '$_GET[nisn]'
    ORDER BY pembayaran.id_pembayaran ASC
    LIMIT 12, 1
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
        <h1 class="t-center mt-4">Cetak Pembayaran SPPku</h1>
        <hr class="header">
        <div class="mt-12">
          <p>Assalamualaikum Wr. Wb.</p>
          <p>
            Berikut adalah laporan pembayaran SPP tahun ajaran <?= $transaction['tahun_dibayar'] . 
            "/" . ($transaction['tahun_dibayar'] + 1) ?> dari siswa yang dengan:
          </p>
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
          <tr>
            <td style="width: 20%;">Nominal SPP</td>
            <td style="width: 4%;">:</td>
            <td><?= $transaction['nominal'] ?></td>
          </tr>
        </table>
        <table class="print mt-16">
          <thead>
            <th style="width: 8%;">No</th>
            <th>Bulan SPP</th>
            <th>Tahun SPP</th>
            <th>Status</th>
          </thead>
          <tbody>
          <?php
          $query = "SELECT * FROM pembayaran
            INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
            INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
            INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
            INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
            WHERE pembayaran.nisn = '$_GET[nisn]'
            LIMIT 12, 12
          ";
          $read = mysqli_query($conn, $query);
          for ($i = 1; $i <= 12; $i++) {
            $data = mysqli_fetch_assoc($read);

            $months = [
              'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
              'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni'
            ];
            $status = "Belum Lunas";

            if (!empty($data)) {
              $status = "Lunas";
            }
            
            if ($i < 7) {
              $year = $transaction['tahun_dibayar'];
            } else {
              $year = $transaction['tahun_dibayar'] + 1;
            }
            ?>
            <tr>
              <td><?= $i ?></td>
              <td><?= $months[($i - 1)] ?></td>
              <td><?= $year ?></td>
              <td><?= $status ?></td>
            </tr>
            <?php
          }
          ?>            
          </tbody>
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
  
  <script>
    window.print();
  </script>

  </html>
<?php
} 
?>