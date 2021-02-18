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
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
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

  function store()
  {
    // Query Insert
    $query = "INSERT INTO siswa SET
      nisn=:nisn, nis=:nis, nama=:nama, id_kelas=:id_kelas, alamat=:alamat, no_telp=:no_telp, id_spp=:id_spp";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->nisn = htmlspecialchars(strip_tags($this->nisn));
    $this->nis = htmlspecialchars(strip_tags($this->nis));
    $this->nama = htmlspecialchars(strip_tags($this->nama));
    $this->id_kelas = htmlspecialchars(strip_tags($this->id_kelas));
    $this->alamat = htmlspecialchars(strip_tags($this->alamat));
    $this->no_telp = htmlspecialchars(strip_tags($this->no_telp));
    $this->id_spp = htmlspecialchars(strip_tags($this->id_spp));

    // Bind Values
    $stmt->bindParam(":nisn", $this->nisn);
    $stmt->bindParam(":nis", $this->nis);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":id_kelas", $this->id_kelas);
    $stmt->bindParam(":alamat", $this->alamat);
    $stmt->bindParam(":no_telp", $this->no_telp);
    $stmt->bindParam(":id_spp", $this->id_spp);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
