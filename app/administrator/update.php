<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include Files
include_once '../config/database.php';
include_once '../objects/administrator.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$administrator = new Administrator($db);

// Get ID of Object to be Edited
$data = json_decode(file_get_contents("php://input"));

if (
  !empty($data->username) &&
  !empty($data->name) &&
  !empty($data->level)
) {
  // Set ID Props of Object to be Edited
  $administrator->id = $data->id;

  // Set Object's Props Values
  $administrator->username = $data->username;
  $administrator->password = $data->password;
  $administrator->name = $data->name;
  $administrator->level = $data->level;

  // Update Object Data
  if ($administrator->update()) {
    // Set Response Code - 200 'OK'
    http_response_code(200);

    // Tell the User
    echo json_encode(array("message" => "Akun Petugas telah diupdate!"));
  } else {
    // If Unable
    // Set Response Code - 503 'Service Unavailable'
    http_response_code(503);

    // Tell the User
    echo json_encode(array("message" => "Akun Petugas gagal diupdate!"));
  }
} else {
  // If data is incomplete
  // Set Response Code - 400 'Bad Request'
  http_response_code(400);

  // Tell the user
  echo json_encode(array("message" => "Petugas gagal dibuat. Data belum lengkap!"));
}
