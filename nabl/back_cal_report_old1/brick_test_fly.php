<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 20px 20px;
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
	table{
		font-size: 12px;
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
	$select_tiles_query = "select * from span_brick_fly WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$mark = $row_select4['brick_mark'];
		$brick_specification = $row_select4['brick_specification'];
	}

	?>

	<br>

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
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE FLYASH BRICKS</b></center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of brick</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mt_name; ?> FLY ASH BRICKS</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification Mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mark; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:16px;">

					<table align="center" width="100%"  class="test1" cellspacing="0" cellpadding="0" style="font-family: Cambria;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" rowspan="2" colspan="2">&nbsp;&nbsp; A. &nbsp;&nbsp; Dimensions Tolerances &nbsp;&nbsp;</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>
						</tr>
						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; IS:1077-1992</td>
						</tr>
						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; No. of Brick = <?php if ($row_select_pipe['no_of_brick'] != "" && $row_select_pipe['no_of_brick'] != "0" && $row_select_pipe['no_of_brick'] != null) {
																												echo $row_select_pipe['no_of_brick'];
																											} else {
																												echo " <br>";
																											} ?> NO'S
							</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;">&nbsp;&nbsp; Dimensions & Tolerance</td>
						</tr>
						<tr style="">
							<td style="width:30%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;">&nbsp;&nbsp; Length (mm)</td>
							<td style="width:20%; text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;"><?php echo $row_select_pipe['avg_length']; ?></td>
							<td style="width:50%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;text-align: center;">&nbsp;&nbsp; 4600 ± 80 mm</td>
						</tr>
						<tr style="">
							<td style="width:30%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;">&nbsp;&nbsp; Width (mm)</td>
							<td style="width:20%; text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;border-right:1px solid;"><?php echo $row_select_pipe['avg_width']; ?></td>
							<td style="width:50%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-bottom:1px solid;text-align: center;">&nbsp;&nbsp; 2200 ± 40 mm</td>
						</tr>
						<tr style="">
							<td style="width:30%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;border-right:1px solid;">&nbsp;&nbsp; Height (mm)</td>
							<td style="width:20%; text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px;border-right:1px solid;"><?php echo $row_select_pipe['avg_height']; ?></td>
							<td style="width:50%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: center;">&nbsp;&nbsp; 1400 ± 40 mm</td>
						</tr>

					</table>
				</td>
			</tr>
		</table>
		<br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-family: Cambria;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" rowspan="2" colspan="5">&nbsp;&nbsp; B. &nbsp;&nbsp; Compressive Strength</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;border-left:1px solid;" colspan="3">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?> </td>
						</tr>
						<tr style="">
							<td style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;border-left:1px solid;" colspan="3">&nbsp;&nbsp; IS: 3495 (Part 1)-2019 </td>
						</tr>
						<tr style="">
							<th style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;text-align: center;" >&nbsp;&nbsp; Sr. No. </th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;">&nbsp;&nbsp; Sample I.D.</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Length in mm</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Breadth in mm</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Height  in mm</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Area (mm<sup>2</sup>)</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Load in KN</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-left:1px solid;">&nbsp;&nbsp; Compressive strength N/mm<sup>2</sup></th>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['com_lab_1']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_1'] != "" && $row_select_pipe['com_l_1'] != "0" && $row_select_pipe['com_l_1'] != null) {
																														echo $row_select_pipe['com_l_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_1'] != "" && $row_select_pipe['com_b_1'] != "0" && $row_select_pipe['com_b_1'] != null) {
																														echo $row_select_pipe['com_b_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_1'] != "" && $row_select_pipe['com_h_1'] != "0" && $row_select_pipe['com_h_1'] != null) {
																														echo $row_select_pipe['com_h_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_1'] != "" && $row_select_pipe['com_area_1'] != "0" && $row_select_pipe['com_area_1'] != null) {
																														echo $row_select_pipe['com_area_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_1'] != "" && $row_select_pipe['com_load_1'] != "0" && $row_select_pipe['com_load_1'] != null) {
																														echo $row_select_pipe['com_load_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['com_lab_2']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_2'] != "" && $row_select_pipe['com_l_2'] != "0" && $row_select_pipe['com_l_2'] != null) {
																														echo $row_select_pipe['com_l_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_2'] != "" && $row_select_pipe['com_b_2'] != "0" && $row_select_pipe['com_b_2'] != null) {
																														echo $row_select_pipe['com_b_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_2'] != "" && $row_select_pipe['com_h_2'] != "0" && $row_select_pipe['com_h_2'] != null) {
																														echo $row_select_pipe['com_h_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_2'] != "" && $row_select_pipe['com_area_2'] != "0" && $row_select_pipe['com_area_2'] != null) {
																														echo $row_select_pipe['com_area_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_2'] != "" && $row_select_pipe['com_load_2'] != "0" && $row_select_pipe['com_load_2'] != null) {
																														echo $row_select_pipe['com_load_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['com_lab_3']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_3'] != "" && $row_select_pipe['com_l_3'] != "0" && $row_select_pipe['com_l_3'] != null) {
																														echo $row_select_pipe['com_l_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_3'] != "" && $row_select_pipe['com_b_3'] != "0" && $row_select_pipe['com_b_3'] != null) {
																														echo $row_select_pipe['com_b_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_3'] != "" && $row_select_pipe['com_h_3'] != "0" && $row_select_pipe['com_h_3'] != null) {
																														echo $row_select_pipe['com_h_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_load_3'] != "" && $row_select_pipe['com_load_3'] != "0" && $row_select_pipe['com_load_3'] != null) {
																														echo $row_select_pipe['com_load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_3'] != "" && $row_select_pipe['com_load_3'] != "0" && $row_select_pipe['com_load_3'] != null) {
																														echo $row_select_pipe['com_load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['com_lab_4']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_4'] != "" && $row_select_pipe['com_l_4'] != "0" && $row_select_pipe['com_l_4'] != null) {
																														echo $row_select_pipe['com_l_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_4'] != "" && $row_select_pipe['com_b_4'] != "0" && $row_select_pipe['com_b_4'] != null) {
																														echo $row_select_pipe['com_b_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_4'] != "" && $row_select_pipe['com_h_4'] != "0" && $row_select_pipe['com_h_4'] != null) {
																														echo $row_select_pipe['com_h_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_4'] != "" && $row_select_pipe['com_area_4'] != "0" && $row_select_pipe['com_area_4'] != null) {
																														echo $row_select_pipe['com_area_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_4'] != "" && $row_select_pipe['com_load_4'] != "0" && $row_select_pipe['com_load_4'] != null) {
																														echo $row_select_pipe['com_load_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																														echo $row_select_pipe['com_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['com_lab_5']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_5'] != "" && $row_select_pipe[''] != "0" && $row_select_pipe['com_l_5'] != null) {
																														echo $row_select_pipe['com_l_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_5'] != "" && $row_select_pipe['com_b_5'] != "0" && $row_select_pipe['com_b_5'] != null) {
																														echo $row_select_pipe['com_b_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_5'] != "" && $row_select_pipe['com_h_5'] != "0" && $row_select_pipe['com_h_5'] != null) {
																														echo $row_select_pipe['com_h_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_5'] != "" && $row_select_pipe['com_area_5'] != "0" && $row_select_pipe['com_area_5'] != null) {
																														echo $row_select_pipe['com_area_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_5'] != "" && $row_select_pipe['com_load_5'] != "0" && $row_select_pipe['com_load_5'] != null) {
																														echo $row_select_pipe['com_load_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																														echo $row_select_pipe['com_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr>
							<td style="border-top:1px solid;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;" colspan="6"></td>
							<td style="border-top:1px solid;text-align:right;font-weight:bold;padding-bottom:5px;padding-top:5px;border-left:1px solid;">Average &nbsp;</td>
							<td style="border-top:1px solid;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;border-left:1px solid;"><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != "0" && $row_select_pipe['avg_com'] != null) {
																																				echo $row_select_pipe['avg_com'];
																																			} else {
																																				echo " <br>";
																																			} ?><span style=""></td>
						</tr>

					</table>

				</td>
			</tr>
		</table>
		<br>



		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-family: Cambria;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" rowspan="2" colspan="4">&nbsp;&nbsp; C. &nbsp;&nbsp; Water Absorption</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>
						</tr>
						<tr style="">
							<td style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; IS : 3495-1992 PART -2 </td>
						</tr>
						<tr style="">
							<th style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;text-align: center;" >&nbsp;&nbsp; Sr. No. </th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-right:1px solid;">&nbsp;&nbsp; Sample I.D.</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-right:1px solid;">&nbsp;&nbsp; Oven Dry Weight in <br> (g) <br> W1</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-right:1px solid;">&nbsp;&nbsp; S. S. Dry <br> weight in  (g) <br> W2</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-right:1px solid;">&nbsp;&nbsp; Difference <br> W2-W1 in (g)</th>
							<th style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;">&nbsp;&nbsp; Water Absorption in percent <br> <span style="border-bottom:1px solid;">(𝑊2 − 𝑊1)</span> 𝑋100<br>𝑊1</th>
						</tr>
						
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;border-right:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['wtr_lab_1']; ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) {
																														echo $row_select_pipe['wtr_w1_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != ""  && $row_select_pipe['wtr_w2_1'] != null) {
																														echo $row_select_pipe['wtr_w2_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != ""  && $row_select_pipe['wtr_w2_1'] != null) {
																														echo (($row_select_pipe['wtr_w2_1']) - ($row_select_pipe['wtr_w1_1']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
																														echo $row_select_pipe['wtr_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;border-right:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['wtr_lab_2']; ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) {
																														echo $row_select_pipe['wtr_w1_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo $row_select_pipe['wtr_w2_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo (($row_select_pipe['wtr_w2_2']) - ($row_select_pipe['wtr_w1_2']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
																														echo $row_select_pipe['wtr_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;border-right:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['wtr_lab_3']; ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_3'] != ""  && $row_select_pipe['wtr_w1_3'] != null) {
																														echo $row_select_pipe['wtr_w1_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != null) {
																														echo $row_select_pipe['wtr_w2_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != ""  && $row_select_pipe['wtr_w2_3'] != null) {
																														echo (($row_select_pipe['wtr_w2_3']) - ($row_select_pipe['wtr_w1_3']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_3'] != ""  && $row_select_pipe['wtr_3'] != null) {
																														echo $row_select_pipe['wtr_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;width:10%;border-right:1px solid; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['wtr_lab_4']; ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_4'] != "" && $row_select_pipe['wtr_w1_4'] != null) {
																														echo $row_select_pipe['wtr_w1_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_4'] != ""  && $row_select_pipe['wtr_w2_4'] != null) {
																														echo $row_select_pipe['wtr_w2_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_4'] != ""  && $row_select_pipe['wtr_w2_4'] != null) {
																														echo (($row_select_pipe['wtr_w2_4']) - ($row_select_pipe['wtr_w1_4']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {
																														echo $row_select_pipe['wtr_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;border-right:1px solid;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;border-right:1px solid;width:10%; text-align:center;padding-bottom:5px;padding-top:5px;"><?php echo $row_select_pipe['wtr_lab_5']; ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_5'] != ""  && $row_select_pipe['wtr_w1_5'] != null) {
																														echo $row_select_pipe['wtr_w1_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_5'] != ""  && $row_select_pipe['wtr_w2_5'] != null) {
																														echo $row_select_pipe['wtr_w2_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-right:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_5'] != ""  && $row_select_pipe['wtr_w2_5'] != null) {
																														echo (($row_select_pipe['wtr_w2_5']) - ($row_select_pipe['wtr_w1_5']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_5'] != "" && $row_select_pipe['wtr_5'] != null) {
																														echo $row_select_pipe['wtr_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

						<tr>
							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;border-right:1px solid;" colspan="4"></td>
							<td style="border-top:1px solid;width:10%; text-align:right;font-weight:bold;padding-bottom:5px;padding-top:5px;border-right:1px solid;">Average &nbsp;</td>
							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><span style=""><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
																																																				echo $row_select_pipe['avg_wtr'];
																																																			} else {
																																																				echo " <br>";
																																																			} ?></td>
						</tr>

					</table>

				</td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
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
			<tr>
				<td style=""><center>Page 1 of 2</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<div class="pagebreak"></div>
		<br><br>
		<br><br>
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
					<center><b>FMT-OBS-004</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE FLYASH BRICKS</b></center>
				</td>
			</tr>
		</table>

		<br><br>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-family: Cambria;">

						<tr style="">
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-right:1px solid;border-bottom:1px solid;" rowspan="2" colspan="4">&nbsp;&nbsp; D. &nbsp;&nbsp;Efflorescence Visual observation After two cycle</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>
						</tr>
						<tr style="">
							<td style="text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; text-align: center;border-bottom:1px solid;" colspan="2">&nbsp;&nbsp; IS: 3495 (Part 3)-2019 </td>
						</tr>
						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">MEASURE</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; " colspan=5>Mark in appropriate (√)</td>
						</tr>
						
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SAMPLE ID</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">NIL</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "NIL"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SLIGHT</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "SLIGHT"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">MODERATE</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "MODERATE"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">HEAVY</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "HEAVY"){echo '&#10004;';} else { echo " <br>";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SERIOUS</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo1'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo2'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo3'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo4'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['rbt_efflo5'] == "SERIOUS"){echo '&#10004;';} else { echo " <br>";} ?></td>
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

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
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
			<tr>
				<td style=""><center>Page 2 of 2</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>

		<!-- <table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;"> -->
			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:20px;margin-top:20px;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[3]</td>
							<td style="width:90%; text-align:left;font-weight:bold;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Water Absorption [ IS : 3495-1992 PART -2 ]</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;">

						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">Sample <br>ID</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; ">Oven Dry<br> Weight in (g)<br>W1</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; ">S. S. Dry<br>weight in g.<br>W2</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; ">Difference<br>W2-W1 in g</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Water Absorption in<br>percent<br><span style="border-bottom:1px solid;">(𝑊2 − 𝑊1)</span> 𝑋100<br>𝑊1</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) {
																														echo $row_select_pipe['wtr_w1_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
																														echo $row_select_pipe['wtr_w2_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
																														echo (($row_select_pipe['wtr_w2_1']) - ($row_select_pipe['wtr_w1_1']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
																														echo $row_select_pipe['wtr_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"> <?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) {
																														echo $row_select_pipe['wtr_w1_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo $row_select_pipe['wtr_w2_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo (($row_select_pipe['wtr_w2_2']) - ($row_select_pipe['wtr_w1_2']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
																														echo $row_select_pipe['wtr_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?> </td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) {
																														echo $row_select_pipe['wtr_w1_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
																														echo $row_select_pipe['wtr_w2_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
																														echo (($row_select_pipe['wtr_w2_3']) - ($row_select_pipe['wtr_w1_3']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
																														echo $row_select_pipe['wtr_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"> <?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_4'] != "" && $row_select_pipe['wtr_w1_4'] != "0" && $row_select_pipe['wtr_w1_4'] != null) {
																														echo $row_select_pipe['wtr_w1_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_4'] != "" && $row_select_pipe['wtr_w2_4'] != "0" && $row_select_pipe['wtr_w2_4'] != null) {
																														echo $row_select_pipe['wtr_w2_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_4'] != "" && $row_select_pipe['wtr_w2_4'] != "0" && $row_select_pipe['wtr_w2_4'] != null) {
																														echo (($row_select_pipe['wtr_w2_4']) - ($row_select_pipe['wtr_w1_4']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_4'] != "" && $row_select_pipe['wtr_4'] != "0" && $row_select_pipe['wtr_4'] != null) {
																														echo $row_select_pipe['wtr_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"> <?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w1_5'] != "" && $row_select_pipe['wtr_w1_5'] != "0" && $row_select_pipe['wtr_w1_5'] != null) {
																														echo $row_select_pipe['wtr_w1_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_5'] != "" && $row_select_pipe['wtr_w2_5'] != "0" && $row_select_pipe['wtr_w2_5'] != null) {
																														echo $row_select_pipe['wtr_w2_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_5'] != "" && $row_select_pipe['wtr_w2_5'] != "0" && $row_select_pipe['wtr_w2_5'] != null) {
																														echo (($row_select_pipe['wtr_w2_5']) - ($row_select_pipe['wtr_w1_5']));
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php if ($row_select_pipe['wtr_5'] != "" && $row_select_pipe['wtr_5'] != "0" && $row_select_pipe['wtr_5'] != null) {
																														echo $row_select_pipe['wtr_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;margin-right:80px;">

						<tr style="">

							<td style="width:78%; text-align:right;font-weight:bold; "><span style="">Average &nbsp;</td>
							<td style="width:22%; text-align:center;font-weight:bold;border:1px solid;border-top:0px solid;border-right:0px solid;padding-bottom:3px;padding-top:3px;	"><span style=""><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
																																																				echo $row_select_pipe['avg_wtr'];
																																																			} else {
																																																				echo " <br>";
																																																			} ?></td>
						</tr>

					</table><br><br>

				</td>
			</tr> -->



			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[4]</td>
							<td style="width:90%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Efflorescence Visual observation After two cycle [ IS : 3495-1992 PART -3 ]</td>

						</tr>

					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="75%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;margin-bottom:20px;margin-left:10%;">

						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">MEASURE</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; " colspan=5>Mark in appropriate (√)</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SAMPLE ID</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center;font-weight:bold; "><?php echo $cnt++; ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">NIL</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; ">&nbsp;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SLIGHT</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; ">&nbsp;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">MODERATE</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; ">&nbsp;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">HEAVY</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; ">&nbsp;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:30%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;">SERIOUS</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; ">&nbsp;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "></td>
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
			</tr>
		</table> -->

		<!-- <table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;"> -->
			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: GOMAEC/N/OS/001</td>
							<td style="width:20%;text-align:center;font-weight:bold; ">REV: 2</td>
							<td style="width:25%; font-weight:bold;">RD:- 05/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : 1</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:75%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:20px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:20px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:15px;padding-top:15px; text-align:center;font-weight:bold; "><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BRICK</td>
						</tr>

					</table>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Job No.</td>
							<td style="border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Sample sent by</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php if ($sample_sent_by == 1) {
																												echo 'Agency';
																											} else if ($sample_sent_by == 0) {
																												echo 'Client';
																											} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Quantity of sample</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php if ($row_select_pipe['no_of_brick'] != "" && $row_select_pipe['no_of_brick'] != "0" && $row_select_pipe['no_of_brick'] != null) {
																												echo $row_select_pipe['no_of_brick'];
																											} else {
																												echo " <br>";
																											} ?> NOS</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Identification mark</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['identification_mark']; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Type of material</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $mt_name; ?> FLY ASH BRICKS </td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Fog ID</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; --</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

					</table><br>

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;margin-bottom:16px;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[A]</td>
							<td style="width:90%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Dimensions Tolerances [ IS : 1077-1992 ]</td>

						</tr>

					</table>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:15px;">

						<tr style="">

							<td style="width:30%;text-align:center;font-weight:bold;  " colspan=2>Tests</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Dimensions</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; ">Modular Tolerance</td>
							<td style="border-left:1px solid;width:30%; text-align:center;font-weight:bold; ">Non-Modular Tolerance</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;  ">(i)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Length mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['dim_length'] != "" && $row_select_pipe['dim_length'] != "0" && $row_select_pipe['dim_length'] != null) {
																																		echo $row_select_pipe['dim_length'];
																																	} else {
																																		echo " <br>";
																																	} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; ">3800 ± 80 mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;font-weight:bold; ">4600 ± 80 mm</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;  ">(ii)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Width mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['dim_width'] != "" && $row_select_pipe['dim_width'] != "0" && $row_select_pipe['dim_width'] != null) {
																																		echo $row_select_pipe['dim_width'];
																																	} else {
																																		echo " <br>";
																																	} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; ">1800 ± 40 mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;font-weight:bold; ">2200 ± 40 mm</td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;  ">(iii)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; ">Height mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold; "><?php if ($row_select_pipe['dim_height'] != "" && $row_select_pipe['dim_height'] != "0" && $row_select_pipe['dim_height'] != null) {
																																		echo $row_select_pipe['dim_height'];
																																	} else {
																																		echo " <br>";
																																	} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px; ">1800 ± 40 mm/<br> 800 ± 80 mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;font-weight:bold; ">1400 ± 40 mm/600 ± 40 mm</td>
						</tr>

					</table>

				</td>
			</tr> -->


			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:15px;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">[2]</td>
							<td style="width:90%; text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Compressive Strength [ IS : 3495-1992 PART -1 ]</td>

						</tr>

					</table>

				</td>
			</tr> -->

			<?php $cnt = 1; ?>
			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;margin-bottom:15px;border-width:1px 0px 1px 0px;">

						<tr style="">

							<td style="width:10%;text-align:center;font-weight:bold;  ">Sample <br>ID</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Length in <br>mm</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Breadth <br>in<br> mm</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Height in <br>mm</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Load <br>KN<br> (dial) </td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Load N<br>(dial <br>gauge)</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold; ">Area<br>(mm&sup2;)</td>
							<td style="border-left:1px solid;width:20%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Compressive <br>strength=<br>Load / Area </td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_1'] != "" && $row_select_pipe['com_l_1'] != "0" && $row_select_pipe['com_l_1'] != null) {
																														echo $row_select_pipe['com_l_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_1'] != "" && $row_select_pipe['com_b_1'] != "0" && $row_select_pipe['com_b_1'] != null) {
																														echo $row_select_pipe['com_b_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_1'] != "" && $row_select_pipe['com_h_1'] != "0" && $row_select_pipe['com_h_1'] != null) {
																														echo $row_select_pipe['com_h_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_1'] != "" && $row_select_pipe['com_load_1'] != "0" && $row_select_pipe['com_load_1'] != null) {
																														echo $row_select_pipe['com_load_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_1'] != "" && $row_select_pipe['com_load_1'] != "0" && $row_select_pipe['com_load_1'] != null) {
																														echo ($row_select_pipe['com_load_1'] * 1000);
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_1'] != "" && $row_select_pipe['com_area_1'] != "0" && $row_select_pipe['com_area_1'] != null) {
																														echo $row_select_pipe['com_area_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_2'] != "" && $row_select_pipe['com_l_2'] != "0" && $row_select_pipe['com_l_2'] != null) {
																														echo $row_select_pipe['com_l_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_2'] != "" && $row_select_pipe['com_b_2'] != "0" && $row_select_pipe['com_b_2'] != null) {
																														echo $row_select_pipe['com_b_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_2'] != "" && $row_select_pipe['com_h_2'] != "0" && $row_select_pipe['com_h_2'] != null) {
																														echo $row_select_pipe['com_h_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_2'] != "" && $row_select_pipe['com_load_2'] != "0" && $row_select_pipe['com_load_2'] != null) {
																														echo $row_select_pipe['com_load_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_2'] != "" && $row_select_pipe['com_load_2'] != "0" && $row_select_pipe['com_load_2'] != null) {
																														echo ($row_select_pipe['com_load_2'] * 1000);
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_2'] != "" && $row_select_pipe['com_area_2'] != "0" && $row_select_pipe['com_area_2'] != null) {
																														echo $row_select_pipe['com_area_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_3'] != "" && $row_select_pipe['com_l_3'] != "0" && $row_select_pipe['com_l_3'] != null) {
																														echo $row_select_pipe['com_l_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_3'] != "" && $row_select_pipe['com_b_3'] != "0" && $row_select_pipe['com_b_3'] != null) {
																														echo $row_select_pipe['com_b_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_3'] != "" && $row_select_pipe['com_h_3'] != "0" && $row_select_pipe['com_h_3'] != null) {
																														echo $row_select_pipe['com_h_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_3'] != "" && $row_select_pipe['com_load_3'] != "0" && $row_select_pipe['com_load_3'] != null) {
																														echo $row_select_pipe['com_load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_2'] != "" && $row_select_pipe['com_load_2'] != "0" && $row_select_pipe['com_load_2'] != null) {
																														echo ($row_select_pipe['com_load_2'] * 1000);
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_load_3'] != "" && $row_select_pipe['com_load_3'] != "0" && $row_select_pipe['com_load_3'] != null) {
																														echo $row_select_pipe['com_load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_4'] != "" && $row_select_pipe['com_l_4'] != "0" && $row_select_pipe['com_l_4'] != null) {
																														echo $row_select_pipe['com_l_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_4'] != "" && $row_select_pipe['com_b_4'] != "0" && $row_select_pipe['com_b_4'] != null) {
																														echo $row_select_pipe['com_b_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_4'] != "" && $row_select_pipe['com_h_4'] != "0" && $row_select_pipe['com_h_4'] != null) {
																														echo $row_select_pipe['com_h_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_4'] != "" && $row_select_pipe['com_load_4'] != "0" && $row_select_pipe['com_load_4'] != null) {
																														echo $row_select_pipe['com_load_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_4'] != "" && $row_select_pipe['com_load_4'] != "0" && $row_select_pipe['com_load_4'] != null) {
																														echo ($row_select_pipe['com_load_4'] * 1000);
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_4'] != "" && $row_select_pipe['com_area_4'] != "0" && $row_select_pipe['com_area_4'] != null) {
																														echo $row_select_pipe['com_area_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																														echo $row_select_pipe['com_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px;"><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "> <?php if ($row_select_pipe['com_l_5'] != "" && $row_select_pipe[''] != "0" && $row_select_pipe['com_l_5'] != null) {
																														echo $row_select_pipe['com_l_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_b_5'] != "" && $row_select_pipe['com_b_5'] != "0" && $row_select_pipe['com_b_5'] != null) {
																														echo $row_select_pipe['com_b_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_h_5'] != "" && $row_select_pipe['com_h_5'] != "0" && $row_select_pipe['com_h_5'] != null) {
																														echo $row_select_pipe['com_h_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_5'] != "" && $row_select_pipe['com_load_5'] != "0" && $row_select_pipe['com_load_5'] != null) {
																														echo $row_select_pipe['com_load_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_load_5'] != "" && $row_select_pipe['com_load_5'] != "0" && $row_select_pipe['com_load_5'] != null) {
																														echo ($row_select_pipe['com_load_5'] * 1000);
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_area_5'] != "" && $row_select_pipe['com_area_5'] != "0" && $row_select_pipe['com_area_5'] != null) {
																														echo $row_select_pipe['com_area_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																														echo $row_select_pipe['com_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;margin-right:80px;">

						<tr style="">

							<td style="width:60%; text-align:right;font-weight:bold; "><span style="">Average=</td>
							<td style="width:30%; text-align:center;font-weight:bold;border:1px solid;padding-bottom:3px;padding-top:3px;"><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != "0" && $row_select_pipe['avg_com'] != null) {
																																				echo $row_select_pipe['avg_com'];
																																			} else {
																																				echo " <br>";
																																			} ?><span style=""> </td>
							<td style="width:10%; text-align:center;font-weight:bold;"><span style="">&nbsp; N/mm2</td>

						</tr>

					</table><br>

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:1/2</td>
						</tr>

					</table>

				</td>
			</tr>



		</table> -->





			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
	</page>

</body>

</html>


<script type="text/javascript">

</script>