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

	$get_refno=$row_select["refno"];

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
		$cement_brand = $row_select4['cement_brand'];
	}
	?>



	
	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-left:35px;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px;text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px;text-decoration: underline; text-underline-offset: 3px;"><b>Physical Properties of  Cement</b></td>
			</tr>


			<tr>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Chemical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;">&nbsp;&nbsp; 
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR- " . $row_select_pipe['ulr'];  
															} ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
						<td style="width:0%;padding-bottom: 4px;">&nbsp;&nbsp; Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $get_refno;?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="92%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;font-size: 11px;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
							<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;font-size: 11px;padding-bottom:14px;">Agg No.</td>
								<td style="width:6%;padding-bottom: 14px;text-align: center;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 14px;"> <?php echo $agreement_no; ?></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="92%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 14px 0;">
					    <tr>
							<td style="width:12%;padding-bottom: 5px;padding-top:14px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 5px;text-align: center;padding-top:14px;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 5px;padding-top:14px;"></td>
							<td style="width:21%;padding-bottom: 4px;padding-top:14px;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;padding-top:14px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;padding-top:14px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;">Test Completed</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;">OPC Cement * 53 Grade</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:12%;padding-bottom: 4px;">Brand Name</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo; </td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $cement_brand;?> </td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 5px;padding-bottom:4px;">Environment Condition</td>
							<td style="width:6%;padding-bottom: 5px;text-align: center;padding-bottom:4px;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom:4px;"><?php echo $con_sample;?></td>
							<td></td>
						</tr>

					</table>
				</td>
			</tr>


			<!-- <tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;
								<?php //$select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								/* $result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; */ ?>
							</td>
							<td style="border-left: 1px solid black;width:15%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:20%;">&nbsp;&nbsp; <?php //echo $agreement_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php //echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;border-right: 1px solid;">&nbsp;&nbsp; <?php// echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php //echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php// echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php //echo "1 Bag " . $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Tender No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; W/623/4672/22-23</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php //echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php //echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php //echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Material under Testing</td>
							<td style="border-left: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; Hi - Bond Ordinary Portland Cement - 53 ( <?php// echo $row_select_pipe['type_of_cement']; ?> )</td>
							<td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp;&nbsp; Room Temp.(&deg;C)</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:18%;">&nbsp;&nbsp; <?php// echo $row_select_pipe['con_temp']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; 1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp;&nbsp; Relative Humidity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid;">&nbsp;&nbsp; <?php //echo $row_select_pipe['con_humidity']; ?></td>
						</tr>

					</table><br>

				</td>
			</tr> -->



			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px;">
					<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;margin-bottom:20px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;">Sr. No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:30%;" colspan=2>Particular of Test</td>
							
							<td style="border-top:1px solid;border-left: 1px solid black;width:37%;">
										<table style="width:100%;border-collapse: collapse;">
							   				<tr>
											     <td style="font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;" colspan=5>Specification Requirement (IS 269: 2015)</td>
											</tr>
											<tr>
												<td style="border-top:1px solid;font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;">OPC-33 Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-43 Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-53 Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-43S Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-53S Grade</td>
											</tr>
										</table>
						    </td>

							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Method of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Results</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Setting Time</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Initial Setting Time (Minute)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;">Min. 30 minute</td>
											<td style="font-size:10px;text-align:center;padding:5px 4px">Min. 60 minute</td>
											</tr>
										</table>
							</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=2>IS 4031 (P-5) 1988 </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['initial_time'] == "" && $row_select_pipe['initial_time'] == null && $row_select_pipe['initial_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['initial_time']);
																																			} ?></td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Final Setting Time (minutes)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;">Max. 600 minute</td>
											<td style="font-size:10px;text-align:center;padding:5px 4px">Max. 600 minute</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['final_time'] == "" && $row_select_pipe['final_time'] == null && $row_select_pipe['final_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['final_time']);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?> </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Soundness, Le-Chatelier (mm)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="font-size:10px;text-align:center;padding:5px 0px;">Max. Expansion 10 mm</td>
											<td style="border-left:1px solid black;font-size:10px;text-align:center;padding:5px 3px">Max. Expansion 5 mm</td>
											</tr>
										</table>
							</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-3) 1988</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['soundness'] == "" && $row_select_pipe['soundness'] == null && $row_select_pipe['soundness'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['soundness'], 1);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness By Blain Air Permeability (m<sup>2</sup>/Kg)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;">Min. 225 m<sup>2</sup>/Kg</td>
											<td style="font-size:10px;text-align:center;padding:5px 4px">Min. 370 m<sup>2</sup>/Kg</td>
											</tr>
										</table>
							</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS 4031 (P-2) 1999 </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['ss_area'] == "" && $row_select_pipe['ss_area'] == null && $row_select_pipe['ss_area'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['ss_area'], 0);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Density (gm/cc)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="font-size:10px;text-align:center;padding:5px 4px">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-11) 1988</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">3.10</td>
						</tr>



						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Consistency (%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="font-size:10px;text-align:center;padding:5px 4px;">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-4) 1988</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['final_consistency'], 1); ?></td>
						</tr>

						
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness by Dry Sieving(%)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="font-size:10px;text-align:center;padding:5px 4px">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-1)  1996</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_fbs'] == "" && $row_select_pipe['avg_fbs'] == null && $row_select_pipe['avg_fbs'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_fbs'], 2);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2><b>Compressive Strength (Mpa)</b></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"  colspan=2>72 &plusmn; 1 hr. (Mpa) Minimum</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">16 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">23 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">27 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">23 Mpa</td>
												<td style="font-size:10px;text-align:center;padding:5px 4px;width:20%;">27 Mpa</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=3>IS 4031 (P-6) 1988</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_1'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 168 &plusmn; 2 hr. (Mpa) Minimum</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
										<tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">22 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">33 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">37 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">37.5 Mpa</td>
												<td style="font-size:10px;text-align:center;padding:5px 4px;width:20%;">37.5 Mpa</td>
											</tr>
										</table>
						   </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != null && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != "NaN") {	echo number_format($row_select_pipe['avg_com_2'], 1); } else {	echo "-";} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">c</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 672 &plusmn; 4 hr. (Mpa) Minimum </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
						      			<table style="width:100%;border-collapse: collapse;">
										  <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">33 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">43 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">53 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">43 Mpa</td>
												<td style="font-size:10px;text-align:center;padding:5px 4px;width:20%;">53 Mpa</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != null && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != "NaN") { echo number_format($row_select_pipe['avg_com_3'], 1); } else {echo "-";} ?></td>
							
						</tr>


						<tr style="">
						    <td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:10px;text-align:right;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> max. </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
						      			<table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">48 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">58 Mpa</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">-</td>
												<td style="border-right:1px solid black;font-size:10px;text-align:center;padding:5px 4px;width:20%;">-</td>
												<td style="font-size:10px;text-align:center;padding:5px 4px;width:20%;">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>



					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">
					<table cellpadding="0" cellpadding="0" align="center" width="92%" style="font-size:11px;font-family: Cambria;" class="test">
							<tr>
								<td style="width:60%;text-align:center;font-weight:bold;padding:3px 0;">
										** End of Report ** 
								</td>																		
							</tr>
					</table>
				</td>
			</tr>


		<tr>
			<table align="center" width="92%" class="test">
						<tr>
							<td style="text-align:center;font-size:10px;">
								<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
									<tr>
										<td><b>Note :-</b></td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
										<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
										<td></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
										<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
									</tr>
									<tr>
										<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
										<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
									</tr>
								</table>
							</td>
						</tr>
			</table>
		</tr>

	</table>


		<table width="92%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
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