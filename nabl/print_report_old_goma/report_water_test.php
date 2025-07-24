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
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: Arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Arial;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Arial;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from water WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$rec_sample_date = $row_select['sample_rec_date'];
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
		$water_source = $row_select4['water_source'];
		$water_brand = $row_select4['water_brand'];
		$water_specification = $row_select4['water_specification'];
	}


	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF WATER</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
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

							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp; </td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold; ">&nbsp; ULR No.</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php //echo $_GET['ulr'];
																																			?><?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																																											echo $row_select_pipe['ulr'];
																																										} ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of EPC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; PMC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?><?php //echo $row_select['pmc_heading'];
																																												?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Sample Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp;Sample Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date("d - m - Y", strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Sample Done By</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select['sel_report_to'] == 1) {
																													echo 'Agency';
																												} else {
																													echo 'Client';
																												} ?></td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left; padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Material Under Testing</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; Construction Water</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp;No.of Sample/Agreement No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 01 NOS / <?php echo $agreement_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left; padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Lab ID</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; F - 01</td>
						</tr>
					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:left; font-size:18px; "><u><b>Test Results of The Water Sample</b></u></td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%;font-weight:bold; text-align:center;padding-bottom:10px;padding-top:10px; "><u>Sr.<br>NO.</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:20%;text-align:center;font-weight:bold; "><u>Test Description</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:25%; text-align:center;font-weight:bold;"><u>Test Method</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%;font-weight:bold;text-align:center; "><u>Results</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:20%;text-align:center;font-weight:bold;"><u>As Per <br>IS 456:2000<br> Permission Limit</u></td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%;text-align:center;font-weight:bold;"><u>Unit</u></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">PH</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 11 RY 2017</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgp'] != "" && $row_select_pipe['avgp'] != null && $row_select_pipe['avgp'] != "0") {
																																				echo $row_select_pipe['avgp'];
																																			} else {
																																				echo "-";
																																			} ?> </td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["phv_test_limit"] != null && $row_select_pipe["phv_test_limit"] != "" && $row_select_pipe["phv_test_limit"] != "0" && $row_select_pipe["phv_test_limit"] != "undefined") {
																															echo $row_select_pipe["phv_test_limit"];
																														} else { ?> not less than 6 <?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">-</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Acidity</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 22 RY 2019</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgn'] != "" && $row_select_pipe['avgn'] != null && $row_select_pipe['avgn'] != "0") {
																																				echo $row_select_pipe['avgn'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["nao_test_limit"] != null && $row_select_pipe["nao_test_limit"] != "" && $row_select_pipe["nao_test_limit"] != "0" && $row_select_pipe["nao_test_limit"] != "undefined") {
																															echo $row_select_pipe["nao_test_limit"];
																														} else { ?>5<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">ml</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Alkalinity</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 23 RY 2019</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgh'] != "" && $row_select_pipe['avgh'] != null && $row_select_pipe['avgh'] != "0") {
																																				echo $row_select_pipe['avgh'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["hso_test_limit"] != null && $row_select_pipe["hso_test_limit"] != "" && $row_select_pipe["hso_test_limit"] != "0" && $row_select_pipe["hso_test_limit"] != "undefined") {
																															echo $row_select_pipe["hso_test_limit"];
																														} else { ?>25<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">ml</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Chloride</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 32 RY 2019</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgch'] != "" && $row_select_pipe['avgch'] != null && $row_select_pipe['avgch'] != "0") {
																																				echo $row_select_pipe['avgch'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["chl_test_limit"] != null && $row_select_pipe["chl_test_limit"] != "" && $row_select_pipe["chl_test_limit"] != "0" && $row_select_pipe["chl_test_limit"] != "undefined") {
																															echo $row_select_pipe["chl_test_limit"];
																														} else { ?>2000 & 500*<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">mg/L</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Sulphate</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 24 RY 2019</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgsu'] != "" && $row_select_pipe['avgsu'] != null && $row_select_pipe['avgsu'] != "0") {
																																				echo $row_select_pipe['avgsu'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["sul_test_limit"] != null && $row_select_pipe["sul_test_limit"] != "" && $row_select_pipe["sul_test_limit"] != "0" && $row_select_pipe["sul_test_limit"] != "undefined") {
																															echo $row_select_pipe["sul_test_limit"];
																														} else { ?>400<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">mg/L</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Organic Solid</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 18 RY 2017</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgor'] != "" && $row_select_pipe['avgor'] != null && $row_select_pipe['avgor'] != "0") {
																																				echo $row_select_pipe['avgor'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["org_test_limit"] != null && $row_select_pipe["org_test_limit"] != "" && $row_select_pipe["org_test_limit"] != "0" && $row_select_pipe["org_test_limit"] != "undefined") {
																															echo $row_select_pipe["org_test_limit"];
																														} else { ?>200<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">mg/L</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Inorganic Solid</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 18 RY 2017</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgin'] != "" && $row_select_pipe['avgin'] != null && $row_select_pipe['avgin'] != "0") {
																																				echo $row_select_pipe['avgin'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["ino_test_limit"] != null && $row_select_pipe["ino_test_limit"] != "" && $row_select_pipe["ino_test_limit"] != "0" && $row_select_pipe["ino_test_limit"] != "undefined") {
																															echo $row_select_pipe["ino_test_limit"];
																														} else { ?>3000<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">mg/L</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:20%;text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px; ">Total Dissolved Solids</td>
							<td style="border-left: 1px solid black;width:25%; text-align:center;border-top:1px solid;">IS 3025 : Part 16 RY 2017</td>
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avgtd'] != "" && $row_select_pipe['avgtd'] != null && $row_select_pipe['avgtd'] != "0") {
																																				echo $row_select_pipe['avgtd'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe["tds_test_limit"] != null && $row_select_pipe["tds_test_limit"] != "" && $row_select_pipe["tds_test_limit"] != "0" && $row_select_pipe["tds_test_limit"] != "undefined") {
																															echo $row_select_pipe["tds_test_limit"];
																														} else { ?>-<?php } ?></td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;">mg/L</td>
						</tr>

					</table>

				</td>
			</tr>


			<tr>
				<td style="text-align:center; "><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px; ">
						<tr>
							<td><b>Note :-</b></td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b>Test rcsults are related to samples submitted by customers only.</td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test results are issued wilh specifïc understanding that GEC will not in any case be involved in action Following the information of the test results.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> The Test reports are not supposed to be used for publicity.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test report shall not be reproduced except in full Without written approvaI of GEC.</td>

						</tr>
						<tr>
							<td><b> * &nbsp;</b> 2000mg/L for Concrete not containing embedded steel and 500 mg/L for reinforced Concrete Work</td>

						</tr>

					</table>
				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br><br><br>
					<table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
						<tr>
							<td style="text-align:right"><b>Approved By</b></td>
						</tr>
						<tr>
							<td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
						</tr>

						<tr>

							<td style="text-align:right"><b>| Darshan Patel |</b></td>

						</tr>
						<tr>

							<td style="text-align:right"><b>Authorized Signatory</b></td>

						</tr>
					</table>
				</td>
			</tr>


		</table>



		<br>
		<table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>

				<td style="width:40%;text-align:left;font-weight:bold;">
					Page No. 1 of 1
				</td>
				<td style="width:60%;text-align:left;font-weight:bold;">
					. . . . . . .END OF REPORT. . . . . . .
				</td>
			</tr>

		</table>
		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
	</page>

</body>

</html>

<script type="text/javascript">


</script>