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
	$entity = '&radic;';

	// select the one you like the best
	$squareRoot = '√';
	$squareRoot = html_entity_decode($entity);
	$squareRoot = mb_convert_encoding($entity, 'UTF-8', 'HTML-ENTITIES');

	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from kerb_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	}

	$pagecnt = 1;
	$totalcnt = 1;
	if (($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) {
		$totalcnt++;
	}


	?>

	<br>
	<br>
	<br>

	<page size="A4">
		<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

			<tr style="">

				<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px;border-left:1px solid; ">&nbsp;&nbsp; DOC : GOMAEC/E/OS/01</td>
				<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
				<td style="width:25%; font-weight:bold;">RD :- 06/01/2023</td>
				<td style="width:25%;font-weight:bold;border-right:1px solid;">Page : </td>
			</tr>
		</table>
		<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

			<tr style="">

				<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;border-left:1px solid;   ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
				<td style="width:40%;text-align:left;font-weight:bold;border-right:1px solid; ">Approved by : Quality Manager</td>
			</tr>

		</table>
		<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-left:1px solid; border-right:1px solid; ">

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
		<?php $cnt = 1 ?>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="2px">
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
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Date of Casting: -</td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($cast_date)); ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Type Of Kerb: </td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['kerb_type']; ?></td>
			</tr>
			<tr style="">
				<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Grade Of Kerb: </td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $row_select_pipe['kerb_grade']; ?></td>
			</tr>
		</table>


		<p style="margin-left:50px; font-size:16px; font-weight:700;">1. Dimention and Tolerance (IS : 5758)</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Length (mm)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Width (mm)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Thickness (mm)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length1'] != "" && $row_select_pipe['length1'] != "0" && $row_select_pipe['length1'] != null) {
																				echo $row_select_pipe['length1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width1'] != "" && $row_select_pipe['width1'] != "0" && $row_select_pipe['width1'] != null) {
																				echo $row_select_pipe['width1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thickness1'] != "" && $row_select_pipe['thickness1'] != "0" && $row_select_pipe['thickness1'] != null) {
																				echo $row_select_pipe['thickness1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
		</table>

		<br>
		<p style="margin-left:50px; font-size:16px; font-weight:700;">2. Water Absorption (IS : 5758 (Annex - B))</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Laboratory Ref. No</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Oven dry weight in (gm) (W1)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Saturated surface dry weight in gm (W2)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Water absorption (%) = (W2 - W1/ W1) x 100</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['w1_1'] != "" && $row_select_pipe['w1_1'] != "0" && $row_select_pipe['w1_1'] != null) {
																				echo $row_select_pipe['w1_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['w2_1'] != "" && $row_select_pipe['w2_1'] != "0" && $row_select_pipe['w2_1'] != null) {
																				echo $row_select_pipe['w2_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != "0" && $row_select_pipe['wtr1'] != null) {
																				echo $row_select_pipe['wtr1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['w1_2'] != "" && $row_select_pipe['w1_2'] != "0" && $row_select_pipe['w1_2'] != null) {
																				echo $row_select_pipe['w1_2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['w2_2'] != "" && $row_select_pipe['w2_2'] != "0" && $row_select_pipe['w2_2'] != null) {
																				echo $row_select_pipe['w2_2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != "0" && $row_select_pipe['wtr2'] != null) {
																				echo $row_select_pipe['wtr2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['w1_3'] != "" && $row_select_pipe['w1_3'] != "0" && $row_select_pipe['w1_3'] != null) {
																				echo $row_select_pipe['w1_3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['w2_3'] != "" && $row_select_pipe['w2_3'] != "0" && $row_select_pipe['w2_3'] != null) {
																				echo $row_select_pipe['w2_3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != "0" && $row_select_pipe['wtr3'] != null) {
																				echo $row_select_pipe['wtr3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
		</table>
		<br>
		<p style="margin-left:50px; font-size:16px; font-weight:700;">3. Transvers Strength (IS : 5758(Annex A))</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Laboratory Ref. No</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Length (L) cm</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Breadth (B) cm</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Height (H) cm</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Ageing Factor</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Corrected Load (KN)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Observation</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['len1'] != "" && $row_select_pipe['len1'] != "0" && $row_select_pipe['len1'] != null) {
																				echo $row_select_pipe['len1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['bre1'] != "" && $row_select_pipe['bre1'] != "0" && $row_select_pipe['bre1'] != null) {
																				echo $row_select_pipe['bre1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['h1'] != "" && $row_select_pipe['h1'] != "0" && $row_select_pipe['h1'] != null) {
																				echo $row_select_pipe['h1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != "0" && $row_select_pipe['load1'] != null) {
																				echo $row_select_pipe['load1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['factor1'] != "" && $row_select_pipe['factor1'] != "0" && $row_select_pipe['factor1'] != null) {
																				echo $row_select_pipe['factor1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['corr1'] != "" && $row_select_pipe['corr1'] != "0" && $row_select_pipe['corr1'] != null) {
																				echo $row_select_pipe['corr1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['obs1'] != "" && $row_select_pipe['obs1'] != "0" && $row_select_pipe['obs1'] != null) {
																				echo $row_select_pipe['obs1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['len2'] != "" && $row_select_pipe['len2'] != "0" && $row_select_pipe['len2'] != null) {
																				echo $row_select_pipe['len2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['bre2'] != "" && $row_select_pipe['bre2'] != "0" && $row_select_pipe['bre2'] != null) {
																				echo $row_select_pipe['bre2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['h2'] != "" && $row_select_pipe['h2'] != "0" && $row_select_pipe['h2'] != null) {
																				echo $row_select_pipe['h2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load2'] != "" && $row_select_pipe['load2'] != "0" && $row_select_pipe['load2'] != null) {
																				echo $row_select_pipe['load2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['factor2'] != "" && $row_select_pipe['factor2'] != "0" && $row_select_pipe['factor2'] != null) {
																				echo $row_select_pipe['factor2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['corr2'] != "" && $row_select_pipe['corr2'] != "0" && $row_select_pipe['corr2'] != null) {
																				echo $row_select_pipe['corr2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['obs2'] != "" && $row_select_pipe['obs2'] != "0" && $row_select_pipe['obs2'] != null) {
																				echo $row_select_pipe['obs2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['len3'] != "" && $row_select_pipe['len3'] != "0" && $row_select_pipe['len3'] != null) {
																				echo $row_select_pipe['len3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['bre3'] != "" && $row_select_pipe['bre3'] != "0" && $row_select_pipe['bre3'] != null) {
																				echo $row_select_pipe['bre3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['h3'] != "" && $row_select_pipe['h3'] != "0" && $row_select_pipe['h3'] != null) {
																				echo $row_select_pipe['h3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['load3'] != "" && $row_select_pipe['load3'] != "0" && $row_select_pipe['load3'] != null) {
																				echo $row_select_pipe['load3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['factor3'] != "" && $row_select_pipe['factor3'] != "0" && $row_select_pipe['factor3'] != null) {
																				echo $row_select_pipe['factor3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['corr3'] != "" && $row_select_pipe['corr3'] != "0" && $row_select_pipe['corr3'] != null) {
																				echo $row_select_pipe['corr3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['obs3'] != "" && $row_select_pipe['obs3'] != "0" && $row_select_pipe['obs3'] != null) {
																				echo $row_select_pipe['obs3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td colspan="7" style="border: 1px solid black; text-align:right;"><b>Average : </b></td>

				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_obs'] != "" && $row_select_pipe['avg_obs'] != "0" && $row_select_pipe['avg_obs'] != null) {
																				echo $row_select_pipe['avg_obs'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<p style="margin-left:50px; font-size:16px; font-weight:700;">4. Surface layer in Thickness in mm = <?php if ($row_select_pipe['avg_sur'] != "" && $row_select_pipe['avg_sur'] != "0" && $row_select_pipe['avg_sur'] != null) {
																												echo $row_select_pipe['avg_sur'];
																											} else {
																												echo "&nbsp;";
																											} ?></p>

		<br>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Tested By:</b></td>
				<td width="50%" style="border: 1px solid black;"><b>Checked By:</b></td>
			</tr>
		</table>

	</page>

</body>

</html>