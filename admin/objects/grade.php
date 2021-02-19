<?php
class Grade
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $id_kelas;
  public $nama_kelas;
  public $kompetensi_keahlian;

  // Constructor with $db as DB Connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
    // Select All Query
    $query = "SELECT * FROM kelas";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}
