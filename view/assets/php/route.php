<?php
$base = "http://localhost/Pembayaran-SPP";

// API References
$api = $base."/app";

// View References
$view = $base."/view";

$login = $view."/index.php";
$logout = $view."/logout.php";

// Student's References
$student = $view."/student";

$index_student = $student."/index.php";
$history_student = $student."/history.php";
$print_student = $student."/print.php";

// Officer's References
$officer = $view."/officer";

$index_officer = $officer."/index.php";
$history_officer = $officer."/history.php";
$entry_officer = $officer."/entry.php";
$print_officer = $officer."/print.php";

// Admin's References
$admin = $view."/admin";

$index_admin = $admin."/index.php";

$index_admin_administrator = $admin."/administrator/index.php";
$index_admin_grade = $admin."/grade/index.php";
$index_admin_payment = $admin."/payment/index.php";
$index_admin_student = $admin."/student/index.php";
$index_admin_tuition = $admin."/tuition/index.php";

// Assets's References
$assets = $view."/assets";

$css = $assets."/style.css";

$javascript = $assets."/js";
$img = $assets."/img";