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

$explode_date=explode("-",$_POST['chek_date']);
$chek_date=$explode_date[2]."-".$explode_date[1]."-".$explode_date[0];

$sel_reserve_ulr="select * from ulr_sequence WHERE `ulr_sequence_date`='$chek_date' AND `ulr_status`='3' ORDER BY ulr_sequence_id ASC LIMIT 0,1";
$query_reserve_ulr=mysqli_query($conn,$sel_reserve_ulr);
if(mysqli_num_rows($query_reserve_ulr) > 0)
{
	$row_seq=mysqli_fetch_array($query_reserve_ulr);
?>
	<!--<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<thead>
									<tr>
										<th style="text-align:center;width:1%;">SN</th>
										<th style="text-align:left;width:1%;">DATE</th>
										<th style="text-align:left;width:1%;">ULR NO</th>
										<th style="text-align:left;width:1%;">JOB NO</th>
										<th style="text-align:left;width:1%;">UNIQUE IDENTIFICATION NO</th>
										<th style="text-align:left;width:1%;">T.R.F. NO</th>
										<th style="text-align:left;width:1%;">REPORT NO</th>
									</tr>
								</thead>
								<tbody>
									<tr>
										<td style="text-align:center;">1</td>
										<td style="text-align:center;"><?php //echo $row_seq['ulr_sequence_date'];?></td>
										<td style="text-align:center;"><?php //echo $row_seq['ulr_sequence'];?></td>
										<td style="text-align:center;"><?php //echo $row_seq['job_no'];?></td>
										<td style="text-align:center;"><?php //echo $row_seq['lab_no'];?></td>
										<td style="text-align:center;"><?php //echo $row_seq['trf_no'];?></td>
										<td style="text-align:center;"><?php //echo $row_seq['report_no'];?></td>
									</tr>
								</tbody>
								</table>-->
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<tbody>
									<tr>
										<td style="text-align:center;color:green;">RESERVE NUMBER AVAILABLE FOR DATE : <?php echo $_POST['chek_date'];?></td>
									</tr>
									<tr>
										<td style="text-align:center;">
										<a href="javascript:void(0);" class="btn btn-danger btn3d delete_old_jobs"><span class="glyphicon glyphicon-question-ok"></span> DELETE OLD REPORT & SET IT TO RECEPTION</a>
										</td>
									</tr>
								</tbody>
								</table>
<?php							
}else{
?>
								<table id="example2" class="table table-bordered table-striped" style="width:100%;">
									<tbody>
									<tr>
										<td style="text-align:center;color:red;">SORRY.....  RESERVE NUMBER NOT AVAILABLE FOR DATE : <?php echo $_POST['chek_date'];?></td>
									</tr>
								</tbody>
								</table>
<?php							
}
?>

	