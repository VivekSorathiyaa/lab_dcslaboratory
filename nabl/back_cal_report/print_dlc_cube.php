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
	$select_tiles_query = "select * from dlc_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	<br>
	<br>

	<page size="A4">

		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			<tr>			</tr>


				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
			</tr>
			<tr>

				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
			</tr>
			<tr>

				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>DLC Cube</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>
			</tr>
			<tr>


				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
				<td colspan="2" style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>
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
				<td colspan="3" style="border: 0px solid black;"><b>As per IS 516 (P-1):1959 </b></td>
				<td colspan="3" style="border: 0px solid black;text-align:right;"><b>Age of Specimen :- </b><?php echo $row_select_pipe['day1']; ?></td>

			</tr>

		</table>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">


			<tr style="border: 1px solid black;">
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Sr.<br>No.</center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Cube ID/<br>Grade</center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Date of Casting</center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Date of Testing</center>
				</td>
				<td colspan="3" style="border: 1px solid black;font-weight:bold;">
					<center>Dimension of<br>Specimen in<br>mm</center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>C/S Area<br>in mm<sup>2</sup></center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Weight of<br>Cube<br>(Kg)</center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Max.<br>Load in<br>(KN)</center>
				</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Comp.<br>Strength,<br>(N/mm<sup>2</sup></center>
				</td>

			</tr>
			<tr style="text-align:center">

				<td style="border: 1px solid black;"><b>L</b></td>
				<td style="border: 1px solid black;"><b>B</b></td>
				<td style="border: 1px solid black;"><b>H</b></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;font-weight:bold;">1</td>
				<td rowspan="5" style="border: 1px solid black;"><?php if ($row_select_pipe['grade1'] != "" && $row_select_pipe['grade1'] != "0" && $row_select_pipe['grade1'] != null) {
																		echo $row_select_pipe['grade1'];
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td rowspan="5" style="border: 1px solid black;"><?php if ($row_select_pipe['caste_date1'] != "" && $row_select_pipe['caste_date1'] != "0" && $row_select_pipe['caste_date1'] != null) {
																		echo date('d/m/Y', strtotime($row_select_pipe['caste_date1']));
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td rowspan="5" style="border: 1px solid black;"><?php if ($row_select_pipe['test_date1'] != "" && $row_select_pipe['test_date1'] != "0" && $row_select_pipe['test_date1'] != null) {
																		echo date('d/m/Y', strtotime($row_select_pipe['test_date1']));
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
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_1'] != "" && $row_select_pipe['cross_1'] != "0" && $row_select_pipe['cross_1'] != null) {
															echo $row_select_pipe['cross_1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['mass_1'] != "" && $row_select_pipe['mass_1'] != "0" && $row_select_pipe['mass_1'] != null) {
															echo $row_select_pipe['mass_1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
															echo $row_select_pipe['load_1'];
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
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_2'] != "" && $row_select_pipe['cross_2'] != "0" && $row_select_pipe['cross_2'] != null) {
															echo $row_select_pipe['cross_2'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['mass_2'] != "" && $row_select_pipe['mass_2'] != "0" && $row_select_pipe['mass_2'] != null) {
															echo $row_select_pipe['mass_2'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
															echo $row_select_pipe['load_2'];
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
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_3'] != "" && $row_select_pipe['cross_3'] != "0" && $row_select_pipe['cross_3'] != null) {
															echo $row_select_pipe['cross_3'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['mass_3'] != "" && $row_select_pipe['mass_3'] != "0" && $row_select_pipe['mass_3'] != null) {
															echo $row_select_pipe['mass_3'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
															echo $row_select_pipe['load_3'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['comp_3'] != "" && $row_select_pipe['comp_3'] != "0" && $row_select_pipe['comp_3'] != null) {
															echo $row_select_pipe['comp_3'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;font-weight:bold;">4</td>

				<td style="border: 1px solid black;"><?php if ($row_select_pipe['l4'] != "" && $row_select_pipe['l4'] != "0" && $row_select_pipe['l4'] != null) {
															echo $row_select_pipe['l4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['b4'] != "" && $row_select_pipe['b4'] != "0" && $row_select_pipe['b4'] != null) {
															echo $row_select_pipe['b4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['h4'] != "" && $row_select_pipe['h4'] != "0" && $row_select_pipe['h4'] != null) {
															echo $row_select_pipe['h4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_4'] != "" && $row_select_pipe['cross_4'] != "0" && $row_select_pipe['cross_4'] != null) {
															echo $row_select_pipe['cross_4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['mass_4'] != "" && $row_select_pipe['mass_4'] != "0" && $row_select_pipe['mass_4'] != null) {
															echo $row_select_pipe['mass_4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
															echo $row_select_pipe['load_4'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['comp_4'] != "" && $row_select_pipe['comp_4'] != "0" && $row_select_pipe['comp_4'] != null) {
															echo $row_select_pipe['comp_4'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;font-weight:bold;">5</td>

				<td style="border: 1px solid black;"><?php if ($row_select_pipe['l5'] != "" && $row_select_pipe['l5'] != "0" && $row_select_pipe['l5'] != null) {
															echo $row_select_pipe['l5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['b5'] != "" && $row_select_pipe['b5'] != "0" && $row_select_pipe['b5'] != null) {
															echo $row_select_pipe['b5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['h5'] != "" && $row_select_pipe['h5'] != "0" && $row_select_pipe['h5'] != null) {
															echo $row_select_pipe['h5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['cross_5'] != "" && $row_select_pipe['cross_5'] != "0" && $row_select_pipe['cross_5'] != null) {
															echo $row_select_pipe['cross_5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['mass_5'] != "" && $row_select_pipe['mass_5'] != "0" && $row_select_pipe['mass_5'] != null) {
															echo $row_select_pipe['mass_5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
															echo $row_select_pipe['load_5'];
														} else {
															echo " <br>";
														}  ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['comp_5'] != "" && $row_select_pipe['comp_5'] != "0" && $row_select_pipe['comp_5'] != null) {
															echo $row_select_pipe['comp_5'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td colspan="10" style="border: 1px solid black;font-weight:bold;text-align:right;">Average</td>

				<td style="border: 1px solid black;"><?php if ($row_select_pipe['avg_com_s_1'] != "" && $row_select_pipe['avg_com_s_1'] != "0" && $row_select_pipe['avg_com_s_1'] != null) {
															echo $row_select_pipe['avg_com_s_1'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>


			<br>
			<br>
		</table>







	</page>

</body>

</html>


<script type="text/javascript">


</script>