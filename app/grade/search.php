<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/grade.php';

// Instantiate DB and Students Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$grade = new Grade($db);

// Get Keywords
$keywords = isset($_GET['search']) ? $_GET['search'] : "";

// Query Students
$stmt = $grade->search($keywords);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Students Array
  $grades = array();
  $grades["records"] = array();
  
  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Rows
    extract($row);

    $grade_arr = array(
      "id" => $id_kelas,
      "name" => $nama_kelas,
      "grade" => $kelas,
      "major" => $kompetensi_keahlian,
      "alma_mater" => $almamater
    );

    array_push($grades["records"], $grade_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students
  echo json_encode($grades);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("mesage" => "Kelas siswa tidak ditemukan!"));
}