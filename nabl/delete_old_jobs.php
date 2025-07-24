
<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'delete_old_jobs'){
		
		$trf_no=$_POST["trf_no"];
		$job_no=$_POST["job_no"];
		$lab_no=$_POST["lab_no"];
		$report_no=$_POST["report_no"];
		$ulr_no=$_POST["ulr_no"];
		$old_date=date("Y-m-d",strtotime($_POST["old_date"]));
		$temporary_trf_no=$_POST["temporary_trf_no"];
		$chek_date=date("Y-m-d",strtotime($_POST["chek_date"]));
		
		//select from job table
		$sel_job = "select  * from job where `trf_no`='$trf_no' AND `temporary_trf_no`='$temporary_trf_no'";
        $query_job = mysqli_query($conn, $sel_job);
        $row_job = mysqli_fetch_array($query_job);
		$job_id=$row_job["job_id"];
		
		//select from final table
		$sel_final = "select  * from final_material_assign_master where `trf_no`='$trf_no' AND `job_no`='$job_no' AND `lab_no`='$lab_no' AND `temporary_trf_no`='$temporary_trf_no'";
        $query_final = mysqli_query($conn, $sel_final);
        $row_final = mysqli_fetch_array($query_final);
		
		$final_material_id=$row_final["final_material_id"];
		$material_id=$row_final["material_id"];
		
		//select from material table
		$sel_mat = "select  * from material where `id`=".$material_id;
        $query_mat = mysqli_query($conn, $sel_mat);
        $row_mat = mysqli_fetch_array($query_mat);
		$table_name=$row_mat["table_name"];
		
		//delete from job_for)eng
		$del_eng="delete from job_for_engineer where `trf_no`='$trf_no'";
		mysqli_query($conn,$del_eng);
		
		// delete from table name
		 $del_table = "delete from $table_name WHERE report_no='$report_no' AND job_no='$job_no' AND lab_no='$lab_no'";
        mysqli_query($conn, $del_table);
		
		// delete from span table 
		$del_span = "delete from span_material_assign WHERE final_material_id='$final_material_id'";
        mysqli_query($conn, $del_span);
		
		// delete from testwise table 
		$del_wise = "delete from test_wise_material_rate WHERE final_material_id='$final_material_id'";
        mysqli_query($conn, $del_wise);
		
		// delete from final table 
		$del_final = "delete from final_material_assign_master WHERE final_material_id=".$final_material_id;
        mysqli_query($conn, $del_final);
		
		// delete from save table 
		$del_save = "delete from save_material_assign WHERE trf_no='$trf_no' AND job_no='$job_no' AND temporary_trf_no='$temporary_trf_no'";
        mysqli_query($conn, $del_save);
		
		// delete from est table 
		$del_est = "delete from estimate_total_span WHERE trf_no='$trf_no' AND job_no='$job_no'";
        mysqli_query($conn, $del_est);
		
		// update seq table 
		$up_ulr = "update job set `trf_no`='',`job_number`='',`sample_rec_date`='$chek_date',`re_generate`='yes' ,`assign_status`=1,`send_to_second_reception`=1,`material_assign`= 0,`job_lab_assign`='0',`job_lab_progress`= '0',`report_job_printing`='0',`accepted_by_qm`=0,`job_owner_eng_and_qm`=0,`any_report_done_by_any_eng`='0',`tested_by`='',`tested_by_status`='',`reported_by`='',`any_report_done_by_any_qm`='0',`all_report_done_qm`='0',`report_received`='0',`job_sent_to_qm`='0',`appoved_by_qm_to_print`='0',`report_sent_to`='0',`job_owner`='0',`job_owner_qm_and_biller`='0',`job_send_to_dispatch`='0',`eng_light_status`='0',`admin_special_light`='0',`light_indication`='0',`job_for_rec_and_biller`='0',`print_done_by_biller_for_qm_see`='0',`perfoma_completed_by_biller`='0',`job_completed_by_scanner`='0',`dispatch_by_reception`='0',`rec_to_tm`='0',`tm_to_eng_blank`='0',`tm_to_eng_blank`='0',`return_eng_to_tm`='0',`any_upload_come`='0',`all_upload_come`='0',`any_verify`='0',`all_verify`='0',`any_accept_by_tm`='0',`all_accept_by_tm`='0',`reported_by_review`=0,`reported_by_authorize`=0,`flow_status`=0,`rec_to_qm`=0,`live_status`=0 WHERE job_id=".$job_id;
        mysqli_query($conn, $up_ulr);
		
		// update job table 
		$up_job = "update ulr_sequence set `ulr_status`='3',`table_primary_key_id`='0' WHERE job_no='$job_no' AND report_no='$report_no' AND ulr_sequence_date='$old_date'";
        mysqli_query($conn, $up_job);
		
		$fill = array("statuses" => "1");
		echo json_encode($fill);
	}
}
?>
