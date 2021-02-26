<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/student.php';

// Instantiate DB and Students Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$student = new Student($db);

// Get Keywords
$keywords = isset($_GET['search']) ? $_GET['search'] : "";

// Query Students
$stmt = $student->search($keywords);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Students Array
  $students = array();
  $students["records"] = array();
  
  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Rows
    extract($row);

    $student_arr = array(
      "nisn" => $nisn,
      "nis" => $nis,
      "name" => $nama,
      "grade" => $nama_kelas." ".$kompetensi_keahlian." ".$almamater,
      "address" => html_entity_decode($alamat),
      "phone" => $no_telp,
      "tuition" => $nominal
    );

    array_push($students["records"], $student_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students
  echo json_encode($students);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("mesage" => "Akun siswa tidak ditemukan!"));
}