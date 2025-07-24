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
		$source = $row_select4['fine_aggregate_source'];
		$type = $row_select4['fine_agg_type'];
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
							<td style="width:20%">&nbsp;&nbsp;<b>Sample Source</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
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
							<td style="width:20%">&nbsp;&nbsp;<b>Type of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo $type; ?></td>
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
					<center><b><u>Sand Test Result</u></b></center>
				</td>

			</tr>
			<tr>

				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
						<tr>
							<td><b>A) Sieves Analysis (IS:2386-1-1963)</b></td>
							<td style="text-align:center;"><b>Sample Taken&nbsp;&nbsp;&nbsp;</b><?php echo $row_select_pipe['sample_taken']; ?><b>&nbsp;&nbsp;gm</b< /td>
						</tr>

					</table>
				</td>
				<!--<td style="font-size:10px;padding-top:3px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sample Taken&nbsp;&nbsp;&nbsp;</b><? php // echo $row_select_pipe['sample_taken'];
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
							<td>&nbsp; <?php echo number_format($row_select_pipe['grd_fm'], 2); ?></td>
						</tr>
						<tr>
							<td>Zone Classification </td>
							<td>:-</td>
							<td>&nbsp; <?php echo $row_select_pipe['grd_zone']; ?></td>
						</tr>

					</table>
				</td>
			</tr>
			<tr>

				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="border-top:1px solid black;">
						<tr>
							<td>&nbsp; </td>
							<td> </td>
							<td> </td>
						</tr>

					</table>
				</td>
			</tr>
			<?php
			if (($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0")) {

			?>
				<tr>
					<td style="padding-top:10px;"><b>B) Other Tests</b></td>
				</tr>


				<tr>
					<td>
						<table align="left" class="test" style="height:Auto;width:100%;">
							<tr style="text-align:center;">
								<td style="width:10%;border:1px solid black;border-left:0px solid black;"><b>Item No.</b></td>
								<td style="width:36%;border:1px solid black;border-left:0px solid black;"><b>Test Name</b></td>
								<td style="width:16%;border:1px solid black;border-left:0px solid black;"><b>Test Method</b></td>
								<td style="width:16%;border:1px solid black;border-left:0px solid black;"><b>Test Results</b></td>
								<td style="width:22%;border:1px solid black;border-right:0px solid black;"><b>Requirement as Per<br>IS 383-2016</b></td>
							</tr>
							<?php
							$cnt = 1;
							$rw = 0;
							if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $soundness['sp_water_abr'] != "0") {
								$rw++;
								if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $soundness['sp_specific_gravity'] != "0") {
									$rw++;
									if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
										$rw++;
									}
								}
							}
							if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Water Absorption %</td>
									<td rowspan="<?php echo $rw; ?>" style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-3-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {
																															echo number_format($row_select_pipe['sp_water_abr'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 2%</td>
								</tr>
							<?php
								$cnt++;
							}
							if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Specific Gravity</td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {

																															echo number_format($row_select_pipe['sp_specific_gravity'], 3);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
								</tr>
							<?php
								$cnt++;
							}
							if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b><?php echo $cnt;
																															?></b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Density kg/lit.</td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
																															echo number_format($row_select_pipe['bdl'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
								</tr>
							<?php
								$cnt++;
							}
							if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
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
								$cnt++;
							}
							if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>5</b></td>
									<td style="border:1px solid black;border-left:0px solid black;">Material Finer Then 75 Micron %</td>
									<td rowspan="<?php echo $rw; ?>" style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-1-1963</b></td>
									<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
																															echo number_format($row_select_pipe['avg_finer'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
								</tr>
							<?php } ?>
							<!--<tr>
								<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>5</b></td>
								<td style="border:1px solid black;border-left:0px solid black;">Alkali Reactivity Test</td>
								<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>IS: 2386-7-1963</b></td>
								<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><? php // if($row_select_pipe['avg_alk']!="" || $row_select_pipe['avg_alk']!=null){echo number_format($row_select_pipe['avg_alk'],2);}else{echo "-";}
																													?></td>
								<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
							</tr>-->


						</table>

					</td>
				</tr>
			<?php
			}
			?>

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

				<td style="text-align:left">Doc. No. F-7.8-07</td>
				<td style="text-align:right">Page No. 1/1</td>

			</tr>
		</table>



	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
