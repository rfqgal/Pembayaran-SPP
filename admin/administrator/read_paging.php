<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/administrator.php';
include_once '../shared/utilities.php';

// Utilities
$utilities = new Utilities();

// Instantiate DB and Object
$database = new Database();
$db = $database->getConnection();

$administrator = new Administrator($db);

// Read Paging Queries
$stmt = $administrator->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Student Array
  $administrators = array();
  $administrators['records'] = array();
  $administrators['paging'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Row
    extract($row);

    $administrator_arr = array(
      "id" => $id_petugas,
      "username" => $username,
      "password" => $password,
      "name" => $nama_petugas,
      "level" => $level
    );

    array_push($administrators['records'], $administrator_arr);
  }

  // Include Paging
  $object_url = "administrator";
  $total_rows = $administrator->count(); 
  $page_url = "{$home_url}{$object_url}/read_paging.php?";
  $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
  $administrators["paging"] = $paging;
  
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students Array
  echo json_encode($administrators);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("message" => "Petugas tidak ditemukan!"));
}