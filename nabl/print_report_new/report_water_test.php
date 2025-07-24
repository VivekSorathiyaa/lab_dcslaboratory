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
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
		  		<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Chemical Analysis of Water</b></td>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:43%;text-align:left;padding-bottom: 4px;">Chemical-Water</td>
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
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $r_name; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 14px 0;border-collapse: inherit;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
								<td style="width:12%;">Agg No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;"> <?php echo $agreement_no; ?></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:24%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Date of Sample <br>  Received</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Source of Sample</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;text-align:left;"><?php echo $source; ?></td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Sample Condition the Time of Receive</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $con_sample; ?></td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Water</td>
							<td style="width:21%;text-align:right;"></td>
							<td style="width:6%;text-align: center;"></td>
							<td style="width:40%;"></td>
						</tr>
						
					</table>
				</td>
			</tr>

			<!-- <tr>
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
			</tr> -->

			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:15px 0 7px;font-family: Cambria;">Test results of Water Sample :- Construction Purpose</td>
                            </tr>
                        </table>
                    </td>
                </tr>
		

			<?php $cnt = 1; ?>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">
						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Sr. NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Description</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Method</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">The Result</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Result <br>  Expressed With respect  <br> to I.S.456-2000</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Permission Limit As Per I.S.456-2000</td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Suspended Solids</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">I.S 3025-17</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"></td>
																												<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["phv_test_limit"] != null && $row_select_pipe["phv_test_limit"] != "" && $row_select_pipe["phv_test_limit"] != "0" && $row_select_pipe["phv_test_limit"] != "undefined") {
																															echo $row_select_pipe["phv_test_limit"];
																														} else { ?> Max. 2000 mg/l <?php } ?></td>
							
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">pH</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">I.S 3025-11</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgp'] != "" && $row_select_pipe['avgp'] != null && $row_select_pipe['avgp'] != "0") {
																																				echo $row_select_pipe['avgp'];
																																			} else {
																																				echo "-";
																																			} ?> </td>
																												<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["phv_test_limit"] != null && $row_select_pipe["phv_test_limit"] != "" && $row_select_pipe["phv_test_limit"] != "0" && $row_select_pipe["phv_test_limit"] != "undefined") {
																															echo $row_select_pipe["phv_test_limit"];
																														} else { ?> pH Shall be more than 6 <?php } ?></td>	
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Acidity (as CaCO<sub>3</sub>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">I.S 3025-22</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgn'] != "" && $row_select_pipe['avgn'] != null && $row_select_pipe['avgn'] != "0") {
																																				echo $row_select_pipe['avgn'];
																																			} else {
																																				echo "-";
																																			} ?></td>
																																			
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">ml for 100 ml</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["nao_test_limit"] != null && $row_select_pipe["nao_test_limit"] != "" && $row_select_pipe["nao_test_limit"] != "0" && $row_select_pipe["nao_test_limit"] != "undefined") {
																															echo $row_select_pipe["nao_test_limit"];
																														} else { ?>Max. 5.0 ml When Tested With 0.02N NaOH for 100ml sample <?php } ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px; ">Alkalinity (as CaCO<sub>3</sub>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">I.S 3025-23</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgh'] != "" && $row_select_pipe['avgh'] != null && $row_select_pipe['avgh'] != "0") {
																																				echo $row_select_pipe['avgh'];
																																			} else {
																																				echo "-";
																																			} ?></td>
																																			
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">ml for 100 ml</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["hso_test_limit"] != null && $row_select_pipe["hso_test_limit"] != "" && $row_select_pipe["hso_test_limit"] != "0" && $row_select_pipe["hso_test_limit"] != "undefined") {
																															echo $row_select_pipe["hso_test_limit"];
																														} else { ?>Max 25.0 mll When Tested With 0.02N H<sub>2</sub>SO<sub>4</sub> for 100ml Sample<?php } ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Chloride as CL</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">I.S 3025-32</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgch'] != "" && $row_select_pipe['avgch'] != null && $row_select_pipe['avgch'] != "0") {
																																				echo $row_select_pipe['avgch'];
																																			} else {
																																				echo "-";
																																			} ?></td>
																												<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["chl_test_limit"] != null && $row_select_pipe["chl_test_limit"] != "" && $row_select_pipe["chl_test_limit"] != "0" && $row_select_pipe["chl_test_limit"] != "undefined") {
																															echo $row_select_pipe["chl_test_limit"];
																														} else { ?>Max. 500 mg/l for RCC Work and 2000mg/l for PCC<?php } ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Sulphate (as SO<sub>3</sub>)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">I.S 3025-24</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgsu'] != "" && $row_select_pipe['avgsu'] != null && $row_select_pipe['avgsu'] != "0") {
																																				echo $row_select_pipe['avgsu'];
																																			} else {
																																				echo "-";
																																			} ?></td>
																												<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["sul_test_limit"] != null && $row_select_pipe["sul_test_limit"] != "" && $row_select_pipe["sul_test_limit"] != "0" && $row_select_pipe["sul_test_limit"] != "undefined") {
																															echo $row_select_pipe["sul_test_limit"];
																														} else { ?>Max. 500 mg/l<?php } ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Organic Solids</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 3025-18</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgor'] != "" && $row_select_pipe['avgor'] != null && $row_select_pipe['avgor'] != "0") {
																																				echo $row_select_pipe['avgor'];
																																			} else {
																																				echo "-";
																																			} ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["org_test_limit"] != null && $row_select_pipe["org_test_limit"] != "" && $row_select_pipe["org_test_limit"] != "0" && $row_select_pipe["org_test_limit"] != "undefined") {
																															echo $row_select_pipe["org_test_limit"];
																														} else { ?>Max. 200mg/l<?php } ?></td>
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Inorganic Solid</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 3025-18</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgin'] != "" && $row_select_pipe['avgin'] != null && $row_select_pipe['avgin'] != "0") {
																																				echo $row_select_pipe['avgin'];
																																			} else {
																																				echo "-";
																																			} ?></td>
																												
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["ino_test_limit"] != null && $row_select_pipe["ino_test_limit"] != "" && $row_select_pipe["ino_test_limit"] != "0" && $row_select_pipe["ino_test_limit"] != "undefined") {
																															echo $row_select_pipe["ino_test_limit"];
																														} else { ?>Max. 3000 mg/l<?php } ?></td>
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">Total Dissolved Solids</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">IS 3025-16</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe['avgtd'] != "" && $row_select_pipe['avgtd'] != null && $row_select_pipe['avgtd'] != "0") {
																																				echo $row_select_pipe['avgtd'];
																																			} else {
																																				echo "-";
																																			} ?></td>
																											    
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;">-</td>
							<td style="font-size:10px;text-align:left;border-left:1px solid black;border-top:1px solid black;padding:4px 4px;"><?php if ($row_select_pipe["tds_test_limit"] != null && $row_select_pipe["tds_test_limit"] != "" && $row_select_pipe["tds_test_limit"] != "0" && $row_select_pipe["tds_test_limit"] != "undefined") {
																															echo $row_select_pipe["tds_test_limit"];
																														} else { ?>-<?php } ?></td>
						</tr>
					</table>

				</td>
			</tr>



			<tr>
			    <td style="text-align:center;font-size:11px; ">
					<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
							<tr>
								<td style="width:60%;text-align:center;font-weight:bold;padding:3px 0;">
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

</body>

</html>

<script type="text/javascript">


</script>