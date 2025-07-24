<?php
include 'connection.php';
error_reporting(0);
	
	if($_POST['action_type']=="select_agency_on_change"){
		
		$select_agency = $_POST['select_agency'];
   
	   $query = "SELECT * FROM job WHERE agency = '$select_agency' order By job_id desc";
	 
		$result = mysqli_query($conn, $query);
		 if(mysqli_num_rows($result) > 0){
			 
			$row = mysqli_fetch_assoc($result);
			$client_code=$row["client_code"];
			 $fill = array('client_code' => $client_code,'statuses' => 1);
		 }else{
			 $fill = array('client_code' =>"",'statuses' => 0);
		 }
		echo json_encode($fill);
		
	}else if($_POST['action_type']=="get_now_on_change")
	{
		
		$select_agency = $_POST['select_agency'];
		$sel_client = $_POST['sel_client'];
		
		$arraying=array(
		array($_POST["select_agency"]," AND `agency` LIKE '%".$_POST['select_agency']."%'"),
		array($_POST["sel_client"]," AND `client_code` LIKE '%".$_POST['sel_client']."%'")
		);

		$where="";
		foreach($arraying as $keys =>$one_array)
		{
			if($one_array[0]!="")
			{
				$where .=$one_array[1];
			}
		}
   
		$query = "SELECT * FROM job WHERE `jobisdeleted`=0".$where." order By job_id desc";
 
		$result = mysqli_query($conn, $query);
		 if(mysqli_num_rows($result) > 0){
			 
			$row = mysqli_fetch_assoc($result);
			$nameofwork=$row["nameofwork"];
			$pmc_code=$row["pmc_code"];
			$tpi_code=$row["tpi_code"];
			$nabl_type=$row["nabl_type"];
			$person_name=$row["person_name"];
			$person_auth_mobile=$row["person_auth_mobile"];
			$nabl_type=$row["nabl_type"];
			$tpi_or_auth=$row["tpi_or_auth"];
			$pmc_heading=$row["pmc_heading"];
			$billing_to_id=$row["billing_to_id"];
			$perfoma_completed_by_biller=$row["perfoma_completed_by_biller"];
			$clientaddress=$row["job_adrs"];
			 $fill = array('nameofwork' => $nameofwork,'pmc_code' => $pmc_code,'tpi_code' => $tpi_code,'person_name' => $person_name,'person_auth_mobile' => $person_auth_mobile,'nabl_type' => $nabl_type,'tpi_or_auth' => $tpi_or_auth,'pmc_heading' => $pmc_heading,'billing_to_id' => $billing_to_id,'perfoma_completed_by_biller' => $perfoma_completed_by_biller,'job_adrs' => $clientaddress,'statuses' => 1);
		 }else{
			 $fill = array('nameofwork' =>"",'pmc_code' => "0",'nabl_type' => "non_nabl",'tpi_or_auth' => "TPI",'pmc_heading' => "PMC",'billing_to_id' => "",'perfoma_completed_by_biller' => "0",'tpi_code' => "0",'person_name' => "",'person_auth_mobile' => "",'job_adrs' => "",'statuses' => 0);
		 }
		echo json_encode($fill);
	}
	
	if($_POST['action_type']=="select_agency_data"){
		
		$agency_id = $_POST['agency_id'];
		
		$get_agency = "SELECT * FROM `agency_master` WHERE `agency_id`='$agency_id'";
		$result_agency = mysqli_query($conn, $get_agency);
		if(mysqli_num_rows($result_agency) > 0){
			$agency_row = mysqli_fetch_array($result_agency);
			
			$fill = array(
				'status' => 'success',
				'agency_name' => $agency_row['agency_name'],
				'agency_address' => $agency_row['agency_address'],
				'agency_mobile' => $agency_row['agency_mobile'],
				'agency_city' => $agency_row['agency_city'],
				'agency_pincode' => $agency_row['agency_pincode'],
				'agency_email' => $agency_row['agency_email'],
				'agency_gstno' => $agency_row['agency_gstno']);
			 echo json_encode($fill);
			
		}
	}
	
   ?>
