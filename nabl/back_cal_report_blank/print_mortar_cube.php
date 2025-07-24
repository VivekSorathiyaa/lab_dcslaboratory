<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 30px;
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
	$agSTCment_no = $row_select['agSTCment_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$branch_name = $row_select['branch_name'];
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
				<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS-001</td>
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 516 (Part - 1/Sec -1): 2021</td>
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
			<tr style="border: 1px solid black;border-top: 0;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Specimen Size</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp;<?php echo substr($ans['l1'],0,3); ?> &nbsp;x&nbsp; <?php echo substr($ans['b1'],0,3); ?> &nbsp;x&nbsp; <?php echo substr($ans['h1'],0,3); ?></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="100%" class="test1" style="" Height="35%">
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
				<td rowspan="3" style="border-left:1px solid;text-align:center;transform:rotate(330deg);"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
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
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="padding: 1px;border-left: 1px solid;border-right :1px solid;"  colspan="4"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  01</td>
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
				<td colspan="4" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
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