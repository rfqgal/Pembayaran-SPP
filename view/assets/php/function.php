<?php
error_reporting(E_ALL ^ (E_WARNING | E_NOTICE));

function check_login()
{
  session_start();

  if (@$_SESSION['level'] == "student") {
    echo "
      <script>
        window.location.href = 'http://localhost/Pembayaran-SPP/view/student/';
      </script>
    ";
  }

  if (@$_SESSION['level'] == "officer") {
    echo "
      <script>
        window.location.href = 'http://localhost/Pembayaran-SPP/view/officer/';
      </script>
    ";
  }
  
  if (@$_SESSION['level'] == "admin") {
    echo "
      <script>
        window.location.href = 'http://localhost/Pembayaran-SPP/view/admin/';
      </script>
    ";
  }
}

function check_user($level)
{
  session_start();
  include_once('./route.php');

  if (@$_SESSION['level'] != "admin") {
    echo "
    <script>
      alert('Anda tidak memiliki akses di halaman ini!');
      window.location.href = '$login';
    </script>
  ";
  }
}

$months = [
  '', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
  'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

function plus_one_month($last_paid, $type)
{
  $last_paid = strtotime($last_paid);
  $date_to_pay = date("Y-m-d", strtotime("+1 month", $last_paid));
  $plus_one_month = (int)date($type, strtotime($date_to_pay));

  return $plus_one_month;
}

function date_one_month($last_paid)
{
  $last_paid = strtotime($last_paid);
  $date_one_month = date("Y-m-d", strtotime("+1 month", $last_paid));

  return $date_one_month;
}

function first_period($date, $type)
{
  $first_period = (int)date($type, strtotime($date));

  return $first_period;
}
