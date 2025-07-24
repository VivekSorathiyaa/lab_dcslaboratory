<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;
	}

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
	$entity = '&radic;';

	// select the one you like the best
	$squareRoot = '√';
	$squareRoot = html_entity_decode($entity);
	$squareRoot = mb_convert_encoding($entity, 'UTF-8', 'HTML-ENTITIES');

	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$lab_no = $_GET['lab_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from fly_ash WHERE `lab_no`='$lab_no' AND `lab_no`='$lab_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	// $sr_no = $row_select['sr_no'];
	// $sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 and `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
	}

	$pagecnt = 1;
	$totalcnt = 1;
	if (($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) {
		$totalcnt++;
	}


	?>

	<br>
	<br>

	<page size="A4">
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;border:1px solid;">
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
						<tr>
							<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><u>PAVER BLOCK</u></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Format No :- &nbsp; ICT-FLY-TST-01</td>
							<td style="padding: 5px;"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :- &nbsp; <?php echo $sample_id; ?></td>
							<td style="padding: 5px;"></td>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Testing Date :- &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
							<td style="padding: 5px;"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :- &nbsp; <?php echo $detail_sample; ?></td>
							<td style="padding: 5px;"></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 0px solid;" colspan="4"></td>
						</tr>
					</table>
				
		
		
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;font-size: 13px;"><b>Consistency of cement (As per IS 4031 Part IV)</b></td>
			</tr>
			<tr style="height: 40px;">
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php echo $row_select_pipe['consistency_of_cement'] ?></td>
			</tr>
		</table>
	
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 0;">
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="4"><b>Compressive Strength of Refrence Cement (as per IS 4031 Part VI)</b></td>
			</tr>
			<tr style="height: 24px;">
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Compressive Strength at 7 days</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b><?php echo $row_select_pipe['avg_com_2']; ?></b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Mpa</b></td>
				<td style="border:0;text-align:center;padding: 2px 4px;width: 12.12%;"></td>
			</tr>
			<tr style="height: 24px;">
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Compressive Strength at 28 days</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b><?php echo $row_select_pipe['avg_com_3']; ?></b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Mpa</b></td>
				<td style="border:0;text-align:center;padding: 2px 4px;width: 12.12%;"></td>
			</tr>
		</table>
		<br>

		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="6"><b>Compressive Strength of Flyash (as per IS 4031 Part VI)</b></td>
			</tr>
			<tr style="height: 24px;">
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Weight of Cement</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;background-color: #ddd;"><b><?php echo $row_select_pipe['weight_of_cement']; ?></b></td>
				<td style="border:0;text-align:left;padding: 2px 4px;width: 12.12%;"><b>gm</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Weight of Sand</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;background-color: #ddd;"><b><?php echo $row_select_pipe['weight_of_sand']; ?></b></td>
				<td style="border:0;text-align:left;padding: 2px 4px;width: 12.12%;"><b>gm</b></td>
			</tr>
			<tr style="height: 24px;">
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Weight of flyash</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;background-color: #ddd;"><b><?php echo $row_select_pipe['weight_of_cement']; ?></b></td>
				<td style="border:0;text-align:left;padding: 2px 4px;width: 12.12%;"><b>gm</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><b>Weight of Water</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;background-color: #ddd;"><b><?php echo $row_select_pipe['weight_of_water']; ?></b></td>
				<td style="border:0;text-align:left;padding: 2px 4px;width: 12.12%;"><b>gm</b></td>
			</tr>
		</table>
		<br>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Cube Mould <br> No.</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Casting Date</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Time (min)</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Date of <br> Testing</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Time (min)</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Weight of cube (kgs)</b></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><b>Max. Load (kN)</b></td>
			</tr>
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;">1</td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																															echo date("d/m/Y", strtotime($row_select_pipe['caste_date1']));
																														} else {
																															echo "&nbsp;";
																														} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['caste_time1']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																															echo date("d/m/Y", strtotime($row_select_pipe['test_date1']));
																														} else {
																															echo "&nbsp;";
																														} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['test_time1']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['woc_1']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['load_1']; ?></td>
			</tr>
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;">2</td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php if ($row_select_pipe['caste_date2'] != "" && $row_select_pipe['caste_date2'] != "0" && $row_select_pipe['caste_date2'] != null) {
																															echo date("d/m/Y", strtotime($row_select_pipe['caste_date2']));
																														} else {
																															echo "&nbsp;";
																														} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['caste_time2']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php if ($row_select_pipe['test_date2'] != "" && $row_select_pipe['test_date2'] != "0" && $row_select_pipe['test_date2'] != null) {
																															echo date("d/m/Y", strtotime($row_select_pipe['test_date2']));
																														} else {
																															echo "&nbsp;";
																														} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['test_time2']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['woc_2']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['load_2']; ?></td>
			</tr>
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;">3</td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php if ($row_select_pipe['caste_date3'] != "" && $row_select_pipe['caste_date3'] != "0" && $row_select_pipe['caste_date3'] != null) {
																															echo date("d/m/Y", strtotime($row_select_pipe['caste_date3']));
																														} else {
																															echo "&nbsp;";
																														} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['caste_time3']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php if ($row_select_pipe['test_date3'] != "" && $row_select_pipe['test_date3'] != "0" && $row_select_pipe['test_date3'] != null) {
																															echo date("d/m/Y", strtotime($row_select_pipe['test_date3']));
																														} else {
																															echo "&nbsp;";
																														} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['test_time3']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['woc_3']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;border-bottom: 0;"><?php echo $row_select_pipe['load_3']; ?></td>
			</tr>
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;">4</td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php if ($row_select_pipe['caste_date4'] != "" && $row_select_pipe['caste_date4'] != "0" && $row_select_pipe['caste_date4'] != null) {
																											echo date("d/m/Y", strtotime($row_select_pipe['caste_date4']));
																										} else {
																											echo "&nbsp;";
																										} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php echo $row_select_pipe['caste_time4']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php if ($row_select_pipe['test_date4'] != "" && $row_select_pipe['test_date4'] != "0" && $row_select_pipe['test_date4'] != null) {
																											echo date("d/m/Y", strtotime($row_select_pipe['test_date4']));
																										} else {
																											echo "&nbsp;";
																										} ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php echo $row_select_pipe['test_time4']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php echo $row_select_pipe['woc_4']; ?></td>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;"><?php echo $row_select_pipe['load_4']; ?></td>
			</tr>
		</table>

		<br>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="6"><b>Specific Surface of Flyash by Blaines air permeability Apparatus (As per IS 4031 P2)</b></td>
			</tr>
			<tr>
				<td>
					<table width="80%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;border-bottom: 0;">
						<tr>
							<td style="border:0;text-align:left;padding: 13px 4px 2px;width: 12.12%;font-size: 13px;" colspan="3"><span style="border-bottom: 2px solid black;font-weight: bold;">Determination of time</span></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:left;padding: 2px 4px;width: 12.12%;font-size: 13px;">Date of Testing</td>
							<td style="border:1px solid black;text-align:left;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo date('d-m-Y', strtotime($end_date)); ?></td>
							<td style="border:0;text-align:left;padding: 2px 4px;width: 12.12%;font-size: 13px;"></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Description</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;">Trial 1</td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Specific Surface of standard sample</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["ss_sample"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Specific Gravity of standard sample</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["gs_sample"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Porosity of the standard bed</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["ps_bed"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">For standard &#8730;e<sup>3</sup></td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["fs_e3"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Time taken for standard sample</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["tts_sample"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">K-value</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["constant_k"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Porosity of the sample bed</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["por_sample_bed"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">For sample &#8730;e<sup>3</sup></td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["sample_e3"]; ?></td>
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:left;padding: 2px 4px;width: 12.12%;font-size: 13px;" colspan="2">Time elapsed from the bottom of the meniscus reaches <br> next to the top mark till the bottom of the meniscus <br> reaches the bottom mark. (in s) T1</td>
							<td style="border:1px solid black;text-align:center;padding: 2px 4px;width: 12.12%;font-size: 13px;"><?php echo $row_select_pipe["tt1"]; ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
<!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="92%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
		<div class="pagebreak"> </div>
		<br>
		<br><br>




	<tr>
				<td>
					<table align="center" width="92%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
						<tr>
							<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"><u>PAVER BLOCK</u></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="92%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Format No :- &nbsp; ICT-FLY-TST-02</td>
							<td style="padding: 5px;"></td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :- &nbsp; <?php echo $sample_id; ?></td>
							<td style="padding: 5px;"></td>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Testing Date :- &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
							<td style="padding: 5px;"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :- &nbsp; <?php echo $detail_sample; ?></td>
							<td style="padding: 5px;"></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 0px solid;" colspan="4"></td>
						</tr>
					</table>
				
		 <table align="center" width="92%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td rowspan="5" style="border: 1px solid black; width:10%; text-align:center;"><b>Consistancy <br> (IS : 4031 - Part V)</b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b>Temp(<sup>0</sup>C)</b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b>Hmdty(%)</b></td>
				<td style="border: 1px solid black; width:20%; "><b>Identification</b></td>
				<td style="border: 1px solid black; text-align:center; width:15%;"><b>S-1</b></td>
				<td style="border: 1px solid black; text-align:center; width:15%;"><b>S-2</b></td>
				<td style="border: 1px solid black; text-align:center; width:15%;"><b>S-3</b></td>
			</tr>
			<tr>
				<td rowspan="4" style="border: 1px solid black;text-align:center"><b><?php echo $row_select_pipe["con_temp"]; ?></b></td>
				<td rowspan="4" style="border: 1px solid black;text-align:center"><b><?php echo $row_select_pipe["con_humidity"]; ?></b></td>
				<td style="border: 1px solid black;"><b>Vol. of water (ml) A</b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['vol_1']; ?></b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['vol_2']; ?></b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['vol_3']; ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Quantity of Cement + Flyash <br> (50% CEMENT + 50% Flyash) (g) (B)</b></td>
				<td colspan="3" style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe["con_weight"]; ?></b></td>

			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Penetration, mm</b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['reading_1']; ?></b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['reading_2']; ?></b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['reading_3']; ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Standard Consistancy(%)(a/b)</b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['wtr_1']; ?></b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['wtr_2']; ?></b></td>
				<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['wtr_3']; ?></b></td>
			</tr>

			<tr>
				<td rowspan="7" style="border: 1px solid black; width:10%; text-align:center;"><b>Fineness <br> (Blaine's Air Permeability Method) <br> (IS : 4031-Part II)</b></td>
				<td rowspan="7" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['fine_temp']; ?></b></td>
				<td rowspan="7" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['fine_humidity']; ?></b></td>
				<td style="border: 1px solid black; width:20%;"><b>Weight of Cement (A), gm</b></td>
				<td colspan="1" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['den_cement']; ?></b></td>
				<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Fineness by Blaine Air Permeability</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%;"><b>Initial Vol. of Le-Chat, Flask (B), ml</b></td>
				<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['den_intial']; ?></b></td>
				<td style="border: 1px solid black; width:15%; "><b>Time for Bed 1, sec</b></td>
				<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['fines_t_1']; ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%;"><b>Final Vol. of Le-Chat Flask(C), ml</b></td>
				<td colspan="1" style="border: 1px solid black; width:15%; text-align:center;"><b><?php echo $row_select_pipe['den_final']; ?></b></td>
				<td style="border: 1px solid black; width:20%; width:15%;"><b>Time for Bed 1, sec</b></td>
				<td colspan="2" style="border: 1px solid black; width:15%; text-align:center;"><b><?php echo $row_select_pipe['fines_t_2']; ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%;"><b>Density of Flyash (&rho;)(A/(C-B))</b></td>
				<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['density']; ?></b></td>
				<td style="border: 1px solid black; width:15%; "><b>Time for Bed 2, sec</b></td>
				<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['fines_t_3']; ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%;"><b></b></td>
				<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b></b></td>
				<td style="border: 1px solid black; width:15%; "><b>Time for Bed 2, sec</b></td>
				<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['fines_t_4']; ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%;"><b>Mass of Flyash req. for Cement bed <br>(0.5 x V x &rho;)</b></td>
				<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['mass']; ?></b></td>
				<td style="border: 1px solid black; width:20%; "><b>Avg, Time(T), sec</b></td>
				<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['avg_fines_time']; ?></b></td>
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid black; width:10%;"><b>Specific surface area m<sup>2</sup>/Kg <?php if ($row_select_pipe["type_of_cement"] == "OPC") {
																															echo "(OPC)=K x'$squareRoot'T";
																														} else {
																															echo "K x $squareRoot T x $squareRoot E<sup>3</sup> / 1-e";
																														} ?></b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['ss_area']; ?></b></td>
			</tr>

		</table>
		<br>



		<table align="center" width="92%" class="test" style="border: 1px solid black; margin-top:20px;">
			<tr>
				<td colspan="2" style="border: 1px solid black;  text-align:center;"><b>Moisture Content</b></td>

				<td style="border: 1px solid black; width:10%; text-align:center;"><b>IS 2720 (Part 2) </b></td>

			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b>Initial weight in (gm) (W1)</b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b>Oven dry weight in (gm) (W2)</b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b>Moisture Content (%) = (W1 - W2/W1) x 100</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['in_w1'] != "" && $row_select_pipe['in_w1'] != "0" && $row_select_pipe['in_w1'] != null) {
																							echo $row_select_pipe['in_w1'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['fn_w1'] != "" && $row_select_pipe['fn_w1'] != "0" && $row_select_pipe['fn_w1'] != null) {
																							echo $row_select_pipe['fn_w1'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['mo1'] != "" && $row_select_pipe['mo1'] != "0" && $row_select_pipe['mo1'] != null) {
																							echo $row_select_pipe['mo1'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['in_w2'] != "" && $row_select_pipe['in_w2'] != "0" && $row_select_pipe['in_w2'] != null) {
																							echo $row_select_pipe['in_w2'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['fn_w2'] != "" && $row_select_pipe['fn_w2'] != "0" && $row_select_pipe['fn_w2'] != null) {
																							echo $row_select_pipe['fn_w2'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['mo2'] != "" && $row_select_pipe['mo2'] != "0" && $row_select_pipe['mo2'] != null) {
																							echo $row_select_pipe['mo2'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
			<tr>

				<td colspan="2" style="border: 1px solid black; width:10%; text-align:right;"><b>Average:</b></td>
				<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if ($row_select_pipe['avg_mo'] != "" && $row_select_pipe['avg_mo'] != "0" && $row_select_pipe['avg_mo'] != null) {
																							echo $row_select_pipe['avg_mo'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
		</table>
		<table align="center" width="92%" class="test" style="border: 1px solid black; margin-top:20px;">
						<tr style="">
							<td style="border:1px solid black;text-align:center;font-weight: bold;font-size: 11px;padding: 2px;" colspan="5">Initial & Final Setting time IS 4031 Part V : 1988 </td>

						</tr>
						<tr style="">
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;" colspan="5">&nbsp;</td>

						</tr>
						<tr style="">
							
							<td style="border:1px solid black;text-align:left;padding: 4px;">Weight Of Cement(g)</td>
							<td style="width: 20%;border:1px solid black;text-align:center;font-weight: bold;background-color: #eeeeee;padding: 4px;">400</td>
							<td style="border:1px solid black;text-align:center;">Weight Of Water (g)</td>
							<td style="width: 20%;border:1px solid black;text-align:center;font-weight: bold;background-color: #eeeeee;padding: 4px;"><?php echo $row_select_pipe['set_wtr']; ?></td>
						</tr>
						<tr style="">
							
							<td style="border:1px solid black;text-align:left;padding: 4px;">Initial Setting Time (mins)</td>
							<td style="border:1px solid black;text-align:center;padding: 4px;" colspan="3"><?php echo $ans = round($row_select_pipe['initial_time'] / 5) * 5; ?></td>
						</tr>
						<tr style="">
							
							<td style="border:1px solid black;text-align:left;padding: 4px;">Final Setting Time (mins)</td>
							<td style="border:1px solid black;text-align:center;padding: 4px;" colspan="3"><?php echo $ans = round($row_select_pipe['final_time'] / 5) * 5; ?></td>
						</tr>
					</table>
					<table align="center" width="92%" class="test" style="border: 1px solid black; margin-top:20px;">
						<tr>
							<td style=" border:0px solid black;text-align:center;font-weight: bold;padding: 4px;">Soundness</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;" colspan="4">Le Chatelier Method IS 4031 Part III : 1988 </td>
							<td>&nbsp;</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;" colspan="3">Autoclave Method IS 4031 Part III : 1988 </td>
						</tr>
						<tr style="height: 5px;">
						</tr>
						<tr>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Weight Of Cement(g)</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Weight Of Water(g)</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Initial reading of Indicators(mm)</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Reading of indicators after boiling and cooling (mm)</td>
							<td>&nbsp;</td>

							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Description</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Trial 1</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">Trial 2</td>
						</tr>

						<tr>
							<td style=" border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"></td>
							<td>&nbsp;</td>

							
						</tr>


						<tr>
							
							<td style="border:1px solid black;text-align:center;font-weight: bold;background-color: #eeeeee;padding: 4px;"><?php echo $row_select_pipe["sou_weight"]; ?> </td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;background-color: #eeeeee;padding: 4px;"><?php echo $row_select_pipe["sou_water"]; ?></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"><?php echo $row_select_pipe["dis_1_1"]; ?> </td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"><?php if ($row_select_pipe['dis_2_1'] != "" && $row_select_pipe['dis_2_1'] != "0" && $row_select_pipe['dis_2_1'] != null) {
																														echo $row_select_pipe['dis_2_1'];
																													} else {
																														echo "&nbsp;";
																													} ?>
							<td>&nbsp;</td>

							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">L1 (Length measured after curing for a period of 24h hrs in a moist room (mm))</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;" ><?php echo $row_select_pipe["sba_l1_1"]; ?></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;" ><?php echo $row_select_pipe["sba_l1_2"]; ?></td>
						</tr>

						<tr>
							<td style="border:1px solid black;text-align:center;font-weight: bold;background-color: #eeeeee;padding: 4px;"> <?php echo $row_select_pipe["sou_weight"]; ?></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;background-color: #eeeeee;padding: 4px;"><?php echo $row_select_pipe["sou_water"]; ?></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"><?php echo $row_select_pipe["dis_1_2"]; ?></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"><?php if ($row_select_pipe['dis_2_2'] != "" && $row_select_pipe['dis_2_2'] != "0" && $row_select_pipe['dis_2_2'] != null) {
																														echo $row_select_pipe['dis_2_2'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td>&nbsp;</td>

							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;">L2 (Length measured after completion of autoclave test (mm))</td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;"><?php echo $row_select_pipe["sba_l2_1"]; ?></td>
							<td style="border:1px solid black;text-align:center;font-weight: bold;padding: 4px;" ><?php echo $row_select_pipe["sba_l2_2"]; ?></td>
						</tr>
					</table>
		<br> 
		 <!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="92%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            


		<!-- <table align="center" width="90%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="5px">
				<tr>
					<td colspan="5" style="font-size:14px;border: 1px solid black;"><center><b>Adcon Consultancy &amp; NDT Services</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="font-size:14px;border: 1px solid black;"><center><b>Job sheet for Physical Test of Flyash</b></center></td>					
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>F-Flyash-01, Issue No.01, Page No 1 of 2</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Laboratory Ref. No.:<?php echo $job_no; ?></b></td>					
					<td colspan="2" style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></b></td>					
				</tr>
				<tr>
					<td rowspan="2" style="border: 1px solid black; width:20%; text-align:center; padding-top:0;"><b>Any Other Information:</b></td>		
					<td style="border: 1px solid black;"><b></b></td>
					<td style="border: 1px solid black; width:15%;"><b></b></td>					
					<td style="border: 1px solid black;"><b></b></td>					
					<td style="border: 1px solid black;"><b>Starting Date:  <?php echo date('d/m/Y', strtotime($start_date)); ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b></b></td>
					<td style="border: 1px solid black;"><b></b></td>					
					<td style="border: 1px solid black;text-align:center"><b></b></td>					
					<td style="border: 1px solid black;"><b>Completion Date:  <?php echo date('d/m/Y', strtotime($end_date)); ?></b></td>					
				</tr>
				<tr>
					<td colspan="5" style="font-size:16px;border: 1px solid black;">&nbsp;</td>					
				</tr>
			</table> -->
		<!-- <br>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Compressive<br> Strength<br> (IS : 4031 - Part VI)</b></td>
				<td style="border: 1px solid black;text-align:center;"><b>Temp(<sup>0</sup>C)</b></td>
				<td style="border: 1px solid black;text-align:center;"><b>Hmdty(%)</b></td>
				<td style="border: 1px solid black;text-align:center;"><b>Date & Time of Casting</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Date & Time of Testing</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Age at The Time of Testing</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>ID</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Lenth, mm</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Width, mm</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Area, mm<sup>2</sup></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Load kN</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Comp Stre., N/mm<sup>2</sup></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Avg. Comp. Stre., N/mm<sup>2</sup></b></td>
			</tr>

			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>Cement Cube</b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_temp'] != "" && $row_select_pipe['com_temp'] != "0" && $row_select_pipe['com_temp'] != null) {
																							echo $row_select_pipe['com_temp'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_humidity'] != "" && $row_select_pipe['com_humidity'] != "0" && $row_select_pipe['com_humidity'] != null) {
																							echo $row_select_pipe['com_humidity'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;"><b><?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																		echo date("d/m/Y", strtotime($row_select_pipe['caste_date1']));
																	} else {
																		echo "&nbsp;";
																	} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																							echo date("d/m/Y", strtotime($row_select_pipe['test_date1']));
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['day_1'] != "" && $row_select_pipe['day_1'] != "0" && $row_select_pipe['day_1'] != null) {
																							echo $row_select_pipe['day_1'] . " Days";
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																				echo $row_select_pipe['l1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b1'] != "" && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {
																				echo $row_select_pipe['b1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) {
																				echo $row_select_pipe['area_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																				echo $row_select_pipe['load_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																				echo $row_select_pipe['com_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) {
																							echo $row_select_pipe['avg_com_1'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != "0" && $row_select_pipe['l2'] != null) {
																				echo $row_select_pipe['l2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b2'] != "" && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {
																				echo $row_select_pipe['b2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) {
																				echo $row_select_pipe['area_2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																				echo $row_select_pipe['load_2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																				echo $row_select_pipe['com_2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != "0" && $row_select_pipe['l3'] != null) {
																				echo $row_select_pipe['l3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b3'] != "" && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {
																				echo $row_select_pipe['b3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) {
																				echo $row_select_pipe['area_3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																				echo $row_select_pipe['load_3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																				echo $row_select_pipe['com_3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>

			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>CEMENT + Flyash CUBE</b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_temp1'] != "" && $row_select_pipe['com_temp1'] != "0" && $row_select_pipe['com_temp1'] != null) {
																							echo $row_select_pipe['com_temp1'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_humidity1'] != "" && $row_select_pipe['com_humidity1'] != "0" && $row_select_pipe['com_humidity1'] != null) {
																							echo $row_select_pipe['com_humidity1'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;"><b><?php if ($row_select_pipe['caste_date2'] != "" && $row_select_pipe['caste_date2'] != "0" && $row_select_pipe['caste_date2'] != null) {
																		echo date("d/m/Y", strtotime($row_select_pipe['caste_date2']));
																	} else {
																		echo "&nbsp;";
																	} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['test_date2'] != "" && $row_select_pipe['test_date2'] != "0" && $row_select_pipe['test_date2'] != null) {
																							echo date("d/m/Y", strtotime($row_select_pipe['test_date2']));
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['day_2'] != "" && $row_select_pipe['day_2'] != "0" && $row_select_pipe['day_2'] != null) {
																							echo $row_select_pipe['day_2'] . " Days";
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>4</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l4'] != "" && $row_select_pipe['l4'] != "0" && $row_select_pipe['l4'] != null) {
																				echo $row_select_pipe['l4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b4'] != "" && $row_select_pipe['b4'] != "0" && $row_select_pipe['b4'] != null) {
																				echo $row_select_pipe['b4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) {
																				echo $row_select_pipe['area_4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
																				echo $row_select_pipe['load_4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																				echo $row_select_pipe['com_4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) {
																							echo $row_select_pipe['avg_com_2'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l5'] != "" && $row_select_pipe['l5'] != "0" && $row_select_pipe['l5'] != null) {
																				echo $row_select_pipe['l5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b5'] != "" && $row_select_pipe['b5'] != "0" && $row_select_pipe['b5'] != null) {
																				echo $row_select_pipe['b5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) {
																				echo $row_select_pipe['area_5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
																				echo $row_select_pipe['load_5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																				echo $row_select_pipe['com_5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l6'] != "" && $row_select_pipe['l6'] != "0" && $row_select_pipe['l6'] != null) {
																				echo $row_select_pipe['l6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b6'] != "" && $row_select_pipe['b6'] != "0" && $row_select_pipe['b6'] != null) {
																				echo $row_select_pipe['b6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) {
																				echo $row_select_pipe['area_6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
																				echo $row_select_pipe['load_6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
																				echo $row_select_pipe['com_6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>


			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>CEMENT CUBE</b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_temp2'] != "" && $row_select_pipe['com_temp2'] != "0" && $row_select_pipe['com_temp2'] != null) {
																							echo $row_select_pipe['com_temp2'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_humidity2'] != "" && $row_select_pipe['com_humidity2'] != "0" && $row_select_pipe['com_humidity2'] != null) {
																							echo $row_select_pipe['com_humidity2'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;"><b><?php if ($row_select_pipe['caste_date3'] != "" && $row_select_pipe['caste_date3'] != "0" && $row_select_pipe['caste_date3'] != null) {
																		echo date("d/m/Y", strtotime($row_select_pipe['caste_date3']));
																	} else {
																		echo "&nbsp;";
																	} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['test_date3'] != "" && $row_select_pipe['test_date3'] != "0" && $row_select_pipe['test_date3'] != null) {
																							echo date("d/m/Y", strtotime($row_select_pipe['test_date3']));
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['day_3'] != "" && $row_select_pipe['day_3'] != "0" && $row_select_pipe['day_3'] != null) {
																							echo $row_select_pipe['day_3'] . " Days";
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>7</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l7'] != "" && $row_select_pipe['l7'] != "0" && $row_select_pipe['l7'] != null) {
																				echo $row_select_pipe['l7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b7'] != "" && $row_select_pipe['b7'] != "0" && $row_select_pipe['b7'] != null) {
																				echo $row_select_pipe['b7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) {
																				echo $row_select_pipe['area_7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
																				echo $row_select_pipe['load_7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
																				echo $row_select_pipe['com_7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null) {
																							echo $row_select_pipe['avg_com_3'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>8</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l8'] != "" && $row_select_pipe['l8'] != "0" && $row_select_pipe['l8'] != null) {
																				echo $row_select_pipe['l8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b8'] != "" && $row_select_pipe['b8'] != "0" && $row_select_pipe['b8'] != null) {
																				echo $row_select_pipe['b8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) {
																				echo $row_select_pipe['area_8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
																				echo $row_select_pipe['load_8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
																				echo $row_select_pipe['com_8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>9</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l9'] != "" && $row_select_pipe['l9'] != "0" && $row_select_pipe['l9'] != null) {
																				echo $row_select_pipe['l9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b9'] != "" && $row_select_pipe['b9'] != "0" && $row_select_pipe['b9'] != null) {
																				echo $row_select_pipe['b9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_9'] != "" && $row_select_pipe['area_9'] != "0" && $row_select_pipe['area_9'] != null) {
																				echo $row_select_pipe['area_9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_9'] != "" && $row_select_pipe['load_9'] != "0" && $row_select_pipe['load_9'] != null) {
																				echo $row_select_pipe['load_9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) {
																				echo $row_select_pipe['com_9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>CEMENT + Flyash CUBE</b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_temp3'] != "" && $row_select_pipe['com_temp3'] != "0" && $row_select_pipe['com_temp3'] != null) {
																							echo $row_select_pipe['com_temp3'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['com_humidity3'] != "" && $row_select_pipe['com_humidity3'] != "0" && $row_select_pipe['com_humidity3'] != null) {
																							echo $row_select_pipe['com_humidity3'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black;"><b><?php if ($row_select_pipe['caste_date4'] != "" && $row_select_pipe['caste_date4'] != "0" && $row_select_pipe['caste_date4'] != null) {
																		echo date("d/m/Y", strtotime($row_select_pipe['caste_date4']));
																	} else {
																		echo "&nbsp;";
																	} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['test_date4'] != "" && $row_select_pipe['test_date4'] != "0" && $row_select_pipe['test_date4'] != null) {
																							echo date("d/m/Y", strtotime($row_select_pipe['test_date4']));
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['day_4'] != "" && $row_select_pipe['day_4'] != "0" && $row_select_pipe['day_4'] != null) {
																							echo $row_select_pipe['day_4'] . "Days";
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>10</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l10'] != "" && $row_select_pipe['l10'] != "0" && $row_select_pipe['l10'] != null) {
																				echo $row_select_pipe['l10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b10'] != "" && $row_select_pipe['b10'] != "0" && $row_select_pipe['b10'] != null) {
																				echo $row_select_pipe['b10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_10'] != "" && $row_select_pipe['area_10'] != "0" && $row_select_pipe['area_10'] != null) {
																				echo $row_select_pipe['area_10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_10'] != "" && $row_select_pipe['load_10'] != "0" && $row_select_pipe['load_10'] != null) {
																				echo $row_select_pipe['load_10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_10'] != "" && $row_select_pipe['com_10'] != "0" && $row_select_pipe['com_10'] != null) {
																				echo $row_select_pipe['com_10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_com_4'] != "" && $row_select_pipe['avg_com_4'] != "0" && $row_select_pipe['avg_com_4'] != null) {
																							echo $row_select_pipe['avg_com_4'];
																						} else {
																							echo "&nbsp;";
																						} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>11</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l11'] != "" && $row_select_pipe['l11'] != "0" && $row_select_pipe['l11'] != null) {
																				echo $row_select_pipe['l11'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b11'] != "" && $row_select_pipe['b11'] != "0" && $row_select_pipe['b11'] != null) {
																				echo $row_select_pipe['b11'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_11'] != "" && $row_select_pipe['area_11'] != "0" && $row_select_pipe['area_11'] != null) {
																				echo $row_select_pipe['area_11'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_11'] != "" && $row_select_pipe['load_11'] != "0" && $row_select_pipe['load_11'] != null) {
																				echo $row_select_pipe['load_11'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_11'] != "" && $row_select_pipe['com_11'] != "0" && $row_select_pipe['com_11'] != null) {
																				echo $row_select_pipe['com_11'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>12</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l12'] != "" && $row_select_pipe['l12'] != "0" && $row_select_pipe['l12'] != null) {
																				echo $row_select_pipe['l12'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b12'] != "" && $row_select_pipe['b12'] != "0" && $row_select_pipe['b12'] != null) {
																				echo $row_select_pipe['b12'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['area_12'] != "" && $row_select_pipe['area_12'] != "0" && $row_select_pipe['area_12'] != null) {
																				echo $row_select_pipe['area_12'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load_12'] != "" && $row_select_pipe['load_12'] != "0" && $row_select_pipe['load_12'] != null) {
																				echo $row_select_pipe['load_12'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['com_12'] != "" && $row_select_pipe['com_12'] != "0" && $row_select_pipe['com_12'] != null) {
																				echo $row_select_pipe['com_12'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>

		</table>
		<table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
			<tr>
				<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>
				<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>
			</tr>
		</table> -->




	</page>

</body>

</html>