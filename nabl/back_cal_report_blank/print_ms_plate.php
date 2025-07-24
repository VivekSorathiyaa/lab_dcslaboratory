<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0px 30px;
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
		font-family : Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		font-size: 11px;
		font-family : Calibri;
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
	$select_tiles_query = "select * from ms_plate WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$branch_name = $row_select['branch_name'];
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
		$issue_date = $row_select2['issue_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
			
			include_once 'sample_id.php';
			
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$ms_grade = $row_select4['ms_grade'];
		$type_sample = $row_select4['ms_type'];
	}
	
	
	
	
	

	?>
	
	


	<br>
	<br>
	<br>
	<br>

	<page size="A4">
				<tr>
					<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">STEEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 2062:2011  </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
		<br>

		<!-- <table align="center" width="100%" class="test1" height="18%">
			<tbody>
				<tr style="border: 1px solid black;">
					<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:4px 0;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;width:25%;text-align:left;padding:4px 0;"><b>&nbsp; Sample ID No.</b></td>
					<td style="border-left:1px solid;width:70%;text-align:left;padding:4px 0;">&nbsp;<?php echo $job_no; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;padding:4px 0;"><b>&nbsp; Any Other Information </td>
					<td style="border-left:1px solid;text-align:left;padding:4px 0;">&nbsp;IS 2062:2011  Grade:<?php echo $row_select_pipe['ms_grade']; ?>&nbsp;</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;padding:4px 0;"><b>&nbsp; Sample Received Date:</b>&nbsp;</td>
					<td style="border-left:1px solid;text-align:left;padding:4px 0;">&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;padding:4px 0;"><b>&nbsp; Testing Start Date :</b></td>
					<td style="border-left:1px solid;text-align:left;padding:4px 0;">&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;padding:4px 0;"><b>&nbsp; Testing Complete Date:</b></td>
					<td style="border-left:1px solid;text-align:left;padding:4px 0;">&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;padding:4px 0;"><b>&nbsp; Sample Type:</b></td>
					<td style="border-left:1px solid;text-align:left;padding:4px 0;">&nbsp; <?php echo $type_sample; ?></td>
				</tr>
			</tbody>
		</table>
		<br> -->

		<table align="center" width="100%" class="test1" style="border: 1px solid black;">

			<tr>
				<td width="10%" style="border: 1px solid black; font-size:12px;"><b>
						<center>&#x2022;</center>
					</b></td>
				<td width="30%" style="border: 1px solid black; font-size:12px;"><b>Overall Dimention</b></td>
				<td width="30%" style="border: 1px solid black; font-size:12px;text-align:center;"><b>Test Results</b></td>
				<td width="30%" style="border: 1px solid black; font-size:12px;text-align:center;"><b>Test Results</b></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>1</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Length (mm)</b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																						echo $row_select_pipe['l1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['l12'] != "" && $row_select_pipe['l12'] != "0" && $row_select_pipe['l12'] != null) {
																						echo $row_select_pipe['l12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>2</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Width (mm)</b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['w1'] != "" && $row_select_pipe['w1'] != "0" && $row_select_pipe['w1'] != null) {
																						echo $row_select_pipe['w1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['w12'] != "" && $row_select_pipe['w12'] != "0" && $row_select_pipe['w12'] != null) {
																						echo $row_select_pipe['w12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>3</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Thickness (mm)</b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['t1'] != "" && $row_select_pipe['t1'] != "0" && $row_select_pipe['t1'] != null) {
																						echo $row_select_pipe['t1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['t12'] != "" && $row_select_pipe['t12'] != "0" && $row_select_pipe['t12'] != null) {
																						echo $row_select_pipe['t12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>4</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Outer Diameter</b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['out1'] != "" && $row_select_pipe['out1'] != "0" && $row_select_pipe['out1'] != null) {
																						echo $row_select_pipe['out1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['out12'] != "" && $row_select_pipe['out12'] != "0" && $row_select_pipe['out12'] != null) {
																						echo $row_select_pipe['out12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="10%" style="border: 1px solid black; font-size:12px;"><b>
						<center>&#x2022;</center>
					</b></td>
				<td width="30%" style="border: 1px solid black; font-size:12px;"><b>Test Sample Perameter</b></td>
				<td width="30%" style="border: 1px solid black; font-size:12px;text-align:center"><b>Test Results</b></td>
				<td width="30%" style="border: 1px solid black; font-size:12px;text-align:center"><b>Test Results</b></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>1</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Wight(kg) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['weight1'] != "" && $row_select_pipe['weight1'] != "0" && $row_select_pipe['weight1'] != null) {
																						echo $row_select_pipe['weight1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['weight12'] != "" && $row_select_pipe['weight12'] != "0" && $row_select_pipe['weight12'] != null) {
																						echo $row_select_pipe['weight12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>2</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Length(m) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['len1'] != "" && $row_select_pipe['len1'] != "0" && $row_select_pipe['len1'] != null) {
																						echo $row_select_pipe['len1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['len12'] != "" && $row_select_pipe['len12'] != "0" && $row_select_pipe['len12'] != null) {
																						echo $row_select_pipe['len12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>3</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Mass/Meter(Kg/m) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['mass1'] != "" && $row_select_pipe['mass1'] != "0" && $row_select_pipe['mass1'] != null) {
																						echo $row_select_pipe['mass1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['mass12'] != "" && $row_select_pipe['mass12'] != "0" && $row_select_pipe['mass12'] != null) {
																						echo $row_select_pipe['mass12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>4</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Dia(mm) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != "0" && $row_select_pipe['dia1'] != null) {
																						echo $row_select_pipe['dia1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['dia12'] != "" && $row_select_pipe['dia12'] != "0" && $row_select_pipe['dia12'] != null) {
																						echo $row_select_pipe['dia12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>5</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Width(mm) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['width1'] != "" && $row_select_pipe['width1'] != "0" && $row_select_pipe['width1'] != null) {
																						echo $row_select_pipe['width1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['width12'] != "" && $row_select_pipe['width12'] != "0" && $row_select_pipe['width12'] != null) {
																						echo $row_select_pipe['width12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>6</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Thickness(mm) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['thk1'] != "" && $row_select_pipe['thk1'] != "0" && $row_select_pipe['thk1'] != null) {
																						echo $row_select_pipe['thk1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['thk12'] != "" && $row_select_pipe['thk12'] != "0" && $row_select_pipe['thk12'] != null) {
																						echo $row_select_pipe['thk12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>7</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Area(mm<sup>2</sup>) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) {
																						echo $row_select_pipe['area1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['area12'] != "" && $row_select_pipe['area12'] != "0" && $row_select_pipe['area12'] != null) {
																						echo $row_select_pipe['area12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>8</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Yield Load(kN) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != "0" && $row_select_pipe['load1'] != null) {
																						echo $row_select_pipe['load1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['load12'] != "" && $row_select_pipe['load12'] != "0" && $row_select_pipe['load12'] != null) {
																						echo $row_select_pipe['load12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>9</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Yield stress(N/mm2) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['str1'] != "" && $row_select_pipe['str1'] != "0" && $row_select_pipe['str1'] != null) {
																						echo $row_select_pipe['str1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['str12'] != "" && $row_select_pipe['str12'] != "0" && $row_select_pipe['str12'] != null) {
																						echo $row_select_pipe['str12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>10</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Ultimate Load(kN) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['ult1'] != "" && $row_select_pipe['ult1'] != "0" && $row_select_pipe['ult1'] != null) {
																						echo $row_select_pipe['ult1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['ult12'] != "" && $row_select_pipe['ult12'] != "0" && $row_select_pipe['ult12'] != null) {
																						echo $row_select_pipe['ult12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>11</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Ultimate Tensil Strength(N/mm2) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['ten1'] != "" && $row_select_pipe['ten1'] != "0" && $row_select_pipe['ten1'] != null) {
																						echo $row_select_pipe['ten1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['ten12'] != "" && $row_select_pipe['ten12'] != "0" && $row_select_pipe['ten12'] != null) {
																						echo $row_select_pipe['ten12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>12</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Initial Gauge Length (mm) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['initial1'] != "" && $row_select_pipe['initial1'] != "0" && $row_select_pipe['initial1'] != null) {
																						echo $row_select_pipe['initial1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['initial12'] != "" && $row_select_pipe['initial12'] != "0" && $row_select_pipe['initial12'] != null) {
																						echo $row_select_pipe['initial12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>13</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Final Gauge Length(mm) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['final1'] != "" && $row_select_pipe['final1'] != "0" && $row_select_pipe['final1'] != null) {
																						echo $row_select_pipe['final1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['final12'] != "" && $row_select_pipe['final12'] != "0" && $row_select_pipe['final12'] != null) {
																						echo $row_select_pipe['final12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>14</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Elongation(%) </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['elo1'] != "" && $row_select_pipe['elo1'] != "0" && $row_select_pipe['elo1'] != null) {
																						echo $row_select_pipe['elo1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['elo12'] != "" && $row_select_pipe['elo12'] != "0" && $row_select_pipe['elo12'] != null) {
																						echo $row_select_pipe['elo12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>15</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Location Of Fracture </b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['location1'] != "" && $row_select_pipe['location1'] != "0" && $row_select_pipe['location1'] != null) {
																						echo $row_select_pipe['location1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['location12'] != "" && $row_select_pipe['location12'] != "0" && $row_select_pipe['location12'] != null) {
																						echo $row_select_pipe['location12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>16</center>
					</b></td>
				<td width="30%" style="border: 1px solid black;"><b>Bend Test</b></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['bend1'] != "" && $row_select_pipe['bend1'] != "0" && $row_select_pipe['bend1'] != null) {
																						echo $row_select_pipe['bend1'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td width="30%" style="border: 1px solid black;text-align:center"><?php if ($row_select_pipe['bend12'] != "" && $row_select_pipe['bend12'] != "0" && $row_select_pipe['bend12'] != null) {
																						echo $row_select_pipe['bend12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;padding : 3px;;"><b>
						<center>Remarks</center>
					</b></td>
				<td colspan="3" style="border: 1px solid black;"><b></b></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test1" style="">
			<tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
                        <!-- <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
                            <td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
                        </tr> -->
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
                            <td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
                            <td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                        </tr>
                        <tr>
                            <td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :-  <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
                        </tr>
                        <tr>
                            <td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
		</table>

	</page>

</body>

</html>


<script type="text/javascript">

</script>