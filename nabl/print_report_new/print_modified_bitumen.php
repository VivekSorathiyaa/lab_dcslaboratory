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
	$select_tiles_query = "select * from modified_bitumen WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
		  		<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Properties of Polymer Modified Bitumen</b></td>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline / Group</td>
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
							    <td style="width:12%;padding-bottom: 4px;padding-top:4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top:4px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top:4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
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
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

					    <tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Source of Sample</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $cons; ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">PMB 64 - 10 *</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Grade of Sample</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $bitumin_grade; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<!--<tr>
						    <td style="width:12%;">Gatepass No.</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;"></td>
							<td style="width:21%;text-align:right;">Vehicle No.</td>
							<td style="width:6%;text-align: center;"> &raquo;</td>
							<td style="width:40%;"><?php echo $row_select_pipe['tank_no']; ?></td>
						</tr>-->
						
					</table>
				</td>
			</tr>
		<tr>
            <td>
                <table cellpadding="0" cellpadding="0" align="center" width="85%" style="" class="test">
                    <tr>
					     <td style="padding:15px 0 4px;font-weight:bold;font-size:11px;">A) Polymer Modified Bitumen Test Results :</td>
                     </tr>
                </table>
            </td>
        </tr>
		<br>

		<?php $cnt = 1; ?>
		<tr>
		    <td style="text-align:left;font-size:12px; ">
				<table align="center" width="80%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">

					<tr style="">
						<td width="30%" style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Name of Test</td>
						<td width="35%" style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Softening Point Test at 5&deg;C (<sup>o</sup>C)</td>
						<td width="35%" style="border-top:1px solid;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Elastic Recovery at 15&deg;C</td>
					</tr>


					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;font-weight:bold;">Test Results</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != null && $row_select_pipe['avg_sof'] != "0") {echo number_format($row_select_pipe['avg_sof'], 0);} else { echo "-";} ?>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php if ($row_select_pipe['avg_ela'] != "" && $row_select_pipe['avg_ela'] != null && $row_select_pipe['avg_ela'] != "0") {echo number_format($row_select_pipe['avg_ela'], 0);} else { echo "-";} ?>
						</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;font-weight:bold;">Test Method</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">lS:1205-2022</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">IS:15462-2019</td>
					</tr>
					<tr style="">
						<td colspan="3" style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;font-weight:bold;">Requirement as per IS 15462-2019, Table I (clause 6.5)</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 64 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 60&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 70 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 65&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 76 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 82 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 80&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 85</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 76 - 22</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 75&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 80</td>
					</tr>
				</table>
			</td>
		<br>
			<!-- <td style="text-align:left;font-size:12px; ">
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

			</td> -->
		</tr>


		<tr>
		    <td style="text-align:center;font-size:11px; ">
					<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
							<tr>
								<td style="width:60%;text-align:center;font-weight:bold;padding:10px 0;">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>