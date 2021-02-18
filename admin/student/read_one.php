<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Include Files
include_once '../config/database.php';
include_once '../objects/student.php';

// Get DB Connection
$database = new Database();
$db = $database->getConnection();

// Prepare Object
$student = new Student($db);

// Set ID Props of Record to Read
$student->nisn = isset($_GET['nisn']) ? $_GET['nisn'] : die();

// Read Details
$student->readOne();

if ($student->nisn != null) {
  // Create Array
  $student_arr = array(
    "nisn" => $student->nisn,
    "nis" => $student->nis,
    "nama" => $student->nama,
    "nama_kelas" => $student->nama_kelas,
    "alamat" => $student->alamat,
    "no_telp" => $student->no_telp,
    "tahun_spp" => $student->tahun_spp,
    "jumlah_spp" => $student->jumlah_spp
  );

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Create JSON
  echo json_encode($student_arr);
}