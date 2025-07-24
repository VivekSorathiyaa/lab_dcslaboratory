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
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$con_sample = "Good";
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
		$source = $row_select4['fine_aggregate_source'];
		$type = $row_select4['fine_agg_type'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}


	?>


	<?php
	if ($row_select['nabl_type'] == "nabl") {
	?>
		<Center><img src="nabl.png" style="padding-right:80px;padding-top:8px;" height="90px" width="80px" /></center>
		<br><br>
	<?php
	} else {
	?>
		<br>
		<Center><img src="non_nabl.png" style="padding-right:60px;padding-top:8px;" height="65px" /></center>
		<br>
		<br>
	<?php
	}
	?>
	<page size="A4">
		<center style="font-size:16px;font-family : Calibri;padding-bottom:3px;font-weight:bold;"><b>TEST REPORT OF FINE AGGREGATE</b></center>


		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family : Calibri;margin-left:45px;margin-right:15px;border:1px solid black;border-bottom:0px solid black;">
			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border-bottom:1px solid black;">
						<tr>
							<td style="width:9%;padding-top:3px;padding-bottom:3px;"><b>&nbsp;&nbsp;Report No.</b></td>
							<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
							<td style="width:15%"><?php echo $report_no; ?></td>
							<td style="width:9%;"><b>Report Date</b></td>
							<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
							<td style="width:15%"><?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
							<?php
							if ($row_select['nabl_type'] == "nabl") {
							?>
								<td style="width:7%;"><b>ULR No.</b></td>
								<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
								<td style="width:15%"><?php echo $_GET['ulr']; ?></td>
							<?php
							} else {
							?>
								<td style="width:6%;"><b>&nbsp;</b></td>
								<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>&nbsp;</b></td>
								<td style="width:15%">&nbsp;&nbsp;</td>
							<?php
							}

							?>
						</tr>

					</table>


				</td>
			</tr>



			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="border-bottom:1px solid black;">

						<?php

						if ($clientname != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Customer</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																					$result_selectc = mysqli_query($conn, $select_queryc);

																					if (mysqli_num_rows($result_selectc) > 0) {
																						$row_selectc = mysqli_fetch_assoc($result_selectc);
																						$ct_nm = $row_selectc['city_name'];
																					}
																					echo $clientname; ?>
								</td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Agency</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $agency_name; ?>
								</td>
							</tr>
						<?php
						}
						if ($row_select['tpi_name'] != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['tpi_or_auth']; ?></b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['tpi_name']; ?>
								</td>
							</tr>
						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['pmc_heading']; ?></b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['pmc_name']; ?>
								</td>
							</tr>

						<?php
						}
						if ($name_of_work != "") {
						?>

							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Work</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $name_of_work; ?>
								</td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>

							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Agreement No.</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
								<td style="width:77%">&nbsp;&nbsp;<?php echo $agreement_no; ?>
								</td>
							</tr>
						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;<b>Reference</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
								<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>

								</td>
							</tr>
						<?php
						}

						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" border="0px" class="test" style="border-bottom:1px solid black;">
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Discipline &amp; Group</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;Mechanical &amp; Building Material</td>
							<td style="width:22%">&nbsp; Environmental Condition in Lab</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:22%">&nbsp;Ambient</td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Description of Material</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family : Calibri;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>

							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						<?php
						if ($type != "" && $type != null && $type != "0") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Description of Sample</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $type; ?></td>
								<td style="width:22%">&nbsp;&nbsp;<b></b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
								<td style="width:14%">&nbsp;&nbsp;</td>
							</tr>
						<?php
						}
						if ($source != "" && $source != null && $source != "0") {
						?>
							<tr>

								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Sample Source</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
								<td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
								<td style="width:14%">&nbsp;&nbsp;</td>
							</tr>
						<?php
						}

						?>


					</table>
				</td>
			</tr>

			<tr>


				<td style="font-size:12.7px;padding-top:5px;">
					<center><b>Test Results</b></center>
				</td>

			</tr>

			<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0") { ?>
				<tr>

					<td>
						<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
							<tr>
								<td><b>Sieves Analysis (IS:2386-1-1963)</b></td>
								<td style="text-align:center;"><b>Sample Taken&nbsp;&nbsp;&nbsp;</b><?php echo $row_select_pipe['sample_taken']; ?><b>&nbsp;&nbsp;gm</b< /td>
							</tr>

						</table>
					</td>
					<!--<td style="font-size:11px;padding-top:3px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sample Taken&nbsp;&nbsp;&nbsp;</b><? php // echo $row_select_pipe['sample_taken'];
																																																										?><b>&nbsp;&nbsp;gm</b></td>-->


				</tr>

				<tr>
					<!--OTHER START-->
					<td>


						<table align="left" width="100%" class="test" style="height:auto;width:100%;">
							<tr style="text-align:center;">
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;width:15%;"><b>Sieve Size<br>in mm</b></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;width:15%;"><b>Cum. % mass<br>retained</b></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;width:15%;"><b>% of passing</b></td>
								<td colspan="4" style="border:1px solid black;border-right:0px solid black;width:55%;"><b>% passing as Per IS. 383-2016</b></td>

							</tr>
							<tr style="text-align:center;border:1px solid black;">

								<td colspan="4"><b>Grading</b></td>
							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><b>Zone I</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>Zone II</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>Zone III</b></td>
								<td style="border:1px solid black;border-right:0px solid black;"><b>Zone IV</b></td>
							</tr>
							<?php
							if ($row_select_pipe['sieve_1'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>10.0</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_1'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_1'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">100</td>
									<td style="border:1px solid black;border-left:0px solid black;">100</td>
									<td style="border:1px solid black;border-left:0px solid black;">100</td>
									<td style="border:1px solid black;border-right:0px solid black;">100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_2'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>4.75</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_2'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_2'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">90-100</td>
									<td style="border:1px solid black;border-left:0px solid black;">90-100</td>
									<td style="border:1px solid black;border-left:0px solid black;">90-100</td>
									<td style="border:1px solid black;border-right:0px solid black;">95-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_3'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>2.36</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_3'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_3'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">60-95</td>
									<td style="border:1px solid black;border-left:0px solid black;">75-100</td>
									<td style="border:1px solid black;border-left:0px solid black;">85-100</td>
									<td style="border:1px solid black;border-right:0px solid black;">95-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_4'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>1.18</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_4'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_4'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">30-70</td>
									<td style="border:1px solid black;border-left:0px solid black;">55-90</td>
									<td style="border:1px solid black;border-left:0px solid black;">75-100</td>
									<td style="border:1px solid black;border-right:0px solid black;">90-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_5'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>0.600</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_5'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_5'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">15-34</td>
									<td style="border:1px solid black;border-left:0px solid black;">35-59</td>
									<td style="border:1px solid black;border-left:0px solid black;">60-79</td>
									<td style="border:1px solid black;border-right:0px solid black;">80-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_6'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>0.300</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_6'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_6'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">5-20</td>
									<td style="border:1px solid black;border-left:0px solid black;">8-30</td>
									<td style="border:1px solid black;border-left:0px solid black;">12-40</td>
									<td style="border:1px solid black;border-right:0px solid black;">15-50</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_7'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;"><b>0.150</b></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['cum_ret_7'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;"><?php echo number_format($row_select_pipe['pass_sample_7'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;">0-10</td>
									<td style="border:1px solid black;border-left:0px solid black;">0-10</td>
									<td style="border:1px solid black;border-left:0px solid black;">0-10</td>
									<td style="border:1px solid black;border-right:0px solid black;">0-15</td>
								</tr>
							<?php
							}
							?>

						</table>

					</td>

				</tr>
				<tr>
					<td>
						<table align="left" width="22%" border="0px" cellspacing="0" cellpadding="0" class="test">
							<tr>
								<td>&nbsp; </td>
								<td> </td>
								<td> </td>

							</tr>
							<tr>
								<td>Fineness Modules </td>
								<td>:-</td>
								<td>&nbsp; <?php echo $row_select_pipe['grd_fm']; ?></td>
							</tr>


							<tr>
								<td>Zone Classification </td>
								<td>:-</td>
								<td>&nbsp; <?php echo $row_select_pipe['grd_zone']; ?></td>
							</tr>
							<?php

							if ($row_select_pipe['silt_content'] != "") {
							?>
								<tr>
									<td>Silt Content</td>
									<td>:-</td>
									<td>&nbsp; <?php echo $row_select_pipe['silt_content']; ?></td>
								</tr>
							<?php
							}

							?>

						</table>
					</td>
				</tr>

				<tr>

					<td>
						<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="border-top:1px solid black;">
							<tr>
								<td>&nbsp; </td>

							</tr>

						</table>
					</td>
				</tr>
			<?php } ?>
			<?php
			if (($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0")) {

			?>
				<tr>
					<td style="padding-top:10px;">&nbsp;&nbsp;<b>Physical Tests</b></td>
				</tr>


				<tr>
					<td>
						<table align="left" class="test" style="height:Auto;width:100%;">
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;"><b>Item No.</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>Test Name</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>Test Method</b></td>
								<td style="border:1px solid black;border-left:0px solid black;"><b>Test Results</b></td>
								<td style="width:20%;border:1px solid black;border-right:0px solid black;"><b>Requirement as Per<br>IS 383-2016</b></td>
							</tr>
							<?php
							$cnt = 0;
							/*$rw=0;*/
							/*if($row_select_pipe['sp_water_abr']!="" && $row_select_pipe['sp_water_abr']!=null && $soundness['sp_water_abr']!="0")
										{
											$rw++;
											if($row_select_pipe['sp_specific_gravity']!="" && $row_select_pipe['sp_specific_gravity']!=null && $soundness['sp_specific_gravity']!="0")
											{
												$rw++;
													if($row_select_pipe['bdl']!="" && $row_select_pipe['bdl']!=null && $row_select_pipe['bdl']!="0")
													{
														$rw++;
													}
											}
										}*/
							if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {



							?>


								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php $cnt++;
																															echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Water Absorption %</td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-3-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {
																															echo number_format($row_select_pipe['sp_water_abr'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 2%</td>
								</tr>
							<?php

							}
							if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Specific Gravity</td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-3-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {

																															echo $row_select_pipe['sp_specific_gravity'];
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
								</tr>
							<?php

							}
							if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Density kg/lit.</td>
									<td style="border:1px solid black;border-left:0px solid black;text-align:center;"><b>IS 2386-3-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
																															echo number_format($row_select_pipe['bdl'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
								</tr>
							<?php

							}
							if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Soundness by Sodium Sulphate %</td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-5-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
																															echo number_format($row_select_pipe['soundness'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 10%</td>
								</tr>
							<?php

							}
							if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Material Finer Then 75 Micron %</td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-1-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
																															echo number_format($row_select_pipe['avg_finer'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
								</tr>
							<?php } ?>

						<?php
					}
						?>
					</td>
				</tr>
		</table>
		</td>
		</tr>
		</table>
		<?php
		if (($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") ||

			($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_3_3'] != "" &&  $row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_3_3'] != "0" &&  $row_select_pipe['dele_4_3'] != "0")
			||
			($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != "undefined")
			||
			($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0")
			||
			($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0")
			||
			($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0") || ($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0") || ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != "0") ||
			($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != "undefined")

			|| ($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != "undefined") || ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != "0")
		) {
		?>

			<table align="center" width="92%" class="test" style="border:1px solid black; margin-left:45px;">
				<tr>
					<td colspan="6" height="25px" style="border:1px solid black;border-right:1px solid black;">&nbsp;&nbsp;<b>Chemical Test</b></td>
				</tr>
				<tr>
					<td colspan="3" style="text-align:center;border:1px solid black;border-right:1px solid black;"><b>Test Name</b></td>
					<td style="text-align:center;border:1px solid black;border-right:1px solid black;"><b>Acceptance Critaria</b></td>
					<td style="text-align:center;border:1px solid black;border-right:1px solid black;"><b>Test Method</b></td>
					<td style="text-align:center;border:1px solid black;border-right:1px solid black;"><b>Test Results</b></td>
				</tr>
				<?php
				if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != null) {
				?>
					<tr>
						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Alkali Reactivity Test (Gravimetric Method)</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-7</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['alk_10'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['alk_10'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 12%</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-5</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['soundness'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['soundness'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_3_3'] != "" &&  $row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_1_4'] != null && $row_select_pipe['dele_2_3'] != null && $row_select_pipe['dele_3_3'] != null &&  $row_select_pipe['dele_4_3'] != null) {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Total of percentages of all deleterious Materials<br>(except mica), %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 2%</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-1,2</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php
																											$a1 = $row_select_pipe['dele_1_4'];
																											$a2 = $row_select_pipe['dele_2_3'];
																											$a3 = $row_select_pipe['dele_3_3'];
																											$a4 = $row_select_pipe['dele_4_3'];

																											$ans  = floatval($a1) + floatval($a2) + floatval($a3) + floatval($a4);


																											echo number_format($ans, 2, ".", ""); ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null && $row_select_pipe['dele_3_3'] != "undefined") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Coal &amp; Lignite, %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 1%</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-2</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php
																											if ($row_select_pipe['dele_3_3'] == "0" || $row_select_pipe['dele_3_3'] == "0.000") {
																												echo "NILL";
																											} else {

																												echo $row_select_pipe['dele_3_3'];
																											}
																											?></td>
					</tr>

				<?php
				}
				if ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != null && $row_select_pipe['dele_2_3'] != "0") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Clay &amp; Lumps, %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 1%</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-2</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['dele_2_3'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['dele_2_3'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != null && $row_select_pipe['dele_4_3'] != "0") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Soft Particles, %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">-</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-2</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['dele_4_3'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['dele_4_3'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != null && $row_select_pipe['dele_1_4'] != "0") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Material Finer than 75&mu;, %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 1%</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-1</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['dele_1_4'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['dele_1_4'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != null && $row_select_pipe['aoi_4'] != "0") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Organic Impurities</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">-</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-2</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php
																											if ($row_select_pipe['aoi_4'] == "Visual Match With Standard Solution, Organic Impurities Not Detected.") {
																												echo "Not Detected";
																											} else {
																												echo $row_select_pipe['aoi_4'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != null && $row_select_pipe['avg_ph'] != "0") {
				?>
					<tr>

						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">pH</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">-</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2720-26</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['avg_ph'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['avg_ph'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != null && $row_select_pipe['avg_sul'] != "undefined" && $row_select_pipe['avg_sul'] != "0") {
				?>
					<tr>
						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Sulphate, %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">-</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">BS 812 P118</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['avg_sul'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['avg_sul'];
																											} ?></td>
					</tr>
				<?php
				}
				if ($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != null && $row_select_pipe['avg_clr'] != "undefined" && $row_select_pipe['avg_clr'] != "0") {
				?>
					<tr>
						<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;">Cloride Content, %</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">-</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;">BS EN 1744-1</td>
						<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php if ($row_select_pipe['avg_clr'] == 0) {
																												echo "NILL";
																											} else {
																												echo $row_select_pipe['avg_clr'];
																											} ?></td>
					</tr>
				<?php } ?>
			</table>
		<?php } ?>





		<table cellpadding="0" cellpadding="0" align="center" width="92%" style="font-size:12.7px;font-family : Calibri;margin-left:45px;margin-right:15px;" class="test">

			<tr>

				<td style="width:100%;text-align:right;padding-top:50px;padding-right:20px;">Authorized Signature</td>


			</tr>

			<tr>

				<td style="width:100%;text-align:right;">Mr. Kuldip(TM) / Mr. Ankur(QM)</td>


			</tr>
		</table>
		<table width="95%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family : Calibri;//position:fixed;bottom:50px;">
			<tr>

				<td colspan="2">
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-left:35px;">
						<tr>

							<td style="text-align:left;padding-right:15px;">
								<p align="justify">Terms &amp; Condition :The results relate only to the sample tested, Sample(s) drawn by party. Test certificate shall not be re-produced except in full without the written approval of Laboratory. RMS has made their best endeavors to provide accurate and reliable information, RMS is not responsible for any financial liability due to any act of omission or error mode.</p>
							</td>

						</tr>
					</table>
				</td>

			</tr>
			<tr>

				<td>
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-left:45px;">

						<td style="text-align:left;width:33%">F/7.8/6</td>


						<td style="text-align:center;width:33%">** END OF REPORT **</td>


						<td style="text-align:right;width:33%;padding-right:22.5px;">Page No. 1 of 1</td>

					</table>
				</td>
			</tr>
		</table>




	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>