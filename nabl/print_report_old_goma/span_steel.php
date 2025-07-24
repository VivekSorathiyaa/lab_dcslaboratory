<?php
include("../connection.php");
session_start();

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
	$select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$tpi_or_auth = $row_select['tpi_or_auth'];
	$pmc_heading = $row_select['pmc_heading'];
	if ($cons == 0) {
		$con_sample = "Sealed";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0'";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$material_location = $row_select4['material_location'];
		$dia = explode(",", $row_select4['steel_dia']);
		$grade = $row_select4['steel_grade'];
		$brand = $row_select4['steel_brand'];
		$sample_qty1 = $row_select4['steel_sample_qty'];
		$heat = $row_select4['steel_heat'];
		$steel_qty = $row_select4['steel_sample_qty'];
		$steel_source_name = $row_select4['steel_source_name'];
		$grade_data = explode(",", $row_select4['steel_grade']);
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 5;
	/*for($a=0;$a<$page_cont;$a++)
			{*/
	?>




	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:18px;padding-bottom:15px; "><b><u>TEST REPORT FOR PHYSICAL TEST OF REINFORCEMENT STEEL</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $clientname; ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:19%;">&nbsp; 2023-24 / <?php echo $agreement_no; ?></td>
						</tr>
						<tr style="">

							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%;font-weight:bold;">&nbsp; </td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;width:11%; font-weight:bold; ">&nbsp; ULR No.</td>
							<td style="border-top: 1px solid black;border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Tender No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																																	$result_selectc = mysqli_query($conn, $select_queryc);

																																	if (mysqli_num_rows($result_selectc) > 0) {
																																		$row_selectc = mysqli_fetch_assoc($result_selectc);
																																		$ct_nm = $row_selectc['city_name'];
																																	}
																																	echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp; <?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;<?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Material Under Testing</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; Reinforcement Steel (10 mm)</td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp;Material Brand</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; Jindal Fe - 500D</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp;No.of Sample/Invoice No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $sample_qty1; ?> Nos</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp;Temperature(&deg;C)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp;27.2</td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp;Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS - 1786 RA - 2013, IS : 1608 RA - 2017 & IS : 1599 RA - 2017</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:left; font-size:20px; "><b>Mechanical Properties</b></td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:11px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:3%;font-weight:bold; text-align:center; ">Sr.<br>NO.</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%;text-align:center;font-weight:bold; ">ID No.</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%; text-align:center;font-weight:bold;">Dia.<br>(mm)</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:3%;font-weight:bold;text-align:center; ">Length<br>(mt)</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:5%;text-align:center;font-weight:bold;">Mass per metre<br>(kg)</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:11%;border-right: 1px solid;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">Gross cross sectional area (mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;width:11%;border-right: 1px solid;text-align:center;font-weight:bold;">Tolerence in mass(%)</td>
							<td style="border-top:1px solid;width:11%;border-right: 1px solid;text-align:center;font-weight:bold;">Yield Stress (N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;width:11%;border-right: 1px solid;text-align:center;font-weight:bold;">Elongation</td>
							<td style="border-top:1px solid;width:11%;border-right: 1px solid;text-align:center;font-weight:bold;">Tensile Stress (N/mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;width:12%;border-right: 1px solid;text-align:center;font-weight:bold;">Bend</td>
							<td style="border-top:1px solid;width:12%;border-right: 1px solid;text-align:center;font-weight:bold;">Rebend</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:5%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px; ">H-01</td>
							<?php
							$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
							$coming_row = mysqli_num_rows($result_tiles_select1);

							while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
								$flag++;
							?>
								<td style="border-left: 1px solid black;width:5%; text-align:center;border-top:1px solid;"><?php echo $row_select_pipe2['dia'];  ?></td>
							<?php
								if ($flag == 5) {
									break;
								}
							}

							?>
							<?php
							$select_tilesy6 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select16 = mysqli_query($conn, $select_tilesy6);
							$coming_row = mysqli_num_rows($result_tiles_select16);

							while ($row_select_pipe26 = mysqli_fetch_array($result_tiles_select16)) {
								$flag6++;
							?>

								<td style="border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;"><?php echo $row_select_pipe26['l_1']; ?></td>


							<?php
								if ($flag6 == 5) {
									break;
								}
							}

							?>




							<?php
							$select_tilesy7 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select17 = mysqli_query($conn, $select_tilesy7);
							$coming_row = mysqli_num_rows($result_tiles_select17);

							while ($row_select_pipe7 = mysqli_fetch_array($result_tiles_select17)) {
								$flag7++;
							?>


								<td style="border-left: 1px solid black;width:5%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe7['w_1'] != "" && $row_select_pipe7['w_1'] != null && $row_select_pipe7['w_1'] != "0") {
																																if ($row_select_pipe7['dia_1'] == "8 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(0.395)";
																																} else if ($row_select_pipe7['dia_1'] == "10 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(0.617)";
																																} else if ($row_select_pipe7['dia_1'] == "12 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(0.888)";
																																} else if ($row_select_pipe7['dia_1'] == "16 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(1.58)";
																																} else if ($row_select_pipe7['dia_1'] == "20 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(2.47)";
																																} else if ($row_select_pipe7['dia_1'] == "25 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(3.85)";
																																} else if ($row_select_pipe7['dia_1'] == "32 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(6.31)";
																																} else if ($row_select_pipe7['dia_1'] == "4 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(0.99)";
																																} else if ($row_select_pipe7['dia_1'] == "5 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(0.154)";
																																} else if ($row_select_pipe7['dia_1'] == "6 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(0.222)";
																																} else if ($row_select_pipe7['dia_1'] == "28 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(4.83)";
																																} else if ($row_select_pipe7['dia_1'] == "36 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(7.99)";
																																} else if ($row_select_pipe7['dia_1'] == "40 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(9.86)";
																																} else if ($row_select_pipe7['dia_1'] == "45 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(12.49)";
																																} else if ($row_select_pipe7['dia_1'] == "50 MM") {
																																	$w = $row_select_pipe7['w_1'];
																																	$l = $row_select_pipe7['l_1'];
																																	$ans = $w / $l;
																																	echo round($ans, 3) . "<br>" . "(15.42)";
																																};
																															} else {
																																echo "-";
																															} ?></td>

							<?php
								if ($flag7 == 5) {
									break;
								}
							}

							?>


							<?php
							$select_tilesy8 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select18 = mysqli_query($conn, $select_tilesy8);
							$coming_row = mysqli_num_rows($result_tiles_select18);

							while ($row_select_pipe8 = mysqli_fetch_array($result_tiles_select18)) {
								$flag8++;
							?>
								<td style="border-left: 1px solid black;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe8['cs_1'] != "" && $row_select_pipe8['cs_1'] != null && $row_select_pipe8['cs_1'] != "0") {
																																						echo $row_select_pipe8['cs_1'];
																																					} else {
																																						echo "-";
																																					} ?></td>
							<?php
								if ($flag8 == 5) {
									break;
								}
							}

							?>

							<td style="width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php
																													if ($row_select_pipe['grade'] == "FE 415") {
																														echo "1.1";
																													} else if ($row_select_pipe['grade'] == "FE 415 D") {
																														echo "1.12";
																													} else if ($row_select_pipe['grade'] == "FE 415 S") {
																														echo "1.25";
																													} else if ($row_select_pipe['grade'] == "FE 500") {
																														echo "1.08";
																													} else if ($row_select_pipe['grade'] == "FE 500 D") {
																														echo "1.1";
																													} else if ($row_select_pipe['grade'] == "FE 500 S") {
																														echo "1.25";
																													} else if ($row_select_pipe['grade'] == "FE 550") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 550 D") {
																														echo "1.08";
																													} else if ($row_select_pipe['grade'] == "FE 600") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 650") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 700") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 415 CRS") {
																														echo "1.1";
																													} else if ($row_select_pipe['grade'] == "FE 415 D CRS") {
																														echo "1.12";
																													} else if ($row_select_pipe['grade'] == "FE 415 S CRS") {
																														echo "1.25";
																													} else if ($row_select_pipe['grade'] == "FE 500 CRS") {
																														echo "1.08";
																													} else if ($row_select_pipe['grade'] == "FE 500 D CRS") {
																														echo "1.1";
																													} else if ($row_select_pipe['grade'] == "FE 500 S CRS") {
																														echo "1.25";
																													} else if ($row_select_pipe['grade'] == "FE 550 CRS") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 550 D CRS") {
																														echo "1.08";
																													} else if ($row_select_pipe['grade'] == "FE 600 CRS") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 650 CRS") {
																														echo "1.06";
																													} else if ($row_select_pipe['grade'] == "FE 700 CRS") {
																														echo "1.06";
																													}
																													?></td>
							<?php
							$select_tilesy26 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select26 = mysqli_query($conn, $select_tilesy26);
							$coming_row = mysqli_num_rows($result_tiles_select26);

							while ($row_select_pipe26 = mysqli_fetch_array($result_tiles_select26)) {
								$flag26++;
							?>
								<td style="width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe26['ys_1'] != "" && $row_select_pipe26['ys_1'] != null && $row_select_pipe26['ys_1'] != "0") {
																															echo $row_select_pipe26['ys_1'];
																														} else {
																															echo "-";
																														} ?></td>

							<?php
								if ($flag26 == 5) {
									break;
								}
							}

							?>

							<?php
							$select_tilesy29 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select29 = mysqli_query($conn, $select_tilesy29);
							$coming_row = mysqli_num_rows($result_tiles_select29);

							while ($row_select_pipe29 = mysqli_fetch_array($result_tiles_select29)) {
								$flag29++;
							?>
								<td style="width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe29['elo_1'] != "" && $row_select_pipe29['elo_1'] != null && $row_select_pipe29['elo_1'] != "0") {
																															echo $row_select_pipe29['elo_1'];
																														} else {
																															echo "-";
																														} ?></td>

							<?php
								if ($flag29 == 5) {
									break;
								}
							}

							?>
							<?php
							$select_tilesy24 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select24 = mysqli_query($conn, $select_tilesy24);
							$coming_row = mysqli_num_rows($result_tiles_select24);

							while ($row_select_pipe24 = mysqli_fetch_array($result_tiles_select24)) {
								$flag24++;
							?>
								<td style="width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe24['ten_1'] != "" && $row_select_pipe24['ten_1'] != null && $row_select_pipe24['ten_1'] != "0") {
																															echo $row_select_pipe24['ten_1'];
																														} else {
																															echo "-";
																														} ?></td>
							<?php
								if ($flag24 == 5) {
									break;
								}
							}

							?>
							<?php
							$select_tilesy31 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select31 = mysqli_query($conn, $select_tilesy31);
							$coming_row = mysqli_num_rows($result_tiles_select31);

							while ($row_select_pipe31 = mysqli_fetch_array($result_tiles_select31)) {
								$flag31++;
							?>
								<td style="width:12%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe31['bend_1'] != "" && $row_select_pipe31['bend_1'] != null && $row_select_pipe31['bend_1'] != "0" && $row_select_pipe31['bend_1'] != "undefined") {
																															echo $row_select_pipe31['bend_1'];
																														} else {
																															echo "-";
																														} ?></td>
							<?php
								if ($flag31 == 5) {
									break;
								}
							}

							?>
							<?php
							$select_tilesy32 = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select32 = mysqli_query($conn, $select_tilesy32);
							$coming_row = mysqli_num_rows($result_tiles_select32);

							while ($row_select_pipe32 = mysqli_fetch_array($result_tiles_select32)) {
								$flag32++;
							?>
								<td style="width:12%;border-right: 1px solid;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe32['rebend_1'] != "" && $row_select_pipe32['rebend_1'] != null && $row_select_pipe32['rebend_1'] != "0") {
																															echo $row_select_pipe32['rebend_1'];
																														} else {
																															echo "-";
																														} ?></td>
							<?php
								if ($flag32 == 5) {
									break;
								}
							}

							?>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:5%;text-align:center;border-top:1px solid;font-weight:bold;padding-bottom:4px;padding-top:4px; " colspan=2>IS Limit</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:5%; text-align:center;border-top:1px solid;">--</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;">--</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:5%;border-top:1px solid;text-align:center;">--</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;">--</td>
							<td style="font-weight:bold;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;">Max()</td>
							<td style="font-weight:bold;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;">Min()</td>
							<td style="font-weight:bold;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;">Min()</td>
							<td style="font-weight:bold;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;">Min()</td>
							<td style="font-weight:bold;width:12%;border-right: 1px solid;border-top:1px solid;text-align:center;">--</td>
							<td style="font-weight:bold;width:12%;border-right: 1px solid;border-top:1px solid;text-align:center;">--</td>
						</tr>
						<tr style="">
							<td style="font-weight:bold;border-left: 1px solid black;width:5%;text-align:center;border-top:1px solid; " colspan=6>Refrence Based On:-</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:5%; text-align:center;border-top:1px solid;">Table-2 as per IS:1786 RA-2013</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:3%;text-align:center; border-top:1px solid;padding-bottom:2px;padding-top:2px;" colspan=3>Table-3 as per IS:RA-2013</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:3%;border-top:1px solid;text-align:center;">CI.9.3 as per IS:1786 RA-2013</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:11%;border-right: 1px solid;border-top:1px solid;text-align:center;">CI.9.4 as per IS:1786 RA-2013</td>
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
				<td style="text-align:center;font-size:14px; "><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-weight:bold; ">
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

	/*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}*/


	/*}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>