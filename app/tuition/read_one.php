<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include Files
include_once '../config/database.php';
include_once '../objects/tuition.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$tuition = new Tuition($db);

// Set ID Props of Record to Read
$tuition->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read Details
$tuition->readOne();

if ($tuition->id != null) {
  // Create Array
  $tuition_arr = array(
    "id" => $tuition->id,
    "year" => $tuition->year,
    "fee" => $tuition->fee
  );

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Create JSON
  echo json_encode($tuition_arr);
}