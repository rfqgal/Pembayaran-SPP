<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/payment.php';
include_once '../shared/utilities.php';

// Utilities
$utilities = new Utilities();

// Instantiate DB and Object
$database = new Database();
$db = $database->getConnection();

$payment = new Payment($db);

// Read Paging Queries
$stmt = $payment->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Student Array
  $payments = array();
  $payments['records'] = array();
  $payments['paging'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Row
    extract($row);

    $payment_arr = array(
      "payment_id" => $id_pembayaran,
      "administrator_id" => $id_petugas,
      "administrator_name" => $nama_petugas,
      "nisn" => $nisn,
      "student_name" => $nama,
      "payment_date" => $tgl_bayar,
      "payment_month" => $bulan_dibayar,
      "payment_year" => $tahun_dibayar,
      "tuition_id" => $id_spp,
      "tuition_fee" => $nominal,
      "payment_total" => $jumlah_bayar
    );

    array_push($payments['records'], $payment_arr);
  }

  // Include Paging
  $object_url = "payment";
  $total_rows = $payment->count(); 
  $page_url = "{$home_url}{$object_url}/read_paging.php?";
  $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
  $payments["paging"] = $paging;
  
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students Array
  echo json_encode($payments);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("message" => "Entry Pembayaran tidak ditemukan!"));
}