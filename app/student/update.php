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

// Get ID of Student to be Edited
$data = json_decode(file_get_contents("php://input"));

// Set ID Props of Student to be Edited
$student->nisn = $data->nisn;

// Set Student's Props Values
$student->nis = $data->nis;
$student->name = $data->name;
$student->grade_id = $data->grade_id;
$student->address = $data->address;
$student->phone = $data->phone;
$student->tuition_id = $data->tuition_id;

// Update Students Data
if ($student->update()) {
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Tell the User
  echo json_encode(array("message" => "Akun telah diupdate!"));
} else {
  // If Unable
  // Set Response Code - 503 'Service Unavailable'
  http_response_code(503);

  // Tell the User
  echo json_encode(array("message" => "Akun gagal diupdate!"));
}