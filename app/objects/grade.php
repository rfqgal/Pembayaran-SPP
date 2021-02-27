<?php
class Grade
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $id;
  public $name;
  public $grade;
  public $major;
  public $alma_mater;

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
      nama_kelas=:nama_kelas, kelas=:kelas,
      kompetensi_keahlian=:kompetensi_keahlian, almamater=:almamater
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->grade = htmlspecialchars(strip_tags($this->grade));
    $this->major = htmlspecialchars(strip_tags($this->major));
    $this->alma_mater = htmlspecialchars(strip_tags($this->alma_mater));

    // Bind Values
    $stmt->bindParam(":nama_kelas", $this->name);
    $stmt->bindParam(":kelas", $this->grade);
    $stmt->bindParam(":kompetensi_keahlian", $this->major);
    $stmt->bindParam(":almamater", $this->alma_mater);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function readOne()
  {
    // Query to Read One
    $query = "SELECT * FROM kelas
      WHERE id_kelas = ?
      LIMIT 0,1
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Bind ID of Grade to be Updated
    $stmt->bindParam(1, $this->id);

    // Execute Query
    $stmt->execute();

    // Get Retrieved Row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set Values to Object Props
    $this->id = $row['id_kelas'];
    $this->name = $row['nama_kelas'];
    $this->grade = $row['kelas'];
    $this->major = $row['kompetensi_keahlian'];
    $this->alma_mater = $row['almamater'];
  }

  function update()
  {
    // Update Query
    $query = "UPDATE kelas SET 
      nama_kelas=:nama_kelas, kelas=:kelas,
      kompetensi_keahlian=:kompetensi_keahlian,
      almamater=:almamater
      WHERE id_kelas=:id_kelas
    ";
    
    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->grade = htmlspecialchars(strip_tags($this->grade));
    $this->major = htmlspecialchars(strip_tags($this->major));
    $this->alma_mater = htmlspecialchars(strip_tags($this->alma_mater));
    
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind New Values
    $stmt->bindParam(":nama_kelas", $this->name);
    $stmt->bindParam(":kelas", $this->grade);
    $stmt->bindParam(":kompetensi_keahlian", $this->major);
    $stmt->bindParam(":almamater", $this->alma_mater);

    $stmt->bindParam(":id_kelas", $this->id);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function delete()
  {
    // Delete Query
    $query = "DELETE FROM kelas WHERE id_kelas = ?";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->id = htmlspecialchars(strip_tags($this->id));
    
    // Bind ID of Record to Delete
    $stmt->bindParam(1, $this->id);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function search($keywords)
  {
    // Query Read
    $query = "SELECT * FROM kelas
      WHERE nama_kelas LIKE ?
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $keywords = htmlspecialchars(strip_tags($keywords));
    $keywords = "%$keywords%";

    // Bind
    $stmt->bindParam(1, $keywords);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }

  public function readPaging($from_record_num, $records_per_page)
  {
    // Select Query
    $query = "SELECT * FROM kelas
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
    $query = "SELECT COUNT(*) as total_rows FROM kelas";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
}
