<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include Files
include_once '../config/database.php';
include_once '../objects/payment.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$payment = new Payment($db);

// Get ID of Object to be Edited
$data = json_decode(file_get_contents("php://input"));

// Set ID Props of Object to be Edited
$payment->payment_id = $data->payment_id;

// Set Object's Props Values
$payment->administrator_id = $data->administrator_id;
$payment->nisn = $data->nisn;
$payment->payment_date = $data->payment_date;
$payment->payment_month = $data->payment_month;
$payment->payment_year = $data->payment_year;
$payment->tuition_id = $data->tuition_id;
$payment->payment_total = $data->payment_total;

// Update Object Data
if ($payment->update()) {
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Tell the User
  echo json_encode(array("message" => "Entry Pembayaran telah diupdate!"));
} else {
  // If Unable
  // Set Response Code - 503 'Service Unavailable'
  http_response_code(503);

  // Tell the User
  echo json_encode(array("message" => "Entry Pembayaran gagal diupdate!"));
}
