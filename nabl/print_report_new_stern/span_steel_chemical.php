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
	$select_tiles_query = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 5);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

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
			$mt_name = $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0'";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$dia = explode(",", $row_select4['steel_dia']);
		$grade = $row_select4['steel_grade'];
		$brand = $row_select4['steel_brand'];
		$sample_qty1 = $row_select4['steel_sample_qty'];
		$heat = $row_select4['steel_heat'];
		$steel_qty = $row_select4['steel_sample_qty'];
		$steel_source_name = $row_select4['steel_source_name'];
		$grade_data = explode(",", $row_select4['steel_grade']);
	}

	$flag = 0;
	$a = 1;
	$down = 0;
	$up = 5;
	/*for($a=0;$a<$page_cont;$a++)
			{*/
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report -  STEEL CHEMICAL</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 14%;padding: 0 2px;text-align: right;">&nbsp;Sample ID No :-</td>
							<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: center;border-left: 1px solid;text-align: right;">&nbsp;Report Date :-</td>
							<td style="padding: 0 2px;text-align: center;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Metal &amp; Alloy</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Chemical</td>
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
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;width: 24.9%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $row_select4['steel_sample_qty'];?></td>
					</tr>-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Select Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php 
						$rr = explode(",",$row_select4['steel_grade']);
						echo $rr[0];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Name Of Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_source_name'];?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Brand :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php 
						$rr1 = explode(",",$row_select4['steel_brand']);
						echo $rr1[0];
						//echo $row_select4['steel_brand'];?></td>
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

		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
			 

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:12px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:2px solid;border-left:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;border-top:0px solid;width:5%;font-weight:bold; text-align:center; ">Sr.<br>NO.</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:13%;text-align:center;font-weight:bold; ">ID No.</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:13%; text-align:center;font-weight:bold;">Dia.(mm)</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:14%;font-weight:bold;text-align:center; ">carbon<br> %</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:14%;text-align:center;font-weight:bold;">Sulphur<br> %</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:14%;text-align:center;font-weight:bold;">Phosphorus <br>%</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:14%;text-align:center;font-weight:bold;">Manganese <br>%</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:14%;text-align:center;font-weight:bold;">Silicon <br>%</td>
							<td style="border-left: 1px solid black;border-top:0px solid;width:14%;border-right: 1px solid;text-align:center;font-weight:bold;"> Carbon Equivalent <br> %</td>
						</tr>
						<?php
							$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
							$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
							$coming_row = mysqli_num_rows($result_tiles_select1);

							while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
								$flag++;
							?>
						<tr style="">
							<td style="border-left: 1px solid black;width:6%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;width:12%;text-align:center;border-top:1px solid;padding:5px 0px;"><?php echo $row_select_pipe2['labno2'];?></td>
							
							<td style="border-left: 1px solid black;width:12%; text-align:center;border-top:1px solid;"><?php echo $row_select_pipe2['dia']." MM";  ?></td>
							
							<td style="border-left: 1px solid black;width:14%;text-align:center; border-top:1px solid;"><?php if ($row_select_pipe2['c1'] != "" && $row_select_pipe2['c1'] != null && $row_select_pipe2['c1'] != "0") {
																															echo $row_select_pipe2['c1'];
																														} else {
																															echo "-";
																														} ?></td>

							
							<td style="border-left: 1px solid black;width:14%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe2['c2'] != "" && $row_select_pipe2['c2'] != null && $row_select_pipe2['c2'] != "0") {
																																					echo $row_select_pipe2['c2'];
																																				} else {
																																					echo "-";
																																				} ?></td>

							<td style="border-left: 1px solid black;width:14%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe2['c3'] != "" && $row_select_pipe2['c3'] != null && $row_select_pipe2['c3'] != "0") {
																																					echo $row_select_pipe2['c3'];
																																				} else {
																																					echo "-";
																																				} ?></td>

							

							<td style="border-left: 1px solid black;width:14%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe2['c5'] != "" && $row_select_pipe2['c5'] != null && $row_select_pipe2['c5'] != "0") {
																																					echo $row_select_pipe2['c5'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="border-left: 1px solid black;width:14%;border-top:1px solid;text-align:center;"><?php if ($row_select_pipe2['c4'] != "" && $row_select_pipe2['c4'] != null && $row_select_pipe2['c4'] != "0") {
																																					echo $row_select_pipe2['c4'];
																																				} else {
																																					echo "-";
																																				} ?></td>
							<td style="border-left: 1px solid black;border-right: 1px solid black;width:14%;border-top:1px solid;text-align:center;"><?php 
							
							
							
							if ($row_select_pipe2['c5'] != "" && $row_select_pipe2['c5'] != null && $row_select_pipe2['c5'] != "0") {
																																					
										$c1 = 	$row_select_pipe2['c1'];
										$c5 = 	$row_select_pipe2['c5'];
										$c6 = 	$row_select_pipe2['c6'];
										$c9 = 	$row_select_pipe2['c9'];
										$c11 = 	$row_select_pipe2['c11'];
										$c8 = 	$row_select_pipe2['c8'];
										$c9 = 	$row_select_pipe2['c9'];
										
										$for1 = floatval($c1);
										$for2 = floatval($c5) / 6;
										$for3 = (floatval($c6) + floatval($c9) + floatval($c11)) / 5;
										$for4 = (floatval($c8) + floatval($c9)) / 15;
										
										$ans =  floatval($for1) +  floatval($for2) +  floatval($for3) +  floatval($for4);
										echo number_format($ans,2);

										} else {
																																					echo "-";
																																				} ?></td>

							
						</tr>
						<?php
								if ($flag == 5) {
									break;
								}
							}

							?>
							
							
						<!--<tr style="">
							<td style="border-left: 1px solid black;width:18%;text-align:center;border-top:1px solid;font-weight:bold;padding-bottom:3px;padding-top:3px; " colspan=2>IS Limit</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:12%; text-align:center;border-top:1px solid;">--</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:14%; text-align:center;border-top:1px solid;">Max.0.300</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:14%; text-align:center;border-top:1px solid;">Max.0.040</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:14%; text-align:center;border-top:1px solid;">Max.0.040</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:14%; text-align:center;border-top:1px solid;">Max.0.075</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:14%; text-align:center;border-top:1px solid;">--</td>
							<td style="font-weight:bold;border-left: 1px solid black;border-right: 1px solid black;width:14%; text-align:center;border-top:1px solid;">--</td>
						</tr>

						<tr style="">
							<td style="font-weight:bold;border-left: 1px solid black;width:30%;text-align:center;border-top:1px solid;padding-bottom:9px;padding-top:9px; " colspan=4>Reference Based On:-</td>
							<td style="font-weight:bold;border-left: 1px solid black;width:70%; text-align:center;border-top:1px solid;" colspan=5>IS 8811 : l998</td>
						</tr>
						-->

					</table>

				</td>
			</tr>
			
			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;font-family:Times New Roman;border-right:2px solid;border-left:2px solid;"> Requirement as per IS l786 - 2008</td>
                            </tr>
                        </table>
                    </td>
            </tr>
				
			<tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px; border-right:2px solid;border-left:2px solid;">             
										<tr>
											<td rowspan="2" style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Sr.<br> No.</td>
											<td rowspan="2" style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Property</td>
											<td colspan="7" style="font-size:11px;text-align:center;border-top:1px solid black;border-right:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Steel Grade</b></td>
										</tr>
										<tr>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415D</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 600</b></td>
										</tr>
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;">1</td>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Sulphar & Phosphourus in % (max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.110</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.085</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.105</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.075</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.100</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.075</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.075</td>
										</tr>
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;">2</td>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Sulphar in % (max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.060</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.045</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.055</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.040</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.055</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.040</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.040</td>
										</tr>
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;">3</td>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Phosphourus in % (max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.060</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.045</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.055</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.040</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.050</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.040</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.040</td>
										</tr>
										<tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;">4</td>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Carbon in % (max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.300</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.250</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.300</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.250</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.300</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.250</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.300</td>
										</tr>
								</table>

							</td>
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