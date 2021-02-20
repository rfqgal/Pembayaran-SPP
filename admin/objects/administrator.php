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

  function store()
  {
    // Query Insert
    $query = "INSERT INTO petugas SET
      id_petugas=:id_petugas, username=:username, password=:password,
      nama_petugas=:nama_petugas, level=:level
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->id = htmlspecialchars(strip_tags($this->id));
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = htmlspecialchars(strip_tags(md5($this->password)));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->level = htmlspecialchars(strip_tags($this->level));

    // Bind Values
    $stmt->bindParam(":id_petugas", $this->id);
    $stmt->bindParam(":username", $this->username);
    $stmt->bindParam(":password", $this->password);
    $stmt->bindParam(":nama_petugas", $this->name);
    $stmt->bindParam(":level", $this->level);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }
}
