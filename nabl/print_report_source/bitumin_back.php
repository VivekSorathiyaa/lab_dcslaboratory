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
		font-family: Book Antiqua;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Book Antiqua;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Book Antiqua;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Book Antiqua;
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

	$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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

	<br>
	<br>


	<page size="A4">
		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td colspan="4" rowspan="4" style="height:50px;width:80px;border: 2px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td colspan="4" rowspan="4" style="font-size:16px;border: 2px solid black;">
					<center><b>MATTEST ENGINEERING <Br> SERVICES<br>
							<br>
							<br>(BITUMEN)</b></center>
				</td>
				<td colspan="2" style="border: 2px solid black;"><b>Doc. No.</b></td>
				<td colspan="6" style="border: 2px solid black;"><b>F / 7.5 / 12</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="2" style="border: 2px solid black;"><b>Issue No.</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center;"><b>03</b></td>
				<td colspan="2" style="border: 2px solid black;"><b>Issue Date :</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center;"><b>01.10.2018</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="2" style="border: 2px solid black;"><b>Amend No.</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center"><b>00</b></td>
				<td colspan="2" style="border: 2px solid black;"><b>Amend Date :</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center"><b>-</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="8" style="border: 2px solid black;"><b>Page No. 1 of 1</b></td>

			</tr>
		</table>

		<p class="test1" style="margin-left:5%;"><b>Detail of Sample</b></p>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="5%">

			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($start_date)); ?></td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td style="width:20%;"><b>Date of Complete</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($end_date)); ?></td>

			</tr>


		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:10%;">
					<center><b>Sr.No.</b></center>
				</td>
				<td rowspan="2" colspan="2" style="border: 1px solid black;font-weight:bold;width:40%;">
					<center><b>Name of Test</b></center>
				</td>
				<td colspan="3" style="border: 1px solid black;font-weight:bold;width:35%;">
					<center><b>Reading</b></center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:15%;">
					<center><b>Test Result</b></center>
				</td>


			</tr>
			<tr>
				<td style="border: 1px solid black;font-weight:bold;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;font-weight:bold;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;font-weight:bold;">
					<center><b>3</b></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>Test-1</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Penetration Test (1/10<sup>th</sup> mm)</b></td>
				<td style="border: 1px solid black;">
					<center><b>IS:1203-1978</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen_1'] != "" && $row_select_pipe['pen_1'] != "0" && $row_select_pipe['pen_1'] != null) {
								echo $row_select_pipe['pen_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen_2'] != "" && $row_select_pipe['pen_2'] != "0" && $row_select_pipe['pen_2'] != null) {
								echo $row_select_pipe['pen_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen_3'] != "" && $row_select_pipe['pen_3'] != "0" && $row_select_pipe['pen_3'] != null) {
								echo $row_select_pipe['pen_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != "0" && $row_select_pipe['avg_pen'] != null) {
								echo $row_select_pipe['avg_pen'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>Test-2</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Softening Point Test (&#8451;) </b></td>
				<td style="border: 1px solid black;">
					<center><b>IS:1205-1978</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sof_0'] != "" && $row_select_pipe['sof_0'] != "0" && $row_select_pipe['sof_0'] != null) {
								echo $row_select_pipe['sof_0'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sof_1'] != "" && $row_select_pipe['sof_1'] != "0" && $row_select_pipe['sof_1'] != null) {
								echo $row_select_pipe['sof_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sof_2'] != "" && $row_select_pipe['sof_2'] != "0" && $row_select_pipe['sof_2'] != null) {
								echo $row_select_pipe['sof_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != "0" && $row_select_pipe['avg_sof'] != null) {
								echo $row_select_pipe['avg_sof'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>Test-3</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Ductility Test (mm)</b></td>
				<td style="border: 1px solid black;">
					<center><b>IS:1208-1978</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['duc_1'] != "" && $row_select_pipe['duc_1'] != "0" && $row_select_pipe['duc_1'] != null) {
								echo $row_select_pipe['duc_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['duc_2'] != "" && $row_select_pipe['duc_2'] != "0" && $row_select_pipe['duc_2'] != null) {
								echo $row_select_pipe['duc_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['duc_3'] != "" && $row_select_pipe['duc_3'] != "0" && $row_select_pipe['duc_3'] != null) {
								echo $row_select_pipe['duc_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != "0" && $row_select_pipe['avg_duc'] != null) {
								echo $row_select_pipe['avg_duc'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>



		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td style="text-align:center;border: 1px solid black;"><b>Test-4</b></td>
				<td style="text-align:left;border: 1px solid black;"><b>Specific Gravity Test</b></td>
				<td style="text-align:center;border: 1px solid black;"><b>IS 1202-1978</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:10%;">
					<center><b>Sr.No.</b></center>
				</td>
				<td style="border: 1px solid black;width:75%;">
					<center><b>Description</b></center>
				</td>
				<td style="border: 1px solid black;width:15%;">
					<center><b>Result</b></center>
				</td>


			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Bottle (A)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sp_a_1'] != "" && $row_select_pipe['sp_a_1'] != "0" && $row_select_pipe['sp_a_1'] != null) {
								echo $row_select_pipe['sp_a_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Bottle Filled in Distilled Water (B)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sp_b_1'] != "" && $row_select_pipe['sp_b_1'] != "0" && $row_select_pipe['sp_b_1'] != null) {
								echo $row_select_pipe['sp_b_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight if about Half Filled Bitumen (C)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sp_c_1'] != "" && $row_select_pipe['sp_c_1'] != "0" && $row_select_pipe['sp_c_1'] != null) {
								echo $row_select_pipe['sp_c_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>4</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of about Half Filled With Bitumen and the rest with Distilled Water (D)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['sp_d_1'] != "" && $row_select_pipe['sp_d_1'] != "0" && $row_select_pipe['sp_d_1'] != null) {
								echo $row_select_pipe['sp_d_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="3">
					<table width="70%" class="test1" style="" height="Auto">
						<tr>

							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>

						</tr>
						<tr style="padding-top:5px;">
							<td>Specific Gravity</td>
							<td style="width:10%;text-align:center"></td>
							<td style="text-align:center;">[C-A]</td>
							<td style="padding-left:35px;">Air Cooling - 1/2 HR</td>
						</tr>
						<tr>
							<td></td>
							<td style="width:10%;text-align:center">:-</td>
							<td>
								<hr>
							</td>
							<td></td>
						</tr>
						<tr>
							<td></td>
							<td style="padding-left:10%;"></td>
							<td style="text-align:center;">[B-A]-[D-C]</td>
							<td style="padding-left:35px;">Water Cooling - 1/2 HR 27&#8451; Temp.</td>
						</tr>
						<tr>
							<td>Specific Gravity</td>
							<td style="width:10%;text-align:center">=</td>
							<td style="text-align:center"><?php if ($row_select_pipe['sp_1'] != "" && $row_select_pipe['sp_1'] != "0" && $row_select_pipe['sp_1'] != null) {
																echo $row_select_pipe['sp_1'];
															} else {
																echo " <br>";
															} ?></td>
							<td></td>
						</tr>
					</table>
				</td>
			</tr>



		</table>
		<br>
		``<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td rowspan="2" style="text-align:center;border: 1px solid black;"><b>Test-5</b></td>
				<td colspan="2" style="text-align:left;border: 1px solid black;"><b>
						Absolute Visocity</b></td>
				<td style="text-align:center;border: 0px solid black;border-left: 0px solid black;"><b>IS 1206-1978( P-2)</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;"><b>Result Test Temp 60&#8451;</b></td>
				<td style="border: 1px solid black;text-align:center;"><b>Visocity on Sample</b></td>
				<td style="border: 1px solid black;text-align:center;"><b>Visocity on Residue</b></td>


			</tr>
			<tr style="text-align:center;">
				<td style="border: 1px solid black;"><b>Sr. No.</b></td>
				<td style="border: 1px solid black;"><b>Test Temp 60&#8451;</b></td>
				<td style="border: 1px solid black;"><b>Test Result</b></td>
				<td style="border: 1px solid black;"><b>Test Result</b></td>


			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Time Req. by Bitumen to Cross the Bulb-B(t1)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_4_1'] != "" && $row_select_pipe['abs_4_1'] != "0" && $row_select_pipe['abs_4_1'] != null) {
								echo $row_select_pipe['abs_4_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_4_2'] != "" && $row_select_pipe['abs_4_2'] != "0" && $row_select_pipe['abs_4_2'] != null) {
								echo $row_select_pipe['abs_4_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Bulb-B Factor (k1)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_3_1'] != "" && $row_select_pipe['abs_3_1'] != "0" && $row_select_pipe['abs_3_1'] != null) {
								echo $row_select_pipe['abs_3_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_3_2'] != "" && $row_select_pipe['abs_3_2'] != "0" && $row_select_pipe['abs_3_2'] != null) {
								echo $row_select_pipe['abs_3_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Flow Time In Sec (tB = k1 * t1)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_5_1'] != "" && $row_select_pipe['abs_5_1'] != "0" && $row_select_pipe['abs_5_1'] != null) {
								echo $row_select_pipe['abs_5_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_5_2'] != "" && $row_select_pipe['abs_5_2'] != "0" && $row_select_pipe['abs_5_2'] != null) {
								echo $row_select_pipe['abs_5_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>4</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Time Req. By Bitumen to Cross the bulb-C (t2)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_7_1'] != "" && $row_select_pipe['abs_7_1'] != "0" && $row_select_pipe['abs_7_1'] != null) {
								echo $row_select_pipe['abs_7_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_7_2'] != "" && $row_select_pipe['abs_7_2'] != "0" && $row_select_pipe['abs_7_2'] != null) {
								echo $row_select_pipe['abs_7_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>5</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Bulb -C Factor (k2)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_6_1'] != "" && $row_select_pipe['abs_6_1'] != "0" && $row_select_pipe['abs_6_1'] != null) {
								echo $row_select_pipe['abs_6_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_6_2'] != "" && $row_select_pipe['abs_6_2'] != "0" && $row_select_pipe['abs_6_2'] != null) {
								echo $row_select_pipe['abs_6_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>6</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Flow Time In Sec (tc = k2 * t2)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_8_1'] != "" && $row_select_pipe['abs_8_1'] != "0" && $row_select_pipe['abs_8_1'] != null) {
								echo $row_select_pipe['abs_8_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_8_2'] != "" && $row_select_pipe['abs_8_2'] != "0" && $row_select_pipe['abs_8_2'] != null) {
								echo $row_select_pipe['abs_8_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>7</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Absolute Viscosity, Poises Avg. 3 &amp; 6</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_9_1'] != "" && $row_select_pipe['abs_9_1'] != "0" && $row_select_pipe['abs_9_1'] != null) {
								echo $row_select_pipe['abs_9_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['abs_9_2'] != "" && $row_select_pipe['abs_9_2'] != "0" && $row_select_pipe['abs_9_2'] != null) {
								echo $row_select_pipe['abs_9_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4">
					<table width="100%" class="test1" style="" height="Auto">
						<tr>

							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>

						</tr>
						<tr>
							<td></td>
							<td></td>
							<td style="text-align:center;">Absolute Viscosity From Residue At 60&#8451;</td>
							<td></td>
							<td></td>
						</tr>
						<tr>
							<td>Viscosity Ratio</td>
							<td style="text-align:center">:-</td>
							<td>
								<hr style="padding-top:2px;">
							</td>
							<td style="text-align:center">:-</td>
							<td style="text-align:center"><?php if ($row_select_pipe['abs_9_2'] != "" && $row_select_pipe['abs_9_2'] != "0" && $row_select_pipe['abs_9_2'] != null) {
																echo $row_select_pipe['avg_abs'];
															} else {
																echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
															} ?></td>
						</tr>
						<tr>
							<td></td>
							<td></td>
							<td style="text-align:center;">Absolute Viscosity From unaged Bitumen At 60&#8451;</td>
							<td></td>
							<td></td>
						</tr>

					</table>
				</td>
			</tr>



		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td style="text-align:center;border: 1px solid black;"><b>Test-6</b></td>
				<td style="text-align:left;border: 1px solid black;"><b>Kinematic Viscosity &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Result Test Temp 135&#8451;</b></td>
				<td style="text-align:center;border: 1px solid black;"><b>IS 1206-1978( P-3)</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:10%;">
					<center><b>Sr.No.</b></center>
				</td>
				<td style="border: 1px solid black;width:75%;">
					<center><b>Description</b></center>
				</td>
				<td style="border: 1px solid black;width:15%;">
					<center><b>Result</b></center>
				</td>


			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Time Req. By Bitumen to Cross the Bulb-B(t)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['kin_5_1'] != "" && $row_select_pipe['kin_5_1'] != "0" && $row_select_pipe['kin_5_1'] != null) {
								echo $row_select_pipe['kin_5_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Bulb-B Factor (C)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['kin_6_1'] != "" && $row_select_pipe['kin_6_1'] != "0" && $row_select_pipe['kin_6_1'] != null) {
								echo $row_select_pipe['kin_6_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Kinematic Viscosity, cSt=C*t</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_kin'] != "" && $row_select_pipe['avg_kin'] != "0" && $row_select_pipe['avg_kin'] != null) {
								echo $row_select_pipe['avg_kin'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>




		</table>





		<table align="center" width="90%" class="test1" style="" height="Auto">
			<tr>
				<td colspan="6" style="border: 0px solid black;height:20px"><b>&nbsp;</b></td>

			</tr>
			<tr style="border-bottom: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>Tested By</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>Checked By</b></td>

			</tr>
			<tr style="border-bottom: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b></b></td>
				<td colspan="3" style="border: 0px solid black;"><b></b></td>

			</tr>
			<tr style="border-bottom: 0px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>

			</tr>
			<tr style="border-bottom: 0px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>

			</tr>
			<tr style="border: 2px solid black;">
				<td colspan="3" style="border: 2px solid black;"><b>Prepared & Issued by : QM</b></td>
				<td colspan="3" style="border: 2px solid black;"><b>Reviewed & Approved by : CEO</b></td>

			</tr>
		</table>


	</page>

</body>

</html>


<script type="text/javascript">


</script>
