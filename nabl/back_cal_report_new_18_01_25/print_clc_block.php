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
	$select_tiles_query = "select * from clc_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$branch_name = $row_select['branch_name'];
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
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
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
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CC BLOCK</td>
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
		
		
		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="Auto">
			<tr style="border: 0px solid black;">
				<td colspan="4" style="border: 0px solid black;padding:10px 5px;text-align:center"><b>TEST-1 Dimension (IS:2185 P3-84 (2015))</b></td>
			</tr>


			<tr style="border: 1px solid black;height:20px;font-weight:bold;">
				<td style="width:7%;border: 1px solid black;">
					<center>Sr. No.</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Length in mm</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Width in mm</center>
				</td>
				<td style="width:31%;border: 1px solid black;">
					<center>Height in mm</center>
				</td>


			</tr>

			<tr style="text-align:center">
				<td style="border: 1px solid black;">1</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l1'] != "" && $row_select_pipe['dim_l1'] != "0" && $row_select_pipe['dim_l1'] != null) {
															echo $row_select_pipe['dim_l1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w1'] != "" && $row_select_pipe['dim_w1'] != "0" && $row_select_pipe['dim_w1'] != null) {
															echo $row_select_pipe['dim_w1'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h1'] != "" && $row_select_pipe['dim_h1'] != "0" && $row_select_pipe['dim_h1'] != null) {
															echo $row_select_pipe['dim_h1'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">2</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l2'] != "" && $row_select_pipe['dim_l2'] != "0" && $row_select_pipe['dim_l2'] != null) {
															echo $row_select_pipe['dim_l2'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w2'] != "" && $row_select_pipe['dim_w2'] != "0" && $row_select_pipe['dim_w2'] != null) {
															echo $row_select_pipe['dim_w2'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h2'] != "" && $row_select_pipe['dim_h2'] != "0" && $row_select_pipe['dim_h2'] != null) {
															echo $row_select_pipe['dim_h2'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">3</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l3'] != "" && $row_select_pipe['dim_l3'] != "0" && $row_select_pipe['dim_l3'] != null) {
															echo $row_select_pipe['dim_l3'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w3'] != "" && $row_select_pipe['dim_w3'] != "0" && $row_select_pipe['dim_w3'] != null) {
															echo $row_select_pipe['dim_w3'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h3'] != "" && $row_select_pipe['dim_h3'] != "0" && $row_select_pipe['dim_h3'] != null) {
															echo $row_select_pipe['dim_h3'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">4</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_l4'] != "" && $row_select_pipe['dim_l4'] != "0" && $row_select_pipe['dim_l4'] != null) {
															echo $row_select_pipe['dim_l4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w4'] != "" && $row_select_pipe['dim_w4'] != "0" && $row_select_pipe['dim_w4'] != null) {
															echo $row_select_pipe['dim_w4'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h4'] != "" && $row_select_pipe['dim_h4'] != "0" && $row_select_pipe['dim_h4'] != null) {
															echo $row_select_pipe['dim_h4'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">5</td>
				<td style="border: 1px solid black;"></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w5'] != "" && $row_select_pipe['dim_w5'] != "0" && $row_select_pipe['dim_w5'] != null) {
															echo $row_select_pipe['dim_w5'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h5'] != "" && $row_select_pipe['dim_h5'] != "0" && $row_select_pipe['dim_h5'] != null) {
															echo $row_select_pipe['dim_h5'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">6</td>
				<td style="border: 1px solid black;"></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w6'] != "" && $row_select_pipe['dim_w6'] != "0" && $row_select_pipe['dim_w6'] != null) {
															echo $row_select_pipe['dim_w6'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_h6'] != "" && $row_select_pipe['dim_h6'] != "0" && $row_select_pipe['dim_h6'] != null) {
															echo $row_select_pipe['dim_h6'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>
			<tr style="text-align:center">
				<td style="border: 1px solid black;">7</td>
				<td style="border: 1px solid black;"></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_w7'] != "" && $row_select_pipe['dim_w7'] != "0" && $row_select_pipe['dim_w7'] != null) {
															echo $row_select_pipe['dim_w7'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"></td>

			</tr>



			<tr style="text-align:center">
				<td style="border: 1px solid black;text-align:right">Avg.</td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_height'] != "" && $row_select_pipe['dim_height'] != "0" && $row_select_pipe['dim_height'] != null) {
															echo $row_select_pipe['dim_height'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_width'] != "" && $row_select_pipe['dim_width'] != "0" && $row_select_pipe['dim_width'] != null) {
															echo $row_select_pipe['dim_width'];
														} else {
															echo " <br>";
														} ?></td>
				<td style="border: 1px solid black;"><?php if ($row_select_pipe['dim_height'] != "" && $row_select_pipe['dim_height'] != "0" && $row_select_pipe['dim_height'] != null) {
															echo $row_select_pipe['dim_height'];
														} else {
															echo " <br>";
														} ?></td>

			</tr>

		</table>
		<br>

		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="8" style="border: 0px solid black;padding:10px 5px;text-align:center"><b>TEST-2 Compressive Strength (IS:6441 P5-72 (2017))</b></td>
			</tr>
			<tr style="height:60px;">
				<td style="width:7%;border: 1px solid black;font-weight:bold;">
					<center><b>Sample ID.</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Length in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Width in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Height in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Moisture Content (%)</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Load IN KN</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Area (<br>mm<sup>2</sup>)</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Compressive<br>Strength in N/mm<sup>2</sup></b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_1'] != "" && $row_select_pipe['sample_1'] != "0" && $row_select_pipe['sample_1'] != null) {
									echo $row_select_pipe['sample_1'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_1'] != "" && $row_select_pipe['l_1'] != "0" && $row_select_pipe['l_1'] != null) {
								echo $row_select_pipe['l_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_1'] != "" && $row_select_pipe['w_1'] != "0" && $row_select_pipe['w_1'] != null) {
								echo $row_select_pipe['w_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_1'] != "" && $row_select_pipe['h_1'] != "0" && $row_select_pipe['h_1'] != null) {
								echo $row_select_pipe['h_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_1'] != "" && $row_select_pipe['mc_1'] != "0" && $row_select_pipe['mc_1'] != null) {
								echo $row_select_pipe['mc_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
								echo $row_select_pipe['load_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) {
								echo $row_select_pipe['area_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
								echo $row_select_pipe['com_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_2'] != "" && $row_select_pipe['sample_2'] != "0" && $row_select_pipe['sample_2'] != null) {
									echo $row_select_pipe['sample_2'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_2'] != "" && $row_select_pipe['l_2'] != "0" && $row_select_pipe['l_2'] != null) {
								echo $row_select_pipe['l_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_2'] != "" && $row_select_pipe['w_2'] != "0" && $row_select_pipe['w_2'] != null) {
								echo $row_select_pipe['w_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_2'] != "" && $row_select_pipe['h_2'] != "0" && $row_select_pipe['h_2'] != null) {
								echo $row_select_pipe['h_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_2'] != "" && $row_select_pipe['mc_2'] != "0" && $row_select_pipe['mc_2'] != null) {
								echo $row_select_pipe['mc_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
								echo $row_select_pipe['load_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) {
								echo $row_select_pipe['area_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
								echo $row_select_pipe['com_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['sample_3'] != "" && $row_select_pipe['sample_3'] != "0" && $row_select_pipe['sample_3'] != null) {
									echo $row_select_pipe['sample_3'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['l_3'] != "" && $row_select_pipe['l_3'] != "0" && $row_select_pipe['l_3'] != null) {
								echo $row_select_pipe['l_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w_3'] != "" && $row_select_pipe['w_3'] != "0" && $row_select_pipe['w_3'] != null) {
								echo $row_select_pipe['w_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['h_3'] != "" && $row_select_pipe['h_3'] != "0" && $row_select_pipe['h_3'] != null) {
								echo $row_select_pipe['h_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc_3'] != "" && $row_select_pipe['mc_3'] != "0" && $row_select_pipe['mc_3'] != null) {
								echo $row_select_pipe['mc_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
								echo $row_select_pipe['load_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) {
								echo $row_select_pipe['area_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
								echo $row_select_pipe['com_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>

			<tr>
				<td colspan="7" style="border: 1px solid black;text-align:right">Average</td>

				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_com'] != "" && $row_select_pipe['avg_com'] != "0" && $row_select_pipe['avg_com'] != null) {
								echo $row_select_pipe['avg_com'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>



		</table>
		<br>

		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="9" style="border: 0px solid black;padding:10px 5px;text-align:center"><b>TEST-3 Bulk Density &amp; Moisture Content (IS:6441 P1:1972 (2017))</b></td>
			</tr>
			<tr style="height:60px;">
				<td style="width:7%;border: 1px solid black;font-weight:bold;">
					<center><b>Sr. No.</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Length in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Width in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Height in mm</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Volume (cm<sup>3</sup>)</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Weight, g</b></center>
				</td>

				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Compressive<br>Strength in N/mm<sup>2</sup></b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Oven Dry Weight, g</b></center>
				</td>
				<td style="width:13.20%;border: 1px solid black;font-weight:bold;">
					<center><b>Moisture Content (%)</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dl_1'] != "" && $row_select_pipe['dl_1'] != "0" && $row_select_pipe['dl_1'] != null) {
								echo $row_select_pipe['dl_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dw_1'] != "" && $row_select_pipe['dw_1'] != "0" && $row_select_pipe['dw_1'] != null) {
								echo $row_select_pipe['dw_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dh_1'] != "" && $row_select_pipe['dh_1'] != "0" && $row_select_pipe['dh_1'] != null) {
								echo $row_select_pipe['dh_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_1'] != "" && $row_select_pipe['vol_1'] != "0" && $row_select_pipe['vol_1'] != null) {
								echo $row_select_pipe['vol_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['weight_1'] != "" && $row_select_pipe['weight_1'] != "0" && $row_select_pipe['weight_1'] != null) {
								echo $row_select_pipe['weight_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['den_1'] != "" && $row_select_pipe['den_1'] != "0" && $row_select_pipe['den_1'] != null) {
								echo $row_select_pipe['den_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w1'] != "" && $row_select_pipe['w1'] != "0" && $row_select_pipe['w1'] != null) {
								echo $row_select_pipe['w1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa_1'] != "" && $row_select_pipe['wa_1'] != "0" && $row_select_pipe['wa_1'] != null) {
								echo $row_select_pipe['wa_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dl_2'] != "" && $row_select_pipe['dl_2'] != "0" && $row_select_pipe['dl_2'] != null) {
								echo $row_select_pipe['dl_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dw_2'] != "" && $row_select_pipe['dw_2'] != "0" && $row_select_pipe['dw_2'] != null) {
								echo $row_select_pipe['dw_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dh_2'] != "" && $row_select_pipe['dh_2'] != "0" && $row_select_pipe['dh_2'] != null) {
								echo $row_select_pipe['dh_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_2'] != "" && $row_select_pipe['vol_2'] != "0" && $row_select_pipe['vol_2'] != null) {
								echo $row_select_pipe['vol_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['weight_2'] != "" && $row_select_pipe['weight_2'] != "0" && $row_select_pipe['weight_2'] != null) {
								echo $row_select_pipe['weight_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['den_2'] != "" && $row_select_pipe['den_2'] != "0" && $row_select_pipe['den_2'] != null) {
								echo $row_select_pipe['den_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w2'] != "" && $row_select_pipe['w2'] != "0" && $row_select_pipe['w2'] != null) {
								echo $row_select_pipe['w2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa_2'] != "" && $row_select_pipe['wa_2'] != "0" && $row_select_pipe['wa_2'] != null) {
								echo $row_select_pipe['wa_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dl_3'] != "" && $row_select_pipe['dl_3'] != "0" && $row_select_pipe['dl_3'] != null) {
								echo $row_select_pipe['dl_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dw_3'] != "" && $row_select_pipe['dw_3'] != "0" && $row_select_pipe['dw_3'] != null) {
								echo $row_select_pipe['dw_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['dh_3'] != "" && $row_select_pipe['dh_3'] != "0" && $row_select_pipe['dh_3'] != null) {
								echo $row_select_pipe['dh_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['vol_3'] != "" && $row_select_pipe['vol_3'] != "0" && $row_select_pipe['vol_3'] != null) {
								echo $row_select_pipe['vol_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['weight_3'] != "" && $row_select_pipe['weight_3'] != "0" && $row_select_pipe['weight_3'] != null) {
								echo $row_select_pipe['weight_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['den_3'] != "" && $row_select_pipe['den_3'] != "0" && $row_select_pipe['den_3'] != null) {
								echo $row_select_pipe['den_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['w3'] != "" && $row_select_pipe['w3'] != "0" && $row_select_pipe['w3'] != null) {
								echo $row_select_pipe['w3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wa_3'] != "" && $row_select_pipe['wa_3'] != "0" && $row_select_pipe['wa_3'] != null) {
								echo $row_select_pipe['wa_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>

			<tr>

				<td colspan="6" style="border: 1px solid black;text-align:right;">Average</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) {
								echo $row_select_pipe['bdl'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;text-align:right;"></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mc'] != "" && $row_select_pipe['mc'] != "0" && $row_select_pipe['mc'] != null) {
								echo $row_select_pipe['mc'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>



		</table>
		<br><br>
		
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
				<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->
		</table>

		<div class="pagebreak"> </div>
		<Br>
		<br><br>

		
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 2</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:75%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON CC BLOCK</td>
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
				<br><br>


		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="Auto">
			<tr style="border: 1px solid black;">
				<td colspan="6" style="border: 0px solid black;padding:10px 5px;text-align:center"><b>TEST-4 Drying Shrinkage (IS:6441 (P-2):72 (2017))</b></td>
			</tr>

			<tr>
				<td colspan="3" style="width:40%;border: 1px solid black;font-weight:bold;">
					<center><b></b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;">
					<center><b>(i)</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;">
					<center><b>(ii)</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;">
					<center><b>(iii)</b></center>
				</td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>1</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>Constant Length, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_1'] != "" && $row_select_pipe['con_1'] != "0" && $row_select_pipe['con_1'] != null) {
																										echo $row_select_pipe['con_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_2'] != "" && $row_select_pipe['con_2'] != "0" && $row_select_pipe['con_2'] != null) {
																										echo $row_select_pipe['con_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_3'] != "" && $row_select_pipe['con_3'] != "0" && $row_select_pipe['con_3'] != null) {
																										echo $row_select_pipe['con_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>2</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>Width, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_wid_1'] != "" && $row_select_pipe['con_wid_1'] != "0" && $row_select_pipe['con_wid_1'] != null) {
																										echo $row_select_pipe['con_wid_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_wid_2'] != "" && $row_select_pipe['con_wid_2'] != "0" && $row_select_pipe['con_wid_2'] != null) {
																										echo $row_select_pipe['con_wid_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_wid_3'] != "" && $row_select_pipe['con_wid_3'] != "0" && $row_select_pipe['con_wid_3'] != null) {
																										echo $row_select_pipe['con_wid_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>3</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>Thickness, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_thi_1'] != "" && $row_select_pipe['con_thi_1'] != "0" && $row_select_pipe['con_thi_1'] != null) {
																										echo $row_select_pipe['con_thi_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_thi_2'] != "" && $row_select_pipe['con_thi_2'] != "0" && $row_select_pipe['con_thi_2'] != null) {
																										echo $row_select_pipe['con_thi_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['con_thi_3'] != "" && $row_select_pipe['con_thi_3'] != "0" && $row_select_pipe['con_thi_3'] != null) {
																										echo $row_select_pipe['con_thi_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>2</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>First Reading, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fr_1'] != "" && $row_select_pipe['fr_1'] != "0" && $row_select_pipe['fr_1'] != null) {
																										echo $row_select_pipe['fr_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fr_2'] != "" && $row_select_pipe['fr_2'] != "0" && $row_select_pipe['fr_2'] != null) {
																										echo $row_select_pipe['fr_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fr_3'] != "" && $row_select_pipe['fr_3'] != "0" && $row_select_pipe['fr_3'] != null) {
																										echo $row_select_pipe['fr_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>3</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>Final Reading, mm</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fi_1'] != "" && $row_select_pipe['fi_1'] != "0" && $row_select_pipe['fi_1'] != null) {
																										echo $row_select_pipe['fi_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fi_2'] != "" && $row_select_pipe['fi_2'] != "0" && $row_select_pipe['fi_2'] != null) {
																										echo $row_select_pipe['fi_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['fi_3'] != "" && $row_select_pipe['fi_3'] != "0" && $row_select_pipe['fi_3'] != null) {
																										echo $row_select_pipe['fi_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>
				<td rowspan="2" style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>4</b></center>
				</td>
				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>Drying Shrinkage, %</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['ds_1'] != "" && $row_select_pipe['ds_1'] != "0" && $row_select_pipe['ds_1'] != null) {
																										echo $row_select_pipe['ds_1'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['ds_2'] != "" && $row_select_pipe['ds_2'] != "0" && $row_select_pipe['ds_2'] != null) {
																										echo $row_select_pipe['ds_2'];
																									} else {
																										echo " <br>";
																									} ?></td>
				<td style="width:20%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['ds_3'] != "" && $row_select_pipe['ds_3'] != "0" && $row_select_pipe['ds_3'] != null) {
																										echo $row_select_pipe['ds_3'];
																									} else {
																										echo " <br>";
																									} ?></td>

			</tr>
			<tr>

				<td style="width:30%;border: 1px solid black;font-weight:bold;padding:5px 5px;"><b>Average Drying Shrinkage, %</b></td>
				<td style="width:5%;border: 1px solid black;font-weight:bold;">
					<center><b>=</b></center>
				</td>
				<td colspan="3" style="width:60%;border: 1px solid black;font-weight:bold;text-align:center"><?php if ($row_select_pipe['avg_shrink'] != "" && $row_select_pipe['avg_shrink'] != "0" && $row_select_pipe['avg_shrink'] != null) {
																													echo $row_select_pipe['avg_shrink'];
																												} else {
																													echo " <br>";
																												} ?></td>


			</tr>




		</table>
		<br><br>

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
				<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
							</tr>
							<tr>
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->

	</page>
</body>

</html>


<script type="text/javascript">

</script>