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
	$select_tiles_query = "select * from carbonation WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$issue_date = $row_select2['issue_date'];
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
		/* $mark= $row_select4['mark'];
					$brick_specification= $row_select4['brick_specification']; */
	}

	?>

	<br>
	<br>

	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/NDT/OS/005</td>
							<td style="width:20%;text-align:center;font-weight:bold; ">REV : 01</td>
							<td style="width:25%; font-weight:bold;">RD :- 23/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : </td>
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

							<td style="width:75%;padding-bottom:3px;padding-top:3px;padding-left:200px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:18px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULAITON SHEET FOR CARBONATION TEST <br>(BS-1881 Part - 201: CL-2.22)</td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php /* $cnt=1;*/ ?>
			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="width:18%;text-align:left; ">&nbsp;&nbsp; Location Name:-</td>
							<td style="border-left:1px solid;width:42%;text-align:left; ">&nbsp;&nbsp; <?php if ($material_location == 1) {
																											echo "In Laboratory";
																										} else {
																											echo "In Field";
																										} ?></td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Testing Date :-</td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:left; ">&nbsp;&nbsp; Temperature:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['temp']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; Sample Id:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
						</tr>
					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:15px;">

						<tr style="">

							<td style="width:10%;font-weight:bold;padding-bottom:10px;text-align:center; ">Sr No.</td>
							<td style="border-left:1px solid;width:30%;font-weight:bold;text-align:center; ">Concrete Elements</td>
							<td style="border-left:1px solid;width:22%;font-weight:bold;text-align:center; ">Core Length,mm</td>
							<td style="border-left:1px solid;width:22%;font-weight:bold;text-align:center;padding-bottom:10px;padding-top:10px;  ">Avg Carbonation<br>Depth,mm</td>
							<td style="border-left:1px solid;width:16%;font-weight:bold;text-align:center;  ">Average pH</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_1'] != "" && $row_select_pipe['con_1'] != null && $row_select_pipe['con_1'] != "0") {
																																							echo $row_select_pipe['con_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_1'] != "" && $row_select_pipe['len_1'] != null && $row_select_pipe['len_1'] != "0") {
																														echo $row_select_pipe['len_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_1'] != "" && $row_select_pipe['acd_1'] != null && $row_select_pipe['acd_1'] != "0") {
																														echo $row_select_pipe['acd_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_1'] != "" && $row_select_pipe['aph_1'] != null && $row_select_pipe['aph_1'] != "0") {
																														echo $row_select_pipe['aph_1'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_2'] != "" && $row_select_pipe['con_2'] != null && $row_select_pipe['con_2'] != "0") {
																																							echo $row_select_pipe['con_2'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_2'] != "" && $row_select_pipe['len_2'] != null && $row_select_pipe['len_2'] != "0") {
																														echo $row_select_pipe['len_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_2'] != "" && $row_select_pipe['acd_2'] != null && $row_select_pipe['acd_2'] != "0") {
																														echo $row_select_pipe['acd_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_2'] != "" && $row_select_pipe['aph_2'] != null && $row_select_pipe['aph_2'] != "0") {
																														echo $row_select_pipe['aph_2'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_3'] != "" && $row_select_pipe['con_3'] != null && $row_select_pipe['con_3'] != "0") {
																																							echo $row_select_pipe['con_3'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_3'] != "" && $row_select_pipe['len_3'] != null && $row_select_pipe['len_3'] != "0") {
																														echo $row_select_pipe['len_3'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_3'] != "" && $row_select_pipe['acd_3'] != null && $row_select_pipe['acd_3'] != "0") {
																														echo $row_select_pipe['acd_3'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_3'] != "" && $row_select_pipe['aph_3'] != null && $row_select_pipe['aph_3'] != "0") {
																														echo $row_select_pipe['aph_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_4'] != "" && $row_select_pipe['con_4'] != null && $row_select_pipe['con_4'] != "0") {
																																							echo $row_select_pipe['con_4'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_4'] != "" && $row_select_pipe['len_4'] != null && $row_select_pipe['len_4'] != "0") {
																														echo $row_select_pipe['len_4'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_4'] != "" && $row_select_pipe['acd_4'] != null && $row_select_pipe['acd_4'] != "0") {
																														echo $row_select_pipe['acd_4'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_4'] != "" && $row_select_pipe['aph_4'] != null && $row_select_pipe['aph_4'] != "0") {
																														echo $row_select_pipe['aph_4'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_5'] != "" && $row_select_pipe['con_5'] != null && $row_select_pipe['con_5'] != "0") {
																																							echo $row_select_pipe['con_5'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_5'] != "" && $row_select_pipe['len_5'] != null && $row_select_pipe['len_5'] != "0") {
																														echo $row_select_pipe['len_5'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_5'] != "" && $row_select_pipe['acd_5'] != null && $row_select_pipe['acd_5'] != "0") {
																														echo $row_select_pipe['acd_5'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_5'] != "" && $row_select_pipe['aph_5'] != null && $row_select_pipe['aph_5'] != "0") {
																														echo $row_select_pipe['aph_5'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_6'] != "" && $row_select_pipe['con_6'] != null && $row_select_pipe['con_6'] != "0") {
																																							echo $row_select_pipe['con_6'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_6'] != "" && $row_select_pipe['len_6'] != null && $row_select_pipe['len_6'] != "0") {
																														echo $row_select_pipe['len_6'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_6'] != "" && $row_select_pipe['acd_6'] != null && $row_select_pipe['acd_6'] != "0") {
																														echo $row_select_pipe['acd_6'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_6'] != "" && $row_select_pipe['aph_6'] != null && $row_select_pipe['aph_6'] != "0") {
																														echo $row_select_pipe['aph_6'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_7'] != "" && $row_select_pipe['con_7'] != null && $row_select_pipe['con_7'] != "0") {
																																							echo $row_select_pipe['con_7'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_7'] != "" && $row_select_pipe['len_7'] != null && $row_select_pipe['len_7'] != "0") {
																														echo $row_select_pipe['len_7'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_7'] != "" && $row_select_pipe['acd_7'] != null && $row_select_pipe['acd_7'] != "0") {
																														echo $row_select_pipe['acd_7'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_7'] != "" && $row_select_pipe['aph_7'] != null && $row_select_pipe['aph_7'] != "0") {
																														echo $row_select_pipe['aph_7'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_8'] != "" && $row_select_pipe['con_8'] != null && $row_select_pipe['con_8'] != "0") {
																																							echo $row_select_pipe['con_8'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_8'] != "" && $row_select_pipe['len_8'] != null && $row_select_pipe['len_8'] != "0") {
																														echo $row_select_pipe['len_8'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_8'] != "" && $row_select_pipe['acd_8'] != null && $row_select_pipe['acd_8'] != "0") {
																														echo $row_select_pipe['acd_8'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_8'] != "" && $row_select_pipe['aph_8'] != null && $row_select_pipe['aph_8'] != "0") {
																														echo $row_select_pipe['aph_8'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_9'] != "" && $row_select_pipe['con_9'] != null && $row_select_pipe['con_9'] != "0") {
																																							echo $row_select_pipe['con_9'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_9'] != "" && $row_select_pipe['len_9'] != null && $row_select_pipe['len_9'] != "0") {
																														echo $row_select_pipe['len_9'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_9'] != "" && $row_select_pipe['acd_9'] != null && $row_select_pipe['acd_9'] != "0") {
																														echo $row_select_pipe['acd_9'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_9'] != "" && $row_select_pipe['aph_9'] != null && $row_select_pipe['aph_9'] != "0") {
																														echo $row_select_pipe['aph_9'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_10'] != "" && $row_select_pipe['con_10'] != null && $row_select_pipe['con_10'] != "0") {
																																							echo $row_select_pipe['con_10'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_10'] != "" && $row_select_pipe['len_10'] != null && $row_select_pipe['len_10'] != "0") {
																														echo $row_select_pipe['len_10'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_10'] != "" && $row_select_pipe['acd_10'] != null && $row_select_pipe['acd_10'] != "0") {
																														echo $row_select_pipe['acd_10'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_10'] != "" && $row_select_pipe['aph_10'] != null && $row_select_pipe['aph_10'] != "0") {
																														echo $row_select_pipe['aph_10'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
							<td style="width:20%;text-align:left;font-weight:bold; ">Checked By:-</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:14px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page: 1/1</td>
						</tr>

					</table>

				</td>
			</tr>


			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
	</page>

</body>

</html>


<script type="text/javascript">

</script>