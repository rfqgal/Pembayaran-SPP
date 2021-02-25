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
      username=:username, password=:password,
      nama_petugas=:nama_petugas, level=:level
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->username = htmlspecialchars(strip_tags($this->username));
    $this->password = md5(htmlspecialchars(strip_tags($this->password)));
    $this->name = htmlspecialchars(strip_tags($this->name));
    $this->level = htmlspecialchars(strip_tags($this->level));

    // Bind Values
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

  function readOne()
  {
    // Query to Read One
    $query = "SELECT * FROM petugas
      WHERE id_petugas = ?
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
    $this->id = $row['id_petugas'];
    $this->username = $row['username'];
    $this->password = $row['password'];
    $this->name = $row['nama_petugas'];
    $this->level = $row['level'];
  }

  function update()
  {
    if ($this->password != "") {
      // Update Query
      $query = "UPDATE petugas SET
        username=:username, password=:password,
        nama_petugas=:nama_petugas, level=:level
        WHERE id_petugas=:id_petugas
      ";
      
      // Prepare Query Statement
      $stmt = $this->conn->prepare($query);
  
      // Sanitize
      $this->username = htmlspecialchars(strip_tags($this->username));
      $this->password = md5(htmlspecialchars(strip_tags($this->password)));
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->level = htmlspecialchars(strip_tags($this->level));
      
      $this->id = htmlspecialchars(strip_tags($this->id));
  
      // Bind New Values
      $stmt->bindParam(":username", $this->username);
      $stmt->bindParam(":password", $this->password);
      $stmt->bindParam(":nama_petugas", $this->name);
      $stmt->bindParam(":level", $this->level);
  
      $stmt->bindParam(":id_petugas", $this->id);

    } else {
      // Update Query
      $query = "UPDATE petugas SET
        username=:username, nama_petugas=:nama_petugas, level=:level
        WHERE id_petugas=:id_petugas
      ";
      
      // Prepare Query Statement
      $stmt = $this->conn->prepare($query);
  
      // Sanitize
      $this->username = htmlspecialchars(strip_tags($this->username));
      $this->name = htmlspecialchars(strip_tags($this->name));
      $this->level = htmlspecialchars(strip_tags($this->level));
      
      $this->id = htmlspecialchars(strip_tags($this->id));
  
      // Bind New Values
      $stmt->bindParam(":username", $this->username);
      $stmt->bindParam(":nama_petugas", $this->name);
      $stmt->bindParam(":level", $this->level);
  
      $stmt->bindParam(":id_petugas", $this->id);
    }

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function delete()
  {
    // Delete Query
    $query = "DELETE FROM petugas WHERE id_petugas = ?";

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
    $query = "SELECT * FROM petugas
      WHERE username LIKE ? OR nama_petugas LIKE ? OR level LIKE ?
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
    $query = "SELECT * FROM petugas
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
    $query = "SELECT COUNT(*) as total_rows FROM petugas";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
}
