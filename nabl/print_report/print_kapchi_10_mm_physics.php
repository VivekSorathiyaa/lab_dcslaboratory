<?php
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0px 40px ;
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
	$select_tiles_query = "select * from rcc_10_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			include_once 'sample_id.php';
			if (
				strpos($row_select3["mt_name"], "WMM (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - IV MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - V MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - VI MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M5)") !== false ||
				strpos($row_select3["mt_name"], "GSB - I MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "GSB - II MIX (M4-1)") !== false ||
				strpos($row_select3["mt_name"], "GSB - III MIX (M4-2)") !== false ||
				strpos($row_select3["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
				strpos($row_select3["mt_name"], "Seal Coat") !== false ||
				strpos($row_select3["mt_name"], "Premix Carpet") !== false ||
				strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
				strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
				strpos($row_select3["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
			) {
				$mt_name = $row_select3['mt_name'];
			} else {
				$ans = substr($row_select3["mt_name"], strpos($row_select3["mt_name"], "(") + 1);
				$explodeing = explode(")", $ans);
				$mt_name = $explodeing[0];
			}
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$sample_de = $row_select4['sample_de'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}


	?>

<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - Properties of Aggregate</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $source; ?></td>
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

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp;&nbsp;
								<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
								$result_selectc = mysqli_query($conn, $select_queryc);

								if (mysqli_num_rows($result_selectc) > 0) {
									$row_selectc = mysqli_fetch_assoc($result_selectc);
									$ct_nm = $row_selectc['city_name'];
								}
								echo $clientname; ?>
							</td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp;Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp;<?php echo $agreement_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;ULR No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $_GET['ulr']; ?></td>
						</tr>
						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Name of EPC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;<?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;PMC</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo $row_select['pmc_name']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
						<tr>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp;Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:30%;font-weight:bold; text-align:center;padding-bottom:2px;padding-top:2px; ">Material Source</td>
							<td style="border-left: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 10 mm</td>

						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Sample Size</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; <?php echo $mt_name; ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; 1</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:30%;font-weight:bold;text-align:center;padding-bottom:2px;padding-top:2px;  ">Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:70%;text-align:left; ">&nbsp;&nbsp; IS:2386-1963   (Part-II,Part-III,Part-IV,)</td>
						</tr>

					</table><br>

				</td>
			</tr> -->


	<?php $cnt = 1; ?>
		<table width="100%" style="border-left:2px solid black; border-right:2px solid black;">
		    <tr style="display:flex;font-family : Calibri; ">
				<td>
					<table>
					<?php if (($row_select_pipe['pass_sample_1'] != "") && ($row_select_pipe['pass_sample_1'] != null) && ($row_select_pipe['pass_sample_1'] != "0")) { ?>
								<td width="100%" style="vertical-align:top;">
									<table align="left" width="100%" class="test" style="font-family : Calibri;">
										<tr>
											<td style="padding-bottom:4px;font-weight:bold;font-size:11px;" colspan="3">A) Sieves Analysis</td>
										</tr>
										<tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:7px 4px;" colspan="3">Particle Size Distribution Test</td>
										</tr>
										<tr>
											<td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:7px 4px;">IS 2386-1963 P-1, clause 2.0</td>
										</tr>


										<tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;font-weight:bold;width:30%;">I.S. Sieve Size</td>

											<td style="border-right:1px solid black;width:35%;">
												<table style="width:100%;border-collapse: collapse;">
													<tr>
														<td style="font-size:11px;text-align:center;border-bottom:0px solid black;font-weight:bold;padding:5px 4px;">Test Results</td>
													</tr>
													<tr style="">
														<td style="font-size:11px;text-align:center;font-weight:bold;border-top:1px solid black;padding:5px 4px;">% of Passing</td>
													</tr>
												</table>
											</td>
											
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;font-weight:bold;padding:7px;width:30%;">% of Passing <br> Req. as per IS 383 : 2016</td>
										</tr>

										
										<tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">12.5 mm</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;">100</td>
										</tr>
										<tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">10 mm</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;">85-100</td>
										</tr>
										<tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">4.75 mm</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;">0-20</td>
										</tr>
										<tr>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">2.36 mm</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
											<td style="font-size:11px;text-align:center;border:1px solid black;border-left:0px solid black;">0-5</td>
										</tr>
									</table>
								</td>
					<?php } ?>
					</table>
				</td>
				
				<td>
					<table>
					    <tr>
							<td>
								<table width="85%"  class="test" style="font-size:11px;font-family:Times New Roman;margin-left:40px;">
									<tr>
										<td style="font-weight:bold;">B) Other Tests</td>
									</tr>
								</table>
							</td>
				        </tr>

						<tr>
							<td  width="100%" style="text-align:center;font-size:11px; ">
							<table align="center" width="85%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-top:1px solid;">

								<tr style="">
									<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test</td>
									<td style="font-size:11px;border-left: 1px solid black;font-weight:bold;text-align:center;padding:10px 4px;">Acceptance Criteria as per IS:383 : 2016</td>
									<td style="font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;">Test Method</td>
									<td style="font-size:11px;border-left: 1px solid black;font-weight:bold;text-align:center;padding:10px 4px;" colspan="2">Test Result</td>
								</tr>

								
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"> Specific Gravity</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px; ">---</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">I.S 2386-3</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;font-weight:bold;padding:5px 4px;" colspan=2><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
							
						</tr>

						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px; ">Water Absorption(%)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px; ">Max. 2%</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px; ">I.S 2386-3</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;font-weight:bold;padding:5px 4px;" colspan=2><?php echo $row_select_pipe['sp_water_abr']; ?>1</td>
						</tr>

						<tr style="">
									<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"> Bulk Density (kg/lit) </td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 0;">---</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 0;">I.S 2386-3</td>
									<td style="border-left: 1px solid black;border-top: 1px solid black;font-weight:bold;text-align:center;padding:5px 0;" colspan=2><?php echo $row_select_pipe['bdl']; ?></td>
						</tr>

			
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Impact Value(%)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Max. 24%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 0;">I.S 2386-3</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" colspan=2><?php echo $row_select_pipe['imp_value']; ?></td>
						</tr>

						 <tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Crushing Value(%)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Max. 30%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 0;">I.S 2386-3</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" colspan=2><?php echo $row_select_pipe['cru_value']; ?></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Abrasion Value(%)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Max. 30%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">I.S 2386-3</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" colspan=2><?php echo $row_select_pipe['abr_index']; ?></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;" rowspan=2>Flakiness Index(%) & Elongation Index(%)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;" rowspan=2>Max. 35%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">F.l</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['combined_index']; ?></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">E.l</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;"><?php echo $row_select_pipe['combined_index']; ?></td>
						</tr> 

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Soundness by Na<sub>2</sub>SO<sub>4</sub></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Max 12%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">I.S 2386-5</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" colspan=2><?php echo $row_select_pipe['soundness']; ?></td>
						</tr>

						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Soundness by MgSO<sub>4</sub></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Max 18%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">I.S 2386-5</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" colspan=2></td>
						</tr>


						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; ">Alkali Aggregate Reactivity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px; "></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">I.S 2386-5</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;font-weight:bold;" colspan=2><?php echo $row_select_pipe['alk_11']; ?></td>
						</tr>

							</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>


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