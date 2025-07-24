<?php

session_start();
include("connection.php");
error_reporting(1);

if(isset($_POST['action_type']) && !empty($_POST['action_type']))
	{
		 if($_POST['action_type'] == 'add')
		{
			$var_dates = $_POST['date'];
			$date_splits = str_replace('/', '-', $var_dates);
			$dateing =  date('Y-m-d', strtotime($date_splits));
			
			$today= $dateing;

			
			
			
			
			
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= "TRF_".rand(999,99999).".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scan_document/';
				move_uploaded_file($tmp_name,$path.$filename);
			}else{
				$filename="";
				
			}
			
			$client_code=$_POST['client_code'];
			$client_name=$_POST['client_name'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$pincode="";
			$sel_city="";
			$customer_gst_no=$_POST['customer_gst_no'];
			$select_agency=$_POST['select_agency'];
			
			if($select_agency !=""){
			$sel_age_name="select agency_name from agency_master where `agency_id`=".$select_agency;
			$result_ag_name= mysqli_query($conn,$sel_age_name);
			$get_agency_names=mysqli_fetch_array($result_ag_name);
			$agency_names= $get_agency_names["agency_name"];
			
			$agency_address=$_POST['agency_address'];
			$agency_mobile=$_POST['agency_mobile'];
			$sel_city_of_agency=$_POST['sel_city_of_agency'];
			$agency_pincode=$_POST['agency_pincode'];
			$agency_email=$_POST['agency_email'];
			$agency_gst=$_POST['agency_gst'];
			
			}else{
				
		    $agency_names= "";
			
			$agency_address="";
			$agency_mobile="";
			$sel_city_of_agency="";
			$agency_pincode="";
			$agency_email="";
			$agency_gst="";
			
			}
			$name_of_work=$_POST['name_of_work'];
			$ref_no=$_POST['ref_no'];
			if($ref_no !="")
			{
			$var_date = $_POST['date'];
			$date_split = str_replace('/', '-', $var_date);
			$ref_date =  date('Y-m-d', strtotime($date_split));
			}else{
				$ref_date=null;
			}
			
			$var_date_sw = $_POST['sw_date'];
			$date_split_sw = str_replace('/', '-', $var_date_sw);
			$sw_date =  date('Y-m-d', strtotime($date_split_sw));
			
			
			
			$sel_sent_by=$_POST['sel_sent_by'];
			$sel_report_to=$_POST['sel_report_to'];
			$var_dates = $_POST['sample_rec_date'];
			$date_splits = str_replace('/', '-', $var_dates);
			$sample_rec_date =  date('Y-m-d', strtotime($date_splits));
			
			
			$person_name=$_POST['person_name'];
			$agreement_no=$_POST['agreement_no'];
			$person_auth_mobile=$_POST['person_auth_mobile'];
			$trf_ref=$_POST['trf_ref'];
			$curr_date=date("Y-m-d");
			
			$tpi_code=$_POST['tpi_code'];
			$tpi_name=$_POST['tpi_name'];
			$tpi_phone=$_POST['tpi_phone'];
			$tpi_email=$_POST['tpi_email'];
			$tpi_address=$_POST['tpi_address'];
			
			$pmc_code=$_POST['pmc_code'];
			$pmc_name=$_POST['pmc_name'];
			$pmc_phone=$_POST['pmc_phone'];
			$pmc_email=$_POST['pmc_email'];
			$pmc_address=$_POST['pmc_address'];
			
			$radio_nabl=$_POST['radio_nabl'];
			$tpi_or_auth=$_POST['tpi_or_auth'];
			$pmc_heading=$_POST['pmc_heading'];
			$billing_to=$_POST['billing_to'];
			
			$sel_branch=explode("|",$_POST['sel_branch']);
			$branch_id=$sel_branch[0];
			$branch_name=$sel_branch[1];
			$branch_short_code=$sel_branch[2];
			
			$radio_1=$_POST['radio_1'];
			$radio_2=$_POST['radio_2'];
			$radio_3=$_POST['radio_3'];
			$radio_4=$_POST['radio_4'];
			$radio_5=$_POST['radio_5'];
			$radio_6=$_POST['radio_6'];
			$radio_7=$_POST['radio_7'];
			$radio_8=$_POST['radio_8'];
			$radio_9=$_POST['radio_9'];
			$radio_10=$_POST['radio_10'];
			$radio_11=$_POST['radio_11'];
			$acceptable=$_POST['acceptable'];
			$applicable=$_POST['applicable'];
			$deviation=$_POST['deviation'];
			
			if($_SESSION["u_id"]!="3"){
				$fill = array("statuses" => "0");
				echo json_encode($fill);
				exit;
			}
			
					$job_serial="SELECT * FROM job ORDER BY job_id DESC";
					$job_res = mysqli_query($conn, $job_serial);

					if (mysqli_num_rows($job_res) > 0) {
						$job_r = mysqli_fetch_array($job_res);
						
						$trf_no_plus=$job_r["temporary_trf_no"];
						$plus_report_no= intval($trf_no_plus) + 1;
						
						$final_trf_no= $plus_report_no;
						
						
					}else{
						$final_trf_no= "1";
					}
					
					
					 $insert_job_only="INSERT INTO `job`(`client_code`, `clientname`, `clientaddress`,`clientphone`,`email`,`client_pincode`,`client_city`,`client_gstno`,`agency`,`agency_name`,`agency_address`,`agency_mobile`,`agency_city`,`agency_pincode`,`agency_email`,`agency_gstno`,`nameofwork`,`agreement_no`,`person_name`,`person_auth_mobile`,`trf_ref`,`scan_document`,`refno`,`date`,`send_to_second_reception`,`assign_status`,`sample_sent_by`,`sample_rec_date`,`condition_of_sample_receved`,`jobcreatedby`,`jobcreatedby_id`,`jobcreateddate`,`jobmodifiedby`,`jobmodifieddate`,`report_sent_to`,`admin_special_light`,`temporary_trf_no`,`sw_date`,`morr`,`tpi_code`,`tpi_name`,`tpi_phone`,`tpi_email`,`tpi_address`,`pmc_code`,`pmc_name`,`pmc_phone`,`pmc_email`,`pmc_address`,`nabl_type`,`tpi_or_auth`,`pmc_heading`,`billing_to_id`,`radio_1`,`radio_2`,`radio_3`,`radio_4`,`radio_5`,`radio_6`,`radio_7`,`radio_8`,`radio_9`,`radio_10`,`radio_11`,`acceptable`,`applicable`,`deviation`,`branch_id`,`branch_name`,`branch_short_code`) values(
						'$client_code',
						'$client_name',
						'$address',
						'$phone',
						'$email',
						'$pincode',
						'$sel_city',
						'$customer_gst_no',
						'$select_agency',
						'$agency_names',
						'$agency_address',
						'$agency_mobile',
						'$sel_city_of_agency',
						'$agency_pincode',
						'$agency_email',
						'$agency_gst',
						'$name_of_work',
						'$agreement_no',
						'$person_name',
						'$person_auth_mobile',
						'$trf_ref',
						'$filename',
						'$ref_no',
						'$ref_date',
						1,
						1,
						'$sel_sent_by',
						'$sample_rec_date',
						'0',
						'$_SESSION[name]',
						'$_SESSION[u_id]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date',
						'$sel_report_to',
						1,
						'$final_trf_no',
						'$sw_date',
						'r',
						'$tpi_code',
						'$tpi_name',
						'$tpi_phone',
						'$tpi_email',
						'$tpi_address',
						'$pmc_code',
						'$pmc_name',
						'$pmc_phone',
						'$pmc_email',
						'$pmc_address',
						'$radio_nabl',
						'$tpi_or_auth',
						'$pmc_heading',
						'$billing_to',
						'$radio_1',
						'$radio_2',
						'$radio_3',
						'$radio_4',
						'$radio_5',
						'$radio_6',
						'$radio_7',
						'$radio_8',
						'$radio_9',
						'$radio_10',
						'$radio_11',
						'$acceptable',
						'$applicable',
						'$deviation',
						'$branch_id',
						'$branch_name',
						'$branch_short_code')";
					$result_of_insert_only_job=mysqli_query($conn,$insert_job_only);	
					$fill = array("statuses" => "1");
					echo json_encode($fill);

		}elseif($_POST['action_type'] == 'add_and_next')
		{
			
			$var_dates = $_POST['date'];
			$date_splits = str_replace('/', '-', $var_dates);
			$dateing =  date('Y-m-d', strtotime($date_splits));
			
			$today= $dateing;

			$job_serial="SELECT * FROM job where date='$today' ORDER BY job_id DESC";
			$job_res = mysqli_query($conn, $job_serial);

			if (mysqli_num_rows($job_res) > 0) {
				$job_r = mysqli_fetch_array($job_res);
				//$job_ser_no=$job_r["jobno"]+1;
				$explode_no= explode("/",$job_r["report_no"]);
				
				$first_explode= $explode_no[0]."/";
				$second_explode= $explode_no[1]."/";
				$third_explode= $explode_no[2];
				$fourth_explode= $explode_no[3];
				$month_day=substr($third_explode,0,4);
				$get_report_no= substr($third_explode,4);
				$plus_report_no= $get_report_no + 1;
				
				$final_report_no= $first_explode.$second_explode.$month_day.$plus_report_no."/".$fourth_explode;
				
				
			}else{
				$explode_date= explode("-",$today); 
				$final_report_no= "SPAN/P/".$explode_date[2].$explode_date[1]."1"."/".$explode_date[0];
			}
			
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				$explode_for_img=explode("/",$_POST['report_no']);
				$filename= "JOB_".$explode_for_img[2].".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scan_document/';
				move_uploaded_file($tmp_name,$path.$filename);
			}else{
				$filename="";
				
			}
			
			$client_code=$_POST['client_code'];
			$client_name=$_POST['client_name'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$pincode=$_POST['pincode'];
			$sel_city=$_POST['sel_city'];
			$customer_gst_no=$_POST['customer_gst_no'];
			$select_agency=$_POST['select_agency'];
			$agency_address=$_POST['agency_address'];
			$agency_mobile=$_POST['agency_mobile'];
			$sel_city_of_agency=$_POST['sel_city_of_agency'];
			$agency_pincode=$_POST['agency_pincode'];
			$agency_email=$_POST['agency_email'];
			$agency_gst=$_POST['agency_gst'];
			$name_of_work=$_POST['name_of_work'];
			$ref_no=$_POST['ref_no'];
			$var_date = $_POST['date'];
			$agreement_no = $_POST['agreement_no'];
			$date_split = str_replace('/', '-', $var_date);
			$date =  date('Y-m-d', strtotime($date_split));
			
			
			$report_no=$final_report_no;
			$sel_sent_by=$_POST['sel_sent_by'];
			$sel_report_to=$_POST['sel_report_to'];
			$var_dates = $_POST['sample_rec_date'];
			$date_splits = str_replace('/', '-', $var_dates);
			$sample_rec_date =  date('Y-m-d', strtotime($date_splits));
			
			
			$person_name=$_POST['person_name'];
			$person_auth_mobile=$_POST['person_auth_mobile'];
			$trf_ref=$_POST['trf_ref'];
			$curr_date=date("Y-m-d");
			
			
			
			$sel_client="select * from client where `clientphone`='$phone' OR `email`='$email'";
			$get_client= mysqli_query($conn,$sel_client);
			
			if(mysqli_num_rows($get_client) > 0){
				$get_all_client= mysqli_fetch_array($get_client);
				
				$client_code=$get_all_client['client_code'];
				$client_name=$get_all_client['clientname'];
				$address=$get_all_client['clientaddress'];
				$phone=$get_all_client['clientphone'];
				$email=$get_all_client['email'];
				$pincode=$get_all_client['pincode'];
				$sel_city=$get_all_client['client_city'];
				$customer_gst_no=$get_all_client['gst_no'];
				
				
				$insert_job_only="INSERT INTO `job`(`client_code`, `clientname`, `clientaddress`,`clientphone`,`email`,`client_pincode`,`client_city`,`client_gstno`,`agency`,`agency_address`,`agency_mobile`,`agency_city`,`agency_pincode`,`agency_email`,`agency_gstno`,`nameofwork`,`agreement_no`,`person_name`,`person_auth_mobile`,`trf_ref`,`scan_document`,`refno`,`date`,`report_no`,`send_to_second_reception`,`assign_status`,`sample_sent_by`,`sample_rec_date`,`condition_of_sample_receved`,`jobcreatedby`,`jobcreatedby_id`,`jobcreateddate`,`jobmodifiedby`,`jobmodifieddate`,`report_sent_to`,`admin_special_light`) values(
						'$client_code',
						'$client_name',
						'$address',
						'$phone',
						'$email',
						'$pincode',
						'$sel_city',
						'$customer_gst_no',
						'$select_agency',
						'$agency_address',
						'$agency_mobile',
						'$sel_city_of_agency',
						'$agency_pincode',
						'$agency_email',
						'$agency_gst',
						'$name_of_work',
						'$agreement_no',
						'$person_name',
						'$person_auth_mobile',
						'$trf_ref',
						'$filename',
						'$ref_no',
						'$date',
						'$report_no',
						1,
						1,
						'$sel_sent_by',
						'$sample_rec_date',
						'0',
						'$_SESSION[name]',
						'$_SESSION[u_id]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date',
						'$sel_report_to',
						1
						)";
					$result_of_insert_only_job=mysqli_query($conn,$insert_job_only);	
					$fill = array("report_no" => $report_no);
					echo json_encode($fill);
			}else
			{
			
				$insert="INSERT INTO `client`(`client_code`, `clientname`, `client_city`,`clientphone`,`email`,`pincode`,`gst_no`,`clientaddress`,`clientcreatedby`,`clientcreateddate`,`clientmodifiedby`,`clientmodifieddate`) values(
						'$client_code',
						'$client_name',
						'$sel_city',
						'$phone',
						'$email',
						'$pincode',
						'$customer_gst_no',
						'$address',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date'
						)";
					$result_of_insert=mysqli_query($conn,$insert);	
					
					
					
					 $insert_job_only="INSERT INTO `job`(`client_code`, `clientname`, `clientaddress`,`clientphone`,`email`,`client_pincode`,`client_city`,`client_gstno`,`agency`,`agency_address`,`agency_mobile`,`agency_city`,`agency_pincode`,`agency_email`,`agency_gstno`,`nameofwork`,`agreement_no`,`person_name`,`person_auth_mobile`,`trf_ref`,`scan_document`,`refno`,`date`,`report_no`,`sample_sent_by`,`sample_rec_date`,`condition_of_sample_receved`,`jobcreatedby`,`jobcreateddate`,`jobmodifiedby`,`jobmodifieddate`,`report_sent_to`,`admin_special_light`) values(
						'$client_code',
						'$client_name',
						'$address',
						'$phone',
						'$email',
						'$pincode',
						'$sel_city',
						'$customer_gst_no',
						'$select_agency',
						'$agency_address',
						'$agency_mobile',
						'$sel_city_of_agency',
						'$agency_pincode',
						'$agency_email',
						'$agency_gst',
						'$name_of_work',
						'$agreement_no',
						'$person_name',
						'$person_auth_mobile',
						'$trf_ref',
						'$filename',
						'$ref_no',
						'$date',
						'$report_no',
						'$sel_sent_by',
						'$sample_rec_date',
						'0',
						'$_SESSION[name]',
						'$curr_date',
						'$_SESSION[name]',
						'$curr_date',
						'$sel_report_to',
						1
						)";
					$result_of_insert_only_job=mysqli_query($conn,$insert_job_only);	
					$fill = array($result_of_insert_only_job);
					echo json_encode($fill);
			}
		} elseif($_POST['action_type'] == 'edit')
		{
			
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= "TRF_".rand(999,99999).".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scan_document/';
				move_uploaded_file($tmp_name,$path.$filename);
				$where=",`scan_document`='$filename'";
			}else{
				$where="";
				
			}
			
			$client_code=$_POST['client_code'];
			$client_name=$_POST['client_name'];
			$address=$_POST['address'];
			$phone=$_POST['phone'];
			$email=$_POST['email'];
			$pincode="";
			$sel_city="";
			$customer_gst_no=$_POST['customer_gst_no'];
			$select_agency=$_POST['select_agency'];
			$agency_address=$_POST['agency_address'];
			$agency_mobile=$_POST['agency_mobile'];
			$sel_city_of_agency=$_POST['sel_city_of_agency'];
			$agency_pincode=$_POST['agency_pincode'];
			$agency_email=$_POST['agency_email'];
			$agency_gst=$_POST['agency_gst'];
			$name_of_work=$_POST['name_of_work'];
			$ref_no=$_POST['ref_no'];
			
			$sel_age_name="select agency_name from agency_master where `agency_id`=".$select_agency;
			$result_ag_name= mysqli_query($conn,$sel_age_name);
			$get_agency_names=mysqli_fetch_array($result_ag_name);
			$agency_names= $get_agency_names["agency_name"];
			
			$agency_address=$_POST['agency_address'];
			$agency_mobile=$_POST['agency_mobile'];
			$sel_city_of_agency=$_POST['sel_city_of_agency'];
			$agency_pincode=$_POST['agency_pincode'];
			$agency_email=$_POST['agency_email'];
			$agency_gst=$_POST['agency_gst'];
			
			
			
			$var_date = $_POST['date'];
			$date_split = str_replace('/', '-', $var_date);
			$date =  date('Y-m-d', strtotime($date_split));
			
			$var_sw_date = $_POST['sw_date'];
			$date_split_sw_date = str_replace('/', '-', $var_sw_date);
			$sw_date =  date('Y-m-d', strtotime($date_split_sw_date));
			
			$sel_sent_by=$_POST['sel_sent_by'];
			$sel_report_to=$_POST['sel_report_to'];
			$var_dates = $_POST['sample_rec_date'];
			$date_splits = str_replace('/', '-', $var_dates);
			$sample_rec_date =  date('Y-m-d', strtotime($date_splits));
			
			
			$tpi_code=$_POST['tpi_code'];
			$tpi_name=$_POST['tpi_name'];
			$tpi_phone=$_POST['tpi_phone'];
			$tpi_email=$_POST['tpi_email'];
			$tpi_address=$_POST['tpi_address'];
			
			$pmc_code=$_POST['pmc_code'];
			$pmc_name=$_POST['pmc_name'];
			$pmc_phone=$_POST['pmc_phone'];
			$pmc_email=$_POST['pmc_email'];
			$pmc_address=$_POST['pmc_address'];
			
			$person_name=$_POST['person_name'];
			$person_auth_mobile=$_POST['person_auth_mobile'];
			$trf_ref=$_POST['trf_ref'];
			$edit_job_id=$_POST['edit_job_id'];
			$agreement_no = $_POST['agreement_no'];
			$tpi_or_auth = $_POST['tpi_or_auth'];
			$pmc_heading = $_POST['pmc_heading'];
			$billing_to = $_POST['billing_to'];
			
			$radio_1=$_POST['radio_1'];
			$radio_2=$_POST['radio_2'];
			$radio_3=$_POST['radio_3'];
			$radio_4=$_POST['radio_4'];
			$radio_5=$_POST['radio_5'];
			$radio_6=$_POST['radio_6'];
			$radio_7=$_POST['radio_7'];
			$radio_8=$_POST['radio_8'];
			$radio_9=$_POST['radio_9'];
			$radio_10=$_POST['radio_10'];
			$radio_11=$_POST['radio_11'];
			$acceptable=$_POST['acceptable'];
			$applicable=$_POST['applicable'];
			$deviation=$_POST['deviation'];
			
			
		 $job_update="update job SET `client_code`='$client_code',`clientname`='$client_name',`clientaddress`='$address',`clientphone`='$phone',`email`='$email',`client_pincode`='$pincode',`client_city`='$sel_city',`client_gstno`='$customer_gst_no',`agency`='$select_agency',`agency_address`='$agency_address',`agency_mobile`='$agency_mobile',`agency_city`='$sel_city_of_agency',`agency_pincode`='$agency_pincode',`agency_email`='$agency_email',`agency_gstno`='$agency_gst',`nameofwork`='$name_of_work',`person_name`='$person_name',`person_auth_mobile`='$person_auth_mobile',`trf_ref`='$trf_ref',`refno`='$ref_no',`date`='$date',`sample_sent_by`='$sel_sent_by',`sample_rec_date`='$sample_rec_date',`sw_date`='$sw_date',`condition_of_sample_receved`='0',`report_sent_to`='$sel_report_to',`admin_status_rec_1`='0',`agreement_no`='$agreement_no',`tpi_or_auth`='$tpi_or_auth',`pmc_heading`='$pmc_heading',`billing_to_id`='$billing_to',`tpi_code`='$tpi_code',`tpi_name`='$tpi_name',`tpi_phone`='$tpi_phone',`tpi_email`='$tpi_email',`tpi_address`='$tpi_address',`pmc_code`='$pmc_code',`pmc_name`='$pmc_name',`pmc_phone`='$pmc_phone',`pmc_email`='$pmc_email',`pmc_address`='$pmc_address',`radio_1`='$radio_1',`radio_2`='$radio_2',`radio_3`='$radio_3',`radio_4`='$radio_4',`radio_5`='$radio_5',`radio_6`='$radio_6',`radio_7`='$radio_7',`radio_8`='$radio_8',`radio_9`='$radio_9',`radio_10`='$radio_10',`radio_11`='$radio_11',`acceptable`='$acceptable',`applicable`='$applicable',`deviation`='$deviation',`agency_name`='$agency_names' ".$where." WHERE `job_id`='$edit_job_id'";
                $result_of_update_only_job=mysqli_query($conn,$job_update);	
				$fill = array($result_of_update_only_job);
				echo json_encode($fill);
		}
		 elseif($_POST['action_type'] == 'edit_trf_by_rec')
		{
			
			
			
			$client_code=$_POST['client_code'];
			$sel_client="select * from client where `client_code`='$client_code'";
			$get_client= mysqli_query($conn,$sel_client);
			
			if(mysqli_num_rows($get_client) > 0){
				$get_all_client= mysqli_fetch_array($get_client);
				
				$client_code=$get_all_client['client_code'];
				$clientname=$get_all_client['clientname'];
				$clientaddress=$get_all_client['clientaddress'];
				$clientphone=$get_all_client['clientphone'];
				$email=$get_all_client['email'];
				$client_pincode=$get_all_client['pincode'];
				$client_city=$get_all_client['client_city'];
				$client_gstno=$get_all_client['gst_no'];
			}else{
				$client_code="";
				$clientname="";
				$clientaddress="";
				$clientphone="";
				$email="";
				$client_pincode="";
				$client_city="";
				$client_gstno="";
			}
			
			if($_POST['select_agency'] !="")
			{
			
				$select_agency=$_POST['select_agency'];
				$sel_agency="select * from 	agency_master where `agency_id`=".$select_agency;
				$get_agency= mysqli_query($conn,$sel_agency);
				
				if(mysqli_num_rows($get_agency) > 0)
				{
					$get_all_agency= mysqli_fetch_array($get_agency);
					
					$agency_id=$get_all_agency["agency_id"];
					$agency_name=$get_all_agency["agency_name"];
					$agency_address=$get_all_agency["agency_address"];
					$agency_mobile=$get_all_agency["agency_mobile"];
					$agency_city=$get_all_agency["agency_city"];
					$agency_pincode=$get_all_agency["agency_pincode"];
					$agency_email=$get_all_agency["agency_email"];
					$agency_gstno=$get_all_agency["agency_gstno"];
				}else{
					$agency_id="";
					$agency_name="";
					$agency_address="";
					$agency_mobile="";
					$agency_city="";
					$agency_pincode="";
					$agency_email="";
					$agency_gstno="";
				}
			
			}else{
					$agency_id="";
					$agency_name="";
					$agency_address="";
					$agency_mobile="";
					$agency_city="";
					$agency_pincode="";
					$agency_email="";
					$agency_gstno="";
			}
			
			
			if($_POST['sel_tpi']!="")
			{
				
				$select_tpi="select * from 	tpi where `tpi_id`=".$_POST['sel_tpi'];
				$get_tpi= mysqli_query($conn,$select_tpi);
				$get_all_tpi= mysqli_fetch_array($get_tpi);
				
				$tpi_code=$get_all_tpi["tpi_code"];
				$tpi_name=$get_all_tpi["tpi_name"];
				$tpi_phone=$get_all_tpi["tpi_phone"];
				$tpi_email=$get_all_tpi["tpi_email"];
				$tpi_address=$get_all_tpi["tpi_address"];
			}else{
				$tpi_code="";
				$tpi_name="";
				$tpi_phone="";
				$tpi_email="";
				$tpi_address="";
			}
			
			if($_POST['sel_pmc']!="")
			{
				$select_pmc="select * from pmc where `pmc_id`=".$_POST['sel_pmc'];
				$get_pmc= mysqli_query($conn,$select_pmc);
				$get_all_pmc= mysqli_fetch_array($get_pmc);
				
				$pmc_code=$get_all_pmc["pmc_code"];
				$pmc_name=$get_all_pmc["pmcname"];
				$pmc_phone=$get_all_pmc["pmcphone"];
				$pmc_email=$get_all_pmc["email"];
				$pmc_address=$get_all_pmc["pmcaddress"];
			}else{
				$pmc_code="";
				$pmc_name="";
				$pmc_phone="";
				$pmc_email="";
				$pmc_address="";
			}
			
			$name_of_work=$_POST['name_of_work'];
			$ref_no=$_POST['ref_no'];
			$ref_date=date("Y-m-d",strtotime($_POST['ref_date']));
			$agreement_no = $_POST['agreement_no'];
			$person_name = $_POST['person_name'];
			$person_auth_mobile = $_POST['person_auth_mobile'];
			$trf_ref = $_POST['trf_ref'];
			$sel_sent_by = $_POST['sel_sent_by'];
			$sel_report_to = $_POST['sel_report_to'];
			$tpi_or_auth = $_POST['tpi_or_auth'];
			$pmc_heading = $_POST['pmc_heading'];
			$bill_to = $_POST['bill_to'];
			
			$edit_job_id=$_POST['edit_job_id'];
			
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= "TRF_".rand(999,99999).".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scan_document/';
				move_uploaded_file($tmp_name,$path.$filename);
				$where=",`scan_document`='$filename'";
			}else{
				$where="";
				
			}
			
			
		$update_jobs="update job set `client_code`='$client_code',`clientname`='$clientname',`clientaddress`='$clientaddress',`clientphone`='$clientphone',`email`='$email',`client_pincode`='$client_pincode',`client_city`='$client_city',`client_gstno`='$client_gstno',`agency`='$agency_id',`agency_name`='$agency_name',`agency_address`='$agency_address',`agency_mobile`='$agency_mobile',`agency_city`='$agency_city',`agency_pincode`='$agency_pincode',`agency_email`='$agency_email',`agency_gstno`='$agency_gstno',`tpi_code`='$tpi_code',`tpi_name`='$tpi_name',`tpi_phone`='$tpi_phone',`tpi_email`='$tpi_email',`tpi_address`='$tpi_address',`pmc_code`='$pmc_code',`pmc_name`='$pmc_name',`pmc_phone`='$pmc_phone',`pmc_email`='$pmc_email',`pmc_address`='$pmc_address',`nameofwork`='$name_of_work',`agreement_no`='$agreement_no',`person_name`='$person_name',`person_auth_mobile`='$person_auth_mobile',`trf_ref`='$trf_ref',`report_sent_to`='$sel_report_to',`refno`='$ref_no',`date`='$ref_date',`tpi_or_auth`='$tpi_or_auth',`pmc_heading`='$pmc_heading',`billing_to_id`='$bill_to'".$where." where `trf_no`='$edit_job_id'";
                $result_of_update_only_job=mysqli_query($conn,$update_jobs);	
				$fill = array($result_of_update_only_job);
				echo json_encode($fill);
		}elseif($_POST['action_type'] == 'edit_only_trf')
		{
			
			$client_code=$_POST['sel_client'];
			$sel_client="select * from client where `client_code`='$client_code'";
			$get_client= mysqli_query($conn,$sel_client);
			
			if(mysqli_num_rows($get_client) > 0){
				$get_all_client= mysqli_fetch_array($get_client);
				
				$client_code=$get_all_client['client_code'];
				$clientname=$get_all_client['clientname'];
			}else{
				$client_code="";
				$clientname="";
			}
			
			$select_agency=$_POST['select_agency'];
			$sel_agency="select * from 	agency_master where `agency_id`=".$select_agency;
				$get_agency= mysqli_query($conn,$sel_agency);
				
				if(mysqli_num_rows($get_agency) > 0)
				{
					$get_all_agency= mysqli_fetch_array($get_agency);
					
					$agency_id=$get_all_agency["agency_id"];
					$agency_name=$get_all_agency["agency_name"];
					
				}else{
					$agency_id="";
					$agency_name="";
				}
			
			
			if($_POST['tpi_code']!="")
			{
				
				$select_tpi="select * from 	tpi where `tpi_id`=".$_POST['tpi_code'];
				$get_tpi= mysqli_query($conn,$select_tpi);
				if(mysqli_num_rows($get_tpi) > 0){
				$get_all_tpi= mysqli_fetch_array($get_tpi);
				
				$tpi_code=$get_all_tpi["tpi_code"];
				$tpi_name=$get_all_tpi["tpi_name"];
				$tpi_phone=$get_all_tpi["tpi_phone"];
				$tpi_email=$get_all_tpi["tpi_email"];
				$tpi_address=$get_all_tpi["tpi_address"];
				}else{
				$tpi_code="";
				$tpi_name="";
				$tpi_phone="";
				$tpi_email="";
				$tpi_address="";
					
				}
			}else{
				$tpi_code="";
				$tpi_name="";
				$tpi_phone="";
				$tpi_email="";
				$tpi_address="";
			}
			
			if($_POST['pmc_code']!="")
			{
				$select_pmc="select * from pmc where `pmc_id`=".$_POST['pmc_code'];
				$get_pmc= mysqli_query($conn,$select_pmc);
				if(mysqli_num_rows($get_pmc) > 0){
				$get_all_pmc= mysqli_fetch_array($get_pmc);
				
				$pmc_code=$get_all_pmc["pmc_code"];
				$pmc_name=$get_all_pmc["pmcname"];
				$pmc_phone=$get_all_pmc["pmcphone"];
				$pmc_email=$get_all_pmc["email"];
				$pmc_address=$get_all_pmc["pmcaddress"];
				
				}else{
					
				$pmc_code="";
				$pmc_name="";
				$pmc_phone="";
				$pmc_email="";
				$pmc_address="";
				
				}
			}else{
				$pmc_code="";
				$pmc_name="";
				$pmc_phone="";
				$pmc_email="";
				$pmc_address="";
			}
			
			$edit_job_id=$_POST['edit_job_id'];
			$agreement_no = $_POST['agreement_no'];
			$ref_no=$_POST['ref_no'];
			$name_of_work=$_POST['name_of_work'];
			$tpi_or_auth=$_POST['tpi_or_auth'];
			$pmc_heading=$_POST['pmc_heading'];
			$person_name=$_POST['person_name'];
			$person_auth_mobile=$_POST['person_auth_mobile'];
			$trf_ref=$_POST['trf_ref'];
			$billing_to=$_POST['billing_to'];
			$dates=date("Y-m-d",strtotime($_POST['date']));
			
			if(isset($_FILES["file"]["name"]))
			{
				$ext = pathinfo($_FILES['file']['name'], PATHINFO_EXTENSION);
				
				$filename= "TRF_".rand(999,99999).".".$ext;
				$tmp_name = $_FILES['file']['tmp_name'];
				$path = 'scan_document/';
				move_uploaded_file($tmp_name,$path.$filename);
				$where=",`scan_document`='$filename'";
			}else{
				$where="";
				
			}
			
			
		$update_jobs="update job set `client_code`='$client_code',`clientname`='$clientname',`agency`='$agency_id',`agency_name`='$agency_name',`refno`='$ref_no',`agreement_no`='$agreement_no',`nameofwork`='$name_of_work',`tpi_code`='$tpi_code',`tpi_name`='$tpi_name',`tpi_phone`='$tpi_phone',`tpi_email`='$tpi_email',`tpi_address`='$tpi_address',`pmc_code`='$pmc_code',`pmc_name`='$pmc_name',`pmc_phone`='$pmc_phone',`pmc_email`='$pmc_email',`pmc_address`='$pmc_address',`tpi_or_auth`='$tpi_or_auth',`pmc_heading`='$pmc_heading',`person_name`='$person_name',`person_auth_mobile`='$person_auth_mobile',`trf_ref`='$trf_ref',`date`='$dates',`billing_to_id`='$billing_to'".$where." where `trf_no`='$edit_job_id'";
                $result_of_update_only_job=mysqli_query($conn,$update_jobs);	
				$fill = array($result_of_update_only_job);
				echo json_encode($fill);
		}
		
		elseif($_POST['action_type'] == 'through_date'){
		
		$get_dating= explode("/",$_POST["get_dating"]);
		
		$today= $get_dating[2]."-".$get_dating[1]."-".$get_dating[0];
        
		$job_serial="SELECT * FROM job where date='$today' ORDER BY job_id DESC";
		$job_res = mysqli_query($conn, $job_serial);

		if (mysqli_num_rows($job_res) > 0) {
			$job_r = mysqli_fetch_array($job_res);
			//$job_ser_no=$job_r["jobno"]+1;
			$explode_no= explode("/",$job_r["report_no"]);
			
			$first_explode= $explode_no[0]."/";
			$second_explode= $explode_no[1]."/";
			$third_explode= $explode_no[2];
			$fourth_explode= $explode_no[3];
			$month_day=substr($third_explode,0,4);
			$get_report_no= substr($third_explode,4);
			$plus_report_no= $get_report_no + 1;
			
			$final_report_no= $first_explode.$second_explode.$month_day.$plus_report_no."/".$fourth_explode;
			
			
		}else{
			$explode_date= explode("/",$_POST["get_dating"]); 
			$final_report_no= "SPAN/P/".$explode_date[0].$explode_date[1]."1"."/".$explode_date[2];
		}
		;
		$fill = array(
		'report_numburing' => $final_report_no,
        );	   
        echo json_encode($fill);
		
	}
    exit;
	
}
