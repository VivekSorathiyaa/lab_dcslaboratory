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


		$from_date=$_POST['from_date'];
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
				$new_to_date = $to_year."-".$to_month."-".$to_day;




		if($agency != 0 && $from_date!= "" && $to_date!= "" && $clientname!=0){
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
		}


?>

					<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th style="text-align:center;">Action</th>
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
										<th style="text-align:center;">Sample Rec Date</th>
										<th style="text-align:center;">Condition of Sample Receved</th>


									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;
										$query="select * from job WHERE `jobisdeleted`=0 AND `assign_status`=1 AND `send_to_second_reception`=1 AND `material_assign`= 1 AND `morr`= 'm' AND `job_lab_assign`='1' AND `job_lab_progress`= '0' AND `report_job_printing`='0' ORDER BY job_id DESC ".$where;
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr>
											<td style="white-space:nowrap;">

												<a href="<?php echo $base_url; ?>edit_job_invert.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-edit"></a>
												&nbsp;
												<a href="<?php echo $base_url; ?>delete_ess_bill.php?id=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $row['est_sr_no']; ?>'):false;"></a>
												&nbsp;
												<a href="<?php echo $base_url; ?>report.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-th-list"></a>&nbsp;&nbsp;

												<a href="<?php echo $base_url; ?>billing.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-book"></a>&nbsp;&nbsp;

											</td>

											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['clientname'];?></td>
											<td><?php echo $row['clientaddress'];?></td>
											<td><?php echo $row['clientphone'];?></td>
											<td><?php echo $row['email'];?></td>
											<td><?php echo $row['client_gstno'];?></td>

											<?php
											$sel_city="select * from city where id=".$row['client_city'];
											$query_city = mysqli_query($conn, $sel_city);
											$get_city = mysqli_fetch_array($query_city);
											?>
											<td><?php echo $get_city['city_name'];?></td>

											<?php $sel_agency="select * from agency_master where `agency_id`=".$row["agency"];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											?>
											<td><?php echo $get_agency['agency_name'];?></td>
											<td><?php echo $row['agency_address'];?></td>
											<td><?php echo $row['agency_mobile'];?></td>
											<?php $sel_agency_city="select * from city where `id`=".$row["agency_city"];
											$query_agency_city = mysqli_query($conn, $sel_agency_city);
											$get_agency_city = mysqli_fetch_array($query_agency_city);
											?>
											<td><?php echo $get_agency_city['city_name'];?></td>
											<td><?php echo $row['agency_gstno'];?></td>
											<td><?php echo $row['agency_email'];?></td>
											<td><?php echo $row['nameofwork'];?></td>
											<td><?php echo $row['person_name'];?></td>
											<td><?php echo $row['refno'];?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['date']));?></td>
											<td><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_number'];?></td>
											<td>
											<?php if($row['sample_sent_by']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row[	'sample_rec_date']));?></td>
											<td>
											<?php if($row['condition_of_sample_receved']=='0'){
												echo $row['clientname'];
											}else{
												echo $get_agency['agency_name'];
											}?>
											</td>

										</tr>
									<?php
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
