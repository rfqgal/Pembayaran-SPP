<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database and Object
include_once '../config/database.php';
include_once '../objects/payment.php';

// Instantiate Database and Product Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$payment = new Payment($db);

// Object's Query
$stmt = $payment->read();
$num = $stmt->rowCount();

// Check Rows Count
if ($num > 0) {
  // Object's Array
  $payments = array();
  $payments['records'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract rows to make $row['name'] to just $name only
    extract($row);

    $payment_arr = array(
      "payment_id" => $id_pembayaran,
      "administrator_id" => $id_petugas,
      "administrator_name" => $nama_petugas,
      "nisn" => $nisn,
      "student_name" => $nama,
      "payment_date" => $tgl_bayar,
      "month_paid" => $bulan_dibayar,
      "year_paid" => $tahun_dibayar,
      "tuition_id" => $id_spp,
      "tuition_fee" => $nominal,
      "payment_total" => $jumlah_bayar
    );

    array_push($payments['records'], $payment_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Object's Data in JSON Format
  echo json_encode($payments);
} else {
  // If no data
  http_response_code(404);

  // Tell the user
  echo json_encode(
    array("message" => "Petugas tidak ditemukan :(")
  );
}
?>