<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px ;
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
	$select_tiles_query = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
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
		$cc_grade = $row_select4['cc_grade'];
		$cc_set_of_cube = $row_select4['cc_set_of_cube'];
		$cc_no_of_cube = $row_select4['cc_no_of_cube'];
		$cc_identification_mark = $row_select4['cc_identification_mark'];
		$day_remark = $row_select4['day_remark'];
		$casting_date = $row_select4['casting_date'];
		$material_location = $row_select4['material_location'];
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 7;
	/*for($a=1;$a<=$page_cont;$a++)
			{
*/
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
							    <td style="width:12%;font-size: 11px;padding-bottom: 4px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
								<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>
							<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;font-size: 11px;padding-bottom: 4px;">Reference No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>

                        <?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:12%;font-size: 11px;"><?php echo $row_select['pmc_heading']; ?></td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;font-size: 11px;text-align:left;"><?php echo $row_select['pmc_name']; ?>
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


			<!-- <tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp;
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

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Accep.Letter No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp;W/623/4672/20- 21,dated-07. 11.2020</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Client</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Ref.No/Ref.Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																																											if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																																											?> / Date : <?php echo date('d - m - Y', strtotime($row_select["date"]));
																																											} else {
																																											}
											?> </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">


						<?php
						$select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;


						?>

							<tr style="">
								<td style="border-left: 1px solid black;width:3%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px; "> 1</td>
								<td style="border-left: 1px solid black;width:15%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold;; ">Grade oF Concrete( By <?php if ($sample_sent_by == 1) {
																																														echo 'Agency';
																																													} else if ($sample_sent_by == 0) {
																																														echo 'Client';
																																													} ?> )</td>
								<td style="border-left: 1px solid black;width:5%; text-align:center;"> <?php echo $row_select_pipe['grade1']; ?><?php echo $row_select_pipe['cc_grade']; ?></td>
								<td style="border-left: 1px solid black;width:3%;font-weight:bold;text-align:center; " rowspan=2>3</td>
								<td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold;" rowspan=2>Client ID Mark</td>
								<td style="border-left: 1px solid black;width:21%;border-right: 1px solid;text-align:center;" rowspan=2><?php echo $row_select_pipe['cc_identification_mark']; ?></td>

							</tr>

							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:2%;font-weight:bold;text-align:center;padding-bottom:1px;padding-top:1px;  ">2</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:27%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold; ">Water Temp</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "> 27.1</td>
							</tr>

							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px; "> 4</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold;; ">Test Method</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:5%; text-align:center;">IS-516-1959</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">5</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold;">Curing Condition</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;text-align:center;">&nbsp;&nbsp; 27 &plusmn; 2 &#8451;</td>

							</tr>

						<?php
							if ($flag == 7) {
								break;
							}
						}

						?>

					</table><br>

				</td>
			</tr> -->


		<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px;">
				    <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" rowspan=2> Sr.<br>No.</td>
							<td rowspan=2 style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">ID No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Diameter of Core</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Height of Core</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;" >Density of core</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Load</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Measured Compressive Strength</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px; ">Corrected Cylinder Strength</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Equivalent Cube Strength</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;">cm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">cm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; ">cm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">gm/ee</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">KN</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
						</tr>


						<?php
						$select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;
						?>
							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">Core-1</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo $row_select	['dia']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['load_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">Core-2</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['load_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
							</tr>


							<tr style="">         
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">Core-3</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['load_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "></td>
							</tr>
							<tr>
								<td style="font-size:10px;text-align:right;border-top:1px solid black;padding:5px 4px;border-left:1px solid black;border-right:1px solid black;" colspan=9>Average :</td>
								<td style="font-size:10px;text-align:center;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
                            </tr>

						<?php
							if ($flag == 7) {
								break;
							}
						}

						?>
					</table>



					<!-- <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-left: 1px solid black;width:4%;font-weight:bold;text-align:center; "> Sr.<br>No.</td>
							<td style="border-left: 1px solid black;width:8%;text-align:center;font-weight:bold; ">Lab ID Mark</td>
							<td style="border-left: 1px solid black;width:8.88%; font-weight:bold;text-align:center;">Date Of Casting (By Client)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Date Of Testing</td>
							<td style="border-left: 1px solid black;width:8%;font-weight:bold;text-align:center; ">Age Of Concrete</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; " colspan="3">Cube Size(mm)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Area <br>(mm <sup>2</sup>)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Axial Load At failure</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Compressive Strength</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;">Average of Compressive Strength</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center;">Weight(kg)</td>
							<td style="border-left: 1px solid black;width:8.88%;font-weight:bold;text-align:center;border-right: 1px solid; ">Failure Pattern</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;font-weight:bold;text-align:center; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center;font-weight:bold; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;"></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; ">Days</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">L</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">B</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">H</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">L x B</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">Kn</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center; ">N/mm<sup>2</sup></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; font-weight:bold;text-align:center;"></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;font-weight:bold;text-align:center;border-right: 1px solid; "></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:1px;padding-top:1px;  ">1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">2</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;">3</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">4</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">5</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; " colspan=3>6</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; ">7</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; ">8</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">9</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">8.88</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; ">11</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">12</td>
						</tr>

						<?php
						$select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;
						?>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-07</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['l1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['b1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['h1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['cross_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['load_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['comp_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; " rowspan=3><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;"><?php echo $row_select_pipe['mass_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">satisfactory</td>
							</tr>

							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-08</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['l2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['b2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['h2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['cross_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['load_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['comp_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;"><?php echo $row_select_pipe['mass_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">satisfactory</td>
							</tr>
							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4%;text-align:center;padding-bottom:4px;padding-top:4px;  "><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; ">1-09</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%; text-align:center;"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8%;text-align:center; "><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['l3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['b3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:4.33%;text-align:center; "><?php echo $row_select_pipe['h3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['cross_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['load_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center; "><?php echo $row_select_pipe['comp_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;"><?php echo $row_select_pipe['mass_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:8.88%;text-align:center;border-right: 1px solid; ">satisfactory</td>
							</tr>
						<?php
							if ($flag == 7) {
								break;
							}
						}

						?>
					</table> -->
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
	<?php

	/*if($flag==8)
				{
					$flag=0;
					$down=$up;
					$up +=8;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}
			
			
			}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


</script>