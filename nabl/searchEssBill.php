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
		$sel_branch=$_POST['sel_branch'];
		
				
				$from_day=substr($_POST['from_date'],0,2);
				$from_month=substr($_POST['from_date'],3,2);
				$from_year=substr($_POST['from_date'],6,4);
				$new_from_date = $from_year."-".$from_month."-".$from_day;
				
			
				$to_day=substr($_POST['to_date'],0,2);
				$to_month=substr($_POST['to_date'],3,2);
				$to_year=substr($_POST['to_date'],6,4);
				$new_to_date = $to_year."-".$to_month."-".$to_day;
				
		
		/*if($select_agency==0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date'";
		}
		else{
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `agency_id`='$select_agency'";

		}
*/

		if($select_agency != "select" && $from_date!= "" && $to_date!= "" && $sel_branch!=0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `agency_id`='$select_agency' AND `branch_id`='$sel_branch'"; 
		}
		else if($from_date !== "" && $to_date !== "" && $sel_branch!=0){
			$where="AND `today_date` BETWEEN '$new_from_date' AND '$new_to_date' AND `branch_id`='$sel_branch' ";
		}
		else if ($select_agency != "select" && $to_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_to_date' AND `agency_id`='$select_agency' AND `branch_id`='$sel_branch' ";
		}
		else if ($select_agency != "select" && $from_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_from_date' AND `agency_id`='$select_agency' AND `branch_id`='$sel_branch'";
		}
		else if ($from_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_from_date' AND `branch_id`='$sel_branch'";
			
		}
		else if($to_date!= "" && $sel_branch!=0){
			$where="AND `today_date`='$new_to_date'  AND `branch_id`='$sel_branch' ";
		}
		else if ($from_date!= ""){
			$where="AND `today_date`='$new_from_date' ";
			
		}
		else if($to_date!= ""){
			$where="AND `today_date`='$new_to_date' ";
		}
		else if($sel_branch != 0){
			
			$where="AND `branch_id`='$sel_branch' ";
		}
		else if($select_agency != "select"){
			
			$where="AND `agency_id`='$select_agency'";
		}
		else{
			$where="";
		}
?>
						
		<table id="example1" class="table table-bordered table-striped">
					<thead>
					<tr>
						<tr>
							<th style="text-align:center;">Action</th>
							<th style="text-align:center;"></th>
							<th style="text-align:center;">Chalan no</th>	
							<th style="text-align:center;">Bill no</th>	
							<th style="text-align:center;">Financial year</th>
							<th style="text-align:center;">Job No</th>
							<th style="text-align:center;">Agency Name</th>
							<th style="text-align:center;">Auth Name</th>
							<th style="text-align:center;">Reference Date</th>
							<th style="text-align:center;">Rec Date</th>
							<th style="text-align:center;" >Invoice Date</th>
							<th style="text-align:center;">Bill Date</th>
							<th style="text-align:center;">Tot Taxable Amount</th>
							<th style="text-align:center;">CGST Total</th>
							<th style="text-align:center;">SGST Total</th>
							<th style="text-align:center;">IGST Total</th>
							<th style="text-align:center;">GST</th>
							<th style="text-align:center;">Grand Total</th>
							<th style="text-align:center;">Paytype</th>
							<th style="text-align:center;">Remarks</th>
							<th style="text-align:center;">Total GST in words</th>
							<th style="text-align:center;">Total bill amount in words</th>
							<th style="text-align:center;">Save As Bill</th>
							<th style="text-align:center;">Entry By</th>
							<th style="text-align:center;">Modified By</th>
					
						</tr>
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
										}
						$count=0;
						 $query="select * from estimate_bill_total_master WHERE `fy_id`='$year' $where";
						$result=mysqli_query($conn,$query);
						while($row=mysqli_fetch_array($result))
						{
							$count++;
					?>
							<tr>
							<td style="white-space:nowrap;">
							<?php if($_SESSION['isadmin']=="1" || $_SESSION['isadmin']=="0")
												{
												?>
								<a href="<?php echo $base_url; ?>edit_ess_bill.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-edit"></a>
								&nbsp;
								<a href="<?php echo $base_url; ?>delete_ess_bill.php?id=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-trash" onclick="return confirm('Are you sure to delete data?')?deleteData('delete','<?php echo $row['est_sr_no']; ?>'):false;"></a>
								&nbsp;
								<?php
								}
								?>
								<a href="<?php echo $base_url; ?>report.php?est_sr_no=<?php echo $row['est_sr_no'];?>" class="glyphicon glyphicon-th-list"></a>&nbsp;&nbsp;
								
								<?php if($row['paymenttype']=="cash"){?>
												<a target = '_blank' href="<?php echo $base_url; ?>bill_cash.php?ess_id=<?php echo $row['est_sr_no'];?>&f_year=<?php echo $row['fy_id'];?>" class="glyphicon glyphicon-print"></a>
												
												<?php } else{?>
												
												<a target = '_blank' href="<?php echo $base_url; ?>bill_esstimate.php?ess_id=<?php echo $row['est_sr_no'];?>&f_year=<?php echo $row['fy_id'];?>" class="glyphicon glyphicon-print"></a>
												
												<?php } ?>
												
							
							</td>

							<td><?php echo $count;?></td>
							<td style="white-space:nowrap;"><?php echo $row['est_sr_no'];?></td>
							<td style="white-space:nowrap;"><?php echo $row['bill_sr_manualy'];?></td>
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
							<td><?php echo $row['cgsttotal']+ $row['sgsttotal']+ $row['igsttotal'];?></td>
							<td><?php echo $row['grandtotal'];?></td>
							<td><?php echo $row['paymenttype'];?></td>
							<td><?php echo $row['remarks'];?></td>
							<td style="white-space:nowrap;"><?php echo $row['totalgst_inword'];?></td>
							<td style="white-space:nowrap;"><?php echo $row['billamt_inword'];?></td>
							<td><?php  
									if($row['bt_isbill']==1){
										echo "Yes";
									}else{
										echo "No";
									}					
							?></td><td><?php echo $row['bt_createdby'];?></td>
															
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
				 <tfoot>
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
									</tr>
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
									</tr>
								   </tfoot>
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
		drawCallback: function () {
      var api = this.api();
      
       // var pageTotal=api.column( 17, {page:'every'} ).data().sum();
        var pageTotal=123;
		
        var total_amount=api.column( 17, {page:'every'} ).data();
        var paytype =api.column( 18, {page:'every'} ).data();
		var paid_total=0;
		var remain_total=0
		for (i = 0; i < paytype.length; i++) 
		{
		
		  if(paytype[i]=="cash" || paytype[i]=="cheque" || paytype[i]=="rtgs")
		  {
			  paid_total=parseInt(paid_total)+parseInt(Math.round(total_amount[i]));
		  }else{
			  remain_total =parseInt(remain_total)+parseInt(Math.round(total_amount[i]));
		  }
		}
		
		
		$('tr:eq(0) td:eq(17)', api.table().footer()).html("TOTAL="+Math.round(paid_total+remain_total)+"   <br>PAID=  "+paid_total+"      <br>UNPAID="  +remain_total);
		
		//$(api.column(17).footer()).html("TOTAL="+Math.round(pageTotal)+"   <br>PAID=  "+paid_total+"      <br>UNPAID="  +remain_total);
      
    },
        buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    } );
 } );

</script>
