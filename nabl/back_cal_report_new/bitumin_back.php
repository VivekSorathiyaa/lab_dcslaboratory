<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 30px 10px;
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
	$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	<page size="A4">
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-008</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR<br>Bitumen</b></center>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;padding: 3px;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;padding: 3px;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;padding: 3px;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding: 3px;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Grade of Bitumen</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo $row_select_pipe['bitumin_grade']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo date("d - m - Y",strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;"><b>&nbsp; Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:left;padding: 3px;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
			</tr>
		</table>
			
		<br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">
						<tr style="">
							<td style="font-size:13px;font-weight:bold;border-bottom:1px solid;padding: 6px;" colspan="3">1. Penetration Test  IS 1203-2022</td>
							<td style="padding: 6px; text-align:right;font-weight:bold;border-bottom:1px solid;">Test Temp <?php if ($row_select_pipe['pen_temp'] != "" && $row_select_pipe['pen_temp'] != "0" && $row_select_pipe['pen_temp'] != null) {
																																																			echo $row_select_pipe['pen_temp'];
																																																		} else {
																																																			echo " <br>";
																																																		} ?></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;">1</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;">2</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;">3</td>
							<td style="border-left:1px solid;text-align:center;">Average Value</td>
						</tr>
						<tr>
							<td style="border-top:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['pen_1'] != "" && $row_select_pipe['pen_1'] != "0" && $row_select_pipe['pen_1'] != null) {
																													echo $row_select_pipe['pen_1'];
																												} else {
																													echo " <br>";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;text-align:center;padding: 6px 0; "><?php if ($row_select_pipe['pen_2'] != "" && $row_select_pipe['pen_2'] != "0" && $row_select_pipe['pen_2'] != null) {
																																	echo $row_select_pipe['pen_2'];
																																} else {
																																	echo " <br>";
																																} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['pen_3'] != "" && $row_select_pipe['pen_3'] != "0" && $row_select_pipe['pen_3'] != null) {
																																	echo $row_select_pipe['pen_3'];
																																} else {
																																	echo " <br>";
																																} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;padding: 6px 0; text-align:center;font-weight:bold;" colspan=2><?php if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != "0" && $row_select_pipe['avg_pen'] != null) {
																												echo $row_select_pipe['avg_pen'];
																											} else {
																												echo " <br>";
																											} ?></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">
						<tr style="">
							<td style="font-size:13px;font-weight:bold;border-bottom:1px solid;padding: 6px;" colspan="3">2. Ductility Test  IS 1208 Part 1-2023</td>
							<td style="padding: 6px; text-align:right;font-weight:bold;border-bottom:1px solid;">Test Temp <?php if ($row_select_pipe['pen_temp'] != "" && $row_select_pipe['pen_temp'] != "0" && $row_select_pipe['pen_temp'] != null) {
																																																			echo $row_select_pipe['pen_temp'];
																																																		} else {
																																																			echo " <br>";
																																																		} ?></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;">1</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;">2</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;">3</td>
							<td style="border-left:1px solid;text-align:center;">Average Value (in cm)</td>
						</tr>
						<tr>
							<td style="border-top:1px solid;text-align:center;padding: 6px 0; "><?php if ($row_select_pipe['duc_1'] != "" && $row_select_pipe['duc_1'] != "0" && $row_select_pipe['duc_1'] != null) {
																														echo $row_select_pipe['duc_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['duc_2'] != "" && $row_select_pipe['duc_2'] != "0" && $row_select_pipe['duc_2'] != null) {
																														echo $row_select_pipe['duc_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['duc_3'] != "" && $row_select_pipe['duc_3'] != "0" && $row_select_pipe['duc_3'] != null) {
																														echo $row_select_pipe['duc_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;padding: 6px 0; text-align:center;font-weight:bold;" colspan=2><?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != "0" && $row_select_pipe['avg_duc'] != null) {
																												echo $row_select_pipe['avg_duc'];
																											} else {
																												echo " <br>";
																											} ?></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">
						<tr style="">
							<td style="font-size:13px;font-weight:bold;border-bottom:1px solid;padding: 6px; 0" colspan="2">3. Softening Point  IS 1205-2022</td>
							<td style="padding: 6px; text-align:right;font-weight:bold;border-bottom:1px solid;">Test Temp <?php if ($row_select_pipe['sof_temp'] != "" && $row_select_pipe['sof_temp'] != "0" && $row_select_pipe['sof_temp'] != null) {
																																																									echo $row_select_pipe['sof_temp'];
																																																								} else {
																																																									echo " <br>";
																																																								} ?></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;">1</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;">2</td>
							<td style="border-left:1px solid;text-align:center;">Average Value (in °C)</td>
						</tr>
						<tr>
							<td style="border-top:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['sof_0'] != "" && $row_select_pipe['sof_0'] != "0" && $row_select_pipe['sof_0'] != null) {
																														echo $row_select_pipe['sof_0'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;text-align:center; padding: 6px 0;"><?php if ($row_select_pipe['sof_1'] != "" && $row_select_pipe['sof_1'] != "0" && $row_select_pipe['sof_1'] != null) {
																														echo $row_select_pipe['sof_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;padding: 6px 0; text-align:center;font-weight:bold;" colspan=2><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != "0" && $row_select_pipe['avg_sof'] != null) {
																														echo $row_select_pipe['avg_sof'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">
						<tr style="">
							<td style="font-size:13px;font-weight:bold;padding: 6px;border:1px solid; border-bottom: 0;" colspan="3">4. Specific Gravity Test IS 1202-2021</td>
						</tr>
						<?php $cnt = 1; ?>
						<tr>
							<td style="text-align:center;font-size:14px; ">

								<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;margin-bottom:20px;">

									<tr style="">

										<td style="width:70%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp;Weight of Specific Gravity Bottle (A)</td>
										<td style="border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_a_1'] != "" && $row_select_pipe['sp_a_1'] != "0" && $row_select_pipe['sp_a_1'] != null) {
																												echo $row_select_pipe['sp_a_1'];
																											} else {
																												echo " <br>";
																											} ?></td>
									</tr>
									<tr style="">

										<td style="border-top:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp;Weight of Specific Gravity Bottle filled with Distilled Water (B)</td>
										<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_b_1'] != "" && $row_select_pipe['sp_b_1'] != "0" && $row_select_pipe['sp_b_1'] != null) {
																																	echo $row_select_pipe['sp_b_1'];
																																} else {
																																	echo " <br>";
																																} ?></td>
									</tr>
									<tr style="">

										<td style="border-top:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp;Weight of Specific Gravity Bottle about Half filled bitumen (C)</td>
										<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_c_1'] != "" && $row_select_pipe['sp_c_1'] != "0" && $row_select_pipe['sp_c_1'] != null) {
																																	echo $row_select_pipe['sp_c_1'];
																																} else {
																																	echo " <br>";
																																} ?></td>
									</tr>
									<tr style="">

										<td style="border-top:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left;padding-left:6px; ">Weight of Specific Gravity Bottle about Half filled with bitumen and the rest with distilled water (D)</td>
										<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_d_1'] != "" && $row_select_pipe['sp_d_1'] != "0" && $row_select_pipe['sp_d_1'] != null) {
																																	echo $row_select_pipe['sp_d_1'];
																																} else {
																																	echo " <br>";
																																} ?></td>
									</tr>

								</table>

							</td>
						</tr>

						<tr>
							<td style="text-align:center;font-size:14px; ">

								<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

									<tr style="">

										<td style="width:33.3%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;padding-left:100px;  ">Specific Gravity &nbsp;&nbsp;&nbsp;&nbsp; = &nbsp;&nbsp;&nbsp;&nbsp;</td>
										<td style="width:16.7%;padding-bottom:2px;padding-top:2px; text-align:center;border-bottom:1px solid;  ">[C - A]</td>
										<td style="width:50%;padding-bottom:2px;padding-top:2px; text-align:left; ">&nbsp;&nbsp;&nbsp;&nbsp;Air Cooling - ½ HR</td>
									</tr>
									<tr style="">

										<td style="width:33.3%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;padding-left:100px;  "></td>
										<td style="width:16.7%;padding-bottom:2px;padding-top:2px; text-align:center;  ">[B - A] - [D - C]</td>
										<td style="width:50%;padding-bottom:2px;padding-top:2px; text-align:left; ">&nbsp;&nbsp;&nbsp;&nbsp;Water Cooling - ½ HR 27°C Temp.</td>
									</tr>

								</table><br>

							</td>
						</tr>
						<tr>
							<td style="text-align:center;font-size:14px; ">

								<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

									<tr style="">

										<td style="width:33%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;padding-left:100px;  ">Specific Gravity &nbsp;&nbsp;&nbsp;&nbsp; = </td>
										<td style="width:66%;padding-bottom:2px;padding-top:2px; text-align:left;  "><span style="">&nbsp;&nbsp; <?php if ($row_select_pipe['sp_1'] != "" && $row_select_pipe['sp_1'] != "0" && $row_select_pipe['sp_1'] != null) {
																																								echo $row_select_pipe['sp_1'];
																																							} else {
																																								echo " <br>";
																																							} ?> </span></td>
									</tr>
								</table><br>

							</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>

		<br><br><br><br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top: 2px solid #ccc;">
			<tr style="padding-top:5px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Page 1 of 3</b></td>
			</tr>		
		</table>


		<div class="pagebreak"></div>


		<br><br>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-008</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR<br>Bitumen</b></center>
				</td>
			</tr>
		</table>
		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" colspan="8">5. Absolute Viscosity: -   IS 1206 (Part 2)-2022</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;">
						<!-- <tr style="">
							<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;" colspan="8">5. Absolute Viscosity: -   IS 1206 (Part 2)-2022</td>
						</tr> -->
						<tr>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Sr No.</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Test</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Bulb</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Test Temperature</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Tube Constant</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Time (second)</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Viscosity  = Constant X Time</td>
							<td style="text-align:center;padding: 6px 0;border-bottom: 1px solid;width: 10%;">Unit</td>
						</tr>
						<tr>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;" rowspan="3"><?php echo $cnt++; ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;" rowspan="3">Absolute Viscosity</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;">[b]</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;" rowspan="2">60 °C  <br>  30cmHg Vacuum</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_3_1'] != "" && $row_select_pipe['abs_3_1'] != "0" && $row_select_pipe['abs_3_1'] != null) {
																														echo $row_select_pipe['abs_3_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_4_1'] != "" && $row_select_pipe['abs_4_1'] != "0" && $row_select_pipe['abs_4_1'] != null) {
																														echo $row_select_pipe['abs_4_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_5_1'] != "" && $row_select_pipe['abs_5_1'] != "0" && $row_select_pipe['abs_5_1'] != null) {
																														echo $row_select_pipe['abs_5_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="text-align:center;padding: 6px 0;border-bottom: 1px solid;">Poise</td>
						</tr>
						<tr>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-top:1px solid;">[c]</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-top:1px solid;"><?php if ($row_select_pipe['abs_6_1'] != "" && $row_select_pipe['abs_6_1'] != "0" && $row_select_pipe['abs_6_1'] != null) {
																														echo $row_select_pipe['abs_6_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-top:1px solid;"><?php if ($row_select_pipe['abs_7_1'] != "" && $row_select_pipe['abs_7_1'] != "0" && $row_select_pipe['abs_7_1'] != null) {
																														echo $row_select_pipe['abs_7_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-top:1px solid;"><?php if ($row_select_pipe['abs_8_1'] != "" && $row_select_pipe['abs_8_1'] != "0" && $row_select_pipe['abs_8_1'] != null) {
																														echo $row_select_pipe['abs_8_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="text-align:center;padding: 6px 0;border-bottom: 1px solid;">Poise</td>
						</tr>
						<tr>
							<td style="border-right:1px solid;border-top:1px solid;text-align:right;padding: 6px 0;" colspan="4">Avareage &nbsp;&nbsp;</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-top:1px solid;"><?php if ($row_select_pipe['avg_abs'] != "" && $row_select_pipe['avg_abs'] != null && $row_select_pipe['avg_abs'] != "0") {
																								echo number_format($row_select_pipe['avg_abs'], 1);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="text-align:center;padding: 6px 0;">Poise</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" colspan="8">6. Kinematic Viscosity  IS 1206 (Part 3)-2021</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;">
						<tr>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Sr No.</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Test</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Bulb</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Test Temperature</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Tube Constant</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Time (second)</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Viscosity  = Constant X Time</td>
							<td style="text-align:center;padding: 6px 0;border-bottom: 1px solid;width: 10%;">Unit</td>
						</tr>
						<tr>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php echo $cnt++; ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;">Kinematic <br> Viscosity</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;">[a]</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;">135 °C</td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['kin_6_1'] != "" && $row_select_pipe['kin_6_1'] != "0" && $row_select_pipe['kin_6_1'] != null) {
																								echo $row_select_pipe['kin_6_1'];
																							} else {
																								echo " <br>";
																							} ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['kin_5_1'] != "" && $row_select_pipe['kin_5_1'] != "0" && $row_select_pipe['kin_5_1'] != null) {
																								echo $row_select_pipe['kin_5_1'];
																							} else {
																								echo " <br>";
																							} ?></td>
							<td style="border-right:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['avg_kin'] != "" && $row_select_pipe['avg_kin'] != null && $row_select_pipe['avg_kin'] != "0") {
																								echo number_format($row_select_pipe['avg_kin'], 1);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="text-align:center;padding: 6px 0;">C.st</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<!-- <tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" colspan="3">7. Solubility in trichloroethylene IS 1216 - 1978	</td>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" >&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>
			</tr> -->
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:0;">
						<tr>
							<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" colspan="3">7. Solubility in trichloroethylene IS 1216 - 1978	</td>
							<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;text-align: right;" >&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?> &nbsp; &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;">
						<tr>
							<td style="text-align:center;padding: 6px 0;border-bottom: 1px solid;">Sr No.</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Wt. of Bitumen (W1) <br> g</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Wt. residue (W2) <br> g</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom: 1px solid;">Solubility <br> %</td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['w1_1']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['w2_1']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['sol_1']; ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" colspan="7">8. Absolute Viscosity on Residue IS 1216 – 1978</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;">
						<!-- <tr style="">
							<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;" colspan="8">5. Absolute Viscosity: -   IS 1206 (Part 2)-2022</td>
						</tr> -->
						<tr>
							<td style="text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Time req. by bitumen to<br> cross the bulb-B <br> (t1)</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Bulb-b Factor <br> (k1)</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Flow time <br> (tB=t1k1)<br> Sec.</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Time req. by bitumen to<br> cross the Bulb-C <br>(t2)</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Bulb-b Factor<br> (k2)</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Flow time<br> (tB=t2k2)<br> Sec.</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Absolute Viscosity<br> (tB + tc)/2 Poise</td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_4_1'] != "" && $row_select_pipe['abs_4_1'] != "0" && $row_select_pipe['abs_4_1'] != null) {
																														echo $row_select_pipe['abs_4_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_3_1'] != "" && $row_select_pipe['abs_3_1'] != "0" && $row_select_pipe['abs_3_1'] != null) {
																														echo $row_select_pipe['abs_3_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_5_1'] != "" && $row_select_pipe['abs_5_1'] != "0" && $row_select_pipe['abs_5_1'] != null) {
																														echo $row_select_pipe['abs_5_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_7_1'] != "" && $row_select_pipe['abs_7_1'] != "0" && $row_select_pipe['abs_7_1'] != null) {
																														echo $row_select_pipe['abs_7_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_6_1'] != "" && $row_select_pipe['abs_6_1'] != "0" && $row_select_pipe['abs_6_1'] != null) {
																														echo $row_select_pipe['abs_6_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_8_1'] != "" && $row_select_pipe['abs_8_1'] != "0" && $row_select_pipe['abs_8_1'] != null) {
																														echo $row_select_pipe['abs_8_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['abs_9_1'] != "" && $row_select_pipe['abs_9_1'] != "0" && $row_select_pipe['abs_9_1'] != null) {
																														echo $row_select_pipe['abs_9_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" style="">
			<tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;">9. Viscosity Ratio</td>
			</tr>
			<tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;"></td>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;"> Viscosity ratio = Absolute Viscosity from Residue at 600C/Absolute Viscosity to unaged bitumen at 60 °C</td>
			</tr>	
		</table>

		<br><br><br><br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top: 2px solid #ccc;">
			<tr style="padding-top:5px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Page 2 of 3</b></td>
			</tr>		
		</table>

		<div class="pagebreak"></div>

		<br><br>

		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-008</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR<br>Bitumen</b></center>
				</td>
			</tr>
		</table>
		<br><br>

		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;padding-bottom: 10px;" colspan="7">10. Flash & Fire Point IS 1209 - 2021</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;">
						<!-- <tr style="">
							<td style="font-size:13px;font-weight:bold;padding: 6px;border: 0;" colspan="8">5. Absolute Viscosity: -   IS 1206 (Part 2)-2022</td>
						</tr> -->
						<tr>
							<td style="text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Sr. No.</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Grade of Bitumen</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Rate of heating time Minutes</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Temperature °C</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Flash point</td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;">Fire point</td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['bitumin_grade']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['time_1']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fla_temp']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fla_1'];?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fire_1'];?></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['bitumin_grade']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['time_2']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fla_temp']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fla_2'];?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fire_2'];?></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['bitumin_grade']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['time_3']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fla_temp']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fla_3'];?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $row_select_pipe['fire_3'];?></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['bitumin_grade']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['time_4']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['fla_temp']; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['fla_4'];?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php echo $row_select_pipe['fire_4'];?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="margin-bottom: 20px;" Height="20%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>

		<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top: 2px solid #ccc;">
			<tr style="padding-top:5px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Page 3 of 3</b></td>
			</tr>		
		</table>




		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<!-- <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;margin-top:15px;"> -->
			<!-- <tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px ;padding-top:2px ; ">&nbsp;&nbsp; DOC : GOMAEC/L/OS/001</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 09/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : 1</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding-bottom:2px ;padding-top:2px ;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:75%;padding-left:200px; text-align:center;font-weight:bold;padding-bottom:2px ;padding-top:4px ; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:200px;padding-bottom:2px ;padding-top:2px ; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:200px;padding-bottom:2px ;padding-top:2px ; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:200px;padding-bottom:2px ;padding-top:2px ; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:8px;padding-top:0px; text-align:center;padding-left:200px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table>
				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:100%; text-align:center;font-weight:bold; "> OBSERVATION AND CALCULAITON SHEET FOR TEST ON BITUMEN</td>
						</tr>

					</table><br>

				</td>
			</tr> 


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
							<td style="border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Date of receipt of sample</td>
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
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Grade of Bitumen</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['bitumin_grade']; ?></td>
						</tr>

					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="30%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;margin-right:80px;">

						<tr style="">

							<td style="width:60%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;border:1px solid; "><span style=""> &nbsp;&nbsp; Temp. of Room:</td>
							<td style="width:40%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold;border:1px solid;border-left:0px; "><span style=""><?php if ($row_select_pipe['room_temp'] != "" && $row_select_pipe['room_temp'] != "0" && $row_select_pipe['room_temp'] != null) {
																																												echo $row_select_pipe['room_temp'];
																																											} else {
																																												echo " <br>";
																																											} ?></td>

						</tr>

					</table><br>

				</td>
			</tr>-->

			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[1]</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Penetration Test [ IS : 1203 ]</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">

						<tr style="">

							<td style="width:30%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;padding-left:100px;  ">Date:</td>
							<td style="width:70%;padding-bottom:2px;padding-top:2px;padding-left:100px; text-align:left;font-weight:bold; ">Casting Time:<span style="border-bottom:1px solid;"><?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																																																	echo $row_select_pipe['caste_date1'];
																																																} else {
																																																	echo " <br>";
																																																} ?></span></td>
						</tr>
						<tr style="">

							<td style="width:30%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;padding-left:100px;  ">Temp: <span style="border-bottom:1px solid;"><?php if ($row_select_pipe['pen_temp'] != "" && $row_select_pipe['pen_temp'] != "0" && $row_select_pipe['pen_temp'] != null) {
																																																echo $row_select_pipe['pen_temp'];
																																															} else {
																																																echo " <br>";
																																															} ?></span></td>
							<td style="width:70%;padding-bottom:2px;padding-top:2px;padding-left:100px; 	 text-align:left;font-weight:bold; ">Testing Time:<span style="border-bottom:1px solid;"><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																																			echo $row_select_pipe['test_date1'];
																																																		} else {
																																																			echo " <br>";
																																																		} ?></span></td>

						</tr>

					</table><br>

				</td>
			</tr> -->

			<!-- <?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;margin-left:60px;margin-bottom:20px;">

						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">Sr.No.</td>
							<td style="border-left:1px solid;width:30%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold; ">Initial Reading<br>(one tenth of mm)</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold; ">Final Readings<br>(one tenth of mm)</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold; ">Penetration<br>(one tenth of mm)</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pint_1'] != "" && $row_select_pipe['pint_1'] != "0" && $row_select_pipe['pint_1'] != null) {
																														echo $row_select_pipe['pint_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pfin_1'] != "" && $row_select_pipe['pfin_1'] != "0" && $row_select_pipe['pfin_1'] != null) {
																														echo $row_select_pipe['pfin_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pen_1'] != "" && $row_select_pipe['pen_1'] != "0" && $row_select_pipe['pen_1'] != null) {
																														echo $row_select_pipe['pen_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pint_2'] != "" && $row_select_pipe['pint_2'] != "0" && $row_select_pipe['pint_2'] != null) {
																														echo $row_select_pipe['pint_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pfin_2'] != "" && $row_select_pipe['pfin_2'] != "0" && $row_select_pipe['pfin_2'] != null) {
																														echo $row_select_pipe['pfin_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pen_2'] != "" && $row_select_pipe['pen_2'] != "0" && $row_select_pipe['pen_2'] != null) {
																														echo $row_select_pipe['pen_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pint_3'] != "" && $row_select_pipe['pint_3'] != "0" && $row_select_pipe['pint_3'] != null) {
																														echo $row_select_pipe['pint_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pfin_3'] != "" && $row_select_pipe['pfin_3'] != "0" && $row_select_pipe['pfin_3'] != null) {
																														echo $row_select_pipe['pfin_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['pen_3'] != "" && $row_select_pipe['pen_3'] != "0" && $row_select_pipe['pen_3'] != null) {
																														echo $row_select_pipe['pen_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:40%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;" colspan=2>Average value=</td>
							<td style="border-top:1px solid;border-left:1px solid;width:60%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;" colspan=2><?php if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != "0" && $row_select_pipe['avg_pen'] != null) {
																																													echo $row_select_pipe['avg_pen'];
																																												} else {
																																													echo " <br>";
																																												} ?></td>
						</tr>

					</table>

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[2]</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Softening Point [ IS : 1205 ]</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">

						<tr style="">

							<td style="width:10%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold;padding-left:100px;  ">Date:_____________</td>
							<td style="width:90%;padding-bottom:2px;padding-top:2px;padding-left:100px; text-align:left;font-weight:bold; ">Casting Time:<span style="border-bottom:1px solid;"><?php if ($row_select_pipe['caste_date2'] != "" && $row_select_pipe['caste_date2'] != "0" && $row_select_pipe['caste_date2'] != null) {
																																																	echo $row_select_pipe['caste_date2'];
																																																} else {
																																																	echo " <br>";
																																																} ?></span></td>
						</tr>
						<tr style="">

							<td style="width:10%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold;padding-left:100px;  ">Temp:&nbsp;&nbsp;&nbsp;<span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['sof_temp'] != "" && $row_select_pipe['sof_temp'] != "0" && $row_select_pipe['sof_temp'] != null) {
																																																									echo $row_select_pipe['sof_temp'];
																																																								} else {
																																																									echo " <br>";
																																																								} ?>&nbsp;&nbsp;&nbsp;</span></td>
							<td style="width:90%;padding-bottom:2px;padding-top:2px;padding-left:100px; 	 text-align:left;font-weight:bold; ">Testing Time:<span style="border-bottom:1px solid;"><?php if ($row_select_pipe['test_date2'] != "" && $row_select_pipe['test_date2'] != "0" && $row_select_pipe['test_date2'] != null) {
																																																			echo $row_select_pipe['test_date2'];
																																																		} else {
																																																			echo " <br>";
																																																		} ?></span></td>

						</tr>

					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;margin-left:60px;margin-bottom:20px;">

						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">Observation</td>
							<td style="border-left:1px solid;width:30%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold; ">Temperature (0C) of Water</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%;text-align:center;padding-bottom:3px;padding-top:3px; ">Temperature (&deg;C) of Water</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['sof_0'] != "" && $row_select_pipe['sof_0'] != "0" && $row_select_pipe['sof_0'] != null) {
																														echo $row_select_pipe['sof_0'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%;text-align:center;padding-bottom:3px;padding-top:3px; ">Ball 2 touches the plate</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['sof_1'] != "" && $row_select_pipe['sof_1'] != "0" && $row_select_pipe['sof_1'] != null) {
																														echo $row_select_pipe['sof_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%;text-align:center;padding-bottom:3px;padding-top:3px; ">Average &deg;C</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != "0" && $row_select_pipe['avg_sof'] != null) {
																														echo $row_select_pipe['avg_sof'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr> -->

			<!--div class="pagebreak"> </div>
		<br>
		<br-->

			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[3]</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Ductility Test [ IS : 1208 ]</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;">

						<tr style="">

							<td style="width:10%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold;padding-left:100px;  ">Date:_____________</td>
							<td style="width:90%;padding-bottom:2px;padding-top:2px;padding-left:100px; text-align:left;font-weight:bold; ">Casting Time:<span style="border-bottom:1px solid;"><?php if ($row_select_pipe['caste_date3'] != "" && $row_select_pipe['caste_date3'] != "0" && $row_select_pipe['caste_date3'] != null) {
																																																	echo $row_select_pipe['caste_date3'];
																																																} else {
																																																	echo " <br>";
																																																} ?></span></td>
						</tr>
						<tr style="">

							<td style="width:10%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold;padding-left:100px;  ">Temp: <span style="border-bottom:1px solid;"><?php if ($row_select_pipe['duc_temp'] != "" && $row_select_pipe['duc_temp'] != "0" && $row_select_pipe['duc_temp'] != null) {
																																																echo $row_select_pipe['duc_temp'];
																																															} else {
																																																echo " <br>";
																																															} ?></span></td>
							<td style="width:90%;padding-bottom:2px;padding-top:2px;padding-left:100px; 	 text-align:left;font-weight:bold; ">Testing Time:<span style="border-bottom:1px solid;"><?php if ($row_select_pipe['test_date3'] != "" && $row_select_pipe['test_date3'] != "0" && $row_select_pipe['test_date3'] != null) {
																																																			echo $row_select_pipe['test_date3'];
																																																		} else {
																																																			echo " <br>";
																																																		} ?></span></td>

						</tr>

					</table><br>

				</td>
			</tr> -->

			<!-- <?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="70%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-right:1px solid;margin-left:60px;margin-bottom:20px;">

						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;border:0;  "></td>
							<td style="width:30%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; "></td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold;border-top:1px solid; ">Load Rate</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold;border-top:1px solid; "></td>
						</tr>
						<tr style="">

							<td style="border-left:1px solid;border-top:1px solid;width:10%;text-align:center;font-weight:bold;  ">Sr.No.</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Initial length (cm)<br>IL</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold;border-top:1px solid; ">Final length (cm)<br>FL</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold;border-top:1px solid; ">Difference (FL-IL)<br>cm</td>
						</tr>

						<tr style="">

							<td style="border-left:1px solid;border-top:1px solid;width:10%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['dint_1'] != "" && $row_select_pipe['dint_1'] != "0" && $row_select_pipe['dint_1'] != null) {
																														echo $row_select_pipe['dint_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['dfin_1'] != "" && $row_select_pipe['dfin_1'] != "0" && $row_select_pipe['dfin_1'] != null) {
																														echo $row_select_pipe['dfin_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['duc_1'] != "" && $row_select_pipe['duc_1'] != "0" && $row_select_pipe['duc_1'] != null) {
																														echo $row_select_pipe['duc_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-left:1px solid;border-top:1px solid;width:10%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['dint_2'] != "" && $row_select_pipe['dint_2'] != "0" && $row_select_pipe['dint_2'] != null) {
																														echo $row_select_pipe['dint_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['dfin_2'] != "" && $row_select_pipe['dfin_2'] != "0" && $row_select_pipe['dfin_2'] != null) {
																														echo $row_select_pipe['dfin_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['duc_2'] != "" && $row_select_pipe['duc_2'] != "0" && $row_select_pipe['duc_2'] != null) {
																														echo $row_select_pipe['duc_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-left:1px solid;border-top:1px solid;width:10%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;border-bottom:1px solid;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;border-bottom:1px solid; "><?php if ($row_select_pipe['dint_3'] != "" && $row_select_pipe['dint_3'] != "0" && $row_select_pipe['dint_3'] != null) {
																																				echo $row_select_pipe['dint_3'];
																																			} else {
																																				echo " <br>";
																																			} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;border-bottom:1px solid; "><?php if ($row_select_pipe['dfin_3'] != "" && $row_select_pipe['dfin_3'] != "0" && $row_select_pipe['dfin_3'] != null) {
																																				echo $row_select_pipe['dfin_3'];
																																			} else {
																																				echo " <br>";
																																			} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;border-bottom:1px solid; "><?php if ($row_select_pipe['duc_3'] != "" && $row_select_pipe['duc_3'] != "0" && $row_select_pipe['duc_3'] != null) {
																																				echo $row_select_pipe['duc_3'];
																																			} else {
																																				echo " <br>";
																																			} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;border:0;  "></td>
							<td style="width:30%;text-align:center;font-weight:bold; "></td>
							<td style="border-left:1px solid;border-bottom:1px solid;width:30%; text-align:center;font-weight:bold; ">Average</td>
							<td style="border-left:1px solid;border-bottom:1px solid;width:30%; text-align:center;font-weight:bold; "><?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != "0" && $row_select_pipe['avg_duc'] != null) {
																																			echo $row_select_pipe['avg_duc'];
																																		} else {
																																			echo " <br>";
																																		} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;text-align:center;font-weight:bold;border:0;  "></td>
							<td style="width:30%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Ductility of Bitumen:</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold;border-bottom:1px solid; " colspan=2><?php if ($row_select_pipe['duc_bit'] != "" && $row_select_pipe['duc_bit'] != "0" && $row_select_pipe['duc_bit'] != null) {
																																					echo $row_select_pipe['duc_bit'];
																																				} else {
																																					echo " <br>";
																																				} ?></td>
						</tr>

					</table>


				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:1/2</td>
						</tr>

					</table>


				</td>
			</tr> -->

		<!-- </table>

		<div class="pagebreak"></div> -->



		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<!-- <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;margin-top:30px;"> -->
			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px ;padding-top:2px ; ">&nbsp;&nbsp; DOC : GOMAEC/L/OS/001</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 09/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : 2</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding-bottom:2px ;padding-top:2px ;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:75%;padding-left:200px; text-align:center;font-weight:bold;padding-bottom:2px ;padding-top:4px ; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:200px;padding-bottom:2px ;padding-top:2px ; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:200px;padding-bottom:2px ;padding-top:2px ; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:200px;padding-bottom:2px ;padding-top:2px ; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:8px;padding-top:0px; text-align:center;padding-left:200px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table><br>
				</td>
			</tr> -->



			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[4]</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Specific Gravity [ IS : 1202 ]</td>

						</tr>

					</table><br><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="80%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 1px 1px 0px;	margin-bottom:20px;">

						<tr style="">

							<td style="border-left:0px solid;width:10%;text-align:center;font-weight:bold;  ">[i]</td>
							<td style="border-left:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp;Weight of Specific Gravity Bottle</td>
							<td style="border-left:1px solid;width:10%; text-align:right; ">[A]=</td>
							<td style="border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_a_1'] != "" && $row_select_pipe['sp_a_1'] != "0" && $row_select_pipe['sp_a_1'] != null) {
																									echo $row_select_pipe['sp_a_1'];
																								} else {
																									echo " <br>";
																								} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;border-left:0px solid;width:10%;text-align:center;font-weight:bold;  ">[ii]</td>
							<td style="border-top:1px solid;border-left:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp;Weight of Specific Gravity Bottle filled with Distilled Water</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:right; ">[B]=</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_b_1'] != "" && $row_select_pipe['sp_b_1'] != "0" && $row_select_pipe['sp_b_1'] != null) {
																														echo $row_select_pipe['sp_b_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;border-left:0px solid;width:10%;text-align:center;font-weight:bold;  ">[iii]</td>
							<td style="border-top:1px solid;border-left:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left; ">&nbsp;&nbsp;Weight of Specific Gravity Bottle about Half filled bitumen</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:right; ">[C]=</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_c_1'] != "" && $row_select_pipe['sp_c_1'] != "0" && $row_select_pipe['sp_c_1'] != null) {
																														echo $row_select_pipe['sp_c_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;border-left:0px solid;width:10%;text-align:center;font-weight:bold;  ">[iv]</td>
							<td style="border-top:1px solid;border-left:1px solid;width:70%;padding-bottom:5px;padding-top:5px; text-align:left;padding-left:6px; ">Weight of Specific Gravity Bottle about Half filled with bitumen and the rest with distilled water</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:right; ">[D]=</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sp_d_1'] != "" && $row_select_pipe['sp_d_1'] != "0" && $row_select_pipe['sp_d_1'] != null) {
																														echo $row_select_pipe['sp_d_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:33.3%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;padding-left:100px;  ">Specific Gravity=</td>
							<td style="width:16.7%;padding-bottom:2px;padding-top:2px; text-align:center;border-bottom:1px solid;  ">[c-a]</td>
							<td style="width:50%;padding-bottom:2px;padding-top:2px; text-align:left; ">Air Cooling - ½ HR</td>
						</tr>
						<tr style="">

							<td style="width:33.3%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;padding-left:100px;  "></td>
							<td style="width:16.7%;padding-bottom:2px;padding-top:2px; text-align:center;  ">[b-a] - [d-c]</td>
							<td style="width:50%;padding-bottom:2px;padding-top:2px; text-align:left; ">Water Cooling - ½ HR 270C Temp.</td>
						</tr>

					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:33%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;padding-left:100px;  ">Specific Gravity = </td>
							<td style="width:66%;padding-bottom:2px;padding-top:2px; text-align:left;  "><span style="border-bottom:1px solid"> <?php if ($row_select_pipe['sp_1'] != "" && $row_select_pipe['sp_1'] != "0" && $row_select_pipe['sp_1'] != null) {
																																					echo $row_select_pipe['sp_1'];
																																				} else {
																																					echo " <br>";
																																				} ?> </span></td>
						</tr>
					</table><br><br>

				</td>
			</tr> -->



			<!--<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[5]</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Absolute viscosity at 60° C [ IS : 1206-Part-2 ]</td>

						</tr>

					</table><br><br>

				</td>
			 </tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;  ">Vaccum Pressure:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;  "><span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['abs_vac'] != "" && $row_select_pipe['abs_vac'] != "0" && $row_select_pipe['abs_vac'] != null) {
																																														echo $row_select_pipe['abs_vac'];
																																													} else {
																																														echo " <br>";
																																													} ?>&nbsp;&nbsp;&nbsp;</span></td>
							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold; ">Temp. of Viscosity Bath:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold; "><span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['abs_temp'] != "" && $row_select_pipe['abs_temp'] != "0" && $row_select_pipe['abs_temp'] != null) {
																																														echo $row_select_pipe['abs_temp'];
																																													} else {
																																														echo " <br>";
																																													} ?>&nbsp;&nbsp;&nbsp;</span></td>
						</tr>
					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="left" width="80%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border:1px solid;margin-left:60px;margin-bottom:20px;">

						<tr style="">

							<td style="width:60%;text-align:center;font-weight:bold;  ">Observation</td>
							<td style="border-left:1px solid;width:40%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Time (sec)</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:60%;text-align:center;padding-bottom:3px;padding-top:3px; ">Travel of Bitumen from point F to G, X</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['abs_4_1'] != "" && $row_select_pipe['abs_4_1'] != "0" && $row_select_pipe['abs_4_1'] != null) {
																														echo $row_select_pipe['abs_4_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:60%;text-align:center;padding-bottom:3px;padding-top:3px; ">Travel of Bitumen from point G to H, Y</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['abs_7_1'] != "" && $row_select_pipe['abs_7_1'] != "0" && $row_select_pipe['abs_7_1'] != null) {
																														echo $row_select_pipe['abs_7_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:33%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;padding-left:60px;  ">Absolute Viscosity = ((X * Constant of Bulb B) + (Y * Constant of Bulb C))/2 =&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; <?php if ($row_select_pipe['abs_9_1'] != "" && $row_select_pipe['abs_9_1'] != "0" && $row_select_pipe['abs_9_1'] != null) {
																																																																																	echo $row_select_pipe['abs_9_1'];
																																																																																} else {
																																																																																	echo " <br>";
																																																																																} ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span></td>
						</tr>
					</table><br><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[6]</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Kinematic viscosity at 135° C [ IS : 1206-Part-3 ]</td>

						</tr>

					</table><br><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold;  ">Vaccum Pressure:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;  "><span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['kin_vac'] != "" && $row_select_pipe['kin_vac'] != "0" && $row_select_pipe['kin_vac'] != null) {
																																														echo $row_select_pipe['kin_vac'];
																																													} else {
																																														echo " <br>";
																																													} ?>&nbsp;&nbsp;&nbsp;</span></td>
							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:right;font-weight:bold; ">Temp. of Viscosity Bath:&nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="width:20%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold; "><span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['kin_temp'] != "" && $row_select_pipe['kin_temp'] != "0" && $row_select_pipe['kin_temp'] != null) {
																																														echo $row_select_pipe['kin_temp'];
																																													} else {
																																														echo " <br>";
																																													} ?>&nbsp;&nbsp;&nbsp;</span></td>
						</tr>
					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="60%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;margin-left:60px;margin-bottom:20px;">

						<tr style="">

							<td style="width:70%;text-align:left;font-weight:bold;  ">&nbsp;&nbsp;Observation</td>
							<td style="border-left:1px solid;width:30%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Time (sec)</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:70%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp;Travel of Bitumen from point E to F, Z</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['kin_5_1'] != "" && $row_select_pipe['kin_5_1'] != "0" && $row_select_pipe['kin_5_1'] != null) {
																														echo $row_select_pipe['kin_5_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:33%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;padding-left:60px;  ">Kinamatic Viscosity = Z * Constant of Bulb C = &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span style="border-bottom:1px solid;">&nbsp;&nbsp;&nbsp;<?php if ($row_select_pipe['avg_kin'] != "" && $row_select_pipe['avg_kin'] != "0" && $row_select_pipe['avg_kin'] != null) {
																																																																							echo $row_select_pipe['avg_kin'];
																																																																						} else {
																																																																							echo " <br>";
																																																																						} ?>&nbsp;&nbsp;&nbsp;</span></td>
						</tr>
					</table><br>

				</td>
			</tr> -->

			<!--div class="pagebreak"> </div>
		<br>
		<br-->

			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:70%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:100px;  ">&nbsp;&nbsp;Tested By:-</td>
							<td style="width:30%;text-align:left;font-weight:bold; ">Checked By:-</td>
						</tr>

					</table>

				</td>
			</tr>



			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:2/2</td>
						</tr>

					</table>

				</td>
			</tr> -->



			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
		<!-- </table> -->
	</page>






</body>

</html>

<script type="text/javascript">


</script>