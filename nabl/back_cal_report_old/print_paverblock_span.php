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
	$select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$sample_sent_by = $row_select['sample_sent_by'];
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
		$paver_shape = $row_select4['paver_shape'];
		$paver_age = $row_select4['paver_age'];
		$paver_color = $row_select4['paver_color'];
		$paver_thickness = $row_select4['paver_thickness'];
		$paver_grade = $row_select4['paver_grade'];
	}

	$pagecnt = 1;
	$totalcnt = 1;
	if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != "0" && $row_select_pipe['avgv'] != null) {
		$totalcnt++;
	}

	?>

	<br>


	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/O/OS/001</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 05/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : 1</td>
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

							<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULATION SHEET FOR TEST ON PAVER BLOCK</td>
						</tr>

					</table>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
							<td style="border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Sample sent by</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php if ($sample_sent_by == 1) {
																												echo 'Agency';
																											} else if ($sample_sent_by == 0) {
																												echo 'Client';
																											} ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Quantity of sample</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['txt_qty']; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Identification mark</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; </td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Grade</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $paver_grade; ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Date of starting test</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="">

							<td style="border-top:1px solid;width:10%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
							<td style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:10%;border-right:1px solid; text-align:center;font-weight:bold; ">1</td>
							<td style="width:90%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Compressive Strength, IS : 15658 - 2006</td>

						</tr>

					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:13px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:30px;">

						<tr style="">

							<td style="width:18%;text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">Sr No.</td>
							<td style="border-left:1px solid;width:12%; text-align:center;font-weight:bold; ">1</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">2</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">3</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">4</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">5</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">6</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">7</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">8</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Lab ID</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['sm1'] != "" && $row_select_pipe['sm1'] != "0" && $row_select_pipe['sm1'] != null) {
																														echo $row_select_pipe['sm1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['sm2'] != "" && $row_select_pipe['sm2'] != "0" && $row_select_pipe['sm2'] != null) {
																														echo $row_select_pipe['sm2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sm3'] != "" && $row_select_pipe['sm3'] != "0" && $row_select_pipe['sm3'] != null) {
																														echo $row_select_pipe['sm3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sm4'] != "" && $row_select_pipe['sm4'] != "0" && $row_select_pipe['sm4'] != null) {
																														echo $row_select_pipe['sm4'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sm5'] != "" && $row_select_pipe['sm5'] != "0" && $row_select_pipe['sm5'] != null) {
																														echo $row_select_pipe['sm5'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sm6'] != "" && $row_select_pipe['sm6'] != "0" && $row_select_pipe['sm6'] != null) {
																														echo $row_select_pipe['sm6'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sm7'] != "" && $row_select_pipe['sm7'] != "0" && $row_select_pipe['sm7'] != null) {
																														echo $row_select_pipe['sm7'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['sm8'] != "" && $row_select_pipe['sm8'] != "0" && $row_select_pipe['sm8'] != null) {
																														echo $row_select_pipe['sm8'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Weight in gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['m1'] != "" && $row_select_pipe['m1'] != "0" && $row_select_pipe['m1'] != null) {
																														echo $row_select_pipe['m1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['m2'] != "" && $row_select_pipe['m2'] != "0" && $row_select_pipe['m2'] != null) {
																														echo $row_select_pipe['m2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['m3'] != "" && $row_select_pipe['m3'] != "0" && $row_select_pipe['m3'] != null) {
																														echo $row_select_pipe['m3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['m4'] != "" && $row_select_pipe['m4'] != "0" && $row_select_pipe['m4'] != null) {
																														echo $row_select_pipe['m4'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['m5'] != "" && $row_select_pipe['m5'] != "0" && $row_select_pipe['m5'] != null) {
																														echo $row_select_pipe['m5'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['m6'] != "" && $row_select_pipe['m6'] != "0" && $row_select_pipe['m6'] != null) {
																														echo $row_select_pipe['m6'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['m7'] != "" && $row_select_pipe['m7'] != "0" && $row_select_pipe['m7'] != null) {
																														echo $row_select_pipe['m7'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['m8'] != "" && $row_select_pipe['m8'] != "0" && $row_select_pipe['m8'] != null) {
																														echo $row_select_pipe['m8'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Length in mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['clen1'] != "" && $row_select_pipe['clen1'] != "0" && $row_select_pipe['clen1'] != null) {
																														echo $row_select_pipe['clen1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['clen2'] != "" && $row_select_pipe['clen2'] != "0" && $row_select_pipe['clen2'] != null) {
																														echo $row_select_pipe['clen2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['clen3'] != "" && $row_select_pipe['clen3'] != "0" && $row_select_pipe['clen3'] != null) {
																														echo $row_select_pipe['clen3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['clen4'] != "" && $row_select_pipe['clen4'] != "0" && $row_select_pipe['clen4'] != null) {
																														echo $row_select_pipe['clen4'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['clen5'] != "" && $row_select_pipe['clen5'] != "0" && $row_select_pipe['clen5'] != null) {
																														echo $row_select_pipe['clen5'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['clen6'] != "" && $row_select_pipe['clen6'] != "0" && $row_select_pipe['clen6'] != null) {
																														echo $row_select_pipe['clen6'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['clen7'] != "" && $row_select_pipe['clen7'] != "0" && $row_select_pipe['clen7'] != null) {
																														echo $row_select_pipe['clen7'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['clen8'] != "" && $row_select_pipe['clen8'] != "0" && $row_select_pipe['clen8'] != null) {
																														echo $row_select_pipe['clen8'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Width In mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['cwid1'] != "" && $row_select_pipe['cwid1'] != "0" && $row_select_pipe['cwid1'] != null) {
																														echo $row_select_pipe['cwid1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['cwid2'] != "" && $row_select_pipe['cwid2'] != "0" && $row_select_pipe['cwid2'] != null) {
																														echo $row_select_pipe['cwid2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['cwid3'] != "" && $row_select_pipe['cwid3'] != "0" && $row_select_pipe['cwid3'] != null) {
																														echo $row_select_pipe['cwid3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['cwid4'] != "" && $row_select_pipe['cwid4'] != "0" && $row_select_pipe['cwid4'] != null) {
																														echo $row_select_pipe['cwid4'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['cwid5'] != "" && $row_select_pipe['cwid5'] != "0" && $row_select_pipe['cwid5'] != null) {
																														echo $row_select_pipe['cwid5'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['cwid6'] != "" && $row_select_pipe['cwid6'] != "0" && $row_select_pipe['cwid6'] != null) {
																														echo $row_select_pipe['cwid6'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['cwid7'] != "" && $row_select_pipe['cwid7'] != "0" && $row_select_pipe['cwid7'] != null) {
																														echo $row_select_pipe['cwid7'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['cwid8'] != "" && $row_select_pipe['cwid8'] != "0" && $row_select_pipe['cwid8'] != null) {
																														echo $row_select_pipe['cwid8'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Thickness In mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['thick_1'] != "" && $row_select_pipe['thick_1'] != "0" && $row_select_pipe['thick_1'] != null) {
																														echo $row_select_pipe['thick_1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['thick_2'] != "" && $row_select_pipe['thick_2'] != "0" && $row_select_pipe['thick_2'] != null) {
																														echo $row_select_pipe['thick_2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['thick_3'] != "" && $row_select_pipe['thick_3'] != "0" && $row_select_pipe['thick_3'] != null) {
																														echo $row_select_pipe['thick_3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['thick_4'] != "" && $row_select_pipe['thick_4'] != "0" && $row_select_pipe['thick_4'] != null) {
																														echo $row_select_pipe['thick_4'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['thick_5'] != "" && $row_select_pipe['thick_5'] != "0" && $row_select_pipe['thick_5'] != null) {
																														echo $row_select_pipe['thick_5'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['thick_6'] != "" && $row_select_pipe['thick_6'] != "0" && $row_select_pipe['thick_6'] != null) {
																														echo $row_select_pipe['thick_6'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['thick_7'] != "" && $row_select_pipe['thick_7'] != "0" && $row_select_pipe['thick_7'] != null) {
																														echo $row_select_pipe['thick_7'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['thick_8'] != "" && $row_select_pipe['thick_8'] != "0" && $row_select_pipe['thick_8'] != null) {
																														echo $row_select_pipe['thick_8'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Area in mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) {
																														echo $row_select_pipe['area_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) {
																														echo $row_select_pipe['area_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) {
																														echo $row_select_pipe['area_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) {
																														echo $row_select_pipe['area_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) {
																														echo $row_select_pipe['area_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) {
																														echo $row_select_pipe['area_6'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) {
																														echo $row_select_pipe['area_7'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) {
																														echo $row_select_pipe['area_8'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Load in KN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																														echo $row_select_pipe['load_1'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																														echo $row_select_pipe['load_2'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																														echo $row_select_pipe['load_3'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
																														echo $row_select_pipe['load_4'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
																														echo $row_select_pipe['load_5'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
																														echo $row_select_pipe['load_6'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
																														echo $row_select_pipe['load_7'];
																													} else {
																														echo " <br>";
																													}  ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
																														echo $row_select_pipe['load_8'];
																													} else {
																														echo " <br>";
																													}  ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Strength in N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																														echo $row_select_pipe['com_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																														echo $row_select_pipe['com_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																														echo $row_select_pipe['com_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																														echo $row_select_pipe['com_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																														echo $row_select_pipe['com_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
																														echo $row_select_pipe['com_6'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
																														echo $row_select_pipe['com_7'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
																														echo $row_select_pipe['com_8'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">After Corrected<br>Strength in N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null) {
																														echo $row_select_pipe['corr_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null) {
																														echo $row_select_pipe['corr_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null) {
																														echo $row_select_pipe['corr_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null) {
																														echo $row_select_pipe['corr_4'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null) {
																														echo $row_select_pipe['corr_5'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null) {
																														echo $row_select_pipe['corr_6'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null) {
																														echo $row_select_pipe['corr_7'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null) {
																														echo $row_select_pipe['corr_8'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:18%;text-align:center;padding-bottom:2px;padding-top:2px;   ">Average Compressive<br>Strength in N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:12%;text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%; text-align:center; "><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																														echo $row_select_pipe['avg_corr'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:18%;border-right:1px solid; text-align:center;font-weight:bold; ">2</td>
							<td style="width:82%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Water Absorption, IS : 15658 - 2006</td>

						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;">

						<tr style="">
							<td style="width:5%;text-align:center;font-weight:bold;  ">Sr.<br>No</td>
							<td style="border-left:1px solid;width:13%; text-align:center;font-weight:bold; ">Lab ID</td>
							<td style="border-left:1px solid;width:16%; text-align:center;font-weight:bold; ">Oven Dry<br> Weight in (g)<br>W1</td>
							<td style="border-left:1px solid;width:20; text-align:center;font-weight:bold; ">S. S. Dry<br>weight in g.<br>W2</td>
							<td style="border-left:1px solid;width:20; text-align:center;font-weight:bold; ">Difference<br>W<sub>2</sub>-W<sub>1</sub> in g</td>
							<td style="border-left:1px solid;width:26%; text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Water Absorption in<br>%<br>((𝑊2−𝑊1))/𝑊1 𝑋100</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;text-align:center;padding-bottom:5px;padding-top:5px;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:13%; text-align:center; ">PB-1</td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
																														echo $row_select_pipe['wtr_w2_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center; "><?php if ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) {
																														echo $row_select_pipe['wtr_w1_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center; "><?php
																													$a = $row_select_pipe['wtr_w1_1'];
																													$b = $row_select_pipe['wtr_w2_1'];
																													echo $ans = ($a - $b); ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:26%; text-align:center; "><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
																														echo $row_select_pipe['wtr_1'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;text-align:center;padding-bottom:5px;padding-top:5px;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:13%; text-align:center; ">PB-2</td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																														echo $row_select_pipe['wtr_w2_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center; "><?php if ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) {
																														echo $row_select_pipe['wtr_w1_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center; "><?php
																													$a = $row_select_pipe['wtr_w1_2'];
																													$b = $row_select_pipe['wtr_w2_2'];
																													echo $ans = ($a - $b); ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:26%; text-align:center; "><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
																														echo $row_select_pipe['wtr_2'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:5%;text-align:center;padding-bottom:5px;padding-top:5px;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:13%; text-align:center; ">PB-3</td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
																														echo $row_select_pipe['wtr_w2_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center; "><?php if ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) {
																														echo $row_select_pipe['wtr_w1_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:20%; text-align:center; "><?php
																													$a = $row_select_pipe['wtr_w1_3'];
																													$b = $row_select_pipe['wtr_w2_3'];
																													echo $ans = ($a - $b); ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:26%; text-align:center; "><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
																														echo $row_select_pipe['wtr_3'];
																													} else {
																														echo " <br>";
																													} ?></td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: margin-bottom:20px;">

						<tr style="">
							<td style="width:72%;text-align:center;font-weight:bold;  "></td>
							<td style="width:10%;text-align:right;font-weight:bold;padding-bottom:5px;padding-top:5px;  ">Average &nbsp;&nbsp;&nbsp;</td>
							<td style="border-left:1px solid;border-bottom:1px solid;width:18%; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; "><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
																																												echo $row_select_pipe['avg_wtr'];
																																											} else {
																																												echo " <br>";
																																											} ?></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By</td>
							<td style="width:20%;text-align:left;font-weight:bold; ">Checked By</td>
						</tr>

					</table><br>

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
		</table>
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
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Observation of Paver Block</b></center></td>					
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
			
			<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="5%">
				
				<tr style="border: 1px solid black;">
					<td style="text-align:center;width:5%;"><b>1</b></td>
					<td style="width:20%;"><b>Laboratory No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $job_no; ?></td>
					<td style="text-align:center;width:5%;"><b>3</b></td>
					<td style="width:20%;"><b>Date of start</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="text-align:center;width:5%;"><b>2</b></td>
					<td style="width:20%;"><b>Job No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
					<td style="text-align:center;width:5%;"><b>4</b></td>
					<td style="width:20%;"><b>Date of Complete</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
					
				</tr>
					
			
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="35%">
				<tr style="border: 0px solid black;">
					<td colspan="4" style="border: 0px solid black;"><b>Test - 01 Compressive Strength</b></td>
					<td colspan="3" style="text-align:left;border: 0px solid black;"><b>IS 15658:2021</b></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td colspan="4" style="border: 0px solid black;"><b> </b></td>
					<td colspan="3" style="text-align:left;border: 0px solid black;"><b>&nbsp;</b></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td colspan="4" style="border: 0px solid black;"><b>Thickness of Block in mm&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $paver_thickness; ?></td>
					<td colspan="3" style="text-align:left;border: 0px solid black;"><b>Correction of Block&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $row_select_pipe['factor']; ?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td colspan="4" style="border: 0px solid black;"><b>Grade of Block&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:-&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?php echo $paver_grade; ?></td>
					<td colspan="3" style="text-align:left;border: 0px solid black;"></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td colspan="4" style="border: 0px solid black;"><b> </b></td>
					<td colspan="3" style="text-align:left;border: 0px solid black;"><b>&nbsp;</b></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;font-weight:bold;"><center>Sr.<br>No.</center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Sample Mark</center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Weight of Standard<br> Card Board<br>(100 mm X 200 mm) (gm)</center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Weight of Sample<br>Card Board (gm)</center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Area (mm<sup>2</sup>)</center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Maximum <br>Load in kN</center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Compressive<br>Strength N/mm<sup>2</sup></center></td>
					<td  style="border: 1px solid black;font-weight:bold;"><center>Correction<br>Compressive<br>Strength </center></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">1</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm1'] != "" && $row_select_pipe['sm1'] != "0" && $row_select_pipe['sm1'] != null) {
																echo $row_select_pipe['sm1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_1'] != "" && $row_select_pipe['lab_1'] != "0" && $row_select_pipe['lab_1'] != null) {
																echo $row_select_pipe['lab_1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m1'] != "" && $row_select_pipe['m1'] != "0" && $row_select_pipe['m1'] != null) {
																echo $row_select_pipe['m1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) {
																echo $row_select_pipe['area_1'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																echo $row_select_pipe['load_1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																echo $row_select_pipe['com_1'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null) {
																echo $row_select_pipe['corr_1'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">2</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm2'] != "" && $row_select_pipe['sm2'] != "0" && $row_select_pipe['sm2'] != null) {
																echo $row_select_pipe['sm2'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_2'] != "" && $row_select_pipe['lab_2'] != "0" && $row_select_pipe['lab_2'] != null) {
																echo $row_select_pipe['lab_2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m2'] != "" && $row_select_pipe['m2'] != "0" && $row_select_pipe['m2'] != null) {
																echo $row_select_pipe['m2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) {
																echo $row_select_pipe['area_2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																echo $row_select_pipe['load_2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																echo $row_select_pipe['com_2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null) {
																echo $row_select_pipe['corr_2'];
															} else {
																echo " <br>";
															}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">3</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm3'] != "" && $row_select_pipe['sm3'] != "0" && $row_select_pipe['sm3'] != null) {
																echo $row_select_pipe['sm3'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_3'] != "" && $row_select_pipe['lab_3'] != "0" && $row_select_pipe['lab_3'] != null) {
																echo $row_select_pipe['lab_3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m3'] != "" && $row_select_pipe['m3'] != "0" && $row_select_pipe['m3'] != null) {
																echo $row_select_pipe['m3'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) {
																echo $row_select_pipe['area_3'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																echo $row_select_pipe['load_3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																echo $row_select_pipe['com_3'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null) {
																echo $row_select_pipe['corr_3'];
															} else {
																echo " <br>";
															}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">4</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm4'] != "" && $row_select_pipe['sm4'] != "0" && $row_select_pipe['sm4'] != null) {
																echo $row_select_pipe['sm4'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_4'] != "" && $row_select_pipe['lab_4'] != "0" && $row_select_pipe['lab_4'] != null) {
																echo $row_select_pipe['lab_4'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m4'] != "" && $row_select_pipe['m4'] != "0" && $row_select_pipe['m4'] != null) {
																echo $row_select_pipe['m4'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) {
																echo $row_select_pipe['area_4'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
																echo $row_select_pipe['load_4'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																echo $row_select_pipe['com_4'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null) {
																echo $row_select_pipe['corr_4'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm5'] != "" && $row_select_pipe['sm5'] != "0" && $row_select_pipe['sm5'] != null) {
																echo $row_select_pipe['sm5'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_5'] != "" && $row_select_pipe['lab_5'] != "0" && $row_select_pipe['lab_5'] != null) {
																echo $row_select_pipe['lab_5'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m5'] != "" && $row_select_pipe['m5'] != "0" && $row_select_pipe['m5'] != null) {
																echo $row_select_pipe['m5'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) {
																echo $row_select_pipe['area_5'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
																echo $row_select_pipe['load_5'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																echo $row_select_pipe['com_5'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null) {
																echo $row_select_pipe['corr_5'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">6</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm6'] != "" && $row_select_pipe['sm6'] != "0" && $row_select_pipe['sm6'] != null) {
																echo $row_select_pipe['sm6'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_6'] != "" && $row_select_pipe['lab_6'] != "0" && $row_select_pipe['lab_6'] != null) {
																echo $row_select_pipe['lab_6'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m6'] != "" && $row_select_pipe['m6'] != "0" && $row_select_pipe['m6'] != null) {
																echo $row_select_pipe['m6'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) {
																echo $row_select_pipe['area_6'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
																echo $row_select_pipe['load_6'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
																echo $row_select_pipe['com_6'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null) {
																echo $row_select_pipe['corr_6'];
															} else {
																echo " <br>";
															}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">7</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm7'] != "" && $row_select_pipe['sm7'] != "0" && $row_select_pipe['sm7'] != null) {
																echo $row_select_pipe['sm7'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_7'] != "" && $row_select_pipe['lab_7'] != "0" && $row_select_pipe['lab_7'] != null) {
																echo $row_select_pipe['lab_7'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m7'] != "" && $row_select_pipe['m7'] != "0" && $row_select_pipe['m7'] != null) {
																echo $row_select_pipe['m7'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) {
																echo $row_select_pipe['area_7'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
																echo $row_select_pipe['load_7'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
																echo $row_select_pipe['com_7'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null) {
																echo $row_select_pipe['corr_7'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">8</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sm8'] != "" && $row_select_pipe['sm8'] != "0" && $row_select_pipe['sm8'] != null) {
																echo $row_select_pipe['sm8'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['lab_8'] != "" && $row_select_pipe['lab_8'] != "0" && $row_select_pipe['lab_8'] != null) {
																echo $row_select_pipe['lab_8'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['m8'] != "" && $row_select_pipe['m8'] != "0" && $row_select_pipe['m8'] != null) {
																echo $row_select_pipe['m8'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) {
																echo $row_select_pipe['area_8'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
																echo $row_select_pipe['load_8'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
																echo $row_select_pipe['com_8'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null) {
																echo $row_select_pipe['corr_8'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td colspan="7" style="border: 1px solid black;text-align:right">Average</td>
					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) {
																echo $row_select_pipe['avg_corr'];
															} else {
																echo " <br>";
															} ?></td>
					
				</tr>
				
				
				<br>
				<br>
			</table>
				<br>	
				<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="17%">
					<tr style="border: 1px solid black;">
						<td colspan="3" style="border: 0px solid black;"><b>Test -02 Water Absorption</b></td>
						<td colspan="2" style="text-align:center;border: 0px solid black;padding-right:20px;"><b>IS 15658:2021</b></td>
					</tr>
					
					<tr>
						<td  style="border: 1px solid black;font-weight:bold;width:10%;"><center><b>Sr.No.</b></center></td>
						<td style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of sample after saturation(gm) (W1)</b></center></td>
						<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of Oven dry sample (gm) (W2)</b></center></td>						
						<td   style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Difference W<sub>1</sub> - W<sub>2</sub> in G</b></center></td>
						<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Water Absorption (%) (W1 – W2) x 100/W2</b></center></td>						
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>1</b></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) {
																			echo $row_select_pipe['wtr_w1_1'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) {
																			echo $row_select_pipe['wtr_w2_1'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
												
						<td  style="border: 1px solid black;"><center><?php
																		$a = $row_select_pipe['wtr_w1_1'];
																		$b = $row_select_pipe['wtr_w2_1'];
																		echo $ans = ($a - $b); ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) {
																			echo $row_select_pipe['wtr_1'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
												
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>2</b></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) {
																			echo $row_select_pipe['wtr_w1_2'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) {
																			echo $row_select_pipe['wtr_w2_2'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
												
						<td  style="border: 1px solid black;"><center><?php
																		$a1 = $row_select_pipe['wtr_w1_2'];
																		$b1 = $row_select_pipe['wtr_w2_2'];
																		echo $ans1 = ($a1 - $b1); ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) {
																			echo $row_select_pipe['wtr_2'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
												
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>3</b></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) {
																			echo $row_select_pipe['wtr_w1_3'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) {
																			echo $row_select_pipe['wtr_w2_3'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
												
						<td  style="border: 1px solid black;"><center><?php
																		$a2 = $row_select_pipe['wtr_w1_3'];
																		$b2 = $row_select_pipe['wtr_w2_3'];
																		echo $ans2 = ($a2 - $b2); ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) {
																			echo $row_select_pipe['wtr_3'];
																		} else {
																			echo " <br>";
																		} ?></center></td>
												
						
					</tr>					
					<tr>
						<td style="border: 1px solid black;" align="right" colspan="4"><b>Average</b></td>
											
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
																			echo $row_select_pipe['avg_wtr'];
																		} else {
																			echo " <br>";
																		} ?></center></td>	
						
					</tr>
				
					
				</table>
				<br>
			
				
					
					
					<?php
					/*if($row_select_pipe['avgv']!="" && $row_select_pipe['avgv']!="0" && $row_select_pipe['avgv']!=null)
					{
						$pagecnt++;*/
					?>
				<div class="pagebreak"> </div>
		
				<br>
				<br>
				
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
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Observation of Paver Block</b></center></td>					
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
			<p class="test1" style="margin-left:5%;">Detail of Sample</p>
			
			<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="5%">
				
				<tr style="border: 1px solid black;">
					<td style="text-align:center;width:5%;"><b>1</b></td>
					<td style="width:20%;"><b>Job No.</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $job_no; ?></td>
					<td style="text-align:center;width:5%;"><b>3</b></td>
					<td style="width:20%;"><b>Date of start</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td style="text-align:center;width:5%;"><b>2</b></td>
					<td style="width:20%;"><b>Laboratory</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td style="width:20%;"><?php echo $row_select_pipe['lab_no']; ?></td>
					<td style="text-align:center;width:5%;"><b>4</b></td>
					<td style="width:20%;"><b>Date of Complete</b></td>
					<td style="width:5%;"><b>:-</b></td>
					<td><?php echo date('d - m - Y', strtotime($start_date . ' + 29 days')); ?></td>
					
				</tr>
					
			
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="Auto">
						<tr>
							<td colspan="3" style="border: 0px solid black;text-align:left;"><b>Test-3  Abrasion Test</b></td>
						
							<td colspan="3" style="text-align:center;border: 0px solid black;padding-right:20px;"><b>IS 15658:2021</b></td>
1
						</tr>
						<tr style="border: 0px solid black;">
							<td style="border: 0px solid black;width:20%;"><b>Thickness of Block in mm</b></td>
							<td style="border: 0px solid black;width:1%;"><b>:-</b></td>							
							<td colspan="3" style="text-align:left;border: 0px solid black;width:77%;"><?php echo $paver_thickness; ?></td>
							<td  style="text-align:left;border: 0px solid black;width:2%;"></td>
						</tr>
						<tr style="border: 0px solid black;">
							<td style="border: 0px solid black;"><b>Grade of Block</b></td>
							<td style="border: 0px solid black;"><b>:-</b></td>							
							<td style="border: 0px solid black;"><?php echo $paver_grade; ?></td>							
							<td colspan="3" style="text-align:left;border: 0px solid black;"></td>
						</tr>
						<tr>
						<td colspan="6">
							<table align="center" width="30%" class="test1" height="Auto">
								
								<tr style="border: 0px solid black;">
									<td style="border: 0px solid black;"><b></b></td>
									<td style="border: 0px solid black;"><b></b></td>							
									<td style="border: 0px solid black;"></td>							
									<td colspan="3" style="text-align:center;border: 0px solid black;">&Delta;m</td>
									<td style="border: 0px solid black;"></td>							
									<td style="border: 0px solid black;"></td>							
								</tr>
								<tr style="border: 0px solid black;">
									<td style="border: 0px solid black;"><b></b></td>
									<td style="border: 0px solid black;"><b>&Delta;V</b></td>							
									<td style="border: 0px solid black;">=</td>							
									<td colspan="3" style="text-align:center;border: 0px solid black;"><HR></td>
									<td style="border: 0px solid black;"></td>							
									<td style="border: 0px solid black;"></td>							
								</tr>
								<tr style="border: 0px solid black;">
									<td style="border: 0px solid black;"><b></b></td>
									<td style="border: 0px solid black;"><b></b></td>							
									<td style="border: 0px solid black;"></td>							
									<td colspan="3" style="text-align:center;border: 0px solid black;">PR</td>
									<td style="border: 0px solid black;"></td>							
									<td style="border: 0px solid black;"></td>							
								</tr>
							</table>
							</td>
						</td>
						
					</table>
					<table align="center" width="90%"  class="test1" style="height:Auto;width:90%;" >
									<tr style="text-align:center;">
										<td colspan="9" style="border:1px solid black;width:50%;"><b>Dry Abrasion Resistance, mm <sup>3</sup> per 5000 mm <sup>2</sup></b></td>
										<td colspan="9" style="border:1px solid black;width:50%;"><b>Wet Abrasion Resistance, mm<sup>3</sup> per 5000 mm <sup>2</sup></b></td>																									
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;width:5.5%;"><b>Sr. No.</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Sample Mark</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>L</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>W</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Input Weight, gm</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Output Weight, gm</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>&#916;m</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>PR</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>&#916;V</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Sr. No.</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Sample Mark</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>L</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>W</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Input Weight, gm</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>Output Weight, gm</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>&#916;m</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>PR</b></td>
										<td  style="border:1px solid black;width:5.5%;"><b>&#916;V</b></td>
									</tr>
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm9'] != "" && $row_select_pipe['sm9'] != null && $row_select_pipe['sm9'] != "0") {
																				echo $row_select_pipe['sm9'];
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != null && $row_select_pipe['l1'] != "0") {
																				echo number_format($row_select_pipe['l1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['w1'] != "" && $row_select_pipe['w1'] != null && $row_select_pipe['w1'] != "0") {
																				echo number_format($row_select_pipe['w1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['im1'] != "" && $row_select_pipe['im1'] != null && $row_select_pipe['im1'] != "0") {
																				echo number_format($row_select_pipe['im1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['om1'] != "" && $row_select_pipe['om1'] != null && $row_select_pipe['om1'] != "0") {
																				echo number_format($row_select_pipe['om1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['lm1'] != "" && $row_select_pipe['lm1'] != null && $row_select_pipe['lm1'] != "0") {
																				echo number_format($row_select_pipe['lm1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['pr1'] != "" && $row_select_pipe['pr1'] != null && $row_select_pipe['pr1'] != "0") {
																				echo number_format($row_select_pipe['pr1'], 5);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['v1'] != "" && $row_select_pipe['v1'] != null && $row_select_pipe['v1'] != "0") {
																				echo number_format($row_select_pipe['v1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm12'] != "" && $row_select_pipe['sm12'] != null && $row_select_pipe['sm12'] != "0") {
																				echo $row_select_pipe['sm12'];
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['l4'] != "" && $row_select_pipe['l4'] != null && $row_select_pipe['l4'] != "0") {
																				echo number_format($row_select_pipe['l4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['w4'] != "" && $row_select_pipe['w4'] != null && $row_select_pipe['w4'] != "0") {
																				echo number_format($row_select_pipe['w4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['im4'] != "" && $row_select_pipe['im4'] != null && $row_select_pipe['im4'] != "0") {
																				echo number_format($row_select_pipe['im4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['om4'] != "" && $row_select_pipe['om4'] != null && $row_select_pipe['om4'] != "0") {
																				echo number_format($row_select_pipe['om4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['lm4'] != "" && $row_select_pipe['lm4'] != null && $row_select_pipe['lm4'] != "0") {
																				echo number_format($row_select_pipe['lm4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['pr4'] != "" && $row_select_pipe['pr4'] != null && $row_select_pipe['pr4'] != "0") {
																				echo number_format($row_select_pipe['pr4'], 5);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['v4'] != "" && $row_select_pipe['v4'] != null && $row_select_pipe['v4'] != "0") {
																				echo number_format($row_select_pipe['v4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
									
										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm10'] != "" && $row_select_pipe['sm10'] != null && $row_select_pipe['sm10'] != "0") {
																				echo $row_select_pipe['sm10'];
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != null && $row_select_pipe['l2'] != "0") {
																				echo number_format($row_select_pipe['l2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['w2'] != "" && $row_select_pipe['w2'] != null && $row_select_pipe['w2'] != "0") {
																				echo number_format($row_select_pipe['w2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['im2'] != "" && $row_select_pipe['im2'] != null && $row_select_pipe['im2'] != "0") {
																				echo number_format($row_select_pipe['im2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['om2'] != "" && $row_select_pipe['om2'] != null && $row_select_pipe['om2'] != "0") {
																				echo number_format($row_select_pipe['om2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['lm2'] != "" && $row_select_pipe['lm2'] != null && $row_select_pipe['lm2'] != "0") {
																				echo number_format($row_select_pipe['lm2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['pr2'] != "" && $row_select_pipe['pr2'] != null && $row_select_pipe['pr2'] != "0") {
																				echo number_format($row_select_pipe['pr2'], 5);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['v2'] != "" && $row_select_pipe['v2'] != null && $row_select_pipe['v2'] != "0") {
																				echo number_format($row_select_pipe['v2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm13'] != "" && $row_select_pipe['sm13'] != null && $row_select_pipe['sm13'] != "0") {
																				echo $row_select_pipe['sm13'];
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['l5'] != "" && $row_select_pipe['l5'] != null && $row_select_pipe['l5'] != "0") {
																				echo number_format($row_select_pipe['l5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['w5'] != "" && $row_select_pipe['w5'] != null && $row_select_pipe['w5'] != "0") {
																				echo number_format($row_select_pipe['w5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['im5'] != "" && $row_select_pipe['im5'] != null && $row_select_pipe['im5'] != "0") {
																				echo number_format($row_select_pipe['im5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['om5'] != "" && $row_select_pipe['om5'] != null && $row_select_pipe['om5'] != "0") {
																				echo number_format($row_select_pipe['om5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['lm5'] != "" && $row_select_pipe['lm5'] != null && $row_select_pipe['lm5'] != "0") {
																				echo number_format($row_select_pipe['lm5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['pr5'] != "" && $row_select_pipe['pr5'] != null && $row_select_pipe['pr5'] != "0") {
																				echo number_format($row_select_pipe['pr5'], 5);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['v5'] != "" && $row_select_pipe['v5'] != null && $row_select_pipe['v5'] != "0") {
																				echo number_format($row_select_pipe['v5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
									
										
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm11'] != "" && $row_select_pipe['sm11'] != null && $row_select_pipe['sm11'] != "0") {
																				echo $row_select_pipe['sm11'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != null && $row_select_pipe['l3'] != "0") {
																				echo number_format($row_select_pipe['l3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['w3'] != "" && $row_select_pipe['w3'] != null && $row_select_pipe['w3'] != "0") {
																				echo number_format($row_select_pipe['w3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['im3'] != "" && $row_select_pipe['im3'] != null && $row_select_pipe['im3'] != "0") {
																				echo number_format($row_select_pipe['im3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['om3'] != "" && $row_select_pipe['om3'] != null && $row_select_pipe['om3'] != "0") {
																				echo number_format($row_select_pipe['om3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['lm3'] != "" && $row_select_pipe['lm3'] != null && $row_select_pipe['lm3'] != "0") {
																				echo number_format($row_select_pipe['lm3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['pr3'] != "" && $row_select_pipe['pr3'] != null && $row_select_pipe['pr3'] != "0") {
																				echo number_format($row_select_pipe['pr3'], 5);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['v3'] != "" && $row_select_pipe['v3'] != null && $row_select_pipe['v3'] != "0") {
																				echo number_format($row_select_pipe['v3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm14'] != "" && $row_select_pipe['sm14'] != null && $row_select_pipe['sm14'] != "0") {
																				echo $row_select_pipe['sm14'];
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['l6'] != "" && $row_select_pipe['l6'] != null && $row_select_pipe['l6'] != "0") {
																				echo number_format($row_select_pipe['l6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['w6'] != "" && $row_select_pipe['w6'] != null && $row_select_pipe['w6'] != "0") {
																				echo number_format($row_select_pipe['w6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['im6'] != "" && $row_select_pipe['im6'] != null && $row_select_pipe['im6'] != "0") {
																				echo number_format($row_select_pipe['im6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['om6'] != "" && $row_select_pipe['om6'] != null && $row_select_pipe['om6'] != "0") {
																				echo number_format($row_select_pipe['om6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['lm6'] != "" && $row_select_pipe['lm6'] != null && $row_select_pipe['lm6'] != "0") {
																				echo number_format($row_select_pipe['lm6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['pr6'] != "" && $row_select_pipe['pr6'] != null && $row_select_pipe['pr6'] != "0") {
																				echo number_format($row_select_pipe['pr6'], 5);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['v6'] != "" && $row_select_pipe['v6'] != null && $row_select_pipe['v6'] != "0") {
																				echo number_format($row_select_pipe['v6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
									
										
									</tr>
									
									
									
									<tr style="text-align:center;">										
										<td colspan="8" style="border:1px solid black;text-align:center">Dry Abrasion Resistance, mm<sup>3</sup> per 5000 mm <sup>2</sup></td>
										<td  style="border:1px solid black;"><?php if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != null && $row_select_pipe['avgv'] != "0") {
																					echo number_format($row_select_pipe['avgv'], 1);
																				} else {
																					echo "-";
																				} ?></td>
										<td colspan="8" style="border:1px solid black;text-align:center">Wet Abrasion Resistance, mm<sup>3</sup> per 5000 mm <sup>2</sup></td>
										<td  style="border:1px solid black;"><?php if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv2'] != null && $row_select_pipe['avgv2'] != "0") {
																					echo number_format($row_select_pipe['avgv2'], 1);
																				} else {
																					echo "-";
																				} ?></td>
									
									
										
									</tr>
									
									
									
									
									
								</table>
					<br>
					<table align="center" width="90%"  class="test1" style="height:Auto;width:90%;" >
									<tr style="text-align:left;">
										<td colspan="13" style="border:1px solid black;width:50%;"><b>Test - 4 Splitting Tensile Strength (IS 15658:2021)</b></td>
																																			
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;width:7.5%;"><b>Sr.<br>No.</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Sample<br>Mark</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Thickness<br>Measure 1, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Thickness<br>Measure 2, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Thickness<br>Measure 3, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Thickness<br>of<br>Paverblock, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Failure<br>Length Measure 1, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Failure<br>Length Measure 2, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Failure<br>Length, mm</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Area<br>of<br>failure, mm<sup>2</sup></b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Load, kN</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Tensile Splitting<br>Strength(T), Mpa</b></td>
										<td  style="border:1px solid black;width:7.5%;"><b>Failure<br>Load(F), N/mm</b></td>
										
									</tr>
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm15'] != "" && $row_select_pipe['sm15'] != null && $row_select_pipe['sm15'] != "0") {
																				echo $row_select_pipe['sm15'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t11'] != "" && $row_select_pipe['t11'] != null && $row_select_pipe['t11'] != "0") {
																				echo number_format($row_select_pipe['t11'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t21'] != "" && $row_select_pipe['t21'] != null && $row_select_pipe['t21'] != "0") {
																				echo number_format($row_select_pipe['t21'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t31'] != "" && $row_select_pipe['t31'] != null && $row_select_pipe['t31'] != "0") {
																				echo number_format($row_select_pipe['t31'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt1'] != "" && $row_select_pipe['avgt1'] != null && $row_select_pipe['avgt1'] != "0") {
																				echo number_format($row_select_pipe['avgt1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f11'] != "" && $row_select_pipe['f11'] != null && $row_select_pipe['f11'] != "0") {
																				echo number_format($row_select_pipe['f11'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f21'] != "" && $row_select_pipe['f21'] != null && $row_select_pipe['f21'] != "0") {
																				echo number_format($row_select_pipe['f21'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf1'] != "" && $row_select_pipe['avgf1'] != null && $row_select_pipe['avgf1'] != "0") {
																				echo number_format($row_select_pipe['avgf1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea1'] != "" && $row_select_pipe['farea1'] != null && $row_select_pipe['farea1'] != "0") {
																				echo number_format($row_select_pipe['farea1'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload1'] != "" && $row_select_pipe['spload1'] != null && $row_select_pipe['spload1'] != "0") {
																				echo number_format($row_select_pipe['spload1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten1'] != "" && $row_select_pipe['sten1'] != null && $row_select_pipe['sten1'] != "0") {
																				echo number_format($row_select_pipe['sten1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload1'] != "" && $row_select_pipe['fload1'] != null && $row_select_pipe['fload1'] != "0") {
																				echo number_format($row_select_pipe['fload1'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm16'] != "" && $row_select_pipe['sm16'] != null && $row_select_pipe['sm16'] != "0") {
																				echo $row_select_pipe['sm16'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t12'] != "" && $row_select_pipe['t12'] != null && $row_select_pipe['t12'] != "0") {
																				echo number_format($row_select_pipe['t12'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t22'] != "" && $row_select_pipe['t22'] != null && $row_select_pipe['t22'] != "0") {
																				echo number_format($row_select_pipe['t22'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t32'] != "" && $row_select_pipe['t32'] != null && $row_select_pipe['t32'] != "0") {
																				echo number_format($row_select_pipe['t32'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt2'] != "" && $row_select_pipe['avgt2'] != null && $row_select_pipe['avgt2'] != "0") {
																				echo number_format($row_select_pipe['avgt2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f12'] != "" && $row_select_pipe['f12'] != null && $row_select_pipe['f12'] != "0") {
																				echo number_format($row_select_pipe['f12'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f22'] != "" && $row_select_pipe['f22'] != null && $row_select_pipe['f22'] != "0") {
																				echo number_format($row_select_pipe['f22'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf2'] != "" && $row_select_pipe['avgf2'] != null && $row_select_pipe['avgf2'] != "0") {
																				echo number_format($row_select_pipe['avgf2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea2'] != "" && $row_select_pipe['farea2'] != null && $row_select_pipe['farea2'] != "0") {
																				echo number_format($row_select_pipe['farea2'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload2'] != "" && $row_select_pipe['spload2'] != null && $row_select_pipe['spload2'] != "0") {
																				echo number_format($row_select_pipe['spload2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten2'] != "" && $row_select_pipe['sten2'] != null && $row_select_pipe['sten2'] != "0") {
																				echo number_format($row_select_pipe['sten2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload2'] != "" && $row_select_pipe['fload2'] != null && $row_select_pipe['fload2'] != "0") {
																				echo number_format($row_select_pipe['fload2'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm17'] != "" && $row_select_pipe['sm17'] != null && $row_select_pipe['sm17'] != "0") {
																				echo $row_select_pipe['sm17'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t13'] != "" && $row_select_pipe['t13'] != null && $row_select_pipe['t13'] != "0") {
																				echo number_format($row_select_pipe['t13'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t23'] != "" && $row_select_pipe['t23'] != null && $row_select_pipe['t23'] != "0") {
																				echo number_format($row_select_pipe['t23'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t33'] != "" && $row_select_pipe['t33'] != null && $row_select_pipe['t33'] != "0") {
																				echo number_format($row_select_pipe['t33'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt3'] != "" && $row_select_pipe['avgt3'] != null && $row_select_pipe['avgt3'] != "0") {
																				echo number_format($row_select_pipe['avgt3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f13'] != "" && $row_select_pipe['f13'] != null && $row_select_pipe['f13'] != "0") {
																				echo number_format($row_select_pipe['f13'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f23'] != "" && $row_select_pipe['f23'] != null && $row_select_pipe['f23'] != "0") {
																				echo number_format($row_select_pipe['f23'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf3'] != "" && $row_select_pipe['avgf3'] != null && $row_select_pipe['avgf3'] != "0") {
																				echo number_format($row_select_pipe['avgf3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea3'] != "" && $row_select_pipe['farea3'] != null && $row_select_pipe['farea3'] != "0") {
																				echo number_format($row_select_pipe['farea3'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload3'] != "" && $row_select_pipe['spload3'] != null && $row_select_pipe['spload3'] != "0") {
																				echo number_format($row_select_pipe['spload3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten3'] != "" && $row_select_pipe['sten3'] != null && $row_select_pipe['sten3'] != "0") {
																				echo number_format($row_select_pipe['sten3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload3'] != "" && $row_select_pipe['fload3'] != null && $row_select_pipe['fload3'] != "0") {
																				echo number_format($row_select_pipe['fload3'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>4</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm18'] != "" && $row_select_pipe['sm18'] != null && $row_select_pipe['sm18'] != "0") {
																				echo $row_select_pipe['sm18'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t14'] != "" && $row_select_pipe['t14'] != null && $row_select_pipe['t14'] != "0") {
																				echo number_format($row_select_pipe['t14'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t24'] != "" && $row_select_pipe['t24'] != null && $row_select_pipe['t24'] != "0") {
																				echo number_format($row_select_pipe['t24'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t34'] != "" && $row_select_pipe['t34'] != null && $row_select_pipe['t34'] != "0") {
																				echo number_format($row_select_pipe['t34'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt4'] != "" && $row_select_pipe['avgt4'] != null && $row_select_pipe['avgt4'] != "0") {
																				echo number_format($row_select_pipe['avgt4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f14'] != "" && $row_select_pipe['f14'] != null && $row_select_pipe['f14'] != "0") {
																				echo number_format($row_select_pipe['f14'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f24'] != "" && $row_select_pipe['f24'] != null && $row_select_pipe['f24'] != "0") {
																				echo number_format($row_select_pipe['f24'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf4'] != "" && $row_select_pipe['avgf4'] != null && $row_select_pipe['avgf4'] != "0") {
																				echo number_format($row_select_pipe['avgf4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea4'] != "" && $row_select_pipe['farea4'] != null && $row_select_pipe['farea4'] != "0") {
																				echo number_format($row_select_pipe['farea4'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload4'] != "" && $row_select_pipe['spload4'] != null && $row_select_pipe['spload4'] != "0") {
																				echo number_format($row_select_pipe['spload4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten4'] != "" && $row_select_pipe['sten4'] != null && $row_select_pipe['sten4'] != "0") {
																				echo number_format($row_select_pipe['sten4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload4'] != "" && $row_select_pipe['fload4'] != null && $row_select_pipe['fload4'] != "0") {
																				echo number_format($row_select_pipe['fload4'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>5</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm19'] != "" && $row_select_pipe['sm19'] != null && $row_select_pipe['sm19'] != "0") {
																				echo $row_select_pipe['sm19'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t15'] != "" && $row_select_pipe['t15'] != null && $row_select_pipe['t15'] != "0") {
																				echo number_format($row_select_pipe['t15'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t25'] != "" && $row_select_pipe['t25'] != null && $row_select_pipe['t25'] != "0") {
																				echo number_format($row_select_pipe['t25'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t35'] != "" && $row_select_pipe['t35'] != null && $row_select_pipe['t35'] != "0") {
																				echo number_format($row_select_pipe['t35'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt5'] != "" && $row_select_pipe['avgt5'] != null && $row_select_pipe['avgt5'] != "0") {
																				echo number_format($row_select_pipe['avgt5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f15'] != "" && $row_select_pipe['f15'] != null && $row_select_pipe['f15'] != "0") {
																				echo number_format($row_select_pipe['f15'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f25'] != "" && $row_select_pipe['f25'] != null && $row_select_pipe['f25'] != "0") {
																				echo number_format($row_select_pipe['f25'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf5'] != "" && $row_select_pipe['avgf5'] != null && $row_select_pipe['avgf5'] != "0") {
																				echo number_format($row_select_pipe['avgf5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea5'] != "" && $row_select_pipe['farea5'] != null && $row_select_pipe['farea5'] != "0") {
																				echo number_format($row_select_pipe['farea5'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload5'] != "" && $row_select_pipe['spload5'] != null && $row_select_pipe['spload5'] != "0") {
																				echo number_format($row_select_pipe['spload5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten5'] != "" && $row_select_pipe['sten5'] != null && $row_select_pipe['sten5'] != "0") {
																				echo number_format($row_select_pipe['sten5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload5'] != "" && $row_select_pipe['fload5'] != null && $row_select_pipe['fload5'] != "0") {
																				echo number_format($row_select_pipe['fload5'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>6</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm20'] != "" && $row_select_pipe['sm20'] != null && $row_select_pipe['sm20'] != "0") {
																				echo $row_select_pipe['sm20'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t16'] != "" && $row_select_pipe['t16'] != null && $row_select_pipe['t16'] != "0") {
																				echo number_format($row_select_pipe['t16'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t26'] != "" && $row_select_pipe['t26'] != null && $row_select_pipe['t26'] != "0") {
																				echo number_format($row_select_pipe['t26'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t36'] != "" && $row_select_pipe['t36'] != null && $row_select_pipe['t36'] != "0") {
																				echo number_format($row_select_pipe['t36'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt6'] != "" && $row_select_pipe['avgt6'] != null && $row_select_pipe['avgt6'] != "0") {
																				echo number_format($row_select_pipe['avgt6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f16'] != "" && $row_select_pipe['f16'] != null && $row_select_pipe['f16'] != "0") {
																				echo number_format($row_select_pipe['f16'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f26'] != "" && $row_select_pipe['f26'] != null && $row_select_pipe['f26'] != "0") {
																				echo number_format($row_select_pipe['f26'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf6'] != "" && $row_select_pipe['avgf6'] != null && $row_select_pipe['avgf6'] != "0") {
																				echo number_format($row_select_pipe['avgf6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea6'] != "" && $row_select_pipe['farea6'] != null && $row_select_pipe['farea6'] != "0") {
																				echo number_format($row_select_pipe['farea6'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload6'] != "" && $row_select_pipe['spload6'] != null && $row_select_pipe['spload6'] != "0") {
																				echo number_format($row_select_pipe['spload6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten6'] != "" && $row_select_pipe['sten6'] != null && $row_select_pipe['sten6'] != "0") {
																				echo number_format($row_select_pipe['sten6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload6'] != "" && $row_select_pipe['fload6'] != null && $row_select_pipe['fload6'] != "0") {
																				echo number_format($row_select_pipe['fload6'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>7</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm21'] != "" && $row_select_pipe['sm21'] != null && $row_select_pipe['sm21'] != "0") {
																				echo $row_select_pipe['sm21'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t17'] != "" && $row_select_pipe['t17'] != null && $row_select_pipe['t17'] != "0") {
																				echo number_format($row_select_pipe['t17'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t27'] != "" && $row_select_pipe['t27'] != null && $row_select_pipe['t27'] != "0") {
																				echo number_format($row_select_pipe['t27'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t37'] != "" && $row_select_pipe['t37'] != null && $row_select_pipe['t37'] != "0") {
																				echo number_format($row_select_pipe['t37'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt7'] != "" && $row_select_pipe['avgt7'] != null && $row_select_pipe['avgt7'] != "0") {
																				echo number_format($row_select_pipe['avgt7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f17'] != "" && $row_select_pipe['f17'] != null && $row_select_pipe['f17'] != "0") {
																				echo number_format($row_select_pipe['f17'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f27'] != "" && $row_select_pipe['f27'] != null && $row_select_pipe['f27'] != "0") {
																				echo number_format($row_select_pipe['f27'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf7'] != "" && $row_select_pipe['avgf7'] != null && $row_select_pipe['avgf7'] != "0") {
																				echo number_format($row_select_pipe['avgf7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea7'] != "" && $row_select_pipe['farea7'] != null && $row_select_pipe['farea7'] != "0") {
																				echo number_format($row_select_pipe['farea7'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload7'] != "" && $row_select_pipe['spload7'] != null && $row_select_pipe['spload7'] != "0") {
																				echo number_format($row_select_pipe['spload7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten7'] != "" && $row_select_pipe['sten7'] != null && $row_select_pipe['sten7'] != "0") {
																				echo number_format($row_select_pipe['sten7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload7'] != "" && $row_select_pipe['fload7'] != null && $row_select_pipe['fload7'] != "0") {
																				echo number_format($row_select_pipe['fload7'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>8</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm22'] != "" && $row_select_pipe['sm22'] != null && $row_select_pipe['sm22'] != "0") {
																				echo $row_select_pipe['sm22'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t18'] != "" && $row_select_pipe['t18'] != null && $row_select_pipe['t18'] != "0") {
																				echo number_format($row_select_pipe['t18'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t28'] != "" && $row_select_pipe['t28'] != null && $row_select_pipe['t28'] != "0") {
																				echo number_format($row_select_pipe['t28'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['t38'] != "" && $row_select_pipe['t38'] != null && $row_select_pipe['t38'] != "0") {
																				echo number_format($row_select_pipe['t38'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgt8'] != "" && $row_select_pipe['avgt8'] != null && $row_select_pipe['avgt8'] != "0") {
																				echo number_format($row_select_pipe['avgt8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f18'] != "" && $row_select_pipe['f18'] != null && $row_select_pipe['f18'] != "0") {
																				echo number_format($row_select_pipe['f18'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['f28'] != "" && $row_select_pipe['f28'] != null && $row_select_pipe['f28'] != "0") {
																				echo number_format($row_select_pipe['f28'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avgf8'] != "" && $row_select_pipe['avgf8'] != null && $row_select_pipe['avgf8'] != "0") {
																				echo number_format($row_select_pipe['avgf8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['farea8'] != "" && $row_select_pipe['farea8'] != null && $row_select_pipe['farea8'] != "0") {
																				echo number_format($row_select_pipe['farea8'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['spload8'] != "" && $row_select_pipe['spload8'] != null && $row_select_pipe['spload8'] != "0") {
																				echo number_format($row_select_pipe['spload8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sten8'] != "" && $row_select_pipe['sten8'] != null && $row_select_pipe['sten8'] != "0") {
																				echo number_format($row_select_pipe['sten8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fload8'] != "" && $row_select_pipe['fload8'] != null && $row_select_pipe['fload8'] != "0") {
																				echo number_format($row_select_pipe['fload8'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td colspan="11" style="border:1px solid black;text-align:right"><b>Average :</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avg_tensile'] != "" && $row_select_pipe['avg_tensile'] != null && $row_select_pipe['avg_tensile'] != "0") {
																				echo number_format($row_select_pipe['avg_tensile'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avg_load'] != "" && $row_select_pipe['avg_load'] != null && $row_select_pipe['avg_load'] != "0") {
																				echo number_format($row_select_pipe['avg_load'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									
								</table>
								<br>
								<table align="center" width="90%"  class="test1" style="height:Auto;width:90%;" >
									<tr style="text-align:left;">
										<td colspan="8" style="border:1px solid black;width:50%;"><b>Flexural Strength (IS 15658:2021)</b></td>
																																			
									</tr>
									<tr style="text-align:center;">
										<td  style="border:1px solid black;width:12%;"><b>Sr.<br>No.</b></td>
										<td  style="border:1px solid black;width:12%;"><b>Sample<br>Mark</b></td>
										<td  style="border:1px solid black;width:12%;"><b>Length, mm</b></td>
										<td  style="border:1px solid black;width:12%;"><b>Width, mm</b></td>
										<td  style="border:1px solid black;width:12%;"><b>Thickness, mm</b></td>
										<td  style="border:1px solid black;width:12%;"><b>Distance Between<br>Roller, mm</b></td>
										<td  style="border:1px solid black;width:14%;"><b>Load, kN</b></td>
										<td  style="border:1px solid black;width:14%;"><b>Flexural<br>Strength, Mpa</b></td>
										
									</tr>
									
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>1</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm23'] != "" && $row_select_pipe['sm23'] != null && $row_select_pipe['sm23'] != "0") {
																				echo $row_select_pipe['sm23'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen1'] != "" && $row_select_pipe['flen1'] != null && $row_select_pipe['flen1'] != "0") {
																				echo number_format($row_select_pipe['flen1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid1'] != "" && $row_select_pipe['fwid1'] != null && $row_select_pipe['fwid1'] != "0") {
																				echo number_format($row_select_pipe['fwid1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk1'] != "" && $row_select_pipe['fthk1'] != null && $row_select_pipe['fthk1'] != "0") {
																				echo number_format($row_select_pipe['fthk1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis1'] != "" && $row_select_pipe['fdis1'] != null && $row_select_pipe['fdis1'] != "0") {
																				echo number_format($row_select_pipe['fdis1'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa1'] != "" && $row_select_pipe['floa1'] != null && $row_select_pipe['floa1'] != "0") {
																				echo number_format($row_select_pipe['floa1'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle1'] != "" && $row_select_pipe['fle1'] != null && $row_select_pipe['fle1'] != "0") {
																				echo number_format($row_select_pipe['fle1'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>2</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm24'] != "" && $row_select_pipe['sm24'] != null && $row_select_pipe['sm24'] != "0") {
																				echo $row_select_pipe['sm24'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen2'] != "" && $row_select_pipe['flen2'] != null && $row_select_pipe['flen2'] != "0") {
																				echo number_format($row_select_pipe['flen2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid2'] != "" && $row_select_pipe['fwid2'] != null && $row_select_pipe['fwid2'] != "0") {
																				echo number_format($row_select_pipe['fwid2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk2'] != "" && $row_select_pipe['fthk2'] != null && $row_select_pipe['fthk2'] != "0") {
																				echo number_format($row_select_pipe['fthk2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis2'] != "" && $row_select_pipe['fdis2'] != null && $row_select_pipe['fdis2'] != "0") {
																				echo number_format($row_select_pipe['fdis2'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa2'] != "" && $row_select_pipe['floa2'] != null && $row_select_pipe['floa2'] != "0") {
																				echo number_format($row_select_pipe['floa2'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle2'] != "" && $row_select_pipe['fle2'] != null && $row_select_pipe['fle2'] != "0") {
																				echo number_format($row_select_pipe['fle2'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>3</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm25'] != "" && $row_select_pipe['sm25'] != null && $row_select_pipe['sm25'] != "0") {
																				echo $row_select_pipe['sm25'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen3'] != "" && $row_select_pipe['flen3'] != null && $row_select_pipe['flen3'] != "0") {
																				echo number_format($row_select_pipe['flen3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid3'] != "" && $row_select_pipe['fwid3'] != null && $row_select_pipe['fwid3'] != "0") {
																				echo number_format($row_select_pipe['fwid3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk3'] != "" && $row_select_pipe['fthk3'] != null && $row_select_pipe['fthk3'] != "0") {
																				echo number_format($row_select_pipe['fthk3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis3'] != "" && $row_select_pipe['fdis3'] != null && $row_select_pipe['fdis3'] != "0") {
																				echo number_format($row_select_pipe['fdis3'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa3'] != "" && $row_select_pipe['floa3'] != null && $row_select_pipe['floa3'] != "0") {
																				echo number_format($row_select_pipe['floa3'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle3'] != "" && $row_select_pipe['fle3'] != null && $row_select_pipe['fle3'] != "0") {
																				echo number_format($row_select_pipe['fle3'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>4</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm26'] != "" && $row_select_pipe['sm26'] != null && $row_select_pipe['sm26'] != "0") {
																				echo $row_select_pipe['sm26'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen4'] != "" && $row_select_pipe['flen4'] != null && $row_select_pipe['flen4'] != "0") {
																				echo number_format($row_select_pipe['flen4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid4'] != "" && $row_select_pipe['fwid4'] != null && $row_select_pipe['fwid4'] != "0") {
																				echo number_format($row_select_pipe['fwid4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk4'] != "" && $row_select_pipe['fthk4'] != null && $row_select_pipe['fthk4'] != "0") {
																				echo number_format($row_select_pipe['fthk4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis4'] != "" && $row_select_pipe['fdis4'] != null && $row_select_pipe['fdis4'] != "0") {
																				echo number_format($row_select_pipe['fdis4'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa4'] != "" && $row_select_pipe['floa4'] != null && $row_select_pipe['floa4'] != "0") {
																				echo number_format($row_select_pipe['floa4'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle4'] != "" && $row_select_pipe['fle4'] != null && $row_select_pipe['fle4'] != "0") {
																				echo number_format($row_select_pipe['fle4'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>5</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm27'] != "" && $row_select_pipe['sm27'] != null && $row_select_pipe['sm27'] != "0") {
																				echo $row_select_pipe['sm27'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen5'] != "" && $row_select_pipe['flen5'] != null && $row_select_pipe['flen5'] != "0") {
																				echo number_format($row_select_pipe['flen5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid5'] != "" && $row_select_pipe['fwid5'] != null && $row_select_pipe['fwid5'] != "0") {
																				echo number_format($row_select_pipe['fwid5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk5'] != "" && $row_select_pipe['fthk5'] != null && $row_select_pipe['fthk5'] != "0") {
																				echo number_format($row_select_pipe['fthk5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis5'] != "" && $row_select_pipe['fdis5'] != null && $row_select_pipe['fdis5'] != "0") {
																				echo number_format($row_select_pipe['fdis5'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa5'] != "" && $row_select_pipe['floa5'] != null && $row_select_pipe['floa5'] != "0") {
																				echo number_format($row_select_pipe['floa5'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle5'] != "" && $row_select_pipe['fle5'] != null && $row_select_pipe['fle5'] != "0") {
																				echo number_format($row_select_pipe['fle5'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>6</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm28'] != "" && $row_select_pipe['sm28'] != null && $row_select_pipe['sm28'] != "0") {
																				echo $row_select_pipe['sm28'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen6'] != "" && $row_select_pipe['flen6'] != null && $row_select_pipe['flen6'] != "0") {
																				echo number_format($row_select_pipe['flen6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid6'] != "" && $row_select_pipe['fwid6'] != null && $row_select_pipe['fwid6'] != "0") {
																				echo number_format($row_select_pipe['fwid6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk6'] != "" && $row_select_pipe['fthk6'] != null && $row_select_pipe['fthk6'] != "0") {
																				echo number_format($row_select_pipe['fthk6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis6'] != "" && $row_select_pipe['fdis6'] != null && $row_select_pipe['fdis6'] != "0") {
																				echo number_format($row_select_pipe['fdis6'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa6'] != "" && $row_select_pipe['floa6'] != null && $row_select_pipe['floa6'] != "0") {
																				echo number_format($row_select_pipe['floa6'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle6'] != "" && $row_select_pipe['fle6'] != null && $row_select_pipe['fle6'] != "0") {
																				echo number_format($row_select_pipe['fle6'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>7</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm29'] != "" && $row_select_pipe['sm29'] != null && $row_select_pipe['sm29'] != "0") {
																				echo $row_select_pipe['sm29'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen7'] != "" && $row_select_pipe['flen7'] != null && $row_select_pipe['flen7'] != "0") {
																				echo number_format($row_select_pipe['flen7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid7'] != "" && $row_select_pipe['fwid7'] != null && $row_select_pipe['fwid7'] != "0") {
																				echo number_format($row_select_pipe['fwid7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk7'] != "" && $row_select_pipe['fthk7'] != null && $row_select_pipe['fthk7'] != "0") {
																				echo number_format($row_select_pipe['fthk7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis7'] != "" && $row_select_pipe['fdis7'] != null && $row_select_pipe['fdis7'] != "0") {
																				echo number_format($row_select_pipe['fdis7'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa7'] != "" && $row_select_pipe['floa7'] != null && $row_select_pipe['floa7'] != "0") {
																				echo number_format($row_select_pipe['floa7'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle7'] != "" && $row_select_pipe['fle7'] != null && $row_select_pipe['fle7'] != "0") {
																				echo number_format($row_select_pipe['fle7'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td style="border:1px solid black;"><b>8</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['sm30'] != "" && $row_select_pipe['sm30'] != null && $row_select_pipe['sm30'] != "0") {
																				echo $row_select_pipe['sm30'];
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['flen8'] != "" && $row_select_pipe['flen8'] != null && $row_select_pipe['flen8'] != "0") {
																				echo number_format($row_select_pipe['flen8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fwid8'] != "" && $row_select_pipe['fwid8'] != null && $row_select_pipe['fwid8'] != "0") {
																				echo number_format($row_select_pipe['fwid8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fthk8'] != "" && $row_select_pipe['fthk8'] != null && $row_select_pipe['fthk8'] != "0") {
																				echo number_format($row_select_pipe['fthk8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fdis8'] != "" && $row_select_pipe['fdis8'] != null && $row_select_pipe['fdis8'] != "0") {
																				echo number_format($row_select_pipe['fdis8'], 0);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['floa8'] != "" && $row_select_pipe['floa8'] != null && $row_select_pipe['floa8'] != "0") {
																				echo number_format($row_select_pipe['floa8'], 2);
																			} else {
																				echo "-";
																			} ?></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['fle8'] != "" && $row_select_pipe['fle8'] != null && $row_select_pipe['fle8'] != "0") {
																				echo number_format($row_select_pipe['fle8'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									<tr style="text-align:center;">
										<td colspan="7" style="border:1px solid black;text-align:right"><b>Average :</b></td>
										<td style="border:1px solid black;"><?php if ($row_select_pipe['avg_fle'] != "" && $row_select_pipe['avg_fle'] != null && $row_select_pipe['avg_fle'] != "0") {
																				echo number_format($row_select_pipe['avg_fle'], 2);
																			} else {
																				echo "-";
																			} ?></td>																	
									</tr>
									
								</table>
						
						
				<?php
				/*}*/
				?>
			
			</page-->

</body>

</html>


<script type="text/javascript">

</script>