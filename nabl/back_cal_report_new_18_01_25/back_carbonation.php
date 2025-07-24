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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from carbonation WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$mt_name= $row_select3['mt_name'];
			
			include_once 'sample_id.php';
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

	<br>
	<br><br>

	<page size="A4">
		
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;"> CARBONATION</td>
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
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date("d/m/Y",strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"> Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
						</table>
					</td>
				</tr>
				<br>


		<!-- <table align="center" width="100%" class="test1" height="15%">

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
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
			</tr>
		</table>
        <br> -->


		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri ;border:1px solid;">
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:14px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;">

						<tr style="">

							<td style="width:10%;font-weight:bold;padding-bottom:10px;text-align:center; ">Sr No.</td>
							<td style="border-left:1px solid;width:30%;font-weight:bold;text-align:center; ">Concrete Elements</td>
							<td style="border-left:1px solid;width:22%;font-weight:bold;text-align:center; ">Core Length,mm</td>
							<td style="border-left:1px solid;width:22%;font-weight:bold;text-align:center;padding-bottom:10px;padding-top:10px;  ">Avg Carbonation<br>Depth,mm</td>
							<td style="border-left:1px solid;width:16%;font-weight:bold;text-align:center;  ">Average pH</td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_1'] != "" && $row_select_pipe['con_1'] != null && $row_select_pipe['con_1'] != "0") {
																																							echo $row_select_pipe['con_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_1'] != "" && $row_select_pipe['len_1'] != null && $row_select_pipe['len_1'] != "0") {
																														echo $row_select_pipe['len_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_1'] != "" && $row_select_pipe['acd_1'] != null && $row_select_pipe['acd_1'] != "0") {
																														echo $row_select_pipe['acd_1'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_1'] != "" && $row_select_pipe['aph_1'] != null && $row_select_pipe['aph_1'] != "0") {
																														echo $row_select_pipe['aph_1'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_2'] != "" && $row_select_pipe['con_2'] != null && $row_select_pipe['con_2'] != "0") {
																																							echo $row_select_pipe['con_2'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_2'] != "" && $row_select_pipe['len_2'] != null && $row_select_pipe['len_2'] != "0") {
																														echo $row_select_pipe['len_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_2'] != "" && $row_select_pipe['acd_2'] != null && $row_select_pipe['acd_2'] != "0") {
																														echo $row_select_pipe['acd_2'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_2'] != "" && $row_select_pipe['aph_2'] != null && $row_select_pipe['aph_2'] != "0") {
																														echo $row_select_pipe['aph_2'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_3'] != "" && $row_select_pipe['con_3'] != null && $row_select_pipe['con_3'] != "0") {
																																							echo $row_select_pipe['con_3'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_3'] != "" && $row_select_pipe['len_3'] != null && $row_select_pipe['len_3'] != "0") {
																														echo $row_select_pipe['len_3'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_3'] != "" && $row_select_pipe['acd_3'] != null && $row_select_pipe['acd_3'] != "0") {
																														echo $row_select_pipe['acd_3'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_3'] != "" && $row_select_pipe['aph_3'] != null && $row_select_pipe['aph_3'] != "0") {
																														echo $row_select_pipe['aph_3'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_4'] != "" && $row_select_pipe['con_4'] != null && $row_select_pipe['con_4'] != "0") {
																																							echo $row_select_pipe['con_4'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_4'] != "" && $row_select_pipe['len_4'] != null && $row_select_pipe['len_4'] != "0") {
																														echo $row_select_pipe['len_4'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_4'] != "" && $row_select_pipe['acd_4'] != null && $row_select_pipe['acd_4'] != "0") {
																														echo $row_select_pipe['acd_4'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_4'] != "" && $row_select_pipe['aph_4'] != null && $row_select_pipe['aph_4'] != "0") {
																														echo $row_select_pipe['aph_4'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_5'] != "" && $row_select_pipe['con_5'] != null && $row_select_pipe['con_5'] != "0") {
																																							echo $row_select_pipe['con_5'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_5'] != "" && $row_select_pipe['len_5'] != null && $row_select_pipe['len_5'] != "0") {
																														echo $row_select_pipe['len_5'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_5'] != "" && $row_select_pipe['acd_5'] != null && $row_select_pipe['acd_5'] != "0") {
																														echo $row_select_pipe['acd_5'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_5'] != "" && $row_select_pipe['aph_5'] != null && $row_select_pipe['aph_5'] != "0") {
																														echo $row_select_pipe['aph_5'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_6'] != "" && $row_select_pipe['con_6'] != null && $row_select_pipe['con_6'] != "0") {
																																							echo $row_select_pipe['con_6'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_6'] != "" && $row_select_pipe['len_6'] != null && $row_select_pipe['len_6'] != "0") {
																														echo $row_select_pipe['len_6'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_6'] != "" && $row_select_pipe['acd_6'] != null && $row_select_pipe['acd_6'] != "0") {
																														echo $row_select_pipe['acd_6'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_6'] != "" && $row_select_pipe['aph_6'] != null && $row_select_pipe['aph_6'] != "0") {
																														echo $row_select_pipe['aph_6'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_7'] != "" && $row_select_pipe['con_7'] != null && $row_select_pipe['con_7'] != "0") {
																																							echo $row_select_pipe['con_7'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_7'] != "" && $row_select_pipe['len_7'] != null && $row_select_pipe['len_7'] != "0") {
																														echo $row_select_pipe['len_7'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_7'] != "" && $row_select_pipe['acd_7'] != null && $row_select_pipe['acd_7'] != "0") {
																														echo $row_select_pipe['acd_7'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_7'] != "" && $row_select_pipe['aph_7'] != null && $row_select_pipe['aph_7'] != "0") {
																														echo $row_select_pipe['aph_7'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_8'] != "" && $row_select_pipe['con_8'] != null && $row_select_pipe['con_8'] != "0") {
																																							echo $row_select_pipe['con_8'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_8'] != "" && $row_select_pipe['len_8'] != null && $row_select_pipe['len_8'] != "0") {
																														echo $row_select_pipe['len_8'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_8'] != "" && $row_select_pipe['acd_8'] != null && $row_select_pipe['acd_8'] != "0") {
																														echo $row_select_pipe['acd_8'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_8'] != "" && $row_select_pipe['aph_8'] != null && $row_select_pipe['aph_8'] != "0") {
																														echo $row_select_pipe['aph_8'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_9'] != "" && $row_select_pipe['con_9'] != null && $row_select_pipe['con_9'] != "0") {
																																							echo $row_select_pipe['con_9'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_9'] != "" && $row_select_pipe['len_9'] != null && $row_select_pipe['len_9'] != "0") {
																														echo $row_select_pipe['len_9'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_9'] != "" && $row_select_pipe['acd_9'] != null && $row_select_pipe['acd_9'] != "0") {
																														echo $row_select_pipe['acd_9'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_9'] != "" && $row_select_pipe['aph_9'] != null && $row_select_pipe['aph_9'] != "0") {
																														echo $row_select_pipe['aph_9'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
						<tr style="">
							<td style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++; ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:30%;text-align:center;padding-bottom:10px;padding-top:10px; "><?php if ($row_select_pipe['con_10'] != "" && $row_select_pipe['con_10'] != null && $row_select_pipe['con_10'] != "0") {
																																							echo $row_select_pipe['con_10'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['len_10'] != "" && $row_select_pipe['len_10'] != null && $row_select_pipe['len_10'] != "0") {
																														echo $row_select_pipe['len_10'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:22%;text-align:center; "><?php if ($row_select_pipe['acd_10'] != "" && $row_select_pipe['acd_10'] != null && $row_select_pipe['acd_10'] != "0") {
																														echo $row_select_pipe['acd_10'];
																													} else {
																														echo "-";
																													} ?></td>
							<td style="border-top:1px solid;border-left:1px solid;width:16%;text-align:center; "><?php if ($row_select_pipe['aph_10'] != "" && $row_select_pipe['aph_10'] != null && $row_select_pipe['aph_10'] != "0") {
																														echo $row_select_pipe['aph_10'];
																													} else {
																														echo "-";
																													} ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

			<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


			</div>
	</page>

</body>

</html>


<script type="text/javascript">

</script>