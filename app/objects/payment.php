<?php
class Payment
{
  // Connection and Table Name
  private $conn;

  // Object Props
  public $payment_id;
  public $administrator_id;
  public $administrator_name;
  public $nisn;
  public $student_name;
  public $payment_date;
  public $payment_month;
  public $payment_year;
  public $tuition_id;
  public $tuition_fee;
  public $payment_total;

  // Constructor with $db as DB Connection
  public function __construct($db)
  {
    $this->conn = $db;
  }

  function read()
  {
    // Select All Query
    $query = "SELECT * FROM pembayaran
      INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
      INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
      INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }

  function store()
  {
    // Query Insert
    $query = "INSERT INTO pembayaran SET
      id_pembayaran=:id_pembayaran, id_petugas=:id_petugas, nisn=:nisn,
      tgl_bayar=:tgl_bayar, bulan_dibayar=:bulan_dibayar, 
      tahun_dibayar=:tahun_dibayar, id_spp=:id_spp, jumlah_bayar=:jumlah_bayar
    ";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->payment_id = htmlspecialchars(strip_tags($this->payment_id));
    $this->administrator_id = htmlspecialchars(strip_tags($this->administrator_id));
    $this->administrator_name = htmlspecialchars(strip_tags($this->administrator_name));
    $this->nisn = htmlspecialchars(strip_tags($this->nisn));
    $this->payment_date = htmlspecialchars(strip_tags($this->payment_date));
    $this->payment_month = htmlspecialchars(strip_tags($this->payment_month));
    $this->tuition_id = htmlspecialchars(strip_tags($this->tuition_id));
    $this->payment_total = htmlspecialchars(strip_tags($this->payment_total));

    // Bind Values
    $stmt->bindParam(":id_pembayaran", $this->payment_id);
    $stmt->bindParam(":id_petugas", $this->administrator_id);
    $stmt->bindParam(":nisn", $this->nisn);
    $stmt->bindParam(":tgl_bayar", $this->payment_date);
    $stmt->bindParam(":bulan_dibayar", $this->payment_month);
    $stmt->bindParam(":tahun_dibayar", $this->payment_year);
    $stmt->bindParam(":id_spp", $this->tuition_id);
    $stmt->bindParam(":jumlah_bayar", $this->payment_total);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function readOne()
  {
    // Query to Read One
    $query = "SELECT * FROM pembayaran
      INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
      INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
      INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
      WHERE id_pembayaran = ?
      LIMIT 0,1
    ";

    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Bind ID of Grade to be Updated
    $stmt->bindParam(1, $this->payment_id);

    // Execute Query
    $stmt->execute();

    // Get Retrieved Row
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    // Set Values to Object Props
    $this->payment_id = $row['id_pembayaran'];
    $this->administrator_id = $row['id_petugas'];
    $this->administrator_name = $row['nama_petugas'];
    $this->nisn = $row['nisn'];
    $this->student_name = $row['nama'];
    $this->payment_date = $row['tgl_bayar'];
    $this->payment_month = $row['bulan_dibayar'];
    $this->payment_year = $row['tahun_dibayar'];
    $this->tuition_id = $row['id_spp'];
    $this->tuition_fee = $row['nominal'];
    $this->payment_total = $row['jumlah_bayar'];
  }

  function update()
  {
    // Update Query
    $query = "UPDATE pembayaran SET
      id_petugas=:id_petugas, nisn=:nisn,
      tgl_bayar=:tgl_bayar, bulan_dibayar=:bulan_dibayar, 
      tahun_dibayar=:tahun_dibayar, id_spp=:id_spp, jumlah_bayar=:jumlah_bayar
      WHERE id_pembayaran=:id_pembayaran
    ";
    
    // Prepare Query Statement
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->administrator_id = htmlspecialchars(strip_tags($this->administrator_id));
    $this->administrator_name = htmlspecialchars(strip_tags($this->administrator_name));
    $this->nisn = htmlspecialchars(strip_tags($this->nisn));
    $this->payment_date = htmlspecialchars(strip_tags($this->payment_date));
    $this->payment_month = htmlspecialchars(strip_tags($this->payment_month));
    $this->tuition_id = htmlspecialchars(strip_tags($this->tuition_id));
    $this->payment_total = htmlspecialchars(strip_tags($this->payment_total));
    
    $this->payment_id = htmlspecialchars(strip_tags($this->payment_id));

    // Bind New Values
    $stmt->bindParam(":id_petugas", $this->administrator_id);
    $stmt->bindParam(":nisn", $this->nisn);
    $stmt->bindParam(":tgl_bayar", $this->payment_date);
    $stmt->bindParam(":bulan_dibayar", $this->payment_month);
    $stmt->bindParam(":tahun_dibayar", $this->payment_year);
    $stmt->bindParam(":id_spp", $this->tuition_id);
    $stmt->bindParam(":jumlah_bayar", $this->payment_total);

    $stmt->bindParam(":id_pembayaran", $this->payment_id);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function delete()
  {
    // Delete Query
    $query = "DELETE FROM pembayaran WHERE id_pembayaran = ?";

    // Prepare Query
    $stmt = $this->conn->prepare($query);

    // Sanitize
    $this->payment_id = htmlspecialchars(strip_tags($this->payment_id));
    
    // Bind ID of Record to Delete
    $stmt->bindParam(1, $this->payment_id);

    // Execute Query
    if ($stmt->execute()) {
      return true;
    }
    return false;
  }

  function search($keywords)
  {
    // Query Read
    $query = "SELECT * FROM pembayaran
      INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
      INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
      INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
      WHERE nama_petugas LIKE ? OR siswa.nisn LIKE ? OR nama LIKE ? 
      OR bulan_dibayar LIKE ? OR tahun_dibayar LIKE ? 
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
    $stmt->bindParam(4, $keywords);
    $stmt->bindParam(5, $keywords);

    // Execute Query
    $stmt->execute();

    return $stmt;
  }

  public function readPaging($from_record_num, $records_per_page)
  {
    // Select Query
    $query = "SELECT * FROM pembayaran
      INNER JOIN petugas ON pembayaran.id_petugas = petugas.id_petugas
      INNER JOIN siswa ON pembayaran.nisn = siswa.nisn
      INNER JOIN spp ON pembayaran.id_spp = spp.id_spp
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
    $query = "SELECT COUNT(*) as total_rows FROM pembayaran";

    $stmt = $this->conn->prepare($query);
    $stmt->execute();
    $row = $stmt->fetch(PDO::FETCH_ASSOC);

    return $row['total_rows'];
  }
}
