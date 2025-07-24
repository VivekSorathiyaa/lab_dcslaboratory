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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from bitumin_span_mix WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		//$source= $row_select4['fine_agg_source'];
		$material_location = $row_select4['material_location'];
		$bit_mix = $row_select4['bit_mix'];
	}


	?>


	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:50px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Properties of Bituminous Mix</b></td>
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
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"><?php echo $r_name; ?></td>
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
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Date of Casting</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Grade of Sample</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $grade_data; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Specification Requirement</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;">As per MoRTH</td>
						</tr>

						<tr>
						    <td style="width:12%;">Test Method</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;">IRC SP 112 : 2017  ,  ASTM D 2726</td>
							<td style="width:21%;text-align:right;">Sample Collection Dt.</td>
							<td style="width:6%;text-align: center;"> &raquo;</td>
							<td style="width:40%;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						
					</table>
				</td>
			</tr>
			
			<!-- <tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Authority</td>
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

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Consultant</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select['pmc_name']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Contractor</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Received Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:5px;padding-top:5px;  ">&nbsp;&nbsp; Description of Sample</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; <?php echo $mt_name; ?></td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:4px;padding-top:4px;padding-bottom:3px;padding-top:3px;    ">&nbsp;&nbsp; Material Source</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; By <?php if ($sample_sent_by == 1) {
																																					echo 'Agency';
																																				} else if ($sample_sent_by == 0) {
																																					echo 'Client';
																																				} ?><?php echo $source; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:4px;padding-top:4px;padding-bottom:3px;padding-top:3px;    ">&nbsp;&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 01/03 to 03/03</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:4px;padding-top:4px;padding-bottom:3px;padding-top:3px;    ">&nbsp;&nbsp; Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IRC SP 11:1984,ASTM D 6927</td>
						</tr>

					</table>

				</td>
			</tr> -->

        <!-- test report 1 -->
			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:7px 0 7px;font-family:Cambria;">(A) Test Results  = DBM Mix Material</td>
                            </tr>
                        </table>
                    </td>
            </tr>
			<?php $cnt = 1; ?>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">SR.<BR>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Location/Chainage/ID*</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Binder Content By Weight of Mix %</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Binder Content By Weight of Agg %</td>
						</tr>
						
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  ">M-01</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  "><?php echo $row_select_pipe['per_mix1']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  "><?php echo $row_select_pipe['per_agg1']; ?></td>																														
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">M-02</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  "><?php echo $row_select_pipe['per_mix2']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  "><?php echo $row_select_pipe['per_agg2']; ?></td>																														
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  ">M-03</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  "><?php echo $row_select_pipe['per_mix3']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;  "><?php echo $row_select_pipe['per_agg3']; ?></td>																														
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Average :</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_bin']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_agg']; ?></td>																												
						</tr>
					</table>
				</td>
			</tr>

		<!-- test report 2 -->
			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:7px 0 7px;font-family:Cambria;">(A) Test Results = DBM-II</td>
                            </tr>
                        </table>
                    </td>
            </tr>
			<?php $cnt = 1; ?>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

					    <tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Method</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">ASTM <br> D 6927-15</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">ASTM <br> D 6927-15</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">ASTM <br> D 2726-21</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">ASTM D 2041-19</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">IRC SP 112 : 2017</td>
						</tr>

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">SR.<BR>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Stability (kg)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Flow (mm)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Density (g/cc)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Theoretical Maximum Specific Gravity (Gmm) at 25&#8451;</td>
							<td style="border-left:1px solid black;border-top:1px solid black;">
								<table style="width:100%;border-collapse: collapse;">
									<tr>
										<td style="font-size:10px;text-align:center;border-bottom:0px solid black;padding:5px 4px;font-weight:bold;">Binder Content</td>
									</tr>
									<tr style="">
										<td style="font-size:10px;text-align:center;border-top:1px solid black;padding:5px 4px;font-weight:bold;">By Weight of Mix %</td>
									</tr>
								</table>
							</td>
						</tr>
						
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ms_21']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ms_31']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['e1']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['sp_1']; ?></td>	
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" rowspan=4><?php echo $row_select_pipe['avg_bin']; ?></td>																													
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ms_22']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ms_33']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['e2']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['sp_2']; ?></td>																													
						</tr>


						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ms_23']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ms_33']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['e3']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['sp_3']; ?></td>																													
						</tr>

						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">Average</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_stabilty']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_flow']; ?></td>																												
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_density']; ?></td>						
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_sp']; ?></td>												
						</tr>
					</table>
				</td>
			</tr>

		<!-- test report 3 -->																																		
			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:7px 0 7px;font-family:Cambria;">(A) Core Density :</td>
                            </tr>
                        </table>
                    </td>
            </tr>
			<?php $cnt = 1; ?>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">SR.<BR>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Location/Chainage *</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Thickness (mm)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Density (g/cc)</td>
						</tr>
						
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['s1']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['thick_1']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['e1']; ?></td>																												
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['s2']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['thick_2']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['e2']; ?></td>																												
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['s3']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['thick_3']; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['e3']; ?></td>																												
						</tr>
						
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Average</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo (($row_select_pipe['thick_1'] + $row_select_pipe['thick_2'] + $row_select_pipe['thick_3']) / 3); ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['avg_density']; ?></td>											
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:5px 0px 5px;">
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
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>

							<tr>
							<td style="font-size:10px;padding:3px 0;">6. &nbsp;Witness By : </td>
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

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">

		</div>
	</page>


	<!--page size="A4">
		<center style="font-size:16px;font-family: Arial;margin-left:45px;padding-bottom:3px;font-weight:bold;"><b>TEST REPORT OF BITUMEN MIX</b></center>
		
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Arial;margin-left:45px;margin-right:15px;border:1px solid black;">
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border-bottom:1px solid black;">
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
				<table align="center" width="100%"   cellspacing="0" cellpadding="0" class="test" style="border-bottom:1px solid black;">
				
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
				<table align="center" width="100%"  border="0px" class="test" style="border-bottom:1px solid black;">
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
					<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>				
					<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
					<td style="width:3%;font-family: Arial;"><b>:</b></td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
					
				</tr>
				<tr>
					<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Type of Sample</b></td>
					<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
					<td style="width:40%">&nbsp;&nbsp;<?php echo $bit_mix; ?></td>
					<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
					<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
					<td style="width:14%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>					
				</tr>
				
				<tr>
					<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Condition of Sample</b></td>
					<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
					<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
					<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
					<td style="width:3%;font-family:Arial;font-weight:bold;">:</td>
					<td style="width:14%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>					
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
		</tr>
		
		<tr >
			
			
					<td style="font-size:12.7px;padding-top:5px;"><center><b>Test Results</b></center></td>
			
		</tr>
		
		
	
		<tr>
					<!--OTHER START-->
	<!--td>
						
							
							<table align="center" width="100%"  class="test" style="height:auto;width:100%;" >
									<tr style="text-align:center;height:45px;">
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Description</b></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Flow<Br>(mm)</b></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Marshal Stability<br>(KN)</b></td>
										<td  style="border:1px solid black;border-left:0px solid black;width:20%;"><b>Density<br>(gm/cc)</b></td>
										<td  style="border:1px solid black;border-right:0px solid black;width:20%;"><b>Binder Content by<br>Mix(%)</b></td>
									</tr>
									
									
									
									<tr style="text-align:center;height:45px;">
										<td style="border:1px solid black;border-left:0px solid black;">Result</td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php
																										if ($row_select_pipe['avg_flow'] == "" or is_null($row_select_pipe['avg_flow'])) {
																											echo "---";
																										} else {
																											echo number_format($row_select_pipe['avg_flow'], 2);
																										}
																										?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php
																										if ($row_select_pipe['avg_stabilty'] == "" or is_null($row_select_pipe['avg_stabilty'])) {
																											echo "---";
																										} else {
																											echo number_format($row_select_pipe['avg_stabilty'], 2);
																										}
																										?></td>
										<td style="border:1px solid black;border-left:0px solid black;"><?php
																										if ($row_select_pipe['avg_density'] == "" or is_null($row_select_pipe['avg_density'])) {
																											echo "---";
																										} else {
																											echo number_format($row_select_pipe['avg_density'], 2);
																										}
																										?></td>
										<td style="border:1px solid black;border-right:0px solid black;"><?php
																											if ($row_select_pipe['avg_bin'] == "" or is_null($row_select_pipe['avg_bin'])) {
																												echo "---";
																											} else {
																												echo number_format($row_select_pipe['avg_bin'], 2);
																											}
																											?></td>
									</tr>
									
									<tr style="text-align:center;height:45px;">
										<td style="border:1px solid black;border-left:0px solid black;">Test Method</td>							
										<td style="border:1px solid black;border-left:0px solid black;">ASTM D 6927:2015</td>
										<td style="border:1px solid black;border-left:0px solid black;">ASTM D 6927:2015</td>
										<td style="border:1px solid black;border-left:0px solid black;">ASTM D 2726:2019</td>
										<td style="border:1px solid black;border-right:0px solid black;">ASTM D 2172:2017</td>
									</tr>
									<tr style="text-align:center;height:45px;">
										<td style="border:1px solid black;border-left:0px solid black;">Requirement<br>As Per IRC/MoRTH</td>							
										<td style="border:1px solid black;border-left:0px solid black;">2-4</td>
										<td style="border:1px solid black;border-left:0px solid black;">Min. 9 KN</td>
										<td style="border:1px solid black;border-left:0px solid black;">---</td>
										<td style="border:1px solid black;border-right:0px solid black;">---</td>
									</tr>
									
									
								</table>
						
					</td>
				
				</tr>
				
				
		
		
		</table>
		<table cellpadding="0" cellpadding="0" align="center" width="92%" style="font-size:12.7px;font-family: Arial;margin-left:45px;margin-right:15px;" class="test">
				
				<tr>
												
						<td style="width:100%;text-align:right;padding-top:70px;padding-right:20px;">Authorized Signature</td>
						
						
			</tr>
			
			<tr>
												
						<td style="width:100%;text-align:right;">Mr. Kuldip(TM) / Mr. Ankur(QM)</td>
						
						
			</tr>
		</table>
		
		<table  width="95%" cellspacing="0" cellpadding="0" style="font-size:12.7px;font-family: Arial;position:fixed;bottom:70px;">
			<tr>
					
					<td colspan="2">
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Arial;margin-left:35px;">
							<tr>
								
								<td style="text-align:left;padding-right:15px;"><p align="justify">Terms &amp; Condition :The results relate only to the sample tested, Sample(s) drawn by party. Test certificate shall not be re-produced except in full without the written approval of Laboratory. RMS has made their best endeavors to provide accurate and reliable information, RMS is not responsible for any financial liability due to any act of omission or error mode.</p></td>
								
							</tr>
					</table>
					</td>
					
			</tr>
			<tr>
					
					<td>
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Arial;margin-left:45px;">
								
								<td style="text-align:left;width:33%">F/7.8/6</td>
						
								
								<td style="text-align:center;width:33%">** END OF REPORT **</td>
						
								
								<td style="text-align:right;width:33%;padding-right:22.5px;">Page No. 1 of 1</td>				
								
							</table>
					</td>
			</tr>
		</table>
		
		
	
		
		</page-->

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>