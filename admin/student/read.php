<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database and Object
include_once '../config/database.php';
include_once '../objects/student.php';

// Instantiate Database and Product Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$student = new Student($db);

// Student's Query
$stmt = $student->read();
$num = $stmt->rowCount();

// Check Rows Count
if ($num > 0) {
  // Students Array
  $students = array();
  $students['records'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract rows to make $row['name'] to just $name only
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

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students Data in JSON Format
  echo json_encode($students);
} else {
  // If no data
  http_response_code(404);

  // Tell the user
  echo json_encode(
    array("message" => "No data found :(")
  );
}
?>