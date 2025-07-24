<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 30px 40px;
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
	$select_tiles_query = "select * from admixture WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query1 = "select * from agency_master where `isdeleted`=0 WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		/* $mark= $row_select4['mark'];
					$brick_specification= $row_select4['brick_specification']; */
		$in_grade = $row_select4['in_grade'];
	}

	?>

	<br>
	<page size="A4">
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tbody>
				<tr>
					<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:100%;padding-left:7px;"></td>
					<td colspan="2" style="font-size:14px;border: 1px solid black;">
						<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;">
						<center><b>FMT-OBS-</b></center>
					</td>
					<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
						<center><b>OBSERVATION &amp; CALCULATION SHEET FOR ADMIXTURE ANALYSIS</b></center>
					</td>
				</tr>
			</tbody>
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="9%">
			<tbody>
				<tr style="border: 1px solid black;">
					<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
					<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $job_no; ?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification Mark :</td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $in_grade; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Laboratory No :</b>&nbsp;</td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Start Date :</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Complete Date:</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
				</tr>
			</tbody>
		</table>

		<br>
		<br>
		<br>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td style="border: 1px solid black; padding: 5px; ">&nbsp; <b>1. ASH CONTENT AS PER <?php if ($row_select_pipe['ash_test_method'] != ""  && $row_select_pipe['ash_test_method'] != null  && $row_select_pipe['ash_test_method'] != "0"  && $row_select_pipe['ash_test_method'] != "undefined") {
																										echo $row_select_pipe['ash_test_method'];
																									} else { ?>IS 9103 : 1999, Annex E (RA 2018) <?php } ?></b></td>
			</tr>
			<!--
				<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>1. ASH CONTENT : AS PER  IS 9103 : 1999 Annex E (RA 2018)</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['ash_s_d'])); ?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['ash_e_d'])); ?></td>
				</tr>-->
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">1</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF CRUCIBLE AND LID (W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_w1'] != "" && $row_select_pipe['ash_w1'] != "0" && $row_select_pipe['ash_w1'] != null) {
																						echo $row_select_pipe['ash_w1'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">2</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF CRUCIBLE, LID AND SAMPLE (W2)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_w2'] != "" && $row_select_pipe['ash_w2'] != "0" && $row_select_pipe['ash_w2'] != null) {
																						echo $row_select_pipe['ash_w2'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">3</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF CRUCIBLE, LID AND ASH (W3)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_w3'] != "" && $row_select_pipe['ash_w3'] != "0" && $row_select_pipe['ash_w3'] != null) {
																						echo $row_select_pipe['ash_w3'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">4</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp;
					<table class="test">
						<tr>
							<td width="150px" rowspan="2" style="text-align:center;">ASH CONTENT =</td>
							<td width="100px" style="border-bottom: 1px solid black; text-align:center;">W3 - W1</td>
							<td width="50px" rowspan="2" style="text-align:center;"> x 100</td>
						</tr>
						<tr>
							<td style="text-align:center;">W2 - W1</td>
						</tr>
					</table>
				</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ash_content'] != "" && $row_select_pipe['ash_content'] != "0" && $row_select_pipe['ash_content'] != null) {
																						echo $row_select_pipe['ash_content'] . " %";
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
		</table>


		<br>
		<br>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td style="border: 1px solid black; padding: 5px;">&nbsp; <b>2. pH VALUE AS PER <?php if ($row_select_pipe['phv_test_method'] != ""  && $row_select_pipe['phv_test_method'] != null  && $row_select_pipe['phv_test_method'] != "0"  && $row_select_pipe['phv_test_method'] != "undefined") {
																									echo $row_select_pipe['phv_test_method'];
																								} else { ?>IS 9103 : 1999, Annex E (RA 2018) <?php } ?></b></td>
			</tr>
			<!--<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b></b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['phv_s_d'])); ?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['phv_e_d'])); ?></td>
				</tr>-->
		</table>

		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:10%;border: 1px solid black;text-align:center; padding: 5px;">SAMPLE ID</td>
				<td style="width:30%;border: 1px solid black;text-align:center;">BEFORE SET</td>
				<td style="width:30%;border: 1px solid black;text-align:center;">AFTER SET</td>
				<td style="width:30%;border: 1px solid black;text-align:center;">TEMPERATURE (<sup>o</sup>C)</td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">1</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before1'] != "" && $row_select_pipe['phv_before1'] != "0" && $row_select_pipe['phv_before1'] != null) {
																			echo $row_select_pipe['phv_before1'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after1'] != "" && $row_select_pipe['phv_after1'] != "0" && $row_select_pipe['phv_after1'] != null) {
																			echo $row_select_pipe['phv_after1'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp1'] != "" && $row_select_pipe['phv_temp1'] != "0" && $row_select_pipe['phv_temp1'] != null) {
																			echo $row_select_pipe['phv_temp1'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">2</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before2'] != "" && $row_select_pipe['phv_before2'] != "0" && $row_select_pipe['phv_before2'] != null) {
																			echo $row_select_pipe['phv_before2'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after2'] != "" && $row_select_pipe['phv_after2'] != "0" && $row_select_pipe['phv_after2'] != null) {
																			echo $row_select_pipe['phv_after2'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp2'] != "" && $row_select_pipe['phv_temp2'] != "0" && $row_select_pipe['phv_temp2'] != null) {
																			echo $row_select_pipe['phv_temp2'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">3</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_before3'] != "" && $row_select_pipe['phv_before3'] != "0" && $row_select_pipe['phv_before3'] != null) {
																			echo $row_select_pipe['phv_before3'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_after3'] != "" && $row_select_pipe['phv_after3'] != "0" && $row_select_pipe['phv_after3'] != null) {
																			echo $row_select_pipe['phv_after3'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_temp3'] != "" && $row_select_pipe['phv_temp3'] != "0" && $row_select_pipe['phv_temp3'] != null) {
																			echo $row_select_pipe['phv_temp3'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">Average</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_before'] != "" && $row_select_pipe['phv_avg_before'] != "0" && $row_select_pipe['phv_avg_before'] != null) {
																			echo $row_select_pipe['phv_avg_before'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_after'] != "" && $row_select_pipe['phv_avg_after'] != "0" && $row_select_pipe['phv_avg_after'] != null) {
																			echo $row_select_pipe['phv_avg_after'];
																		} else {
																			echo " <br>";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['phv_avg_temp'] != "" && $row_select_pipe['phv_avg_temp'] != "0" && $row_select_pipe['phv_avg_temp'] != null) {
																			echo $row_select_pipe['phv_avg_temp'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
		</table>

		<br>
		<br>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td style="border: 1px solid black; padding: 5px;">&nbsp; <b>3. CHLORIDE ION CONCENTRATION AS PER <?php if ($row_select_pipe['clr_test_method'] != ""  && $row_select_pipe['clr_test_method'] != null  && $row_select_pipe['clr_test_method'] != "0"  && $row_select_pipe['clr_test_method'] != "undefined") {
																														echo $row_select_pipe['clr_test_method'];
																													} else { ?>IS 6925:1973 (RA 2018) <?php } ?></b></td>
			</tr>
			<!--<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>3. CHLORIDE ION CONCENTRATION : IS 6925 : 1973 (RA 2018)</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['clr_s_d'])); ?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['clr_e_d'])); ?></td>
				</tr>-->
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">1</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF SAMPLE, GM</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_w'] != "" && $row_select_pipe['clr_w'] != "0" && $row_select_pipe['clr_w'] != null) {
																						echo $row_select_pipe['clr_w'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">2</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF CHLORIDE, GM (From Graph)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_x'] != "" && $row_select_pipe['clr_x'] != "0" && $row_select_pipe['clr_x'] != null) {
																						echo $row_select_pipe['clr_x'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>

			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">3</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; CHLORIDE CONTENT (%) = (WEIGHT OF CHLORIDE / WEIGHT OF SAMPLE) X 100</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['chloride_content'] != "" && $row_select_pipe['chloride_content'] != "0" && $row_select_pipe['chloride_content'] != null) {
																						echo $row_select_pipe['chloride_content'] . " %";
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>


		</table>


		<br><br><br><br><br><br><br><br><br>
		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid;">
			<tbody>
				<tr style="">
					<td style="width:25%;padding-top:4px;">
						<center>Amendment No.: 01</center>
					</td>
					<td style="width:25%;">
						<center>Amendment Date: 01.04.2023</center>
					</td>
					<td style="width:16.67%;">
						<center>Prepared by:</center>
					</td>
					<td style="width:16.67%;">
						<center>Approved by:</center>
					</td>
					<td style="width:16.67%;">
						<center>Issued by:</center>
					</td>
				</tr>
				<tr>
					<td style="">
						<center>Issue No.: 03</center>
					</td>
					<td style="">
						<center>Issue Date: 01.01.2022 </center>
					</td>
					<td style="">
						<center>Nodal QM</center>
					</td>
					<td style="">
						<center>Director</center>
					</td>
					<td style="">
						<center>Nodal QM</center>
					</td>
				</tr>
				<tr style="font-size:10px;">
					<td style="text-align:center;">Page 1 of 2</td>
				</tr>
			</tbody>
		</table>

		<div class="pagebreak"> </div>

		<br>
		<br>

		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tbody>
				<tr>
					<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:100%;padding-left:7px;"></td>
					<td colspan="2" style="font-size:14px;border: 1px solid black;">
						<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;">
						<center><b>FMT-OBS-</b></center>
					</td>
					<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
						<center><b>OBSERVATION &amp; CALCULATION SHEET FOR ADMIXTURE ANALYSIS</b></center>
					</td>
				</tr>
			</tbody>
		</table>


		<br><br>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td style="border: 1px solid black; padding: 5px;">&nbsp; <b>4. RELATIVE DENSITY AS PER <?php if ($row_select_pipe['rdv_test_method'] != ""  && $row_select_pipe['rdv_test_method'] != null  && $row_select_pipe['rdv_test_method'] != "0"  && $row_select_pipe['rdv_test_method'] != "undefined") {
																											echo $row_select_pipe['rdv_test_method'];
																										} else { ?>IS 9103 : 1999, Annex E (RA 2018) <?php } ?></b></td>
			</tr>

			<!--<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>4. RELATIVE DENSITY : AS PER  IS 9103 : 1999 Annex E (RA 2018)</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['rdv_s_d'])); ?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['rdv_e_d'])); ?></td>
				</tr>-->
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td rowspan="4" style="width:30%;border: 1px solid black;text-align:center; padding: 5px;">TEMPERATURE 20 &plusmn; 5<sup>o</sup>C</td>
				<td style="width:30%;border: 1px solid black;text-align:center;">SAMPLE ID </td>
				<td style="width:30%;border: 1px solid black;text-align:center;">DENSITY</td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">1</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rdv1'] != "" && $row_select_pipe['rdv1'] != "0" && $row_select_pipe['rdv1'] != null) {
																			echo $row_select_pipe['rdv1'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">2</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rdv2'] != "" && $row_select_pipe['rdv2'] != "0" && $row_select_pipe['rdv2'] != null) {
																			echo $row_select_pipe['rdv2'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="border: 1px solid black;text-align:center; padding: 5px;">3</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['rdv3'] != "" && $row_select_pipe['rdv3'] != "0" && $row_select_pipe['rdv3'] != null) {
																			echo $row_select_pipe['rdv3'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
			<tr style="height:20px;">
				<td colspan="2" style="border: 1px solid black;text-align:right; padding: 5px;">Average &nbsp;</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['avg_rdv'] != "" && $row_select_pipe['avg_rdv'] != "0" && $row_select_pipe['avg_rdv'] != null) {
																			echo $row_select_pipe['avg_rdv'];
																		} else {
																			echo " <br>";
																		} ?></td>
			</tr>
		</table>


		<br><br>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr>
				<td style="border: 1px solid black; padding: 5px;">&nbsp; <b>5. DRY MATERIAL CONTENT AS PER <?php if ($row_select_pipe['dmc_test_method'] != ""  && $row_select_pipe['dmc_test_method'] != null  && $row_select_pipe['dmc_test_method'] != "0"  && $row_select_pipe['dmc_test_method'] != "undefined") {
																												echo $row_select_pipe['dmc_test_method'];
																											} else { ?>IS 9103 : 1999, Annex E (RA 2018) <?php } ?></b></td>
			</tr>
			<!--
				<tr style="border: 0px solid black;">
					<td rowspan="2" colspan="2" style="border: 0px solid black;">&nbsp; <b>5. DRY MATERIAL CONTENT : AS PER  IS 9103 : 1999 Annex E (RA 2018)</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['dmc_s_d'])); ?></td>
				</tr>
				<tr style="border: 0px solid black;">
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($row_select_pipe['dmc_e_d'])); ?></td>
				</tr>-->
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center;font-weight:bold; padding: 5px;">Sr No.</td>
				<td style="width:50%;border: 1px solid black;text-align:center;font-weight:bold;">PERTICULARS</td>
				<td style="width:19%;border: 1px solid black;text-align:center;font-weight:bold;">LIQUID ADMIXTURE</td>
				<td style="width:19%;border: 1px solid black;text-align:center;font-weight:bold;">NON LIQUID ADMIXTURE</td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">1</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF BOTTLE AND SAND (W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w1'] != "" && $row_select_pipe['dmc_w1'] != "0" && $row_select_pipe['dmc_w1'] != null) {
																						echo $row_select_pipe['dmc_w1'];
																					} else {
																						echo " -";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w1'] != "" && $row_select_pipe['dmc_non_w1'] != "0" && $row_select_pipe['dmc_non_w1'] != null) {
																						echo $row_select_pipe['dmc_non_w1'];
																					} else {
																						echo " -";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">2</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF BOTTLE + SAND + SAMPLE (W2)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w2'] != "" && $row_select_pipe['dmc_w2'] != "0" && $row_select_pipe['dmc_w2'] != null) {
																						echo $row_select_pipe['dmc_w2'];
																					} else {
																						echo " -";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w2'] != "" && $row_select_pipe['dmc_non_w2'] != "0" && $row_select_pipe['dmc_non_w2'] != null) {
																						echo $row_select_pipe['dmc_non_w2'];
																					} else {
																						echo " -";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">3</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF SAMPLE (W2-W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w2_w1'] != "" && $row_select_pipe['dmc_w2_w1'] != "0" && $row_select_pipe['dmc_w2_w1'] != null) {
																						echo $row_select_pipe['dmc_w2_w1'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w2_w1'] != "" && $row_select_pipe['dmc_non_w2_w1'] != "0" && $row_select_pipe['dmc_non_w2_w1'] != null) {
																						echo $row_select_pipe['dmc_non_w2_w1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">4</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF BOTTLE, SAND AND DRIED RESIDUE (W3)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w3'] != "" && $row_select_pipe['dmc_w3'] != "0" && $row_select_pipe['dmc_w3'] != null) {
																						echo $row_select_pipe['dmc_w3'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center; padding: 5px;"><?php if ($row_select_pipe['dmc_non_w3'] != "" && $row_select_pipe['dmc_non_w3'] != "0" && $row_select_pipe['dmc_non_w3'] != null) {
																									echo $row_select_pipe['dmc_non_w3'];
																								} else {
																									echo " -";
																								} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">5</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp; WEIGHT OF DRIED RESIDUE (W3-W1)</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_w3_w1'] != "" && $row_select_pipe['dmc_w3_w1'] != "0" && $row_select_pipe['dmc_w3_w1'] != null) {
																						echo $row_select_pipe['dmc_w3_w1'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_w3_w1'] != "" && $row_select_pipe['dmc_non_w3_w1'] != "0" && $row_select_pipe['dmc_non_w3_w1'] != null) {
																						echo $row_select_pipe['dmc_non_w3_w1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr style="height:20px;">
				<td style="width:5%;border: 1px solid black;text-align:center; padding: 5px;">6</td>
				<td style="width:50%;border: 1px solid black;text-align:left;">&nbsp;
					<table class="test">
						<tr>
							<td width="250px" rowspan="2" style="text-align:center;">PERCENT RESIDUE ON DRYING =</td>
							<td width="150px" style="border-bottom: 1px solid black; text-align:center;">W3 - W1</td>
							<td width="50px" rowspan="2" style="text-align:center;"> x 100</td>
						</tr>
						<tr>
							<td style="text-align:center;">W2 - W1</td>
						</tr>
					</table>
				</td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_content'] != "" && $row_select_pipe['dmc_content'] != "0" && $row_select_pipe['dmc_content'] != null) {
																						echo $row_select_pipe['dmc_content'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td style="width:19%;border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['dmc_non_content'] != "" && $row_select_pipe['dmc_non_content'] != "0" && $row_select_pipe['dmc_non_content'] != null) {
																						echo $row_select_pipe['dmc_non_content'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
		</table>

		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="100%" class="test1" style="" height="20%">
			<tbody>
				<tr style="font-size:15px;">
					<td>
						<div style="float:left;">
							<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
							<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br><br><br>
							<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b>
						</div>
					</td>
				</tr>
			</tbody>
		</table>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:2px solid;">
			<tbody>
				<tr style="padding-top:2px;">
					<td style="width:25%;padding-top:4px;">
						<center>Amendment No.: 01</center>
					</td>
					<td style="width:25%;">
						<center>Amendment Date: 01.04.2023</center>
					</td>
					<td style="width:16.67%;">
						<center>Prepared by:</center>
					</td>
					<td style="width:16.67%;">
						<center>Approved by:</center>
					</td>
					<td style="width:16.67%;">
						<center>Issued by:</center>
					</td>
				</tr>
				<tr>
					<td style="">
						<center>Issue No.: 03</center>
					</td>
					<td style="">
						<center>Issue Date: 01.01.2022 </center>
					</td>
					<td style="">
						<center>Nodal QM</center>
					</td>
					<td style="">
						<center>Director</center>
					</td>
					<td style="">
						<center>Nodal QM</center>
					</td>
				</tr>
				<tr style="font-size:10px;">
					<td style="text-align:center;">Page 2 of 2</td>
				</tr>
			</tbody>
		</table>
	</page>






















</body>
<html>


<script type="text/javascript">

</script>