<?php
class Payment
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
}
