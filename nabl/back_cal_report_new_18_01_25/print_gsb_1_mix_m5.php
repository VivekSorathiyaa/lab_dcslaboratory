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
		font-family: Book Antiqua;
	}

	.test {
		border-collapse: collapse;
		font-size: 11px;
		font-family: Book Antiqua;
	}

	.test1 {
		font-size: 11px;
		border-collapse: collapse;
		font-family: Book Antiqua;

	}

	.tdclass1 {

		font-size: 11px;
		font-family: Book Antiqua;
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
	$tbl = $_GET['tbl_name'];
	$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$mark = $row_select3['fine_agg_type'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
	}
	$totalcnt = 0;
	$pagecnt = 1;
	if (($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['silt_content'] != "" && $row_select_pipe['silt_content'] != "0" && $row_select_pipe['silt_content'] != null) || ($row_select_pipe['alk_a1'] != "" && $row_select_pipe['alk_a1'] != "0" && $row_select_pipe['alk_a1'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null)) {
		$totalcnt++;
	}
	if (($row_select_pipe['dele_1_3'] != "" && $row_select_pipe['dele_1_3'] != "0" && $row_select_pipe['dele_1_3'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
		$totalcnt++;
	}

	if (($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null)) {

	?>

		<br>
		<page size="A4">
			<div id="header" style="text-align: center;width: 110px;margin: 0 auto;">
				<!-- <img src="../images/header.png" width="150px"> -->
			</div>

			<br>
<div style="border:1px solid;width:92%;text-align:center;margin-left:50px;">
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;border-collapse: collapse;">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt;?></td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-bottom:1px solid;border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			
			
			<br>
			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;"><b>AGGREGATE IMPACT VALUE ( IS 2386 PART 4 :1963)</b></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Testing &nbsp; &nbsp; <?php if ($row_select_pipe['imp_s_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['imp_s_d']));
																																		} ?></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;border-top:1px solid;">
				<tr>
					<td style="border-left:0;border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Sr.No.</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>DESCRIPTION</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 1</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 2</b></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">1</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">WT OF METAL CONTAINER (A), gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_a_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_a_2']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">2</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">[ (A) + WT OF SAMPLE ] = (B),gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_b_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_b_2']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">3</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">WT OF SAMPLE (B-A),gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_c_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_c_2']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">4</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">MATERIAL RETAINED ON IS SIEVES,gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_d_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_d_2']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">5</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">MATERIAL PASSING ON IS SIEVES,gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_e_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_w_m_e_2']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">6</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">SUM OF RETAINED AND PASSING,gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_value_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_value_2']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">7</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Impact Value</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_value']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['imp_value_3']?></td>
					
				</tr>
				
			
			</table>


			
			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;" colspan="2" ><b>SPECIFIC GRAVITY & WATER ABSORPTION BY BASKET  ( IS 2386 (Part I): 1963)</b></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Testing &nbsp; &nbsp; <?php if ($row_select_pipe['wtr_s_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['wtr_s_d']));
																																		} ?></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Ending &nbsp; &nbsp; <?php if ($row_select_pipe['wtr_e_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['wtr_e_d']));
																																		} ?></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Sr.No.</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Particulars</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;" colspan="2"><b>Observation</b></td>
					
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">1</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Wt of Agg. In Saturated surface-dry condition  (gms) </td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sp_wt_st_1']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">2</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Wt of Agg after dried in Oven temp of 110 deg C about 24 Hrs    (gms)</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sp_w_s_1']?></td>
					
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">3</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Weight of sample in water (g)</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sp_w_sur_1']?></td>
					
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">4</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Specific Gravity</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sp_specific_gravity']?></td>
					
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">5</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Water Absorption</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sp_water_abr']?></td>
					
					
				</tr>
				
				
				
			</table>

	

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;"><b>LIQUID AND PLASTIC LIMIT 2720 (Part-5)-1985</b></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Testing &nbsp; &nbsp; <?php if ($row_select_pipe['den_s_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['den_s_d']));
																																		} ?></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>DESCRIPTION</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"colspan="5"><b>LIQUID LIMIT</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"colspan="3"><b>PLASTIC LIMIT</b></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Initial reading (A)</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['initial1']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['initial2']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['initial3']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['initial4']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['initial5']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Final Reading (B)</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['final1']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['final2']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['final3']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['final4']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['final5']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Penetration*(B-A)/10 (mm)</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['pene1']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['pene2']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['pene3']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['pene4']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['pene5']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Tare No</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_5'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_6']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['tare_8']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Wt of Tare (gm)</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_5'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_6']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wt_tare_8']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Wt of Tare+wet sample (gm)</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_5'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_6']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['wet_8']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Wt of Tare+dry sample (gm)</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_5'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_6']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_8']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">MC</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc5'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc6']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mc8']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">LL</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;" colspan="5" ><?php echo $row_select_pipe['ll1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
					
				</tr>
				
			</table>





			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;"><b>WATER CONTENT - DRY DENSITY RELATION USING HEAVY COMPACTION  (IS 2720 PART 8 :1983)</b></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Testing &nbsp; &nbsp; <?php if ($row_select_pipe['den_s_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['den_s_d']));
																																		} ?></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>DESCRIPTION</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 1</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 2</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 3</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 4</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 5</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TRIAL 6</b></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Weight of Mould (A) , gms</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"colspan="6"><?php echo $row_select_pipe['weight_mould_1']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">((A) + Weight of Sample ) (B),gm</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_sample_1']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_sample_2']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_sample_3']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_sample_4']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_sample_5']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"></td>
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Tare No</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mdd_tare_1']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mdd_tare_2']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mdd_tare_3']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mdd_tare_4']?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mdd_tare_5']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['mdd_tare_6']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Weight of Container</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_con_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_con_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_con_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_con_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_con_5'];?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['weight_con_6']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Weight of Sample+Container</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_con_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_con_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_con_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_con_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_con_5'];?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_con_6']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">Weight of Oven dry Sample+ Container</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_dry_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_dry_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_dry_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_dry_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_dry_5'];?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sam_dry_6']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">DD</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_den_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_den_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_den_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_den_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_den_5'];?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_den_6']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">MC</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_mc_1'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_mc_2'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_mc_3'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_mc_4'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_mc_5'];?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['dry_mc_6']?></td>
					
				</tr>
				
				
				
			</table>
			<table align="center" width="100%" class="test1"   style="border-top: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;">Checked By (Testing Incharge)</td>
			</tr>
			
		</table>
			</div>

<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>
<br>

			<div class="pagebreak"> </div>
			<br>
			<br><br>
			<br><br>

<div style="border:1px solid;width:92%;text-align:center;margin-left:50px;">
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border-bottom:0px;padding: 0;border-collapse: collapse;">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : <?php echo $totalcnt;?></td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON COARSE AGGREGATE </td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;"><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-bottom:1px solid;border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-bottom:1px solid;border-top:1px solid;border-left:1px solid;width:50%;">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<br>
			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;"><b>CALIFORNIA BEARING RATIO IN LAB (IS 2720(PART 16)- 1987)</b></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Testing &nbsp; &nbsp; <?php if ($row_select_pipe['grd_s_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['grd_s_d']));
																																		} ?></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Sr.No.</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>PENETRATION IN MM</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>PROVING RING READING (DIVISION)</b></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">1</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">0</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_1']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">2</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">0.5</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_2']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">3</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">1</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_3']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">4</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">1.5</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_4']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">5</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">2</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_5']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">6</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">2.5</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_6']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">7</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">3</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_7']?></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">8</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">4</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_8']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">9</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">5</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_9']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">10</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">7.5</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_10']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">11</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">10</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_11']?></td>
					
				</tr>
				
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">12</td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;">12.5</td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['ring_12']?></td>
					
				</tr>
				
			</table>	
			
			<br>
			
			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border-top:1px solid black;border-bottom:1px solid black;text-align:center;padding: 1px 4px;width: 12.12%;font-size: 13px;text-transform: uppercase;"><b>GRAIN SIZE ANALYSIS (IS 2386 part 1)</b></td>
				</tr>
				<tr>
					<td style="border:0;text-align:left;padding: 1px 4px;width: 12.12%;font-size: 11px;">Date of Testing &nbsp; &nbsp; <?php if ($row_select_pipe['grd_s_d'] != "0000-00-00") {
																																			echo date("d/m/Y", strtotime($row_select_pipe['grd_s_d']));
																																		} ?></td>
				</tr>
			</table>

			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					
					<td><b></b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>TOTAL SAMPLE WT</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;" colspan="4"><b><?php echo $row_select_pipe['sample_taken'] ?></b></td>
					
				</tr>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Sr.No.</b></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Sieve Size (mm)</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Weight of Sample Retained (kg)</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Cum. mass retained, Kg</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>Cum. % mass retained</b></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 0;"><b>% of passing</b></td>
					
				</tr>
				<?php $cnt = 1; if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != null && $row_select_pipe['sieve_1'] != "0") { 
			?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_1'];?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_1']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_1']?></td>
					
				</tr>
				<?php } if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != null && $row_select_pipe['sieve_2'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_2']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_2']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_2']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_2']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_2']?></td>
				</tr>
				<?php } if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != null && $row_select_pipe['sieve_3'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_3']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_3']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_3']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_3']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_3']?></td>
				</tr>
				<?php } if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != null && $row_select_pipe['sieve_4'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_4']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_4']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_4']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_4']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_4']?>
				</tr>
				<?php } if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != null && $row_select_pipe['sieve_5'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_5']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_5']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_5']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_5']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_5']?></td>
				</tr>
				<?php } if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != null && $row_select_pipe['sieve_6'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_6']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_6']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_6']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_6']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_6']?></td>
				</tr>
				<?php } if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != null && $row_select_pipe['sieve_7'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_7']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_7']?></td>
				</tr>
				<?php } if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != null && $row_select_pipe['sieve_8'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_8']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_8']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_8']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_8']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_8']?></td>
				</tr>
				<?php } if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != null && $row_select_pipe['sieve_9'] != "0") { ?>
				<tr>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $cnt++;?></td>
					<td style="border:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['sieve_9']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;"><?php echo $row_select_pipe['cum_wt_gm_9']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['ret_wt_gm_9']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['cum_ret_9']?></td>
					<td style="border-top:1px solid black;text-align:center;padding: 1px 4px;border-bottom: 1px solid black;border-left: 1px solid black;"><?php echo $row_select_pipe['pass_sample_9']?></td>
				</tr>
				<?php }?>
			</table>

			<table align="center" width="100%" class="test1"   style="border-top: 1px solid black; font-family : Calibri; margin-top:-1px;">
			
			<tr>
				<td style="font-weight: bold;text-align: LEFT;padding: 5px;">Tested By :</td>
				
				<td style="font-weight: bold;text-align: RIGHT;padding: 5px;">Checked By (Testing Incharge)</td>
			</tr>
			
		</table>
			</div>
			<!--<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 36px;">
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;width: 15%;">Tested by</td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;width: 15%;">Witness by </td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;width: 20%;">1</td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;width: 15%;">2</td>
				</tr>
				<tr style="height: 36px;">
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;" rowspan="2"></td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;">Signature </td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
				</tr>
				<tr style="height: 36px;">
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;">Name </td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
				</tr>
				<tr style="height: 36px;">
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;">Name :</td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;">Designation </td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
				</tr>
				<tr style="height: 36px;">
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;">SKGPEPL</td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;">Company Name </td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
					<td style="border:1px solid black;text-align:center;padding: 4px;text-transform: uppercase;"></td>
				</tr>
			</table>>


			


			<table align="center" width="100%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 20px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;"><b>Page 2 of 2</b></td>
				</tr>
				<tr style="height: 20px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;"><b>****END OF PAGE ****</b></td>
				</tr>
			</table>


			<br><br><br><br><br>













			<!-- <h3 style="font-size:16px; text-align:center;"><u>OBSERVATION & CALCULAITON SHEET FOR TEST ON FINE AGGREGATE <br> IS 2386:1963 RA 2016</u></h3>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial;margin-top:-15px;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark: </b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $mark; ?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no; ?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Laboratory No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-5px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>1. Specific Gravity &amp; Water Absorption of fine Aggregate :IS 2386:1963, Part-3</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['wtr_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['wtr_s_d']));
																					} ?>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['wtr_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['wtr_e_d']));
																		} ?></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black;">&nbsp;&nbsp; Weight of Basket /Pycnometer Bottle in Water A2= <?php if ($row_select_pipe['sp_bask_water'] != "" && $row_select_pipe['sp_bask_water'] != "0" && $row_select_pipe['sp_bask_water'] != null) {
																																		echo $row_select_pipe['sp_bask_water'];
																																	} else {
																																		echo "&nbsp;";
																																	} ?> gm</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;margin-top:-1px;" height="Auto">
				<tr>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:10%;"><center><b>Sr.No.</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of Sample <br> with distilled <br>Water in  pycnometer <br>bottle A1 in gm</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of saturated surface dry (gm) B</b></center></td>
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample oven dry (gm) C</b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Weight of sample in water (gm) A = A1-A2</b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Specific Gravity = <br>C/(B-A)</b></center></td>						
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Percentage water absorption in 24 hours = </b></center></td>						
					<td rowspan="2"style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>Remarks</b></center></td>
				</tr>
				<tr>
					<td style="border-right:1px solid black; font-weight:bold;width:12%;"><center><b>(B-C)/C x 100</b></center></td>	
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center><b>1</b></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_bas1'] != "" && $row_select_pipe['sp_wt_bas1'] != "0" && $row_select_pipe['sp_wt_bas1'] != null) {
																		echo $row_select_pipe['sp_wt_bas1'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) {
																		echo $row_select_pipe['sp_wt_st_1'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) {
																		echo $row_select_pipe['sp_w_s_1'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) {
																		echo $row_select_pipe['sp_w_sur_1'];
																	} else {
																		echo " <br>";
																	} ?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) {
																		echo $row_select_pipe['sp_specific_gravity_1'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td  style="border: 1px solid black; "><center><?php if ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) {
																		echo $row_select_pipe['sp_water_abr_1'];
																	} else {
																		echo " <br>";
																	} ?></center></td>						
					<td  style="border: 1px solid black;"><center></center></td>						
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_bas2'] != "" && $row_select_pipe['sp_wt_bas2'] != "0" && $row_select_pipe['sp_wt_bas2'] != null) {
																		echo $row_select_pipe['sp_wt_bas2'];
																	} else {
																		echo " <br>";
																	} ?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) {
																		echo $row_select_pipe['sp_wt_st_2'];
																	} else {
																		echo " <br>";
																	} ?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) {
																		echo $row_select_pipe['sp_w_s_2'];
																	} else {
																		echo " <br>";
																	} ?></center></td>						
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) {
																		echo $row_select_pipe['sp_w_sur_2'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) {
																		echo $row_select_pipe['sp_specific_gravity_2'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) {
																		echo $row_select_pipe['sp_water_abr_2'];
																	} else {
																		echo " <br>";
																	} ?></center></td>						
					<td  style="border: 1px solid black;"><center></center></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; font-weight:bold;" align="right" colspan="5"><b>Average</b></td>
					<td style="border: 1px solid black; font-weight:bold;"><center><?php if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) {
																						echo number_format($row_select_pipe['sp_specific_gravity'], 2);
																					} else {
																						echo " <br>";
																					} ?></center></td>						
					<td  style="border: 1px solid black; font-weight:bold;"><center><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) {
																						echo $row_select_pipe['sp_water_abr'];
																					} else {
																						echo " <br>";
																					} ?></center></td>						
					<td  style="border: 1px solid black; font-weight:bold;"><center></center></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;" colspan="8">&nbsp;&nbsp; <b>Limit :</b> Specific Gravity :- 2.11 to 3.2 & Water Absorption :- Max. 5%</td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-5px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>2. GRADATION :IS 2386:1963, Part-1 RA 2016 <br></b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['grd_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['grd_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['grd_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['grd_e_d']));
																		} ?></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black;">&nbsp;&nbsp; Weight retained in gms = <?php if ($row_select_pipe['sample_taken'] != "" && $row_select_pipe['sample_taken'] != "0" && $row_select_pipe['sample_taken'] != null) {
																												echo $row_select_pipe['sample_taken'];
																											} else {
																												echo "&nbsp;";
																											} ?> gm</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr style="border: 1px solid black;">
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;"><center>Sieve Size</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;"><center>Individual</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;"><center>Cumulative</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;"><center>% Cumulative</center></td>
					<td rowspan="2" style="border: 1px solid black;font-weight:bold;"><center>% Passing</center></td>
					<td style="border: 1px solid black;font-weight:bold;"><center>Classification of Zone <br> concrete as per <br> IS 383-2016 </center></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					
					<td style="border: 1px solid black;font-weight:bold;"><table class="test" style="width:100%">
						<tr>
							<td style="text-align:center;border-top:0px solid black;width:25%;">I</td>
							<td style="text-align:center;border-left:1px solid black;border-top:0px solid black;width:25%;">II</td>
							<td style="text-align:center;border-left:1px solid black;border-top:0px solid black;width:25%;">III</td>
							<td style="text-align:center;border-left:1px solid black;border-top:0px solid black;width:25%;">IV</td>
						</tr>
						</table>
						</td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">10 mm</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_1'] != "" && $row_select_pipe['cum_wt_gm_1'] != "" && $row_select_pipe['cum_wt_gm_1'] != null) {
																echo $row_select_pipe['cum_wt_gm_1'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_1'] != "" && $row_select_pipe['ret_wt_gm_1'] != "" && $row_select_pipe['ret_wt_gm_1'] != null) {
																echo $row_select_pipe['ret_wt_gm_1'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_1'] != "" && $row_select_pipe['cum_ret_1'] != "" && $row_select_pipe['cum_ret_1'] != null) {
																echo $row_select_pipe['cum_ret_1'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_1'] != "" && $row_select_pipe['pass_sample_1'] != "0" && $row_select_pipe['pass_sample_1'] != null) {
																echo $row_select_pipe['pass_sample_1'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td rowspan="7" style="border: 1px solid black;">
					<table class="test" style="width:100%">
						
						<tr>
							<td style="border-top:1px solid black;width:25%;text-align:center;border:1px solid black;border-left:0px solid black;">100</td>
							<td style="border-top:1px solid black;width:25%;text-align:center;border:1px solid black;">100</td>
							<td style="border-top:1px solid black;width:25%;text-align:center;border:1px solid black;">100</td>
							<td style="border-top:1px solid black;width:25%;text-align:center;border:1px solid black;">100</td>
						</tr>
						<tr>
							<td style="text-align:center;border:1px solid black;border-left:0px solid black;">90-100</td>
							<td style="text-align:center;border:1px solid black;">90-100</td>
							<td style="text-align:center;border:1px solid black;">90-100</td>
							<td style="text-align:center;border:1px solid black;">95-100</td>
						</tr>
						<tr>
							<td style="text-align:center;border:1px solid black; border-left:0px solid black;">60-95</td>
							<td style="text-align:center;border:1px solid black;">75-100</td>
							<td style="text-align:center;border:1px solid black;">85-100</td>
							<td style="text-align:center;border:1px solid black;">95-100</td>
						</tr>
						<tr>
							<td style="text-align:center;border:1px solid black;border-left:0px solid black;">30-70</td>
							<td style="text-align:center;border:1px solid black;">55-90</td>
							<td style="text-align:center;border:1px solid black;">75-100</td>
							<td style="text-align:center;border:1px solid black;">90-100</td>
						</tr>
						<tr>
							<td style="text-align:center;border:1px solid black;border-left:0px solid black;">15-34</td>
							<td style="text-align:center;border:1px solid black;">35-59</td>
							<td style="text-align:center;border:1px solid black;">60-79</td>
							<td style="text-align:center;border:1px solid black;">80-100</td>
						</tr>
						<tr>
							<td style="text-align:center;border:1px solid black;border-left:0px solid black;">5-20</td>
							<td style="text-align:center;border:1px solid black;border-left:0px solid black;">8-30</td>
							<td style="text-align:center;border:1px solid black;">12-40</td>
							<td style="text-align:center;border:1px solid black;">15-50</td>
						</tr>
						<tr>
							<td style="text-align:center;border:1px solid black;border-bottom:0px solid black;border-left:0px solid black;">0-10</td>
							<td style="text-align:center;border:1px solid black;border-bottom:0px solid black;">0-10</td>
							<td style="text-align:center;border:1px solid black;border-bottom:0px solid black;">0-10</td>
							<td style="text-align:center;border:1px solid black;border-bottom:0px solid black;">0-15</td>
						</tr>
					</table>
					</td>
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">4.75 mm</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_2'] != "" && $row_select_pipe['cum_wt_gm_2'] != "0" && $row_select_pipe['cum_wt_gm_2'] != null) {
																echo $row_select_pipe['cum_wt_gm_2'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_2'] != "" && $row_select_pipe['ret_wt_gm_2'] != "0" && $row_select_pipe['ret_wt_gm_2'] != null) {
																echo $row_select_pipe['ret_wt_gm_2'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_2'] != "" && $row_select_pipe['cum_ret_2'] != "0" && $row_select_pipe['cum_ret_2'] != null) {
																echo $row_select_pipe['cum_ret_2'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != "0" && $row_select_pipe['pass_sample_2'] != null) {
																echo $row_select_pipe['pass_sample_2'];
															} else {
																echo "&nbsp;";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">2.36 mm</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_3'] != "" && $row_select_pipe['cum_wt_gm_3'] != "0" && $row_select_pipe['cum_wt_gm_3'] != null) {
																echo $row_select_pipe['cum_wt_gm_3'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_3'] != "" && $row_select_pipe['ret_wt_gm_3'] != "0" && $row_select_pipe['ret_wt_gm_3'] != null) {
																echo $row_select_pipe['ret_wt_gm_3'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_3'] != "" && $row_select_pipe['cum_ret_3'] != "0" && $row_select_pipe['cum_ret_3'] != null) {
																echo $row_select_pipe['cum_ret_3'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != "0" && $row_select_pipe['pass_sample_3'] != null) {
																echo $row_select_pipe['pass_sample_3'];
															} else {
																echo "&nbsp;";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">1.18 mm</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_4'] != "" && $row_select_pipe['cum_wt_gm_4'] != "0" && $row_select_pipe['cum_wt_gm_4'] != null) {
																echo $row_select_pipe['cum_wt_gm_4'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_4'] != "" && $row_select_pipe['ret_wt_gm_4'] != "0" && $row_select_pipe['ret_wt_gm_4'] != null) {
																echo $row_select_pipe['ret_wt_gm_4'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_4'] != "" && $row_select_pipe['cum_ret_4'] != "0" && $row_select_pipe['cum_ret_4'] != null) {
																echo $row_select_pipe['cum_ret_4'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != "0" && $row_select_pipe['pass_sample_4'] != null) {
																echo $row_select_pipe['pass_sample_4'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">600 mic</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_5'] != "" && $row_select_pipe['cum_wt_gm_5'] != "0" && $row_select_pipe['cum_wt_gm_5'] != null) {
																echo $row_select_pipe['cum_wt_gm_5'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_5'] != "" && $row_select_pipe['ret_wt_gm_5'] != "0" && $row_select_pipe['ret_wt_gm_5'] != null) {
																echo $row_select_pipe['ret_wt_gm_5'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_5'] != "" && $row_select_pipe['cum_ret_5'] != "0" && $row_select_pipe['cum_ret_5'] != null) {
																echo $row_select_pipe['cum_ret_5'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_5'] != "" && $row_select_pipe['pass_sample_5'] != "0" && $row_select_pipe['pass_sample_5'] != null) {
																echo $row_select_pipe['pass_sample_5'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">300 mic</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_6'] != "" && $row_select_pipe['cum_wt_gm_6'] != "0" && $row_select_pipe['cum_wt_gm_6'] != null) {
																echo $row_select_pipe['cum_wt_gm_6'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_6'] != "" && $row_select_pipe['ret_wt_gm_6'] != "0" && $row_select_pipe['ret_wt_gm_6'] != null) {
																echo $row_select_pipe['ret_wt_gm_6'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_6'] != "" && $row_select_pipe['cum_ret_6'] != "0" && $row_select_pipe['cum_ret_6'] != null) {
																echo $row_select_pipe['cum_ret_6'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_6'] != "" && $row_select_pipe['pass_sample_6'] != "0" && $row_select_pipe['pass_sample_6'] != null) {
																echo $row_select_pipe['pass_sample_6'];
															} else {
																echo "&nbsp;";
															} ?></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">150 mic</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_wt_gm_7'] != "" && $row_select_pipe['cum_wt_gm_7'] != "0" && $row_select_pipe['cum_wt_gm_7'] != null) {
																echo $row_select_pipe['cum_wt_gm_7'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ret_wt_gm_7'] != "" && $row_select_pipe['ret_wt_gm_7'] != "0" && $row_select_pipe['ret_wt_gm_7'] != null) {
																echo $row_select_pipe['ret_wt_gm_7'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['cum_ret_7'] != "" && $row_select_pipe['cum_ret_7'] != "0" && $row_select_pipe['cum_ret_7'] != null) {
																echo $row_select_pipe['cum_ret_7'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td  style="border: 1px solid black;"><?php if ($row_select_pipe['pass_sample_7'] != "" && $row_select_pipe['pass_sample_7'] != "0" && $row_select_pipe['pass_sample_7'] != null) {
																echo $row_select_pipe['pass_sample_7'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					
				</tr>
				
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">Total</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['blank_extra'] != "" && $row_select_pipe['blank_extra'] != "0" && $row_select_pipe['blank_extra'] != null) {
																echo $row_select_pipe['blank_extra'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"></td>
					<td style="border: 1px solid black;"></td>
					<td  style="border: 1px solid black;"><?php if ($row_select_pipe['grd_zone'] != "" && $row_select_pipe['grd_zone'] != "0" && $row_select_pipe['grd_zone'] != null) {
																echo $row_select_pipe['grd_zone'];
															} else {
																echo "&nbsp;";
															}  ?></td>
					<td style="border: 1px solid black;"></td>
					
				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">F.M.</td>
					<td style="border: 1px solid black;"></td>
					<td style="border: 1px solid black;"></td>
					<td style="border: 1px solid black;"></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['grd_fm'] != "" && $row_select_pipe['grd_fm'] != "0" && $row_select_pipe['grd_fm'] != null) {
																echo $row_select_pipe['grd_fm'];
															} else {
																echo "&nbsp;";
															} ?></td>
					<td style="border: 1px solid black;"></td>
				</tr>
				
				
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="100%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:100px;">
							<b style="font-size:10px;font-weight:100;">F/SND/01, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.12.2012</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:100px;">
							<b style="font-size:10px;font-weight:100;">Page: <?php echo $pagecnt; ?> of <?php echo $totalcnt; ?></b><br>
						</div>
					</td>
				</tr>
			</table>
			<?php
		}
		if (($row_select_pipe['silt_content'] != "" && $row_select_pipe['silt_content'] != "0" && $row_select_pipe['silt_content'] != null) || ($row_select_pipe['alk_a1'] != "" && $row_select_pipe['alk_a1'] != "0" && $row_select_pipe['alk_a1'] != null) || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null)) {
			$pagecnt++;
			?>
			<div class="pagebreak"></div>
			<br>
			<div id="header" style="text-align: center;width: 110px;margin: 0 auto;">
				<img src="../images/header.png" width="150px">
			</div>
			<h3 style="font-size:16px; text-align:center;"><u>OBSERVATION & CALCULAITON SHEET FOR TEST ON FINE AGGREGATE <br> IS 2386:1963 RA 2016</u></h3>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial;margin-top:-15px;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark: </b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $mark; ?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no; ?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Laboratory No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-5px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>3. DETERMINATION OF SILT CONTENT :<br>&nbsp;&nbsp; IS 2386:1963 Part-1 RA 2016 </b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['slt_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['slt_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['slt_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['slt_e_d']));
																		} ?></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black;">&nbsp;&nbsp; </td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td>&nbsp;&nbsp; The amount of material finer than 75 micron IS sieve shall be calculated as follows :</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; A= Percentage of material finer than 75 micron</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; B= Original weight B = <b><?php echo $row_select_pipe['silt_1'];  ?> gm</b></td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; C= Dry weight after washing C = <b><?php echo $row_select_pipe['silt_2'];  ?> gm. </b><br>&nbsp;&nbsp; Percentage of material</td>
				</tr>
				<tr>
					<td>&nbsp;&nbsp; Finer than 75 micron A = B - C x 100 = <b><?php echo $row_select_pipe['silt_content'];  ?></b></td>
				</tr>
				
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>B = <?php echo $row_select_pipe['silt_1']; ?> &nbsp;&nbsp;&nbsp;&nbsp; C = <?php echo $row_select_pipe['silt_2'];  ?>&nbsp;&nbsp;&nbsp;&nbsp; A = <?php echo $row_select_pipe['silt_content']; ?></b></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-5px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>4. Alkali Reactivity Test :<br>&nbsp;&nbsp; As per IS 2386 : 1963, Part-4 RA 2016</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['alk_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['alk_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['alk_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['alk_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center; font-weight:bold;">Sr. no</td>
					<td width="40%" style="border: 1px solid black; text-align:center; font-weight:bold;">DISCRIPTION</td>
					<td width="25%" style="border: 1px solid black; text-align:center; font-weight:bold;">1</td>
					<td width="25%" style="border: 1px solid black; text-align:center; font-weight:bold;">2</td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center; ">1</td>
					<td style="border: 1px solid black; text-align:center; ">Length of Speciment after 24 hr</td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_a1'] != "" && $row_select_pipe['alk_a1'] != "0" && $row_select_pipe['alk_a1'] != null) {
																					echo $row_select_pipe['alk_a1'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_b1'] != "" && $row_select_pipe['alk_b1'] != "0" && $row_select_pipe['alk_b1'] != null) {
																					echo $row_select_pipe['alk_b1'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center; ">2</td>
					<td style="border: 1px solid black; text-align:center; ">Length of Speciment after 7 days</td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_a2'] != "" && $row_select_pipe['alk_a2'] != "0" && $row_select_pipe['alk_a2'] != null) {
																					echo $row_select_pipe['alk_a2'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_b2'] != "" && $row_select_pipe['alk_b2'] != "0" && $row_select_pipe['alk_b2'] != null) {
																					echo $row_select_pipe['alk_b2'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center; ">3</td>
					<td style="border: 1px solid black; text-align:center; ">Length of Speciment after 28 days</td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_a3'] != "" && $row_select_pipe['alk_a3'] != "0" && $row_select_pipe['alk_a3'] != null) {
																					echo $row_select_pipe['alk_a3'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_b3'] != "" && $row_select_pipe['alk_b3'] != "0" && $row_select_pipe['alk_b3'] != null) {
																					echo $row_select_pipe['alk_b3'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center; ">4</td>
					<td style="border: 1px solid black; text-align:center; ">Length of Speciment after 6 Months</td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_a4'] != "" && $row_select_pipe['alk_a4'] != "0" && $row_select_pipe['alk_a4'] != null) {
																					echo $row_select_pipe['alk_a4'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_b4'] != "" && $row_select_pipe['alk_b4'] != "0" && $row_select_pipe['alk_b4'] != null) {
																					echo $row_select_pipe['alk_b4'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center; ">5</td>
					<td style="border: 1px solid black; text-align:center; ">Length of Speciment after 365 days</td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_a5'] != "" && $row_select_pipe['alk_a5'] != "0" && $row_select_pipe['alk_a5'] != null) {
																					echo $row_select_pipe['alk_a5'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
					<td style="border: 1px solid black; text-align:center; "><?php if ($row_select_pipe['alk_b5'] != "" && $row_select_pipe['alk_b5'] != "0" && $row_select_pipe['alk_b5'] != null) {
																					echo $row_select_pipe['alk_b5'];
																				} else {
																					echo "&nbsp;";
																				} ?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-5px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>5. BULK DENSITY: <br>&nbsp;&nbsp;
					IS 2386:1963 Part 3,RA 2016,Clause No.3</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['den_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['den_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['den_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['den_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black;"><center><b>Sr.No.</b></center></td>
					<td width="40%" style="border: 1px solid black;"><center><b>Particular</b></center></td>
					<td width="16.6%" style="border: 1px solid black;"><center><b>(I)</b></center></td>
					<td width="16.6%" style="border: 1px solid black;"><center><b>(II)</b></center></td>						
					<td width="16.6%" style="border: 1px solid black;"><center><b>(III)</b></center></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>1</b></center></td>
					<td style="border: 1px solid black;"><b>Weight of mould + material in gm</b></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m11'] != "" && $row_select_pipe['m11'] != "0" && $row_select_pipe['m11'] != null) {
																		echo $row_select_pipe['m11'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m12'] != "" && $row_select_pipe['m12'] != "0" && $row_select_pipe['m12'] != null) {
																		echo $row_select_pipe['m12'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m13'] != "" && $row_select_pipe['m13'] != "0" && $row_select_pipe['m13'] != null) {
																		echo $row_select_pipe['m13'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>2</b></center></td>
					<td style="border: 1px solid black;"><b>Weight of mould in gm</b></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m21'] != "" && $row_select_pipe['m21'] != "0" && $row_select_pipe['m21'] != null) {
																		echo $row_select_pipe['m21'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m22'] != "" && $row_select_pipe['m22'] != "0" && $row_select_pipe['m22'] != null) {
																		echo $row_select_pipe['m22'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m23'] != "" && $row_select_pipe['m23'] != "0" && $row_select_pipe['m23'] != null) {
																		echo $row_select_pipe['m23'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><center><b>3</b></center></td>
					<td style="border: 1px solid black;"><b>Weight of material in gm</b></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m31'] != "" && $row_select_pipe['m31'] != "0" && $row_select_pipe['m31'] != null) {
																		echo $row_select_pipe['m31'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m32'] != "" && $row_select_pipe['m32'] != "0" && $row_select_pipe['m32'] != null) {
																		echo $row_select_pipe['m32'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
					<td style="border: 1px solid black;"><center><?php if ($row_select_pipe['m33'] != "" && $row_select_pipe['m33'] != "0" && $row_select_pipe['m33'] != null) {
																		echo $row_select_pipe['m33'];
																	} else {
																		echo " <br>";
																	} ?></center></td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;text-align:right;"><b>Average</b></td>
					<td colspan="3" style="border: 1px solid black;"><center><?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {
																					echo $row_select_pipe['avg_wom'];
																				} else {
																					echo "&nbsp;";
																				} ?></center></td>
				</tr>
				<tr>
					<td colspan="2" style="text-align:left;">&nbsp; <b>Average weight of material = <?php if ($row_select_pipe['avg_wom'] != "" && $row_select_pipe['avg_wom'] != "0" && $row_select_pipe['avg_wom'] != null) {
																										echo number_format($row_select_pipe['avg_wom'] / 100, 2);
																									} else {
																										echo "&nbsp;";
																									} ?> kg</b></td>
					<td colspan="3" style=""><b>volume of mould = </b> <?php if ($row_select_pipe['vol'] != "" && $row_select_pipe['vol'] != "0" && $row_select_pipe['vol'] != null) {
																			echo $row_select_pipe['vol'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
				</tr>
				<tr>
					<td colspan="5" style="text-align:left;">&nbsp; <b>Bulk loose density = Average weight of material / volume of mould = <?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null) {
																																				echo $row_select_pipe['bdl'];
																																			} else {
																																				echo "&nbsp;";
																																			} ?> kg / m<sup>3</sup></b></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-5px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>6. ORGANIC IMPURITIES TEST<br>&nbsp;&nbsp;
					IS 2386-1963 PART-II RA-2016</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['org_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['org_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['org_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['org_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="40%" rowspan="3" style="border: 1px solid black; text-align:center">Sand Sample With Added 3% Solution Sodium Hydroxide Up to 200 ml</td>
					<td width="10%" style="border: 1px solid black; text-align:center; font-weight:bold;">Reading</td>
					<td width="25%" style="border: 1px solid black; text-align:center; font-weight:bold;">After 24 Hour</td>
					<td width="25%" style="border: 1px solid black; text-align:center; font-weight:bold;">Result</td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['aoi_1'] != "" && $row_select_pipe['aoi_1'] != "0" && $row_select_pipe['aoi_1'] != null) {
																				echo $row_select_pipe['aoi_1'];
																			} else {
																				echo "&nbsp;";
																			} ?> <br></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['aoi_2'] != "" && $row_select_pipe['aoi_2'] != "0" && $row_select_pipe['aoi_2'] != null) {
																				echo $row_select_pipe['aoi_2'];
																			} else {
																				echo "&nbsp;";
																			} ?> <br></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['aoi_4'] != "" && $row_select_pipe['aoi_4'] != "0" && $row_select_pipe['aoi_4'] != null) {
																							echo $row_select_pipe['aoi_4'];
																						} else {
																							echo "&nbsp;";
																						} ?><br></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php //if($row_select_pipe['wom3']!="" && $row_select_pipe['wom3']!="0" && $row_select_pipe['wom3']!=null){echo $row_select_pipe['wom3']; }else{echo "&nbsp;";}
																			?> <br></td>
					<td style="border: 1px solid black; text-align:center;"><?php //if($row_select_pipe['wom3']!="" && $row_select_pipe['wom3']!="0" && $row_select_pipe['wom3']!=null){echo $row_select_pipe['wom3']; }else{echo "&nbsp;";}
																			?> <br></td>
					
				</tr>
			</table>
			<br>
			<br>
			
			<br>
			<br>
			<table align="center" width="100%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:60px;">
							<b style="font-size:10px;font-weight:100;">F/SND/01, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.12.2012</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:60px;">
							<b style="font-size:10px;font-weight:100;">Page: <?php echo $pagecnt; ?> of <?php echo $totalcnt; ?></b><br>
						</div>
					</td>
				</tr>
			</table>
			<?php
		}
		if (($row_select_pipe['dele_1_3'] != "" && $row_select_pipe['dele_1_3'] != "0" && $row_select_pipe['dele_1_3'] != null) || ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) || ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null)) {
			$pagecnt++;
			?>
			<div class="pagebreak"></div>
			<br>
			<div id="header" style="text-align: center;width: 110px;margin: 0 auto;">
				<img src="../images/header.png" width="150px">
			</div>
			<h3 style="font-size:16px; text-align:center;"><u>OBSERVATION & CALCULAITON SHEET FOR TEST ON FINE AGGREGATE <br> IS 2386:1963 RA 2016</u></h3>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial;margin-top:-15px;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark: </b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $mark; ?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no; ?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Laboratory No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>7. Deleterious material <br> &nbsp;&nbsp; As per IS 2386 : 1963, Part-2 RA 2016</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['del_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['del_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>(7.1) Determination of light weight pieces <br> &nbsp;&nbsp; (Coal & Lignite)</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['del_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['del_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="height:150px;border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Perticular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Dry weight in gm of decanted pieces (W1)</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_3_1'] != "" && $row_select_pipe['dele_3_1'] != "0" && $row_select_pipe['dele_3_1'] != null) {
																		echo $row_select_pipe['dele_3_1'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Dry weight in gm of portion of sample finer than 300 micron IS Sieve (W3)</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_3_2'] != "" && $row_select_pipe['dele_3_2'] != "0" && $row_select_pipe['dele_3_2'] != null) {
																		echo $row_select_pipe['dele_3_2'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="100%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Percentage of clay lumps (L)</td>
								<td width="10%" rowspan="2" style="text-align:center;">=</td>
								<td width="10%" rowspan="2" style="text-align:center;"></td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">W1</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 100</td>
							</tr>
							<tr>
								<td style="text-align:center;">W3</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_3_3'] != "" && $row_select_pipe['dele_3_3'] != "0" && $row_select_pipe['dele_3_3'] != null) {
																		echo $row_select_pipe['dele_3_3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>(7.2) Determine of Clay lumps</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['del_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['del_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="height:150px;border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Perticular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Weight of sample (W)</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_2_1'] != "" && $row_select_pipe['dele_2_1'] != "0" && $row_select_pipe['dele_2_1'] != null) {
																		echo $row_select_pipe['dele_2_1'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Weight of sample after removal of clay lumps (R )</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_2_2'] != "" && $row_select_pipe['dele_2_2'] != "0" && $row_select_pipe['dele_2_2'] != null) {
																		echo $row_select_pipe['dele_2_2'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="100%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Percentage of clay lumps (L)</td>
								<td width="10%" rowspan="2" style="text-align:center;">=</td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">W - R</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 100</td>
							</tr>
							<tr>
								<td style="text-align:center;">W</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_2_3'] != "" && $row_select_pipe['dele_2_3'] != "0" && $row_select_pipe['dele_2_3'] != null) {
																		echo $row_select_pipe['dele_2_3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>(7.3) Material finer than 75 micron sieve</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['del_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['del_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['del_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="height:150px;border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="10%" style="border: 1px solid black; font-weight:bold;"><center>Sr No.</center></td>
					<td width="40%" style="border: 1px solid black; font-weight:bold;"><center>Perticular </center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Result Obtained</center></td>
					<td width="20%" style="border: 1px solid black; font-weight:bold;"><center>Remarks</center></td>
				</tr>	
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Weight of sample (B)</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_1_1'] != "" && $row_select_pipe['dele_1_1'] != "0" && $row_select_pipe['dele_1_1'] != null) {
																		echo $row_select_pipe['dele_1_1'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>2.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>Weight of sample after removal of clay lumps (C)</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_1_2'] != "" && $row_select_pipe['dele_1_2'] != "0" && $row_select_pipe['dele_1_2'] != null) {
																		echo $row_select_pipe['dele_1_2'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>3.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;">
						<table width="100%" style="font-size:11px; font-weight:bold;">
							<tr>
								<td width="30%" rowspan="2" style="text-align:center;">Material finer than 75 micron sieve =</td>
								<td width="10%" rowspan="2" style="text-align:center;">=</td>
								<td width="15%" style="text-align:center; border-bottom: 1px solid black;">B-C</td>
								<td width="15%" rowspan="2" style="text-align:center;">x 100</td>
							</tr>
							<tr>
								<td style="text-align:center;">B</td>
							</tr>
						</table>						
					</td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['dele_1_4'] != "" && $row_select_pipe['dele_1_4'] != "0" && $row_select_pipe['dele_1_4'] != null) {
																		echo $row_select_pipe['dele_1_4'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
				<tr>
					<td  style="border: 1px solid black;"><center>1.</center></td>
					<td  style="border: 1px solid black; font-weight:bold;"><center>TOTAL DELETERIOUS MATERIAL (7.1+7.2+7.3)</center></td>
					<td  style="border: 1px solid black;"><center><?php
																	$a1 = $row_select_pipe['dele_1_4'];
																	$a2 = $row_select_pipe['dele_2_3'];
																	$a3 = $row_select_pipe['dele_3_3'];

																	$ans = floatval($a1)  + floatval($a2) + floatval($a3);
																	echo number_format($ans, 3);
																	?></center></td>
					<td  style="border: 1px solid black;"><center></center></td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<table align="center" width="100%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:50px;">
							<b style="font-size:10px;font-weight:100;">F/SND/01, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.12.2012</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:50px;">
							<b style="font-size:10px;font-weight:100;">Page: <?php echo $pagecnt; ?> of <?php echo $totalcnt; ?></b><br>
						</div>
					</td>
				</tr>
			</table>
			<?php
		}
		if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null)) {

			$pagecnt++;
			?>
			<div class="pagebreak"></div>
			<br>
			<div id="header" style="text-align: center;width: 110px;margin: 0 auto;">
				<img src="../images/header.png" width="150px">
			</div>
			<h3 style="font-size:16px; text-align:center;"><u>OBSERVATION & CALCULAITON SHEET FOR TEST ON FINE AGGREGATE <br> IS 2386:1963 RA 2016</u></h3>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial;margin-top:-15px;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark: </b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $mark; ?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no; ?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Laboratory No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>8. Soundness by MgSO<sub>4</sub><br> &nbsp;&nbsp; IS 2386 Part-5 </b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['sou_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['sou_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['sou_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['sou_e_d']));
																		} ?></td>
				</tr>
			</table>
			
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					<td colspan="2" style="border: 1px solid black;"><center>Sieve Size</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>Grading of <br> Original <br> sample %</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>Weight of test <br> fractions before test</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>% passing finer <br> sieve after test <br> (Actual % loss)</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>Weighted average <br> (corrected % loss)</center></td>
				</tr>
				<tr style="text-align:center;font-weight:bold;">
					<td  style="border: 1px solid black;font-weight:bold;">Passing</td>
					<td  style="border: 1px solid black;font-weight:bold;">Retained</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>150 mic</center></td>
					<td  style="border: 1px solid black;"><center>--</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go1'] != "" && $row_select_pipe['go1'] != "0" && $row_select_pipe['go1'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go1'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt1'] != "" && $row_select_pipe['wt1'] != "0" && $row_select_pipe['wt1'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt1'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp1'] != "" && $row_select_pipe['pp1'] != "0" && $row_select_pipe['pp1'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp1'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa1'] != "" && $row_select_pipe['wa1'] != "0" && $row_select_pipe['wa1'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa1'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>300 mic</center></td>
					<td  style="border: 1px solid black;"><center>150 mic</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go2'] != "" && $row_select_pipe['go2'] != "0" && $row_select_pipe['go2'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt2'] != "" && $row_select_pipe['wt2'] != "0" && $row_select_pipe['wt2'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp2'] != "" && $row_select_pipe['pp2'] != "0" && $row_select_pipe['pp2'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa2'] != "" && $row_select_pipe['wa2'] != "0" && $row_select_pipe['wa2'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>600 mic</center></td>
					<td  style="border: 1px solid black;"><center>300 mic</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go3'] != "" && $row_select_pipe['go3'] != "0" && $row_select_pipe['go3'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt3'] != "" && $row_select_pipe['wt3'] != "0" && $row_select_pipe['wt3'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp3'] != "" && $row_select_pipe['pp3'] != "0" && $row_select_pipe['pp3'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa3'] != "" && $row_select_pipe['wa3'] != "0" && $row_select_pipe['wa3'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>1.18 mm</center></td>
					<td  style="border: 1px solid black;"><center>600 mic</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go4'] != "" && $row_select_pipe['go4'] != "0" && $row_select_pipe['go4'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go4'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt4'] != "" && $row_select_pipe['wt4'] != "0" && $row_select_pipe['wt4'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt4'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp4'] != "" && $row_select_pipe['pp4'] != "0" && $row_select_pipe['pp4'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp4'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa4'] != "" && $row_select_pipe['wa4'] != "0" && $row_select_pipe['wa4'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa4'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>2.36 mm</center></td>
					<td  style="border: 1px solid black;"><center>1.18 mm</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go5'] != "" && $row_select_pipe['go5'] != "0" && $row_select_pipe['go5'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt5'] != "" && $row_select_pipe['wt5'] != "0" && $row_select_pipe['wt5'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp5'] != "" && $row_select_pipe['pp5'] != "0" && $row_select_pipe['pp5'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa5'] != "" && $row_select_pipe['wa5'] != "0" && $row_select_pipe['wa5'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>4.75 mm</center></td>
					<td  style="border: 1px solid black;"><center>2.36 mm</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go6'] != "" && $row_select_pipe['go6'] != "0" && $row_select_pipe['go6'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go6'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt6'] != "" && $row_select_pipe['wt6'] != "0" && $row_select_pipe['wt6'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt6'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp6'] != "" && $row_select_pipe['pp6'] != "0" && $row_select_pipe['pp6'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp6'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa6'] != "" && $row_select_pipe['wa6'] != "0" && $row_select_pipe['wa6'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa6'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>10 mm</center></td>
					<td  style="border: 1px solid black;"><center>4.75 mm</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go7'] != "" && $row_select_pipe['go7'] != "0" && $row_select_pipe['go7'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['go7'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt7'] != "" && $row_select_pipe['wt7'] != "0" && $row_select_pipe['wt7'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wt7'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp7'] != "" && $row_select_pipe['pp7'] != "0" && $row_select_pipe['pp7'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['pp7'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa7'] != "" && $row_select_pipe['wa7'] != "0" && $row_select_pipe['wa7'] != null && $row_select_pipe['wom1'] == "M1") {
																		echo $row_select_pipe['wa7'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 0px solid black;">Results :-</td>
					<td style="border: 0px solid black;">Soundness</td>
					<td style="border: 0px solid black;">=</td>
					<td  colspan="3" style="border: 0px solid black;text-align:left;" > <?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null && $row_select_pipe['wom1'] == "M1") {
																							echo $row_select_pipe['soundness'];
																						} else {
																							echo "&nbsp;";
																						}  ?> %</td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr>
					<td width="50%" rowspan="2" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>9. Soundness by Na<sub>2</sub>SO<sub>4</sub><br> &nbsp;&nbsp; IS 2386 Part-5 </b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; Starting Date of Test</td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['sou_s_d'] != "0000-00-00") {
																						echo date("d/m/Y", strtotime($row_select_pipe['sou_s_d']));
																					} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; Completion Date of Test</td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php if ($row_select_pipe['sou_e_d'] != "0000-00-00") {
																			echo date("d/m/Y", strtotime($row_select_pipe['sou_e_d']));
																		} ?></td>
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial; margin-top:-1px;">
				<tr style="border: 1px solid black;font-weight:bold;">
					<td colspan="2" style="border: 1px solid black;"><center>Sieve Size</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>Grading of <br> Original <br> sample %</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>Weight of test <br> fractions before test</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>% passing finer <br> sieve after test <br> (Actual % loss)</center></td>
					<td  style="border: 1px solid black;" rowspan="2"><center>Weighted average <br> (corrected % loss)</center></td>
				</tr>
				<tr style="text-align:center;font-weight:bold;">
					<td  style="border: 1px solid black;font-weight:bold;">Passing</td>
					<td  style="border: 1px solid black;font-weight:bold;">Retained</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>150 mic</center></td>
					<td  style="border: 1px solid black;"><center>--</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go1'] != "" && $row_select_pipe['go1'] != "0" && $row_select_pipe['go1'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go1'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt1'] != "" && $row_select_pipe['wt1'] != "0" && $row_select_pipe['wt1'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt1'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp1'] != "" && $row_select_pipe['pp1'] != "0" && $row_select_pipe['pp1'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp1'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa1'] != "" && $row_select_pipe['wa1'] != "0" && $row_select_pipe['wa1'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa1'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>300 mic</center></td>
					<td  style="border: 1px solid black;"><center>150 mic</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go2'] != "" && $row_select_pipe['go2'] != "0" && $row_select_pipe['go2'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt2'] != "" && $row_select_pipe['wt2'] != "0" && $row_select_pipe['wt2'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp2'] != "" && $row_select_pipe['pp2'] != "0" && $row_select_pipe['pp2'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa2'] != "" && $row_select_pipe['wa2'] != "0" && $row_select_pipe['wa2'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa2'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>600 mic</center></td>
					<td  style="border: 1px solid black;"><center>300 mic</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go3'] != "" && $row_select_pipe['go3'] != "0" && $row_select_pipe['go3'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt3'] != "" && $row_select_pipe['wt3'] != "0" && $row_select_pipe['wt3'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp3'] != "" && $row_select_pipe['pp3'] != "0" && $row_select_pipe['pp3'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa3'] != "" && $row_select_pipe['wa3'] != "0" && $row_select_pipe['wa3'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa3'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>1.18 mm</center></td>
					<td  style="border: 1px solid black;"><center>600 mic</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go4'] != "" && $row_select_pipe['go4'] != "0" && $row_select_pipe['go4'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go4'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt4'] != "" && $row_select_pipe['wt4'] != "0" && $row_select_pipe['wt4'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt4'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp4'] != "" && $row_select_pipe['pp4'] != "0" && $row_select_pipe['pp4'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp4'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa4'] != "" && $row_select_pipe['wa4'] != "0" && $row_select_pipe['wa4'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa4'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>2.36 mm</center></td>
					<td  style="border: 1px solid black;"><center>1.18 mm</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go5'] != "" && $row_select_pipe['go5'] != "0" && $row_select_pipe['go5'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt5'] != "" && $row_select_pipe['wt5'] != "0" && $row_select_pipe['wt5'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp5'] != "" && $row_select_pipe['pp5'] != "0" && $row_select_pipe['pp5'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa5'] != "" && $row_select_pipe['wa5'] != "0" && $row_select_pipe['wa5'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa5'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>4.75 mm</center></td>
					<td  style="border: 1px solid black;"><center>2.36 mm</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go6'] != "" && $row_select_pipe['go6'] != "0" && $row_select_pipe['go6'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go6'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt6'] != "" && $row_select_pipe['wt6'] != "0" && $row_select_pipe['wt6'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt6'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp6'] != "" && $row_select_pipe['pp6'] != "0" && $row_select_pipe['pp6'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp6'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa6'] != "" && $row_select_pipe['wa6'] != "0" && $row_select_pipe['wa6'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa6'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;"><center>10 mm</center></td>
					<td  style="border: 1px solid black;"><center>4.75 mm</center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['go7'] != "" && $row_select_pipe['go7'] != "0" && $row_select_pipe['go7'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['go7'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wt7'] != "" && $row_select_pipe['wt7'] != "0" && $row_select_pipe['wt7'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wt7'];
																	} else {
																		echo "&nbsp;";
																	} ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['pp7'] != "" && $row_select_pipe['pp7'] != "0" && $row_select_pipe['pp7'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['pp7'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
					<td  style="border: 1px solid black;"><center><?php if ($row_select_pipe['wa7'] != "" && $row_select_pipe['wa7'] != "0" && $row_select_pipe['wa7'] != null && $row_select_pipe['wom1'] == "N1") {
																		echo $row_select_pipe['wa7'];
																	} else {
																		echo "&nbsp;";
																	}  ?></center></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 0px solid black;">Results :-</td>
					<td style="border: 0px solid black;">Soundness</td>
					<td style="border: 0px solid black;">=</td>
					<td  colspan="3" style="border: 0px solid black;text-align:left;" > <?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null && $row_select_pipe['wom1'] == "N1") {
																							echo $row_select_pipe['soundness'];
																						} else {
																							echo "&nbsp;";
																						}  ?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td colspan="6" style="border: 0px solid black;"><b>Limit :</b> 10 % When Tested with NA<sub>2</sub>SO<sub>4</sub> & 15 % When Tested with MgSO<sub>4</sub> <br> <b>NOTE :- </b>All Requirements are as per IS 383 : 2016</td>
				</tr>
			</table>
			
			<br>
			<table align="center" width="100%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:11px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:70px;">
							<b style="font-size:10px;font-weight:100;">F/SND/01, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.12.2012</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:70px;">
							<b style="font-size:10px;font-weight:100;">Page: <?php echo $pagecnt; ?> of <?php echo $totalcnt; ?></b><br>
						</div>
					</td>
				</tr>
			</table>
			</page>
			<?php
		}

			?> -->

</body>

</html>


<script type="text/javascript">


</script>