<?php 
session_start();
include("./assets/php/route.php");

session_destroy();

header("location:$login");
?>