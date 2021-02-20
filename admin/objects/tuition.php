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
      id_spp=:id_spp, tahun=:tahun, nominal=:nominal
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->year = htmlspecialchars(strip_tags($this->year));
    $this->fee = htmlspecialchars(strip_tags($this->fee));

    // Bind Values
    $stmt->bindParam(":id_spp", $this->id);
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
}
