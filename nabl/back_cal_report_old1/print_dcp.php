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
	$select_tiles_query = "select * from dcp WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$chainage_no = $row_select4['chainage_no'];
		$type_method = $row_select4['type_method'];
	}

	?>

	<br>
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
					<center><b>FMT-OBS-00</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON DCPT</b></center>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" height="12%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td colspan=4 style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td colspan=4 style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($start_date)); ?></td>
                <td style="text-align:center;border-left:1px solid;width:7%;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>    
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Layer of Material</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php if ($row_select_pipe['layer_mt'] != "" && $row_select_pipe['layer_mt'] != "0" && $row_select_pipe['layer_mt'] != null) {
											echo $row_select_pipe['layer_mt'];
										} else {
											echo " <br>";
										} ?></td>
                <td style="text-align:center;border-left:1px solid;width:7%;"><b>6</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp;Field Moisture</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp;<?php if ($row_select_pipe['field_mos'] != "" && $row_select_pipe['field_mos'] != "0" && $row_select_pipe['field_mos'] != null) {
											echo $row_select_pipe['field_mos'];
										} else {
											echo " <br>";
										} ?></td>    
			</tr>
		</table>
        <br>

		<table align="center" width="94%" class="test1" style="border: 0px solid black;" height="Auto">

			<tr style="border: 1px solid black;">
				<td colspan="2" style="border: 1px solid black;font-weight:bold;width:50%;padding:7px 3px;">
					<center>DCPT Hammer</center>
				</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;width:50%;">
					<center>DCPT Standard Cone Size</center>
				</td>



			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;font-weight:bold;width:25%;padding:7px 7px;">Wt. of Hammer (kg)</td>
				<td style="border: 1px solid black;font-weight:bold;width:25%;">
					<center>8.0 &plusmn; 0.01</center>
				</td>
				<td style="border: 1px solid black;font-weight:bold;width:25%;padding:7px 3px;">Tip Angle Measurement (&#176;)</td>
				<td style="border: 1px solid black;font-weight:bold;width:25%;">
					<center>60 &plusmn; 1</center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;font-weight:bold;width:25%;padding:7px 7px;">Fall of Hammer (mm)</td>
				<td style="border: 1px solid black;font-weight:bold;width:25%;">
					<center>575 &plusmn; 1.0</center>
				</td>
				<td style="border: 1px solid black;font-weight:bold;width:25%;padding:7px 3px;">Tip Base Dia. (mm)</td>
				<td style="border: 1px solid black;font-weight:bold;width:25%;">
					<center>20 &plusmn; 0.25</center>
				</td>

			</tr>

		</table>

		<table align="center" width="94%" class="test1" style="border: 0px solid black;" height="Auto">
			<tr style="text-align:left">
				<td colspan="8" style="border: 1px solid black;padding:7px 7px;"><b>Chainage No. -</b> <?php echo $chainage_no; ?></td>

			</tr>
			<tr style="text-align:center">
				<td colspan="8" style="border: 1px solid black;font-weight:bold;padding:7px 7px;">Test - 1</td>


			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;padding:7px 7px;font-weight:bold;">DCP<br>Blows</td>
				<td style="border: 1px solid black;font-weight:bold;">Scale Reading<Br>(mm)</td>
				<td style="border: 1px solid black;font-weight:bold;">DCP<br>Blows</td>
				<td style="border: 1px solid black;font-weight:bold;">Scale Reading<Br>(mm)</td>
				<td style="border: 1px solid black;border-left: 1px solid black;font-weight:bold;">DCP<br>Blows</td>
				<td style="border: 1px solid black;font-weight:bold;">Scale Reading<Br>(mm)</td>
				<td style="border: 1px solid black;font-weight:bold;">DCP<br>Blows</td>
				<td style="border: 1px solid black;font-weight:bold;">Scale Reading<Br>(mm)</td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">0</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_0'] != "" && $row_select_pipe['hsr_0'] != "0" && $row_select_pipe['hsr_0'] != null) {
															echo $row_select_pipe['hsr_0'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">13</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_13'] != "" && $row_select_pipe['hsr_13'] != "0" && $row_select_pipe['hsr_13'] != null) {
															echo $row_select_pipe['hsr_13'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">26</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_26'] != "" && $row_select_pipe['hsr_26'] != "0" && $row_select_pipe['hsr_26'] != null) {
															echo $row_select_pipe['hsr_26'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">39</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_39'] != "" && $row_select_pipe['hsr_39'] != "0" && $row_select_pipe['hsr_39'] != null) {
															echo $row_select_pipe['hsr_39'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_1'] != "" && $row_select_pipe['hsr_1'] != "0" && $row_select_pipe['hsr_1'] != null) {
															echo $row_select_pipe['hsr_1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">14</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_14'] != "" && $row_select_pipe['hsr_14'] != "0" && $row_select_pipe['hsr_14'] != null) {
															echo $row_select_pipe['hsr_14'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">27</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_27'] != "" && $row_select_pipe['hsr_27'] != "0" && $row_select_pipe['hsr_27'] != null) {
															echo $row_select_pipe['hsr_27'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">40</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_40'] != "" && $row_select_pipe['hsr_40'] != "0" && $row_select_pipe['hsr_40'] != null) {
															echo $row_select_pipe['hsr_40'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_2'] != "" && $row_select_pipe['hsr_2'] != "0" && $row_select_pipe['hsr_2'] != null) {
															echo $row_select_pipe['hsr_2'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">15</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_15'] != "" && $row_select_pipe['hsr_15'] != "0" && $row_select_pipe['hsr_15'] != null) {
															echo $row_select_pipe['hsr_15'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">28</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_28'] != "" && $row_select_pipe['hsr_28'] != "0" && $row_select_pipe['hsr_28'] != null) {
															echo $row_select_pipe['hsr_28'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">41</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_41'] != "" && $row_select_pipe['hsr_41'] != "0" && $row_select_pipe['hsr_41'] != null) {
															echo $row_select_pipe['hsr_41'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_3'] != "" && $row_select_pipe['hsr_3'] != "0" && $row_select_pipe['hsr_3'] != null) {
															echo $row_select_pipe['hsr_3'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">16</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_16'] != "" && $row_select_pipe['hsr_16'] != "0" && $row_select_pipe['hsr_16'] != null) {
															echo $row_select_pipe['hsr_16'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">29</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_29'] != "" && $row_select_pipe['hsr_29'] != "0" && $row_select_pipe['hsr_29'] != null) {
															echo $row_select_pipe['hsr_29'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">42</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_42'] != "" && $row_select_pipe['hsr_42'] != "0" && $row_select_pipe['hsr_42'] != null) {
															echo $row_select_pipe['hsr_42'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_4'] != "" && $row_select_pipe['hsr_4'] != "0" && $row_select_pipe['hsr_4'] != null) {
															echo $row_select_pipe['hsr_4'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">17</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_17'] != "" && $row_select_pipe['hsr_17'] != "0" && $row_select_pipe['hsr_17'] != null) {
															echo $row_select_pipe['hsr_17'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">30</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_30'] != "" && $row_select_pipe['hsr_30'] != "0" && $row_select_pipe['hsr_30'] != null) {
															echo $row_select_pipe['hsr_30'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">43</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_43'] != "" && $row_select_pipe['hsr_43'] != "0" && $row_select_pipe['hsr_43'] != null) {
															echo $row_select_pipe['hsr_43'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_5'] != "" && $row_select_pipe['hsr_5'] != "0" && $row_select_pipe['hsr_5'] != null) {
															echo $row_select_pipe['hsr_5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">18</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_18'] != "" && $row_select_pipe['hsr_18'] != "0" && $row_select_pipe['hsr_18'] != null) {
															echo $row_select_pipe['hsr_18'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">31</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_31'] != "" && $row_select_pipe['hsr_31'] != "0" && $row_select_pipe['hsr_31'] != null) {
															echo $row_select_pipe['hsr_31'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">44</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_44'] != "" && $row_select_pipe['hsr_44'] != "0" && $row_select_pipe['hsr_44'] != null) {
															echo $row_select_pipe['hsr_44'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_6'] != "" && $row_select_pipe['hsr_6'] != "0" && $row_select_pipe['hsr_6'] != null) {
															echo $row_select_pipe['hsr_6'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">19</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_19'] != "" && $row_select_pipe['hsr_19'] != "0" && $row_select_pipe['hsr_19'] != null) {
															echo $row_select_pipe['hsr_19'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">32</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_32'] != "" && $row_select_pipe['hsr_32'] != "0" && $row_select_pipe['hsr_32'] != null) {
															echo $row_select_pipe['hsr_32'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">45</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_45'] != "" && $row_select_pipe['hsr_45'] != "0" && $row_select_pipe['hsr_45'] != null) {
															echo $row_select_pipe['hsr_45'];
														} else {
															echo " <br>";
														}  ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">7</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_7'] != "" && $row_select_pipe['hsr_7'] != "0" && $row_select_pipe['hsr_7'] != null) {
															echo $row_select_pipe['hsr_7'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">20</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_20'] != "" && $row_select_pipe['hsr_20'] != "0" && $row_select_pipe['hsr_20'] != null) {
															echo $row_select_pipe['hsr_20'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">33</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_33'] != "" && $row_select_pipe['hsr_33'] != "0" && $row_select_pipe['hsr_33'] != null) {
															echo $row_select_pipe['hsr_33'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">46</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_46'] != "" && $row_select_pipe['hsr_46'] != "0" && $row_select_pipe['hsr_46'] != null) {
															echo $row_select_pipe['hsr_46'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>

			<tr style="text-align:center">
				<td style="border: 1px solid black;">8</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_8'] != "" && $row_select_pipe['hsr_8'] != "0" && $row_select_pipe['hsr_8'] != null) {
															echo $row_select_pipe['hsr_8'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">21</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_21'] != "" && $row_select_pipe['hsr_21'] != "0" && $row_select_pipe['hsr_21'] != null) {
															echo $row_select_pipe['hsr_21'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">34</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_34'] != "" && $row_select_pipe['hsr_34'] != "0" && $row_select_pipe['hsr_34'] != null) {
															echo $row_select_pipe['hsr_34'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">47</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_47'] != "" && $row_select_pipe['hsr_47'] != "0" && $row_select_pipe['hsr_47'] != null) {
															echo $row_select_pipe['hsr_47'];
														} else {
															echo " <br>";
														}  ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">9</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_9'] != "" && $row_select_pipe['hsr_9'] != "0" && $row_select_pipe['hsr_9'] != null) {
															echo $row_select_pipe['hsr_9'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">22</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_22'] != "" && $row_select_pipe['hsr_22'] != "0" && $row_select_pipe['hsr_22'] != null) {
															echo $row_select_pipe['hsr_22'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">35</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_35'] != "" && $row_select_pipe['hsr_35'] != "0" && $row_select_pipe['hsr_35'] != null) {
															echo $row_select_pipe['hsr_35'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">48</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_48'] != "" && $row_select_pipe['hsr_48'] != "0" && $row_select_pipe['hsr_48'] != null) {
															echo $row_select_pipe['hsr_48'];
														} else {
															echo " <br>";
														}  ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">10</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_10'] != "" && $row_select_pipe['hsr_10'] != "0" && $row_select_pipe['hsr_10'] != null) {
															echo $row_select_pipe['hsr_10'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">23</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_23'] != "" && $row_select_pipe['hsr_23'] != "0" && $row_select_pipe['hsr_23'] != null) {
															echo $row_select_pipe['hsr_23'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">36</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_36'] != "" && $row_select_pipe['hsr_36'] != "0" && $row_select_pipe['hsr_36'] != null) {
															echo $row_select_pipe['hsr_36'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">49</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_49'] != "" && $row_select_pipe['hsr_49'] != "0" && $row_select_pipe['hsr_49'] != null) {
															echo $row_select_pipe['hsr_49'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">11</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_11'] != "" && $row_select_pipe['hsr_11'] != "0" && $row_select_pipe['hsr_11'] != null) {
															echo $row_select_pipe['hsr_11'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">24</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_24'] != "" && $row_select_pipe['hsr_24'] != "0" && $row_select_pipe['hsr_24'] != null) {
															echo $row_select_pipe['hsr_24'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">37</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_37'] != "" && $row_select_pipe['hsr_37'] != "0" && $row_select_pipe['hsr_37'] != null) {
															echo $row_select_pipe['hsr_37'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;">50</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_50'] != "" && $row_select_pipe['hsr_50'] != "0" && $row_select_pipe['hsr_50'] != null) {
															echo $row_select_pipe['hsr_50'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">12</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_12'] != "" && $row_select_pipe['hsr_12'] != "0" && $row_select_pipe['hsr_12'] != null) {
															echo $row_select_pipe['hsr_12'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">25</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_25'] != "" && $row_select_pipe['hsr_25'] != "0" && $row_select_pipe['hsr_25'] != null) {
															echo $row_select_pipe['hsr_25'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;border-left: 1px solid black;">38</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_38'] != "" && $row_select_pipe['hsr_38'] != "0" && $row_select_pipe['hsr_38'] != null) {
															echo $row_select_pipe['hsr_38'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">51</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['hsr_51'] != "" && $row_select_pipe['hsr_51'] != "0" && $row_select_pipe['hsr_51'] != null) {
															echo $row_select_pipe['hsr_51'];
														} else {
															echo " <br>";
														}  ?></td>

			</tr>
			<tr><td class="test1" style="width:94%;text-align:center;border:1px solid black;padding:7px 7px;" colspan=8>Field CBR = 10^(2.465-1.12*(Log<sub>10</sub>(Pentration/Blow))) (%) = <?php echo $row_select_pipe['cbr']; ?></td></tr>										
			<br>
		</table>
		<br>


		<table align="center" width="94%" class="test1" style="margin-bottom:0px;" Height="14%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 1</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>



	</page>

</body>

</html>


<script type="text/javascript">


</script>