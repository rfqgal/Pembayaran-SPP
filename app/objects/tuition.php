<?php
class Tuition
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $id;
  public $year;
  public $fee;

  // Constructor with $db as DB Connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
    // Select All Query
    $query = "SELECT * FROM spp";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }

  function store()
  {
    // Query Insert
    $query = "INSERT INTO spp SET
      tahun=:tahun, nominal=:nominal
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->year = htmlspecialchars(strip_tags($this->year));
    $this->fee = htmlspecialchars(strip_tags($this->fee));

    // Bind Values
    $stmt->bindParam(":tahun", $this->year);
    $stmt->bindParam(":nominal", $this->fee);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function readOne()
  {
    // Query to Read One
    $query = "SELECT * FROM spp
      WHERE id_spp = ?
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
    $this->id = $row['id_spp'];
    $this->year = $row['tahun'];
    $this->fee = $row['nominal'];
  }

  function update()
  {
    // Update Query
    $query = "UPDATE spp SET
      tahun=:tahun, nominal=:nominal
      WHERE id_spp=:id_spp
    ";
    
    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->year = htmlspecialchars(strip_tags($this->year));
    $this->fee = htmlspecialchars(strip_tags($this->fee));
    
    $this->id = htmlspecialchars(strip_tags($this->id));

    // Bind New Values
    $stmt->bindParam(":tahun", $this->year);
    $stmt->bindParam(":nominal", $this->fee);

    $stmt->bindParam(":id_spp", $this->id);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function delete()
  {
    // Delete Query
    $query = "DELETE FROM spp WHERE id_spp = ?";

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
    $query = "SELECT * FROM spp
      WHERE tahun LIKE ? OR nominal LIKE ? OR id_spp LIKE ?
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

    // Execute Query
    $stmt->execute();

    return $stmt;
  }

  public function readPaging($from_record_num, $records_per_page)
  {
    // Select Query
    $query = "SELECT * FROM spp
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
    $query = "SELECT COUNT(*) as total_rows FROM spp";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
}
