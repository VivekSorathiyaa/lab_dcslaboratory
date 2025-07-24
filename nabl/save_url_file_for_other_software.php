<?php
session_start();
include("connection.php");
error_reporting("0");

//set ulr no in session
//$sel_ulrs="select * from ulr_no where `ulr_status`=0";
//$result_ulrs = mysqli_query($conn, $sel_ulrs);
//if(mysqli_num_rows($result_ulrs)>0)
//{
//	$get_ulrs=mysqli_fetch_array($result_ulrs);
//	$_SESSION["ulr_nos"]= $get_ulrs["ulr_no"];
//}else{
//	$_SESSION["ulr_nos"]= "TC6202200000";	
//}


if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'apply_ulr_no'){
		
		$branch_short_code=$_POST["branch_short_code"];
		$counts_of_final_material=$_POST["counts_of_final_material"];
		$sel_ulr_no="SELECT * FROM ulr_sequence  WHERE `branch_short_code`='$branch_short_code' order by ulr_sequence desc LIMIT 0,1";
		$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
		
		if(mysqli_num_rows($query_ulr_no) > 0)
		{
			
			$result_ulr_no=mysqli_fetch_array($query_ulr_no);
			
			$ulr_sequence_plused= intval($result_ulr_no["ulr_sequence"]) + 1;
		}
		else
		{
			$ulr_sequence_plused=1;
		}
		
		
		$set_ulr_array=array();
		for($i=1;$i<=$counts_of_final_material;$i++)
		{
			array_push($set_ulr_array,$ulr_sequence_plused);
			$ulr_sequence_plused++;
		}
		$fill=array("set_ulr_array"=>$set_ulr_array);	
		echo json_encode($fill);
		
	}else if($_POST['action_type'] == 'use_reserved_ulr_no'){
		
		$branch_short_code=$_POST["branch_short_code"];
		$date_explode=explode("/",$_POST["sample_rec_date"]);
		$sample_rec_date=$date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		$sel_ulr_no="SELECT * FROM ulr_sequence where `ulr_sequence_date`='$sample_rec_date' AND `ulr_status`='3' AND `branch_short_code`='$branch_short_code' order by ulr_sequence ASC";
		$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
		
		$set_ulr_array=array();
		if(mysqli_num_rows($query_ulr_no) > 0)
		{
			
			while($result_ulr_no=mysqli_fetch_array($query_ulr_no))
			{
				array_push($set_ulr_array,$result_ulr_no["ulr_sequence"]);
			}
			
			
		}
		$fill=array("set_ulr_array"=>$set_ulr_array);	
		echo json_encode($fill);
		
	}else if($_POST['action_type'] == 'reserveing_ulr'){
		
		$todays=date("Y-m-d");
		$user_ids=$_SESSION["u_id"];
		$date_explode=explode("/",$_POST["reserved_date"]);
		$job_no_date=$date_explode[2].$date_explode[1].$date_explode[0];
		$reserved_date=$date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		$months="_____".$date_explode[1]."___";
		$txt_start_url=$_POST["txt_start_url"];
		$txt_last_url=$_POST["txt_last_url"];
		$sel_branch=explode("|",$_POST["sel_branch"]);
		$branch_short_code=$sel_branch[0];
		$branch_name=$sel_branch[1];
		$errors=0;
		$plusing=0;
		for($i=$txt_start_url;$i<=$txt_last_url;$i++)
		{
			   $sel_ulr_no="SELECT * FROM ulr_sequence WHERE ulr_sequence=$i AND `branch_short_code`='$branch_short_code'";
				$query_ulr_no_conts=mysqli_query($conn,$sel_ulr_no);
				if(mysqli_num_rows($query_ulr_no_conts) > 0)
				{
					$plusing++;
				}
		}
			if($plusing == 0)
			{
							
				for($k=$txt_start_url;$k<=$txt_last_url;$k++)
				{
						//get trfno
						$sel_trf_ulr="select * from ulr_sequence WHERE `ulr_sequence_date` LIKE '$months' ORDER BY trf_max_number DESC LIMIT 0,1";
						$query_trf_ulr=mysqli_query($conn,$sel_trf_ulr);
						if(mysqli_num_rows($query_trf_ulr) > 0)
						{
							$get_tfr_no_ulr=mysqli_fetch_array($query_trf_ulr);
							$max_number= $get_tfr_no_ulr["trf_max_number"];
							$get_number= $max_number;
							$trf_no= intval($get_number)+1;
							$trf_max_number= intval($get_number)+1;
						}
						else
						{
							$trf_max_number= 1;
							$trf_no= "1";
						}
						
						//get labno
						$sel_lab="select * from ulr_sequence WHERE `ulr_sequence_date` LIKE '$months' ORDER BY ulr_sequence_id DESC LIMIT 0,1";
						$query_lab=mysqli_query($conn,$sel_lab);
						if(mysqli_num_rows($query_lab) > 0)
						{
							$get_lab=mysqli_fetch_array($query_lab);
							$get_lab_number= $get_lab["lab_no"];
							$lab_no= intval($get_lab_number)+1;
						}
						else
						{
							$lab_no= "1";
						}
						
						$set_job_nos=$job_no_date."DCS".sprintf('%02d', $k);
						$set_report_nos="DCS/".$date_explode[1]."/".$_SESSION['fy_name']."/".sprintf('%02d', $k);
						
							
						
						$ins_ulr_no="insert into ulr_sequence(`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_status`,`created_date`,`created_by`,`modified_date`,`modified_by`,`branch_name`,`branch_short_code`,`trf_no`,`job_no`,`report_no`,`lab_no`,`trf_max_number`)VALUES($k,'$reserved_date','0','3','$todays','$user_ids','$todays','$user_ids','$branch_name','$branch_short_code','$trf_no','$set_job_nos','$set_report_nos','$lab_no',$trf_max_number)";
						$query_ins_ulr_no=mysqli_query($conn,$ins_ulr_no);
						
				}
				
				$fill=array("set_status"=>0,"message"=> "Ulr Reserved For ".$branch_name." Branch Successfully");
			}else
			{
				$fill=array("set_status"=>1,"message"=> "Sorry...Something Went Wrong.");
			}				
				
				echo json_encode($fill);
		
	}else if($_POST['action_type'] == 'on_branch_changes'){
		
		$sel_branch=explode("|",$_POST["sel_branch"]);
		$branch_short_code=$sel_branch[0];
		$branch_name=$sel_branch[1];
		
		$sel_ulr_no="SELECT * FROM ulr_sequence WHERE `branch_short_code`='$branch_short_code' order by ulr_sequence desc LIMIT 0,1";
		$query_ulr_no=mysqli_query($conn,$sel_ulr_no);
		if(mysqli_num_rows($query_ulr_no) > 0)
		{
			$result_ulr_no=mysqli_fetch_array($query_ulr_no);
			$last_ulr_no= intval($result_ulr_no["ulr_sequence"]) + 1;
		}
		else
		{
			$last_ulr_no=1;
		}
				
		$fill=array("set_status"=>0,"last_ulr_no"=> $last_ulr_no);
		echo json_encode($fill);
	}else if($_POST['action_type'] == 'chk_and_save'){
		
		$date_explode=explode("/",$_POST["txt_sam_rec_date"]);
		$txt_sam_rec_date=$date_explode[2]."-".$date_explode[1]."-".$date_explode[0];
		$final_mate_id_array=$_POST["final_mate_id_array"];
		$url_array=$_POST["url_array"];
		$ulr_status=$_POST["ulr_status"];
		$current_date= date('Y-m-d');
		
		$branch_name=$_POST["branch_name"];
		$branch_short_code=$_POST["branch_short_code"];
		
		$txt_temporary_trf_no=$_POST["txt_temporary_trf_no"];
		
		$explode_ulr_array=explode(",",$url_array);
		$explode_mate_id_array=explode(",",$final_mate_id_array);
		
		
		$error_status=0;
		
		if($ulr_status=="auto_ulr_use")
		{
			$error_status=0;
			foreach($explode_ulr_array as $keyed => $one_ulr_no)
			{
				$sel_ulr_no="SELECT * FROM ulr_sequence where ulr_sequence=$one_ulr_no AND `branch_short_code`='$branch_short_code' ORDER BY ulr_sequence_id desc";
				$query_ulr_no_five=mysqli_query($conn,$sel_ulr_no);
				
				if(mysqli_num_rows($query_ulr_no_five) > 0)
				{
					$error_status=1;
				}
			}
		
			
			if($error_status==0)
			{
				foreach($explode_ulr_array as $keyed => $one_ulr_no)
				{
					$insert_ulr="insert into ulr_sequence (`ulr_sequence`,`ulr_sequence_date`,`table_primary_key_id`,`ulr_status`,`created_date`,`created_by`,`modified_date`,`modified_by`,`branch_name`,`branch_short_code`) 
					values(
					$one_ulr_no,
					'$txt_sam_rec_date',
					'$explode_mate_id_array[$keyed]',
					'2',
					'$current_date',
					$_SESSION[u_id],
					'$current_date',
					$_SESSION[u_id],
					'$branch_name',
					'$branch_short_code')";
					mysqli_query($conn,$insert_ulr);
				
					$set_ulr_no =sprintf('%09d', $one_ulr_no);
					$update_final_table="update final_material_assign_master set `ulr_no`='$set_ulr_no' where `final_material_id`=".$explode_mate_id_array[$keyed];
					mysqli_query($conn,$update_final_table);
				}
					$update_save="update save_material_assign set `set_url`='1' where `temporary_trf_no`='$txt_temporary_trf_no'";
					mysqli_query($conn,$update_save);
					$up_job="update job set `set_url`='1' where `temporary_trf_no`='$txt_temporary_trf_no'";
					mysqli_query($conn,$up_job);
					
					$fill=array("set_status"=>"1","msg"=>"Successfully Saved");
			}
			else
			{
			        $fill=array("set_status"=>"0","msg"=>"Something went wrong");
			}
		}
		
		if($ulr_status=="reserved_ulr_use")
		{
			$error_status=0;
			foreach($explode_ulr_array as $keyed => $one_ulr_no)
			{
				 $sel_ulr_no="SELECT * FROM ulr_sequence where ulr_sequence=$one_ulr_no AND `ulr_status`='2' AND `branch_short_code`='$branch_short_code' ORDER BY ulr_sequence_id desc";
				$query_ulr_no_five=mysqli_query($conn,$sel_ulr_no);
				
				if(mysqli_num_rows($query_ulr_no_five) > 0)
				{
					$error_status=1;
				}
			}
		
			if($error_status==0)
			{
				foreach($explode_ulr_array as $keyed => $one_ulr_no)
				{
					$update_ulrs="update ulr_sequence set ulr_status='2',created_date='$current_date',table_primary_key_id=$explode_mate_id_array[$keyed] where ulr_sequence=$one_ulr_no";
					mysqli_query($conn,$update_ulrs);
					
					$set_ulr_no =sprintf('%09d', $one_ulr_no);
					$update_final_table="update final_material_assign_master set `ulr_no`='$set_ulr_no' where `final_material_id`=".$explode_mate_id_array[$keyed];
					mysqli_query($conn,$update_final_table);
				}
					
					$update_save="update save_material_assign set `set_url`='1' where `temporary_trf_no`='$txt_temporary_trf_no'";
					mysqli_query($conn,$update_save);
					$up_job="update job set `set_url`='1' where `temporary_trf_no`='$txt_temporary_trf_no'";
					mysqli_query($conn,$up_job);
					
					$fill=array("set_status"=>"1","msg"=>"Successfully Saved");
			}
			else
			{
			        $fill=array("set_status"=>"0","msg"=>"Something went wrong");
			}
		}
		
		
				echo json_encode($fill);
		
	}

}
    exit;

?>