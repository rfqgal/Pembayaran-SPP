<?php
class Student
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $nisn;
  public $nis;
  public $nama;
  public $id_kelas;
  public $alamat;
  public $no_telp;
  public $id_spp;

  // Constructor with $db as DB Connection
  public function __construct($db) {
    $this->conn = $db;
  }

  function read() {
    // Select All Query
    $query = "SELECT * FROM siswa
      INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
      INNER JOIN spp ON siswa.id_spp = spp.id_spp";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}