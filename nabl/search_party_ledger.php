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

	$where=" AND entry_date BETWEEN '" . $start_date . "' AND  '" . $end_date."'";
}else{
	$where="";
}

	$explodings=explode("|",$_POST["party_name"]);
	$party_id=$explodings[0];
	$party_name=$explodings[1];
	$sets=" AND `user_type`='party' AND `user_id`='$party_id'";

	$sel_balances="select * from party_balance_sheet where `user_type`='party' AND `user_id`='$party_id' AND `is_deleted`='0'";

	
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
									
									<input type="hidden" name="chk_job_card" value="<?php echo $base_url; ?>set_party_ledger_print.php?u_types=party&&start_date=<?php echo $start_date;?>&&end_date=<?php echo $end_date;?>&&user_id=<?php echo $party_id;?>">
									<input type="submit" name="submit_job_card" value="PRINT" class="btn btn-primary form-control" style="height:0%;width:10%;">
									</form>
									<table id="example1" class="table table-bordered table-striped" style="width:100%">
									<thead>
									<tr>
										
										<th style="text-align:center;">SR. No</th>
										<th style="text-align:center;">Party Name</th>	
										<th style="text-align:center;">Date</th>
										<th style="text-align:center;">Bill No</th>
										<th style="text-align:center;">Receipt No</th>
										<th style="text-align:center;">Total</th>
										<th style="text-align:center;">Tds</th>
										<th style="text-align:center;">Debit</th>
										<th style="text-align:center;">Credit</th>
										<th style="text-align:center;">Closing</th>
																	
								
									</tr>
								</thead>
								<tbody>
									<?php
									
										$count=0;
										$closings=0;
										
										$query="select * from party_ledger where `is_deleted`=0".$sets.$where." ORDER BY ledger_id ASC";
										$result=mysqli_query($conn,$query);
										while($row=mysqli_fetch_array($result))
										{$mt_cnt=0;
											$count++;
											
											if($row["entry_type"]=="purchase_in")
											{
												$closings= floatval($closings) + floatval($row["credits"]);
											}
											else
											{
												$closings= floatval($closings) - floatval($row["debits"]);
											}
											
									?>
											<tr>
											<td><?php echo $count;?></td>
											<td><?php echo $row["user_name"];?></td>
											<td><?php echo date('d/m/Y', strtotime($row['entry_date']));?></td>
											<td><?php echo $row["bill_no"];?></td>
											<td><?php echo $row["receipt_no"];?></td>
											<td><?php echo $row["totals_amnt"];?></td>
											<td><?php echo $row["tds_amnt"];?></td>
											<td><?php echo $row["debits"];?></td>
											<td><?php echo $row["credits"];?></td>
											<td><?php echo $closings;?></td>
											
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