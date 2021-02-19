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

  function store()
  {
    // Query Insert
    $query = "INSERT INTO kelas SET
      id_kelas=:id_kelas, nama_kelas=:nama_kelas, kompetensi_keahlian=:kompetensi_keahlian
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->id_kelas = htmlspecialchars(strip_tags($this->id_kelas));
    $this->nama_kelas = htmlspecialchars(strip_tags($this->nama_kelas));
    $this->kompetensi_keahlian = htmlspecialchars(strip_tags($this->kompetensi_keahlian));

    // Bind Values
    $stmt->bindParam(":id_kelas", $this->id_kelas);
    $stmt->bindParam(":nama_kelas", $this->nama_kelas);
    $stmt->bindParam(":kompetensi_keahlian", $this->kompetensi_keahlian);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
