<?php
session_start();
include 'connection.php';
error_reporting(0);
  
if(isset($_POST['agency_name'])){
 //$agency_names = str_replace("zxctxavb","'",$_POST['agency_name']);
   $agency_name = str_replace("qwerfdsa","&",$_POST['agency_name']);
   $agency_mobile = $_POST['agency_mobile'];
   $agency_address = $_POST['agency_address'];
   $agency_email = $_POST['agency_email'];
   $agency_gstno = $_POST['agency_gstno'];
   $curr_date=date("Y-m-d");
	
	$sel_party="select * from party_master where `party_name`='$agency_name' OR `party_mobile`='$agency_mobile'";
	$quey_party=mysqli_query($conn,$sel_party);
	if(mysqli_num_rows($sel_party)==0)
	{
		$query = "INSERT INTO `party_master`(`party_name`,`party_mobile`,`party_email`,`party_adress`,`party_gst`)
         VALUES('$agency_name','$agency_mobile','$agency_email','$agency_address','$agency_gstno')";
         $query_run= mysqli_query($conn,$query);
		 
		$todays=date("Y-m-d");
		$last_id = $conn->insert_id;
		 $insert_job_only="INSERT INTO `party_balance_sheet`(`user_type`, `user_id`, `user_name`, `total_balance`, `paid_balance`, `remain_balance`, `last_action`, `modify_date`, `modify_by`, `created_by`, `created_date`) values(
						'party',
						'$last_id',
						'$agency_name',
						'0',
						'0',
						'0',
						'new_entry',
						'$todays',
						'$_SESSION[name]',
						'$_SESSION[name]',
						'$todays')";
					$result_of_insert_only_job=mysqli_query($conn,$insert_job_only);
		 
	}else{
		
	}       
}
?>
<option value="">Select Party</option>
<?php
$sql = "select * from party_master where `is_deleted`=0";
$result = mysqli_query($conn, $sql);
while($row = mysqli_fetch_array($result)) {
   ?>
  <option value="<?php echo $row['party_id'].'|'.$row['party_name'];?>"><?php echo $row['party_name'];?></option>
  <?php
}
?>
