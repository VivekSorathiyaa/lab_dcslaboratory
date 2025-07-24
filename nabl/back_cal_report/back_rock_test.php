<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin:0 40px;
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
	$select_tiles_query = "select * from rock WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$agSTCment_no = $row_select['agSTCment_no'];
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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
	}
	?>



	<page size="A4">
	<?php if (($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) || ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) || ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) || ($row_select_pipe['sp_agg1'] != "" && $row_select_pipe['sp_agg1'] != "0" && $row_select_pipe['sp_agg1'] != null) || ($row_select_pipe['sp_wat1'] != "" && $row_select_pipe['sp_wat1'] != "0" && $row_select_pipe['sp_wat1'] != null) || ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) || ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) || ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) || ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) || ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) || ($row_select_pipe['sp_agg2'] != "" && $row_select_pipe['sp_agg2'] != "0" && $row_select_pipe['sp_agg2'] != null) || ($row_select_pipe['sp_wat2'] != "" && $row_select_pipe['sp_wat2'] != "0" && $row_select_pipe['sp_wat2'] != null) || ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) || ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) || ($row_select_pipe['sp_wt_st_3'] != "" && $row_select_pipe['sp_wt_st_3'] != "0" && $row_select_pipe['sp_wt_st_3'] != null) || ($row_select_pipe['sp_w_s_3'] != "" && $row_select_pipe['sp_w_s_3'] != "0" && $row_select_pipe['sp_w_s_3'] != null) || ($row_select_pipe['sp_w_sur_3'] != "" && $row_select_pipe['sp_w_sur_3'] != "0" && $row_select_pipe['sp_w_sur_3'] != null) || ($row_select_pipe['sp_agg3'] != "" && $row_select_pipe['sp_agg3'] != "0" && $row_select_pipe['sp_agg3'] != null) || ($row_select_pipe['sp_wat3'] != "" && $row_select_pipe['sp_wat3'] != "0" && $row_select_pipe['sp_wat3'] != null) || ($row_select_pipe['sp_specific_gravity_3'] != "" && $row_select_pipe['sp_specific_gravity_3'] != "0" && $row_select_pipe['sp_specific_gravity_3'] != null) || ($row_select_pipe['sp_water_abr_3'] != "" && $row_select_pipe['sp_water_abr_3'] != "0" && $row_select_pipe['sp_water_abr_3'] != null) || ($row_select_pipe['sp_wt_st_4'] != "" && $row_select_pipe['sp_wt_st_4'] != "0" && $row_select_pipe['sp_wt_st_4'] != null) || ($row_select_pipe['sp_w_s_4'] != "" && $row_select_pipe['sp_w_s_4'] != "0" && $row_select_pipe['sp_w_s_4'] != null) || ($row_select_pipe['sp_w_sur_4'] != "" && $row_select_pipe['sp_w_sur_4'] != "0" && $row_select_pipe['sp_w_sur_4'] != null) || ($row_select_pipe['sp_agg4'] != "" && $row_select_pipe['sp_agg4'] != "0" && $row_select_pipe['sp_agg4'] != null) || ($row_select_pipe['sp_wat4'] != "" && $row_select_pipe['sp_wat4'] != "0" && $row_select_pipe['sp_wat4'] != null) || ($row_select_pipe['sp_specific_gravity_4'] != "" && $row_select_pipe['sp_specific_gravity_4'] != "0" && $row_select_pipe['sp_specific_gravity_4'] != null) || ($row_select_pipe['sp_water_abr_4'] != "" && $row_select_pipe['sp_water_abr_4'] != "0" && $row_select_pipe['sp_water_abr_4'] != null) || ($row_select_pipe['sp_wt_st_5'] != "" && $row_select_pipe['sp_wt_st_5'] != "0" && $row_select_pipe['sp_wt_st_5'] != null) || ($row_select_pipe['sp_w_s_5'] != "" && $row_select_pipe['sp_w_s_5'] != "0" && $row_select_pipe['sp_w_s_5'] != null) || ($row_select_pipe['sp_w_sur_5'] != "" && $row_select_pipe['sp_w_sur_5'] != "0" && $row_select_pipe['sp_w_sur_5'] != null) || ($row_select_pipe['sp_agg5'] != "" && $row_select_pipe['sp_agg5'] != "0" && $row_select_pipe['sp_agg5'] != null) || ($row_select_pipe['sp_wat5'] != "" && $row_select_pipe['sp_wat5'] != "0" && $row_select_pipe['sp_wat5'] != null) || ($row_select_pipe['sp_specific_gravity_5'] != "" && $row_select_pipe['sp_specific_gravity_5'] != "0" && $row_select_pipe['sp_specific_gravity_5'] != null) || ($row_select_pipe['sp_water_abr_5'] != "" && $row_select_pipe['sp_water_abr_5'] != "0" && $row_select_pipe['sp_water_abr_5'] != null) || ($row_select_pipe['sp_wt_st_6'] != "" && $row_select_pipe['sp_wt_st_6'] != "0" && $row_select_pipe['sp_wt_st_6'] != null) || ($row_select_pipe['sp_w_s_6'] != "" && $row_select_pipe['sp_w_s_6'] != "0" && $row_select_pipe['sp_w_s_6'] != null) || ($row_select_pipe['sp_w_sur_6'] != "" && $row_select_pipe['sp_w_sur_6'] != "0" && $row_select_pipe['sp_w_sur_6'] != null) || ($row_select_pipe['sp_agg6'] != "" && $row_select_pipe['sp_agg6'] != "0" && $row_select_pipe['sp_agg6'] != null) || ($row_select_pipe['sp_wat6'] != "" && $row_select_pipe['sp_wat6'] != "0" && $row_select_pipe['sp_wat6'] != null) || ($row_select_pipe['sp_specific_gravity_6'] != "" && $row_select_pipe['sp_specific_gravity_6'] != "0" && $row_select_pipe['sp_specific_gravity_6'] != null) || ($row_select_pipe['sp_water_abr_6'] != "" && $row_select_pipe['sp_water_abr_6'] != "0" && $row_select_pipe['sp_water_abr_6'] != null) || ($row_select_pipe['sp_wt_st_7'] != "" && $row_select_pipe['sp_wt_st_7'] != "0" && $row_select_pipe['sp_wt_st_7'] != null) || ($row_select_pipe['sp_w_s_7'] != "" && $row_select_pipe['sp_w_s_7'] != "0" && $row_select_pipe['sp_w_s_7'] != null) || ($row_select_pipe['sp_w_sur_7'] != "" && $row_select_pipe['sp_w_sur_7'] != "0" && $row_select_pipe['sp_w_sur_7'] != null) || ($row_select_pipe['sp_agg7'] != "" && $row_select_pipe['sp_agg7'] != "0" && $row_select_pipe['sp_agg7'] != null) || ($row_select_pipe['sp_wat7'] != "" && $row_select_pipe['sp_wat7'] != "0" && $row_select_pipe['sp_wat7'] != null) || ($row_select_pipe['sp_specific_gravity_7'] != "" && $row_select_pipe['sp_specific_gravity_7'] != "0" && $row_select_pipe['sp_specific_gravity_7'] != null) || ($row_select_pipe['sp_water_abr_7'] != "" && $row_select_pipe['sp_water_abr_7'] != "0" && $row_select_pipe['sp_water_abr_7'] != null) || ($row_select_pipe['sp_wt_st_8'] != "" && $row_select_pipe['sp_wt_st_8'] != "0" && $row_select_pipe['sp_wt_st_8'] != null) || ($row_select_pipe['sp_w_s_8'] != "" && $row_select_pipe['sp_w_s_8'] != "0" && $row_select_pipe['sp_w_s_8'] != null) || ($row_select_pipe['sp_w_sur_8'] != "" && $row_select_pipe['sp_w_sur_8'] != "0" && $row_select_pipe['sp_w_sur_8'] != null) || ($row_select_pipe['sp_agg8'] != "" && $row_select_pipe['sp_agg8'] != "0" && $row_select_pipe['sp_agg8'] != null) || ($row_select_pipe['sp_wat8'] != "" && $row_select_pipe['sp_wat8'] != "0" && $row_select_pipe['sp_wat8'] != null) || ($row_select_pipe['sp_specific_gravity_8'] != "" && $row_select_pipe['sp_specific_gravity_8'] != "0" && $row_select_pipe['sp_specific_gravity_8'] != null) || ($row_select_pipe['sp_water_abr_8'] != "" && $row_select_pipe['sp_water_abr_8'] != "0" && $row_select_pipe['sp_water_abr_8'] != null) || ($row_select_pipe['sp_wt_st_9'] != "" && $row_select_pipe['sp_wt_st_9'] != "0" && $row_select_pipe['sp_wt_st_9'] != null) || ($row_select_pipe['sp_w_s_9'] != "" && $row_select_pipe['sp_w_s_9'] != "0" && $row_select_pipe['sp_w_s_9'] != null) || ($row_select_pipe['sp_w_sur_9'] != "" && $row_select_pipe['sp_w_sur_9'] != "0" && $row_select_pipe['sp_w_sur_9'] != null) || ($row_select_pipe['sp_agg9'] != "" && $row_select_pipe['sp_agg9'] != "0" && $row_select_pipe['sp_agg9'] != null) || ($row_select_pipe['sp_wat9'] != "" && $row_select_pipe['sp_wat9'] != "0" && $row_select_pipe['sp_wat9'] != null) || ($row_select_pipe['sp_specific_gravity_9'] != "" && $row_select_pipe['sp_specific_gravity_9'] != "0" && $row_select_pipe['sp_specific_gravity_9'] != null) || ($row_select_pipe['sp_water_abr_9'] != "" && $row_select_pipe['sp_water_abr_9'] != "0" && $row_select_pipe['sp_water_abr_9'] != null) || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['sp_porosity_1'] != "" && $row_select_pipe['sp_porosity_1'] != "0" && $row_select_pipe['sp_porosity_1'] != null) || ($row_select_pipe['sp_sg_avg_2'] != "" && $row_select_pipe['sp_sg_avg_2'] != "0" && $row_select_pipe['sp_sg_avg_2'] != null) || ($row_select_pipe['sp_wa_avg_2'] != "" && $row_select_pipe['sp_wa_avg_2'] != "0" && $row_select_pipe['sp_wa_avg_2'] != null) || ($row_select_pipe['sp_porosity_2'] != "" && $row_select_pipe['sp_porosity_2'] != "0" && $row_select_pipe['sp_porosity_2'] != null) || ($row_select_pipe['sp_sg_avg_3'] != "" && $row_select_pipe['sp_sg_avg_3'] != "0" && $row_select_pipe['sp_sg_avg_3'] != null) || ($row_select_pipe['sp_wa_avg_3'] != "" && $row_select_pipe['sp_wa_avg_3'] != "0" && $row_select_pipe['sp_wa_avg_3'] != null) || ($row_select_pipe['sp_porosity_3'] != "" && $row_select_pipe['sp_porosity_3'] != "0" && $row_select_pipe['sp_porosity_3'] != null)) { ?>
	<br>
	<br>
	<br>
	<br>
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
					 <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 3</td>
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
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; "><span style="" colspan="3"> OBSERVATION AND CALCULATION SHEET FOR TEST ON ROCK</td>
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
<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;border-top:2px solid black;">SPECIFIC GRAVITY & WATER ABSORPATION & POROSITY</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				

				<!-- table design -->
				<tr>
					<td>
					<?php $cnt=1; ?>
							<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-top: 2px solid;">
									<tr>
										<td style="border:1px solid;text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;width:3%;" rowspan=3>Sr. No.</td>
										<td style="border:1px solid;text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;width:6%;" rowspan=3>Sample ID</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;width:10%;" rowspan=3>Wt. of Oven Dry test piece,A (g)</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;width:10%;" rowspan=3>Wt. of saturated surface dry sample, B (g)</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;width:10%;" rowspan=3>Quantity of water added in 1000 ml jar containing test sample, C (g)</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;width:10%;">Apparent Specific Gravity,</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;width:10%;">Water Absorpation,</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;width:20%;" colspan=3 >Apparent Porosity,</td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;" rowspan=2>= A / (1000-C) </td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;"  rowspan=2>= (B-A)/A X 100</td>
										<td style="text-align:right; font-weight: bold; padding:5px;border-bottom: 2px solid;border-right:1px solid white;" rowspan=2>= </td>
										<td style="text-align:center; font-weight: bold; padding:5px;border-left:1px solid white;">B - A</td>
										<td style="border:1px solid; text-align:left; font-weight: bold; padding:5px;border-bottom: 2px solid;border-left:1px solid white;" rowspan=2>X 100</td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;border-bottom: 2px solid;">1000 - C</td>
									</tr>
									<?php if(($row_select_pipe['sp_wt_st_1'] != "" && $row_select_pipe['sp_wt_st_1'] != "0" && $row_select_pipe['sp_wt_st_1'] != null) || ($row_select_pipe['sp_w_s_1'] != "" && $row_select_pipe['sp_w_s_1'] != "0" && $row_select_pipe['sp_w_s_1'] != null) || ($row_select_pipe['sp_w_sur_1'] != "" && $row_select_pipe['sp_w_sur_1'] != "0" && $row_select_pipe['sp_w_sur_1'] != null) || ($row_select_pipe['sp_agg1'] != "" && $row_select_pipe['sp_agg1'] != "0" && $row_select_pipe['sp_agg1'] != null) || ($row_select_pipe['sp_wat1'] != "" && $row_select_pipe['sp_wat1'] != "0" && $row_select_pipe['sp_wat1'] != null) || ($row_select_pipe['sp_specific_gravity_1'] != "" && $row_select_pipe['sp_specific_gravity_1'] != "0" && $row_select_pipe['sp_specific_gravity_1'] != null) || ($row_select_pipe['sp_water_abr_1'] != "" && $row_select_pipe['sp_water_abr_1'] != "0" && $row_select_pipe['sp_water_abr_1'] != null) || ($row_select_pipe['sp_wt_st_2'] != "" && $row_select_pipe['sp_wt_st_2'] != "0" && $row_select_pipe['sp_wt_st_2'] != null) || ($row_select_pipe['sp_w_s_2'] != "" && $row_select_pipe['sp_w_s_2'] != "0" && $row_select_pipe['sp_w_s_2'] != null) || ($row_select_pipe['sp_w_sur_2'] != "" && $row_select_pipe['sp_w_sur_2'] != "0" && $row_select_pipe['sp_w_sur_2'] != null) || ($row_select_pipe['sp_agg2'] != "" && $row_select_pipe['sp_agg2'] != "0" && $row_select_pipe['sp_agg2'] != null) || ($row_select_pipe['sp_wat2'] != "" && $row_select_pipe['sp_wat2'] != "0" && $row_select_pipe['sp_wat2'] != null) || ($row_select_pipe['sp_specific_gravity_2'] != "" && $row_select_pipe['sp_specific_gravity_2'] != "0" && $row_select_pipe['sp_specific_gravity_2'] != null) || ($row_select_pipe['sp_water_abr_2'] != "" && $row_select_pipe['sp_water_abr_2'] != "0" && $row_select_pipe['sp_water_abr_2'] != null) || ($row_select_pipe['sp_wt_st_3'] != "" && $row_select_pipe['sp_wt_st_3'] != "0" && $row_select_pipe['sp_wt_st_3'] != null) || ($row_select_pipe['sp_w_s_3'] != "" && $row_select_pipe['sp_w_s_3'] != "0" && $row_select_pipe['sp_w_s_3'] != null) || ($row_select_pipe['sp_w_sur_3'] != "" && $row_select_pipe['sp_w_sur_3'] != "0" && $row_select_pipe['sp_w_sur_3'] != null) || ($row_select_pipe['sp_agg3'] != "" && $row_select_pipe['sp_agg3'] != "0" && $row_select_pipe['sp_agg3'] != null) || ($row_select_pipe['sp_wat3'] != "" && $row_select_pipe['sp_wat3'] != "0" && $row_select_pipe['sp_wat3'] != null) || ($row_select_pipe['sp_specific_gravity_3'] != "" && $row_select_pipe['sp_specific_gravity_3'] != "0" && $row_select_pipe['sp_specific_gravity_3'] != null) || ($row_select_pipe['sp_water_abr_3'] != "" && $row_select_pipe['sp_water_abr_3'] != "0" && $row_select_pipe['sp_water_abr_3'] != null) || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null) || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null) || ($row_select_pipe['sp_porosity_1'] != "" && $row_select_pipe['sp_porosity_1'] != "0" && $row_select_pipe['sp_porosity_1'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >1</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_1']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >2</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_2']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >3</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_3']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:right; font-weight: bold; padding:7px 3px;" colspan=5>Average =</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_water_abr']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_porosity_1']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:right; font-weight: bold; padding:10px 3px;" colspan=11></td>
									</tr>
									<?php } if(($row_select_pipe['sp_wt_st_4'] != "" && $row_select_pipe['sp_wt_st_4'] != "0" && $row_select_pipe['sp_wt_st_4'] != null) || ($row_select_pipe['sp_w_s_4'] != "" && $row_select_pipe['sp_w_s_4'] != "0" && $row_select_pipe['sp_w_s_4'] != null) || ($row_select_pipe['sp_w_sur_4'] != "" && $row_select_pipe['sp_w_sur_4'] != "0" && $row_select_pipe['sp_w_sur_4'] != null) || ($row_select_pipe['sp_agg4'] != "" && $row_select_pipe['sp_agg4'] != "0" && $row_select_pipe['sp_agg4'] != null) || ($row_select_pipe['sp_wat4'] != "" && $row_select_pipe['sp_wat4'] != "0" && $row_select_pipe['sp_wat4'] != null) || ($row_select_pipe['sp_specific_gravity_4'] != "" && $row_select_pipe['sp_specific_gravity_4'] != "0" && $row_select_pipe['sp_specific_gravity_4'] != null) || ($row_select_pipe['sp_water_abr_4'] != "" && $row_select_pipe['sp_water_abr_4'] != "0" && $row_select_pipe['sp_water_abr_4'] != null) || ($row_select_pipe['sp_wt_st_5'] != "" && $row_select_pipe['sp_wt_st_5'] != "0" && $row_select_pipe['sp_wt_st_5'] != null) || ($row_select_pipe['sp_w_s_5'] != "" && $row_select_pipe['sp_w_s_5'] != "0" && $row_select_pipe['sp_w_s_5'] != null) || ($row_select_pipe['sp_w_sur_5'] != "" && $row_select_pipe['sp_w_sur_5'] != "0" && $row_select_pipe['sp_w_sur_5'] != null) || ($row_select_pipe['sp_agg5'] != "" && $row_select_pipe['sp_agg5'] != "0" && $row_select_pipe['sp_agg5'] != null) || ($row_select_pipe['sp_wat5'] != "" && $row_select_pipe['sp_wat5'] != "0" && $row_select_pipe['sp_wat5'] != null) || ($row_select_pipe['sp_specific_gravity_5'] != "" && $row_select_pipe['sp_specific_gravity_5'] != "0" && $row_select_pipe['sp_specific_gravity_5'] != null) || ($row_select_pipe['sp_water_abr_5'] != "" && $row_select_pipe['sp_water_abr_5'] != "0" && $row_select_pipe['sp_water_abr_5'] != null) || ($row_select_pipe['sp_wt_st_6'] != "" && $row_select_pipe['sp_wt_st_6'] != "0" && $row_select_pipe['sp_wt_st_6'] != null) || ($row_select_pipe['sp_w_s_6'] != "" && $row_select_pipe['sp_w_s_6'] != "0" && $row_select_pipe['sp_w_s_6'] != null) || ($row_select_pipe['sp_w_sur_6'] != "" && $row_select_pipe['sp_w_sur_6'] != "0" && $row_select_pipe['sp_w_sur_6'] != null) || ($row_select_pipe['sp_agg6'] != "" && $row_select_pipe['sp_agg6'] != "0" && $row_select_pipe['sp_agg6'] != null) || ($row_select_pipe['sp_wat6'] != "" && $row_select_pipe['sp_wat6'] != "0" && $row_select_pipe['sp_wat6'] != null) || ($row_select_pipe['sp_specific_gravity_6'] != "" && $row_select_pipe['sp_specific_gravity_6'] != "0" && $row_select_pipe['sp_specific_gravity_6'] != null) || ($row_select_pipe['sp_water_abr_6'] != "" && $row_select_pipe['sp_water_abr_6'] != "0" && $row_select_pipe['sp_water_abr_6'] != null) || ($row_select_pipe['sp_sg_avg_2'] != "" && $row_select_pipe['sp_sg_avg_2'] != "0" && $row_select_pipe['sp_sg_avg_2'] != null) || ($row_select_pipe['sp_wa_avg_2'] != "" && $row_select_pipe['sp_wa_avg_2'] != "0" && $row_select_pipe['sp_wa_avg_2'] != null) || ($row_select_pipe['sp_porosity_2'] != "" && $row_select_pipe['sp_porosity_2'] != "0" && $row_select_pipe['sp_porosity_2'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >1</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_4']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >2</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_5']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >3</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3><?php echo $row_select_pipe['sp_water_abr_6']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:right; font-weight: bold; padding:7px 3px;" colspan=5>Average =</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_sg_avg_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wa_avg_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3><?php echo $row_select_pipe['sp_porosity_2']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:right; font-weight: bold; padding:10px 3px;" colspan=11></td>
									</tr>
									<?php } if(($row_select_pipe['sp_wt_st_7'] != "" && $row_select_pipe['sp_wt_st_7'] != "0" && $row_select_pipe['sp_wt_st_7'] != null) || ($row_select_pipe['sp_w_s_7'] != "" && $row_select_pipe['sp_w_s_7'] != "0" && $row_select_pipe['sp_w_s_7'] != null) || ($row_select_pipe['sp_w_sur_7'] != "" && $row_select_pipe['sp_w_sur_7'] != "0" && $row_select_pipe['sp_w_sur_7'] != null) || ($row_select_pipe['sp_agg7'] != "" && $row_select_pipe['sp_agg7'] != "0" && $row_select_pipe['sp_agg7'] != null) || ($row_select_pipe['sp_wat7'] != "" && $row_select_pipe['sp_wat7'] != "0" && $row_select_pipe['sp_wat7'] != null) || ($row_select_pipe['sp_specific_gravity_7'] != "" && $row_select_pipe['sp_specific_gravity_7'] != "0" && $row_select_pipe['sp_specific_gravity_7'] != null) || ($row_select_pipe['sp_water_abr_7'] != "" && $row_select_pipe['sp_water_abr_7'] != "0" && $row_select_pipe['sp_water_abr_7'] != null) || ($row_select_pipe['sp_wt_st_8'] != "" && $row_select_pipe['sp_wt_st_8'] != "0" && $row_select_pipe['sp_wt_st_8'] != null) || ($row_select_pipe['sp_w_s_8'] != "" && $row_select_pipe['sp_w_s_8'] != "0" && $row_select_pipe['sp_w_s_8'] != null) || ($row_select_pipe['sp_w_sur_8'] != "" && $row_select_pipe['sp_w_sur_8'] != "0" && $row_select_pipe['sp_w_sur_8'] != null) || ($row_select_pipe['sp_agg8'] != "" && $row_select_pipe['sp_agg8'] != "0" && $row_select_pipe['sp_agg8'] != null) || ($row_select_pipe['sp_wat8'] != "" && $row_select_pipe['sp_wat8'] != "0" && $row_select_pipe['sp_wat8'] != null) || ($row_select_pipe['sp_specific_gravity_8'] != "" && $row_select_pipe['sp_specific_gravity_8'] != "0" && $row_select_pipe['sp_specific_gravity_8'] != null) || ($row_select_pipe['sp_water_abr_8'] != "" && $row_select_pipe['sp_water_abr_8'] != "0" && $row_select_pipe['sp_water_abr_8'] != null) || ($row_select_pipe['sp_wt_st_9'] != "" && $row_select_pipe['sp_wt_st_9'] != "0" && $row_select_pipe['sp_wt_st_9'] != null) || ($row_select_pipe['sp_w_s_9'] != "" && $row_select_pipe['sp_w_s_9'] != "0" && $row_select_pipe['sp_w_s_9'] != null) || ($row_select_pipe['sp_w_sur_9'] != "" && $row_select_pipe['sp_w_sur_9'] != "0" && $row_select_pipe['sp_w_sur_9'] != null) || ($row_select_pipe['sp_agg9'] != "" && $row_select_pipe['sp_agg9'] != "0" && $row_select_pipe['sp_agg9'] != null) || ($row_select_pipe['sp_wat9'] != "" && $row_select_pipe['sp_wat9'] != "0" && $row_select_pipe['sp_wat9'] != null) || ($row_select_pipe['sp_specific_gravity_9'] != "" && $row_select_pipe['sp_specific_gravity_9'] != "0" && $row_select_pipe['sp_specific_gravity_9'] != null) || ($row_select_pipe['sp_water_abr_9'] != "" && $row_select_pipe['sp_water_abr_9'] != "0" && $row_select_pipe['sp_water_abr_9'] != null) || ($row_select_pipe['sp_sg_avg_3'] != "" && $row_select_pipe['sp_sg_avg_3'] != "0" && $row_select_pipe['sp_sg_avg_3'] != null) || ($row_select_pipe['sp_wa_avg_3'] != "" && $row_select_pipe['sp_wa_avg_3'] != "0" && $row_select_pipe['sp_wa_avg_3'] != null) || ($row_select_pipe['sp_porosity_3'] != "" && $row_select_pipe['sp_porosity_3'] != "0" && $row_select_pipe['sp_porosity_3'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >1</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_7']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >2</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3><?php echo $row_select_pipe['sp_water_abr_8']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >3</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wt_st_9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_s_9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_w_sur_9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_agg9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wat9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_specific_gravity_9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_water_abr_9']; ?></td>
									</tr>
									<tr>
										<td style="border:1px solid; text-align:right; font-weight: bold; padding:7px 3px;" colspan=5>Average =</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_sg_avg_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['sp_wa_avg_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" colspan=3 ><?php echo $row_select_pipe['sp_porosity_3']; ?></td>
									</tr>
									<tr>
										<td style="text-align:right; font-weight: bold; padding:10px 3px;" colspan=8></td>
									</tr>
									<?php } ?>
							</table>
					</td>
				</tr>
				
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; border-left:1px solid;border-right:1px solid; ">
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td colspan="1" style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid;border-top:1px solid;" colspan=2>Remarks :-  <?php echo $row_select_pipe['remark']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Checked By :-</td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Tested By :-</td>
							</tr>
							<tr>
								<td style="height: 40px;border: 1px solid;font-weight: bold;border-right: 1px solid; padding: 5px; border-bottom:0px; border-top:2px solid; "colspan="4"></td>
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

	<?php }if(($row_select_pipe['desc1'] != "" && $row_select_pipe['desc1'] != "0" && $row_select_pipe['desc1'] != null) || ($row_select_pipe['length2'] != "" && $row_select_pipe['length2'] != "0" && $row_select_pipe['length2'] != null) || ($row_select_pipe['corr3'] != "" && $row_select_pipe['corr3'] != "0" && $row_select_pipe['corr3'] != null) || ($row_select_pipe['ppl1'] != "" && $row_select_pipe['ppl1'] != "0" && $row_select_pipe['ppl1'] != null) || ($row_select_pipe['mod2'] != "" && $row_select_pipe['mod2'] != "0" && $row_select_pipe['mod2'] != null) || ($row_select_pipe['cor3'] != "" && $row_select_pipe['cor3'] != "0" && $row_select_pipe['cor3'] != null) || ($row_select_pipe['com_10'] != "" && $row_select_pipe['com_10'] != "0" && $row_select_pipe['com_10'] != null) || ($row_select_pipe['com_20'] != "" && $row_select_pipe['com_20'] != "0" && $row_select_pipe['com_20'] != null) || ($row_select_pipe['com_30'] != "" && $row_select_pipe['com_30'] != "0" && $row_select_pipe['com_30'] != null) || ($row_select_pipe['com_109'] != "" && $row_select_pipe['com_109'] != "0" && $row_select_pipe['com_109'] != null) || ($row_select_pipe['com_49'] != "" && $row_select_pipe['com_49'] != "0" && $row_select_pipe['com_49'] != null) || ($row_select_pipe['com_59'] != "" && $row_select_pipe['com_59'] != "0" && $row_select_pipe['com_59'] != null) || ($row_select_pipe['com_69'] != "" && $row_select_pipe['com_69'] != "0" && $row_select_pipe['com_69'] != null) || ($row_select_pipe['com_79'] != "" && $row_select_pipe['com_79'] != "0" && $row_select_pipe['com_79'] != null) || ($row_select_pipe['com_89'] != "" && $row_select_pipe['com_89'] != "0" && $row_select_pipe['com_89'] != null) || ($row_select_pipe['com_99'] != "" && $row_select_pipe['com_99'] != "0" && $row_select_pipe['com_99'] != null) || ($row_select_pipe['desc2'] != "" && $row_select_pipe['desc2'] != "0" && $row_select_pipe['desc2'] != null) || ($row_select_pipe['length3'] != "" && $row_select_pipe['length3'] != "0" && $row_select_pipe['length3'] != null) || ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) || ($row_select_pipe['ppl2'] != "" && $row_select_pipe['ppl2'] != "0" && $row_select_pipe['ppl2'] != null) || ($row_select_pipe['mod3'] != "" && $row_select_pipe['mod3'] != "0" && $row_select_pipe['mod3'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['com_11'] != "" && $row_select_pipe['com_11'] != "0" && $row_select_pipe['com_11'] != null) || ($row_select_pipe['com_21'] != "" && $row_select_pipe['com_21'] != "0" && $row_select_pipe['com_21'] != null) || ($row_select_pipe['com_31'] != "" && $row_select_pipe['com_31'] != "0" && $row_select_pipe['com_31'] != null) || ($row_select_pipe['com_40'] != "" && $row_select_pipe['com_40'] != "0" && $row_select_pipe['com_40'] != null) || ($row_select_pipe['com_50'] != "" && $row_select_pipe['com_50'] != "0" && $row_select_pipe['com_50'] != null) || ($row_select_pipe['com_60'] != "" && $row_select_pipe['com_60'] != "0" && $row_select_pipe['com_60'] != null) || ($row_select_pipe['com_70'] != "" && $row_select_pipe['com_70'] != "0" && $row_select_pipe['com_70'] != null) || ($row_select_pipe['com_80'] != "" && $row_select_pipe['com_80'] != "0" && $row_select_pipe['com_80'] != null) || ($row_select_pipe['com_90'] != "" && $row_select_pipe['com_90'] != "0" && $row_select_pipe['com_90'] != null) || ($row_select_pipe['com_100'] != "" && $row_select_pipe['com_100'] != "0" && $row_select_pipe['com_100'] != null) || ($row_select_pipe['con1'] != "" && $row_select_pipe['con1'] != "0" && $row_select_pipe['con1'] != null) || ($row_select_pipe['dia2'] != "" && $row_select_pipe['dia2'] != "0" && $row_select_pipe['dia2'] != null) || ($row_select_pipe['area3'] != "" && $row_select_pipe['area3'] != "0" && $row_select_pipe['area3'] != null) || ($row_select_pipe['str1'] != "" && $row_select_pipe['str1'] != "0" && $row_select_pipe['str1'] != null) || ($row_select_pipe['load2'] != "" && $row_select_pipe['load2'] != "0" && $row_select_pipe['load2'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['com_13'] != "" && $row_select_pipe['com_13'] != "0" && $row_select_pipe['com_13'] != null) || ($row_select_pipe['com_23'] != "" && $row_select_pipe['com_23'] != "0" && $row_select_pipe['com_23'] != null) || ($row_select_pipe['com_33'] != "" && $row_select_pipe['com_33'] != "0" && $row_select_pipe['com_33'] != null) || ($row_select_pipe['com_42'] != "" && $row_select_pipe['com_42'] != "0" && $row_select_pipe['com_42'] != null) || ($row_select_pipe['com_52'] != "" && $row_select_pipe['com_52'] != "0" && $row_select_pipe['com_52'] != null) || ($row_select_pipe['com_62'] != "" && $row_select_pipe['com_62'] != "0" && $row_select_pipe['com_62'] != null) || ($row_select_pipe['com_72'] != "" && $row_select_pipe['com_72'] != "0" && $row_select_pipe['com_72'] != null) || ($row_select_pipe['com_82'] != "" && $row_select_pipe['com_82'] != "0" && $row_select_pipe['com_82'] != null) || ($row_select_pipe['com_92'] != "" && $row_select_pipe['com_92'] != "0" && $row_select_pipe['com_92'] != null) || ($row_select_pipe['com_102'] != "" && $row_select_pipe['com_102'] != "0" && $row_select_pipe['com_102'] != null) || ($row_select_pipe['con2'] != "" && $row_select_pipe['con2'] != "0" && $row_select_pipe['con2'] != null) || ($row_select_pipe['dia3'] != "" && $row_select_pipe['dia3'] != "0" && $row_select_pipe['dia3'] != null) || ($row_select_pipe['fla1'] != "" && $row_select_pipe['fla1'] != "0" && $row_select_pipe['fla1'] != null) || ($row_select_pipe['str2'] != "" && $row_select_pipe['str2'] != "0" && $row_select_pipe['str2'] != null) || ($row_select_pipe['load3'] != "" && $row_select_pipe['load3'] != "0" && $row_select_pipe['load3'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['com_14'] != "" && $row_select_pipe['com_14'] != "0" && $row_select_pipe['com_14'] != null) || ($row_select_pipe['com_24'] != "" && $row_select_pipe['com_24'] != "0" && $row_select_pipe['com_24'] != null) || ($row_select_pipe['com_34'] != "" && $row_select_pipe['com_34'] != "0" && $row_select_pipe['com_34'] != null) || ($row_select_pipe['com_43'] != "" && $row_select_pipe['com_43'] != "0" && $row_select_pipe['com_43'] != null) || ($row_select_pipe['com_53'] != "" && $row_select_pipe['com_53'] != "0" && $row_select_pipe['com_53'] != null) || ($row_select_pipe['com_63'] != "" && $row_select_pipe['com_63'] != "0" && $row_select_pipe['com_63'] != null) || ($row_select_pipe['com_73'] != "" && $row_select_pipe['com_73'] != "0" && $row_select_pipe['com_73'] != null) || ($row_select_pipe['com_83'] != "" && $row_select_pipe['com_83'] != "0" && $row_select_pipe['com_83'] != null) || ($row_select_pipe['com_93'] != "" && $row_select_pipe['com_93'] != "0" && $row_select_pipe['com_93'] != null) || ($row_select_pipe['com_103'] != "" && $row_select_pipe['com_103'] != "0" && $row_select_pipe['com_103'] != null) || ($row_select_pipe['con3'] != "" && $row_select_pipe['con3'] != "0" && $row_select_pipe['con3'] != null) || ($row_select_pipe['ratio1'] != "" && $row_select_pipe['ratio1'] != "0" && $row_select_pipe['ratio1'] != null) || ($row_select_pipe['fla2'] != "" && $row_select_pipe['fla2'] != "0" && $row_select_pipe['fla2'] != null) || ($row_select_pipe['str3'] != "" && $row_select_pipe['str3'] != "0" && $row_select_pipe['str3'] != null) || ($row_select_pipe['ucs1'] != "" && $row_select_pipe['ucs1'] != "0" && $row_select_pipe['ucs1'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['com_15'] != "" && $row_select_pipe['com_15'] != "0" && $row_select_pipe['com_15'] != null) || ($row_select_pipe['com_25'] != "" && $row_select_pipe['com_25'] != "0" && $row_select_pipe['com_25'] != null) || ($row_select_pipe['com_35'] != "" && $row_select_pipe['com_35'] != "0" && $row_select_pipe['com_35'] != null) || ($row_select_pipe['com_44'] != "" && $row_select_pipe['com_44'] != "0" && $row_select_pipe['com_44'] != null) || ($row_select_pipe['com_54'] != "" && $row_select_pipe['com_54'] != "0" && $row_select_pipe['com_54'] != null) || ($row_select_pipe['com_64'] != "" && $row_select_pipe['com_64'] != "0" && $row_select_pipe['com_64'] != null) || ($row_select_pipe['com_74'] != "" && $row_select_pipe['com_74'] != "0" && $row_select_pipe['com_74'] != null) || ($row_select_pipe['com_84'] != "" && $row_select_pipe['com_84'] != "0" && $row_select_pipe['com_84'] != null) || ($row_select_pipe['com_94'] != "" && $row_select_pipe['com_94'] != "0" && $row_select_pipe['com_94'] != null) || ($row_select_pipe['com_104'] != "" && $row_select_pipe['com_104'] != "0" && $row_select_pipe['com_104'] != null) || ($row_select_pipe['depth1'] != "" && $row_select_pipe['depth1'] != "0" && $row_select_pipe['depth1'] != null) || ($row_select_pipe['ratio2'] != "" && $row_select_pipe['ratio2'] != "0" && $row_select_pipe['ratio2'] != null) || ($row_select_pipe['fla3'] != "" && $row_select_pipe['fla3'] != "0" && $row_select_pipe['fla3'] != null) || ($row_select_pipe['rate1'] != "" && $row_select_pipe['rate1'] != "0" && $row_select_pipe['rate1'] != null) || ($row_select_pipe['ucs2'] != "" && $row_select_pipe['ucs2'] != "0" && $row_select_pipe['ucs2'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['com_16'] != "" && $row_select_pipe['com_16'] != "0" && $row_select_pipe['com_16'] != null) || ($row_select_pipe['com_26'] != "" && $row_select_pipe['com_26'] != "0" && $row_select_pipe['com_26'] != null) || ($row_select_pipe['com_36'] != "" && $row_select_pipe['com_36'] != "0" && $row_select_pipe['com_36'] != null) || ($row_select_pipe['com_45'] != "" && $row_select_pipe['com_45'] != "0" && $row_select_pipe['com_45'] != null) || ($row_select_pipe['com_55'] != "" && $row_select_pipe['com_55'] != "0" && $row_select_pipe['com_55'] != null) || ($row_select_pipe['com_65'] != "" && $row_select_pipe['com_65'] != "0" && $row_select_pipe['com_65'] != null) || ($row_select_pipe['com_75'] != "" && $row_select_pipe['com_75'] != "0" && $row_select_pipe['com_75'] != null) || ($row_select_pipe['com_85'] != "" && $row_select_pipe['com_85'] != "0" && $row_select_pipe['com_85'] != null) || ($row_select_pipe['com_95'] != "" && $row_select_pipe['com_95'] != "0" && $row_select_pipe['com_95'] != null) || ($row_select_pipe['com_105'] != "" && $row_select_pipe['com_105'] != "0" && $row_select_pipe['com_105'] != null) || ($row_select_pipe['depth2'] != "" && $row_select_pipe['depth2'] != "0" && $row_select_pipe['depth2'] != null) || ($row_select_pipe['ratio3'] != "" && $row_select_pipe['ratio3'] != "0" && $row_select_pipe['ratio3'] != null) || ($row_select_pipe['par1'] != "" && $row_select_pipe['par1'] != "0" && $row_select_pipe['par1'] != null) || ($row_select_pipe['rate2'] != "" && $row_select_pipe['rate2'] != "0" && $row_select_pipe['rate2'] != null) || ($row_select_pipe['ucs3'] != "" && $row_select_pipe['ucs3'] != "0" && $row_select_pipe['ucs3'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['com_17'] != "" && $row_select_pipe['com_17'] != "0" && $row_select_pipe['com_17'] != null) || ($row_select_pipe['com_27'] != "" && $row_select_pipe['com_27'] != "0" && $row_select_pipe['com_27'] != null) || ($row_select_pipe['com_37'] != "" && $row_select_pipe['com_37'] != "0" && $row_select_pipe['com_37'] != null) || ($row_select_pipe['com_46'] != "" && $row_select_pipe['com_46'] != "0" && $row_select_pipe['com_46'] != null) || ($row_select_pipe['com_56'] != "" && $row_select_pipe['com_56'] != "0" && $row_select_pipe['com_56'] != null) || ($row_select_pipe['com_66'] != "" && $row_select_pipe['com_66'] != "0" && $row_select_pipe['com_66'] != null) || ($row_select_pipe['com_76'] != "" && $row_select_pipe['com_76'] != "0" && $row_select_pipe['com_76'] != null) || ($row_select_pipe['com_86'] != "" && $row_select_pipe['com_86'] != "0" && $row_select_pipe['com_86'] != null) || ($row_select_pipe['com_96'] != "" && $row_select_pipe['com_96'] != "0" && $row_select_pipe['com_96'] != null) || ($row_select_pipe['com_106'] != "" && $row_select_pipe['com_106'] != "0" && $row_select_pipe['com_106'] != null) || ($row_select_pipe['depth3'] != "" && $row_select_pipe['depth3'] != "0" && $row_select_pipe['depth3'] != null) || ($row_select_pipe['corr1'] != "" && $row_select_pipe['corr1'] != "0" && $row_select_pipe['corr1'] != null) || ($row_select_pipe['par2'] != "" && $row_select_pipe['par2'] != "0" && $row_select_pipe['par2'] != null) || ($row_select_pipe['rate3'] != "" && $row_select_pipe['rate3'] != "0" && $row_select_pipe['rate3'] != null) || ($row_select_pipe['cor1'] != "" && $row_select_pipe['cor1'] != "0" && $row_select_pipe['cor1'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['com_18'] != "" && $row_select_pipe['com_18'] != "0" && $row_select_pipe['com_18'] != null) || ($row_select_pipe['com_28'] != "" && $row_select_pipe['com_28'] != "0" && $row_select_pipe['com_28'] != null) || ($row_select_pipe['com_38'] != "" && $row_select_pipe['com_38'] != "0" && $row_select_pipe['com_38'] != null) || ($row_select_pipe['com_47'] != "" && $row_select_pipe['com_47'] != "0" && $row_select_pipe['com_47'] != null) || ($row_select_pipe['com_57'] != "" && $row_select_pipe['com_57'] != "0" && $row_select_pipe['com_57'] != null) || ($row_select_pipe['com_67'] != "" && $row_select_pipe['com_67'] != "0" && $row_select_pipe['com_67'] != null) || ($row_select_pipe['com_77'] != "" && $row_select_pipe['com_77'] != "0" && $row_select_pipe['com_77'] != null) || ($row_select_pipe['com_87'] != "" && $row_select_pipe['com_87'] != "0" && $row_select_pipe['com_87'] != null) || ($row_select_pipe['com_97'] != "" && $row_select_pipe['com_97'] != "0" && $row_select_pipe['com_97'] != null) || ($row_select_pipe['com_107'] != "" && $row_select_pipe['com_107'] != "0" && $row_select_pipe['com_107'] != null) || ($row_select_pipe['length1'] != "" && $row_select_pipe['length1'] != "0" && $row_select_pipe['length1'] != null) || ($row_select_pipe['corr2'] != "" && $row_select_pipe['corr2'] != "0" && $row_select_pipe['corr2'] != null) || ($row_select_pipe['par3'] != "" && $row_select_pipe['par3'] != "0" && $row_select_pipe['par3'] != null) || ($row_select_pipe['mod1'] != "" && $row_select_pipe['mod1'] != "0" && $row_select_pipe['mod1'] != null) || ($row_select_pipe['cor2'] != "" && $row_select_pipe['cor2'] != "0" && $row_select_pipe['cor2'] != null) || ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) || ($row_select_pipe['com_19'] != "" && $row_select_pipe['com_19'] != "0" && $row_select_pipe['com_19'] != null) || ($row_select_pipe['com_29'] != "" && $row_select_pipe['com_29'] != "0" && $row_select_pipe['com_29'] != null) || ($row_select_pipe['com_39'] != "" && $row_select_pipe['com_39'] != "0" && $row_select_pipe['com_39'] != null) || ($row_select_pipe['com_48'] != "" && $row_select_pipe['com_48'] != "0" && $row_select_pipe['com_48'] != null) || ($row_select_pipe['com_58'] != "" && $row_select_pipe['com_58'] != "0" && $row_select_pipe['com_58'] != null) || ($row_select_pipe['com_68'] != "" && $row_select_pipe['com_68'] != "0" && $row_select_pipe['com_68'] != null) || ($row_select_pipe['com_78'] != "" && $row_select_pipe['com_78'] != "0" && $row_select_pipe['com_78'] != null) || ($row_select_pipe['com_88'] != "" && $row_select_pipe['com_88'] != "0" && $row_select_pipe['com_88'] != null) || ($row_select_pipe['com_98'] != "" && $row_select_pipe['com_98'] != "0" && $row_select_pipe['com_98'] != null) || ($row_select_pipe['com_108'] != "" && $row_select_pipe['com_108'] != "0" && $row_select_pipe['com_108'] != null)) { ?>
	
	
			<div class="pagebreak"></div>
			
			
			<br><br><br><br>


			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
					<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 3</td>
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
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON ROCK</td>
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
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; padding-bottom:3px;padding-top:3px;">&nbsp;&nbsp; Sample sent by</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php if($sample_sent_by==1){echo 'Agency';} else if($sample_sent_by==0){echo 'Client';}?></td>
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
<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;border-top:2px solid black;">UNCONFINED COMPRESSIVE STRENGTH TEST</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				
				<!-- table design -->
				<tr>
					<td>
					<?php $cnt=1; ?>
								<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
									<tr>
										<td style="border:1px solid;border-top:0px;text-align:center; font-weight: bold; padding:5px;width:3%;" rowspan=4>Sr. No.</td>
										<td style="border:1px solid;border-top:0px;text-align:center; font-weight: bold; padding:5px;width:5%;" rowspan=4>Sample ID</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Sample Depth</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" colspan=7>Diameter of Specimen (D)</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Length of Specimen</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Cross Sectional Area </td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Weight</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Dry Density</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Length to Diameter Ratio</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Failure Load</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" rowspan=2>Unconfined Compressive Strength</td>
									</tr>
									<tr>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" colspan=2>Upper Diameter</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" colspan=2>Middle Diameter</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;" colspan=2>Lower Diameter</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">Average Diameter</td>
									</tr>
									<tr>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">d</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">X-Axis</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">Y-Axis</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">X-Axis</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">Y-Axis</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">X-Axis</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">Y-Axis</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">D</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">L</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">A</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">W</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">y<sub>d</sub></td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">R = <u style="text-underline-offset:6px;">&nbsp;&nbsp;&nbsp;L&nbsp;&nbsp;&nbsp;</u> <br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;D</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">P</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">&sigma; = <u style="text-underline-offset:6px;">&nbsp;&nbsp;&nbsp;P&nbsp;&nbsp;&nbsp;</u> <br><br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A</td>
									</tr>
									<tr>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">m</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">mm<sup>2</sup></td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">gm</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">Kg/m<sup>3</sup></td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">--</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">KN</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">N/mm<sup>2</sup></td>
									</tr>
									
									<?php if(($row_select_pipe['desc1'] != "" && $row_select_pipe['desc1'] != "0" && $row_select_pipe['desc1'] != null) || ($row_select_pipe['length2'] != "" && $row_select_pipe['length2'] != "0" && $row_select_pipe['length2'] != null) || ($row_select_pipe['corr3'] != "" && $row_select_pipe['corr3'] != "0" && $row_select_pipe['corr3'] != null) || ($row_select_pipe['ppl1'] != "" && $row_select_pipe['ppl1'] != "0" && $row_select_pipe['ppl1'] != null) || ($row_select_pipe['mod2'] != "" && $row_select_pipe['mod2'] != "0" && $row_select_pipe['mod2'] != null) || ($row_select_pipe['cor3'] != "" && $row_select_pipe['cor3'] != "0" && $row_select_pipe['cor3'] != null) || ($row_select_pipe['com_10'] != "" && $row_select_pipe['com_10'] != "0" && $row_select_pipe['com_10'] != null) || ($row_select_pipe['com_20'] != "" && $row_select_pipe['com_20'] != "0" && $row_select_pipe['com_20'] != null) || ($row_select_pipe['com_30'] != "" && $row_select_pipe['com_30'] != "0" && $row_select_pipe['com_30'] != null) || ($row_select_pipe['com_109'] != "" && $row_select_pipe['com_109'] != "0" && $row_select_pipe['com_109'] != null) || ($row_select_pipe['com_49'] != "" && $row_select_pipe['com_49'] != "0" && $row_select_pipe['com_49'] != null) || ($row_select_pipe['com_59'] != "" && $row_select_pipe['com_59'] != "0" && $row_select_pipe['com_59'] != null) || ($row_select_pipe['com_69'] != "" && $row_select_pipe['com_69'] != "0" && $row_select_pipe['com_69'] != null) || ($row_select_pipe['com_79'] != "" && $row_select_pipe['com_79'] != "0" && $row_select_pipe['com_79'] != null) || ($row_select_pipe['com_89'] != "" && $row_select_pipe['com_89'] != "0" && $row_select_pipe['com_89'] != null) || ($row_select_pipe['com_99'] != "" && $row_select_pipe['com_99'] != "0" && $row_select_pipe['com_99'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['desc1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['length2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['corr3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ppl1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['mod2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['cor3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_10']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_20']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_30']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_109']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_49']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_59']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_69']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_79']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_89']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_99']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['desc2'] != "" && $row_select_pipe['desc2'] != "0" && $row_select_pipe['desc2'] != null) || ($row_select_pipe['length3'] != "" && $row_select_pipe['length3'] != "0" && $row_select_pipe['length3'] != null) || ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) || ($row_select_pipe['ppl2'] != "" && $row_select_pipe['ppl2'] != "0" && $row_select_pipe['ppl2'] != null) || ($row_select_pipe['mod3'] != "" && $row_select_pipe['mod3'] != "0" && $row_select_pipe['mod3'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['com_11'] != "" && $row_select_pipe['com_11'] != "0" && $row_select_pipe['com_11'] != null) || ($row_select_pipe['com_21'] != "" && $row_select_pipe['com_21'] != "0" && $row_select_pipe['com_21'] != null) || ($row_select_pipe['com_31'] != "" && $row_select_pipe['com_31'] != "0" && $row_select_pipe['com_31'] != null) || ($row_select_pipe['com_40'] != "" && $row_select_pipe['com_40'] != "0" && $row_select_pipe['com_40'] != null) || ($row_select_pipe['com_50'] != "" && $row_select_pipe['com_50'] != "0" && $row_select_pipe['com_50'] != null) || ($row_select_pipe['com_60'] != "" && $row_select_pipe['com_60'] != "0" && $row_select_pipe['com_60'] != null) || ($row_select_pipe['com_70'] != "" && $row_select_pipe['com_70'] != "0" && $row_select_pipe['com_70'] != null) || ($row_select_pipe['com_80'] != "" && $row_select_pipe['com_80'] != "0" && $row_select_pipe['com_80'] != null) || ($row_select_pipe['com_90'] != "" && $row_select_pipe['com_90'] != "0" && $row_select_pipe['com_90'] != null) || ($row_select_pipe['com_100'] != "" && $row_select_pipe['com_100'] != "0" && $row_select_pipe['com_100'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['desc2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['length3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['area1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ppl2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['mod3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_11']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_21']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_31']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_40']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_50']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_60']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_70']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_80']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_90']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_100']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['desc1'] != "" && $row_select_pipe['desc1'] != "0" && $row_select_pipe['desc1'] != null) || ($row_select_pipe['length2'] != "" && $row_select_pipe['length2'] != "0" && $row_select_pipe['length2'] != null) || ($row_select_pipe['corr3'] != "" && $row_select_pipe['corr3'] != "0" && $row_select_pipe['corr3'] != null) || ($row_select_pipe['ppl1'] != "" && $row_select_pipe['ppl1'] != "0" && $row_select_pipe['ppl1'] != null) || ($row_select_pipe['mod2'] != "" && $row_select_pipe['mod2'] != "0" && $row_select_pipe['mod2'] != null) || ($row_select_pipe['cor3'] != "" && $row_select_pipe['cor3'] != "0" && $row_select_pipe['cor3'] != null) || ($row_select_pipe['com_10'] != "" && $row_select_pipe['com_10'] != "0" && $row_select_pipe['com_10'] != null) || ($row_select_pipe['com_20'] != "" && $row_select_pipe['com_20'] != "0" && $row_select_pipe['com_20'] != null) || ($row_select_pipe['com_30'] != "" && $row_select_pipe['com_30'] != "0" && $row_select_pipe['com_30'] != null) || ($row_select_pipe['com_109'] != "" && $row_select_pipe['com_109'] != "0" && $row_select_pipe['com_109'] != null) || ($row_select_pipe['com_49'] != "" && $row_select_pipe['com_49'] != "0" && $row_select_pipe['com_49'] != null) || ($row_select_pipe['com_59'] != "" && $row_select_pipe['com_59'] != "0" && $row_select_pipe['com_59'] != null) || ($row_select_pipe['com_69'] != "" && $row_select_pipe['com_69'] != "0" && $row_select_pipe['com_69'] != null) || ($row_select_pipe['com_79'] != "" && $row_select_pipe['com_79'] != "0" && $row_select_pipe['com_79'] != null) || ($row_select_pipe['com_89'] != "" && $row_select_pipe['com_89'] != "0" && $row_select_pipe['com_89'] != null) || ($row_select_pipe['com_99'] != "" && $row_select_pipe['com_99'] != "0" && $row_select_pipe['com_99'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['desc3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['dia1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['area2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ppl3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['load1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_12']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_22']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_32']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_41']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_51']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_61']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_71']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_81']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_91']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_101']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['con1'] != "" && $row_select_pipe['con1'] != "0" && $row_select_pipe['con1'] != null) || ($row_select_pipe['dia2'] != "" && $row_select_pipe['dia2'] != "0" && $row_select_pipe['dia2'] != null) || ($row_select_pipe['area3'] != "" && $row_select_pipe['area3'] != "0" && $row_select_pipe['area3'] != null) || ($row_select_pipe['str1'] != "" && $row_select_pipe['str1'] != "0" && $row_select_pipe['str1'] != null) || ($row_select_pipe['load2'] != "" && $row_select_pipe['load2'] != "0" && $row_select_pipe['load2'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['com_13'] != "" && $row_select_pipe['com_13'] != "0" && $row_select_pipe['com_13'] != null) || ($row_select_pipe['com_23'] != "" && $row_select_pipe['com_23'] != "0" && $row_select_pipe['com_23'] != null) || ($row_select_pipe['com_33'] != "" && $row_select_pipe['com_33'] != "0" && $row_select_pipe['com_33'] != null) || ($row_select_pipe['com_42'] != "" && $row_select_pipe['com_42'] != "0" && $row_select_pipe['com_42'] != null) || ($row_select_pipe['com_52'] != "" && $row_select_pipe['com_52'] != "0" && $row_select_pipe['com_52'] != null) || ($row_select_pipe['com_62'] != "" && $row_select_pipe['com_62'] != "0" && $row_select_pipe['com_62'] != null) || ($row_select_pipe['com_72'] != "" && $row_select_pipe['com_72'] != "0" && $row_select_pipe['com_72'] != null) || ($row_select_pipe['com_82'] != "" && $row_select_pipe['com_82'] != "0" && $row_select_pipe['com_82'] != null) || ($row_select_pipe['com_92'] != "" && $row_select_pipe['com_92'] != "0" && $row_select_pipe['com_92'] != null) || ($row_select_pipe['com_102'] != "" && $row_select_pipe['com_102'] != "0" && $row_select_pipe['com_102'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['con1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['dia2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['area3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['str1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['load2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_13']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_23']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_33']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_42']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_52']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_62']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_72']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_82']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_92']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_102']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['con2'] != "" && $row_select_pipe['con2'] != "0" && $row_select_pipe['con2'] != null) || ($row_select_pipe['dia3'] != "" && $row_select_pipe['dia3'] != "0" && $row_select_pipe['dia3'] != null) || ($row_select_pipe['fla1'] != "" && $row_select_pipe['fla1'] != "0" && $row_select_pipe['fla1'] != null) || ($row_select_pipe['str2'] != "" && $row_select_pipe['str2'] != "0" && $row_select_pipe['str2'] != null) || ($row_select_pipe['load3'] != "" && $row_select_pipe['load3'] != "0" && $row_select_pipe['load3'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['com_14'] != "" && $row_select_pipe['com_14'] != "0" && $row_select_pipe['com_14'] != null) || ($row_select_pipe['com_24'] != "" && $row_select_pipe['com_24'] != "0" && $row_select_pipe['com_24'] != null) || ($row_select_pipe['com_34'] != "" && $row_select_pipe['com_34'] != "0" && $row_select_pipe['com_34'] != null) || ($row_select_pipe['com_43'] != "" && $row_select_pipe['com_43'] != "0" && $row_select_pipe['com_43'] != null) || ($row_select_pipe['com_53'] != "" && $row_select_pipe['com_53'] != "0" && $row_select_pipe['com_53'] != null) || ($row_select_pipe['com_63'] != "" && $row_select_pipe['com_63'] != "0" && $row_select_pipe['com_63'] != null) || ($row_select_pipe['com_73'] != "" && $row_select_pipe['com_73'] != "0" && $row_select_pipe['com_73'] != null) || ($row_select_pipe['com_83'] != "" && $row_select_pipe['com_83'] != "0" && $row_select_pipe['com_83'] != null) || ($row_select_pipe['com_93'] != "" && $row_select_pipe['com_93'] != "0" && $row_select_pipe['com_93'] != null) || ($row_select_pipe['com_103'] != "" && $row_select_pipe['com_103'] != "0" && $row_select_pipe['com_103'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['con2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['dia3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['fla1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['str2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['load3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_4']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_14']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_24']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_34']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_43']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_53']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_63']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_73']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_83']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_93']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_103']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['con3'] != "" && $row_select_pipe['con3'] != "0" && $row_select_pipe['con3'] != null) || ($row_select_pipe['ratio1'] != "" && $row_select_pipe['ratio1'] != "0" && $row_select_pipe['ratio1'] != null) || ($row_select_pipe['fla2'] != "" && $row_select_pipe['fla2'] != "0" && $row_select_pipe['fla2'] != null) || ($row_select_pipe['str3'] != "" && $row_select_pipe['str3'] != "0" && $row_select_pipe['str3'] != null) || ($row_select_pipe['ucs1'] != "" && $row_select_pipe['ucs1'] != "0" && $row_select_pipe['ucs1'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['com_15'] != "" && $row_select_pipe['com_15'] != "0" && $row_select_pipe['com_15'] != null) || ($row_select_pipe['com_25'] != "" && $row_select_pipe['com_25'] != "0" && $row_select_pipe['com_25'] != null) || ($row_select_pipe['com_35'] != "" && $row_select_pipe['com_35'] != "0" && $row_select_pipe['com_35'] != null) || ($row_select_pipe['com_44'] != "" && $row_select_pipe['com_44'] != "0" && $row_select_pipe['com_44'] != null) || ($row_select_pipe['com_54'] != "" && $row_select_pipe['com_54'] != "0" && $row_select_pipe['com_54'] != null) || ($row_select_pipe['com_64'] != "" && $row_select_pipe['com_64'] != "0" && $row_select_pipe['com_64'] != null) || ($row_select_pipe['com_74'] != "" && $row_select_pipe['com_74'] != "0" && $row_select_pipe['com_74'] != null) || ($row_select_pipe['com_84'] != "" && $row_select_pipe['com_84'] != "0" && $row_select_pipe['com_84'] != null) || ($row_select_pipe['com_94'] != "" && $row_select_pipe['com_94'] != "0" && $row_select_pipe['com_94'] != null) || ($row_select_pipe['com_104'] != "" && $row_select_pipe['com_104'] != "0" && $row_select_pipe['com_104'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['con3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ratio1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['fla2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['str3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ucs1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_5']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_15']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_25']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_35']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_44']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_54']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_64']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_74']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_84']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_94']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_104']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['depth1'] != "" && $row_select_pipe['depth1'] != "0" && $row_select_pipe['depth1'] != null) || ($row_select_pipe['ratio2'] != "" && $row_select_pipe['ratio2'] != "0" && $row_select_pipe['ratio2'] != null) || ($row_select_pipe['fla3'] != "" && $row_select_pipe['fla3'] != "0" && $row_select_pipe['fla3'] != null) || ($row_select_pipe['rate1'] != "" && $row_select_pipe['rate1'] != "0" && $row_select_pipe['rate1'] != null) || ($row_select_pipe['ucs2'] != "" && $row_select_pipe['ucs2'] != "0" && $row_select_pipe['ucs2'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['com_16'] != "" && $row_select_pipe['com_16'] != "0" && $row_select_pipe['com_16'] != null) || ($row_select_pipe['com_26'] != "" && $row_select_pipe['com_26'] != "0" && $row_select_pipe['com_26'] != null) || ($row_select_pipe['com_36'] != "" && $row_select_pipe['com_36'] != "0" && $row_select_pipe['com_36'] != null) || ($row_select_pipe['com_45'] != "" && $row_select_pipe['com_45'] != "0" && $row_select_pipe['com_45'] != null) || ($row_select_pipe['com_55'] != "" && $row_select_pipe['com_55'] != "0" && $row_select_pipe['com_55'] != null) || ($row_select_pipe['com_65'] != "" && $row_select_pipe['com_65'] != "0" && $row_select_pipe['com_65'] != null) || ($row_select_pipe['com_75'] != "" && $row_select_pipe['com_75'] != "0" && $row_select_pipe['com_75'] != null) || ($row_select_pipe['com_85'] != "" && $row_select_pipe['com_85'] != "0" && $row_select_pipe['com_85'] != null) || ($row_select_pipe['com_95'] != "" && $row_select_pipe['com_95'] != "0" && $row_select_pipe['com_95'] != null) || ($row_select_pipe['com_105'] != "" && $row_select_pipe['com_105'] != "0" && $row_select_pipe['com_105'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['depth1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ratio2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['fla3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['rate1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ucs2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_6']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_16']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_26']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_36']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_45']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_55']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_65']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_75']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_85']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_95']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_105']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['depth2'] != "" && $row_select_pipe['depth2'] != "0" && $row_select_pipe['depth2'] != null) || ($row_select_pipe['ratio3'] != "" && $row_select_pipe['ratio3'] != "0" && $row_select_pipe['ratio3'] != null) || ($row_select_pipe['par1'] != "" && $row_select_pipe['par1'] != "0" && $row_select_pipe['par1'] != null) || ($row_select_pipe['rate2'] != "" && $row_select_pipe['rate2'] != "0" && $row_select_pipe['rate2'] != null) || ($row_select_pipe['ucs3'] != "" && $row_select_pipe['ucs3'] != "0" && $row_select_pipe['ucs3'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['com_17'] != "" && $row_select_pipe['com_17'] != "0" && $row_select_pipe['com_17'] != null) || ($row_select_pipe['com_27'] != "" && $row_select_pipe['com_27'] != "0" && $row_select_pipe['com_27'] != null) || ($row_select_pipe['com_37'] != "" && $row_select_pipe['com_37'] != "0" && $row_select_pipe['com_37'] != null) || ($row_select_pipe['com_46'] != "" && $row_select_pipe['com_46'] != "0" && $row_select_pipe['com_46'] != null) || ($row_select_pipe['com_56'] != "" && $row_select_pipe['com_56'] != "0" && $row_select_pipe['com_56'] != null) || ($row_select_pipe['com_66'] != "" && $row_select_pipe['com_66'] != "0" && $row_select_pipe['com_66'] != null) || ($row_select_pipe['com_76'] != "" && $row_select_pipe['com_76'] != "0" && $row_select_pipe['com_76'] != null) || ($row_select_pipe['com_86'] != "" && $row_select_pipe['com_86'] != "0" && $row_select_pipe['com_86'] != null) || ($row_select_pipe['com_96'] != "" && $row_select_pipe['com_96'] != "0" && $row_select_pipe['com_96'] != null) || ($row_select_pipe['com_106'] != "" && $row_select_pipe['com_106'] != "0" && $row_select_pipe['com_106'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['depth2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ratio3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['par1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['rate2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['ucs3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_7']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_17']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_27']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_37']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_46']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_56']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_66']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_76']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_86']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_96']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_106']; ?></td>
									</tr>
									
									<?php } if(($row_select_pipe['depth3'] != "" && $row_select_pipe['depth3'] != "0" && $row_select_pipe['depth3'] != null) || ($row_select_pipe['corr1'] != "" && $row_select_pipe['corr1'] != "0" && $row_select_pipe['corr1'] != null) || ($row_select_pipe['par2'] != "" && $row_select_pipe['par2'] != "0" && $row_select_pipe['par2'] != null) || ($row_select_pipe['rate3'] != "" && $row_select_pipe['rate3'] != "0" && $row_select_pipe['rate3'] != null) || ($row_select_pipe['cor1'] != "" && $row_select_pipe['cor1'] != "0" && $row_select_pipe['cor1'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['com_18'] != "" && $row_select_pipe['com_18'] != "0" && $row_select_pipe['com_18'] != null) || ($row_select_pipe['com_28'] != "" && $row_select_pipe['com_28'] != "0" && $row_select_pipe['com_28'] != null) || ($row_select_pipe['com_38'] != "" && $row_select_pipe['com_38'] != "0" && $row_select_pipe['com_38'] != null) || ($row_select_pipe['com_47'] != "" && $row_select_pipe['com_47'] != "0" && $row_select_pipe['com_47'] != null) || ($row_select_pipe['com_57'] != "" && $row_select_pipe['com_57'] != "0" && $row_select_pipe['com_57'] != null) || ($row_select_pipe['com_67'] != "" && $row_select_pipe['com_67'] != "0" && $row_select_pipe['com_67'] != null) || ($row_select_pipe['com_77'] != "" && $row_select_pipe['com_77'] != "0" && $row_select_pipe['com_77'] != null) || ($row_select_pipe['com_87'] != "" && $row_select_pipe['com_87'] != "0" && $row_select_pipe['com_87'] != null) || ($row_select_pipe['com_97'] != "" && $row_select_pipe['com_97'] != "0" && $row_select_pipe['com_97'] != null) || ($row_select_pipe['com_107'] != "" && $row_select_pipe['com_107'] != "0" && $row_select_pipe['com_107'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['depth3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['corr1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['par2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['rate3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['cor1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_8']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_18']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_28']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_38']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_47']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_57']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_67']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_77']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_87']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_97']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_107']; ?></td>
									</tr>
									
									
									<?php } if(($row_select_pipe['length1'] != "" && $row_select_pipe['length1'] != "0" && $row_select_pipe['length1'] != null) || ($row_select_pipe['corr2'] != "" && $row_select_pipe['corr2'] != "0" && $row_select_pipe['corr2'] != null) || ($row_select_pipe['par3'] != "" && $row_select_pipe['par3'] != "0" && $row_select_pipe['par3'] != null) || ($row_select_pipe['mod1'] != "" && $row_select_pipe['mod1'] != "0" && $row_select_pipe['mod1'] != null) || ($row_select_pipe['cor2'] != "" && $row_select_pipe['cor2'] != "0" && $row_select_pipe['cor2'] != null) || ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) || ($row_select_pipe['com_19'] != "" && $row_select_pipe['com_19'] != "0" && $row_select_pipe['com_19'] != null) || ($row_select_pipe['com_29'] != "" && $row_select_pipe['com_29'] != "0" && $row_select_pipe['com_29'] != null) || ($row_select_pipe['com_39'] != "" && $row_select_pipe['com_39'] != "0" && $row_select_pipe['com_39'] != null) || ($row_select_pipe['com_48'] != "" && $row_select_pipe['com_48'] != "0" && $row_select_pipe['com_48'] != null) || ($row_select_pipe['com_58'] != "" && $row_select_pipe['com_58'] != "0" && $row_select_pipe['com_58'] != null) || ($row_select_pipe['com_68'] != "" && $row_select_pipe['com_68'] != "0" && $row_select_pipe['com_68'] != null) || ($row_select_pipe['com_78'] != "" && $row_select_pipe['com_78'] != "0" && $row_select_pipe['com_78'] != null) || ($row_select_pipe['com_88'] != "" && $row_select_pipe['com_88'] != "0" && $row_select_pipe['com_88'] != null) || ($row_select_pipe['com_98'] != "" && $row_select_pipe['com_98'] != "0" && $row_select_pipe['com_98'] != null) || ($row_select_pipe['com_108'] != "" && $row_select_pipe['com_108'] != "0" && $row_select_pipe['com_108'] != null)) { ?>
									
									<tr>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['length1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['corr2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['par3']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['mod1']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['cor2']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_9']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_19']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_29']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_39']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_48']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_58']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_68']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_78']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_88']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_98']; ?></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" ><?php echo $row_select_pipe['com_108']; ?></td>
									</tr>
									<?php } ?>
								</table>
					</td>
				</tr>
				
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; border-left:1px solid;border-right:1px solid; ">
							<tr>
								<td style="height: 30px;border: 1px solid;font-weight: bold;border-right: 1px solid; padding: 5px; border-bottom:0px; "colspan="4"></td>
							</tr>
							<tr>
								<td colspan="1" style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; border-right:1px solid;border-top:2px solid;" >Remarks :-</td>
								<td colspan="3" style="border-top:2px solid; border-bottom:1px solid;padding: 5px;"><?php echo $row_select_pipe['remark']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Checked By :-</td>
								<td  style="border-top:1px solid; border-bottom:1px solid;padding: 5px;"></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Tested By :-</td>
								<td  style="border-top:1px solid; border-bottom:1px solid;padding: 5px;"></td>	
							</tr>
							<tr>
								<td style="height: 40px;border: 1px solid;font-weight: bold;border-right: 1px solid; padding: 5px; border-bottom:0px; border-top:2px solid; "colspan="4"></td>
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

    <?php } if (($row_select_pipe['wtr_temp_1'] != "" && $row_select_pipe['wtr_temp_1'] != "0" && $row_select_pipe['wtr_temp_1'] != null) || ($row_select_pipe['wtr_temp_2'] != "" && $row_select_pipe['wtr_temp_2'] != "0" && $row_select_pipe['wtr_temp_2'] != null) || ($row_select_pipe['wtr_temp_3'] != "" && $row_select_pipe['wtr_temp_3'] != "0" && $row_select_pipe['wtr_temp_3'] != null) || ($row_select_pipe['rt_m_1'] != "" && $row_select_pipe['rt_m_1'] != "0" && $row_select_pipe['rt_m_1'] != null) || ($row_select_pipe['rt_m_2'] != "" && $row_select_pipe['rt_m_2'] != "0" && $row_select_pipe['rt_m_2'] != null) || ($row_select_pipe['rt_m_3'] != "" && $row_select_pipe['rt_m_3'] != "0" && $row_select_pipe['rt_m_3'] != null) || ($row_select_pipe['ss_m1_1'] != "" && $row_select_pipe['ss_m1_1'] != "0" && $row_select_pipe['ss_m1_1'] != null) || ($row_select_pipe['ss_m1_2'] != "" && $row_select_pipe['ss_m1_2'] != "0" && $row_select_pipe['ss_m1_2'] != null) || ($row_select_pipe['ss_m1_3'] != "" && $row_select_pipe['ss_m1_3'] != "0" && $row_select_pipe['ss_m1_3'] != null) || ($row_select_pipe['ss_m2_1'] != "" && $row_select_pipe['ss_m2_1'] != "0" && $row_select_pipe['ss_m2_1'] != null) || ($row_select_pipe['ss_m2_2'] != "" && $row_select_pipe['ss_m2_2'] != "0" && $row_select_pipe['ss_m2_2'] != null) || ($row_select_pipe['ss_m2_3'] != "" && $row_select_pipe['ss_m2_3'] != "0" && $row_select_pipe['ss_m2_3'] != null) || ($row_select_pipe['ss_m3_1'] != "" && $row_select_pipe['ss_m3_1'] != "0" && $row_select_pipe['ss_m3_1'] != null) || ($row_select_pipe['ss_m3_2'] != "" && $row_select_pipe['ss_m3_2'] != "0" && $row_select_pipe['ss_m3_2'] != null) || ($row_select_pipe['ss_m3_3'] != "" && $row_select_pipe['ss_m3_3'] != "0" && $row_select_pipe['ss_m3_3'] != null) || ($row_select_pipe['ss_m4_1'] != "" && $row_select_pipe['ss_m4_1'] != "0" && $row_select_pipe['ss_m4_1'] != null) || ($row_select_pipe['ss_m4_2'] != "" && $row_select_pipe['ss_m4_2'] != "0" && $row_select_pipe['ss_m4_2'] != null) || ($row_select_pipe['ss_m4_3'] != "" && $row_select_pipe['ss_m4_3'] != "0" && $row_select_pipe['ss_m4_3'] != null) || ($row_select_pipe['ss_m5_1'] != "" && $row_select_pipe['ss_m5_1'] != "0" && $row_select_pipe['ss_m5_1'] != null) || ($row_select_pipe['ss_m5_2'] != "" && $row_select_pipe['ss_m5_2'] != "0" && $row_select_pipe['ss_m5_2'] != null) || ($row_select_pipe['ss_m5_3'] != "" && $row_select_pipe['ss_m5_3'] != "0" && $row_select_pipe['ss_m5_3'] != null) || ($row_select_pipe['ssm_sub_1'] != "" && $row_select_pipe['ssm_sub_1'] != "0" && $row_select_pipe['ssm_sub_1'] != null) || ($row_select_pipe['ssm_sub_2'] != "" && $row_select_pipe['ssm_sub_2'] != "0" && $row_select_pipe['ssm_sub_2'] != null) || ($row_select_pipe['ssm_sub_3'] != "" && $row_select_pipe['ssm_sub_3'] != "0" && $row_select_pipe['ssm_sub_3'] != null) || ($row_select_pipe['ssm_sat_1'] != "" && $row_select_pipe['ssm_sat_1'] != "0" && $row_select_pipe['ssm_sat_1'] != null) || ($row_select_pipe['ssm_sat_2'] != "" && $row_select_pipe['ssm_sat_2'] != "0" && $row_select_pipe['ssm_sat_2'] != null) || ($row_select_pipe['ssm_sat_3'] != "" && $row_select_pipe['ssm_sat_3'] != "0" && $row_select_pipe['ssm_sat_3'] != null) || ($row_select_pipe['dm_ms_1'] != "" && $row_select_pipe['dm_ms_1'] != "0" && $row_select_pipe['dm_ms_1'] != null) || ($row_select_pipe['dm_ms_2'] != "" && $row_select_pipe['dm_ms_2'] != "0" && $row_select_pipe['dm_ms_2'] != null) || ($row_select_pipe['dm_ms_3'] != "" && $row_select_pipe['dm_ms_3'] != "0" && $row_select_pipe['dm_ms_3'] != null) || ($row_select_pipe['bvol_1'] != "" && $row_select_pipe['bvol_1'] != "0" && $row_select_pipe['bvol_1'] != null) || ($row_select_pipe['bvol_2'] != "" && $row_select_pipe['bvol_2'] != "0" && $row_select_pipe['bvol_2'] != null) || ($row_select_pipe['bvol_3'] != "" && $row_select_pipe['bvol_3'] != "0" && $row_select_pipe['bvol_3'] != null) || ($row_select_pipe['pv_1'] != "" && $row_select_pipe['pv_1'] != "0" && $row_select_pipe['pv_1'] != null) || ($row_select_pipe['pv_2'] != "" && $row_select_pipe['pv_2'] != "0" && $row_select_pipe['pv_2'] != null) || ($row_select_pipe['pv_3'] != "" && $row_select_pipe['pv_3'] != "0" && $row_select_pipe['pv_3'] != null) || ($row_select_pipe['por_1'] != "" && $row_select_pipe['por_1'] != "0" && $row_select_pipe['por_1'] != null) || ($row_select_pipe['por_2'] != "" && $row_select_pipe['por_2'] != "0" && $row_select_pipe['por_2'] != null) || ($row_select_pipe['por_3'] != "" && $row_select_pipe['por_3'] != "0" && $row_select_pipe['por_3'] != null) || ($row_select_pipe['pd_1'] != "" && $row_select_pipe['pd_1'] != "0" && $row_select_pipe['pd_1'] != null) || ($row_select_pipe['pd_2'] != "" && $row_select_pipe['pd_2'] != "0" && $row_select_pipe['pd_2'] != null) || ($row_select_pipe['pd_3'] != "" && $row_select_pipe['pd_3'] != "0" && $row_select_pipe['pd_3'] != null) || ($row_select_pipe['wc_1'] != "" && $row_select_pipe['wc_1'] != "0" && $row_select_pipe['wc_1'] != null) || ($row_select_pipe['wc_2'] != "" && $row_select_pipe['wc_2'] != "0" && $row_select_pipe['wc_2'] != null) || ($row_select_pipe['wc_3'] != "" && $row_select_pipe['wc_3'] != "0" && $row_select_pipe['wc_3'] != null)) { ?>
			<div class="pagebreak"></div>
			<br><br><br><br>


			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse; ">
				<!-- header design -->
<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 3</td>
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
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON ROCK</td>
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
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left; padding-bottom:3px;padding-top:3px;">&nbsp;&nbsp; Sample sent by</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php if($sample_sent_by==1){echo 'Agency';} else if($sample_sent_by==0){echo 'Client';}?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>				
<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;border-top:2px solid black;">DENSITY, POROSITY & WATER CONTENT TEST</td>
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
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 8%;">Test Method :-</td>
								<td style="padding: 5px;" colspan="3">As Per IS : 13030 : 1991 Reaffirmed : 2021, clause No. 6 & 4</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="padding: 10px;border: 1px solid;border-bottom:1px solid;" colspan="6"></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- table design -->
				<tr>
					<td>
						<?php $cnt=1; ?>
								<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
									<tr>
										<td style="border:1px solid;text-align:center; font-weight: bold; padding:5px;width:7%;" rowspan=2>Sr. No.</td>
										<td style="border:1px solid;text-align:center; font-weight: bold; padding:5px;width:40%;" rowspan=2>Description</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;width:10%;" rowspan=2>Unit</td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:5px;width:40%;" colspan=7>Results</td>
									</tr>
									<tr>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">i</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">ii</td>
										<td style="border:1px solid;border-top:0px; text-align:center; font-weight: bold; padding:5px;">iii</td>
									</tr>
									<?php if (($row_select_pipe['wtr_temp_1'] != "" && $row_select_pipe['wtr_temp_1'] != "0" && $row_select_pipe['wtr_temp_1'] != null) || ($row_select_pipe['wtr_temp_2'] != "" && $row_select_pipe['wtr_temp_2'] != "0" && $row_select_pipe['wtr_temp_2'] != null) || ($row_select_pipe['wtr_temp_3'] != "" && $row_select_pipe['wtr_temp_3'] != "0" && $row_select_pipe['wtr_temp_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left;padding:7px 3px;" >Water Temperature</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><b>°C</b></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['wtr_temp_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['wtr_temp_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['wtr_temp_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['rt_m_1'] != "" && $row_select_pipe['rt_m_1'] != "0" && $row_select_pipe['rt_m_1'] != null) || ($row_select_pipe['rt_m_2'] != "" && $row_select_pipe['rt_m_2'] != "0" && $row_select_pipe['rt_m_2'] != null) || ($row_select_pipe['rt_m_3'] != "" && $row_select_pipe['rt_m_3'] != "0" && $row_select_pipe['rt_m_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Mass of Sample at Room Temperature with Container - <b>M</b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['rt_m_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['rt_m_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['rt_m_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ss_m1_1'] != "" && $row_select_pipe['ss_m1_1'] != "0" && $row_select_pipe['ss_m1_1'] != null) || ($row_select_pipe['ss_m1_2'] != "" && $row_select_pipe['ss_m1_2'] != "0" && $row_select_pipe['ss_m1_2'] != null) || ($row_select_pipe['ss_m1_3'] != "" && $row_select_pipe['ss_m1_3'] != "0" && $row_select_pipe['ss_m1_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Saturated Submerged Mass of Basket alone - <b>M₁</b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m1_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m1_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m1_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ss_m2_1'] != "" && $row_select_pipe['ss_m2_1'] != "0" && $row_select_pipe['ss_m2_1'] != null) || ($row_select_pipe['ss_m2_2'] != "" && $row_select_pipe['ss_m2_2'] != "0" && $row_select_pipe['ss_m2_2'] != null) || ($row_select_pipe['ss_m2_3'] != "" && $row_select_pipe['ss_m2_3'] != "0" && $row_select_pipe['ss_m2_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Saturated Submerged Mass of Basket and Sample - <b>M₂</b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m2_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m2_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m2_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ss_m3_1'] != "" && $row_select_pipe['ss_m3_1'] != "0" && $row_select_pipe['ss_m3_1'] != null) || ($row_select_pipe['ss_m3_2'] != "" && $row_select_pipe['ss_m3_2'] != "0" && $row_select_pipe['ss_m3_2'] != null) || ($row_select_pipe['ss_m3_3'] != "" && $row_select_pipe['ss_m3_3'] != "0" && $row_select_pipe['ss_m3_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Mass of Container  - <b>M<sub>3</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m3_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m3_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m3_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ss_m4_1'] != "" && $row_select_pipe['ss_m4_1'] != "0" && $row_select_pipe['ss_m4_1'] != null) || ($row_select_pipe['ss_m4_2'] != "" && $row_select_pipe['ss_m4_2'] != "0" && $row_select_pipe['ss_m4_2'] != null) || ($row_select_pipe['ss_m4_3'] != "" && $row_select_pipe['ss_m4_3'] != "0" && $row_select_pipe['ss_m4_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Saturated Surface Dry Weight of Sample with Container - <b>M<sub>4</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m4_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m4_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m4_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ss_m5_1'] != "" && $row_select_pipe['ss_m5_1'] != "0" && $row_select_pipe['ss_m5_1'] != null) || ($row_select_pipe['ss_m5_2'] != "" && $row_select_pipe['ss_m5_2'] != "0" && $row_select_pipe['ss_m5_2'] != null) || ($row_select_pipe['ss_m5_3'] != "" && $row_select_pipe['ss_m5_3'] != "0" && $row_select_pipe['ss_m5_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Dry Weight of Sample with Container - <b>M<sub>5</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m5_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m5_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ss_m5_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ssm_sub_1'] != "" && $row_select_pipe['ssm_sub_1'] != "0" && $row_select_pipe['ssm_sub_1'] != null) || ($row_select_pipe['ssm_sub_2'] != "" && $row_select_pipe['ssm_sub_2'] != "0" && $row_select_pipe['ssm_sub_2'] != null) || ($row_select_pipe['ssm_sub_3'] != "" && $row_select_pipe['ssm_sub_3'] != "0" && $row_select_pipe['ssm_sub_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Saturated Submerged Mass - <b>M<sub>sub</sub>= M<sub>2</sub> - M<sub>1</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ssm_sub_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ssm_sub_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ssm_sub_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['ssm_sat_1'] != "" && $row_select_pipe['ssm_sat_1'] != "0" && $row_select_pipe['ssm_sat_1'] != null) || ($row_select_pipe['ssm_sat_2'] != "" && $row_select_pipe['ssm_sat_2'] != "0" && $row_select_pipe['ssm_sat_2'] != null) || ($row_select_pipe['ssm_sat_3'] != "" && $row_select_pipe['ssm_sat_3'] != "0" && $row_select_pipe['ssm_sat_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Saturated Surface Dry Mass - <b>M<sub>sat</sub>= M<sub>4</sub> - M<sub>3</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ssm_sat_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ssm_sat_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['ssm_sat_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['dm_ms_1'] != "" && $row_select_pipe['dm_ms_1'] != "0" && $row_select_pipe['dm_ms_1'] != null) || ($row_select_pipe['dm_ms_2'] != "" && $row_select_pipe['dm_ms_2'] != "0" && $row_select_pipe['dm_ms_2'] != null) || ($row_select_pipe['dm_ms_3'] != "" && $row_select_pipe['dm_ms_3'] != "0" && $row_select_pipe['dm_ms_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Dry Mass (Grain Weight) - <b>M<sub>s</sub>= M<sub>5</sub> - M<sub>3</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['dm_ms_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['dm_ms_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['dm_ms_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['bvol_1'] != "" && $row_select_pipe['bvol_1'] != "0" && $row_select_pipe['bvol_1'] != null) || ($row_select_pipe['bvol_2'] != "" && $row_select_pipe['bvol_2'] != "0" && $row_select_pipe['bvol_2'] != null) || ($row_select_pipe['bvol_3'] != "" && $row_select_pipe['bvol_3'] != "0" && $row_select_pipe['bvol_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Bulk Volume - <b>V = (M<sub>sat</sub> - M<sub>sub</sub>) / &Rho;<sub>w</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >m<sup>3</sup></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['bvol_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['bvol_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['bvol_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['pv_1'] != "" && $row_select_pipe['pv_1'] != "0" && $row_select_pipe['pv_1'] != null) || ($row_select_pipe['pv_2'] != "" && $row_select_pipe['pv_2'] != "0" && $row_select_pipe['pv_2'] != null) || ($row_select_pipe['pv_3'] != "" && $row_select_pipe['pv_3'] != "0" && $row_select_pipe['pv_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Pore Volume - <b>V<sub>v</sub> = (M<sub>sat</sub> - M<sub>s</sub>) / &Rho;<sub>w</sub></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >m<sup>3</sup></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['pv_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['pv_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['pv_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['por_1'] != "" && $row_select_pipe['por_1'] != "0" && $row_select_pipe['por_1'] != null) || ($row_select_pipe['por_2'] != "" && $row_select_pipe['por_2'] != "0" && $row_select_pipe['por_2'] != null) || ($row_select_pipe['por_3'] != "" && $row_select_pipe['por_3'] != "0" && $row_select_pipe['por_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Porosity - <b>n = (V<sub>v</sub> / V) X 100</b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >%</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['por_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['por_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['por_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['pd_1'] != "" && $row_select_pipe['pd_1'] != "0" && $row_select_pipe['pd_1'] != null) || ($row_select_pipe['pd_2'] != "" && $row_select_pipe['pd_2'] != "0" && $row_select_pipe['pd_2'] != null) || ($row_select_pipe['pd_3'] != "" && $row_select_pipe['pd_3'] != "0" && $row_select_pipe['pd_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" >Dry Density - <b>P<sub>d</sub> = M<sub>s</sub> / V</b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >Kg/m<sup>3</sup></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['pd_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['pd_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['pd_3']; ?></td>
									</tr>
									<?php } if (($row_select_pipe['wc_1'] != "" && $row_select_pipe['wc_1'] != "0" && $row_select_pipe['wc_1'] != null) || ($row_select_pipe['wc_2'] != "" && $row_select_pipe['wc_2'] != "0" && $row_select_pipe['wc_2'] != null) || ($row_select_pipe['wc_3'] != "" && $row_select_pipe['wc_3'] != "0" && $row_select_pipe['wc_3'] != null)) { ?>
									<tr>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $cnt++; ?></td>
										<td style="border:1px solid; text-align:left; padding:7px 3px;" > Water Content - <b>W = <u style="text-underline-offset:4px;">(M<sub>4</sub> - M<sub>3</sub>) -  (M<sub>5</sub> - M<sub>3</sub>) </u> X 100 <br> <span style="padding-left:40%;"> (M<sub>5</sub> - M<sub>3</sub>) </span></b></td>
										<td style="border:1px solid; text-align:center; font-weight: bold; padding:7px 3px;" >%</td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['wc_1']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['wc_2']; ?></td>
										<td style="border:1px solid; text-align:center;padding:7px 3px;" ><?php echo $row_select_pipe['wc_3']; ?></td>
									</tr>
									<?php } ?>
								</table>
					</td>
				</tr>
				
				<!-- footer design -->
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; border-left:1px solid;border-right:1px solid; ">
							<tr>
								<td style="height: 30px;border: 1px solid;font-weight: bold;border-right: 1px solid; padding: 5px; border-bottom:0px; "colspan="4"></td>
							</tr>
							<tr>
								<td colspan="1" style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; border-right:1px solid;border-top:2px solid;" >Note :-</td>
								<td colspan="3" style="border-top:2px solid; border-bottom:1px solid;padding: 5px;font-weight: bold;">Density of water - p<sub>w</sub> = 1000 kg/m<sup>3</sup></td>
							</tr>
							<tr>
								<td colspan="1" style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; border-right:1px solid;border-top:2px solid;" >Remarks :-</td>
								<td colspan="3" style="border-top:2px solid; border-bottom:1px solid;padding: 5px;"><?php echo $row_select_pipe['remark']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: center;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Checked By :-</td>
								<td  style="border-top:1px solid; border-bottom:1px solid;padding: 5px;"></td>
								<td style="font-weight: bold;text-align: center;padding: 5px;border-left: 1px solid; border-right:1px solid; border-top:1px solid; border-bottom:1px solid; width:15%" >Tested By :-</td>
								<td  style="border-top:1px solid; border-bottom:1px solid;padding: 5px;"></td>	
							</tr>
							<tr>
								<td style="height: 40px;border: 1px solid;font-weight: bold;border-right: 1px solid; padding: 5px; border-bottom:0px; border-top:2px solid; "colspan="4"></td>
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
	
	<?php } ?>
	
	</page>
	
</body>

</html>

<script type="text/javascript">


</script>