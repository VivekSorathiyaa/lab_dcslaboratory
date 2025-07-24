<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
{
		 if($_POST['action_type'] == 'add_vouchers')
		{
			//$voucher_code=$_POST['voucher_code'];
			$replace_date= str_replace("/","-",$_POST['voucher_date']);
			$voucher_date= date('Y-m-d', strtotime($replace_date));
			$given_person=$_POST['given_person'];
			$amounts=$_POST['amounts'];
			$pay_type=$_POST['pay_type'];
			$remark_type=$_POST['remark_type'];
			$discripts=$_POST['discripts'];
			
			$sel_voch="select * from st_voucher ORDER BY voucher_id DESC LIMIT 0,1";
			$query_vouch=mysqli_query($conn,$sel_voch);
			if(mysqli_num_rows($query_vouch) > 0)
			{
				$one_vouch=mysqli_fetch_array($query_vouch);
				$explodings=explode("/",$one_vouch["voucher_code"]);
				$lasts=intval($explodings[1])+1;
				$sets= sprintf('%04d', $lasts);
				
				$voucher_code=$vou_first_parts.$sets;
			}else{
				$voucher_code=$vou_first_parts."0001";
			}
		
			$todays= date("Y-m-d");
			$insert_job_only="INSERT INTO `st_voucher`(`voucher_code`, `voucher_date`, `given_person`, `discription`, `amount`, `payment_type`, `remark_type`, `created_by`, `created_date`) values(
						'$voucher_code',
						'$voucher_date',
						'$given_person',
						'$discripts',
						'$amounts',
						'$pay_type',
						'$remark_type',
						'$_SESSION[name]',
						'$todays')";
					$result_of_insert_only_job=mysqli_query($conn,$insert_job_only);	
					$fill = array("status" => "1","msg" => "Successfully saved");
					echo json_encode($fill);
				
			
		}else if($_POST['action_type'] == 'delete_vouch')
		{
			$delete_vouch_id=$_POST["delete_vouch_id"];
			echo $del_vouch="delete from st_voucher where `voucher_id`=".$delete_vouch_id;
			mysqli_query($conn,$del_vouch);			
		}
	
    exit;
	
}
?>