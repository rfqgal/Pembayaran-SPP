<?php
class Student
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $nisn;
  public $nis;
  public $name;
  public $grade_id;
  public $grade_name;
  public $address;
  public $phone;
  public $tuition_id;
  public $tuition_year;
  public $tuition_fee;

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
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->grade_id = htmlspecialchars(strip_tags($this->grade_id));
    $this->address = htmlspecialchars(strip_tags($this->address));
    $this->phone = htmlspecialchars(strip_tags($this->phone));
    $this->tuition_id = htmlspecialchars(strip_tags($this->tuition_id));

    // Bind Values
    $stmt->bindParam(":nisn", $this->nisn);
    $stmt->bindParam(":nis", $this->nis);
    $stmt->bindParam(":nama", $this->name);
    $stmt->bindParam(":id_kelas", $this->grade_id);
    $stmt->bindParam(":alamat", $this->address);
    $stmt->bindParam(":no_telp", $this->phone);
    $stmt->bindParam(":id_spp", $this->tuition_id);

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
    $this->name = $row['nama'];
    $this->grade_id = $row['id_kelas'];
    $this->grade_name = $row['nama_kelas'];
    $this->address = $row['alamat'];
    $this->phone = $row['no_telp'];
    $this->tuition_id = $row['id_spp'];
    $this->tuition_fee = $row['nominal'];
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
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->grade_id = htmlspecialchars(strip_tags($this->grade_id));
    $this->address = htmlspecialchars(strip_tags($this->address));
    $this->phone = htmlspecialchars(strip_tags($this->phone));
    $this->tuition_id = htmlspecialchars(strip_tags($this->tuition_id));
    
    $this->nisn = htmlspecialchars(strip_tags($this->nisn));

    // Bind New Values
    $stmt->bindParam(":nis", $this->nis);
    $stmt->bindParam(":nama", $this->name);
    $stmt->bindParam(":id_kelas", $this->grade_id);
    $stmt->bindParam(":alamat", $this->address);
    $stmt->bindParam(":no_telp", $this->phone);
    $stmt->bindParam(":id_spp", $this->tuition_id);

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
      WHERE siswa.nisn LIKE ? OR siswa.nis LIKE ?
      OR siswa.nama LIKE ? OR kelas.nama_kelas LIKE ?
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%$keywords%";

    // Bind
    $stmt->bindParam(1, $keywords);
    $stmt->bindParam(2, $keywords);
    $stmt->bindParam(3, $keywords);
    $stmt->bindParam(4, $keywords);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }

  public function readPaging($from_record_num, $records_per_page)
  {
    // Select Query
    $query = "SELECT * FROM siswa
      INNER JOIN kelas ON siswa.id_kelas = kelas.id_kelas
      INNER JOIN spp ON siswa.id_spp = spp.id_spp
      LIMIT ?, ?
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Bind Variable Values
    $stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
    $stmt->bindParam(2, $records_per_page, PDO::PARAM_INT);

    // Execute Query
    $stmt->execute();

    // Return Values from DB
    return $stmt;
  }

  public function count()
  {
    $query = "SELECT COUNT(*) as total_rows FROM siswa";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
}
