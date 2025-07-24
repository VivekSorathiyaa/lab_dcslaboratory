<?php

include 'connection.php';
if(isset($_POST['btn_last_nofw']))
{
	
		$sql = "select * from job_invert ORDER BY id DESC";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		
		if(!empty($row))
		{
			echo  $row["name_of_work"];
			return true;
			exit;
		}else{
			echo "no";
			return true;
			exit;
		}
		
}


if(isset($_POST['btn_auth_address']))
{
	
		$sql = "select * from job_invert ORDER BY id DESC";
		$result = mysqli_query($conn, $sql);
		$row = mysqli_fetch_assoc($result);
		
		
		if(!empty($row))
		{
			echo $row["auth_address"];
			return true;
			exit;

		}else{
			echo "no";
			return true;
			exit;
		}
		
}



?>
