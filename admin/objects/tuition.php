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
}
