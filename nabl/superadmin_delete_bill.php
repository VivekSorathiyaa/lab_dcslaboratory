<?php include("connection.php");
if(isset($_POST['action_type']) && $_POST['action_type']=="sendrec1"){
$delete_ids = $_POST['delete_ids'];

	$delete="update estimate_total_span SET `est_isdeleted`='1' WHERE `est_id`='$delete_ids'";
	$result_of_delete=mysqli_query($conn,$delete);
			
}

if(isset($_POST['action_type']) && $_POST['action_type']=="delete_job_by_sadmin"){
$delete_ids = $_POST['delete_ids'];

	$delete="delete from job  WHERE `job_id`='$delete_ids'";
	$result_of_delete=mysqli_query($conn,$delete);
			
}	

if(isset($_POST['action_type']) && $_POST['action_type']=="reward_job_by_sadmin"){
$delete_ids = $_POST['delete_ids'];

	$delete="update job SET `send_to_second_reception` = '0' and `material_assign` = '0' WHERE `job_id`='$delete_ids'";
	$result_of_delete=mysqli_query($conn,$delete);
			
}		
?>