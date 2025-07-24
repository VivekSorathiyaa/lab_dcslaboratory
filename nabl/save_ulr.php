<?php
session_start();
include("connection.php");
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
{
    if($_POST['action_type'] == 'add_ulr')
	{
		$txt_ulr= $_POST['txt_ulr'];					
		$insertas="insert into ulr_no (`ulr_no`) values('$txt_ulr')";
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'update_ulr')
	{
		$txt_ulr= $_POST['txt_ulr'];					
		$txt_ulr_id= $_POST['txt_ulr_id'];					
		$insertas="update ulr_no set `ulr_no`='$txt_ulr' where `ulr_id`=".$txt_ulr_id;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'delete')
	{
		$dele_id= $_POST['dele_id'];					
		$insertas="delete from  ulr_no where `ulr_id`=".$dele_id;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'set_active')
	{
		$set_active= $_POST['set_active'];	
		$insertas_all="update ulr_no set `ulr_status`=1";
		$result_of_insert_all=mysqli_query($conn,$insertas_all);
		
		$insertas="update ulr_no set `ulr_status`=0 where `ulr_id`=".$set_active;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
}
    exit;
?>