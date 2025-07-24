<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0px 30px;
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
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family : Calibri;
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
	$branch_name = $row_select['branch_name'];
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
        $issue_date = $row_select2['issue_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name= $row_select3['mt_name'];
			
			include_once 'sample_id.php';
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


<br><br><br>
	<page size="A4">
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">BITUMEN</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">MODIFIED POLYMER BITUMEN</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-044</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Grade of Bitumen :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $row_select_pipe['bitumin_grade']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 1205-2022</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>

		<!-- <table align="center" width="100%" class="test1" height="17%">
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
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
			</tr>
		</table>
		<br> -->

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" height="110px" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
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
		<br><br>
		
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" height="110px" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;">
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

			<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
							<!-- <tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
							</tr> -->
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
								<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
							</tr>
							<tr>
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
		</table>
		
	</page>
</body>

</html>

<script type="text/javascript">


</script>