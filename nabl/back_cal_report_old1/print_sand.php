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
	$select_tiles_query = "select * from sand WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$in_grade= $row_select4['in_grade'];
		$grd_zone = $row_select4['grd_zone'];
	}
	$cnt = 1;
	$pagecnt = 0;
	$totalcnt = 0;
	if (($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) || ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
		$totalcnt++;
	}
	
	?>

	
<br>
	<page size="A4">
		<?php
			if (($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null)) {
				$pagecnt++;
		?>

		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-005</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE STRENGHT TEST ON FINE AGGREGATE</b></center>
				</td>
			</tr>
		</table>
		<br>	
		<br>

		<table align="center" width="94%" class="test1" height="9%">

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
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification Mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo "Fine Aggregate - ".$in_grade; ?> <?php //echo $row_select_pipe['lab_no']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of Sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++;?> & <?php echo $cnt++;?> Specific Gravity & Water Absorption of fine Aggregate:</b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date: </b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b><?php echo date('d - m - Y', strtotime($start_date)); ?></b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td colspan="2" style="border-top: 1px solid black;"><b>&nbsp; IS 2386 Part III 1963</b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;font-size:13px;margin-top:-1px;" height="20%">
			<tr style="border: 0px solid black;">
				<td width="60%" colspan="8" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; Weight of Pycnometer bottle in water A2 &nbsp; = &nbsp; <?php if($row_select_pipe['sp_wt_py1_1']!='' && $row_select_pipe['sp_wt_py1_1']!=0 && $row_select_pipe['sp_wt_py1_1']!=null){echo $row_select_pipe['sp_wt_py1_1'];}?> g</b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td width="5%" style="text-align:center;border-top: 1px solid black;"><b>Sr.<br>No.</b></td>
				<td width="14%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Weight of<br>Sample with<br>distilled<br>Water in<br>pycnometer<br>bottle in g<br><br>A1</b></td>
				<td width="13%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Weight of<br>Saturated<br>Surface<br>Dry in gm<br><br><br><br>B</b></td>
				<td width="13%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Weight of<br>Sample<br>oven dry<br> in g<br><br><br><br>C</b></td>
				<td width="14%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Weight of<br>Sample in<br>water in g<br><br><br><br><br>A = A1-A2</td>
				<td width="14%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Specific<br>Gravity=<br><br><br> <span style="border-bottom:1px solid;"><br>C</span><br><br> B - A</td>
				<td width="14%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Percentage<br>Water<br>Absorption in<br>24 hours<br><br><span style="border-bottom:1px solid;"><br>(B – C)</span> X 100  <br> C <br>%</td>
				<td width="13%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Remarks</td>
				
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_wt_py2_1']!='' && $row_select_pipe['sp_wt_py2_1']!=0 && $row_select_pipe['sp_wt_py2_1']!=null){echo $row_select_pipe['sp_wt_py2_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_wt_st_1']!='' && $row_select_pipe['sp_wt_st_1']!=0 && $row_select_pipe['sp_wt_st_1']!=null){echo $row_select_pipe['sp_wt_st_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_w_s_1']!='' && $row_select_pipe['sp_w_s_1']!=0 && $row_select_pipe['sp_w_s_1']!=null){echo $row_select_pipe['sp_w_s_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_w_sur_1']!='' && $row_select_pipe['sp_w_sur_1']!=0 && $row_select_pipe['sp_w_sur_1']!=null){echo $row_select_pipe['sp_w_sur_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_specific_gravity_1']!='' && $row_select_pipe['sp_specific_gravity_1']!=0 && $row_select_pipe['sp_specific_gravity_1']!=null){echo $row_select_pipe['sp_specific_gravity_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_water_abr_1']!='' && $row_select_pipe['sp_water_abr_1']!=0 && $row_select_pipe['sp_water_abr_1']!=null){echo $row_select_pipe['sp_water_abr_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_wt_py2_2']!='' && $row_select_pipe['sp_wt_py2_2']!=0 && $row_select_pipe['sp_wt_py2_2']!=null){echo $row_select_pipe['sp_wt_py2_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_wt_st_2']!='' && $row_select_pipe['sp_wt_st_2']!=0 && $row_select_pipe['sp_wt_st_2']!=null){echo $row_select_pipe['sp_wt_st_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_w_s_2']!='' && $row_select_pipe['sp_w_s_2']!=0 && $row_select_pipe['sp_w_s_2']!=null){echo $row_select_pipe['sp_w_s_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_w_sur_2']!='' && $row_select_pipe['sp_w_sur_2']!=0 && $row_select_pipe['sp_w_sur_2']!=null){echo $row_select_pipe['sp_w_sur_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_specific_gravity_2']!='' && $row_select_pipe['sp_specific_gravity_2']!=0 && $row_select_pipe['sp_specific_gravity_2']!=null){echo $row_select_pipe['sp_specific_gravity_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['sp_water_abr_2']!='' && $row_select_pipe['sp_water_abr_2']!=0 && $row_select_pipe['sp_water_abr_2']!=null){echo $row_select_pipe['sp_water_abr_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++;?>. Bulk Density </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b><?php echo date('d - m - Y', strtotime($start_date.'+1 days')); ?></b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td colspan="2" style="border-top: 1px solid black;"><b>&nbsp; IS 2386 Part III-1963 </b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;font-size:13px;margin-top:-1px;" height="12%">
			<tr style="border: 0px solid black;">
				<td width="5%" style="text-align:center;border-top: 1px solid black;"><b>Sr.<br>No.</b></td>
				<td width="50%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Particular</b></td>
				<td width="15%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>(i)</b></td>
				<td width="15%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>(ii)</b></td>
				<td width="15%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>(iii)</b></td>				
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;border-top: 1px solid black;">&nbsp; Weight of mould + material in kg</td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['m11']!='' && $row_select_pipe['m11']!=0 && $row_select_pipe['m11']!=null){echo $row_select_pipe['m11'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['m12']!='' && $row_select_pipe['m12']!=0 && $row_select_pipe['m12']!=null){echo $row_select_pipe['m12'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['m13']!='' && $row_select_pipe['m13']!=0 && $row_select_pipe['m13']!=null){echo $row_select_pipe['m13'];}else{echo '-';}?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;border-top: 1px solid black;">&nbsp; Weight of mould in kg</td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['m21']!='' && $row_select_pipe['m21']!=0 && $row_select_pipe['m21']!=null){echo $row_select_pipe['m21'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['m22']!='' && $row_select_pipe['m22']!=0 && $row_select_pipe['m22']!=null){echo $row_select_pipe['m22'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['m23']!='' && $row_select_pipe['m23']!=0 && $row_select_pipe['m23']!=null){echo $row_select_pipe['m23'];}else{echo '-';}?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;border-top: 1px solid black;">&nbsp; Weight of material in kg</td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['wom1']!='' && $row_select_pipe['wom1']!=0 && $row_select_pipe['wom1']!=null){echo $row_select_pipe['wom1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['wom2']!='' && $row_select_pipe['wom2']!=0 && $row_select_pipe['wom2']!=null){echo $row_select_pipe['wom2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['wom3']!='' && $row_select_pipe['wom3']!=0 && $row_select_pipe['wom3']!=null){echo $row_select_pipe['wom3'];}else{echo '-';}?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="font-size:15px;" height="4%">
			<tr style="border: 0px solid black;">
				<td style=""><b>Average weight of material = <?php if($row_select_pipe['avg_wom']!='' && $row_select_pipe['avg_wom']!=0 && $row_select_pipe['avg_wom']!=null){echo $row_select_pipe['avg_wom'];}else{echo '-';}?> kg &nbsp; &nbsp; &nbsp; &nbsp; volume of mould = <?php if($row_select_pipe['vol']!='' && $row_select_pipe['vol']!=0 && $row_select_pipe['vol']!=null){echo $row_select_pipe['vol'];}else{echo '-';}?> m<sup>3</sup></b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style=""><b>Bulk density  &nbsp; = &nbsp; Average weight of material / volume of mould = <?php if($row_select_pipe['bdl']!='' && $row_select_pipe['bdl']!=0 && $row_select_pipe['bdl']!=null){echo $row_select_pipe['bdl'];}else{echo '-';}?> kg / m<sup>3</sup></b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;"><b><br>Oven Process Record</b></td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;font-size:13px;margin-top:-1px;" height="10%">
			<tr style="border: 0px solid black;">
				<td width="10%" style="text-align:center;border-top: 1px solid black;"><b>Sr.No.</b></td>
				<td width="30%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Date</b></td>
				<td width="20%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Time</b></td>
				<td width="20%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Temp.</b></td>
				<td width="20%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Weight</b></td>				
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;border-top: 1px solid black;"></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;border-top: 1px solid black;"></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"></td>
			</tr>
			
		</table>
		<br>
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
			<tr>
				<td style=""><center>Page 1 of 3</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
			<?php }?>
		<div class="pagebreak"></div>



		<?php
			if (($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) || ($row_select_pipe['avg_finer'] != "" && $row_select_pipe['avg_finer'] != "0" && $row_select_pipe['avg_finer'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null)) {
				$pagecnt++;
		?>
		<br>
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
					<center><b>FMT-OBS-005</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE STRENGHT TEST ON FINE AGGREGATE</b></center>
				</td>
			</tr>
		</table>
		<?php
			if ($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) {
		?>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++;?>. Gradation : </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b><?php echo date('d - m - Y', strtotime($start_date.'+1 days')); ?></b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td colspan="2" style="border-top: 1px solid black;"><b>&nbsp; IS 2386 Part 1- 1963 </b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;border-width:1px 0 0 1px;;font-size:13px;margin-top:-1px;" height="20%">
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b></b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b></b></td>
				<td colspan="2" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Weight retained in gms</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b></b></td>
				<td style="border-left:1px solid;border-right:1px solid;text-align:center;border-top: 1px solid black;"><b></b></td>		
			</tr>
			<tr style="border: 0px solid black;">
				<td width="15%" style="text-align:center;border-top: 1px solid black;"><b>IS Sieve</b></td>
				<td width="17%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Individual Mass<br>retained<br>bottle in g<br><br>A1</b></td>
				<td width="17%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Cumulative<br>Mass retained</b></td>
				<td width="17%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>% Cumulative<br>Mass retained</b></td>
				<td width="17%" style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>% of Passing</b></td>
				<td width="17%" style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><b>Classification of <br>Zone sand as <br>per IS 383-2016</b></td>		
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>10 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_1']!='' && $row_select_pipe['cum_wt_gm_1']!=0 && $row_select_pipe['cum_wt_gm_1']!=null){echo $row_select_pipe['cum_wt_gm_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_1']!='' && $row_select_pipe['ret_wt_gm_1']!=0 && $row_select_pipe['ret_wt_gm_1']!=null){echo $row_select_pipe['ret_wt_gm_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_1']!='' && $row_select_pipe['cum_ret_1']!=0 && $row_select_pipe['cum_ret_1']!=null){echo $row_select_pipe['cum_ret_1'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_1']!='' && $row_select_pipe['pass_sample_1']!=0 && $row_select_pipe['pass_sample_1']!=null){echo $row_select_pipe['pass_sample_1'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>4.75 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_2']!='' && $row_select_pipe['cum_wt_gm_2']!=0 && $row_select_pipe['cum_wt_gm_2']!=null){echo $row_select_pipe['cum_wt_gm_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_2']!='' && $row_select_pipe['ret_wt_gm_2']!=0 && $row_select_pipe['ret_wt_gm_2']!=null){echo $row_select_pipe['ret_wt_gm_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_2']!='' && $row_select_pipe['cum_ret_2']!=0 && $row_select_pipe['cum_ret_2']!=null){echo $row_select_pipe['cum_ret_2'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_2']!='' && $row_select_pipe['pass_sample_2']!=0 && $row_select_pipe['pass_sample_2']!=null){echo $row_select_pipe['pass_sample_2'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>2.36 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_3']!='' && $row_select_pipe['cum_wt_gm_3']!=0 && $row_select_pipe['cum_wt_gm_3']!=null){echo $row_select_pipe['cum_wt_gm_3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_3']!='' && $row_select_pipe['ret_wt_gm_3']!=0 && $row_select_pipe['ret_wt_gm_3']!=null){echo $row_select_pipe['ret_wt_gm_3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_3']!='' && $row_select_pipe['cum_ret_3']!=0 && $row_select_pipe['cum_ret_3']!=null){echo $row_select_pipe['cum_ret_3'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_3']!='' && $row_select_pipe['pass_sample_3']!=0 && $row_select_pipe['pass_sample_3']!=null){echo $row_select_pipe['pass_sample_3'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>1.18 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_4']!='' && $row_select_pipe['cum_wt_gm_4']!=0 && $row_select_pipe['cum_wt_gm_4']!=null){echo $row_select_pipe['cum_wt_gm_4'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_4']!='' && $row_select_pipe['ret_wt_gm_4']!=0 && $row_select_pipe['ret_wt_gm_4']!=null){echo $row_select_pipe['ret_wt_gm_4'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_4']!='' && $row_select_pipe['cum_ret_4']!=0 && $row_select_pipe['cum_ret_4']!=null){echo $row_select_pipe['cum_ret_4'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_4']!='' && $row_select_pipe['pass_sample_4']!=0 && $row_select_pipe['pass_sample_4']!=null){echo $row_select_pipe['pass_sample_4'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>0.600 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_5']!='' && $row_select_pipe['cum_wt_gm_5']!=0 && $row_select_pipe['cum_wt_gm_5']!=null){echo $row_select_pipe['cum_wt_gm_5'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_5']!='' && $row_select_pipe['ret_wt_gm_5']!=0 && $row_select_pipe['ret_wt_gm_5']!=null){echo $row_select_pipe['ret_wt_gm_5'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_5']!='' && $row_select_pipe['cum_ret_5']!=0 && $row_select_pipe['cum_ret_5']!=null){echo $row_select_pipe['cum_ret_5'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_5']!='' && $row_select_pipe['pass_sample_5']!=0 && $row_select_pipe['pass_sample_5']!=null){echo $row_select_pipe['pass_sample_5'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>0.300 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_6']!='' && $row_select_pipe['cum_wt_gm_6']!=0 && $row_select_pipe['cum_wt_gm_6']!=null){echo $row_select_pipe['cum_wt_gm_6'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_6']!='' && $row_select_pipe['ret_wt_gm_6']!=0 && $row_select_pipe['ret_wt_gm_6']!=null){echo $row_select_pipe['ret_wt_gm_6'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_6']!='' && $row_select_pipe['cum_ret_6']!=0 && $row_select_pipe['cum_ret_6']!=null){echo $row_select_pipe['cum_ret_6'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_6']!='' && $row_select_pipe['pass_sample_6']!=0 && $row_select_pipe['pass_sample_6']!=null){echo $row_select_pipe['pass_sample_6'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>0.150 mm</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_7']!='' && $row_select_pipe['cum_wt_gm_7']!=0 && $row_select_pipe['cum_wt_gm_7']!=null){echo $row_select_pipe['cum_wt_gm_7'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_7']!='' && $row_select_pipe['ret_wt_gm_7']!=0 && $row_select_pipe['ret_wt_gm_7']!=null){echo $row_select_pipe['ret_wt_gm_7'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_7']!='' && $row_select_pipe['cum_ret_7']!=0 && $row_select_pipe['cum_ret_7']!=null){echo $row_select_pipe['cum_ret_7'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_7']!='' && $row_select_pipe['pass_sample_7']!=0 && $row_select_pipe['pass_sample_7']!=null){echo $row_select_pipe['pass_sample_7'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>pan</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_wt_gm_8']!='' && $row_select_pipe['cum_wt_gm_8']!=0 && $row_select_pipe['cum_wt_gm_8']!=null){echo $row_select_pipe['cum_wt_gm_8'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['ret_wt_gm_8']!='' && $row_select_pipe['ret_wt_gm_8']!=0 && $row_select_pipe['ret_wt_gm_8']!=null){echo $row_select_pipe['ret_wt_gm_8'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['cum_ret_8']!='' && $row_select_pipe['cum_ret_8']!=0 && $row_select_pipe['cum_ret_8']!=null){echo $row_select_pipe['cum_ret_8'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['pass_sample_8']!='' && $row_select_pipe['pass_sample_8']!=0 && $row_select_pipe['pass_sample_8']!=null){echo $row_select_pipe['pass_sample_8'];}else{echo '-';}?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td style="text-align:center;border-top: 1px solid black;"><b>Total</b></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php if($row_select_pipe['blank_extra']!='' && $row_select_pipe['blank_extra']!=0 && $row_select_pipe['blank_extra']!=null){echo $row_select_pipe['blank_extra'];}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php //echo ($row_select_pipe['ret_wt_gm_1'] + $row_select_pipe['ret_wt_gm_2'] + $row_select_pipe['ret_wt_gm_3'] + $row_select_pipe['ret_wt_gm_4'] + $row_select_pipe['ret_wt_gm_5'] + $row_select_pipe['ret_wt_gm_6'] + $row_select_pipe['ret_wt_gm_7'] + $row_select_pipe['ret_wt_gm_8']);?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php //if($row_select_pipe['grd_fm']!='' && $row_select_pipe['grd_fm']!=0 && $row_select_pipe['grd_fm']!=null){echo $row_select_pipe['grd_fm'] * 100;}else{echo '-';}?></td>
				<td style="border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php //echo ($row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8']);?></td>
				<td style="border-right:1px solid;border-left:1px solid;text-align:center;border-top: 1px solid black;"><?php echo $grd_zone;?></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td colspan="3" style="border-bottom: 1px solid black;text-align:center;border-top: 1px solid black;"><b>Fineness Modulus = Sum of %<br>Cumulative Mass retained / 100</b></td>
				<td style="border-bottom: 1px solid black;border-left:1px solid;text-align:center;border-top: 1px solid black;border-right:1px solid;"><?php if($row_select_pipe['grd_fm']!='' && $row_select_pipe['grd_fm']!=0 && $row_select_pipe['grd_fm']!=null){echo $row_select_pipe['grd_fm'];}else{echo '-';}?></td>
				<td style="border-top: 1px solid black;"></td>
				<td style="border-top: 1px solid black;"></td>
			</tr>
			
		</table>
			<?php }?>
		<br>
		<table align="center" width="94%" class="test1" style="font-size:15px;" height="4%">
			<tr style="">
				<td width="60%" style=""><b>&nbsp; <?php echo $cnt++;?>. Determination of deleterious material</b></td>
				<td width="40%" style=""><b>&nbsp; Date:</b> <?php echo date('d - m - Y', strtotime($start_date.'+1 days')); ?></td>
			</tr>
			<tr style="">
				<td style=""><b>&nbsp; </b></td>
				<td style=""><b>&nbsp; IS 2386 Part II 1963 </b></td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="font-size:15px;" height="4%">
			<tr style="">
				<td width="10%" style="text-align:center;"><b> i.</b></td>
				<td width="90%" style=""><b>Determination of light weight pieces (Coal & Lignite)</b></td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">Percentage of light weight pieces = 1 + <span style="border-bottom:1px solid;">W1</span> x 100 &nbsp; &nbsp; &nbsp;  = &nbsp; &nbsp; &nbsp;  <?php if($row_select_pipe['dele_3_3']!='' && $row_select_pipe['dele_3_3']!=0 && $row_select_pipe['dele_3_3']!=null){echo $row_select_pipe['dele_3_3'];}else{echo '-';}?></td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;&nbsp;W2</td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">Where W1 + dry weight in gm of decanted pieces</td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; W2 = dry weight in gm of portion of sample Coarser than 300 Micron IS Sieve.</td>
			</tr>
			<tr style="">
				<td style="text-align:center;"><br>ii</td>
				<td style=""><b><br>Determination of Clay lumps</b></td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style=""><br>Calculation : L = <span style="border-bottom:1px solid;"> W-R </span> x 100 &nbsp; &nbsp; &nbsp;  = &nbsp; &nbsp; &nbsp;  <?php if($row_select_pipe['dele_2_3']!='' && $row_select_pipe['dele_2_3']!=0 && $row_select_pipe['dele_2_3']!=null){echo $row_select_pipe['dele_2_3'];}else{echo '-';}?> </td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;W</td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">Where L = Percentage of clay lumps <br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp; W = Weight of sample<br>&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;&nbsp;R = Weight of sample after removal of clay lumps</td>
			</tr>
			<tr style="">
				<td style="text-align:center;"><br>iii</td>
				<td style=""><b><br>Material finer than 75 micron sieve </b></td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">The amount of material finer than 75 micron IS sieve shall be calculated as follows :</td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">A= Percentage of material finer than 75 micron<br>B= Original weight B = <?php if($row_select_pipe['finer_a']!='' && $row_select_pipe['finer_a']!=0 && $row_select_pipe['finer_a']!=null){echo $row_select_pipe['finer_a'];}else{echo '-';}?> g.<br>C= Dry weight after washing C = <?php if($row_select_pipe['finer_b']!='' && $row_select_pipe['finer_b']!=0 && $row_select_pipe['finer_b']!=null){echo $row_select_pipe['finer_b'];}else{echo '-';}?> g.<br>Percentage of material</td>
			</tr>
			<tr style="">
				<td style=""></td>
				<td style="">Finer than 75 micron A = <span style="border-bottom:1px solid;"> B-C </span> x 100 &nbsp; &nbsp; &nbsp;  = &nbsp; &nbsp; &nbsp;  <?php if($row_select_pipe['avg_finer']!='' && $row_select_pipe['avg_finer']!=0 && $row_select_pipe['avg_finer']!=null){echo $row_select_pipe['avg_finer'];}else{echo '-';}?> <br> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; B</td>
			</tr>
			
		</table>
		<br><br>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:2px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:2px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 2 of 3</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
			<?php }?>
		<div class="pagebreak"></div>
		
		
		<?php
			if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
				$pagecnt++;
		?>
		
		
		<br>
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
					<center><b>FMT-OBS-005</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR COMPRESSIVE STRENGHT TEST ON FINE AGGREGATE</b></center>
				</td>
			</tr>
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++;?>. Soundness</b></td>
				<td width="17%" style="border: 0px solid black;"><b>&nbsp; Date:</b></td>
				<td width="23%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b><?php echo date('d - m - Y', strtotime($start_date.'+2 days')); ?></b></td>
			</tr>
			<tr style="border: 0px solid black;">
				<td colspan="2" style="border-top: 1px solid black;"><b>&nbsp; IS 2386 Part V 1963 </b></td>
			</tr>
		</table>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="40%">
			
			<tr style="border: 1px solid black;font-weight:bold;">
				<td colspan="2" style="border: 1px solid black;"><center>Sieve Size</center></td>
				<td style="border: 1px solid black;" rowspan="2"><center>Grading of<BR>original<br>sample %</center></td>
				<td style="border: 1px solid black;" rowspan="2"><center>Weight of<br>test<br>fraction<br>before<br>test</center></td>
				<td style="border: 1px solid black;" rowspan="2"><center>Weight of<br>test<br>fraction<br>after<br>test</center></td>
				<td style="border: 1px solid black;" rowspan="2"><center>%passing<br>finer sieve<br>after test<br>(Actual %loss)</center>
				<td style="border: 1px solid black;" rowspan="2"><center>Weighted<br>average<br>corrected<br>%loss</center>
				</td>

			</tr>
			<tr style="text-align:center;font-weight:bold;">
				<td style="border: 1px solid black;font-weight:bold;">Passing</td>
				<td style="border: 1px solid black;font-weight:bold;">Retained</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>150 mic</center></td>
				<td style="border: 1px solid black;"><center>--</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go1'] != "" && $row_select_pipe['go1'] != "0" && $row_select_pipe['go1'] != null) {echo $row_select_pipe['go1'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt1'] != "" && $row_select_pipe['wt1'] != "0" && $row_select_pipe['wt1'] != null) {echo $row_select_pipe['wt1'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp1'] != "" && $row_select_pipe['pp1'] != "0" && $row_select_pipe['pp1'] != null) {echo $row_select_pipe['pp1'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa1'] != "" && $row_select_pipe['wa1'] != "0" && $row_select_pipe['wa1'] != null) {echo $row_select_pipe['wa1'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>300 mic</center></td>
				<td style="border: 1px solid black;"><center>150 mic</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go2'] != "" && $row_select_pipe['go2'] != "0" && $row_select_pipe['go2'] != null) {echo $row_select_pipe['go2'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt2'] != "" && $row_select_pipe['wt2'] != "0" && $row_select_pipe['wt2'] != null) {echo $row_select_pipe['wt2'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp2'] != "" && $row_select_pipe['pp2'] != "0" && $row_select_pipe['pp2'] != null) {echo $row_select_pipe['pp2'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa2'] != "" && $row_select_pipe['wa2'] != "0" && $row_select_pipe['wa2'] != null) {echo $row_select_pipe['wa2'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>600 mic</center></td>
				<td style="border: 1px solid black;"><center>300 mic</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go3'] != "" && $row_select_pipe['go3'] != "0" && $row_select_pipe['go3'] != null) {echo $row_select_pipe['go3'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt3'] != "" && $row_select_pipe['wt3'] != "0" && $row_select_pipe['wt3'] != null) {echo $row_select_pipe['wt3'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp3'] != "" && $row_select_pipe['pp3'] != "0" && $row_select_pipe['pp3'] != null) {echo $row_select_pipe['pp3'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa3'] != "" && $row_select_pipe['wa3'] != "0" && $row_select_pipe['wa3'] != null) {echo $row_select_pipe['wa3'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>1.18 mm</center></td>
				<td style="border: 1px solid black;"><center>600 mic</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go4'] != "" && $row_select_pipe['go4'] != "0" && $row_select_pipe['go4'] != null) {echo $row_select_pipe['go4'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt4'] != "" && $row_select_pipe['wt4'] != "0" && $row_select_pipe['wt4'] != null) {echo $row_select_pipe['wt4'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp4'] != "" && $row_select_pipe['pp4'] != "0" && $row_select_pipe['pp4'] != null) {echo $row_select_pipe['pp4'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa4'] != "" && $row_select_pipe['wa4'] != "0" && $row_select_pipe['wa4'] != null) {echo $row_select_pipe['wa4'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>2.36 mm</center></td>
				<td style="border: 1px solid black;"><center>1.18 mm</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go5'] != "" && $row_select_pipe['go5'] != "0" && $row_select_pipe['go5'] != null) {echo $row_select_pipe['go5'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt5'] != "" && $row_select_pipe['wt5'] != "0" && $row_select_pipe['wt5'] != null) {echo $row_select_pipe['wt5'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp5'] != "" && $row_select_pipe['pp5'] != "0" && $row_select_pipe['pp5'] != null) {echo $row_select_pipe['pp5'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa5'] != "" && $row_select_pipe['wa5'] != "0" && $row_select_pipe['wa5'] != null) {echo $row_select_pipe['wa5'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>4.75 mm</center></td>
				<td style="border: 1px solid black;"><center>2.36 mm</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go6'] != "" && $row_select_pipe['go6'] != "0" && $row_select_pipe['go6'] != null) {echo $row_select_pipe['go6'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt6'] != "" && $row_select_pipe['wt6'] != "0" && $row_select_pipe['wt6'] != null) {echo $row_select_pipe['wt6'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp6'] != "" && $row_select_pipe['pp6'] != "0" && $row_select_pipe['pp6'] != null) {echo $row_select_pipe['pp6'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa6'] != "" && $row_select_pipe['wa6'] != "0" && $row_select_pipe['wa6'] != null) {echo $row_select_pipe['wa6'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>10 mm</center></td>
				<td style="border: 1px solid black;"><center>4.75 mm</center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['go7'] != "" && $row_select_pipe['go7'] != "0" && $row_select_pipe['go7'] != null) {echo $row_select_pipe['go7'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt7'] != "" && $row_select_pipe['wt7'] != "0" && $row_select_pipe['wt7'] != null) {echo $row_select_pipe['wt7'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp7'] != "" && $row_select_pipe['pp7'] != "0" && $row_select_pipe['pp7'] != null) {echo $row_select_pipe['pp7'];} else {echo "&nbsp;";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa7'] != "" && $row_select_pipe['wa7'] != "0" && $row_select_pipe['wa7'] != null) {echo $row_select_pipe['wa7'];} else {echo "&nbsp;";} ?></center></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><center>Total</center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php echo ($row_select_pipe['go1'] + $row_select_pipe['go2'] + $row_select_pipe['go3'] + $row_select_pipe['go4'] + $row_select_pipe['go5'] + $row_select_pipe['go6'] + $row_select_pipe['go7']);?></center></td>
				<td style="border: 1px solid black;"><center><?php echo ($row_select_pipe['wt1'] + $row_select_pipe['wt2'] + $row_select_pipe['wt3'] + $row_select_pipe['wt4'] + $row_select_pipe['wt5'] + $row_select_pipe['wt6'] + $row_select_pipe['wt7']);?></center></td>
				<td style="border: 1px solid black;"><center></center></td>
				<td style="border: 1px solid black;"><center><?php echo ($row_select_pipe['pp1'] + $row_select_pipe['pp2'] + $row_select_pipe['pp3'] + $row_select_pipe['pp4'] + $row_select_pipe['pp5'] + $row_select_pipe['pp6'] + $row_select_pipe['pp7']);?></center></td>
				<td style="border: 1px solid black;"><center><?php echo ($row_select_pipe['wa1'] + $row_select_pipe['wa2'] + $row_select_pipe['wa3'] + $row_select_pipe['wa4'] + $row_select_pipe['wa5'] + $row_select_pipe['wa6'] + $row_select_pipe['wa7']);?></center></td>
			</tr>
			<!--tr style="border: 1px solid black;">
				<td style="border: 0px solid black;">Results :-</td>
				<td style="border: 0px solid black;">Soundness</td>
				<td style="border: 0px solid black;">=</td>
				<td colspan="3" style="border: 0px solid black;text-align:left;"> <?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
																						echo $row_select_pipe['soundness'];
																					} else {
																						echo "&nbsp;";
																					}  ?> %</td>


			</tr-->
		</table>
		<br>
		<br>
		<br>		
		<table align="center" width="94%" class="test1" style="font-size:15px;" height="4%">
			<tr style="">
				<td width="60%" style=""><b>Tested By : <br><br><br>Reviewed By :<br><br><br>Witness By :</td>
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
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:2px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:2px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:2px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 3 of 3</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		
			<?php }?>
	</page>

</body>

</html>


<script type="text/javascript">


</script>