<?php

$months = ['', 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni',
'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'
];

function plus_one_month($last_paid, $type) {
  $last_paid = strtotime($last_paid);
  $date_to_pay = date("Y-m-d", strtotime("+1 month", $last_paid));
  $plus_one_month = (int)date($type, strtotime($date_to_pay));

  return $plus_one_month;
}

function date_one_month($last_paid) {
  $last_paid = strtotime($last_paid);
  $date_one_month = date("Y-m-d", strtotime("+1 month", $last_paid));

  return $date_one_month;
}

function first_period($date, $type) {
  $first_period = (int)date($type, strtotime($date));

  return $first_period;
}
?>