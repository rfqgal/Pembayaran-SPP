<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include Files
include_once '../config/database.php';
include_once '../objects/payment.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$payment = new Payment($db);

// Set ID Props of Record to Read
$payment->payment_id = isset($_GET['id']) ? $_GET['id'] : die();

// Read Details
$payment->readOne();

if ($payment->payment_id != null) {
  // Create Array
  $payment_arr = array(
    "payment_id" => $payment->payment_id,
    "administrator_id" => $payment->administrator_id,
    "administrator_name" => $payment->administrator_name,
    "nisn" => $payment->nisn,
    "student_name" => $payment->student_name,
    "payment_date" => $payment->payment_date,
    "month_paid" => $payment->payment_month,
    "year_paid" => $payment->payment_year,
    "tuition_id" => $payment->tuition_id,
    "tuition_fee" => $payment->tuition_fee,
    "payment_total" => $payment->payment_total
  );

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Create JSON
  echo json_encode($payment_arr);
}