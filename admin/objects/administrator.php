<?php
class Administrator
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $id;
  public $username;
  public $password;
  public $name;
  public $level;

  // Constructor with $db as DB Connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
    // Select All Query
    $query = "SELECT * FROM petugas";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}
