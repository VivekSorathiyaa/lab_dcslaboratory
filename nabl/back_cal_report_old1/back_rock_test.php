<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 30px 10px;
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
	$select_tiles_query = "select * from rock WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$agreement_no = $row_select['agreement_no'];
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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
	}
	?>


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
					<center><b>FMT-OBS-027</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON ROCK</b></center>
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
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $job_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Quantity of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php if ($row_select_pipe['no_of_brick'] != "" && $row_select_pipe['no_of_brick'] != "0" && $row_select_pipe['no_of_brick'] != null) {echo $row_select_pipe['no_of_brick'];
																											} else {echo " <br>";
																											} ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>

		<!-- table 1 -->
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria; margin-bottom: 10px;">
			<tr>
				<td>
				<table width="100%" class="test1" style="border: 0;font-family: Cambria;margin-top: 12px;margin-bottom: 0;" height="Auto">
					<tr>
						<td style="padding: 6px;font-size: 14px;"><b>1.   Specific Gravity and Water absorption(IS : 1124-1974)</b></td>
					</tr>
				</table>
				<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;" rowspan="2"><center><b>Sr. No.</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;" colspan="3"><center><b>Weight of sample</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Apparent Specific Gravity</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Water Absorption <br> (%)</b></center></td>						
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>Oven dry (g) <br> A </b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Saturated Surface dry (g) <br> B</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Wt. of Sample in Water <br> C</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b><span style="border-bottom: 1px solid;">&nbsp;&nbsp; &nbsp; B &nbsp; &nbsp; &nbsp;  </span><br>(A - C)  </b></center></td>						
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b><span style="border-bottom: 1px solid;">B - A </span>&nbsp;&nbsp; X 100<br>A  &nbsp;&nbsp;  </b></center></td>						
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != null && $row_select_pipe['sp_w_s_1'] != "0") {echo $row_select_pipe['sp_w_s_1'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != null && $row_select_pipe['sp_wt_st_1'] != "0") {echo $row_select_pipe['sp_wt_st_1'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != null && $row_select_pipe['sp_w_sur_1'] != "0") {echo $row_select_pipe['sp_w_sur_1'];} else {echo "0";} ?></center></td>						
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != null && $row_select_pipe['sp_specific_gravity_1'] != "0") {echo $row_select_pipe['sp_specific_gravity_1'];} else {echo "0";} ?></center></td>
						<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != null && $row_select_pipe['sp_water_abr_1'] != "0") {echo $row_select_pipe['sp_water_abr_1'];} else {echo "0";} ?></td>
							
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != null && $row_select_pipe['sp_w_s_2'] != "0") {echo $row_select_pipe['sp_w_s_2'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != null && $row_select_pipe['sp_wt_st_2'] != "0") {echo $row_select_pipe['sp_wt_st_2'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != null && $row_select_pipe['sp_w_sur_2'] != "0") {echo $row_select_pipe['sp_w_sur_2'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != null && $row_select_pipe['sp_specific_gravity_2'] != "0") {echo $row_select_pipe['sp_specific_gravity_2'];} else {echo "0";} ?></center></td>
						<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != null && $row_select_pipe['sp_water_abr_2'] != "0") {echo $row_select_pipe['sp_water_abr_2'];} else {echo "0";} ?></td>			
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_w_s_3'] != "" && $row_select_pipe['sp_w_s_3'] != null && $row_select_pipe['sp_w_s_3'] != "0") {echo $row_select_pipe['sp_w_s_3'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_wt_st_3'] != "" && $row_select_pipe['sp_wt_st_3'] != null && $row_select_pipe['sp_wt_st_3'] != "0") {echo $row_select_pipe['sp_wt_st_3'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_w_sur_3'] != "" && $row_select_pipe['sp_w_sur_3'] != null && $row_select_pipe['sp_w_sur_3'] != "0") {echo $row_select_pipe['sp_w_sur_3'];} else {echo "0";} ?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['sp_specific_gravity_3'] != "" && $row_select_pipe['sp_specific_gravity_3'] != null && $row_select_pipe['sp_specific_gravity_3'] != "0") {echo $row_select_pipe['sp_specific_gravity_3'];} else {echo "0";} ?></center></td>
						<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['sp_water_abr_3'] != "" && $row_select_pipe['sp_water_abr_3'] != null && $row_select_pipe['sp_water_abr_3'] != "0") {echo $row_select_pipe['sp_water_abr_3'];} else {echo "0";} ?></td>			
					</tr>
					
					<tr>
						<td colspan="4" style="border: 1px solid black;width:5%;padding: 2px 5px;text-align:right"><b> Average </b></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe["sp_specific_gravity"]; ?></center></td>
						<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><center><?php echo $row_select_pipe	["sp_water_abr"]; ?></center></td>			
					</tr>
					
				</table>
				</td>
			</tr>																					
		</table><br>

		<!-- table 2 -->
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td>	
					<table width="100%" class="test1" style="border: 0;font-family: Cambria;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 14px;"><b>2.   Water Content(IS: 13030-1991)</b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Weight of <br> Container(m1)</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Weight of  Container+ <br> Specimen(m2)</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Weight of Container+ Dry <br> Specimen(m3).</b></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Water Content w= <br> m3-m2/m3-m1 X 100</b></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?> </b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_1_1'] != "" && $row_select_pipe['m_1_1'] != null ) {echo $row_select_pipe['m_1_1'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_2_1'] != "" && $row_select_pipe['m_2_1'] != null) {echo $row_select_pipe['m_2_1'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_3_1'] != "" && $row_select_pipe['m_3_1'] != null ) {echo $row_select_pipe['m_3_1'];} else {echo "0";} ?></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != null ) {echo $row_select_pipe['wtr1'];} else {echo "0";} ?></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?> </b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_1_2'] != "" && $row_select_pipe['m_1_2'] != null ) {echo $row_select_pipe['m_1_2'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_2_2'] != "" && $row_select_pipe['m_2_2'] != null) {echo $row_select_pipe['m_2_2'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_3_2'] != "" && $row_select_pipe['m_3_2'] != null ) {echo $row_select_pipe['m_3_2'];} else {echo "0";} ?></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != null ) {echo $row_select_pipe['wtr2'];} else {echo "0";} ?></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?> </b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_1_3'] != "" && $row_select_pipe['m_1_3'] != null ) {echo $row_select_pipe['m_1_3'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_2_3'] != "" && $row_select_pipe['m_2_3'] != null) {echo $row_select_pipe['m_2_3'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_3_3'] != "" && $row_select_pipe['m_3_3'] != null ) {echo $row_select_pipe['m_3_3'];} else {echo "0";} ?></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != null ) {echo $row_select_pipe['wtr3'];} else {echo "0";} ?></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?> </b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_1_4'] != "" && $row_select_pipe['m_1_4'] != null && $row_select_pipe['m_1_4'] != "0") {echo $row_select_pipe['m_1_3'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_2_4'] != "" && $row_select_pipe['m_2_4'] != null) {echo $row_select_pipe['m_2_4'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_3_4'] != "" && $row_select_pipe['m_3_4'] != null ) {echo $row_select_pipe['m_3_4'];} else {echo "0";} ?></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['wtr4'] != "" && $row_select_pipe['wtr4'] != null ) {echo $row_select_pipe['wtr4'];} else {echo "0";} ?></center></td>						
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?> </b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_1_5'] != "" && $row_select_pipe['m_1_5'] != null && $row_select_pipe['m_1_4'] != "0") {echo $row_select_pipe['m_1_3'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_2_5'] != "" && $row_select_pipe['m_2_5'] != null) {echo $row_select_pipe['m_2_4'];} else {echo "0";} ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['m_3_5'] != "" && $row_select_pipe['m_3_5'] != null ) {echo $row_select_pipe['m_3_4'];} else {echo "0";} ?></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php if ($row_select_pipe['wtr5'] != "" && $row_select_pipe['wtr5'] != null ) {echo $row_select_pipe['wtr4'];} else {echo "0";} ?></center></td>						
						</tr>
					    <td colspan="4" style="border: 1px solid black;width:5%;padding: 2px 5px;text-align:right"><b> Average</b></td>
						<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null) {echo $row_select_pipe['avg_wtr'];} else {echo "0";} ?></td>			
					</tr>
						
					</table>
				</td>
			</tr>																					
		</table>
		<br>
		
		<!-- table 4 -->
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria; margin-bottom: 10px;">
			<tr>
				<td>
				<table width="100%" class="test1" style="border: 0;font-family: Cambria;margin-top: 12px;margin-bottom: 0;" height="Auto">
					<tr>
						<td style="padding: 6px;font-size: 14px;"><b>3.    Unconfined Compressive Strength (IS : 9143-1979)</b></td>
					</tr>
				</table>
				<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;" rowspan="2"><center><b>Sr. No.</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Load at Failure</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"colspan="3"><center><b>Diameter</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;" rowspan="2"><center><b>Diameter (Average)(cm)</b></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;" rowspan="2"><center><b>UCS =Load at Failure/CS area(Kg/cm<sup>2</sup>)</b></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;" rowspan="2"><center><b>Remarks</b></center></td>	
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b>P (N)</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Upper (cm)</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Middle (cm)</b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><b>Lower (cm)</b></center></td>						
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php  $cnt=1 ;echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['load1'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['ucs1'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>			
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['load2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['ucs2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>			
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['load2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['ucs2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>			
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['load2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['ucs2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>			
					</tr>
					<tr>
						<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b> <?php echo $cnt++; ?></b></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['load2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['ucs2'];?></center></td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>			
					</tr>
					<tr>
						<td colspan="6" style="padding: 2px 100px;text-align:right">Average :</td>
						<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe["avg_ucs"]; ?></center></td>
						<td style="border: 1px solid ack;width:20%;padding: 2px 3px;"><center></center></td>			
					</tr>
				</table>
				</td>
			</tr>																					
		</table>
		<br><br><br>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:1px solid #ccc;">
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
		<table align="center" width="79%" style="">
				<tr style="font-size:12px;" >
					<td style="text-align:left;">Page 1 of 2</td>
				</tr>		
		</table>

		<br>
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
					<center><b>FMT-OBS-027</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR <br>TEST ON ROCK</b></center>
				</td>
			</tr>
		</table>
		<br>

		<!-- table 3 -->
		<?php $cnt = 1; ?>
		<table align="center" width="94%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;">
			<tr>
				<td>
					<table width="100%" class="test1" style="border: 0;font-family: Cambria;margin-top: 10px;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 14px;"><b>4.   Porosity and density (IS : 13030-1991)</b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family: Cambria;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:22%;padding: 2px 3px;"></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><b>1</b></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><b>2</b></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><b>3</b></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><b>4</b></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><b>5</b></center></td>						
							
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>M<sub>1</sub>(Weight of basket Submerged) (kg) </b></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_1'] != "" && $row_select_pipe['mass_s_1'] != null && $row_select_pipe['mass_s_1'] != "0") {echo $row_select_pipe['mass_s_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>

						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>M<sub>2</sub>(Mass of Specimen + basket Submerged) (kg) </b></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_1'] != "" && $row_select_pipe['mass_s_1'] != null && $row_select_pipe['mass_s_1'] != "0") {echo ($row_select_pipe['mass_s_1'] + $row_select_pipe['sm_1']);} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo ($row_select_pipe['mass_s_2'] + $row_select_pipe['sm_2']);} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo ($row_select_pipe['mass_s_3'] + $row_select_pipe['sm_3']);} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>

						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>M<sub>3</sub>(Weight of container) (kg) </b></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_c_1'] != "" && $row_select_pipe['mass_c_1'] != null && $row_select_pipe['mass_c_1'] != "0") {echo $row_select_pipe['mass_c_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_c_2'] != "" && $row_select_pipe['mass_c_2'] != null && $row_select_pipe['mass_c_2'] != "0") {echo $row_select_pipe['mass_c_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_c_3'] != "" && $row_select_pipe['mass_c_3'] != null && $row_select_pipe['mass_c_3'] != "0") {echo $row_select_pipe['mass_c_3'];} else {echo "0";} ?></td>		
						    <td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
								
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>M<sub>4</sub>(Weight of saturated surface dry+ container) (kg) </b></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_o_1'] != "" && $row_select_pipe['mass_o_1'] != null && $row_select_pipe['mass_o_1'] != "0") {echo $row_select_pipe['mass_o_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_o_2'] != "" && $row_select_pipe['mass_o_2'] != null && $row_select_pipe['mass_o_2'] != "0") {echo $row_select_pipe['mass_o_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_o_3'] != "" && $row_select_pipe['mass_o_3'] != null && $row_select_pipe['mass_o_3'] != "0") {echo $row_select_pipe['mass_o_3'];} else {echo "0";} ?></td>	
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
					
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b> M<sub>5</sub>(Dry weight of specimen + Container) (kg) </b></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_d_1'] != "" && $row_select_pipe['mass_d_1'] != null && $row_select_pipe['mass_d_1'] != "0") {echo $row_select_pipe['mass_d_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_d_2'] != "" && $row_select_pipe['mass_d_2'] != null && $row_select_pipe['mass_d_2'] != "0") {echo $row_select_pipe['mass_d_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_d_3'] != "" && $row_select_pipe['mass_d_3'] != null && $row_select_pipe['mass_d_3'] != "0") {echo $row_select_pipe['mass_d_3'];} else {echo "0";} ?>					
						    <td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
				
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b> M<sub>sub</sub>=M<sub>3</sub>-M<sub>1</sub>(kg) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_c_1'] - $row_select_pipe['mass_s_1']); ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_c_2'] - $row_select_pipe['mass_s_2']); ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_c_3'] - $row_select_pipe['mass_s_3']); ?></center></td>						
						    <td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
	
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b> M<sub>sat</sub>=M<sub>4</sub>-M<sub>3</sub>(kg) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_o_1'] - $row_select_pipe['mass_c_1']); ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_o_2'] - $row_select_pipe['mass_c_2']); ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_o_3'] - $row_select_pipe['mass_c_3']); ?></center></td>						
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
			
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>M<sub>s</sub>=M<sub>5</sub>-M<sub>3</sub>(kg) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_d_1'] - $row_select_pipe['mass_c_1']); ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_d_2'] - $row_select_pipe['mass_c_2']); ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['mass_d_3'] - $row_select_pipe['mass_c_3']); ?></center></td>						
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>V=( M<sub>sat</sub>- M<sub>sub</sub>)/ρ<sub>w</sub>(m<Sup>3</Sup>) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo (($row_select_pipe['mass_o_1'] - $row_select_pipe['mass_c_1']) - ($row_select_pipe['mass_c_1'] - $row_select_pipe['mass_s_1'])) / $row_select_pipe['dtemp1']; ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo (($row_select_pipe['mass_o_2'] - $row_select_pipe['mass_c_3']) - ($row_select_pipe['mass_c_2'] - $row_select_pipe['mass_s_2'])) / $row_select_pipe['dtemp2']; ?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo (($row_select_pipe['mass_o_3'] - $row_select_pipe['mass_c_3']) - ($row_select_pipe['mass_c_3'] - $row_select_pipe['mass_s_3'])) / $row_select_pipe['dtemp3']; ?></center></td>						
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>

						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>Y<sub>v</sub>=( Msat- Ms)/ ρ<sub>w</sub>(m<sup>3</sup>) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo $row_select_pipe['pvol1'];?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo $row_select_pipe['pvol2'];?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo $row_select_pipe['pvol3'];?></center></td>						
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>

						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>n = Y<sub>v</sub> / V (%) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['pvol1'] / ((($row_select_pipe['mass_o_1'] - $row_select_pipe['mass_c_1']) - ($row_select_pipe['mass_c_1'] - $row_select_pipe['mass_s_1'])) / $row_select_pipe['dtemp1']));?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['pvol2'] / ((($row_select_pipe['mass_o_2'] - $row_select_pipe['mass_c_2']) - ($row_select_pipe['mass_c_2'] - $row_select_pipe['mass_s_2'])) / $row_select_pipe['dtemp2']));?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo ($row_select_pipe['pvol3'] / ((($row_select_pipe['mass_o_3'] - $row_select_pipe['mass_c_3']) - ($row_select_pipe['mass_c_3'] - $row_select_pipe['mass_s_3'])) / $row_select_pipe['dtemp3']));?></center></td>						
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>

						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><b>ρ<sub>d</sub>=M<sub>s</sub> / V(kg/m<sup>3</sup>) </b></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo (($row_select_pipe['mass_d_1'] - $row_select_pipe['mass_c_1']) / ((($row_select_pipe['mass_o_1'] - $row_select_pipe['mass_c_1']) - ($row_select_pipe['mass_c_1'] - $row_select_pipe['mass_s_1'])) / $row_select_pipe['dtemp1']));?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo (($row_select_pipe['mass_d_2'] - $row_select_pipe['mass_c_2']) / ((($row_select_pipe['mass_o_2'] - $row_select_pipe['mass_c_2']) - ($row_select_pipe['mass_c_2'] - $row_select_pipe['mass_s_2'])) / $row_select_pipe['dtemp2']));?></center></td>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;"><center><?php echo (($row_select_pipe['mass_d_3'] - $row_select_pipe['mass_c_3']) / ((($row_select_pipe['mass_o_3'] - $row_select_pipe['mass_c_3']) - ($row_select_pipe['mass_c_3'] - $row_select_pipe['mass_s_3'])) / $row_select_pipe['dtemp3']));?></center></td>						
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>

						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;text-align: left"><b>Average of Porosity </b></td>
							<td colspan=5 style="border: 1px solid black;width:16%;padding: 2px 5px;"><?php echo $row_select_pipe["avg_por"]; ?></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:16%;padding: 2px 3px;text-align: left"><b>Average of density</b></td>
							<td colspan=5 style="border: 1px solid black;width:16%;padding: 2px 5px;"><?php echo $row_select_pipe["avg_den"]; ?></td>
						</tr>
					</table>
				</td>
			</tr>																					
		</table>
		<br><br>
	
		
		<table align="center" width="94%" class="test1" style="" Height="10%">
			<tr style="font-size:15px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>
		<br><br><br><br><br><br><br><br><br><br><br><br>

		<table align="center" width="94%" class="test" height="Auto" style="border-top:1px solid #ccc;">
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
		<table align="center" width="79%" style="">
				<tr style="font-size:12px;" >
					<td style="text-align:left;">Page 2 of 2</td>
				</tr>		
		</table>

		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<!-- <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;"> -->
			<!-- <tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/E/OS/01</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 06/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : </td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

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

				</td>
			</tr> -->

			<!-- <tr>
				<td style="text-align:center;font-size:18px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:18px;font-family: Cambria;">

						<tr style="">

							<td style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; "><span style="">OBSERVATION AND CALCULATION SHEET FOR TEST ON ROCK</td>
						</tr>

					</table>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Job No.</td>
							<td style="border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-top:1px solid;width:8%;font-weight:bold;padding-bottom:2px;padding-top:2px;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%;text-align:left; ">&nbsp;&nbsp; Laboratory No</td>
							<td style="border-top:1px solid;border-left:1px solid;width:46%; ">&nbsp;&nbsp; <?php echo $job_no; ?><?php echo $sample_no; ?></td>
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

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:15%;border-right:1px solid; text-align:center;font-weight:bold; ">1</td>
							<td style="width:85%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Unconfined Compressive Strength (IS:9143-1979(R.A.2001)</td>

						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:20px;">

						<tr style="">
							<td style="width:8%;text-align:center;font-weight:bold;  ">Sr. No.</td>
							<td style="border-left:1px solid;width:28%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Description</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 1</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 2</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">I.D.Marks</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['desc1'] != "" && $row_select_pipe['desc1'] != null && $row_select_pipe['desc1'] != "0") {echo $row_select_pipe['desc1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['desc2'] != "" && $row_select_pipe['desc2'] != null && $row_select_pipe['desc2'] != "0") {echo $row_select_pipe['desc2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['desc3'] != "" && $row_select_pipe['desc3'] != null && $row_select_pipe['desc3'] != "0") {echo $row_select_pipe['desc3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Lenth</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['length1'] != "" && $row_select_pipe['length1'] != null && $row_select_pipe['length1'] != "0") {echo $row_select_pipe['length1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['length2'] != "" && $row_select_pipe['length2'] != null && $row_select_pipe['length2'] != "0") {echo $row_select_pipe['length2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['length3'] != "" && $row_select_pipe['length3'] != null && $row_select_pipe['length3'] != "0") {echo $row_select_pipe['length3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Diameter</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">mm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != null && $row_select_pipe['dia1'] != "0") {echo $row_select_pipe['dia1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['dia2'] != "" && $row_select_pipe['dia2'] != null && $row_select_pipe['dia2'] != "0") {echo $row_select_pipe['dia2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['dia3'] != "" && $row_select_pipe['dia3'] != null && $row_select_pipe['dia3'] != "0") {echo $row_select_pipe['dia3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">L/D Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['ratio1'] != "" && $row_select_pipe['ratio1'] != null && $row_select_pipe['ratio1'] != "0") {echo $row_select_pipe['ratio1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['ratio2'] != "" && $row_select_pipe['ratio2'] != null && $row_select_pipe['ratio2'] != "0") {echo $row_select_pipe['ratio2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['ratio3'] != "" && $row_select_pipe['ratio3'] != null && $row_select_pipe['ratio3'] != "0") {echo $row_select_pipe['ratio3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Correction factor for L/D<br>Ratio</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">-</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['corr1'] != "" && $row_select_pipe['corr1'] != null && $row_select_pipe['corr1'] != "0") {echo $row_select_pipe['corr1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['corr2'] != "" && $row_select_pipe['corr2'] != null && $row_select_pipe['corr2'] != "0") {echo $row_select_pipe['corr2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['corr3'] != "" && $row_select_pipe['corr3'] != null && $row_select_pipe['corr3'] != "0") {echo $row_select_pipe['corr3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Load</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kN</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != null && $row_select_pipe['load1'] != "0") {echo $row_select_pipe['load1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['load2'] != "" && $row_select_pipe['load2'] != null && $row_select_pipe['load2'] != "0") {echo $row_select_pipe['load2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['load3'] != "" && $row_select_pipe['load3'] != null && $row_select_pipe['load3'] != "0") {echo $row_select_pipe['load3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;">Cylindrical Comp.Strength</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">N/mm&sup2;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['cor1'] != "" && $row_select_pipe['cor1'] != null && $row_select_pipe['cor1'] != "0") {echo $row_select_pipe['cor1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['cor2'] != "" && $row_select_pipe['cor2'] != null && $row_select_pipe['cor2'] != "0") {echo $row_select_pipe['cor2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['cor3'] != "" && $row_select_pipe['cor3'] != null && $row_select_pipe['cor3'] != "0") {echo $row_select_pipe['cor3'];} else {echo "0";} ?></td>
						</tr>

					</table>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:15%;border-right:1px solid; text-align:center;font-weight:bold; ">2</td>
							<td style="width:85%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Water Absorption,(IS:13030-1991(R.A.2001)</td>

						</tr>

					</table><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:40px;">

						<tr style="">
							<td style="width:8%;text-align:center;font-weight:bold;  ">Sr. No.</td>
							<td style="border-left:1px solid;width:28%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Description</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 1</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 2</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Mass in g of the container<br>with its lid<br>at room temperature(M1)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_1_1'] != "" && $row_select_pipe['m_1_1'] != null && $row_select_pipe['m_1_1'] != "0") {echo $row_select_pipe['m_1_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_1_2'] != "" && $row_select_pipe['m_1_2'] != null && $row_select_pipe['m_1_2'] != "0") {echo $row_select_pipe['m_1_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_1_3'] != "" && $row_select_pipe['m_1_3'] != null && $row_select_pipe['m_1_3'] != "0") {echo $row_select_pipe['m_1_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Mass in g of the container<br>with its lid<br>and the sample at room<br>temperature(M2)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_2_1'] != "" && $row_select_pipe['m_2_1'] != null && $row_select_pipe['m_2_1'] != "0") {echo $row_select_pipe['m_2_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_2_2'] != "" && $row_select_pipe['m_2_2'] != null && $row_select_pipe['m_2_2'] != "0") {echo $row_select_pipe['m_2_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_2_3'] != "" && $row_select_pipe['m_2_3'] != null && $row_select_pipe['m_2_3'] != "0") {echo $row_select_pipe['m_2_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Mass in g of the container<br>with its lid<br>and the sample after<br>drying(M3)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">gm</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_3_1'] != "" && $row_select_pipe['m_3_1'] != null && $row_select_pipe['m_3_1'] != "0") {echo $row_select_pipe['m_3_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_3_2'] != "" && $row_select_pipe['m_3_2'] != null && $row_select_pipe['m_3_2'] != "0") {echo $row_select_pipe['m_3_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['m_3_3'] != "" && $row_select_pipe['m_3_3'] != null && $row_select_pipe['m_3_3'] != "0") {echo $row_select_pipe['m_3_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Water Absorption (2-3)/(3)</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">%</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != null && $row_select_pipe['wtr1'] != "0") {echo $row_select_pipe['wtr1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != null && $row_select_pipe['wtr2'] != "0") {echo $row_select_pipe['wtr2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != null && $row_select_pipe['wtr3'] != "0") {echo $row_select_pipe['wtr3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Average Water Absorption</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">%</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;" colspan="3"><?php if ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != null && $row_select_pipe['avg_wtr'] != "0") {			echo $row_select_pipe['avg_wtr'];		} else {			echo "-";		} ?></td>
						</tr>
					</table>

				</td>
			</tr>



			<tr>
				<td style="text-align:right;font-size:14px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:1/2</td>
						</tr>

					</table>

				</td>
			</tr>


			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div> -->
		<!-- </table> -->



		<!-- <div class="pagebreak"></div>
		<br>
		<br>
		<br> -->



		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<!-- <table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;border:1px solid;">
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:25%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC : GOMAEC/E/OS/01</td>
							<td style="width:25%;text-align:center;font-weight:bold; ">REV : 2</td>
							<td style="width:25%; font-weight:bold;">RD :- 06/01/2023</td>
							<td style="width:25%;font-weight:bold;">Page : </td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">

							<td style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px;  ">&nbsp;&nbsp; Prepared by : Technical Manager</td>
							<td style="width:40%;text-align:left;font-weight:bold; ">Approved by : Quality Manager</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border-bottom:1px solid;">

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

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:16px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:16px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="width:15%;border-right:1px solid; text-align:center;font-weight:bold; ">3</td>
							<td style="width:85%; text-align:left;font-weight:bold; ">&nbsp;&nbsp; Density,(IS:13030-1991(R.A.2001)</td>

						</tr>

					</table><br><br>

				</td>
			</tr>


			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;border:1px solid;border-width:1px 0px 1px 0px;margin-bottom:20px;">

						<tr style="">
							<td style="width:8%;text-align:center;font-weight:bold;  ">Sr. No.</td>
							<td style="border-left:1px solid;width:28%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold; ">Description</td>
							<td style="border-left:1px solid;width:10%; text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 1</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 2</td>
							<td style="border-left:1px solid;width:18%; text-align:center;font-weight:bold; ">Sample 3</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:12px;padding-top:12px;">Saturated-submerged<br>mass of basket alone,M1</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_1'] != "" && $row_select_pipe['mass_s_1'] != null && $row_select_pipe['mass_s_1'] != "0") {echo $row_select_pipe['mass_s_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo $row_select_pipe['mass_s_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo $row_select_pipe['mass_s_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Saturated-submerged<br>mass of basket +<br>specimen, M2</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_1'] != "" && $row_select_pipe['mass_s_1'] != null && $row_select_pipe['mass_s_1'] != "0") {echo ($row_select_pipe['mass_s_1'] + $row_select_pipe['sm_1']);} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_2'] != "" && $row_select_pipe['mass_s_2'] != null && $row_select_pipe['mass_s_2'] != "0") {echo ($row_select_pipe['mass_s_2'] + $row_select_pipe['sm_2']);} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_s_3'] != "" && $row_select_pipe['mass_s_3'] != null && $row_select_pipe['mass_s_3'] != "0") {echo ($row_select_pipe['mass_s_3'] + $row_select_pipe['sm_3']);} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:12px;padding-top:12px;">Mass of container and<br>lid, M3</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_c_1'] != "" && $row_select_pipe['mass_c_1'] != null && $row_select_pipe['mass_c_1'] != "0") {echo $row_select_pipe['mass_c_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_c_2'] != "" && $row_select_pipe['mass_c_2'] != null && $row_select_pipe['mass_c_2'] != "0") {echo $row_select_pipe['mass_c_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_c_3'] != "" && $row_select_pipe['mass_c_3'] != null && $row_select_pipe['mass_c_3'] != "0") {echo $row_select_pipe['mass_c_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:5px;padding-top:5px;">Saturated surface dry<br>mass of the sample<br>+ container, M4</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_o_1'] != "" && $row_select_pipe['mass_o_1'] != null && $row_select_pipe['mass_o_1'] != "0") {echo $row_select_pipe['mass_o_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_o_2'] != "" && $row_select_pipe['mass_o_2'] != null && $row_select_pipe['mass_o_2'] != "0") {echo $row_select_pipe['mass_o_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_o_3'] != "" && $row_select_pipe['mass_o_3'] != null && $row_select_pipe['mass_o_3'] != "0") {echo $row_select_pipe['mass_o_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:12px;padding-top:12px;">Dried mass of the<br>container with sample, M5</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_d_1'] != "" && $row_select_pipe['mass_d_1'] != null && $row_select_pipe['mass_d_1'] != "0") {echo $row_select_pipe['mass_d_1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_d_2'] != "" && $row_select_pipe['mass_d_2'] != null && $row_select_pipe['mass_d_2'] != "0") {echo $row_select_pipe['mass_d_2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['mass_d_3'] != "" && $row_select_pipe['mass_d_3'] != null && $row_select_pipe['mass_d_3'] != "0") {echo $row_select_pipe['mass_d_3'];} else {echo "0";} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:8%;padding-bottom:5px;padding-top:5px; text-align:center;font-weight:bold;  "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:28%;text-align:center;padding-bottom:18px;padding-top:18px;">Dry Density of Rock</td>
							<td style="border-top:1px solid;border-left:1px solid;width:10%;text-align:center;">kg/m&sup3;</td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != null && $row_select_pipe['den1'] != "0") {echo $row_select_pipe['den1'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['den2'] != "" && $row_select_pipe['den2'] != null && $row_select_pipe['den2'] != "0") {echo $row_select_pipe['den2'];} else {echo "0";} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:18%;text-align:center;"><?php if ($row_select_pipe['den3'] != "" && $row_select_pipe['den3'] != null && $row_select_pipe['den3'] != "0") {echo $row_select_pipe['den3'];} else {echo "0";} ?></td>
						</tr>
					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:14px; ">

					<table align="center" width="90%" cellspacing="0" cellpadding="0" style="font-size:14px;font-family: Cambria;">

						<tr style="">

							<td style="width:75%;font-weight:bold;padding-bottom:20px;padding-top:12px;padding-left:25px;  ">&nbsp;&nbsp;Tested By:-</td>
							<td style="width:25%;text-align:left;font-weight:bold; ">Checked By:-</td>
						</tr>

					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:right;font-size:11px; ">

					<table align="right" width="15%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-bottom:20px;">

						<tr style="">

							<td style="width:80%;font-weight:bold;border-top:1px solid;border-left:1px solid;border-bottom:1px solid;text-align:center;padding-bottom:2px;padding-top:2px; ">Page:2/2</td>
						</tr>

					</table>

				</td>
			</tr>


			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div> -->
	</page>


</body>

</html>

<script type="text/javascript">


</script>