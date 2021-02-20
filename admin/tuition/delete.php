<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include Files
include_once '../config/database.php';
include_once '../objects/tuition.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$tuition = new Tuition($db);

// Get Object's ID
$data = json_decode(file_get_contents('php://input'));

// Set Object's ID to be Deleted
$tuition->id = $data->id;

// Delete Object
if ($tuition->delete()) {
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Tell the User
  echo json_encode(array("message" => "SPP telah dihapus!"));
} else {
  // Set Response Code - 503 'Service Unavailable'
  http_response_code(503);

  // Tell the User
  echo json_encode(array("message" => "SPP gagal dihapus!"));
}