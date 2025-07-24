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
	$select_tiles_query = "select * from flexure_beam WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$cc_grade = $row_select4['cc_grade'];
		$cc_set_of_cube = $row_select4['cc_set_of_cube'];
		$cc_no_of_cube = $row_select4['cc_no_of_cube'];
		$day_remark = $row_select4['day_remark'];
		$casting_date = $row_select4['casting_date'];
	}

	?>

	<br>



	<page size="A4">
		<table align="center" width="96%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-025</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE<br>FLEXURAL STRENGTH OF CONCRETE</b></center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="96%" class="test1" height="9%">

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
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Specimen Size</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $mt_name; ?> FLEXURAL STRENGTH</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="96%" class="test" style="font-size: 14px;">
			<tr>
				<td><b><span>&nbsp;&nbsp; IS 516 (Part – 1/Sec – 1): 2021 SECTION 4</span></b></td>
			</tr>
		</table>

		<br>
		<table align="center" width="96%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
			<tr>
				<td style="text-align:center;">
				<?php $cnt=1; ?>
					<table align="center" width="100%"  class="test1" cellspacing="0" cellpadding="0" style="font-family: Cambria;">

						<tr style="">
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > Sr No.</td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Beam ID </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Date of Casting </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Date of Testing </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Age of Specimen </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Weight (kg) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Length (mm) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Width (mm)  </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Height (mm) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Length of span (mm) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Density (Kg/m<sup>3</sup>) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Load at Failure(KN) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Distance between line of Fracture (a) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;border-right:1px solid;" > Flexural Strength N/mm<sup>2</sup> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;" > Type of Failure (A/B) </td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $cnt++; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > </td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" >  <?php echo date('d-m-Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['day1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['mass_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['l1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['b1']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['h1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) { echo ($row_select_pipe['mass_1']) / 1000; } else { echo " - "; } ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['load_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" ><?php echo $row_select_pipe['cross_1']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['comp_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;" > <?php echo $row_select_pipe['mark_1']; ?></td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $cnt++; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > </td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" >  <?php echo date('d-m-Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['day1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['mass_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['l2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['b2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['h2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_2']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
																																						echo ($row_select_pipe['mass_2']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['load_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['comp_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;" ><?php echo $row_select_pipe['mark_2']; ?> </td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $cnt++; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > </td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" >  <?php echo date('d-m-Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['day1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['mass_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['l3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['b3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['h3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_3']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
																																						echo ($row_select_pipe['mass_3']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['load_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['comp_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-bottom:1px solid;" ><?php echo $row_select_pipe['mark_3']; ?> </td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;text-align: right;padding: 5px;" colspan="13">&nbsp;&nbsp; Average &nbsp;&nbsp;</td>
							<td style=" text-align:center;font-weight:bold;padding: 2px 3px; border-right:1px solid;text-align: center;padding: 5px;" ><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
						</tr>
						

					</table>
				</td>
			</tr>
		</table>

		<br>
		<table align="center" width="96%" class="test" style="font-size: 14px;">
			<tr>
				<td><b><span>&nbsp;&nbsp; * Rate of Loading 4 KN/min</span></b></td>
			</tr>
		</table>
		<br>
		<table align="center" width="96%" style="" Height="5%">
			<tr style="font-size:14px;" >
				<td style="padding-bottom: 10px;"><b>Calculation: </b></td>
			</tr>
			<tr style="font-size:14px;" >
				<td>&nbsp;&nbsp;&nbsp;<b>1.</b> Type A Failure (When 'a' is greater than 200mm)</td>
			</tr>
			<tr style="font-size:14px;" >
				<td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fb = (P X L)/(B X D2)</td>
			</tr>
			<tr style="font-size:14px;" >
				<td>&nbsp;&nbsp;&nbsp;<b>2.</b> Type B Failure (When 'a' is Less than 200mm but greater than 170mm)</td>
			</tr>
			<tr style="font-size:14px;" >
				<td style="padding-bottom: 10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; Fb = (3P X a)/(B X D2)</td>
			</tr>
			<tr style="font-size:14px;" >
				<td style="padding-bottom: 10px;">&nbsp; Where,</td>
			</tr>
			<tr style="font-size:14px;">
				<td>&nbsp; Fb = Flexural strength in N/mm<sup>2</sup></td>
			</tr>
			<tr style="font-size:14px;">
				<td>&nbsp; P = Maximum load in KN</td>
			</tr>
			<tr style="font-size:14px;">
				<td>&nbsp; a = The distance between the line of fracture and the nearer support, measured on the center line of the tensile side  of the specimen in mm</td>
			</tr>
			<tr style="font-size:14px;">
				<td>&nbsp; D = Lateral dimension of the specimen</td>
			</tr>
			<tr style="font-size:14px;">
				<td>&nbsp; L = Length of span on which specimen support</td>
			</tr>
		</table>

		<br>

		<table align="center" width="96%" class="test1" style="margin-bottom: 20px;" Height="10%">
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
		<br>
		<table align="center" width="96%" class="test1" height="Auto" style="border-top:2px solid #ccc;">
			<tr style="padding-top:4px;">
				<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:4px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:4px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:4px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:4px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>
		<table align="center" width="96%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;padding-top:8px;"><b>Page 1 of 1</b></td>
			</tr>		
		</table>







		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 1px;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding: 2px 3px; ">&nbsp;&nbsp; DOC : GOMAEC/I/OS/003</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 1</td>
							<td style="width:25%; font-weight:bold;">RD :- 19/09/2016</td>
							<td style="border-right:1px solid;width:25%;font-weight:bold;">Page : &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;25/25</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:0px 1px 1px 1px;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding: 2px 3px;padding-left:50px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold;padding-left:50px; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:0px 1px 1px 1px;">

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
							<td style="width:50%;padding-bottom:3px;padding-top:3px; text-align:center; ">Email: <u>gomaconsultancy@gmail.com</u></td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding: 2px 3px; text-align:center;font-weight:bold; "><span style=""><u>OBSERVATION & CALCULATION SHEET FOR FLEXURE STRENGTH TEST ON C.C.BEAM<br>IS : 516 - 1959 (Reaff. 2013</u></td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php /* $cnt=1;*/ ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">
							<td style="width:30%;text-align:left;font-weight:bold; "> Details of C.C. Beam Sample :</td>
							<td style="width:10%;text-align:left; "> </td>
							<td style="width:25%;text-align:right;font-weight:bold; ">Dated :&nbsp;&nbsp; </td>
							<td style="border:1px solid;width:25%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							<td style="width:10%;text-align:left; ">&nbsp;&nbsp; </td>
						</tr>
					</table><br>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:15px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:15px;font-family: Cambria;border:1px solid;">

						<tr style="">
							<td style="width:10%;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Job No. :</td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
							<td style="border-left:1px solid;width:10%;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Laboratory ID :-</td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;border-top:1px solid;width:10%;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;border-top:1px solid;border-top:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Grade of concrete :-</td>
							<td style="border-left:1px solid;border-top:1px solid;border-top:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select_pipe['grade1'] != "" && $row_select_pipe['grade1'] != "0" && $row_select_pipe['grade1'] != null) {
																																						echo $row_select_pipe['grade1'];
																																					} else {
																																						echo " <br>";
																																					}  ?></td>
							<td style="border-top:1px solid;border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Sample Rec. Date:-</td>
							<td style="border-top:1px solid;border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;border-top:1px solid;width:10%;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;border-top:1px solid;border-top:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Date of casting :-</td>
							<td style="border-left:1px solid;border-top:1px solid;border-top:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																																						echo date('d - m - Y', strtotime($row_select_pipe['caste_date1']));
																																					} else {
																																						echo " <br>";
																																					}  ?></td>
							<td style="border-top:1px solid;border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Water temp:-</td>
							<td style="border-top:1px solid;border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['wat_temp']; ?></td>
						</tr>

					</table><br>

				</td>
			</tr>



			<tr>
				<td style="text-align:center;font-size:18px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:10px;padding-top:20px; text-align:center;font-weight:bold; ">MODULUS OF RUPTURE</td>
						</tr>

					</table>

				</td>
			</tr>



			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border:1px solid;margin-bottom:15px;">

						<tr style="">

							<td style="width:8%;font-weight:bold;text-align:center; ">Sr.<br> No.</td>
							<td style="border-left:1px solid;width:12%;font-weight:bold;text-align:center; ">Date of<br>Testing</td>
							<td style="border-left:1px solid;width:8%;font-weight:bold;text-align:center; ">Client<br>I.D.<br>Mark</td>
							<td style="border-left:1px solid;width:14%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;  ">Beam Size<br>(L X B X H)<br>(mm)</td>
							<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">A in mm</td>
							<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center;  ">Load in <br>KN</td>
							<td style="border-left:1px solid;width:18%;font-weight:bold;text-align:center;  ">Modulus of<br>Rupture (N/mm&sup2;)</td>
							<td style="border-left:1px solid;width:20%;font-weight:bold;text-align:center;  ">Average Modulus of<br>Rupture (N/mm&sup2;)</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																						echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																					} else {
																																						echo " <br>";
																																					} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:8%;text-align:center; "><?php if ($row_select_pipe['mark_1'] != "" && $row_select_pipe['mark_1'] != "0" && $row_select_pipe['mark_1'] != null) {
																													echo $row_select_pipe['mark_1'];
																												} else {
																													echo " - ";
																												}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																														echo ($row_select_pipe['l1'] * $row_select_pipe['b1'] * $row_select_pipe['h1']);
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cross_1'] != "" && $row_select_pipe['cross_1'] != "0" && $row_select_pipe['cross_1'] != null) {
																														echo $row_select_pipe['cross_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																														echo $row_select_pipe['load_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center; "><?php if ($row_select_pipe['comp_1'] != "" && $row_select_pipe['comp_1'] != "0" && $row_select_pipe['comp_1'] != null) {
																														echo $row_select_pipe['comp_1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; " rowspan=3><?php if ($row_select_pipe['avg_com_s_1'] != "" && $row_select_pipe['avg_com_s_1'] != "0" && $row_select_pipe['avg_com_s_1'] != null) {
																																echo $row_select_pipe['avg_com_s_1'];
																															} else {
																																echo " <br>";
																															} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																						echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																					} else {
																																						echo " <br>";
																																					} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:8%;text-align:center; "><?php if ($row_select_pipe['mark_2'] != "" && $row_select_pipe['mark_2'] != "0" && $row_select_pipe['mark_2'] != null) {
																													echo $row_select_pipe['mark_2'];
																												} else {
																													echo " - ";
																												}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != "0" && $row_select_pipe['l2'] != null) {
																														echo ($row_select_pipe['l2'] * $row_select_pipe['b2'] * $row_select_pipe['h2']);
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cross_2'] != "" && $row_select_pipe['cross_2'] != "0" && $row_select_pipe['cross_2'] != null) {
																														echo $row_select_pipe['cross_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																														echo $row_select_pipe['load_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center; "><?php if ($row_select_pipe['comp_2'] != "" && $row_select_pipe['comp_2'] != "0" && $row_select_pipe['comp_2'] != null) {
																														echo $row_select_pipe['comp_2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																																						echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																																					} else {
																																						echo " <br>";
																																					} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:8%;text-align:center; "><?php if ($row_select_pipe['mark_3'] != "" && $row_select_pipe['mark_3'] != "0" && $row_select_pipe['mark_3'] != null) {
																													echo $row_select_pipe['mark_3'];
																												} else {
																													echo " - ";
																												}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:14%;text-align:center; "><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != "0" && $row_select_pipe['l3'] != null) {
																														echo ($row_select_pipe['l3'] * $row_select_pipe['b3'] * $row_select_pipe['h2']);
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cross_3'] != "" && $row_select_pipe['cross_3'] != "0" && $row_select_pipe['cross_3'] != null) {
																														echo $row_select_pipe['cross_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																														echo $row_select_pipe['load_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center; "><?php if ($row_select_pipe['comp_3'] != "" && $row_select_pipe['comp_3'] != "0" && $row_select_pipe['comp_3'] != null) {
																														echo $row_select_pipe['comp_3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="20%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border:1px solid;margin-bottom:15px;">

						<tr style="">

							<td style="width:8%;font-weight:bold;text-align:center; padding-bottom:5px;padding-top:5px;">Weight<br>(kg)</td>
							<td style="border-left:1px solid;width:12%;font-weight:bold;text-align:center; ">Density<br>(kg/m&sup3;)</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) {
																												echo $row_select_pipe['mass_1'];
																											} else {
																												echo " - ";
																											}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) {
																																						echo ($row_select_pipe['mass_1']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
																												echo $row_select_pipe['mass_2'];
																											} else {
																												echo " - ";
																											}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
																																						echo ($row_select_pipe['mass_2']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
																												echo $row_select_pipe['mass_3'];
																											} else {
																												echo " - ";
																											}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:5px;padding-top:5px; "><?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
																																						echo ($row_select_pipe['mass_3']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
						</tr>

					</table>

					<table align="left" width="45%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border:1px solid;margin-bottom:15px;margin-left:15%;">

						<tr style="">

							<td style="width:8%;font-weight:bold;text-align:center;font-weight:bold;padding-bottom:8px;padding-top:8px; ">Test method</td>
							<td style="border-left:1px solid;width:12%;text-align:center; ">IS : 516 - 1959 (Reaff. 2013)</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center;font-weight:bold; ">Curing Condition</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center;padding-bottom:8px;padding-top:8px; ">IS : 516 - 1959 (Reaff. 2013)</td>
						</tr>
					</table>

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:center;font-size:13px; "><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:13px; ">
						<tr>
							<td style="font-size:15px;padding-bottom:2px;"><b>Note :-</b></td>
						</tr>
						<tr>
							<td><b> 1) &nbsp;</b>a is equals the distance between the line ot fracture and the nearer support.</td>
						</tr>
						<tr>
							<td><b> 2) &nbsp;</b>Flexural Strength of Beam Calucalted as</td>

						</tr>
						<tr>
							<td><b> i) &nbsp;</b>Modulus of Rupture or Flexural Strength=(p*l)/(b*d&sup2;)<br>when 'a' is greater than 20.0 cm for 15·0 cm specimen, or greater than 13.3 cm for a 10·0 cm specimen</td>

						</tr>
						<tr>
							<td><b> ii) &nbsp;</b>Modulus of Rupture or Flexural Strength= (3*p*a)/(b*d&sup2;)<br>when,'a' is less than 20·0 cm but greater than 17·0 cm for 15·0 cm specimen, or less than 13·3 cm but greater than 11·0 <br>cm for a 10·0 cm specimen.</td>

						</tr>
						<tr>
							<td style="font-weight:bold;font-size:16px;padding-bottom:2px;padding-top:8px;">where</td>

						</tr>
						<tr>
							<td><b> b =&nbsp;</b> measured width In cm of the specimen,</td>

						</tr>
						<tr>
							<td><b> d = &nbsp;</b>measured depth in cm of the specimen at the point of failure,</td>

						</tr>
						<tr>
							<td><b> I &nbsp;= &nbsp;</b>length in cm of the span on which the specimen was supported,and</td>

						</tr>
						<tr>
							<td><b> p = &nbsp;</b>maximum load in kg applied to the specimen</td>

						</tr>

					</table>
				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:30px;padding-left:40px;  "><u>Tested By</u></td>
							<td style="width:20%;text-align:left;font-weight:bold; "><u>Checked By</u></td>
						</tr>

					</table><br>

				</td>
			</tr> -->

			<!--tr>
				<td  style="text-align:right;font-size:11px; ">
				
					<table align="right" width="15%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			
						<tr style=""> 
							
							<td  style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding: 2px 3px; ">Page: 1/1</td>
						</tr>
						
					</table>
				
				</td>
		</tr-->


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
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>
					Flexural Strength</b></center></td>					
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

			<p class="test1" style="margin-left:5%;">Detail of Sample</p>
			
			<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="5%">
				
				<tr style="border: 1px solid black;">
					<td style="text-align:center;width:5%;"><b>1</b></td>
					<td style="width:20%;"><b>Laboratory No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $job_no; ?></td>
					<td><b>&nbsp;</b></td>
					<td><b>&nbsp;</b></td>
					<td><b>&nbsp;</b></td>
					<td>&nbsp;</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="text-align:center;width:5%"><b>2</b></td>
					<td style="width:20%;"><b>Job No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
					<td><b>&nbsp;</b></td>
					<td><b>&nbsp;</b></td>
					<td><b>&nbsp;</b></td>
					<td>&nbsp;</td>
					
				</tr>
					
			
			</table>
			<br>
			<table align="center" width="90%" class="test1" style="" height="Auto">
						
						<tr style="border-bottom: 1px solid black;">
							<td  colspan="3" style="border: 0px solid black;"><b>As per IS 516 (P-1) - 1959 R.A. 2019</b></td>
							<td  colspan="3" style="border: 0px solid black;text-align:right;"><b>Age of Specimen  :-  </b><?php echo $row_select_pipe['day1']; ?></td>
							
						</tr>
						
			</table>
			<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
				
				
				<tr style="border: 1px solid black;">
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:5%;"><center>Sr.<br>No.</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:12.6%"><center>Sample ID/<br>Grade of Concrete</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:12.6%"><center>Date of Casting</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:12.6%"><center>Date of Testing</center></td>
					<td colspan="3" style="border: 1px solid black;font-weight:bold;width:21%"><center>Dimension <br>(mm)</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:12%"><center>Max. Load at<br>Failure (KN)</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:12%"><center>A<br>(mm)</center></td>
																					
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;width:"><center>Flexural<br>Strength,<br>(N/mm<sup>2</sup>)</center></td>
					
				</tr>
				<tr style="text-align:center">
					
					<td style="border: 1px solid black;widht:7%"><b>L</b></td>
					<td style="border: 1px solid black;widht:7%"><b>B</b></td>
					<td style="border: 1px solid black;widht:7%"><b>H</b></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">1</td>
					
					<td rowspan="3" style="border: 1px solid black;"><?php if ($row_select_pipe['grade1'] != "" && $row_select_pipe['grade1'] != "0" && $row_select_pipe['grade1'] != null) {
																			echo $row_select_pipe['grade1'];
																		} else {
																			echo " <br>";
																		}  ?></td>
					<td rowspan="3" style="border: 1px solid black;"><?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																			echo date('d - m - Y', strtotime($row_select_pipe['caste_date1']));
																		} else {
																			echo " <br>";
																		}  ?></td>
					<td rowspan="3" style="border: 1px solid black;"><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																			echo date('d - m - Y', strtotime($row_select_pipe['test_date1']));
																		} else {
																			echo " <br>";
																		} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																echo $row_select_pipe['l1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b1'] != "" && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {
																echo $row_select_pipe['b1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['h1'] != "" && $row_select_pipe['h1'] != "0" && $row_select_pipe['h1'] != null) {
																echo $row_select_pipe['h1'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																echo $row_select_pipe['load_1'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_1'] != "" && $row_select_pipe['cross_1'] != "0" && $row_select_pipe['cross_1'] != null) {
																echo $row_select_pipe['cross_1'];
															} else {
																echo " <br>";
															} ?></td>					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['comp_1'] != "" && $row_select_pipe['comp_1'] != "0" && $row_select_pipe['comp_1'] != null) {
																echo $row_select_pipe['comp_1'];
															} else {
																echo " <br>";
															}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">2</td>
					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != "0" && $row_select_pipe['l2'] != null) {
																echo $row_select_pipe['l2'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b2'] != "" && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {
																echo $row_select_pipe['b2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['h2'] != "" && $row_select_pipe['h2'] != "0" && $row_select_pipe['h2'] != null) {
																echo $row_select_pipe['h2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																echo $row_select_pipe['load_2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_2'] != "" && $row_select_pipe['cross_2'] != "0" && $row_select_pipe['cross_2'] != null) {
																echo $row_select_pipe['cross_2'];
															} else {
																echo " <br>";
															} ?></td>					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['comp_2'] != "" && $row_select_pipe['comp_2'] != "0" && $row_select_pipe['comp_2'] != null) {
																echo $row_select_pipe['comp_2'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">3</td>
										
					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != "0" && $row_select_pipe['l3'] != null) {
																echo $row_select_pipe['l3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b3'] != "" && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {
																echo $row_select_pipe['b3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['h3'] != "" && $row_select_pipe['h3'] != "0" && $row_select_pipe['h3'] != null) {
																echo $row_select_pipe['h3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																echo $row_select_pipe['load_3'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_3'] != "" && $row_select_pipe['cross_3'] != "0" && $row_select_pipe['cross_3'] != null) {
																echo $row_select_pipe['cross_3'];
															} else {
																echo " <br>";
															} ?></td>					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['comp_3'] != "" && $row_select_pipe['comp_3'] != "0" && $row_select_pipe['comp_3'] != null) {
																echo $row_select_pipe['comp_3'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td colspan="9" style="border: 1px solid black;font-weight:bold;text-align:right;">Average</td>
					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['avg_com_s_1'] != "" && $row_select_pipe['avg_com_s_1'] != "0" && $row_select_pipe['avg_com_s_1'] != null) {
																echo $row_select_pipe['avg_com_s_1'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				
				
				<br>
				<br>
			</table>
			
				
					
			
			
			</page-->

</body>

</html>


<script type="text/javascript">

</script>