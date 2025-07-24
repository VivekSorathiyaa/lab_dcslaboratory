<?php
include 'connection.php';
 
  
if(isset($_POST['chk_bill'])){
   $chk_bill = $_POST['chk_bill'];

	$querys_nabl = "SELECT * FROM nabl ORDER BY nabl_id ASC";
				$get_nabl = mysqli_query($conn,$querys_nabl);
				$rows=mysqli_num_rows($get_nabl);											
				while($r1 = mysqli_fetch_array($get_nabl)){
					$nabl_sr=$r1['nabl_sr_no'];
				}
				if($rows<1){
					$nabl_sr_no_set=1;
					$nabl_sr_no="NABL-".$nabl_sr_no_set;
					
				}
				else{
				
					
					$nabl_sr_no_set=substr($nabl_sr,5);
					$nabl_sr_no="NABL-".($nabl_sr_no_set+1);
					
				
				}
$query = "INSERT INTO `nabl` 
         (`nabl_bill_id`,`nabl_sr_no`)
         VALUES
         ($chk_bill,'$nabl_sr_no')";
         $query_run= mysqli_query($conn,$query);
           if ($query_run)
           { 
	          // echo 'It is working';
			  $update="update bill_totalmaster SET `nabl_status`=1 WHERE `bt_id`=$chk_bill";
				
					$result_of_update=mysqli_query($conn,$update);
           }
}


if(isset($_POST['unchk_bill'])){
   $unchk_bill = $_POST['unchk_bill'];

		 $query = "DELETE FROM `nabl` WHERE `nabl_bill_id`=".$unchk_bill;

         $query_run= mysqli_query($conn,$query);
           if ($query_run)
           { 
	          // echo 'It is working';
			  $update="update bill_totalmaster SET `nabl_status`=0 WHERE `bt_id`=$unchk_bill";
				
			  $result_of_update=mysqli_query($conn,$update);
           }
}



