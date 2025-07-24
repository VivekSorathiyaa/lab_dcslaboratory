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
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
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

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$detail_sample = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
	}

	$pagecnt = 1;
	$totalcnt = 1;
	if (($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) {
		$totalcnt++;
	}


	?>

	<br>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/G/OS/001</td>
							<td style="width:20%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 05/01/2023</td>
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
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;border-bottom:1px solid;border-top:3px solid;">

						<tr style="">

							<td style="width:100%;padding-bottom:10px;padding-top:2px; text-align:center;font-weight:bold; ">OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
							<td style="border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Sample received date</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Date of starting test</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="width:100%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; 1). Consistency Test,IS 4031(Part-4)-1988 (Reaffirmed 2019)</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;text-align:left;font-weight:bold;  ">&nbsp;&nbsp; Temp.:</td>
							<td style="border-left:1px solid;width:15%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['con_temp'] != "" && $row_select_pipe['con_temp'] != "0" && $row_select_pipe['con_temp'] != null) {
																																	echo $row_select_pipe['con_temp'];
																																} else {
																																	echo "&nbsp;";
																																} ?>&#8451; </td>
							<td style="border-left:1px solid;width:15%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Humidity (%) :</td>
							<td style="border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['con_humidity'] != "" && $row_select_pipe['con_humidity'] != "0" && $row_select_pipe['con_humidity'] != null) {
																									echo $row_select_pipe['con_humidity'];
																								} else {
																									echo "&nbsp;";
																								} ?> %</td>
							<td style="border-left:1px solid;width:30%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Weight of Cement</td>
							<td style="border-left:1px solid;width:20%; text-align:center; "><?php if ($row_select_pipe['con_weight'] != "" && $row_select_pipe['con_weight'] != "0" && $row_select_pipe['con_weight'] != null) {
																									echo number_format($row_select_pipe['con_weight'], 0) . " gm";
																								} else {
																									echo "&nbsp;";
																								} ?></td>
						</tr>

					</table>

				</td>
			</tr>
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:30px;">

						<tr style="">
							<td style="width:10%;text-align:center;font-weight:bold;  ">Sr.No.</td>
							<td style="border-left:1px solid;width:40%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; ">Volume of Water (cc)</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; ">% of Water</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold; ">Reading on Vicat</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['vol_1'] != "" && $row_select_pipe['vol_1'] != "0" && $row_select_pipe['vol_1'] != null) {
																																							echo $row_select_pipe['vol_1'];
																																						} else {
																																							echo "&nbsp;";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
																														echo $row_select_pipe['wtr_1'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['reading_1'] != "" && $row_select_pipe['reading_1'] != "0" && $row_select_pipe['reading_1'] != null) {
																														echo $row_select_pipe['reading_1'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['vol_2'] != "" && $row_select_pipe['vol_2'] != "0" && $row_select_pipe['vol_2'] != null) {
																																							echo $row_select_pipe['vol_2'];
																																						} else {
																																							echo "&nbsp;";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
																														echo $row_select_pipe['wtr_2'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['reading_2'] != "" && $row_select_pipe['reading_2'] != "0" && $row_select_pipe['reading_2'] != null) {
																														echo $row_select_pipe['reading_2'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['vol_3'] != "" && $row_select_pipe['vol_3'] != "0" && $row_select_pipe['vol_3'] != null) {
																																							echo $row_select_pipe['vol_3'];
																																						} else {
																																							echo "&nbsp;";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
																														echo $row_select_pipe['wtr_3'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['reading_3'] != "" && $row_select_pipe['reading_3'] != "0" && $row_select_pipe['reading_3'] != null) {
																														echo $row_select_pipe['reading_3'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['vol_4'] != "" && $row_select_pipe['vol_4'] != "0" && $row_select_pipe['vol_4'] != null) {
																																							echo $row_select_pipe['vol_4'];
																																						} else {
																																							echo "&nbsp;";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {
																														echo $row_select_pipe['wtr_4'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['reading_4'] != "" && $row_select_pipe['reading_4'] != "0" && $row_select_pipe['reading_4'] != null) {
																														echo $row_select_pipe['reading_4'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['vol_5'] != "" && $row_select_pipe['vol_5'] != "0" && $row_select_pipe['vol_5'] != null) {
																																							echo $row_select_pipe['vol_5'];
																																						} else {
																																							echo "&nbsp;";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['wtr_5'] != "" && $row_select_pipe['wtr_5'] != "0" && $row_select_pipe['wtr_5'] != null) {
																														echo $row_select_pipe['wtr_5'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['reading_5'] != "" && $row_select_pipe['reading_5'] != "0" && $row_select_pipe['reading_5'] != null) {
																														echo $row_select_pipe['reading_5'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="width:100%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; 2). Specific Surface Area m&sup2; / Kg.,IS 4031 (Part-2)-1999 (Rea. 2019 )</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="50%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="width:20%;text-align:left;font-weight:bold;  ">&nbsp;&nbsp; Temp.:</td>
							<td style="border-left:1px solid;width:30%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['fine_temp'] != "" && $row_select_pipe['fine_temp'] != "0" && $row_select_pipe['fine_temp'] != null) {
																																	echo $row_select_pipe['fine_temp'];
																																} else {
																																	echo "&nbsp;";
																																} ?> &#8451; </td>
							<td style="border-left:1px solid;width:30%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Humidity:</td>
							<td style="border-left:1px solid;width:20%; text-align:center; "><?php if ($row_select_pipe['fine_humidity'] != "" && $row_select_pipe['fine_humidity'] != "0" && $row_select_pipe['fine_humidity'] != null) {
																									echo $row_select_pipe['fine_humidity'];
																								} else {
																									echo "&nbsp;";
																								} ?> % </td>
						</tr>
					</table>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:30px;">

						<tr style="">
							<td style="width:20%;text-align:center;padding-left:50px;  " colspan=2>Time in Seconds (T)</td>
							<td style="width:80%;padding-bottom:15px;padding-top:2px; text-align:right; " rowspan=5>
								Sp. Surface area = <span style="border-bottom:1px solid;">SpecificSurfacearea of std.cement X √T</span><br>√Time of std.cement&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <br><br> = <span style="border-bottom:1px solid;"><?php if ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null) {
																																																																																		echo $row_select_pipe['ss_area'];
																																																																																	} else {
																																																																																		echo "&nbsp;";
																																																																																	} ?></span> m&sup2;/kg.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
						</tr>
						<tr style="">
							<td style="border-right:1px solid;border-top:1px solid;width:5%;text-align:center;font-weight:bold;  ">1</td>
							<td style="border-right:1px solid;border-top:1px solid;width:15%;text-align:center;font-weight:bold;  "><?php if ($row_select_pipe['fines_t_1'] != "" && $row_select_pipe['fines_t_1'] != "0" && $row_select_pipe['fines_t_1'] != null) {
																																		echo $row_select_pipe['fines_t_1'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
							<td></td>
						</tr>
						<tr style="">
							<td style="border-right:1px solid;border-top:1px solid;width:5%;text-align:center;font-weight:bold;  ">2</td>
							<td style="border-right:1px solid;border-top:1px solid;width:15%;text-align:center;font-weight:bold;  "><?php if ($row_select_pipe['fines_t_2'] != "" && $row_select_pipe['fines_t_2'] != "0" && $row_select_pipe['fines_t_2'] != null) {
																																		echo $row_select_pipe['fines_t_2'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
							<td></td>
						</tr>
						<tr style="">
							<td style="border-right:1px solid;border-top:1px solid;width:5%;text-align:center;font-weight:bold;  ">3</td>
							<td style="border-right:1px solid;border-top:1px solid;width:15%;text-align:center;font-weight:bold;  "><?php if ($row_select_pipe['fines_t_3'] != "" && $row_select_pipe['fines_t_3'] != "0" && $row_select_pipe['fines_t_3'] != null) {
																																		echo $row_select_pipe['fines_t_3'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
							<td></td>
						</tr>
						<tr style="">
							<td style="border-right:1px solid;border-top:1px solid;width:5%;text-align:center;font-weight:bold;  ">Average</td>
							<td style="border-right:1px solid;border-top:1px solid;width:15%;text-align:center;font-weight:bold;  "><?php if ($row_select_pipe['avg_fines_time'] != "" && $row_select_pipe['avg_fines_time'] != "0" && $row_select_pipe['avg_fines_time'] != null) {
																																		echo $row_select_pipe['avg_fines_time'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
							<td></td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="width:100%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; 3).Compressive Strength,IS:4031 (Part-6) -1988 (Reaffirmed-2019)</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-right:1px solid;">

						<tr style="">
							<td style="border-top:1px solid;width:15%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;   ">&nbsp;&nbsp; Temp.:</td>
							<td style="border-top:1px solid;border-left:1px solid;width:21%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><?php if ($row_select_pipe['com_temp'] != "" && $row_select_pipe['com_temp'] != "0" && $row_select_pipe['com_temp'] != null) {
																																											echo $row_select_pipe['com_temp'];
																																										} else {
																																											echo "&nbsp;";
																																										} ?>&nbsp;&nbsp; &#8451;</td>
							<td style="border-left:1px solid;width:22%;text-align:center;font-weight:bold; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:21%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Humidity:</td>
							<td style="border-top:1px solid;border-left:1px solid;width:21%; text-align:center;font-weight:bold; "><?php if ($row_select_pipe['com_humidity'] != "" && $row_select_pipe['com_humidity'] != "0" && $row_select_pipe['com_humidity'] != null) {
																																		echo $row_select_pipe['com_humidity'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?>&nbsp;&nbsp; %</td>
						</tr>
					</table>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:20px;">

						<tr style="">
							<td style="width:20%;text-align:left; ">&nbsp;&nbsp; Weight of Cement - <?php if ($row_select_pipe['weight_of_cement'] != "" && $row_select_pipe['weight_of_cement'] != "0" && $row_select_pipe['weight_of_cement'] != null) {
																										echo $row_select_pipe['weight_of_cement'];
																									} else {
																										echo "&nbsp;";
																									} ?> gm</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Weight of Std. Sand - <?php if ($row_select_pipe['weight_of_sand'] != "" && $row_select_pipe['weight_of_sand'] != "0" && $row_select_pipe['weight_of_sand'] != null) {
																																echo $row_select_pipe['weight_of_sand'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;  ">&nbsp;&nbsp; Volume of Water [% consistency/4]+3 X 8 = <?php if ($row_select_pipe['weight_of_water'] != "" && $row_select_pipe['weight_of_water'] != "0" && $row_select_pipe['weight_of_water'] != null) {
																																						echo $row_select_pipe['weight_of_water'];
																																					} else {
																																						echo "&nbsp;";
																																					} ?>&nbsp;&nbsp; CC</td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-top:1px solid;border-bottom:1px solid;margin-bottom:30px;">

						<tr style="">

							<td style="width:33.33%;text-align:left;font-weight:bold;  " colspan=3>&nbsp;&nbsp; Testing Date : <?php if ($row_select_pipe['avg_com_1'] != "") {
																																	echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																} ?></td>
							<td style="border-left:1px solid;width:33.33%; text-align:left;font-weight:bold; " colspan=3>&nbsp;&nbsp; Testing Date : <?php if ($row_select_pipe['avg_com_2'] != "") {
																																							echo date('d - m - Y', strtotime($row_select_pipe['test_date2']));
																																						} ?></td>
							<td style="border-left:1px solid;width:33.33%; text-align:left;font-weight:bold; " colspan=3>&nbsp;&nbsp; Testing Date : <?php if ($row_select_pipe['avg_com_3'] != "") {
																																							echo date('d - m - Y', strtotime($row_select_pipe['test_date3']));
																																						} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:33.33%;text-align:center;  " colspan=3>&nbsp;&nbsp; Reading in 3 Days</td>
							<td style="border-top:1px solid;border-left:1px solid;width:33.33%; text-align:center; " colspan=3>&nbsp;&nbsp; Reading in 7 Days</td>
							<td style="border-top:1px solid;border-left:1px solid;width:33.33%; text-align:center; " colspan=3>&nbsp;&nbsp; Reading in 28 Days</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;  ">KN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; ">mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; ">N/mm&sup2;</td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  ">KN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; ">mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; ">N/mm&sup2;</td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  ">KN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; ">mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; ">N/mm&sup2;</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;  "><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																								echo $row_select_pipe['load_1'];
																							} else {
																								echo "&nbsp;";
																							} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) {
																														echo $row_select_pipe['area_1'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
																														echo $row_select_pipe['load_4'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) {
																														echo $row_select_pipe['area_4'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																														echo $row_select_pipe['com_4'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
																														echo $row_select_pipe['load_7'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) {
																														echo $row_select_pipe['area_7'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
																														echo $row_select_pipe['com_7'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;  "><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																								echo $row_select_pipe['load_2'];
																							} else {
																								echo "&nbsp;";
																							} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) {
																														echo $row_select_pipe['area_2'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
																														echo $row_select_pipe['load_5'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) {
																														echo $row_select_pipe['area_5'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																														echo $row_select_pipe['com_5'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
																														echo $row_select_pipe['load_8'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) {
																														echo $row_select_pipe['area_8'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
																														echo $row_select_pipe['com_8'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;  "><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																								echo $row_select_pipe['load_3'];
																							} else {
																								echo "&nbsp;";
																							} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) {
																														echo $row_select_pipe['area_3'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
																														echo $row_select_pipe['load_6'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) {
																														echo $row_select_pipe['area_6'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
																														echo $row_select_pipe['com_6'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['load_9'] != "" && $row_select_pipe['load_9'] != "0" && $row_select_pipe['load_9'] != null) {
																														echo $row_select_pipe['load_9'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_9'] != "" && $row_select_pipe['area_9'] != "0" && $row_select_pipe['area_9'] != null) {
																														echo $row_select_pipe['area_9'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) {
																														echo $row_select_pipe['com_9'];
																													} else {
																														echo "&nbsp;";
																													} ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  " colspan=2>Average Comp. Strength</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) {
																																		echo $row_select_pipe['avg_com_1'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;font-weight:bold;  " colspan=2>Average Comp. Strength</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) {
																																		echo $row_select_pipe['avg_com_2'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
							<td style="border-top:1px solid;width:10%;text-align:center;border-left:1px solid;font-weight:bold;  " colspan=2>Average Comp. Strength</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null) {
																																		echo $row_select_pipe['avg_com_3'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?></td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page: 1/2</td>
						</tr>

					</table>

				</td>
			</tr>


			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
		</table>

		<div class="pagebreak">
			<div>
				<br>
				<br>
				<br>

				<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
					<tr>
						<td style="text-align:center;font-size:14px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

								<tr style="">

									<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/G/OS/001</td>
									<td style="width:20%;text-align:center;font-weight:bold; ">REV : 2</td>
									<td style="width:25%; font-weight:bold;">RD :- 05/01/2023</td>
									<td style="width:25%;font-weight:bold;">Page : 2</td>
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
						<td style="text-align:center;font-size:13px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;">

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
						<td style="text-align:center;font-size:14px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

								<tr style="">
									<td style="width:100%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; 4). Setting time,IS:4031 (Part-5)-1988 (Reaffirmed 2019)</td>

								</tr>

							</table><br>

						</td>
					</tr>

					<tr>
						<td style="text-align:center;font-size:13px; ">

							<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-top:1px solid;border-right:1px solid;margin-left:7.8%;">

								<tr style="">
									<td style="border-left:1px solid;width:20%;text-align:left;font-weight:bold;  ">&nbsp;&nbsp; Temp. : </td>
									<td style="border-left:1px solid;width:30%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['set_temp'] != "" && $row_select_pipe['set_temp'] != "0" && $row_select_pipe['set_temp'] != null) {
																																			echo $row_select_pipe['set_temp'];
																																		} else {
																																			echo "&nbsp;";
																																		} ?>&nbsp;&nbsp; &#8451;</td>
									<td style="border-left:1px solid;width:30%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Humidity : </td>
									<td style="border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['set_humidity'] != "" && $row_select_pipe['set_humidity'] != "0" && $row_select_pipe['set_humidity'] != null) {
																										echo $row_select_pipe['set_humidity'];
																									} else {
																										echo "&nbsp;";
																									} ?>&nbsp;&nbsp; %</td>
								</tr>
							</table>

						</td>
					</tr>

					<?php $cnt = 1; ?>
					<tr>
						<td style="text-align:center;font-size:13px; ">

							<table align="left" width="77.8%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;border-top:1px solid;margin-bottom:50px;">

								<tr style="">
									<td style="width:10%;text-align:center; " colspan=4>Weight of Cement = <?php if ($row_select_pipe['set_weight'] != "" && $row_select_pipe['set_weight'] != "0" && $row_select_pipe['set_weight'] != null) {
																												echo $row_select_pipe['set_weight'];
																											} else {
																												echo "&nbsp;";
																											} ?> gm</td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;  " colspan=4>Water = 0.85 x Consistency in % x 4=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if ($row_select_pipe['set_wtr'] != "" && $row_select_pipe['set_wtr'] != "0" && $row_select_pipe['set_wtr'] != null) {
																																																				echo $row_select_pipe['set_wtr'];
																																																			} else {
																																																				echo "&nbsp;";
																																																			} ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; CC</td>
								</tr>

								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:5px;padding-top:5px; text-align:left; "> &nbsp;&nbsp; Time when water added :</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:left;">&nbsp;:- Hours/Min</td>
									<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['hr_a'] != "" && $row_select_pipe['hr_a'] != "0" && $row_select_pipe['hr_a'] != null) {
																																echo $row_select_pipe['hr_a'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Initial setting time</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:left;">&nbsp;:- Hours/Min</td>
									<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['hr_b'] != "" && $row_select_pipe['hr_b'] != "0" && $row_select_pipe['hr_b'] != null) {
																																echo $row_select_pipe['hr_b'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:40%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Final setting time</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:left;">&nbsp;:- Hours/Min</td>
									<td style="border-top:1px solid;border-left:1px solid;width:30%; text-align:center;"><?php if ($row_select_pipe['hr_c'] != "" && $row_select_pipe['hr_c'] != "0" && $row_select_pipe['hr_c'] != null) {
																																echo $row_select_pipe['hr_c'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
							</table>

						</td>
					</tr>

					<tr>
						<td style="text-align:center;font-size:13px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

								<tr style="">
									<td style="width:100%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; 5). Soundness by Le-chatelier, IS:4031 (Part-3)-1988 (Reaffirmed 2019)</td>

								</tr>

							</table><br>

						</td>
					</tr>

					<tr>
						<td style="text-align:center;font-size:13px; ">

							<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-top:1px solid;border-right:1px solid;margin-left:7.8%;">

								<tr style="">
									<td style="border-left:1px solid;width:20%;text-align:left;font-weight:bold;  ">&nbsp;&nbsp; Temp.:</td>
									<td style="border-left:1px solid;width:30%;padding-bottom:2px;padding-top:2px; text-align:center; "><?php if ($row_select_pipe['sou_temp'] != "" && $row_select_pipe['sou_temp'] != "0" && $row_select_pipe['sou_temp'] != null) {
																																			echo $row_select_pipe['sou_temp'];
																																		} else {
																																			echo "&nbsp;";
																																		} ?>&nbsp;&nbsp; &#8451;</td>
									<td style="border-left:1px solid;width:30%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Humidity:</td>
									<td style="border-left:1px solid;width:20%; text-align:center; "><?php if ($row_select_pipe['sou_humidity'] != "" && $row_select_pipe['sou_humidity'] != "0" && $row_select_pipe['sou_humidity'] != null) {
																											echo $row_select_pipe['sou_humidity'];
																										} else {
																											echo "&nbsp;";
																										} ?>&nbsp;&nbsp; %</td>
								</tr>
							</table>

						</td>
					</tr>

					<?php $cnt = 1; ?>
					<tr>
						<td style="text-align:center;font-size:13px; ">

							<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:30px;">

								<tr style="">
									<td style="width:50%;text-align:left; " colspan=2>&nbsp;&nbsp; Weight of Cement : - &nbsp;&nbsp;&nbsp; <?php if ($row_select_pipe['sou_weight'] != "" && $row_select_pipe['sou_weight'] != "0" && $row_select_pipe['sou_weight'] != null) {
																																				echo number_format($row_select_pipe['sou_weight'], 0);
																																			} else {
																																				echo "&nbsp;";
																																			} ?> gms</td>
									<td style="width:40%;text-align:left;border-left:1px solid;  " colspan=2>&nbsp;&nbsp; Water = 0.78 x Consistency in % x 2&nbsp;&nbsp;&nbsp; = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
									<td style="width:20%;text-align:center;border-left:1px solid;  "><?php if ($row_select_pipe['sou_water'] != "" && $row_select_pipe['sou_water'] != "0" && $row_select_pipe['sou_water'] != null) {
																											echo $row_select_pipe['sou_water'];
																										} else {
																											echo "&nbsp;";
																										} ?> &nbsp;&nbsp; C.C.</td>
								</tr>

								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  ">Sr.</td>
									<td style="border-top:1px solid;border-left:1px solid;width:30%;padding-bottom:5px;padding-top:5px; text-align:center; "> Distance between two</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;">Reading after 3 hrs.</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;">Difference (mm)</td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;">Average (mm)</td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:30%;padding-bottom:3px;padding-top:3px; text-align:center; "><?php if ($row_select_pipe['dis_1_1'] != "" && $row_select_pipe['dis_1_1'] != "0" && $row_select_pipe['dis_1_1'] != null) {
																																									echo $row_select_pipe['dis_1_1'];
																																								} else {
																																									echo "&nbsp;";
																																								} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['dis_2_1'] != "" && $row_select_pipe['dis_2_1'] != "0" && $row_select_pipe['dis_2_1'] != null) {
																																echo $row_select_pipe['dis_2_1'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['diff_1'] != "" && $row_select_pipe['diff_1'] != "0" && $row_select_pipe['diff_1'] != null) {
																																echo $row_select_pipe['diff_1'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
																																echo $row_select_pipe['soundness'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:30%;padding-bottom:3px;padding-top:3px; text-align:center; "><?php if ($row_select_pipe['dis_1_2'] != "" && $row_select_pipe['dis_1_2'] != "0" && $row_select_pipe['dis_1_2'] != null) {
																																									echo $row_select_pipe['dis_1_2'];
																																								} else {
																																									echo "&nbsp;";
																																								} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['dis_2_2'] != "" && $row_select_pipe['dis_2_2'] != "0" && $row_select_pipe['dis_2_2'] != null) {
																																echo $row_select_pipe['dis_2_2'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['diff_2'] != "" && $row_select_pipe['diff_2'] != "0" && $row_select_pipe['diff_2'] != null) {
																																echo $row_select_pipe['diff_2'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center;"><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
																																echo $row_select_pipe['soundness'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>

							</table>

						</td>
					</tr>
					<tr>
						<td style="text-align:center;font-size:14px; ">

							<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

								<tr style="">
									<td style="width:100%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; 6). Density of Cement, IS:4031 (Part-11)-1988 (Reaffirmed 2019)</td>

								</tr>

							</table><br>

						</td>
					</tr>


					<?php $cnt = 1; ?>
					<tr>
						<td style="text-align:center;font-size:13px; ">

							<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:40px;">

								<tr style="">
									<td style="width:10%;text-align:center;font-weight:bold;  ">Sr.No</td>
									<td style="border-left:1px solid;width:60%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; "> Particular</td>
									<td style="border-left:1px solid;width:15%; text-align:center;font-weight:bold;">1</td>
									<td style="border-left:1px solid;width:15%; text-align:center;font-weight:bold;">2</td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:60%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Wt of Cement (gm)</td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;">64 gm</td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;">64 gm</td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:60%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Intial Reading of Le-Chetelier Flask</td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['den_intial'] != "" && $row_select_pipe['den_intial'] != "0" && $row_select_pipe['den_intial'] != null) {
																																echo $row_select_pipe['den_intial'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['den_intial1'] != "" && $row_select_pipe['den_intial1'] != "0" && $row_select_pipe['den_intial1'] != null) {
																																echo $row_select_pipe['den_intial1'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:60%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Final Reading of Le-Chetelier Flask after cement pouring</td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['den_final'] != "" && $row_select_pipe['den_final'] != "0" && $row_select_pipe['den_final'] != null) {
																																echo $row_select_pipe['den_final'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['den_final1'] != "" && $row_select_pipe['den_final1'] != "0" && $row_select_pipe['den_final1'] != null) {
																																echo $row_select_pipe['den_final1'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:60%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Volume of Displacement</td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['den_displaced'] != "" && $row_select_pipe['den_displaced'] != "0" && $row_select_pipe['den_displaced'] != null) {
																																echo $row_select_pipe['den_displaced'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['den_displaced1'] != "" && $row_select_pipe['den_displaced1'] != "0" && $row_select_pipe['den_displaced1'] != null) {
																																echo $row_select_pipe['den_displaced1'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>
								<tr style="">
									<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:60%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp; Density of Cement</td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['density'] != "" && $row_select_pipe['density'] != "0" && $row_select_pipe['density'] != null) {
																																echo $row_select_pipe['density'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
									<td style="border-top:1px solid;border-left:1px solid;width:15%; text-align:center;"><?php if ($row_select_pipe['density1'] != "" && $row_select_pipe['density1'] != "0" && $row_select_pipe['density1'] != null) {
																																echo $row_select_pipe['density1'];
																															} else {
																																echo "&nbsp;";
																															} ?></td>
								</tr>

							</table>

						</td>
					</tr>

					<tr>
						<td style="text-align:center;font-size:14px; ">

							<table align="center" width="70%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

								<tr style="">

									<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By</td>
									<td style="width:20%;text-align:left;font-weight:bold; ">Checked By</td>
								</tr>

							</table><br>

						</td>
					</tr>


					<tr>
						<td style="text-align:right;font-size:11px; ">

							<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

								<tr style="">

									<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page: 2/2</td>
								</tr>

							</table>

						</td>
					</tr>


					<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


					</div>

				</table>


	</page>





</body>

</html>


<script type="text/javascript">


</script>