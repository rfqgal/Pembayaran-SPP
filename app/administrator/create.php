<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get DB Connection
include_once '../config/database.php';
include_once '../objects/administrator.php';

$database = new Database();
$db = $database->getConnection();

$administrator = new Administrator($db);

// Get Posted Data
$data = json_decode(file_get_contents("php://input"));

// Make sure data is not empty!
if (
  !empty($data->username) &&
  !empty($data->password) &&
  !empty($data->name) &&
  !empty($data->level) 
) {
  // Set Object Props Values
  $administrator->username = $data->username;
  $administrator->password = $data->password;
  $administrator->name = $data->name;
  $administrator->level = $data->level;

  // Create Admin Account
  if ($administrator->store()) {
    // Set Response Code - 201 'Created'
    http_response_code(201);

    // Tell the user
    echo json_encode(array("message" => "Petugas telah berhasil dibuat!"));
  } else {
    // If unable to create the product
    // Set Response Code - 503 'Service Unavailable'
    http_response_code(503);

    // Tell the user
    echo json_encode(array("message" => "Petugas gagal dibuat!"));
  }
} else {
  // If data is incomplete
  // Set Response Code - 400 'Bad Request'
  http_response_code(400);

  // Tell the user
  echo json_encode(array("message" => "Petugas gagal dibuat. Data belum lengkap!"));
}
