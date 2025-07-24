<?php
include("../connection.php");
include("function_calling.php");
session_start();

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
	$select_tiles_query = "select * from rcc_10_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	//$page_cont = round_up($no_of_rows / 5);
	//$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

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

	$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}
	
	?>





	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - COARSE AGGREGATE</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 22%;padding: 0 2px;text-align: left;">&nbsp;Sample ID No :-</td>
							<td style="padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;width:11%;">&nbsp;Report Date :-</td>
							<td style="text-align: left;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:22%;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;width:37.6%;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;width:11%;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
						</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part -->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;width: 22%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					<tr>
						<td style="border: 1px solid;padding: 1px 0;text-align: left;" colspan="4"></td>
						
					</tr>
					
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight: bold;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;width:5%;font-weight: bold;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 0px solid;text-align: left;font-weight: bold;"colspan="2">&nbsp;To &nbsp; <?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $row_select4['steel_sample_qty'];?></td>
					</tr>-->
					
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;font-weight: bold;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;font-weight: bold;" colspan="3">&nbsp;<?php echo $source; ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mill Heat No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_heat'];?></td>
					</tr>-->
					
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;border-top:0px;border-bottom:0px;">
			<tr>
				<td  colspan="5"  style="font-weight:bold; text-align:left;border:1px solid;border-top:0px;">TEST RESULT</td>	
				
			</tr>
			<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="5"></td>
					</tr>
	</table>		
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;border-top:0px;">
			
			<tr>
				<td width="10%" style="font-weight:bold; text-align:center;border:1px solid;border-right:1px;">Item</td>	
				<td width="30%" style="font-weight:bold; text-align:center;border:1px solid;border-right:1px;">Tests</td>	
				<td width="15%" style="font-weight:bold; text-align:center;border:1px solid;border-right:1px;">Test Method Ref.</td>	
				<td width="15%" style="font-weight:bold; text-align:center;border:1px solid;border-right:1px;">Results Obtained</td>	
				<td width="25%" style="font-weight:bold; text-align:center;border-bottom:0px;border:1px solid;">Requirement as per <br> IS 383-2016</td>	
			</tr>
			<tr>
				<td style="text-align:center;padding:1px;border:1px ;"colspan="5"></td>	
			</tr>
			
			<?php 
			$cnt=0;
			if($row_select_pipe['pass_sample_1'] != ""  && $row_select_pipe['pass_sample_1'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-right:0px;"rowspan="5"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-right:0px;">&nbsp;&nbsp; Gradation percent passingon IS Sieve </td>	
				<td rowspan="7" style="text-align:center;border:1px solid;border-right:0px;"> IS 2386:1963 <br> (Part-1)</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-right:0px;"> - </td>	
				<td style="text-align:center;border:1px solid;"> - </td>	
			</tr>
			<tr>
				
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; 12.5 mm </td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['pass_sample_1'] != ""  && $row_select_pipe['pass_sample_1'] != null){ echo $row_select_pipe['pass_sample_1']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> 100 </td>	
			</tr>
			<tr>
				
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; 10 mm</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != null){ echo $row_select_pipe['pass_sample_2']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> 85-100 </td>	
			</tr>
			<tr>
				
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; 4.75 mm</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != null){ echo $row_select_pipe['pass_sample_3']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> 0-20 </td>	
			</tr>
			<tr>
				
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; 2.36 mm </td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != null){ echo $row_select_pipe['pass_sample_4']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> 0-5 </td>	
			</tr>
			<?php }if($row_select_pipe['fi_index'] != "" && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Flakiness Index (%) </td>	
				<!--<td style="text-align:center;"> IS 2386: 1963 <br> (Part-1)</td>-->	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['fi_index'] != "" && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null){ echo $row_select_pipe['fi_index']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"rowspan="2"> Maximum 40% (Combine) </td>	
			</tr>
			<?php }if($row_select_pipe['ei_index'] != "" && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Elongation Index (%)</td>	
				<!--<td style="text-align:center;"> IS 2386: 1963 <br> (Part-1)</td>-->	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['ei_index'] != "" && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null){ echo $row_select_pipe['ei_index']; } else{ echo "-";}?></td>	
				<!--<td style="text-align:center;"> Maximum 40% (Combine) </td>-->	
			</tr>
			<?php }if($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Bulk density kg/m<sup>3</sup> </td>
				<td rowspan="3" style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"> IS 2386 : 1963 <br> (Part-3) </td>					
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null){ echo $row_select_pipe['bdl']; } else{ echo "--";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> -- </td>	
			</tr>
			<?php 
			}
			if($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Specific Gravity </td>	
				
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null){ echo number_format($row_select_pipe['sp_specific_gravity'],2); } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;">  2.1-3.2 </td>	
			</tr>
			
			
			<?php }if($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Water absorption (%)</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null){ echo $row_select_pipe['sp_water_abr']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> 5.00% </td>	
			</tr>
			<?php }?>
			
			<?php if($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Impact value (%) </td>
				<td rowspan="3" style="text-align:center;border:1px solid;border-top:0px;border-right:0px;">IS 2386:1963 <br> (Part-4)</td>
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null){ echo $row_select_pipe['imp_value']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;">30% Max for WS / 45% Max for NWS</td>	
			</tr>
			<?php }?>
			
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Crushing value (%) </td>	
				
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null){ echo $row_select_pipe['cru_value']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;">30% Max for WS / 45% Max for NWS</td>	
			</tr>
			
			
			
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Loss Angels Abrasion Value (%)</td>		
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null){ echo $row_select_pipe['abr_index']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;">30% Max for WS / 50% Max for NWS</td>	
			</tr>
			<?php if($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Soundness (%)</td>	
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;">IS 2386:1963 <br> (Part-5)</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null){ echo $row_select_pipe['soundness']; } else{ echo "-";}?></td>	
				<?php if($row_select_pipe['sou_con']=="con2"){?>
				<td style="text-align:center;border:1px solid;border-top:0px;"> (18% when tested with MgSo<sub>4</sub>)</td>
				<?php }else {?>
				<td style="text-align:center;border:1px solid;border-top:0px;"> (12% when tested with Na<sub>2</sub>So<sub>4</sub>)</td>
				<?php }?>
			</tr>
			
			<?php }if($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; 10% Fine Value (%)</td>	
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"> IS 2386: 1963 <br> (Part-4)</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null){ echo $row_select_pipe['fines_value']; } else{ echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;">30% Mas for WS/Min. 50kN Load for NWS</td>	
			</tr>
			<?php }if($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null && $row_select_pipe['dele_2_3'] != "undefined"){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Deleterious Material (%)</td>	
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"> IS 2386: 1963 <br> (Part-2)</td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['dele_2_3']!="" && $row_select_pipe['dele_2_3']!=null && $row_select_pipe['dele_2_3']!="0"){
					  $a = $row_select_pipe['dele_3_3'];
					  $b = $row_select_pipe['dele_2_3'];
					  $c = $row_select_pipe['dele_1_4'];
					
					$ans = floatval($a) + floatval($b) + floatval(c);
					
					
					echo number_format($ans,2);}else{echo "-";}?></td>	
				<td style="text-align:center;border:1px solid;border-top:0px;"> Max 1% by Mass</td>	
			</tr>
			<?php }if($row_select_pipe['alk_1'] != "" && $row_select_pipe['alk_1'] != "0" && $row_select_pipe['alk_1'] != null){?>
			<tr>
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Alkali Aggregate reactivity</td>	
				<td style="text-align:center;border:1px solid;border-top:0px;border-right:0px;"> IS 2386: 1963 <br> (Part-7)</td>	
				<td  colspan="2" style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;"><?php if($row_select_pipe['alk_1']!="" && $row_select_pipe['alk_1']!=null && $row_select_pipe['alk_1']!="0"){?>
					
					<select style="font-weight:bold;font-size:11px;" onchange="put_details()" id="abc">
					<option>Alkali Silica Reaction shall not be positive (Satisfactory)</option>
					<option>Alkali Silica Reaction shall positive (Not Satisfactory)</option></select>
					
					<?php }else{echo "-";}?></td>
			</tr>
			<?php }if($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null){?>
			<tr>
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Chloride Content (%)</td>	
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> IS 2386: 1963 <br> (Part-7)</td>	
				<td style="text-align:center; font-weight:bold;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['avg_clr'] != "" && $row_select_pipe['avg_clr'] != "0" && $row_select_pipe['avg_clr'] != null){ echo $row_select_pipe['avg_clr']; } else{ echo "-";}?></td>	
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;"> - </td>	
			</tr>
			<?php }if($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null){?>
			<tr>
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Sulphate Content (%)</td>	
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> IS 2386: 1963 <br> (Part-7)</td>	
				<td style="text-align:center; font-weight:bold;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null){ echo $row_select_pipe['avg_sul']; } else{ echo "-";}?></td>	
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;"> - </td>	
			</tr>
			<?php }if($row_select_pipe['strip_per'] != "" && $row_select_pipe['strip_per'] != "0" && $row_select_pipe['strip_per'] != null){?>
			<tr>
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"><?php $cnt++; echo $cnt;?></td>	
				<td style="text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;">&nbsp;&nbsp; Stripping Value (%)</td>	
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> IS 6241 -1971 </td>	
				<td style="text-align:center; font-weight:bold;text-align:center; font-weight:bold;border:1px solid;border-top:0px;border-right:0px;"> <?php if($row_select_pipe['strip_per'] != "" && $row_select_pipe['strip_per'] != "0" && $row_select_pipe['strip_per'] != null){ echo $row_select_pipe['strip_per']; } else{ echo "-";}?></td>	
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px solid;border-top:0px;"> - </td>	
			</tr>
			<?php }?>
			<tr>
				<td style="text-align:center;text-align:center; font-weight:bold;border:1px ;padding:1px;"colspan="5"></td>	
			</tr>
		</table>

		<!-- footer design -->
		
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



<!-- old code -->


		<!-- <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:80px;">
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:11px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr.<br>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bar Dia (mm) *</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Mass in Kg/m</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area (mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Yield Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Tensile Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Elongation %</td>
							<td colspan="15" style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bend & Rebend Test</td>
						</tr>

						<?php
								$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								// $coming_row = mysqli_num_rows($result_tiles_select1);

								while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
								
								?>
						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"> <?php echo $cnt++; ?></td>
								

							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe2['dia_1'];  ?></td>
							


		<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['w_1'] != "" && $row_select_pipe2['w_1'] != null && $row_select_pipe2['w_1'] != "0") {
																															if ($row_select_pipe2['dia_1'] == "8 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "10 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "12 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "16 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "20 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "25 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "32 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "4 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "5 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "6 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "28 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "36 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "40 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "45 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "50 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) . "<br>" . "(15.42)";
																															};
																																	} else {
																																		echo "-";
																																	} ?></td>

							
					<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['cs_1'] != "" && $row_select_pipe2['cs_1'] != null && $row_select_pipe2['cs_1'] != "0") {echo $row_select_pipe2['cs_1'];} else {echo "-";} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ys_1'] != "" && $row_select_pipe2['ys_1'] != null && $row_select_pipe2['ys_1'] != "0") {echo $row_select_pipe2['ys_1'];} else {echo "-";} ?></td>

					
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ten_1'] != "" && $row_select_pipe2['ten_1'] != null && $row_select_pipe2['ten_1'] != "0") {
																																								echo $row_select_pipe2['ten_1'];
																																							} else {
																																								echo "-";
																																							} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['elo_1'] != "" && $row_select_pipe2['elo_1'] != null && $row_select_pipe2['elo_1'] != "0") {
																																							echo $row_select_pipe2['elo_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>

						
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['bend_1'] != "" && $row_select_pipe2['bend_1'] != null && $row_select_pipe2['bend_1'] != "0" && $row_select_pipe2['bend_1'] != "undefined") {
																																							echo $row_select_pipe2['bend_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							



						
					</tr>
					<?php
								/* if ($flag6 == 5) {
									break;
								} */
							}

							?>

						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>Method of Test</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1786-2008</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>IS 1608-2022 (Part-1)</td>
							<td colspan="15" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1599-2019</td>
						</tr>
					</table>


				</td>
			</tr>

			    <tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI-8.1, Table-3 (Amend No. 1 to IS 1786 : 2008)</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Property</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415D</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 600</b></td>
										</tr>
										
										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Yield Stress (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Tensile Stress N/mm<sup>2</sup> . Min/ % more than actual Yield stress</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">485 / 10%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">500 / 12%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">545 / 81%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">565 / 10%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">585 / 6%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600 / 8%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">660 / 6%</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Elongation % (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">14.5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">18</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">12</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">16</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">14.5</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
										</tr>

										<tr>
											<td style="font-size:11px;text-align:left;border:1px solid black;padding:5px 4px;" >&nbsp; Bend Test</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;padding:5px 4px;" colspan=7> There Shall not be any transverse crack/ruputre in the bent portion</td>
                           				 </tr>
								</table>

							</td>
            </tr>


			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI6.3 & 7.2.3</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;margin-bottom:10px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Diameter in mm</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>4</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>5</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>6</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>8</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>10</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>12</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>16</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>20</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>25</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>28</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>32</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>36</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>40</b></td>
										</tr>
										
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Mass per meter (Kg)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.099</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.154</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.222</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.395</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.617</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.888</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">1.580</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">2.470</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.850</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.830</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">6.310</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">7.990</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">9.860</td>
											</tr>
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Tolerances on Nominal Mass</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="5">-8%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="2">-6%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;" colspan="6">-4%</td>
											</tr>
								</table>

							</td>
            </tr>			
		</table> -->

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
	</page>
	<?php

	/*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}*/


	/*}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>