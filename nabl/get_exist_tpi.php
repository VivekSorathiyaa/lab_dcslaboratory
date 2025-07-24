
<?php
include 'connection.php';


	if(isset($_POST['exist_client'])){

		$exist_client = $_POST['exist_client'];

    $query = "SELECT * FROM client WHERE client_code = '$exist_client'";

	$result = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($result);
	if(count($row)==0){
		$count=0;
	}else{
		$count=1;
	}

		 $fill = array(
        'client_code' => $row["client_code"],
        'clientname' => $row["clientname"],
        'client_city' => $row["client_city"],
        'clientphone' => $row["clientphone"],
        'email' => $row["email"],
        'clientaddress' => $row["clientaddress"],
        'pincode' => $row["pincode"],
        'gst_no' => $row["gst_no"]
        );


    echo json_encode($fill);

	}

	if(isset($_POST['select_agency'])){

		$select_agency = $_POST['select_agency'];

   $query = "select * from agency_master where agency_id =".$select_agency;

	$result = mysqli_query($conn, $query);

	$row = mysqli_fetch_assoc($result);
	if(count($row)==0){
		$count=0;
	}else{
		$count=1;
	}

		 $fill = array(
        'agency_address' => $row["agency_address"],
        'agency_mobile' => $row["agency_mobile"],
        'agency_city' => $row["agency_city"],
        'agency_pincode' => $row["agency_pincode"],
        'agency_email' => $row["agency_email"],
        'agency_gstno' => $row["agency_gstno"]
        );


    echo json_encode($fill);


	}

	if(isset($_POST['exist_agency_mo'])){

		$exist_agency_mo = $_POST['exist_agency_mo'];

			$query1 = "select * from agency_master where agency_mobile =".$exist_agency_mo;

			$result1 = mysqli_query($conn, $query1);

			$row1 = mysqli_fetch_assoc($result1);
			if(count($row1)==0){
				$count1=0;
				$fill = array('cnt' => $count1
				);
			}else{
				$count1=1;
				 $fill = array(
				'agency_id' => $row1["agency_id"],
				'agency_address' => $row1["agency_address"],
				'agency_mobile' => $row1["agency_mobile"],
				'agency_city' => $row1["agency_city"],
				'agency_pincode' => $row1["agency_pincode"],
				'agency_email' => $row1["agency_email"],
				'agency_gstno' => $row1["agency_gstno"],
				'cnt' => $count1
				);


			echo json_encode($fill);
			}
	}





   ?>
