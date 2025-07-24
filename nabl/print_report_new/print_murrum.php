<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40PX;
		-webkit-transform: scale(.68, .68);
		-moz-transform: scale(.58, .58);
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
	$tbl = $_GET['tbl_name'];
	$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$source = $row_select4['soil_source'];
		$soil_location = $row_select4['soil_location'];
	}
	$cnt = 1;

	?>

	<page size="A4">
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">

		    <tr>
				<td style="text-align:center; font-size:20px;padding-bottom:8px"><b>TEST REPORT OF <span style="text-transform:uppercase"><?php echo $mt_name; ?></span></b></td>
			</tr>
			 
		    <tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;border-bottom:1px solid;border-top:1px solid black;padding:10px 0;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;"><?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?></td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
						
					</tr>


					<tr style="">
					    <td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;"> 
						    Discipline/Group
						</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;padding-bottom: 4px;">Mechanical-soil & Rock</td>
						
					</tr>
					
					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:21%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">

					<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;">Name of Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

					<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Name of Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>

							<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agreement No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:40%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>

							<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Ref. No. & Date</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
						</tr>


						<tr>
							<td style="width:12%;padding-bottom: 4px;">letter No.</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:40%;padding-bottom: 4px;text-align:left;"></td>
						</tr>

						
						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Date of Starting</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>


						<tr>
						     <td style="width:12%;padding-bottom: 4px;">Type of Sample</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $soil_location; ?></td>
						    <td style="width:21%;padding-bottom: 4px;text-align:right;">Date of Completion</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>
						
						<?php
						}
						?>
					</table>
				</td>
			</tr>
 
			<!-- <tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border-bottom:1px solid black;">
						<tr>
							<td style="width:9%;padding-top:3px;padding-bottom:3px;"><b>&nbsp;&nbsp;Report No.</b></td>
							<td style="width:2%;font-family: Arial;font-weight:bold;"><b>:</b></td>
							<td style="width:15%"><?php echo $report_no; ?></td>
							<td style="width:9%;"><b>Report Date</b></td>
							<td style="width:2%;font-family: Arial;font-weight:bold;"><b>:</b></td>
							<td style="width:15%"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
							<?php
							if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "-" && strlen($row_select_pipe['ulr']) >= 5 && $row_select['nabl_type'] == "nabl") {
							?>
								<td style="width:7%;"><b>ULR No.</b></td>
								<td style="width:2%;font-family: Arial;font-weight:bold;"><b>:</b></td>
								<td style="width:15%"><?php echo $_GET['ulr']; ?></td>
							<?php
							} else {
							?>
								<td style="width:6%;"><b>&nbsp;</b></td>
								<td style="width:2%;font-family: Arial;font-weight:bold;"><b>&nbsp;</b></td>
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
								<td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
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
								<td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $agency_name; ?>
								</td>
							</tr>
						<?php
						}
						if ($row_select['tpi_name'] != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['tpi_or_auth']; ?></b></td>
								<td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['tpi_name']; ?>
								</td>
							</tr>
						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['pmc_heading']; ?></b></td>
								<td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['pmc_name']; ?>
								</td>
							</tr>

						<?php
						}
						if ($name_of_work != "") {
						?>

							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Work</b></td>
								<td style="width:3%;font-family: Arial;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $name_of_work; ?>
								</td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>

							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Agreement No.</b></td>
								<td style="width:3%;font-family: Arial;font-weight:bold;"><b>:</b></td>
								<td style="width:77%">&nbsp;&nbsp;<?php echo $agreement_no; ?>
								</td>
							</tr>
						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;<b>Reference</b></td>
								<td style="width:3%;font-family: Arial;font-weight:bold;"><b>:</b></td>
								<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																									?>Date: <?php echo date('d - m - Y', strtotime($row_select["date"]));
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
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;Mechanical &amp; Building Material</td>
							<td style="width:22%">&nbsp;</td>
							<td style="width:3%;font-family:Arial;font-weight:bold;"></td>
							<td style="width:22%">&nbsp;</td>

						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Description of Sample</b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;Murrum</td>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family: Arial;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Sample Type</b></td>
							<td style="width:3%;font-family: Arial;font-weight:bold;"><b>:</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $soil_location; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Source</b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b></b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family:Arial;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr> -->

			

			<tr>
				<!--OTHER START-->
			    <td>
					<table align="left" width="100%" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" rowspan=2>Lab No.</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" rowspan=2>Particulars</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;;" colspan=4>Grain Size Analysis %</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" colspan=3>Atterberg Limits %</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>I.S. Classifications</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" colspan=2>Modified</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Specific Gravity</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" colspan=2>Swelling Char.</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" colspan=3>Sher Parameter</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Shrinkage Limit %</td>									
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;writing-mode: tb-rl;transform: rotate(-180deg);" rowspan=2>Permeability</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;" colspan=1>C.B.R.</td>
						</tr>

						<tr>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Gravel</td>                                                                                                                    
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Sand</td>                                                                                                                      
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Silt</td>                                                                                                                      
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Clay</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">L.L.</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">P.L.</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">P.I.</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">MDD gm/cc</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">OMC %</td>                                                                                                                     
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Swell Pressure, <br> kg/cm<sup>2</sup></td>									
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Free Swell %</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Type</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">C<sup>"</sup> kg/cm<sup>2</sup></td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">&#8709; Deg.</td>
							<td style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;writing-mode: tb-rl;transform: rotate(-180deg);">Soaked (%)</td>
						</tr>	

						<tr>
						    <td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $lab_no; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['g1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['g2']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;" colspan=2><?php echo $row_select_pipe['g3']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['a1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['a2']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['a3']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['so1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['h1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['h2']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['sp1']; ?></td>									
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['sw1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['f1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['d1']; ?></td>									
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['d2']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['s1']; ?></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"></td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:10px 0;"><?php echo $row_select_pipe['cbr2']; ?></td>
						</tr>

						<tr>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=2>Test Method specification</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=4>IS 2720 part-4</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=3>Is 2720 Part-5</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 1498</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=2>IS 2720 Part-8</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 2720 Part-3</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 2720 Part-41</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 2720 Part-40</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=3>IS 2720 Part-11 & 13</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 2720 Part-6</td>									
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 2720 Part-17</td>
							<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;" colspan=1>IS 2720 Part-16</td>
						</tr>
					</table>
				</td>


			<!--OTHER START-->
				<!-- <td>
					<table align="left" width="100%" class="test" style="height:auto;width:100%; font-size:11px;">
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Sr.No.</b></td>
							<td colspan="2" style="border:1px solid black;border-left:0px solid black;width:35%;"><b>Test</b></td>

							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Unit</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Results</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:35%;"><b>Test Method Specification</b></td>


						</tr>
						<?php
						if ($row_select_pipe['g1'] != "" ||  $row_select_pipe['g1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Grain Size Analysis</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Gravel</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g1']; ?></td>
								<td rowspan="3" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-4)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Sand</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g2']; ?></td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Silt + Clay</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['g3']; ?></td>

							</tr>

						<?php
							$cnt++;
						}
						if ($row_select_pipe['a1'] != "" ||  $row_select_pipe['a1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Atterberg Limits</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Liquid Limit</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['a1']; ?></td>
								<td rowspan="3" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1980 (Part-5)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Plastic Limit</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['a2']; ?></td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Plasticity Index</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['a3']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['s1'] != "" ||  $row_select_pipe['s1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Shrinkage Limit</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['s1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-6)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['f1'] != "" ||  $row_select_pipe['f1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Free Swell Index</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['f1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1973 (Part-40)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['so1'] != "" ||  $row_select_pipe['so1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Soil Classifications</td>
								<td style="border:1px solid black;border-left:0px solid black;">--</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['so1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:1498, RA 2002</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['l1'] != "" ||  $row_select_pipe['l1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Light Compaction</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Maximum Dry Density</td>
								<td style="border:1px solid black;border-left:0px solid black;">gm/cc</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['l1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-7)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Optimum Moisture Content</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['l2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['h1'] != "" ||  $row_select_pipe['h1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Heavy Compaction</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Maximum Dry Density</td>
								<td style="border:1px solid black;border-left:0px solid black;">gm/cc</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['h1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-8)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Optimum Moisture Content</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['h2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['sp1'] != "" ||  $row_select_pipe['sp1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="3" style="border:1px solid black;border-left:0px solid black;text-align:left;">Specific Gravity</td>

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['sp1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1985 (Part-3)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['d1'] != "" ||  $row_select_pipe['d1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Direct Shear</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Cohesion ('C)</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['d1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-13)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Friction Angel(&empty;)</td>
								<td style="border:1px solid black;border-left:0px solid black;">Degree</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['d2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['c1'] != "" ||  $row_select_pipe['c1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Consolidation</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Cc</td>
								<td style="border:1px solid black;border-left:0px solid black;">--</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['c1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-15)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Pc</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['c2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['cbr1'] != "" ||  $row_select_pipe['cbr1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">CBR (Unsoaked)</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cbr1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1987 (Part-16)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['cbr2'] != "" ||  $row_select_pipe['cbr2'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">CBR (Soaked)</td>
								<td style="border:1px solid black;border-left:0px solid black;">%</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['cbr2']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1987 (Part-16)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['t1'] != "" ||  $row_select_pipe['t1'] != null) {
						?>
							<tr style="text-align:center;">

								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td rowspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Triaxial (UU)</td>
								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Cohesion ('C)</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['t1']; ?></td>
								<td rowspan="2" style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1986 (Part-11)</td>

							</tr>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;text-align:left;">Friction Angel (&empty;)</td>
								<td style="border:1px solid black;border-left:0px solid black;">Degree</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['t2']; ?></td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['r1'] != "" ||  $row_select_pipe['r1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Relative Density</td>
								<td style="border:1px solid black;border-left:0px solid black;">gm/cc</td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['r1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1983 (Part-14)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['u1'] != "" ||  $row_select_pipe['u1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Unconfined Compressive Strength (UCS)</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['u1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1980 (Part-10)</td>

							</tr>
						<?php
							$cnt++;
						}
						if ($row_select_pipe['sw1'] != "" ||  $row_select_pipe['sw1'] != null) {
						?>
							<tr style="text-align:center;">

								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $cnt; ?></td>
								<td colspan="2" style="border:1px solid black;border-left:0px solid black;text-align:left;">Swelling Pressure</td>
								<td style="border:1px solid black;border-left:0px solid black;">kg/cm<sup>2</sup></td>
								<td style="border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['sw1']; ?></td>
								<td style="border:1px solid black;border-right:0px solid black;">IS:2720 - 1977 (Part-41)</td>

							</tr>
						<?php

						}

						?>


					</table>

				</td> -->
			</tr>
		</table>



		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
						<tr>
							<td style="width:60%;text-align:center;font-weight:bold;padding:20px 0 7px;">
									** End of Report ** 
							</td>																		
						</tr>
		</table>

	    <table align="center" width="100%" class="test">
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

		<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
							</td>
						</tr>
		</table>
	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>