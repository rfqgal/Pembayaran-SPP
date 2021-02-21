<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database and Object
include_once '../config/database.php';
include_once '../objects/tuition.php';

// Instantiate Database and Product Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$tuition = new Tuition($db);

// Object's Query
$stmt = $tuition->read();
$num = $stmt->rowCount();

// Check Rows Count
if ($num > 0) {
  // Object's Array
  $tuitions = array();
  $tuitions['records'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract rows to make $row['name'] to just $name only
    extract($row);

    $tuition_arr = array(
      "id" => $id_spp,
      "year" => $tahun,
      "fee" => $nominal
    );

    array_push($tuitions['records'], $tuition_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Object's Data in JSON Format
  echo json_encode($tuitions);
} else {
  // If no data
  http_response_code(404);

  // Tell the user
  echo json_encode(
    array("message" => "SPP tidak ditemukan :(")
  );
}
?>