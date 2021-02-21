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

// Get Object's ID
$data = json_decode(file_get_contents('php://input'));

// Set Object's ID to be Deleted
$payment->payment_id = $data->payment_id;

// Delete Object
if ($payment->delete()) {
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Tell the User
  echo json_encode(array("message" => "Entry Pembayaran telah dihapus!"));
} else {
  // Set Response Code - 503 'Service Unavailable'
  http_response_code(503);

  // Tell the User
  echo json_encode(array("message" => "Entry Pembayaran gagal dihapus!"));
}