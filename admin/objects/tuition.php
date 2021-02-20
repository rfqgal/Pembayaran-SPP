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
}
