<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 30px 10px;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: Arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Arial;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Arial;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from modified_bitumen WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$detail_sample = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	<page size="A4">
		<table align="center" width="94%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-044</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION &  CALCULATION SHEET FOR TEST ON MODIFIED BITUMEN</b></center>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" class="test1" height="17%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;padding: 3px;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;padding: 3px;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;padding: 3px;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding: 3px;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Grade of Bitumen</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo $row_select_pipe['bitumin_grade']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo date("d - m - Y",strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
			</tr>
		</table>
			
		<br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" height="110px" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">
						<tr style="">
							<td style="font-size:13px;font-weight:bold;border-bottom:1px solid;padding: 6px;" colspan="2">1. Softening Point  IS 1205-2022</td>
							<td style="padding: 6px; text-align:left;font-weight:bold;border-bottom:1px solid;">Test Temp <?php if ($row_select_pipe['sof_temp'] != "" && $row_select_pipe['sof_temp'] != "0" && $row_select_pipe['sof_temp'] != null) { echo $row_select_pipe['sof_temp'];} else { echo " <br>";} ?>&deg;C</td>
						</tr>
						<tr>
							<td style="font-weight:bold;text-align:center;padding: 6px 0;">1</td>
							<td style="font-weight:bold;border-left:1px solid;text-align:center;padding: 6px 0;">2</td>
							<td style="font-weight:bold;border-left:1px solid;text-align:center;">Average Value</td>
						</tr>
						<tr>
							<td style="border-top:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['sof_0'] != "" && $row_select_pipe['sof_0'] != "0" && $row_select_pipe['sof_0'] != null) {echo $row_select_pipe['sof_0'];} else {echo " <br>";} ?></td>
							<td style="border-left:1px solid;border-top:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['sof_1'] != "" && $row_select_pipe['sof_1'] != "0" && $row_select_pipe['sof_1'] != null) {echo $row_select_pipe['sof_1'];} else {echo " <br>";} ?></td>
							<td style="border-left:1px solid;border-top:1px solid;text-align:center; padding: 6px 0;font-weight:bold;"><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != "0" && $row_select_pipe['avg_sof'] != null) {echo $row_select_pipe['avg_sof'];} else {echo " <br>";} ?></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" height="110px" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">
						<tr style="">
							<td style="font-size:13px;font-weight:bold;border-bottom:1px solid;padding: 6px;" colspan="2">2. Elastic Recovery IS 15462 : 2019</td>
							<td style="padding: 6px; text-align:left;font-weight:bold;border-bottom:1px solid;">Test Temp <?php if ($row_select_pipe['ela_temp'] != "" && $row_select_pipe['ela_temp'] != "0" && $row_select_pipe['ela_temp'] != null) { echo $row_select_pipe['ela_temp'];} else { echo " &nbsp;";} ?>&deg;C</td>
						</tr>
						<tr>
							<td style="font-weight:bold;text-align:center;padding: 6px 0;">1</td>
							<td style="font-weight:bold;border-left:1px solid;text-align:center;padding: 6px 0;">2</td>
							<td style="font-weight:bold;border-left:1px solid;text-align:center;">Average Value</td>
						</tr>
						<tr>
							<td style="border-top:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['ela_0'] != "" && $row_select_pipe['ela_0'] != "0" && $row_select_pipe['ela_0'] != null) {echo $row_select_pipe['ela_0'];} else {echo " <br>";} ?></td>
							<td style="border-left:1px solid;border-top:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['ela_1'] != "" && $row_select_pipe['ela_1'] != "0" && $row_select_pipe['ela_1'] != null) {echo $row_select_pipe['ela_1'];} else {echo " <br>";} ?></td>
							<td style="border-left:1px solid;border-top:1px solid;text-align:center; padding: 6px 0;font-weight:bold;"><?php if ($row_select_pipe['avg_ela'] != "" && $row_select_pipe['avg_ela'] != "0" && $row_select_pipe['avg_ela'] != null) {echo $row_select_pipe['avg_ela'];} else {echo " <br>";} ?></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-family: Cambria;">
			<tr>
				<td style="text-align:left;font-size:18px;font-weight:bold;padding-bottom:25px;">Tested By :</td>	
			</tr>
			<tr>
				<td style="text-align:left;font-size:18px;font-weight:bold;padding-bottom:25px;">Reviewed By:</td>	
			</tr>
			<tr>
				<td style="text-align:left;font-size:18px;font-weight:bold;">Witness By:</td>	
			</tr>
			
		</table>
		<br>
		
		
	</page>






</body>

</html>

<script type="text/javascript">


</script>