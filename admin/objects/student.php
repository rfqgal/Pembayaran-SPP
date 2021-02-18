<?php
class Student {
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
  public function __contruct($db)
  {
    $this->conn = $db;
  }
}
?>