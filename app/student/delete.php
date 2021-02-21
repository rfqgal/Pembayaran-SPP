<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Include Files
include_once '../config/database.php';
include_once '../objects/student.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$student = new Student($db);

// Get Student's ID
$data = json_decode(file_get_contents('php://input'));

// Set Student's ID to be Deleted
$student->nisn = $data->nisn;

// Delete Student
if ($student->delete()) {
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Tell the User
  echo json_encode(array("message" => "Akun telah dihapus!"));
} else {
  // Set Response Code - 503 'Service Unavailable'
  http_response_code(503);

  // Tell the User
  echo json_encode(array("message" => "Akun gagal dihapus!"));
}