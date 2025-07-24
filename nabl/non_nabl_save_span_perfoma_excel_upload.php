<?php
session_start();
include("connection.php");
include("connection_of_non_nabl_in_nabl.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'get_table_after_update'){
		
		// get all id by explode
		$select_exploded= explode("|",$_POST["id"]);
		$achive_rates_type=$select_exploded[0];
		$txt_trf_no=$select_exploded[1];
		$achive_jobs=$select_exploded[2];
		$gst_type=$select_exploded[3];
		$in_or_ex=$select_exploded[4];
		$txt_grand=$select_exploded[5];
		$txt_temporary_trf_no=$select_exploded[6];
		
		
				
				// without gst code
				if($gst_type=="without_gst" && $in_or_ex==""){
					
					$cgst= 0;
					$sgst= 0;
					$igst=0;
					$grand_total= $txt_grand;
					$net_total= $grand_total + $cgst + $sgst;
					$get_total_amt_in_word=numtowords($net_total);
					
				}
				
				// with gst code include
				if($gst_type=="with_gst" && $in_or_ex=="include"){
					
					$count_gst= intval($txt_grand) / 1.18;
					$both_gst_c_s= intval($txt_grand)- intval($count_gst);
					$cgst= intval($both_gst_c_s)/2;
					$sgst= intval($both_gst_c_s)/2;
					$igst=0;
					
					$grand_total= intval($txt_grand)- intval($both_gst_c_s);
					$net_total= $grand_total + $cgst + $sgst + $igst;
					$get_total_amt_in_word=numtowords($net_total);
				
				} 
				
				// with gst code exclude
				if($gst_type=="with_gst" && $in_or_ex=="exclude"){
					
					$count_gst= intval($txt_grand) * 1.18;
					$both_gst_c_s= intval($count_gst)- intval($txt_grand);
					$cgst= intval($both_gst_c_s)/2;
					$sgst= intval($both_gst_c_s)/2;
					$igst=0;
					
					$grand_total= $txt_grand;
					$net_total= $grand_total + $cgst + $sgst + $igst;
					$get_total_amt_in_word=numtowords($net_total);
				
				}
				
				// with igst code include
				if($gst_type=="with_igst" && $in_or_ex=="include"){
					
					$count_gst= intval($txt_grand) / 1.18;
					$both_gst_c_s= intval($txt_grand)- intval($count_gst);
					$cgst= 0;
					$sgst= 0;
					$igst=$both_gst_c_s;
					
					$grand_total= intval($txt_grand)- intval($both_gst_c_s);
					$net_total= $grand_total + $cgst + $sgst + $igst;
					$get_total_amt_in_word=numtowords($net_total);
				
				} 
				
				// with igst code exclude
				if($gst_type=="with_igst" && $in_or_ex=="exclude"){
					
					$count_gst= intval($txt_grand) * 1.18;
					$both_gst_c_s= intval($count_gst)- intval($txt_grand);
					$cgst= 0;
					$sgst= 0;
					$igst=$both_gst_c_s;
					
					$grand_total= $txt_grand;
					$net_total= $grand_total + $cgst + $sgst + $igst;
					$get_total_amt_in_word=numtowords($net_total);
				
				} 
				
				
				$fill=array("cgst" => $cgst,"sgst" => $sgst,"igst" => $igst,"grand_total" => $grand_total,"net_total" => $net_total,"get_total_amt_in_word" => $get_total_amt_in_word);
			
				echo json_encode($fill);				
		
		
		
	}else if($_POST['action_type'] == 'change_amt_in_word'){
		
		$total_amt= $_POST["total_amt"];
		$get_total_amt_in_word=numtowords(intval($total_amt));
		$fill=array("get_total_amt_in_word" => $get_total_amt_in_word);
			
		echo json_encode($fill);
		
	}else if($_POST['action_type'] == 'save_next_estimate_only_save')
	{
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_temporary_trf_no= $_POST["txt_temporary_trf_no"];
		$explode_trf=explode(",",$txt_trf_no);
		$explode_temporary_trf_no=explode(",",$txt_temporary_trf_no);
		foreach($explode_trf as $keyed => $one_trf)
		{
			$txt_trf_no=$one_trf;
			$txt_job_no=$one_trf;
			
			$txt_temporary_trf_no=$explode_temporary_trf_no[$keyed];
			
			$update_save_material_assign="update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";
			$result_save_material_assign=mysqli_query($conn_of_non,$update_save_material_assign);
			
			$get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";
			$resultset = mysqli_query($conn_of_non, $get_job_data);
			if(mysqli_num_rows($resultset)>0)
			{
				$get_datas = mysqli_fetch_array($resultset);
				$report_sent_to = $get_datas['report_sent_to'];
				if($report_sent_to=="0")
				{
					$update_gst = "update job set client_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";				
				}
				else
				{
					$update_gst = "update job set agency_gstno='$gst_no',`perfoma_completed_by_biller`=1 where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";
				}
				$result_updategst=mysqli_query($conn_of_non,$update_gst);
			}
				
			// get morr by report no andjob no
			$sel_span_mate="select * from span_material_assign where `trf_no`='$txt_trf_no' AND `job_number`='$txt_job_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";
			$query_span_mate=mysqli_query($conn_of_non,$sel_span_mate);
			$get_span_mate= mysqli_fetch_assoc($query_span_mate);
			
			$get_morr=$get_span_mate["morr"];
			$get_job_number=$get_span_mate["job_number"];
			$expected_date=$get_span_mate["expected_date"];
			$tested_by=$get_span_mate["tested_by"];
			$reported_by=$get_span_mate["reported_by"];
			
			
			// code to get sample receve date from job table
			$sel_jobs="select * from job where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";
			$query_jobs=mysqli_query($conn_of_non,$sel_jobs);
			$result_jobs=mysqli_fetch_array($query_jobs);
			$get_sample_rec_date= $result_jobs["sample_rec_date"];
			
			
			// update  morr and job_lab_assign in job table
			
			if($get_morr=="m"){
				$j_n_progress=0;
				$report_printing=0;
				$set_expected_date="0000-00-00";
				$set_re_sample_date="0000-00-00";
				
			}else{
				$j_n_progress=1;
				$report_printing=1;
				$set_expected_date=$expected_date;
				$set_re_sample_date=$get_sample_rec_date;
			}
			
			
			
			$update_jobs="update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`tested_by`='$tested_by',`reported_by`='$reported_by',`admin_special_light`=3,`print_done_by_biller_for_qm_see`=1 where `trf_no`='$txt_trf_no' AND `temporary_trf_no`='$txt_temporary_trf_no'";
			$query_update_jobs=mysqli_query($conn_of_non,$update_jobs);
		}
	}else if($_POST['action_type'] == 'upload_excel')
	{
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_temporary_trf_no= $_POST["txt_temporary_trf_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$gst_no= $_POST["gst_no"];
		$hsn_codes= $_POST["hsn_codes"];
		$squence_no= $_POST["squence_no"];
		$perfoma_no= $_POST["perfoma_no"];
		$txt_invoice_no= $_POST["txt_invoice_no"];
		$replace_date= str_replace("/","-",$_POST['invoice_date']);
		$invoice_date= date('Y-m-d', strtotime($replace_date));
		$select_rate_explode= explode("|",$_POST["select_rate"]);
		$select_rate=$select_rate_explode[0];
		$hidden_gst_type= $_POST["hidden_gst_type"];
		$hidden_gst_in_ex= $_POST["hidden_gst_in_ex"];
		$txt_cgst= $_POST["txt_cgst"];
		$txt_sgst= $_POST["txt_sgst"];
		$txt_igst= $_POST["txt_igst"];
		$txt_grand= $_POST["txt_grand"];
		$txt_amt_in_word= $_POST["txt_amt_in_word"];
		$total_amt= $_POST["total_amt"];
		$hidden_agency= $_POST["hidden_agency"];
		$test_ids_array= $_POST["test_ids_array"];
		$test_name_array= $_POST["test_name_array"];
		$test_qty_array= $_POST["test_qty_array"];
		$test_rates_array= $_POST["test_rates_array"];
		$test_amnt_array= $_POST["test_amnt_array"];
		$test_mate_array= $_POST["test_mate_array"];
		
		if(isset($_FILES["file"]["name"]))
			{
				$explode_perfoma_no=explode("/",$perfoma_no);
				$set_document_no=$explode_perfoma_no[3];
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$filename= $set_document_no.".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'perfoma_excel/';
				move_uploaded_file($tmp_name,$path.$filename);
			}else{
				$filename="";
				
			}
			
		
		$todays=date("Y-m-d");	
		$insert_estimate="insert into estimate_total_span (`temporary_trf_no`,`trf_no`,`job_no`,`estimate_no`,`estimate_sequence_maintain`,`perfoma_no`,`gst_no`,`hsn_codes`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`gst_in_or_ex`,`test_ids`,`test_name`,`test_qty`,`test_rates`,`test_totals`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`,`mate_name`,`perfoma_type`,`perfoma_excel_upload`,`nabl_type`) 
						values(
						'$txt_temporary_trf_no',
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$squence_no',
						'$perfoma_no',
						'$gst_no',
						'$hsn_codes',
						'$invoice_date',
						'$hidden_agency',
						'$select_rate',
						'$hidden_gst_type',
						'$hidden_gst_in_ex',
						'$test_ids_array',
						'$test_name_array',
						'$test_qty_array',
						'$test_rates_array',
						'$test_amnt_array',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'$todays',
						'',
						'0000-00-00',
						'$test_mate_array',
						'excel',
						'$filename',
						'non_nabl')";
						$result_insert_estimate=mysqli_query($conn,$insert_estimate);
						$fill = array($result_insert_estimate);
					    echo json_encode($fill);
		
		
	}else if($_POST['action_type'] == 'delete_perfoma_excel')
	{
		
		$perfoma_no= $_POST["perfoma_no"];
		$del_perf="update estimate_total_span set `est_isdeleted`=1 where `perfoma_no`='$perfoma_no'";
		$delt_perfoma=mysqli_query($conn,$del_perf);
		$fill = array($delt_perfoma);
		echo json_encode($fill);
		
		
	}
	else if($_POST['action_type'] == 'set_perfoma_no_by_invoice_date')
	{
			 $dating = str_replace('/', '-', $_POST["invoice_date"] );
			 $invoice_dates = date("Y-m-d", strtotime($dating));
			 $minus_one= date('Y-m-d', strtotime('-1 day', strtotime($invoice_dates)));
			 $minus_two= date('Y-m-d', strtotime('-2 day', strtotime($invoice_dates)));
			 $minus_three= date('Y-m-d', strtotime('-3 day', strtotime($invoice_dates)));

			 // jo invoice date ma perfoma hoy to 
			 $sel_estiamte_by_date="SELECT * FROM estimate_total_span where estimate_date='$invoice_dates' ORDER BY est_id DESC";
			 $query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);

			
			if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) 
			{
				$result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
				$get_sequence= $result_estimate["estimate_sequence_maintain"];
				//$plus_squence= intval($get_sequence)+1;
				$plus_squence= "0";
				
				$get_perfoma_no= $result_estimate["perfoma_no"];
				
				// if old no with - available so add one in it
				if (strpos($get_perfoma_no, '-') !== false) 
				{
					$explode_perfomas=explode("-",$get_perfoma_no);
					$plus_perfoma= intval($explode_perfomas[1])+1;
					
					$set_perfoma_no= $explode_perfomas[0]."-".$plus_perfoma;
				}else
				{
					$set_perfoma_no= $get_perfoma_no."-1";
				}
				
			}
			else
			{
				// jo invoice date thi 1 day back ma perfoma hoy to
				$sel_estiamte_by_date="SELECT * FROM estimate_total_span where estimate_date='$minus_one' ORDER BY est_id DESC";
				$query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);
				
				if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) 
				{
					$result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
					$get_sequence= $result_estimate["estimate_sequence_maintain"];
					//$plus_squence= intval($get_sequence)+1;
				   $plus_squence= "0";
					
					$get_perfoma_no= $result_estimate["perfoma_no"];
					
					// if old no with - available so add one in it
					if (strpos($get_perfoma_no, '-') !== false) 
					{
						$explode_perfomas=explode("-",$get_perfoma_no);
						$plus_perfoma= intval($explode_perfomas[1])+1;
						
						$set_perfoma_no= $explode_perfomas[0]."-".$plus_perfoma;
					}else
					{
						$set_perfoma_no= $get_perfoma_no."-1";
					}
					
				}
				else
				{
					// jo invoice date thi 2 day back ma perfoma hoy to
					$sel_estiamte_by_date="SELECT * FROM estimate_total_span where estimate_date='$minus_two' ORDER BY est_id DESC";
					$query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);
					if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) 
					{
						$result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
						$get_sequence= $result_estimate["estimate_sequence_maintain"];
						//$plus_squence= intval($get_sequence)+1;
				        $plus_squence= "0";
						
						$get_perfoma_no= $result_estimate["perfoma_no"];
						
						// if old no with - available so add one in it
						if (strpos($get_perfoma_no, '-') !== false) 
						{
							$explode_perfomas=explode("-",$get_perfoma_no);
							$plus_perfoma= intval($explode_perfomas[1])+1;
							
							$set_perfoma_no= $explode_perfomas[0]."-".$plus_perfoma;
						}else
						{
							$set_perfoma_no= $get_perfoma_no."-1";
						}
						
					}
					else
					{
						// jo invoice date thi 3 day back ma perfoma hoy to
						$sel_estiamte_by_date="SELECT * FROM estimate_total_span where estimate_date='$minus_three' ORDER BY est_id DESC";
						$query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);
						if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) 
						{
							$result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
							$get_sequence= $result_estimate["estimate_sequence_maintain"];
							//$plus_squence= intval($get_sequence)+1;
				            $plus_squence= "0";
							
							$get_perfoma_no= $result_estimate["perfoma_no"];
							
							// if old no with - available so add one in it
							if (strpos($get_perfoma_no, '-') !== false) 
							{
								$explode_perfomas=explode("-",$get_perfoma_no);
								$plus_perfoma= intval($explode_perfomas[1])+1;
								
								$set_perfoma_no= $explode_perfomas[0]."-".$plus_perfoma;
							}else
							{
								$set_perfoma_no= $get_perfoma_no."-1";
							}
							
						}
						else
						{
							// jo invoice date thi 1 day aagal ma perfoma hoy to
							$dating = str_replace('/', '-', $_POST["invoice_date"] );
						    $invoice_dates = date("Y-m-d", strtotime($dating));
							
							function dateDiff($date1, $date2) 
							{
							  $date1_ts = strtotime($date1);
							  $date2_ts = strtotime($date2);
							  $diff = $date2_ts - $date1_ts;
							  return round($diff / 86400);
							}
							  $dateDiff_day= dateDiff($invoice_dates, date("Y-m-d"));
							  
							  for($i=1; $i <= $dateDiff_day; $i++)
							  {
								    $plus_one= date('Y-m-d', strtotime('+'.$i.' day', strtotime($invoice_dates)));
									
									$sel_estiamte_by_date="SELECT * FROM estimate_total_span where estimate_date='$plus_one' ORDER BY est_id ASC";
									$query_sel_estiamte_by_date = mysqli_query($conn, $sel_estiamte_by_date);
									if (mysqli_num_rows($query_sel_estiamte_by_date) > 0) 
									{
										$result_estimate = mysqli_fetch_assoc($query_sel_estiamte_by_date);
										$get_sequence= $result_estimate["estimate_sequence_maintain"];
										//$plus_squence= intval($get_sequence)+1;
										$plus_squence= "0";
										
										$get_perfoma_no= $result_estimate["perfoma_no"];
										
										// if old no with - available so add one in it
										if (strpos($get_perfoma_no, '-') !== false) 
										{
											$explode_perfomas=explode("-",$get_perfoma_no);
											$plus_perfoma= intval($explode_perfomas[1])+1;
											
											$set_perfoma_no= $explode_perfomas[0]."-".$plus_perfoma;
										}else
										{
											$set_perfoma_no= $get_perfoma_no."-1";
										}
										break;
									}
								 
							  }
							  
						}
					}
				}
				
			}
		
			$fill=array("set_perfoma_no" => $set_perfoma_no,"plus_squence" => $plus_squence);
			
			echo json_encode($fill);
	}
	else if($_POST['action_type'] == 'save_next_estimate_only_save_final_bill')
	{
		
		$txt_report_no= $_POST["txt_report_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$gst_no= $_POST["gst_no"];
		$txt_invoice_no= $_POST["txt_invoice_no"];
		$replace_date= str_replace("/","-",$_POST['invoice_date']);
		$invoice_date= date('Y-m-d', strtotime($replace_date));
		$select_rate_explode= explode("|",$_POST["select_rate"]);
		$select_rate=$select_rate_explode[0];
		$hidden_gst_type= $_POST["hidden_gst_type"];
		$txt_cgst= $_POST["txt_cgst"];
		$txt_sgst= $_POST["txt_sgst"];
		$txt_igst= $_POST["txt_igst"];
		$txt_grand= $_POST["txt_grand"];
		$txt_amt_in_word= $_POST["txt_amt_in_word"];
		$total_amt= $_POST["total_amt"];
		$hidden_agency= $_POST["hidden_agency"];
		
		
		$get_job_data = "select * from job WHERE `report_no`='$txt_report_no'";
		$resultset = mysqli_query($conn, $get_job_data);
		if(mysqli_num_rows($resultset)>0)
		{
			$get_datas = mysqli_fetch_array($resultset);
			$report_sent_to = $get_datas['report_sent_to'];
			if($report_sent_to=="0")
			{
				$update_gst = "update job set client_gstno='$gst_no' where `report_no`='$txt_report_no'";				
			}
			else
			{
				$update_gst = "update job set agency_gstno='$gst_no' where `report_no`='$txt_report_no'";
			}
			$result_updategst=mysqli_query($conn,$update_gst);
		
		    $clients_ids = $get_datas['client_code'];
			$authority = $get_datas['person_name'];
			$agreement_no = $get_datas['agreement_no'];
		}
		else
		{
			$clients_ids = 0;
			$authority = "";
			$agreement_no = "";
		}
		
		$sel_estimate="select * from estimate_total_span_only_bill where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$sel_estimate);
		
		if(mysqli_num_rows($result_estimate) > 0){
			
		$update_est="update estimate_total_span_only_bill set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`client_id`=$clients_ids,`authority`='$authority',`agreement_no`='$agreement_no',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word' where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$update_est);
		
		  $update_save_material_assign="update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
			
		}else
		{
		
		$insert_estimate="insert into estimate_total_span_only_bill (`report_no`,`job_no`,`estimate_no`,`estimate_date`,`agency_id`,`client_id`,`authority`,`agreement_no`,`rate_type`,`gst_type`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`) 
						values(
						'$txt_report_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$hidden_agency',
						 $clients_ids,
						'$authority',
						'$agreement_no',
						'$select_rate',
						'$hidden_gst_type',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00')";
	    $result_insert_estimate=mysqli_query($conn,$insert_estimate);
		
		 $update_save_material_assign="update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
		}
			
		// get morr by report no andjob no
		$sel_span_mate="select * from span_material_assign where `report_no`='$txt_report_no' AND `job_number`='$txt_job_no'";
		$query_span_mate=mysqli_query($conn,$sel_span_mate);
		$get_span_mate= mysqli_fetch_assoc($query_span_mate);
		
		$get_morr=$get_span_mate["morr"];
		$get_job_number=$get_span_mate["job_number"];
		$expected_date=$get_span_mate["expected_date"];
		$tested_by=$get_span_mate["tested_by"];
		$reported_by=$get_span_mate["reported_by"];
		
		
		// code to get sample receve date from job table
		$sel_jobs="select * from job where `report_no`='$txt_report_no'";
		$query_jobs=mysqli_query($conn,$sel_jobs);
		$result_jobs=mysqli_fetch_array($query_jobs);
		$get_sample_rec_date= $result_jobs["sample_rec_date"];
		
		
		// update  morr and job_lab_assign in job table
		
		if($get_morr=="m"){
			$j_n_progress=0;
			$report_printing=0;
			$set_expected_date="0000-00-00";
			$set_re_sample_date="0000-00-00";
			
		}else{
			$j_n_progress=1;
			$report_printing=1;
			$set_expected_date=$expected_date;
			$set_re_sample_date=$get_sample_rec_date;
		}
		
		
		
		$update_jobs="update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`tested_by`='$tested_by',`reported_by`='$reported_by',`admin_special_light`=4 where `report_no`='$txt_report_no'";
		$query_update_jobs=mysqli_query($conn,$update_jobs);
	}
	else if($_POST['action_type'] == 'get_bill_for_edit')
{
	 $id_array=$_POST["abc"];
	$set_array=explode("|",$id_array);
	$what=$set_array[0];
	$est_id=$set_array[1];
	if($what=="test_mathi")
	{
		 $sel_test_table="select * from estimate_total_span_only_for_test where `est_isdeleted`=0 AND `est_id`=$est_id";
		$result_test_table =mysqli_query($conn,$sel_test_table);
		$get_results =mysqli_fetch_array($result_test_table);
	}
	if($what=="mat_mathi")
	{
		 $sel_mat_table="select * from estimate_total_span_only_for_material where `est_isdeleted`=0 AND `est_id`=$est_id";
		$result_mat_table =mysqli_query($conn,$sel_mat_table);
		$get_results =mysqli_fetch_array($result_mat_table);
	}
	
?>
		<table class="table" style="color: black;width:90%;text-align: center;margin-left:46px;margin-top:20px;" border="1">
		  <thead></thead>
		  <tbody>
		  
		  <tr>
		   <th colspan="6"><?php echo $get_results["bill_no"]; ?></th>
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
		   <th>Old Bill No:</th>
		   <td><input type="text" name="old_bill_no" class="form-control" id="old_bill_no" value="<?php if($get_results["old_bill_no"] !=""){ echo $get_results["old_bill_no"];}?>"></td>
		  <th>Bill Amount:</th>
		  <td><input type="text" name="bill_amt" class="form-control" id="bill_amt" value="<?php if($get_results["total_amt"] !=""){ echo $get_results["total_amt"];}?>"></td>
		  <th>Tds:</th>
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
           <input type="hidden" name="hidden_what_and_ids" id="hidden_what_and_ids" value="<?php echo $what."|".$est_id;?>">
		  <a href="javascript:void(0);" class="btn btn-primary btn-lg btn3d update_bill_by_id"  title="Merge"><span class="glyphicon glyphicon-question-ok"></span>Update</a>
		  
	<script>	
	$('#cheque_date').datepicker({
			autoclose: true,
			format: 'dd/mm/yyyy'
		});
	</script>	
<?php
}
else if($_POST['action_type'] == 'cancel_bill_by_id')
{
	$bill_ids=$_POST["abc"];
	$upd_bill="update estimate_total_span_bill_sequence set `is_deleted`=1 where `bill_no`='$bill_ids'";
    $result_bill=mysqli_query($conn,$upd_bill);
	
}
else if($_POST['action_type'] == 'restore_bill_by_id')
{
	$bill_ids=$_POST["abc"];
	$upd_bill="update estimate_total_span_bill_sequence set `is_deleted`=0 where `bill_no`='$bill_ids'";
    $result_bill=mysqli_query($conn,$upd_bill);
	
}
else if($_POST['action_type'] == 'update_bill_by_id')
{
	    
		$replaced_date=str_replace('/', '-', $_POST["cheque_date"]);
	    $explode_date=explode('-', $replaced_date);
		$cheque_date= $explode_date[2]."-".$explode_date[1]."-".$explode_date[0];
		
		$chequeno=$_POST["chequeno"];
		$bank_name=$_POST["bank_name"];
		$old_bill_no=$_POST["old_bill_no"];
		$bill_amt=$_POST["bill_amt"];
		$tds=$_POST["tds"];
		$paid_amt=$_POST["paid_amt"];
		$remarks=$_POST["remarks"];
		$cheque_amt=$_POST["cheque_amt"];
		$hidden_what_and_ids=explode("|",$_POST["hidden_what_and_ids"]);
		$what=$hidden_what_and_ids[0];
		$est_ids=$hidden_what_and_ids[1];
		
		if($what=="mat_mathi")
		{
			$upd_mat="update estimate_total_span_only_for_material set `ch_date`='$cheque_date',`chequeno`='$chequeno',`bank_name`='$bank_name',`tds`='$tds',`paid_amt`='$paid_amt',`remarks`='$remarks',`cheque_amt`='$cheque_amt',`old_bill_no`='$old_bill_no',`total_amt`='$bill_amt' where `est_id`=$est_ids";
		    $result_upd_reports=mysqli_query($conn,$upd_mat);
		}
		if($what=="test_mathi")
		{
			echo $upd_mat="update estimate_total_span_only_for_test set `ch_date`='$cheque_date',`chequeno`='$chequeno',`bank_name`='$bank_name',`tds`='$tds',`paid_amt`='$paid_amt',`remarks`='$remarks',`cheque_amt`='$cheque_amt',`old_bill_no`='$old_bill_no',`total_amt`='$bill_amt' where `est_id`=$est_ids";
		    $result_upd_reports=mysqli_query($conn,$upd_mat);
		}
}
}

// convert in word function_exists
function numtowords($num){
	$number = $num;
   $no = round($number);
   $point = round($number - $no, 2) * 100;
   $hundred = null;
   $digits_1 = strlen($no);
   $i = 0;
   $str = array();
   $words = array('0' => '', '1' => 'one', '2' => 'two',
    '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
    '7' => 'seven', '8' => 'eight', '9' => 'nine',
    '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
    '13' => 'thirteen', '14' => 'fourteen',
    '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
    '18' => 'eighteen', '19' =>'nineteen', '20' => 'twenty',
    '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
    '60' => 'sixty', '70' => 'seventy',
    '80' => 'eighty', '90' => 'ninety');
   $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
   while ($i < $digits_1) {
     $divider = ($i == 2) ? 10 : 100;
     $number = floor($no % $divider);
     $no = floor($no / $divider);
     $i += ($divider == 10) ? 1 : 2;
     if ($number) {
        $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
        $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
        $str [] = ($number < 21) ? $words[$number] .
            " " . $digits[$counter] . $plural . " " . $hundred
            :
            $words[floor($number / 10) * 10]
            . " " . $words[$number % 10] . " "
            . $digits[$counter] . $plural . " " . $hundred;
     } else $str[] = null;
  }
  $str = array_reverse($str);
  $result = implode('', $str);
  $points = ($point) ?
    "." . $words[$point / 10] . " " . 
          $words[$point = $point % 10] : '';
 // return $result . "Rupees  " . $points;
 return $result . "Rupees  ";
}
?>
