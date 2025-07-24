<?php
include 'connection.php';
  
if(isset($_POST['action_type']) && $_POST['action_type']=="change_assign"){
   $val = $_POST['val'];
   
   $explode_data=explode("|",$val);
   
   $ids= $explode_data[0];
   $report_no= $explode_data[1];


 $query = "update job set `tested_by`='$ids' where `report_no`='$report_no'";
 $query_run= mysqli_query($conn,$query);
          
}
?>
