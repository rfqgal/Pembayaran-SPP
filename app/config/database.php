<?php
class Database {
  // Database Credentials
  private $host = "localhost";
  private $db_name = "pra-ukk";
  private $username = "root";
  private $password = "";

  public $conn;

  // Get Database Connection
  public function getConnection() {
    $this->conn = null;

    try {
      $this->conn = new PDO("mysql:host=".$this->host.";dbname=".$this->db_name, $this->username, $this->password);
      $this->conn->exec("set names utf8");
    } catch (PDOException $exception) {
      echo "Connection error: ".$exception->getMessage();
    }

    return $this->conn;
  }
}
?>