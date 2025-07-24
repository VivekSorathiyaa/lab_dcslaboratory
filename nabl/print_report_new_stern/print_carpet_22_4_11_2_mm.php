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
	$select_tiles_query = "select * from carpet_22_4_11_2_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			include_once 'sample_id.php';
			if (
				strpos($row_select3["mt_name"], "WMM (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - IV MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - V MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - VI MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "Seal Coat") !== false ||
				strpos($row_select3["mt_name"], "Premix Carpet") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
			) {
				$mt_name = $row_select3['mt_name'];
			} else {
				$ans = substr($row_select3["mt_name"], strpos($row_select3["mt_name"], "(") + 1);
				$explodeing = explode(")", $ans);
				$mt_name = $explodeing[0];
			}
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
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
		<br>
	<?php
	} else {
	?>
		<br>
		<Center><img src="non_nabl.png" style="padding-right:90px;padding-top:8px;" height="60px" width="200px" /></center>
		<br>
		<br>

	<?php
	}
	?>

	<page size="A4">
		<center style="font-size:16px;font-family : Calibri;margin-left:45px;padding-bottom:3px;font-weight:bold;"><b>TEST REPORT OF COARSE AGGREGATE</b></center>



		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family : Calibri;margin-left:45px;margin-right:15px;border:1px solid black;">
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
							if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "-" && strlen($row_select_pipe['ulr']) >= 5 && $row_select['nabl_type'] == "nabl") {
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
							<td style="width:22%">&nbsp;</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
							<td style="width:22%">&nbsp;</td>

						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Material Received</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;Coarse Aggregates</td>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family : Calibri;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Size of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Source of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:22%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr>

			<tr>


				<td style="font-size:12.7px;padding-top:5px;">
					<center><b>Test Results</b></center>
				</td>

			</tr>


			<!--START-->
			<tr>

				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
						<tr>
							<td colspan="2" style="width:49%"><b>(I) Sieves Analysis</b></td>
							<td style="width:2%"><b>&nbsp;</b></td>
							<?php
							if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

							?>
								<td colspan="3" style="width:49%"><b>(II) Other Tests</b></td>
							<?php } else { ?>
								<td colspan="3" style="width:49%"><b>&nbsp;</b></td>
							<?php
							}
							?>
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
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>% of Retained</b></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><b>% of Passing</b></td>

									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">22.4 mm</td>

										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_1']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">13.2 mm</td>

										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_2']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
									</tr>
									<tr>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;">11.2 mm</td>

										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cum_ret_3']; ?></td>
										<td style="text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
									</tr>




								</table>
							</td>
							<td style="width:2%"></td>
							<td colspan="3" style="width:49%;vertical-align:top">
								<table align="top" width="100%" class="test" style="height:100%;width:100%;">
									<?php
									if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

									?>
										<tr>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Name</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Req. as per<br>IS 383-2016</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test<br>Method</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Results</b></td>
										</tr>
										<?php
										if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Flakiness %</td>
												<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 35%</td>
												<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-1</td>
												<td rowspan="2" style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['combined_index']; ?></td>
											</tr>
											<tr>
												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Elongation %</td>


											</tr>
										<?php
										}
										if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Impact Value %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['imp_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Specific Gravity</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Water Absorption %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 2%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Crushing Value %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 30%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['cru_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Abrasion Value %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 40%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['abr_index']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Bulk Density kg/Lit.</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-3</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['bdl']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") {
										?>
											<tr>
												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">10% Fine Value KN</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-4</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['fines_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") {
										?>
											<tr>

												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Liquid Limit %</td>
												<td rowspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;">Max 25%</td>
												<td rowspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2720-5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
											</tr>
											<tr>

												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Plastic Limit %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
											</tr>
											<tr>

												<td style="text-align:Left;border:1px solid black;border-right:0px solid black;">Plasticity Index %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['pi_value']; ?></td>
											</tr>
										<?php
										}
										if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
										?>
											<tr>

												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">Max. 12%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['soundness']; ?></td>
											</tr>
									<?php
										}
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
							<?php
							if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") {
							?>
								<td colspan="6" style="width:100%">
									<table align="center" width="100%" class="test" style="height:100%;width:100%;">
										<tr>
											<td colspan="3" style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Name</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Acceptance Critaria</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Method</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><b>Test Results</b></td>
										</tr>

										<tr>
											<td colspan="3" style="text-align:left;border:1px solid black;border-right:0px solid black;"><b>III) Alkali Reactivity Test (Gravimetric Method)</b></td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">--</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;">IS 2386-7</td>
											<td style="text-align:center;border:1px solid black;border-right:0px solid black;"><?php echo $row_select_pipe['alk_10']; ?></td>
										</tr>


									</table>

								</td>
							<?php
							}
							?>


						</tr>


					</table>

				</td>
			</tr>



		</table>
		<table cellpadding="0" cellpadding="0" align="center" width="92%" style="font-size:12.7px;font-family : Calibri;margin-left:45px;margin-right:15px;" class="test">

			<tr>

				<td style="width:100%;text-align:right;padding-top:70px;padding-right:20px;">Authorized Signature</td>


			</tr>

			<tr>

				<td style="width:100%;text-align:right;">Mr. Kuldip(TM) / Mr. Ankur(QM)</td>


			</tr>
		</table>

		<table width="95%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family : Calibri;position:fixed;bottom:70px;">
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