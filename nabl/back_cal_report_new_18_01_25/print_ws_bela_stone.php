<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
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
	$select_tiles_query = "select * from ws_bela_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	// $sr_no = $row_select['sr_no'];
	// $sample_no = $row_select['job_no'];
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
		$mark = $row_select4['brick_mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>

	<page size="A4">
		<br>
		<br>
		<table align="center" width="92%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
			<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 1</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BELLA </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
								
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
		</table>
		<br>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td colspan="4" style="border: 0px solid black;font-size:14px;padding: 4px;"><b>&nbsp; 1. True Specific Gravity (IS 1122)</b></td>
			</tr>
		</table>


		<br>

		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">

			<tr>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;padding: 4px;">Sr No</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Description</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Result of Test</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">1</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Room Temperature, tin°C</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['tsg1'] != "" && $row_select_pipe['tsg1'] != "0" && $row_select_pipe['tsg1'] != null) {
																						echo $row_select_pipe['tsg1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">2</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of the empty specific gravity bottle with stopper, W1in g.</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['tsg2'] != "" && $row_select_pipe['tsg2'] != "0" && $row_select_pipe['tsg2'] != null) {
																						echo $row_select_pipe['tsg2'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">3</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of the bottle with stopper and powder, w2 in g</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['tsg3'] != "" && $row_select_pipe['tsg3'] != "0" && $row_select_pipe['tsg3'] != null) {
																						echo $row_select_pipe['tsg3'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">4</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of the bottle with stopper, powder and distilled water to fill rest of the bottle at room temperature,w3 in g</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['tsg4'] != "" && $row_select_pipe['tsg4'] != "0" && $row_select_pipe['tsg4'] != null) {
																						echo $row_select_pipe['tsg4'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">5</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of the bottle with stopper filled with distilled water at room temperature, W4 in g</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['tsg5'] != "" && $row_select_pipe['tsg5'] != "0" && $row_select_pipe['tsg5'] != null) {
																						echo $row_select_pipe['tsg5'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">6</td>
				<td style="border: 1px solid black;">&nbsp; True specificgravity@t °C</td>
				<td style="border: 1px solid black;text-align:center;">
					<div>
						<span style="border-bottom:1px solid black;width:100px;margin:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(W2 - W1)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <br>
						<span style="margin:5px;">(W4 - W2)- (W3 - W2) </span>
					</div>
				</td>
				<td style="border: 1px solid black;text-align:center;width:30%;font-weight:bold;"><?php if ($row_select_pipe['tsg6'] != "" && $row_select_pipe['tsg6'] != "0" && $row_select_pipe['tsg6'] != null) {
																										echo $row_select_pipe['tsg6'];
																									} else {
																										echo "-";
																									} ?></td>
			</tr>
		</table>

		<br>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td colspan="4" style="border: 0px solid black;font-size:14px;padding: 4px;"><b>&nbsp; 2. Apparent Specific Gravity (IS 1124)</b></td>
			</tr>
		</table>		<br>

		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
	
			<tr>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;padding: 4px;">Sr No</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Description</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Result of Test</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">1</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of oven dry test piece,</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['asg1'] != "" && $row_select_pipe['asg1'] != "0" && $row_select_pipe['asg1'] != null) {
																						echo $row_select_pipe['asg1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">2</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Quantity of water added in 1000 ml jar containing the test piece, C in g</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['asg2'] != "" && $row_select_pipe['asg2'] != "0" && $row_select_pipe['asg2'] != null) {
																						echo $row_select_pipe['asg2'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">3</td>
				<td style="border: 1px solid black;">&nbsp; Apparent Specific Gravity</td>
				<td style="border: 1px solid black;text-align:center;">
					<div>
						<span style="border-bottom:1px solid black;width:100px;margin:5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span> <br>
						<span style="margin:5px;">1000 - C </span>
					</div>
				</td>
				<td style="border: 1px solid black;text-align:center;width:30%;font-weight:bold;"><?php if ($row_select_pipe['asg3'] != "" && $row_select_pipe['asg3'] != "0" && $row_select_pipe['asg3'] != null) {
																										echo $row_select_pipe['asg3'];
																									} else {
																										echo "-";
																									} ?></td>
			</tr>

		</table>
		<br>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td colspan="4" style="border: 0px solid black;font-size:14px;padding: 4px;"><b>&nbsp; 3. Water Absorption (IS 1124)</b></td>
			</tr>
		</table>
		<br>

		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">

			<tr>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;padding: 4px;">Sr No</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Description</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">Result of Test</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">1</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of oven dry test piece, A in 8</td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['wtr1'] != "" && $row_select_pipe['wtr1'] != "0" && $row_select_pipe['wtr1'] != null) {
																						echo $row_select_pipe['wtr1'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">2</td>
				<td colspan="2" style="border: 1px solid black;width:60%;">&nbsp; Weight of saturated surface dry test piece, B in g. </td>
				<td style="border: 1px solid black;text-align:center;width:30%;"><?php if ($row_select_pipe['wtr2'] != "" && $row_select_pipe['wtr2'] != "0" && $row_select_pipe['wtr2'] != null) {
																						echo $row_select_pipe['wtr2'];
																					} else {
																						echo "-";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">3</td>
				<td style="border: 1px solid black;">&nbsp; Water Absorption</td>
				<td style="border: 1px solid black;text-align:center;">((B - A) / A) x 100</td>
				<td style="border: 1px solid black;text-align:center;width:30%;font-weight:bold;"><?php if ($row_select_pipe['wtr3'] != "" && $row_select_pipe['wtr3'] != "0" && $row_select_pipe['wtr3'] != null) {
																										echo $row_select_pipe['wtr3'];
																									} else {
																										echo "-";
																									} ?></td>
			</tr>
		</table>
		<br>			<div class="pagebreak"> </div>
		<br>
		
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
				<td colspan="4" style="border: 0px solid black;font-size:14px;padding: 4px;"><b>&nbsp; 4. Compressive Strength (IS 1121)</b></td>
			</tr>
		</table>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">

			<tr>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;padding: 4px;">Sr No</td>
				<td rowspan="2" style="border: 1px solid black;font-weight:bold;text-align:center;">Description</td>
				<td colspan="5" style="border: 1px solid black;font-weight:bold;text-align:center;">Result of Test</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">1</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">2</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">3</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">4</td>
				<td style="border: 1px solid black;font-weight:bold;text-align:center;">5</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">1</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Weight of oven dry test piece, in mm</td>
				<td style="border: 1px solid black;text-align:center;width:10%;"><?php if ($row_select_pipe['com1'] != "" && $row_select_pipe['com1'] != "0" && $row_select_pipe['com1'] != null) {
																						echo $row_select_pipe['com1'];
																					} else {
																						echo "-";
																					} ?></td>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;"></td>
				<td style="border: 1px solid black;text-align:center;width:10%;"></td>
				<td style="border: 1px solid black;text-align:center;width:10%;"></td>
				<td style="border: 1px solid black;text-align:center;width:10%;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">2</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Diameter of specimen, in mm</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com2'] != "" && $row_select_pipe['com2'] != "0" && $row_select_pipe['com2'] != null) {
																			echo $row_select_pipe['com2'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">3</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Length to diameter ratio (Must be between 2 to 3)</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com3'] != "" && $row_select_pipe['com3'] != "0" && $row_select_pipe['com3'] != null) {
																			echo $row_select_pipe['com3'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">4</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Rate of loading (stress), in N/mm<sup>2</sup></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com4'] != "" && $row_select_pipe['com4'] != "0" && $row_select_pipe['com4'] != null) {
																			echo $row_select_pipe['com4'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">5</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Load at failure, in kN</td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com5'] != "" && $row_select_pipe['com5'] != "0" && $row_select_pipe['com5'] != null) {
																			echo $row_select_pipe['com5'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"padding: 4px;></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">6</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Area, mm<sup>2</sup></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com6'] != "" && $row_select_pipe['com6'] != "0" && $row_select_pipe['com6'] != null) {
																			echo $row_select_pipe['com6'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">7</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Compressive strength, N/mm<sup>2</sup></td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com7'] != "" && $row_select_pipe['com7'] != "0" && $row_select_pipe['com7'] != null) {
																			echo $row_select_pipe['com7'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;width:10%;padding: 4px;">8</td>
				<td style="border: 1px solid black;width:30%;">&nbsp; Mode of failure </td>
				<td style="border: 1px solid black;text-align:center;"><?php if ($row_select_pipe['com8'] != "" && $row_select_pipe['com8'] != "0" && $row_select_pipe['com8'] != null) {
																			echo $row_select_pipe['com8'];
																		} else {
																			echo "-";
																		} ?></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
				<td style="border: 1px solid black;text-align:center;"></td>
			</tr>

		</table>
		<br>
		<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 2px;width: 12%;">Remarks :-</td>
                            <td style="padding: 2px;border-left: 1px solid;border: 1px solid;border: 1px solid;text-align: left;" colspan="3"><?php echo $row_select_pipe["re1"] ?></td>
                        </tr>
                        <tr>
                            <td style="font-weight: bold;text-align: left;padding: 2px;width: 8%;border-top: 1px solid;width: 12%;">Checked By :-</td>
                            <td style="padding: 2px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                            <td style="font-weight: bold;text-align: center;padding: 2px;width: 8%;border: 1px solid;width: 12%;">Tested By :-</td>
                            <td style="padding: 2px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
                        </tr>
                       
                    </table>
                </td>
            </tr>
		</table>
		<br>
		<!-- <table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family : Calibri;margin-bottom: 8px;">
			<tr style="height: 24px;">
				<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;">Page 3 of 3</td>
			</tr>
		</table> -->

	</page>



</body>

</html>