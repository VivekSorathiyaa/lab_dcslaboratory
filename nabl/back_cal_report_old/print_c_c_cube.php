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

		font-size: 11px;
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
	$page_cont = round_up($no_of_rows / 4);

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
	$up = 4;
	for ($a = 1; $a <= $page_cont; $a++) {


	?>

		<br>
		<br>


		<page size="A4">
			<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
			<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

							<tr style="">

								<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/I/OS/001</td>
								<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
								<td style="width:25%; font-weight:bold;">RD :- 09/01/2023</td>
								<td style="width:25%;font-weight:bold;">Page : 1</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

							<tr style="">

								<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
								<td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

							<tr style="">

								<td style="width:75%;padding-bottom:3px;padding-top:3px;padding-left:200px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
								<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
							</tr>
							<tr style="">
								<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
							</tr>
							<tr style="">
								<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
							</tr>
							<tr style="">
								<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
							</tr>
							<tr style="">
								<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Email: gomaconsultancy@gmail.com</td>
							</tr>

						</table><br>
					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;">

							<tr style="">

								<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULATION SHEET FOR TEST ON C.C.CUBE <br>IS : 516 - 1959 (Reaff. 2013)</td>
							</tr>

						</table><br>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:14px; ">
						<?php
						$select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;


						?>

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

								<tr style="">

									<td style="width:20%;font-weight:bold;padding-left:5px;  ">&nbsp;&nbsp;Details of Sample :</td>
									<td style="width:20%;font-weight:bold;  "><u>Concrete Cube</u></td>
									<td style="width:20%;text-align:right;font-weight:bold; ">Dated :&nbsp;&nbsp;&nbsp; </td>
									<td style="width:20%;text-align:center;font-weight:bold; border:1px solid;padding-bottom:3px;padding-top:3px;"><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																						echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																					} else {
																																						echo " <br>";
																																					} ?></td>
									<td style="width:20%;text-align:left;font-weight:bold;"></td>
								</tr>

							</table><br>

						<?php if ($flag == 4) {
								break;
							}
						} ?>
					</td>
				</tr>



				<?php $cnt = 1; ?>
				<?php $cnts = 5; ?>
				<tr>
					<td style="text-align:center;font-size:14px; ">
						<?php
						$select_tilesy = "select * from span_c_c_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;


						?>
							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

								<tr style="">

									<td style="width:5%;font-weight:bold;padding-bottom:3px;padding-top:3px;text-align:center; "><?php echo $cnt++; ?></td>
									<td style="border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
									<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
									<td style="width:5%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center;border-left:1px solid; "><?php echo $cnts++; ?></td>
									<td style="border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Identification Mark :</td>
									<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select_pipe['cc_identification_mark'] != "" && $row_select_pipe['cc_identification_mark'] != "0" && $row_select_pipe['cc_identification_mark'] != null) {
																													echo $row_select_pipe['cc_identification_mark'];
																												} else {
																													echo " <br>";
																												}  ?></td>
								</tr>
								<tr style="">

									<td style="border-top:1px solid;width:5%;font-weight:bold;padding-bottom:3px;padding-top:3px;text-align:center; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Laboratory No :-</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
									<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnts++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Grade of concrete :-</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select_pipe['grade1'] != "" && $row_select_pipe['grade1'] != "0" && $row_select_pipe['grade1'] != null) {
																																		echo $row_select_pipe['grade1'];
																																	} else {
																																		echo " <br>";
																																	}  ?></td>
								</tr>
								<tr style="">

									<td style="border-top:1px solid;width:5%;font-weight:bold;padding-bottom:3px;padding-top:3px;text-align:center; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Samp. Rec. Date:-</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
									<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnts++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Date of casting :-</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																																		echo date('d - m - Y', strtotime($row_select_pipe['caste_date1']));
																																	} else {
																																		echo " <br>";
																																	}  ?></td>
								</tr>
								<tr style="">

									<td style="border-top:1px solid;width:5%;font-weight:bold;padding-bottom:3px;padding-top:3px;text-align:center; "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Water temp.:-</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; 27.1</td>
									<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnts++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; Age of Testing :-</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['day1']; ?> Days</td>
								</tr>

							</table><br><br>

					</td>
				</tr>


				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;">

							<tr style="">

								<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style="">COMPRESSIVE STRENGTH</td>
							</tr>

						</table><br>

					</td>
				</tr>


				<?php $cnt = 1; ?>
				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:25px;">

							<tr style="">

								<td style="width:10%;font-weight:bold;padding-bottom:5px;text-align:center; ">Sr No.</td>
								<td style="border-left:1px solid;width:12%;font-weight:bold;padding-bottom:5px;text-align:center; ">Date of<br>Testing</td>
								<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center; ">I.D.<br>Mark</td>
								<td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center;  ">Size<br>(L X B X H)<br>(mm)</td>
								<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Area<br>(L X B)</td>
								<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Load in KN </td>
								<td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center;  ">Compressive<br>Strength<br>(N/mm&sup2;)</td>
								<td style="border-left:1px solid;width:16%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;  ">Average<br>compressive<br>strength (N/mm&sup2;)</td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																							echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																						} else {
																																							echo " <br>";
																																						} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cc_identification_mark'] != "" && $row_select_pipe['cc_identification_mark'] != "0" && $row_select_pipe['cc_identification_mark'] != null) {
																															echo $row_select_pipe['cc_identification_mark'];
																														} else {
																															echo " <br>";
																														}  ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['h1'] != "" && $row_select_pipe['h1'] != "0" && $row_select_pipe['h1'] != null) {
																															echo ($row_select_pipe['l1'] * $row_select_pipe['b1'] * $row_select_pipe['h1']);
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cross_1'] != "" && $row_select_pipe['cross_1'] != "0" && $row_select_pipe['cross_1'] != null) {
																															echo $row_select_pipe['cross_1'];
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																															echo $row_select_pipe['load_1'];
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['comp_1'] != "" && $row_select_pipe['comp_1'] != "0" && $row_select_pipe['comp_1'] != null) {
																															echo $row_select_pipe['comp_1'];
																														} else {
																															echo " <br>";
																														}  ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;font-weight:bold; " rowspan="3"><?php if ($row_select_pipe['avg_com_s_1'] != "" && $row_select_pipe['avg_com_s_1'] != "0" && $row_select_pipe['avg_com_s_1'] != null) {
																																						echo $row_select_pipe['avg_com_s_1'];
																																					} else {
																																						echo " <br>";
																																					} ?> </td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																							echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																						} else {
																																							echo " <br>";
																																						} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cc_identification_mark'] != "" && $row_select_pipe['cc_identification_mark'] != "0" && $row_select_pipe['cc_identification_mark'] != null) {
																															echo $row_select_pipe['cc_identification_mark'];
																														} else {
																															echo " <br>";
																														}  ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['h2'] != "" && $row_select_pipe['h2'] != "0" && $row_select_pipe['h2'] != null) {
																															echo ($row_select_pipe['l2'] * $row_select_pipe['b2'] * $row_select_pipe['h2']);
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cross_2'] != "" && $row_select_pipe['cross_2'] != "0" && $row_select_pipe['cross_2'] != null) {
																															echo $row_select_pipe['cross_2'];
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																															echo $row_select_pipe['load_2'];
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['comp_2'] != "" && $row_select_pipe['comp_2'] != "0" && $row_select_pipe['comp_2'] != null) {
																															echo $row_select_pipe['comp_2'];
																														} else {
																															echo " <br>";
																														}  ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																							echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																						} else {
																																							echo " <br>";
																																						} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cc_identification_mark'] != "" && $row_select_pipe['cc_identification_mark'] != "0" && $row_select_pipe['cc_identification_mark'] != null) {
																															echo $row_select_pipe['cc_identification_mark'];
																														} else {
																															echo " <br>";
																														}  ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['h3'] != "" && $row_select_pipe['h3'] != "0" && $row_select_pipe['h3'] != null) {
																															echo ($row_select_pipe['l3'] * $row_select_pipe['b3'] * $row_select_pipe['h3']);
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cross_3'] != "" && $row_select_pipe['cross_3'] != "0" && $row_select_pipe['cross_3'] != null) {
																															echo $row_select_pipe['cross_3'];
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																															echo $row_select_pipe['load_3'];
																														} else {
																															echo " <br>";
																														} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['comp_3'] != "" && $row_select_pipe['comp_3'] != "0" && $row_select_pipe['comp_3'] != null) {
																															echo $row_select_pipe['comp_3'];
																														} else {
																															echo " <br>";
																														}  ?></td>
							</tr>

						</table>

					</td>
				</tr>

				<?php $cnt = 1; ?>
				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="left" width="22%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

							<tr style="">

								<td style="width:10%;font-weight:bold;padding-bottom:5px;text-align:center; ">Weight<br>(kg)</td>
								<td style="border-left:1px solid;width:12%;font-weight:bold;padding-bottom:5px;text-align:center; ">Density<br>(kg/m&sup3;)</td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) {
																									echo $row_select_pipe['mass_1'];
																								} else {
																									echo " <br>";
																								} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) {
																																							echo ($row_select_pipe['mass_1'] / 1000);
																																						} else {
																																							echo " <br>";
																																						} ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
																									echo $row_select_pipe['mass_2'];
																								} else {
																									echo " <br>";
																								} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
																																							echo ($row_select_pipe['mass_2'] / 1000);
																																						} else {
																																							echo " <br>";
																																						} ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
																									echo $row_select_pipe['mass_3'];
																								} else {
																									echo " <br>";
																								} ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
																																							echo ($row_select_pipe['mass_3'] / 1000);
																																						} else {
																																							echo " <br>";
																																						} ?></td>
							</tr>

						</table>

						<table align="right" width="45%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;margin-right:18%;">

							<tr style="">

								<td style="width:10%;font-weight:bold;padding-bottom:5px;text-align:left; ">&nbsp;&nbsp; Test method</td>
								<td style="border-left:1px solid;width:12%;padding-bottom:9px;padding-top:9px;text-align:center; ">IS-516:1959</td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:left; ">&nbsp;&nbsp; Curing Condition</td>
								<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:13px;padding-top:13px; ">IS-516:1959</td>
							</tr>

						</table>
					<?php
							if ($flag == 4) {
								break;
							}
						}

					?>
					</td>

				</tr>




				<tr>
					<td style="text-align:center;font-size:14px; ">

						<br><br>
						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

							<tr style="">

								<td style="width:75%;padding-bottom:20px;padding-top:12px;padding-left:80px;  ">&nbsp;&nbsp;Tested By</td>
								<td style="width:25%;text-align:left;">Checked By</td>
							</tr>

						</table><br><br>

					</td>
				</tr>

				<tr>
					<td style="text-align:right;font-size:11px; ">

						<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

							<tr style="">

								<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page 1 of 1</td>
							</tr>

						</table>

					</td>
				</tr>


				<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


				</div>
		</page>


		<?php

		if ($flag == 4) {
			$flag = 0;
			$down = $up;
			$up += 4;
		?>



			<div class="pagebreak"> </div>
	<?php }
	}

	?>


</body>

</html>


<script type="text/javascript">


</script>