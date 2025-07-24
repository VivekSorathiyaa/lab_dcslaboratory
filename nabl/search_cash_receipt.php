<!-- DataTables -->
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
		<link rel="stylesheet" href="bower_components/datatables.net-bs/css/buttons.dataTables.min.css">
<?php 
session_start();
include("connection.php");
error_reporting("ALL");
if($_SESSION['name']=="")
{
	?>
	<script >
		window.location.href="index.php";
	</script>
	<?php
}

if($_POST['from_date']!="" || $_POST['to_date']!="")
{
$ref_dayc1_0=substr($_POST['from_date'],0,2);
$ref_monthc1_0=substr($_POST['from_date'],3,2);
$ref_yearc1_0=substr($_POST['from_date'],6,4);
$start_date = $ref_yearc1_0."-".$ref_monthc1_0."-".$ref_dayc1_0;

$ref_dayc2_0=substr($_POST['to_date'],0,2);
$ref_monthc2_0=substr($_POST['to_date'],3,2);
$ref_yearc2_0=substr($_POST['to_date'],6,4);
$end_date = $ref_yearc2_0."-".$ref_monthc2_0."-".$ref_dayc2_0;

	$where=" AND receipt_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
}else{
	$where="";
}

if($_POST["user_type"]=="0")
{
	$u_types="agency";
	$sets=" AND `user_type`='$u_types' AND `user_id`='$_POST[sends]'";
	$user_id=$_POST["sends"];

	$sel_balances="select * from cash_balance_sheet where `user_type`='$u_types' AND `user_id`='$user_id' AND `is_deleted`='0'";
}else if ($_POST["user_type"]=="1"){
	$u_types="clients";
	$sets=" AND `user_type`='$u_types' AND `user_id`='$_POST[sends]'";
	$user_id=$_POST["sends"];
	$sel_balances="select * from cash_balance_sheet where `user_type`='$u_types' AND `user_id`='$user_id' AND `is_deleted`='0'";
}else if ($_POST["user_type"]=="2"){
	$u_types="other_customer";
	$sets=" AND `user_type`='$u_types' AND `user_id`='$_POST[sends]'";
	$user_id=$_POST["sends"];
	$sel_balances="select * from cash_balance_sheet where `user_type`='$u_types' AND `user_id`='$user_id' AND `is_deleted`='0'";
}
else
{
	$user_id=$_POST["sends"];
	$sel_balances="select * from cash_balance_sheet WHERE ".$where." AND  `is_deleted`='0'";
}
	
	$query_balnce=mysqli_query($conn,$sel_balances);
	if(mysqli_num_rows($query_balnce) > 0)
	{
		$results=mysqli_fetch_array($query_balnce);
		$names=$results["user_name"];
		$total_balance=$results["total_balance"];
		$paid_balance=$results["paid_balance"];
		$remain_balance=$results["remain_balance"];
	}
	

?>								
									
									<form action="admin_inward_print.php" method="POST" target="_blank">
									
									<input type="hidden" name="chk_job_card" value="<?php echo $base_url; ?>set_cash_receipt_print.php?u_types=<?php echo $_POST["user_type"];?>&&start_date=<?php echo $start_date;?>&&end_date=<?php echo $end_date;?>&&user_id=<?php echo $user_id;?>">
									<input type="submit" name="submit_job_card" value="PRINT" class="btn btn-primary form-control" style="height:0%;width:10%;">
									</form>
									<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										
										<th style="text-align:center;">SR. No</th>
										<th style="text-align:center;">Party Name</th>	
										<th style="text-align:center;">receipt code</th>
										<th style="text-align:center;">Receipt date</th>
										<th style="text-align:center;">Payment  Amount</th>
										<th style="text-align:center;">Tds Value</th>
										<th style="text-align:center;">Total Amount</th>
										<th style="text-align:center;">payment type</th>
										<th style="text-align:center;">remark</th>							
										<th style="text-align:center;">Action</th>							
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										
										$query="select * from cash_receipt where `is_deleted`='0'".$sets.$where." ORDER BY receipt_id ASC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											
									?>
											<tr>
											<td><?php echo $count;?></td>
											<?php
											
											$selecting="select * from  job where `tfr_no`='$row[trf_no]'";
											$queryings = mysqli_query($conn, $selecting);
											$getings = mysqli_fetch_array($queryings);
											
											if($row["bill_to"]=="0")
											{
												$clients="select * from agency_master where `isdeleted`=0 AND `agency_id`=".$row["agency_id"];
												$query_client=mysqli_query($conn,$clients);
												$one_client=mysqli_fetch_array($query_client);
												$concect=$one_client["agency_name"];
												$gst_numbers=$one_client["agency_gstno"];
											}else{
												$clients="select * from client where `clientisdeleted`=0 AND `client_code`='$row[client_code]'";
												$query_client=mysqli_query($conn,$clients);
												$one_client=mysqli_fetch_array($query_client);
												$concect=$one_client["clientname"];
												$gst_numbers=$one_client["gst_no"];
											}
											?>
											<td><?php echo $row["user_name"];?></td>
											<td><?php echo $row["receipt_code"];?></td>
											<td><?php echo date('d/m/Y', strtotime($row['receipt_date']));?></td>
											<td><?php echo $row["payment_amount"];?></td>
											<td><?php echo $row["tds_amout"];?></td>
											<td><?php echo $row["total_amount"];?></td>
											<td><?php echo $row["payment_type"];?></td>
											<td><?php echo $row["remark"];?></td>
											<td>
											<a href="javascript:void(0)" class="btn btn-danger delete_cash_receipt" title="Delete" data-id="<?php echo $row['receipt_id'];?>">
											Delete
											</a>
										</tr>
									<?php
										}	
									?>
									<!--<tr>
									<td colspan="9">&nbsp;</td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td><b>TOTAL</b></td>
										<td><b>PAID</b></td>
										<td><b>REMAIN</b></td>
									</tr>
									<tr>
										<td colspan="6">&nbsp;</td>
										<td><b><?php //echo $total_balance;?></b></td>
										<td><b><?php //echo $paid_balance;?></b></td>
										<td><b><?php //echo $remain_balance;?></b></td>
									</tr>-->
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
$(document).ready(function(){
	var table = $('#example1').DataTable( {
        'autoWidth': true,
		'scrollX': true,
		buttons: [ 'copy' ], dom: 'Bfrtip',
		buttons: [
			
            { extend: 'excel',
			  footer: true,
			}
        ],
    });
	
	$(function () {
		$('.select2').select2()
	})

});
</script>