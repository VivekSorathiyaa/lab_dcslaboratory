	<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
session_start();
include("connection.php");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

		
		/*$from_date=$_POST['from_date'];
		$to_date=$_POST['to_date'];
		$agency=$_POST['agency'];
		$clientname=$_POST['clientname'];
		
				
				$from_day=substr($_POST['from_date'],0,2);
				$from_month=substr($_POST['from_date'],3,2);
				$from_year=substr($_POST['from_date'],6,4);
				$new_from_date = $from_year."-".$from_month."-".$from_day;
				
			
				$to_day=substr($_POST['to_date'],0,2);
				$to_month=substr($_POST['to_date'],3,2); 
				$to_year=substr($_POST['to_date'],6,4);
				$new_to_date = $to_year."-".$to_month."-".$to_day;*/
				
		
		

		/*if($agency != 0 && $from_date!= "" && $to_date!= "" && $clientname!=0){
			$where="And `date` >= '$new_from_date' AND `date` <='$new_to_date' AND `agency`='$agency' AND `client_code`='$clientname' "; 
		}
		else if($from_date !== "" && $to_date !== "" && $agency != 0){
			$where="And `date` >= '$new_from_date' AND `date` <='$new_to_date' AND `agency`='$agency' "; 
		}
		else if($from_date!= "" && $to_date!= "" && $clientname!=0){
			$where="And `date` >= '$new_from_date' AND `date` <='$new_to_date' AND `client_code`='$clientname' "; 
		}
		else if($agency != 0  && $to_date!= "" && $clientname!=0){
			$where="And  `date` <='$new_to_date' AND `agency`='$agency' AND `client_code`='$	' "; 
		}
		else if($agency != 0 && $to_date!= "" && $clientname!=0){
			$where="And `date` >= '$new_from_date'  AND `agency`='$agency' AND `client_code`='$clientname' "; 
		}
		else if($from_date !== "" && $to_date !== "" ){
			$where="And `date` >= '$new_from_date' AND `date` <='$new_to_date'"; 
		}
		else if($from_date !== "" && $to_date !== "" && $agency != 0){
			$where="And `date` >= '$new_from_date'  AND `agency`='$agency' "; 
		}
		else if($from_date!= "" && $clientname!=0){
			$where="And `date` >= '$new_from_date' AND `client_code`='$clientname' "; 
		}
		else if($to_date !== "" && $agency != 0){
			$where="And `date` <='$new_to_date' AND `agency`='$agency' "; 
		}
		else if($to_date!= "" && $clientname!=0){
			$where="And `date` <='$new_to_date' AND `client_code`='$clientname' "; 
		}
		else if($agency != 0 && $clientname!=0){
			$where="And `agency`='$agency' AND `client_code`='$clientname' "; 
		}
		else if($from_date !== "" ){
			$where="And `date` >= '$new_from_date'"; 
		}
		else if($to_date !== "" ){
			$where="And `date` <='$new_to_date'"; 
		}
		else if($agency != 0){
			$where="And `agency`='$agency' "; 
		}
		else if($clientname!=0){
			$where="And `client_code`='$clientname' "; 
		}
		else{
			$where="";
		}*/
		
		
?>
						
					<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										<!--<th style="text-align:center;">Action</th>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Client Name</th>	
										<th style="text-align:center;">Client Address</th>
										<th style="text-align:center;">Client Phone</th>
										<th style="text-align:center;">Email</th>
										<th style="text-align:center;">Client Gst No</th>
										<th style="text-align:center;">Client city</th>
										<th style="text-align:center;">Agency</th>
										<th style="text-align:center;">Agency Address</th>
										<th style="text-align:center;" >Agency Mobile</th>
										<th style="text-align:center;">Agency City</th>
										<th style="text-align:center;">Agency Gstno</th>
										<th style="text-align:center;">Agency Email</th>
										<th style="text-align:center;">Name of Work</th>
										<th style="text-align:center;">Authorized Name</th>
										<th style="text-align:center;">Ref No</th>
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job Number</th>
										<th style="text-align:center;">Sample Sent By</th>
										<th style="text-align:center;">Sample Rec Date</th>-->
										
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job No</th>
										
								
									</tr>
								</thead>
								<tbody>
									<?php
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1'  AND `report_job_printing`='0' ORDER BY job_id DESC";
										$result=mysqli_query($conn,$query);
										$current_date= date("Y-m-d");
										$next_date= date('Y-m-d', strtotime($current_date. ' + 2 days'));
			
					
									while($row=mysqli_fetch_array($result))
									{
										if($row["job_lab_progress"]=='0')
										{
											
											$final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `expected_date` <= '$next_date' ORDER BY final_material_id DESC";
											$final_result=mysqli_query($conn,$final_query);
												if(mysqli_num_rows($final_result) > 0)
												{
													while($final_row=mysqli_fetch_array($final_result))
													{?>
														
														<tr>
															
														<td>
																<?php echo $final_row["report_no"]; ?>
																
																
														</td>	
														<td>
																
																<?php echo $final_row["job_no"]; ?>
																
														</td>
														</tr>
													<?php
													}
												}
											
										}
										else
										{
											
											$final_query="select * from final_material_assign_master WHERE `is_deleted`=0 AND `job_no`='$row[job_number]' AND `expected_date` <= '$next_date' ORDER BY final_material_id DESC";
											$final_result=mysqli_query($conn,$final_query);
												if(mysqli_num_rows($final_result) > 0)
												{
													while($final_row1=mysqli_fetch_array($final_result))
													{?>
														<tr>
															
														<td>
															<?php echo $final_row1["report_no"]; ?>
															
														</td>
														<td>
															
															<?php echo $final_row1["job_no"]; ?>
														</td>	
														</tr>
														
													<?php
													}
												}
											
										}
										
										
									}
																		
									?>
									
								</tbody>
						
							  </table>
		


<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.buttons.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.flash.min.js"></script>
<script src="bower_components/datatables.net-bs/js/jszip.min.js"></script>
<script src="bower_components/datatables.net-bs/js/pdfmake.min.js"></script>
<script src="bower_components/datatables.net-bs/js/vfs_fonts.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.html5.min.js"></script>
<script src="bower_components/datatables.net-bs/js/buttons.print.min.js"></script>

<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<script>		  
     $(document).ready(function() {
    var table = $('#example1').DataTable( {
        //'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
        buttons: [
			
            'excel'
        ]
    } );
 } );

</script>
