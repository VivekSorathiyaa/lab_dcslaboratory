<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin:30px 40px;
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
	$select_tiles_query = "select * from aac_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		/* $mark= $row_select4['mark'];
					$brick_specification= $row_select4['brick_specification']; */
	}

	?>

	<page size="A4">
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:13px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-026</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION &  CALCULATION SHEET FOR AAC BLOCKS</b></center>
				</td>
			</tr>
		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="9%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Details of Sample  &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
			    <td style="text-align:center;width:7%;padding:5px 0px;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;padding:5px 0px;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;padding:5px 0px;">&nbsp; <?php echo $lab_no."_01"?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:7%;padding:5px 0px;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Quantity of sample</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; 3</td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;width:7%;padding:5px 0px;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Date of Receipt of Sample</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br><br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="23%" class="test1" style="border:1px solid black;font-family: Arial;margin-bottom: 0;float: inline-end;border-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px 0;font-size: 13px;text-align:start;"><b>&nbsp;&nbsp;Date :- &nbsp;&nbsp;<?php echo date("d - m - y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td colspan=7 style="border: 1px solid black;padding: 15px 3px;font-size:13px;"><b>&nbsp;&nbsp;1.&nbsp;&nbsp;Bulk Density & Moisture Content</b></td>
							<td colspan=2 style="border: 1px solid black;padding: 15px 3px;text-align:left;"><b> &nbsp;&nbsp;IS :6441 (P-1)-1972</b></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Length mm <br><br>L</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Breadth mm <br><br>B</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Thickness mm <br><br>D</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Wt. of Sample gm <br><br>W1</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Dry Wt. of Sample gm <br><br>(W)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Volume <br><br>(Cm<sup>3</sup>)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Bulk Density Y = W / V <br><br>(g/cm<sup>3</sup>)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><b>Moisture Content F = [(W1-W)/W]X100 <br><br> %</b></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dl_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dw_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dh_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo ($row_select_pipe['weight_1']); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['w1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['vol_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['den_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['wa_1']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dl_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dw_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dh_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo ($row_select_pipe['weight_2']); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['w2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['vol_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['den_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['wa_2']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dl_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dw_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['dh_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo ($row_select_pipe['weight_3']); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['w3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['vol_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['den_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;"><center><?php echo $row_select_pipe['wa_3']; ?></center></td>
						</tr>
						
					</table>

					<table align="center" width="100%" class="test1" style="font-family: Arial;" height="Auto">
						<tr>
							<td style="padding: 6px 3px;width:7%;"><center></center></td>
							<td style="padding: 6px 3px;width:10%;"><center></center></td>
							<td style="padding: 6px 3px;width:10%;"><center></center></td>
							<td style="padding: 6px 3px;width:10%;"><center></center></td>
							<td style="padding: 6px 3px;width:10%;"><center></center></td>
							<td style="border-right:1px solid;padding: 6px 3px;width:10%;"><center></center></td>
							<td style="border: 1px solid black;width:10%;border-top: 0;border-left: 0;"><center><b>Average</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;border-top: 0;"><center><?php echo $row_select_pipe['bdl_kg']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:10%;border-top: 0;"><center><?php echo $row_select_pipe['mc']; ?></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br><br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="40%" class="test1" style="border:1px solid black;font-family: Arial;margin-bottom: 0;float: inline-end;border-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px 0;font-size: 13px;text-align:start;"><b>&nbsp;&nbsp;Date :- &nbsp;&nbsp;<?php echo date("d - m - y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td colspan=4 style="border: 1px solid black;padding: 15px 3px;font-size:13px;"><b>&nbsp;&nbsp;2.&nbsp;&nbsp;Drying Shrinkage</b></td>
							<td colspan=1 style="border: 1px solid black;padding: 15px 3px;text-align:left;"><b> &nbsp;&nbsp;IS :6441 (P-2)-1972</b></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b>Sr No.</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Length of Specimen <br>(L)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>First  reading <br>(L1)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Final Reading <br>(L2)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Drying Shrinkage = <span style="border-bottom:1px solid black;">L1-L2</span>&nbsp;&nbsp;&nbsp;X 100 = &nbsp;&nbsp;<br><span style="margin-left:17%;">L</span> </b></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['con_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['fr_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;;"><center><?php echo $row_select_pipe['fi_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['ds_1']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['con_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['fr_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;;"><center><?php echo $row_select_pipe['fi_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['ds_2']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['con_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['fr_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;;"><center><?php echo $row_select_pipe['fi_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['ds_3']; ?></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br><br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:1px solid #ccc;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
		</table>
		<table align="center" width="83%" style="" Height="2%">
				<tr style="font-size:12px;" >
					<td style="text-align:left;">Page 1 of 2</td>
				</tr>		
		</table>


		<div class="pagebreak"></div><br>


		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:13px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-026</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION &  CALCULATION SHEET FOR AAC BLOCKS</b></center>
				</td>
			</tr>
		</table>
		<br><br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="26.4%" class="test1" style="border:1px solid black;font-family: Arial;margin-bottom: 0;float: inline-end;border-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px 0;font-size: 13px;text-align:start;"><b>&nbsp;&nbsp;Date :- &nbsp;&nbsp;<?php echo date("d - m - y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td colspan=6 style="border: 1px solid black;padding: 15px 3px;font-size:13px;"><b>&nbsp;&nbsp;3.&nbsp;&nbsp;Compressive Strength</b></td>
							<td colspan=1 style="border: 1px solid black;padding: 15px 3px;text-align:left;"><b> &nbsp;&nbsp;IS :6441 (P-5)-1972</b></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><b>Length <br> cm</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><b>Breadth <br> cm</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><b>Area <br> Cm<sup>2</sup></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><b>Wt of Specimen <br>(W<sub>1</sub>)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:15%;"><center><b>Load dial<br> reading <br>(KN)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:25%;"><center><b>Compressive Strength <br>N/mm<sup>2</sup></b></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['l_1'] / 10); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['w_1'] / 10); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['area_1'] / 100); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo $row_select_pipe['w1_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:15%;"><center><?php echo $row_select_pipe['load_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:25%;"><center><?php echo $row_select_pipe['com_1']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['l_2'] / 10); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['w_2'] / 10); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['area_2'] / 100); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo $row_select_pipe['w1_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:15%;"><center><?php echo $row_select_pipe['load_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:25%;"><center><?php echo $row_select_pipe['com_2']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['l_3'] / 10); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['w_3'] / 10); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo ($row_select_pipe['area_3'] / 100); ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:12%;"><center><?php echo $row_select_pipe['w1_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:15%;"><center><?php echo $row_select_pipe['load_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;width:25%;"><center><?php echo $row_select_pipe['com_3']; ?></center></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="font-family: Arial;" height="Auto">
						<tr>
							<td style="padding: 6px 3px;width:7%;"><center></center></td>
							<td style="padding: 6px 3px;width:12%;"><center></center></td>
							<td style="padding: 6px 3px;width:12%;"><center></center></td>
							<td style="padding: 6px 3px;width:12%;"><center></center></td>
							<td style="padding: 6px 3px;width:12%;"><center></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;border-top: 0;width:15%;"><center><b>Average</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;border-top: 0;width:25%;"><center><?php echo substr((($row_select_pipe['com_1'] + $row_select_pipe['com_2'] + $row_select_pipe['com_3']) / 3),0,4); ?></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br><br><br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;">
				<tr>
					<td>
					<table width="30%" class="test1" style="border:1px solid black;font-family: Arial;margin-bottom: 0;float: inline-end;border-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px 0;font-size: 13px;text-align:start;"><b>&nbsp;&nbsp;Date :- &nbsp;&nbsp;<?php echo date("d - m - y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Arial;" height="Auto">
						<tr>
							<td colspan=7 style="border: 1px solid black;padding: 15px 3px;font-size:13px;"><b>&nbsp;&nbsp;4.&nbsp;&nbsp;Thermal Conductivity</b></td>
							<td colspan=2 style="border: 1px solid black;padding: 15px 3px;text-align:left;"><b> &nbsp;&nbsp;IS :6441 (P-3)-1972</b></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Length <br> cm</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Breadth <br> cm</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Thicknes<br> Cm<sup>2</sup></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Area <br> Cm<sup>2</sup></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Hot Face <br>Temperature <br> in k (T<sub>h</sub>)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Cold Face<br>Temperature <br> in k (Tc)</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>W=VI</b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b>Thermal Conductivity <br><br> K = <span style="border-bottom:1px solid black;"> 0.5 W X  D</span> <br> <span style="margin-left:17%;">(2 X A X (TH-TC)</span> <br><br> (  W/m k ) </b></center></td>
						</tr>

						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tl_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tw_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['th_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tarea_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tf_1_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tc_1_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tvolt_1']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['thr_1']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tl_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tw_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['th_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tarea_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tf_1_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tc_1_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tvolt_2']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['thr_2']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tl_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tw_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['th_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tarea_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tf_1_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tc_1_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['tvolt_3']; ?></center></td>
							<td style="padding: 6px 3px;border: 1px solid black;"><center><?php echo $row_select_pipe['thr_3']; ?></center></td>
						</tr>
						
					</table>
					</td>
				</tr>																					
		</table>
		<br><br>


		<table align="center" width="100%" class="test1" style="margin-bottom: 20px;" Height="9%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table><br><br><br><br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:1px solid #ccc;">
				<tr style="">
					<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2021 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
		</table>
		<table align="center" width="83%" style="" Height="2%">
				<tr style="font-size:12px;" >
					<td style="text-align:left;">Page 2 of 2</td>
				</tr>		
		</table>

		
	</page>
	<!-- <page size="A4">
		<table align="center" width="100%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:13px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-026</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION &  CALCULATION SHEET FOR AAC BLOCKS</b></center>
				</td>
			</tr>
		</table>
		<br><br>

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
		<br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 0px solid black;">
				<td colspan="2" style="border: 0px solid black;"><b>TEST-1 Dimension</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS:2185 P3-84 (2015)</b></td>
			</tr>


			<tr style="border: 1px solid black;height:20px;font-weight:bold;">
				<td style="width:7%;border: 1px solid black;">
					<center>Sr. No.</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Length in mm</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Width in mm</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Height in mm</center>
				</td>


			</tr>

			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l1'] != "" && $row_select_pipe['dim_l1'] != "0" && $row_select_pipe['dim_l1'] != null) {
															echo $row_select_pipe['dim_l1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w1'] != "" && $row_select_pipe['dim_w1'] != "0" && $row_select_pipe['dim_w1'] != null) {
															echo $row_select_pipe['dim_w1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h1'] != "" && $row_select_pipe['dim_h1'] != "0" && $row_select_pipe['dim_h1'] != null) {
															echo $row_select_pipe['dim_h1'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l2'] != "" && $row_select_pipe['dim_l2'] != "0" && $row_select_pipe['dim_l2'] != null) {
															echo $row_select_pipe['dim_l2'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w2'] != "" && $row_select_pipe['dim_w2'] != "0" && $row_select_pipe['dim_w2'] != null) {
															echo $row_select_pipe['dim_w2'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h2'] != "" && $row_select_pipe['dim_h2'] != "0" && $row_select_pipe['dim_h2'] != null) {
															echo $row_select_pipe['dim_h2'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l3'] != "" && $row_select_pipe['dim_l3'] != "0" && $row_select_pipe['dim_l3'] != null) {
															echo $row_select_pipe['dim_l3'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w3'] != "" && $row_select_pipe['dim_w3'] != "0" && $row_select_pipe['dim_w3'] != null) {
															echo $row_select_pipe['dim_w3'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h3'] != "" && $row_select_pipe['dim_h3'] != "0" && $row_select_pipe['dim_h3'] != null) {
															echo $row_select_pipe['dim_h3'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l4'] != "" && $row_select_pipe['dim_l4'] != "0" && $row_select_pipe['dim_l4'] != null) {
															echo $row_select_pipe['dim_l4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w4'] != "" && $row_select_pipe['dim_w4'] != "0" && $row_select_pipe['dim_w4'] != null) {
															echo $row_select_pipe['dim_w4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h4'] != "" && $row_select_pipe['dim_h4'] != "0" && $row_select_pipe['dim_h4'] != null) {
															echo $row_select_pipe['dim_h4'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;">-</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w5'] != "" && $row_select_pipe['dim_w5'] != "0" && $row_select_pipe['dim_w5'] != null) {
															echo $row_select_pipe['dim_w5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h5'] != "" && $row_select_pipe['dim_h5'] != "0" && $row_select_pipe['dim_h5'] != null) {
															echo $row_select_pipe['dim_h5'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;">-</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w6'] != "" && $row_select_pipe['dim_w6'] != "0" && $row_select_pipe['dim_w6'] != null) {
															echo $row_select_pipe['dim_w6'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h6'] != "" && $row_select_pipe['dim_h6'] != "0" && $row_select_pipe['dim_h6'] != null) {
															echo $row_select_pipe['dim_h6'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">7</td>
				<td style="border: 1px solid black;">-</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w7'] != "" && $row_select_pipe['dim_w7'] != "0" && $row_select_pipe['dim_w7'] != null) {
															echo $row_select_pipe['dim_w7'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;">-</td>

			</tr>



			<tr style="text-align:center">
				<td style="border: 1px solid black;text-align:right">Avg.</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_height'] != "" && $row_select_pipe['dim_height'] != "0" && $row_select_pipe['dim_height'] != null) {
															echo $row_select_pipe['dim_height'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_width'] != "" && $row_select_pipe['dim_width'] != "0" && $row_select_pipe['dim_width'] != null) {
															echo $row_select_pipe['dim_width'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_height'] != "" && $row_select_pipe['dim_height'] != "0" && $row_select_pipe['dim_height'] != null) {
															echo $row_select_pipe['dim_height'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>

		</table>
		<br>
		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="4" style="border: 0px solid black;"><b>TEST-2 Compressive Strength</b></td>
				<td colspan="4" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS:6441 P5-72 (2017)</b></td>
			</tr>
			<tr style="height:60px;">
				<td style="width:7%;border: 1px solid black;font-weight:bold;">
					<center><b>Sample ID.</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Length in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Width in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Height in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Moisture Content (%)</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Load IN KN</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Area (<br>mm<sup>2</sup>)</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Compressive<br>Strength in N/mm<sup>2</sup></b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_1'] != "" && $row_select_pipe['sample_1'] != "0" && $row_select_pipe['sample_1'] != null) {
									echo $row_select_pipe['sample_1'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_1'] != "" && $row_select_pipe['l_1'] != "0" && $row_select_pipe['l_1'] != null) {
								echo $row_select_pipe['l_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_1'] != "" && $row_select_pipe['w_1'] != "0" && $row_select_pipe['w_1'] != null) {
								echo $row_select_pipe['w_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_1'] != "" && $row_select_pipe['h_1'] != "0" && $row_select_pipe['h_1'] != null) {
								echo $row_select_pipe['h_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_1'] != "" && $row_select_pipe['mc_1'] != "0" && $row_select_pipe['mc_1'] != null) {
								echo $row_select_pipe['mc_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
								echo $row_select_pipe['load_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) {
								echo $row_select_pipe['area_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
								echo $row_select_pipe['com_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_2'] != "" && $row_select_pipe['sample_2'] != "0" && $row_select_pipe['sample_2'] != null) {
									echo $row_select_pipe['sample_2'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_2'] != "" && $row_select_pipe['l_2'] != "0" && $row_select_pipe['l_2'] != null) {
								echo $row_select_pipe['l_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_2'] != "" && $row_select_pipe['w_2'] != "0" && $row_select_pipe['w_2'] != null) {
								echo $row_select_pipe['w_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_2'] != "" && $row_select_pipe['h_2'] != "0" && $row_select_pipe['h_2'] != null) {
								echo $row_select_pipe['h_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_2'] != "" && $row_select_pipe['mc_2'] != "0" && $row_select_pipe['mc_2'] != null) {
								echo $row_select_pipe['mc_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
								echo $row_select_pipe['load_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) {
								echo $row_select_pipe['area_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
								echo $row_select_pipe['com_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_4'] != "" && $row_select_pipe['sample_4'] != "0" && $row_select_pipe['sample_4'] != null) {
									echo $row_select_pipe['sample_4'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_4'] != "" && $row_select_pipe['l_4'] != "0" && $row_select_pipe['l_4'] != null) {
								echo $row_select_pipe['l_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_4'] != "" && $row_select_pipe['w_4'] != "0" && $row_select_pipe['w_4'] != null) {
								echo $row_select_pipe['w_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_4'] != "" && $row_select_pipe['h_4'] != "0" && $row_select_pipe['h_4'] != null) {
								echo $row_select_pipe['h_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_4'] != "" && $row_select_pipe['mc_4'] != "0" && $row_select_pipe['mc_4'] != null) {
								echo $row_select_pipe['mc_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
								echo $row_select_pipe['load_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) {
								echo $row_select_pipe['area_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
								echo $row_select_pipe['com_4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_5'] != "" && $row_select_pipe['sample_5'] != "0" && $row_select_pipe['sample_5'] != null) {
									echo $row_select_pipe['sample_5'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_5'] != "" && $row_select_pipe['l_5'] != "0" && $row_select_pipe['l_5'] != null) {
								echo $row_select_pipe['l_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_5'] != "" && $row_select_pipe['w_5'] != "0" && $row_select_pipe['w_5'] != null) {
								echo $row_select_pipe['w_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_5'] != "" && $row_select_pipe['h_5'] != "0" && $row_select_pipe['h_5'] != null) {
								echo $row_select_pipe['h_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_5'] != "" && $row_select_pipe['mc_5'] != "0" && $row_select_pipe['mc_5'] != null) {
								echo $row_select_pipe['mc_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
								echo $row_select_pipe['load_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) {
								echo $row_select_pipe['area_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
								echo $row_select_pipe['com_5'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_6'] != "" && $row_select_pipe['sample_6'] != "0" && $row_select_pipe['sample_6'] != null) {
									echo $row_select_pipe['sample_6'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_6'] != "" && $row_select_pipe['l_6'] != "0" && $row_select_pipe['l_6'] != null) {
								echo $row_select_pipe['l_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_6'] != "" && $row_select_pipe['w_6'] != "0" && $row_select_pipe['w_6'] != null) {
								echo $row_select_pipe['w_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_6'] != "" && $row_select_pipe['h_6'] != "0" && $row_select_pipe['h_6'] != null) {
								echo $row_select_pipe['h_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_6'] != "" && $row_select_pipe['mc_6'] != "0" && $row_select_pipe['mc_6'] != null) {
								echo $row_select_pipe['mc_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
								echo $row_select_pipe['load_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) {
								echo $row_select_pipe['area_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
								echo $row_select_pipe['com_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_7'] != "" && $row_select_pipe['sample_7'] != "0" && $row_select_pipe['sample_7'] != null) {
									echo $row_select_pipe['sample_7'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_7'] != "" && $row_select_pipe['l_7'] != "0" && $row_select_pipe['l_7'] != null) {
								echo $row_select_pipe['l_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_7'] != "" && $row_select_pipe['w_7'] != "0" && $row_select_pipe['w_7'] != null) {
								echo $row_select_pipe['w_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_7'] != "" && $row_select_pipe['h_7'] != "0" && $row_select_pipe['h_7'] != null) {
								echo $row_select_pipe['h_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_7'] != "" && $row_select_pipe['mc_7'] != "0" && $row_select_pipe['mc_7'] != null) {
								echo $row_select_pipe['mc_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
								echo $row_select_pipe['load_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) {
								echo $row_select_pipe['area_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
								echo $row_select_pipe['com_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_8'] != "" && $row_select_pipe['sample_8'] != "0" && $row_select_pipe['sample_8'] != null) {
									echo $row_select_pipe['sample_8'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_8'] != "" && $row_select_pipe['l_8'] != "0" && $row_select_pipe['l_8'] != null) {
								echo $row_select_pipe['l_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_8'] != "" && $row_select_pipe['w_8'] != "0" && $row_select_pipe['w_8'] != null) {
								echo $row_select_pipe['w_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_8'] != "" && $row_select_pipe['h_8'] != "0" && $row_select_pipe['h_8'] != null) {
								echo $row_select_pipe['h_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_8'] != "" && $row_select_pipe['mc_8'] != "0" && $row_select_pipe['mc_8'] != null) {
								echo $row_select_pipe['mc_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
								echo $row_select_pipe['load_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) {
								echo $row_select_pipe['area_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
								echo $row_select_pipe['com_8'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_9'] != "" && $row_select_pipe['sample_9'] != "0" && $row_select_pipe['sample_9'] != null) {
									echo $row_select_pipe['sample_9'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_9'] != "" && $row_select_pipe['l_9'] != "0" && $row_select_pipe['l_9'] != null) {
								echo $row_select_pipe['l_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_9'] != "" && $row_select_pipe['w_9'] != "0" && $row_select_pipe['w_9'] != null) {
								echo $row_select_pipe['w_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_9'] != "" && $row_select_pipe['h_9'] != "0" && $row_select_pipe['h_9'] != null) {
								echo $row_select_pipe['h_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_9'] != "" && $row_select_pipe['mc_9'] != "0" && $row_select_pipe['mc_9'] != null) {
								echo $row_select_pipe['mc_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_9'] != "" && $row_select_pipe['load_9'] != "0" && $row_select_pipe['load_9'] != null) {
								echo $row_select_pipe['load_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_9'] != "" && $row_select_pipe['area_9'] != "0" && $row_select_pipe['area_9'] != null) {
								echo $row_select_pipe['area_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) {
								echo $row_select_pipe['com_9'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_10'] != "" && $row_select_pipe['sample_10'] != "0" && $row_select_pipe['sample_10'] != null) {
									echo $row_select_pipe['sample_10'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_10'] != "" && $row_select_pipe['l_10'] != "0" && $row_select_pipe['l_10'] != null) {
								echo $row_select_pipe['l_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_10'] != "" && $row_select_pipe['w_10'] != "0" && $row_select_pipe['w_10'] != null) {
								echo $row_select_pipe['w_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_10'] != "" && $row_select_pipe['h_10'] != "0" && $row_select_pipe['h_10'] != null) {
								echo $row_select_pipe['h_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_10'] != "" && $row_select_pipe['mc_10'] != "0" && $row_select_pipe['mc_10'] != null) {
								echo $row_select_pipe['mc_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_10'] != "" && $row_select_pipe['load_10'] != "0" && $row_select_pipe['load_10'] != null) {
								echo $row_select_pipe['load_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_10'] != "" && $row_select_pipe['area_10'] != "0" && $row_select_pipe['area_10'] != null) {
								echo $row_select_pipe['area_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_10'] != "" && $row_select_pipe['com_10'] != "0" && $row_select_pipe['com_10'] != null) {
								echo $row_select_pipe['com_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_11'] != "" && $row_select_pipe['sample_11'] != "0" && $row_select_pipe['sample_11'] != null) {
									echo $row_select_pipe['sample_11'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_11'] != "" && $row_select_pipe['l_11'] != "0" && $row_select_pipe['l_11'] != null) {
								echo $row_select_pipe['l_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_11'] != "" && $row_select_pipe['w_11'] != "0" && $row_select_pipe['w_11'] != null) {
								echo $row_select_pipe['w_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_11'] != "" && $row_select_pipe['h_11'] != "0" && $row_select_pipe['h_11'] != null) {
								echo $row_select_pipe['h_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_11'] != "" && $row_select_pipe['mc_11'] != "0" && $row_select_pipe['mc_11'] != null) {
								echo $row_select_pipe['mc_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_11'] != "" && $row_select_pipe['load_11'] != "0" && $row_select_pipe['load_11'] != null) {
								echo $row_select_pipe['load_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_11'] != "" && $row_select_pipe['area_11'] != "0" && $row_select_pipe['area_11'] != null) {
								echo $row_select_pipe['area_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_11'] != "" && $row_select_pipe['com_11'] != "0" && $row_select_pipe['com_11'] != null) {
								echo $row_select_pipe['com_11'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_12'] != "" && $row_select_pipe['sample_12'] != "0" && $row_select_pipe['sample_12'] != null) {
									echo $row_select_pipe['sample_12'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_12'] != "" && $row_select_pipe['l_12'] != "0" && $row_select_pipe['l_12'] != null) {
								echo $row_select_pipe['l_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_12'] != "" && $row_select_pipe['w_12'] != "0" && $row_select_pipe['w_12'] != null) {
								echo $row_select_pipe['w_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_12'] != "" && $row_select_pipe['h_12'] != "0" && $row_select_pipe['h_12'] != null) {
								echo $row_select_pipe['h_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_12'] != "" && $row_select_pipe['mc_12'] != "0" && $row_select_pipe['mc_12'] != null) {
								echo $row_select_pipe['mc_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_12'] != "" && $row_select_pipe['load_12'] != "0" && $row_select_pipe['load_12'] != null) {
								echo $row_select_pipe['load_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_12'] != "" && $row_select_pipe['area_12'] != "0" && $row_select_pipe['area_12'] != null) {
								echo $row_select_pipe['area_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_12'] != "" && $row_select_pipe['com_12'] != "0" && $row_select_pipe['com_12'] != null) {
								echo $row_select_pipe['com_12'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>


			<tr>
				<td colspan="7" style="border: 1px solid black;text-align:right">Average</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != "0" && $row_select_pipe['avg_com'] != null) {
								echo $row_select_pipe['avg_com'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>



		</table>
		<br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="5" style="border: 0px solid black;"><b>TEST-3 Bulk Density &amp; Moisture Content</b></td>
				<td colspan="4" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS:6441 P1:1972 (2017)</b></td>
			</tr>
			<tr style="height:60px;">
				<td style="width:7%;border: 1px solid black;font-weight:bold;">
					<center><b>Sr. No.</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Length in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Width in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Height in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Volume (cm<sup>3</sup>)</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Weight, g</b></center>
				</td>

				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Compressive<br>Strength in N/mm<sup>2</sup></b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Oven Dry Weight, g</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Moisture Content (%)</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dl_1'] != "" && $row_select_pipe['dl_1'] != "0" && $row_select_pipe['dl_1'] != null) {
								echo $row_select_pipe['dl_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dw_1'] != "" && $row_select_pipe['dw_1'] != "0" && $row_select_pipe['dw_1'] != null) {
								echo $row_select_pipe['dw_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dh_1'] != "" && $row_select_pipe['dh_1'] != "0" && $row_select_pipe['dh_1'] != null) {
								echo $row_select_pipe['dh_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_1'] != "" && $row_select_pipe['vol_1'] != "0" && $row_select_pipe['vol_1'] != null) {
								echo $row_select_pipe['vol_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['weight_1'] != "" && $row_select_pipe['weight_1'] != "0" && $row_select_pipe['weight_1'] != null) {
								echo $row_select_pipe['weight_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['den_1'] != "" && $row_select_pipe['den_1'] != "0" && $row_select_pipe['den_1'] != null) {
								echo $row_select_pipe['den_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w1'] != "" && $row_select_pipe['w1'] != "0" && $row_select_pipe['w1'] != null) {
								echo $row_select_pipe['w1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa_1'] != "" && $row_select_pipe['wa_1'] != "0" && $row_select_pipe['wa_1'] != null) {
								echo $row_select_pipe['wa_1'];
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
					<center><?php if ($row_select_pipe['dl_2'] != "" && $row_select_pipe['dl_2'] != "0" && $row_select_pipe['dl_2'] != null) {
								echo $row_select_pipe['dl_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dw_2'] != "" && $row_select_pipe['dw_2'] != "0" && $row_select_pipe['dw_2'] != null) {
								echo $row_select_pipe['dw_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dh_2'] != "" && $row_select_pipe['dh_2'] != "0" && $row_select_pipe['dh_2'] != null) {
								echo $row_select_pipe['dh_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_2'] != "" && $row_select_pipe['vol_2'] != "0" && $row_select_pipe['vol_2'] != null) {
								echo $row_select_pipe['vol_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['weight_2'] != "" && $row_select_pipe['weight_2'] != "0" && $row_select_pipe['weight_2'] != null) {
								echo $row_select_pipe['weight_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['den_2'] != "" && $row_select_pipe['den_2'] != "0" && $row_select_pipe['den_2'] != null) {
								echo $row_select_pipe['den_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w2'] != "" && $row_select_pipe['w2'] != "0" && $row_select_pipe['w2'] != null) {
								echo $row_select_pipe['w2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa_2'] != "" && $row_select_pipe['wa_2'] != "0" && $row_select_pipe['wa_2'] != null) {
								echo $row_select_pipe['wa_2'];
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
					<center><?php if ($row_select_pipe['dl_3'] != "" && $row_select_pipe['dl_3'] != "0" && $row_select_pipe['dl_3'] != null) {
								echo $row_select_pipe['dl_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dw_3'] != "" && $row_select_pipe['dw_3'] != "0" && $row_select_pipe['dw_3'] != null) {
								echo $row_select_pipe['dw_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dh_3'] != "" && $row_select_pipe['dh_3'] != "0" && $row_select_pipe['dh_3'] != null) {
								echo $row_select_pipe['dh_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_3'] != "" && $row_select_pipe['vol_3'] != "0" && $row_select_pipe['vol_3'] != null) {
								echo $row_select_pipe['vol_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['weight_3'] != "" && $row_select_pipe['weight_3'] != "0" && $row_select_pipe['weight_3'] != null) {
								echo $row_select_pipe['weight_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['den_3'] != "" && $row_select_pipe['den_3'] != "0" && $row_select_pipe['den_3'] != null) {
								echo $row_select_pipe['den_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w3'] != "" && $row_select_pipe['w3'] != "0" && $row_select_pipe['w3'] != null) {
								echo $row_select_pipe['w3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa_3'] != "" && $row_select_pipe['wa_3'] != "0" && $row_select_pipe['wa_3'] != null) {
								echo $row_select_pipe['wa_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>

			<tr>

				<td colspan="6" style="border: 1px solid black;text-align:right;">Average</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) {
								echo $row_select_pipe['bdl'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;text-align:right;"></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc'] != "" && $row_select_pipe['mc'] != "0" && $row_select_pipe['mc'] != null) {
								echo $row_select_pipe['mc'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>



		</table>

		<div class="pagebreak"></div>
		<br>
		<br>
		<br>
		<table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
			<tr>
				<td rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
				<td rowspan="3" style="font-size:16px;border: 1px solid black;">
					<center><b>GOMA ENGINEERING AND CONSULTANCY</b></center>
				</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
			</tr>
			<tr>

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
					<center><b>
							AAC BLOCK</b></center>
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

		<br>

		<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;"><b>TEST-4 Drying Shrinkage</b></td>
				<td colspan="3" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS:6441 (P-2):72 (2017)</b></td>
			</tr>

			<tr>
				<td colspan="3" style="width:40%;border: 1px solid black;font-weight:bold;">
					<center><b></b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;">
					<center><b>(i)</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;">
					<center><b>(ii)</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;">
					<center><b>(iii)</b></center>
				</td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>1</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>Constant Length, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_1'] != "" && $row_select_pipe['con_1'] != "0" && $row_select_pipe['con_1'] != null) {
																										echo $row_select_pipe['con_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_2'] != "" && $row_select_pipe['con_2'] != "0" && $row_select_pipe['con_2'] != null) {
																										echo $row_select_pipe['con_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_3'] != "" && $row_select_pipe['con_3'] != "0" && $row_select_pipe['con_3'] != null) {
																										echo $row_select_pipe['con_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>2</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>Width, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_wid_1'] != "" && $row_select_pipe['con_wid_1'] != "0" && $row_select_pipe['con_wid_1'] != null) {
																										echo $row_select_pipe['con_wid_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_wid_2'] != "" && $row_select_pipe['con_wid_2'] != "0" && $row_select_pipe['con_wid_2'] != null) {
																										echo $row_select_pipe['con_wid_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_wid_3'] != "" && $row_select_pipe['con_wid_3'] != "0" && $row_select_pipe['con_wid_3'] != null) {
																										echo $row_select_pipe['con_wid_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>3</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>Thickness, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_thi_1'] != "" && $row_select_pipe['con_thi_1'] != "0" && $row_select_pipe['con_thi_1'] != null) {
																										echo $row_select_pipe['con_thi_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_thi_2'] != "" && $row_select_pipe['con_thi_2'] != "0" && $row_select_pipe['con_thi_2'] != null) {
																										echo $row_select_pipe['con_thi_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_thi_3'] != "" && $row_select_pipe['con_thi_3'] != "0" && $row_select_pipe['con_thi_3'] != null) {
																										echo $row_select_pipe['con_thi_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>2</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>First Reading, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fr_1'] != "" && $row_select_pipe['fr_1'] != "0" && $row_select_pipe['fr_1'] != null) {
																										echo $row_select_pipe['fr_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fr_2'] != "" && $row_select_pipe['fr_2'] != "0" && $row_select_pipe['fr_2'] != null) {
																										echo $row_select_pipe['fr_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fr_3'] != "" && $row_select_pipe['fr_3'] != "0" && $row_select_pipe['fr_3'] != null) {
																										echo $row_select_pipe['fr_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>3</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>Final Reading, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fi_1'] != "" && $row_select_pipe['fi_1'] != "0" && $row_select_pipe['fi_1'] != null) {
																										echo $row_select_pipe['fi_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fi_2'] != "" && $row_select_pipe['fi_2'] != "0" && $row_select_pipe['fi_2'] != null) {
																										echo $row_select_pipe['fi_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fi_3'] != "" && $row_select_pipe['fi_3'] != "0" && $row_select_pipe['fi_3'] != null) {
																										echo $row_select_pipe['fi_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td rowspan="2" style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>4</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>Drying Shrinkage, %</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['ds_1'] != "" && $row_select_pipe['ds_1'] != "0" && $row_select_pipe['ds_1'] != null) {
																										echo $row_select_pipe['ds_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['ds_2'] != "" && $row_select_pipe['ds_2'] != "0" && $row_select_pipe['ds_2'] != null) {
																										echo $row_select_pipe['ds_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['ds_3'] != "" && $row_select_pipe['ds_3'] != "0" && $row_select_pipe['ds_3'] != null) {
																										echo $row_select_pipe['ds_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>

				<td style="width:30%;border: 1px solid black;font-weight:bold;"><b>Average Drying Shrinkage, %</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td colspan="3" style="width:60%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['avg_shrink'] != "" && $row_select_pipe['avg_shrink'] != "0" && $row_select_pipe['avg_shrink'] != null) {
																													echo $row_select_pipe['avg_shrink'];
																												} else {
																													echo " <br>";
																												} ?></td>


			</tr>




		</table>
		<br>



	</page> -->
</body>

</html>


<script type="text/javascript">

</script>