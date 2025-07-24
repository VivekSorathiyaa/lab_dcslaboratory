
<?php
include 'connection.php';
  
if(isset($_POST['select_srno'])){
   $select_srno = $_POST['select_srno'];
	
   
	$query = "SELECT * FROM bill_totalmaster WHERE `sr_no` = '$select_srno'";
	$result = mysqli_query($conn, $query);
	 

	
	//--------------
	
	if (mysqli_num_rows($result) > 0) {
		$row_select = mysqli_fetch_assoc($result);
		$serial_no1= $row_select['sr_no'];
		$job_no= $row_select['job_no'];
		$agency_id= $row_select['agency_id'];
		$agency_name= $row_select['agency_name'];
		$auth_name= $row_select['auth_name'];
		$ref_date1= $row_select['ref_date'];
		$rec_date1= $row_select['rec_date'];
		$inv_date1= $row_select['inv_date'];
		$today_date1= $row_select['today_date'];
		$total_taxableamt= $row_select['total_taxableamt'];
		$cgsttotal= $row_select['cgsttotal'];
		$sgsttotal= $row_select['sgsttotal'];
		$paymenttype= $row_select['paymenttype'];
		$dateofpay= $row_select['dateofpay'];
		$check_no= $row_select['check_no'];
		$bank_name= $row_select['bank_name'];
		$remarks= $row_select['remarks'];
		$totalgst_inword= $row_select['totalgst_inword'];
		$billamt_inword= $row_select['billamt_inword'];
		
		$srno2=substr($serial_no1,8);
		$srno1=substr($serial_no1,0,8);
		
		$rec_date=date('d/m/Y', strtotime($row_select['rec_date']));
		$inv_date=date('d/m/Y', strtotime($row_select['inv_date']));
		$ref_date=date('d/m/Y', strtotime($row_select['ref_date']));
		$today_date=date('d/m/Y', strtotime($row_select['today_date']));
		
	
		$select_query1 = "select * from billmaster WHERE `sr_no`='$serial_no1'";
		$result_select1 = mysqli_query($conn, $select_query1);


		if (mysqli_num_rows($result_select1) > 0) {
			$row_select1 = mysqli_fetch_assoc($result_select1);
			$name_of_work= $row_select1['name_of_work'];
			$city_id= $row_select1['city_id'];
			$ref_name= $row_select1['ref_name'];
			$ref_id= $row_select1['ref_id'];
			$material_id=$row_select1['material_id'];
			
				$select_city = "select * from city WHERE `id`='$city_id'";
				$result_city = mysqli_query($conn, $select_city);
	

				if (mysqli_num_rows($result_city) > 0) {
					$row_city = mysqli_fetch_assoc($result_city);
					$name_of_work= $row_select1['name_of_work'];
					$city_name= $row_city['city_name'];
				}
				
				$select_ref = "select * from reference WHERE `id`='$ref_id'";
				$result_ref = mysqli_query($conn, $select_ref);
	

				if (mysqli_num_rows($result_ref) > 0) {
					$row_ref = mysqli_fetch_assoc($result_ref);
					$r_name= $row_ref['ref_name'];
				}
		}
		
	}
	
	//----------------------
	
	
	 $fill = array(
        'job_no' => $job_no,
        'inv_date' => $inv_date,
        'ref_date' => $ref_date,
        'ref_name' => $ref_name,
        'rec_date' => $rec_date,
        'today_date' => $today_date,
        'name_of_work' => $name_of_work,
        'agency_name' => $agency_name,
        'auth_name' => $auth_name,
        'city_name' => $city_name,
        'r_name' => $r_name,
        );
    echo json_encode($fill);

}
	
   ?>
   
							