<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/tuition.php';

// Instantiate DB and Students Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$tuition = new Tuition($db);

// Get Keywords
$keywords = isset($_GET['search']) ? $_GET['search'] : "";

// Query Students
$stmt = $tuition->search($keywords);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Students Array
  $tuitions = array();
  $tuitions["records"] = array();
  
  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Rows
    extract($row);

    $tuition_arr = array(
      "id" => $id_spp,
      "year" => $tahun,
      "fee" => $nominal
    );

    array_push($tuitions["records"], $tuition_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students
  echo json_encode($tuitions);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("mesage" => "SPP tidak ditemukan!"));
}