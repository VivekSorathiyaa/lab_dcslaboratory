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
	$select_tiles_query = "select * from cocrete_core WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$agreement_no = $row_select['agreement_no'];
	$cons = $row_select['condition_of_sample_receved'];
	//// $job_no= $row_select['job_no'];			
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
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
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
					<center><b>FMT-OBS-055</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE STRENGTH OF CONCRETE CORE</b></center>
				</td>
			</tr>
		</table>
		<br><br>

		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;">&nbsp; <?php echo $lab_no."_01"?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Grade Of Concrete</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['bitumin_grade']; ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Casting</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>


		<?php  $cnt=1; ?>
        <table align="center" width="94%" class="test1">
			<tr style="border: 0;">
				<td colspan="3" style="width:25%;text-align:left;font-size: 13px; font-weight: bold;padding-bottom: 5px;"><b>IS 516 (P-4): 2018</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Sr. No.</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Core ID</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Weight (kg)</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Dia (mm)</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Length (mm) </b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Load (KN)</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Comp. Strength  (N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Corrected Cylinder Strength (N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Equivalent Cube Strength (N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;"><b>&nbsp; Density (Kg/m<sup>3</sup>)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-top:1px solid;text-align:center;">&nbsp;&nbsp;&nbsp;<?php echo $cnt++; ?></td>
				
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['mar_1'] != "" && $row_select_pipe['mar_1'] != null && $row_select_pipe['mar_1'] != "0") {
																														echo $row_select_pipe['mar_1'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp;</td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['dia_1'] != "" && $row_select_pipe['dia_1'] != null && $row_select_pipe['dia_1'] != "0") {
																														echo $row_select_pipe['dia_1'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['len_1'] != "" && $row_select_pipe['len_1'] != null && $row_select_pipe['len_1'] != "0") {
																														echo $row_select_pipe['len_1'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != null && $row_select_pipe['load_1'] != "0") {
																														echo $row_select_pipe['load_1'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['ccc_1'] != "" && $row_select_pipe['ccc_1'] != null && $row_select_pipe['ccc_1'] != "0") {
																														echo $row_select_pipe['ccc_1'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['ecs_2'] != "" && $row_select_pipe['ecs_2'] != null && $row_select_pipe['ecs_2'] != "0") {
																														echo $row_select_pipe['ecs_2'];
																													} else {
																														echo "-";
																													} ?></td>																									
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp;</td>
			</tr>

			
			<tr style="border: 1px solid black;">
				<td style="border-top:1px solid;text-align:center;font-weight:bold; ">&nbsp;&nbsp;&nbsp;<?php echo $cnt++; ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['mar_1'] != "" && $row_select_pipe['mar_2'] != null && $row_select_pipe['weight2'] != "0") {
																														echo $row_select_pipe['mar_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp;</td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['dia_2'] != "" && $row_select_pipe['dia_2'] != null && $row_select_pipe['dia_2'] != "0") {
																														echo $row_select_pipe['dia_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['len_2'] != "" && $row_select_pipe['len_2'] != null && $row_select_pipe['len_2'] != "0") {
																														echo $row_select_pipe['len_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != null && $row_select_pipe['load_2'] != "0") {
																														echo $row_select_pipe['load_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != null && $row_select_pipe['com_2'] != "0") {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['ccc_2'] != "" && $row_select_pipe['ccc_2'] != null && $row_select_pipe['ccc_2'] != "0") {
																														echo $row_select_pipe['ccc_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['ecs_2'] != "" && $row_select_pipe['ecs_2'] != null && $row_select_pipe['ecs_2'] != "0") {
																														echo $row_select_pipe['ecs_2'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp;</td>
			</tr>


			<tr style="border: 1px solid black;">
				<td style="border-top:1px solid;text-align:center;font-weight:bold; ">&nbsp;&nbsp;&nbsp;<?php echo $cnt++; ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['mar_3'] != "" && $row_select_pipe['mar_3'] != null && $row_select_pipe['mar_3'] != "0") {
																														echo $row_select_pipe['mar_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp;</td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['dia_3'] != "" && $row_select_pipe['dia_3'] != null && $row_select_pipe['dia_3'] != "0") {
																														echo $row_select_pipe['dia_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['len_3'] != "" && $row_select_pipe['len_3'] != null && $row_select_pipe['len_3'] != "0") {
																														echo $row_select_pipe['len_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != null && $row_select_pipe['load_3'] != "0") {
																														echo $row_select_pipe['load_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != null && $row_select_pipe['com_3'] != "0") {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['ccc_3'] != "" && $row_select_pipe['ccc_3'] != null && $row_select_pipe['ccc_3'] != "0") {
																														echo $row_select_pipe['ccc_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp; <?php if ($row_select_pipe['ecs_3'] != "" && $row_select_pipe['ecs_3'] != null && $row_select_pipe['ecs_3'] != "0") {
																														echo $row_select_pipe['ecs_3'];
																													} else {
																														echo "-";
																													} ?></td>
				<td style="border-left:1px solid;text-align:center;padding: 4px;">&nbsp;</td>
			</tr>
			<tr>
				<td style="border-left:1px solid;border-bottom:1px solid;text-align:left;padding: 4px;text-align: right" colspan="10"><b>&nbsp; Average  &nbsp;&nbsp;</b></td>
				<td colspan="2" style="border:1px solid;text-align:left;padding: 4px;">&nbsp; </td>
				
				
			</tr>
		</table>
		<br><br>

		<table align="center" width="94%" class="test1">

			<tr>
				<td style="font-size: 16px;padding-bottom: 8px;">&nbsp; Rate of Loading approximately 14 N/mm<sup>2</sup>/min (or 5.25 KN/S)</td>
			</tr>
			<tr>
				<td style="font-size: 16px;padding-bottom: 8px;">&nbsp; Correction Factor for L/D Ratio = (0.11 x L/D) + 0.78</td>
			</tr>
			<tr>
				<td style="font-size: 16px;padding-bottom: 8px;">&nbsp; Corrected Cylindrical Comp. Strength for L/D ratio = Correction Factor x Comp. Strength</td>
			</tr>
			<tr>
				<td style="font-size: 16px;padding-bottom: 8px;">&nbsp; Equivalent Cube Strength = 5/4 x Corrected Cylindrical Strength </td>
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
		<br><br><br><br>

		<table align="center" width="94%" class="test" height="Auto" style="border-top:1px solid #ccc;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 00</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 01</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>

		<table align="center" width="79%" style="" Height="2%">
				<tr style="font-size:12px;" >
					<td style="text-align:left;">Page 1 of 1</td>
				</tr>		
		</table>



		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<!-- <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;"> -->
			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/E/OS/001</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 1</td>
							<td style="width:25%; font-weight:bold;">RD :- 19/01/2016</td>
							<td style="width:25%;font-weight:bold;">Page : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; /</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">
							<td style="width:22%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo_1.jpeg" style="height:50px;width:100px;background-blend-mode:multiply;"><br><span style="text-align:center">AN ISO 9001:2008<br> Certified Company</span></td>
							<td style="width:50%;padding-bottom:3px;padding-top:3px; text-align:center;font-weight:bold;font-size:16px; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:50%;padding-bottom:3px;padding-top:3px; text-align:center; ">320, Joshi Estate, Nr Hotel Bhagyoday, Opp. Ankur Oilmill,</td>
						</tr>
						<tr style="">
							<td style="width:50%;padding-bottom:3px;padding-top:3px; text-align:center; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:50%;padding-bottom:3px;padding-top:3px; text-align:center; ">Ahmedabad. Ph.No.: 01727-250770</td>
						</tr>
						<tr style="">
							<td style="width:50%;padding-bottom:3px;padding-top:3px; text-align:center; "><u>Email: gomaconsultancy@gmail.com</u></td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style=""><u>COMPRESSIVE STRENGTH OF CONCRETE CORE as per IS 516-1959 Reaffimed 2004)</u></td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php /* $cnt=1;*/ ?>
			<tr>
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;">

						<tr style="">
							<td style="border-top:1px solid;width:10%;text-align:left;padding-bottom:5px;padding-top:5px; ">&nbsp;&nbsp; Date:</td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							<td style="border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; ">Job No.:</td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left; ">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-bottom:1px solid;border-top:1px solid;border-top:1px solid;width:10%;text-align:left;padding-bottom:5px;padding-top:5px; ">&nbsp;&nbsp; Lab No.:</td>
							<td style="border-bottom:1px solid;border-top:1px solid;border-top:1px solid;border-left:1px solid;width:35%;text-align:left; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
							<td style="border-left:1px solid;border-left:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-bottom:1px solid;border-top:1px solid;border-top:1px solid;border-left:1px solid;width:15%;text-align:center; ">Sample Con.</td>
							<td style="border-bottom:1px solid;border-top:1px solid;border-top:1px solid;border-left:1px solid;width:15%;text-align:left; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>
					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:1px;padding-top:20px; text-align:left;font-weight:bold;padding-left:50px; "><span style=""><u>Observation:</u></td>
						</tr>

					</table>

				</td>
			</tr> -->



			<!-- <?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:15px;">

						<tr style="">

							<td style="width:10%;font-weight:bold;padding-bottom:10px;text-align:center; ">Sr No.</td>
							<td style="border-left:1px solid;width:23%;font-weight:bold;text-align:center; ">Description</td>
							<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center; ">Unit</td>
							<td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center;padding-bottom:10px;padding-top:10px;  ">Sample 1</td>
							<td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center;  ">Sample 2</td>
							<td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center;  ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">I.D.Marks</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['mar_1'] != "" && $row_select_pipe['mar_1'] != null && $row_select_pipe['mar_1'] != "0") {
																														echo $row_select_pipe['mar_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['mar_2'] != "" && $row_select_pipe['mar_2'] != null && $row_select_pipe['mar_2'] != "0") {
																														echo $row_select_pipe['mar_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['mar_3'] != "" && $row_select_pipe['mar_3'] != null && $row_select_pipe['mar_3'] != "0") {
																														echo $row_select_pipe['mar_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">Lenth</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['len_1'] != "" && $row_select_pipe['len_1'] != null && $row_select_pipe['len_1'] != "0") {
																														echo $row_select_pipe['len_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['len_2'] != "" && $row_select_pipe['len_2'] != null && $row_select_pipe['len_2'] != "0") {
																														echo $row_select_pipe['len_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['len_3'] != "" && $row_select_pipe['len_3'] != null && $row_select_pipe['len_3'] != "0") {
																														echo $row_select_pipe['len_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">Diameter</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['dia_1'] != "" && $row_select_pipe['dia_1'] != null && $row_select_pipe['dia_1'] != "0") {
																														echo $row_select_pipe['dia_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['dia_2'] != "" && $row_select_pipe['dia_2'] != null && $row_select_pipe['dia_2'] != "0") {
																														echo $row_select_pipe['dia_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['dia_3'] != "" && $row_select_pipe['dia_3'] != null && $row_select_pipe['dia_3'] != "0") {
																														echo $row_select_pipe['dia_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">L/D Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['dia_1'] != "" && $row_select_pipe['dia_1'] != null && $row_select_pipe['dia_1'] != "0") {
																														echo ($row_select_pipe['len_1'] / $row_select_pipe['dia_1']);
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['dia_2'] != "" && $row_select_pipe['dia_2'] != null && $row_select_pipe['dia_2'] != "0") {
																														echo ($row_select_pipe['len_2'] / $row_select_pipe['dia_2']);
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['dia_3'] != "" && $row_select_pipe['dia_3'] != null && $row_select_pipe['dia_3'] != "0") {
																														echo ($row_select_pipe['len_3'] / $row_select_pipe['dia_3']);
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">Correction factor for L/D<br>Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != null && $row_select_pipe['corr_1'] != "0") {
																														echo $row_select_pipe['corr_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != null && $row_select_pipe['corr_2'] != "0") {
																														echo $row_select_pipe['corr_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != null && $row_select_pipe['corr_3'] != "0") {
																														echo $row_select_pipe['corr_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">Load</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">kN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != null && $row_select_pipe['load_1'] != "0") {
																														echo $row_select_pipe['load_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != null && $row_select_pipe['load_2'] != "0") {
																														echo $row_select_pipe['load_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != null && $row_select_pipe['load_3'] != "0") {
																														echo $row_select_pipe['load_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:10px;padding-top:10px; ">Cylindrical Comp.Strength</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != null && $row_select_pipe['com_1'] != "0") {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != null && $row_select_pipe['com_2'] != "0") {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != null && $row_select_pipe['com_3'] != "0") {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:3px;padding-top:3px; ">Correction Cylindrical<br>Comp. Strength for L/D<br>Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['ccc_1'] != "" && $row_select_pipe['ccc_1'] != null && $row_select_pipe['ccc_1'] != "0") {
																														echo $row_select_pipe['ccc_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['ccc_2'] != "" && $row_select_pipe['ccc_2'] != null && $row_select_pipe['ccc_2'] != "0") {
																														echo $row_select_pipe['ccc_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['ccc_3'] != "" && $row_select_pipe['ccc_3'] != null && $row_select_pipe['ccc_3'] != "0") {
																														echo $row_select_pipe['ccc_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:23%;text-align:center;padding-bottom:3px;padding-top:3px; ">Equivalent Cube<br>Strenghth</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['ecs_1'] != "" && $row_select_pipe['ecs_1'] != null && $row_select_pipe['ecs_1'] != "0") {
																														echo $row_select_pipe['ecs_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['ecs_2'] != "" && $row_select_pipe['ecs_2'] != null && $row_select_pipe['ecs_2'] != "0") {
																														echo $row_select_pipe['ecs_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['ecs_3'] != "" && $row_select_pipe['ecs_3'] != null && $row_select_pipe['ecs_3'] != "0") {
																														echo $row_select_pipe['ecs_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:1px;padding-top:10px;padding-bottom:100px; text-align:left;font-weight:bold;padding-left:50px; "><span style=""><u>Calculation:</u></td>
						</tr>

					</table><br><br><br><br><br><br>
				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
							<td style="width:20%;text-align:left;font-weight:bold; ">Checked By:-</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page: 1/2</td>
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