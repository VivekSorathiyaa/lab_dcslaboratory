<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0px 40px;
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
	$select_tiles_query = "select * from ms_plate_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);


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
		$ms_grade = $row_select4['ms_grade'];
	}

	?>

	<br><br><br>

	<page size="A4">
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;"><?php echo $mt_name; ?></td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
				<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS</td>
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 2062:2011  Grade:<?php echo $row_select_pipe['ms_grade']; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1">

			<tbody>
				<tr style="border: 1px solid black;border-top: 0;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Sample Received Date</b>&nbsp;</td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Start Date</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Complete Date</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Sample Type</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['sample_type']; ?></td>
				</tr>
			</tbody>
		</table>

		<br>
	
		<table align="center" width="100%" class="test1" style="border: 1px solid black;" cellspacing="0" cellpadding="4px">

			<tr>
				<td width="10%" style="border: 1px solid black; font-size:12px;"><b>
						<center>&#x2022;</center>
					</b></td>
				<td width="45%" style="border: 1px solid black; font-size:12px;"><b>Chemical Element</b></td>
				<td width="45%" style="border: 1px solid black; font-size:12px;text-align:center;"><b>Test Results</b></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>1</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Carbon (C), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c1'] != "" && $row_select_pipe['c1'] != "0" && $row_select_pipe['c1'] != null) {
																						echo $row_select_pipe['c1'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>2</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Manganese (Mn), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c5'] != "" && $row_select_pipe['c5'] != "0" && $row_select_pipe['c5'] != null) {
																						echo $row_select_pipe['c5'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>3</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Phosphorous (P), %</b></td>

				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c3'] != "" && $row_select_pipe['c3'] != "0" && $row_select_pipe['c3'] != null) {
																						echo $row_select_pipe['c3'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>4</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Sulphur (S), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c2'] != "" && $row_select_pipe['c2'] != "0" && $row_select_pipe['c2'] != null) {
																						echo $row_select_pipe['c2'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>

			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>5</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>(P) + (S), % </b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c3'] != "" && $row_select_pipe['c3'] != null && $row_select_pipe['c3'] != "0" && $row_select_pipe['c2'] != "" && $row_select_pipe['c2'] != null && $row_select_pipe['c2'] != "0") {
																						$a2 = number_format($row_select_pipe['c3'], 3) + number_format($row_select_pipe['c2'], 3);


																						echo $a2;
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>6</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Chromium (Cr), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c6'] != "" && $row_select_pipe['c6'] != "0" && $row_select_pipe['c6'] != null) {
																						echo $row_select_pipe['c6'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>7</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Molybdenum (Mo), % </b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c9'] != "" && $row_select_pipe['c9'] != "0" && $row_select_pipe['c9'] != null) {
																						echo $row_select_pipe['c9'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>8</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Nickel (Ni), % </b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c8'] != "" && $row_select_pipe['c8'] != "0" && $row_select_pipe['c8'] != null) {
																						echo $row_select_pipe['c8'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>9</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Copper (Cu), % </b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c7'] != "" && $row_select_pipe['c7'] != "0" && $row_select_pipe['c7'] != null) {
																						echo $row_select_pipe['c7'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>10</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Niobium (Nb), % </b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c10'] != "" && $row_select_pipe['c10'] != "0" && $row_select_pipe['c10'] != null) {
																						echo $row_select_pipe['c10'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>11</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Vanadium (V), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c11'] != "" && $row_select_pipe['c11'] != "0" && $row_select_pipe['c11'] != null) {
																						echo $row_select_pipe['c11'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>12</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Boron (B), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c12'] != "" && $row_select_pipe['c12'] != "0" && $row_select_pipe['c12'] != null) {
																						echo $row_select_pipe['c12'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>13</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Titanium (Ti), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c13'] != "" && $row_select_pipe['c13'] != "0" && $row_select_pipe['c13'] != null) {
																						echo $row_select_pipe['c13'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>14</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Nitrogen (N), % </b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c14'] != "" && $row_select_pipe['c14'] != "0" && $row_select_pipe['c14'] != null) {
																						echo $row_select_pipe['c14'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>15</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Carbon Equivalent (CE), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php
																					$ans1 = number_format($row_select_pipe['c1'], 3);
																					$ans2 = number_format($row_select_pipe['c5'], 3) / 6;
																					$ans3 = (number_format($row_select_pipe['c6'], 3) + number_format($row_select_pipe['c9'], 3) + number_format($row_select_pipe['c11'], 3)) / 5;
																					$ans4 = (number_format($row_select_pipe['c8'], 3) + number_format($row_select_pipe['c7'], 3)) / 15;

																					$final = $ans1 + $ans2 + $ans3 + $ans4;
																					echo number_format($final, 3);

																					?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>16</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>Silicon (Si), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['c4'] != "" && $row_select_pipe['c4'] != "0" && $row_select_pipe['c4'] != null) {
																						echo $row_select_pipe['c4'];
																					} else {
																						echo " <br>";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>17</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>(Nb) + (V) + (B) + (Ti), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php $a1 = number_format($row_select_pipe['c10'], 3) + number_format($row_select_pipe['c11'], 3) + number_format($row_select_pipe['c12'], 4) + number_format($row_select_pipe['c13'], 3);
																					echo number_format($a1, 3); ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>18</center>
					</b></td>
				<td width="45%" style="border: 1px solid black;"><b>(Cr) + (Cu) + (Ni) + (Mo) + (P), %</b></td>
				<td width="45%" style="border: 1px solid black;text-align:center;"><?php $a5 = number_format($row_select_pipe['c6'], 3) + number_format($row_select_pipe['c7'], 3) + number_format($row_select_pipe['c8'], 4) + number_format($row_select_pipe['c9'], 3) + number_format($row_select_pipe['c3'], 3);
																					echo number_format($a5, 3); ?></td>
			</tr>

			<tr>
				<td width="10%" style="border: 1px solid black;"><b>
						<center>Remarks</center>
					</b></td>
				<td colspan="2" style="border: 1px solid black;"><b></b></td>
			</tr>
		</table>


		<!-- footer design -->
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
		<table align="center" width="100%"  style="margin-top: 2px;font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
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

	</page>

</body>

</html>

<script type="text/javascript">

</script>