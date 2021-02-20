<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include Files
include_once '../config/database.php';
include_once '../objects/administrator.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$administrator = new Administrator($db);

// Set ID Props of Record to Read
$administrator->id = isset($_GET['id']) ? $_GET['id'] : die();

// Read Details
$administrator->readOne();

if ($administrator->id != null) {
  // Create Array
  $administrator_arr = array(
    "id" => $administrator->id,
    "username" => $administrator->username,
    "password" => $administrator->password,
    "name" => $administrator->name,
    "level" => $administrator->level
  );

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Create JSON
  echo json_encode($administrator_arr);
}