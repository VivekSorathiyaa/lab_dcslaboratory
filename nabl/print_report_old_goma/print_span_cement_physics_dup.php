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
	$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$tpi_or_auth = $row_select['tpi_or_auth'];
	$pmc_heading = $row_select['pmc_heading'];
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
		$source = $row_select4['fine_agg_source'];
		$material_location = $row_select4['material_location'];
	}


	?>



	<br>
	<br>
	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT OF CEMENT</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;
								<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								$result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; ?>
							</td>
							<td style="border-left: 1px solid black;width:15%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:20%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo "1 Bag " . $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Tender No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; W/623/4672/22-23</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Material under Testing</td>
							<td style="border-left: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; Hi - Bond Ordinary Portland Cement - 53 ( <?php echo $row_select_pipe['type_of_cement']; ?> )</td>
							<td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp;&nbsp; Room Temp.(&deg;C)</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:18%;">&nbsp;&nbsp; <?php echo $row_select_pipe['con_temp']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; 1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp;&nbsp; Relative Humidity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['con_humidity']; ?></td>
						</tr>




					</table><br>

				</td>
			</tr>






			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr>
							<td style="text-align:left; font-size:20px; " colspan="6"><b>PHYSICAL PROPERTIES:</b></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:3%;font-weight:bold; text-align:center; ">Sr.<br>NO.</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:45%;text-align:left;font-weight:bold; " colspan=2>&nbsp;&nbsp;Test Description</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%; text-align:center;font-weight:bold;">Test Results</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:22%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;  ">Test Requirements<br>(IS:269-2015) RA 2020</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%;text-align:center;font-weight:bold;">Test Method</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid; " colspan=2><b>&nbsp;&nbsp;Standard Consistency</b> ( in percentage)</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php echo number_format($row_select_pipe['final_consistency'], 1); ?></td>
							<td style="border-left: 1px solid black;width:22%;border-top:1px solid;text-align:center;">-</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS:4031:1988 <br>(part-4) RA 2019</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;" rowspan=3> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid;padding-bottom:3px;padding-top:3px; " colspan=2><b>&nbsp;&nbsp;Setting Time</b></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;">-</td>
							<td style="border-left: 1px solid black;width:22%;border-top:1px solid;text-align:center;">-</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;" rowspan=3>IS:4031:1988 <br> (part-5) RA 2219</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid;padding-bottom:5px;padding-top:3px; " colspan=2>&nbsp;&nbsp;a. Initial Setting Time (in minutes)</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['initial_time'] == "" && $row_select_pipe['initial_time'] == null && $row_select_pipe['initial_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['initial_time']);
																																			} ?></td>
							<td style="border-left: 1px solid black;width:22%;border-top:1px solid;text-align:center;">Min.30 minutes</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid;padding-bottom:3px;padding-top:3px; " colspan=2>&nbsp;&nbsp;a. Final Setting Time (in minutes)</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['final_time'] == "" && $row_select_pipe['final_time'] == null && $row_select_pipe['final_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['final_time']);
																																			} ?></td>
							<td style="border-left: 1px solid black;width:22%;border-top:1px solid;text-align:center;">Min.600 minutes</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;" rowspan=4> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid;padding-bottom:3px;padding-top:3px; " colspan=2><b>&nbsp;&nbsp; Compressive Strength (N/mm<sup>2</sup>)</b></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;">-</td>
							<td style="border-left: 1px solid black;width:22%;border-top:1px solid;text-align:center;">-</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;" rowspan=4>IS:4031:1988 <br> (part-6) RA 2019</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22.5%;text-align:left;border-top:1px solid;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; a. After 3 Days</td>
							<td style="border-left: 1px solid black;width:22.5%;text-align:center;border-top:1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_1'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">Min.27 N/mm<sup>2</sup></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22.5%;text-align:left;border-top:1px solid;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; a. After 7 Days</td>
							<td style="border-left: 1px solid black;width:22.5%;text-align:center;border-top:1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($row_select_pipe['test_date2'])); ?></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != null && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_2'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">Min.37 N/mm<sup>2</sup></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:22.5%;text-align:left;border-top:1px solid;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; a. After 28 Days</td>
							<td style="border-left: 1px solid black;width:22.5%;text-align:center;border-top:1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($row_select_pipe['test_date3'])); ?></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != null && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_3'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">Min.53 N/mm<sup>2</sup></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid; " colspan=2><b>&nbsp;&nbsp; Soundness by Le Chateliar(mm)</b></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['soundness'] == "" && $row_select_pipe['soundness'] == null && $row_select_pipe['soundness'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['soundness'], 1);
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">Max. 10 mm</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS:4031:1988 <br> (part 3) RA 2019</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid; " colspan=2><b>&nbsp;&nbsp; Fineness By Blain Air Permeability (m<sup>2</sup>/Kg)</b></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['ss_area'] == "" && $row_select_pipe['ss_area'] == null && $row_select_pipe['ss_area'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['ss_area'], 0);
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">Min. 225(m<sup>2</sup>/Kg)</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS:4031:1999 <br> (part 2) RA 2018</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid; " colspan=2><b>&nbsp;&nbsp; Density (gm/cm<sup>2</sup>)</b></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;">3.10</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">-</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS:4031:1999 <br> (part 11) RA 2019</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:left;border-top:1px solid; " colspan=2><b>&nbsp;&nbsp; Fineness by Dry Sieving(%)</b></td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;"><?php if ($row_select_pipe['avg_fbs'] == "" && $row_select_pipe['avg_fbs'] == null && $row_select_pipe['avg_fbs'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_fbs'], 2);
																																			} ?></td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">-</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS:4031:1996<br> (part 1) RA 2021</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">
					<br>
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
							<td><b> > &nbsp;</b>Starting Date of Testing: <?php echo date('d - m - Y', strtotime($start_date)); ?></td>

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