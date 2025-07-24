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
	<br>

	<page size="A4">

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>
							Cement</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>

		</table>

		<p class="test1" style="margin-left:5%;">Detail of Sample</p>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="5%">

			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td style="width:20%;"><b>Date of Complete</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>

			</tr>


		</table>
		<Br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>1</center>
					</b></td>
				<td colspan="2" rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Consistency Test</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-4)</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Min. 65%</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border: 1px solid black;"><b>Weight of Cement :&nbsp;&nbsp;<?php if ($row_select_pipe['con_weight'] != "" && $row_select_pipe['con_weight'] != "0" && $row_select_pipe['con_weight'] != null) {
																										echo number_format($row_select_pipe['con_weight'], 0) . " gm";
																									} else {
																										echo "&nbsp;";
																									} ?></b></td>
				<td style="text-align:center; border: 1px solid black;"><b>Temp. :&nbsp;&nbsp;<?php if ($row_select_pipe['con_temp'] != "" && $row_select_pipe['con_temp'] != "0" && $row_select_pipe['con_temp'] != null) {
																									echo $row_select_pipe['con_temp'];
																								} else {
																									echo "&nbsp;";
																								} ?> &#8451; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Humidity (%):&nbsp;&nbsp;<?php if ($row_select_pipe['con_humidity'] != "" && $row_select_pipe['con_humidity'] != "0" && $row_select_pipe['con_humidity'] != null) {
																																																																																													echo $row_select_pipe['con_humidity'];
																																																																																												} else {
																																																																																													echo "&nbsp;";
																																																																																												} ?> %</b></td>
			</tr>

			<tr style="border: 1px solid black;">

				<td style="border: 1px solid black;width:10%;">
					<center>Sr.No.</center>
				</td>
				<td style="border: 1px solid black;width:30%;">
					<center>Weight of Water (cc)</center>
				</td>
				<td style="border: 1px solid black;width:20%;">
					<center>% of Water</center>
				</td>
				<td style="border: 1px solid black;width:40%;">
					<center>Reading on Vicat (mm)</center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>1</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_1'] != "" && $row_select_pipe['vol_1'] != "0" && $row_select_pipe['vol_1'] != null) {
								echo $row_select_pipe['vol_1'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>
				<td style="border: 1px solid black;" rowspan="5">
					<center><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
								echo $row_select_pipe['final_consistency'];
							} else {
								echo "&nbsp;";
							} ?><center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['reading_1'] != "" && $row_select_pipe['reading_1'] != "0" && $row_select_pipe['reading_1'] != null) {
								echo $row_select_pipe['reading_1'];
							} else {
								echo "&nbsp;";
							} ?><center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>2</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_2'] != "" && $row_select_pipe['vol_2'] != "0" && $row_select_pipe['vol_2'] != null) {
								echo $row_select_pipe['vol_2'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['reading_2'] != "" && $row_select_pipe['reading_2'] != "0" && $row_select_pipe['reading_2'] != null) {
								echo $row_select_pipe['reading_2'];
							} else {
								echo "&nbsp;";
							} ?><center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>3</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_3'] != "" && $row_select_pipe['vol_3'] != "0" && $row_select_pipe['vol_3'] != null) {
								echo $row_select_pipe['vol_3'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['reading_3'] != "" && $row_select_pipe['reading_3'] != "0" && $row_select_pipe['reading_3'] != null) {
								echo $row_select_pipe['reading_3'];
							} else {
								echo "&nbsp;";
							} ?><center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>4</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_4'] != "" && $row_select_pipe['vol_4'] != "0" && $row_select_pipe['vol_4'] != null) {
								echo $row_select_pipe['vol_4'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['reading_4'] != "" && $row_select_pipe['reading_4'] != "0" && $row_select_pipe['reading_4'] != null) {
								echo $row_select_pipe['reading_4'];
							} else {
								echo "&nbsp;";
							} ?><center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center>5</center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_5'] != "" && $row_select_pipe['vol_5'] != "0" && $row_select_pipe['vol_5'] != null) {
								echo $row_select_pipe['vol_5'];
							} else {
								echo "&nbsp;";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['reading_5'] != "" && $row_select_pipe['reading_5'] != "0" && $row_select_pipe['reading_5'] != null) {
								echo $row_select_pipe['reading_5'];
							} else {
								echo "&nbsp;";
							} ?><center>
				</td>

			</tr>


		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>2</center>
					</b></td>
				<td rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Blaine Air Permeability</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-2)</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Max. 65%</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>
						<center>A.</center>
					</b></td>
				<td style="border: 1px solid black;"><b>Specific surface area M<sup>2</sup>/kg. OPC</b></td>
				<td style="text-align:center; border: 1px solid black;"><b>Temp. :&nbsp;&nbsp;<?php if ($row_select_pipe['fine_temp'] != "" && $row_select_pipe['fine_temp'] != "0" && $row_select_pipe['fine_temp'] != null) {
																									echo $row_select_pipe['fine_temp'];
																								} else {
																									echo "&nbsp;";
																								} ?> &#8451; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Humidity (%):&nbsp;&nbsp;<?php if ($row_select_pipe['fine_humidity'] != "" && $row_select_pipe['fine_humidity'] != "0" && $row_select_pipe['fine_humidity'] != null) {
																																																																																														echo $row_select_pipe['fine_humidity'];
																																																																																													} else {
																																																																																														echo "&nbsp;";
																																																																																													} ?> %</b></td>
			</tr>

			<tr style="border: 0px solid black;">
				<td colspan="3">
					<table align="center" width="100%" class="test1" height="Auto">

						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:left;width:30%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:7%;"></td>
							<td style="border: 0px solid black;text-align:center;width:7%;">&Sqrt;0.1 &#x3B7;o</td>
							<td style="border: 0px solid black;text-align:left;width:2%;"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:right;width:30%;">Determination of the aparatus Constant</td>
							<td style="border: 0px solid black;text-align:center;width:4%;">K</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td style="border: 0px solid black;text-align:center;width:7%;">1.414 So P<sub>o</sub></td>
							<td style="border: 0px solid black;text-align:left;width:7%;">
								<hr>
							</td>
							<td style="border: 0px solid black;text-align:center;width:2%;">=</td>
							<td style="border: 0px solid black;width:10%;text-align:center;"><?php if ($row_select_pipe['constant_k'] != "" && $row_select_pipe['constant_k'] != "0" && $row_select_pipe['constant_k'] != null) {
																									echo $row_select_pipe['constant_k'];
																								} else {
																									echo "&nbsp;";
																								} ?></td>

						</tr>
						<tr style="border: 0px solid black;">

							<td style="border: 0px solid black;width:30%;"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:7%"></td>
							<td style="border: 0px solid black;width:7%;text-align:center;">&Sqrt;to</td>
							<td style="border: 0px solid black;width:2%"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;">
								<hr>
							</td>
						</tr>
						<tr style="border: 0px solid black;">

							<td style="border: 0px solid black;width:30%;"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:7%"></td>
							<td style="border: 0px solid black;width:7%;text-align:center;"></td>
							<td style="border: 0px solid black;width:2%"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>
						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:left;width:30%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:center;width:7%;">521.08 K &Sqrt;to</td>
							<td style="border: 0px solid black;text-align:left;width:7%;"></td>
							<td style="border: 0px solid black;text-align:left;width:2%;"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:right;width:30%;">Specific Surface area</td>
							<td style="border: 0px solid black;text-align:center;width:4%;">S</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td style="border: 0px solid black;text-align:left;width:7%;">
								<hr>
							</td>
							<td style="border: 0px solid black;text-align:center;width:7%;"></td>
							<td style="border: 0px solid black;text-align:left;width:2%;"></td>
							<td style="border: 0px solid black;width:10%;text-align:center;"></td>

						</tr>
						<tr style="border: 0px solid black;">

							<td style="border: 0px solid black;width:30%;"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:7%;text-align:center;">p</td>
							<td style="border: 0px solid black;width:7%"></td>
							<td style="border: 0px solid black;width:2%"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>
						</tr>
						<tr style="border: 0px solid black;">

							<td style="border: 0px solid black;width:30%;"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:7%"></td>
							<td style="border: 0px solid black;width:7%;text-align:center;"><br></td>
							<td style="border: 0px solid black;width:2%"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>
						</tr>

						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:left;width:30%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:center;width:7%;">521.08&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>
							<td style="border: 0px solid black;text-align:center;width:7%;"><?php if ($row_select_pipe['constant_k'] != "" && $row_select_pipe['constant_k'] != "0" && $row_select_pipe['constant_k'] != null) {
																								echo $row_select_pipe['constant_k'];
																							} else {
																								echo "&nbsp;";
																							} ?> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;X</td>
							<td style="border: 0px solid black;text-align:center;width:7%;">&Sqrt;<?php if ($row_select_pipe['avg_fines_time'] != "" && $row_select_pipe['avg_fines_time'] != "0" && $row_select_pipe['avg_fines_time'] != null) {
																										echo $row_select_pipe['avg_fines_time'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>

						</tr>
						<tr style="border: 0px solid black;">


							<td rowspan="4" style="border: 0px solid black;text-align:right;width:30%;">
								<table align="left" border="1px" width="50%" class="test1" height="Auto">
									<tr style="text-align:center;">
										<td style="width:30%"><B>1</B></td>
										<td style="width:70%"><?php if ($row_select_pipe['fines_t_1'] != "" && $row_select_pipe['fines_t_1'] != "0" && $row_select_pipe['fines_t_1'] != null) {
																	echo $row_select_pipe['fines_t_1'];
																} else {
																	echo "&nbsp;";
																} ?></td>
									</tr>
									<tr style="text-align:center;">
										<td style="text-align:center;width:5%;"><b>2</b></td>
										<td><?php if ($row_select_pipe['fines_t_2'] != "" && $row_select_pipe['fines_t_2'] != "0" && $row_select_pipe['fines_t_2'] != null) {
												echo $row_select_pipe['fines_t_2'];
											} else {
												echo "&nbsp;";
											} ?></td>
									</tr>
									<tr style="text-align:center;">
										<td style="text-align:center;width:5%;"><b>3</b></td>
										<td><?php if ($row_select_pipe['fines_t_3'] != "" && $row_select_pipe['fines_t_3'] != "0" && $row_select_pipe['fines_t_3'] != null) {
												echo $row_select_pipe['fines_t_3'];
											} else {
												echo "&nbsp;";
											} ?></td>
									</tr>
									<tr style="text-align:center;">
										<td><B>Average</B></td>
										<td><?php if ($row_select_pipe['avg_fines_time'] != "" && $row_select_pipe['avg_fines_time'] != "0" && $row_select_pipe['avg_fines_time'] != null) {
												echo $row_select_pipe['avg_fines_time'];
											} else {
												echo "&nbsp;";
											} ?></td>
									</tr>
								</table>
							</td>
							<td style="border: 0px solid black;text-align:center;width:4%;">S</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td colspan="3" style="border: 0px solid black;text-align:center;">
								<hr>
							</td>
							<td style="border: 0px solid black;width:10%;text-align:center;"></td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:7%"></td>
							<td style="border: 0px solid black;width:7%;text-align:left;"><?php if ($row_select_pipe['fines_val2'] != "" && $row_select_pipe['fines_val2'] != "0" && $row_select_pipe['fines_val2'] != null) {
																								echo $row_select_pipe['fines_val2'];
																							} else {
																								echo "&nbsp;";
																							} ?></td>
							<td style="border: 0px solid black;width:2%"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>
						</tr>

						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:4%"></td>
							<td style="border: 0px solid black;width:7%"></td>
							<td style="border: 0px solid black;width:7%;text-align:center;"><br></td>
							<td style="border: 0px solid black;width:2%"></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>
						</tr>
						<tr style="border: 0px solid black;">



							<td style="border: 0px solid black;text-align:center;width:4%;">S</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td colspan="3" style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null) {
																									echo $row_select_pipe['ss_area'];
																								} else {
																									echo "&nbsp;";
																								} ?>&nbsp;&nbsp;&nbsp; m<sup>2</sup>/kg&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;=&nbsp;&nbsp; <?php if ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null) {
																																																																																									echo number_format($row_select_pipe['ss_area'], 0) * 10;
																																																																																								} else {
																																																																																									echo "&nbsp;";
																																																																																								} ?>&nbsp;&nbsp;&nbsp;cm<sup>2</sup>/g</td>
							<td style="border: 0px solid black;width:10%;text-align:center;"></td>

						</tr>

					</table>
				</td>
			</tr>


		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>3</center>
					</b></td>
				<td rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Setting Time</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-5)</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Min. 65%</b></td>
			</tr>


			<tr style="border: 0px solid black;">
				<td colspan="3">
					<table align="center" width="100%" class="test1" height="Auto">

						<tr style="border: 0px solid black;">



							<td style="border: 0px solid black;text-align:center;width:30%;font-weight:bold;">Weight of Cement</td>
							<td colspan="2" style="border-bottom: 1px solid black;text-align:center;width:10%;"><?php if ($row_select_pipe['set_weight'] != "" && $row_select_pipe['set_weight'] != "0" && $row_select_pipe['set_weight'] != null) {
																													echo $row_select_pipe['set_weight'];
																												} else {
																													echo "&nbsp;";
																												} ?></td>
							<td style="border: 0px solid black;text-align:left;width:16%;"><b>gm</b></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:6%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:right;width:13%;">Temp :-</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['set_temp'] != "" && $row_select_pipe['set_temp'] != "0" && $row_select_pipe['set_temp'] != null) {
																										echo $row_select_pipe['set_temp'];
																									} else {
																										echo "&nbsp;";
																									} ?>&nbsp;&nbsp; &#8451;</td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;width:30%;font-weight:bold;">Water &nbsp;&nbsp;&nbsp;&nbsp; =</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:10%;font-weight:bold;">0.85&nbsp;&nbsp;</td>
							<td style="border: 0px solid black;text-align:left;width:4%;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:left;width:16%;font-weight:bold;">Consistency %</td>
							<td style="border: 0px solid black;text-align:left;width:4%;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:left;width:6%;font-weight:bold;">4</td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:right;width:13%;">Humidity :-</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['set_humidity'] != "" && $row_select_pipe['set_humidity'] != "0" && $row_select_pipe['set_humidity'] != null) {
																										echo $row_select_pipe['set_humidity'];
																									} else {
																										echo "&nbsp;";
																									} ?>&nbsp;&nbsp; %</td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;width:30%;"><br></td>
							<td style="border: 0px solid black;text-align:left;width:10%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:16%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:6%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:right;width:13%;"></td>
							<td style="border: 0px solid black;text-align:left;width:13%;"></td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;width:30%;">Water &nbsp;&nbsp;&nbsp;&nbsp; =</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:10%;">0.85&nbsp;&nbsp;</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">X</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:16%;"><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
																										echo $row_select_pipe['final_consistency'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="border: 0px solid black;text-align:left;width:4%;">X</td>
							<td style="border: 0px solid black;text-align:left;width:6%;">4</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['set_wtr'] != "" && $row_select_pipe['set_wtr'] != "0" && $row_select_pipe['set_wtr'] != null) {
																										echo $row_select_pipe['set_wtr'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="border: 0px solid black;text-align:left;width:13%;">gm</td>

						</tr>


					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3"><br></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td colspan="3">
					<table align="left" width="60%" class="test1" height="Auto">

						<tr style="border: 0px solid black;">
							<td style="width:5%;border: 0px solid black;text-align:center;font-weight:bold;">A.</td>
							<td style="width:50%;border: 0px solid black;text-align:left;font-weight:bold;">Time when Water added</td>
							<td style="width:10%;border: 0px solid black;text-align:center;font-weight:bold;">=</td>
							<td style="width:15%;border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hr_a'] != "" && $row_select_pipe['hr_a'] != "0" && $row_select_pipe['hr_a'] != null) {
																										echo $row_select_pipe['hr_a'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="width:20%;border: 0px solid black;text-align:left;font-weight:bold;">hours/min</td>
						</tr>
						<tr style="border: 0px solid black;">
							<td style="width:5%;border: 0px solid black;text-align:center;font-weight:bold;">B.</td>
							<td style="width:50%;border: 0px solid black;text-align:left;font-weight:bold;">Initial Setting Time</td>
							<td style="width:10%;border: 0px solid black;text-align:center;font-weight:bold;">=</td>
							<td style="width:15%;border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hr_b'] != "" && $row_select_pipe['hr_b'] != "0" && $row_select_pipe['hr_b'] != null) {
																										echo $row_select_pipe['hr_b'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="width:20%;border: 0px solid black;text-align:left;font-weight:bold;">hours/min</td>
						</tr>
						<tr style="border: 0px solid black;">
							<td style="width:5%;border: 0px solid black;text-align:center;font-weight:bold;">C.</td>
							<td style="width:50%;border: 0px solid black;text-align:left;font-weight:bold;">Final Setting Time</td>
							<td style="width:10%;border: 0px solid black;text-align:center;font-weight:bold;">=</td>
							<td style="width:15%;border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['hr_c'] != "" && $row_select_pipe['hr_c'] != "0" && $row_select_pipe['hr_c'] != null) {
																										echo $row_select_pipe['hr_c'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="width:20%;border: 0px solid black;text-align:left;font-weight:bold;">hours/min</td>
						</tr>
						<tr style="border: 0px solid black;">
							<td style="width:5%;border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="width:50%;border: 0px solid black;text-align:left;font-weight:bold;"><br></td>
							<td style="width:10%;border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="width:15%;border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="width:20%;border: 0px solid black;text-align:left;font-weight:bold;"></td>
						</tr>
						<tr style="border: 0px solid black;">
							<td style="width:5%;border: 0px solid black;text-align:center;font-weight:bold;">1</td>
							<td style="width:50%;border: 0px solid black;text-align:left;font-weight:bold;">Initial Setting Time</td>
							<td style="width:10%;border: 0px solid black;text-align:center;font-weight:bold;">=</td>
							<td style="width:15%;border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "0" && $row_select_pipe['initial_time'] != null) {
																										echo $row_select_pipe['initial_time'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="width:20%;border: 0px solid black;text-align:left;font-weight:bold;">min</td>
						</tr>
						<tr style="border: 0px solid black;">
							<td style="width:5%;border: 0px solid black;text-align:center;font-weight:bold;">2</td>
							<td style="width:50%;border: 0px solid black;text-align:left;font-weight:bold;">Final Setting Time</td>
							<td style="width:10%;border: 0px solid black;text-align:center;font-weight:bold;">=</td>
							<td style="width:15%;border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "0" && $row_select_pipe['final_time'] != null) {
																										echo $row_select_pipe['final_time'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="width:20%;border: 0px solid black;text-align:left;font-weight:bold;">min</td>
						</tr>



					</table>
				</td>
			</tr>


		</table>


		<?php

		/*if(($row_select_pipe['avg_com_1']!="" && $row_select_pipe['avg_com_1']!="0" && $row_select_pipe['avg_com_1']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
					{
						$pagecnt++;*/
		?>

		<div class="pagebreak"> </div>

		<br>
		<br>

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>
							Cement</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>

		</table>
		<br>
		<table align="center" width="90%" cellpadding="0" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>4</center>
					</b></td>
				<td rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Compressive Strength</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-6)</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Min. 65%</b></td>
			</tr>


			<tr style="border: 0px solid black;">
				<td colspan="3">
					<table align="center" width="100%" class="test1" height="Auto">

						<tr style="border: 0px solid black;">



							<td style="border: 0px solid black;text-align:center;width:30%;font-weight:bold;">Weight of Cement</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['weight_of_cement'] != "" && $row_select_pipe['weight_of_cement'] != "0" && $row_select_pipe['weight_of_cement'] != null) {
																										echo $row_select_pipe['weight_of_cement'];
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="border: 0px solid black;text-align:left;width:8%;"><b>gm</b></td>
							<td style="border: 0px solid black;text-align:left;width:6%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:left;width:4%;"></td>
							<td style="border: 0px solid black;text-align:right;width:13%;">Temp :-</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['com_temp'] != "" && $row_select_pipe['com_temp'] != "0" && $row_select_pipe['com_temp'] != null) {
																										echo $row_select_pipe['com_temp'];
																									} else {
																										echo "&nbsp;";
																									} ?>&nbsp;&nbsp; &#8451;</td>

						</tr>
						<tr style="border: 0px solid black;">
							<td style="border: 0px solid black;text-align:center;font-weight:bold;">Weight of Std. Sand</td>
							<td style="border: 0px solid black;text-align:left;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['weight_of_sand'] != "" && $row_select_pipe['weight_of_sand'] != "0" && $row_select_pipe['weight_of_sand'] != null) {
																								echo $row_select_pipe['weight_of_sand'];
																							} else {
																								echo "&nbsp;";
																							} ?></td>
							<td style="border: 0px solid black;text-align:left;"><b>gm</b></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:right;">Humidity :-</td>
							<td style="border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com_humidity'] != "" && $row_select_pipe['com_humidity'] != "0" && $row_select_pipe['com_humidity'] != null) {
																								echo $row_select_pipe['com_humidity'];
																							} else {
																								echo "&nbsp;";
																							} ?>&nbsp;&nbsp; %</td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;">Water &nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;font-weight:bold;">Consistency %</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">+</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">3</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:left;">8</td>
							<td style="border: 0px solid black;text-align:right;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>


						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:center;font-weight:bold;">4</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>


						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:center;font-weight:bold;"><br></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>


						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;">Water &nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
																								echo $row_select_pipe['final_consistency'];
																							} else {
																								echo "&nbsp;";
																							} ?></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">+</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">3</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:left;">8</td>
							<td colspan="2" style="border: 0px solid black;text-align:left;">=&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<u><?php if ($row_select_pipe['weight_of_water'] != "" && $row_select_pipe['weight_of_water'] != "0" && $row_select_pipe['weight_of_water'] != null) {
																																	echo $row_select_pipe['weight_of_water'];
																																} else {
																																	echo "&nbsp;";
																																} ?></u>&nbsp;&nbsp;gm</td>



						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:center;font-weight:bold;">4</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>


						</tr>

					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3"><br></td>
			</tr>
			<tr>
				<td colspan="3">
					<table align="center" border="1" style="border: 1px solid black;" width="100%" class="test1" height="Auto">
						<tr style="border: 1px solid black;">
							<td style="width:25%;border-bottom:2px solid black;border-top:2px solid black;"><b>
									<center>Actual Date of Testing</center>
								</b></td>
							<td style="width:25%;border-bottom:2px solid black;border-top:2px solid black;font-weight:bold;" colspan="2">
								<center><?php if ($row_select_pipe['avg_com_1'] != "") {
											echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
										} ?></center>
							</td>
							<td style="width:25%;border-bottom:2px solid black;border-top:2px solid black;font-weight:bold;" colspan="2">
								<center><?php if ($row_select_pipe['avg_com_2'] != "") {
											echo date('d - m - Y', strtotime($row_select_pipe['test_date2']));
										} ?></center>
							</td>
							<td style="width:25%;border-bottom:2px solid black;border-top:2px solid black;font-weight:bold;" colspan="2">
								<center><?php if ($row_select_pipe['avg_com_3'] != "") {
											echo date('d - m - Y', strtotime($row_select_pipe['test_date3']));
										} ?></center>
							</td>
						</tr>
						<tr style="border: 1px solid black;">
							<td rowspan="2"><b>
									<center>Sr.<br>No</center>
								</b></td>
							<td colspan="2">
								<center>3 Day</center>
							</td>
							<td colspan="2">
								<center>7 Day</center>
							</td>
							<td colspan="2">
								<center>28 Day</center>
							</td>

						</tr>
						<tr style="border: 1px solid black;">
							<td style="width:12.5%;">
								<center>Load KN</center>
							</td>
							<td style="width:12.5%;">
								<center>C.S. N/mm<sup>2</sup></center>
							</td>
							<td style="width:12.5%;">
								<center>Load KN</center>
							</td>
							<td style="width:12.5%;">
								<center>C.S. N/mm<sup>2</sup></center>
							</td>
							<td style="width:12.5%;">
								<center>Load KN</center>
							</td>
							<td style="width:12.5%;">
								<center>C.S. N/mm<sup>2</sup></center>
							</td>
						</tr>
						<tr style="border: 1px solid black;">
							<td>
								<center>1</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
											echo $row_select_pipe['load_1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
											echo $row_select_pipe['com_1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
											echo $row_select_pipe['load_4'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
											echo $row_select_pipe['com_4'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
											echo $row_select_pipe['load_7'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
											echo $row_select_pipe['com_7'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>

						</tr>
						<tr style="border: 1px solid black;">
							<td>
								<center>2</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
											echo $row_select_pipe['load_2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
											echo $row_select_pipe['com_2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
											echo $row_select_pipe['load_5'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
											echo $row_select_pipe['com_5'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
											echo $row_select_pipe['load_8'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
											echo $row_select_pipe['com_8'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>

						</tr>
						<tr style="border: 1px solid black;">
							<td>
								<center>3</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
											echo $row_select_pipe['load_3'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
											echo $row_select_pipe['com_3'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
											echo $row_select_pipe['load_6'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
											echo $row_select_pipe['com_6'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['load_9'] != "" && $row_select_pipe['load_9'] != "0" && $row_select_pipe['load_9'] != null) {
											echo $row_select_pipe['load_9'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) {
											echo $row_select_pipe['com_9'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>

						</tr>
						<tr style="border: 1px solid black;">
							<td>
								<center>AVG.</center>
							</td>
							<td>
								<center>AVG.</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) {
											echo $row_select_pipe['avg_com_1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center>AVG.</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) {
											echo $row_select_pipe['avg_com_2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center>AVG.</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null) {
											echo $row_select_pipe['avg_com_3'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>

						</tr>
					</table>

				</td>
			</tr>


		</table>
		<br>
		<table align="center" width="90%" cellpadding="0" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>5</center>
					</b></td>
				<td rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Soundness by Le-Chatelier</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-3)</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Min. 65%</b></td>
			</tr>


			<tr style="border: 0px solid black;">
				<td colspan="3">
					<table align="center" width="100%" class="test1" height="Auto">

						<tr style="border: 0px solid black;">



							<td style="border: 0px solid black;text-align:center;width:30%;font-weight:bold;">Weight of Cement</td>
							<td style="border: 0px solid black;text-align:left;width:4%;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['sou_weight'] != "" && $row_select_pipe['sou_weight'] != "0" && $row_select_pipe['sou_weight'] != null) {
																										echo number_format($row_select_pipe['sou_weight'], 0);
																									} else {
																										echo "&nbsp;";
																									} ?></td>
							<td style="border: 0px solid black;text-align:left;width:2%;"><b>gm</b></td>
							<td style="border: 0px solid black;text-align:left;width:11%;"></td>
							<td style="border: 0px solid black;text-align:left;width:1%;"></td>
							<td style="border: 0px solid black;text-align:left;width:2%;"></td>
							<td style="border: 0px solid black;text-align:right;width:13%;">Temp :-</td>
							<td style="border-bottom: 1px solid black;text-align:center;width:13%;"><?php if ($row_select_pipe['sou_temp'] != "" && $row_select_pipe['sou_temp'] != "0" && $row_select_pipe['sou_temp'] != null) {
																										echo $row_select_pipe['sou_temp'];
																									} else {
																										echo "&nbsp;";
																									} ?>&nbsp;&nbsp; &#8451;</td>

						</tr>
						<tr style="border: 0px solid black;">
							<td style="border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:left;"><b></b></td>
							<td style="border: 0px solid black;text-align:center;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:right;">Humidity :-</td>
							<td style="border-bottom: 1px solid black;text-align:center;"><?php if ($row_select_pipe['sou_humidity'] != "" && $row_select_pipe['sou_humidity'] != "0" && $row_select_pipe['sou_humidity'] != null) {
																								echo $row_select_pipe['sou_humidity'];
																							} else {
																								echo "&nbsp;";
																							} ?>&nbsp;&nbsp; %</td>

						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;">Water &nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;font-weight:bold;">0.78</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:center;font-weight:bold;">Consistency %</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:left;">2</td>
							<td style="border: 0px solid black;text-align:right;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>



						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"><br></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"><br></td>

							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:center;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;"></td>
							<td style="border: 0px solid black;text-align:left;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>
							<td style="border: 0px solid black;text-align:right;"></td>


						</tr>
						<tr style="border: 0px solid black;">


							<td style="border: 0px solid black;text-align:center;font-weight:bold;">Water &nbsp;&nbsp;&nbsp;&nbsp;</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">=</td>
							<td style="border-bottom: 1px solid black;text-align:center;font-weight:bold;">0.78</td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">X</td>
							<td style="border-bottom: 1px solid black;text-align:center;font-weight:bold;"><?php if ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) {
																												echo $row_select_pipe['final_consistency'];
																											} else {
																												echo "&nbsp;";
																											} ?></td>
							<td style="border: 0px solid black;text-align:left;font-weight:bold;">X</td>
							<td style="border: 0px solid black;text-align:left;">2</td>
							<td style="border: 0px solid black;text-align:left;">=</td>
							<td style="border: 0px solid black;text-align:left;"><u><?php if ($row_select_pipe['sou_water'] != "" && $row_select_pipe['sou_water'] != "0" && $row_select_pipe['sou_water'] != null) {
																						echo $row_select_pipe['sou_water'];
																					} else {
																						echo "&nbsp;";
																					} ?></u>&nbsp;&nbsp; gm</td>


						</tr>

					</table>
				</td>
			</tr>
			<tr>
				<td colspan="3"><br></td>
			</tr>
			<tr>
				<td colspan="3">
					<table align="center" border="1" style="border: 1px solid black;" width="100%" class="test1" height="40%">

						<tr style="border: 1px solid black;">
							<td><b>
									<center>Sr.No.</center>
								</b></td>
							<td><b>
									<center>Distance between two<br>Points 24 hrs. in water (mm)</center>
								</b></td>
							<td><b>
									<center>Reading after 3 hrs.<br> in boiling (mm)</center>
								</b></td>
							<td><b>
									<center>Difference (mm)</center>
								</b></td>
							<td><b>
									<center>Average (mm)</center>
								</b></td>

						</tr>

						<tr style="border: 1px solid black;">
							<td>
								<center>1</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['dis_1_1'] != "" && $row_select_pipe['dis_1_1'] != "0" && $row_select_pipe['dis_1_1'] != null) {
											echo $row_select_pipe['dis_1_1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['dis_2_1'] != "" && $row_select_pipe['dis_2_1'] != "0" && $row_select_pipe['dis_2_1'] != null) {
											echo $row_select_pipe['dis_2_1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['diff_1'] != "" && $row_select_pipe['diff_1'] != "0" && $row_select_pipe['diff_1'] != null) {
											echo $row_select_pipe['diff_1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td rowspan="2">
								<center><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
											echo $row_select_pipe['soundness'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>


						</tr>
						<tr style="border: 1px solid black;">
							<td>
								<center>2</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['dis_1_2'] != "" && $row_select_pipe['dis_1_2'] != "0" && $row_select_pipe['dis_1_2'] != null) {
											echo $row_select_pipe['dis_1_2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['dis_2_2'] != "" && $row_select_pipe['dis_2_2'] != "0" && $row_select_pipe['dis_2_2'] != null) {
											echo $row_select_pipe['dis_2_2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['diff_2'] != "" && $row_select_pipe['diff_2'] != "0" && $row_select_pipe['diff_2'] != null) {
											echo $row_select_pipe['diff_2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>


						</tr>

					</table>

				</td>
			</tr>


		</table>
		<br>
		<table align="center" width="90%" cellpadding="0" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>6</center>
					</b></td>
				<td rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Fineness By dry Seiving</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-2)</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Min. 65%</b></td>
			</tr>



			<tr>
				<td colspan="3"><br></td>
			</tr>
			<tr>
				<td colspan="3">
					<table align="center" border="1" style="border: 1px solid black;" width="100%" class="test1" height="40%">

						<tr style="border: 1px solid black;">
							<td><b>
									<center>Sr.No.</center>
								</b></td>
							<td><b>
									<center>Weight of Cement, gm</center>
								</b></td>
							<td><b>
									<center>90 Micron Retained Weight, gm</center>
								</b></td>
							<td><b>
									<center>Percentage</center>
								</b></td>
							<td><b>
									<center>Average (%)</center>
								</b></td>

						</tr>

						<tr style="border: 1px solid black;">
							<td>
								<center>1</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['fbs_w1'] != "" && $row_select_pipe['fbs_w1'] != "0" && $row_select_pipe['fbs_w1'] != null) {
											echo $row_select_pipe['fbs_w1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['fbs_m1'] != "" && $row_select_pipe['fbs_m1'] != "0" && $row_select_pipe['fbs_m1'] != null) {
											echo $row_select_pipe['fbs_m1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['fbs_p1'] != "" && $row_select_pipe['fbs_p1'] != "0" && $row_select_pipe['fbs_p1'] != null) {
											echo $row_select_pipe['fbs_p1'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td rowspan="2">
								<center><?php if ($row_select_pipe['avg_fbs'] != "" && $row_select_pipe['avg_fbs'] != "0" && $row_select_pipe['avg_fbs'] != null) {
											echo $row_select_pipe['avg_fbs'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>


						</tr>
						<tr style="border: 1px solid black;">
							<td>
								<center>2</center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['fbs_w2'] != "" && $row_select_pipe['fbs_w2'] != "0" && $row_select_pipe['fbs_w2'] != null) {
											echo $row_select_pipe['fbs_w2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['fbs_m2'] != "" && $row_select_pipe['fbs_m2'] != "0" && $row_select_pipe['fbs_m2'] != null) {
											echo $row_select_pipe['fbs_m2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>
							<td>
								<center><?php if ($row_select_pipe['fbs_p2'] != "" && $row_select_pipe['fbs_p2'] != "0" && $row_select_pipe['fbs_p2'] != null) {
											echo $row_select_pipe['fbs_p2'];
										} else {
											echo "&nbsp;";
										} ?></center>
							</td>


						</tr>

					</table>

				</td>
			</tr>


		</table>





		<?php
		/*	}
				if($row_select_pipe['avg_density']!="" && $row_select_pipe['avg_density']!="0" && $row_select_pipe['avg_density']!=null)
				{
					$pagecnt++;*/
		?>

		<div class="pagebreak"> </div>

		<br>
		<br>

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>
							Cement</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>

		</table>
		<br>
		<Br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>7</center>
					</b></td>
				<td colspan="2" rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Specific Gravity Test</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-11), Clause 7.1</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Max. 65%</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border: 1px solid black;"><b>Weight of Cement :&nbsp;&nbsp; 64 gm</b></td>
				<td style="text-align:center; border: 1px solid black;"><b>Temp. :&nbsp;&nbsp;<?php echo $row_select_pipe['den_temp']; ?> &#8451; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Humidity (%):&nbsp;&nbsp;<?php echo $row_select_pipe['den_humidity']; ?> %</b></td>
			</tr>

			<tr style="border: 1px solid black;">

				<td colspan="4" style="border: 1px solid black;width:100%;">
					<table align="center" width="100%" class="test1" height="Auto">
						<tr>
							<td style="text-align:right"><B>Displaced Volume in cm<sup>3</sup></B></td>
							<td style="text-align:center"><B>=</B></td>
							<td style="text-align:left"><B>Final Reading of Liquid Displaced - Intial Reading of Liquid Displaced</B></td>
						</tr>
						<tr>
							<td style="text-align:right"><B>&nbsp;</B></td>
							<td style="text-align:center"><B></B></td>
							<td style="text-align:left"><B></B></td>
						</tr>
						<tr>
							<td style="text-align:right"><B></B></td>
							<td style="text-align:center"><B></B></td>
							<td style="text-align:left"><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Mass of Cement in (gm)</B></td>
						</tr>
						<tr>
							<td style="text-align:right"><B>Density</B></td>
							<td style="text-align:center"><B>=</B></td>
							<td style="text-align:left"><B>
									<hr align="left" width="50%">
								</B></td>
						</tr>
						<tr>
							<td style="text-align:right"><B></B></td>
							<td style="text-align:center"><B></B></td>
							<td style="text-align:left"><B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Displaced Volume in cm<sup>3</sup></B></td>
						</tr>
					</table>
				</td>


			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="4" style="border: 1px solid black;width:100%;">
					<table align="center" width="100%" class="test1" height="Auto">
						<tr>
							<!--1-->
							<td style="border-right: 1px solid black;width:30%;">
								<table align="center" width="100%" class="test1" height="Auto">
									<tr>
										<td style="text-align:center"><B>Displaced Volume in cm<sup>3</sup></B></td>
									</tr>
								</table>
							</td>
							<!--2-->
							<td style="border-right: 1px solid black;width:35%;">
								<table align="center" width="100%" class="test1" height="Auto">
									<tr>
										<td colspan="7" style="text-align:center"><B>Test - 1, A</B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B>A</B></td>
										<td style="text-align:center"><B>=</B></td>
										<td style="text-align:center"><B><?php if ($row_select_pipe['den_final'] != "" && $row_select_pipe['den_final'] != "0" && $row_select_pipe['den_final'] != null) {
																				echo $row_select_pipe['den_final'];
																			} else {
																				echo "&nbsp;";
																			} ?></B></td>
										<td style="text-align:center"><B>-</B></td>
										<td style="text-align:center"><B><?php if ($row_select_pipe['den_intial'] != "" && $row_select_pipe['den_intial'] != "0" && $row_select_pipe['den_intial'] != null) {
																				echo $row_select_pipe['den_intial'];
																			} else {
																				echo "&nbsp;";
																			} ?></B></td>
										<td style="text-align:center"><B>=</B></td>
										<td style="text-align:center"><B><?php if ($row_select_pipe['den_displaced'] != "" && $row_select_pipe['den_displaced'] != "0" && $row_select_pipe['den_displaced'] != null) {
																				echo $row_select_pipe['den_displaced'];
																			} else {
																				echo "&nbsp;";
																			} ?></B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td colspan="2" style="text-align:center;padding-top:20px;"><B>64</B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B>A</B></td>
										<td style="text-align:center"><B>=</B></td>
										<td colspan="2" style="text-align:center"><B>
												<hr>
											</B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td colspan="2" style="text-align:center"><B><?php if ($row_select_pipe['den_displaced'] != "" && $row_select_pipe['den_displaced'] != "0" && $row_select_pipe['den_displaced'] != null) {
																							echo $row_select_pipe['den_displaced'];
																						} else {
																							echo "&nbsp;";
																						} ?></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
									<tr>
										<td style="text-align:center;padding-top:20px;"><B>A</B></td>
										<td style="text-align:center;padding-top:20px;"><B>=</B></td>
										<td colspan="2" style="text-align:center;padding-top:20px;"><B><?php if ($row_select_pipe['density'] != "" && $row_select_pipe['density'] != "0" && $row_select_pipe['density'] != null) {
																											echo $row_select_pipe['density'];
																										} else {
																											echo "&nbsp;";
																										} ?></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
								</table>
							</td>
							<!--3-->
							<td style="width:35%;">
								<table align="center" width="100%" class="test1" height="Auto">
									<tr>
										<td colspan="7" style="text-align:center"><B>Test - 2, B</B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B>B</B></td>
										<td style="text-align:center"><B>=</B></td>
										<td style="text-align:center"><B><?php if ($row_select_pipe['den_final1'] != "" && $row_select_pipe['den_final1'] != "0" && $row_select_pipe['den_final1'] != null) {
																				echo $row_select_pipe['den_final1'];
																			} else {
																				echo "&nbsp;";
																			} ?></B></td>
										<td style="text-align:center"><B>-</B></td>
										<td style="text-align:center"><B><?php if ($row_select_pipe['den_intial1'] != "" && $row_select_pipe['den_intial1'] != "0" && $row_select_pipe['den_intial1'] != null) {
																				echo $row_select_pipe['den_intial1'];
																			} else {
																				echo "&nbsp;";
																			} ?></B></td>
										<td style="text-align:center"><B>=</B></td>
										<td style="text-align:center"><B><?php if ($row_select_pipe['den_displaced1'] != "" && $row_select_pipe['den_displaced1'] != "0" && $row_select_pipe['den_displaced1'] != null) {
																				echo $row_select_pipe['den_displaced1'];
																			} else {
																				echo "&nbsp;";
																			} ?></B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td colspan="2" style="text-align:center;padding-top:20px;"><B>64</B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B>B</B></td>
										<td style="text-align:center"><B>=</B></td>
										<td colspan="2" style="text-align:center"><B>
												<hr>
											</B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
									<tr>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td colspan="2" style="text-align:center"><B><?php if ($row_select_pipe['den_displaced1'] != "" && $row_select_pipe['den_displaced1'] != "0" && $row_select_pipe['den_displaced1'] != null) {
																							echo $row_select_pipe['den_displaced1'];
																						} else {
																							echo "&nbsp;";
																						}
																						echo $row_select_pipe['den_displaced1']; ?></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>

									<tr>
										<td style="text-align:center;padding-top:20px;"><B>B</B></td>
										<td style="text-align:center;padding-top:20px;"><B>=</B></td>
										<td colspan="2" style="text-align:center;padding-top:20px;"><B><?php if ($row_select_pipe['density1'] != "" && $row_select_pipe['density1'] != "0" && $row_select_pipe['density1'] != null) {
																											echo $row_select_pipe['density1'];
																										} else {
																											echo "&nbsp;";
																										} ?></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
										<td style="text-align:center"><B></B></td>
									</tr>
								</table>

							</td>

						</tr>
					</table>
				</td>

			</tr>

			<tr style="border: 1px solid black;">

				<td colspan="4" style="border: 1px solid black;width:100%;">
					<br>
					<table align="center" width="100%" class="test1" height="Auto">
						<tr>
							<td style="text-align:right"><B>Density</B></td>
							<td style="text-align:center"><B>=</B></td>
							<td style="text-align:left"><B>(A + B) / 2</B></td>
						</tr>
						<tr>
							<td style="text-align:right"><B>&nbsp;</B></td>
							<td style="text-align:center"><B></B></td>
							<td style="text-align:left"><B></B></td>
						</tr>

						<tr>
							<td style="text-align:right"><B>Density</B></td>
							<td style="text-align:center"><B>=</B></td>
							<td style="text-align:left"><B><?php if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) {
																echo $row_select_pipe['avg_density'];
															} else {
																echo "&nbsp;";
															} ?> g/cm<sup>3</sup></B></td>
						</tr>
						<tr>
							<td style="text-align:right"><B></B></td>
							<td style="text-align:center"><B></B></td>
							<td style="text-align:left"><B></B></td>
						</tr>
					</table>
				</td>


			</tr>

		</table>




		<div class="pagebreak"> </div>

		<br>
		<br>

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>
							Cement</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
			</tr>

		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>OBSERVATION SHEET OF CEMENT CHEMICAL ANALYSIS<br>(IS:4032-1985) GRAVIMETRIC METHOD</center>
					</b></td>

			</tr>
		</table>
		<Br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;width:5%;"><b>
						<center>7</center>
					</b></td>
				<td colspan="2" rowspan="2" style="border: 1px solid black;width:45%;padding-left:3px;"><b>Specific Gravity Test</b></td>
				<td style="text-align:center;width:50%;"><b>IS 4031 (Part-11), Clause 7.1</b></td>
			</tr>
			<tr style="border: 1px solid black;">

				<td style="text-align:center;"><b>Test Temp - 27 &#xb1; 2&#8451; Humidity - Max. 65%</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border: 1px solid black;"><b>Weight of Cement :&nbsp;&nbsp; 64 gm</b></td>
				<td style="text-align:center; border: 1px solid black;"><b>Temp. :&nbsp;&nbsp;<?php echo $row_select_pipe['den_temp']; ?> &#8451; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Humidity (%):&nbsp;&nbsp;<?php echo $row_select_pipe['den_humidity']; ?> %</b></td>
			</tr>


		</table>

		<?php
		/*}*/
		?>
	</page>

</body>

</html>


<script type="text/javascript">


</script>