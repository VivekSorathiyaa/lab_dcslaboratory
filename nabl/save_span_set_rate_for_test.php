<?php
session_start();
include("connection.php");

if(isset($_POST['action_type']) && !empty($_POST['action_type'])){
    if($_POST['action_type'] == 'get_data_by_rate'){
		
		$select_rate=$_POST["select_rate"];
		// get all id by explode
		$test_id_array= explode(",",$_POST["test_id_array"]);
		$test_qty_array= explode(",",$_POST["test_qty_array"]);
		$test_wise_rate_array=array();
		$test_wise_total_array=array();
		
		foreach($test_id_array as $keys => $one_test_id)
		{
			
		// get test record by test id
					$sel_test="select * from test_master where `test_id`=".$one_test_id;
					$sel_test_query=mysqli_query($conn,$sel_test);
					$get_test_record=mysqli_fetch_array($sel_test_query);
					
					//check type of rate(G,P,O)?
					if($select_rate=="0"){
						$get_rates= $get_test_record["test_rate_gov"];
						array_push($test_wise_rate_array,$get_rates);
						array_push($test_wise_total_array,($get_rates*$test_qty_array[$keys]));
						
					}
					if($select_rate=="1"){
						
						$get_rates= $get_test_record["test_rate_private"];	
						array_push($test_wise_rate_array,$get_rates);
						array_push($test_wise_total_array,($get_rates*$test_qty_array[$keys]));
					}
					if($select_rate=="2"){
						$get_rates= $get_test_record["test_rate"];
						array_push($test_wise_rate_array,$get_rates);
						array_push($test_wise_total_array,($get_rates*$test_qty_array[$keys]));
					}
		}
			$fill=array("test_wise_rate_array" => $test_wise_rate_array,"test_wise_total_array" => $test_wise_total_array);
			
			echo json_encode($fill);	
	}else if($_POST['action_type'] == 'get_table_after_update'){
		
		// get all id by explode
		$select_exploded= explode("|",$_POST["id"]);
		$achive_rates_type=$select_exploded[0];
		$txt_trf_no=$select_exploded[1];
		$achive_jobs=$select_exploded[2];
		$gst_type=$select_exploded[3];
		$in_or_ex=$select_exploded[4];
		$txt_grand=$select_exploded[5];
		
		
				
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
		
		
		
	}else if($_POST['action_type'] == 'add_estimate_only_for_material')
	{
		
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$txt_invoice_no= $_POST["txt_invoice_no"];
		$replace_date= str_replace("/","-",$_POST['invoice_date']);
		$invoice_date= date('Y-m-d', strtotime($replace_date));
		$hidden_gst_type= $_POST["hidden_gst_type"];
		$hidden_gst_in_ex= $_POST["hidden_gst_in_ex"];
		$txt_cgst= $_POST["txt_cgst"];
		$txt_sgst= $_POST["txt_sgst"];
		$txt_igst= $_POST["txt_igst"];
		$txt_grand= $_POST["txt_grand"];
		$txt_amt_in_word= $_POST["txt_amt_in_word"];
		$total_amt= $_POST["total_amt"];
		$hidden_agency= $_POST["hidden_agency"];
		$txt_sub_total= $_POST["txt_sub_total"];
		$txt_discount_percent= $_POST["txt_discount_percent"];
		$txt_discount_amount= $_POST["txt_discount_amount"];
		$txt_bill_to= $_POST["txt_bill_to"];
		
		$all_hsn_codes= $_POST["all_hsn_codes"];
		$all_material_id= $_POST["all_material_id"];
		$all_material_name= $_POST["all_material_name"];
		$all_material_qty= $_POST["all_material_qty"];
		$all_material_rates= $_POST["all_material_rates"];
		$all_material_amt= $_POST["all_material_amt"];
		
		$sel_estimate="select * from estimate_total_span_only_for_material where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$sel_estimate);
		
		if(mysqli_num_rows($result_estimate) > 0){
			
		$update_est="update estimate_total_span_only_for_material set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`bill_to`='$txt_bill_to',`agency_id`='$hidden_agency',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`sub_total`='$txt_sub_total',`discount_percent`='$txt_discount_percent',`discount_amount`='$txt_discount_amount',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`hsn_codes`='$all_hsn_codes',`all_material_id`='$all_material_id',`all_material_name`='$all_material_name',`all_material_qty`='$all_material_qty',`all_material_rates`='$all_material_rates',`all_material_amt`='$all_material_amt' where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$update_est);
		
		$update_save_material_assign="update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
			
		}else
		{
		
		$insert_estimate="insert into estimate_total_span_only_for_material (`trf_no`,`job_no`,`estimate_no`,`estimate_date`,`bill_to`,`agency_id`,`gst_type`,`gst_in_or_ex`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`sub_total`,`discount_percent`,`discount_amount`,`grand_total`,`total_amt`,`total_amt_in_word`,`hsn_codes`,`all_material_id`,`all_material_name`,`all_material_qty`,`all_material_rates`,`all_material_amt`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`) 
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$txt_bill_to',
						'$hidden_agency',
						'$hidden_gst_type',
						'$hidden_gst_in_ex',
						'$txt_cgst',
						'$txt_sgst',
						'$txt_igst',
						'$txt_sub_total',
						'$txt_discount_percent',
						'$txt_discount_amount',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$all_hsn_codes',
						'$all_material_id',
						'$all_material_name',
						'$all_material_qty',
						'$all_material_rates',
						'$all_material_amt',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00')";
	    $result_insert_estimate=mysqli_query($conn,$insert_estimate);
		
		$update_save_material_assign="update save_material_assign set `is_estimate`=1,`invoice_by_material`=1 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
		}
	}else if($_POST['action_type'] == 'set_c_s_and_amt_on_rate_change'){
		
		
		// get all id by explode
		$gst_type= $_POST["gst_type"];
		$all_material_qty= $_POST["all_material_qty"];
		$all_material_rates= $_POST["all_material_rates"];
		$all_material_amt= $_POST["all_material_amt"];
		
		$explode_all_material_qty= explode(",",$_POST["all_material_qty"]);
		$explode_all_material_rates= explode(",",$_POST["all_material_rates"]);
		
		$sum_of_all_mate_amt=0;
		
		//array_for_amt_textbox
		$push_amont=array();
		
		foreach($explode_all_material_qty as $mate_keys => $one_all_material_qty){
			
			$multific_qty_and_mate_rates= $explode_all_material_rates[$mate_keys]* $one_all_material_qty;
			$sum_of_all_mate_amt +=$multific_qty_and_mate_rates;
			
			array_push($push_amont,$multific_qty_and_mate_rates);
		}
			$get_total_amt= $sum_of_all_mate_amt;
			
				
				
				if($gst_type=="with_gst"){
					
					$sel_tax="select * from tax";
					$query_tax=mysqli_query($conn,$sel_tax);
					$get_tax=mysqli_fetch_array($query_tax);
					
					$cgst= $get_total_amt * $get_tax["tax_cgst"]/100;
					$sgst= $get_total_amt * $get_tax["tax_sgst"]/100;
					$igst=0;
					$grand_total= $get_total_amt;
					$net_total= $grand_total + $cgst + $sgst;
					$get_total_amt_in_word=numtowords($net_total);
					
				}elseif($gst_type=="with_igst"){
					
					$sel_tax="select * from tax";
					$query_tax=mysqli_query($conn,$sel_tax);
					$get_tax=mysqli_fetch_array($query_tax);
					
					$cgst= 0;
					$sgst= 0;
					$igst=$get_total_amt * $get_tax["tax_igst"]/100;;
					$grand_total= $get_total_amt;
					$net_total= $grand_total + $igst;
					$get_total_amt_in_word=numtowords($net_total);
				}else{
					
					$cgst= 0;
					$sgst= 0;
					$igst=0;
					$grand_total= $get_total_amt;
					$net_total= $grand_total + $cgst + $sgst;
					$get_total_amt_in_word=numtowords($net_total);
					
				}
				
				$fill=array("cgst" => round($cgst),"sgst" => round($sgst),"igst" => round($igst),"grand_total" => round($grand_total),"net_total" => round($net_total),"get_total_amt_in_word" => $get_total_amt_in_word,"push_amont" =>$push_amont);
			
				echo json_encode($fill);				
		
		
		
	}else if($_POST['action_type'] == 'set_c_s_and_amt'){
		
		// get all id by explode
		$gst_type= $_POST["gst_type"];
		$in_or_ex= $_POST["in_or_ex"];
		$all_material_qty= $_POST["all_material_qty"];
		$all_material_rates= $_POST["all_material_rates"];
		$all_material_amt= $_POST["all_material_amt"];
		
		$get_total_amt= $all_material_amt;
			
				
				
				if($gst_type=="with_gst"){
					
					$sel_tax="select * from tax";
					$query_tax=mysqli_query($conn,$sel_tax);
					$get_tax=mysqli_fetch_array($query_tax);
					
					$cgst= $get_total_amt * $get_tax["tax_cgst"]/100;
					$sgst= $get_total_amt * $get_tax["tax_sgst"]/100;
					$igst=0;
					$grand_total= $get_total_amt;
					$net_total= $grand_total + $cgst + $sgst;
					$get_total_amt_in_word=numtowords($net_total);
					
				}
				if($gst_type=="with_igst"){
					
					$sel_tax="select * from tax";
					$query_tax=mysqli_query($conn,$sel_tax);
					$get_tax=mysqli_fetch_array($query_tax);
					
					$cgst= 0;
					$sgst= 0;
					$igst=$get_total_amt * $get_tax["tax_igst"]/100;;
					$grand_total= $get_total_amt;
					$net_total= $grand_total + $igst;
					$get_total_amt_in_word=numtowords($net_total);
				}
				if($gst_type=="without_gst" && $in_or_ex==""){
					
					$cgst= 0;
					$sgst= 0;
					$igst=0;
					$grand_total= $get_total_amt;
					$net_total= $grand_total + $cgst + $sgst;
					$get_total_amt_in_word=numtowords($net_total);
					
				}
				
				$fill=array("cgst" => round($cgst),"sgst" => round($sgst),"igst" => round($igst),"grand_total" => round($grand_total),"net_total" => round($net_total),"get_total_amt_in_word" => $get_total_amt_in_word);
			
				echo json_encode($fill);				
		
		
		
	}else if($_POST['action_type'] == 'update_rates'){
		
		// get all id by explode
		$get_rate=$_POST["get_rate"];
		$get_qty=$_POST["get_qty"];
		$get_amts= $get_rate * $get_qty;
		$get_test_id=$_POST["get_test_id"];

		$update_test_wise="update test_wise_material_rate set `rate`='$get_rate',`amt`='$get_amts' where `test_wise_id`=".$get_test_id;
		$result_update_test_wise=mysqli_query($conn,$update_test_wise);
				
    }else if($_POST['action_type'] == 'add_estimate')
	{
		
		$txt_trf_no= $_POST["txt_trf_no"];
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
		
		
		$get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
		$resultset = mysqli_query($conn, $get_job_data);
		if(mysqli_num_rows($resultset)>0)
		{
			$get_datas = mysqli_fetch_array($resultset);
			$report_sent_to = $get_datas['report_sent_to'];
			if($report_sent_to=="0")
			{
				$update_gst = "update job set client_gstno='$gst_no' where `trf_no`='$txt_trf_no'";				
			}
			else
			{
				$update_gst = "update job set agency_gstno='$gst_no' where `trf_no`='$txt_trf_no'";
			}
			$result_updategst=mysqli_query($conn,$update_gst);
		}
		
		$sel_estimate="select * from estimate_total_span where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$sel_estimate);
		
		if(mysqli_num_rows($result_estimate) > 0){
			
		$update_est="update estimate_total_span set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word' where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$update_est);
		
		$update_save_material_assign="update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
			
		}else
		{
		
		$insert_estimate="insert into estimate_total_span (`trf_no`,`job_no`,`estimate_no`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`) 
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$hidden_agency',
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
		
		$update_save_material_assign="update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
		}
	}else if($_POST['action_type'] == 'save_next_estimate')
	{
		
		$txt_report_no= $_POST["txt_report_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$gst_no= $_POST["gst_no"];
		$txt_invoice_no= $_POST["txt_invoice_no"];
		$replace_date= str_replace("/","-",$_POST['invoice_date']);
		$invoice_date= date('Y-m-d', strtotime($replace_date));
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
		}
		
		$sel_estimate="select * from estimate_total_span where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$sel_estimate);
		
		if(mysqli_num_rows($result_estimate) > 0){
			
		$update_est="update estimate_total_span set `estimate_no`='$txt_invoice_no',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`gst_type`='$hidden_gst_type',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word' where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$update_est);
		
		  $update_save_material_assign="update save_material_assign set `is_estimate`=1,`isstatus`=3 where `report_no`='$txt_report_no' AND `job_no`='$txt_job_no'";
		$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
			
		}else
		{
		
		$insert_estimate="insert into estimate_total_span (`report_no`,`job_no`,`estimate_no`,`estimate_date`,`agency_id`,`gst_type`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`) 
						values(
						'$txt_report_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$invoice_date',
						'$hidden_agency',
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
		
		
		
		$update_jobs="update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`tested_by`='$tested_by',`reported_by`='$reported_by',`admin_special_light`=3 where `report_no`='$txt_report_no'";
		$query_update_jobs=mysqli_query($conn,$update_jobs);
	}else if($_POST['action_type'] == 'save_next_estimate_only_save')
	{
		
		$txt_trf_no= $_POST["txt_trf_no"];
		$txt_job_no= $_POST["txt_job_no"];
		$gst_no= $_POST["gst_no"];
		$hsn_codes= $_POST["hsn_codes"];
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
		$txt_sub_total= $_POST["txt_sub_total"];
		$txt_discount_percent= $_POST["txt_discount_percent"];
		$txt_discount_amount= $_POST["txt_discount_amount"];
		$txt_bill_to= $_POST["txt_bill_to"];
		$bill_no= $_POST["bill_no"];
		$hidden_agency= $_POST["hidden_agency"];
		$test_ids_array= $_POST["test_ids_array"];
		$test_name_array= $_POST["test_name_array"];
		$test_qty_array= $_POST["test_qty_array"];
		$test_rates_array= $_POST["test_rates_array"];
		$test_amnt_array= $_POST["test_amnt_array"];
		
		 
		
		
		$get_job_data = "select * from job WHERE `trf_no`='$txt_trf_no'";
		$resultset = mysqli_query($conn, $get_job_data);
		if(mysqli_num_rows($resultset)>0)
		{
			$get_datas = mysqli_fetch_array($resultset);
			$report_sent_to = $get_datas['report_sent_to'];
			if($report_sent_to=="0")
			{
				$update_gst = "update job set client_gstno='$gst_no' where `trf_no`='$txt_trf_no'";				
			}
			else
			{
				$update_gst = "update job set agency_gstno='$gst_no' where `trf_no`='$txt_trf_no'";
			}
			$result_updategst=mysqli_query($conn,$update_gst);
		}
		
		$sel_estimate="select * from estimate_total_span_only_for_test where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$sel_estimate);
		
		if(mysqli_num_rows($result_estimate) > 0){
			
	    $update_est="update estimate_total_span_only_for_test set `estimate_no`='$txt_invoice_no',`bill_to`='$txt_bill_to',`gst_no`='$gst_no',`hsn_codes`='$hsn_codes',`estimate_date`='$invoice_date',`agency_id`='$hidden_agency',`rate_type`='$select_rate',`gst_type`='$hidden_gst_type',`gst_in_or_ex`='$hidden_gst_in_ex',`c_gst_amt`='$txt_cgst',`s_gst_amt`='$txt_cgst',`i_gst_amt`='$txt_igst',`grand_total`='$txt_grand',`total_amt`='$total_amt',`total_amt_in_word`='$txt_amt_in_word',`sub_total`='$txt_sub_total',`discount_percent`='$txt_discount_percent',`discount_amount`='$txt_discount_amount',`test_ids`='$test_ids_array',`test_name`='$test_name_array',`test_qty`='$test_qty_array',`test_rates`='$test_rates_array',`test_totals`='$test_amnt_array' where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		$result_estimate=mysqli_query($conn,$update_est);
		
		  
			
		}else
		{
		
				// bill sequence logic
			 $sel_estiamte_for_bill_no="select * from estimate_total_span_bill_sequence  ORDER BY bill_id DESC";
			 $query_estiamte_for_bill_no = mysqli_query($conn, $sel_estiamte_for_bill_no);
			 
			 if (mysqli_num_rows($query_estiamte_for_bill_no) > 0) 
			 {
				$result_estiamte_for_bill_no = mysqli_fetch_assoc($query_estiamte_for_bill_no);
				$explode_bill_no= explode("/",$result_estiamte_for_bill_no["bill_no"]);
		
				$first_explode=$explode_bill_no[0];
				$second_explode=$explode_bill_no[1];
				$third_explode=$explode_bill_no[2];
				$l_trim_third_explode= ltrim($third_explode,"0");
				$plus_of_bill= intval($l_trim_third_explode)+1;
				$final_bill_no= sprintf('%04d', $plus_of_bill);
				
				$sel_year="select * from fyearmaster where `fy_isactive`=0";
				$query_year = mysqli_query($conn, $sel_year);
				$result_year = mysqli_fetch_array($query_year);
				$year_name=$result_year["fy_name"];
				$today_date=date("Ymd");
				
				$set_bill_no= $first_explode."/".$year_name."/".$final_bill_no;
			}
			else
			{
				$sel_year="select * from fyearmaster where `fy_isactive`=0";
				$query_year = mysqli_query($conn, $sel_year);
				$result_year = mysqli_fetch_array($query_year);
				$year_name=$result_year["fy_name"];
				$today_date=date("Ymd");
				
				$set_bill_no= "GST/".$year_name."/0001";

			}
		
		    //insert entry in estimate_sequence_maintain
			$todays=date("Y-m-d");
			$insert_sequence="insert into estimate_total_span_bill_sequence(`trf_no`,`job_no`,`bill_no`,`estimate_type`,`estimate_date`,`created_date`,`created_by`,`created_name`) values('$txt_trf_no','$txt_job_no','$set_bill_no','for_test','$invoice_date','$todays','$_SESSION[u_id]','$_SESSION[name]')";
			$result_insert_sequence=mysqli_query($conn,$insert_sequence);
			
		   $insert_estimate="insert into estimate_total_span_only_for_test (`trf_no`,`job_no`,`estimate_no`,`bill_to`,`bill_no`,`gst_no`,`hsn_codes`,`estimate_date`,`agency_id`,`rate_type`,`gst_type`,`gst_in_or_ex`,`test_ids`,`test_name`,`test_qty`,`test_rates`,`test_totals`,`c_gst_amt`,`s_gst_amt`,`i_gst_amt`,`discount_percent`,`discount_amount`,`sub_total`,`grand_total`,`total_amt`,`total_amt_in_word`,`est_creatredby`,`est_createddate`,`est_modifyby`,`est_modifydate`) 
						values(
						'$txt_trf_no',
						'$txt_job_no',
						'$txt_invoice_no',
						'$txt_bill_to',
						'$set_bill_no',
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
						'$txt_discount_percent',
						'$txt_discount_amount',
						'$txt_sub_total',
						'$txt_grand',
						'$total_amt',
						'$txt_amt_in_word',
						'$_SESSION[name]',
						'0000-00-00',
						'',
						'0000-00-00')";
	    $result_insert_estimate=mysqli_query($conn,$insert_estimate);
		
		// $update_save_material_assign="update save_material_assign set `is_estimate`=1 where `trf_no`='$txt_trf_no' AND `job_no`='$txt_job_no'";
		//$result_save_material_assign=mysqli_query($conn,$update_save_material_assign);
		}
			
		// get morr by report no andjob no
		$sel_span_mate="select * from span_material_assign where `trf_no`='$txt_trf_no' AND `job_number`='$txt_job_no'";
		$query_span_mate=mysqli_query($conn,$sel_span_mate);
		$get_span_mate= mysqli_fetch_assoc($query_span_mate);
		
		$get_morr=$get_span_mate["morr"];
		$get_job_number=$get_span_mate["job_number"];
		$expected_date=$get_span_mate["expected_date"];
		$tested_by=$get_span_mate["tested_by"];
		$reported_by=$get_span_mate["reported_by"];
		
		
		// code to get sample receve date from job table
		$sel_jobs="select * from job where `trf_no`='$txt_trf_no'";
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
		
		
		
		$update_jobs="update job set `morr`='$get_morr',`job_lab_assign`='1',`job_lab_progress`='$j_n_progress',`report_job_printing`='$report_printing',`job_number`='$txt_job_no', `job_lab_progress_date`='$set_expected_date',`job_lab_progress_end_date`='$set_re_sample_date',`tested_by`='$tested_by',`reported_by`='$reported_by',`admin_special_light`=3 where `trf_no`='$txt_trf_no'";
		$query_update_jobs=mysqli_query($conn,$update_jobs);
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
