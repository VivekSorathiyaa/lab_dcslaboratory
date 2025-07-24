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
	$select_tiles_query = "select * from ceramic_tiles WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
			</tr>
		</table>
		<p style="font-size:16px; font-weight:700; margin-left:50px;">&bull; Moulus of Rupture and Breaking Strength:(IS 13630, P-6)</p>
		<p style="font-size:14px; font-weight:500; margin-left:50px;">Dimention of Tile in mm (1)> 48: 77 specimen (2) < 48> 18:10 speciment</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>SR No.</b></td>
				<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Dimention in mm</b></td>
				<td width="15%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Span Support rods in mm (L)</b></td>
				<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Breaking Load <br>(F)</b></td>
				<td width="20%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Modulus of Rupture Strength in N.mm<sup>2</sup> = 3FL/2bh<sup>2</sup></b></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>Length</b></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>Width <br>(a)</b></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>Thickness</b></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>Kg</b></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>N</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima1'] != "" && $row_select_pipe['dima1'] != "0" && $row_select_pipe['dima1'] != null) {
																				echo $row_select_pipe['dima1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb1'] != "" && $row_select_pipe['dimb1'] != "0" && $row_select_pipe['dimb1'] != null) {
																				echo $row_select_pipe['dimb1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh1'] != "" && $row_select_pipe['dimh1'] != "0" && $row_select_pipe['dimh1'] != null) {
																				echo $row_select_pipe['dimh1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																				echo $row_select_pipe['l1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa1'] != "" && $row_select_pipe['wa1'] != "0" && $row_select_pipe['wa1'] != null) {
																				echo $row_select_pipe['wa1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str1'] != "" && $row_select_pipe['str1'] != "0" && $row_select_pipe['str1'] != null) {
																				echo $row_select_pipe['str1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr1'] != "" && $row_select_pipe['rstr1'] != "0" && $row_select_pipe['rstr1'] != null) {
																				echo $row_select_pipe['rstr1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima2'] != "" && $row_select_pipe['dima2'] != "0" && $row_select_pipe['dima2'] != null) {
																				echo $row_select_pipe['dima2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb2'] != "" && $row_select_pipe['dimb2'] != "0" && $row_select_pipe['dimb2'] != null) {
																				echo $row_select_pipe['dimb2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh2'] != "" && $row_select_pipe['dimh2'] != "0" && $row_select_pipe['dimh2'] != null) {
																				echo $row_select_pipe['dimh2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != "0" && $row_select_pipe['l2'] != null) {
																				echo $row_select_pipe['l2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa2'] != "" && $row_select_pipe['wa2'] != "0" && $row_select_pipe['wa2'] != null) {
																				echo $row_select_pipe['wa2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str2'] != "" && $row_select_pipe['str2'] != "0" && $row_select_pipe['str2'] != null) {
																				echo $row_select_pipe['str2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr2'] != "" && $row_select_pipe['rstr2'] != "0" && $row_select_pipe['rstr2'] != null) {
																				echo $row_select_pipe['rstr2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima3'] != "" && $row_select_pipe['dima3'] != "0" && $row_select_pipe['dima3'] != null) {
																				echo $row_select_pipe['dima3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb3'] != "" && $row_select_pipe['dimb3'] != "0" && $row_select_pipe['dimb3'] != null) {
																				echo $row_select_pipe['dimb3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh3'] != "" && $row_select_pipe['dimh3'] != "0" && $row_select_pipe['dimh3'] != null) {
																				echo $row_select_pipe['dimh3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != "0" && $row_select_pipe['l3'] != null) {
																				echo $row_select_pipe['l3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa3'] != "" && $row_select_pipe['wa3'] != "0" && $row_select_pipe['wa3'] != null) {
																				echo $row_select_pipe['wa3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str3'] != "" && $row_select_pipe['str3'] != "0" && $row_select_pipe['str3'] != null) {
																				echo $row_select_pipe['str3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr3'] != "" && $row_select_pipe['rstr3'] != "0" && $row_select_pipe['rstr3'] != null) {
																				echo $row_select_pipe['rstr3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima4'] != "" && $row_select_pipe['dima4'] != "0" && $row_select_pipe['dima4'] != null) {
																				echo $row_select_pipe['dima4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb4'] != "" && $row_select_pipe['dimb4'] != "0" && $row_select_pipe['dimb4'] != null) {
																				echo $row_select_pipe['dimb4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh4'] != "" && $row_select_pipe['dimh4'] != "0" && $row_select_pipe['dimh4'] != null) {
																				echo $row_select_pipe['dimh4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l4'] != "" && $row_select_pipe['l4'] != "0" && $row_select_pipe['l4'] != null) {
																				echo $row_select_pipe['l4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa4'] != "" && $row_select_pipe['wa4'] != "0" && $row_select_pipe['wa4'] != null) {
																				echo $row_select_pipe['wa4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str4'] != "" && $row_select_pipe['str4'] != "0" && $row_select_pipe['str4'] != null) {
																				echo $row_select_pipe['str4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr4'] != "" && $row_select_pipe['rstr4'] != "0" && $row_select_pipe['rstr4'] != null) {
																				echo $row_select_pipe['rstr4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima5'] != "" && $row_select_pipe['dima5'] != "0" && $row_select_pipe['dima5'] != null) {
																				echo $row_select_pipe['dima5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb5'] != "" && $row_select_pipe['dimb5'] != "0" && $row_select_pipe['dimb5'] != null) {
																				echo $row_select_pipe['dimb5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh5'] != "" && $row_select_pipe['dimh5'] != "0" && $row_select_pipe['dimh5'] != null) {
																				echo $row_select_pipe['dimh5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l5'] != "" && $row_select_pipe['l5'] != "0" && $row_select_pipe['l5'] != null) {
																				echo $row_select_pipe['l5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa5'] != "" && $row_select_pipe['wa5'] != "0" && $row_select_pipe['wa5'] != null) {
																				echo $row_select_pipe['wa5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str5'] != "" && $row_select_pipe['str5'] != "0" && $row_select_pipe['str5'] != null) {
																				echo $row_select_pipe['str5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr5'] != "" && $row_select_pipe['rstr5'] != "0" && $row_select_pipe['rstr5'] != null) {
																				echo $row_select_pipe['rstr5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima6'] != "" && $row_select_pipe['dima6'] != "0" && $row_select_pipe['dima6'] != null) {
																				echo $row_select_pipe['dima6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb6'] != "" && $row_select_pipe['dimb6'] != "0" && $row_select_pipe['dimb6'] != null) {
																				echo $row_select_pipe['dimb6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh6'] != "" && $row_select_pipe['dimh6'] != "0" && $row_select_pipe['dimh6'] != null) {
																				echo $row_select_pipe['dimh6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l6'] != "" && $row_select_pipe['l6'] != "0" && $row_select_pipe['l6'] != null) {
																				echo $row_select_pipe['l6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa6'] != "" && $row_select_pipe['wa6'] != "0" && $row_select_pipe['wa6'] != null) {
																				echo $row_select_pipe['wa6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str6'] != "" && $row_select_pipe['str6'] != "0" && $row_select_pipe['str6'] != null) {
																				echo $row_select_pipe['str6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr6'] != "" && $row_select_pipe['rstr6'] != "0" && $row_select_pipe['rstr6'] != null) {
																				echo $row_select_pipe['rstr6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dima7'] != "" && $row_select_pipe['dima7'] != "0" && $row_select_pipe['dima7'] != null) {
																				echo $row_select_pipe['dima7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimb7'] != "" && $row_select_pipe['dimb7'] != "0" && $row_select_pipe['dimb7'] != null) {
																				echo $row_select_pipe['dimb7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dimh7'] != "" && $row_select_pipe['dimh7'] != "0" && $row_select_pipe['dimh7'] != null) {
																				echo $row_select_pipe['dimh7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['l7'] != "" && $row_select_pipe['l7'] != "0" && $row_select_pipe['l7'] != null) {
																				echo $row_select_pipe['l7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wa7'] != "" && $row_select_pipe['wa7'] != "0" && $row_select_pipe['wa7'] != null) {
																				echo $row_select_pipe['wa7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['str7'] != "" && $row_select_pipe['str7'] != "0" && $row_select_pipe['str7'] != null) {
																				echo $row_select_pipe['str7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['rstr7'] != "" && $row_select_pipe['rstr7'] != "0" && $row_select_pipe['rstr7'] != null) {
																				echo $row_select_pipe['rstr7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>

			<tr>
				<td colspan="6" style="border: 1px solid black; text-align:right;"><b>Average</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_str'] != "" && $row_select_pipe['avg_str'] != "0" && $row_select_pipe['avg_str'] != null) {
																				echo $row_select_pipe['avg_str'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_rstr'] != "" && $row_select_pipe['avg_rstr'] != "0" && $row_select_pipe['avg_rstr'] != null) {
																				echo $row_select_pipe['avg_rstr'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
		</table>
		<br>
		<p style="font-size:16px; font-weight:700; margin-left:50px;">&bull; Scratch Hardness of Surface of Surface(Mkhs' Scale):(IS 13630, P-13)</p>
		<p style="font-size:14px; font-weight:500; margin-left:50px;">Minimum of three tie shall be tested.</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>SR No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Mohs' Scale No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['s1'] != "" && $row_select_pipe['s1'] != "0" && $row_select_pipe['s1'] != null) {
																				echo $row_select_pipe['s1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['s2'] != "" && $row_select_pipe['s2'] != "0" && $row_select_pipe['s2'] != null) {
																				echo $row_select_pipe['s2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['s3'] != "" && $row_select_pipe['s3'] != "0" && $row_select_pipe['s3'] != null) {
																				echo $row_select_pipe['s3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
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
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
			<tr>
				<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>
				<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>
			</tr>
		</table>
		<div class="pagebreak"> </div>
		<br>
		<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-left:1px solid; border-right:1px solid; border-top:1px solid; ">

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
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
			</tr>
		</table>
		<p style="font-size:16px; font-weight:700; margin-left:50px;">&bull; Dimention and Surface Quality(IS 13630, P-1)</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>SR No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Length</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Width</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Thickness</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_1_1'] != "" && $row_select_pipe['length_1_1'] != "0" && $row_select_pipe['length_1_1'] != null) {
																				echo $row_select_pipe['length_1_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_1_1'] != "" && $row_select_pipe['width_1_1'] != "0" && $row_select_pipe['width_1_1'] != null) {
																				echo $row_select_pipe['width_1_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_1_1'] != "" && $row_select_pipe['thick_1_1'] != "0" && $row_select_pipe['thick_1_1'] != null) {
																				echo $row_select_pipe['thick_1_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_2_1'] != "" && $row_select_pipe['length_2_1'] != "0" && $row_select_pipe['length_2_1'] != null) {
																				echo $row_select_pipe['length_2_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_2_1'] != "" && $row_select_pipe['width_2_1'] != "0" && $row_select_pipe['width_2_1'] != null) {
																				echo $row_select_pipe['width_2_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_2_1'] != "" && $row_select_pipe['thick_2_1'] != "0" && $row_select_pipe['thick_2_1'] != null) {
																				echo $row_select_pipe['thick_2_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_3_1'] != "" && $row_select_pipe['length_3_1'] != "0" && $row_select_pipe['length_3_1'] != null) {
																				echo $row_select_pipe['length_3_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_3_1'] != "" && $row_select_pipe['width_3_1'] != "0" && $row_select_pipe['width_3_1'] != null) {
																				echo $row_select_pipe['width_3_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_3_1'] != "" && $row_select_pipe['thick_3_1'] != "0" && $row_select_pipe['thick_3_1'] != null) {
																				echo $row_select_pipe['thick_3_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_4_1'] != "" && $row_select_pipe['length_4_1'] != "0" && $row_select_pipe['length_4_1'] != null) {
																				echo $row_select_pipe['length_4_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_4_1'] != "" && $row_select_pipe['width_4_1'] != "0" && $row_select_pipe['width_4_1'] != null) {
																				echo $row_select_pipe['width_4_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_4_1'] != "" && $row_select_pipe['thick_4_1'] != "0" && $row_select_pipe['thick_4_1'] != null) {
																				echo $row_select_pipe['thick_4_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_5_1'] != "" && $row_select_pipe['length_5_1'] != "0" && $row_select_pipe['length_5_1'] != null) {
																				echo $row_select_pipe['length_5_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_5_1'] != "" && $row_select_pipe['width_5_1'] != "0" && $row_select_pipe['width_5_1'] != null) {
																				echo $row_select_pipe['width_5_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_5_1'] != "" && $row_select_pipe['thick_5_1'] != "0" && $row_select_pipe['thick_5_1'] != null) {
																				echo $row_select_pipe['thick_5_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_6_1'] != "" && $row_select_pipe['length_6_1'] != "0" && $row_select_pipe['length_6_1'] != null) {
																				echo $row_select_pipe['length_6_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_6_1'] != "" && $row_select_pipe['width_6_1'] != "0" && $row_select_pipe['width_6_1'] != null) {
																				echo $row_select_pipe['width_6_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_6_1'] != "" && $row_select_pipe['thick_6_1'] != "0" && $row_select_pipe['thick_6_1'] != null) {
																				echo $row_select_pipe['thick_6_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_7_1'] != "" && $row_select_pipe['length_7_1'] != "0" && $row_select_pipe['length_7_1'] != null) {
																				echo $row_select_pipe['length_7_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_7_1'] != "" && $row_select_pipe['width_7_1'] != "0" && $row_select_pipe['width_7_1'] != null) {
																				echo $row_select_pipe['width_7_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_7_1'] != "" && $row_select_pipe['thick_7_1'] != "0" && $row_select_pipe['thick_7_1'] != null) {
																				echo $row_select_pipe['thick_7_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>8.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_8_1'] != "" && $row_select_pipe['length_8_1'] != "0" && $row_select_pipe['length_8_1'] != null) {
																				echo $row_select_pipe['length_8_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_8_1'] != "" && $row_select_pipe['width_8_1'] != "0" && $row_select_pipe['width_8_1'] != null) {
																				echo $row_select_pipe['width_8_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_8_1'] != "" && $row_select_pipe['thick_8_1'] != "0" && $row_select_pipe['thick_8_1'] != null) {
																				echo $row_select_pipe['thick_8_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>9.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_9_1'] != "" && $row_select_pipe['length_9_1'] != "0" && $row_select_pipe['length_9_1'] != null) {
																				echo $row_select_pipe['length_9_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_9_1'] != "" && $row_select_pipe['width_9_1'] != "0" && $row_select_pipe['width_9_1'] != null) {
																				echo $row_select_pipe['width_9_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_9_1'] != "" && $row_select_pipe['thick_9_1'] != "0" && $row_select_pipe['thick_9_1'] != null) {
																				echo $row_select_pipe['thick_9_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>10.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['length_10_1'] != "" && $row_select_pipe['length_10_1'] != "0" && $row_select_pipe['length_10_1'] != null) {
																				echo $row_select_pipe['length_10_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['width_10_1'] != "" && $row_select_pipe['width_10_1'] != "0" && $row_select_pipe['width_10_1'] != null) {
																				echo $row_select_pipe['width_10_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['thick_10_1'] != "" && $row_select_pipe['thick_10_1'] != "0" && $row_select_pipe['thick_10_1'] != null) {
																				echo $row_select_pipe['thick_10_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Average:</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_1_1'] != "" && $row_select_pipe['avg_1_1'] != "0" && $row_select_pipe['avg_1_1'] != null) {
																				echo $row_select_pipe['avg_1_1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_1_5'] != "" && $row_select_pipe['avg_1_5'] != "0" && $row_select_pipe['avg_1_5'] != null) {
																				echo $row_select_pipe['avg_1_5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_1_9'] != "" && $row_select_pipe['avg_1_9'] != "0" && $row_select_pipe['avg_1_9'] != null) {
																				echo $row_select_pipe['avg_1_9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
		</table>
		<br>
		<p style="font-size:16px; font-weight:700; margin-left:70px;">&bull; Water Absorption:(IS 13630, P-2)</p>
		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>SR No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Weight of Oven Dry Sample in g <br>(A)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Weight of saturated Surface Dry in g <br>(B)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Water Absorption in %<br> = 100(B-A)/A</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a1'] != "" && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {
																				echo $row_select_pipe['a1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b1'] != "" && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {
																				echo $row_select_pipe['b1'];
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
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a2'] != "" && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {
																				echo $row_select_pipe['a2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b2'] != "" && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {
																				echo $row_select_pipe['b2'];
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
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a3'] != "" && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {
																				echo $row_select_pipe['a3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b3'] != "" && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {
																				echo $row_select_pipe['b3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != "0" && $row_select_pipe['wtr3'] != null) {
																				echo $row_select_pipe['wtr3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a4'] != "" && $row_select_pipe['a4'] != "0" && $row_select_pipe['a4'] != null) {
																				echo $row_select_pipe['a4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b4'] != "" && $row_select_pipe['b4'] != "0" && $row_select_pipe['b4'] != null) {
																				echo $row_select_pipe['b4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr4'] != "" && $row_select_pipe['wtr4'] != "0" && $row_select_pipe['wtr4'] != null) {
																				echo $row_select_pipe['wtr4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a5'] != "" && $row_select_pipe['a5'] != "0" && $row_select_pipe['a5'] != null) {
																				echo $row_select_pipe['a5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b5'] != "" && $row_select_pipe['b5'] != "0" && $row_select_pipe['b5'] != null) {
																				echo $row_select_pipe['b5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr5'] != "" && $row_select_pipe['wtr5'] != "0" && $row_select_pipe['wtr5'] != null) {
																				echo $row_select_pipe['wtr5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a6'] != "" && $row_select_pipe['a6'] != "0" && $row_select_pipe['a6'] != null) {
																				echo $row_select_pipe['a6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b6'] != "" && $row_select_pipe['b6'] != "0" && $row_select_pipe['b6'] != null) {
																				echo $row_select_pipe['b6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr6'] != "" && $row_select_pipe['wtr6'] != "0" && $row_select_pipe['wtr6'] != null) {
																				echo $row_select_pipe['wtr6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a7'] != "" && $row_select_pipe['a7'] != "0" && $row_select_pipe['a7'] != null) {
																				echo $row_select_pipe['a7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b7'] != "" && $row_select_pipe['b7'] != "0" && $row_select_pipe['b7'] != null) {
																				echo $row_select_pipe['b7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr7'] != "" && $row_select_pipe['wtr7'] != "0" && $row_select_pipe['wtr7'] != null) {
																				echo $row_select_pipe['wtr7'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>8.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a8'] != "" && $row_select_pipe['a8'] != "0" && $row_select_pipe['a8'] != null) {
																				echo $row_select_pipe['a8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b8'] != "" && $row_select_pipe['b8'] != "0" && $row_select_pipe['b8'] != null) {
																				echo $row_select_pipe['b8'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr8'] != "" && $row_select_pipe['wtr8'] != "0" && $row_select_pipe['wtr8'] != null) {
																				echo $row_select_pipe['wtr1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>9.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a9'] != "" && $row_select_pipe['a9'] != "0" && $row_select_pipe['a9'] != null) {
																				echo $row_select_pipe['a9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b9'] != "" && $row_select_pipe['b9'] != "0" && $row_select_pipe['b9'] != null) {
																				echo $row_select_pipe['b9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr9'] != "" && $row_select_pipe['wtr9'] != "0" && $row_select_pipe['wtr9'] != null) {
																				echo $row_select_pipe['wtr9'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>10.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['a10'] != "" && $row_select_pipe['a10'] != "0" && $row_select_pipe['a10'] != null) {
																				echo $row_select_pipe['a10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['b10'] != "" && $row_select_pipe['b10'] != "0" && $row_select_pipe['b10'] != null) {
																				echo $row_select_pipe['b10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['wtr10'] != "" && $row_select_pipe['wtr10'] != "0" && $row_select_pipe['wtr10'] != null) {
																				echo $row_select_pipe['wtr10'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b></b></td>
				<td style="border: 1px solid black; text-align:center;"><b></b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Average:</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null) {
																				echo $row_select_pipe['avg_wtr'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
			<tr>
				<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>
				<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>
			</tr>
		</table>
		<div class="pagebreak"> </div>
		<br>
		<br>
		<br>





		<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-left:1px solid; border-right:1px solid; border-top:1px solid; ">

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
				<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Probable date of completion</td>
				<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
			</tr>
		</table>
		<p style="font-size:16px; font-weight:700; margin-left:50px;">&bull; Density:</p>

		<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Length <br> (mm)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Width <br> (mm)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Thickness <br> (mm)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Volume <br> (mm<sup>2</sup>)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Weight <br> (gm)</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Density <br> (gm/cc)</b></td>
			</tr>

			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dl1'] != "" && $row_select_pipe['dl1'] != "0" && $row_select_pipe['dl1'] != null) {
																				echo $row_select_pipe['dl1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dw1'] != "" && $row_select_pipe['dw1'] != "0" && $row_select_pipe['dw1'] != null) {
																				echo $row_select_pipe['dw1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dt1'] != "" && $row_select_pipe['dt1'] != "0" && $row_select_pipe['dt1'] != null) {
																				echo $row_select_pipe['dt1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['vol1'] != "" && $row_select_pipe['vol1'] != "0" && $row_select_pipe['vol1'] != null) {
																				echo $row_select_pipe['vol1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dweight1'] != "" && $row_select_pipe['dweight1'] != "0" && $row_select_pipe['dweight1'] != null) {
																				echo $row_select_pipe['dweight1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != "0" && $row_select_pipe['den1'] != null) {
																				echo $row_select_pipe['den1'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dl2'] != "" && $row_select_pipe['dl2'] != "0" && $row_select_pipe['dl2'] != null) {
																				echo $row_select_pipe['dl2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dw2'] != "" && $row_select_pipe['dw2'] != "0" && $row_select_pipe['dw2'] != null) {
																				echo $row_select_pipe['dw2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dt2'] != "" && $row_select_pipe['dt2'] != "0" && $row_select_pipe['dt2'] != null) {
																				echo $row_select_pipe['dt2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['vol2'] != "" && $row_select_pipe['vol2'] != "0" && $row_select_pipe['vol2'] != null) {
																				echo $row_select_pipe['vol2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dweight2'] != "" && $row_select_pipe['dweight2'] != "0" && $row_select_pipe['dweight2'] != null) {
																				echo $row_select_pipe['dweight2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['den2'] != "" && $row_select_pipe['den2'] != "0" && $row_select_pipe['den2'] != null) {
																				echo $row_select_pipe['den2'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dl3'] != "" && $row_select_pipe['dl3'] != "0" && $row_select_pipe['dl3'] != null) {
																				echo $row_select_pipe['dl3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dw3'] != "" && $row_select_pipe['dw3'] != "0" && $row_select_pipe['dw3'] != null) {
																				echo $row_select_pipe['dw3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dt3'] != "" && $row_select_pipe['dt3'] != "0" && $row_select_pipe['dt3'] != null) {
																				echo $row_select_pipe['dt3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['vol3'] != "" && $row_select_pipe['vol3'] != "0" && $row_select_pipe['vol3'] != null) {
																				echo $row_select_pipe['vol3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dweight3'] != "" && $row_select_pipe['dweight3'] != "0" && $row_select_pipe['dweight3'] != null) {
																				echo $row_select_pipe['dweight3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['den3'] != "" && $row_select_pipe['den3'] != "0" && $row_select_pipe['den3'] != null) {
																				echo $row_select_pipe['den3'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dl4'] != "" && $row_select_pipe['dl4'] != "0" && $row_select_pipe['dl4'] != null) {
																				echo $row_select_pipe['dl4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dw4'] != "" && $row_select_pipe['dw4'] != "0" && $row_select_pipe['dw4'] != null) {
																				echo $row_select_pipe['dw4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dt4'] != "" && $row_select_pipe['dt4'] != "0" && $row_select_pipe['dt4'] != null) {
																				echo $row_select_pipe['dt4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['vol4'] != "" && $row_select_pipe['vol4'] != "0" && $row_select_pipe['vol4'] != null) {
																				echo $row_select_pipe['vol4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dweight4'] != "" && $row_select_pipe['dweight4'] != "0" && $row_select_pipe['dweight4'] != null) {
																				echo $row_select_pipe['dweight4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['den4'] != "" && $row_select_pipe['den4'] != "0" && $row_select_pipe['den4'] != null) {
																				echo $row_select_pipe['den4'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dl5'] != "" && $row_select_pipe['dl5'] != "0" && $row_select_pipe['dl5'] != null) {
																				echo $row_select_pipe['dl5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dw5'] != "" && $row_select_pipe['dw5'] != "0" && $row_select_pipe['dw5'] != null) {
																				echo $row_select_pipe['dw5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dt5'] != "" && $row_select_pipe['dt5'] != "0" && $row_select_pipe['dt5'] != null) {
																				echo $row_select_pipe['dt5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['vol5'] != "" && $row_select_pipe['vol5'] != "0" && $row_select_pipe['vol5'] != null) {
																				echo $row_select_pipe['vol5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dweight5'] != "" && $row_select_pipe['dweight5'] != "0" && $row_select_pipe['dweight5'] != null) {
																				echo $row_select_pipe['dweight5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['den5'] != "" && $row_select_pipe['den5'] != "0" && $row_select_pipe['den5'] != null) {
																				echo $row_select_pipe['den5'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dl6'] != "" && $row_select_pipe['dl6'] != "0" && $row_select_pipe['dl6'] != null) {
																				echo $row_select_pipe['dl6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dw6'] != "" && $row_select_pipe['dw6'] != "0" && $row_select_pipe['dw6'] != null) {
																				echo $row_select_pipe['dw6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dt6'] != "" && $row_select_pipe['dt6'] != "0" && $row_select_pipe['dt6'] != null) {
																				echo $row_select_pipe['dt6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['vol6'] != "" && $row_select_pipe['vol6'] != "0" && $row_select_pipe['vol6'] != null) {
																				echo $row_select_pipe['vol6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['dweight6'] != "" && $row_select_pipe['dweight6'] != "0" && $row_select_pipe['dweight6'] != null) {
																				echo $row_select_pipe['dweight6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['den6'] != "" && $row_select_pipe['den6'] != "0" && $row_select_pipe['den6'] != null) {
																				echo $row_select_pipe['den6'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
			</tr>
			<tr>
				<td colspan="5" style="border: 1px solid black; text-align:center;"><b></b></td>
				<td style="border: 1px solid black; text-align:right;"><b>Average</b></td>
				<td style="border: 1px solid black; text-align:center;"><b><?php if ($row_select_pipe['avg_den'] != "" && $row_select_pipe['avg_den'] != "0" && $row_select_pipe['avg_den'] != null) {
																				echo $row_select_pipe['avg_den'];
																			} else {
																				echo "&nbsp;";
																			} ?></b></td>
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
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>

		<table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
			<tr>
				<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>
				<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>
			</tr>
		</table>
	</page>

</body>

</html>