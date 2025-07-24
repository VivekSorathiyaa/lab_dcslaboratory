<?php
include 'connection.php';
 
  
if(isset($_POST['est_sr_no'])){
   $est_sr_no = $_POST['est_sr_no'];
  // $txt_auth_name = $_POST['txt_auth_name'];
   $txt_auth_address = $_POST['txt_auth_address']; 


$update_bill_tot="update bill_totalmaster SET `auth_address`='$txt_auth_address' WHERE `est_sr_no`='$est_sr_no'"; 
				
		 $query_run= mysqli_query($conn,$update_bill_tot);
		 
		 $update_estimate="update estimate_bill_total_master SET `auth_address`='$txt_auth_address' WHERE `est_sr_no`='$est_sr_no'"; 
				
		 $query_run= mysqli_query($conn,$update_estimate);
		 
		 $update_billmaster="update billmaster SET `auth_address`='$txt_auth_address' WHERE `sr_no`='$est_sr_no'"; 
				
		 $query_run= mysqli_query($conn,$update_billmaster);
		 
		 
         
}







?>
