<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 ;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
	}

	@media print {
		#header_hide_show {
			display: none !important;

		}
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
	$select_tiles_query = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe1 = mysqli_fetch_array($result_tiles_select);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 7);

	$ans = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$r_date = $row_select['date'];
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
	}
	?>
	
	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-top:80px;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Equivalent Cube Strength od Concrete Core</b></td>
			</tr>


			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding-bottom:6px;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;text-align:left;">
						<?php echo "ULR No.  " . $_GET['ulr']; ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"> <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;">Report Ref No</td>
						<td style="width:6%;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-collapse: inherit;padding-top:14px;padding-bottom:14px;">

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
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>
							<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Reference No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>

                        <?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:12%;"><?php echo $row_select['pmc_heading']; ?></td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;"><?php echo $row_select['pmc_name']; ?>
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
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-collapse: inherit;padding:4px 0;margin-bottom:6px;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No. & Date</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Location</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $material_location;?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Date of Sample Received</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Concrete Core</td>
							<!-- <td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td> -->
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Date of Testing</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;">&raquo;</td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style="width:21%;text-align:right;padding-bottom: 4px;"></td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>																			
						</tr>

						<tr>
						    <td style="width:12%;">Grade of Concrete</td>
							<td style="width:6%;text-align: center;">&raquo;</td>
							<td style="width:40%;font-size: 10px;text-align:left;"><?php echo $row_select_pipe['grade1']; ?></td>
							<td style="width:21%;text-align:right;"></td>
							<td style="width:6%;text-align: center;p"></td>
							<td style="width:40%;"></td>			
						</tr>
						
					</table>
				</td>
			</tr>


			


		<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px;">
				    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="width:5%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" rowspan=2> Sr.<br>No.</td>
							<td rowspan=2 style="width:5%; border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">ID No.</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Diameter of Core</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Height of Core</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" >Density of core</td>
							<td style="width:8%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Load</td>
							<td style="width:14%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Measured Compressive Strength</td>
							<td style="width:14%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Corrected Compressive Strength</td>
							<td style="width:14%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Equivalent Cube Strength</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center;">cm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">cm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; ">cm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">gm/ee</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">KN</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
						</tr>


						<?php
						$select_tilesy = "select * from concrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						// $coming_row = mysqli_num_rows($result_tiles_select1);
						$count=1;
						$flag=1;
						if(mysqli_num_rows($result_tiles_select1)>0){
						while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select1)) {
						?>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">Core-<?php echo $count++;?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select_pipe['dia1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['height1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['area1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['den1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['load1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['com1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['corr_com1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['eq_cube1']; ?></td>
							</tr>

						<?php
							
						}
						}

						?>
					</table>
				</td>
			</tr>


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
           		 <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;">
				<tr>
				<td style="text-align:center;font-size:10px;">
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
						<tr>
							<td><b>Note :-</b></td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"> 1. &nbsp; Correction Factor foe Equivalent Cylinder Strength of is considered as per IS : 516 (Part-4) 2018.</td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"> 2. &nbsp; Core Strength Shall Be Considered acceptable if the average equivalent cubical strength of the cores is equal to at least 85% of the equivalent cube strength of the grade of concrete and no individual core has a less than 75% strength as per IS : 456.</td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"> 3. &nbsp; Results are issued with specific understanding that Manglam Consultancy Service will not be in any case involed in action following the interpretation of the results.</td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"> 4. &nbsp; The Results are not supposed to be used for publicity & Legal Purpose.</td>
						</tr>
						<tr>
							<td style="font-size:10px;width:50%;padding:3px 0;"> 5. &nbsp;The results are given for the sample submitted by the Customer/Agency</td>
							<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"> 6. &nbsp;The results are given on sample submitted in Lab by Customer/Agency only.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;">7. &nbsp;*As informed by Customer/Agency.</td>
							<td></td>
						</tr>
						<tr>
							<td style="font-size:10px;padding:3px 0;"></td>
							<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
						</tr>
						<tr>
							<td style="text-align:left;font-style:italic;font-size:11px;font-weight:bold;padding:3px 0;">Witness By : </td>
							<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
						</tr>
					</table>
				</td>
            </tr>
        </table>


            <table width="95%" align="center" style="font-family:Cambria;font-size:10px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-28/ Page 1/1
							</td>
						</tr>
			</table>
		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">

		</div>
	</page>
	
	
	<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
	<!--<page size="A4">

		<div id="header">
			<br>
			<br>
		</div>

		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-left:35px; ">
			<tr>
				<td style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
			</tr>
		</table>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border:1px solid black;margin-left:35px; ">

			<tr style="border: 1px solid black;height:20px;">
				<td width="30%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($row_select_pipe1['ulr'] != "" && $row_select_pipe1['ulr'] != "0" && $row_select_pipe1['ulr'] != null) {
																							echo "<b>ULR:</b> " . $row_select_pipe1['ulr'];
																						} ?></td>

				<td width="65%" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if ($report_no != "" && $report_no != "0" && $report_no != null) {
																											echo " " . $report_no;
																										} ?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d-m-Y', strtotime($issue_date)); ?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submited To </b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																						$result_selectc = mysqli_query($conn, $select_queryc);

																						if (mysqli_num_rows($result_selectc) > 0) {
																							$row_selectc = mysqli_fetch_assoc($result_selectc);
																							$ct_nm = $row_selectc['city_name'];
																						}
																						echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of <span id="put_details"></span><select style="font-weight:bold;border:0px;font-size:11px;" onchange="put_details()" id="details_of_sample">
							<option>Work</option>
							<option>Project</option>
						</select></b></td>
				<td colspan="2" style="border-bottom: 1px solid black;padding-left:10px ">&nbsp;&nbsp;<?php echo $name_of_work; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo "Concrte Core"; ?> </td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php
																						echo $r_name . " Date:" . date('d/m/Y', strtotime($row_select2["letter_date"]));

																						?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Date of Receipt of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($cons == "1") {
																							echo "Sealed";
																						} elseif ($cons == "2") {
																							echo "Unsealed";
																						} elseif ($cons == "3") {
																							echo "Good";
																						} elseif ($cons == "4") {
																							echo "Poor";
																						} else {
																							echo "Sealed";
																						} ?> </td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																						$result_selectc1 = mysqli_query($conn, $select_queryc1);

																						if (mysqli_num_rows($result_selectc1) > 0) {
																							$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																							$ct_nm1 = $row_selectc1['city_name'];
																						}
																						echo $agency_name . " " . $ct_nm1; ?> </td>
			</tr>
			<?php if ($agreement_no != "") { ?>
				<tr style="border: 1px solid black;height:20px;">
					<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Aggrement No.</b></td>
					<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
				</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php


																						echo $lab_no;
																						?></td>
			</tr>
			<?php
			$first_tag = $row_select['first_tag'];
			$second_tag = $row_select['second_tag'];
			$third_tag = $row_select['third_tag'];
			$fourth_tag = $row_select['fourth_tag'];

			$first_txt = $row_select['first_txt'];
			$second_txt = $row_select['second_txt'];
			$third_txt = $row_select['third_txt'];
			$fourth_txt = $row_select['fourth_txt'];
			if ($first_tag != null && $first_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt; ?></td>
				</tr>
			<?php }
			if ($second_tag != null && $second_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt; ?></td>
				</tr>
			<?php }
			if ($third_tag != null && $third_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt; ?></td>
				</tr>
			<?php }
			if ($fourth_tag != null && $fourth_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt; ?></td>
				</tr>
			<?php } ?>



			<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
			</TR>
			<tr style="border: 1px solid black;height:20px;">
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:LEFT;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Sample Quantity:</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $no_of_rows . " Nos."; ?></td>
			</tr>

			<!--<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];
																																																																														?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>>
		</table>
		<br>


		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border:1px solid black;margin-left:35px; ">
			<tr>
				<td style="font-size:15px;text-align:center"><b><u>Test Result</u></b></td>
			</tr>
			<tr>
				<!--OTHER START>
				<td>
					<table align="center" width="100%" class="test" style="border: 1px solid black;font-size:10px;" cellpadding="3px">
						<tr>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Location of Core</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Weight (gm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Dia (mm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Height (mm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Area (mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Ratio</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Volume (m<sup>3</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Density (Kg/m<sup>3</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Diameter Correction</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Correction</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Corrected Comp. Strength</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>

						</tr>
						<?php
						$total_data = 0;
						$select_tiles_query = "select * from concrete_core WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
						$result_tiles_select = mysqli_query($conn, $select_tiles_query);
						if (mysqli_num_rows($result_tiles_select) > 0) {
							while ($row_select_pipe = mysqli_fetch_array($result_tiles_select)) {
						?>
								<tr>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['location1'] != "" && $row_select_pipe['location1'] != "0" && $row_select_pipe['location1'] != null) {
																								echo $row_select_pipe['location1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['weight1'] != "" && $row_select_pipe['weight1'] != "0" && $row_select_pipe['weight1'] != null) {
																								echo $row_select_pipe['weight1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != "0" && $row_select_pipe['dia1'] != null) {
																								echo $row_select_pipe['dia1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['height1'] != "" && $row_select_pipe['height1'] != "0" && $row_select_pipe['height1'] != null) {
																								echo $row_select_pipe['height1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) {
																								echo $row_select_pipe['area1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_ratio1'] != "" && $row_select_pipe['hd_ratio1'] != "0" && $row_select_pipe['hd_ratio1'] != null) {
																								echo $row_select_pipe['hd_ratio1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['vol1'] != "" && $row_select_pipe['vol1'] != "0" && $row_select_pipe['vol1'] != null) {
																								echo $row_select_pipe['vol1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != "0" && $row_select_pipe['den1'] != null) {
																								echo $row_select_pipe['den1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != "0" && $row_select_pipe['load1'] != null) {
																								echo $row_select_pipe['load1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com1'] != "" && $row_select_pipe['com1'] != "0" && $row_select_pipe['com1'] != null) {
																								echo $row_select_pipe['com1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia_corr1'] != "" && $row_select_pipe['dia_corr1'] != "0" && $row_select_pipe['dia_corr1'] != null) {
																								echo $row_select_pipe['dia_corr1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_corr1'] != "" && $row_select_pipe['hd_corr1'] != "0" && $row_select_pipe['hd_corr1'] != null) {
																								echo $row_select_pipe['hd_corr1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['corr_com1'] != "" && $row_select_pipe['corr_com1'] != "0" && $row_select_pipe['corr_com1'] != null) {
																								echo $row_select_pipe['corr_com1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['eq_cube1'] != "" && $row_select_pipe['eq_cube1'] != "0" && $row_select_pipe['eq_cube1'] != null) {
																								echo $row_select_pipe['eq_cube1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>

								</tr>
						<?php
								$total_data += floatval($row_select_pipe['eq_cube1']);
							}
						}

						?>
						<tr>
							<td colspan="13" width="5%" style="border: 1px solid black; text-align:right;"><b>Average Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b><?php
																									$ans = $total_data / $no_of_rows;
																									echo number_format($ans, 2);



																									?></b></td>

						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:33%;font-weight:bold;">*** END OF REPORT ***</td>
			</tr>
		</table>

		<br>
		<!--table align="center" width="92%"  class="test" style="border:1px solid black;font-family: Arial;margin-left:35px; " >
			<tr>
				<td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
				<td><p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the TMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity.  (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="95%" style="font-family:arial;margin-left:35px;">
			<tr>
				<td style="">
					<div style="float:right;" id="footer">

					</div>
				</td>
				<td style="width:25%;">
					<div style="float:right; text-align:center; padding-right:60px;" id="sign">
						<img src="../images/stamp.png" width="160px">
					</div>
				</td>
			</tr>
		</table>
	</page>-->


</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
		if (document.querySelector('#header_hide_show').checked) {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="100%">');
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}

	function loading() {

		document.getElementById('header').innerHTML = '';
		document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
		document.getElementById("footer").innerHTML = '';
		document.getElementById('sign').innerHTML = '';
		document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');

	}
</script>