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
  public $nama_kelas;
  public $alamat;
  public $no_telp;
  public $id_spp;
  public $tahun_spp;
  public $jumlah_spp;

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
      INNER JOIN spp ON siswa.id_spp = spp.id_spp
    ";

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
      nisn=:nisn, nis=:nis, nama=:nama, id_kelas=:id_kelas, 
      alamat=:alamat, no_telp=:no_telp, id_spp=:id_spp
    ";

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

  function readOne()
  {
    // Query to Read One
    $query = "SELECT * FROM siswa
      INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
      INNER JOIN spp ON siswa.id_spp = spp.id_spp
      WHERE siswa.nisn = ?
      LIMIT 0,1
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Bind ID of Student to be Updated
    $stmt->bindParam(1, $this->nisn);

    // Execute Query
    $stmt->execute();

    // Get Retrieved Row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set Values to Object Props
    $this->nisn = $row['nisn'];
    $this->nis = $row['nis'];
    $this->nama = $row['nama'];
    $this->nama_kelas = $row['nama_kelas'];
    $this->alamat = $row['alamat'];
    $this->no_telp = $row['no_telp'];
    $this->tahun_spp = $row['tahun'];
    $this->jumlah_spp = $row['nominal'];
  }

  function update()
  {
    // Update Query
    $query = "UPDATE siswa SET
      nis=:nis, nama=:nama, id_kelas=:id_kelas, 
      alamat=:alamat, no_telp=:no_telp, id_spp=:id_spp
      WHERE nisn=:nisn
    ";
    
    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->nis = htmlspecialchars(strip_tags($this->nis));
    $this->nama = htmlspecialchars(strip_tags($this->nama));
    $this->id_kelas = htmlspecialchars(strip_tags($this->id_kelas));
    $this->alamat = htmlspecialchars(strip_tags($this->alamat));
    $this->no_telp = htmlspecialchars(strip_tags($this->no_telp));
    $this->id_spp = htmlspecialchars(strip_tags($this->id_spp));
    
    $this->nisn = htmlspecialchars(strip_tags($this->nisn));

    // Bind New Values
    $stmt->bindParam(":nis", $this->nis);
    $stmt->bindParam(":nama", $this->nama);
    $stmt->bindParam(":id_kelas", $this->id_kelas);
    $stmt->bindParam(":alamat", $this->alamat);
    $stmt->bindParam(":no_telp", $this->no_telp);
    $stmt->bindParam(":id_spp", $this->id_spp);

    $stmt->bindParam(":nisn", $this->nisn);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function delete()
  {
    // Delete Query
    $query = "DELETE FROM siswa WHERE nisn = ?";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->nisn = htmlspecialchars(strip_tags($this->nisn));
    
    // Bind ID of Record to Delete
    $stmt->bindParam(1, $this->nisn);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function search($keywords)
  {
    // Query Read
    $query = "SELECT * FROM siswa
      INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
      INNER JOIN spp ON siswa.id_spp = spp.id_spp
      WHERE siswa.nama LIKE ? OR kelas.nama_kelas LIKE ?
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%$keywords%";

    // Bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}
