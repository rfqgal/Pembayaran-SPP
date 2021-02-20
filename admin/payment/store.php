<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get DB Connection
include_once '../config/database.php';
include_once '../objects/payment.php';

$database = new Database();
$db = $database->getConnection();

$payment = new Payment($db);

// Get Posted Data
$data = json_decode(file_get_contents("php://input"));

// Make sure data is not empty!
if (
  !empty($data->payment_id) &&
  !empty($data->administrator_id) &&
  !empty($data->nisn) &&
  !empty($data->payment_date) &&
  !empty($data->payment_month) && 
  !empty($data->payment_year) && 
  !empty($data->tuition_id) && 
  !empty($data->payment_total) 
) {
  // Set Object Props Values
  $payment->payment_id = $data->payment_id;
  $payment->administrator_id = $data->administrator_id;
  $payment->nisn = $data->nisn;
  $payment->payment_date = $data->payment_date;
  $payment->payment_month = $data->payment_month;
  $payment->payment_year = $data->payment_year;
  $payment->tuition_id = $data->tuition_id;
  $payment->payment_total = $data->payment_total;

  // Create Admin Account
  if ($payment->store()) {
    // Set Response Code - 201 'Created'
    http_response_code(201);

    // Tell the user
    echo json_encode(array("message" => "Entry Pembayaran telah berhasil dibuat!"));
  } else {
    // If unable to create the product
    // Set Response Code - 503 'Service Unavailable'
    http_response_code(503);

    // Tell the user
    echo json_encode(array("message" => "Entry Pembayaran gagal dibuat!"));
  }
} else {
  // If data is incomplete
  // Set Response Code - 400 'Bad Request'
  http_response_code(400);

  // Tell the user
  echo json_encode(array("message" => "Entry Pembayaran gagal dibuat. Data belum lengkap!"));
}
