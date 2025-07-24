<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family: Book Antiqua;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Book Antiqua;
	}

	.tdclass1 {

		font-size: 12px;
		font-family: Book Antiqua;
	}

	div.vertical-sentence {
		-ms-writing-mode: tb-rl;
		/* for IE */
		-webkit-writing-mode: vertical-rl;
		/* for Webkit */
		writing-mode: vertical-rl;

	}

	.rotate-characters-back-to-horizontal {
		-webkit-text-orientation: upright;
		/* for Webkit */
		text-orientation: upright;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
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
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['fine_agg_source'];
		$material_location = $row_select4['material_location'];
	}


	?>


	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="height:77%;font-size:13px;font-family: Book Antiqua;border:2px solid black;margin-left:35px;">
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:40px;">ULR: <?php echo $row_select_pipe['ulr']; ?></td>
			</tr>
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:43px;"><b>Discipline : Mechanical</b></td>
			</tr>
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:38px;"><b>Group : Building Material</b></td>
			</tr>
			<tr>


				<td style="font-size:15px;">
					<center><b><u>Test Report</u></b></center>
				</td>

			</tr>
			<tr>


				<td style="font-size:15px;">&nbsp;</td>

			</tr>
			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Report No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $report_no; ?></td>
							<td style="width:20%;text-align:right;padding-right:20px;">&nbsp;&nbsp;<b>Issue Date</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($issue_date)); ?></td>
						</tr>

					</table>
				</td>
			</tr>


			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="border-top:1px solid black;">
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Customer</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																$result_selectc = mysqli_query($conn, $select_queryc);

																if (mysqli_num_rows($result_selectc) > 0) {
																	$row_selectc = mysqli_fetch_assoc($result_selectc);
																	$ct_nm = $row_selectc['city_name'];
																}
																echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?>
							</td>

						</tr>

						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Work</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $name_of_work; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Agency</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%"> &nbsp;&nbsp;<?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																$result_selectc1 = mysqli_query($conn, $select_queryc1);

																if (mysqli_num_rows($result_selectc1) > 0) {
																	$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																	$ct_nm1 = $row_selectc1['city_name'];
																}
																echo $agency_name . " " . $ct_nm1; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Agreement No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $agreement_no; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Reference No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;Date: <?php echo date('d-M-y', strtotime($row_select["date"])); ?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>

					</table>
				</td>
			</tr>



			<tr>
				<td>
					<table align="center" width="100%" border="0px" class="test" style="border-top:1px solid black;border-bottom:1px solid black;">
						<tr>
							<td style="width:20%"></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:40%">&nbsp;</td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:22%">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Description of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Dia. of Speciman</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['dia'] . " MM "; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Grade of Steel</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['grade']; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Brand Name</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['brand']; ?></td>
							<td style="width:20%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;Good</td>
							<td style="width:20%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:20%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%"></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:40%">&nbsp;</td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr>

			<tr>


				<td style="font-size:15px;padding-top:5px;">
					<center><b><u>Steel Test Result</u></b></center>
				</td>

			</tr>

			<tr>
				<!--OTHER START-->
				<td>


					<table align="left" width="100%" class="test" style="height:auto;width:100%;">
						<tr style="text-align:center;">
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Sr.<br>No.</b></td>
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Dia<br>TMT Bar<br>(mm)</b></td>
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Weight<br>(kg)</b></td>
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Cross<br>Sectional<br>Area<br>(mm<sup>2</sup>)</b></td>
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Yield<br>Stress,<Br>N/mm<sup>2</sup></b></td>
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Ultimate<br>Stress,<Br>N/mm<sup>2</sup></b></td>
							<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Elongation<br>%</b></td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;width:18%;"><b>Bend Test</b></td>
							<td colspan="2" style="border:1px solid black;border-right:0px solid black;width:18%;"><b>Re-bend Test</b></td>


						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Bend Test</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Mandrel<br>Size/<br>Angle of<br>Bend</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:9%;"><b>Re-bend Test</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:9%;"><b>Mandrel<br>Size/<br>Angle of<br>Bend</b></td>


						</tr>


						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">1</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo mb_substr($row_select_pipe['dia_1'], 0, -2);  ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['w_1'] != "" && $row_select_pipe['w_1'] != null && $row_select_pipe['w_1'] != "0") {
																								echo $row_select_pipe['w_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['cs_1'] != "" && $row_select_pipe['cs_1'] != null && $row_select_pipe['cs_1'] != "0") {
																								echo $row_select_pipe['cs_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['ys_1'] != "" && $row_select_pipe['ys_1'] != null && $row_select_pipe['ys_1'] != "0") {
																								echo $row_select_pipe['ys_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['ten_1'] != "" && $row_select_pipe['ten_1'] != null && $row_select_pipe['ten_1'] != "0") {
																								echo $row_select_pipe['ten_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['elo_1'] != "" && $row_select_pipe['elo_1'] != null && $row_select_pipe['elo_1'] != "0") {
																								echo $row_select_pipe['elo_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['bend_1'] != "" && $row_select_pipe['bend_1'] != null && $row_select_pipe['bend_1'] != "0") {
																								echo $row_select_pipe['bend_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php
																							if ($row_select_pipe['grade'] == "FE 415") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 4;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 4;
																									echo $val . " / 180&#12444;";
																								}
																							} else if ($row_select_pipe['grade'] == "FE 415 D") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 2;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 2;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 2;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 2;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 2;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 3;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 3;
																									echo $val . " / 180&#12444;";
																								}
																							} else if ($row_select_pipe['grade'] == "FE 500") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 5;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 5;
																									echo $val . " / 180&#12444;";
																								}
																							} else if ($row_select_pipe['grade'] == "FE 500 D") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 3;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 4;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 4;
																									echo $val . " / 180&#12444;";
																								}
																							} else if ($row_select_pipe['grade'] == "FE 550") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 6;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 6;
																									echo $val . " / 180&#12444;";
																								}
																							} else if ($row_select_pipe['grade'] == "FE 550 D") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 4;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 5;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 5;
																									echo $val . " / 180&#12444;";
																								}
																							} else if ($row_select_pipe['grade'] == "FE 600") {
																								if ($row_select_pipe['dia_1'] == "8 MM") {
																									$val = 8 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "10 MM") {
																									$val = 10 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "12 MM") {
																									$val = 12 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "16 MM") {
																									$val = 16 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "20 MM") {
																									$val = 20 * 5;
																									echo $val . " / 180&#12444;";
																								} else if ($row_select_pipe['dia_1'] == "25 MM") {
																									$val = 25 * 6;
																									echo $val . " / 180&#12444;";
																								} else {
																									$val = 32 * 6;
																									echo $val . " / 180&#12444;";
																								}
																							}


																							?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['rebend_1'] != "" && $row_select_pipe['rebend_1'] != null && $row_select_pipe['rebend_1'] != "0") {
																								echo $row_select_pipe['rebend_1'];
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php
																								if ($row_select_pipe['grade'] == "FE 415") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 5;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 5;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 7;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 7;
																										echo $val . " / 180&#12444;";
																									}
																								} else if ($row_select_pipe['grade'] == "FE 415 D") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 4;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 4;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 6;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 6;
																										echo $val . " / 180&#12444;";
																									}
																								} else if ($row_select_pipe['grade'] == "FE 500") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 5;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 5;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 7;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 7;
																										echo $val . " / 180&#12444;";
																									}
																								} else if ($row_select_pipe['grade'] == "FE 500 D") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 4;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 4;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 6;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 6;
																										echo $val . " / 180&#12444;";
																									}
																								} else if ($row_select_pipe['grade'] == "FE 550") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 8;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 8;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 8;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 8;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 8;
																										echo $val . " / 180&#12444;";
																									}
																								} else if ($row_select_pipe['grade'] == "FE 550 D") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 6;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 7;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 7;
																										echo $val . " / 180&#12444;";
																									}
																								} else if ($row_select_pipe['grade'] == "FE 600") {
																									if ($row_select_pipe['dia_1'] == "8 MM") {
																										$val = 8 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "10 MM") {
																										$val = 10 * 7;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "12 MM") {
																										$val = 12 * 8;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "16 MM") {
																										$val = 16 * 8;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "20 MM") {
																										$val = 20 * 8;
																										echo $val . " / 180&#12444;";
																									} else if ($row_select_pipe['dia_1'] == "25 MM") {
																										$val = 25 * 8;
																										echo $val . " / 180&#12444;";
																									} else {
																										$val = 32 * 8;
																										echo $val . " / 180&#12444;";
																									}
																								}


																								?></td>


						</tr>
						<tr style="text-align:center;">
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;"><b>Method of Test</b></td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;"><b>IS:1786-2018</b></td>
							<td colspan="3" style="border:1px solid black;border-left:0px solid black;"><b>IS:1608-2018 (Part - 1, Part - 3)</b></td>
							<td colspan="4" style="border:1px solid black;border-right:0px solid black;"><b>IS:1599-2019</b></td>

						</tr>
						<tr style="text-align:left;">
							<td colspan="11" style="border:1px solid black;border-right:0px solid black;"><b>Requirement as per IS 1786-2008, Cl-8.1, Table-3 (Amend No. 1 to IS 1786 : 2008)</b></td>


						</tr>
						<tr style="text-align:center;">
							<td colspan="8" style="border:1px solid black;border-left:0px solid black;text-align:left;"><b>Property</b></td>
							<td colspan="3" style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['grade']; ?></td>

						</tr>
						<tr style="text-align:center;">
							<td colspan="8" style="border:1px solid black;border-left:0px solid black;text-align:left;"><b>0.2% Proof / Yield Stress (YS) N/mm<sup>2<sup></b></td>
							<td colspan="3" style="border:1px solid black;border-right:0px solid black;"><?php
																											if ($row_select_pipe['grade'] == "FE 415") {
																												echo "415";
																											} else if ($row_select_pipe['grade'] == "FE 415 D") {
																												echo "415";
																											} else if ($row_select_pipe['grade'] == "FE 500") {
																												echo "500";
																											} else if ($row_select_pipe['grade'] == "FE 500 D") {
																												echo "500";
																											} else if ($row_select_pipe['grade'] == "FE 550") {
																												echo "550";
																											} else if ($row_select_pipe['grade'] == "FE 550 D") {
																												echo "550";
																											}
																											?></td>

						</tr>
						<tr style="text-align:center;">
							<td colspan="8" style="border:1px solid black;border-left:0px solid black;text-align:left;"><b>Min. Tensile Stress(TS) N/mm<sup>2</sup>,/ % more than actual Yield stress</b></td>
							<td colspan="3" style="border:1px solid black;border-right:0px solid black;"><?php
																											if ($row_select_pipe['grade'] == "FE 415") {
																												echo "485 / 10%";
																											} else if ($row_select_pipe['grade'] == "FE 415 D") {
																												echo "500 / 12%";
																											} else if ($row_select_pipe['grade'] == "FE 500") {
																												echo "545 / 8%";
																											} else if ($row_select_pipe['grade'] == "FE 500 D") {
																												echo "565 / 10%";
																											} else if ($row_select_pipe['grade'] == "FE 550") {
																												echo "585 / 6%";
																											} else if ($row_select_pipe['grade'] == "FE 550 D") {
																												echo "600 / 8%";
																											}
																											?></td>

						</tr>
						<tr style="text-align:center;">
							<td colspan="8" style="border:1px solid black;border-left:0px solid black;text-align:left;"><b>Min. Elongation %</b></td>
							<td colspan="3" style="border:1px solid black;border-right:0px solid black;"><?php
																											if ($row_select_pipe['grade'] == "FE 415") {
																												echo "14.5";
																											} else if ($row_select_pipe['grade'] == "FE 415 D") {
																												echo "18";
																											} else if ($row_select_pipe['grade'] == "FE 500") {
																												echo "12";
																											} else if ($row_select_pipe['grade'] == "FE 500 D") {
																												echo "16";
																											} else if ($row_select_pipe['grade'] == "FE 550") {
																												echo "10";
																											} else if ($row_select_pipe['grade'] == "FE 550 D") {
																												echo "14.5";
																											}
																											?></td>

						</tr>
						<tr style="text-align:left;">
							<td colspan="11" style="border:1px solid black;border-right:0px solid black;"><b>Bend and Rebend Test- There Shall not be any transverse crack/fracture in the bend portion.</b></td>


						</tr>


					</table>

				</td>

			</tr>



			<tr>

				<td style="text-align:center"><b>&#8226;&#8226; End of Report &#8226;&#8226;</b></td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="border-top:1px solid black;font-size:8px;" class="test">
						<tr>
							<td style="width:3%;text-align:center;"><b>N<br>O<br>T<br>E</b></td>
							<td style="width:97%;">
								1. The Result relate only to the items tested.<br>
								2. Test Report Shall not be reproduced except in full without approval of the Mattest Engineering Serivces can Provide assurance that parts of a report are not taken of context.<br>
								3. The information is Supplied by the customer and can effect the validity of Result.<br>
								4. The result applied to the Sample as received.<br>
								<textarea style="font-size:8px;border:0px;width:100%;height:15px;font-family: Book Antiqua;margin-left: -2px;
    margin-top: -2px;"></textarea>

							</td>
						</tr>
					</table>
				</td>

			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:12;" class="test">
						<tr>
							<?php
							$select_qm = "select * from sign_authority WHERE `is_active`='1'";
							$result_qm = mysqli_query($conn, $select_qm);

							if (mysqli_num_rows($result_qm) > 0) {
								$row_ans = mysqli_fetch_assoc($result_qm);
								$authname = $row_ans['auth_name'];
								$authdesignation = $row_ans['auth_designation'];
							}
							?>
							<td style="width:50%;text-align:center;padding-top:70px;border-top:1px solid black;border-right:1px solid black;"><br><b><i>Authorized By</i> <br> <?php echo $authname . " " . $authdesignation; ?></b></td>
							<td align="left" style="width:50%;text-align:center;padding-top:70px;border-top:1px solid black;">&nbsp;</td>

						</tr>
					</table>
				</td>

			</tr>



		</table>

		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Book Antiqua;margin-left:35px;">
			<tr>

				<td style="text-align:left">Doc. No. F-7.8-03</td>
				<td style="text-align:right">Page No. 1/1</td>

			</tr>
		</table>




	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
