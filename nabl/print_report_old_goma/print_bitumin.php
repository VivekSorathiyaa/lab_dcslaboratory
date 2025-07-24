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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$bitumin_grade = $row_select4['bitumin_grade'];
		$lot_no = $row_select4['lot_no'];
		$bitumin_make = $row_select4['bitumin_make'];
		$tank_no = $row_select4['tanker_no'];
		$material_location = $row_select4['material_location'];
	}


	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF BITUMEN</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Authority

							</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;<?php echo $agreement_no; ?></td>
						</tr>


						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Client</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																																	$result_selectc = mysqli_query($conn, $select_queryc);

																																	if (mysqli_num_rows($result_selectc) > 0) {
																																		$row_selectc = mysqli_fetch_assoc($result_selectc);
																																		$ct_nm = $row_selectc['city_name'];
																																	}
																																	echo $clientname; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;<?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;Contractor</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;<?php echo $row_select['pmc_name']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;<?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>



						<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Receive Date</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Testing Date</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
			</tr>


		</table><br>

		</td>
		</tr>
		<tr>
			<td style="text-align:center;font-size:12px; ">

				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

					<tr style="">
						<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:5px;padding-top:5px;  ">&nbsp;Material under Testing</td>
						<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;Bitumen VG - 30</td>

					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;Vehicle No./Inv.No.</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;<?php echo $row_select_pipe['tank_no']; ?></td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;No.of Sample</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;1/1</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;Source</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;<?php echo $source; ?>10CL Vadodara</td>
					</tr>

				</table><br>

			</td>
		</tr>


		<?php $cnt = 1; ?>
		<tr>
			<td style="text-align:left;font-size:12px; ">
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

					<tr style="">
						<td style="border-left: 1px solid black;border-top:1px solid;width:4%;font-weight:bold; text-align:center; " rowspan="2">SR.<BR>NO.</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:26%;text-align:center;font-weight:bold; " rowspan="2">Test Description</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:10%; text-align:center;font-weight:bold;" rowspan="2">Unit</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:10%;text-align:center;font-weight:bold;" rowspan="2">Test Results</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:28%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px;" colspan="4">Test Requirements</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:19%;text-align:center;font-weight:bold;" rowspan="2">Test Method</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%; text-align:center;font-weight:bold;">VG 10</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;">VG 20</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px;">VG 30</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;">VG 40</td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Flash Point**(Cleveland open Cup)</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;">&deg;C</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;">52</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1448[P:69]</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Penetration @ 25&deg;C.100g.5s</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">(1/10)mm</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != null && $row_select_pipe['avg_pen'] != "0") {
																														echo number_format($row_select_pipe['avg_pen'], 0);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.80</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.60</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.47</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.35</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1203:1958 RA 2009</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Softening Point(R&B)</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">&deg;C</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != null && $row_select_pipe['avg_sof'] != "0") {
																														echo number_format($row_select_pipe['avg_sof'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.40&deg;C</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.45&deg;C</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.47&deg;C</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.50&deg;C</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1205:1978</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;  ">Absolute Viscosity @ 70&deg;C.30 cmHg</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">Poise</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_abs'] != "" && $row_select_pipe['avg_abs'] != null && $row_select_pipe['avg_abs'] != "0") {
																														echo number_format($row_select_pipe['avg_abs'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;">800-1200</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">1600-2400</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">2400-3600</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">3200-4800</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1206:1978(Part-2)</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Kinematic Viscosity @ 135&deg;C</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">cSt</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_kin'] != "" && $row_select_pipe['avg_kin'] != null && $row_select_pipe['avg_kin'] != "0") {
																														echo number_format($row_select_pipe['avg_kin'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.250</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.300</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.350</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.400</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1206:1978(Part-3)</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Ductility @ 25</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">cm</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != null && $row_select_pipe['avg_duc'] != "0") {
																														echo number_format($row_select_pipe['avg_duc'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.75</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.50</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.40</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.25</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1208:1978</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Specific Gravity</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">-</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_sp'] != "" && $row_select_pipe['avg_sp'] != null && $row_select_pipe['avg_sp'] != "0") {
																														echo number_format($row_select_pipe['avg_sp'], 2);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">-</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">-</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.0.99</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">-</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1202:1978</td>
					</tr>

				</table>

			</td>
		</tr>


		<tr>
			<td style="text-align:center;"><br>
				<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px;  ">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>