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
	$select_tiles_query = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 5);

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
	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 5;
	for ($a = 1; $a <= $page_cont; $a++) {
	?>

		<br>


		<page size="A4">
			<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
			<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:3px solid;">

				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;">

							<tr style="">

								<td style="width:100%;padding-bottom:3px;padding-top:3px; text-align:center;font-size:22px;" colspan=4>FIELD DENSITY OF SOIL</td>
							</tr>
							<tr style="">
								<td style="width:100%;padding-bottom:20px;padding-top:3px; text-align:center;font-size:20px; " colspan=4>Sand Replacement Method</td>
							</tr>
							<tr style="">
								<td style="width:100%;padding-bottom:3px;padding-top:3px; text-align:center; " colspan=4></td>
							</tr>
							<tr style="">
								<td style="width:25%;padding-bottom:3px;padding-top:3px; text-align:left; ">&nbsp;&nbsp; Road /Section Details :</td>
								<td style="width:40%;padding-bottom:3px;padding-top:3px; text-align:left; "></td>
								<td style="width:20%;padding-bottom:3px;padding-top:3px; text-align:left; ">Date of Testing : </td>
								<td style="width:15%;padding-bottom:3px;padding-top:3px; text-align:left; "><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							</tr>
							<?php
							$select_tilesx = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select1x = mysqli_query($conn, $select_tilesx);
							$coming_rowx = mysqli_num_rows($result_tiles_select1x);

							while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1x)) {
								$flag++;
							?>
								<tr style="">
									<td style="width:25%;padding-bottom:3px;padding-top:3px; text-align:left; ">&nbsp;&nbsp; Location of Test Point : </td>
									<td style="width:35%;padding-bottom:3px;padding-top:3px; text-align:left; "><? php // echo $row_select_pipe['chainage_no'];
																												?><?php if ($material_location == 1) {
																																									echo "In Laboratory";
																																								} else {
																																									echo "In Field";
																																								} ?></td>
									<td style="width:25%;padding-bottom:3px;padding-top:3px; text-align:left; ">Thickness of Layer :</td>
									<td style="width:15%;padding-bottom:3px;padding-top:3px; text-align:left; "><?php echo $row_select_pipe['layer_mt']; ?></td>
								</tr>

						</table><br>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:18px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

							<tr style="">

								<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;"><span style="">&nbsp;&nbsp; CALIBRATION</td>
							</tr>

						</table><br>

					</td>
				</tr>

				<?php $cnt = 1; ?>
				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:40px;">

							<tr style="">

								<td style="width:10%;font-weight:bold;padding-bottom:5px;text-align:center; ">Sr No.</td>
								<td style="border-left:1px solid;width:60%;font-weight:bold;padding-bottom:7px;padding-top:7px;text-align:center; ">Observation And Calculation </td>
								<td style="border-left:1px solid;width:30%;font-weight:bold;text-align:center; ">Readings</td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;padding-bottom:7px;padding-top:7px; ">&nbsp;&nbsp; Volume of Calibrating Container ( V cm&sup3;)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php echo $row_select_pipe['c2']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;padding-bottom:7px;padding-top:7px; ">&nbsp;&nbsp; Weight of Cylinder + Sand (Before Pouring)(W1 gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php echo $row_select_pipe['c3']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;padding-bottom:7px;padding-top:7px; ">&nbsp;&nbsp; Mean Weight Cylinder + Sand (After Pouring)(W2 gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php echo $row_select_pipe['c4']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;padding-bottom:7px;padding-top:7px; ">&nbsp;&nbsp; Mean Weight of Sand of Cone (of pouring Cylinder)(W3 gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php echo $row_select_pipe['c1']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;padding-bottom:7px;padding-top:7px; ">&nbsp;&nbsp; Weight of Sand to fill Calibrated Container (W<sub>a</sub>=W1-W2-W3)(gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php echo $row_select_pipe['c5']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:60%;text-align:left;padding-bottom:7px;padding-top:7px; ">&nbsp;&nbsp; Bulk Density of Sand Y<sub>s</sub> = W<sub>a</sub>/V (g/cm&sup3;)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center; "><?php echo $row_select_pipe['c6']; ?></td>
							</tr>

						</table>

					</td>
				</tr>

				<tr>
					<td style="text-align:center;font-size:17px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

							<tr style="">

								<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:left;font-weight:bold;"><span style="">&nbsp;&nbsp; DETERMINATION OF SOIL DENSITY</td>
							</tr>

						</table><br>

					</td>
				</tr>

				<?php $cnt = 1; ?>
				<tr>
					<td style="text-align:center;font-size:14px; ">

						<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:10px;">

							<tr style="">

								<td style="width:10%;font-weight:bold;padding-bottom:5px;text-align:center; ">Sr No.</td>
								<td style="border-left:1px solid;width:55%;font-weight:bold;padding-bottom:7px;padding-top:7px;text-align:center; ">Observation And Calculation </td>
								<td style="border-left:1px solid;width:35%;font-weight:bold;text-align:center; ">Determination No.</td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Weight of Wet Soil From Hole (W<sub>w</sub> gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['d1']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Weight of Cylinder + Sand (Before Pouring)(W<sub>4</sub> gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['d2']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Mean Weight Cylinder + Sand (After Pouring)(W<sub>5</sub> gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['d3']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:2px;padding-top:2px; ">Weight of Sand in Hole<br>(W<sub>b</sub> =W<sub>4</sub> -W<sub>5</sub> -W<sub>3 </sub> gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['d4']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Volume of Hole (V<sub>h</sub> =W<sub>b</sub>/Y<sub>s</sub>)(cm&sup3;)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo substr($row_select_pipe['d4'] / $row_select_pipe['c6'], 0, 8); ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Bulk Density Y<sub>b</sub> = W<sub>w</sub> / V<sub>h</sub> ( g/cm&sup3;)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['d5']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Container Number</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['con_no']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Moisture Content(w%)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['mc_od']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Weight of Dry Soil From Hole ( W<sub>d</sub> gm)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo $row_select_pipe['wt_con_dry_soil']; ?></td>
							</tr>
							<tr style="">
								<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
								<td style="border-top:1px solid;border-left:1px solid;width:55%;text-align:center;padding-bottom:7px;padding-top:7px; ">Dry Density = (W<sub>d</sub>/W<sub>b</sub>) * Y<sub>s</sub> ( g/cm&sup3)</td>
								<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center; "><?php echo substr(($row_select_pipe['wt_con_dry_soil'] / $row_select_pipe['d4']) * $row_select_pipe['c6'], 0, 6); ?></td>
							</tr>
						<?php
								if ($flag == 5) {
									break;
								}
							}

						?>
						</table>

					</td>
				</tr>



				<tr>
					<td style="text-align:center;font-size:16px; ">

						<table align="center" width="80%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;">

							<tr style="">

								<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By</td>
								<td style="width:20%;text-align:left;font-weight:bold; ">Checked By</td>
							</tr>

						</table>

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







		<!--page size="A4" >
		
			
			
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:12px;border: 1px solid black;"><center><b>
					FIELD COMPACTION TEST BY SAND REPLACEMENT METHOD<br>(as per IS : 2720 (Part 28))</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>

			<br>
			<table align="center" width="90%" class="test1"  height="5%">
				
				<tr >
					<td style="text-align:center;width:5%;"><b>1</b></td>
					<td style="width:20%;"><b>Laboratory No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $job_no; ?></td>
					<td style="text-align:center;width:5%;"><b>4</b></td>
					<td style="width:20%;"><b>Date of start</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
					
				</tr>
				<tr >
					<td style="text-align:center;width:5%;"><b>2</b></td>
					<td style="width:20%;"><b>Job No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $lab_no; ?></td>
					<td style="text-align:center;width:5%;"><b>5</b></td>
					<td style="width:20%;"><b>Date of Completion</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
					
				</tr>
				
				
				
					
			
			</table>
			<Br>
			
			<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
				
				<tr style="border: 2px solid black;">
					<td rowspan="5" style="border: 2px solid black;font-weight:bold;width:61%;"><center>Uniformly Graded Natural Sand Passing through 1.00<br>mm and Retained on 600 Micron IS Sieve</center></td>
					
					
					
					
				</tr>
				<tr style="border: 2px solid black;">
					<td rowspan="2" style="border: 2px solid black;font-weight:bold;"></td>
					<td colspan="2" style="border: 2px solid black;font-weight:bold;"><center>Pouring Cylinder</center></td>
					
					
				</tr>
				<tr style="border: 2px solid black;">
					
					
					<td  style="border: 2px solid black;font-weight:bold;"><center>Small</center></td>
					<td  style="border: 2px solid black;font-weight:bold;"><center>Large</center></td>
					
				</tr>
				<tr style="border: 2px solid black;">
					
					
					<td  style="border: 2px solid black;font-weight:bold;width:13%"><center>Dia (mm)</center></td>
					<td  style="border: 2px solid black;font-weight:bold;width:13%"><center>100 &plusmn; 0.1</center></td>
					<td  style="border: 2px solid black;font-weight:bold;width:13%"><center>200 &plusmn; 0.1</center></td>
					
					
				</tr>
				<tr style="border: 2px solid black;">
					
					
					<td  style="border: 2px solid black;font-weight:bold;"><center>Depth (mm)</center></td>
					<td  style="border: 2px solid black;font-weight:bold;"><center>150 &plusmn; 0.1</center></td>
					<td  style="border: 2px solid black;font-weight:bold;"><center>250 &plusmn; 0.1</center></td>
					
					
				</tr>
				
				</table>
				<Br>
			
				<table align="center" width="90%"  class="test" style="height:auto;width:90%;border:1px solid black;" >
									<tr style="text-align:center;height:20px;">
										<td style="border:1px solid black;width:15%;"><b>Sr. No.</b></td>
										<td style="border:1px solid black;width:60%;"><b>Description</b></td>										
										<td colspan="<?php echo $up; ?>" style="border:1px solid black;border-right:0px solid black;"><b>Test Result</b></td>
										
									
									
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand in Cone (W2), gm</td>
										<?php
										$select_tilesx = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1x = mysqli_query($conn, $select_tilesx);
										$coming_rowx = mysqli_num_rows($result_tiles_select1x);

										while ($row_select_pipe2x = mysqli_fetch_array($result_tiles_select1x)) {
											$flag++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2x['c1']; ?></b></td>
									<?php
											if ($flag == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;text-align:left">Vol. of Calibrating Container (V),cc</td>
										<?php
										$select_tilesyy = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1y = mysqli_query($conn, $select_tilesyy);
										$coming_rowy = mysqli_num_rows($result_tiles_select1y);

										while ($row_select_pipe21y = mysqli_fetch_array($result_tiles_select1y)) {
											$flagy++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe21y['c2']; ?></b></td>
									<?php
											if ($flagy == 5) {
												break;
											}
										}

									?>
																			
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand + Cylinder before  Pouring (W1), gm</td>
										<?php
										$select_tilesyz = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1z = mysqli_query($conn, $select_tilesyz);
										$coming_rowz = mysqli_num_rows($result_tiles_select1z);

										while ($row_select_pipe22z = mysqli_fetch_array($result_tiles_select1z)) {
											$flagz++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe22z['c3']; ?></b></td>
									<?php
											if ($flagz == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>4</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand + Cylinder after  Pouring (W3), gm</td>
										<?php
										$select_tilesya = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1a = mysqli_query($conn, $select_tilesya);
										$coming_rowa = mysqli_num_rows($result_tiles_select1a);

										while ($row_select_pipe2a = mysqli_fetch_array($result_tiles_select1a)) {
											$flaga++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2a['c4']; ?></b></td>
									<?php
											if ($flaga == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>5</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand to Fill Calibrating Cylinder (Wa) = W1 - W3 - W2, gm</td>
										<?php
										$select_tilesyb = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1b = mysqli_query($conn, $select_tilesyb);
										$coming_rowb = mysqli_num_rows($result_tiles_select1b);

										while ($row_select_pipe2b = mysqli_fetch_array($result_tiles_select1b)) {
											$flagb++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2b['c5']; ?></b></td>
									<?php
											if ($flagb == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>6</b></td>
										<td style="border:1px solid black;text-align:left">Bulk Density of Sand Ds = Wa / V, gm/cc</td>
										<?php
										$select_tilesyc = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1c = mysqli_query($conn, $select_tilesyc);
										$coming_rowc = mysqli_num_rows($result_tiles_select1c);

										while ($row_select_pipe2c = mysqli_fetch_array($result_tiles_select1c)) {
											$flagc++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo number_format($row_select_pipe2c['c6'], 2); ?></b></td>
									<?php
											if ($flagc == 5) {
												break;
											}
										}

									?>
																			
									</tr>
									
								
									
								</table>
						
				<table align="center" width="90%"  class="test" style="height:auto;width:90%;border:1px solid black;" >
									<tr style="text-align:center;height:20px;">
										<td style="border:1px solid black;width:15%;"><b>Sr. No.</b></td>
										<td style="border:1px solid black;width:60%;"><b>Description</b></td>
										<td colspan="<?php echo $up; ?>" style="border:1px solid black;border-right:0px solid black;"><b>Test Result</b></td>
										
										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b></b></td>
										<td style="border:1px solid black;text-align:left">Chainage No.</td>
										<?php
										$select_tilesyd3 = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1d3 = mysqli_query($conn, $select_tilesyd3);
										$coming_rowd3 = mysqli_num_rows($result_tiles_select1d3);

										while ($row_select_pipe2d3 = mysqli_fetch_array($result_tiles_select1d3)) {
											$flagd3++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2d3['chainage_no']; ?></b></td>
									<?php
											if ($flagd3 == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b></b></td>
										<td style="border:1px solid black;text-align:left">Material Description</td>
										<?php
										$select_tilesyd38 = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1d38 = mysqli_query($conn, $select_tilesyd38);
										$coming_rowd38 = mysqli_num_rows($result_tiles_select1d38);

										while ($row_select_pipe2d38 = mysqli_fetch_array($result_tiles_select1d38)) {
											$flagd38++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2d38['layer_mt']; ?></b></td>
									<?php
											if ($flagd38 == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b></b></td>
										<td style="border:1px solid black;text-align:left">	Lab Density of Material (MDD), g/cc</td>
										<?php
										$select_tilesyd381 = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1d381 = mysqli_query($conn, $select_tilesyd381);
										$coming_rowd381 = mysqli_num_rows($result_tiles_select1d381);

										while ($row_select_pipe2d381 = mysqli_fetch_array($result_tiles_select1d381)) {
											$flagd381++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2d381['cal_mdd']; ?></b></td>
									<?php
											if ($flagd381 == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Wet Sample from Hole (Ww), gm</td>
										<?php
										$select_tilesyd = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1d = mysqli_query($conn, $select_tilesyd);
										$coming_rowd = mysqli_num_rows($result_tiles_select1d);

										while ($row_select_pipe2d = mysqli_fetch_array($result_tiles_select1d)) {
											$flagd++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2d['d1']; ?></b></td>
									<?php
											if ($flagd == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand + Cylinder before Pouring (W1), gm</td>
										<?php
										$select_tilesydi = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1di = mysqli_query($conn, $select_tilesydi);
										$coming_rowdi = mysqli_num_rows($result_tiles_select1di);

										while ($row_select_pipe2di = mysqli_fetch_array($result_tiles_select1di)) {
											$flagdi++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2di['d2']; ?></b></td>
									<?php
											if ($flagdi == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand + Cylinder after Pouring (W4), gm</td>
										<?php
										$select_tilesydq = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1dq = mysqli_query($conn, $select_tilesydq);
										$coming_rowdq = mysqli_num_rows($result_tiles_select1dq);

										while ($row_select_pipe2dq = mysqli_fetch_array($result_tiles_select1dq)) {
											$flagdq++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2dq['d3']; ?></b></td>
									<?php
											if ($flagdq == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>4</b></td>
										<td style="border:1px solid black;text-align:left">Wt. of Sand to Fill Hole Wb</td>
										<?php
										$select_tilesydw = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1dw = mysqli_query($conn, $select_tilesydw);
										$coming_rowdw = mysqli_num_rows($result_tiles_select1dw);

										while ($row_select_pipe2dw = mysqli_fetch_array($result_tiles_select1dw)) {
											$flagdw++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2dw['d4']; ?></b></td>
									<?php
											if ($flagdw == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>5</b></td>
										<td style="border:1px solid black;text-align:left">Bulk Density of Sample, D<sub>wet</sub></td>
										<?php
										$select_tilesyda = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1da = mysqli_query($conn, $select_tilesyda);
										$coming_rowda = mysqli_num_rows($result_tiles_select1da);

										while ($row_select_pipe2da = mysqli_fetch_array($result_tiles_select1da)) {
											$flagda++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo number_format($row_select_pipe2da['d5'], 2); ?></b></td>
									<?php
											if ($flagda == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>6</b></td>
										<td style="border:1px solid black;text-align:left">Moisture Content (W), %</td>
										<?php
										$select_tilesydb = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1db = mysqli_query($conn, $select_tilesydb);
										$coming_rowdb = mysqli_num_rows($result_tiles_select1db);

										while ($row_select_pipe2db = mysqli_fetch_array($result_tiles_select1db)) {
											$flagdb++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php
																											if ($row_select_pipe2db['d6'] != "") {

																												echo $row_select_pipe2db['d6'];
																											} else {
																												echo $row_select_pipe2db['mc_od'];
																											}
																											?></b></td>	
									<?php
											if ($flagdb == 5) {
												break;
											}
										}

									?>
																			
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>7</b></td>
										<td style="border:1px solid black;text-align:left">D<sub>dry</sub> = 100 X D<sub>wet</sub>/ (100 + w%). gm/cc</td>
										<?php
										$select_tilesydc = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1dc = mysqli_query($conn, $select_tilesydc);
										$coming_rowdc = mysqli_num_rows($result_tiles_select1dc);

										while ($row_select_pipe2dc = mysqli_fetch_array($result_tiles_select1dc)) {
											$flagdc++;
										?>
										
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo number_format($row_select_pipe2dc['d7'], 2); ?></b></td>
									<?php
											if ($flagdc == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<?php
									$select_tilesydd1 = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
									$result_tiles_select1dd1 = mysqli_query($conn, $select_tilesydd1);
									$row_select_pipe2dd1 = mysqli_fetch_array($result_tiles_select1dd1);
									if ($row_select_pipe2dd1['displays'] == "1") {
									?>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>8</b></td>
										<td style="border:1px solid black;text-align:left">Compaction %</td>
										<?php
										$select_tilesydd = "select * from soil_calibration WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
										$result_tiles_select1dd = mysqli_query($conn, $select_tilesydd);
										$coming_rowdd = mysqli_num_rows($result_tiles_select1dd);

										while ($row_select_pipe2dd = mysqli_fetch_array($result_tiles_select1dd)) {
											$flagdd++;
										?>
										<td style="border:1px solid black;border-right:0px solid black;"><b><?php echo $row_select_pipe2dd['d8']; ?></b></td>
									<?php
											if ($flagdd == 5) {
												break;
											}
										}

									?>
																				
									</tr>
									<?php
									}
									?>
									
								
									
								</table>
						
				<br>
			
				
					
			
			
			</page-->
		<?php

		if ($flag == 5) {
			$flag = 0;
			$down = $up;
			$up += 5;
		?>



			<div class="pagebreak"> </div>
	<?php }
	}
	?>
</body>

</html>


<script type="text/javascript">


</script>