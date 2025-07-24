<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 30px;
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
	$branch_name = $row_select['branch_name'];
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
        $issue_date = $row_select2['issue_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name= $row_select3['mt_name'];
			include_once 'sample_id.php';
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

	<br><br><br>


	<page size="A4">

				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
					<tr>
						<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
					</tr>
					<tr>
						<td style="padding: 1px;border: 1px solid;"></td>
					</tr>
					<tr>
						<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">FLEXURAL STRENGTH OF CONCRETE BEAM TEST</td>
					</tr>
					<tr>
						<td style="padding: 1px;border: 1px solid;"></td>
					</tr>
				</table>
				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
					<tr>
						<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
						<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS-025</td>
						<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
						<td style="font-weight: bold;padding: 5px;"><?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
					</tr>
					<tr>
						<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
						<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
						<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
						<td style="font-weight: bold;padding: 5px;"><?php echo $mt_name; ?></td>
					</tr>
					<tr>
						<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
					</tr>
				</table>
				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
					<tr>
						<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
						<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 516 (Part – 1/Sec – 1): 2021 SECTION 4</td>
					</tr>
					<tr>
						<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
					</tr>
					<tr>
						<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
					</tr>
				</table>

		
		<!-- <?php if ($branch_name == "Nadiad") {?>
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-025</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample;?></b></center>
				</td>
			</tr>
		</table>
		<?php } else {?>
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name;?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-025</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $mt_name;?></b></center>
				</td>
			</tr>
		</table>
		<?php }?>
		<br>
		<table align="center" width="100%" class="test1" height="9%">

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
		</table> -->
		<br>


		<table align="center" width="100%" class="test" style="font-size: 14px;">
			<tr>
				<td><b><span>&nbsp;&nbsp; IS 516 (Part – 1/Sec – 1): 2021 SECTION 4</span></b></td>
			</tr>
		</table>

		<br>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;">
			<tr>
				<td style="text-align:center;">
				<?php $cnt=1; ?>
					<table align="center" width="100%"  class="test1" cellspacing="0" cellpadding="0" style="font-family : Calibri;">

						<tr style="">
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > Sr No.</td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Beam ID </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Date of Casting </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Date of Testing </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Age of Specimen </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Weight (kg) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Length (mm) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Width (mm)  </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Height (mm) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Length of span (mm) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Density (Kg/m<sup>3</sup>) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Load at Failure(KN) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Distance between line of Fracture (a) </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;border-right:1px solid;" > Flexural Strength N/mm<sup>2</sup> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;" > Type of Failure (A/B) </td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $cnt++; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > </td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" >  <?php echo date('d-m-Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['day1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['mass_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['l1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['b1']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['h1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) { echo ($row_select_pipe['mass_1']) / 1000; } else { echo " - "; } ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['load_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" ><?php echo $row_select_pipe['cross_1']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['comp_1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;" > <?php echo $row_select_pipe['mark_1']; ?></td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $cnt++; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > </td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" >  <?php echo date('d-m-Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['day1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['mass_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['l2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['b2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['h2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_2']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
																																						echo ($row_select_pipe['mass_2']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['load_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['comp_2']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;" ><?php echo $row_select_pipe['mark_2']; ?> </td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $cnt++; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > </td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
							<td style=" text-align:center;width: 12%;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" >  <?php echo date('d-m-Y', strtotime($row_select_pipe['test_date1'])); ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['day1']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['mass_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['l3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['b3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['h3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_3']; ?> </td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
																																						echo ($row_select_pipe['mass_3']) / 1000;
																																					} else {
																																						echo " - ";
																																					}  ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['load_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['cross_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;border-bottom:1px solid;" > <?php echo $row_select_pipe['comp_3']; ?></td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-bottom:1px solid;" ><?php echo $row_select_pipe['mark_3']; ?> </td>
						</tr>
						<tr>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;text-align: right;padding: 5px;" colspan="13">&nbsp;&nbsp; Average &nbsp;&nbsp;</td>
							<td style=" text-align:center;font-weight:bold;padding: 2px; border-right:1px solid;text-align: center;padding: 5px;" ><?php echo $row_select_pipe['avg_com_s_1']; ?></td>
						</tr>
						

					</table>
				</td>
			</tr>
		</table>

		<br>
		<table align="center" width="100%" class="test" style="font-size: 14px;">
			<tr>
				<td><b><span>&nbsp;&nbsp; * Rate of Loading 4 KN/min</span></b></td>
			</tr>
		</table>
		<br>
		<table align="center" width="100%" style="" Height="5%">
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
		

		<table align="center" width="100%" class="test1" style="" Height="10%">
			<!-- <tr style="font-size:16px;" >
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
			<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid #ccc;">
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
			<table align="center" width="100%" style="" Height="5%">
				<tr style="font-size:15px;" >
					<td style="text-align:center;padding-top:8px;"><b>Page 1 of 1</b></td>
				</tr>		 -->

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
                            <td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
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
                            <td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
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
	

			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
	</page>

</body>
</html>

<script type="text/javascript">

</script>