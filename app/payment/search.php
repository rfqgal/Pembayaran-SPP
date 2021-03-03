<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/payment.php';

// Instantiate DB and Students Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$payment = new Payment($db);

// Get Keywords
$keywords = isset($_GET['search']) ? $_GET['search'] : "";

// Query Students
$stmt = $payment->search($keywords);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Students Array
  $payments = array();
  $payments["records"] = array();
  
  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Rows
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

    array_push($payments["records"], $payment_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students
  echo json_encode($payments);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("mesage" => "Entry Pembayaran tidak ditemukan!"));
}