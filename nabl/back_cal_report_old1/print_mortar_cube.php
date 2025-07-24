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
	 $select_tiles_query = "select * from mortar_cube WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
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
					<center><b>FMT-OBS-001</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE<br>STRENGHT TEST ON CEMENT CONCRETE CUBES</b></center>
				</td>
			</tr>
		</table>
		<br>	
		<br>
		<table align="center" width="94%" class="test1" height="9%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $mt_name;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Specimen Size</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp;<?php echo substr($ans['l1'],0,3); ?> &nbsp;x&nbsp; <?php echo substr($ans['b1'],0,3); ?> &nbsp;x&nbsp; <?php echo substr($ans['h1'],0,3); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>5</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Specimen</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="94%" class="test1" style="" Height="35%">
			<tr>
				<td colspan="4" style="text-align:center;"><b>Age of Testing : <?php if($ans['day1']!='' && $ans['day1']!=0 && $ans['day1']!=null){echo $ans['day1'];}else{echo '-';}?></b></td>
				<td colspan="6" style="text-align:center;"><b>Grade of concrete &nbsp; : &nbsp; <?php echo $ans['grade1']; ?></b></td>
				<td colspan="3" style="border:1px solid;text-align:center;"><b>Date : - <?php echo date('d-m-Y',strtotime($ans['test_date1']));?></b></td>
			</tr>
			<tr>
				<td colspan="4" style="text-align:left;"><b>Start Curing Date : <?php echo date('d-m-Y',strtotime($start_date));?></b></td>
				<td colspan="6" style="text-align:left;"><b>End Curing Date : - <?php echo date('d-m-Y',strtotime($end_date));?></b></td>
				<td colspan="3" rowspan="2" style="border:1px solid;text-align:center;"><b>IS 516 (Part - 1/Sec -1): 2021</b></td>
			</tr>
			<tr>
				<td colspan="4" style="text-align:left;"><b>Start Curing Temp : </b></td>
				<td colspan="6" style="text-align:left;"><b>End Curing Temp : -</b></td>
			</tr> 
			<tr style="border-top:1px solid;" >
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Sr.<br>No</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Cube<br>ID</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Date of<br>Casting</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Date of<br>Testing</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Weigh<br>t (kg)</b></td>
				<td colspan="3" style="border-left:1px solid;border-bottom:1px solid;text-align:center;"><b>Dimension (mm)</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>C / S<br>Area<br>(mm<sup>2</sup>)A</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Density<br>(kg / m<sup>3</sup>)</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Max<br>Load<br>at<br>failure<br>(KN)<br>F</b></td>
				<td rowspan="2" style="border-left:1px solid;text-align:center;"><b>Comp.<br>strength<br>= F / A<br>N / mm <sup>2</sup></b></td>
				<td rowspan="2" style="	border-right:1px solid;border-left:1px solid;text-align:center;"><b>Type of <br>Fracture<br>(1 / 2)</b></td>
			</tr>
			<tr>
				<td style="border-left:1px solid;text-align:center;transform:rotate(270deg);"><b>Length </b></td>
				<td style="border-left:1px solid;text-align:center;transform:rotate(270deg);"><b>Width</b></td>
				<td style="border-left:1px solid;text-align:center;transform:rotate(270deg);"><b>Height</b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">1</td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $ans['grade1']; ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;transform:rotate(330deg);"><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
				<td rowspan="3" style="border-left:1px solid;text-align:center;transform:rotate(330deg);"><?php if($ans['test_date1'] !='' && $ans['test_date1']!=0 && $ans['test_date1']!=null){echo date('d-m-Y',strtotime($ans['test_date1']));}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['mass_1']!='' && $ans['mass_1']!=0 && $ans['mass_1']!=null){echo $ans['mass_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['l1']!='' && $ans['l1']!=0 && $ans['l1']!=null){echo $ans['l1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['b1']!='' && $ans['b1']!=0 && $ans['b1']!=null){echo $ans['b1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['h1']!='' && $ans['h1']!=0 && $ans['h1']!=null){echo $ans['h1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['cross_1']!='' && $ans['cross_1']!=0 && $ans['cross_1']!=null){echo $ans['cross_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['mass_1']!='' && $ans['mass_1']!=0 && $ans['mass_1']!=null){echo ($ans['mass_1'] / 1000);}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['load_1']!='' && $ans['load_1']!=null){echo $ans['load_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['comp_1']!='' && $ans['comp_1']!=null){echo $ans['comp_1'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if($ans['fail_pat_1']!='' && $ans['fail_pat_1']!=0 && $ans['fail_pat_1']!=null){echo $ans['fail_pat_1'];}else{echo '-';}?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">2</td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $ans['grade1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['mass_2']!='' && $ans['mass_2']!=0 && $ans['mass_2']!=null){echo $ans['mass_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['l2']!='' && $ans['l2']!=0 && $ans['l2']!=null){echo $ans['l2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['b2']!='' && $ans['b2']!=0 && $ans['b2']!=null){echo $ans['b2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['h2']!='' && $ans['h2']!=0 && $ans['h2']!=null){echo $ans['h2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['cross_2']!='' && $ans['cross_2']!=0 && $ans['cross_2']!=null){echo $ans['cross_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['mass_2']!='' && $ans['mass_2']!=0 && $ans['mass_2']!=null){echo ($ans['mass_2'] / 1000);}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['load_2']!=''  && $ans['load_2']!=null){echo $ans['load_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['comp_2']!='' &&  $ans['comp_2']!=null){echo $ans['comp_2'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if($ans['fail_pat_2']!='' && $ans['fail_pat_2']!=0 && $ans['fail_pat_2']!=null){echo $ans['fail_pat_2'];}else{echo '-';}?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">3</td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $ans['grade1']; ?>	</td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['mass_3']!='' && $ans['mass_3']!=0 && $ans['mass_3']!=null){echo $ans['mass_3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['l3']!='' && $ans['l3']!=0 && $ans['l3']!=null){echo $ans['l3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['b3']!='' && $ans['b3']!=0 && $ans['b3']!=null){echo $ans['b3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['h3']!='' && $ans['h3']!=0 && $ans['h3']!=null){echo $ans['h3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['cross_3']!='' && $ans['cross_3']!=0 && $ans['cross_3']!=null){echo $ans['cross_3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['mass_3']!='' && $ans['mass_3']!=0 && $ans['mass_3']!=null){echo ($ans['mass_3'] / 1000);}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['load_3']!='' && $ans['load_3']!=null){echo $ans['load_3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['comp_3']!='' && $ans['comp_3']!=null){echo $ans['comp_3'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if($ans['fail_pat_3']!='' && $ans['fail_pat_3']!=0 && $ans['fail_pat_3']!=null){echo $ans['fail_pat_3'];}else{echo '-';}?></td>
			</tr>
			<tr style="border-top:1px solid;font-size:15px;">
				<td colspan="11" style="border-left:1px solid;text-align:center;text-align:right;"><b>Average &nbsp; &nbsp; </b></td>
				<td style="border-left:1px solid;text-align:center;"><?php if($ans['avg_com_s_1']!='' &&	 $ans['avg_com_s_1']!=null){echo $ans['avg_com_s_1'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;"><?php if($ans['fail_pat_1']!='' && $ans['fail_pat_1']!=0 && $ans['fail_pat_1']!=null){echo substr((($ans['fail_pat_1'] + $ans['fail_pat_2'] + $ans['fail_pat_3']) / 3),0,3);}else{echo '-';}?></td>
			</tr>
			<tr style="border-top:1px solid;font-size:15px;" >
				<td colspan="13" style="">&nbsp; &nbsp;Rate of Loading 14 N/mm2/min (or 5.25 KN/S)</td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" style="" Height="20%">
			<tr style="font-size:15px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b>
					</div>
				</td>
			</tr>		
		</table>
		
		
		
		
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Page 1 of 1</b></td>
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