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
	$select_tiles_query = "select * from core_cutter WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

				<td colspan="16" style="border: 2px solid black;text-align:center;"><b>Field Dry Density Test By Core Cutter Method IS 2720 (Part 29) : 1975</b></td>

			</tr>
		</table>

		<br>
		<table align="center" width="90%" class="test1" height="5%">

			<tr>
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>5</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($start_date)); ?></td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>6</b></td>
				<td style="width:20%;"><b>Date of Completion</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($end_date)); ?></td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Type of Material</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['type_method']; ?></td>
				<td style="text-align:center;width:5%;"><b>7</b></td>
				<td style="width:20%;"><b>Lab Density of Material (MDD)</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['field_mdd']; ?> g/cc</td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td><b>Size of Core Cutter Mould</b></td>
				<td><b>:-</b></td>
				<td style="text-align:right;"><b>Height -</b> <u>130 &plusmn; 0.25 mm</u></td>
				<td style="text-align:center;width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;"><b>&nbsp;</b></td>
				<td style="width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;">&nbsp;</td>

			</tr>
			<tr>
				<td style="text-align:center;width:5%;"><b></b></td>
				<td><b></b></td>
				<td><b></b></td>
				<td style="text-align:right;"><b>Dia. -</b> <u>100 &plusmn; 0.25 mm</u></td>
				<td style="text-align:center;width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;"><b>&nbsp;</b></td>
				<td style="width:5%;"><b>&nbsp;</b></td>
				<td style="width:20%;">&nbsp;</td>

			</tr>



		</table>
		<Br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="50%">
			<tr style="text-align:center;font-weight:bold;">
				<td style="border: 1px solid black;width:11%;border-bottom: 2px solid black;border-left: 2px solid black;">Sr. No.</td>
				<td style="border: 1px solid black;width:50%;border-bottom: 2px solid black;border-left: 2px solid black;">TESTING</td>
				<td style="border: 1px solid black;width:39%;border-bottom: 2px solid black;border-left: 2px solid black;">1</td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Chainage No.</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php echo $chainage_no; ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Wt. of Empty Core Cutter (gm) (W<sub>1</sub>)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['empty_core'] != "" && $row_select_pipe['empty_core'] != "0" && $row_select_pipe['empty_core'] != null) {
																						echo $row_select_pipe['empty_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;text-align:left;border-left: 2px solid black;">Vol. of Core Cutter (cc) (V)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['vol_core'] != "" && $row_select_pipe['vol_core'] != "0" && $row_select_pipe['vol_core'] != null) {
																						echo $row_select_pipe['vol_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Soil + Core Cutter (gm) (W<sub>2</sub>)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['soil_core'] != "" && $row_select_pipe['soil_core'] != "0" && $row_select_pipe['soil_core'] != null) {
																						echo $row_select_pipe['soil_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Wet Soil (gm) (W<sub>3</sub>) = (W<sub>2</sub>) - (W<sub>1</sub>)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wet_soil_core'] != "" && $row_select_pipe['wet_soil_core'] != "0" && $row_select_pipe['wet_soil_core'] != null) {
																						echo $row_select_pipe['wet_soil_core'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wet Density (gm/cc) W<sub>4</sub> = W<sub>3</sub> / V</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_1'] != "" && $row_select_pipe['fdd_1'] != "0" && $row_select_pipe['fdd_1'] != null) {
																						echo $row_select_pipe['fdd_1'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">7</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Moisture Content from Moisture Meter W(%)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['mc_soil'] != "" && $row_select_pipe['mc_soil'] != "0" && $row_select_pipe['mc_soil'] != null) {
																						echo $row_select_pipe['mc_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">8</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Container No.</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['con_no'] != "" && $row_select_pipe['con_no'] != "0" && $row_select_pipe['con_no'] != null) {
																						echo $row_select_pipe['con_no'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">9</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Container Empty wt. (gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['con_weight'] != "" && $row_select_pipe['con_weight'] != "0" && $row_select_pipe['con_weight'] != null) {
																						echo $row_select_pipe['con_weight'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">10</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Container + Wet soil(gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wt_con_wt_soil'] != "" && $row_select_pipe['wt_con_wt_soil'] != "0" && $row_select_pipe['wt_con_wt_soil'] != null) {
																						echo $row_select_pipe['wt_con_wt_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">11</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Wt. of Container + Dry soil(gm)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['wt_con_dry_soil'] != "" && $row_select_pipe['wt_con_dry_soil'] != "0" && $row_select_pipe['wt_con_dry_soil'] != null) {
																						echo $row_select_pipe['wt_con_dry_soil'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">12</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Moisture Content from Oven Dry W(%)</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_2'] != "" && $row_select_pipe['fdd_2'] != "0" && $row_select_pipe['fdd_2'] != null) {
																						echo $row_select_pipe['fdd_2'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">13</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Field Dry Density (gm/cc) D<sub>Dry</sub> = W<sub>4</sub> / ( 1 + (w/100))</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_3'] != "" && $row_select_pipe['fdd_3'] != "0" && $row_select_pipe['fdd_3'] != null) {
																						echo $row_select_pipe['fdd_3'];
																					} else {
																						echo " <br>";
																					} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">14</td>
				<td style="border: 1px solid black;border-left: 2px solid black;text-align:left;">Compaction (%) = (D<sub>Dry</sub>/ MDD) x 100</td>
				<td style="border: 1px solid black;border-left: 2px solid black;"><?php if ($row_select_pipe['fdd_4'] != "" && $row_select_pipe['fdd_4'] != "0" && $row_select_pipe['fdd_4'] != null) {
																						echo $row_select_pipe['fdd_4'];
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
	window.onload = function() {
		setTimeout(function() {

				window.print();
			},
			1000);

	}
</script>
