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
		//$agency=$_POST['agency'];


				$from_day=substr($_POST['from_date'],0,2);
				$from_month=substr($_POST['from_date'],3,2);
				$from_year=substr($_POST['from_date'],6,4);
				$new_from_date = $from_year."-".$from_month."-".$from_day;


				$to_day=substr($_POST['to_date'],0,2);
				$to_month=substr($_POST['to_date'],3,2);
				$to_year=substr($_POST['to_date'],6,4);
				$new_to_date = $to_year."-".$to_month."-".$to_day;



		if($from_date!= "" && $to_date!= "" ){
			$where="And `estimate_date` >= '$new_from_date' AND `estimate_date` <='$new_to_date'  ";
		}
		else if($from_date!= "" ){
			$where="And `estimate_date` >= '$new_from_date' ";
		}
		else if($to_date!= "" ){
			$where="And `estimate_date` <='$new_to_date' ";
		}
		else{
			$where="";
		}


		?>

					<table id="example1" class="table table-bordered table-striped">
									<thead>
									<tr>
										<th style="text-align:center;"></th>
										<th style="text-align:center;">Report No</th>
										<th style="text-align:center;">Job No</th>
										<th style="text-align:center;">Estimate No.</th>
										<th style="text-align:center;">Estimate Date</th>
										<th style="text-align:center;">Party Name</th>
										<th style="text-align:center;">Address</th>
										<th style="text-align:center;">City</th>
										<th style="text-align:center;">Pin code</th>
										<th style="text-align:center;">GST No.</th>
										<th style="text-align:center;">CGST Amt</th>
										<th style="text-align:center;">SGST Amt</th>
										<th style="text-align:center;">IGST Amt</th>
										<th style="text-align:center;">Grand Total</th>
										<th style="text-align:center;">Total GST Amt</th>
										<th style="text-align:center;">Total Amt</th>
										<th style="text-align:center;">is Billing</th>
									</tr>
								</thead>
								<tbody>
									<?php

										$count=0;
										 $query="select * from estimate_total_span where `est_isdeleted`='0' AND `is_billing`='1' AND (`gst_type`='with_gst' OR `gst_type`='with_igst')".$where;
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{
											$count++;

									?>
											<tr id="tr_<?php echo $row['est_id']?>">
											<td><?php echo $count;?></td>
											<td style="white-space:nowrap;"><?php echo $row['report_no'];?></td>
											<td><?php echo $row['job_no'];?></td>
											<td><?php echo $row['estimate_no'];?></td>
											<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['estimate_date']));?></td>


											<?php
											$sel_reports_data="select * from job where `report_no`='".$row['report_no']."'";
											$query_report_data = mysqli_query($conn, $sel_reports_data);
											$get_data = mysqli_fetch_array($query_report_data);

											if($get_data['report_sent_to']=='0')
											{

											?>
											<td><?php echo $get_data['clientname'];?></td>
											<td><?php echo $get_data['clientaddress'];?></td>
											<td><?php
											$get_city="select * from city where `id`=".$get_data['client_city'];
											$city_dataas = mysqli_query($conn, $get_city);
											$citys = mysqli_fetch_array($city_dataas);

											echo $citys['city_name'];?></td>
											<td><?php echo $get_data['client_pincode'];?></td>
											<td><?php echo $get_data['client_gstno'];?></td>
											<?php
											}
											else
											{
											 $sel_agency="select * from agency_master where `agency_id`=".$get_data['agency'];
											$query_agency = mysqli_query($conn, $sel_agency);
											$get_agency = mysqli_fetch_array($query_agency);
											?>
											<td><?php echo $get_agency['agency_name'];?></td>
											<td><?php echo $get_data['agency_address'];?></td>
											<td><?php
											$get_city="select * from city where `id`=".$get_data['agency_city'];
											$city_dataas = mysqli_query($conn, $get_city);
											$citys = mysqli_fetch_array($city_dataas);

											echo $citys['city_name'];?></td>
											<td><?php echo $get_data['agency_pincode'];?></td>
											<td><?php echo $get_data['agency_gstno'];?></td>
											<?php
											}
											?>
											<td><?php echo $row['c_gst_amt'];?></td>
											<td><?php echo $row['s_gst_amt'];?></td>
											<td><?php echo $row['i_gst_amt'];?></td>
											<td><?php echo $row['grand_total'];?></td>
											<td><?php echo ($row['total_amt']-$row['grand_total']);?></td>
											<td><?php echo $row['total_amt'];?></td>
											<td>
											<?php if($row['is_billing']=='1'){
												echo "yes";
											}else{
												echo "no";
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
