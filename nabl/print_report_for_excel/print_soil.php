<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0;
		-webkit-transform: scale(.68, .68);
		-moz-transform: scale(.58, .58);
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
		font-size: 11px;
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
	$select_tiles_query = "select * from soil WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$source = $row_select4['soil_source'];
		$soil_location = $row_select4['soil_location'];
		$material_location = $row_select4['material_location'];
	}
	$cnt = 1;

	?>


	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="height:60%;font-size:13px;font-family: Book Antiqua;border:2px solid black;margin-left:35px;">
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:40px;">ULR: <?php echo $row_select_pipe['ulr']; ?></td>
			</tr>
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:43px;"><b>Discipline : Mechanical</b></td>
			</tr>
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:38px;"><b>Group : Soil And Rock</b></td>
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
							<td style="width:40%">&nbsp;&nbsp;Soil</td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Sample Type</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $soil_location; ?></td>
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
							<td style="width:20%">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">Source</td>
							<td style="width:3%;font-family:Book Antiqua;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr>

			<tr>


				<td style="font-size:15px;padding-top:5px;">
					<center><b><u>Soil Test Results</u></b></center>
				</td>

			</tr>

			<tr>
				<!--OTHER START-->
				<td>




					<table align="left" width="100%" class="test" style="height:auto;width:100%; font-size:11px;">
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Sr.No.</b></td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;width:35%;"><b>Test</b></td>

							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Unit</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Results</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:35%;"><b>Test Method Specification</b></td>


						</tr>
						<?php
						if ($row_select_pipe['g1'] != "" ||  $row_select_pipe['g1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="4" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="4" style="border:1px solid black;border-left:0px solid black;text-align:left;">Hydrometer Analysis</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Gravel,</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g1']; ?></td>
								<td rowspan="4" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-4)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Sand,</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g2']; ?></td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Silt,</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g3']; ?></td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Clay,</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g4']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['grain1'] != "" ||  $row_select_pipe['grain1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Grain Size Analysis</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Gravel,</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['grain1']; ?></td>
								<td rowspan="3" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-4)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Sand,</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['grain2']; ?></td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Silt + Clay</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['grain3']; ?></td>

							</tr>

						<?php
							$cnt++;
						}
						if ($row_select_pipe['a1'] != "" ||  $row_select_pipe['a1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Atterberg Limits</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Liquid Limit</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['a1']; ?></td>
								<td rowspan="3" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1980 (Part-5)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Plastic Limit</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['a2']; ?></td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Plasticity Index</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['a3']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['s1'] != "" ||  $row_select_pipe['s1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Shrinkage Limit</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['s1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-6)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['f1'] != "" ||  $row_select_pipe['f1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Free Swell Index</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['f1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1973 (Part-40)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['so1'] != "" ||  $row_select_pipe['so1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Soil Classifications</td>
								<td style="border:1px solid black;border-left:0px solid black;">--</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['so1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:1498, RA 2002</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['l1'] != "" ||  $row_select_pipe['l1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Light Compaction</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Maximum Dry Density</td>
								<td style="border:1px solid black;border-left:0px solid black;">gm/cc</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['l1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-7)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Optimum Moisture Content</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['l2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['h1'] != "" ||  $row_select_pipe['h1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Heavy Compaction</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Maximum Dry Density</td>
								<td style="border:1px solid black;border-left:0px solid black;">gm/cc</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['h1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-8)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Optimum Moisture Content</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['h2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['sp1'] != "" ||  $row_select_pipe['sp1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Specific Gravity</td>

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['sp1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-3)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['d1'] != "" ||  $row_select_pipe['d1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Direct Shear</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Cohesion ('C)</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['d1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-13)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Friction Angel(&empty;)</td>
								<td style="border:1px solid black;border-left:0px solid black;">Degree</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['d2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['c1'] != "" ||  $row_select_pipe['c1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Consolidation</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Cc</td>
								<td style="border:1px solid black;border-left:0px solid black;">--</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['c1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-15)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Pc</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['c2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['cbr1'] != "" ||  $row_select_pipe['cbr1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">CBR (Unsoaked)</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cbr1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1987 (Part-16)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['cbr2'] != "" ||  $row_select_pipe['cbr2'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">CBR (Soaked)</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cbr2']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1987 (Part-16)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['t1'] != "" ||  $row_select_pipe['t1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Triaxial (UU)</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Cohesion ('C)</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['t1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-11)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Friction Angel (&empty;)</td>
								<td style="border:1px solid black;border-left:0px solid black;">Degree</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['t2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['r1'] != "" ||  $row_select_pipe['r1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Relative Density</td>
								<td style="border:1px solid black;border-left:0px solid black;">gm/cc</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['r1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1983 (Part-14)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['u1'] != "" ||  $row_select_pipe['u1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Unconfined Compressive Strength (UCS)</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['u1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1980 (Part-10)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['sw1'] != "" ||  $row_select_pipe['sw1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Swelling Pressure</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['sw1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1977 (Part-41)</td>

							</tr>
						<?php

						}

						?>


					</table>

				</td>

			</tr>


			<tr>

				<td style="text-align:center;"><b>&#8226;&#8226; End of the Report &#8226;&#8226;</b></td>
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

				<td style="text-align:left">Doc. No. F-7.8-05</td>
				<td style="text-align:right">Page No. 1/1</td>

			</tr>
		</table>




	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
