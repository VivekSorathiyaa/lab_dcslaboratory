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
		$select_agency=$_POST['select_agency'];
		$radio_button=$_POST['radio_button'];
		$sel_branch=$_POST['sel_branch'];
		
		if($radio_button == "bills")
		{
			
				$from_day=substr($_POST['from_date'],0,2);
				$from_month=substr($_POST['from_date'],3,2);
				$from_year=substr($_POST['from_date'],6,4);
				$new_from_date = $from_year."-".$from_month."-".$from_day;
				
			
				$to_day=substr($_POST['to_date'],0,2);
				$to_month=substr($_POST['to_date'],3,2);
				$to_year=substr($_POST['to_date'],6,4);
				$new_to_date = $to_year."-".$to_month."-".$to_day;
				
				
		/*if($from_date != ""){
			$where="AND `today_date`='$new_from_date'";
		}
		else if($to_date != ""){
			$where="AND `today_date`='$new_to_date'";
		}*/
		if($from_date!= "" && $to_date!= "" && $select_agency != "select" && $sel_branch!=0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' "; 
		}
		else if($from_date !== "" && $to_date !== "" && $select_agency != "select" && $sel_branch==0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `bt_isdeleted` = '0' AND `agency_id`='$select_agency'";
		}
		else if($from_date !== "" && $to_date !== "" && $select_agency == "select" && $sel_branch!=0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' ";
		}
		else if($from_date !== "" && $to_date !== ""){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `bt_isdeleted` = '0' ";
		}
		/* else if ($select_agency != 0 && $to_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_to_date' AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
		}
		else if ($select_agency != 0 && $from_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_from_date' AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
		}
		else if ($from_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_from_date' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
			
		}
		else if($to_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_to_date'  AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
		}
		else if ($from_date!= ""){
			$where="AND `today_date`='$new_from_date' AND `bt_isdeleted` = '0' group by `sr_no`";
			
		}
		else if($to_date!= ""){
			$where="AND `today_date`='$new_to_date' AND `bt_isdeleted` = '0' group by `sr_no`";
		}
		else if($sel_branch != 0){
			
			$where="AND `branch_id`='$sel_branch' AND `bt_isdeleted` = '0' group by `sr_no`";
		}
		else if($select_agency != 0){
			
			$where="AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' group by `sr_no`";
		} */
		else{
			$where="";
		}


?>
						
		<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
						<th style="text-align:center;">BAction</th>
						<th style="text-align:right;"></th>
						<th style="text-align:center;">Sr no</th>	
						<th style="text-align:center;">Financial year</th>
						<th style="text-align:center;">Job No</th>
						<th style="text-align:center;">Agency Name</th>
						<th style="text-align:center;">Auth Name</th>
						<th style="text-align:center;">Reference Date</th>
						<th style="text-align:center;">Rec Date</th>
						<th style="text-align:center;">Invoice Date</th>
						<th style="text-align:center;">Bill Date</th>
						<th style="text-align:center;">Tot Taxable Amount</th>
						<th style="text-align:center;">CGST Total</th>
						<th style="text-align:center;">SGST Total</th>
						<th style="text-align:center;">IGST Total</th>
						<th style="text-align:center;">GST</th>
						<th style="text-align:center;">Grand Total</th>
						<th style="text-align:center;">Payment Status</th>
						<th style="text-align:center;">Payment Type</th>
						<th style="text-align:center;">Date of Payment</th>
						<th style="text-align:center;">Check No.</th>
						<th style="text-align:center;">Bank Name</th>
						<th style="text-align:center;">Remarks</th>
						<th style="text-align:center;">Total GST in words</th>
						<th style="text-align:center;">Total bill amount in words</th>
						<th style="text-align:center;">Entry By</th>
						<th style="text-align:center;">Modified By</th>
								
					</tr>
				</thead>
				<tbody>
					<?php
					$query1="SELECT * FROM fyearmaster WHERE `fy_status`='1'";	
										 $qrys = mysqli_query($conn,$query1);
										$no_of_rows=mysqli_num_rows($qrys);
										if($no_of_rows>0){
																
											$r = mysqli_fetch_array($qrys);
											$year=$r['fy_name'];										
											//$year=substr($years, 0, -3);										
										}
						$count=0;
						$sum_of_grand_tot=0;
						$paid_total=0;
						 $query="select * from bill_totalmaster,fyearmaster WHERE `fy_id`='$year' $where";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
							$sum_of_grand_tot += $row['grandtotal'];
							$count++;
					?>
							<tr>
								<td style="white-space:nowrap;">
								<a href="<?php echo $base_url; ?>edit_bill.php?bt_id=<?php echo $row['bt_id'];?>&est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-edit"></a>
								&nbsp;
								<a href="<?php echo $base_url; ?>superadmin_delete_bill.php?id=<?php echo $row['bt_id'];?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $row['bt_id']; ?>'):false;"></a>
								&nbsp;
								<a href="<?php echo $base_url; ?>report.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-th-list"></a>&nbsp;&nbsp;
								<a target = '_blank' href="<?php echo $base_url; ?>bill_print.php?sr_no=sr_no=<?php echo $row['est_sr_no'];?>&f_year=<?php echo $row['fy_id'];?>" class="glyphicon glyphicon-print"></a>
	

							</td>
						
	
							<td><?php echo $count;?></td>
							<td style="white-space:nowrap;"><?php echo $row['sr_no'];?></td>
							<td><?php echo $row['fy_id'];?></td>
							<td><?php echo $row['job_no'];?></td>
							<td><?php echo $row['agency_name'];?></td>
							<td><?php echo $row['auth_name'];?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['ref_date']));?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['rec_date']));?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['inv_date']));?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($row['today_date']));?></td>
							<td><?php echo $row['total_taxableamt'];?></td>
							<td><?php echo $row['cgsttotal'];?></td>
							<td><?php echo $row['sgsttotal'];?></td>
							<td><?php echo $row['igsttotal'];?></td>
							<td><?php echo $row['cgsttotal']+ $row['sgsttotal']+$row['igsttotal'];?></td>
							<td><?php echo $row['grandtotal'];?></td>
							<?php  
								if($row['paymenttype']=="")
								{?>
									<td><?php echo "Pending";?></td>
	
									<?php
								}
								else{
								?>
								<td><?php echo "Paied";?></td>
									<?php
									$paid_total +=$row['grandtotal'];
									}
									?>
								<td><?php echo $row['paymenttype'];?></td>
					
								<?php  
								if($row['paymenttype']=="")
								{?>
								<td><?php echo "00/00/0000";?></td>

								<?php
								}
								else{
								?>
								<td><?php echo date('d/m/Y', strtotime($row['dateofpay']));?></td>
								<?php
								}
								?>
								<td><?php echo $row['check_no'];?></td>
								<td><?php echo $row['bank_name'];?></td>
								<td><?php echo $row['remarks'];?></td>
								<td style="white-space:nowrap;"><?php echo $row['totalgst_inword'];?></td>
								<td style="white-space:nowrap;"><?php echo $row['billamt_inword'];?></td>
								<td><?php echo $row['bt_createdby'];?></td>
												
								<?php  
									if($row['bt_modifiedby']=="")
									{?>
									<td align="center"><?php echo "-";?></td>

									<?php
									}
									else{
									?>
									<td align="center"><?php echo $row['bt_modifiedby'];?></td>
									<?php
									}
								?>
							</tr>
					<?php
						}	
					?>
				  
				</tbody>
				<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<th>Total :</th>
										<th><?php echo $sum_of_grand_tot;?></th>
										<th>Paid :</th>
										<th><?php echo $paid_total;?></th>
										<th>Pending :</th>
										<th colspan="4"><?php echo $sum_of_grand_tot - $paid_total;?></th>
										</tr>
			  </table>
			  <?php
		}
		else
		{
			$from_day=substr($_POST['from_date'],0,2);
				$from_month=substr($_POST['from_date'],3,2);
				$from_year=substr($_POST['from_date'],6,4);
				$new_from_date = $from_year."-".$from_month."-".$from_day;
				
			
				$to_day=substr($_POST['to_date'],0,2);
				$to_month=substr($_POST['to_date'],3,2);
				$to_year=substr($_POST['to_date'],6,4);
				$new_to_date = $to_year."-".$to_month."-".$to_day;
				
				
		/*if($from_date != ""){
			$where="AND `today_date`='$new_from_date'";
		}
		else if($to_date != ""){
			$where="AND `today_date`='$new_to_date'";
		}*/
		if($from_date!= "" && $to_date!= "" && $select_agency != "select" && $sel_branch!=0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch'"; 
		}
		else if($from_date !== "" && $to_date !== "" && $select_agency != "select" && $sel_branch==0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `bt_isdeleted` = '0' AND `agency_id`='$select_agency'";
		}
		else if($from_date !== "" && $to_date !== "" && $select_agency == "select" && $sel_branch!=0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch'";
		}
		else if($from_date !== "" && $to_date !== ""){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `bt_isdeleted` = '0'";
		}
		/* else if ($select_agency != 0 && $to_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_to_date' AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
		}
		else if ($select_agency != 0 && $from_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_from_date' AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
		}
		else if ($from_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_from_date' AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
			
		}
		else if($to_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_to_date'  AND `bt_isdeleted` = '0' AND `branch_id`='$sel_branch' group by `sr_no`";
		}
		else if ($from_date!= ""){
			$where="AND `today_date`='$new_from_date' AND `bt_isdeleted` = '0' group by `sr_no`";
			
		}
		else if($to_date!= ""){
			$where="AND `today_date`='$new_to_date' AND `bt_isdeleted` = '0' group by `sr_no`";
		}
		else if($sel_branch != 0){
			
			$where="AND `branch_id`='$sel_branch' AND `bt_isdeleted` = '0' group by `sr_no`";
		}
		else if($select_agency != 0){
			
			$where="AND `agency_id`='$select_agency' AND `bt_isdeleted` = '0' group by `sr_no`";
		} */
		else{
			$where="";
		}


?>
						
		<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
						<th style="text-align:center;">EAction</th>
						<th style="text-align:right;"></th>
						<th style="text-align:center;">Sr no</th>	
						<th style="text-align:center;">Financial year</th>
						<th style="text-align:center;">Job No</th>
						<th style="text-align:center;">Agency Name</th>
						<th style="text-align:center;">Auth Name</th>
						<th style="text-align:center;">Reference Date</th>
						<th style="text-align:center;">Rec Date</th>
						<th style="text-align:center;">Invoice Date</th>
						<th style="text-align:center;">Bill Date</th>
						<th style="text-align:center;">Tot Taxable Amount</th>
						<th style="text-align:center;">CGST Total</th>
						<th style="text-align:center;">SGST Total</th>
						<th style="text-align:center;">IGST Total</th>
						<th style="text-align:center;">GST</th>
						<th style="text-align:center;">Grand Total</th>
						<th style="text-align:center;">Payment Status</th>
						<th style="text-align:center;">Payment Type</th>
						<th style="text-align:center;">Date of Payment</th>
						<th style="text-align:center;">Check No.</th>
						<th style="text-align:center;">Bank Name</th>
						<th style="text-align:center;">Remarks</th>
						<th style="text-align:center;">Total GST in words</th>
						<th style="text-align:center;">Total bill amount in words</th>
						<th style="text-align:center;">Entry By</th>
						<th style="text-align:center;">Modified By</th>
								
					</tr>
				</thead>
				<tbody>
					<?php
					$query1="SELECT * FROM fyearmaster WHERE `fy_status`='1'";	
										 $qrys = mysqli_query($conn,$query1);
										$no_of_rows=mysqli_num_rows($qrys);
										if($no_of_rows>0){
																
											$r = mysqli_fetch_array($qrys);
											$year=$r['fy_name'];										
											//$year=substr($years, 0, -3);										
										}
						$count=0;
						$sum_of_grand_tot=0;
						$paid_total=0;
					   $querys="select * from estimate_bill_total_master WHERE `fy_id`='$year' $where";
						$results=mysqli_query($conn,$querys);
						while($rows=mysqli_fetch_array($results))
						{
							//echo "this-->".$rows['ref_date'];
							$count++;
							$sum_of_grand_tot += $rows['grandtotal'];
					?>
							<tr>
								<td style="white-space:nowrap;">
								<a href="<?php echo $base_url; ?>edit_ess_bill.php?est_sr_no=<?php echo $rows['est_sr_no'];?>" class="glyphicon glyphicon-edit"></a>
								&nbsp;
								<a href="<?php echo $base_url; ?>superadmin_delete_bill.php?id=<?php echo $rows['id'];?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $rows['id']; ?>'):false;"></a>
								&nbsp;
								<a href="<?php echo $base_url; ?>report.php?est_sr_no=<?php echo $rows['est_sr_no'];?>" class="glyphicon glyphicon-th-list"></a>&nbsp;&nbsp;
								<a target = '_blank' href="<?php echo $base_url; ?>bill_print.php?sr_no=<?php echo $rows['sr_no'];?>" class="glyphicon glyphicon-print"></a>
	

							</td>
						
	
							<td><?php echo $count;?></td>
							<td style="white-space:nowrap;"><?php echo $row['sr_no'];?></td>
							<td><?php echo $rows['fy_id'];?></td>
							<td><?php echo $rows['job_no'];?></td>
							<td><?php echo $rows['agency_name'];?></td>
							<td><?php echo $rows['auth_name'];?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($rows['ref_date']));?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($rows['rec_date']));?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($rows['inv_date']));?></td>
							<td style="white-space:nowrap;"><?php echo date('d/m/Y', strtotime($rows['today_date']));?></td>
							<td><?php echo $rows['total_taxableamt'];?></td>
							<td><?php echo $rows['cgsttotal'];?></td>
							<td><?php echo $rows['sgsttotal'];?></td>
							<td><?php echo $rows['igsttotal'];?></td>
							<td><?php echo $rows['cgsttotal']+ $rows['sgsttotal']+$rows['igsttotal'];?></td>
							<td><?php echo $rows['grandtotal'];?></td>
							<?php  
								if($rows['paymenttype']=="")
								{?>
									<td><?php echo "Pending";?></td>
	
									<?php
								}
								else{
								?>
								<td><?php echo "Paied";?></td>
									<?php
									$paid_total +=$rows['grandtotal'];
									}
									?>
								<td><?php echo $rows['paymenttype'];?></td>
					
								<?php  
								if($rows['paymenttype']=="")
								{?>
								<td><?php echo "00/00/0000";?></td>

								<?php
								}
								else{
								?>
								<td><?php echo date('d/m/Y', strtotime($rows['dateofpay']));?></td>
								<?php
								}
								?>
								<td><?php echo $rows['check_no'];?></td>
								<td><?php echo $rows['bank_name'];?></td>
								<td><?php echo $rows['remarks'];?></td>
								<td style="white-space:nowrap;"><?php echo $rows['totalgst_inword'];?></td>
								<td style="white-space:nowrap;"><?php echo $rows['billamt_inword'];?></td>
								<td><?php echo $rows['bt_createdby'];?></td>
												
								<?php  
									if($rows['bt_modifiedby']=="")
									{?>
									<td align="center"><?php echo "-";?></td>

									<?php
									}
									else{
									?>
									<td align="center"><?php echo $rows['bt_modifiedby'];?></td>
									<?php
									}
								?>
							</tr>
					<?php
						}	
					?>
				  
				</tbody>
				<tr>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<td>&nbsp;</td>
										<th>Total :</th>
										<th><?php echo $sum_of_grand_tot;?></th>
										<th>Paid :</th>
										<th><?php echo $paid_total;?></th>
										<th>Pending :</th>
										<th colspan="4"><?php echo $sum_of_grand_tot - $paid_total;?></th>
										</tr>
			  </table>
			  <?php
			
		}
		
?>
			  
		
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

