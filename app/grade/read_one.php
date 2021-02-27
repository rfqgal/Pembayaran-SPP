<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include Files
include_once '../config/database.php';
include_once '../objects/grade.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$grade = new Grade($db);

// Set ID Props of Record to Read
$grade->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read Details
$grade->readOne();

if ($grade->id != null) {
  // Create Array
  $grade_arr = array(
    "id" => $grade->id,
    "name" => $grade->name,
    "grade" => $grade->grade,
    "major" => $grade->major,
    "alma_mater" => $grade->alma_mater
  );

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Create JSON
  echo json_encode($grade_arr);
}