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
	$select_tiles_query = "select * from half_cell WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	// $job_no= $row_select['job_no'];			
	$agreement_no = $row_select['agreement_no'];
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
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:20px; "><b><u>ANNEXURE-A.7</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:19px;padding-bottom:15px; "><b><u>TEST REPORT OF HALF CELL POTENTIAL</u></b></td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																												$result_selectc = mysqli_query($conn, $select_queryc);

																												if (mysqli_num_rows($result_selectc) > 0) {
																													$row_selectc = mysqli_fetch_assoc($result_selectc);
																													$ct_nm = $row_selectc['city_name'];
																												}
																												echo $clientname; ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:19%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>

					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:25%;font-weight:bold; text-align:left;padding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Structure Type</td>
							<td style="border-left: 1px solid black;width:75%;text-align:left; ">&nbsp;&nbsp; Madhavbag School,RCC frame building (School building)</td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:25%;font-weight:bold;text-align:left;padding-bottom:3px;padding-top:3px;   ">&nbsp;&nbsp; Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:75%;text-align:left; ">&nbsp;&nbsp; ASTM C876</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:25%;font-weight:bold;text-align:leftpadding-bottom:3px;padding-top:3px;  ">&nbsp;&nbsp; Date of Test</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:75%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center; font-size:16px;padding-bottom:5px;" colspan=6><b><u>Half Cell Potential</u></b></td>
			</tr>
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:11px; ">
					<table align="left" width="80%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border-bottom:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%;font-weight:bold; text-align:center; ">Observation points</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:20%;text-align:center;font-weight:bold; ">Concrete Element<br> Location</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px;">Measured <br> Potential <br> Value <br> (mV/CSE)</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:15%; text-align:center;font-weight:bold;padding-bottom:6px;padding-top:6px;">Chances of<br> active steel <br>corrosion</td>
							<td style="border-left: 1px solid black;border-top:1px solid;width:35%; text-align:center;font-weight:bold;border-right:1px solid;">Condition</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:25%;text-align:center;border-top:1px solid; " rowspan=8><?php if ($row_select_pipe['loc_1'] != "" && $row_select_pipe['loc_1'] != null && $row_select_pipe['loc_1'] != "0") {
																																		echo $row_select_pipe['loc_1'];
																																	} else {
																																		echo "-";
																																	} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_1'] != "" && $row_select_pipe['val_1'] != null && $row_select_pipe['val_1'] != "0") {
																															echo number_format($row_select_pipe['val_1'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != null && $row_select_pipe['corr_1'] != "0") {
																															echo number_format($row_select_pipe['corr_1'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_2'] != "" && $row_select_pipe['val_2'] != null && $row_select_pipe['val_2'] != "0") {
																															echo number_format($row_select_pipe['val_2'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != null && $row_select_pipe['corr_2'] != "0") {
																															echo number_format($row_select_pipe['corr_2'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_3'] != "" && $row_select_pipe['val_3'] != null && $row_select_pipe['val_3'] != "0") {
																															echo number_format($row_select_pipe['val_3'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != null && $row_select_pipe['corr_3'] != "0") {
																															echo number_format($row_select_pipe['corr_3'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_4'] != "" && $row_select_pipe['val_4'] != null && $row_select_pipe['val_4'] != "0") {
																															echo number_format($row_select_pipe['val_4'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != null && $row_select_pipe['corr_4'] != "0") {
																															echo number_format($row_select_pipe['corr_4'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_5'] != "" && $row_select_pipe['val_5'] != null && $row_select_pipe['val_5'] != "0") {
																															echo number_format($row_select_pipe['val_5'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != null && $row_select_pipe['corr_5'] != "0") {
																															echo number_format($row_select_pipe['corr_5'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_6'] != "" && $row_select_pipe['val_6'] != null && $row_select_pipe['val_6'] != "0") {
																															echo number_format($row_select_pipe['val_6'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != null && $row_select_pipe['corr_6'] != "0") {
																															echo number_format($row_select_pipe['corr_6'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_7'] != "" && $row_select_pipe['val_7'] != null && $row_select_pipe['val_7'] != "0") {
																															echo number_format($row_select_pipe['val_7'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != null && $row_select_pipe['corr_7'] != "0") {
																															echo number_format($row_select_pipe['corr_7'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;width:15%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['val_8'] != "" && $row_select_pipe['val_8'] != null && $row_select_pipe['val_8'] != "0") {
																															echo number_format($row_select_pipe['val_8'], 0);
																														} else {
																															echo "-";
																														} ?></td>
							<td style="border-left: 1px solid black;width:15%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != null && $row_select_pipe['corr_8'] != "0") {
																															echo number_format($row_select_pipe['corr_8'], 0);
																														} else {
																															echo "-";
																														} ?>%</td>
							<td style="border-left: 1px solid black;width:30%; text-align:center;border-top:1px solid;border-right:1px solid;padding-bottom:6px;padding-top:6px;">Dry,Crbonated Concrete</td>
						</tr>

					</table>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">
					<br>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; "><br>
					<table align="center" width="12%" class="test" style="height:auto;font-family: Cambria;border:1px solid rgb(120 154 185); ">
						<tr>
							<td style="text-align:center;padding-top:20px;padding-bottom:20px;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
							<td style="text-align:center;padding-top:20px;padding-bottom:20px;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
						</tr>
						<tr>
							<td style="text-align:center;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
							<td style="text-align:center;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
						</tr>
						<tr>
							<td style="text-align:center;padding-top:20px;padding-bottom:20px;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
							<td style="text-align:center;padding-top:20px;padding-bottom:20px;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
						</tr>
						<tr>
							<td style="text-align:center;padding-bottom:20px;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
							<td style="text-align:center;padding-bottom:20px;"><img src="round-black.svg" style="height:16px;width:16px;"></td>
						</tr>
						<tr>
							<td style="text-align:center;padding-bottom:20px;"><img src="round-orange.svg" style="height:16px;width:16px;"></td>
						</tr>

					</table>
				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:11px;padding-top:20px; "><br>
					<table align="center" width="35%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;border:1px solid;">
						<tr>
							<td style="text-align:center;width:10%"><img src="round-black.svg" style="height:16px;width:16px;"></td>
							<td style="text-align:left;padding-bottom:5px;padding-top:5px;border-left:1px solid;width:90%;font-size:15px;font-weight:bold;">&nbsp;&nbsp;Reference electrode</td>
						</tr>
						<tr>
							<td style="text-align:center;border-top:1px solid;width:10%"><img src="round-orange.svg" style="height:16px;width:16px;"></td>
							<td style="text-align:left;padding-bottom:5px;padding-top:5px;border-left:1px solid;width:90%;font-size:15px;font-weight:bold;border-top:1px solid;">&nbsp;&nbsp;Exposed Reference electrode</td>
						</tr>

					</table>
				</td>
			</tr>


			<table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
				<br><br>
				<tr>

					<td style="width:40%;text-align:left;font-weight:bold;">
						Page No. 1 of 1
					</td>
					<td style="width:60%;text-align:left;font-weight:bold;">
						. . . . . . .END OF REPORT. . . . . . .
					</td>
				</tr>

			</table>
			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
		</table>
	</page>
</body>

</html>

<script type="text/javascript">


</script>