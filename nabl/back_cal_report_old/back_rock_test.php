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
	$select_tiles_query = "select * from rock WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		<br>
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/E/OS/01</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 06/01/2023</td>
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

							<td style="width:75%;padding-bottom:3px;padding-top:5px;padding-left:200px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:1px;padding-top:3px; text-align:center;padding-left:200px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:8px;padding-top:3px; text-align:center;padding-left:200px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:18px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULATION SHEET FOR TEST ON ROCK</td>
						</tr>

					</table>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
							<td style="border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $job_no; ?><?php echo $sample_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Date of starting test</td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:15%;border-right:1px solid; text-align:center;font-weight:bold; ">1</td>
							<td style="width:85%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Unconfined Compressive Strength (IS:9143-1979(R.A.2001)</td>

						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:20px;">

						<tr style="">
							<td style="width:8%;text-align:center;font-weight:bold;  ">Sr. No.</td>
							<td style="border-left:1px solid;width:28%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Description</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 1</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 2</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">I.D.Marks</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['desc1'] != "" && $row_select_pipe['desc1'] != null && $row_select_pipe['desc1'] != "0") {
																													echo $row_select_pipe['desc1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['desc2'] != "" && $row_select_pipe['desc2'] != null && $row_select_pipe['desc2'] != "0") {
																													echo $row_select_pipe['desc2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['desc3'] != "" && $row_select_pipe['desc3'] != null && $row_select_pipe['desc3'] != "0") {
																													echo $row_select_pipe['desc3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Lenth</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['length1'] != "" && $row_select_pipe['length1'] != null && $row_select_pipe['length1'] != "0") {
																													echo $row_select_pipe['length1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['length2'] != "" && $row_select_pipe['length2'] != null && $row_select_pipe['length2'] != "0") {
																													echo $row_select_pipe['length2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['length3'] != "" && $row_select_pipe['length3'] != null && $row_select_pipe['length3'] != "0") {
																													echo $row_select_pipe['length3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Diameter</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != null && $row_select_pipe['dia1'] != "0") {
																													echo $row_select_pipe['dia1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['dia2'] != "" && $row_select_pipe['dia2'] != null && $row_select_pipe['dia2'] != "0") {
																													echo $row_select_pipe['dia2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['dia3'] != "" && $row_select_pipe['dia3'] != null && $row_select_pipe['dia3'] != "0") {
																													echo $row_select_pipe['dia3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">L/D Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['ratio1'] != "" && $row_select_pipe['ratio1'] != null && $row_select_pipe['ratio1'] != "0") {
																													echo $row_select_pipe['ratio1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['ratio2'] != "" && $row_select_pipe['ratio2'] != null && $row_select_pipe['ratio2'] != "0") {
																													echo $row_select_pipe['ratio2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['ratio3'] != "" && $row_select_pipe['ratio3'] != null && $row_select_pipe['ratio3'] != "0") {
																													echo $row_select_pipe['ratio3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Correction factor for L/D<br>Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['corr1'] != "" && $row_select_pipe['corr1'] != null && $row_select_pipe['corr1'] != "0") {
																													echo $row_select_pipe['corr1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['corr2'] != "" && $row_select_pipe['corr2'] != null && $row_select_pipe['corr2'] != "0") {
																													echo $row_select_pipe['corr2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['corr3'] != "" && $row_select_pipe['corr3'] != null && $row_select_pipe['corr3'] != "0") {
																													echo $row_select_pipe['corr3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Load</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != null && $row_select_pipe['load1'] != "0") {
																													echo $row_select_pipe['load1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['load2'] != "" && $row_select_pipe['load2'] != null && $row_select_pipe['load2'] != "0") {
																													echo $row_select_pipe['load2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['load3'] != "" && $row_select_pipe['load3'] != null && $row_select_pipe['load3'] != "0") {
																													echo $row_select_pipe['load3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Cylindrical Comp.Strength</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['cor1'] != "" && $row_select_pipe['cor1'] != null && $row_select_pipe['cor1'] != "0") {
																													echo $row_select_pipe['cor1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['cor2'] != "" && $row_select_pipe['cor2'] != null && $row_select_pipe['cor2'] != "0") {
																													echo $row_select_pipe['cor2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['cor3'] != "" && $row_select_pipe['cor3'] != null && $row_select_pipe['cor3'] != "0") {
																													echo $row_select_pipe['cor3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>

					</table>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:15%;border-right:1px solid; text-align:center;font-weight:bold; ">2</td>
							<td style="width:85%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Water Absorption,(IS:13030-1991(R.A.2001)</td>

						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:40px;">

						<tr style="">
							<td style="width:8%;text-align:center;font-weight:bold;  ">Sr. No.</td>
							<td style="border-left:1px solid;width:28%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Description</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 1</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 2</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Mass in g of the container<br>with its lid<br>at room temperature(M1)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_1_1'] != "" && $row_select_pipe['m_1_1'] != null && $row_select_pipe['m_1_1'] != "0") {
																													echo $row_select_pipe['m_1_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_1_2'] != "" && $row_select_pipe['m_1_2'] != null && $row_select_pipe['m_1_2'] != "0") {
																													echo $row_select_pipe['m_1_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_1_3'] != "" && $row_select_pipe['m_1_3'] != null && $row_select_pipe['m_1_3'] != "0") {
																													echo $row_select_pipe['m_1_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Mass in g of the container<br>with its lid<br>and the sample at room<br>temperature(M2)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_2_1'] != "" && $row_select_pipe['m_2_1'] != null && $row_select_pipe['m_2_1'] != "0") {
																													echo $row_select_pipe['m_2_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_2_2'] != "" && $row_select_pipe['m_2_2'] != null && $row_select_pipe['m_2_2'] != "0") {
																													echo $row_select_pipe['m_2_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_2_3'] != "" && $row_select_pipe['m_2_3'] != null && $row_select_pipe['m_2_3'] != "0") {
																													echo $row_select_pipe['m_2_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Mass in g of the container<br>with its lid<br>and the sample after<br>drying(M3)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_3_1'] != "" && $row_select_pipe['m_3_1'] != null && $row_select_pipe['m_3_1'] != "0") {
																													echo $row_select_pipe['m_3_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_3_2'] != "" && $row_select_pipe['m_3_2'] != null && $row_select_pipe['m_3_2'] != "0") {
																													echo $row_select_pipe['m_3_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_3_3'] != "" && $row_select_pipe['m_3_3'] != null && $row_select_pipe['m_3_3'] != "0") {
																													echo $row_select_pipe['m_3_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Water Absorption (2-3)/(3)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">%</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != null && $row_select_pipe['wtr1'] != "0") {
																													echo $row_select_pipe['wtr1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != null && $row_select_pipe['wtr2'] != "0") {
																													echo $row_select_pipe['wtr2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != null && $row_select_pipe['wtr3'] != "0") {
																													echo $row_select_pipe['wtr3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Average Water Absorption</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">%</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;" colspan="3"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {
																																echo $row_select_pipe['avg_wtr'];
																															} else {
																																echo "-";
																															} ?></td>
						</tr>
					</table>

				</td>
			</tr>



			<tr>
				<td style="text-align:right;font-size:14px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:1/2</td>
						</tr>

					</table>

				</td>
			</tr>


			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
		</table>



		<div class="pagebreak"></div>
		<br>
		<br>
		<br>



		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/E/OS/01</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 06/01/2023</td>
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

							<td style="width:75%;padding-bottom:3px;padding-top:5px;padding-left:200px; text-align:center;font-weight:bold; ">Goma Engineering and Consultancy, Ahmedabad,</td>
							<td style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/logo.jpg" style="height:40px;width:60px;background-blend-mode:multiply;"><br><span style="text-align:center">A Gov. Approved<br> Laboratory</span></td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">"Goma House" F-88, Tulsi Estate,Opp. Bhagyoday Hotel,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:3px;padding-top:3px; text-align:center;padding-left:200px; ">Sarkhej - Bawla Highway, Changodar - 382 213,</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:1px;padding-top:3px; text-align:center;padding-left:200px; ">Ahmedabad. Ph.No. :- 8238468031/7600004285</td>
						</tr>
						<tr style="">
							<td style="width:75%;padding-bottom:8px;padding-top:3px; text-align:center;padding-left:200px; ">Email: gomaconsultancy@gmail.com</td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:15%;border-right:1px solid; text-align:center;font-weight:bold; ">3</td>
							<td style="width:85%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Density,(IS:13030-1991(R.A.2001)</td>

						</tr>

					</table><br><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:20px;">

						<tr style="">
							<td style="width:8%;text-align:center;font-weight:bold;  ">Sr. No.</td>
							<td style="border-left:1px solid;width:28%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Description</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 1</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 2</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:12px;padding-top:12px;">Saturated-submerged<br>mass of basket alone,M1</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_1'] != "" && $row_select_pipe['mass_s_1'] != null && $row_select_pipe['mass_s_1'] != "0") {
																													echo $row_select_pipe['mass_s_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {
																													echo $row_select_pipe['mass_s_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {
																													echo $row_select_pipe['mass_s_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Saturated-submerged<br>mass of basket +<br>specimen, M2</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_1'] != "" && $row_select_pipe['mass_s_1'] != null && $row_select_pipe['mass_s_1'] != "0") {
																													echo ($row_select_pipe['mass_s_1'] + $row_select_pipe['sm_1']);
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {
																													echo ($row_select_pipe['mass_s_2'] + $row_select_pipe['sm_2']);
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {
																													echo ($row_select_pipe['mass_s_3'] + $row_select_pipe['sm_3']);
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:12px;padding-top:12px;">Mass of container and<br>lid, M3</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_c_1'] != "" && $row_select_pipe['mass_c_1'] != null && $row_select_pipe['mass_c_1'] != "0") {
																													echo $row_select_pipe['mass_c_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_c_2'] != "" && $row_select_pipe['mass_c_2'] != null && $row_select_pipe['mass_c_2'] != "0") {
																													echo $row_select_pipe['mass_c_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_c_3'] != "" && $row_select_pipe['mass_c_3'] != null && $row_select_pipe['mass_c_3'] != "0") {
																													echo $row_select_pipe['mass_c_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Saturated surface dry<br>mass of the sample<br>+ container, M4</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_o_1'] != "" && $row_select_pipe['mass_o_1'] != null && $row_select_pipe['mass_o_1'] != "0") {
																													echo $row_select_pipe['mass_o_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_o_2'] != "" && $row_select_pipe['mass_o_2'] != null && $row_select_pipe['mass_o_2'] != "0") {
																													echo $row_select_pipe['mass_o_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_o_3'] != "" && $row_select_pipe['mass_o_3'] != null && $row_select_pipe['mass_o_3'] != "0") {
																													echo $row_select_pipe['mass_o_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:12px;padding-top:12px;">Dried mass of the<br>container with sample, M5</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_d_1'] != "" && $row_select_pipe['mass_d_1'] != null && $row_select_pipe['mass_d_1'] != "0") {
																													echo $row_select_pipe['mass_d_1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_d_2'] != "" && $row_select_pipe['mass_d_2'] != null && $row_select_pipe['mass_d_2'] != "0") {
																													echo $row_select_pipe['mass_d_2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_d_3'] != "" && $row_select_pipe['mass_d_3'] != null && $row_select_pipe['mass_d_3'] != "0") {
																													echo $row_select_pipe['mass_d_3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:18px;padding-top:18px;">Dry Density of Rock</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg/m&sup3;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != null && $row_select_pipe['den1'] != "0") {
																													echo $row_select_pipe['den1'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['den2'] != "" && $row_select_pipe['den2'] != null && $row_select_pipe['den2'] != "0") {
																													echo $row_select_pipe['den2'];
																												} else {
																													echo "-";
																												} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['den3'] != "" && $row_select_pipe['den3'] != null && $row_select_pipe['den3'] != "0") {
																													echo $row_select_pipe['den3'];
																												} else {
																													echo "-";
																												} ?></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:75%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
							<td style="width:25%;text-align:left;font-weight:bold; ">Checked By:-</td>
						</tr>

					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-bottom:20px;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;border-bottom:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:2/2</td>
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