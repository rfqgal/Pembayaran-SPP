<?php
class Payment
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $payment_id;
  public $administrator_id;
  public $administrator_name;
  public $nisn;
  public $student_name;
  public $payment_date;
  public $payment_month;
  public $payment_year;
  public $tuition_id;
  public $tuition_fee;
  public $payment_total;

  // Constructor with $db as DB Connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
    // Select All Query
    $query = "SELECT * FROM pembayaran
      INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
      INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
      INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}
