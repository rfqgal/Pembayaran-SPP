<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// Get DB Connection
include_once '../config/database.php';
include_once '../objects/student.php';

$database = new Database();
$db = $database->getConnection();

$student = new Student($db);

// Get Posted Data
$data = json_decode(file_get_contents("php://input"));

// Make sure data is not empty!
if (
  !empty($data->nisn) &&
  !empty($data->nis) &&
  !empty($data->nama) &&
  !empty($data->id_kelas) &&
  !empty($data->alamat) &&
  !empty($data->no_telp) &&
  !empty($data->id_spp)
) {
  // Set Object Props Values
  $student->nisn = $data->nisn;
  $student->nis = $data->nis;
  $student->nama = $data->nama;
  $student->id_kelas = $data->id_kelas;
  $student->alamat = $data->alamat;
  $student->no_telp = $data->no_telp;
  $student->id_spp = $data->id_spp;

  // Create Student Account
  if ($student->store()) {
    // Set Response Code - 201 'Created'
    http_response_code(201);

    // Tell the user
    echo json_encode(array("message" => "Akun siswa telah berhasil dibuat!"));
  } else {
    // If unable to create the product
    // Set Response Code - 503 'Service Unavailable'
    http_response_code(503);

    // Tell the user
    echo json_encode(array("message" => "Akun siswa gagal dibuat!"));
  }
} else {
  // If data is incomplete
  // Set Response Code - 400 'Bad Request'
  http_response_code(400);

  // Tell the user
  echo json_encode(array("message" => "Akun siswa gagal dibuat. Data belum lengkap!"));
}
