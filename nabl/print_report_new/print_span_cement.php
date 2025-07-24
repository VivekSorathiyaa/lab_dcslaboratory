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
				<td style="text-align:center; font-size:15px;padding-bottom:15px;text-decoration: underline; text-underline-offset: 3px;"><b>Chemical Properties of  Cement</b></td>
			</tr>

			<tr>
				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:14%;padding-bottom: 4px;">Discipline/Group</td>
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
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
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
							    <td style="width:14%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
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
							<td style="width:14%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:14%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:14%;padding-bottom:14px;">Agg No.</td>
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
						<td style="width:12%;padding-bottom: 5px;padding-top:14px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 5px;text-align: center;padding-top:14px;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 5px;padding-top:14px;"><?php echo $letter_no;?></td>
							<td></td>
						</tr>

						<tr>
						<td style="width:14%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:14%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;">OPC Cement * 53 Grade</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;">Test Completed</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:14%;padding-bottom: 4px;">Brand Name</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $cement_brand;?> </td>
							<td style="width:21%;padding-bottom: 4px;;">Requirement of Speciments</td>
							<td style="width:6%;padding-bottom: 4px;text-align: left;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;">I.S 269-2015</td>
						</tr>
						
						<tr>
							<td style="width:14%;padding-bottom: 5px;padding-bottom:4px;">Environment Condition</td>
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

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;
								<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								$result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; ?>
							</td>
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

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo "1 Bag " . $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Ref. No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $r_name; ?>&nbsp;&nbsp;<?php
																																											if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																																											?>Date: <?php echo date('d - m - Y', strtotime($row_select["date"]));
																																											} else {
																																											}
													?>
							</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
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
							<td style="border-left: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; Sidhee Ordinary Portland cement - 53 (<?php echo $row_select_pipe['type_of_cement']; ?>)</td>
							<td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp;&nbsp; Room Temp.(&deg;C)</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:18%;">&nbsp;&nbsp; <?php //echo $row_select_pipe['con_temp'];
																														?>25.1</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; 1 (By <?php if ($sample_sent_by == 1) {
																																					echo 'Agency';
																																				} else if ($sample_sent_by == 0) {
																																					echo 'Client';
																																				} ?>)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp;&nbsp; Relative Humidity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid;">&nbsp;&nbsp; <? php // echo $row_select_pipe['con_humidity'];
																																					?>65</td>
						</tr>

					</table><br>
				</td>
			</tr> -->


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:15px;">
						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;width:7%;">Sr. No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Praticular of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Specification Requirement (LS 269-2015) , Tabel-2, Clause:6.1</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Method of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Results</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Total Loss on Ignition(%) by Mass (LI)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 4%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px; ">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['ig4'], 2); ?></td>
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Total Sulphur Content Calculated as sulphuric Anhydride <br> (SO<sub>3</sub>), (%) by Mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 3.5%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px; padding:2px 4px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:2px 4px;"><?php if ($row_select_pipe['so4'] == "" && $row_select_pipe['so4'] == null && $row_select_pipe['so4'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['so4'], 2);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Insoluble Residue(%) by Mass (IR)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 5%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;padding:2px 4px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:2px 4px;"><?php if ($row_select_pipe['res4'] == "" && $row_select_pipe['res4'] == null && $row_select_pipe['res4'] == "0") {																												echo "-";
																																								} else {
																																									echo number_format($row_select_pipe['res4'], 2);
																																								} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;"> Magnesia (MGO), (%) by Mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 6%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;padding:2px 4px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:2px 4px;"><?php if ($row_select_pipe['mgo4'] == "" && $row_select_pipe['mgo4'] == null && $row_select_pipe['mgo4'] == "0") {
																																									echo "-";
																																								} else {
																																									echo number_format($row_select_pipe['mgo4'], 2);
																																								} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Chloride(%)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 0.1%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px; ">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['cl6'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:2px 4px;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Tri Calcium Aluminate (C<sub>3</sub>A) Content(%) </td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">Max 10%</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;">-</td>
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:2px 4px;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Alumina Oxide (Al<sub>2</sub>O<sub>3</sub>) , (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985 </td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['alo1'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Silica Oxide (SiO<sub>2</sub>) , (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985 </td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['sio7'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Iron Oxide Fe<sub>2</sub>O<sub>3</sub> (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['feo3'], 3); ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:2px 4px;">Calcium Oxide CaO (%) by mass</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:2px 4px;">-</td>
							<td style="border-left: 1px solid black;width:17%;border-top:1px solid;text-align:center;padding:2px 4px;padding-bottom:5px;padding-top:5px;">IS 4032-1985</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;padding:2px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['cao4'], 2); ?></td>
						</tr>
					</table>

				</td>
			</tr>
			
			<tr>
					<td>
						<table width="92%"  class="test" style="font-size:11px;font-family:Cambria;margin-left: 28px;margin-top:15px;">
							<tr>
								<td style="font-weight:bold;font-size:11px;">Interpretation **</td>
							</tr>
						</table>
					</td>
			</tr>
		
		    <?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:4px;">
					    
						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;width:7%;">Sr. No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">characteristic</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 10px;width:35%;">Specification Requirement (LS 269-2015) , Tabel-2, Clause:6.1</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Value</td>
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding-left:7px;padding:5px 4px;">Ratio of % of Line to percentage of Silica , Alumina and Iron Oxide <br>
						    CaO-(0.7xSO<sub>3</sub>)/(2.8xSiO<sub>2</sub>)+(1.2xAl<sub>2</sub>O<sub>3</sub>)+(0.65xFe<sub>2</sub>O<sub>3</sub>)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:5px 4px;">0.80 to 1.02</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:5px 4px;"><?php echo number_format($row_select_pipe['per1'], 2); ?></td>
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:45%;text-align:center;border-top:1px solid;padding:5px 4px;">Ratio of percentage of Alumina to That of Iron Oxide <br> (Al<sub>2</sub>O<sub>3</sub>/Fe<sub>2</sub>O<sub>3</sub>)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;padding:5px 4px;">Min 0.66</td>
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;font-weight:bold;padding:5px 4px;"><?php if ($row_select_pipe['alo1'] == "" && $row_select_pipe['alo1'] == null && $row_select_pipe['alo1'] == "0") {
																																										echo "-";
																																									} else {
																																										echo number_format(($row_select_pipe['alo1'] / $row_select_pipe['feo3']), 2);
																																									} ?>																													</td>
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