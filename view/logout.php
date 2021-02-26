<?php 
session_start();
include("./route.php");

session_destroy();

header("location:$login");
?>