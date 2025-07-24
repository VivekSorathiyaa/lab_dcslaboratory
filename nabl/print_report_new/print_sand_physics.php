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
	$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	}
	?>



<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
    <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Cambria;margin-top:80px;border-bottom:0px solid black;">
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Mechanical Properties of Fine Aggregate</b></td>
			</tr>

		
			<tr>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
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
							    <td style="width:12%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
								<td style="width:12%;padding-bottom:14px;">Agg No.</td>
								<td style="width:6%;padding-bottom: 14px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"> <?php echo $agreement_no; ?></td>
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
							<td style="width:12%;padding-bottom: 4px;padding-top:14px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top:14px;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;padding-top:14px;"></td>
							<td style="width:21%;padding-bottom: 4px;padding-top:14px;">Sample Source</td>
							<td style="width:6%;padding-bottom: 4px;padding-top:14px;;text-align: left;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;padding-top:14px;"><?php echo $source; ?></td>
						</tr>

						<!-- <tr>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family: Cambria;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr> -->

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
							<td style="width:40%"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>

						    <td style="width:12%;padding-bottom: 14px;">Material Received</td>
							<td style="width:6%;padding-bottom:14px;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 14px;">Fine Aggregate/ sand</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 14px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 14px;">Test Completed</td>
							<td style="width:6%;padding-bottom: 14px;text-align: left;"> &raquo;</td>
							<td style="width:40%;padding-bottom:14px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>
						

						<!-- <?php
						if ($type != "" && $type != null && $type != "0") {
						?>
							<tr>
								<td style="width:12%;padding-top:3px;">&nbsp;&nbsp;<b>Description of Sample</b></td>
								<td style="width:3%;font-family:Cambria;font-weight:bold;">:</td>
								<td style="width:40%"><?php echo $type; ?></td>
								<td style="width:22%"><b></b></td>
								<td style="width:3%;font-family:Cambria;font-weight:bold;"></td>
								<td style="width:14%">&nbsp;&nbsp;</td>
							</tr>
						<?php
						}
						if ($source != "" && $source != null && $source != "0") {
						?>
							<tr>
								<td style="width:12%;padding-top:3px;">&nbsp;&nbsp;<b>Sample Source</b></td>
								<td style="width:3%;font-family:Cambria;font-weight:bold;">:</td>
								<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
								<td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
								<td style="width:3%;font-family:Cambria;font-weight:bold;"></td>
								<td style="width:14%">&nbsp;&nbsp;</td>
							</tr>
						<?php
						}
						?> -->

					</table>
				</td>
			</tr>
		
<!-- 
			<tr>
					<td style="text-align:center;font-size:11px;">
						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

							<tr style="">
								<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>

								<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																													$result_selectc = mysqli_query($conn, $select_queryc);

																													if (mysqli_num_rows($result_selectc) > 0) {
																														$row_selectc = mysqli_fetch_assoc($result_selectc);
																														$ct_nm = $row_selectc['city_name'];
																													}
																													echo $clientname; ?></td>
								<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
								<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
							</tr>


							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
							</tr>
							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name of EPC</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
							</tr>

							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; PMC</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
							</tr>



							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
				        </tr>
			          </table>
					<br>
					</td>
		    </tr> -->
			

			<!-- <tr>
					<td style="text-align:center;font-size:11px; ">
						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">
							<tr style="">
								<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:center;padding-bottom:2px;padding-top:2px; ">Material Source</td>
								<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $source; ?></td>

							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Sample Description</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $mt_name; ?></td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center; padding-bottom:2px;padding-top:2px; ">No.of Sample</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 1 NOS</td>
							</tr>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Test Method Adopted</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS-2386:1963 RA 2016 (Part-I,Part-II,Part-IV)</td>
							</tr>

						</table><br>
					</td>
			</tr> -->

			

				
		<?php $cnt = 1; ?>
			<!-- <tr>
				<td style="text-align:center;font-size:12px; ">
					<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:7%;font-weight:bold;text-align:center; "> Sr.No</td>
							<td style="border-left: 1px solid black;width:42%;text-align:center;font-weight:bold; ">Test</td>
							<td style="border-left: 1px solid black;width:15%; font-weight:bold;text-align:center;">Result</td>
							<td style="border-left: 1px solid black;width:36%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; " colspan=4>Requirement as per
								<br> IS:383-2016
							</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; "> specifik grasvity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {

																																					echo $row_select_pipe['sp_specific_gravity'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:center; " colspan=4>2.1-3.2</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">Water absorption(%)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {
																																					echo number_format($row_select_pipe['sp_water_abr'], 2);
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:center; " colspan=4>Max. 5%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center;font-weight:bold; ">Gradation Percent Passing on IS Sieve</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;">% Passing</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">ZONE-I</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">ZONE-II</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">ZONE-III</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">ZONE-IV</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; ">i</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">10 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_1'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; ">ii</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">4.75 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_2'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center; padding-bottom:5px;padding-top:5px;">iii</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">2.36 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_3'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; ">iv</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">1.18 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_4'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; ">v</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">0.600 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_5'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; ">vi</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">0.300 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_6'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; ">vii</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">0.150 mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php echo number_format($row_select_pipe['pass_sample_7'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center;font-weight:bold; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:9%;text-align:center; ">100</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">Bulk Density Loose</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
																			echo number_format($row_select_pipe['bdl'], 2);
																									} else {
																			echo "-";
																						} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:center; " rowspan=4 colspan=4>--</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">Conforming Zone</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php if ($row_select_pipe['grd_zone'] != "" && $row_select_pipe['grd_zone'] != null && $row_select_pipe['grd_zone'] != "0") {
																																					echo $row_select_pipe['grd_zone'];
																																				} else {
																																					echo "-";
																																				} ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">F.M</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php if ($row_select_pipe['grd_fm'] != "" && $row_select_pipe['grd_fm'] != null && $row_select_pipe['grd_fm'] != "0") {
																																					echo number_format($row_select_pipe['grd_fm'], 2);
																																				} else {
																																					echo "-";
																																				} ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:7%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:center; ">Meterial Finer Than 75 micron Sieve</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%; font-weight:bold;text-align:center;"><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
																																					echo number_format($row_select_pipe['avg_finer'], 2);
																																				} else {
																																					echo "-";
																																				} ?></td>
						</tr>

					</table>
				</td>

			</tr> -->
			
			<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0") { ?>
				<tr>
					<td>
						<table align="center" width="92%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family: Cambria;margin-top:20px;margin-bottom:4px;font-weight:bold;">
							<tr>
								<td>A) Sieves Analysis (IS:2386-1-1963)</td>
							</tr>
						</table>
					</td>
					<!--<td style="font-size:10px;padding-top:3px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Sample Taken&nbsp;&nbsp;&nbsp;</b><? php // echo $row_select_pipe['sample_taken'];																											?><b>&nbsp;&nbsp;gm</b></td>-->
				</tr>


				<tr>
					<!--OTHER START-->
					<td>
						<table align="center" width="92%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;margin-bottom:20px;max-width:540px;margin-left:35px;border:1px solid;">
							<tr style="text-align:center;">
								<td rowspan="4" style="border:1px solid black;border-left:0px solid black;width:15%;padding:2px 0;font-size:11px;"><b>Sieve Size<br>in mm</b></td>
								<td colspan="2" style="border:1px solid black;border-right:0px solid black;width:55%;padding:2px 0;font-size:11px;"><b>Test Results</b></td>
								<td colspan="4" style="border:1px solid black;border-right:0px solid black;width:55%;padding:2px 0;font-size:11px;"><b>Req. % passing as Per IS 383:2016, Tabel-9</b></td>
							</tr>

							<tr>
							    <td rowspan="3" style="border:1px solid black;border-left:0px solid black;width:15%;text-align:center;padding:2px 3px;font-size:11px;"><b>Cum. % mass<br>retained</b></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;width:15%;text-align:center;padding:2px 0;font-size:11px;"><b>% of passing</b></td>
							</tr>

							<tr style="text-align:center;border:1px solid black;font-size:11px;">
								<td colspan="4" style="padding:2px 0;"><b>Grading</b></td>
							</tr>

							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;font-size:11px;"><b>Zone I</b></td>
								<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;font-size:11px;"><b>Zone II</b></td>
								<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;font-size:11px;"><b>Zone III</b></td>
								<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;font-size:11px;"><b>Zone IV</b></td>
							</tr>

							<?php
							if ($row_select_pipe['sieve_1'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">10.0</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_1'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_1'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">100</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">100</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">100</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_2'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">4.75</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_2'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_2'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">90-100</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">90-100</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">90-100</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">95-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_3'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">2.36</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_3'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_3'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">60-95</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">75-100</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">85-100</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">95-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_4'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">1.18</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_4'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_4'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">30-70</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">55-90</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">75-100</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">90-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_5'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">0.600</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_5'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_5'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">15-34</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">35-59</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">60-79</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">80-100</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_6'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">0.300</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_6'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_6'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">5-20</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">8-30</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">12-40</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">15-50</td>
								</tr>
							<?php
							}
							if ($row_select_pipe['sieve_7'] != "") {
							?>
								<tr style="text-align:center;">
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">0.150</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;"><?php echo number_format($row_select_pipe['cum_ret_7'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;font-weight:bold;padding:2px 0;font-size:11px;"><?php echo number_format($row_select_pipe['pass_sample_7'], 2); ?></td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">0-10</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">0-10</td>
									<td style="border:1px solid black;border-left:0px solid black;padding:2px 0;">0-10</td>
									<td style="border:1px solid black;border-right:0px solid black;padding:2px 0;">0-15</td>
								</tr>
							<?php
							}
							?>
						</table>
					</td>
				</tr>


				<tr>
					<td>
						<table align="center" width="92%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;">
							<tr>
								<td style="padding-bottom:4px;font-weight:bold;">B) Other Tests</td>
							</tr>
						</table>
					</td>
				</tr>
			<?php } ?>
			

			<?php
			if (($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0")) {

			?>
				
				<tr>
					<td>
						<table align="center" width="92%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid; margin-bottom:20px;max-width:450px;margin-left:31px;">
							<tr style="text-align:center;">
								<td style="border:1px solid black;border-left:1px solid black;padding:3px 0;font-size:11px;"><b>Item No.</b></td>
								<td style="border:1px solid black;border-left:1px solid black;padding:2px 0;font-size:11px;"><b>Test Name</b></td>
								<td style="border:1px solid black;border-left:1px solid black;padding:2px 0;font-size:11px;"><b>Test Results</b></td>
								<td style="border:1px solid black;border-left:1px solid black;padding:2px 0;font-size:11px;"><b>Test Method</b></td>
							</tr>


							<?php
							$cnt = 0;
							}
							if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $cnt;
																															?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">Zone Classification</td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
																															echo number_format($row_select_pipe['avg_finer'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td rowspan="2" style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">IS: 2386-1-1963</td>																					
								</tr>



							<?php
							}
							if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $cnt;
																															?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">Material Finer Then 75 Micron (%)</td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php if ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != null && $row_select_pipe['avg_finer'] != "0") {
																															echo number_format($row_select_pipe['avg_finer'], 2);
																														} else {
																															echo "-";
																														} ?></td>
								</tr>

							<?php
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
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php $cnt++;
																															echo $cnt;
																															?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">Water Absorption (%)</td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != null && $row_select_pipe['sp_water_abr'] != "0") {
																															echo number_format($row_select_pipe['sp_water_abr'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td rowspan="3" style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">IS: 2386-3-1963</td>																					
								</tr>
							<?php
							}
							if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $cnt;
																															?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">Specific Gravity</td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != null && $row_select_pipe['sp_specific_gravity'] != "0") {

																															echo $row_select_pipe['sp_specific_gravity'];
																														} else {
																															echo "-";
																														} ?></td>
								</tr>
							<?php
							}
							if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $cnt;
																															?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">Bulk Density (kg/lit)</td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != null && $row_select_pipe['bdl'] != "0") {
																															echo number_format($row_select_pipe['bdl'], 2);
																														} else {
																															echo "-";
																														} ?></td>
																														
								</tr>
							<?php

							}
							if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
								$cnt++;
							?>
								<tr>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $cnt;
																															?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">Soundness by Sodium Sulphate %</td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != null && $row_select_pipe['soundness'] != "0") {
																															echo number_format($row_select_pipe['soundness'], 2);
																														} else {
																															echo "-";
																														} ?></td>
									<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">IS: 2386-5-1963</td>																					
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
			) 
			?>



			<tr>
				<table cellpadding="0" cellpadding="0" align="center" width="92%" style="font-size:11px;font-family: Cambria;" class="test">
					<tr>
						<td style="width:60%;text-align:center;font-weight:bold;padding:3px 0;">
								** End of Report ** 
						</td>																		
					</tr>
				</table>
			</tr>

			<tr>
					<td style="text-align:center;font-size:10px;">
						<table align="center" width="92%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
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