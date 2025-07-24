<?php
session_start();
include("connection.php");
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
{
    if($_POST['action_type'] == 'add_auth')
	{
		$auth_name= $_POST['auth_name'];					
		$auth_designation= $_POST['auth_designation'];					
		
		$insertas="insert into sign_authority (`auth_name`,`auth_designation`,`is_active`,`is_status`) values('$auth_name','$auth_designation','0',1)";
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'update_auth')
	{
		$auth_name= $_POST['auth_name'];					
		$auth_designation= $_POST['auth_designation'];	
		$txt_ids= $_POST['txt_ids'];	
		
		$insertas="update sign_authority set `auth_name`='$auth_name',`auth_designation`='$auth_designation' where `id`=".$txt_ids;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'delete')
	{
		$dele_id= $_POST['dele_id'];					
		$insertas="delete from  sign_authority where `id`=".$dele_id;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'set_active')
	{
		$set_active= $_POST['set_active'];	
		$insertas_all="update sign_authority set `is_active`='0'";
		$result_of_insert_all=mysqli_query($conn,$insertas_all);
		
		$insertas="update sign_authority set `is_active`='1' where `id`=".$set_active;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
}
    exit;
?>