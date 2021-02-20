<?php
class Payment
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $payment_id;
  public $administrator_id;
  public $nisn;
  public $payment_date;
  public $payment_month;
  public $payment_year;
  public $tuition_id;
  public $payment_total;

  // Constructor with $db as DB Connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
    // Select All Query
    $query = "SELECT * FROM pembayaran";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }
}
