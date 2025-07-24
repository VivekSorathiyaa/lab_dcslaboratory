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
	$select_tiles_query = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$chainage_no = $row_select4['chainage_no'];
		$type_method = $row_select4['type_method'];
	}

	?>

	<br>
	<br>
	<br>

	<page size="A4">

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td colspan="4" rowspan="4" style="height:50px;width:80px;border: 2px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td colspan="4" rowspan="4" style="font-size:16px;border: 2px solid black;">
					<center><b>MATTEST ENGINEERING <Br> SERVICES<br>
							<br>
							<br>(SOIL)</b></center>
				</td>
				<td colspan="2" style="border: 2px solid black;"><b>Doc. No.</b></td>
				<td colspan="6" style="border: 2px solid black;"><b>F / 7.5 / 08</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="2" style="border: 2px solid black;"><b>Issue No.</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center;"><b>02</b></td>
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
			<tr style="border: 2px solid black;">

				<td colspan="16" style="border: 2px solid black;text-align:center;"><b>FIELD COMPACTION TEST BY SAND REPLACEMENT METHOD<br>(as per IS : 2720 (Part 28))</b></td>

			</tr>
		</table>

		<br>
		<table align="center" width="90%" class="test1" height="5%">

			<tr>
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($start_date)); ?></td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>5</b></td>
				<td style="width:20%;"><b>Date of Completion</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($end_date)); ?></td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Lab Density of Material (MDD)</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php if ($row_select_pipe['cal_mdd'] != "" && $row_select_pipe['cal_mdd'] != "0" && $row_select_pipe['cal_mdd'] != null) {
											echo $row_select_pipe['cal_mdd'];
										} else {
											echo " <br>";
										} ?> g/cc</td>
				<td style="text-align:center;width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;"><b>&nbsp;</b></td>
				<td style="width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;">&nbsp;</td>

			</tr>




		</table>
		<Br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 2px solid black;">
				<td rowspan="5" style="border: 2px solid black;font-weight:bold;width:61%;">
					<center>Uniformly Graded Natural Sand Passing through 1.00<br>mm and Retained on 600 Micron IS Sieve</center>
				</td>




			</tr>
			<tr style="border: 2px solid black;">
				<td rowspan="2" style="border: 2px solid black;font-weight:bold;"></td>
				<td colspan="2" style="border: 2px solid black;font-weight:bold;">
					<center>Pouring Cylinder</center>
				</td>


			</tr>
			<tr style="border: 2px solid black;">


				<td style="border: 2px solid black;font-weight:bold;">
					<center>Small</center>
				</td>
				<td style="border: 2px solid black;font-weight:bold;">
					<center>Large</center>
				</td>

			</tr>
			<tr style="border: 2px solid black;">


				<td style="border: 2px solid black;font-weight:bold;width:13%">
					<center>Dia (mm)</center>
				</td>
				<td style="border: 2px solid black;font-weight:bold;width:13%">
					<center>100 &plusmn; 0.1</center>
				</td>
				<td style="border: 2px solid black;font-weight:bold;width:13%">
					<center>200 &plusmn; 0.1</center>
				</td>


			</tr>
			<tr style="border: 2px solid black;">


				<td style="border: 2px solid black;font-weight:bold;">
					<center>Depth (mm)</center>
				</td>
				<td style="border: 2px solid black;font-weight:bold;">
					<center>150 &plusmn; 0.1</center>
				</td>
				<td style="border: 2px solid black;font-weight:bold;">
					<center>250 &plusmn; 0.1</center>
				</td>


			</tr>

		</table>
		<Br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">

			<tr style="border: 2px solid black;">
				<td Colspan="3" style="border: 2px solid black;font-weight:bold;width:50%;">
					<center>Density of Sand</center>
				</td>
			</tr>
			<tr style="border: 1px solid black;text-align:center;">
				<td style="border: 1px solid black;width:5%;">1</td>
				<td style="border: 1px solid black;text-align:left;width:70%;">Wt. of Sand in Cone W<sub>2</sub>, gm</td>
				<td style="border: 1px solid black;width:25%;"><?php if ($row_select_pipe['c1'] != "" && $row_select_pipe['c1'] != "0" && $row_select_pipe['c1'] != null) {
																	echo $row_select_pipe['c1'];
																} else {
																	echo " <br>";
																} ?></td>
			</tr>
			<tr style="border: 1px solid black;text-align:center;">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;text-align:left;">Vol. of Calibrating Container V (cc)</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['c2'] != "" && $row_select_pipe['c2'] != "0" && $row_select_pipe['c2'] != null) {
															echo $row_select_pipe['c2'];
														} else {
															echo " <br>";
														} ?></td>
			</tr>
			<tr style="border: 1px solid black;text-align:center;">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;text-align:left;">Wt. of Sand + Cylinder before Pouring W<sub>1</sub> (gm)</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['c3'] != "" && $row_select_pipe['c3'] != "0" && $row_select_pipe['c3'] != null) {
															echo $row_select_pipe['c3'];
														} else {
															echo " <br>";
														} ?></td>
			</tr>
			<tr style="border: 1px solid black;text-align:center;">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;text-align:left;">Wt. of Sand + Cylinder after Pouring W<sub>3</sub> (gm)</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['c4'] != "" && $row_select_pipe['c4'] != "0" && $row_select_pipe['c4'] != null) {
															echo $row_select_pipe['c4'];
														} else {
															echo " <br>";
														} ?></td>
			</tr>
			<tr style="border: 1px solid black;text-align:center;">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;text-align:left;">Wt. of Sand to Fill Calibrating Cylinder W<sub>a</sub> = W<sub>1</sub> - W<sub>3</sub> - W<sub>2</sub> (gm)</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['c5'] != "" && $row_select_pipe['c5'] != "0" && $row_select_pipe['c5'] != null) {
															echo $row_select_pipe['c5'];
														} else {
															echo " <br>";
														} ?></td>
			</tr>

			<tr style="border: 1px solid black;text-align:center;">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;text-align:left;">Bulk density of Sand D<sub>s</sub> = W<sub>a</sub> / V (g/cc)</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['c6'] != "" && $row_select_pipe['c6'] != "0" && $row_select_pipe['c6'] != null) {
															echo $row_select_pipe['c6'];
														} else {
															echo " <br>";
														} ?></td>
			</tr>
		</table>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="text-align:center;">
				<td rowspan="2" style="border: 1px solid black;width:5%;border-bottom: 2px solid black;border-left: 2px solid black;">Sr.<br>No.</td>
				<td rowspan="2" style="border: 1px solid black;width:70%;border-bottom: 2px solid black;border-left: 2px solid black;">Description</td>
				<td style="border: 1px solid black;width:25%;border-bottom: 2px solid black;border-left: 2px solid black;">Test Result</td>

			</tr>
			<tr style="text-align:center;">
				<td style="border: 1px solid black;width:13%;border-bottom: 2px solid black;border-left: 2px solid black;">1</td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Chainage No. \ Location</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php echo $chainage_no; ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Layer of Material</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['layer_mt'] != "" && $row_select_pipe['layer_mt'] != "0" && $row_select_pipe['layer_mt'] != null) {
																						echo $row_select_pipe['layer_mt'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Wt. of Wet Sample from Hole W<sub>W</sub> (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d1'] != "" && $row_select_pipe['d1'] != "0" && $row_select_pipe['d1'] != null) {
																						echo $row_select_pipe['d1'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Sand + Cylinder before Pouring (W<sub>1</sub>) (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d2'] != "" && $row_select_pipe['d2'] != "0" && $row_select_pipe['d2'] != null) {
																						echo $row_select_pipe['d2'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Sand + Cylinder after Pouring (W<sub>4</sub>) (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d3'] != "" && $row_select_pipe['d3'] != "0" && $row_select_pipe['d3'] != null) {
																						echo $row_select_pipe['d3'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Sand to Fill Hole W<sub>b</sub> = W<sub>1</sub> - W<sub>4</sub> - W<sub>2</sub> (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d4'] != "" && $row_select_pipe['d4'] != "0" && $row_select_pipe['d4'] != null) {
																						echo $row_select_pipe['d4'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">7</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wet Density of Sample, D<sub>wet</sub> = (W<sub>W</sub>/W<sub>b</sub>) x D<sub>S</sub></td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d5'] != "" && $row_select_pipe['d5'] != "0" && $row_select_pipe['d5'] != null) {
																						echo $row_select_pipe['d5'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">8</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Moisture content from Moisture Meter W(%)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d6'] != "" && $row_select_pipe['d6'] != "0" && $row_select_pipe['d6'] != null) {
																						echo $row_select_pipe['d6'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">9</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Container No.</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['con_no'] != "" && $row_select_pipe['con_no'] != "0" && $row_select_pipe['con_no'] != null) {
																						echo $row_select_pipe['con_no'];
																					} else {
																						echo " <br>";
																					} ?></td>


			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">10</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Container Empty wt. (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['con_weight'] != "" && $row_select_pipe['con_weight'] != "0" && $row_select_pipe['con_weight'] != null) {
																						echo $row_select_pipe['con_weight'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">11</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Container + Wet Soil(gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wt_con_wt_soil'] != "" && $row_select_pipe['wt_con_wt_soil'] != "0" && $row_select_pipe['wt_con_wt_soil'] != null) {
																						echo $row_select_pipe['wt_con_wt_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">12</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Container + Dry soil(gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wt_con_dry_soil'] != "" && $row_select_pipe['wt_con_dry_soil'] != "0" && $row_select_pipe['wt_con_dry_soil'] != null) {
																						echo $row_select_pipe['wt_con_dry_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">13</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Moisture Content from Oven Dry W(%)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['mc_od'] != "" && $row_select_pipe['mc_od'] != "0" && $row_select_pipe['mc_od'] != null) {
																						echo $row_select_pipe['mc_od'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">14</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">D<sub>dry</sub> = 100 x D<sub>wet</sub> / ( 100 + w%) (g/cc)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d7'] != "" && $row_select_pipe['d7'] != "0" && $row_select_pipe['d7'] != null) {
																						echo $row_select_pipe['d7'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">15</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Compaction (%) = (D<sub>dry</sub>/ MDD) x 100</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['d8'] != "" && $row_select_pipe['d8'] != "0" && $row_select_pipe['d8'] != null) {
																						echo $row_select_pipe['d8'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<br>
		</table>

		<br>


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
