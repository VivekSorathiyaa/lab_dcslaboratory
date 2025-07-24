<?php include("connection.php");

	if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'ACTIVATE'){
		$delete="update staff SET `staff_status`='1' WHERE `id`='$_POST[id]'";
		$result_of_delete=mysqli_query($conn,$delete);
	}
	else
	{
		$delete1="update staff SET `staff_status`='0' WHERE `id`='$_POST[id]'";
		$result_of_delete1=mysqli_query($conn,$delete1);
	}
}

			
?>	
		

		
	