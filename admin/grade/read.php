<?php
// Required Headers
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// Include Database and Object
include_once '../config/database.php';
include_once '../objects/grade.php';

// Instantiate Database and Product Object
$database = new Database();
$db = $database->getConnection();

// Initialize Object
$grade = new Grade($db);

// Student's Query
$stmt = $grade->read();
$num = $stmt->rowCount();

// Check Rows Count
if ($num > 0) {
  // Students Array
  $grades = array();
  $grades['records'] = array();

  // Retrieve Table Contents
  while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
    // Extract rows to make $row['name'] to just $name only
    extract($row);

    $grade_arr = array(
      "id" => $id_kelas,
      "grade" => $nama_kelas,
      "major" => $kompetensi_keahlian
    );

    array_push($grades['records'], $grade_arr);
  }

  // Set Response Code - 200 'OK'
  http_response_code(200);

  // Show Students Data in JSON Format
  echo json_encode($grades);
} else {
  // If no data
  http_response_code(404);

  // Tell the user
  echo json_encode(
    array("message" => "Kelas tidak ditemukan :(")
  );
}
?>