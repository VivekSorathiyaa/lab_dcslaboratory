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

			<br>
			<page size="A4">
				<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
					<tr>
						<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TESTING REPORT FOR CORE CUTTER BY SAND REPLACEMENT METHOD</u></b></td>
					</tr>
					<tr>
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
					</tr>


					<?php $cnt = 1; ?>
					<tr>
						<td style="text-align:left;font-size:12px; ">
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

								<tr style="">
									<td style="border-left: 1px solid black;border-top:1px solid;width:7%;font-weight:bold; text-align:center; ">SR.NO.</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%;text-align:center;font-weight:bold; ">ID OF <br>Sample</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%; text-align:center;font-weight:bold;">MDD</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%;text-align:center;font-weight:bold;">OMC</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:15.5%;text-align:center;font-weight:bold;padding-bottom:6px;padding-top:6px; ">WET <br>DENSITY OF <br>SOIL</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:13.5%;text-align:center;font-weight:bold;">MOISTURE CONTENT</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:13.5%;text-align:center;font-weight:bold;">DRY DENSITY<br> OF SOIL</td>
									<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%;text-align:center;font-weight:bold;">COMPACTION</td>
								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> - </td>
									<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid; ">-</td>
									<td style="border-left: 1px solid black;width:12.5%; text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;">gm/cc</td>
									<td style="border-left: 1px solid black;width:12.5%;text-align:center; border-top:1px solid;">%</td>
									<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;">gm/cc</td>
									<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;">%</td>
									<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;">gm/cc</td>
									<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;">%</td>
								</tr>
								<tr style="">
									<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
									<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-01</td>
									<td style="border-left: 1px solid black;width:12.5%; text-align:center;border-top:1px solid;" rowspan=8><?php echo $row_select_pipe['cal_mdd']; ?></td>
									<td style="border-left: 1px solid black;width:12.5%;text-align:center; border-top:1px solid;" rowspan=8>-</td>
									<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"><?php echo number_format($row_select_pipe['c6'], 2); ?></td>
									<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"><?php
																																	if ($row_select_pipe['d6'] != "") {

																																		echo $row_select_pipe['d6'];
																																	} else {
																																		echo $row_select_pipe['mc_od'];
																																	}
																																	?></td>
									<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"><?php echo number_format($row_select_pipe['d7'], 2); ?></td>
									<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"><?php echo $row_select_pipe['d8']; ?></td>
								</tr>
								<!--tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-02</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-03</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-04</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-05</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-06</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-07</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr>
						<tr style=""> 
							<td  style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
							<td  style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  " >A-08</td>
							<td  style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
							<td  style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
						</tr-->

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
			<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
				<tr>
					<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TESTING REPORT FOR CORE CUTTER BY SAND REPLACEMENT METHOD</u></b></td>
				</tr>
				<tr>
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
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 8</td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:1px;padding-top:1px;   ">&nbsp;&nbsp;Method Adopted</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS:2720(Part-28) - 1974</td>
							</tr>

						</table><br>

					</td>
				</tr>


				<?php $cnt = 1; ?>
				<tr>
					<td style="text-align:left;font-size:12px; ">
						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

							<tr style="">
								<td style="border-left: 1px solid black;border-top:1px solid;width:7%;font-weight:bold; text-align:center; ">SR.NO.</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%;text-align:center;font-weight:bold; ">ID OF <br>Sample</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%; text-align:center;font-weight:bold;">MDD</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%;text-align:center;font-weight:bold;">OMC</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:15.5%;text-align:center;font-weight:bold;padding-bottom:6px;padding-top:6px; ">WET <br>DENSITY OF <br>SOIL</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:13.5%;text-align:center;font-weight:bold;">MOISTURE CONTENT</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:13.5%;text-align:center;font-weight:bold;">DRY DENSITY<br> OF SOIL</td>
								<td style="border-left: 1px solid black;border-top:1px solid;width:12.5%;text-align:center;font-weight:bold;">COMPACTION</td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> - </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid; ">-</td>
								<td style="border-left: 1px solid black;width:12.5%; text-align:center;border-top:1px solid;padding-bottom:2px;padding-top:2px;">gm/cc</td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center; border-top:1px solid;">%</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;">gm/cc</td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;">%</td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;">gm/cc</td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;">%</td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-01</td>
								<td style="border-left: 1px solid black;width:12.5%; text-align:center;border-top:1px solid;" rowspan=8><?php echo $row_select_pipe['cal_mdd']; ?></td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center; border-top:1px solid;" rowspan=8>-</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"><?php echo number_format($row_select_pipe['c6'], 2); ?></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"><?php
																																if ($row_select_pipe['d6'] != "") {

																																	echo $row_select_pipe['d6'];
																																} else {
																																	echo $row_select_pipe['mc_od'];
																																}
																																?></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"><?php echo number_format($row_select_pipe['d7'], 2); ?></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"><?php echo $row_select_pipe['d8']; ?></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-02</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-03</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-04</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-05</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-06</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-07</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
								<td style="border-left: 1px solid black;width:12.5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">A-08</td>
								<td style="border-left: 1px solid black;width:15.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:13.5%;border-top:1px solid;text-align:center;"></td>
								<td style="border-left: 1px solid black;width:12.5%;border-top:1px solid;text-align:center;"></td>
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
















	<?php
	}
	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>