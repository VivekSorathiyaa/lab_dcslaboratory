<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
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
		font-family: Arial;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.tdclass1 {

		font-size: 12px;
		font-family: Arial;
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
	function round_up($number, $precision = 0)
	{
		$fig = (int) str_pad('1', $precision, '0');
		return (ceil($number * $fig) / $fig);
	}
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 5);
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
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['fine_aggregate_source'];
		$material_location = $row_select4['material_location'];
		$chainage_no = $row_select4['chainage_no'];
		$fdd_desc_sample = $row_select4['fdd_desc_sample'];
	}


	if ($row_select_pipe['iscompaction'] == "1") {

		$flag = 0;
		$a = 1;
		$down = 0;
		$up = 5;
		for ($a = 1; $a <= $page_cont; $a++) {

	?>

			
			<page size="A4">
				<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
				     <tr>
						<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
					</tr>
					<tr>
						<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Compaction by Sand Replacement Method</b></td>
					</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top:4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top:4px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top:4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>


					
							<tr>
								<td style="width:12%;padding-bottom:4px;">Letter No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">

					    <tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Soil Field Density & field Moisture</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Method of Test</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">IS 2720 Part - 28</td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>
					</table>
				</td>
			</tr>


					<!-- <tr>
						<td style="text-align:center;font-size:12px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

								<tr style="">

									<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Authority</td>
									<td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																														$result_selectc = mysqli_query($conn, $select_queryc);

																														if (mysqli_num_rows($result_selectc) > 0) {
																															$row_selectc = mysqli_fetch_assoc($result_selectc);
																															$ct_nm = $row_selectc['city_name'];
																														}
																														echo $clientname; ?></td>
									<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
									<td style="border-left: 1px solid black;border-right: 1px solid;width:19%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Name Of Work</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
								</tr>
								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  "></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; ULR No.</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Consultant</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Agency</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
								</tr>

								<tr style="">

									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Received Date</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
								</tr>


							</table><br>

						</td>
					</tr>
					<tr>
						<td style="text-align:center;font-size:12px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

								<tr style="">
									<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Material under Testing</td>
									<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; GSB Layer</td>

								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;Source/Location</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php if ($material_location == 1) {
																																						echo "In Laboratory";
																																					} else {
																																						echo "In Field";
																																					} ?></td>
								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;No.of Sample</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['fdd_qty']; ?></td>
								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;Method Adopted</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS:2720(Part-28) - 1974</td>
								</tr>

							</table><br>

						</td>
					</tr> -->


					<?php $cnt = 1; ?>
					<tr>
						<td>
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

								<tr style="">
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Lab NO.</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Particulars</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">MDD g/cc</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OMC (%)</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Moisture Content %</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Density g/cc</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">COMPACTION</td>
								</tr>
								
								<tr style="">
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $lab_no; ?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['cal_mdd']; ?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;">-</td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php if ($row_select_pipe['mc_od'] != "") { echo $row_select_pipe['mc_od']; } else { echo $row_select_pipe['mc_od']; } ?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php if ($row_select_pipe['d7'] != "") { echo $row_select_pipe['d7']; } else { echo $row_select_pipe['d7']; } ?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['d8']; ?></td>
								</tr>
							</table>

						</td>
					</tr>

					<tr>
							<td style="text-align:center;font-size:11px; ">
									<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
											<tr>
												<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
														** End of Report ** 
												</td>																		
											</tr>
									</table>
							</td>		
					</tr>


					<tr>
						<td style="text-align:center;font-size:11px;">
								<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
									<tr>
										<td><b>Note :-</b></td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;width:50%;padding:3px 0;">1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
										<td style="text-align:center;width:15%;font-style:italic;"><b>Reviewed & Authorized By</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
										<td style="text-align:center;font-style:italic;"><b>(D.H.Shah/M.D.Shah)</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
										<td style="text-align:center;font-style:italic;"><b>Director/TM</b></td>
									</tr>
								</table>
						</td>
					</tr>
				</table>


				<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
							</td>
						</tr>
		        </table>


				
				<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


				</div>
			</page>
			<?php

			if ($flag == 5) {
				$flag = 0;
				$down = $up;
				$up += 5;
			?>



				<div class="pagebreak"> </div>
			<?php }
		}

	} else {


		//second
		if ($row_select['nabl_type'] == "nabl") {
			?>
			<Center><img src="nabl.png" style="padding-right:80px;padding-top:8px;" height="90px" width="80px" /></center>
			<br><br>
		<?php
		}
		?>


		<page size="A4">
			<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
			
			<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
				     <tr>
						<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
					</tr>
					<tr>
						<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Compaction by Sand Replacement Method</b></td>
					</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top:4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top:4px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top:4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>


					
							<tr>
								<td style="width:12%;padding-bottom:4px;">Letter No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">

					    <tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Soil Field Density & field Moisture</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Method of Test</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">IS 2720 Part - 28</td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>
					</table>
				</td>
			</tr>



				<?php $cnt = 1; ?>
				<tr>
						<td>
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

								<tr style="">
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Lab NO.</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Particulars</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">MDD g/cc</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OMC (%)</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Moisture Content %</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Field Density g/cc</td>
									<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">COMPACTION</td>
								</tr>
								
								<tr style="">
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $lab_no; ?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['cal_mdd']; ?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;">-</td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php
																																	if ($row_select_pipe['d6'] != "") {

																																		echo $row_select_pipe['d6'];
																																	} else {
																																		echo $row_select_pipe['mc_od'];
																																	}
																																	?></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"></td>
									<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;border-right: 0;
    border-bottom: 0;"><?php echo $row_select_pipe['d8']; ?></td>
								</tr>
							</table>

						</td>
					</tr>

					<tr>
							<td style="text-align:center;font-size:11px; ">
									<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
											<tr>
												<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
														** End of Report ** 
												</td>																		
											</tr>
									</table>
							</td>		
					</tr>


					<tr>
						<td style="text-align:center;font-size:11px;">
								<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
									<tr>
										<td><b>Note :-</b></td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;width:50%;padding:3px 0;">1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
										<td style="text-align:center;width:15%;font-style:italic;"><b>Reviewed & Authorized By</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
										<td style="text-align:center;font-style:italic;"><b>(D.H.Shah/M.D.Shah)</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
										<td style="text-align:center;font-style:italic;"><b>Director/TM</b></td>
									</tr>
								</table>
						</td>
					</tr>

			</table>



			<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
							</td>
						</tr>
		    </table>
			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
		</page>
















	<?php
	}
	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>