<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 20px 10px;}

	.pagebreak {
		page-break-before: always;}

	page[size="A4"] {
		width: 29.7cm;
		height: 21cm;}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: Arial;}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Arial;}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family: Arial;
}

	.tdclass1 {

		font-size: 11px;
		font-family: Arial;}

	.details {
		margin: 0px auto;
		padding: 0px;}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$tbl = $_GET['tbl_name'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$con_sample = "Sealed Ok";} else {
		$con_sample = "Unsealed";}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];}

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
}}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];}


	$totalcnt = 0;
	$pagecnt = 1;
	$count = 1;
	if (($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) || ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null)) {
		$totalcnt++;}
	if (($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null) || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null) || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null)) {
		$totalcnt++;}
	if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null) || ($row_select_pipe['fi_index'] != "" && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null) || ($row_select_pipe['ei_index'] != "" && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null)) {
		$totalcnt++;}
	if (($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null) || ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {
		$totalcnt++;}
	if (($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null) || ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != "0" && $row_select_pipe['avg_ph'] != null) || ($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null) || ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != "0" && $row_select_pipe['aoi_4'] != null)) {
		$totalcnt++;}

	?>

	<br>
	<br>

	<page size="A4">
	
	<?php if (($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) || ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null)) { ?>
	
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-006</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
				</td>
			</tr>
		</table>
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
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['brick_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>

		<!-- sample gravity table -->
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. & <?php echo $count++;?>.  Specific Gravity & Water Absorption of Coarse Aggregate :</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part III 1963 &nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style="font-size:13px;font-weight:bold;padding: 2px 4px 3px;border: 0;padding-bottom: 10px;">Weight of basket in Water A2=_________________g</td>
						</tr>
					</table>
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border:1px solid;">
						<tr>
							<td style="text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 3%;"><b>Sr. No.</b></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Weight of sample in water with basket <br> (g) <br><br><br> A1</b></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Weight of saturated surface dry <br> (g)  <br><br><br>B</b></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Weight of sample oven dry <br> (g)<br><br><br>C</b></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Weight of sample in water <br> (g) <br><br><br>A=A1-A2</b> </td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Specific gravity <br><br><br> <span style="border-bottom:1px solid;">&nbsp;&nbsp; C &nbsp;&nbsp;</span> <br> (B - A)</b></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Percentage water absorption in 24 hours (%)  <br><br><br> <span style="border-bottom:1px solid;">&nbsp; 100(B - C) &nbsp;</span> <br> C</b></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 4px;border-bottom: 1px solid;width: 8%;"><b>Remarks <br><br><br></b></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php if ($row_select_pipe['sp_agg1'] != "" && $row_select_pipe['sp_agg1'] != "0" && $row_select_pipe['sp_agg1'] != null) {
                                                                                                                        echo ($row_select_pipe['sp_agg1'] + $row_select_pipe['sp_wat1']);
                                                                                                                    } else {
                                                                                                                        echo " <br>";
                                                                                                                    } ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php if ($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) {		echo $row_select_pipe['sp_wt_st_1'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php if ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) {		echo $row_select_pipe['sp_w_s_1'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) {		echo $row_select_pipe['sp_w_sur_1'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php if ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) {		echo $row_select_pipe['sp_specific_gravity_1'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"><?php if ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) {		echo $row_select_pipe['sp_water_abr_1'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;border-bottom:1px solid;"></td>
						</tr>
						<tr>
							<td style="text-align:center;padding: 6px 0;"><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['sp_agg2'] != "" && $row_select_pipe['sp_agg2'] != "0" && $row_select_pipe['sp_agg2'] != null) {
                                                                                                                        echo ($row_select_pipe['sp_agg2'] + $row_select_pipe['sp_wat2']);
                                                                                                                    } else {
                                                                                                                        echo " <br>";
                                                                                                                    } ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) {		echo $row_select_pipe['sp_wt_st_2'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) {		echo $row_select_pipe['sp_w_s_2'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) {		echo $row_select_pipe['sp_w_sur_2'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) {		echo $row_select_pipe['sp_specific_gravity_2'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"><?php if ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) {		echo $row_select_pipe['sp_water_abr_2'];	} else {		echo " <br>";	} ?></td>
							<td style="border-left:1px solid;text-align:center;padding: 6px 0;"></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<br>
		<br>
		
		<!-- Gradation -->
		<table align="center" width="94%" class="test" style="">
			<tr>
				<td>
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. Gradation</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; (IS 2386 Part I 1963) &nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: left;">&nbsp;&nbsp;Total Weight in g:  &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
							<tr>
								<td style="border: 1px solid black;width:5%;padding: 6px;text-align: center;" colspan="5"><center><b>Weight retained</b></center></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;width:5%;padding: 2px 3px;text-align:center;"><b>IS Sieve</b></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 3px;"><center><b>Individual (g)</b></center></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 3px;"><center><b>Cumulative (g)</b></center></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 3px;"><center><b>Cumulative (%)</b></center></td>						
								<td style="border: 1px solid black;width:15%;padding: 2px 3px;"><center><b>Passing (%)</b></center></td>						
							</tr>
							<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null ) { ?>
							<?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != null) { ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_1'] != "") {echo $row_select_pipe['sieve_1'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_1'] != "" && $row_select_pipe['cum_wt_gm_1'] != "0" && $row_select_pipe['cum_wt_gm_1'] != null) {echo $row_select_pipe['cum_wt_gm_1'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_1'] != "" && $row_select_pipe['ret_wt_gm_1'] != "0" && $row_select_pipe['ret_wt_gm_1'] != null) {echo $row_select_pipe['ret_wt_gm_1'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_1'] != "" && $row_select_pipe['cum_ret_1'] != "0" && $row_select_pipe['cum_ret_1'] != null) {echo $row_select_pipe['cum_ret_1'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) {echo $row_select_pipe['pass_sample_1'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != null) {?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_2'] != ""  && $row_select_pipe['sieve_2'] != "0"  && $row_select_pipe['sieve_2'] != null) {echo $row_select_pipe['sieve_2'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_2'] != "" && $row_select_pipe['cum_wt_gm_2'] != "0" && $row_select_pipe['cum_wt_gm_2'] != null) {echo $row_select_pipe['cum_wt_gm_2'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_2'] != "" && $row_select_pipe['ret_wt_gm_2'] != "0" && $row_select_pipe['ret_wt_gm_2'] != null) {echo $row_select_pipe['ret_wt_gm_2'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_2'] != "" && $row_select_pipe['cum_ret_2'] != "0" && $row_select_pipe['cum_ret_2'] != null) {echo $row_select_pipe['cum_ret_2'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != "0" && $row_select_pipe['pass_sample_2'] != null) {echo $row_select_pipe['pass_sample_2'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {echo $row_select_pipe['sieve_3'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_3'] != "" && $row_select_pipe['cum_wt_gm_3'] != "0" && $row_select_pipe['cum_wt_gm_3'] != null) {echo $row_select_pipe['cum_wt_gm_3'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_3'] != "" && $row_select_pipe['ret_wt_gm_3'] != "0" && $row_select_pipe['ret_wt_gm_3'] != null) {echo $row_select_pipe['ret_wt_gm_3'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_3'] != "" && $row_select_pipe['cum_ret_3'] != "0" && $row_select_pipe['cum_ret_3'] != null) {echo $row_select_pipe['cum_ret_3'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != "0" && $row_select_pipe['pass_sample_3'] != null) {echo $row_select_pipe['pass_sample_3'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {echo $row_select_pipe['sieve_4'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_4'] != "" && $row_select_pipe['cum_wt_gm_4'] != "0" && $row_select_pipe['cum_wt_gm_4'] != null) {echo $row_select_pipe['cum_wt_gm_4'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_4'] != "" && $row_select_pipe['ret_wt_gm_4'] != "0" && $row_select_pipe['ret_wt_gm_4'] != null) {echo $row_select_pipe['ret_wt_gm_4'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_4'] != "" && $row_select_pipe['cum_ret_4'] != "0" && $row_select_pipe['cum_ret_4'] != null) {echo $row_select_pipe['cum_ret_4'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != "0" && $row_select_pipe['pass_sample_4'] != null) {echo $row_select_pipe['pass_sample_4'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_5'] != "" && $row_select_pipe['pass_sample_5'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {echo $row_select_pipe['sieve_5'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_5'] != "" && $row_select_pipe['cum_wt_gm_5'] != "0" && $row_select_pipe['cum_wt_gm_5'] != null) {echo $row_select_pipe['cum_wt_gm_5'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_5'] != "" && $row_select_pipe['ret_wt_gm_5'] != "0" && $row_select_pipe['ret_wt_gm_5'] != null) {echo $row_select_pipe['ret_wt_gm_5'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_5'] != "" && $row_select_pipe['cum_ret_5'] != "0" && $row_select_pipe['cum_ret_5'] != null) {echo $row_select_pipe['cum_ret_5'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_5'] != "" && $row_select_pipe['pass_sample_5'] != "0" && $row_select_pipe['pass_sample_5'] != null) {echo $row_select_pipe['pass_sample_5'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_6'] != "" && $row_select_pipe['pass_sample_6'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {echo $row_select_pipe['sieve_6'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_6'] != "" && $row_select_pipe['cum_wt_gm_6'] != "0" && $row_select_pipe['cum_wt_gm_6'] != null) {echo $row_select_pipe['cum_wt_gm_6'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_6'] != "" && $row_select_pipe['ret_wt_gm_6'] != "0" && $row_select_pipe['ret_wt_gm_6'] != null) {echo $row_select_pipe['ret_wt_gm_6'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_6'] != "" && $row_select_pipe['cum_ret_6'] != "0" && $row_select_pipe['cum_ret_6'] != null) {echo $row_select_pipe['cum_ret_6'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_6'] != "" && $row_select_pipe['pass_sample_6'] != "0" && $row_select_pipe['pass_sample_6'] != null) {echo $row_select_pipe['pass_sample_6'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_7'] != "" && $row_select_pipe['pass_sample_7'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {echo $row_select_pipe['sieve_7'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_7'] != "" && $row_select_pipe['cum_wt_gm_7'] != "0" && $row_select_pipe['cum_wt_gm_7'] != null) {echo $row_select_pipe['cum_wt_gm_7'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_7'] != "" && $row_select_pipe['ret_wt_gm_7'] != "0" && $row_select_pipe['ret_wt_gm_7'] != null) {echo $row_select_pipe['ret_wt_gm_7'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_7'] != "" && $row_select_pipe['cum_ret_7'] != "0" && $row_select_pipe['cum_ret_7'] != null) {echo $row_select_pipe['cum_ret_7'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_7'] != "" && $row_select_pipe['pass_sample_7'] != "0" && $row_select_pipe['pass_sample_7'] != null) {echo $row_select_pipe['pass_sample_7'];} else {echo " <br>";} ?></td>					
							</tr>
							<?php } if ($row_select_pipe['pass_sample_8'] != "" && $row_select_pipe['pass_sample_8'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {echo $row_select_pipe['sieve_8'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_8'] != "" && $row_select_pipe['cum_wt_gm_8'] != "0" && $row_select_pipe['cum_wt_gm_8'] != null) {echo $row_select_pipe['cum_wt_gm_8'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_8'] != "" && $row_select_pipe['ret_wt_gm_8'] != "0" && $row_select_pipe['ret_wt_gm_8'] != null) {echo $row_select_pipe['ret_wt_gm_8'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_8'] != "" && $row_select_pipe['cum_ret_8'] != "0" && $row_select_pipe['cum_ret_8'] != null) {echo $row_select_pipe['cum_ret_8'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_8'] != "" && $row_select_pipe['pass_sample_8'] != "0" && $row_select_pipe['pass_sample_8'] != null) {echo $row_select_pipe['pass_sample_8'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_9'] != "" && $row_select_pipe['pass_sample_9'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {echo $row_select_pipe['sieve_9'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_9'] != "" && $row_select_pipe['cum_wt_gm_9'] != "0" && $row_select_pipe['cum_wt_gm_9'] != null) {echo $row_select_pipe['cum_wt_gm_9'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_9'] != "" && $row_select_pipe['ret_wt_gm_9'] != "0" && $row_select_pipe['ret_wt_gm_9'] != null) {echo $row_select_pipe['ret_wt_gm_9'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_9'] != "" && $row_select_pipe['cum_ret_9'] != "0" && $row_select_pipe['cum_ret_9'] != null) {echo $row_select_pipe['cum_ret_9'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_9'] != "" && $row_select_pipe['pass_sample_9'] != "0" && $row_select_pipe['pass_sample_9'] != null) {echo $row_select_pipe['pass_sample_9'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_10'] != "" && $row_select_pipe['pass_sample_10'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {echo $row_select_pipe['sieve_10'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_10'] != "" && $row_select_pipe['cum_wt_gm_10'] != "0" && $row_select_pipe['cum_wt_gm_10'] != null) {echo $row_select_pipe['cum_wt_gm_10'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_10'] != "" && $row_select_pipe['ret_wt_gm_10'] != "0" && $row_select_pipe['ret_wt_gm_10'] != null) {echo $row_select_pipe['ret_wt_gm_10'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_10'] != "" && $row_select_pipe['cum_ret_10'] != "0" && $row_select_pipe['cum_ret_10'] != null) {echo $row_select_pipe['cum_ret_10'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_10'] != "" && $row_select_pipe['pass_sample_10'] != "0" && $row_select_pipe['pass_sample_10'] != null) {echo $row_select_pipe['pass_sample_10'];} else {echo " <br>";} ?></td>					
							</tr>
							<?php } if ($row_select_pipe['pass_sample_11'] != "" && $row_select_pipe['pass_sample_11'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {echo $row_select_pipe['sieve_11'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_11'] != "" && $row_select_pipe['cum_wt_gm_11'] != "0" && $row_select_pipe['cum_wt_gm_11'] != null) {echo $row_select_pipe['cum_wt_gm_11'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_11'] != "" && $row_select_pipe['ret_wt_gm_11'] != "0" && $row_select_pipe['ret_wt_gm_11'] != null) {echo $row_select_pipe['ret_wt_gm_11'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_11'] != "" && $row_select_pipe['cum_ret_11'] != "0" && $row_select_pipe['cum_ret_11'] != null) {echo $row_select_pipe['cum_ret_11'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_11'] != "" && $row_select_pipe['pass_sample_11'] != "0" && $row_select_pipe['pass_sample_11'] != null) {echo $row_select_pipe['pass_sample_11'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_12'] != "" && $row_select_pipe['pass_sample_12'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {echo $row_select_pipe['sieve_12'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_12'] != "" && $row_select_pipe['cum_wt_gm_12'] != "0" && $row_select_pipe['cum_wt_gm_12'] != null) {echo $row_select_pipe['cum_wt_gm_12'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_12'] != "" && $row_select_pipe['ret_wt_gm_12'] != "0" && $row_select_pipe['ret_wt_gm_12'] != null) {echo $row_select_pipe['ret_wt_gm_12'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_12'] != "" && $row_select_pipe['cum_ret_12'] != "0" && $row_select_pipe['cum_ret_12'] != null) {echo $row_select_pipe['cum_ret_12'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_12'] != "" && $row_select_pipe['pass_sample_12'] != "0" && $row_select_pipe['pass_sample_12'] != null) {echo $row_select_pipe['pass_sample_12'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_13'] != "" && $row_select_pipe['pass_sample_13'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_13'] != "" && $row_select_pipe['sieve_13'] != "0" && $row_select_pipe['sieve_13'] != null) {echo $row_select_pipe['sieve_13'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_13'] != "" && $row_select_pipe['cum_wt_gm_13'] != "0" && $row_select_pipe['cum_wt_gm_13'] != null) {echo $row_select_pipe['cum_wt_gm_13'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_13'] != "" && $row_select_pipe['ret_wt_gm_13'] != "0" && $row_select_pipe['ret_wt_gm_13'] != null) {echo $row_select_pipe['ret_wt_gm_13'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_13'] != "" && $row_select_pipe['cum_ret_13'] != "0" && $row_select_pipe['cum_ret_13'] != null) {echo $row_select_pipe['cum_ret_13'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_13'] != "" && $row_select_pipe['pass_sample_13'] != "0" && $row_select_pipe['pass_sample_13'] != null) {echo $row_select_pipe['pass_sample_13'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php } if ($row_select_pipe['pass_sample_14'] != "" && $row_select_pipe['pass_sample_14'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_14'] != "" && $row_select_pipe['sieve_14'] != "0" && $row_select_pipe['sieve_14'] != null) {echo $row_select_pipe['sieve_14'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_14'] != "" && $row_select_pipe['cum_wt_gm_14'] != "0" && $row_select_pipe['cum_wt_gm_14'] != null) {echo $row_select_pipe['cum_wt_gm_14'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_14'] != "" && $row_select_pipe['ret_wt_gm_14'] != "0" && $row_select_pipe['ret_wt_gm_14'] != null) {echo $row_select_pipe['ret_wt_gm_14'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_14'] != "" && $row_select_pipe['cum_ret_14'] != "0" && $row_select_pipe['cum_ret_14'] != null) {echo $row_select_pipe['cum_ret_14'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_14'] != "" && $row_select_pipe['pass_sample_14'] != "0" && $row_select_pipe['pass_sample_14'] != null) {echo $row_select_pipe['pass_sample_14'];} else {echo " <br>";} ?></td>				
							</tr>
							<?php } if ($row_select_pipe['pass_sample_15'] != "" && $row_select_pipe['pass_sample_15'] != null){ ?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" ><?php if ($row_select_pipe['sieve_15'] != "" && $row_select_pipe['sieve_15'] != "0" && $row_select_pipe['sieve_15'] != null) {echo $row_select_pipe['sieve_15'] .' mm';} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_wt_gm_15'] != "" && $row_select_pipe['cum_wt_gm_15'] != "0" && $row_select_pipe['cum_wt_gm_15'] != null) {echo $row_select_pipe['cum_wt_gm_15'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['ret_wt_gm_15'] != "" && $row_select_pipe['ret_wt_gm_15'] != "0" && $row_select_pipe['ret_wt_gm_15'] != null) {echo $row_select_pipe['ret_wt_gm_15'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['cum_ret_15'] != "" && $row_select_pipe['cum_ret_15'] != "0" && $row_select_pipe['cum_ret_15'] != null) {echo $row_select_pipe['cum_ret_15'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['pass_sample_15'] != "" && $row_select_pipe['pass_sample_15'] != "0" && $row_select_pipe['pass_sample_15'] != null) {echo $row_select_pipe['pass_sample_15'];} else {echo " <br>";} ?></td>						
							</tr>
							<?php }?>
							<tr>
								<td style="border: 1px solid black;width:10%;padding:  2px 4px;text-align:center;" >Total</td>
								<td style="border: 1px solid black;width:50%;padding: 2px 4px;text-align:center;"><?php if ($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) {echo $row_select_pipe['blank_extra'];} else {echo " <br>";} ?></td>
								
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php echo ($row_select_pipe['ret_wt_gm_1'] + $row_select_pipe['ret_wt_gm_2'] + $row_select_pipe['ret_wt_gm_3'] + $row_select_pipe['ret_wt_gm_4'] + $row_select_pipe['ret_wt_gm_5'] + $row_select_pipe['ret_wt_gm_6'] + $row_select_pipe['ret_wt_gm_7'] + $row_select_pipe['ret_wt_gm_8'] + $row_select_pipe['ret_wt_gm_9'] + $row_select_pipe['ret_wt_gm_10'] + $row_select_pipe['ret_wt_gm_11'] + $row_select_pipe['ret_wt_gm_12'] + $row_select_pipe['ret_wt_gm_13'] + $row_select_pipe['ret_wt_gm_14'] + $row_select_pipe['ret_wt_gm_15']);?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php echo $row_select_pipe['cum_ret_1'] + $row_select_pipe['cum_ret_2'] + $row_select_pipe['cum_ret_3'] + $row_select_pipe['cum_ret_4'] + $row_select_pipe['cum_ret_5'] + $row_select_pipe['cum_ret_6'] + $row_select_pipe['cum_ret_7'] + $row_select_pipe['cum_ret_8'] + $row_select_pipe['cum_ret_9'] + $row_select_pipe['cum_ret_10'] + $row_select_pipe['cum_ret_11'] + $row_select_pipe['cum_ret_12'] + $row_select_pipe['cum_ret_13'] + $row_select_pipe['cum_ret_14'] + $row_select_pipe['cum_ret_15'];?></td>
								<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align:center;"><?php echo $row_select_pipe['pass_sample_1'] + $row_select_pipe['pass_sample_2'] + $row_select_pipe['pass_sample_3'] + $row_select_pipe['pass_sample_4'] + $row_select_pipe['pass_sample_5'] + $row_select_pipe['pass_sample_6'] + $row_select_pipe['pass_sample_7'] + $row_select_pipe['pass_sample_8'] + $row_select_pipe['pass_sample_9'] + $row_select_pipe['pass_sample_10'] + $row_select_pipe['pass_sample_11'] + $row_select_pipe['pass_sample_12'] + $row_select_pipe['pass_sample_13'] + $row_select_pipe['pass_sample_14'] + $row_select_pipe['pass_sample_15'];?></td>						
							</tr>
								<?php } else {echo " <br>";}?>
					</table>
				</td>
			</tr>
		</table>


		<!-- Bulk Desity -->
		<!--<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php //echo $count++;?>. Bulk Density:</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part III 1963 &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 6px;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;width:50%;padding: 6px;"><center><b>Particular</b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b>(I)</b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b>(II)</b></center></td>						
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b>(III)</b></center></td>						
						</tr>
						<tr>
						<td style="border: 1px solid black;padding: 5px;"><center><b>1</b></center></td>
						<td style="border: 1px solid black;padding: 5px;"><b>Weight of Mould + Material in kg</b></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m11'] != "" && $row_select_pipe['m11'] != "0" && $row_select_pipe['m11'] != null) {		echo $row_select_pipe['m11'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m12'] != "" && $row_select_pipe['m12'] != "0" && $row_select_pipe['m12'] != null) {		echo $row_select_pipe['m12'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m13'] != "" && $row_select_pipe['m13'] != "0" && $row_select_pipe['m13'] != null) {		echo $row_select_pipe['m13'];	} else {		echo " <br>";	} ?></center></td>
						</tr>
						<tr>
						<td style="border: 1px solid black;padding: 5px;"><center><b>2</b></center></td>
						<td style="border: 1px solid black;padding: 5px;"><b>Weight of Mould in kg</b></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m21'] != "" && $row_select_pipe['m21'] != "0" && $row_select_pipe['m21'] != null) {		echo $row_select_pipe['m21'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m22'] != "" && $row_select_pipe['m22'] != "0" && $row_select_pipe['m22'] != null) {		echo $row_select_pipe['m22'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m23'] != "" && $row_select_pipe['m23'] != "0" && $row_select_pipe['m23'] != null) {		echo $row_select_pipe['m23'];	} else {		echo " <br>";	} ?></center></td>
						</tr>
						<tr>
						<td style="border: 1px solid black;padding: 5px;"><center><b>3</b></center></td>
						<td style="border: 1px solid black;padding: 5px;"><b>Weight of Material in kg</b></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m31'] != "" && $row_select_pipe['m31'] != "0" && $row_select_pipe['m31'] != null) {		echo $row_select_pipe['m31'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m32'] != "" && $row_select_pipe['m32'] != "0" && $row_select_pipe['m32'] != null) {		echo $row_select_pipe['m32'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;padding: 5px;"><center><?php if ($row_select_pipe['m33'] != "" && $row_select_pipe['m33'] != "0" && $row_select_pipe['m33'] != null) {		echo $row_select_pipe['m33'];	} else {		echo " <br>";	} ?></center></td>
						</tr>
						<tr>
						
						</tr>
						
					</table>
					<br>
					<br>
					<table align="center" width="100%" class="test1" style="border: 0;" height="Auto">
						<tr>
							<td style="border: 0px solid black;text-align:left;width:30%;"><b>&nbsp;&nbsp; Average weight of material &nbsp;&nbsp; =</b></td>
							<td style="border: 0px solid black;text-align:left;width:20%;"><span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {		echo $row_select_pipe['avg_wom'];		} else {		echo "&nbsp;&nbsp;&nbsp;&nbsp;";		} ?></span><b> Kg</b></td>
						
							<td style="border: 0px solid black;text-align:center;width:30%;"><b>volume of mould &nbsp;&nbsp; = </b></td>
							<td style="border: 0px solid black;text-align:left;width:20%;"><span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['vol'] != "" && $row_select_pipe['vol'] != "0" && $row_select_pipe['vol'] != null) {		echo $row_select_pipe['vol'];		} else {		echo "&nbsp;&nbsp;&nbsp;&nbsp;";		} ?></span><b>m<sup>3</sup></b></td>
						
						</tr>
					</table>
					<br>
					<table align="center" width="100%" class="test1" style="border: 0;" height="Auto">
						<tr>
							<td  style="border: 0px solid black;width:25%;"><b>&nbsp;&nbsp; Bulk loose density &nbsp; &nbsp; &nbsp; = </b></td>
							<td  style="border: 0px solid black;text-align:left;width:45%;">Average weight of material /  volume of mould  &nbsp; &nbsp; &nbsp; =</td>
							<td  style="border: 0px solid black;text-align:center;width:15%;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) {		echo $row_select_pipe['bdl'];		} else {		echo "&nbsp;";		} ?></td>
							<td  style="border: 0px solid black;text-align:left;width:15%;">kg/m<sup>3</sup> </td>
							
						</tr>
					</table>
					<br>
					<!--<table align="center" width="100%" class="test1" style="border: 0;font-family: Cambria;margin-top: 12px;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 14px;"><center><b>Oven Process Record</b></center></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 6px;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;width:50%;padding: 6px;"><center><b>Date</b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b>Time</b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b>Temp.</b></center></td>						
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b>Weight</b></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 6px;"><center><b> </b></center></td>
							<td style="border: 1px solid black;width:50%;padding: 6px;"><center><b></b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>						
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 6px;"><center><b> </b></center></td>
							<td style="border: 1px solid black;width:50%;padding: 6px;"><center><b></b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>						
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 6px;"><center><b> </b></center></td>
							<td style="border: 1px solid black;width:50%;padding: 6px;"><center><b></b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>						
							<td style="border: 1px solid black;width:15%;padding: 6px;"><center><b></b></center></td>						
						</tr>
					</table>

				</td>
			</tr>
		</table>-->

		
		<br><br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:4px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2022 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
				<tr style="font-size:12px;" >
					<td style="text-align:center;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
				</tr>
			</table>	
		<br>
		<div class="pagebreak"></div>
		<br>
		<?php } if (($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null) || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null) || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null)) { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-006</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
				</td>
			</tr>
		</table>
		<br>	

		
	
		
		<!-- Crushing Value -->
		<!--<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-top: 10px;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px;border: 0;"><?php// echo $count++;?>. Crushing Value</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part IV 1963 &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 4px; font-weight: bold;width:3%;">&nbsp;&nbsp;</td>
							<td style="border: 1px solid black;width:50%;padding: 2px 4px;font-weight: bold;">&nbsp; Particular</td>
							<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align : center;font-weight: bold;width:10%;">(i)</td>
							<td style="border: 1px solid black;width:15%;padding: 2px 4px;text-align : center;font-weight: bold;width:10%;">(ii)</td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 4px;">&nbsp;&nbsp; a</td>
							<td style="border: 1px solid black;padding: 2px 4px;">&nbsp;&nbsp; Total weight taken into crushing mould in g = A </td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cr_a_1'] != "" && $row_select_pipe['cr_a_1'] != "0" && $row_select_pipe['cr_a_1'] != null) {echo $row_select_pipe['cr_a_1'];} else {echo " <br>";} ?></center></td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cr_a_2'] != "" && $row_select_pipe['cr_a_2'] != "0" && $row_select_pipe['cr_a_2'] != null) {				echo $row_select_pipe['cr_a_2'];} else {				echo " <br>";} ?></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; b</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Weight of material passing through IS sieve 2.36mm after crushing load applied  in g   =  B</td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cr_b_1'] != "" && $row_select_pipe['cr_b_1'] != "0" && $row_select_pipe['cr_b_1'] != null) {echo $row_select_pipe['cr_b_1'];} else {echo " <br>";} ?></center></td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cr_b_2'] != "" && $row_select_pipe['cr_b_2'] != "0" && $row_select_pipe['cr_b_2'] != null) {				echo $row_select_pipe['cr_b_2'];} else {				echo " <br>";} ?></center></td>	
											
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; c</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Crushing Value %    = B/A x 100  = </td>
						    <td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cru_value_1'] != "" && $row_select_pipe['cru_value_1'] != "0" && $row_select_pipe['cru_value_1'] != null) {echo $row_select_pipe['cru_value_1'];} else {echo " <br>";} ?></center></td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cru_value_2'] != "" && $row_select_pipe['cru_value_2'] != "0" && $row_select_pipe['cru_value_2'] != null) {				echo $row_select_pipe['cru_value_2'];} else {				echo " <br>";} ?></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; D</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Average Crushing Value % </td>
						    <td colspan="2" style="border: 1px solid black;"><center><?php if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null) {echo $row_select_pipe['cru_value'];} else {echo " <br>";} ?></center></td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>-->
		<br>

		<!-- Impact Value -->
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. Impact value</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part IV 1963 &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;" rowspan="2">&nbsp;&nbsp; A</td>
							<td style="border: 1px solid black;padding: 2px 3px;" rowspan="2">&nbsp;&nbsp; Total weight taken in mould  in  g  =  A </td>
							<td style="border: 1px solid black;width:15%;padding: 2px 3px;text-align : center;">(i)</td>
							<td style="border: 1px solid black;width:15%;padding: 2px 3px;text-align : center;">(ii)</td>
							
						</tr>
						<tr>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_a_1'] != "" && $row_select_pipe['imp_w_m_a_1'] != "0" && $row_select_pipe['imp_w_m_a_1'] != null) {echo $row_select_pipe['imp_w_m_a_1'];} else {echo " <br>";} ?></center></td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_a_2'] != "" && $row_select_pipe['imp_w_m_a_2'] != "0" && $row_select_pipe['imp_w_m_a_2'] != null) {echo $row_select_pipe['imp_w_m_a_2'];} else {echo " <br>";} ?></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; B</td>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; Weight of material retained on IS sieve 2.36 mm in g =  B</td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_c_1'] != "" && $row_select_pipe['imp_w_m_c_1'] != "0" && $row_select_pipe['imp_w_m_c_1'] != null) {echo $row_select_pipe['imp_w_m_c_1'];} else {echo " <br>";} ?></center></td>
							<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_c_2'] != "" && $row_select_pipe['imp_w_m_c_2'] != "0" && $row_select_pipe['imp_w_m_c_2'] != null) {echo $row_select_pipe['imp_w_m_c_2'];} else {echo " <br>";} ?></center></td>					
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; C</td>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; Weight of material passing through IS sieve 2.36mm in  g = C </td>
							<td colspan=2 style="border: 1px solid black;text-align:left;padding: 2px 6px;">Av = (i+ii)/2=</td>
						    	
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; D</td>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; Impact Value % = C/A x 100 = </td>
						    <td  colspan=2  style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_value_1'] != "" && $row_select_pipe['imp_value_1'] != "0" && $row_select_pipe['imp_value_1'] != null) {echo $row_select_pipe['imp_value_1'];} else {echo " <br>";} ?></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; E</td>
							<td style="border: 1px solid black;padding: 2px 3px;">&nbsp;&nbsp; Average Impact Value %</td>
						    <td colspan="2" style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null) {echo $row_select_pipe['imp_value'];} else {echo " <br>";} ?></center></td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. Loss Angeles Abrasion</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part IV 1963 &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; A</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Total weight taken for testing  in g = A </td>
							<td colspan="2"style="border: 1px solid black;width:15%;"><center><?php if ($row_select_pipe['abr_wt_t_a_1'] != "" && $row_select_pipe['abr_wt_t_a_1'] != "0" && $row_select_pipe['abr_wt_t_a_1'] != null) {echo $row_select_pipe['abr_wt_t_a_1'];} else {echo " <br>";} ?></center></td>
							
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; B</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Weight of material retained on IS sieve in g   =  B </td>
							<td colspan="2" style="border: 1px solid black;"><center><?php if ($row_select_pipe['abr_wt_t_b_1'] != "" && $row_select_pipe['abr_wt_t_b_1'] != "0" && $row_select_pipe['abr_wt_t_b_1'] != null) {echo $row_select_pipe['abr_wt_t_b_1'];} else {echo " <br>";} ?></center></td>
							
											
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; C</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Weight of material passing through IS sieve 1.70mm  C =A – B </td>
						    <td colspan="2" style="border: 1px solid black;"><center><?php if ($row_select_pipe['abr_wt_t_c_1'] != "" && $row_select_pipe['abr_wt_t_c_1'] != "0" && $row_select_pipe['abr_wt_t_c_1'] != null) {echo $row_select_pipe['abr_wt_t_c_1'];} else {echo " <br>";} ?></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; D</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Abrasion Value % C/Ax100 </td>
						    <td colspan="2" style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_1'] != "" && $row_select_pipe['abr_1'] != "0" && $row_select_pipe['abr_1'] != null) {echo $row_select_pipe['abr_1'];} else {echo " <br>";} ?></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; E</td>
							<td style="border: 1px solid black;padding: 5px;">&nbsp;&nbsp; Average Abrasion Value % </td>
						    <td colspan="2" style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null) {echo $row_select_pipe['abr_index'];} else {echo " <br>";} ?></center></td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
		<br><br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:4px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2022 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
				<tr style="font-size:12px;" >
					<td style="text-align:center;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
				</tr>
			</table>
		<br><br>


			<div class="pagebreak"></div>

			<?php } if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null) || ($row_select_pipe['fi_index'] != "" && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null) || ($row_select_pipe['ei_index'] != "" && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null)) { ?>
			<br>
			<table align="center" width="94%" class="test" height="10%" style="border: 1px solid black;">
				<tr>
					<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
					<td colspan="2" style="font-size:14px;border: 1px solid black;">
						<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;">
						<center><b>FMT-OBS-006</b></center>
					</td>
					<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
						<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
					</td>
				</tr>
			</table>
			<br>	
			<!-- Loss Angeles Abrasion -->
			
			<!-- Determination of flakiness index & elongation -->
			<table align="center" width="94%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
				<tr>
					<td style="text-align:center;font-size:16px;">
						<table align="left" width="100%" height="70px;"  cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
							<tr>
								<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. Determination of flakiness index & elongation :</td>
								<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
							</tr>
							<tr>
								<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part I 1963 &nbsp; &nbsp;</td>
							</tr>
						</table>
						<br>
						<table align="center" width="100%" height="450px;"  class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;" colspan="2">&nbsp;&nbsp; Size of Aggregates</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;" rowspan="2">&nbsp;&nbsp; Weight of fraction (gms) </td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;" rowspan="2">&nbsp;&nbsp; Weight of flaky material (gms) </td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;" rowspan="2">&nbsp;&nbsp; Weight of non flaky material (gms) </td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;" rowspan="2">&nbsp;&nbsp; Weight of elongated material (gms) </td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">Passing through IS sieves (mm)</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">Retained on IS sieve (mm)</td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 63</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 50</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a1'] != ""  && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {echo $row_select_pipe['a1'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b1'] != ""  && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {echo $row_select_pipe['b1'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa1'] != ""  && $row_select_pipe['aa1'] != "0" && $row_select_pipe['aa1'] != null) {echo $row_select_pipe['aa1'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd1'] != ""  && $row_select_pipe['dd1'] != "0" && $row_select_pipe['dd1'] != null) {echo $row_select_pipe['dd1'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 50</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 40</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a2'] != ""  && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {echo $row_select_pipe['a2'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b2'] != ""  && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {echo $row_select_pipe['b2'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa2'] != ""  && $row_select_pipe['aa2'] != "0" && $row_select_pipe['aa2'] != null) {echo $row_select_pipe['aa2'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd2'] != ""  && $row_select_pipe['dd2'] != "0" && $row_select_pipe['dd2'] != null) {echo $row_select_pipe['dd2'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 40</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 31.5</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a3'] != ""  && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {echo $row_select_pipe['a3'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b3'] != ""  && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {echo $row_select_pipe['b3'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa3'] != ""  && $row_select_pipe['aa3'] != "0" && $row_select_pipe['aa3'] != null) {echo $row_select_pipe['aa3'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd3'] != ""  && $row_select_pipe['dd3'] != "0" && $row_select_pipe['dd3'] != null) {echo $row_select_pipe['dd3'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 31.5</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 25</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a4'] != ""  && $row_select_pipe['a4'] != "0" && $row_select_pipe['a4'] != null) {echo $row_select_pipe['a4'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b4'] != ""  && $row_select_pipe['b4'] != "0" && $row_select_pipe['b4'] != null) {echo $row_select_pipe['b4'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa4'] != ""  && $row_select_pipe['aa4'] != "0" && $row_select_pipe['aa4'] != null) {echo $row_select_pipe['aa4'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd4'] != ""  && $row_select_pipe['dd4'] != "0" && $row_select_pipe['dd4'] != null) {echo $row_select_pipe['dd4'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 25</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 20</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a5'] != ""  && $row_select_pipe['a5'] != "0" && $row_select_pipe['a5'] != null) {echo $row_select_pipe['a5'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b5'] != ""  && $row_select_pipe['b5'] != "0" && $row_select_pipe['b5'] != null) {echo $row_select_pipe['b5'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa5'] != ""  && $row_select_pipe['aa5'] != "0" && $row_select_pipe['aa5'] != null) {echo $row_select_pipe['aa5'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd5'] != ""  && $row_select_pipe['dd5'] != "0" && $row_select_pipe['dd5'] != null) {echo $row_select_pipe['dd5'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 20</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 16</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a6'] != ""  && $row_select_pipe['a6'] != "0" && $row_select_pipe['a6'] != null) {echo $row_select_pipe['a6'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b6'] != ""  && $row_select_pipe['b6'] != "0" && $row_select_pipe['b6'] != null) {echo $row_select_pipe['b6'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa6'] != ""  && $row_select_pipe['aa6'] != "0" && $row_select_pipe['aa6'] != null) {echo $row_select_pipe['aa6'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd6'] != ""  && $row_select_pipe['dd6'] != "0" && $row_select_pipe['dd6'] != null) {echo $row_select_pipe['dd6'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 16</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 12.5</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a7'] != ""  && $row_select_pipe['a7'] != "0" && $row_select_pipe['a7'] != null) {echo $row_select_pipe['a7'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b7'] != ""  && $row_select_pipe['b7'] != "0" && $row_select_pipe['b7'] != null) {echo $row_select_pipe['b7'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa7'] != ""  && $row_select_pipe['aa7'] != "0" && $row_select_pipe['aa7'] != null) {echo $row_select_pipe['aa7'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd7'] != ""  && $row_select_pipe['dd7'] != "0" && $row_select_pipe['dd7'] != null) {echo $row_select_pipe['dd7'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 12.5</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 10</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a8'] != ""  && $row_select_pipe['a8'] != "0" && $row_select_pipe['a8'] != null) {echo $row_select_pipe['a8'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b8'] != ""  && $row_select_pipe['b8'] != "0" && $row_select_pipe['b8'] != null) {echo $row_select_pipe['b8'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa8'] != ""  && $row_select_pipe['aa8'] != "0" && $row_select_pipe['aa8'] != null) {echo $row_select_pipe['aa8'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd8'] != ""  && $row_select_pipe['dd8'] != "0" && $row_select_pipe['dd8'] != null) {echo $row_select_pipe['dd8'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 10</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;">&nbsp;&nbsp; 6.3</td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['a9'] != ""  && $row_select_pipe['a9'] != "0" && $row_select_pipe['a9'] != null) {echo $row_select_pipe['a9'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['b9'] != ""  && $row_select_pipe['b9'] != "0" && $row_select_pipe['b9'] != null) {echo $row_select_pipe['b9'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['aa9'] != ""  && $row_select_pipe['aa9'] != "0" && $row_select_pipe['aa9'] != null) {echo $row_select_pipe['aa9'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;text-align: center;"><?php if ($row_select_pipe['dd9'] != ""  && $row_select_pipe['dd9'] != "0" && $row_select_pipe['dd9'] != null) {echo $row_select_pipe['dd9'];} else {echo " <br>";}  ?></td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 5px;text-align: left;" colspan="2">&nbsp;&nbsp; Total Weight</td>
								<td style="border: 1px solid black;padding: 5px;text-align: left;">&nbsp;&nbsp; W1 = <?php if ($row_select_pipe['suma'] != ""  && $row_select_pipe['suma'] != "0" && $row_select_pipe['suma'] != null) {echo $row_select_pipe['suma'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;padding: 5px;text-align: left;">&nbsp;&nbsp; W2 = <?php if ($row_select_pipe['sumb'] != ""  && $row_select_pipe['sumb'] != "0" && $row_select_pipe['sumb'] != null) {echo $row_select_pipe['sumb'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;padding: 5px;text-align: left;">&nbsp;&nbsp; W3 = <?php if ($row_select_pipe['sumaa'] != ""  && $row_select_pipe['sumaa'] != "0" && $row_select_pipe['sumaa'] != null) {echo $row_select_pipe['sumaa'];} else {echo " <br>";}  ?></td>
								<td style="border: 1px solid black;padding: 5px;text-align: left;">&nbsp;&nbsp; W4 = <?php if ($row_select_pipe['sumdd'] != ""  && $row_select_pipe['sumdd'] != "0" && $row_select_pipe['sumdd'] != null) {echo $row_select_pipe['sumdd'];} else {echo " <br>";}  ?></td>
							</tr>
							
						</table>
						<table align="center" width="100%" height="150px;" class="test1" style="border: 1px solid; border-top: 0;">
							<tr style="border: 0px solid black;">
								<td style="width: 14%;border-bottom: 1px solid;text-align: center;padding: 3px;" >Flakiness <br> Index (F.I.)</td>
								<td style="width: 5%;border-left: 1px solid;border-bottom: 1px solid;text-align: center;padding: 3px;" > =</td>
								<td style="width: 30%;text-align: center;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" ><span style="border-bottom: 1px solid;">Total weight of flaky material (W2)</span> <br>Total weight of sample (W1) </td>
								<td style="width: 5%;text-align: center;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" >X</td>
								<td style="width: 5%;text-align: center;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" >100</td>
								<td style="width: 6%;border-left: 1px solid;border-bottom: 1px solid;text-align: center;padding: 3px;" >&nbsp;&nbsp;=</td>
								<td style="width: 10%;border-left: 1px solid;border-bottom: 1px solid;text-align: center;padding: 3px;" ><span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['fi_index'] != ""  && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null) {echo $row_select_pipe['fi_index'];} else {echo " <br>";} ?></span></td>
								<td style="width: 10%;border-left: 1px solid;border-bottom: 1px solid;" >&nbsp;&nbsp; %</td>
							</tr>
							<tr style="border: 0px solid black;">
								<td style="width: 14%;border-bottom: 1px solid;text-align: center;padding: 3px;" >Elongation  <br> Index (E.I.)</td>
								<td style="width: 5%;border-left: 1px solid;border-bottom: 1px solid;text-align: center;padding: 3px;" >=</td>
								<td style="width: 30%;text-align: center;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" ><span style="border-bottom: 1px solid;">Total weight of elongated material (W4)</span> <br>Total weight of sample (W3) </td>
								<td style="width: 5%;text-align: center;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" >X</td>
								<td style="width: 5%;text-align: center;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" >100</td>
								<td style="width: 6%;border-left: 1px solid;border-bottom: 1px solid;text-align: center;padding: 3px;" >&nbsp;&nbsp;=</td>
								<td style="width: 10%;border-left: 1px solid;border-bottom: 1px solid;text-align: center;padding: 3px;" ><span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['ei_index'] != ""  && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null) {echo $row_select_pipe['ei_index'];} else {echo " <br>";} ?></span></td>
								<td style="width: 10%;border-left: 1px solid;border-bottom: 1px solid;padding: 3px;" >&nbsp;&nbsp; %</td>
							</tr>
							<tr style="border: 0px solid black;">
								<td style="text-align: center;padding: 3px;" colspan="3">Combined Flakiness & Elongation Index =  F.I. + E.I.  =</td>
								<td colspan="5"  style="border-left: 1px solid;text-align: center;padding: 3px;">&nbsp;&nbsp; = &nbsp;&nbsp; <?php if ($row_select_pipe['combined_index'] != ""  && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null) {echo $row_select_pipe['combined_index'];} else {echo " <br>";} ?></td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:4px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2022 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
				<tr style="font-size:12px;" >
					<td style="text-align:center;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
				</tr>
			</table>

			

			<?php } if (($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null) || ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null) || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) { ?>
			<div class="pagebreak"></div>
			<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
				<tr>
					<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
					<td colspan="2" style="font-size:14px;border: 1px solid black;">
						<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;">
						<center><b>FMT-OBS-006</b></center>
					</td>
					<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
						<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
					</td>
				</tr>
			</table>
			<br>	
			<!-- Loss Angeles Abrasion -->
			
			<!-- Determination of flakiness index & elongation -->
			<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
				<tr>
					<td style="text-align:center;font-size:16px;">
						<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
							<tr>
								<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. Soundness</td>
								<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
							</tr>
							<tr>
								<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part IV 1963 &nbsp; &nbsp;</td>
							</tr>
						</table>
						<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;" colspan="2">&nbsp;&nbsp; Sieve Size</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">&nbsp;&nbsp; Grading of original sample % </td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">&nbsp;&nbsp; Weight of test fraction before test In g </td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">&nbsp;&nbsp; Weight of test fraction after test In g </td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">&nbsp;&nbsp; % passing finer sieve after test (Actual % loss) </td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">&nbsp;&nbsp; Weighted average (corrected % loss) </td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;width: 8%;">Passing</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;width: 8%;">Retained</td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">63 mm</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">40 mm</td>
								<td style="border: 1px solid black;">
									<center>40 mm</center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s41'] != "" && $row_select_pipe['s41'] != "0" && $row_select_pipe['s41'] != null) {echo $row_select_pipe['s41'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;"><?php if ($row_select_pipe['s71'] != "" && $row_select_pipe['s71'] != "0" && $row_select_pipe['s71'] != null) {echo $row_select_pipe['s71'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s51'] != "" && $row_select_pipe['s51'] != "0" && $row_select_pipe['s51'] != null) {echo $row_select_pipe['s51'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s61'] != "" && $row_select_pipe['s61'] != "0" && $row_select_pipe['s61'] != null) {echo $row_select_pipe['s61'];} else {echo " <br>";} ?></center>
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">40 mm</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">20 mm</td>
								<td style="border: 1px solid black;">
									<center>20 mm</center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s44'] != "" && $row_select_pipe['s44'] != "0" && $row_select_pipe['s44'] != null) {echo $row_select_pipe['s44'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;"><?php if ($row_select_pipe['s74'] != "" && $row_select_pipe['s74'] != "0" && $row_select_pipe['s74'] != null) {echo $row_select_pipe['s74'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s54'] != "" && $row_select_pipe['s54'] != "0" && $row_select_pipe['s54'] != null) {echo $row_select_pipe['s54'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s64'] != "" && $row_select_pipe['s64'] != "0" && $row_select_pipe['s64'] != null) {echo $row_select_pipe['s64'];} else {echo " <br>";} ?></center>
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">20 mm</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">10 mm</td>
								<td style="border: 1px solid black;">
									<center>10 mm</center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s47'] != "" && $row_select_pipe['s47'] != "0" && $row_select_pipe['s47'] != null) {echo $row_select_pipe['s47'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;"><?php if ($row_select_pipe['s77'] != "" && $row_select_pipe['s77'] != "0" && $row_select_pipe['s77'] != null) {echo $row_select_pipe['s77'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s57'] != "" && $row_select_pipe['s57'] != "0" && $row_select_pipe['s57'] != null) {echo $row_select_pipe['s57'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s67'] != "" && $row_select_pipe['s67'] != "0" && $row_select_pipe['s67'] != null) {echo $row_select_pipe['s67'];} else {echo " <br>";} ?></center>
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">10 mm</td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">4.75 mm</td>
								<td style="border: 1px solid black;">
									<center>4.75 mm</center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s40'] != "" && $row_select_pipe['s40'] != "0" && $row_select_pipe['s40'] != null) {echo $row_select_pipe['s40'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;padding: 5px;text-align: center;"><?php if ($row_select_pipe['s70'] != "" && $row_select_pipe['s70'] != "0" && $row_select_pipe['s70'] != null) {echo $row_select_pipe['s70'];} else {echo " <br>";} ?></td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s60'] != "" && $row_select_pipe['s60'] != "0" && $row_select_pipe['s60'] != null) {echo $row_select_pipe['s60'];} else {echo " <br>";} ?></center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s60'] != "" && $row_select_pipe['s60'] != "0" && $row_select_pipe['s60'] != null) {echo $row_select_pipe['s60'];} else {echo " <br>";} ?></center>
								</td>
							</tr>
							<tr>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;"></td>
								<td style="border: 1px solid black;padding: 2px 3px;text-align: center;">Total</td>
								<td style="border: 1px solid black;">
									<center></center>
								</td>
								<td style="border: 1px solid black;">
									<center></center>
								</td>
								<td style="border: 1px solid black;">
									<center></center>
								</td>
								<td style="border: 1px solid black;">
									<center></center>
								</td>
								<td style="border: 1px solid black;">
									<center><?php if ($row_select_pipe['s6total'] != "" && $row_select_pipe['s6total'] != "0" && $row_select_pipe['s6total'] != null) {echo $row_select_pipe['s6total'];} else {echo " <br>";} ?></center>
								</td>
							</tr>
							
						</table>
					</td>
				</tr>
			</table>
			<br>
			<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
				
				<tr>
					<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;"><?php echo $count++;?>. Deleterious material</td>
				</tr>
			</table>
			<p style="margin-left:30px;font-weight:bold; ">(i) % finer than 75u</b></p>
			<table align="center" width="90%" Height="90px;" class="test1" style="border: 1px solid black;">
				<tr>
					<td width="65%" style="border: 1px solid black;">&nbsp; Weight of Sample, gm (B)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_1_1'] != "0" && $row_select_pipe['dele_1_1'] != null) {echo $row_select_pipe['dele_1_1'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; After washing through water, then oven dry weight</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_2'] != "" && $row_select_pipe['dele_1_2'] != "0" && $row_select_pipe['dele_1_2'] != null) {echo $row_select_pipe['dele_1_2'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; Weight of Sample, gm (C)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_3'] != "" && $row_select_pipe['dele_1_3'] != "0" && $row_select_pipe['dele_1_3'] != null) {echo $row_select_pipe['dele_1_3'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; % finer than 75u (A) = (B-C)/B * 100</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) {echo $row_select_pipe['dele_1_4'];} else {echo " <br>";} ?></b></td>
				</tr>
			</table>

			<p style="margin-left:30px;font-weight:bold;">(ii) % Clay and Lumps</b></p>
			<table align="center" width="90%" Height="90px;" class="test1" style="border: 1px solid black;">
				<tr>
					<td width="65%" style="border: 1px solid black;">&nbsp; Wt of Sample gm (W)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_2_1'] != "0" && $row_select_pipe['dele_2_1'] != null) {echo $row_select_pipe['dele_2_1'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; After broken with fingre then paassing 2.36mm IS Sieve gm (R)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_2_2'] != "" && $row_select_pipe['dele_2_2'] != "0" && $row_select_pipe['dele_2_2'] != null) {echo $row_select_pipe['dele_2_2'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; % Clay Lumps = (W-R)/B * 100</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) {echo $row_select_pipe['dele_2_3'];} else {echo " <br>";} ?></b></td>
				</tr>
			</table>
	
			<p style="margin-left:30px;font-weight:bold; ">(iii) % Coal and Lignite</b></p>
			<table align="center" width="90%" Height="90px;" class="test1" style="border: 1px solid black;">
				<tr>
					<td width="65%" style="border: 1px solid black;">&nbsp; Wt of Sample gm (W1)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_3_1'] != "0" && $row_select_pipe['dele_3_1'] != null) {echo $row_select_pipe['dele_3_1'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; Introduce in to heavy liquid then wt gm (W2)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_3_2'] != "" && $row_select_pipe['dele_3_2'] != "0" && $row_select_pipe['dele_3_2'] != null) {echo $row_select_pipe['dele_3_2'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; % Coal & Ligntie = (W1 - W2)/W1 * 100</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_3_3'] != "") {echo $row_select_pipe['dele_3_3'];} else {echo " <br>";} ?></b></td>
				</tr>
			</table>
	
			<p style="margin-left:30px;font-weight:bold; ">(iv) % Soft Particle</b></p>
			<table align="center" width="90%" Height="90px;" class="test1" style="border: 1px solid black;">
				<tr>
					<td width="65%" style="border: 1px solid black;">&nbsp; Weight of Sample as per IS 2386 (P-2), CL no S 3.1 gms (A)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_4_1'] != "0" && $row_select_pipe['dele_4_1'] != null) {echo $row_select_pipe['dele_4_1'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; Weight of Soft Particle broken from surface after brass rod rubbing, gms (B)</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_4_2'] != "" && $row_select_pipe['dele_4_2'] != "0" && $row_select_pipe['dele_4_2'] != null) {echo $row_select_pipe['dele_4_2'];} else {echo " <br>";} ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp; % Soft Particle :- B/A * 100</b></td>
					<td style="border: 1px solid black;text-align:center;">&nbsp; <?php if ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null) {echo $row_select_pipe['dele_4_3'];} else {echo " <br>";} ?></b></td>
				</tr>
			</table>
	
			
			<br>
			<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:4px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2022 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
				<tr style="font-size:12px;" >
					<td style="text-align:center;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
				</tr>
			</table>

			
			
		<?php } if (($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null) || ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != "0" && $row_select_pipe['avg_ph'] != null) || ($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null) || ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != "0" && $row_select_pipe['aoi_4'] != null)) { ?>	
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
				<tr>
					<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
					<td colspan="2" style="font-size:14px;border: 1px solid black;">
						<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
					</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;">
						<center><b>FMT-OBS-006</b></center>
					</td>
					<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
						<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
					</td>
				</tr>
			</table>
		<p style="margin-left:30px;font-weight:bold;"><?php echo $count++;?>. Chloride Content (BS EN 1744 - 1)</p>
		<table align="center" width="90%" Height="23%" class="test1" style="border: 1px solid black;" height="Auto" cellpadding="3px">
			<tr>
				<td width="60%" style="border: 1px solid black;text-align:center;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;text-align:center;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;text-align:center;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Weight of Soil Sample</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_1'] != "" && $row_select_pipe['clr_s1_1'] != "0" && $row_select_pipe['clr_s1_1'] != null) {echo $row_select_pipe['clr_s1_1'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_1'] != "" && $row_select_pipe['clr_s2_1'] != "0" && $row_select_pipe['clr_s2_1'] != null) {echo $row_select_pipe['clr_s2_1'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Weight of Water</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_2'] != "" && $row_select_pipe['clr_s1_2'] != "0" && $row_select_pipe['clr_s1_2'] != null) {echo $row_select_pipe['clr_s1_2'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_2'] != "" && $row_select_pipe['clr_s2_2'] != "0" && $row_select_pipe['clr_s2_2'] != null) {echo $row_select_pipe['clr_s2_2'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Weight of Soil Ratio gm/g (W)</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_3'] != "" && $row_select_pipe['clr_s1_3'] != "0" && $row_select_pipe['clr_s1_3'] != null) {echo $row_select_pipe['clr_s1_3'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_3'] != "" && $row_select_pipe['clr_s2_3'] != "0" && $row_select_pipe['clr_s2_3'] != null) {echo $row_select_pipe['clr_s2_3'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Volume of AgNo3.0.1M Solution ml (V5)</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_4'] != "" && $row_select_pipe['clr_s1_4'] != "0" && $row_select_pipe['clr_s1_4'] != null) {echo $row_select_pipe['clr_s1_4'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_4'] != "" && $row_select_pipe['clr_s2_4'] != "0" && $row_select_pipe['clr_s2_4'] != null) {echo $row_select_pipe['clr_s2_4'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Volume of STD NH45CN Solution (ml) (V6)</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_5'] != "" && $row_select_pipe['clr_s1_5'] != "0" && $row_select_pipe['clr_s1_5'] != null) {echo $row_select_pipe['clr_s1_5'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_5'] != "" && $row_select_pipe['clr_s2_5'] != "0" && $row_select_pipe['clr_s2_5'] != null) {echo $row_select_pipe['clr_s2_5'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; CT - Normality of NH4SCN</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_6'] != "" && $row_select_pipe['clr_s1_6'] != "0" && $row_select_pipe['clr_s1_6'] != null) {echo $row_select_pipe['clr_s1_6'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_6'] != "" && $row_select_pipe['clr_s2_6'] != "0" && $row_select_pipe['clr_s2_6'] != null) {echo $row_select_pipe['clr_s2_6'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Chloride = 0.003546*W {(V5-(10*CT*V6))}</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s1_7'] != "" && $row_select_pipe['clr_s1_7'] != "0" && $row_select_pipe['clr_s1_7'] != null) {echo $row_select_pipe['clr_s1_7'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['clr_s2_7'] != "" && $row_select_pipe['clr_s2_7'] != "0" && $row_select_pipe['clr_s2_7'] != null) {echo $row_select_pipe['clr_s2_7'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>&nbsp; % Average</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null) {			echo $row_select_pipe['avg_clr'];		} else {			echo " <br>";		} ?></b></td>
			</tr>
		</table>
		<p style="margin-left:30px;font-weight:bold;"><?php echo $count++;?>. pH (IS 2720 - 26)</p>
		<table align="center" width="90%" Height="10%" class="test1" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td width="60%" style="border: 1px solid black;text-align:center;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;text-align:center;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;text-align:center;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Volume in ml of sample taken (V)</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ph_s1_1'] != "" && $row_select_pipe['ph_s1_1'] != "0" && $row_select_pipe['ph_s1_1'] != null) {echo $row_select_pipe['ph_s1_1'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ph_s2_1'] != "" && $row_select_pipe['ph_s2_1'] != "0" && $row_select_pipe['ph_s2_1'] != null) {echo $row_select_pipe['ph_s2_1'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; pH</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ph_s1_2'] != "" && $row_select_pipe['ph_s1_2'] != "0" && $row_select_pipe['ph_s1_2'] != null) {echo $row_select_pipe['ph_s1_2'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['ph_s2_2'] != "" && $row_select_pipe['ph_s2_2'] != "0" && $row_select_pipe['ph_s2_2'] != null) {echo $row_select_pipe['ph_s2_2'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>&nbsp; % Average</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != "0" && $row_select_pipe['avg_ph'] != null) { echo $row_select_pipe['avg_ph'];} else {echo " <br>";} ?></b></td>
			</tr>
		</table>
		<p style="margin-left:30px;font-weight:bold;"><?php echo $count++;?>. Sulphate (IS 2720 - 27)</p>
		<table align="center" width="90%" Height="18%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="60%" style="border: 1px solid black;text-align:center;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;text-align:center;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;text-align:center;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Initial Weight of Sample (A) gm</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s1_1'] != "" && $row_select_pipe['slp_s1_1'] != "0" && $row_select_pipe['slp_s1_1'] != null) {echo $row_select_pipe['slp_s1_1'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s2_1'] != "" && $row_select_pipe['slp_s2_1'] != "0" && $row_select_pipe['slp_s2_1'] != null) {echo $row_select_pipe['slp_s2_1'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Empty weight of Crucible + Sample After Ignition (C) gm</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s1_2'] != "" && $row_select_pipe['slp_s1_2'] != "0" && $row_select_pipe['slp_s1_2'] != null) {echo $row_select_pipe['slp_s1_2'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s2_2'] != "" && $row_select_pipe['slp_s2_2'] != "0" && $row_select_pipe['slp_s2_2'] != null) {echo $row_select_pipe['slp_s2_2'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; Weight of Residue after Ignition D = (C-B) gm</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s1_3'] != "" && $row_select_pipe['slp_s1_3'] != "0" && $row_select_pipe['slp_s1_3'] != null) {echo $row_select_pipe['slp_s1_3'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s2_3'] != "" && $row_select_pipe['slp_s2_3'] != "0" && $row_select_pipe['slp_s2_3'] != null) {echo $row_select_pipe['slp_s2_3'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">&nbsp; S04 (%) = 41.15-D/A</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s1_4'] != "" && $row_select_pipe['slp_s1_4'] != "0" && $row_select_pipe['slp_s1_4'] != null) {echo $row_select_pipe['slp_s1_4'];} else {echo " <br>";} ?></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['slp_s2_4'] != "" && $row_select_pipe['slp_s2_4'] != "0" && $row_select_pipe['slp_s2_4'] != null) {echo $row_select_pipe['slp_s2_4'];} else {echo " <br>";} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>&nbsp; % Average</b></td>
				<td colspan="2" style="border: 1px solid black;text-align:center;"><b><?php if ($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null) {			echo $row_select_pipe['avg_sul'];		} else {			echo " <br>";		} ?></b></td>
			</tr>
		</table>
			<br>
			<br>
			<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid black;">
				<tr style="">
					<td style="width:25%;padding-top:4px;"><center>Amendment No.: 01</center></td>
					<td style="width:25%;padding-top:4px;"><center>Amendment Date: 01.04.2023</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Prepared by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Approved by:</center></td>
					<td style="width:16.67%;padding-top:4px;"><center>Issued by:</center></td>
				</tr>	
				<tr>
					<td style=""><center>Issue No.: 03</center></td>
					<td style=""><center>Issue Date: 01.01.2022 </center></td>
					<td style=""><center>Nodal QM</center></td>
					<td style=""><center>Director</center></td>
					<td style=""><center>Nodal QM</center></td>
				</tr>
				<tr style="font-size:12px;" >
					<td style="text-align:center;">Page <?php echo $pagecnt++;?> of <?php echo $totalcnt;?></td>
				</tr>
			</table>
		<?php }?>

		<!--<div class="pagebreak"></div>


		<br><br>	
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-006</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
				</td>
			</tr>
		</table>
		<br>

		<Deleterious material>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;">10. Deleterious material</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part IV 1963 &nbsp; &nbsp;</td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="font-family: Cambria;">
						<tr>
							<td style="padding: 2px 3px;text-align: center;">(i)</td>
							<td style="padding: 2px 3px;text-align: left;">Determination of light weight pieces (Coal & Lignite) </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">Percentage of light weight pieces =  1 + <span style="border-bottom: 1px solid;">W1</span>&nbsp;&nbsp; X 100 <br> <p style="margin: 0 0 0 214px;">W3</p> </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">Where &nbsp;&nbsp;&nbsp;  W1 = dry weight in gm of decanted pieces</td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    W3 = dry weight in gm of portion of sample coarser than 4.75mm IS Sieve </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">(ii)</td>
							<td style="padding: 2px 3px;text-align: left;">Determine of Clay lumps </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">Calculationc : L = <span style="border-bottom: 1px solid;">W - R</span>&nbsp;&nbsp; X 100 <br> <p style="margin: 0 0 0 96px;">W3</p> </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">Where &nbsp;&nbsp;&nbsp;  L	= Percentage of clay lumps</td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    W 	= Weight of sample </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    R 	= Weight of sample after removal of clay lumps </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">(iii)</td>
							<td style="padding: 2px 3px;text-align: left;">Material finer than 75 micron sieve </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">Original dry weight B = <span style="border-bottom: 1px solid;">&nbsp;&nbsp;&nbsp;</span> g </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;"></td>
							<td style="padding: 2px 3px;text-align: left;">Dry weight after washing C =  <span style="border-bottom: 1px solid;">&nbsp;&nbsp;&nbsp;</span> g </td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="font-family: Cambria;">
						<tr>
							<td style="padding: 2px 3px;text-align: left;" colspan="2">Percentage of material</td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: left; width: 18%;">finer than 75 micron </td>
							<td style="padding: 2px 3px;text-align: left;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; A = <span style="border-bottom: 1px solid;">B - C</span>&nbsp;&nbsp; X 100 <br> <p style="margin: 0 0 0 54px;">B</p> </td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="font-family: Cambria;">
						<tr>
							<td style="padding: 2px 3px;text-align: center;padding-bottom: 8px;">(iv)</td>
							<td style="padding: 2px 3px;text-align: left;padding-bottom: 8px;"> Soft fragment </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">a.</td>
							<td style="padding: 2px 3px;text-align: left;"> Weight and number of particles of each sample tested with the brass rod </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">b.</td>
							<td style="padding: 2px 3px;text-align: left;"> Weight and number of particles of size of each sample classified as soft in the test </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">c.</td>
							<td style="padding: 2px 3px;text-align: left;"> Percentage of test sample classified as soft by weight & by number of particles </td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">d.</td>
							<td style="padding: 2px 3px;text-align: left;"> Weight average percentage of soft particles calculated from percentage in item c based on the grading of sample of aggregate </td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br><br><br><br><br><br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid #ccc;">
			<tr style="padding-top:4px;">
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
				<td style="text-align:center;"><b>Page 4 of 5</b></td>
			</tr>		
		</table>
		<br><br>


		<div class="pagebreak"></div>


		<br><br>	
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-006</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR  TEST ON COARSE AGGREGATE </b></center>
				</td>
			</tr>
		</table>
		<br>
		<!-- 10 %  fine value >
		<br><br>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td style="text-align:center;font-size:16px;">
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border: 0;">
						<tr>
							<td style="font-size:16px;font-weight:bold;padding: 2px 4px 3px;border: 0;">Determination Of 10 % Fine Value Of Aggregate</td>
							<td style=" text-align:left;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align: right;">&nbsp;&nbsp; Date &nbsp; &nbsp; &nbsp; :  &nbsp; &nbsp; &nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?>&nbsp; &nbsp;</td>
						</tr>
						<tr>
							<td style=" text-align:left;font-weight:bold;padding-bottom:6px;padding-top:2px;text-align: right;" colspan="2">&nbsp;&nbsp; IS 2386 Part IV 1963 &nbsp; &nbsp;</td>
						</tr>
					</table>
					<br><br>
					<table align="center" width="100%" class="test1" style="font-family: Cambria; margin-top: 14px;">
						<tr>
							<td style="padding: 2px 3px;text-align: center;">1.</td>
							<td style="padding: 2px 3px;text-align: left;width: 80%">Total weight of sample taken in mould passing through 12.5 mm sieve & retained on 10 mm Sieve </td>
							<td style="padding: 2px 3px;text-align: left;width: 26%">A(gm) =  <span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['f_a_1'] != "" && $row_select_pipe['f_a_1'] != "0" && $row_select_pipe['f_a_1'] != null) {
                                                                                                                        echo $row_select_pipe['f_a_1'];
                                                                                                                    } else {
                                                                                                                        echo " <br>";
                                                                                                                    } ?></span></td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">2.</td>
							<td style="padding: 2px 3px;text-align: left;">Weight of material passing through 2.36 mm sieve after load applied </td>
							<td style="padding: 2px 3px;text-align: left;">B(gm) =  <span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['f_c_1'] != "" && $row_select_pipe['f_c_1'] != "0" && $row_select_pipe['f_c_1'] != null) {
                                                                                                                        echo $row_select_pipe['f_c_1'];
                                                                                                                    } else {
                                                                                                                        echo " <br>";
                                                                                                                    } ?></span></td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">3.</td>
							<td style="padding: 2px 3px;text-align: left;"> % fines  </td>
							<td style="padding: 2px 3px;text-align: left;">Y =  (B/A)*100 =  <span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['f_d_1'] != "" && $row_select_pipe['f_d_1'] != "0" && $row_select_pipe['f_d_1'] != null) {
                                                                                                                        echo $row_select_pipe['f_d_1'];
                                                                                                                    } else {
                                                                                                                        echo " <br>";
                                                                                                                    } ?></span></td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">4.</td>
							<td style="padding: 2px 3px;text-align: left;">Load applied uniformly for 10 min for 15/20/24 mm penetration of plunger for rounded/normal/honeycombed aggregates respectively </td>
							<td style="padding: 2px 3px;text-align: left;">X =  <span style="border-bottom: 1px solid;"><?php if ($row_select_pipe['f_b_1'] != "" && $row_select_pipe['f_b_1'] != "0" && $row_select_pipe['f_b_1'] != null) {
                                                                                                                        echo $row_select_pipe['f_b_1'];
                                                                                                                    } else {
                                                                                                                        echo " <br>";
                                                                                                                    } ?></span></td>
						</tr>
						<tr>
							<td style="padding: 2px 3px;text-align: center;">5.</td>
							<td style="padding: 2px 3px;text-align: left;">Load required for 10% fines = </td>
							<td style="padding: 2px 3px;text-align: left;"><span style="border-bottom: 1px solid;">(14 * X)</span>&nbsp;&nbsp; =  <?php if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null) {
                                                                                                                                                    echo $row_select_pipe['fines_value'];
                                                                                                                                                } else {
                                                                                                                                                    echo "&nbsp;";
                                                                                                                                                } ?><br> <span style="margin: ;">(Y + 4)</span></td>
							
						</tr>
					</table>
				</td>
			</tr>
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


		<br><br><br><br><br><br><br><br><br><br><br><br><br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid #ccc;">
			<tr style="padding-top:4px;">
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
				<td style="text-align:center;"><b>Page 5 of 5</b></td>
			</tr>		
		</table>
		<br><br>


		<div class="pagebreak"></div>


		<br><br>



		<!-- <table align="center" width="90%" class="test" height="10%" style="border: 1px solid black;">
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
					<center><b>Coarse Aggregate</b></center>
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

		<p class="test1" style="margin-left:5%;">Detail of Sample</p>

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


		</table> -->
		<!--table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
				<tr style="border: 0px solid black;">
					<td colspan="10" style="border: 0px solid black;"><b>Test - 1 Gradation</b></td>
					<td colspan="4" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-1</b></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">				
				<tr style="border: 0px solid black;">
					<td colspan="10" style="border: 0px solid black;" ><b>Size of Material :-</b> <?php echo $detail_sample; ?> </td>
					<td colspan="4" style="text-align:center; border: 0px solid black;"><b>Total Weight   = </b>  <?php echo $row_select_pipe['sample_taken']; ?><b>  gm</b></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><center>Sieve Size<br>(mm)</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Wt. of mass <br> retained, gm</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Cum. mass <br> retained, gm</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Cum. % mass <br> retained</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>% of passing</center></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;"><center>Requirement</center></td>
					
				</tr>
				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {			echo $row_select_pipe['sieve_1'];			} else {			echo "";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {		echo $row_select_pipe['cum_wt_gm_1'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {		echo $row_select_pipe['ret_wt_gm_1'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {		echo $row_select_pipe['cum_ret_1'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {		echo $row_select_pipe['pass_sample_1'];	} else {		echo " <br>";	}  ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {			echo $row_select_pipe['sieve_2'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {		echo $row_select_pipe['cum_wt_gm_2'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {		echo $row_select_pipe['ret_wt_gm_2'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {		echo $row_select_pipe['cum_ret_2'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {		echo $row_select_pipe['pass_sample_2'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {			echo $row_select_pipe['sieve_3'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {		echo $row_select_pipe['cum_wt_gm_3'];	} else {		echo " <br>";	}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {		echo $row_select_pipe['ret_wt_gm_3'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {		echo $row_select_pipe['cum_ret_3'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {		echo $row_select_pipe['pass_sample_3'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
			
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {			echo $row_select_pipe['sieve_4'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {		echo $row_select_pipe['cum_wt_gm_4'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {		echo $row_select_pipe['ret_wt_gm_4'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {		echo $row_select_pipe['cum_ret_4'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {		echo $row_select_pipe['pass_sample_4'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {			echo $row_select_pipe['sieve_5'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {		echo $row_select_pipe['cum_wt_gm_5'];	} else {		echo " <br>";	}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {		echo $row_select_pipe['ret_wt_gm_5'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {		echo $row_select_pipe['cum_ret_5'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {		echo $row_select_pipe['pass_sample_5'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {			echo $row_select_pipe['sieve_6'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {		echo $row_select_pipe['cum_wt_gm_6'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {		echo $row_select_pipe['ret_wt_gm_6'];	} else {		echo " <br>";	}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {		echo $row_select_pipe['cum_ret_6'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {		echo $row_select_pipe['pass_sample_6'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {			echo $row_select_pipe['sieve_7'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {		echo $row_select_pipe['cum_wt_gm_7'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {		echo $row_select_pipe['ret_wt_gm_7'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {		echo $row_select_pipe['cum_ret_7'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {		echo $row_select_pipe['pass_sample_7'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {			echo $row_select_pipe['sieve_8'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {		echo $row_select_pipe['cum_wt_gm_8'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {		echo $row_select_pipe['ret_wt_gm_8'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {		echo $row_select_pipe['cum_ret_8'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {		echo $row_select_pipe['pass_sample_8'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {			echo $row_select_pipe['sieve_9'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {		echo $row_select_pipe['cum_wt_gm_9'];	} else {		echo " <br>";	}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {		echo $row_select_pipe['ret_wt_gm_9'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {		echo $row_select_pipe['cum_ret_9'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {		echo $row_select_pipe['pass_sample_9'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {			echo $row_select_pipe['sieve_10'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {		echo $row_select_pipe['cum_wt_gm_10'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {		echo $row_select_pipe['ret_wt_gm_10'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {		echo $row_select_pipe['cum_ret_10'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {		echo $row_select_pipe['pass_sample_10'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {			echo $row_select_pipe['sieve_11'];			} else {			echo " <br>";			} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {		echo $row_select_pipe['cum_wt_gm_11'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {		echo $row_select_pipe['ret_wt_gm_11'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {		echo $row_select_pipe['cum_ret_11'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {		echo $row_select_pipe['pass_sample_11'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>				
				<tr style="text-align:center">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {			echo $row_select_pipe['sieve_12'];			} else {			echo " <br>";			}  ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {		echo $row_select_pipe['cum_wt_gm_12'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {		echo $row_select_pipe['ret_wt_gm_12'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {		echo $row_select_pipe['cum_ret_12'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {		echo $row_select_pipe['pass_sample_12'];	} else {		echo " <br>";	} ?></td>
					<td colspan="2" style="border: 1px solid black;"></td>
				</tr>
				
				
			</table>
				<br>	
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
					<tr style="border: 1px solid black;">
						<td colspan="3" style="border: 0px solid black;"><b>Test - 2&3 Specific Gravity & Water Absorption </b></td>
						<td colspan="3" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-3</b></td>
					</tr>
					<tr>
						<td  style="border: 1px solid black;font-weight:bold;width:10%;"><center><b>Sr.No.</b></center></td>
						<td style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of<br>saturated<br>surface Dry<br>(gm) (A)</b></center></td>
						<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of<Br>sample oven<Br>dry (gm)<Br>(B)</b></center></td>						
						<td   style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Weight of sample,<br>in Water<br>(gm) (C)</b></center></td>						
						<td style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>Specific<br>gravity<hr width="100%">B/(A-C)</b></center></td>						
						<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center><b>water absorption <br>(% of Dry Weight)<hr width="100%">100(A-B)/B</b></center></td>						
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>1</b></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) {		echo $row_select_pipe['sp_wt_st_1'];	} else {		echo " <br>";	} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) {		echo $row_select_pipe['sp_w_s_1'];	} else {		echo " <br>";	} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) {		echo $row_select_pipe['sp_w_sur_1'];	} else {		echo " <br>";	} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) {		echo $row_select_pipe['sp_specific_gravity_1'];	} else {		echo " <br>";	} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) {		echo $row_select_pipe['sp_water_abr_1'];	} else {		echo " <br>";	} ?></center></td>						
						
					</tr>
					<tr>
						<td  style="border: 1px solid black;"><center>2</center></td>
						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) {		echo $row_select_pipe['sp_wt_st_2'];	} else {		echo " <br>";	} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) {		echo $row_select_pipe['sp_w_s_2'];	} else {		echo " <br>";	} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) {		echo $row_select_pipe['sp_w_sur_2'];	} else {		echo " <br>";	} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) {		echo $row_select_pipe['sp_specific_gravity_2'];	} else {		echo " <br>";	} ?></center></td>
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) {		echo $row_select_pipe['sp_water_abr_2'];	} else {		echo " <br>";	} ?></center></td>						
						
					</tr>
					<tr>
						<td style="border: 1px solid black;" align="right" colspan="4"><b>Average</b></td>
											
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) {		echo $row_select_pipe['sp_specific_gravity'];	} else {		echo " <br>";	} ?></center></td>						
						<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) {		echo $row_select_pipe['sp_water_abr'];	} else {		echo " <br>";	} ?></center></td>						
						
					</tr>
				
					
				</table>
				<br>
			
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
						<tr style="border: 1px solid black;">
							<td colspan="3" style="border: 0px solid black;"><b>Test-4 Bulk Density</b></td>
							<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-3</b></td>
						</tr>
					
					
						<tr>
						<td style="border: 1px solid black;width:5%;"><center><b>S.N.</b></center></td>
						<td style="border: 1px solid black;width:50%;"><center><b>Particular</b></center></td>
						<td style="border: 1px solid black;width:15%;"><center><b>(I)</b></center></td>
						<td style="border: 1px solid black;width:15%;"><center><b>(II)</b></center></td>						
						<td style="border: 1px solid black;width:15%;"><center><b>(III)</b></center></td>						
						
						</tr>
						<tr>
						<td style="border: 1px solid black;"><center><b>1</b></center></td>
						<td style="border: 1px solid black;"><b>Weight of Mould + Material in kg</b></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m11'] != "" && $row_select_pipe['m11'] != "0" && $row_select_pipe['m11'] != null) {		echo $row_select_pipe['m11'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m12'] != "" && $row_select_pipe['m12'] != "0" && $row_select_pipe['m12'] != null) {		echo $row_select_pipe['m12'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m13'] != "" && $row_select_pipe['m13'] != "0" && $row_select_pipe['m13'] != null) {		echo $row_select_pipe['m13'];	} else {		echo " <br>";	} ?></center></td>
						</tr>
						<tr>
						<td style="border: 1px solid black;"><center><b>2</b></center></td>
						<td style="border: 1px solid black;"><b>Weight of Mould in kg</b></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m21'] != "" && $row_select_pipe['m21'] != "0" && $row_select_pipe['m21'] != null) {		echo $row_select_pipe['m21'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m22'] != "" && $row_select_pipe['m22'] != "0" && $row_select_pipe['m22'] != null) {		echo $row_select_pipe['m22'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m23'] != "" && $row_select_pipe['m23'] != "0" && $row_select_pipe['m23'] != null) {		echo $row_select_pipe['m23'];	} else {		echo " <br>";	} ?></center></td>
						</tr>
						<tr>
						<td style="border: 1px solid black;"><center><b>3</b></center></td>
						<td style="border: 1px solid black;"><b>Weight of Material in kg</b></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m31'] != "" && $row_select_pipe['m31'] != "0" && $row_select_pipe['m31'] != null) {		echo $row_select_pipe['m31'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m32'] != "" && $row_select_pipe['m32'] != "0" && $row_select_pipe['m32'] != null) {		echo $row_select_pipe['m32'];	} else {		echo " <br>";	} ?></center></td>
						<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m33'] != "" && $row_select_pipe['m33'] != "0" && $row_select_pipe['m33'] != null) {		echo $row_select_pipe['m33'];	} else {		echo " <br>";	} ?></center></td>
						</tr>
						<tr>
						<td colspan="2" style="border: 1px solid black;text-align:right;"><b>Average</b></td>
					
						<td colspan="3" style="border: 1px solid black;"><center><?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {		echo $row_select_pipe['avg_wom'];		} else {		echo "&nbsp;";		} ?></center></td>
						
						</tr>
						
						</table>
						<table align="center" width="90%" class="test1" style="border: 2px solid black;border-top: 0px solid black;" height="Auto">
						<tr>
							<td colspan="4" style="border: 0px solid black;text-align:left;"><b>Sand condition at that time :-</b></td>
						
							<td colspan="4" style="border: 0px solid black;text-align:left;"><b>(Oven dry/S.S.D./Moisturized)</b></td>
						
						</tr>
						
						<tr>
							<td  style="border: 0px solid black;"><b>&nbsp;&nbsp; Bulk Density</b></td>
						
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;">Weight of Material <hr></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {		echo $row_select_pipe['avg_wom'];		} else {		echo "&nbsp;";		} ?><hr></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) {		echo $row_select_pipe['bdl'];		} else {		echo "&nbsp;";		} ?><hr></td>
							<td  style="border: 0px solid black;text-align:left;">kg/Lit.</td>
							
						</tr>
						<tr>
							<td  style="border: 0px solid black;"><b></b></td>
						
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;">Volume of Mould</td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['vol'] != "" && $row_select_pipe['vol'] != "0" && $row_select_pipe['vol'] != null) {		echo $row_select_pipe['vol'];		} else {		echo "&nbsp;";		} ?></td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:left;"></td>
							<td  style="border: 0px solid black;text-align:left;"></td>
							
						</tr>
						
						
					
					</table>
					
			
				
				
				
				<?php
				/*if(($row_select_pipe['imp_value']!="" && $row_select_pipe['imp_value']!="0" && $row_select_pipe['imp_value']!=null) || ($row_select_pipe['abr_index']!="" && $row_select_pipe['abr_index']!="0" && $row_select_pipe['abr_index']!=null) || ($row_select_pipe['cru_value']!="" && $row_select_pipe['cru_value']!="0" && $row_select_pipe['cru_value']!=null))
					{
						$pagecnt++;*/
				?>
					<div class="pagebreak"> </div>
				<br>
				<br>
			
				<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Coarse Aggregate</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>
			<br>
			<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="18.5%">
				<tr style="border: 1px solid black;height:20px;">
					<td colspan="2" style="border: 0px solid black;"><b>Test-5 Impact Test</b></td>
					<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-4</b></td>
				</tr>
			
			
				<tr>
				<td style="border: 1px solid black;width:5%;height:45px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:51%;"><center><b>Particular</b></center></td>
				<td style="border: 1px solid black;width:22%;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;width:22%;"><center><b>2</b></center></td>									
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;"><b>Total weight taken in mould in g (A)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_a_1'] != "" && $row_select_pipe['imp_w_m_a_1'] != "0" && $row_select_pipe['imp_w_m_a_1'] != null) {echo $row_select_pipe['imp_w_m_a_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['imp_w_m_a_2'] != "" && $row_select_pipe['imp_w_m_a_2'] != "0" && $row_select_pipe['imp_w_m_a_2'] != null) {				echo $row_select_pipe['imp_w_m_a_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>2</b></center></td>
				<td style="border: 1px solid black;"><b>Weight of material passing through IS sieve 2.36 mm in g (B)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_b_1'] != "" && $row_select_pipe['imp_w_m_b_1'] != "0" && $row_select_pipe['imp_w_m_b_1'] != null) {echo $row_select_pipe['imp_w_m_b_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['imp_w_m_b_2'] != "" && $row_select_pipe['imp_w_m_b_2'] != "0" && $row_select_pipe['imp_w_m_b_2'] != null) {				echo $row_select_pipe['imp_w_m_b_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>3</b></center></td>
				<td style="border: 1px solid black;"><b>Weight of material retained on IS sieve 2.36 mm in g (C)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_w_m_c_1'] != "" && $row_select_pipe['imp_w_m_c_1'] != "0" && $row_select_pipe['imp_w_m_c_1'] != null) {echo $row_select_pipe['imp_w_m_c_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['imp_w_m_c_2'] != "" && $row_select_pipe['imp_w_m_c_2'] != "0" && $row_select_pipe['imp_w_m_c_2'] != null) {				echo $row_select_pipe['imp_w_m_c_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>4</b></center></td>
				<td style="border: 1px solid black;"><b>Impact Value % = B/A x 100</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['imp_value_1'] != "" && $row_select_pipe['imp_value_1'] != "0" && $row_select_pipe['imp_value_1'] != null) {echo $row_select_pipe['imp_value_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['imp_value_2'] != "" && $row_select_pipe['imp_value_2'] != "0" && $row_select_pipe['imp_value_2'] != null) {				echo $row_select_pipe['imp_value_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average</b></td>
			
				<td colspan="2" style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null) {echo $row_select_pipe['imp_value'];} else {echo " <br>";} ?></center></td>
				
				</tr>
				
				</table>
				<br>
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="18.5%">
				<tr style="border: 1px solid black;height:20px;">
					<td colspan="2" style="border: 0px solid black;"><b>Test-6 Loss Angel Abrasion</b></td>
					<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-4</b></td>
				</tr>
			
			
				<tr>
				<td style="border: 1px solid black;width:5%;height:45px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:51%;height:15px;"><center><b>Particular</b></center></td>
				<td style="border: 1px solid black;width:22%;height:15px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;width:22%;height:15px;"><center><b>2</b></center></td>									
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Total weight taken in mould in g (A)</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_wt_t_a_1'] != "" && $row_select_pipe['abr_wt_t_a_1'] != "0" && $row_select_pipe['abr_wt_t_a_1'] != null) {echo $row_select_pipe['abr_wt_t_a_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_wt_t_a_2'] != "" && $row_select_pipe['abr_wt_t_a_2'] != "0" && $row_select_pipe['abr_wt_t_a_2'] != null) {echo $row_select_pipe['abr_wt_t_a_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>2</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of material retained on IS sieve in g(B)</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_wt_t_b_1'] != "" && $row_select_pipe['abr_wt_t_b_1'] != "0" && $row_select_pipe['abr_wt_t_b_1'] != null) {echo $row_select_pipe['abr_wt_t_b_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_wt_t_b_2'] != "" && $row_select_pipe['abr_wt_t_b_2'] != "0" && $row_select_pipe['abr_wt_t_b_2'] != null) {echo $row_select_pipe['abr_wt_t_b_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>3</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of material passing through IS sieve 1.70 mm C = A - B</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_wt_t_c_1'] != "" && $row_select_pipe['abr_wt_t_c_1'] != "0" && $row_select_pipe['abr_wt_t_c_1'] != null) {echo $row_select_pipe['abr_wt_t_c_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_wt_t_c_2'] != "" && $row_select_pipe['abr_wt_t_c_2'] != "0" && $row_select_pipe['abr_wt_t_c_2'] != null) {echo $row_select_pipe['abr_wt_t_c_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>4</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of material passing Abrasion % = C/A x 100</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_1'] != "" && $row_select_pipe['abr_1'] != "0" && $row_select_pipe['abr_1'] != null) {echo $row_select_pipe['abr_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_2'] != "" && $row_select_pipe['abr_2'] != "0" && $row_select_pipe['abr_2'] != null) {echo $row_select_pipe['abr_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average</b></td>
			
				<td colspan="2" style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null) {echo $row_select_pipe['abr_index'];	} else {echo " <br>";	} ?></center></td>
				
				</tr>
				
				</table>
				<br>
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="18.5%">
				<tr style="border: 1px solid black;">
					<td colspan="2" style="border: 0px solid black;height:20px;"><b>Test-7 Crushing Value</b></td>
					<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-4</b></td>
				</tr>
			
			
				<tr>
				<td style="border: 1px solid black;width:5%;height:45px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:51%;"><center><b>Particular</b></center></td>
				<td style="border: 1px solid black;width:22%;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;width:22%;"><center><b>2</b></center></td>									
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;"><b>Total weight taken in crushing mould in g (A)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cr_a_1'] != "" && $row_select_pipe['cr_a_1'] != "0" && $row_select_pipe['cr_a_1'] != null) {echo $row_select_pipe['cr_a_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['cr_a_2'] != "" && $row_select_pipe['cr_a_2'] != "0" && $row_select_pipe['cr_a_2'] != null) {				echo $row_select_pipe['cr_a_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>2</b></center></td>
				<td style="border: 1px solid black;"><b>Weight of material passing through IS sieve 2.36mm after crushing load applied in g (B)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cr_b_1'] != "" && $row_select_pipe['cr_b_1'] != "0" && $row_select_pipe['cr_b_1'] != null) {echo $row_select_pipe['cr_b_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['cr_b_2'] != "" && $row_select_pipe['cr_b_2'] != "0" && $row_select_pipe['cr_b_2'] != null) {				echo $row_select_pipe['cr_b_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>				
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>3</b></center></td>
				<td style="border: 1px solid black;"><b>Crushing Value % = B/A x 100</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cru_value_1'] != "" && $row_select_pipe['cru_value_1'] != "0" && $row_select_pipe['cru_value_1'] != null) {echo $row_select_pipe['cru_value_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['cru_value_2'] != "" && $row_select_pipe['cru_value_2'] != "0" && $row_select_pipe['cru_value_2'] != null) {				echo $row_select_pipe['cru_value_2'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average</b></td>
			
				<td colspan="2" style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null) {echo $row_select_pipe['cru_value'];} else {echo " <br>";} ?></center></td>
				
				</tr>
				
				</table>
				
				
				
				<?php

				/*}
					if($row_select_pipe['combined_index']!=""  && $row_select_pipe['combined_index']!="0" && $row_select_pipe['combined_index']!=null)
					{
						$pagecnt++;*/

				?>
				<div class="pagebreak"> </div>
				<div style=" transform: rotate(270deg) translate(-276mm, 0);
					transform-origin: 0 0;">
				<br>
				<br>
				
				<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Coarse Aggregate</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>
			<br>
			<table align="center" width="100%" class="test1" style="border: 2px solid black;" height="50%">				
				<tr style="border: 0px solid black;">
					<td colspan="8" style="border: 0px solid black;" ><b>Test - 8 Determination of Combined Flakiness Index &amp; Elongation Index</b> </td>					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;width:50%;"><center>FLEKINESS INDEX</center></td>
					<td colspan="4" style="border: 1px solid black;font-weight:bold;Width:50%;"><center>ELONGATION INDEX</center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;font-weight:bold;width:7%;"><center>Sr.No.</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:13%;"><center>Sieve Set</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center>Material Retained<br>on Sieve,(gm) A</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center>Material Passing<br>Through Thickness<br>Gauge,(gm), B</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:7%;"><center>Sr.No.</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:13%;"><center>Sieve Set</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center>Material Retained<br>Through Thickness<br>Gauge,(gm),D=A-B</center></td>
					<td  style="border: 1px solid black;font-weight:bold;width:15%;"><center>Material Retained<br>on Length<br>Gauge,(gm) C</center></td>
				
				</tr>
				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">1</td>
					<td style="border: 1px solid black;">63-50</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a1'] != ""  && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {echo $row_select_pipe['a1'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b1'] != ""  && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {echo $row_select_pipe['b1'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">1</td>
					<td style="border: 1px solid black;">--</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa1'] != ""  && $row_select_pipe['aa1'] != "0" && $row_select_pipe['aa1'] != null) {echo $row_select_pipe['aa1'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd1'] != ""  && $row_select_pipe['dd1'] != "0" && $row_select_pipe['dd1'] != null) {echo $row_select_pipe['dd1'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">2</td>
					<td style="border: 1px solid black;">50-40</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a2'] != ""  && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {echo $row_select_pipe['a2'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b2'] != ""  && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {echo $row_select_pipe['b2'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">2</td>
					<td style="border: 1px solid black;">50-40</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa2'] != ""  && $row_select_pipe['aa2'] != "0" && $row_select_pipe['aa2'] != null) {echo $row_select_pipe['aa2'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd2'] != ""  && $row_select_pipe['dd2'] != "0" && $row_select_pipe['dd2'] != null) {echo $row_select_pipe['dd2'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">3</td>
					<td style="border: 1px solid black;">40-31.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a3'] != ""  && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {echo $row_select_pipe['a3'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b3'] != ""  && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {echo $row_select_pipe['b3'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">3</td>
					<td style="border: 1px solid black;">40-31.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa3'] != ""  && $row_select_pipe['aa3'] != "0" && $row_select_pipe['aa3'] != null) {echo $row_select_pipe['aa3'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd3'] != ""  && $row_select_pipe['dd3'] != "0" && $row_select_pipe['dd3'] != null) {echo $row_select_pipe['dd3'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">4</td>
					<td style="border: 1px solid black;">31.5-25</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a4'] != ""  && $row_select_pipe['a4'] != "0" && $row_select_pipe['a4'] != null) {echo $row_select_pipe['a4'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b4'] != ""  && $row_select_pipe['b4'] != "0" && $row_select_pipe['b4'] != null) {echo $row_select_pipe['b4'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">4</td>
					<td style="border: 1px solid black;">31.5-25</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa4'] != ""  && $row_select_pipe['aa4'] != "0" && $row_select_pipe['aa4'] != null) {echo $row_select_pipe['aa4'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd4'] != ""  && $row_select_pipe['dd4'] != "0" && $row_select_pipe['dd4'] != null) {echo $row_select_pipe['dd4'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">5</td>
					<td style="border: 1px solid black;">25-20</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a5'] != ""  && $row_select_pipe['a5'] != "0" && $row_select_pipe['a5'] != null) {echo $row_select_pipe['a5'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b5'] != ""  && $row_select_pipe['b5'] != "0" && $row_select_pipe['b5'] != null) {echo $row_select_pipe['b5'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">5</td>
					<td style="border: 1px solid black;">25-20</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa5'] != ""  && $row_select_pipe['aa5'] != "0" && $row_select_pipe['aa5'] != null) {echo $row_select_pipe['aa5'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd5'] != ""  && $row_select_pipe['dd5'] != "0" && $row_select_pipe['dd5'] != null) {echo $row_select_pipe['dd5'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">6</td>
					<td style="border: 1px solid black;">20-16</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a6'] != ""  && $row_select_pipe['a6'] != "0" && $row_select_pipe['a6'] != null) {echo $row_select_pipe['a6'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b6'] != ""  && $row_select_pipe['b6'] != "0" && $row_select_pipe['b6'] != null) {echo $row_select_pipe['b6'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">6</td>
					<td style="border: 1px solid black;">20-16</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa6'] != ""  && $row_select_pipe['aa6'] != "0" && $row_select_pipe['aa6'] != null) {echo $row_select_pipe['aa6'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd6'] != ""  && $row_select_pipe['dd6'] != "0" && $row_select_pipe['dd6'] != null) {echo $row_select_pipe['dd6'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">7</td>
					<td style="border: 1px solid black;">16-12.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a7'] != ""  && $row_select_pipe['a7'] != "0" && $row_select_pipe['a7'] != null) {echo $row_select_pipe['a7'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b7'] != ""  && $row_select_pipe['b7'] != "0" && $row_select_pipe['b7'] != null) {echo $row_select_pipe['b7'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">7</td>
					<td style="border: 1px solid black;">16-12.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa7'] != ""  && $row_select_pipe['aa7'] != "0" && $row_select_pipe['aa7'] != null) {echo $row_select_pipe['aa7'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd7'] != ""  && $row_select_pipe['dd7'] != "0" && $row_select_pipe['dd7'] != null) {echo $row_select_pipe['dd7'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">8</td>
					<td style="border: 1px solid black;">12.5-10</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a8'] != ""  && $row_select_pipe['a8'] != "0" && $row_select_pipe['a8'] != null) {echo $row_select_pipe['a8'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b8'] != ""  && $row_select_pipe['b8'] != "0" && $row_select_pipe['b8'] != null) {echo $row_select_pipe['b8'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">8</td>
					<td style="border: 1px solid black;">12.5-10</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa8'] != ""  && $row_select_pipe['aa8'] != "0" && $row_select_pipe['aa8'] != null) {echo $row_select_pipe['aa8'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd8'] != ""  && $row_select_pipe['dd8'] != "0" && $row_select_pipe['dd8'] != null) {echo $row_select_pipe['dd8'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">9</td>
					<td style="border: 1px solid black;">10-6.3</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a9'] != ""  && $row_select_pipe['a9'] != "0" && $row_select_pipe['a9'] != null) {echo $row_select_pipe['a9'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b9'] != ""  && $row_select_pipe['b9'] != "0" && $row_select_pipe['b9'] != null) {echo $row_select_pipe['b9'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">9</td>
					<td style="border: 1px solid black;">10-6.3</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa9'] != ""  && $row_select_pipe['aa9'] != "0" && $row_select_pipe['aa9'] != null) {echo $row_select_pipe['aa9'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd9'] != ""  && $row_select_pipe['dd9'] != "0" && $row_select_pipe['dd9'] != null) {echo $row_select_pipe['dd9'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td colspan="2" style="border: 1px solid black;font-weight:bold;">Total</td>					
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['suma'] != ""  && $row_select_pipe['suma'] != "0" && $row_select_pipe['suma'] != null) {echo $row_select_pipe['suma'];} else {echo " <br>";} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sumb'] != ""  && $row_select_pipe['sumb'] != "0" && $row_select_pipe['sumb'] != null) {echo $row_select_pipe['sumb'];} else {echo " <br>";} ?></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;">Total</td>		
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sumaa'] != ""  && $row_select_pipe['sumaa'] != "0" && $row_select_pipe['sumaa'] != null) {echo $row_select_pipe['sumaa'];} else {echo " <br>";}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sumdd'] != ""  && $row_select_pipe['sumdd'] != "0" && $row_select_pipe['sumdd'] != null) {echo $row_select_pipe['sumdd'];} else {echo " <br>";}  ?></td>
					
				</tr>
				<tr style="border: 1px solid black;text-align:center;">
					<td colspan="3" style="border: 1px solid black;font-weight:bold;width:50%;"><center>Flakiness Index = 100*B/A, (%)</center></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['fi_index'] != ""  && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null) {echo $row_select_pipe['fi_index'];} else {echo " <br>";} ?></td>
					<td colspan="3" style="border: 1px solid black;font-weight:bold;Width:50%;"><center>Elongation Index = 100*C/D, (%)</center></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ei_index'] != ""  && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null) {echo $row_select_pipe['ei_index'];} else {echo " <br>";} ?></td>
					
				</tr>
				<tr style="border: 1px solid black;text-align:center;">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;width:50%;"><center></center></td>
					
					<td colspan="3" style="border: 1px solid black;font-weight:bold;Width:50%;"><center>Combined Index = F.I. + E.I. (%)</center></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['combined_index'] != ""  && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null) {echo $row_select_pipe['combined_index'];} else {echo " <br>";} ?></td>
					
				</tr>
				
				
				
			</table>
			
			</div>
				
				
				
				<?php

				/*	}
					if(($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null) || ($row_select_pipe['fines_value']!="" && $row_select_pipe['fines_value']!="0" && $row_select_pipe['fines_value']!=null))
					{
						$pagecnt++;*/

				?>
				<div class="pagebreak"> </div>
				
				<br>
				<br>
				<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Coarse Aggregate</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>
			<br-->

		<!-- <table align="center" width="90%" class="test1" style="border: 2px solid black;" height="40%">
			<tr style="border: 0px solid black;">
				<td style="border: 0px solid black;border-right: 1px solid black;"><b>Test - 1</b></td>
				<td colspan="3" style="border: 0px solid black;"><b>Soundness</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-5</b></td>
			</tr>

			<tr style="border: 1px solid black;font-weight:bold;">
				<td colspan="2" style="border: 1px solid black;">
					<center>Sieve Size</center>
				</td>
				<td style="border: 1px solid black;width:16%;" rowspan="2">
					<center>Grading of <br> Original <br> sample percent</center>
				</td>
				<td style="border: 1px solid black;width:20%;" rowspan="2">
					<center>Weight of test <br> fractions before test</center>
				</td>
				<td style="border: 1px solid black;width:16%;" rowspan="2">
					<center>Percentage passing <br> finer sieve after test <br> (Actual Percentage loss)</center>
				</td>
				<td style="border: 1px solid black;width:16%;" rowspan="2">
					<center>Weighted average <br> (corrected percent <br> loss)</center>
				</td>

			</tr>
			<tr style="text-align:center;font-weight:bold;">
				<td style="border: 1px solid black;font-weight:bold;width:16%;">Passing</td>
				<td style="border: 1px solid black;font-weight:bold;width:16%;">Retained</td>


			</tr>
			<tr style="border: 1px solid black;font-weight:bold;">
				<td style="border: 1px solid black;">
					<center>1</center>
				</td>
				<td style="border: 1px solid black;">
					<center>2</center>
				</td>
				<td style="border: 1px solid black;">
					<center>3</center>
				</td>
				<td style="border: 1px solid black;">
					<center>4</center>
				</td>
				<td style="border: 1px solid black;">
					<center>5</center>
				</td>
				<td style="border: 1px solid black;">
					<center>6</center>
				</td>

			</tr>
			<tr style="text-align:center">
				<td colspan="6" style="border: 1px solid black;font-weight:bold;">Soundness Test for Coarse Aggregate</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>63 MM</b></td>
				<td style="border: 1px solid black;"><b>40 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s31'] != "" && $row_select_pipe['s31'] != "0" && $row_select_pipe['s31'] != null) {
								echo $row_select_pipe['s31'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s41'] != "" && $row_select_pipe['s41'] != "0" && $row_select_pipe['s41'] != null) {
								echo $row_select_pipe['s41'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s51'] != "" && $row_select_pipe['s51'] != "0" && $row_select_pipe['s51'] != null) {
								echo $row_select_pipe['s51'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s61'] != "" && $row_select_pipe['s61'] != "0" && $row_select_pipe['s61'] != null) {
								echo $row_select_pipe['s61'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>63 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>50 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s32'] != "" && $row_select_pipe['s32'] != "0" && $row_select_pipe['s32'] != null) {
								echo $row_select_pipe['s32'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s42'] != "" && $row_select_pipe['s42'] != "0" && $row_select_pipe['s42'] != null) {
								echo $row_select_pipe['s42'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s52'] != "" && $row_select_pipe['s52'] != "0" && $row_select_pipe['s52'] != null) {
								echo $row_select_pipe['s52'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s62'] != "" && $row_select_pipe['s62'] != "0" && $row_select_pipe['s62'] != null) {
								echo $row_select_pipe['s62'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>50 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>40 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s33'] != "" && $row_select_pipe['s33'] != "0" && $row_select_pipe['s33'] != null) {
								echo $row_select_pipe['s33'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s43'] != "" && $row_select_pipe['s43'] != "0" && $row_select_pipe['s43'] != null) {
								echo $row_select_pipe['s43'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s53'] != "" && $row_select_pipe['s53'] != "0" && $row_select_pipe['s53'] != null) {
								echo $row_select_pipe['s53'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s63'] != "" && $row_select_pipe['s63'] != "0" && $row_select_pipe['s63'] != null) {
								echo $row_select_pipe['s63'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>40 MM</b></td>
				<td style="border: 1px solid black;"><b>20 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s34'] != "" && $row_select_pipe['s34'] != "0" && $row_select_pipe['s34'] != null) {
								echo $row_select_pipe['s34'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s44'] != "" && $row_select_pipe['s44'] != "0" && $row_select_pipe['s44'] != null) {
								echo $row_select_pipe['s44'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s54'] != "" && $row_select_pipe['s54'] != "0" && $row_select_pipe['s54'] != null) {
								echo $row_select_pipe['s54'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s64'] != "" && $row_select_pipe['s64'] != "0" && $row_select_pipe['s64'] != null) {
								echo $row_select_pipe['s64'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>40 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>25 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s35'] != "" && $row_select_pipe['s35'] != "0" && $row_select_pipe['s35'] != null) {
								echo $row_select_pipe['s35'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s45'] != "" && $row_select_pipe['s45'] != "0" && $row_select_pipe['s45'] != null) {
								echo $row_select_pipe['s45'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s55'] != "" && $row_select_pipe['s55'] != "0" && $row_select_pipe['s55'] != null) {
								echo $row_select_pipe['s55'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s65'] != "" && $row_select_pipe['s65'] != "0" && $row_select_pipe['s65'] != null) {
								echo $row_select_pipe['s65'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>25 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>20 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s36'] != "" && $row_select_pipe['s36'] != "0" && $row_select_pipe['s36'] != null) {
								echo $row_select_pipe['s36'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s46'] != "" && $row_select_pipe['s46'] != "0" && $row_select_pipe['s46'] != null) {
								echo $row_select_pipe['s46'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s56'] != "" && $row_select_pipe['s56'] != "0" && $row_select_pipe['s56'] != null) {
								echo $row_select_pipe['s56'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s66'] != "" && $row_select_pipe['s66'] != "0" && $row_select_pipe['s66'] != null) {
								echo $row_select_pipe['s66'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>20 MM</b></td>
				<td style="border: 1px solid black;"><b>10 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s37'] != "" && $row_select_pipe['s37'] != "0" && $row_select_pipe['s37'] != null) {
								echo $row_select_pipe['s37'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s47'] != "" && $row_select_pipe['s47'] != "0" && $row_select_pipe['s47'] != null) {
								echo $row_select_pipe['s47'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s57'] != "" && $row_select_pipe['s57'] != "0" && $row_select_pipe['s57'] != null) {
								echo $row_select_pipe['s57'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s67'] != "" && $row_select_pipe['s67'] != "0" && $row_select_pipe['s67'] != null) {
								echo $row_select_pipe['s67'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>20 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>12.5 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s38'] != "" && $row_select_pipe['s38'] != "0" && $row_select_pipe['s38'] != null) {
								echo $row_select_pipe['s38'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s48'] != "" && $row_select_pipe['s48'] != "0" && $row_select_pipe['s48'] != null) {
								echo $row_select_pipe['s48'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s58'] != "" && $row_select_pipe['s58'] != "0" && $row_select_pipe['s58'] != null) {
								echo $row_select_pipe['s58'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s68'] != "" && $row_select_pipe['s68'] != "0" && $row_select_pipe['s68'] != null) {
								echo $row_select_pipe['s68'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>12.5 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>10 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s39'] != "" && $row_select_pipe['s39'] != "0" && $row_select_pipe['s39'] != null) {
								echo $row_select_pipe['s39'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s49'] != "" && $row_select_pipe['s49'] != "0" && $row_select_pipe['s49'] != null) {
								echo $row_select_pipe['s49'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s59'] != "" && $row_select_pipe['s59'] != "0" && $row_select_pipe['s59'] != null) {
								echo $row_select_pipe['s59'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s69'] != "" && $row_select_pipe['s69'] != "0" && $row_select_pipe['s69'] != null) {
								echo $row_select_pipe['s69'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>10 MM</b></td>
				<td style="border: 1px solid black;"><b>4.75 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s30'] != "" && $row_select_pipe['s30'] != "0" && $row_select_pipe['s30'] != null) {
								echo $row_select_pipe['s30'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s40'] != "" && $row_select_pipe['s40'] != "0" && $row_select_pipe['s40'] != null) {
								echo $row_select_pipe['s40'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s60'] != "" && $row_select_pipe['s60'] != "0" && $row_select_pipe['s60'] != null) {
								echo $row_select_pipe['s60'];
	} else {
								echo " <br>";
	} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s60'] != "" && $row_select_pipe['s60'] != "0" && $row_select_pipe['s60'] != null) {
								echo $row_select_pipe['s60'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>Total</b></td>
				<td style="border: 1px solid black;"><b></b></td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s6total'] != "" && $row_select_pipe['s6total'] != "0" && $row_select_pipe['s6total'] != null) {
								echo $row_select_pipe['s6total'];
	} else {
								echo " <br>";
	} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;">Results :- Soundness</td>
				<td colspan="3" style="border: 0px solid black;"> <?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {	echo $row_select_pipe['soundness'];} else {	echo " <br>";} ?> %</td>


			</tr>

			<br>
			<br>
		</table> -->

		<!--br>
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="20%">
				<tr style="border: 1px solid black;height:20px;">
					<td colspan="2" style="border: 0px solid black;"><b>Test-10 10% Fine Value</b></td>
					<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-4</b></td>
				</tr>
			
			
				<tr>
				<td style="border: 1px solid black;width:5%;height:45px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:51%;height:15px;"><center><b>Particular</b></center></td>
				<td style="border: 1px solid black;width:22%;height:15px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;width:22%;height:15px;"><center><b>2</b></center></td>									
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of Sample taken in Mould in gm (A)</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['f_a_1'] != "" && $row_select_pipe['f_a_1'] != "0" && $row_select_pipe['f_a_1'] != null) {echo $row_select_pipe['f_a_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['f_a_2'] != "" && $row_select_pipe['f_a_2'] != "0" && $row_select_pipe['f_a_2'] != null) {echo $row_select_pipe['f_a_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>2</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of Sample after Penetration, passing through 2.36 mm IS Sieve in gm (B)</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['f_c_1'] != "" && $row_select_pipe['f_c_1'] != "0" && $row_select_pipe['f_c_1'] != null) {echo $row_select_pipe['f_c_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['f_c_2'] != "" && $row_select_pipe['f_c_2'] != "0" && $row_select_pipe['f_c_2'] != null) {echo $row_select_pipe['f_c_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>3</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Percentage of Passing Y=(B/A)X100</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['f_d_1'] != "" && $row_select_pipe['f_d_1'] != "0" && $row_select_pipe['f_d_1'] != null) {echo $row_select_pipe['f_d_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['f_d_2'] != "" && $row_select_pipe['f_d_2'] != "0" && $row_select_pipe['f_d_2'] != null) {echo $row_select_pipe['f_d_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:15px;"><center><b>4</b></center></td>
				<td style="border: 1px solid black;height:15px;"><b>Load in KN (X)</b></td>
				<td style="border: 1px solid black;height:15px;"><center><?php if ($row_select_pipe['f_b_1'] != "" && $row_select_pipe['f_b_1'] != "0" && $row_select_pipe['f_b_1'] != null) {echo $row_select_pipe['f_b_1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['f_b_2'] != "" && $row_select_pipe['f_b_2'] != "0" && $row_select_pipe['f_b_2'] != null) {echo $row_select_pipe['f_b_2'];} else {echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average Value Percentage of Passing (Y)</b></td>
			
				<td colspan="2" style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['avg_f_d'] != "" && $row_select_pipe['avg_f_d'] != "0" && $row_select_pipe['avg_f_d'] != null) {echo $row_select_pipe['avg_f_d'];	} else {echo " <br>";	} ?></center></td>
				
				</tr>
				<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average Value of Load (X)</b></td>
			
				<td colspan="2" style="border: 1px solid black;border-right: 2px solid black;height:15px;"><center><?php if ($row_select_pipe['avg_f_c'] != "" && $row_select_pipe['avg_f_c'] != "0" && $row_select_pipe['avg_f_c'] != null) {echo $row_select_pipe['avg_f_c'];	} else {echo " <br>";	} ?></center></td>
				
				</tr>
				
				</table>
				<table align="center" width="90%" class="test1" style="border: 2px solid black;border-top: 0px solid black;" height="Auto">
						<tr>
							<td colspan="8" style="border: 0px solid black;text-align:left;font-size:10px;"><b>Note :- A repeat test shall be run if the load does not produce % of fines within tha range 7.5 to 12.5.</b></td>
						
							
						</tr>
						
						<tr>
							<td  style="border: 0px solid black;text-align:right;"><b>&nbsp;&nbsp; 10 % Fine Value</b></td>
						
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;">14&nbsp;&nbsp;&nbsp;&nbsp; x&nbsp;&nbsp; &nbsp;&nbsp; X <hr></td>
							<td  style="border: 0px solid black;text-align:right;">=</td>
							<td  style="border: 0px solid black;text-align:center;">14&nbsp;&nbsp; &nbsp;&nbsp;x&nbsp;&nbsp; &nbsp;&nbsp; <?php if ($row_select_pipe['avg_f_c'] != "" && $row_select_pipe['avg_f_c'] != "0" && $row_select_pipe['avg_f_c'] != null) {						echo $row_select_pipe['avg_f_c'];			} else {						echo "&nbsp;";			} ?><hr></td>
							<td  style="border: 0px solid black;text-align:center;">=</td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null) {		echo $row_select_pipe['fines_value'];		} else {		echo "&nbsp;";		} ?></td>
							<td  style="border: 0px solid black;text-align:left;">KN</td>
							
						</tr>
						<tr>
							<td  style="border: 0px solid black;"><b></b></td>
						
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;">Y&nbsp;&nbsp; &nbsp;&nbsp; +&nbsp;&nbsp; &nbsp;&nbsp; 4</td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['avg_f_d'] != "" && $row_select_pipe['avg_f_d'] != "0" && $row_select_pipe['avg_f_d'] != null) {		echo $row_select_pipe['avg_f_d'];		} else {		echo "&nbsp;";		} ?>&nbsp;&nbsp; &nbsp;&nbsp; +&nbsp;&nbsp; &nbsp;&nbsp; 4</td>
							<td  style="border: 0px solid black;text-align:center;"></td>
							<td  style="border: 0px solid black;text-align:left;"></td>
							<td  style="border: 0px solid black;text-align:left;"></td>
							
						</tr>
						
						
					
					</table>
			
			
					
					
					
			
			<?php

			/*}
					if($row_select_pipe['alk_10']!="" && $row_select_pipe['alk_10']!="0" && $row_select_pipe['alk_10']!=null)
					{
						$pagecnt++;*/

			?>
			<div class="pagebreak"> </div>
			<Br>
			<br>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Coarse Aggregate</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>
			<br>	
			<table align="center" width="95%" class="test1" style="border: 2px solid black;" height="18.5%">
				<tr style="border: 1px solid black;height:20px;">
					<td colspan="2" style="border: 0px solid black;"><b>Test-11 Alkali Reactivity</b></td>
					<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-7</b></td>
				</tr>
			
			
				<tr>
				<td style="border: 1px solid black;width:5%;height:20px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:51%;"><center><b>Sc Observed</b></center></td>
				<td style="border: 1px solid black;width:22%;"><center><b>Weight W1</b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;width:22%;"><center><b>Weight W2</b></center></td>									
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:55px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;"><b><center><?php if ($row_select_pipe['alk_1'] != "" && $row_select_pipe['alk_1'] != "0" && $row_select_pipe['alk_1'] != null) {echo $row_select_pipe['alk_1'];} else {echo " <br>";} ?></center></b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['alk_2'] != "" && $row_select_pipe['alk_2'] != "0" && $row_select_pipe['alk_2'] != null) {echo $row_select_pipe['alk_2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['alk_3'] != "" && $row_select_pipe['alk_3'] != "0" && $row_select_pipe['alk_3'] != null) {				echo $row_select_pipe['alk_3'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:55px;"><center><b>Sc = W1 - W2&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;3330 = </b><?php echo $row_select_pipe['alk_4'] . "  "; ?><b>milli mol/Lit.</b></center></td>
					
				</tr>
				<tr>
				<td style="border: 1px solid black;width:5%;height:20px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:51%;"><center><b>V1(ml)</b></center></td>
				<td style="border: 1px solid black;width:22%;"><center><b>V2 (ml)</b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;width:22%;"><center><b>V3 (ml)</b></center></td>									
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:55px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;"><center><b><?php if ($row_select_pipe['alk_5'] != "" && $row_select_pipe['alk_5'] != "0" && $row_select_pipe['alk_5'] != null) {echo $row_select_pipe['alk_5'];} else {echo " <br>";} ?></b></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['alk_6'] != "" && $row_select_pipe['alk_6'] != "0" && $row_select_pipe['alk_6'] != null) {echo $row_select_pipe['alk_6'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['alk_7'] != "" && $row_select_pipe['alk_7'] != "0" && $row_select_pipe['alk_7'] != null) {				echo $row_select_pipe['alk_7'];} else {				echo " <br>";} ?></center></td>				
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:55px;"><center><b>Rc = (20 x N (V2 - V3) x 1000)/V1 &nbsp; = </b><?php if ($row_select_pipe['alk_8'] != "" && $row_select_pipe['alk_8'] != "0" && $row_select_pipe['alk_8'] != null) {					echo $row_select_pipe['alk_8'] . "  ";		} else {					echo " <br>";		} ?><b>milli mol/Lit.</b></center></td>
					
				</tr>
				</table>
				<table align="center" width="95%" class="test1" style="border: 2px solid black;" height="18.5%">
				<tr>
				<td style="border: 1px solid black;width:5%;height:20px;"><center><b>Sr.<br>No.</b></center></td>
				<td style="border: 1px solid black;width:47.5%;"><center><b>Sc/Rc/Ratio</b></center></td>
				<td style="border: 1px solid black;width:47.5%;border-right: 2px solid black;"><center><b>Aggregate</b></center></td>

													
				
				</tr>
				<tr>
				<td style="border: 1px solid black;height:55px;"><center><b>1</b></center></td>
				<td style="border: 1px solid black;"><center><b><?php if ($row_select_pipe['alk_9'] != "" && $row_select_pipe['alk_9'] != "0" && $row_select_pipe['alk_9'] != null) {echo $row_select_pipe['alk_9'];} else {echo " <br>";} ?></b></center></td>
				<td style="border: 1px solid black;border-right: 2px solid black;"><center><?php if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0" && $row_select_pipe['alk_10'] != null) {				echo $row_select_pipe['alk_10'];} else {				echo " <br>";} ?></center></td>						
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:55px;"><center><b>Ratio = Sc / Rc = </b><?php if ($row_select_pipe['alk_11'] != "" && $row_select_pipe['alk_11'] != "0" && $row_select_pipe['alk_11'] != null) {		echo $row_select_pipe['alk_11'];} else {		echo " <br>";} ?></center></td>
					
				</tr>
				
				
				</table>
				<br>
				<br>
				<br>
				<br>
				<table align="center" width="95%" class="test1" style="" height="Auto">
						<tr>
							<td style="border: 0px solid black;height:20px"><b>R<sub>c</sub></b></td>
							<td style="border: 0px solid black;height:20px"><b>=</b></td>
							<td style="border: 0px solid black;height:20px">The Reduction In Alkalinity, In Millimoles Per Liter.</td>
							
						</tr>
						<tr>
							<td style="border: 0px solid black;height:20px"><b>N</b></td>
							<td style="border: 0px solid black;height:20px"><b>=</b></td>
							<td style="border: 0px solid black;height:20px">Normality Of The Hydrochloric acid Used for the titretion.</td>
							
						</tr>
						<tr>
							<td style="border: 0px solid black;height:20px"><b>V<sub>1</sub></b></td>
							<td style="border: 0px solid black;height:20px"><b>=</b></td>
							<td style="border: 0px solid black;height:20px">Volume in ml of dilute solution.</td>
							
						</tr>
						<tr>
							<td style="border: 0px solid black;height:20px"><b>V<sub>2</sub></b></td>
							<td style="border: 0px solid black;height:20px"><b>=</b></td>
							<td style="border: 0px solid black;height:20px">Volume of Hydrochloric acid in ml used to attain the phenolphthalein end point in the test sample.</td>
							
						</tr>
						<tr>
							<td style="border: 0px solid black;height:20px"><b>V<sub>3</sub></b></td>
							<td style="border: 0px solid black;height:20px"><b>=</b></td>
							<td style="border: 0px solid black;height:20px">Volume of Hydrochloric acid in ml used to attain the phenolphthalein end point in the test Blank.</td>
							
						</tr>
				</table>
				
				
				<?php

				/*}
					if($row_select_pipe['liquide_limit']!="" && $row_select_pipe['liquide_limit']!="0" && $row_select_pipe['liquide_limit']!=null)
					{
						$pagecnt++;*/
				?>
				<div class="pagebreak"> </div>
				<Br>
				<br>
				<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black;">
				<tr >
					<td  rowspan="6" style="height:50px;width:175px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:100%;width:100%"></td>
					<td rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>GOMA ENGINEERING AND CONSULTANCY</b></center></td>					
					<td style="border: 1px solid black;">&nbsp;&nbsp;Doc. No.</td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp;F/7.5/09</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;1</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Issue Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;01/04/19</td>
				</tr>
				<tr >
									
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend No.</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;0</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;Amend Date :</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp;-</td>
				</tr>
				<tr >
					
					<td  rowspan="3" style="font-size:16px;border: 1px solid black;"><center><b>Coarse Aggregate</b></center></td>					
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Prepared & Issued By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Quality Manager</td>					
				</tr>
				<tr >
					
										
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;Reviewed & Apporved By</td>
					<td colspan="2"style="border: 1px solid black;">&nbsp;&nbsp;CEO</td>					
				</tr>                             
				<tr >													
					<td colspan="4"style="border: 1px solid black;">&nbsp;&nbsp;Controlled Document</td>					
				</tr>
				
			</table>
				<br>
				<table align="center" width="90%" class="test1" style="border: 2px solid black;" height="Auto">
				<tr style="border: 1px solid black;height:20px;">
					<td colspan="8" style="border: 0px solid black;"><b>Test-12 Determination of Liquid Limit (Using Cone Penetraton Apparatus) and Plastic Limit - IS 2720 (Part 5) : 1985 Clause 6 &amp; 7 (One Point Method)</b></td>					
				</tr>
				<tr style="border: 1px solid black;height:20px;">
					<td colspan="8" style="border: 0px solid black;"><b>Sample Passing Through 425 Micron IS Sieve</b></td>					
				</tr>
			
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><center><b>Sample Weight about        >>   150 gm</b></center></td>
				<td colspan="4" style="border: 1px solid black;height:20px;"><center><b>Period of Soaking Before Test       >>   24 Hrs</b></center></td>									
				
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> </b></td>
				<td colspan="2" style="border: 1px solid black;"><b><center>Liquid Limit</center></b></td>
				<td colspan="2" style="border: 1px solid black;"><b><center>Plastic Limit</center></b></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Determination No.</b></td>
				<td style="border: 1px solid black;"><b><center>1</center></b></td>
				<td style="border: 1px solid black;"><b><center>2</center></b></td>
				<td style="border: 1px solid black;"><b><center>1</center></b></td>
				<td style="border: 1px solid black;"><b><center>2</center></b></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> No. of Penetration (D) (mm)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pen1'] != "" && $row_select_pipe['pen1'] != "0" && $row_select_pipe['pen1'] != null) {echo $row_select_pipe['pen1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pen2'] != "" && $row_select_pipe['pen2'] != "0" && $row_select_pipe['pen2'] != null) {echo $row_select_pipe['pen2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pen3'] != "" && $row_select_pipe['pen3'] != "0" && $row_select_pipe['pen3'] != null) {echo $row_select_pipe['pen3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['pen4'] != "" && $row_select_pipe['pen4'] != "0" && $row_select_pipe['pen4'] != null) {echo $row_select_pipe['pen4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Container No.</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cont1'] != "" && $row_select_pipe['cont1'] != "0" && $row_select_pipe['cont1'] != null) {echo $row_select_pipe['cont1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cont2'] != "" && $row_select_pipe['cont2'] != "0" && $row_select_pipe['cont2'] != null) {echo $row_select_pipe['cont2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cont3'] != "" && $row_select_pipe['cont3'] != "0" && $row_select_pipe['cont3'] != null) {echo $row_select_pipe['cont3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['cont4'] != "" && $row_select_pipe['cont4'] != "0" && $row_select_pipe['cont4'] != null) {echo $row_select_pipe['cont4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Weight of Container + Wet Sample (gm)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wc1'] != "" && $row_select_pipe['wc1'] != "0" && $row_select_pipe['wc1'] != null) {echo $row_select_pipe['wc1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wc2'] != "" && $row_select_pipe['wc2'] != "0" && $row_select_pipe['wc2'] != null) {echo $row_select_pipe['wc2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wc3'] != "" && $row_select_pipe['wc3'] != "0" && $row_select_pipe['wc3'] != null) {echo $row_select_pipe['wc3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wc4'] != "" && $row_select_pipe['wc4'] != "0" && $row_select_pipe['wc4'] != null) {echo $row_select_pipe['wc4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Weight of Container + Oven Dry Sample (gm)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['od1'] != "" && $row_select_pipe['od1'] != "0" && $row_select_pipe['od1'] != null) {echo $row_select_pipe['od1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['od2'] != "" && $row_select_pipe['od2'] != "0" && $row_select_pipe['od2'] != null) {echo $row_select_pipe['od2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['od3'] != "" && $row_select_pipe['od3'] != "0" && $row_select_pipe['od3'] != null) {echo $row_select_pipe['od3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['od4'] != "" && $row_select_pipe['od4'] != "0" && $row_select_pipe['od4'] != null) {echo $row_select_pipe['od4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Weight of Water (gm)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ww1'] != "" && $row_select_pipe['ww1'] != "0" && $row_select_pipe['ww1'] != null) {echo $row_select_pipe['ww1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ww2'] != "" && $row_select_pipe['ww2'] != "0" && $row_select_pipe['ww2'] != null) {echo $row_select_pipe['ww2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ww3'] != "" && $row_select_pipe['ww3'] != "0" && $row_select_pipe['ww3'] != null) {echo $row_select_pipe['ww3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ww4'] != "" && $row_select_pipe['ww4'] != "0" && $row_select_pipe['ww4'] != null) {echo $row_select_pipe['ww4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Weight of Container (gm)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wf1'] != "" && $row_select_pipe['wf1'] != "0" && $row_select_pipe['wf1'] != null) {echo $row_select_pipe['wf1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wf2'] != "" && $row_select_pipe['wf2'] != "0" && $row_select_pipe['wf2'] != null) {echo $row_select_pipe['wf2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wf3'] != "" && $row_select_pipe['wf3'] != "0" && $row_select_pipe['wf3'] != null) {echo $row_select_pipe['wf3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['wf3'] != "" && $row_select_pipe['wf3'] != "0" && $row_select_pipe['wf3'] != null) {echo $row_select_pipe['wf3'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Weight of Oven Dry Sample (gm)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ds1'] != "" && $row_select_pipe['ds1'] != "0" && $row_select_pipe['ds1'] != null) {echo $row_select_pipe['ds1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ds2'] != "" && $row_select_pipe['ds2'] != "0" && $row_select_pipe['ds2'] != null) {echo $row_select_pipe['ds2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ds3'] != "" && $row_select_pipe['ds3'] != "0" && $row_select_pipe['ds3'] != null) {echo $row_select_pipe['ds3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ds4'] != "" && $row_select_pipe['ds4'] != "0" && $row_select_pipe['ds4'] != null) {echo $row_select_pipe['ds4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Moisture % (W<sub>N</sub>)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['mo1'] != "" && $row_select_pipe['mo1'] != "0" && $row_select_pipe['mo1'] != null) {echo $row_select_pipe['mo1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['mo2'] != "" && $row_select_pipe['mo2'] != "0" && $row_select_pipe['mo2'] != null) {echo $row_select_pipe['mo2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['mo3'] != "" && $row_select_pipe['mo3'] != "0" && $row_select_pipe['mo3'] != null) {echo $row_select_pipe['mo3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['mo4'] != "" && $row_select_pipe['mo4'] != "0" && $row_select_pipe['mo4'] != null) {echo $row_select_pipe['mo4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Moisture % (W<sub>L</sub>) = (W<sub>N</sub>)/(0.65 + 0.0175 D)</b></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ln1'] != "" && $row_select_pipe['ln1'] != "0" && $row_select_pipe['ln1'] != null) {echo $row_select_pipe['ln1'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ln2'] != "" && $row_select_pipe['ln2'] != "0" && $row_select_pipe['ln2'] != null) {echo $row_select_pipe['ln2'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ln3'] != "" && $row_select_pipe['ln3'] != "0" && $row_select_pipe['ln3'] != null) {echo $row_select_pipe['ln3'];} else {echo " <br>";} ?></center></td>
				<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['ln4'] != "" && $row_select_pipe['ln4'] != "0" && $row_select_pipe['ln4'] != null) {echo $row_select_pipe['ln4'];} else {echo " <br>";} ?></center></td>
								
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><center><?php if ($row_select_pipe['avg_ll'] != "" && $row_select_pipe['avg_ll'] != "0" && $row_select_pipe['avg_ll'] != null) {echo $row_select_pipe['avg_ll'];} else {echo " <br>";} ?></center></td>
				<td colspan="2" style="border: 1px solid black;"><center><?php if ($row_select_pipe['avg_pl'] != "" && $row_select_pipe['avg_pl'] != "0" && $row_select_pipe['avg_pl'] != null) {echo $row_select_pipe['avg_pl'];} else {echo " <br>";} ?></center></td>
							
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b><center> Liquid Limit % (W<sub>L</sub>)</center></b></td>
				<td colspan="2" style="border: 1px solid black;"><center><b>Plastic Limit % (W<sub>p</sub>)</b></center></td>
				<td colspan="2" style="border: 1px solid black;"><center><b>Plasticity Index % (I<sub>p</sub>)</b></center></td>
							
				</tr>
				<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b><center><?php if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0" && $row_select_pipe['liquide_limit'] != null) {			echo $row_select_pipe['liquide_limit'];			} else {			echo " <br>";			} ?></center></b></td>
				<td colspan="2" style="border: 1px solid black;"><center><b><?php if ($row_select_pipe['plastic_limit'] != "" && $row_select_pipe['plastic_limit'] != "0" && $row_select_pipe['plastic_limit'] != null) {echo $row_select_pipe['plastic_limit'];} else {echo " <br>";} ?></b></center></td>
				<td colspan="2" style="border: 1px solid black;"><center><b><?php if ($row_select_pipe['pi_value'] != "" && $row_select_pipe['pi_value'] != "0" && $row_select_pipe['pi_value'] != null) {echo $row_select_pipe['pi_value'];} else {echo " <br>";} ?></center></td>
							
				</tr>
				
				</table-->
		<!-- <div class="pagebreak"></div>
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
					<center><b>Coarse Aggregate</b></center>
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

		<p style="margin-left:50px;">1. Chloride Content (BS EN 1744 - 1)</p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;" height="Auto" cellpadding="3px">
			<tr>
				<td width="60%" style="border: 1px solid black;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Soil Sample</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_1'] != "" && $row_select_pipe['clr_s1_1'] != "0" && $row_select_pipe['clr_s1_1'] != null) {	echo $row_select_pipe['clr_s1_1'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_1'] != "" && $row_select_pipe['clr_s2_1'] != "0" && $row_select_pipe['clr_s2_1'] != null) {	echo $row_select_pipe['clr_s2_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Water</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_2'] != "" && $row_select_pipe['clr_s1_2'] != "0" && $row_select_pipe['clr_s1_2'] != null) {	echo $row_select_pipe['clr_s1_2'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_2'] != "" && $row_select_pipe['clr_s2_2'] != "0" && $row_select_pipe['clr_s2_2'] != null) {	echo $row_select_pipe['clr_s2_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Soil Ratio gm/g (W)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_3'] != "" && $row_select_pipe['clr_s1_3'] != "0" && $row_select_pipe['clr_s1_3'] != null) {	echo $row_select_pipe['clr_s1_3'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_3'] != "" && $row_select_pipe['clr_s2_3'] != "0" && $row_select_pipe['clr_s2_3'] != null) {	echo $row_select_pipe['clr_s2_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Volume of AgNo3.0.1M Solution ml (V5)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_4'] != "" && $row_select_pipe['clr_s1_4'] != "0" && $row_select_pipe['clr_s1_4'] != null) {	echo $row_select_pipe['clr_s1_4'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_4'] != "" && $row_select_pipe['clr_s2_4'] != "0" && $row_select_pipe['clr_s2_4'] != null) {	echo $row_select_pipe['clr_s2_4'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Volume of STD NH45CN Solution (ml) (V6)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_5'] != "" && $row_select_pipe['clr_s1_5'] != "0" && $row_select_pipe['clr_s1_5'] != null) {	echo $row_select_pipe['clr_s1_5'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_5'] != "" && $row_select_pipe['clr_s2_5'] != "0" && $row_select_pipe['clr_s2_5'] != null) {	echo $row_select_pipe['clr_s2_5'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>CT - Normality of NH4SCN</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_6'] != "" && $row_select_pipe['clr_s1_6'] != "0" && $row_select_pipe['clr_s1_6'] != null) {	echo $row_select_pipe['clr_s1_6'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_6'] != "" && $row_select_pipe['clr_s2_6'] != "0" && $row_select_pipe['clr_s2_6'] != null) {	echo $row_select_pipe['clr_s2_6'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Chloride = 0.003546*W {(V5-(10*CT*V6))}</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s1_7'] != "" && $row_select_pipe['clr_s1_7'] != "0" && $row_select_pipe['clr_s1_7'] != null) {	echo $row_select_pipe['clr_s1_7'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['clr_s2_7'] != "" && $row_select_pipe['clr_s2_7'] != "0" && $row_select_pipe['clr_s2_7'] != null) {	echo $row_select_pipe['clr_s2_7'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>% Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><b><?php if ($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null) {	echo $row_select_pipe['avg_clr'];} else {	echo " <br>";} ?></b></td>
			</tr>
		</table>
		<p style="margin-left:50px;">2. pH (IS 2720 - 26)</p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td width="60%" style="border: 1px solid black;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Volume in ml of sample taken (V)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s1_1'] != "" && $row_select_pipe['ph_s1_1'] != "0" && $row_select_pipe['ph_s1_1'] != null) {	echo $row_select_pipe['ph_s1_1'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s2_1'] != "" && $row_select_pipe['ph_s2_1'] != "0" && $row_select_pipe['ph_s2_1'] != null) {	echo $row_select_pipe['ph_s2_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>pH</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s1_2'] != "" && $row_select_pipe['ph_s1_2'] != "0" && $row_select_pipe['ph_s1_2'] != null) {	echo $row_select_pipe['ph_s1_2'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['ph_s2_2'] != "" && $row_select_pipe['ph_s2_2'] != "0" && $row_select_pipe['ph_s2_2'] != null) {	echo $row_select_pipe['ph_s2_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>% Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><b><?php if ($row_select_pipe['avg_ph'] != "" && $row_select_pipe['avg_ph'] != "0" && $row_select_pipe['avg_ph'] != null) {	echo $row_select_pipe['avg_ph'];} else {	echo " <br>";} ?></b></td>
			</tr>
		</table>
		<p style="margin-left:50px;">3. Sulphate (IS 2720 - 27)</p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="60%" style="border: 1px solid black;"><b>Method</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S1 gm</b></td>
				<td width="20%" style="border: 1px solid black;"><b>S2 gm</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Initial Weight of Sample (A) gm</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_1'] != "" && $row_select_pipe['slp_s1_1'] != "0" && $row_select_pipe['slp_s1_1'] != null) {	echo $row_select_pipe['slp_s1_1'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_1'] != "" && $row_select_pipe['slp_s2_1'] != "0" && $row_select_pipe['slp_s2_1'] != null) {	echo $row_select_pipe['slp_s2_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Empty weight of Crucible + Sample After Ignition (C) gm</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_2'] != "" && $row_select_pipe['slp_s1_2'] != "0" && $row_select_pipe['slp_s1_2'] != null) {	echo $row_select_pipe['slp_s1_2'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_2'] != "" && $row_select_pipe['slp_s2_2'] != "0" && $row_select_pipe['slp_s2_2'] != null) {	echo $row_select_pipe['slp_s2_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>Weight of Residue after Ignition D = (C-B) gm</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_3'] != "" && $row_select_pipe['slp_s1_3'] != "0" && $row_select_pipe['slp_s1_3'] != null) {	echo $row_select_pipe['slp_s1_3'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_3'] != "" && $row_select_pipe['slp_s2_3'] != "0" && $row_select_pipe['slp_s2_3'] != null) {	echo $row_select_pipe['slp_s2_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>S04 (%) = 41.15-D/A</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s1_4'] != "" && $row_select_pipe['slp_s1_4'] != "0" && $row_select_pipe['slp_s1_4'] != null) {	echo $row_select_pipe['slp_s1_4'];
			} else {	echo " <br>";
			} ?></b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['slp_s2_4'] != "" && $row_select_pipe['slp_s2_4'] != "0" && $row_select_pipe['slp_s2_4'] != null) {	echo $row_select_pipe['slp_s2_4'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;"><b>% Average</b></td>
				<td colspan="2" style="border: 1px solid black;"><b><?php if ($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null) {	echo $row_select_pipe['avg_sul'];} else {	echo " <br>";} ?></b></td>
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
					<center><b>Coarse Aggregate</b></center>
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
		<p style="margin-left:50px;"><b>Deleterius Materials (IS 2686 - 1 & 2) - 1963</b></p>
		<p style="margin-left:50px; "><b>(i) % finer than 75u</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Sample, gm (B)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_1_1'] != "0" && $row_select_pipe['dele_1_1'] != null) {	echo $row_select_pipe['dele_1_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>After washing through water, then oven dry weight</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_2'] != "" && $row_select_pipe['dele_1_2'] != "0" && $row_select_pipe['dele_1_2'] != null) {	echo $row_select_pipe['dele_1_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Sample, gm (C)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_3'] != "" && $row_select_pipe['dele_1_3'] != "0" && $row_select_pipe['dele_1_3'] != null) {	echo $row_select_pipe['dele_1_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% finer than 75u (A) = (B-C)/B * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) {	echo $row_select_pipe['dele_1_4'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px; "><b>(ii) % Clay and Lumps</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Wt of Sample gm (W)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_2_1'] != "0" && $row_select_pipe['dele_2_1'] != null) {	echo $row_select_pipe['dele_2_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>After broken with fingre then paassing 2.36mm IS Sieve gm (R)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_2_2'] != "" && $row_select_pipe['dele_2_2'] != "0" && $row_select_pipe['dele_2_2'] != null) {	echo $row_select_pipe['dele_2_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% Clay Lumps = (W-R)/B * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) {	echo $row_select_pipe['dele_2_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px; "><b>(iii) % Coal and Lignite</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Wt of Sample gm (W1)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_3_1'] != "0" && $row_select_pipe['dele_3_1'] != null) {	echo $row_select_pipe['dele_3_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Introduce in to heavy liquid then wt gm (W2)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_3_2'] != "" && $row_select_pipe['dele_3_2'] != "0" && $row_select_pipe['dele_3_2'] != null) {	echo $row_select_pipe['dele_3_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% Coal & Ligntie = (W1 - W2)/W1 * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_3_3'] != "") {	echo $row_select_pipe['dele_3_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px; "><b>(iv) % Soft Particle</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Sample as per IS 2386 (P-2), CL no S 3.1 gms (A)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_4_1'] != "0" && $row_select_pipe['dele_4_1'] != null) {	echo $row_select_pipe['dele_4_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Weight of Soft Particle broken from surface after brass rod rubbing, gms (B)</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_4_2'] != "" && $row_select_pipe['dele_4_2'] != "0" && $row_select_pipe['dele_4_2'] != null) {	echo $row_select_pipe['dele_4_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>% Soft Particle :- B/A * 100</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['dele_4_3'] != "" && $row_select_pipe['dele_4_3'] != "0" && $row_select_pipe['dele_4_3'] != null) {	echo $row_select_pipe['dele_4_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
		</table>

		<p style="margin-left:50px;"><b>ORGANIC IMPURITIES (IS 2686 - 2) - 1963</b></p>
		<table align="center" width="90%" class="test1" style="border: 1px solid black;">
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Fill Solutions upto Mark</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_1'] != "" && $row_select_pipe['aoi_1'] != "0" && $row_select_pipe['aoi_1'] != null) {	echo $row_select_pipe['aoi_1'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Fill Sand upto mark</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_2'] != "" && $row_select_pipe['aoi_2'] != "0" && $row_select_pipe['aoi_2'] != null) {	echo $row_select_pipe['aoi_2'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Further fill solution upto mark</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_3'] != "" && $row_select_pipe['aoi_3'] != "0" && $row_select_pipe['aoi_3'] != null) {	echo $row_select_pipe['aoi_3'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
			<tr>
				<td width="50%" style="border: 1px solid black;"><b>Observation</b></td>
				<td style="border: 1px solid black;"><b><?php if ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != "0" && $row_select_pipe['aoi_4'] != null) {	echo $row_select_pipe['aoi_4'];
			} else {	echo " <br>";
			} ?></b></td>
			</tr>
		</table> -->

		<?php
		/*}			*/
		?>

	</page>

</body>

</html>


<script type="text/javascript">

</script>