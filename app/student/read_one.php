<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include Files
include_once '../config/database.php';
include_once '../objects/student.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$student = new Student($db);

// Set ID Props of Record to Read
$student->nisn = isset($_GET['nisn']) ? $_GET['nisn'] : die();

// Read Details
$student->readOne();

if ($student->nisn != null) {
  // Students Array
  $students = array();
  $students["record"] = array();

  // Create Array
  $student_arr = array(
    "nisn" => $student->nisn,
    "nis" => $student->nis,
    "name" => $student->name,
    "grade_id" => $student->grade_id,
    "grade" => $student->grade_name,
    "address" => $student->address,
    "phone" => $student->phone,
    "tuition_id" => $student->tuition_id,
    "tuition" => $student->tuition_fee
  );  
  array_push($students['record'], $student_arr);

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Create JSON
  echo json_encode($students);
}