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
	$select_tiles_query = "select * from concrete_cover WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<br>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/NDT/OS/004</td>
							<td style="width:20%;text-align:center	;font-weight:bold; ">REV : 01</td>
							<td style="width:25%; font-weight:bold;">RD :- 12/01/2023</td>
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

							<td style="width:100%;padding-bottom:2px;padding-top:2px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULAITON SHEET FOR COVER METER<br>(IS 456:2000 )</td>
						</tr>

					</table><br>

				</td>
			</tr>


			<?php /* $cnt=1;*/ ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">
							<td style="width:20%;text-align:left;font-weight:bold;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Location Name:-</td>
							<td style="border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; <?php if ($material_location == 1) {
																											echo "In Laboratory";
																										} else {
																											echo "In Field";
																										} ?></td>
							<td style="border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp;&nbsp; Testing Date :-</td>
							<td style="border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:20%;text-align:left;font-weight:bold;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Temperature:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:45%;text-align:left; ">&nbsp;&nbsp; <?php echo $row_select_pipe['temp']; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:15%;text-align:left;font-weight:bold; ">&nbsp;&nbsp; Sample Id:-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:left; ">&nbsp;&nbsp; </td>
						</tr>
					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;margin-bottom:25px;">

						<tr style="">

							<td style="width:5%;font-weight:bold;text-align:center; ">Sr No.</td>
							<td style="border-left:1px solid;width:35%;font-weight:bold;text-align:center; ">Concrete Elements</td>
							<td style="border-left:1px solid;width:40%;font-weight:bold;text-align:center; ">Cover to Element (mm)</td>
							<td style="border-left:1px solid;width:20%;font-weight:bold;text-align:center;padding-bottom:12px;padding-top:12px;  ">Remarks</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:12px;padding-top:12px; "><?php if ($row_select_pipe['ele_1'] != "" && $row_select_pipe['ele_1'] != null && $row_select_pipe['ele_1'] != "0") {
																																							echo $row_select_pipe['ele_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['cov_1'] != "" && $row_select_pipe['cov_1'] != null && $row_select_pipe['cov_1'] != "0") {
																														echo $row_select_pipe['cov_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['rem_1'] != "" && $row_select_pipe['rem_1'] != null && $row_select_pipe['rem_1'] != "0") {
																														echo $row_select_pipe['rem_1'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:12px;padding-top:12px; "><?php if ($row_select_pipe['ele_2'] != "" && $row_select_pipe['ele_2'] != null && $row_select_pipe['ele_2'] != "0") {
																																							echo $row_select_pipe['ele_2'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['cov_2'] != "" && $row_select_pipe['cov_2'] != null && $row_select_pipe['cov_2'] != "0") {
																														echo $row_select_pipe['cov_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['rem_2'] != "" && $row_select_pipe['rem_2'] != null && $row_select_pipe['rem_2'] != "0") {
																														echo $row_select_pipe['rem_2'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:12px;padding-top:12px; "><?php if ($row_select_pipe['ele_3'] != "" && $row_select_pipe['ele_3'] != null && $row_select_pipe['ele_3'] != "0") {
																																							echo $row_select_pipe['ele_3'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['cov_3'] != "" && $row_select_pipe['cov_3'] != null && $row_select_pipe['cov_3'] != "0") {
																														echo $row_select_pipe['cov_3'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['rem_3'] != "" && $row_select_pipe['rem_3'] != null && $row_select_pipe['rem_3'] != "0") {
																														echo $row_select_pipe['rem_
							3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:12px;padding-top:12px; "><?php if ($row_select_pipe['ele_4'] != "" && $row_select_pipe['ele_4'] != null && $row_select_pipe['ele_4'] != "0") {
																																							echo $row_select_pipe['ele_4'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['cov_4'] != "" && $row_select_pipe['cov_4'] != null && $row_select_pipe['cov_4'] != "0") {
																														echo $row_select_pipe['cov_4'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['rem_4'] != "" && $row_select_pipe['rem_4'] != null && $row_select_pipe['rem_4'] != "0") {
																														echo $row_select_pipe['rem_4'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:12px;padding-top:12px; "><?php if ($row_select_pipe['ele_5'] != "" && $row_select_pipe['ele_5'] != null && $row_select_pipe['ele_5'] != "0") {
																																							echo $row_select_pipe['ele_5'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['cov_5'] != "" && $row_select_pipe['cov_5'] != null && $row_select_pipe['cov_5'] != "0") {
																														echo $row_select_pipe['cov_5'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['rem_5'] != "" && $row_select_pipe['rem_5'] != null && $row_select_pipe['rem_5'] != "0") {
																														echo $row_select_pipe['rem_5'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:12px;padding-top:12px; "><?php if ($row_select_pipe['ele_6'] != "" && $row_select_pipe['ele_6'] != null && $row_select_pipe['ele_6'] != "0") {
																																							echo $row_select_pipe['ele_6'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; "><?php if ($row_select_pipe['cov_6'] != "" && $row_select_pipe['cov_6'] != null && $row_select_pipe['cov_6'] != "0") {
																														echo $row_select_pipe['cov_6'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "><?php if ($row_select_pipe['rem_6'] != "" && $row_select_pipe['rem_6'] != null && $row_select_pipe['rem_6'] != "0") {
																														echo $row_select_pipe['rem_6'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>

						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:75%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold;  " colspan=2>Nominal Cover to Meet Durability Requirments<br>as per IS 456:2000 (Clause 26.4.2)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center;"></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:5px;padding-top:5px; ">Exposure</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; ">Nominal Concrete Cover in mm not less than</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:5px;padding-top:5px; ">Mild</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; ">30</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:5px;padding-top:5px; ">Moderate</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; ">30</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:5px;padding-top:5px; ">Severe</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; ">45</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:5px;padding-top:5px; ">Very Severe</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; ">50</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;font-weight:bold;text-align:center; "></td>
							<td style="border-top:1px solid;border-left:1px solid;width:35%;text-align:center;padding-bottom:5px;padding-top:5px; ">Extreme</td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:center; ">75</td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%;text-align:center; "></td>
						</tr>

					</table>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="85%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:70%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
							<td style="width:30%;text-align:left;font-weight:bold; ">Checked By:-</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="20%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">

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