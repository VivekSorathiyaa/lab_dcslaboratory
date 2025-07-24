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
				$select_tiles_query = "select * from granite_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

				$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
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
						$detail_sample = $row_select3['mt_name'];
					}
				}

				$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$depths = $row_select4['bs_depth'];
					$location = $row_select4['bs_location'];
					$bhno = $row_select4['bs_bhno'];
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
							<center><b>FMT-OBS-00</b></center>
						</td>
						<td style="font-size:12px;border: 1px solid black;">
							<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON GRANITE STONE</b></center>
						</td>
					</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" height="15%">
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
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>
			</tr>
		</table>
		<br>																													
				<?php
					/*if($row_select_pipe['chk_wtr']== 1)
				{*/
					?>
				<table align="center" width="94%" class="test" border="1px" style="font-size:13px;">
					<tr>
						<td colspan="12" style="padding:7px 3px;"><b>&nbsp; Determination of water Absorption of Natural Builing stone (As per IS :1127 - 1974,[RA - 2013])</b></td>
					</tr>
					<tr >
						<td colspan="6" rowspan="2">
							<center><b>Observation</b></center>
						</td>
						<td colspan="6">
							<center style="padding:7px 3px;"><b>SAMPLE</b></center>
						</td>
					</tr>
						<tr>

							<td colspan="2">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>

						</tr>
						<tr >
							<td colspan="6" width="70%"	>
								<center style="padding:5px 3px;">Weight of the saturated surface dry test piece in W1 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Weight of oven dry test piece in W2 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Water Absorption (%) (W1 - W2 / W2) X 100</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['wtr1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['wtr2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['wtr3']; ?></center>
							</td>

						</tr>

						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Average Water Absorption (%)</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_wtr']; ?></center>
							</td>

						</tr>
				</table>
				<br>
					
					<? php/* }
			   if ($row_select_pipe['chk_t_sp'] == 1)
				{*/
					?>
					<!--Specific Gravity Water Abrasion-->
			    <table align="center" width="94%" class="test" border="1px" style="font-size:13px;">
						<tr>
							<td colspan="12" style="padding:7px 3px;"><b>&nbsp;&nbsp; Determination of True Specific Gravity of Natural Builing stone (As per IS :1122 - 1974,[RA - 2017])</b></td>
						</tr>
						<tr >
							<td colspan="6" rowspan="2">
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center style="padding:7px 3px;"><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>

						</tr>
						<tr	>
							<td colspan="6" width="70%"	>
								<center style="padding:5px 3px;">Weight of the empty specific gravity bottle with stopper W1 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w1_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w1_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w1_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Weight of specific gravity bottle with stopper and stone powder W2 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w2_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w2_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w2_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Weight of specific gravity bottle with stopper and stone powder and distilled water W3 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w3_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w3_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w3_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Weight of specific gravity bottle with stopper and Fully filled with distilled water W4 (gms)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w4_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w4_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['w4_3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">True Specific Gravity = W2 - W1 / [(W4 - W1)-(W3 - W2)]</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['spg_1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['spg_2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['spg_3']; ?></center>
							</td>

						</tr>

						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Average True Specific Gravity</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_spg']; ?></center>
							</td>

						</tr>
			    </table>
			    <br> <br> <br> <br> <br>
				
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
						<td style=""><center>Page 1 of 2</center></td>
						<td style=""><center></center></td>
						<td style=""><center></center></td>
						<td style=""><center></center></td>
						<td style=""><center></center></td>
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
							<center><b>FMT-OBS-00</b></center>
						</td>
						<td style="font-size:12px;border: 1px solid black;">
							<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON GRANITE STONE</b></center>
						</td>
					</tr>
				</table>
				<br>
					<? php/* }*/ ?>

					<?php
					/*  if ($row_select_pipe['chk_sp'] == 1)
				{*/
					?>

					<!--Specific Gravity Water Abrasion-->
				<table align="center" width="94%" class="test" border="1px" style="font-size:13px;">
						<tr>
							<td colspan="12" style="padding:7px 3px;"><b>&nbsp;&nbsp; Determination of Apparent Specific Gravity of Natural Builing stone (As per IS :1124 - 1974,[RA - 2013])</b></td>
						</tr>
						<tr>
							<td colspan="6" rowspan="2" width="70%"	>
								<center><b>Observation</b></center>
							</td>
							<td colspan="6">
								<center style="padding:7px 3px;"><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="2">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="2">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="6" width="70%"	>
								<center style="padding:5px 3px;">Weight of Oven-Dry Sample (g)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['a3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Weight of Saturated Surface Dry Sample (g) B</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['b3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Qunaity of Water Added in 1000 ML jar (g) C</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['c1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['c2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['c3']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Apparent Specific Gravity = A / (1000-C)</center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['asg1']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['asg2']; ?></center>
							</td>
							<td colspan="2">
								<center><?php echo $row_select_pipe['asg3']; ?></center>
							</td>
						</tr>

						<tr>
							<td colspan="6">
								<center style="padding:5px 3px;">Average Apparent Specific Gravity</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_asg']; ?></center>
							</td>
						</tr>
				</table>
				<br>

				<?php /*}*/ ?>
				<?php
					/*  if ($row_select_pipe['chk_com'] == 1)
				{*/
					?>

				<!--Specific Gravity Water Abrasion-->
				<table align="center" width="94%" class="test" border="1px" style="font-size:13px;">
						<tr>
							<td colspan="12" style="padding:7px 3px;"><b>&nbsp;&nbsp; Determination of Compressive Strength of Natural Builing stone (As per IS :1121 (P-1) - 1974,[RA - 2017])</b></td>
						</tr>
						<tr>
							<td colspan="6" style="padding:7px 3px;"><b>&nbsp;&nbsp; Dia. Of Specimen (b) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['dia']; ?></td>
							<td colspan="6" style="padding:7px 3px;"><b>&nbsp;&nbsp; Height of Specimen (h) :</b> &nbsp;&nbsp;<?php echo $row_select_pipe['height']; ?></td>
						</tr>
						<tr>
							<td colspan="7" rowspan="2" width="70%"	>
								<center><b>Observation</b></center>
							</td>
							<td colspan="5">
								<center style="padding:7px 3px;"><b>SAMPLE</b></center>
							</td>

						</tr>
						<tr>

							<td colspan="1">
								<center style="padding:7px 3px;"><b>I</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>II</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>III</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>IV</b></center>
							</td>
							<td colspan="1">
								<center style="padding:7px 3px;"><b>V</b></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center style="padding:7px 3px;">Maximum load applied to the test piece before filure A (kg)</center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load1']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load2']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load3']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load4']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['load5']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center style="padding:7px 3px;">Area of bearing face of the test piece B (cm<sup>2</sup>)</center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area1']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area2']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area3']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area4']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['area5']; ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center style="padding:7px 3px;">(i) When ratio of height to diameter is greater then compressive strength (C<sub>p</sub>) = A/B (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load1'] / $row_select_pipe['area1']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load2'] / $row_select_pipe['area2']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load3'] / $row_select_pipe['area3']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load4'] / $row_select_pipe['area4']), 0, 5); ?></center>
							</td>
							<td colspan="1">
								<center><?php echo substr(($row_select_pipe['load5'] / $row_select_pipe['area5']), 0, 5); ?></center>
							</td>

						</tr>
						<tr>
							<td colspan="7">
								<center style="padding:7px 3px;">(ii) When ratio of height to diameter differs from unity by 25% or more compressive strength (C<sub>c</sub>) = (C<sub>p</sub>) / 0.778 + 0.222(b + h) (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio1']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio2']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio3']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio4']; ?></center>
							</td>
							<td colspan="1">
								<center><?php echo $row_select_pipe['ratio5']; ?></center>
							</td>

						</tr>

						<tr>
							<td colspan="6">
								<center style="padding:7px 3px;">Average Compressive Strength (kg/cm<sup>2</sup>)</center>
							</td>
							<td colspan="6">
								<center><?php echo $row_select_pipe['avg_com1']; ?></center>
							</td>

						</tr>
				</table>
				<br>

				<?php /*} */ ?>

				<table align="center" width="94%" class="test1" style="margin-bottom:0px;" Height="15%">
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
						<td style=""><center>Page 2 of 2</center></td>
						<td style=""><center></center></td>
						<td style=""><center></center></td>
						<td style=""><center></center></td>
						<td style=""><center></center></td>
					</tr>
				</table>	
		</page>
		<!-- <input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT"> -->

	</body>
</html>

			<script src="jquery-1.12.3.min.js"></script>
			<script type="text/javascript">
				$("#print_button").on("click", function() {
					$('#print_button').hide();
					window.print();
				});
			</script>