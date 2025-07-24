<?php
session_start();
include("../connection.php");
include("function_calling.php");
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
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 12px;
		font-family : Calibri;
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
	$select_tiles_query = "select * from wbm_stone_dust_only WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job,city WHERE city.id = job.client_city AND `report_no`='$report_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$client_city = $row_select6['city_name'];
	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed";
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

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
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
		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="height:60%;font-size:13px;font-family : Calibri;border:2px solid black;">
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:40px;">ULR:TC620220000000001F</td>
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
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $report_no; ?></td>
							<td style="width:20%;text-align:right;padding-right:20px;">&nbsp;&nbsp;<b>Issue Date</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
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
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
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
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $name_of_work; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Agency</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
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
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Reference No.</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>
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
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;"></td>
							<td style="width:40%">&nbsp;</td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;"></td>
							<td style="width:22%">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Material Received</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;Coarse Aggregates</td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Size of Sample</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Source of Sample</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Condifiton of Sample</b></td>
							<td style="width:3%;font-family:Times New Roman;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:20%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family:Times New Roman;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == "0") {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:20%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%"></td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;"></td>
							<td style="width:40%">&nbsp;</td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Times New Roman;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr>

			<tr>


				<td style="font-size:15px;padding-top:5px;">
					<center><b><u>Aggregate Test Result</u></b></center>
				</td>

			</tr>


			<!--START-->
			<tr>

				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
						<tr>
							<td colspan="2" style="width:49%"><b>(I) Sieves Analysis</b></td>
							<td style="width:2%"><b>&nbsp;</b></td>
							<td colspan="3" style="width:49%"><b>(II) Other Tests</b></td>
						</tr>
						<tr>

							<td colspan="2" style="width:49%;vertical-align:top">
								<table align="top" width="100%" class="test" style="height:100%;width:100%;">
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;" colspan="3"><b>Particle Size Distribution Test</b></td>
									</tr>
									<tr>
										<td colspan="3" style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS 2386-1963 : P-1</b></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS Sieve Size</b></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>% of Passing</b></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>Req. as per<br>IS 383-2016</b></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">26.5 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">100</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">19 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">90-100</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">13.2 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">59-79</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">9.5 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">52-72</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">9.5 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">52-72</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">4.75 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_6']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">35-55</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">2.36 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_7']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">28-44</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">1.18 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_8']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">15-27</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">0.600 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_9']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">10-20</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">0.300 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_10']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">5-13</td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">0.075 mm</td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_11']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">2-8</td>
									</tr>
								</table>
							</td>
							<td style="width:2%"></td>
							<td colspan="3" style="width:49%;vertical-align:top">
								<table align="top" width="100%" class="test" style="height:100%;width:100%;">
									<tr>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Name</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Req. as per<br>IS 383-2016</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test<br>Method</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Results</b></td>
									</tr>
									<?php
									if ($row_select_pipe['fi_index'] != "" && $row_select_pipe['ei_index'] != "") {
									?>
										<tr>
											<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Flakiness %</td>
											<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 40%</td>
											<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-1</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['fi_index']; ?></td>
										</tr>
										<tr>
											<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Elongation %</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['ei_index']; ?></td>

										</tr>
									<?php
									}
									if ($row_select_pipe['imp_value'] != "") {
									?>
										<tr>
											<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Impact Value %</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['imp_value']; ?></td>
										</tr>
									<?php
									}
									if ($row_select_pipe['sp_specific_gravity'] != "") {
									?>
										<tr>
											<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Specific Gravity</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
										</tr>
									<?php
									}
									if ($row_select_pipe['sp_water_abr'] != "") {
									?>
										<tr>
											<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Water Absorption %</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 2%</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
										</tr>
									<?php
									}
									if ($row_select_pipe['cru_value'] != "") {
									?>
										<tr>
											<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Crushing Value %</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['cru_value']; ?></td>
										</tr>
									<?php
									}
									if ($row_select_pipe['abr_index'] != "") {
									?>
										<tr>
											<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Abrasion Value %</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['abr_index']; ?></td>
										</tr>
									<?php
									}
									?>

								</table>

							</td>
						</tr>
						<tr>
							<td colspan="2" style="width:49%"><b>&nbsp;</b></td>
							<td style="width:2%"><b>&nbsp;</b></td>
							<td colspan="3" style="width:49%"><b></b></td>
						</tr>
						<tr>

							<td colspan="6" style="width:100%">
								<table align="center" width="100%" class="test" style="height:100%;width:100%;">
									<tr>
										<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;"><b>(III) Soundess Test</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Acceptance Critaria</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Method</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Results</b></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">A</td>
										<td colspan="2" style="text-align:left;border:1px solid black;border-right:0px solid black;">Sodium Sulphate</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 12%</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-5</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['soundness']; ?></td>
									</tr>
									<tr>
										<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;"><b>IV) Alkali Reactivity Test (Gravimetric Method)</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-7</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['alk_10']; ?></td>
									</tr>
									<tr>
										<td colspan="3" style="text-align:Left;border:1px solid black;border-right:0px solid black;"><b>V) Bulk Density kg/Lit.</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['bdl']; ?></td>
									</tr>
									<tr>
										<td colspan="3" style="text-align:Left;border:1px solid black;border-right:0px solid black;"><b>VI) 10% Fine Value KN</b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['fines_value']; ?></td>
									</tr>
									<tr>
										<td colspan="3" style="text-align:Left;border:1px solid black;border-right:0px solid black;"><b>VII) Liquid Limit & Plastic Limit Test (One Point Method) </b></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"></td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">A</td>
										<td colspan="2" style="text-align:Left;border:1px solid black;border-right:0px solid black;">Liquid Limit %</td>
										<td rowspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;">Max 25%</td>
										<td rowspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2720-5</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">B</td>
										<td colspan="2" style="text-align:Left;border:1px solid black;border-right:0px solid black;">Plastic Limit %</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;">C</td>
										<td colspan="2" style="text-align:Left;border:1px solid black;border-right:0px solid black;">Plasticity Index %</td>
										<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['pi_value']; ?></td>
									</tr>

								</table>

							</td>

						</tr>


					</table>

				</td>
			</tr>

			<tr>

				<td style="text-align:center"><b>&#8226;&#8226; End of the Report &#8226;&#8226;</b></td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="border-top:1px solid black;font-size:9;" class="test">
						<tr>
							<td style="width:3%;text-align:center;"><b>N<br>O<br>T<br>E</b></td>
							<td style="width:97%;">
								1. The Result relate only to the items tested.<br>
								2. Test Report Shall not be reproduced except in full without apporval of the Mattest Engineering Serivces can Provide assurance that parts of a report are not taken of context.<br>
								3. The information is Supplied by the customer and can effect the validity of Result.<br>
								4. The result applied to the Sample as received.

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

		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			<tr>

				<td style="text-align:left">Doc. No. F-7.8-06</td>
				<td style="text-align:right">Page No. 1/1</td>

			</tr>
		</table>



		<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>