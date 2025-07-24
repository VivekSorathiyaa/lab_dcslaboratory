<?php 
session_start();
include("connection.php");

$print_counts=$_POST["print_counts"];
$est_id=$_POST["est_id"];
$up="update estimate_total_span set `print_counts`='$print_counts' where `est_id`=".$est_id;
mysqli_query($conn,$up);
?>

