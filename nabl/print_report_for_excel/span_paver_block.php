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
		transform: scale(.7);
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
	$select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$paver_shape = $row_select4['paver_shape'];
		$paver_age = $row_select4['paver_age'];
		$paver_color = $row_select4['paver_color'];
		$paver_thickness = $row_select4['paver_thickness'];
		$paver_grade = $row_select4['paver_grade'];
		$material_location = $row_select4['material_location'];
		$material_condition = $row_select4['material_condition'];
	}


	?>

	<?php
	if (($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") || ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0")) { ?>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		<page size="A4">
			<table align="center" width="95%" cellspacing="0" cellpadding="0" style="height:70%;font-size:13px;font-family: Book Antiqua;border:2px solid black;margin-left:35px; ">
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
								<td style="width:20%">&nbsp;&nbsp;<b>Thick. of Block (mm)</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $paver_thickness; ?></td>
								<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($start_date)); ?></td>
							</tr>

							<tr>
								<td style="width:20%">&nbsp;&nbsp;<b>Concrete Grade</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $paver_grade; ?></td>
								<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($end_date)); ?></td>
							</tr>
							<tr>
								<td style="width:20%">&nbsp;&nbsp;<b>Correction factor</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['factor']; ?></td>
								<td style="width:20%">&nbsp;&nbsp;</td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"></td>
								<td style="width:14%">&nbsp;&nbsp;</td>
							</tr>
							<tr>
								<td style="width:20%">&nbsp;&nbsp;<b>Condition of Sample</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;
									<?php
									if ($material_condition == "1") {
										echo "Sealed";
									}
									if ($material_condition == "2") {
										echo "Unsealed";
									}
									if ($material_condition == "3") {
										echo "Good";
									}
									if ($material_condition == "4") {
										echo "Poor";
									}
									?>
								</td>
								<td style="width:20%">&nbsp;&nbsp;</td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"></td>
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
								<td style="width:20%">&nbsp;&nbsp;Size</td>
								<td style="width:3%;font-family:Book Antiqua;font-size:20px;"><b>»</b></td>
								<td style="width:14%">&nbsp;&nbsp;<?php echo $paver_age; ?></td>
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
						<center><b><u>Paver Block Test Result</u></b></center>
					</td>

				</tr>

				<tr>
					<!--OTHER START-->
					<td>


						<table align="left" width="100%" class="test" style="height:300px;width:100%;">
							<tr style="text-align:center;">
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:2.20%;"><b>Sr.<br>No.</b></td>

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;width:16.20%;"><b>Sample Mark</b></td>
								<td style="border:1px solid black;border-left:0px solid black;width:16.20%;"><b>Failure Load</b></td>
								<td style="border:1px solid black;border-left:0px solid black;width:16.20%;"><b>Area of Paver<br>Block</b></td>
								<td style="border:1px solid black;border-left:0px solid black;width:16.20%;"><b>Comp.<br>Strength</b></td>
								<td style="border:1px solid black;border-left:0px solid black;width:16.20%;"><b>Corrected Comp.<br>Strength</b></td>
								<td style="border:1px solid black;border-right:0px solid black;width:16.26%;"><b>Water<br>Absorption</b></td>



							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><b>(KN)</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>(mm<sup>2</sup>)</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>(N/mm<sup>2</sup>)</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>(N/mm<sup>2</sup>)</b></td>
								<td style="border:1px solid black;border-right:0px solid black;"><b>(%)</b></td>

							</tr>

							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>1</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != null && $row_select_pipe['load_1'] != "0") {
																									echo number_format($row_select_pipe['load_1'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != null && $row_select_pipe['area_1'] != "0") {
																									echo number_format($row_select_pipe['area_1'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") {
																									echo number_format($row_select_pipe['com_1'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != null && $row_select_pipe['corr_1'] != "0") {
																									echo number_format($row_select_pipe['corr_1'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != null && $row_select_pipe['wtr_1'] != "0") {
																										echo number_format($row_select_pipe['wtr_1'], 2);
																									} else {
																										echo "-";
																									} ?></td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>2</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != null && $row_select_pipe['load_2'] != "0") {
																									echo number_format($row_select_pipe['load_2'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != null && $row_select_pipe['area_2'] != "0") {
																									echo number_format($row_select_pipe['area_2'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != null && $row_select_pipe['com_2'] != "0") {
																									echo number_format($row_select_pipe['com_2'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != null && $row_select_pipe['corr_2'] != "0") {
																									echo number_format($row_select_pipe['corr_2'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != null && $row_select_pipe['wtr_2'] != "0") {
																										echo number_format($row_select_pipe['wtr_2'], 2);
																									} else {
																										echo "-";
																									} ?></td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>3</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != null && $row_select_pipe['load_3'] != "0") {
																									echo number_format($row_select_pipe['load_3'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != null && $row_select_pipe['area_3'] != "0") {
																									echo number_format($row_select_pipe['area_3'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != null && $row_select_pipe['com_3'] != "0") {
																									echo number_format($row_select_pipe['com_3'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != null && $row_select_pipe['corr_3'] != "0") {
																									echo number_format($row_select_pipe['corr_3'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != null && $row_select_pipe['wtr_3'] != "0") {
																										echo number_format($row_select_pipe['wtr_3'], 2);
																									} else {
																										echo "-";
																									} ?></td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>4</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_4'] != "" || $row_select_pipe['load_4'] != null) {
																									echo number_format($row_select_pipe['load_4'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_4'] != "" || $row_select_pipe['area_4'] != null) {
																									echo number_format($row_select_pipe['area_4'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_4'] != "" || $row_select_pipe['com_4'] != null) {
																									echo number_format($row_select_pipe['com_4'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_4'] != "" || $row_select_pipe['corr_4'] != null) {
																									echo number_format($row_select_pipe['corr_4'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">-</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>5</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != null && $row_select_pipe['load_5'] != "0") {
																									echo number_format($row_select_pipe['load_5'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != null && $row_select_pipe['area_5'] != "0") {
																									echo number_format($row_select_pipe['area_5'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != null && $row_select_pipe['com_5'] != "0") {
																									echo number_format($row_select_pipe['com_5'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != null && $row_select_pipe['corr_5'] != "0") {
																									echo number_format($row_select_pipe['corr_5'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">-</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>6</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != null) {
																									echo number_format($row_select_pipe['load_6'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != null) {
																									echo number_format($row_select_pipe['area_6'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != null) {
																									echo number_format($row_select_pipe['com_6'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != null) {
																									echo number_format($row_select_pipe['corr_6'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">-</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>7</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != null && $row_select_pipe['load_7'] != "0") {
																									echo number_format($row_select_pipe['load_7'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != null && $row_select_pipe['area_7'] != "0") {
																									echo number_format($row_select_pipe['area_7'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != null && $row_select_pipe['com_7'] != "0") {
																									echo number_format($row_select_pipe['com_7'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != null && $row_select_pipe['corr_7'] != "0") {
																									echo number_format($row_select_pipe['corr_7'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">-</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>8</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $paver_color; ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != null && $row_select_pipe['load_8'] != "0") {
																									echo number_format($row_select_pipe['load_8'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != null  && $row_select_pipe['area_8'] != "0") {
																									echo number_format($row_select_pipe['area_8'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != null && $row_select_pipe['com_8'] != "0") {
																									echo number_format($row_select_pipe['com_8'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != null && $row_select_pipe['corr_8'] != "0") {
																									echo number_format($row_select_pipe['corr_8'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">-</td>


							</tr>
							<tr style="text-align:center;">
								<td colspan="5" style="border:1px solid black;border-left:0px solid black;text-align:right;">Average</td>

								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != null && $row_select_pipe['avg_corr'] != "0") {
																									echo number_format($row_select_pipe['avg_corr'], 2);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {
																										echo number_format($row_select_pipe['avg_wtr'], 2);
																									} else {
																										echo "-";
																									} ?></td>


							</tr>
							<tr style="text-align:center;">
								<td colspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Method of Test</td>

								<td colspan="3" style="border:1px solid black;border-left:0px solid black;">IS.15658, ANNEX D</td>
								<td style="border:1px solid black;border-right:0px solid black;">IS.15658, ANNEX C</td>

							</tr>
							<tr>
								<td colspan="7">
									<table align="left" width="100%" cellspacing="0px" cellpadding="0px" class="test" style="height:auto;width:100%;font-size:11px;">
										<tr style="text-align:center;">
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;font-size:10px;border-top:0px solid black;border-bottom:0px solid black;width:35.2%;">Correction Factors for Thickness and Arris/Chamfer<br>of Paver Block for Calculation of Comp. Strength</td>

											<td style="border:1px solid black;border-left:0px solid black;text-align:left;border-top:0px solid black;">&nbsp;for plain Block</td>
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;border-bottom:0px solid black;">50<br>mm</td>
											<td style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;"><i>0.96</i></td>
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;border-bottom:0px solid black;">60<br>mm</td>
											<td style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;"><i>1.00</i></td>
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;border-bottom:0px solid black;">80<br>mm</td>
											<td style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;"><i>1.12</i></td>
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;border-bottom:0px solid black;">100<br>mm</td>
											<td style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;"><i>1.18</i></td>
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;border-top:0px solid black;border-bottom:0px solid black;">120<br>mm</td>
											<td style="border:1px solid black;border-right:0px solid black;border-top:0px solid black;"><i>1.28</i></td>

										</tr>
										<tr style="text-align:center;">

											<td style="border:1px solid black;border-left:0px solid black;text-align:left;border-bottom:0px solid black;">&nbsp;for chamfered/Arris Block </td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;"><i>1.03</i></td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;"><i>1.06</i></td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;"><i>1.18</i></td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;"><i>1.24</i></td>
											<td style="border:1px solid black;border-right:0px solid black;border-bottom:0px solid black;"><i>1.34</i></td>

										</tr>
									</table>

								</td>

							</tr>
							<tr style="text-align:center;">
								<td colspan="7" style="border:1px solid black;border-left:0px solid black;"><b>I.S. Requirements as per I.S.15658:2019</b></td>

							</tr>
							<tr style="text-align:center;">
								<td colspan="7">
									<table align="left" width="100%" cellspacing="0px" cellpadding="0px" class="test" style="height:auto;width:100%;font-size:11px;">
										<tr style="text-align:center;">
											<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:center;font-size:10px;border-top:0px solid black;border-bottom:0px solid black;width:35.2%;">Test Description</td>


											<td colspan="6" style="border:1px solid black;border-right:0px solid black;border-top:0px solid black;border-bottom:0px solid black;">Grade of Paver Block</td>


										</tr>

										<tr style="text-align:center;">

											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">M-30</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">M-35</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">M-40</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">M-45</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">M-50</td>
											<td style="border:1px solid black;border-right:0px solid black;border-bottom:0px solid black;">M-55</td>


										</tr>
										<tr style="text-align:center;">
											<td style="border:1px solid black;border-left:0px solid black;text-align:left;font-size:10px;border-bottom:0px solid black;">Specified Compressive Strength at 28 Days,<br>Table-1, N/mm<sup>2</sup></td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">30</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">35</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">40</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">45</td>
											<td style="border:1px solid black;border-left:0px solid black;border-bottom:0px solid black;">50</td>
											<td style="border:1px solid black;border-right:0px solid black;border-bottom:0px solid black;">55</td>


										</tr>
									</table>

								</td>
							</tr>
							<tr style="text-align:center;">
								<td colspan="7">
									<table align="left" width="100%" cellspacing="0px" cellpadding="0px" class="test" style="height:auto;width:100%;font-size:11px;">
										<tr style="text-align:left;">
											<td style="border:1px solid black;border-left:0px solid black;text-align:left;font-size:10px;width:17.5%;">Water Absorption</td>


											<td style="border:1px solid black;border-right:0px solid black;">Average shall not be more than 6% and Individual samples should be restricted to 7%</td>

										</tr>
									</table>

								</td>
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

					<td style="text-align:left">Doc. No. F-7.8-08</td>
					<td style="text-align:right">Page No. 1/1</td>

				</tr>
			</table>



		</page>
	<?php }
	if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != null && $row_select_pipe['avgv'] != "0") { ?>
		<div class="pagebreak"></div>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		<page size="A4">
			<table align="center" width="95%" cellspacing="0" cellpadding="0" style="height:70%;font-size:13px;font-family: Book Antiqua;border:2px solid black;margin-left:35px; ">
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
								<td style="width:40%">&nbsp;&nbsp;<?php echo $report_no . "-01"; ?></td>
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
								<td style="width:20%">&nbsp;&nbsp;<b>Thick. of Block (mm)</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $paver_thickness; ?></td>
								<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($start_date)); ?></td>
							</tr>

							<tr>
								<td style="width:20%">&nbsp;&nbsp;<b>Concrete Grade</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $paver_grade; ?></td>
								<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($end_date)); ?></td>
							</tr>
							<tr>
								<td style="width:20%">&nbsp;&nbsp;<b>Condition of Sample</b></td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
								<td style="width:40%">&nbsp;&nbsp;
									<?php
									if ($material_condition == "1") {
										echo "Sealed";
									}
									if ($material_condition == "2") {
										echo "Unsealed";
									}
									if ($material_condition == "3") {
										echo "Good";
									}
									if ($material_condition == "4") {
										echo "Poor";
									}
									?>
								</td>
								<td style="width:20%">&nbsp;&nbsp;</td>
								<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"></td>
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
					<!--OTHER START-->
					<td>


						<table align="left" width="100%" class="test" style="height:300px;width:100%;">
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;width:8%;"><b>Sr. No.</b></td>

								<td style="border:1px solid black;border-left:0px solid black;width:23%;"><b>Name of Test</b></td>
								<td style="border:1px solid black;border-left:0px solid black;width:23%;"><b>Result</b></td>
								<td style="border:1px solid black;border-left:0px solid black;width:23%;"><b>Test Method</b></td>
								<td style="border:1px solid black;border-right:0px solid black;width:23%;"><b>Test Requirement</b></td>



							</tr>

							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>1</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Abrasion Test</td>
								<td style="border:1px solid black;border-left:0px solid black;">--</td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>



							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>2</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 1</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v1'] != "" && $row_select_pipe['v1'] != null && $row_select_pipe['v1'] != "0") {
																									echo number_format($row_select_pipe['v1'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>3</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 2</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v2'] != "" && $row_select_pipe['v2'] != null && $row_select_pipe['v2'] != "0") {
																									echo number_format($row_select_pipe['v2'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>4</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 3</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v3'] != "" && $row_select_pipe['v3'] != null && $row_select_pipe['v3'] != "0") {
																									echo number_format($row_select_pipe['v3'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>5</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 4</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v4'] != "" && $row_select_pipe['v4'] != null && $row_select_pipe['v4'] != "0") {
																									echo number_format($row_select_pipe['v4'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>6</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 5</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v5'] != "" && $row_select_pipe['v5'] != null && $row_select_pipe['v5'] != "0") {
																									echo number_format($row_select_pipe['v5'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>7</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 6</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v6'] != "" && $row_select_pipe['v6'] != null && $row_select_pipe['v6'] != "0") {
																									echo number_format($row_select_pipe['v6'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>8</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 7</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v7'] != "" && $row_select_pipe['v7'] != null && $row_select_pipe['v7'] != "0") {
																									echo number_format($row_select_pipe['v7'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>9</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Block - 8</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['v8'] != "" && $row_select_pipe['v8'] != null && $row_select_pipe['v8'] != "0") {
																									echo number_format($row_select_pipe['v8'], 1);
																								} else {
																									echo "-";
																								} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;">IS 15658:2019</td>
								<td style="border:1px solid black;border-right:0px solid black;">--</td>


							</tr>
							<tr style="text-align:center;">
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:right">Average:</td>
								<td style="border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != null && $row_select_pipe['avgv'] != "0") {
																										echo number_format($row_select_pipe['avgv'], 1);
																									} else {
																										echo "-";
																									} ?></td>
								<td style="border:1px solid black;border-left:0px solid black;"></td>
								<td style="border:1px solid black;border-right:0px solid black;">18000 mm<sup>3</sup> per 5000 mm<sup>2</sup></td>


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

					<td style="text-align:left">Doc. No. F-7.8-08</td>
					<td style="text-align:right">Page No. 1/1</td>

				</tr>
			</table>



		</page>
	<?php } ?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
