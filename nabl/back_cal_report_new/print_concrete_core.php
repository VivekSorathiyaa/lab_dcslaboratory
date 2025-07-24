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
	$select_tiles_query = "select * from concrete_core WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	?>

	<br>
	<br>


	<page size="A4">
		<table align="center" width="94%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-053</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE<br> STRENGTH OF CONCRETE CORE</b></center>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" class="test1" height="15%">

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
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Grade Of Concrete</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['bitumin_grade']; ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of Casting</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; </td>
			</tr>
		</table>
		<br>
		<!-- <table align="center" width="94%" class="test" style="border: 1px solid black;" cellpadding="2px">
			<tr style="">

				<td style="width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
				<td style="border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
			</tr>

			<tr style="">

				<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $lab_no; ?><?php echo $sample_no; ?></td>
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
		</table>
		<br> -->
		<table align="center" width="94%" height="25%" class="test" style="border: 1px solid black;font-size:10px;" cellpadding="3px">
			<tr>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Location of Core</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Weight (gm)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Dia (mm)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Height (mm)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Area (mm<sup>2</sup>)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Ratio</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Volume (m<sup>3</sup>)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Density (Kg/m<sup>3</sup>)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Diameter Correction</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Correction</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Corrected Comp. Strength</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>Average Equiv.Cube Strength</b></td>
			</tr>
			<?php
			$select_tiles_query = "select * from concrete_core WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			if (mysqli_num_rows($result_tiles_select) > 0) {
				while ($row_select_pipe = mysqli_fetch_array($result_tiles_select)) {
			?>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['location1'] != "" && $row_select_pipe['location1'] != "0" && $row_select_pipe['location1'] != null) {
																					echo $row_select_pipe['location1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['weight1'] != "" && $row_select_pipe['weight1'] != "0" && $row_select_pipe['weight1'] != null) {
																					echo $row_select_pipe['weight1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != "0" && $row_select_pipe['dia1'] != null) {
																					echo $row_select_pipe['dia1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['height1'] != "" && $row_select_pipe['height1'] != "0" && $row_select_pipe['height1'] != null) {
																					echo $row_select_pipe['height1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) {
																					echo $row_select_pipe['area1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_ratio1'] != "" && $row_select_pipe['hd_ratio1'] != "0" && $row_select_pipe['hd_ratio1'] != null) {
																					echo $row_select_pipe['hd_ratio1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['vol1'] != "" && $row_select_pipe['vol1'] != "0" && $row_select_pipe['vol1'] != null) {
																					echo $row_select_pipe['vol1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != "0" && $row_select_pipe['den1'] != null) {
																					echo $row_select_pipe['den1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != "0" && $row_select_pipe['load1'] != null) {
																					echo $row_select_pipe['load1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com1'] != "" && $row_select_pipe['com1'] != "0" && $row_select_pipe['com1'] != null) {
																					echo $row_select_pipe['com1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia_corr1'] != "" && $row_select_pipe['dia_corr1'] != "0" && $row_select_pipe['dia_corr1'] != null) {
																					echo $row_select_pipe['dia_corr1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_corr1'] != "" && $row_select_pipe['hd_corr1'] != "0" && $row_select_pipe['hd_corr1'] != null) {
																					echo $row_select_pipe['hd_corr1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['corr_com1'] != "" && $row_select_pipe['corr_com1'] != "0" && $row_select_pipe['corr_com1'] != null) {
																					echo $row_select_pipe['corr_com1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['eq_cube1'] != "" && $row_select_pipe['eq_cube1'] != "0" && $row_select_pipe['eq_cube1'] != null) {
																					echo $row_select_pipe['eq_cube1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
						<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['eq_cube1'] != "" && $row_select_pipe['eq_cube1'] != "0" && $row_select_pipe['eq_cube1'] != null) {
																					echo $row_select_pipe['eq_cube1'];
																				} else {
																					echo "&nbsp;";
																				} ?></b></td>
					</tr>
			<?php
				}
			}

			?>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="margin-bottom: 20px;" Height="20%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>
	</page>

</body>

</html>


<script type="text/javascript">
	window.print();
</script>