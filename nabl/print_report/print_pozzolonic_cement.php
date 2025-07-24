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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from pozzolonic_cement WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$get_refno=$row_select["refno"];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$tpi_or_auth = $row_select['tpi_or_auth'];
	$pmc_heading = $row_select['pmc_heading'];
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
		$source = $row_select4['fine_agg_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$cement_brand = $row_select4['cement_brand'];
	}
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report -  PHYSICAL PROPERTIES OF POZZOLONIC CEMENT</td>
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
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Type Of Cement :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['type_of_cement'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cement_grade'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Brand :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cement_brand'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Week No. :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['week_number'];?></td>
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
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;
								<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								$result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; ?>
							</td>
							<td style="border-left: 1px solid black;width:15%; font-weight:bold;">&nbsp;&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:20%;">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp;Name of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:20%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; ULR No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp; <?php echo $_GET['ulr']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo "1 Bag " . $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Tender No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; W/623/4672/22-23</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%;border-right: 1px solid; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:42%;text-align:left; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold; ">&nbsp;&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:19%; border-right: 1px solid;">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>

			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; Material under Testing</td>
							<td style="border-left: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; Hi - Bond Ordinary Portland Cement - 53 ( <?php echo $row_select_pipe['type_of_cement']; ?> )</td>
							<td style="border-left: 1px solid black;width:12%; font-weight:bold;">&nbsp;&nbsp; Room Temp.(&deg;C)</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:18%;">&nbsp;&nbsp; <?php echo $row_select_pipe['con_temp']; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:15%;font-weight:bold;padding-bottom:1px;padding-top:1px;  ">&nbsp;&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:38%;text-align:left; ">&nbsp;&nbsp; 1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;font-weight:bold; ">&nbsp;&nbsp; Relative Humidity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:18%;border-right: 1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['con_humidity']; ?></td>
						</tr>

					</table><br>

				</td>
			</tr> -->

			<?php if ($row_select_pipe['type_of_cement'] == 'OPC' ){ ?>
			<?php $cnt = 1; ?>
		
		
			<tr>
				<td style="text-align:left;font-size:12px;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:0px solid;border-right:2px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;">Sr. No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:30%;" colspan=2>Particular of Test</td>
							
							<td style="border-top:1px solid;border-left: 1px solid black;width:100%;">
										<table style="width:100%;border-collapse: collapse;">
							   				<tr>
											     <td style="font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;" colspan=5>Specification Requirement (IS 269: 2015)</td>
											</tr>
											<tr>
												<td style="border-top:1px solid;font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;">OPC-33 Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-43 Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-53 Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-43S Grade</td>
												<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">OPC-53S Grade</td>
											</tr>
										</table>
						    </td>

							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Method of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Results</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight: bold;"><b><?php echo $cnt++; ?></B></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Setting Time</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Initial Setting Time (Minute)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;">Min. 30 minute</td>
											<td style="font-size:11px;text-align:center;padding:5px 4px">Min. 60 minute</td>
											</tr>
										</table>
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=2>IS 4031 (P-5) 1988 </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['initial_time'] == "" && $row_select_pipe['initial_time'] == null && $row_select_pipe['initial_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['initial_time']);
																																			} ?></td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Final Setting Time (minutes)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;">Max. 600 minute</td>
											<td style="font-size:11px;text-align:center;padding:5px 4px">Max. 600 minute</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['final_time'] == "" && $row_select_pipe['final_time'] == null && $row_select_pipe['final_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['final_time']);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?> </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Soundness, Le-Chatelier (mm)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 0px;">Max. Expansion 10 mm</td>
											<td style="font-size:11px;text-align:center;padding:5px 3px">Max. Expansion 5 mm</td>
											</tr>
										</table>
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-3) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['soundness'] == "" && $row_select_pipe['soundness'] == null && $row_select_pipe['soundness'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['soundness'], 1);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness By Blain Air Permeability (m<sup>2</sup>/Kg)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;">Min. 225 m<sup>2</sup>/Kg</td>
											<td style="font-size:11px;text-align:center;padding:5px 4px">Min. 370 m<sup>2</sup>/Kg</td>
											</tr>
										</table>
							</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS 4031 (P-2) 1999 </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['ss_area'] == "" && $row_select_pipe['ss_area'] == null && $row_select_pipe['ss_area'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['ss_area'], 0);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Density (gm/cc)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="font-size:11px;text-align:center;padding:5px 4px">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-11) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">3.10</td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Consistency (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            <table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="font-size:11px;text-align:center;padding:5px 4px;">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-4) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['final_consistency'], 1); ?></td>
						</tr>

						
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness by Dry Sieving(%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
											<tr>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:25%;">-</td>
											<td style="font-size:11px;text-align:center;padding:5px 4px">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-1)  1996</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_fbs'] == "" && $row_select_pipe['avg_fbs'] == null && $row_select_pipe['avg_fbs'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_fbs'], 2);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Compressive Strength (Mpa)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"  colspan=2>72 &plusmn; 1 hr. (Mpa) Minimum</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">16 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">23 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">27 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">23 Mpa</td>
												<td style="font-size:11px;text-align:center;padding:5px 4px;width:20%;">27 Mpa</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=3>IS 4031 (P-6) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_1'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 168 &plusmn; 2 hr. (Mpa) Minimum</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										<table style="width:100%;border-collapse: collapse;">
										<tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">22 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">33 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">37 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">37.5 Mpa</td>
												<td style="font-size:11px;text-align:center;padding:5px 4px;width:20%;">37.5 Mpa</td>
											</tr>
										</table>
						   </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != null && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != "NaN") {echo number_format($row_select_pipe['avg_com_2'], 1);} else {echo "-";} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">c</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 672 &plusmn; 4 hr. (Mpa) Minimum </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
						      			<table style="width:100%;border-collapse: collapse;">
										  <tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">33 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">43 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">53 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">43 Mpa</td>
												<td style="font-size:11px;text-align:center;padding:5px 4px;width:20%;">53 Mpa</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != null && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != "NaN") { echo number_format($row_select_pipe['avg_com_3'], 1);} else {echo "-";} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:right;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> max. </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
						      			<table style="width:100%;border-collapse: collapse;">
										    <tr>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">48 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">58 Mpa</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">-</td>
												<td style="border-right:1px solid black;font-size:11px;text-align:center;padding:5px 4px;width:20%;">-</td>
												<td style="font-size:11px;text-align:center;padding:5px 4px;width:20%;">-</td>
											</tr>
										</table>
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>



					</table>

				</td>
			</tr>
			<?php }
			if ($row_select_pipe['type_of_cement'] == 'PPC' ){ ?>
			<?php $cnt = 1; ?>
			<br>
			<tr>
				<td style="text-align:left;font-size:12px;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;">Sr. No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:30%;" colspan=2>Particular of Test</td>
							
							<td style="border-top:1px solid;border-left: 1px solid black;width:37%;">
										<table style="width:100%;border-collapse: collapse;">
							   				<tr>
											     <td style="font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;" >Specification Requirement (IS 1489: 2015)</td>
											</tr>
											<tr>
												<td style="border-top:1px solid;font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;">PPC Cement</td>
											</tr>
										</table>
						    </td>

							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Method of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Results</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Setting Time</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Initial Setting Time (Minute)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							Min. 30 minute
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=2>IS 4031 (P-5) 1988 </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['initial_time'] == "" && $row_select_pipe['initial_time'] == null && $row_select_pipe['initial_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['initial_time']);
																																			} ?></td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Final Setting Time (minutes)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							      Max. 600 minute	
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['final_time'] == "" && $row_select_pipe['final_time'] == null && $row_select_pipe['final_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['final_time']);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?> </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Soundness, Le-Chatelier (mm)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							      Max. Expansion 10 mm    
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-3) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['soundness'] == "" && $row_select_pipe['soundness'] == null && $row_select_pipe['soundness'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['soundness'], 1);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness By Blain Air Permeability (m<sup>2</sup>/Kg)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">
							      Min. 300 m<sup>2</sup>/Kg	
							</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS 4031 (P-2) 1999 </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['ss_area'] == "" && $row_select_pipe['ss_area'] == null && $row_select_pipe['ss_area'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['ss_area'], 0);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Density (gm/cc)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										---
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-11) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">3.10</td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Consistency (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            ---
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-4) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['final_consistency'], 1); ?></td>
						</tr>

						
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness by Dry Sieving(%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										---
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-1)  1996</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_fbs'] == "" && $row_select_pipe['avg_fbs'] == null && $row_select_pipe['avg_fbs'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_fbs'], 2);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Compressive Strength (Mpa)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"  colspan=2>72 &plusmn; 1 hr. (Mpa) Minimum</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							   16 Mpa
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=3>IS 4031 (P-6) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_1'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 168 &plusmn; 2 hr. (Mpa) Minimum</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
									22 Mpa
						   </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != null && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_2'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">c</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 672 &plusmn; 4 hr. (Mpa) Minimum </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
									33 Mpa
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != null && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_3'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>
					</table>

				</td>
			</tr>
			

			<?php }
			if ($row_select_pipe['type_of_cement'] == 'PSC' ){ ?>
			<?php $cnt = 1; ?>
			
			<tr>
				<td style="text-align:left;font-size:12px;">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:0px solid;border-right:2px solid;border-left:1px solid;border-top:0px solid;">

						<tr style="">
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:5%;">Sr. No.</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:30%;" colspan=2>Particular of Test</td>
							
							<td style="border-top:0px solid;border-left: 1px solid black;width:37%;">
										<table style="width:100%;border-collapse: collapse;">
							   				<tr>
											     <td style="font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;" >Specification Requirement (IS 1489: 2015)</td>
											</tr>
											<tr>
												<td style="border-top:1px solid;font-size:11px;text-align:center;font-weight:bold;padding:10px 4px;">PSC Cement</td>
											</tr>
										</table>
						    </td>

							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Method of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Results</td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Setting Time</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Initial Setting Time (Minute)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							Min. 30 minute
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=2>IS 4031 (P-5) 1988 </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['initial_time'] == "" && $row_select_pipe['initial_time'] == null && $row_select_pipe['initial_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['initial_time']);
																																			} ?></td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Final Setting Time (minutes)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							      Max. 600 minute	
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['final_time'] == "" && $row_select_pipe['final_time'] == null && $row_select_pipe['final_time'] == "0") {
																																				echo "-";
																																			} else {
																																				echo round($row_select_pipe['final_time']);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?> </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Soundness, Le-Chatelier (mm)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							      Max. Expansion 10 mm    
							</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-3) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['soundness'] == "" && $row_select_pipe['soundness'] == null && $row_select_pipe['soundness'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['soundness'], 1);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness By Blain Air Permeability (m<sup>2</sup>/Kg)</td>
							<td style="border-left: 1px solid black;width:20%;border-top:1px solid;text-align:center;">
							      Min. 300 m<sup>2</sup>/Kg	
							</td>
							<td style="border-left: 1px solid black;width:15%;border-top:1px solid;text-align:center;padding-bottom:5px;padding-top:5px;">IS 4031 (P-2) 1999 </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['ss_area'] == "" && $row_select_pipe['ss_area'] == null && $row_select_pipe['ss_area'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['ss_area'], 0);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Density (gm/cc)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										---
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-11) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">3.10</td>
						</tr>



						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> Consistency (%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							            ---
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-4) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php echo number_format($row_select_pipe['final_consistency'], 1); ?></td>
						</tr>

						
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2>Fineness by Dry Sieving(%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
										---
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS:4031 (P-1)  1996</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_fbs'] == "" && $row_select_pipe['avg_fbs'] == null && $row_select_pipe['avg_fbs'] == "0") {
																																				echo "-";
																																			} else {
																																				echo number_format($row_select_pipe['avg_fbs'], 2);
																																			} ?></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> <?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;" colspan=2>Compressive Strength (Mpa)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
						</tr>


						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"  colspan=2>72 &plusmn; 1 hr. (Mpa) Minimum</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
							   16 Mpa
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" rowspan=3>IS 4031 (P-6) 1988</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_1'] != "" && $row_select_pipe['avg_com_1'] != null && $row_select_pipe['avg_com_1'] != "0" && $row_select_pipe['avg_com_1'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_1'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 168 &plusmn; 2 hr. (Mpa) Minimum</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
									22 Mpa
						   </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">
							<?php if ($row_select_pipe['avg_com_2'] != "" && $row_select_pipe['avg_com_2'] != null && $row_select_pipe['avg_com_2'] != "0" && $row_select_pipe['avg_com_2'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_2'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
						</tr>


						<tr style="">
						    <td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">c</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" colspan=2> 672 &plusmn; 4 hr. (Mpa) Minimum </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;">
									33 Mpa
						    </td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;"><?php if ($row_select_pipe['avg_com_3'] != "" && $row_select_pipe['avg_com_3'] != null && $row_select_pipe['avg_com_3'] != "0" && $row_select_pipe['avg_com_3'] != "NaN") {
																																				echo number_format($row_select_pipe['avg_com_3'], 1);
																																			} else {
																																				echo "-";
																																			} ?></td>
							
						</tr>
					</table>

				</td>
			</tr>
			<?php }?>



			<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;">
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

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>