<?php
class Student
{
  // Connection and Table Name
  private $conn;
  private $tb_name = "siswa";

  // Object Props
  public $nisn;
  public $nis;
  public $nama;
  public $id_kelas;
  public $alamat;
  public $no_telp;
  public $id_spp;

  // Constructor with $db as DB Connection
  public function __contruct($db) {
    $this->conn = $db;
  }

  function read() {
    // Select All Query
    $query = "SELECT * FROM" . $this->tb_name . " 
      INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
      INNER JOIN spp ON siswa.id_spp = spp.id_spp";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}