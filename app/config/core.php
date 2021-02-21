<?php
// Show Error Reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);
 
// Home Page URL
$home_url="http://localhost/pembayaran-spp/admin/";
 
// Page given in URL parameter, default page is one
$page = isset($_GET['page']) ? $_GET['page'] : 1;
 
// Set number of records per page
$records_per_page = 5;
 
// Calculate for the query LIMIT clause
$from_record_num = ($records_per_page * $page) - $records_per_page;
