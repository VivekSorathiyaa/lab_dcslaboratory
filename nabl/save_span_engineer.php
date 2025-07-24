
<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'update_engineer'){
		
		$start_date= date('Y-m-d',strtotime($_POST["get_start_date"]));
		$end_date= date('Y-m-d',strtotime($_POST["get_end_date"]));
		//$issue_date= date('Y-m-d',strtotime($_POST["get_issuedate"]));
		$days= $_POST["diffDays"];
		$get_lab_id= $_POST["get_lab_id"];
		$get_material_id= $_POST["get_material_id"];
		$get_test_id= $_POST["get_test_id"];
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$get_job_no= $_POST["get_job_no"];
		$get_expdate= date('Y-m-d',strtotime($_POST["get_expdate"]));
		
		if ($start_date < $end_date || $start_date == $end_date ) 
		{
		$sel_eng="Select * from job_for_engineer where `lab_no`='$get_lab_id'";
		$query_eng= mysqli_query($conn,$sel_eng);
		
		
		if(mysqli_num_rows($query_eng) > 0 ){
			
			$update_eng="update job_for_engineer set `material_id`='$get_material_id',`trf_no`='$txt_trf_no',`job_no`='$get_job_no',`lab_no`='$get_lab_id',`test_list`='$get_test_id',`start_date`='$start_date',`end_date`='$end_date',`issue_date`='$end_date',`days`='$days',`expected_date`='$get_expdate' where `lab_no`='$get_lab_id'";
			$result_update_eng=mysqli_query($conn,$update_eng);
			
		}else{
			
			
			$insert_eng="insert into job_for_engineer (`material_id`,`trf_no`,`job_no`,`lab_no`,`test_list`,`start_date`,`end_date`,`issue_date`,`days`,`expected_date`,`createdby`,`createddate`,`modifiedby`,`modifieddate`) values('$get_material_id','$txt_trf_no','$get_job_no','$get_lab_id','$get_test_id','$start_date','$end_date','$end_date','$days','$get_expdate','$_SESSION[name]','0000-00-00','','0000-00-00')";
			$result_insert_eng=mysqli_query($conn,$insert_eng);
			
		}
		
		}else{
			echo "SORRY.. Something Went Wrong";
		}
	}
	
	else if($_POST['action_type'] == 'aasign_eng_to_material')
	{
			
			$explodeers=explode('|', $_POST["clicked_id"]);
			$tested_by= $explodeers[0];
			$lab_no= $explodeers[1];
			$trf_no= $explodeers[2];
			$final_material_id= $explodeers[3];
			
				$upd_job_eng="update job_for_engineer set `assigned_by_tm`='1',`tested_by`='$tested_by',`tested_by_status`='0' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_job_eng);
				
				$upd_final="update final_material_assign_master set `assigned_by_tm`='1',`tested_by`='$tested_by',`tested_by_status`='0' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_final);
				
				$upd_span="update span_material_assign set `assigned_by_tm`='1',`tested_by`='$tested_by',`tested_by_status`='0' where `final_material_id`='$final_material_id'";
				mysqli_query($conn,$upd_span);
				
				$sel_jobs="select * from job where `trf_no`='$trf_no'";
				$query_jobs=mysqli_query($conn,$sel_jobs);
				$get_jobs=mysqli_fetch_array($query_jobs);
				$explode_tested_by=explode(",",$get_jobs["tested_by"]);
				$explode_tested_by_status=explode(",",$get_jobs["tested_by_status"]);
				$explode_downlaod_status=explode(",",$get_jobs["downlaod_status"]);
				
				if (!in_array($tested_by, $explode_tested_by))
				{
					array_push($explode_tested_by,$tested_by);
					array_push($explode_tested_by_status,"0");
					array_push($explode_downlaod_status,"0");
				}
				
				$implode_tested_by=ltrim(implode(",",$explode_tested_by),",");
				$implode_tested_by_status=ltrim(implode(",",$explode_tested_by_status),",");
				$implode_downlaod_status=ltrim(implode(",",$explode_downlaod_status),",");
				
				$upd_jobs="update job set `tested_by`='$implode_tested_by',`tested_by_status`='$implode_tested_by_status',`downlaod_status`='$implode_downlaod_status' where `trf_no`='$trf_no'";
				mysqli_query($conn,$upd_jobs);

				$select_job_for_eng = "select * from job_for_engineer where `sent_tm_to_eng_blank`=0 AND `trf_no` = '$trf_no'";
				$query_job_for_eng = mysqli_query($conn, $select_job_for_eng);
				if (mysqli_num_rows($query_job_for_eng) == 0) {
					
				}
	}
	
	else if($_POST['action_type'] == 'send_tm_to_eng_blank')
	{
			
			$explodeers=explode('|', $_POST["clicked_id"]);
			$lab_no= $explodeers[0];
			$trf_no= $explodeers[1];
			$final_material_id= $explodeers[2];
			
				$upd_job_eng="update job_for_engineer set `sent_tm_to_eng_blank`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_job_eng);
				
				$upd_final="update final_material_assign_master set `sent_tm_to_eng_blank`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_final);
				
				$upd_span="update span_material_assign set `sent_tm_to_eng_blank`='1' where `final_material_id`='$final_material_id'";
				mysqli_query($conn,$upd_span);
				
				$upd_jobs = "update job set `tm_to_eng_blank`='1',`live_status`=2 where `trf_no`='$trf_no'";
				mysqli_query($conn, $upd_jobs);
	}
	
	else if($_POST['action_type'] == 'report_view_only')
	{
			
			
			$trf_no=$_POST['trf_no'];
			$job_no=$_POST['job_no'];
			$temporary_trf_no=$_POST['temporary_trf_no'];
				
			$upd_jobs = "update job set `live_status`=7 where `trf_no`='$trf_no'";
			mysqli_query($conn, $upd_jobs);
	}
	else if($_POST['action_type'] == 'report_view_HA')
	{
			
			
			$trf_no=$_POST['trf_no'];
			$job_no=$_POST['job_no'];
			$temporary_trf_no=$_POST['temporary_trf_no'];
				
			$upd_jobs = "update job set `live_status`=7 where `trf_no`='$trf_no'";
			mysqli_query($conn, $upd_jobs);
	}
	
	else if($_POST['action_type'] == 'send_eng_to_tm_upload')
	{
			
			$explodeers=explode('|', $_POST["clicked_id"]);
			$reported_by_review = $explodeers[0];
			$trf_no= $explodeers[1];
			$final_material_id= $explodeers[2];
			
			
				$upd_job_eng="update job_for_engineer set `sent_eng_to_tm_upload`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_job_eng);
				
				$upd_final="update final_material_assign_master set `sent_eng_to_tm_upload`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_final);
				
				$upd_span="update span_material_assign set `sent_eng_to_tm_upload`='1' where `final_material_id`='$final_material_id'";
				mysqli_query($conn,$upd_span);
				
				$upd_job="update job set `any_upload_come`='1', `reported_by_review`='$reported_by_review' where `trf_no`='$trf_no'";
				mysqli_query($conn,$upd_job);
	}
	
	else if($_POST['action_type'] == 'verified_by_tm')
	{
			
			$explodeers=explode('|', $_POST["clicked_id"]);
			$lab_no= $explodeers[0];
			$trf_no= $explodeers[1];
			$final_material_id= $explodeers[2];
			
				$upd_job_eng="update job_for_engineer set `tm_verify`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_job_eng);
				
				$upd_final="update final_material_assign_master set `tm_verify`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_final);
				
				$upd_span="update span_material_assign set `tm_verify`='1' where `final_material_id`='$final_material_id'";
				mysqli_query($conn,$upd_span);
				
				$upd_job="update job set `any_verify`='1' where `trf_no`='$trf_no'";
				mysqli_query($conn,$upd_job);
	}
	
	else if($_POST['action_type'] == 'accept_by_tm_of_qm')
	{
			
			$explodeers=explode('|', $_POST["clicked_id"]);
			$lab_no= $explodeers[0];
			$trf_no= $explodeers[1];
			$final_material_id= $explodeers[2];
			
				$upd_job_eng="update job_for_engineer set `accept_by_tm`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_job_eng);
				
				$upd_final="update final_material_assign_master set `accept_by_tm`='1' where `lab_no`='$lab_no'";
				mysqli_query($conn,$upd_final);
				
				$upd_span="update span_material_assign set `accept_by_tm`='1' where `final_material_id`='$final_material_id'";
				mysqli_query($conn,$upd_span);
				
				$upd_job="update job set `any_accept_by_tm`='1' where `trf_no`='$trf_no'";
				mysqli_query($conn,$upd_job);
	}
	else if($_POST['action_type'] == 'update_issue_dates'){
		
		$issue_date= date('Y-m-d',strtotime($_POST["get_issuedate"]));
		$get_lab_id= $_POST["get_lab_id"];
		
		$update_eng="update job_for_engineer set `issue_date`='$issue_date' where `lab_no`='$get_lab_id'";
			$result_update_eng=mysqli_query($conn,$update_eng);
		
	}else if($_POST['action_type'] == 'update_print_counts'){
		
		$get_values= $_POST["get_values"];
		$get_id= $_POST["get_id"];
		
		$update_eng="update estimate_total_span set `print_counts`='$get_values' where `est_id`=".$get_id;
		$result_update_eng=mysqli_query($conn,$update_eng);
		
	}else if($_POST['action_type'] == 'send_to_qlty_manager'){
		$clicked_id = $_POST['clicked_id'];
$txt_trf_no = $_POST['txt_trf_no'];
$job_no = $_POST['job_no'];
$reported_by_review = $_POST['reported_by_review'];

// Update job_for_engineer
$save_eng_update = "UPDATE job_for_engineer 
                    SET report_sent_to_qm = 1, accepted_by_qm = 2 ,trf_no = '$txt_trf_no' , job_no = '$job_no'
                    WHERE lab_no = '$clicked_id'";
$result_eng_update = mysqli_query($conn, $save_eng_update);

// Update final_material_assign_master
$update_eng_light = "UPDATE final_material_assign_master 
                     SET eng_light_status = 2 
                     WHERE lab_no = '$clicked_id'";
$result_eng_light = mysqli_query($conn, $update_eng_light);

// First check if reported_by_review is already set in job
$check_query = "SELECT reported_by_review 
                FROM job 
                WHERE trf_no = '$txt_trf_no' AND jobisdeleted = 0 
                LIMIT 1";
$check_result = mysqli_query($conn, $check_query);

if ($check_row = mysqli_fetch_assoc($check_result)) {
    if (empty($check_row['reported_by_review']) || $check_row['reported_by_review'] == '0') {
        // Only update if not already set
        $update_job_owner = "UPDATE job 
                             SET any_report_done_by_any_eng = 1, reported_by_review = '$reported_by_review' , `return_eng_to_tm`='1' , `live_status`=3
                             WHERE trf_no = '$txt_trf_no' AND jobisdeleted = 0";
        $update_job_query = mysqli_query($conn, $update_job_owner);
    } else {
        // Already set, so just update the status flag if needed
        $update_job_owner = "UPDATE job 
                             SET any_report_done_by_any_eng = 1 ,`live_status`=3
                             WHERE trf_no = '$txt_trf_no' AND jobisdeleted = 0";
        $update_job_query = mysqli_query($conn, $update_job_owner);
    }
}

	
	}else if($_POST['action_type'] == 'all_report_send'){
		$explode_clicked_ids=explode(",",$_POST['clicked_id']);
		$reported_by_review=$_POST['reported_by_review'];
		$txt_report_no=$_POST['txt_report_no'];
		foreach($explode_clicked_ids as $clicked_id)
		{
			
			$save_eng_update="update job_for_engineer SET `report_sent_to_qm`=1 WHERE `lab_no`='$clicked_id'";
			$result_eng_update=mysqli_query($conn,$save_eng_update);
		
			// ALSO SET ENG LIGHT STATUS in final_material_assign_master
		
			$update_eng_light="update final_material_assign_master SET `eng_light_status`=2 WHERE `lab_no`='$clicked_id'";
			$result_eng_light=mysqli_query($conn,$update_eng_light);
			
		}
		
		
		$update_job_owner="update job set `job_owner_eng_and_qm`='1' where `report_no`='$txt_report_no' AND `jobisdeleted`='0'";
		$update_job_query=mysqli_query($conn,$update_job_owner);
	
	}else if($_POST['action_type'] == 'send_to_dispatch'){
		$clicked_id=$_POST['clicked_id'];
		
		$update_job_owner="update estimate_total_span set `job_send_to_dispatch`=1 where `trf_no`='$clicked_id'";
		$update_job_query=mysqli_query($conn,$update_job_owner);
	
	}
	else if($_POST['action_type'] == 'report_send_to_eng'){
		
		//31/3
		$clicked_id=explode("|",$_POST['clicked_id']);
		$txt_lab_no=$clicked_id[0];
		$tested_bys=$clicked_id[1];
		$txt_trf_no=$_POST["txt_trf_no"];
		$remark = $_POST["remark"];
		
		$save_eng_update="update job_for_engineer SET `report_sent_to_qm`=0,`biller_light_status`=1, `appoved_by_qm_to_print`=0 WHERE `lab_no`='$txt_lab_no'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
		
		// ALSO SET ENG LIGHT STATUS in final_material_assign_master
			
		$update_eng_light="update final_material_assign_master SET `eng_light_status`=1,`notes_by_tm`='$remark' WHERE `lab_no`='$txt_lab_no'";
		$result_eng_light=mysqli_query($conn,$update_eng_light);
		
		$sel_job_by_trf_no="select `tested_by`,`tested_by_status` from job where `trf_no`='$txt_trf_no'";
		$result_job_by_trf_no=mysqli_query($conn,$sel_job_by_trf_no);
		if(mysqli_num_rows($result_job_by_trf_no)>0)
		{
			$get_jobs_by_trf_no= mysqli_fetch_array($result_job_by_trf_no);
			
			$explode_tested_by=explode(",",$get_jobs_by_trf_no["tested_by"]);
			$explode_tested_by_status=explode(",",$get_jobs_by_trf_no["tested_by_status"]);
			
			$value_position=array_search($tested_bys,$explode_tested_by,true);
			
			$explode_tested_by_status[$value_position]="0";
			
			$implode_tested_by_status=implode(",",$explode_tested_by_status);
			
			$update_job="update job set `tested_by_status`='$implode_tested_by_status',`remark`='$remark',`flow_status`=5,`live_status`=4 WHERE `trf_no`='$txt_trf_no'";
			
			$result_update_job=mysqli_query($conn,$update_job);
			
			
		}
	
	}
	else if($_POST['action_type'] == 'job_sent_to_eng'){
		
		//31/3
		$clicked_id=$_POST['clicked_id'];
		//$txt_report_no=$_POST['txt_report_no'];
		
		//$save_eng_update="update job_for_engineer SET `report_sent_to_qm`=0 WHERE `lab_no`='$clicked_id'";
		//$result_eng_update=mysqli_query($conn,$save_eng_update);
		
		// ALSO SET ENG LIGHT STATUS in final_material_assign_master
		
		//$update_eng_light="update final_material_assign_master SET `eng_light_status`=1 WHERE `lab_no`='$clicked_id'";
		//$result_eng_light=mysqli_query($conn,$update_eng_light);
		
		$update_job_owner="update job set `job_owner_eng_and_qm`='0',`job_sent_to_qm`='0' where `report_no`='$clicked_id' AND `jobisdeleted`='0'";
		$update_job_query=mysqli_query($conn,$update_job_owner);
	
	}
	else if($_POST['action_type'] == 'send_job_to_qlty_manager'){
		$clicked_id=explode("|",$_POST['clicked_id']);
		
		$sel_span_material_assign="select `lab_no` from span_material_assign where `trf_no`='$clicked_id[0]' AND `job_number`='$clicked_id[1]' AND `tested_by`='$clicked_id[2]' AND `temporary_trf_no`='$clicked_id[3]'";
		$result_span_material_assign=mysqli_query($conn,$sel_span_material_assign);
		
		if(mysqli_num_rows($result_span_material_assign)>0)
		{
			$lab_array=array();
			
			while($one_span_material=mysqli_fetch_array($result_span_material_assign))
			{
				if (!in_array($one_span_material["lab_no"], $lab_array))
				{
					array_push($lab_array,$one_span_material["lab_no"]);
				}
			}
			
			foreach ($lab_array as $element_lab) 
			{ 
				$save_eng_update="update job_for_engineer SET `report_sent_to_qm`=1 ,`biller_light_status`=2, `appoved_by_qm_to_print`=1 WHERE `lab_no`='$element_lab'";
				$result_eng_update=mysqli_query($conn,$save_eng_update);
		
				// ALSO SET ENG LIGHT STATUS in final_material_assign_master
		
				$update_eng_light="update final_material_assign_master SET `eng_light_status`=2 WHERE `lab_no`='$element_lab'";
				$result_eng_light=mysqli_query($conn,$update_eng_light);
			}
		}
		
		$sel_job_by_trf_no="select `tested_by`,`reported_by`,`tested_by_status` from job where `trf_no`='$clicked_id[0]' AND `job_number`='$clicked_id[1]' AND `temporary_trf_no`='$clicked_id[3]'";
		$result_job_by_trf_no=mysqli_query($conn,$sel_job_by_trf_no);
		if(mysqli_num_rows($result_job_by_trf_no)>0)
		{
			$get_jobs_by_trf_no= mysqli_fetch_array($result_job_by_trf_no);
			
			$explode_tested_by=explode(",",$get_jobs_by_trf_no["tested_by"]);
			$explode_reported_by=explode(",",$get_jobs_by_trf_no["reported_by"]);
			$explode_tested_by_status=explode(",",$get_jobs_by_trf_no["tested_by_status"]);
			
			$value_position=array_search($clicked_id[2],$explode_tested_by,true);
			
			$explode_tested_by_status[$value_position]="1";
			
			$implode_tested_by_status=implode(",",$explode_tested_by_status);
			
			$update_job="update job set `tested_by_status`='$implode_tested_by_status' where `trf_no`='$clicked_id[0]' AND `job_number`='$clicked_id[1]'  AND `temporary_trf_no`='$clicked_id[3]'";
			$result_update_job=mysqli_query($conn,$update_job);
			
			//if all job complete job status set by 
			if (!in_array("0", $explode_tested_by_status))
			{
				$set_update_job="update job set `job_owner_eng_and_qm`=1 where `trf_no`='$clicked_id[0]' AND `job_number`='$clicked_id[1]'  AND `temporary_trf_no`='$clicked_id[3]'";
				$set_result_update_job=mysqli_query($conn,$set_update_job);
			}
		}
		
	
	}else if($_POST['action_type'] == 'report_send_to_accept'){
		$clicked_id=explode("|",$_POST['clicked_id']);
		$lab_no=$clicked_id[0];
		$reporting_date=date("Y-m-d",strtotime($clicked_id[1]));
		$nabl_type=$clicked_id[2];
		$table_names=$clicked_id[3];
		$txt_trf_no=$_POST['txt_trf_no'];
		$reported_by_authorize=$_POST['reported_by_authorize'];
		
		$sel_report_starting="select * from report_starting where `is_deleted`=0";
		$query_report_starting=mysqli_query($conn,$sel_report_starting);
		$result_report_starting=mysqli_fetch_assoc($query_report_starting);
		$starting_date=$result_report_starting["starting_date"];
		$start_no=$result_report_starting["start_no"];
		
		$sel_table="select * from final_material_assign_master where `reporting_date`='$reporting_date' ORDER BY `report_max_number` DESC LIMIT 0,1";
		$query_save=mysqli_query($conn,$sel_table);
		if(mysqli_num_rows($query_save) > 0)
		{
							$result_save_mate=mysqli_fetch_assoc($query_save);
							$get_number= $result_save_mate["report_max_number"];
							$max_number= intval($get_number)+1;
							$set_last= sprintf('%05d', $max_number);
							if($nabl_type=="nabl")
							{
								$set_report_no= $nabl_report_first.$set_last;
							}
							else
							{
								$set_report_no= $non_nabl_report_first.$set_last;
							}
							
		}
		else
		{
							$max_number= get_report_no($starting_date,$start_no,$reporting_date);
							$set_last= sprintf('%05d', $max_number);
							if($nabl_type=="nabl")
							{
								$set_report_no= $nabl_report_first.$set_last;
							}
							else
							{
								$set_report_no= $non_nabl_report_first.$set_last;
							}
		}
		
		$save_eng_update="update job_for_engineer SET `accepted_by_qm`=1,`appoved_by_qm_to_print`=1 WHERE `lab_no`='$lab_no'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
		
		$save_final_update="update final_material_assign_master SET `report_done_by_qm`='1',`accept_by_tm`=1,`report_max_number`='$max_number',`reporting_date`='$reporting_date' WHERE `lab_no`='$lab_no'";
		$result_final_update=mysqli_query($conn,$save_final_update);
		
		//$update_table="update $table_names SET `report_no`='$set_report_no' WHERE `lab_no`='$lab_no'";
		//mysqli_query($conn,$update_table);
		
		$update_job_owner="update job set `job_owner_qm_and_biller`='1',flow_status=2, `reported_by_authorize`=$reported_by_authorize,`any_report_done_by_any_qm`='1',`live_status`=5 where `trf_no`='$txt_trf_no' AND `jobisdeleted`='0'";
		$update_job_query=mysqli_query($conn,$update_job_owner);
		
		
	
	}else if($_POST['action_type'] == 'report_send_to_print'){
		$clicked_id=$_POST['clicked_id'];
		$txt_trf_no=$_POST['txt_trf_no'];
		
		$save_eng_update="update job_for_engineer SET `appoved_by_qm_to_print`=1 WHERE `lab_no`='$clicked_id'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
		
		$save_eng_light="update job_for_engineer SET `eng_light_status`=2 WHERE `lab_no`='$clicked_id' AND `eng_light_status`='1'";
		$result_eng_light=mysqli_query($conn,$save_eng_light);
		
		$update_job_owner="update job set `job_owner_qm_and_biller`='1',`appoved_by_qm_to_print`=1 where `trf_no`='$txt_trf_no' AND `jobisdeleted`='0'";
		$update_job_query=mysqli_query($conn,$update_job_owner);
	
	}else if($_POST['action_type'] == 'report_send_to_complete'){
		$clicked_id=$_POST['clicked_id'];
		
		$save_eng_update="update job_for_engineer SET `appoved_by_qm_to_print`=2 WHERE `lab_no`='$clicked_id'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
	
	}else if($_POST['action_type'] == 'send_job_to_accept'){
		$clicked_id=explode("|",$_POST['clicked_id']);
		
		$save_jobs_update = "UPDATE job 
		SET `accepted_by_qm` = 1,
			`job_owner_eng_and_qm` = 2,
			`appoved_by_qm_to_print` = 1,
			`job_sent_to_qm` = 1,
			`job_owner_qm_and_biller` = 1, 
			`live_status`=6
		WHERE `trf_no` = '{$clicked_id[0]}' 
		  AND `job_number` = '{$clicked_id[1]}'";
		$result_jobs_update=mysqli_query($conn,$save_jobs_update);
		
		$save_eng_update="update job_for_engineer SET `accepted_by_qm`=1 WHERE `trf_no`='$clicked_id[0]' AND `job_no`='$clicked_id[1]'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
	
	}else if($_POST['action_type'] == 'job_send_to_print'){
		$clicked_id=explode("|",$_POST['clicked_id']);
		// aprove to print by qm and ALSO SEND JOB TO BILLER
		
		$save_jobs_update="update job SET `appoved_by_qm_to_print`=1,`job_owner_qm_and_biller`=1 WHERE `trf_no`='$clicked_id[0]' AND `job_number`='$clicked_id[1]'";
		$result_jobs_update=mysqli_query($conn,$save_jobs_update);
		
		$save_eng_update="update job_for_engineer SET `appoved_by_qm_to_print`=1 WHERE `trf_no`='$clicked_id[0]' AND `job_no`='$clicked_id[1]'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
	
	}else if($_POST['action_type'] == 'job_send_to_complete'){
		$clicked_id=explode("|",$_POST['clicked_id']);
		
		$save_jobs_update="update job SET `appoved_by_qm_to_print`=2,`job_owner_eng_and_qm`=2,`admin_special_light`=4 WHERE `trf_no`='$clicked_id[0]' AND `job_number`='$clicked_id[1]'";
		$result_jobs_update=mysqli_query($conn,$save_jobs_update);
		
		$save_eng_update="update job_for_engineer SET `appoved_by_qm_to_print`=2 WHERE `trf_no`='$clicked_id[0]' AND `job_no`='$clicked_id[1]'";
		$result_eng_update=mysqli_query($conn,$save_eng_update);
		
		//$update_estimate="update estimate_total_span SET `is_billing`=1,`job_send_to_dispatch`=0 WHERE `trf_no`='$clicked_id[0]'";
		//$result_of_estimate=mysqli_query($conn,$update_estimate);
	}else if($_POST['action_type'] == 'perfoma_complete_by_est_id'){
		$clicked_id=$_POST['clicked_id'];
		
		$save_jobs_update="update estimate_total_span SET `perfoma_completed_by_biller`='1' WHERE `est_id`=".$clicked_id;
		$result_jobs_update=mysqli_query($conn,$save_jobs_update);
	}
	else if($_POST['action_type'] == 'perfoma_cancel_by_est_id'){
		$clicked_id=$_POST['clicked_id'];
		
		$save_jobs_update="update estimate_total_span SET `est_isdeleted`=1,`make_test_bill`='0',`make_material_bill`='0',`make_estimate`='0' WHERE `est_id`=".$clicked_id;
		$result_jobs_update=mysqli_query($conn,$save_jobs_update);
	}
	else if($_POST['action_type'] == 'perfoma_deletes'){
		
		$clicked_id=$_POST['clicked_id'];
		$sel_est="select * from estimate_total_span WHERE `est_id`=".$clicked_id;
		$result_est=mysqli_query($conn,$sel_est);
		$get_est=mysqli_fetch_array($result_est);
		$get_trfs=$get_est["trf_no"];
		$explodes_trf=explode(",",$get_trfs);
		
		foreach($explodes_trf as $one_trf)
		{
			$txt_trf_no=$one_trf;
			$txt_job_no=$one_trf;
			
			$update_save_material_assign="update save_material_assign set `is_estimate`=0 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
			$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
			
			$update_gst = "update job set `perfoma_completed_by_biller`=0 where `trf_no`='$txt_trf_no'";
			$result_updategst=mysqli_query($conn,$update_gst);
		}
		
		$del_est="delete from estimate_total_span WHERE `est_id`=".$clicked_id;
		$result_del_est=mysqli_query($conn,$del_est);
	}
	else if($_POST['action_type'] == 'invoice_deletes'){
		
		$clicked_id=$_POST['clicked_id'];
		$sel_estiamte="select * from estimate_total_span where `est_id`=".$clicked_id;
		$estiamte_query= mysqli_query($conn,$sel_estiamte);
		$get_estimate= mysqli_fetch_array($estiamte_query);
		$perfoma_no= $get_estimate["perfoma_no"];
		$invoice_no= $get_estimate["invoice_no"];
		
		$del_inv="delete FROM estimate_total_span_bill_sequence  where `bill_no`='$invoice_no' AND `perfoma_no` ='$perfoma_no'";
		mysqli_query($conn,$del_inv);
		
		$update_est = "update estimate_total_span set `invoice_no`='0',`invoice_date`=null,`which_made`='0' where `est_id`=".$clicked_id;
		$result_updategst=mysqli_query($conn,$update_est);
		
	}else if($_POST['action_type'] == 'estimate_deletes'){
		
		$clicked_id=$_POST['clicked_id'];
		$company_year_id= $_SESSION["fy_bill_no"];
		
		$sel_estiamte="select * from estimate_total_span where `est_id`=".$clicked_id;
		$estiamte_query= mysqli_query($conn,$sel_estiamte);
		$get_estimate= mysqli_fetch_array($estiamte_query);
		$estimate_numbers= $get_estimate["estimate_numbers"];
		$explode_estimate_no=explode("/",$estimate_numbers);
		$estimates_numbers=$explode_estimate_no[2];
		$estimates_no=ltrim($estimates_numbers, '0');
		
		
		
		$update_est = "update estimate_total_span set `estimate_numbers`='0',`estimating_date`=null,`which_made`='0' where `est_id`=".$clicked_id;
		$result_updategst=mysqli_query($conn,$update_est);
	}
	else if($_POST['action_type'] == 'perfoma_restore_by_est_id'){
		$clicked_id=$_POST['clicked_id'];
		
		$save_jobs_update="update estimate_total_span SET `est_isdeleted`=0 WHERE `est_id`=".$clicked_id;
		$result_jobs_update=mysqli_query($conn,$save_jobs_update);
	}
	else if($_POST['action_type'] == 'save_dispatch_reports'){
		
		$dispatch_type=$_POST['dispatch_type'];
		$remark=$_POST['remark'];
		$receiver_name=$_POST['receiver_name'];
		$receiver_mobile=$_POST['receiver_mobile'];
		$courier_company=$_POST['courier_company'];
	    $replaced_date=str_replace('/', '-', $_POST["courier_date"]);
	    $explode_date=explode('-', $replaced_date);
		 $courier_date= $explode_date[2]."-".$explode_date[1]."-".$explode_date[0];
		$courier_docate_no=$_POST['courier_docate_no'];
		$Contact_person=$_POST['Contact_person'];
		$Contact_person_mobile=$_POST['Contact_person_mobile'];
		$address=$_POST['address'];
		$reports_no_array=explode(",",$_POST['chk_array']);
		$today_date= date('Y-m-d');
		
		//loop of multiple reports
		
		foreach($reports_no_array as $keying => $one_reports_array)
		{
			$explode_single_reports=explode("|",$one_reports_array);
			
			$trf_no=$explode_single_reports[0];
			$job_no=$explode_single_reports[1];
			$report_no=$explode_single_reports[2];
			$lab_no=$explode_single_reports[3];
			$ulr_no=$explode_single_reports[4];
			$final_mat_id=$explode_single_reports[5];
			// insert in dispatch
			 $ins_dispatch="insert into report_dispatch (`dispatch_type`,`remark`,`courier_company`,`courier_date`,`courier_docate_no`,`courier_contact_person`,`courier_contact_person_mobile`,`courier_contact_address`,`receiver_name`,`receiver_mo_no`,`trf_no`,`job_no`,`report_no`,`lab_no`,`ulr_no`,`created_by`,`created_name`,`created_date`) values('$dispatch_type','$remark','$courier_company','$courier_date','$courier_docate_no','$Contact_person','$Contact_person_mobile','$address','$receiver_name','$receiver_mobile','$trf_no','$job_no','$report_no','$lab_no','$ulr_no','$_SESSION[u_id]','$_SESSION[name]','$today_date')";
			$result_reports=mysqli_query($conn,$ins_dispatch);
			
			//update final_material_assign_master
			$update_final="update final_material_assign_master SET `dispatch_by_reception`='1' WHERE `final_material_id`=".$final_mat_id;
		    $result_final=mysqli_query($conn,$update_final);
			
		}
		
		
	}
	else if($_POST['action_type'] == 'get_peroma_for_edit')
{
	 $est_id=$_POST["abc"];
	
		 $sel_perfoma_table="select * from estimate_total_span where `est_isdeleted`=0 AND `est_id`=$est_id";
		$result_perfoma_table =mysqli_query($conn,$sel_perfoma_table);
		$get_results =mysqli_fetch_array($result_perfoma_table);
	

?>
		<table class="table" style="color: black;width:90%;text-align: center;margin-left:46px;margin-top:20px;" border="1">
		  <thead></thead>
		  <tbody>
		  
		  <tr>
		   <th colspan="6"><?php echo $get_results["perfoma_no"]; ?></th>
		  </tr>
		  
		  <tr>
		   <th>Cheque Date:</th>
		   <td><input type="text" name="cheque_date" class="form-control" id="cheque_date" value="<?php if($get_results["ch_date"] !=""){ echo date('d/m/Y',strtotime($get_results["ch_date"])); }else{ echo date('d/m/Y');} ?>"></td>
		  
		   <th>Cheque No:</th>
		   <td><input type="text" name="chequeno" class="form-control" id="chequeno" value="<?php if($get_results["chequeno"] !=""){ echo $get_results["chequeno"];}?>"></td>
		   
		   <th>Bank Name:</th>
		   <td><input type="text" name="bank_name" class="form-control" id="bank_name" value="<?php if($get_results["bank_name"] !=""){ echo $get_results["bank_name"];}?>"></td>
		  </tr>
		  
		  <tr>
		  <th colspan="2">Bill Amount:</th>
		  <td><input type="text" name="bill_amt" class="form-control" id="bill_amt" value="<?php if($get_results["total_amt"] !=""){ echo $get_results["total_amt"];}?>"></td>
		  <th colspan="2">Tds:</th>
		  <td><input type="text" name="tds" class="form-control" id="tds" value="<?php if($get_results["tds"] !=""){ echo $get_results["tds"];}?>"></td>
		  </tr>
		  
		  <tr>
		   <th>Paid Amount:</th>
		   <td><input type="text" name="paid_amt" class="form-control" id="paid_amt" value="<?php if($get_results["paid_amt"] !=""){ echo $get_results["paid_amt"];}?>"></td>
		   <th>Remarks:</th>
		   <td><textarea name="remarks" class="form-control" id="remarks"><?php if($get_results["remarks"] !=""){ echo $get_results["remarks"];}?></textarea></td>
		   <th>Cheque Amount:</th>
		   <td><input type="text" name="cheque_amt" class="form-control" id="cheque_amt" value="<?php if($get_results["cheque_amt"] !=""){ echo $get_results["cheque_amt"];}?>"></td>
		  </tr>
		  </tbody>
		  </table>
		  <table class="table" style="color: black;width:90%;text-align: center;margin-left:46px;margin-top:20px;" border="1">
		  <thead></thead>
		  <tbody>
		   <tr>
		   <td colspan="2"><b>GST TYPE</b></td>
		   <td colspan="2"><b>GRAND TOTAL</b></td>
		   <td colspan="2"><b>TDS</b></td>
		   </tr>
		   
		   <tr>
		   <td colspan="2">
		   <b><input type="radio" style="width:33px;height:25px;" name="gst_type" value="direct"><span style="font-size:32px;"><b>Direct</b></span>
			<input type="radio" style="width:33px;height:25px;" name="gst_type" value="cut_gst"><span style="font-size:32px;"><b>Cut Gst</b></span><b>
		   </td>
		   <td colspan="2">
		   <input type="text" name="grand_total" id="grand_total" value="0" class="form-control">
		   </td>
		   <td colspan="2">
		   <input type="text" name="tds_percent" id="tds_percent" value="0" class="form-control">
		   </td>
		   </tr>
		  
		  </tbody>
		  </table>
           <input type="hidden" name="hidden_est_ids" id="hidden_est_ids" value="<?php echo $get_results['est_id']; ?>" >
		  <a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d update_perfoma_by_id"  title="Merge"><span class="glyphicon glyphicon-question-ok"></span>Update</a>
		  
	<script>	
	$('#cheque_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	</script>	
<?php
}
else if($_POST['action_type'] == 'update_perfoma_by_id')
{
	    
		$replaced_date=str_replace('/', '-', $_POST["cheque_date"]);
	    $explode_date=explode('-', $replaced_date);
		$cheque_date= $explode_date[2]."-".$explode_date[1]."-".$explode_date[0];
		
		$chequeno=$_POST["chequeno"];
		$bank_name=$_POST["bank_name"];
		$bill_amt=$_POST["bill_amt"];
		$tds=$_POST["tds"];
		$paid_amt=$_POST["paid_amt"];
		$remarks=$_POST["remarks"];
		$cheque_amt=$_POST["cheque_amt"];
		$hidden_est_ids=$_POST["hidden_est_ids"];
		
		
			$upd_mat="update estimate_total_span set `ch_date`='$cheque_date',`chequeno`='$chequeno',`bank_name`='$bank_name',`tds`='$tds',`paid_amt`='$paid_amt',`remarks`='$remarks',`cheque_amt`='$cheque_amt',`total_amt`='$bill_amt' where `est_id`=$hidden_est_ids";
		    $result_upd_reports=mysqli_query($conn,$upd_mat);
		
	
}

else if($_POST['action_type'] == 'get_notes'){
		$clicked_id=$_POST['clicked_id'];
		$sel_final="select * from final_material_assign_master where `is_deleted`=0 AND `final_material_id`=".$clicked_id;
		$result_final =mysqli_query($conn,$sel_final);
		$get_final =mysqli_fetch_array($result_final);
		
		$notes_by_tm =$get_final["notes_by_tm"];
		$final_material_id =$get_final["final_material_id"];
		
		$fill=array("notes_by_tm" => $notes_by_tm,"final_material_id" => $final_material_id);
		
		echo json_encode($fill);
		exit;
		
	}
else if($_POST['action_type'] == 'update_notes'){
		$txt_note=$_POST['txt_note'];
		$final_material_id=$_POST['final_material_id'];
		
		$upd_final="update final_material_assign_master set `notes_by_tm`='$txt_note' where `final_material_id`=".$final_material_id;
		mysqli_query($conn,$upd_final);
		
		$fill=array("msg" => "Success");
		
		echo json_encode($fill);
		exit;
		
	}
}

function get_report_no($start_date,$nums,$dating)
{
	$stop_date= $start_date;
	$starting= intval($nums);
	$date_array=array();
	$num_array=array();
	for($i=1;$i<=365;$i++)
	{
		
		array_push($date_array,date('Y-m-d', strtotime($stop_date)));
		$stop_date= date('Y-m-d', strtotime($stop_date . ' +1 day'));
		array_push($num_array,$starting);
		$starting= intval($starting) + 100;
	}
		  $keys= array_search($dating,$date_array);
		  return $get_number=$num_array[$keys];
	
}
?>
