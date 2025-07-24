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
		font-family: Book Antiqua;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Book Antiqua;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Book Antiqua;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Book Antiqua;
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
	$select_tiles_query = "select * from bitumin_span_mix WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
	}

	?>

	<br>
	<br>

	<page size="A4">

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td colspan="4" rowspan="4" style="height:50px;width:80px;border: 2px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td colspan="4" rowspan="4" style="font-size:16px;border: 2px solid black;">
					<center><b>MATTEST ENGINEERING <Br> SERVICES<br>
							<br>
							<br>(BITUMEN MIX)</b></center>
				</td>
				<td colspan="2" style="border: 2px solid black;"><b>Doc. No.</b></td>
				<td colspan="6" style="border: 2px solid black;"><b>F / 7.5 / 13</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="2" style="border: 2px solid black;"><b>Issue No.</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center;"><b>03</b></td>
				<td colspan="2" style="border: 2px solid black;"><b>Issue Date :</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center;"><b>01.10.2018</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="2" style="border: 2px solid black;"><b>Amend No.</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center"><b>00</b></td>
				<td colspan="2" style="border: 2px solid black;"><b>Amend Date :</b></td>
				<td colspan="2" style="border: 2px solid black;text-align:center"><b>-</b></td>
			</tr>
			<tr style="border: 2px solid black;">

				<td colspan="8" style="border: 2px solid black;"><b>Page No. 1 of 1</b></td>

			</tr>
		</table>

		<p class="test1" style="margin-left:5%;font-weight:bold;">Detail of Sample</p>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="5%">

			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="width:20%;"><b>Laboratory No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $job_no; ?></td>
				<td style="text-align:center;width:5%;"><b>3</b></td>
				<td style="width:20%;"><b>Date of start</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($start_date)); ?></td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>2</b></td>
				<td style="width:20%;"><b>Job No.</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
				<td style="text-align:center;width:5%;"><b>4</b></td>
				<td style="width:20%;"><b>Date of Complete</b></td>
				<td style="width:5%;"><b>:-</b></td>
				<td style="width:20%;"><?php echo date('d-m-Y', strtotime($end_date)); ?></td>

			</tr>


		</table>
		<br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 0px solid black;">
				<td colspan="2" style="border: 0px solid black;"><b>Test-01 Marshall Stability & Flow</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>ASTM D 6927</b></td>
			</tr>


			<tr style="border: 1px solid black;height:20px;font-weight:bold;">
				<td style="width:7%;border: 1px solid black;">
					<center>Sr<br>No.</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Sample No.</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Stability (kN)</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Flow (mm)</center>
				</td>


			</tr>

			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_11'] != "" && $row_select_pipe['ms_11'] != "0" && $row_select_pipe['ms_11'] != null) {
															echo $row_select_pipe['ms_11'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_21'] != "" && $row_select_pipe['ms_21'] != "0" && $row_select_pipe['ms_21'] != null) {
															echo $row_select_pipe['ms_21'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_31'] != "" && $row_select_pipe['ms_31'] != "0" && $row_select_pipe['ms_31'] != null) {
															echo $row_select_pipe['ms_31'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_12'] != "" && $row_select_pipe['ms_12'] != "0" && $row_select_pipe['ms_12'] != null) {
															echo $row_select_pipe['ms_12'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_22'] != "" && $row_select_pipe['ms_22'] != "0" && $row_select_pipe['ms_22'] != null) {
															echo $row_select_pipe['ms_22'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_32'] != "" && $row_select_pipe['ms_32'] != "0" && $row_select_pipe['ms_32'] != null) {
															echo $row_select_pipe['ms_32'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_13'] != "" && $row_select_pipe['ms_13'] != "0" && $row_select_pipe['ms_13'] != null) {
															echo $row_select_pipe['ms_13'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_23'] != "" && $row_select_pipe['ms_23'] != "0" && $row_select_pipe['ms_23'] != null) {
															echo $row_select_pipe['ms_23'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['ms_33'] != "" && $row_select_pipe['ms_33'] != "0" && $row_select_pipe['ms_33'] != null) {
															echo $row_select_pipe['ms_33'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;text-align:right" colspan="2">Average&nbsp;</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['avg_stabilty'] != "" && $row_select_pipe['avg_stabilty'] != "0" && $row_select_pipe['avg_stabilty'] != null) {
															echo $row_select_pipe['avg_stabilty'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['avg_flow'] != "" && $row_select_pipe['avg_flow'] != "0" && $row_select_pipe['avg_flow'] != null) {
															echo $row_select_pipe['avg_flow'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>

		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="4" style="border: 0px solid black;"><b>Test-02 Density (CDM) Test Obersvation Sheet</b></td>
				<td colspan="3" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>ASTM D 2726</b></td>
			</tr>
			<tr style="height:60px;">
				<td style="width:7%;border: 1px solid black;font-weight:bold;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;font-weight:bold;">
					<center><b>Sample No.</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;font-weight:bold;">
					<center><b>Weight in Air<Br>(gm)<Br>(A)</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;font-weight:bold;">
					<center><b>Weight in Water<Br>(gm)<Br>(B)</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;font-weight:bold;">
					<center><b>S.S.D.<br>Weight (gm)<Br>(C)</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;font-weight:bold;">
					<center><b>Volume in CC<Br>D=(C-B)</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;font-weight:bold;">
					<center><b>Density in gm/cc<Br>E=A/D</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s1'] != "" && $row_select_pipe['s1'] != "0" && $row_select_pipe['s1'] != null) {
								echo $row_select_pipe['s1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['a1'] != "" && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {
								echo $row_select_pipe['a1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b1'] != "" && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {
								echo $row_select_pipe['b1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['c1'] != "" && $row_select_pipe['c1'] != "0" && $row_select_pipe['c1'] != null) {
								echo $row_select_pipe['c1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['d1'] != "" && $row_select_pipe['d1'] != "0" && $row_select_pipe['d1'] != null) {
								echo $row_select_pipe['d1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['e1'] != "" && $row_select_pipe['e1'] != "0" && $row_select_pipe['e1'] != null) {
								echo $row_select_pipe['e1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>


			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s2'] != "" && $row_select_pipe['s2'] != "0" && $row_select_pipe['s2'] != null) {
								echo $row_select_pipe['s2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['a2'] != "" && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {
								echo $row_select_pipe['a2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b2'] != "" && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {
								echo $row_select_pipe['b2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['c2'] != "" && $row_select_pipe['c2'] != "0" && $row_select_pipe['c2'] != null) {
								echo $row_select_pipe['c2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['d2'] != "" && $row_select_pipe['d2'] != "0" && $row_select_pipe['d2'] != null) {
								echo $row_select_pipe['d2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['e2'] != "" && $row_select_pipe['e2'] != "0" && $row_select_pipe['e2'] != null) {
								echo $row_select_pipe['e2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>


			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s3'] != "" && $row_select_pipe['s3'] != "0" && $row_select_pipe['s3'] != null) {
								echo $row_select_pipe['s3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['a3'] != "" && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {
								echo $row_select_pipe['a3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b3'] != "" && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {
								echo $row_select_pipe['b3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['c3'] != "" && $row_select_pipe['c3'] != "0" && $row_select_pipe['c3'] != null) {
								echo $row_select_pipe['c3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['d3'] != "" && $row_select_pipe['d3'] != "0" && $row_select_pipe['d3'] != null) {
								echo $row_select_pipe['d3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['e3'] != "" && $row_select_pipe['e3'] != "0" && $row_select_pipe['e3'] != null) {
								echo $row_select_pipe['e3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>


			</tr>

			<tr>
				<td style="border: 1px solid black;" align="right" colspan="6"><b>Average</b></td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) {
								echo $row_select_pipe['avg_density'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>


		</table>
		<br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="2" style="border: 0px solid black;"><b>Test-03 Binder Content</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>ASTM D 2172</b></td>
			</tr>


			<tr>
				<td style="width:7%;border: 1px solid black;">
					<center><b>S.N.</b></center>
				</td>
				<td style="width:63%;border: 1px solid black;">
					<center><b>Description</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="width:15%;border: 1px solid black;">
					<center><b>2</b></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Bowel in gm</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b11'] != "" && $row_select_pipe['b11'] != "0" && $row_select_pipe['b11'] != null) {
								echo $row_select_pipe['b11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b12'] != "" && $row_select_pipe['b12'] != "0" && $row_select_pipe['b12'] != null) {
								echo $row_select_pipe['b12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Filter Paper before extraction in gm (A)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b21'] != "" && $row_select_pipe['b21'] != "0" && $row_select_pipe['b21'] != null) {
								echo $row_select_pipe['b21'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b22'] != "" && $row_select_pipe['b22'] != "0" && $row_select_pipe['b22'] != null) {
								echo $row_select_pipe['b22'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Sample before extraction in gm (B)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b31'] != "" && $row_select_pipe['b31'] != "0" && $row_select_pipe['b31'] != null) {
								echo $row_select_pipe['b31'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b32'] != "" && $row_select_pipe['b32'] != "0" && $row_select_pipe['b32'] != null) {
								echo $row_select_pipe['b32'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>4</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Filter Paper after extraction in gm (C)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b41'] != "" && $row_select_pipe['b41'] != "0" && $row_select_pipe['b41'] != null) {
								echo $row_select_pipe['b41'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b42'] != "" && $row_select_pipe['b42'] != "0" && $row_select_pipe['b42'] != null) {
								echo $row_select_pipe['b42'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>5</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Sample after extraction in gm (D)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b51'] != "" && $row_select_pipe['b51'] != "0" && $row_select_pipe['b51'] != null) {
								echo $row_select_pipe['b51'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b52'] != "" && $row_select_pipe['b52'] != "0" && $row_select_pipe['b52'] != null) {
								echo $row_select_pipe['b52'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>6</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of Aggregate in filter paper E =(C)-(A)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b61'] != "" && $row_select_pipe['b61'] != "0" && $row_select_pipe['b61'] != null) {
								echo $row_select_pipe['b61'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b62'] != "" && $row_select_pipe['b62'] != "0" && $row_select_pipe['b62'] != null) {
								echo $row_select_pipe['b62'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>7</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Total Weight of aggregate after extraction in gm F =(D)+(E)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b71'] != "" && $row_select_pipe['b71'] != "0" && $row_select_pipe['b71'] != null) {
								echo $row_select_pipe['b71'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b72'] != "" && $row_select_pipe['b72'] != "0" && $row_select_pipe['b72'] != null) {
								echo $row_select_pipe['b72'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>8</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Weight of bitumen in gm G = (B) - (F)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b81'] != "" && $row_select_pipe['b81'] != "0" && $row_select_pipe['b81'] != null) {
								echo $row_select_pipe['b81'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['b82'] != "" && $row_select_pipe['b82'] != "0" && $row_select_pipe['b82'] != null) {
								echo $row_select_pipe['b82'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>9</b></center>
				</td>
				<td style="border: 1px solid black;"><b>% of bitumen (G/B)x100</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['per_bin1'] != "" && $row_select_pipe['per_bin1'] != "0" && $row_select_pipe['per_bin1'] != null) {
								echo $row_select_pipe['per_bin1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['per_bin2'] != "" && $row_select_pipe['per_bin2'] != "0" && $row_select_pipe['per_bin2'] != null) {
								echo $row_select_pipe['per_bin2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>10</b></center>
				</td>
				<td style="border: 1px solid black;"><b>Average Binder Content</b></td>
				<td colspan="2" style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_bin'] != "" && $row_select_pipe['avg_bin'] != "0" && $row_select_pipe['avg_bin'] != null) {
								echo $row_select_pipe['avg_bin'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>


		</table>

		<table align="center" width="90%" class="test1" style="" height="Auto">
			<tr>
				<td colspan="6" style="border: 0px solid black;height:20px"><b>&nbsp;</b></td>

			</tr>
			<tr style="border-bottom: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>Tested By</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>Checked By</b></td>

			</tr>
			<tr style="border-bottom: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b></b></td>
				<td colspan="3" style="border: 0px solid black;"><b></b></td>

			</tr>
			<tr style="border-bottom: 0px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>

			</tr>
			<tr style="border-bottom: 0px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>&nbsp;</b></td>

			</tr>
			<tr style="border: 2px solid black;">
				<td colspan="3" style="border: 2px solid black;"><b>Prepared & Issued by : QM</b></td>
				<td colspan="3" style="border: 2px solid black;"><b>Reviewed & Approved by : CEO</b></td>

			</tr>
		</table>

	</page>

</body>

</html>


<script type="text/javascript">


</script>
