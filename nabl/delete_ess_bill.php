<?php 
session_start();
include("connection.php");

			 $delete="update job SET `jobisstatus`='0',`jobisdeleted`='1' WHERE `report_no`='$_POST[report_no]'";
			mysqli_query($conn,$delete); 
			
			$delete1="update estimate_total_span SET `est_isdeleted`='1' WHERE `report_no`='$_POST[report_no]'";
			mysqli_query($conn,$delete1);
	
?>
			