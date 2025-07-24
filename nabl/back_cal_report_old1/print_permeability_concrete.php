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
	function round_up($number, $precision = 0)
	{
		$fig = (int) str_pad('1', $precision, '0');
		return (ceil($number * $fig) / $fig);
	}
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from permeability_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 4);

	$ans = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$r_date = $row_select['date'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed";
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


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
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
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$cc_grade = $row_select4['cc_grade'];
		$cc_set_of_cube = $row_select4['cc_set_of_cube'];
		$cc_no_of_cube = $row_select4['cc_no_of_cube'];
		$cc_qty = $row_select4['cc_qty'];
		$cc_identification_mark = $row_select4['cc_identification_mark'];
		$day_remark = $row_select4['day_remark'];
		$casting_date = $row_select4['casting_date'];
		$material_location = $row_select4['material_location'];
	}

	// $flag = 0;
	// $a = 1;
	// $down = 0;
	// $up = 4;
	// for ($a = 1; $a <= $page_cont; $a++) {
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
					<center><b>FMT-OBS-039</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR permeability test of concrete</b></center>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" height="9%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;padding:6px 3px;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $mt_name;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;padding:6px 3px;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;padding:6px 3px;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;padding:6px 3px;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding:6px 3px;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;"><b>&nbsp; No. of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;">&nbsp;<?php echo $cc_qty; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding:6px 3px;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;"><b>&nbsp; Grade of Concrete</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;">&nbsp;<?php echo $cc_grade; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding:6px 3px;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding:6px 3px;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;"><b>&nbsp; Method of Test</b></td>
				<td style="border-left:1px solid;text-align:left;padding:6px 3px;">&nbsp;<b>BSEN 12390-8 : 2009, DIN1048 p-5 : 199, IS 516 P-2 SEC-1 : 2018 , IRS Bridge Code 1997</b></td>
			</tr>
		</table>
		

		<table align="center" width="94%" class="test1">
			<tr>
				<td></td>
				<td style="border:1px solid;border-bottom:0px;border-top:0px;text-align:left;padding:15px 3px;width:31%;"><b>&nbsp;&nbsp;&nbsp; Date :- &nbsp;&nbsp;<?php echo date("d - m - y",strtotime($casting_date)); ?></b></td>
			</tr>
		</table>
		<?php $cnt = 1; ?>
		<table align="center" width="94%" class="test1">
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:10px 3px;"><b><center>Sr.No.</center></b></td>
				<td style="text-align:center;padding:10px 3px;width:15%;"><b>Date of Casting</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:15%;"><b>Date of Testing</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:15%;"><b>Age of Concrete</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:17%;"><b>Depth of <br> Penetration in mm</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:17%;"><b>Average depth of <br> Penetration in mm</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:10%;"><b>Remarks</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:8px 3px;"><b><center><?php echo $cnt++; ?></center></b></td>
				<td style="text-align:center;padding:8px 3px;" rowspan=3><?php echo date("d - m - y",strtotime($casting_date)); ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;" rowspan=3><?php echo date("d - m - y",strtotime($test_date1)); ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;" rowspan=3><?php echo $ans['day1']; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $ans["pen_1"]; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;" rowspan=3><?php echo $ans["avg_pen"]; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;" rowspan=3><?php echo $ans["remarks"]; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:8px 3px;"><b><center><?php echo $cnt++; ?></center></b></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $ans["pen_2"]; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:8px 3px;"><b><center><?php echo $cnt++; ?></center></b></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $ans["pen_3"]; ?></td>
			</tr>
		</table>
		<br><br>
		

		<table align="center" width="94%" class="test1" style="">
			<tr style="font-size:15px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;Witness By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b><br>
					</div>
				</td>
			</tr>		
		</table>
		<br><br><br>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:3px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:3px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:3px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:3px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:3px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style="text-align:center;">Page 1 of 1</td>
			</tr>	
		</table>
	</page>
	<?php 
	// }

	?>
</body>
</html>


<script type="text/javascript">
</script>