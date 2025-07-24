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
	$select_tiles_query = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$mark = $row_select4['brick_mark'];
		$brick_specification = $row_select4['brick_specification'];
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
							<td style="width:20%">&nbsp;&nbsp;<b>Sample ID</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mark; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Type of Bricks</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;Non Modular</td>
							<td style="width:20%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Class Designation</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $brick_specification; ?></td>
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
					<center><b><u>Fly Ash Brick Test Result</u></b></center>
				</td>

			</tr>

			<tr>
				<!--OTHER START-->
				<td>


					<table align="left" width="100%" class="test" style="height:auto;width:100%;">
						<tr style="text-align:center;">

							<td style="border:1px solid black;border-left:0px solid black;width:7%;"><b>Sr. No.</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:13%;"><b>Test<br>Sample<br>ID</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Water<br>Absorption<br>(%)</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:13%;"><b>Test<br>Sample<br>ID</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:11%;"><b>Load<br>(KN)</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:11%;"><b>Area of<br>Brick<br>(mm<sup>2</sup>)</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:12%;"><b>Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:13%;"><b>Test<br>Sample<br>ID</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:10%;"><b>Efflorescence</b></td>
						</tr>

						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">1</td>
							<td style="border:1px solid black;border-left:0px solid black;">WA - 01</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wtr_1']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">CS - 01</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_load_1']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_area_1']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_1']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">EF - 01</td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['rbt_efflo1'] != "" && $row_select_pipe['rbt_efflo1'] != null) {
																									echo $row_select_pipe['rbt_efflo1'];
																								} else {
																									echo "-";
																								} ?></td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">2</td>
							<td style="border:1px solid black;border-left:0px solid black;">WA - 02</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wtr_2']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">CS - 02</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_load_2']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_area_2']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_2']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">EF - 02</td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['rbt_efflo2'] != "" && $row_select_pipe['rbt_efflo2'] != null) {
																									echo $row_select_pipe['rbt_efflo2'];
																								} else {
																									echo "-";
																								} ?></td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">3</td>
							<td style="border:1px solid black;border-left:0px solid black;">WA - 03</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wtr_3']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">CS - 03</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_load_3']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_area_3']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_3']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">EF - 03</td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['rbt_efflo3'] != "" && $row_select_pipe['rbt_efflo3'] != null) {
																									echo $row_select_pipe['rbt_efflo3'];
																								} else {
																									echo "-";
																								} ?></td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">4</td>
							<td style="border:1px solid black;border-left:0px solid black;">WA - 04</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wtr_4']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">CS - 04</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_load_4']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_area_4']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_4']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">EF - 04</td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['rbt_efflo4'] != "" && $row_select_pipe['rbt_efflo4'] != null) {
																									echo $row_select_pipe['rbt_efflo4'];
																								} else {
																									echo "-";
																								} ?></td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">5</td>
							<td style="border:1px solid black;border-left:0px solid black;">WA - 05</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['wtr_5']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">CS - 05</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_load_5']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_area_5']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['com_5']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">EF - 05</td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['rbt_efflo5'] != "" && $row_select_pipe['rbt_efflo5'] != null) {
																									echo $row_select_pipe['rbt_efflo5'];
																								} else {
																									echo "-";
																								} ?></td>
						</tr>

						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;"><b>Average</b></td>
							<td style="border:1px solid black;border-left:0px solid black;">---</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['avg_wtr']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;">---</td>
							<td style="border:1px solid black;border-left:0px solid black;">---</td>
							<td style="border:1px solid black;border-left:0px solid black;">---</td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['avg_com']; ?></td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;">---</td>

						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">Method of<br>Testing</td>

							<td colspan="2" style="border:1px solid black;border-left:0px solid black;">IS:3495 (P 2)-1992</td>
							<td colspan="4" style="border:1px solid black;border-left:0px solid black;">IS:3495 (P 1)-1992</td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;">IS:3495 (P 3)-1992</td>

						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">Req.<br>IS:13753-<br>(1993)</td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;">Shall Not be More than 20%<br>(Clause 7.2)</td>

							<td colspan="4" style="border:1px solid black;border-left:0px solid black;">Compressive Strength Shall Not be less than<br><?php echo $brick_specification; ?> N/mm<sup>2</sup> (Table-1 Clause 4.1)</td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;">Nil/Slight/Moderate/<br>Heavy/Serious<br>(Clause 7.3)</td>

						</tr>



					</table>

				</td>

			</tr>
			<tr>
				<td><br></td>
			</tr>


			<tr>
				<td>
					<table align="left" class="test" style="height:Auto;width:100%;">
						<tr style="text-align:center;">
							<td style="width:40%;border:1px solid black;border-left:0px solid black;">Dimension Test Results of 20 Nos. Bricks</td>
							<td style="width:20%;border:1px solid black;border-left:0px solid black;">Length, mm</td>
							<td style="width:20%;border:1px solid black;border-left:0px solid black;">Width, mm</td>
							<td style="width:20%;border:1px solid black;border-right:0px solid black;">Thickness, mm</td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;"><b>Results</b></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['avg_length']; ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['avg_width']; ?></td>
							<td style="border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['avg_height']; ?></td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;">Requirement as per IS. 13757 (1993)</td>
							<td style="border:1px solid black;border-left:0px solid black;">4600 &plusmn; 80 mm</td>
							<td style="border:1px solid black;border-left:0px solid black;">2200 &plusmn; 40 mm</td>
							<td style="border:1px solid black;border-right:0px solid black;">1400 &plusmn; 40 mm</td>

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

				<td style="text-align:left">Doc. No. F-7.8-04-A</td>
				<td style="text-align:right">Page No. 1/1</td>

			</tr>
		</table>




	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
