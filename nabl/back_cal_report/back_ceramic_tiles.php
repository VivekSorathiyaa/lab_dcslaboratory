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
	$select_tiles_query = "select * from rebound_hammer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	// $job_no= $row_select['job_no'];			
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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family : Calibri;border-bottom:1px solid;">

						<tr style="">

							<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/NDT/OS/001</td>
							<td style="width:20%;text-align:center;font-weight:bold; ">REV : 01</td>
							<td style="width:25%; font-weight:bold;">RD :- 12.01.2023</td>
							<td style="width:25%;font-weight:bold;">Page : </td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family : Calibri;border-bottom:1px solid;">

						<tr style="">

							<td style="width:70%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:30%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">

						<tr style="">

							<td style="width:75%;padding-bottom:3px;padding-top:3px;padding-left:150px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:150px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULAITON SHEET FOR REBOUND HAMMER TEST (IS 132311:Part 2)</td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php /* $cnt=1;*/ ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Location :-</td>
							<td style="border-left:1px solid;width:45%;text-align:left; ">&nbsp;<?php if ($material_location == 1) {
																									echo "In Laboratory";
																								} else {
																									echo "In Field";
																								} ?> <?php echo $source; ?></td>
							<td style="border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; Testing Date :-</td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Date of Casting:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp; <?php echo date('d/m/Y', strtotime($caste_date)); ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; Sample Id:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; "><?php echo $sample_id; ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Type of Cement:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; Temperature:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp; <?php echo $row_select_pipe['temp']; ?> </td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Type of Aggregate:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; rebound hammer</td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; </td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Surface Condition:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp; <?php echo $con_sample; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp; </td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Age of Concrete:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp;&nbsp; </td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;margin-bottom:25px;">

						<tr style="">

							<td style="width:7%;font-weight:bold;text-align:center; " rowspan=2>Sr No.</td>
							<td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center; " rowspan=2>Description</td>
							<td style="border-left:1px solid;width:10%;font-weight:bold;text-align:center; " rowspan=2>Direction</td>
							<td style="border-left:1px solid;width:7%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px;  " rowspan=2>Angle</td>
							<td style="border-left:1px solid;width:24%;font-weight:bold;text-align:center;padding-bottom:5px;padding-top:5px; " colspan=6>Rebound Number=N</td>
							<td style="border-left:1px solid;width:15%;font-weight:bold;text-align:center; " rowspan=2>Average Rebound<br>Number</td>
							<td style="border-left:1px solid;width:19%;font-weight:bold;text-align:center; " rowspan=2>Compressive<br>Strength N/mm&sup2;</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">1</td>
							<td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center;padding-bottom:3px;padding-top:3px; ">2</td>
							<td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">3</td>
							<td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">4</td>
							<td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">5</td>
							<td style="border-top:1px solid;border-left:1px solid;width:4%;font-weight:bold;text-align:center; ">6</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 0 mtr</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
							<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
							<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_11'] != "" && $row_select_pipe['r_11'] != null && $row_select_pipe['r_11'] != "0") {
																															echo $row_select_pipe['r_11'];
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_21'] != "" && $row_select_pipe['r_21'] != null && $row_select_pipe['r_21'] != "0") {
																															echo $row_select_pipe['r_21'];
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_31'] != "" && $row_select_pipe['r_31'] != null && $row_select_pipe['r_31'] != "0") {
																															echo $row_select_pipe['r_31'];
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_41'] != "" && $row_select_pipe['r_41'] != null && $row_select_pipe['r_41'] != "0") {
																															echo $row_select_pipe['r_41'];
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_51'] != "" && $row_select_pipe['r_51'] != null && $row_select_pipe['r_51'] != "0") {
																															echo $row_select_pipe['r_51'];
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_61'] != "" && $row_select_pipe['r_61'] != null && $row_select_pipe['r_61'] != "0") {
																															echo $row_select_pipe['r_61'];
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_1'] != "" && $row_select_pipe['avg_1'] != null && $row_select_pipe['avg_1'] != "0") {
																														echo $row_select_pipe['avg_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com1'] != "" && $row_select_pipe['avg_com1'] != null && $row_select_pipe['avg_com1'] != "0") {
																														echo $row_select_pipe['avg_com1'];
																													} else {
																														echo "-";
																													} ?></td>
				</td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 3 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_13'] != "" && $row_select_pipe['r_13'] != null && $row_select_pipe['r_13'] != "0") {
																												echo $row_select_pipe['r_13'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_23'] != "" && $row_select_pipe['r_23'] != null && $row_select_pipe['r_23'] != "0") {
																												echo $row_select_pipe['r_23'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_33'] != "" && $row_select_pipe['r_33'] != null && $row_select_pipe['r_33'] != "0") {
																												echo $row_select_pipe['r_33'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_43'] != "" && $row_select_pipe['r_43'] != null && $row_select_pipe['r_43'] != "0") {
																												echo $row_select_pipe['r_43'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_53'] != "" && $row_select_pipe['r_53'] != null && $row_select_pipe['r_53'] != "0") {
																												echo $row_select_pipe['r_53'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_63'] != "" && $row_select_pipe['r_63'] != null && $row_select_pipe['r_63'] != "0") {
																												echo $row_select_pipe['r_63'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_3'] != "" && $row_select_pipe['avg_3'] != null && $row_select_pipe['avg_3'] != "0") {
																											echo $row_select_pipe['avg_3'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com2'] != "" && $row_select_pipe['avg_com2'] != null && $row_select_pipe['avg_com2'] != "0") {
																											echo $row_select_pipe['avg_com2'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 6 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_15'] != "" && $row_select_pipe['r_15'] != null && $row_select_pipe['r_15'] != "0") {
																												echo $row_select_pipe['r_15'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_25'] != "" && $row_select_pipe['r_25'] != null && $row_select_pipe['r_25'] != "0") {
																												echo $row_select_pipe['r_25'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_35'] != "" && $row_select_pipe['r_35'] != null && $row_select_pipe['r_35'] != "0") {
																												echo $row_select_pipe['r_35'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_45'] != "" && $row_select_pipe['r_45'] != null && $row_select_pipe['r_45'] != "0") {
																												echo $row_select_pipe['r_45'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_55'] != "" && $row_select_pipe['r_55'] != null && $row_select_pipe['r_55'] != "0") {
																												echo $row_select_pipe['r_55'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_65'] != "" && $row_select_pipe['r_65'] != null && $row_select_pipe['r_65'] != "0") {
																												echo $row_select_pipe['r_65'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_5'] != "" && $row_select_pipe['avg_5'] != null && $row_select_pipe['avg_5'] != "0") {
																											echo $row_select_pipe['avg_5'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com3'] != "" && $row_select_pipe['avg_com3'] != null && $row_select_pipe['avg_com3'] != "0") {
																											echo $row_select_pipe['avg_com3'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 9 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_17'] != "" && $row_select_pipe['r_17'] != null && $row_select_pipe['r_17'] != "0") {
																												echo $row_select_pipe['r_17'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_27'] != "" && $row_select_pipe['r_27'] != null && $row_select_pipe['r_27'] != "0") {
																												echo $row_select_pipe['r_27'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_37'] != "" && $row_select_pipe['r_37'] != null && $row_select_pipe['r_37'] != "0") {
																												echo $row_select_pipe['r_37'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_47'] != "" && $row_select_pipe['r_47'] != null && $row_select_pipe['r_47'] != "0") {
																												echo $row_select_pipe['r_47'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_57'] != "" && $row_select_pipe['r_57'] != null && $row_select_pipe['r_57'] != "0") {
																												echo $row_select_pipe['r_57'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_67'] != "" && $row_select_pipe['r_67'] != null && $row_select_pipe['r_67'] != "0") {
																												echo $row_select_pipe['r_67'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_7'] != "" && $row_select_pipe['avg_7'] != null && $row_select_pipe['avg_7'] != "0") {
																											echo $row_select_pipe['avg_7'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com4'] != "" && $row_select_pipe['avg_com4'] != null && $row_select_pipe['avg_com4'] != "0") {
																											echo $row_select_pipe['avg_com4'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 12 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_19'] != "" && $row_select_pipe['r_19'] != null && $row_select_pipe['r_19'] != "0") {
																												echo $row_select_pipe['r_19'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_29'] != "" && $row_select_pipe['r_29'] != null && $row_select_pipe['r_29'] != "0") {
																												echo $row_select_pipe['r_29'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_39'] != "" && $row_select_pipe['r_39'] != null && $row_select_pipe['r_39'] != "0") {
																												echo $row_select_pipe['r_39'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_49'] != "" && $row_select_pipe['r_49'] != null && $row_select_pipe['r_49'] != "0") {
																												echo $row_select_pipe['r_49'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_59'] != "" && $row_select_pipe['r_59'] != null && $row_select_pipe['r_59'] != "0") {
																												echo $row_select_pipe['r_59'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_69'] != "" && $row_select_pipe['r_69'] != null && $row_select_pipe['r_69'] != "0") {
																												echo $row_select_pipe['r_69'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_9'] != "" && $row_select_pipe['avg_9'] != null && $row_select_pipe['avg_9'] != "0") {
																											echo $row_select_pipe['avg_9'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com5'] != "" && $row_select_pipe['avg_com5'] != null && $row_select_pipe['avg_com5'] != "0") {
																											echo $row_select_pipe['avg_com5'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 15 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_111'] != "" && $row_select_pipe['r_111'] != null && $row_select_pipe['r_111'] != "0") {
																												echo $row_select_pipe['r_111'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_211'] != "" && $row_select_pipe['r_211'] != null && $row_select_pipe['r_211'] != "0") {
																												echo $row_select_pipe['r_211'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_311'] != "" && $row_select_pipe['r_311'] != null && $row_select_pipe['r_311'] != "0") {
																												echo $row_select_pipe['r_311'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_411'] != "" && $row_select_pipe['r_411'] != null && $row_select_pipe['r_411'] != "0") {
																												echo $row_select_pipe['r_411'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_511'] != "" && $row_select_pipe['r_511'] != null && $row_select_pipe['r_511'] != "0") {
																												echo $row_select_pipe['r_511'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_611'] != "" && $row_select_pipe['r_611'] != null && $row_select_pipe['r_611'] != "0") {
																												echo $row_select_pipe['r_611'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_11'] != "" && $row_select_pipe['avg_11'] != null && $row_select_pipe['avg_11'] != "0") {
																											echo $row_select_pipe['avg_11'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com6'] != "" && $row_select_pipe['avg_com6'] != null && $row_select_pipe['avg_com6'] != "0") {
																											echo $row_select_pipe['avg_com6'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 18 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_113'] != "" && $row_select_pipe['r_113'] != null && $row_select_pipe['r_113'] != "0") {
																												echo $row_select_pipe['r_113'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_213'] != "" && $row_select_pipe['r_213'] != null && $row_select_pipe['r_213'] != "0") {
																												echo $row_select_pipe['r_213'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_313'] != "" && $row_select_pipe['r_313'] != null && $row_select_pipe['r_313'] != "0") {
																												echo $row_select_pipe['r_313'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_413'] != "" && $row_select_pipe['r_413'] != null && $row_select_pipe['r_413'] != "0") {
																												echo $row_select_pipe['r_413'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_513'] != "" && $row_select_pipe['r_513'] != null && $row_select_pipe['r_513'] != "0") {
																												echo $row_select_pipe['r_513'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_613'] != "" && $row_select_pipe['r_613'] != null && $row_select_pipe['r_613'] != "0") {
																												echo $row_select_pipe['r_613'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_13'] != "" && $row_select_pipe['avg_13'] != null && $row_select_pipe['avg_13'] != "0") {
																											echo $row_select_pipe['avg_13'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com7'] != "" && $row_select_pipe['avg_com7'] != null && $row_select_pipe['avg_com7'] != "0") {
																											echo $row_select_pipe['avg_com7'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:7%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center;padding-bottom:5px;padding-top:5px; ">Beam at 21 mtr</td>
				<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; ">Horizontal</td>
				<td style="border-top:1px solid;border-left:1px solid;width:7%;text-align:center; ">0&deg;</td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_115'] != "" && $row_select_pipe['r_115'] != null && $row_select_pipe['r_115'] != "0") {
																												echo $row_select_pipe['r_115'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_215'] != "" && $row_select_pipe['r_215'] != null && $row_select_pipe['r_215'] != "0") {
																												echo $row_select_pipe['r_215'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_315'] != "" && $row_select_pipe['r_315'] != null && $row_select_pipe['r_315'] != "0") {
																												echo $row_select_pipe['r_315'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_415'] != "" && $row_select_pipe['r_415'] != null && $row_select_pipe['r_415'] != "0") {
																												echo $row_select_pipe['r_415'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_515'] != "" && $row_select_pipe['r_515'] != null && $row_select_pipe['r_515'] != "0") {
																												echo $row_select_pipe['r_515'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-left: 1px solid black;width:4%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe['r_615'] != "" && $row_select_pipe['r_615'] != null && $row_select_pipe['r_615'] != "0") {
																												echo $row_select_pipe['r_615'];
																											} else {
																												echo "-";
																											} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:center; "><?php if ($row_select_pipe['avg_15'] != "" && $row_select_pipe['avg_15'] != null && $row_select_pipe['avg_15'] != "0") {
																											echo $row_select_pipe['avg_15'];
																										} else {
																											echo "-";
																										} ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:19%;text-align:center; "><?php if ($row_select_pipe['avg_com8'] != "" && $row_select_pipe['avg_com8'] != null && $row_select_pipe['avg_com8'] != "0") {
																											echo $row_select_pipe['avg_com8'];
																										} else {
																											echo "-";
																										} ?></td>
			</tr>


		</table>

		</td>
		</tr>


		<tr>
			<td style="text-align:center;font-size:14px; ">

				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family : Calibri;">

					<tr style="">

						<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
						<td style="width:20%;text-align:left;font-weight:bold; ">Checked By:-</td>
					</tr>

				</table><br>

			</td>
		</tr>

		<tr>
			<td style="text-align:right;font-size:11px; ">

				<table align="right" width="20%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">

					<tr style="">

						<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page: 1/1</td>
					</tr>

				</table>

			</td>
		</tr>


		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
		</table>
	</page>

</body>

</html>

<script type="text/javascript">


</script>