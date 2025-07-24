<?php
session_start();
include("connection.php");

    if($_POST['action_type'] == 'test_done'){
				$txt_m_cat_name = $_POST['txt_m_cat_name'];	
				$txt_m_name = $_POST['txt_m_name'];	
				$txt_m_cat_id = $_POST['txt_m_cat_id'];	
				$txt_m_id = $_POST['txt_m_id'];	
				$array_test= $_POST['array_test'];					
				$array_settings= $_POST['array_settings'];					
				$current_date= date('Y-m-d');
				$user_ids=$_SESSION['u_id'];
				
				
				$sel_test_if_available="select * from particular_test where `mate_cat_id`=$txt_m_cat_id AND `mate_id`=$txt_m_id AND `is_deleted`=0";
				
				$query_test_if_available=mysqli_query($conn,$sel_test_if_available);
				if(mysqli_num_rows($query_test_if_available) > 0){
					
					$update_particular_test="update particular_test set `test_ids`='$array_test',`test_chk`='$array_settings' where `mate_cat_id`=$txt_m_cat_id AND `mate_id`=$txt_m_id AND `is_deleted`=0";
					$result_particular_test=mysqli_query($conn,$update_particular_test);
				
				}else
				{					
				$insertas="insert into particular_test (`cat_name`,`material_name`,`mate_cat_id`,`mate_id`,`test_ids`,`test_chk`,`created_date`,`created_by`) 
				values(
				'$txt_m_cat_name',
				'$txt_m_name',
				$txt_m_cat_id,
				$txt_m_id,
				'$array_test',
				'$array_settings',
				'$current_date',
				$user_ids)";
				$result_of_insert=mysqli_query($conn,$insertas);
				}
				
				
				
			}
    exit;

?>