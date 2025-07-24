<?php
session_start();
include("connection.php");
if(isset($_POST['action_type']) && !empty($_POST['action_type']))
{
    if($_POST['action_type'] == 'add_year')
	{
		$txt_year= $_POST['txt_year'];					
		$replace_date= str_replace("/","-",$_POST['start_date']);
		$start_date= date('Y-m-d', strtotime($replace_date));
		$end_replace_date= str_replace("/","-",$_POST['end_date']);
		$end_date= date('Y-m-d', strtotime($end_replace_date));
		
		$insertas="insert into fyearmaster (`fy_name`,`fy_startdate`,`fy_enddate`,`fy_status`,`fy_isactive`,`fy_isdeleted`) values('$txt_year','$start_date','$end_date',0,1,0)";
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'update_year')
	{
		$txt_year= $_POST['txt_year'];					
		$txt_ids= $_POST['txt_ids'];					
		$end_date= $_POST['end_date'];					
		$start_date= $_POST['start_date'];	
		
		$insertas="update fyearmaster set `fy_name`='$txt_year',`fy_startdate`='$start_date',`fy_enddate`='$end_date' where `id`=".$txt_ids;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'delete')
	{
		$dele_id= $_POST['dele_id'];					
		$insertas="delete from  fyearmaster where `id`=".$dele_id;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
	elseif($_POST['action_type'] == 'set_active')
	{
		$set_active= $_POST['set_active'];	
		$insertas_all="update fyearmaster set `fy_isactive`=1";
		$result_of_insert_all=mysqli_query($conn,$insertas_all);
		
		$insertas="update fyearmaster set `fy_isactive`=0 where `id`=".$set_active;
		$result_of_insert=mysqli_query($conn,$insertas);
	}
}
    exit;
?>