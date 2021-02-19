<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Files
include_once '../config/core.php';
include_once '../config/database.php';
include_once '../objects/student.php';
include_once '../shared/utilities.php';

// Utilities
$utilities = new Utilities();

// Instantiate DB and Object
$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

// Read Paging Queries
$stmt = $student->readPaging($from_record_num, $records_per_page);
$num = $stmt->rowCount();

// Check if more than 0 records found
if ($num > 0) {
  // Student Array
  $students = array();
  $students['records'] = array();
  $students['paging'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract Row
    extract($row);

    $student_arr = array(
      "nisn" => $nisn,
      "nis" => $nis,
      "nama" => $nama,
      "nama_kelas" => $nama_kelas,
      "alamat" => html_entity_decode($alamat),
      "no_telp" => $no_telp,
      "tahun_spp" => $tahun,
      "jumlah_spp" => $nominal
    );

    array_push($students['records'], $student_arr);
  }

  // Include Paging
  $total_rows = $student->count(); 
  $page_url = "{$home_url}student/read_paging.php?";
  $paging = $utilities->getPaging($page, $total_rows, $records_per_page, $page_url);
  $students["paging"] = $paging;
  
  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students Array
  echo json_encode($students);
} else {
  // Set Response Code - 404 'Not Found'
  http_response_code(404);

  // Tell the User
  echo json_encode(array("message" => "Akun tidak ditemukan!"));
}