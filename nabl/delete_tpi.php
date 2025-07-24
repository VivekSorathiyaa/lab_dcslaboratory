<?php
session_start();
include("connection.php");
error_reporting(1);
if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
  
	if($_POST['action_type'] == 'delete_tpi'){
		$clicked_id=$_POST['clicked_id'];
		
		
		
		$job_delete="delete from  tpi WHERE `tpi_id`=".$clicked_id;
		$result_of_job_delete=mysqli_query($conn,$job_delete);
	
}

}
