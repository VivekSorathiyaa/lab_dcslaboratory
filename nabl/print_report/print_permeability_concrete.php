<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 12px;
		font-family : Calibri;
	}

	div.vertical-sentence {
		-ms-writing-mode: tb-rl;
		/* for IE */
		-webkit-writing-mode: vertical-rl;
		/* for Webkit */
		writing-mode: vertical-rl;

	}

	.rotate-characters-back-to-horizontal {
		-webkit-text-orientation: upright;
		/* for Webkit */
		text-orientation: upright;
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
	$page_cont = round_up($no_of_rows / 7);

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
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$cube_grade = $row_select4['cube_grade'];
		$casting_date = $row_select4['casting_date'];
		$day = $row_select4['day'];
		$day_remark = $row_select4['day_remark'];
		$cc_identification = $row_select4['cc_identification'];
		$cc_qty = $row_select4['cc_qty'];
		
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 7;
	/*for($a=1;$a<=$page_cont;$a++)		{
*/
	?>



<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report -   PERMEABILITY OF CONCRETE</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
					</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;--</td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part -->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width: 24.9%;">&nbsp;Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
					</tr>
					<?php } 
					if ($row_select['tpi_name'] != "") {
						?>
							
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $source; ?></td>
					</tr>-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cc_grade']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Casting Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $casting_date; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Day :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cc_day']; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Remarks :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $day_remark; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Identification Mark :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $cc_identification_mark; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Quantity / Report :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $cc_qty; ?></td>
					</tr>
					
					
					
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

			<!-- <tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp;
								<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								$result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; ?>
							</td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Name of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Accep.Letter No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp;W/623/4672/20- 21,dated-07. 11.2020</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Client</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px; ">&nbsp;&nbsp; Ref.No/Ref.Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:36%;text-align:left; ">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																																											if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																																											?> / Date : <?php echo date('d/m/Y', strtotime($row_select["date"]));
																																											} else {
																																											}
											?> </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">


						<?php
						$select_tilesy = "select * from permeability_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;


						?>

							<tr style="">

								<td style="border-left: 1px solid black;width:3%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px; "> 1</td>
								<td style="border-left: 1px solid black;width:15%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold;; ">Grade oF Concrete( By <?php if ($sample_sent_by == 1) {
																																														echo 'Agency';
																																													} else if ($sample_sent_by == 0) {
																																														echo 'Client';
																																													} ?> )</td>
								<td style="border-left: 1px solid black;width:5%; text-align:center;"> <?php echo $row_select_pipe['grade1']; ?><?php echo $row_select_pipe['cc_grade']; ?></td>
								<td style="border-left: 1px solid black;width:3%;font-weight:bold;text-align:center; " rowspan=2>3</td>
								<td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold;" rowspan=2>Client ID Mark</td>
								<td style="border-left: 1px solid black;width:21%;border-right: 1px solid;text-align:center;" rowspan=2><?php echo $row_select_pipe['cc_identification_mark']; ?></td>

							</tr>

							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:2%;font-weight:bold;text-align:center;padding-bottom:1px;padding-top:1px;  ">2</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:27%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold; ">Water Temp</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "> 27.1</td>
							</tr>

							<tr style="">

								<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px; "> 4</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;text-align:center;padding-bottom:3px;padding-top:3px;font-weight:bold;; ">Test Method</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:5%; text-align:center;">IS-516-1959</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:3%;font-weight:bold;text-align:center; ">5</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center;font-weight:bold;">Curing Condition</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;text-align:center;">&nbsp;&nbsp; 27 &plusmn; 2 &#8451;</td>

							</tr>

						<?php
							if ($flag == 7) {
								break;
							}
						}

						?>

					</table

				</td>
			</tr> -->

			<tr style="">
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                        <tr>
                        	<td style="border-top:0px solid;font-size:11px;border-left: 2px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;font-size:12px;text-align:left;padding:15px 0 10px;font-family:Times New Roman;font-weight:bold;border-right:2px solid">A) Concrete Cube Test Result.</td>
                        </tr>
                    </table>
                </td>
            </tr>

			<?php $cnt = 1; ?>
			<tr>
			    <td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid;border-top:0px solid;border-left:1px solid;border-right:2px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;"> Sr.<br>No.</td>
							<td style="width:10%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Sample ID</td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Date Of Casting *</td>
							<td style="width:12%;border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Date Of Testing</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Age Of Test <br> (days)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Result in mm</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Acceptance Criteria</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Grade</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">ID Mark / Location*</td>
						</tr>

						<?php
						$select_tilesy = "select * from permeability_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						$coming_row = mysqli_num_rows($result_tiles_select1);
						

						while ($row_select_pipe = mysqli_fetch_array($result_tiles_select1)) {
							$flag++;

							$length1 = $row_select_pipe['l1'];
							$width1 = $row_select_pipe['b1'];

							$length2 = $row_select_pipe['l2'];
							$width2 = $row_select_pipe['b2'];

							$length3 = $row_select_pipe['l3'];
							$width3 = $row_select_pipe['b3'];

							$formatted1 = round($length1, 0);
							$formatted2 = round($width1, 0);
							$formatted3 = round($length2, 0);
							$formatted4 = round($width2, 0);
							$formatted5 = round($length3, 0);
							$formatted6 = round($width3, 0);
						?>
						

							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $formatted1; ?> X <?php echo $formatted2; ?> mm</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['comp_1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;" rowspan=3>(As per IS 516 Part-2 See-1)<br> Apply a water pressure of 500 &#177; 50 Kpa for the duration of 72 &#177; 2h. <B> Max. 25 mm </b></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $cc_grade; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $formatted3; ?> X <?php echo $formatted4; ?> mm</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['comp_2']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $cc_grade; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
							</tr>


							<tr style="">
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $cnt++; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $formatted5; ?> X <?php echo $formatted6; ?> mm</td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;"><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['day1']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['comp_3']; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $cc_grade; ?></td>
								<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
							</tr>

						<?php
							if ($flag == 7) {
								break;
							}
						}
						?>
					</table>
				</td>
			</tr>
		</table>

		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
	</page>
	<?php

	/*if($flag==8)
				{
					$flag=0;
					$down=$up;
					$up +=8;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}
			
			
			}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">


</script>