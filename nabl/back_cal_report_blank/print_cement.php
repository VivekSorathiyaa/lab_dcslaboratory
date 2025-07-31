<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
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
		font-size: 12px;
		font-family: Calibri;
	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Calibri;

	}

	.tdclass1 {

		font-size: 12px;
		font-family: Calibri;
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
	$select_tiles_query = "select * from span_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}

	$select_query2 = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
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
			$mt_name = $row_select3['mt_name'];

			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$type_of_cement = $row_select4['type_of_cement'];
		$cement_brand = $row_select4['cement_brand'];
		$cement_grade = $row_select4['cement_grade'];
		$week_no = $row_select4['week_no'];
		$in_grade = $row_select4['in_grade'];
	}

	$cnt = 1;
	$pagecnt = 0;
	$totalcnt = 0;
	if (($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "0" && $row_select_pipe['initial_time'] != null) || ($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "0" && $row_select_pipe['final_time'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null)) {
		$totalcnt++;
	}


	?>

	<? php// if ($row_select_pipe['chk_che'] =="0"){ ?>
	<?php
	//if (($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['initial_time'] != "" && $row_select_pipe['initial_time'] != "0" && $row_select_pipe['initial_time'] != null) || ($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "0" && $row_select_pipe['final_time'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null)) {
	?>
	<page size="A4">
		<!--<table width="92%"  cellspacing="0"
		style="margin-left: auto; margin-right: auto; border:1px solid black; text-align: center;">
		<tr>
			<td style="border: 1px solid black;">logo</td>
			<td style="border: 1px solid black;" colspan="2">
				NextGenLIMS Technologies<br>
				<b>(Formerly known as DC Consultant)</b><br>
				Mobile: +91-7018819894, +91-9816755805, e-mail: officialdcspvtltd@gmail.com<br>
				<b>Regd, Office : VPO Taragarh (Rani Di K) Near Taragarh Palace Tehsil Baijnath</b><br>
				<b>District Kangra Himachal Pradesh (176081)</b>
			</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;"><b>Cement</b></td>
			<td style="border: 1px solid black;"><b>C.S.C DATA SHEET</b></td>
			<td style="border: 1px solid black;"><b>QSF-1004</b></td>
		</tr>
	</table>
	<table width="92%"  cellspacing="0"
		style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;">
		<tr>
			<td style="border: 1px solid black;">Job Card No</td>
			<td style="border: 1px solid black;">20240724DCS139</td>
			<td style="border: 1px solid black;"> Date of Receipt</td>
			<td style="border: 1px solid black;">24.07.2024</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">Date of Start</td>
			<td style="border: 1px solid black;">24.07.2024</td>
			<td style="border: 1px solid black;">Date of Completion</td>
			<td style="border: 1px solid black;">26.08.2024</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">Description of Sample</td>
			<td style="border: 1px solid black;" colspan="3">Cement PPC</td>
		</tr>
	</table>
	<table width="92%"  cellspacing="0"
		style="margin-left: auto; margin-right: auto; border:1px solid black; text-align: center;">
		<tr>
			<td style="border: 1px solid black;"><b>S.No.</b></td>
			<td style="border: 1px solid black;"><b>Test <br>(with unit of measurement)</b></td>
			<td style="border: 1px solid black;"><b>Test Result</b></td>
			<td style="border: 1px solid black;"><b>Test Method</b></td>
			<td style="border: 1px solid black;"><b>Requirement as per<br>IS 1489 (P-1):2015</b></td>
		</tr>
		<tr>
			<td style="border: 1px solid black;"><b>A.</b></td>
			<td style="border: 1px solid black;"><b>Physical Test</b></td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">1.</td>
			<td style="border: 1px solid black;">Consistency (%)</td>
			<td style="border: 1px solid black;"><?php echo $row_select_pipe['final_consistency']; ?></td>
			<td style="border: 1px solid black;">IS 4031 (P-4): 1988</td>
			<td style="border: 1px solid black;">-</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">2.</td>
			<td style="border: 1px solid black;" >Setting Time (Minutes)<br>
				Initial<br>
				Final</td>
			<td style="border: 1px solid black;"><?php echo $row_select_pipe['initial_time']; ?> <br><?php echo $row_select_pipe['final_time']; ?></td>
			<td style="border: 1px solid black;">IS 4031 (P-5): 1988</td>
			<td style="border: 1px solid black;">30 Min. <br>600 Maх.</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">3.</td>
			<td style="border: 1px solid black;">Fineness (m²/kg)</td>
			<td style="border: 1px solid black;"><?php echo $row_select_pipe['ss_area']; ?></td>
			<td style="border: 1px solid black;">IS 4031 (P-2):1999</td>
			<td style="border: 1px solid black;">300 Min.</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">4.</td>
			<td style="border: 1px solid black;">Dry Sieving (%)</td>
			<td style="border: 1px solid black;"><?php echo $row_select_pipe['']; ?></td>
			<td>IS 4031 (P-1):1996</td>
			<td style="border: 1px solid black;">-</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">5.</td>
			<td style="border: 1px solid black;">
				Soundness<br>
				By Lechatelier (mm)</td>
			<td style="border: 1px solid black;"><?php echo $row_select_pipe['soundness']; ?></td>
			<td style="border: 1px solid black;">IS 4031 (P-3):1988</td>
			<td style="border: 1px solid black;">10 Mаx.</td>
		</tr>
		<tr>
			<td style="border: 1px solid black;">6.</td>
			<td style="border: 1px solid black;">Compressive strength (N/mm²)<br>3 days (72±1h)<br>7 days (168±2h)<br>28 days (672±4h)</td>
			<td style="border: 1px solid black;"><?php echo $row_select_pipe['avg_com_1']; ?><br><?php echo $row_select_pipe['avg_com_2']; ?><br><?php echo $row_select_pipe['avg_com_3']; ?></td>
			<td style="border: 1px solid black;">IS 4031 (P-6):1988</td>
			<td style="border: 1px solid black;">16 Min.<br>22 Min.<br>33 min.</td>
		</tr>
	</table> 
	<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
		<tr>
			<td><b>D.O.S.:</b> 24.07.2024</td>
		</tr>
		<tr>
			<td><b>D.O.C.:</b> 26.08.2024</td>
		</tr>
	</table>
	<br>
	<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
		<tr>
			<td><b>Checked By</b></td>
			<td><b>Analyst</b></td>
		</tr>
		<tr>
			<td><b>(Vishal Achaya)</b></td>
			<td><b>Saurabh Singh</b></td>
		</tr>
		<tr>
			<td><b>(T.M)</b></td>
		</tr>
	</table>-->

		<br><br>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align: center;">
			<tr>
			<tr>
				<td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
						src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
				</td>

			</tr>
			<td style="border: 1px solid black;" colspan="2">
				NextGenLIMS Technologies<br>
				<b>(Formerly known as DC Consultant)</b><br>
				<b>Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</b><br>
				<b>DPR’s and other Civil Engineering Consultancy Services</b><br>
				<b>CIN : U71100HP2024PTC010626, GSTIN : 02AAKCD6125G1ZZ </b><br>
				<b>Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P)
					(176081)</b><br>
				<b>Mobile : +91-7018819894, 01894 295-074 E-mail : officialdcspvtltd@gmail.com</b><br>

			</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Cement</b></td>
				<td style="border: 1px solid black;"><b>ANALYSIS DATA SHEET</b></td>
				<td style="border: 1px solid black;"><b>QSF-1004</b></td>
			</tr>
		</table>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;">
			<tr>
				<td style="border: 1px solid black;" colspan="2">Job Card No : <?php echo $job_no ?> </td>
				<td style="border: 1px solid black;" colspan="2">Test : Consistency, Setting Time, Soundness </td>
			</tr>
			<tr>
				<td style="border: 1px solid black;" colspan="2">Sample Description : <?php echo $mt_name; ?></td>
				<td style="border: 1px solid black;" colspan="2">Method : </td>
			</tr>
			<tr>
				<td style="border:1px solid">DOR : <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?> </td>
				<td style="border:1px solid">DOS : <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				<td style="border:1px solid">DOC : <?php echo date('d-m-Y', strtotime($end_date)); ?> </td>
				<td style="border: 1px solid black;">Page No.</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">Sample Qty : 30 kg</td>
				<td style="border: 1px solid black;">Residual Qty : 27.8 kg</td>
				<td style="border: 1px solid black;" colspan="2">Sample Retention : </td>
			</tr>
		</table>
		<br>
		<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
			<tr>
				<td>1) Consistency of cement % :- IS 4031 (Part-4)</td>
			</tr>
		</table>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:center;">
			<tr>
				<td style="border: 1px solid black;">S. No.</td>
				<td style="border: 1px solid black;">Wt. of Water (gm)</td>
				<td style="border: 1px solid black;">Penetration (mm)</td>
				<td style="border: 1px solid black;">Consistency (%)</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['vol_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['reading_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['wtr_1']; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['vol_2']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['reading_2']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['wtr_2']; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['vol_3']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['reading_3']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['wtr_3']; ?></td>
			</tr>
		</table>
		<br>
		<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
			<tr>
				<td>2) Setting Time (Min.) :- IS 4031 (Part-5)&nbsp; &nbsp; &nbsp; &nbsp; Water = 0.85 x P = (0.85 * 4 *
					<?php echo $row_select_pipe['final_consistency']; ?>)&nbsp; &nbsp;
					<?php echo $row_select_pipe['set_wtr']; ?> &nbsp; gm</td>
			</tr>
		</table>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;">
			<tr>
				<td style="border: 1px solid black;">Starting Time:- <?php echo $row_select_pipe['hr_a']; ?>
					<br>Initial:- <?php echo $row_select_pipe['hr_b']; ?> -
					<?php echo $row_select_pipe['initial_time']; ?> min<br>Final:- <?php echo $row_select_pipe['hr_c']; ?>
					- <?php echo $row_select_pipe['final_time']; ?> min</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">Initial Setting Time:-
					<?php echo $row_select_pipe['initial_time']; ?> min</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">Final Setting Time:- <?php echo $row_select_pipe['final_time']; ?>
					min</td>
			</tr>
		</table>
		<br>
		<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
			<tr>
				<td>3) Soundness By Le- Chatelier's:- IS 4031 (Part-3)</td>
			</tr>
		</table>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;">
			<tr>
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;">Distance Before Heating (A) mm</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['dis_1_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['dis_1_1']; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;">Distance After Heating (B) mm</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['dis_2_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['dis_2_2']; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;">Expansion (B-A)</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['diff_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['diff_2']; ?></td>

			</tr>
			<tr>
				<td style="border: 1px solid black;" colspan="2">Average</td>
				<td style="border: 1px solid black;" colspan="2"><?php echo $row_select_pipe['soundness']; ?></td>
			</tr>
		</table>
		<br>
		<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
			<tr>
				<td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
						<u><?php echo $u_name; ?> </u></td></b>
				<td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
						<u><?php echo $v_name; ?> </u></td></b>
			</tr>
		</table>

		<div class="pagebreak"></div>
		<br><br>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align: center;">
			<tr>
			<tr>
				<td style="width: 20%;text-align: center;font-weight: bolder;border-right: 1px solid;" rowspan="5"><img
						src="../images/mat_logo.png" style="height: 100px;width:120px;background-blend-mode: multiply;">
				</td>

			</tr>
			<td style="border: 1px solid black;" colspan="2">
				NextGenLIMS Technologies<br>
				<b>(Formerly known as DC Consultant)</b><br>
				<b>Geo Technical Investigation, Construction Material Testing Facility, Designing Structures,</b><br>
				<b>DPR’s and other Civil Engineering Consultancy Services</b><br>
				<b>CIN : U71100HP2024PTC010626, GSTIN : 02AAKCD6125G1ZZ </b><br>
				<b>Regd. Office : VPO Taragarh , Near Taragarh Palace, Tehsil Baijnath, Distt. Kangra (H.P)
					(176081)</b><br>
				<b>Mobile : +91-7018819894, 01894 295-074 E-mail : officialdcspvtltd@gmail.com</b><br>

			</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Cement</b></td>
				<td style="border: 1px solid black;"><b>ANALYSIS DATA SHEET</b></td>
				<td style="border: 1px solid black;"><b>QSF-1004</b></td>
			</tr>
		</table>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;">
			<tr>
				<td style="border: 1px solid black;" colspan="2">Job Card No : <?php echo $job_no ?> </td>
				<td style="border: 1px solid black;" colspan="2">Test : Consistency, Setting Time, Soundness </td>
			</tr>
			<tr>
				<td style="border: 1px solid black;" colspan="2">Sample Description : <?php echo $mt_name; ?></td>
				<td style="border: 1px solid black;" colspan="2">Method : </td>
			</tr>
			<tr>
				<td style="border:1px solid">DOR : <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?> </td>
				<td style="border:1px solid">DOS : <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				<td style="border:1px solid">DOC : <?php echo date('d-m-Y', strtotime($end_date)); ?> </td>
				<td style="border: 1px solid black;">Page No.</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">Sample Qty : 30 kg</td>
				<td style="border: 1px solid black;">Residual Qty : 27.8 kg</td>
				<td style="border: 1px solid black;" colspan="2">Sample Retention : </td>
			</tr>
		</table>
		<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
			<tr>
				<td>4) Compressive Strength :- IS 4031 (Part-6)</td>
			</tr>
			<tr>
				<td>DOC :- <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
			</tr>
			<tr>
				<td>DOT :- <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
			</tr>
			<tr>
				<td>Days :- <?php echo $row_select_pipe['day_1']; ?></td>
			</tr>
		</table>
		<table width="92%" cellspacing="0"
			style="margin-left: auto; margin-right: auto; border:1px solid black; text-align:left;">
			<tr>
				<td style="border: 1px solid black;">SNo.</td>
				<td style="border: 1px solid black;">Area (mm²)</td>
				<td style="border: 1px solid black;">Load (KN)</td>
				<td style="border: 1px solid black;">Compressive Strength<br>
					(N/mm²)</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['area_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['load_1']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['com_1']; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['area_2']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['load_4']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['com_4']; ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['area_3']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['load_7']; ?></td>
				<td style="border: 1px solid black;"><?php echo $row_select_pipe['com_7']; ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%"
			style="font-size:16px;height:auto;font-family : Calibri;border-collapse: collapse;">
			<!--<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Density of test cement, ρ, (g/cc)<u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fines_val2']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Porosity, e<u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fin_21']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>->
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Apparatus Constant, K <u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['constant_k']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>-->
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 20px 5px 5px;border: 0;width:7%;">Finess
					(m<sup>2</sup>/Kg) = Factor x K x √to / P = (521.08 * <?php echo $row_select_pipe['constant_k_1']; ?>
					* <?php echo $row_select_pipe['fines_val1']; ?>) / (<?php echo $row_select_pipe['fines_val2']; ?>) =
					<u
						style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['ss_area']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;
					m<sup>2</sup>/Kg</td>
			</tr>



		</table>
		<br>
		<br>
		<br>
		<table width="92%" cellspacing="0" style="margin-left: auto; margin-right: auto; border:none; text-align:left;">
			<tr>
				<td style="border: 0;text-align: left;font-size: 15px;font-family: 'calibri'"><b>Tested by :
						<u><?php echo $u_name; ?> </u></td></b>
				<td style="border: 0;text-align: right;font-size: 15px;font-family: 'calibri'"><b>Checked By:
						<u><?php echo $v_name; ?> </u></td></b>
			</tr>
		</table>

		<!-- <table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
				<!-- header design ->
				 <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
				
				
				<?php
				if (($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['final_wtr'] != "" && $row_select_pipe['final_wtr'] != "0" && $row_select_pipe['final_wtr'] != null)) {
					?>
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding:1px;text-transform: uppercase;border: 1px solid;">CEMENT CONSISTENCY TEST (IS 4031 (Part-4) : 1988)</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding:1px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 0px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:20%;">Amount of Sample :- <span></span></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;width:20%;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['con_weight']; ?>&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp;gm</td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:20%">Room Temperature :- <span></span></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;width:25%;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['con_temp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; °C (25 °C to 29 °C)</td>						
							</tr>
							<tr>
								<td style="padding: 5px;"></td>	
								<td></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;">Room Humidity :- <span></span></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['con_humidity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; % (> 65% RH)</td>
							</tr>
						</table>
					</td>
				</tr>
					<?php } ?>
				<!-- table design ->
				<tr>
					<td>
					
						<table align="center" width="100%"  style="border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td>
								<?php $cnt = 1; ?>
								<table align="center" width="85%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;margin:10px auto">
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;"rowspan="2">Standard Consistency P,%</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;">Trial-1</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;">Trial-2</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;">Trial-3</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;">Trial-4</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;">Trial-5</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;">Final Standard Consistency P,%</td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;" ><?php echo $row_select_pipe['wtr_1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;" ><?php echo $row_select_pipe['wtr_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;" ><?php echo $row_select_pipe['wtr_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;" ><?php echo $row_select_pipe['wtr_4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;" ><?php echo $row_select_pipe['wtr_5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:10px;" ><?php echo $row_select_pipe['final_consistency']; ?></td>
									</tr>
									
								</table>
								</td>
							</tr>
						</table>
					

						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;  border-top:1px solid;">
							
							<tr>
									<td colspan="4" style="font-size: 12px;font-weight: bold;text-align: center; padding: 8px;border-top: 1px solid;width: 8%;border-bottom:1px solid;"colspan="3">INITIAL AND FINAL SETTING TIME TEST (IS 4031 (Part-5) : 1988)</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding:1px;border-top: 0;width: 8%; border-top:1px solid;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>

						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:0px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:29%;">Amount of Sample :- <span></span></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['set_weight']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0; width:25%">Room Temperature :- <span></span></td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['set_temp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; °C (25 °C to 29 °C)</td>
							</tr>
							<tr>
							<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:29%">Standard Consistency (P) :- <span></span></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['final_consistency']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; %</td>
								
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0; width:25%;">Room Humidity :- <span></span></td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['con_humidity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; % (> 65% RH)</td>
							
							</tr>
							<tr>
							<td style="font-weight: bold;text-align: left;padding:  5px 5px 20px;border: 0; width:29%">Amount of Water to be Taken :- 0.85 P</td>
								<td style="font-weight: bold;text-align: left;padding:  5px 5px 20px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['set_wtr']; ?>&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
								
								<!--<td style="font-weight: bold;text-align: right;padding:  5px 5px 20px;border: 0; width:25%;">Humidity in Closet :-<span></span></td>
								<td style="font-weight: bold;text-align: right;padding: 5px 5px 20px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php //echo $row_select_pipe['set_humidity2']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; % (> 90% RH)</td>->
								
							</tr>
						</table>

						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; 	">
							
							<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: left; padding:1px;border-top:0px solid;width: 8%;border-bottom:0px solid;"colspan="3">Initial Setting Time :</td>
							</tr>	
						</table>


						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:0px solid;">
								<tr>
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border: 0; width:30%;border:1px solid;">Start Time<span></span></td>
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border: 0; width:30%;border:1px solid;">Finish Time<span></span></td>
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border: 0; width:30%;border:1px solid;">Initial Setting Time, minute<span></span></td>
									
								</tr>
								<tr>
								<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border:1px solid;"><?php echo $row_select_pipe['hr_a']; ?></td>
								
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border:1px solid;"><?php echo $row_select_pipe['hr_b']; ?></td>				
										
								
									<td style="font-weight: bold;text-align: center;padding: 5px 5px 18px;border:1px solid;"><?php echo $row_select_pipe['initial_time']; ?></td>
								
								</tr>
								
								
						</table>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; 	">
							
							<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: left; padding:1px;border-top:0px solid;width: 8%;border-bottom:0px solid;"colspan="3">Final Setting Time :</td>
							</tr>	
						</table>


						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:0px solid;">
								<tr>
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border: 0; width:30%;border:1px solid;">Start Time<span></span></td>
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border: 0; width:30%;border:1px solid;">Finish Time<span></span></td>
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border: 0; width:30%;border:1px solid;">Final Setting Time, minute<span></span></td>
									
								</tr>
								<tr>
								<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border:1px solid;"><?php echo $row_select_pipe['hr_a']; ?></td>
								
									<td style="font-weight: bold;text-align: center;padding: 7px 5px 5px;border:1px solid;"><?php echo $row_select_pipe['hr_c']; ?></td>				
										
								
									<td style="font-weight: bold;text-align: center;padding: 5px 5px 18px;border:1px solid;"><?php echo $row_select_pipe['final_time']; ?></td>
								
								</tr>
								
								
						</table>
						
					
					</td>
				</tr>
				
			
				
				
				
			<!-- footer design ->
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
				</td>
			</tr>
			
		</table>

			</table>
		</page>
	<?php //} if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) ) {// ?>

 


	
		<div class="pagebreak"></div>
		<br>

		<page size="A4">
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;border-bottom:0px; ">
			
			<!-- header design ->
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
				
				<!-- header design ->
				
				
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding:1px;text-transform: uppercase;border: 1px solid;">SOUNDNESS TEST (IS 4031 (Part-3) : 1988)</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
								<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: center; padding:1px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
								</tr>
								<tr>
									<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
								</tr>
							</table>
							<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; border-top:0px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 9px 5px 5px;border: 0; width:29%;">Amount of Sample :-</td>
								<td style="font-weight: bold;text-align: left;padding: 9px 5px 5px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['sou_weight']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
								<td style="font-weight: bold;text-align: right;padding: 9px 5px 5px;border: 0; width:25%">Room Temperature :-</td>
								<td style="font-weight: bold;text-align: right;padding: 9px 5px 5px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['sou_temp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; °C (25 °C to 29 °C)</td>			
									
							</tr>
							<tr>
							<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:29%">Standard Consistency (P) :-</td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['final_consistency']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; %</td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0; width:25%;">Room Humidity :-</td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['sou_humidity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; % (> 65% RH)</td>
								<td style="padding: 5px;"></td>
							</tr>
							<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px 5px 16px;border: 0; width:29%">Amount of Water to be Taken :-  0.78 P</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 16px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['sou_water']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
								<td style="padding: 5px 5px 16px;"></td>
								<td style="padding: 5px 5px 16px;"></td>
							</tr>
						</table>
						<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse:collapse;border-left:2px solid;border-right: 2px solid; border-top:1px solid;">

							<tr>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:20%;">Description</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:25%;">Observation-1</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:35%;">Observation-2</td>		
									
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 1px;border: 1px solid;width:20%;"colspan="3"></td>
									
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid;width:20%;">
								Distance between Indicator Position (A) ,mm</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:25%;"><?php echo $row_select_pipe['dis_1_1']; ?></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:35%;"><?php echo $row_select_pipe['dis_1_2']; ?></td>		
									
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid;">Final Distance between Indicator Position (B), mm<span></span></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['dis_2_1']; ?></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['dis_2_2']; ?></td>
								
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid; width:%;">Difference between Initial & Final measurement (B-A), mm <span></span></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['diff_1']; ?></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['diff_2']; ?></td>
								
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: right;padding:1px;border:1px solid; width:%;">Average Expansion, mm<span></span></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;" colspan=2><?php echo $row_select_pipe['soundness']; ?></td>
							</tr>
						</table>
					</td>
				</tr>
				 <tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
					   
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding:1px;text-transform: uppercase;border: 1px solid;">DENSITY (IS 4031 (Part-11) : 1988)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: center; padding:1px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 8px 5px 18px;border: 0; width:29%;">Amount of Sample :- <span></span></td>
							<td style="font-weight: bold;text-align: left;padding: 8px 5px 18px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;64&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
							<td style="font-weight: bold;text-align: left;padding: 8px 5px 18px;border: 0; width:25%">Room Temperature :- <span></span></td>
							<td style="font-weight: bold;text-align: left;padding: 8px 5px 18px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['den_temp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; °C (25 °C to 29 °C)</td>						
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; border-top:1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:5%;">Sr. No.</td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:30%;">Description </td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:30%;">OBSERVATION - 1</td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;width:30%;">OBSERVATION - 2</td>
							
							
						</tr>	
						<tr>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;">1</td>
							<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid;">Mass of Cement (M), g :- </td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_intial']; ?></td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_intial1']; ?></td>		
							
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;">2</td>
							<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid;">Initial Reading (A), cm<sup>3</sup> </td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_intial']; ?></td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_intial1']; ?></td>		
							
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;">3</td>
							<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid;">Final Reading (B), cm<sup>3</sup><span></span></td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_final']; ?></td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_final1']; ?></td>
							
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;">4</td>
							<td style="font-weight: bold;text-align: left;padding:1px;border:1px solid;">Vol. of liquid displaced by mass of cement (V), cm<sup>3</sup> = B-A<span></span></td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_displaced']; ?></td>
							<td style="font-weight: bold;text-align: center;padding:1px;border:1px solid;"><?php echo $row_select_pipe['den_displaced1']; ?></td>
							
							
						</tr>
						<tr>
							<td  style="font-weight: bold;text-align: center;padding:1px;border:1px solid;">5</td>
							<td  style="font-weight: bold;text-align: left;padding:1px;border:1px solid;">Density = M / V, g/cc</td>
							<td  style="font-weight: bold;text-align: center;padding:1px;border:1px solid; "><?php echo $row_select_pipe['density']; ?></sub>
							<td  style="font-weight: bold;text-align: center;padding:1px;border:1px solid; "><?php echo $row_select_pipe['density1']; ?></td>
						</tr>
						<tr>
							<td  style="font-weight: bold;text-align: center;padding: 5px 5px 25px;border:1px solid;">6</td>
							<td  style="font-weight: bold;text-align: right;padding: 5px 5px 25px;border:1px solid;">Average Density</td>
						
							<td  colspan="2" style="font-weight: bold;text-align: center;padding: 5px 5px 25px;border:1px solid;"> <?php echo $row_select_pipe['avg_density']; ?></td>
						</tr>
					</table>
				</td>
			</tr>
				
						


						
					
				
					
				

			<!-- footer design ->
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
				</td>
			</tr>
			
		</table>


			</table>
		</page>
		
	 <?php if (($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null) || ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) || ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != null) || ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != null)) { ?>

		<div class="pagebreak"></div>
		<br>

		<page size="A4">
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
			 <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			<!-- header design ->
			<tr>
				<td>
					
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
						
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding:1px;text-transform: uppercase;border: 1px solid;">FINENESS BY BLAINE AIR PERMEABILITY TEST (IS 4031(Part-2):1999, IS:3535:1986,IS:5516:1996)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
					</table>
				</td>
			</tr>
		   
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px 5px 10px;border-top: 0;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 20px;border: 0;">Room Temperature :-<span></span></td>
								<td style="font-weight: bold;text-align: leftt;padding: 5px 5px 20px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fine_temp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; °C (25 °C to 29 °C)</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 20px;border: 0;">Room Humidity :- <span></span></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 20px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fine_humidity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; ( &lt; 65 % RH)</td>	
							</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
							<tr>
								<td style="padding:1px;font-weight: bold;padding:1px;border:1px solid ;" colspan=4></td>
								
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;width:10%;">(I) Amount of Sample, m1</td>
								<td style="padding:1px;font-weight: bold;" colspan=3> </td>
							</tr>
							<tr>
								<td style="padding:1px;font-weight: bold;padding:1px;border:1px solid ;" colspan=4></td>
								
							</tr>
							
							<tr>
								<td style="padding:1px;font-weight: bold;" colspan=4></td>
								
							</tr>
							<tr>
								<td style="padding:1px;font-weight: bold;" colspan=4></td>
								
							</tr>
							<tr>
								<td style="padding:1px;font-weight: bold;" colspan=4>m1 =   (1-e) ρ V <u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['avg_density']; ?> where, ρ = density of test cement </td>
								
							</tr>
							
							<tr>
								<td style="padding:1px;font-weight: bold;" colspan=4></td>
								
							</tr>
							<tr>
								<td style="padding:1px;font-weight: bold;" colspan=4></td>
								
							</tr>
							<tr>
								<td style="padding:1px;font-weight: bold;" colspan=4></td>
								
							</tr>
							<tr>
								<td style="padding:1px;font-weight: bold;padding:1px;border:1px solid ;" colspan=4></td>
								
							</tr>
							
					</table>
				</td>
			</td></tr>

<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">Sr.<br>No.</td>
								<td style="font-weight: bold;text-align: leftt;padding: 5px 5px ;border:  1px solid;">Description</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"colspan="2">Observation-1</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"colspan="2">Observation-2</td>	
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">1</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">Time, t , Sec</td>
								<td style="font-weight: bold;text-align: center;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fines_t_1']; ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fines_t_2']; ?></td>	
								<td style="font-weight: bold;text-align: center;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fines_t_3']; ?></td>	
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"></td>	
							</tr>
							
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">2</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">Mean Time, t , Sec</td>
								<td style="font-weight: bold;text-align: center;padding: 5px 5px ;border:  1px solid;"colspan="4"><?php echo $row_select_pipe['avg_fines_time']; ?></td>
							</tr>
							
							<!--<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">3</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">Test temperature, T, 0C</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_9']; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_12']; ?></td>	
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_14']; ?></td>	
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_17']; ?></td>	
							</tr>
							
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">4</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">Mean Test temperature, T, 0C</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_9']; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_12']; ?></td>	
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_14']; ?></td>	
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;"><?php echo $row_select_pipe['fin_17']; ?></td>	
							</tr>->
							
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">3</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px ;border:  1px solid;">Air Viscosity at testtemperaure taken,√0.1ή</td>
								<td style="font-weight: bold;text-align: center;padding: 5px 5px ;border:  1px solid;" colspan="4"><?php echo $row_select_pipe['constant_k']; ?></td>
							</tr>
							
					</table>
				</td>
			</tr>
			
			<!--<tr>
				<td>
					<?php $cnt = 1; ?>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-top:2px solid black;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 8px;border: 1px solid;border-bottom:2px solid black;border-right:2px solid black;width:50%;"colspan="2" >Standard Sample Data</td>
							<td style="font-weight: bold;text-align: center;padding: 8px;border: 1px solid;border-bottom:2px solid black;width:50%;" colspan="3">Test Material Data</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Amount of sample m (gm)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; width:18%"><?php echo $row_select_pipe['fin_1']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Volume of cement bed V (cm³)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; width:20%" colspan=2><?php echo $row_select_pipe['fin_2']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Density p<sub>o,</sub> (g/cc)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;"><?php echo $row_select_pipe['fin_3']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Density p<sub>,</sub> (g/cc)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; " colspan=2><?php echo $row_select_pipe['fin_4']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Porosity, e<sub>0</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; "><?php echo $row_select_pipe['fin_5']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Porosity, e</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; " colspan=2><?php echo $row_select_pipe['fin_6']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Air Viscosity at the mean of thSTC temperature, √0.1ή0</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;"><?php echo $row_select_pipe['fin_7']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Air Viscosity at test temprature taken, √0.1ή0</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;" colspan=2><?php echo $row_select_pipe['fin_8']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in Second - t<sub>1</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;"><?php echo $row_select_pipe['fin_9']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in Second-t<sub>1</sub> (Bed-1)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; width:10%"><?php echo $row_select_pipe['fin_10']; ?></td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;width:10%;"><?php echo $row_select_pipe['fin_11']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in Second-t<sub>2</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; "><?php echo $row_select_pipe['fin_12']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in S, t<sub>1</sub> (Average of Bed-1)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; " colspan=2><?php echo $row_select_pipe['fin_13']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in Second-t<sub>3</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; "><?php echo $row_select_pipe['fin_14']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in Second-t<sub>2</sub> (Bed -2)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;width:10%;"><?php echo $row_select_pipe['fin_15']; ?></td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;width:10%;"><?php echo $row_select_pipe['fin_16']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in Second t<sub>0</sub> (Average of t₁, t₂ & t₃)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; "><?php echo $row_select_pipe['fin_17']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Time in S, t2 (Average of Bed-2)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; " colspan=2><?php echo $row_select_pipe['fin_18']; ?></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Specific Surface S<sub>0,</sub> (cm²/g)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid; "><?php echo $row_select_pipe['fin_19']; ?></td>
							<td style="font-weight: bold;text-align: left;padding: 7px;border: 1px solid;">Specific Surface S, (cm²/g)</td>
							<td style="font-weight: bold;text-align: center;padding: 7px;border: 1px solid;" colspan=2><?php echo $row_select_pipe['fin_20']; ?></td>
						</tr>
					</table>
				</td>
			</tr>->

			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-top:1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Density of test cement, ρ, (g/cc)<u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fines_val2']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>
						<!--<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Porosity, e<u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fin_21']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>->
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Apparatus Constant, K <u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['constant_k']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 20px 5px 5px;border: 0;width:7%;">Specific surface area S = 521.08 x K x √to / P = <u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['ss_area']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
						</tr>
						
					   

					</table>
				</td>
			</tr>

			
	
		   
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; 	">
							<tr>
									<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
							<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 7px;border:1px solid;width: 8%;"colspan="3">Compressive Strength (IS 4031 (Part-6) : 1988)</td>
							</tr>
							<tr>
									<td style="padding: 1px;border: 1px solid;"></td>
							</tr>		
						</table>

						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; border-top:0px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 5px;border: 0; width:29%;">Standard Consistency (P):-</td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['weight_of_cement']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; %</td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0; width:26%">Room Temperature :- <span></span></td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['com_temp']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; °C (25 °C to 29 °C)</td>			
							</tr>
							<tr>
							<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:29%">Amount of Water to be Taken:<br> ((P/4) +3) % of Combined Mass <span></span></td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['weight_of_water']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; gm</td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0; width:26%;">Room Humidity :- </td>
								<td style="font-weight: bold;text-align: right;padding:1px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fine_humidity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; % (> 65% RH)</td>
							</tr>
							<tr>
							<td style="font-weight: bold;text-align: left;padding:1px;border: 0; width:1%">Cube Size :-</td>
								<td style="font-weight: bold;text-align: left;padding:1px;border: 0;">7.06 cm x 7.06 cm x 7.06 cm</td>
								<!--<td style="font-weight: bold;text-align: right;padding:1px;border: 0; width:26%;">Humidity in Closet :-</td>
								<td style="font-weight: bold;text-align: right;padding: 5px 5px 5px;border: 0;"><u style="text-underline-offset:4px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $row_select_pipe['fine_humidity']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;&nbsp; % (>90% RH)</td>->
							</tr>
						
						</table>

				<tr>
					<td>
						<?php $cnt = 1; ?>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;" rowspan="3">Age of <br> Specimen</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;" colspan="3">Specimen Dimensions</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;" rowspan="4">Casting Date <br> of Specimen</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;" rowspan="4">Testing Date <br> of Specimen</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;" rowspan="2">Observed <br> Failure Load</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;" rowspan="2">Compressive <br> Strength</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;" rowspan="3">Average <br> Compressive <br> Strength</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">Length</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">Breadth</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">Height</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">L</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">B</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">H</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">p</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;">Px 1000/(LxB)</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">Hours/Days</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">mm</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">KN</td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">N/mm<sup>2</sup></td>
								<td style="font-weight: bold;text-align: center;padding:1px;border: 1px solid;border-bottom: 1px solid;">N/mm<sup>2</sup></td>
							</tr>
							<?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;" rowspan="3"><b>72 ± 1h / <br>3 days</b></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l1']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b1']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h1']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_1']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;" ><?php echo $row_select_pipe['com_1']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;" rowspan="3"><?php echo $row_select_pipe['avg_com_1']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;" ><?php echo $row_select_pipe['l2']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b2']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h2']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_2']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_2']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l3']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b3']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h3']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_3']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_3']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;" rowspan="3"><b>168 ± 2h / <br> 7 days</b></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l4']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b4']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h4']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date2'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date2'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_4']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_4']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;" rowspan="3"><?php echo $row_select_pipe['avg_com_2']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l5']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b5']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h5']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date2'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date2'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_5']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_5']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l6']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b6']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h6']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date2'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date2'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_6']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_6']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;"rowspan="3"><b>672 ± 4h / <br> 28 days</b></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l7']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b7']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h7']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date3'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date3'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_7']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_7']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;" rowspan="3"><?php echo $row_select_pipe['avg_com_3']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l8']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b8']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h8']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date3'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date3'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_8']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_8']; ?></td>
							</tr>
							<?php }
							if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) { ?>
							<tr>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['l9']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['b9']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['h9']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date3'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date3'])); ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['load_9']; ?></td>
								<td style="text-align: center;padding: 3px;border: 1px solid;"><?php echo $row_select_pipe['com_9']; ?></td>
							</tr>
							<?php } ?>
							
						</table>
		 <!-- footer design -->

			<!-- footer design ->
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
				</td>
			</tr>
			
		</table>


		</table>
		</page>
		</table>

		</page>
	<?php } ?>
	
	
		<?php //}if ($row_select_pipe['chk_che'] =="1"){ ?>
	
	
			<br>
		
		<page size="A4" >
			
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;border-bottom:0px; ">
			
			<!-- header design ->
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			
			
			<tr>
					<td>
			<table align="center" width="100%" class="test1" style="margin-top:-1px;" height="Auto">
				<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			
			<table align="center" width="100%" class="test1"  height="Auto">
				<tr >
					
					<td style="text-align:left;border-left:1px solid;border-right:1px solid;" colspan="4"><b>1. LOSS ON IGNITION (LOI)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE + SAMPLE (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo number_format((floatval($row_select_pipe['ig1']) + floatval($row_select_pipe['ig2'])), 4); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>LOSS ON IGNITION  =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo number_format((floatval($row_select_pipe['ig1']) + floatval($row_select_pipe['ig2'])), 4); ?> - <?php echo $row_select_pipe['ig3']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>L.O.I  =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['ig1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig4']; ?> %</td>
				</tr>
			
				<tr >
					
					<td style="text-align:left;border-left:1px solid;border-right:1px solid;" colspan="4"><b>2. SILICA, (SiO<sub>2</sub>)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER HF (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio4']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA BEFORE HF</b></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio3']; ?> - <?php echo $row_select_pipe['sio2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio5']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA AFTER HF</b></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio3']; ?> - <?php echo $row_select_pipe['sio4']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio6']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >7</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>R = R1 - R2</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<?php echo $row_select_pipe['sio5']; ?> - <?php echo $row_select_pipe['sio6']; ?></td>
						
					<td  style="text-align:center; border: 1px solid black;"><?php echo $silica_r = $row_select_pipe['sio5'] - $row_select_pipe['sio6']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >8</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>PURE SILICA = R + R2(SILICA FROM R<sub>2</sub>O<sub>3</sub>)</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<?php echo $silica_r; ?> + <?php echo $row_select_pipe['r2o6']; ?></td>
						
					<td  style="text-align:center; border: 1px solid black;"><?php echo number_format($row_select_pipe['sio7'], 2); ?> %</td>
				</tr>
				
				<tr >
					
					<td style="text-align:left;border-left:1px solid;border-right:1px solid;" colspan="4"><b>3. COMBINED FERRIC OXIDE AND ALUMINA (R<sub>2</sub>O<sub>3</sub>)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER HF (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o4']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA BEFORE HF</b></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o3']; ?> - <?php echo $row_select_pipe['r2o2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o5']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA AFTER HF</b></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o3']; ?> - <?php echo $row_select_pipe['r2o4']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o6']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >7</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>R = R1 - R2</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">										
						<?php echo $row_select_pipe['r2o5']; ?> - <?php echo $row_select_pipe['r2o6']; ?>					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o7']; ?> %</td>
				</tr>
			
				</table>
				
					</td>
				</tr>
				<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
				</td>
			</tr>
			</table>
			<div class="pagebreak"> </div>
			
			<br>
			
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;border-bottom:0px; ">
			
			<!-- header design ->
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
					<td>	
			<table align="center" width="100%" class="test1" style="" height="Auto">
			
			<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			
			<table align="center" width="100%" class="test1" style="" height="Auto">
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>4(A). FERRIC OXIDE, (Fe<sub>2</sub>O<sub>3</sub>)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo2']; ?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.7985 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>FERRIC OXIDE (Fe<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.7985 X <?php echo $row_select_pipe['feo2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td> FERRIC OXIDE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['feo1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo3']; ?> %</td>
				</tr>
				<tr >
					
					<td style="text-align:left;border-left:1px solid;border-right:1px solid;" colspan="4"><b>4(B). ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.5098 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.5098 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo3']; ?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >4</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) = R<sub>2</sub>O<sub>3</sub> - Fe<sub>2</sub>O<sub>3</sub></td>
					<td  style="width:30%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o7']; ?> - <?php echo $row_select_pipe['feo3']; ?></td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alo1']; ?> %</td>
				</tr>
			
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>5. CALCIUM OXIDE (CaO)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao3']; ?> - <?php echo $row_select_pipe['cao2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao4']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td colspan="4" style="border: 1px solid black;text-align:center" >OR</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">TRITANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao5']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.05608 X 25 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.05608 X 25 X <?php echo $row_select_pipe['cao5']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao6']; ?> %</td>
				</tr>
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>6. MAGNESIUM OXIDE (MgO)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 36.22</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo3']; ?> - <?php echo $row_select_pipe['mgo2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 36.22</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo4']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td colspan="4" style="border: 1px solid black;text-align:center" >OR</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">TRITANT (V1) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo5']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.04032 X 25 X (V1 - V)</td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.04032 X 25 X (<?php echo $row_select_pipe['mgo5']; ?> - <?php echo $row_select_pipe['cao5']; ?>)</td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo6']; ?> %</td>
				</tr>
				
				</table>
			
			</td>
				</tr>
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			</table>
				</td>
			</tr>
			</table>
				<div class="pagebreak"> </div>
			<br>
			
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;border-bottom:0px; ">
			
			<!-- header design ->
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			<tr>
					<td>
			<table align="center" width="100%" class="test1" style="" height="Auto">
			
			<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			
			
			
			<table align="center" width="100%" class="test1" style="" height="Auto">
			<tr >
					
					<td style="text-align:left;" colspan="4"><b>7. SULPHURIC ANHYDRIDE, SO<sub>3</sub></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>SULPHURIC ANHYDRIDE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 34.3</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['so3']; ?> - <?php echo $row_select_pipe['so2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>SO<sub>3</sub></td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 34.3</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['so1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so4']; ?> %</td>
				</tr>
			<tr >
					
					<td style="text-align:left;" colspan="4"><b>8. INSOLUBLE RESIDUE</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['res1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['res2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['res3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>INSOLUBLE RESIDUE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['res3']; ?> - <?php echo $row_select_pipe['res2']; ?></td>
								<td></td>
						</tr>
						<tr>
								<td>IR =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['res1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['res4']; ?> %</td>
				</tr>
				
				
				
				
				
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>9. CHLORIDE</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT USED FOR SAMPLE (X), ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl2']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT USED FOR BLANK (Y), ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl3']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">Z = 10 - (X-Y)</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl4']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;"> N = Normality of NH<sub>4</sub>SCN</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl5']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>(Z X 0.03546 X N X 100)</td>
								<td></td>
						</tr>
						<tr>
								<td>Cl =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>(<?php echo $row_select_pipe['cl4']; ?> X 0.03546 X <?php echo $row_select_pipe['cl5']; ?> X 100)</td>
								<td></td>
						</tr>
						<tr>
								<td>Cl =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cl1']; ?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl6']; ?>  %</td>
				</tr>
				</table>
				<table align="center" width="100%" class="test1"  height="Auto">
				<tr >
					
					<td style="text-align:left;border-left:0px solid;" colspan="5"><b>10. ALAKALI CONTENT Na<sub>2</sub>O</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alk1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  rowspan="2" style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  rowspan="2" style="width:50%;text-align:left; border: 1px solid black;">ALAKALI CONTENT Na<sub>2</sub>O</b> %</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk2']; ?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk3']; ?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk4']; ?> %</td>
				</tr>
				</table>
				<table align="center" width="100%" class="test1"  height="Auto">
				<tr >
					
					<td style="text-align:left;border:0px" colspan="5"><b>11. ALAKALI CONTENT K<sub>2</sub>O</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alk5']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  rowspan="2" style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  rowspan="2" style="width:50%;text-align:left; border: 1px solid black;">ALAKALI CONTENT K<sub>2</sub>O</b> %</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk6']; ?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk7']; ?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk8']; ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  rowspan="2" style="width:5%;border: 1px solid black;text-align:center" >3</td>
					<td  rowspan="2" style="width:50%;text-align:left; border: 1px solid black;">EQUIVALENT ALKALI (Na<sub>2</sub>O</b>) CONTENT % = Na<sub>2</sub>O</b> % + 0.658 K<sub>2</sub>O</b> %</td>
					<td  colspan="3" style="width:5%;border: 1px solid black;text-align:center" ><?php
					$ad1 = $row_select_pipe['alk4'];
					$ad2 = $row_select_pipe['alk8'];

					$cal12 = floatval(0.658) * floatval($ad2);
					$ansd = $cal12 + floatval($ad1);

					echo number_format($ansd, 2);

					?></td>
					
				</tr>
				</table>
				
				<table align="center" width="100%" class="test1"  height="Auto">
				<tr>
					
					<td style="text-align:left;border:0px" colspan="5"><b>12. Sulphur as Sulphaide (s)</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">VOLUME IN ML OF POTASSIUM IODATE SOLUTION REQUIRED BY THE SAMPLE (V), ml</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sul1']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">SULPHUR EQUIVALENT OF THE POTASSIUM IODATE SOLUTION (E), g/ml</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sul2']; ?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td   style="width:5%;border: 1px solid black;text-align:center" >3</td>
					<td   style="width:50%;text-align:left; border: 1px solid black;">SULPHUR CONTENT % = E X V X 20</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td   style="width:5%;border: 1px solid black;text-align:center" ><?php
					echo $row_select_pipe['sul3'];
					?></td>
					
				</tr>
				</table>
				
			</td>
				</tr>

			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			</table>
				</td>
			</tr>
			</table>

				
			
					<div class="pagebreak"> </div>
			<br>
			
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;border-bottom:0px; ">
			
			<!-- header design ->
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt; ?></td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:1px;padding-top:1px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:1px;padding-top:1px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CEMENT</td>
						</tr>
						<?php
						if ($row_select_pipe['lab_no'] != "") {
							$cnt = 1;
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++; ?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no']; ?></td>
						</tr>
							<?php }
						if ($job_no != "") {
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
						</tr>
						<?php }
						//if($job_no!=""){
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++; ?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			<tr>
			<td>
			<h3 style="font-size:14px; text-align:center;">PERCENTAGE OF CEMENT</h3>
			<br>
			<table align="center" width="70%" class="test1"  height="Auto">
				
				<tr style="border: 1px solid black;">
					<td  style="width:20%;border: 1px solid black;text-align:center;font-weight:bold;" >SR.NO.</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;font-weight:bold;">PRESENT CHEMICAL COMPOUND</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">PERCENTAGE</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:20%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">SILICA</td>
					<td  style="width:30%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['sio7']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">COMBINED FERRIC OXIDE AND ALUMINA</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['r2o7']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">CALCUIM OXIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['cao6']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >4</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">MAGNESIUM OXIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['mgo6']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >5</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">SULPHURIC ANHYDRIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['so4']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >6</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">LOSS ON IGNITION</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['ig4']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >7</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">CHLORIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['cl6']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >8</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">ALKALI</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php $ad1 = $row_select_pipe['alk4'];
					$ad2 = $row_select_pipe['alk8'];

					$cal12 = floatval(0.658) * floatval($ad2);
					$ansd = $cal12 + floatval($ad1);

					echo number_format($ansd, 2); ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >9</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">INSOLUBLE RESIDUE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['res4']; ?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  colspan="2" style="width:70%;border: 1px solid black;text-align:center" >TOTAL</td>
					
					<td  style="width:30%;border: 1px solid black;text-align:center" >
					
					<?php

					$ad1 = $row_select_pipe['alk4'];
					$ad2 = $row_select_pipe['alk8'];

					$cal12 = floatval(0.658) * floatval($ad2);
					$ansd = $cal12 + floatval($ad1);


					$ans = floatval($row_select_pipe['sio7']) + floatval($row_select_pipe['r2o7']) + floatval($row_select_pipe['cao6']) + floatval($row_select_pipe['mgo6']) + floatval($row_select_pipe['so4']) + floatval($row_select_pipe['ig4']) + floatval($row_select_pipe['cl6']) + floatval($ansd) + floatval($row_select_pipe['res4']);

					echo number_format($ans, 2);

					?></td>
					
				</tr>
				
				</table>
				<br>
				<table align="center" width="70%" class="test1"  height="Auto">
			
				<tr style="text-align:center;height:25px;">
				<td style="border:1px solid black;text-align:center;">1.</td>
				<td style="border:1px solid black;text-align:left;"><b>
				Ratio percentage of lime to percentage of silica allumina and iron oxide
				<br>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;CaO-0.7SO<sub>3</sub></span>										
				
				<br>
				<span style="border-top:solid black 1px;border-right:0px solid;border-bottom:0px;">2.8SiO<sub>2</sub> + 1.2 Al<sub>2</sub>O<sub>3</sub> + 0.65 Fe<sub>2</sub>O<sub>3</sub></span>
				
				</b></td>
				
				<td style="border:1px solid black;"><?php echo number_format($row_select_pipe['per1'], 2); ?></td>
				
			</tr>
			
			<tr style="text-align:center;height:25px;">
				<td style="border:1px solid black;text-align:center;">2.</td>
				<td style="border:1px solid black;text-align:left;"><b>Ratio of percentage of Alumina to that of Iron Oxide, %</b></td>
				
				
				<td style="border:1px solid black;"><?php if ($row_select_pipe['alo1'] == "" && $row_select_pipe['alo1'] == null && $row_select_pipe['alo1'] == "0") {
					echo "-";
				} else {
					echo number_format(($row_select_pipe['alo1'] / $row_select_pipe['feo3']), 2);
				} ?></td>										
				
				
			</tr>
				</table>
			</td>
				</tr>
			
			
			<tr>
				<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding:1px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding:1px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2']; ?></td>
			</tr> ->
			<tr>
				<td style="font-weight: bold;text-align: left;padding:1px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding:1px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			</table>
				</td>
			</tr>
			</table>
	
	
	
	
	
	
	
	
	
	
	
		<?php //} ?>
	
	
	
	<!-- <br>
	<br>

	<page size="A4">
		
		
		<?php
		if (($row_select_pipe['avg_density'] != "" && $row_select_pipe['avg_density'] != "0" && $row_select_pipe['avg_density'] != null) || ($row_select_pipe['final_consistency'] != "" && $row_select_pipe['final_consistency'] != "0" && $row_select_pipe['final_consistency'] != null) || ($row_select_pipe['ss_area'] != "" && $row_select_pipe['ss_area'] != "0" && $row_select_pipe['ss_area'] != null)) {
			$pagecnt++;
			?>
		
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-002</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-002</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>	
		
		<br>
		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $job_no; ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Type of Cement</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $type_of_cement; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Brand Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $cement_brand; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification Mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo "Cement - " . $in_grade; ?> <?php //echo $row_select_pipe['lab_no']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y", strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="94%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center><?php echo $cnt++; ?>.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Density of Cement by Le Chatelier Flask</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031(P-11) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Test Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if ($row_select_pipe['sou_temp'] != '' && $row_select_pipe['sou_temp'] != '0' && $row_select_pipe['sou_temp'] != null) {
					echo $row_select_pipe['sou_temp'];
				} else {
					echo ' - ';
				} ?></b></td>
				<td style="text-align:left;"><b>Humidity(%) - Min. <?php if ($row_select_pipe['sou_humidity'] != '' && $row_select_pipe['sou_humidity'] != '0' && $row_select_pipe['sou_humidity'] != null) {
					echo $row_select_pipe['sou_humidity'];
				} else {
					echo ' - ';
				} ?> %</b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="15%" style="margin-top:-1px;font-size:14px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>1</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Air temperature &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; °C</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['sou_temp'] != '' && $row_select_pipe['sou_temp'] != '0' && $row_select_pipe['sou_temp'] != null) {
					echo $row_select_pipe['sou_temp'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['sou_temp'] != '' && $row_select_pipe['sou_temp'] != '0' && $row_select_pipe['sou_temp'] != null) {
					echo $row_select_pipe['sou_temp'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>2</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Mass of cement used &nbsp; &nbsp; &nbsp; gm</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['sou_weight'] != '' && $row_select_pipe['sou_weight'] != '0' && $row_select_pipe['sou_weight'] != null) {
					echo $row_select_pipe['sou_weight'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['sou_weight'] != '' && $row_select_pipe['sou_weight'] != '0' && $row_select_pipe['sou_weight'] != null) {
					echo $row_select_pipe['sou_weight'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>3</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Initial reading of flask &nbsp; &nbsp; &nbsp; &nbsp; ml</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['dis_1_1'] != '' && $row_select_pipe['dis_1_1'] != '0' && $row_select_pipe['dis_1_1'] != null) {
					echo $row_select_pipe['dis_1_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['dis_1_2'] != '' && $row_select_pipe['dis_1_2'] != '0' && $row_select_pipe['dis_1_2'] != null) {
					echo $row_select_pipe['dis_1_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>4</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Final reading of flask &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; ml</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['dis_2_1'] != '' && $row_select_pipe['dis_2_1'] != '0' && $row_select_pipe['dis_2_1'] != null) {
					echo $row_select_pipe['dis_2_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['dis_2_2'] != '' && $row_select_pipe['dis_2_2'] != '0' && $row_select_pipe['dis_2_2'] != null) {
					echo $row_select_pipe['dis_2_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>5</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Displaced volume in cm<sup>3</sup> &nbsp; (4-3)</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['diff_1'] != '' && $row_select_pipe['diff_1'] != '0' && $row_select_pipe['diff_1'] != null) {
					echo $row_select_pipe['diff_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['diff_2'] != '' && $row_select_pipe['diff_2'] != '0' && $row_select_pipe['diff_2'] != null) {
					echo $row_select_pipe['diff_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>6</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Density of Cement (2/5)&nbsp; ,&nbsp; g/cm<sup>3</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['diff_1'] != '' && $row_select_pipe['diff_1'] != '0' && $row_select_pipe['diff_1'] != null) {
					echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_1']), 0, 6);
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['diff_2'] != '' && $row_select_pipe['diff_2'] != '0' && $row_select_pipe['diff_2'] != null) {
					echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_2']), 0, 6);
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>7</center></b></td>
				<td style="width:64%;padding-left:3px;"><b>Density of Cement &nbsp; ,&nbsp; g/cm <sup>3</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['diff_1'] != '' && $row_select_pipe['diff_1'] != '0' && $row_select_pipe['diff_1'] != null) {
					echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_1']), 0, 6);
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><?php if ($row_select_pipe['diff_2'] != '' && $row_select_pipe['diff_2'] != '0' && $row_select_pipe['diff_2'] != null) {
					echo substr(($row_select_pipe['sou_weight'] / $row_select_pipe['diff_2']), 0, 6);
				} else {
					echo ' - ';
				} ?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="94%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center><?php echo $cnt++; ?>.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Consistency Test</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031(P-4) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if ($row_select_pipe['con_temp'] != '' && $row_select_pipe['con_temp'] != '0' && $row_select_pipe['con_temp'] != null) {
					echo $row_select_pipe['con_temp'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity(%) - Min. <?php if ($row_select_pipe['con_humidity'] != '' && $row_select_pipe['con_humidity'] != '0' && $row_select_pipe['con_humidity'] != null) {
					 echo $row_select_pipe['con_humidity'];
				 } else {
					 echo ' - ';
				 } ?>%</b></td>
				<td style="text-align:center;"><b>Weight of Cement <?php if ($row_select_pipe['con_weight'] != '' && $row_select_pipe['con_weight'] != '0') {
					echo $row_select_pipe['con_weight'];
				} else {
					echo ' - ';
				} ?> gm</b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="13%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>Sr.No.</center></b></td>
				<td style="width:32%;padding-left:3px;text-align:center;"><b>Volume of Water (cc)</b></td>
				<td style="border-left:1px solid;text-align:center;width:32%;"><b>% of Water</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>Reading on Vicat (mm)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['vol_1'] != '' && $row_select_pipe['vol_1'] != '0' && $row_select_pipe['vol_1'] != null) {
					echo $row_select_pipe['vol_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_1'] != '' && $row_select_pipe['wtr_1'] != '0' && $row_select_pipe['wtr_1'] != null) {
					echo $row_select_pipe['wtr_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['reading_1'] != '' && $row_select_pipe['reading_1'] != '0' && $row_select_pipe['reading_1'] != null) {
					echo $row_select_pipe['reading_1'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['vol_2'] != '' && $row_select_pipe['vol_2'] != '0' && $row_select_pipe['vol_2'] != null) {
					echo $row_select_pipe['vol_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_2'] != '' && $row_select_pipe['wtr_2'] != '0' && $row_select_pipe['wtr_2'] != null) {
					echo $row_select_pipe['wtr_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['reading_2'] != '' && $row_select_pipe['reading_2'] != '0' && $row_select_pipe['reading_2'] != null) {
					echo $row_select_pipe['reading_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['vol_3'] != '' && $row_select_pipe['vol_3'] != '0' && $row_select_pipe['vol_3'] != null) {
					echo $row_select_pipe['vol_3'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_3'] != '' && $row_select_pipe['wtr_3'] != '0' && $row_select_pipe['wtr_3'] != null) {
					echo $row_select_pipe['wtr_3'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['reading_3'] != '' && $row_select_pipe['reading_3'] != '0' && $row_select_pipe['reading_3'] != null) {
					echo $row_select_pipe['reading_3'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>4</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['vol_4'] != '' && $row_select_pipe['vol_4'] != '0' && $row_select_pipe['vol_4'] != null) {
					echo $row_select_pipe['vol_4'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_4'] != '' && $row_select_pipe['wtr_4'] != '0' && $row_select_pipe['wtr_4'] != null) {
					echo $row_select_pipe['wtr_4'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['reading_4'] != '' && $row_select_pipe['reading_4'] != '0' && $row_select_pipe['reading_4'] != null) {
					echo $row_select_pipe['reading_4'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>5</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['vol_5'] != '' && $row_select_pipe['vol_5'] != '0' && $row_select_pipe['vol_5'] != null) {
					echo $row_select_pipe['vol_5'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_5'] != '' && $row_select_pipe['wtr_5'] != '0' && $row_select_pipe['wtr_5'] != null) {
					echo $row_select_pipe['wtr_5'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['reading_5'] != '' && $row_select_pipe['reading_5'] != '0' && $row_select_pipe['reading_5'] != null) {
					echo $row_select_pipe['reading_5'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;border-width:1px 1px 0 0;">
				<td></td>
				<td></td>
				<td style="padding-left:3px;text-align:right;border-left:1px solid;border-bottom:1px solid;">Consistency &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; </td>
				<td style="border-left:1px solid;text-align:center;border-bottom:1px solid;"><?php if ($row_select_pipe['final_consistency'] != '' && $row_select_pipe['final_consistency'] != '0' && $row_select_pipe['final_consistency'] != null) {
					echo $row_select_pipe['final_consistency'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			
		</table>
		<Br>
		<table align="center" width="94%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center><?php echo $cnt++; ?>.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Specific surface area m <sup>2</sup> / Kg.</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031(P-2) &nbsp;  &nbsp;  1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Test Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if ($row_select_pipe['fine_temp'] != '' && $row_select_pipe['fine_temp'] != '0' && $row_select_pipe['fine_temp'] != null) {
					echo $row_select_pipe['fine_temp'];
				} else {
					echo ' - ';
				} ?></b></td>
				<td style="text-align:left;"><b>Humidity(%) - Min. <?php if ($row_select_pipe['fine_humidity'] != '' && $row_select_pipe['fine_humidity'] != '0' && $row_select_pipe['fine_humidity'] != null) {
					echo $row_select_pipe['fine_humidity'];
				} else {
					echo ' - ';
				} ?>%</b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="13%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td colspan="2" style="width:20%;border-right:1px solid;"><b><center>Time in Seconds (T)</center></b></td>
				<td colspan="2" style="width:80%;padding-left:5px;"><b>Specific surface area of Standard Cement in cm<sup>2</sup> /g, S<sub>o</sub></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:8%;border-right:1px solid;"><b><center>1</center></b></td>
				<td style="width:12%;padding-left:3px;text-align:center;"><?php if ($row_select_pipe['fines_t_1'] != '' && $row_select_pipe['fines_t_1'] != '0' && $row_select_pipe['fines_t_1'] != null) {
					echo $row_select_pipe['fines_t_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td colspan="2" style="border-left:1px solid;width:80%;padding-left:5px;">Standard Time in seconds, T<sub>o</sub></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['fines_t_2'] != '' && $row_select_pipe['fines_t_2'] != '0' && $row_select_pipe['fines_t_2'] != null) {
					echo $row_select_pipe['fines_t_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;width:40%;padding-left:5px;">Density of Standard Cement g/cm <sup>3</sup> , ƍ<sub>o</sub></td>
				<td style="border-left:1px solid;width:40%;padding-left:5px;">Density of Cement g/cm <sup>3</sup> , ƍ</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="width:13%;padding-left:3px;text-align:center;"><?php if ($row_select_pipe['fines_t_3'] != '' && $row_select_pipe['fines_t_3'] != '0' && $row_select_pipe['fines_t_3'] != null) {
					echo $row_select_pipe['fines_t_3'];
				} else {
					echo ' - ';
				} ?></td>
				<td rowspan="2" colspan="2" style="border-left:1px solid;width:80%;">
					<table align="center" width="99%" class="test1" height="Auto">
						<tr>
							<td width="40" rowspan="2"> Aparatus Constant	K	=	1.414 &times; S<sub>o</sub> ƍ<sub>o</sub></td>
							<td width="5" style="text-align:center;"> &#8730; 0.1 η<sub>o</sub></td>
							<td width="55" rowspan="2">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; = &nbsp; &nbsp; <?php if ($row_select_pipe['constant_k'] != '' && $row_select_pipe['constant_k'] != '0' && $row_select_pipe['constant_k'] != null) {
								echo $row_select_pipe['constant_k'];
							} else {
								echo ' - ';
							} ?></td>
						</tr>
						<tr>
							<td style="text-align:center;border-top:1px solid;">&#8730; t<sub>o</sub></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;"><b><center>Average</center></b></td>
				<td style="width:13%;padding-left:3px;text-align:center;"><b><?php if ($row_select_pipe['avg_fines_time'] != '' && $row_select_pipe['avg_fines_time'] != '0' && $row_select_pipe['avg_fines_time'] != null) {
					echo $row_select_pipe['avg_fines_time'];
				} else {
					echo ' - ';
				} ?></b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="Auto" style="margin-top:-2px;border:1px solid;">
						<tr>
							<td width="35" rowspan="2">&nbsp;  Specific Surface area		S	=	521.08 &times; K </td>
							<td width="5" style="text-align:center;"> &#8730; t<sub>o</sub></td>
							<td width="60" rowspan="2"> &nbsp; &nbsp; &nbsp;  &nbsp; = &nbsp; &nbsp; &nbsp;  <?php if ($row_select_pipe['ss_area'] != '' && $row_select_pipe['ss_area'] != '0' && $row_select_pipe['ss_area'] != null) {
								echo ($row_select_pipe['ss_area'] * 10);
							} else {
								echo ' - ';
							} ?> cm<sup>2</sup>/g &nbsp; &nbsp; &nbsp;  &nbsp; &nbsp; =   &nbsp; &nbsp; &nbsp;<?php if ($row_select_pipe['ss_area'] != '' && $row_select_pipe['ss_area'] != '0' && $row_select_pipe['ss_area'] != null) {
								 echo $row_select_pipe['ss_area'];
							 } else {
								 echo ' - ';
							 } ?>&nbsp;  m<sup>2</sup> / kg</td>
						</tr>
						<tr>
							<td style="text-align:center;border-top:1px solid;">&#8730; ƍ<sub>o</sub></td>
						</tr>
						
		</table>
		<table align="center" width="94%" class="test1" height="Auto">
			<tr>
				<td style="padding-left:10px;"><br>Where, <br><br> &#8730; 0.1 η<sub>o</sub> = the Viscosity of air at the test temperature taken from Table 1 (IS 4031 Part – 2)</td>
			</tr>	
		</table>
		<br>
		<br>
		<br>
		
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date : 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by :</center></td>
				<td style="width:16.67%;"><center>Approved by :</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 02</center></td>
				<td style=""><center>Issue Date : 01.04.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 2</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>

		<?php
		}
		if (($row_select_pipe['final_time'] != "" && $row_select_pipe['final_time'] != "0" && $row_select_pipe['final_time'] != null) || ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
			$pagecnt++;
			?>

		<div class="pagebreak"> </div>

		<br>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-002</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON CEMENT</b></center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" height="17%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center><?php echo $cnt++; ?>.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Setting Time</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS : 4031 ( P - 5 ) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if ($row_select_pipe['set_temp'] != '' && $row_select_pipe['set_temp'] != '0' && $row_select_pipe['set_temp'] != null) {
					echo $row_select_pipe['set_temp'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity(%) - Min. <?php if ($row_select_pipe['set_humidity'] != '' && $row_select_pipe['set_humidity'] != '0' && $row_select_pipe['set_humidity'] != null) {
					 echo $row_select_pipe['set_humidity'];
				 } else {
					 echo ' - ';
				 } ?>%</td>
				<td style="text-align:center;"><b>Weight of Cement <?php if ($row_select_pipe['set_weight'] != '' && $row_select_pipe['set_weight'] != '0' && $row_select_pipe['set_weight'] != null) {
					echo $row_select_pipe['set_weight'];
				} else {
					echo ' - ';
				} ?> gm</b></td>
			</tr>
			<tr style="border: 1px solid black;font-size:13px;">
				<td colspan="3"><b>&nbsp; &nbsp; &nbsp; Water = 0.85 x Consistency in % X 4 &nbsp; &nbsp; &nbsp;  = &nbsp; &nbsp; &nbsp;  <?php if ($row_select_pipe['set_wtr'] != '' && $row_select_pipe['set_wtr'] != '0') {
					echo $row_select_pipe['set_wtr'];
				} else {
					echo ' - ';
				} ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td><b><center> a </center></b></td>
				<td colspan="2" style="padding-left:3px;border-left:1px solid;"><b>&nbsp; Time when water added &nbsp; : - &nbsp; <?php if ($row_select_pipe['hr_a'] != '' && $row_select_pipe['hr_a'] != '0' && $row_select_pipe['hr_a'] != null) {
					echo $row_select_pipe['hr_a'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp; 	hours/min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td><b><center> b </center></b></td>
				<td colspan="2" style="padding-left:3px;border-left:1px solid;"><b>&nbsp; Initial setting time &nbsp; : - &nbsp; <?php if ($row_select_pipe['hr_b'] != '' && $row_select_pipe['hr_b'] != '0' && $row_select_pipe['hr_b'] != null) {
					echo $row_select_pipe['hr_b'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp; 	hours/min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td><b><center> c </center></b></td>
				<td colspan="2" style="padding-left:3px;border-left:1px solid;"><b>&nbsp; Final setting time  &nbsp; : - &nbsp; <?php if ($row_select_pipe['hr_c'] != '' && $row_select_pipe['hr_c'] != '0' && $row_select_pipe['hr_c'] != null) {
					echo $row_select_pipe['hr_c'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp; 	hours/min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3"><b>&nbsp; Initial setting time  &nbsp; : - &nbsp; ( b ) - ( a ) &nbsp; &nbsp; &nbsp; <?php if ($row_select_pipe['initial_time'] != '' && $row_select_pipe['initial_time'] != '0' && $row_select_pipe['initial_time'] != null) {
					echo $row_select_pipe['initial_time'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp; 	min</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3"><b>&nbsp; Final setting time  &nbsp; : - &nbsp; ( c ) - ( a ) &nbsp; &nbsp; &nbsp; <?php if ($row_select_pipe['final_time'] != '' && $row_select_pipe['final_time'] != '0' && $row_select_pipe['final_time'] != null) {
					echo $row_select_pipe['final_time'];
				} else {
					echo ' - ';
				} ?> &nbsp; &nbsp;  min</b></td>
			</tr>
		</table>	
		<br>
		<table align="center" width="94%" class="test1" height="2%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center><?php echo $cnt++; ?>.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Compressive Strength</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031 ( P - 6 ) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if ($row_select_pipe['com_temp'] != '' && $row_select_pipe['com_temp'] != '0' && $row_select_pipe['com_temp'] != null) {
					echo $row_select_pipe['com_temp'];
				} else {
					echo ' - ';
				} ?></b></td>
				<td style="text-align:left;"><b>Humidity ( % ) &nbsp; = &nbsp; <?php if ($row_select_pipe['com_humidity'] != '' && $row_select_pipe['com_humidity'] != '0' && $row_select_pipe['com_humidity'] != null) {
					echo $row_select_pipe['com_humidity'];
				} else {
					echo ' - ';
				} ?>&nbsp;%</b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="4%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:25%;border-right:1px solid;"><b><center>Weight of Cement <?php if ($row_select_pipe['weight_of_cement'] != '' && $row_select_pipe['weight_of_cement'] != '0' && $row_select_pipe['weight_of_cement'] != null) {
					echo $row_select_pipe['weight_of_cement'];
				} else {
					echo ' - ';
				} ?> gm</center></b></td>
				<td style="width:30%;padding-left:5px;text-align:center;"><b>Weight of Std. Sand &nbsp; - &nbsp; <?php if ($row_select_pipe['weight_of_sand'] != '' && $row_select_pipe['weight_of_sand'] != '0' && $row_select_pipe['weight_of_sand'] != null) {
					echo $row_select_pipe['weight_of_sand'];
				} else {
					echo ' - ';
				} ?> gm</b></td>
				<td style="border-left:1px solid;width:45%;">
					<table align="center" width="99%" class="test1" height="Auto">
						<tr>
							<td> Water &nbsp; = &nbsp; </td>
							<td style="border-bottom:1px solid;text-align:center;">% consistency</td>
							<td>&nbsp; + &nbsp; ( 3 x 8 ) &nbsp; &nbsp; = &nbsp; &nbsp; <?php if ($row_select_pipe['weight_of_water'] != '' && $row_select_pipe['weight_of_water'] != '0' && $row_select_pipe['weight_of_water'] != null) {
								echo $row_select_pipe['weight_of_water'];
							} else {
								echo ' - ';
							} ?> C.C.</td>
						</tr>
						<tr>
							<td style="text-align:center;"></td>
							<td style="text-align:center;">4</td>
							<td style="text-align:center;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3	" style="width:8%;border-right:1px solid;"><b>&nbsp; &nbsp; Age: Days 3 (72 Hrs + 1 Hrs)</b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="27%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>Sr.No.</center></b></td>
				<td style="width:11%;text-align:center;"><b>Date of<br>Casting</b></td>
				<td style="border-left:1px solid;text-align:center;width:11%;"><b>Date of<br>Testing</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;"><b>Length<br>(L)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;"><b>Width<br>(B)<br>mm</b></td>
				<td style="border-left:1px solid;text-align:center;width:10%;"><b>Area<br>mm<sup>2</sup></b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;"><b>Load (KN)</b></td>
				<td style="border-left:1px solid;text-align:center;width:15%;"><b>Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
				<td style="border-left:1px solid;text-align:center;width:14%;"><b>Avg. Comp.<br>Strength<br>(N/mm<sup>2</sup>)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date1'] != '' && $row_select_pipe['caste_date1'] != '0' && $row_select_pipe['caste_date1'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date1']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date1'] != '' && $row_select_pipe['test_date1'] != '0' && $row_select_pipe['test_date1'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date1']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l1'] != '' && $row_select_pipe['l1'] != '0' && $row_select_pipe['l1'] != null) {
					echo $row_select_pipe['l1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b1'] != '' && $row_select_pipe['b1'] != '0' && $row_select_pipe['b1'] != null) {
					echo $row_select_pipe['b1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_1'] != '' && $row_select_pipe['area_1'] != '0' && $row_select_pipe['area_1'] != null) {
					echo $row_select_pipe['area_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_1'] != '' && $row_select_pipe['load_1'] != '0' && $row_select_pipe['load_1'] != null) {
					echo $row_select_pipe['load_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_1'] != '' && $row_select_pipe['com_1'] != '0' && $row_select_pipe['com_1'] != null) {
					echo $row_select_pipe['com_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_com_1'] != '' && $row_select_pipe['avg_com_1'] != '0' && $row_select_pipe['avg_com_1'] != null) {
					echo $row_select_pipe['avg_com_1'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date1'] != '' && $row_select_pipe['caste_date1'] != '0' && $row_select_pipe['caste_date1'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date1']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date1'] != '' && $row_select_pipe['test_date1'] != '0' && $row_select_pipe['test_date1'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date1']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l2'] != '' && $row_select_pipe['l2'] != '0' && $row_select_pipe['l2'] != null) {
					echo $row_select_pipe['l2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b2'] != '' && $row_select_pipe['b2'] != '0' && $row_select_pipe['b2'] != null) {
					echo $row_select_pipe['b2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_2'] != '' && $row_select_pipe['area_2'] != '0' && $row_select_pipe['area_2'] != null) {
					echo $row_select_pipe['area_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_2'] != '' && $row_select_pipe['load_2'] != '0' && $row_select_pipe['load_2'] != null) {
					echo $row_select_pipe['load_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_2'] != '' && $row_select_pipe['com_2'] != '0' && $row_select_pipe['com_2'] != null) {
					echo $row_select_pipe['com_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>3</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date1'] != '' && $row_select_pipe['caste_date1'] != '0' && $row_select_pipe['caste_date1'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date1']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date1'] != '' && $row_select_pipe['test_date1'] != '0' && $row_select_pipe['test_date1'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date1']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l3'] != '' && $row_select_pipe['l3'] != '0' && $row_select_pipe['l3'] != null) {
					echo $row_select_pipe['l3'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b3'] != '' && $row_select_pipe['b3'] != '0' && $row_select_pipe['b3'] != null) {
					echo $row_select_pipe['b3'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_3'] != '' && $row_select_pipe['area_3'] != '0' && $row_select_pipe['area_3'] != null) {
					echo $row_select_pipe['area_3'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_3'] != '' && $row_select_pipe['load_3'] != '0' && $row_select_pipe['load_3'] != null) {
					echo $row_select_pipe['load_3'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_3'] != '' && $row_select_pipe['com_3'] != '0' && $row_select_pipe['com_3'] != null) {
					echo $row_select_pipe['com_3'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="9	" style="width:8%;border-right:1px solid;"><b>&nbsp; &nbsp; Age: Days 7 (168 Hrs + 2 Hrs)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>4</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date2'] != '' && $row_select_pipe['caste_date2'] != '0' && $row_select_pipe['caste_date2'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date2']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date2'] != '' && $row_select_pipe['test_date2'] != '0' && $row_select_pipe['test_date2'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date2']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l4'] != '' && $row_select_pipe['l4'] != '0' && $row_select_pipe['l4'] != null) {
					echo $row_select_pipe['l4'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b4'] != '' && $row_select_pipe['b4'] != '0' && $row_select_pipe['b4'] != null) {
					echo $row_select_pipe['b4'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_4'] != '' && $row_select_pipe['area_4'] != '0' && $row_select_pipe['area_4'] != null) {
					echo $row_select_pipe['area_4'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_4'] != '' && $row_select_pipe['load_4'] != '0' && $row_select_pipe['load_4'] != null) {
					echo $row_select_pipe['load_4'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_4'] != '' && $row_select_pipe['com_4'] != '0' && $row_select_pipe['com_4'] != null) {
					echo $row_select_pipe['com_4'];
				} else {
					echo ' - ';
				} ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_com_2'] != '' && $row_select_pipe['avg_com_2'] != '0' && $row_select_pipe['avg_com_2'] != null) {
					echo $row_select_pipe['avg_com_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>5</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date2'] != '' && $row_select_pipe['caste_date2'] != '0' && $row_select_pipe['caste_date2'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date2']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date2'] != '' && $row_select_pipe['test_date2'] != '0' && $row_select_pipe['test_date2'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date2']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l5'] != '' && $row_select_pipe['l5'] != '0' && $row_select_pipe['l5'] != null) {
					echo $row_select_pipe['l5'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b5'] != '' && $row_select_pipe['b5'] != '0' && $row_select_pipe['b5'] != null) {
					echo $row_select_pipe['b5'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_5'] != '' && $row_select_pipe['area_5'] != '0' && $row_select_pipe['area_5'] != null) {
					echo $row_select_pipe['area_5'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_5'] != '' && $row_select_pipe['load_5'] != '0' && $row_select_pipe['load_5'] != null) {
					echo $row_select_pipe['load_5'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_5'] != '' && $row_select_pipe['com_5'] != '0' && $row_select_pipe['com_5'] != null) {
					echo $row_select_pipe['com_5'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>6</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date2'] != '' && $row_select_pipe['caste_date2'] != '0' && $row_select_pipe['caste_date2'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date2']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date2'] != '' && $row_select_pipe['test_date2'] != '0' && $row_select_pipe['test_date2'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date2']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l6'] != '' && $row_select_pipe['l6'] != '0' && $row_select_pipe['l6'] != null) {
					echo $row_select_pipe['l6'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b6'] != '' && $row_select_pipe['b6'] != '0' && $row_select_pipe['b6'] != null) {
					echo $row_select_pipe['b6'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_6'] != '' && $row_select_pipe['area_6'] != '0' && $row_select_pipe['area_6'] != null) {
					echo $row_select_pipe['area_6'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_6'] != '' && $row_select_pipe['load_6'] != '0' && $row_select_pipe['load_6'] != null) {
					echo $row_select_pipe['load_6'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_6'] != '' && $row_select_pipe['com_6'] != '0' && $row_select_pipe['com_6'] != null) {
					echo $row_select_pipe['com_6'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="9	" style="width:8%;border-right:1px solid;"><b>&nbsp; &nbsp; Age: Days 28 (672 Hrs + 4 Hrs)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>7</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date3'] != '' && $row_select_pipe['caste_date3'] != '0' && $row_select_pipe['caste_date3'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date3']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date3'] != '' && $row_select_pipe['test_date3'] != '0' && $row_select_pipe['test_date3'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date3']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l7'] != '' && $row_select_pipe['l7'] != '0' && $row_select_pipe['l7'] != null) {
					echo $row_select_pipe['l7'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b7'] != '' && $row_select_pipe['b7'] != '0' && $row_select_pipe['b7'] != null) {
					echo $row_select_pipe['b7'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_7'] != '' && $row_select_pipe['area_7'] != '0' && $row_select_pipe['area_7'] != null) {
					echo $row_select_pipe['area_7'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_7'] != '' && $row_select_pipe['load_7'] != '0' && $row_select_pipe['load_7'] != null) {
					echo $row_select_pipe['load_7'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_7'] != '' && $row_select_pipe['com_7'] != '0' && $row_select_pipe['com_7'] != null) {
					echo $row_select_pipe['com_7'];
				} else {
					echo ' - ';
				} ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avg_com_3'] != '' && $row_select_pipe['avg_com_3'] != '0' && $row_select_pipe['avg_com_3'] != null) {
					echo $row_select_pipe['avg_com_3'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>7</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date3'] != '' && $row_select_pipe['caste_date3'] != '0' && $row_select_pipe['caste_date3'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date3']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date3'] != '' && $row_select_pipe['test_date3'] != '0' && $row_select_pipe['test_date3'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date3']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l7'] != '' && $row_select_pipe['l7'] != '0' && $row_select_pipe['l7'] != null) {
					echo $row_select_pipe['l7'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b7'] != '' && $row_select_pipe['b7'] != '0' && $row_select_pipe['b7'] != null) {
					echo $row_select_pipe['b7'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_8'] != '' && $row_select_pipe['area_8'] != '0' && $row_select_pipe['area_8'] != null) {
					echo $row_select_pipe['area_8'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_8'] != '' && $row_select_pipe['load_8'] != '0' && $row_select_pipe['load_8'] != null) {
					echo $row_select_pipe['load_8'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_8'] != '' && $row_select_pipe['com_8'] != '0' && $row_select_pipe['com_8'] != null) {
					echo $row_select_pipe['com_8'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>7</center></b></td>
				<td style="text-align:center;"><?php if ($row_select_pipe['caste_date3'] != '' && $row_select_pipe['caste_date3'] != '0' && $row_select_pipe['caste_date3'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['caste_date3']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['test_date3'] != '' && $row_select_pipe['test_date3'] != '0' && $row_select_pipe['test_date3'] != null) {
					echo Date('d-m-Y', strtotime($row_select_pipe['test_date3']));
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l9'] != '' && $row_select_pipe['l9'] != '0' && $row_select_pipe['l9'] != null) {
					echo $row_select_pipe['l9'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['b9'] != '' && $row_select_pipe['b9'] != '0' && $row_select_pipe['b9'] != null) {
					echo $row_select_pipe['b9'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['area_9'] != '' && $row_select_pipe['area_9'] != '0' && $row_select_pipe['area_9'] != null) {
					echo $row_select_pipe['area_9'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['load_9'] != '' && $row_select_pipe['load_9'] != '0' && $row_select_pipe['load_9'] != null) {
					echo $row_select_pipe['load_9'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['com_9'] != '' && $row_select_pipe['com_9'] != '0' && $row_select_pipe['com_9'] != null) {
					echo $row_select_pipe['com_9'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
		</table>
		<Br>
		<table align="center" width="94%" class="test1" height="5%">
			<tr style="border: 1px solid black;">
				<td style="width:5%;"><b><center><?php echo $cnt++; ?>.</center></b></td>
				<td style="width:65%;padding-left:3px;"><b>Soundness by Le - chatelier</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>IS 4031 ( P - 3 ) 1988</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:5%;"></td>
				<td style="text-align:left;"><b>Temperature ( &deg;C ) &nbsp; = &nbsp; <?php if ($row_select_pipe['sou_temp'] != '' && $row_select_pipe['sou_temp'] != '0' && $row_select_pipe['sou_temp'] != null) {
					echo $row_select_pipe['sou_temp'];
				} else {
					echo ' - ';
				} ?></b></td>
				<td style="text-align:left;"><b>Humidity ( % ) &nbsp; = &nbsp; <?php if ($row_select_pipe['sou_humidity'] != '' && $row_select_pipe['sou_humidity'] != '0' && $row_select_pipe['sou_humidity'] != null) {
					echo $row_select_pipe['sou_humidity'];
				} else {
					echo ' - ';
				} ?>&nbsp;%</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="2" style="width:25%;border-right:1px solid;"><b><center>Weight of Cement <?php if ($row_select_pipe['sou_weight'] != '' && $row_select_pipe['sou_weight'] != '0' && $row_select_pipe['sou_weight'] != null) {
					echo $row_select_pipe['sou_weight'];
				} else {
					echo ' - ';
				} ?> gms</center></b></td>
				<td style="border-left:1px solid;width:45%;">
					
				</td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="2%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:40%;border-right:1px solid;"><b><center>Weight of Cement <?php if ($row_select_pipe['sou_weight'] != '' && $row_select_pipe['sou_weight'] != '0' && $row_select_pipe['sou_weight'] != null) {
					echo $row_select_pipe['sou_weight'];
				} else {
					echo ' - ';
				} ?> gms</center></b></td>
				<td style="width:60%;border-bottom:1px solid;text-align:center;">Water &nbsp; = &nbsp; ( 0.78 &nbsp; x &nbsp; Consistencyin % ) &nbsp; X &nbsp; 2 &nbsp; = &nbsp; <?php if ($row_select_pipe['sou_water'] != '' && $row_select_pipe['sou_water'] != '0' && $row_select_pipe['sou_water'] != null) {
					echo $row_select_pipe['sou_water'];
				} else {
					echo ' - ';
				} ?> &nbsp;  C.C.</td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" height="9%" style="margin-top:-1px;">
			<tr style="border: 1px solid black;">
				<td style="width:6%;border-right:1px solid;"><b><center>Sr.No.</center></b></td>
				<td style="width:30%;padding-left:3px;text-align:center;"><b>Distance between two Points<br>after 24 hrs. in water (mm)</b></td>
				<td style="border-left:1px solid;text-align:center;width:30%;"><b>Reading after 3 hrs. in boiling<br>(mm) </b></td>
				<td style="border-left:1px solid;text-align:center;width:17%;"><b>Difference (mm)</b> </td>
				<td style="border-left:1px solid;text-align:center;width:17%;"><b>Average (mm) </b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>1</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['dis_1_1'] != '' && $row_select_pipe['dis_1_1'] != '0' && $row_select_pipe['dis_1_1'] != null) {
					echo $row_select_pipe['dis_1_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['dis_2_1'] != '' && $row_select_pipe['dis_2_1'] != '0' && $row_select_pipe['dis_2_1'] != null) {
					echo $row_select_pipe['dis_2_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['diff_1'] != '' && $row_select_pipe['diff_1'] != '0' && $row_select_pipe['diff_1'] != null) {
					echo $row_select_pipe['diff_1'];
				} else {
					echo ' - ';
				} ?></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['soundness'] != '' && $row_select_pipe['soundness'] != '0' && $row_select_pipe['soundness'] != null) {
					echo $row_select_pipe['soundness'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-right:1px solid;"><b><center>2</center></b></td>
				<td style="padding-left:3px;text-align:center;"><?php if ($row_select_pipe['dis_1_2'] != '' && $row_select_pipe['dis_1_2'] != '0' && $row_select_pipe['dis_1_2'] != null) {
					echo $row_select_pipe['dis_1_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['dis_2_2'] != '' && $row_select_pipe['dis_2_2'] != '0' && $row_select_pipe['dis_2_2'] != null) {
					echo $row_select_pipe['dis_2_2'];
				} else {
					echo ' - ';
				} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['diff_2'] != '' && $row_select_pipe['diff_2'] != '0' && $row_select_pipe['diff_2'] != null) {
					echo $row_select_pipe['diff_2'];
				} else {
					echo ' - ';
				} ?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="margin-top:-1px;">
			<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b>
						</div>
					</td>
					<!--<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date : 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by :</center></td>
				<td style="width:16.67%;"><center>Approved by :</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 02</center></td>
				<td style=""><center>Issue Date : 01.04.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 2</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<?php } ?>
	</page> -->










</body>





</html>
<script type="text/javascript">

</script>