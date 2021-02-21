<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database and Object
include_once '../config/database.php';
include_once '../objects/administrator.php';

// Instantiate Database and Product Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$administrator = new Administrator($db);

// Object's Query
$stmt = $administrator->read();
$num = $stmt->rowCount();

// Check Rows Count
if ($num > 0) {
  // Object's Array
  $administrators = array();
  $administrators['records'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract rows to make $row['name'] to just $name only
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

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Object's Data in JSON Format
  echo json_encode($administrators);
} else {
  // If no data
  http_response_code(404);

  // Tell the user
  echo json_encode(
    array("message" => "Petugas tidak ditemukan :(")
  );
}
?>