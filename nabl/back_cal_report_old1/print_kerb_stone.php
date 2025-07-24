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
	<page size="A4">
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-00</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON KERB STONE</b></center>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" height="12%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td colspan=4 style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td colspan=4 style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($start_date)); ?></td>
                <td style="text-align:center;border-left:1px solid;width:7%;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>    
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp;  Type Of Kerb</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['kerb_type']; ?></td>
                <td style="text-align:center;border-left:1px solid;width:7%;"><b>6</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Grade Of Kerb</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['kerb_grade']; ?></td>    
			</tr>
		</table>
        <br>
		
		<table align="center" width="94%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr><td style="margin-left:50px; font-size:13px; font-weight:700;padding:7px 7px;" colspan=3>1.  &nbsp;&nbsp; Dimention and Tolerance (IS : 5758)</td></tr>
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

		<table align="center" width="94%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr><td style="margin-left:50px; font-size:13px; font-weight:700;padding:7px 7px;" colspan=4>2.  &nbsp;&nbsp; Water Absorption (IS : 5758 (Annex - B))</td></tr>
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

		<table align="center" width="94%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr><td style="margin-left:50px; font-size:13px; font-weight:700;padding:7px 7px;" colspan=8>3.  &nbsp;&nbsp; Transvers Strength (IS : 5758(Annex A))</td></tr>																
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

		<table align="center" width="94%" class="test" style="border: 1px solid black;" cellpadding="5px">
			<tr><td style="margin-left:50px; font-size:13px; font-weight:700;padding:7px 7px;">4.  &nbsp;&nbsp; Surface layer in Thickness in mm = 
			<?php //if ($row_select_pipe['avg_sur'] != "" && $row_select_pipe['avg_sur'] != "0" && $row_select_pipe['avg_sur'] != null) {
																												//echo $row_select_pipe['avg_sur'];
																											//} else {
																												//echo "&nbsp;";
																											//} ?>
			<?php if ($row_select_pipe['thickness1'] != "" && $row_select_pipe['thickness1'] != "0" && $row_select_pipe['thickness1'] != null) {
																												echo $row_select_pipe['thickness1'];
																											} else {
																												echo "&nbsp;";
																											} ?></td></tr>	
		</table>
	
		<table align="center" width="94%" class="test1" style="margin-bottom:0px;" Height="14%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 1</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>

	</page>

</body>

</html>