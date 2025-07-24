<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
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
	$select_tiles_query = "select * from span_paver_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
	$sample_sent_by = $row_select['sample_sent_by'];
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
			$detail_sample = $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$paver_shape = $row_select4['paver_shape'];
		$paver_age = $row_select4['paver_age'];
		$paver_color = $row_select4['paver_color'];
		$paver_thickness = $row_select4['paver_thickness'];
		$paver_grade = $row_select4['paver_grade'];
	}

	$pagecnt = 1;
	$totalcnt = 1;
	$cnt = 1;
	if ($row_select_pipe['avgv'] != "" && $row_select_pipe['avgv'] != "0" && $row_select_pipe['avgv'] != null) {
		$totalcnt++;
	}

	?>

<?php 
	      /*   if (($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null) || ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) || ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) || ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null) || ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null) || ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null) || ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null) || ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null) || ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null) || ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null) || ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null) || ($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) || ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) || ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) || ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) || ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) || ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) || ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) || ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) || ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) || ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null)) { */
	        ?>


	<br>
	<br>
	<br>
	<br>
	<page size="A4">

		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;border-collapse: collapse; ">
			<!-- header design -->
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON PAVER BLOCK</td>
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
				
			<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">WATER ABSORPTION TEST (IS : 15658:2021, Annex C)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						
						<!--<tr>
							<td style="font-weight: bold;text-align: left;padding: 8px 5px;border: 0; width:20%;"></td>
							<td style="font-weight: bold;text-align: center;padding: 8px 5px;border: 0; width:30%;">Testing Date :-<span style="border-bottom: 1px solid black;"><?php echo date('d/m/Y', strtotime($end_date)); ?></span></td>
						</tr>>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>-->
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0; width:40%;">Paver block Shape :- <span style="border-bottom:1px solid black;"><?php echo $paver_shape; ?></span></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<?php $cnt = 1; ?>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width:20%;" rowspan="4">Sample Id.</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Dry Weight (Wd), kg</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="2">Wet Weight (Ww), kg</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="4">Water Absorption, %</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">W =</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">(Ww-Wd)</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">X</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">100 / Wd</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">W<sub>d</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">W<sub>w</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">wd</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="4">%</td>
						</tr>
						
						<?php 
	                    if (($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) || ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) || ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null)) {
	                    ?>
						
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w2_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w1_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="4"><?php echo $row_select_pipe['wtr_1']; ?></td>
						</tr>
						
						<?php 
	                    } if (($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) || ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) || ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null)) {
	                    ?>
						
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w2_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w1_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="4"><?php echo $row_select_pipe['wtr_2']; ?></td>
						</tr>
						
						<?php 
	                    } if (($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) || ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) || ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null)) {
	                    ?>
						
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w2_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w1_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="4"><?php echo $row_select_pipe['wtr_3']; ?></td>
						</tr>
						
						<?php 
	                    } if (($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null)) {
	                    ?>
						
						<tr>
							<td style="font-weight: bold;text-align: right;padding: 2px;" colspan=3>Average Water Absorpation :-</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;" colspan=4><?php echo $row_select_pipe['avg_wtr']; ?></td>
						</tr>
						
						<?php } ?>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">COMPRESSIVE STRENGTH (IS : 15658-2021; Annex D)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						
					</table>
				</td>
			</tr>
			
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6">&nbsp;</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0; width:40%;">Paver block Shape :- <span style="border-bottom:1px solid black;"><?php echo $paver_shape; ?></span></td>
						</tr>
					</table>
				</td>
			</tr>
			
				<tr>
				<td>
					<?php $cnt = 1; ?>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Sr. <br> No.</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Sample Id</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" >Weight of Cardboard representing Paver Block, msp</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" >Weight of Cardboard of 200mm x 100mm size, mstd</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" >Plan Area = 20000 msp / mstd</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2" >Remarks</td>
							
						</tr>
						
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">g</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">g</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">mm<sup>2</sup></td>
							
						</tr>
						
							
						<?php 
	                    if (($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">1</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m1']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) || ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) || ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">2</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m2']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">3</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m3']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">4</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m4']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">5</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m5']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">6</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m6']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">7</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m7']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">8</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['area_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php //echo $row_select_pipe['m8']; ?></td>
						</tr>
						
                        <?php } ?>
					</table>
				</td>
			</tr>
             
			 
			 

			<tr>
				<td>
					<?php $cnt = 1; ?>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 10px;border: 0px solid;" colspan="7"></td>
							
						</tr>
							<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Sr. <br> No.</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Sample Id</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" >Thickness, mm</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Failure Load, kN</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;"> Compressive Strength, MPa</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Correction Factor Based on Thickness</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">Corrected Compressive Strength, MPa</td>
							
						</tr>
							
						<?php 
	                    if (($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">1</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_1']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) || ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) || ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">2</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_2']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">3</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_3']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">4</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_4']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">5</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_5']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">6</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_6']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">7</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_7']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;">8</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['com_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['corr_8']; ?></td>
						</tr>
						
                        <?php } ?>
						<tr>
							<td colspan="6" style="text-align: right;padding: 2px;border: 1px solid;">Average :-</td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['avg_corr']; ?></td>
						</tr>
					</table>
				</td>
			</tr>
             

		
			<!-- footer design -->
            <tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
                </td>
            </tr>
            
        </table>
			<?php 
	      /*   if (($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null) || ($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) || ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) || ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null) || ($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null) || ($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null) || ($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null) || ($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null) || ($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null) || ($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null) || ($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null)) { */
	        ?>

		<!--	<tr>
				<td>
					<?php $cnt = 1; ?>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="4">Sample <br> Identification <br> No.</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="3">Thickness <br> of <br> Specimen</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="2">Rectangular <br> Cardboard Weight <br> (200 mm x 100 mm)</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="2">Paver Block <br>Shape <br> Cardboard <br> Weight</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" colspan="2">Plan Area</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Observed <br>Failure <br> Load</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2" colspan="2">Compressive <br> Strength</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Correction <br> Factor Based <br> on Thickness</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2" colspan="2">Corrected <br> Compressive <br> Strength</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">ASP =</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">20,000 m<sub>sp</sub></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">m<sub>std</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">m<sub>sp</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">m<sub>std</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">P</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">s =</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">P/A</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">T<sub>c</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">s<sub>c</sub> =</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">S X T<sub>c</sub></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">mm</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="2">mm²</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">KN</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="2">N/mm<sup>2</sup></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">--</td>
						</tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="2">N/mm<sup>2</sup></td>
							
							
						<?php 
	                    if (($row_select_pipe['area_1'] != "" && $row_select_pipe['area_1'] != "0" && $row_select_pipe['area_1'] != null) || ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) || ($row_select_pipe['corr_1'] != "" && $row_select_pipe['corr_1'] != "0" && $row_select_pipe['corr_1'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_1']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_2'] != "" && $row_select_pipe['area_2'] != "0" && $row_select_pipe['area_2'] != null) || ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) || ($row_select_pipe['corr_2'] != "" && $row_select_pipe['corr_2'] != "0" && $row_select_pipe['corr_2'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_2']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_3'] != "" && $row_select_pipe['area_3'] != "0" && $row_select_pipe['area_3'] != null) || ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) || ($row_select_pipe['corr_3'] != "" && $row_select_pipe['corr_3'] != "0" && $row_select_pipe['corr_3'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_3']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_4'] != "" && $row_select_pipe['area_4'] != "0" && $row_select_pipe['area_4'] != null) || ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) || ($row_select_pipe['corr_4'] != "" && $row_select_pipe['corr_4'] != "0" && $row_select_pipe['corr_4'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_4']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_4']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_5'] != "" && $row_select_pipe['area_5'] != "0" && $row_select_pipe['area_5'] != null) || ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) || ($row_select_pipe['corr_5'] != "" && $row_select_pipe['corr_5'] != "0" && $row_select_pipe['corr_5'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_5']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_5']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_6'] != "" && $row_select_pipe['area_6'] != "0" && $row_select_pipe['area_6'] != null) || ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) || ($row_select_pipe['corr_6'] != "" && $row_select_pipe['corr_6'] != "0" && $row_select_pipe['corr_6'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_6']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_6']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_7'] != "" && $row_select_pipe['area_7'] != "0" && $row_select_pipe['area_7'] != null) || ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) || ($row_select_pipe['corr_7'] != "" && $row_select_pipe['corr_7'] != "0" && $row_select_pipe['corr_7'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_7']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_7']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['area_8'] != "" && $row_select_pipe['area_8'] != "0" && $row_select_pipe['area_8'] != null) || ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) || ($row_select_pipe['corr_8'] != "" && $row_select_pipe['corr_8'] != "0" && $row_select_pipe['corr_8'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['sm8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['thick_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['lab_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['m8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['area_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['load_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['com_8']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['factor']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="2"><?php echo $row_select_pipe['corr_8']; ?></td>
						</tr>
						<?php 
	                    } if (($row_select_pipe['avg_corr'] != "" && $row_select_pipe['avg_corr'] != "0" && $row_select_pipe['avg_corr'] != null)) {
	                    ?>
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:1px solid;" colspan="6"></td>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:1px solid;" colspan="4"><b>Average Compressive Strength :-</b></td>
							<td style="text-align: center;padding: 2px;border: 1px solid; border-top:1px solid;" colspan="2"><?php echo $row_select_pipe['avg_corr']; ?></td>
						</tr>
                        <?php } ?>
					</table>
				</td>
			</tr>
             
	<?php 
			/* } if (($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) || ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) || ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null) || ($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) || ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) || ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null) || ($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) || ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) || ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null) || ($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null)) { */
	?>		

			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">WATER ABSORPTION TEST</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6">&nbsp;</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 8px 5px;border: 0; width:20%;">Material Description :- <span style="border-bottom: 1px solid black;">&nbsp; <?php echo $detail_sample; ?></span></td>
							<td style="font-weight: bold;text-align: center;padding: 8px 5px;border: 0; width:30%;">Testing Date :-<span style="border-bottom: 1px solid black;"><?php echo date('d/m/Y', strtotime($end_date)); ?></span></td>
						</tr>
						<tr>
							<td style="text-align: left;padding: 5px;border-top: 1px solid;width: 5%;" colspan=2><b>Test Method :-</b> &nbsp;&nbsp;&nbsp;AS per IS : 15658 : 2021 - Annex C</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">Observation Table</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: left;padding: 5px;border: 0; width:40%;">Paver block Shape :- <span style="border-bottom:1px solid black;"><?php echo $paver_shape; ?></span></td>
						</tr>
					</table>
				</td>
			</tr>


			<tr>
				<td>
					<?php $cnt = 1; ?>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;width:20%;" rowspan="4">Sample Identification No.</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">Dry Weight</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" rowspan="2">Wet Weight</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="4">Water Absorption</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">W =</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;">(Ww-Wd)</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">X</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;" rowspan="2">100</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">W<sub>d</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">W<sub>w</sub></td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">wd</td>
						</tr>
						<tr>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;">N</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;border: 1px solid;border-bottom: 1px solid;" colspan="4">%</td>
						</tr>
						
						<?php 
	                    if (($row_select_pipe['wtr_w1_1'] != "" && $row_select_pipe['wtr_w1_1'] != "0" && $row_select_pipe['wtr_w1_1'] != null) || ($row_select_pipe['wtr_w2_1'] != "" && $row_select_pipe['wtr_w2_1'] != "0" && $row_select_pipe['wtr_w2_1'] != null) || ($row_select_pipe['wtr_1'] != "" && $row_select_pipe['wtr_1'] != "0" && $row_select_pipe['wtr_1'] != null)) {
	                    ?>
						
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w1_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w2_1']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="4"><?php echo $row_select_pipe['wtr_1']; ?></td>
						</tr>
						
						<?php 
	                    } if (($row_select_pipe['wtr_w1_2'] != "" && $row_select_pipe['wtr_w1_2'] != "0" && $row_select_pipe['wtr_w1_2'] != null) || ($row_select_pipe['wtr_w2_2'] != "" && $row_select_pipe['wtr_w2_2'] != "0" && $row_select_pipe['wtr_w2_2'] != null) || ($row_select_pipe['wtr_2'] != "" && $row_select_pipe['wtr_2'] != "0" && $row_select_pipe['wtr_2'] != null)) {
	                    ?>
						
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w1_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w2_2']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="4"><?php echo $row_select_pipe['wtr_2']; ?></td>
						</tr>
						
						<?php 
	                    } if (($row_select_pipe['wtr_w1_3'] != "" && $row_select_pipe['wtr_w1_3'] != "0" && $row_select_pipe['wtr_w1_3'] != null) || ($row_select_pipe['wtr_w2_3'] != "" && $row_select_pipe['wtr_w2_3'] != "0" && $row_select_pipe['wtr_w2_3'] != null) || ($row_select_pipe['wtr_3'] != "" && $row_select_pipe['wtr_3'] != "0" && $row_select_pipe['wtr_3'] != null)) {
	                    ?>
						
						<tr>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $cnt++; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w1_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;"><?php echo $row_select_pipe['wtr_w2_3']; ?></td>
							<td style="text-align: center;padding: 2px;border: 1px solid;" colspan="4"><?php echo $row_select_pipe['wtr_3']; ?></td>
						</tr>
						
						<?php 
	                    } if (($row_select_pipe['avg_wtr'] != "" && $row_select_pipe['avg_wtr'] != "0" && $row_select_pipe['avg_wtr'] != null)) {
	                    ?>
						
						<tr>
							<td style="font-weight: bold;text-align: right;padding: 2px;" colspan=3>Average Water Absorpation :-</td>
							<td style="font-weight: bold;text-align: center;padding: 2px;" colspan=4><?php echo $row_select_pipe['avg_wtr']; ?></td>
						</tr>
						
						<?php } ?>
						
					</table>
				</td>
			</tr>
	-->
			<!-- footer design -->
		
			
	 <?php //} ?>		
		</table>


	</page>


			<?php //} ?>











	<!-- <br>

		<page size="A4">
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>	
		<br>
		<table align="center" width="94%" class="test1" height="20%">

			<tr style="border: 1px solid black;">
				<td colspan="2" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of Sample &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample; ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no . "_01" ?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; No. of Specimen	</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; 1</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Identification mark</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $row_select_pipe['identification_mark']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Grade & Shape of Block</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $paver_grade . '&nbsp; &nbsp; & &nbsp; &nbsp; ' . $paver_shape; ?></td>
			</tr>
			
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of receipt of sample</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y", strtotime($rec_sample_date)); ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++; ?>. Dimension : (IS 15658 : 2021 Annex-B (Method-1) : </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date : &nbsp;<?php echo date("d/m/Y", strtotime($end_date)); ?></b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b></b></td>
			</tr>	
		</table>
		<?php $count = 1 ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" >
			<tr style="border-top:1px solid;" >
				<td rowspan="2" style="width:8%;border-left:1px solid;text-align:center;padding:4px 4px;"><b>Sr.No</b></td>
				<td style="width:23%;border-left:1px solid;text-align:center;padding:4px 4px;"><b>Weight of the<br>sample<br>(completely<br>submerged in<br>Water)<br>W<sub>a</sub></b></td>
				<td style="width:23%;border-left:1px solid;text-align:center;padding:4px 4px;"><b>Weight of the<br>Sample (After<br>Drain 1 min or SSD)<br>W<sub>w</sub></b></td>
				<td style="width:23%;border-left:1px solid;text-align:center;padding:4px 4px;"><b>Volume =<br>(W<sub>w</sub> - W<sub>a</sub>) x 10<sup>-3</sup></b></td>
				<td style="width:23%;border-left:1px solid;text-align:center;padding:4px 4px;"><b>Plan Area =<br> (Volume / Thickness) </b></td>
			</tr>
			<tr>
				<td style="border-left:1px solid;text-align:center;"><b>N </b></td>
				<td style="border-left:1px solid;text-align:center;"><b>N</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>m<sup>3</sup></b></td>
				<td style="border-left:1px solid;text-align:center;"><b>mm<sup>2</sup></b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_1'] - $row_select_pipe['wa_1']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_1'] - $row_select_pipe['wa_1']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_2'] - $row_select_pipe['wa_2']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_2'] - $row_select_pipe['wa_2']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_3'] - $row_select_pipe['wa_3']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_3'] - $row_select_pipe['wa_3']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_4'] - $row_select_pipe['wa_4']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_4'] - $row_select_pipe['wa_4']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_5'] - $row_select_pipe['wa_5']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_5'] - $row_select_pipe['wa_5']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_6'] - $row_select_pipe['wa_6']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_6'] - $row_select_pipe['wa_6']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_7'] - $row_select_pipe['wa_7']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_7'] - $row_select_pipe['wa_7']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['wa_8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['ww_8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo (($row_select_pipe['ww_8'] - $row_select_pipe['wa_8']) / 1000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(((($row_select_pipe['ww_8'] - $row_select_pipe['wa_8']) / 1000) / $paver_thickness), 0, 6); ?></td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amend No.: 01</center></td>
				<td style="width:25%;"><center>Amend Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 5</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
			<br>
			<br>
		<div class="pagebreak"></div>
		<br>
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="3%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++; ?>. Compressive Strength : - &nbsp; &nbsp; &nbsp; (IS: 15658-2021 Annex D) </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date : &nbsp;<?php echo date("d/m/Y", strtotime($end_date)); ?></b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b></b></td>
			</tr>	
		</table>
		<?php $count = 1 ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="30%">
			<tr style="border-top:1px solid;" >
				<td style="width:4%;border-left:1px solid;text-align:center;"><b>Sr.<br>No</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Length<br>(mm)</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Width<br>(mm)</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Thickness<br>(mm)</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Weight<br>(kg)</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Plan Area<br>of<br>Block<br>(mm<sup>2</sup>)</td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Failure<br>Load<br>(KN)</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Comp.<br>strength <br>(N / mm<sup>2</sup>)</b></td>
				<td style="width:12%;border-left:1px solid;text-align:center;"><b>Comp. strength <br>after applying <br>correction Factor <br>(N / mm<sup>2</sup>)<br></b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_1'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_1']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_2'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_2']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_3'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_3']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_3']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_4'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_4']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_4']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_5'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_5']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_5']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_6'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_6']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_6']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_7'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_7']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_7']; ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['clen8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['cwid8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['thick_8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo substr(($row_select_pipe['lab_8'] / 1000), 0, 5); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['grade_8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['load_8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['com_8']; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo $row_select_pipe['corr_8']; ?></td>
			</tr>
			
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Note: Correction factor for block thickness as per IS 15658: 2021 (Annexure D & Table 5)</b></td>
			</tr>		
		</table>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="3%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++; ?>. Tensile Splitting Strength (IS 15658 : 2021 Annexure F) :- </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date : &nbsp;<?php echo date("d/m/Y", strtotime($end_date)); ?></b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b></b></td>
			</tr>	
		</table>
		<?php $count = 1; ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="35%">
			<tr style="border-top:1px solid;" >
				<td style="width:10%;border-left:1px solid;text-align:center;"><b>Sr.No</b></td>
				<td style="width:18%;border-left:1px solid;text-align:center;"><b>Failure Length,<br>l (mm)</b></td>
				<td style="width:15%;border-left:1px solid;text-align:center;"><b>Thickness,<br>t (mm)</b></td>
				<td style="width:15%;border-left:1px solid;text-align:center;"><b>Area of failure<br>S (mm<sup>2</sup>)<br> S = l X T</b></td>
				<td style="width:15%;border-left:1px solid;text-align:center;"><b>Failure Load,<br>P (KN)</b></td>
				<td style="width:18%;border-left:1px solid;text-align:center;"><b>Tensile splitting<br>strength,<br>T =0.637 x K x<br>(P / S) N / mm<sup>2</sup></td>
				<td style="width:15%;border-left:1px solid;text-align:center;"><b>correction factor <br>F = P / l </b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf1'] != '' && $row_select_pipe['avgf1'] != 0 && $row_select_pipe['avgf1'] != null) {
																			echo $row_select_pipe['avgf1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt1'] != '' && $row_select_pipe['avgt1'] != 0 && $row_select_pipe['avgt1'] != null) {
																			echo $row_select_pipe['avgt1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea1'] != '' && $row_select_pipe['farea1'] != 0 && $row_select_pipe['farea1'] != null) {
																			echo $row_select_pipe['farea1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload1'] != '' && $row_select_pipe['fload1'] != 0 && $row_select_pipe['fload1'] != null) {
																			echo $row_select_pipe['fload1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten1'] != '' && $row_select_pipe['sten1'] != 0 && $row_select_pipe['sten1'] != null) {
																			echo $row_select_pipe['sten1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload1'] != '' && $row_select_pipe['fload1'] != 0 && $row_select_pipe['fload1'] != null) {
																			echo substr(($row_select_pipe['fload1'] / $row_select_pipe['avgf1']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf2'] != '' && $row_select_pipe['avgf2'] != 0 && $row_select_pipe['avgf2'] != null) {
																			echo $row_select_pipe['avgf2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt2'] != '' && $row_select_pipe['avgt2'] != 0 && $row_select_pipe['avgt2'] != null) {
																			echo $row_select_pipe['avgt2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea2'] != '' && $row_select_pipe['farea2'] != 0 && $row_select_pipe['farea2'] != null) {
																			echo $row_select_pipe['farea2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload2'] != '' && $row_select_pipe['fload2'] != 0 && $row_select_pipe['fload2'] != null) {
																			echo $row_select_pipe['fload2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten2'] != '' && $row_select_pipe['sten2'] != 0 && $row_select_pipe['sten2'] != null) {
																			echo $row_select_pipe['sten2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload2'] != '' && $row_select_pipe['fload2'] != 0 && $row_select_pipe['fload2'] != null) {
																			echo substr(($row_select_pipe['fload2'] / $row_select_pipe['avgf2']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf3'] != '' && $row_select_pipe['avgf3'] != 0 && $row_select_pipe['avgf3'] != null) {
																			echo $row_select_pipe['avgf3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt3'] != '' && $row_select_pipe['avgt3'] != 0 && $row_select_pipe['avgt3'] != null) {
																			echo $row_select_pipe['avgt3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea3'] != '' && $row_select_pipe['farea3'] != 0 && $row_select_pipe['farea3'] != null) {
																			echo $row_select_pipe['farea3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload3'] != '' && $row_select_pipe['fload3'] != 0 && $row_select_pipe['fload3'] != null) {
																			echo $row_select_pipe['fload3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten3'] != '' && $row_select_pipe['sten3'] != 0 && $row_select_pipe['sten3'] != null) {
																			echo $row_select_pipe['sten3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload3'] != '' && $row_select_pipe['fload3'] != 0 && $row_select_pipe['fload3'] != null) {
																			echo substr(($row_select_pipe['fload3'] / $row_select_pipe['avgf3']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf4'] != '' && $row_select_pipe['avgf4'] != 0 && $row_select_pipe['avgf4'] != null) {
																			echo $row_select_pipe['avgf4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt4'] != '' && $row_select_pipe['avgt4'] != 0 && $row_select_pipe['avgt4'] != null) {
																			echo $row_select_pipe['avgt4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea4'] != '' && $row_select_pipe['farea4'] != 0 && $row_select_pipe['farea4'] != null) {
																			echo $row_select_pipe['farea4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload4'] != '' && $row_select_pipe['fload4'] != 0 && $row_select_pipe['fload4'] != null) {
																			echo $row_select_pipe['fload4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten4'] != '' && $row_select_pipe['sten4'] != 0 && $row_select_pipe['sten4'] != null) {
																			echo $row_select_pipe['sten4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload4'] != '' && $row_select_pipe['fload4'] != 0 && $row_select_pipe['fload4'] != null) {
																			echo substr(($row_select_pipe['fload4'] / $row_select_pipe['avgf4']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf5'] != '' && $row_select_pipe['avgf5'] != 0 && $row_select_pipe['avgf5'] != null) {
																			echo $row_select_pipe['avgf5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt5'] != '' && $row_select_pipe['avgt5'] != 0 && $row_select_pipe['avgt5'] != null) {
																			echo $row_select_pipe['avgt5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea5'] != '' && $row_select_pipe['farea5'] != 0 && $row_select_pipe['farea5'] != null) {
																			echo $row_select_pipe['farea5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload5'] != '' && $row_select_pipe['fload5'] != 0 && $row_select_pipe['fload5'] != null) {
																			echo $row_select_pipe['fload5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten5'] != '' && $row_select_pipe['sten5'] != 0 && $row_select_pipe['sten5'] != null) {
																			echo $row_select_pipe['sten5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload5'] != '' && $row_select_pipe['fload5'] != 0 && $row_select_pipe['fload5'] != null) {
																			echo substr(($row_select_pipe['fload5'] / $row_select_pipe['avgf5']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf6'] != '' && $row_select_pipe['avgf6'] != 0 && $row_select_pipe['avgf6'] != null) {
																			echo $row_select_pipe['avgf6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt6'] != '' && $row_select_pipe['avgt6'] != 0 && $row_select_pipe['avgt6'] != null) {
																			echo $row_select_pipe['avgt6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea6'] != '' && $row_select_pipe['farea6'] != 0 && $row_select_pipe['farea6'] != null) {
																			echo $row_select_pipe['farea6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload6'] != '' && $row_select_pipe['fload6'] != 0 && $row_select_pipe['fload6'] != null) {
																			echo $row_select_pipe['fload6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten6'] != '' && $row_select_pipe['sten6'] != 0 && $row_select_pipe['sten6'] != null) {
																			echo $row_select_pipe['sten6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload6'] != '' && $row_select_pipe['fload6'] != 0 && $row_select_pipe['fload6'] != null) {
																			echo substr(($row_select_pipe['fload6'] / $row_select_pipe['avgf6']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf7'] != '' && $row_select_pipe['avgf7'] != 0 && $row_select_pipe['avgf7'] != null) {
																			echo $row_select_pipe['avgf7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt7'] != '' && $row_select_pipe['avgt7'] != 0 && $row_select_pipe['avgt7'] != null) {
																			echo $row_select_pipe['avgt7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea7'] != '' && $row_select_pipe['farea7'] != 0 && $row_select_pipe['farea7'] != null) {
																			echo $row_select_pipe['farea7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload7'] != '' && $row_select_pipe['fload7'] != 0 && $row_select_pipe['fload7'] != null) {
																			echo $row_select_pipe['fload7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten7'] != '' && $row_select_pipe['sten7'] != 0 && $row_select_pipe['sten7'] != null) {
																			echo $row_select_pipe['sten7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload7'] != '' && $row_select_pipe['fload7'] != 0 && $row_select_pipe['fload7'] != null) {
																			echo substr(($row_select_pipe['fload7'] / $row_select_pipe['avgf7']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgf8'] != '' && $row_select_pipe['avgf8'] != 0 && $row_select_pipe['avgf8'] != null) {
																			echo $row_select_pipe['avgf8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['avgt8'] != '' && $row_select_pipe['avgt8'] != 0 && $row_select_pipe['avgt8'] != null) {
																			echo $row_select_pipe['avgt8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['farea8'] != '' && $row_select_pipe['farea8'] != 0 && $row_select_pipe['farea8'] != null) {
																			echo $row_select_pipe['farea8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload8'] != '' && $row_select_pipe['fload8'] != 0 && $row_select_pipe['fload8'] != null) {
																			echo $row_select_pipe['fload8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sten8'] != '' && $row_select_pipe['sten8'] != 0 && $row_select_pipe['sten8'] != null) {
																			echo $row_select_pipe['sten8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fload8'] != '' && $row_select_pipe['fload8'] != 0 && $row_select_pipe['fload8'] != null) {
																			echo substr(($row_select_pipe['fload8'] / $row_select_pipe['avgf8']), 0, 6);
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			
		</table>
		<table align="center" width="94%" style="" Height="5%">
			<tr style="font-size:15px;" >
				<td style="text-align:center;"><b>Note : K = Correction factor for block thickness as per IS 15658 : 2021 (Annexure F)</b></td>
			</tr>		
		</table>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amend No.: 01</center></td>
				<td style="width:25%;"><center>Amend Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 2 of 5</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<br>
		<br>
		<div class="pagebreak"></div>
		<br>
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++; ?>. Water Absorption: - (IS: 15658-2021 Annex C ) </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date : &nbsp;<?php echo date("d/m/Y", strtotime($end_date)); ?></b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b></b></td>
			</tr>	
		</table>
		<?php $count = 1 ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="23%">
			<tr style="border-top:1px solid;" >
				<td style="width:4%;border-left:1px solid;text-align:center;"><b>Sr.<br>No</b></td>
				<td style="width:20%;border-left:1px solid;text-align:center;"><b>Oven Dry Weight<br>in (N) Wd</b></td>
				<td style="width:20%;border-left:1px solid;text-align:center;"><b>S. S. Dry weight<br>in (N) Ww</b></td>
				<td style="width:26%;border-left:1px solid;text-align:center;"><b>Difference Ww - Wd in (N)</b></td>
				<td style="width:30%;border-left:1px solid;text-align:center;"><b>Water Absorption in percent <br>&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp; <span style="border-bottom:1px solid;">Ww - Wd </span> &nbsp; x &nbsp; 100 <br>Wd</b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w2_1'] != '' && $row_select_pipe['wtr_w2_1'] != 0 && $row_select_pipe['wtr_w2_1'] != null) {
																			echo $row_select_pipe['wtr_w2_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w1_1'] != '' && $row_select_pipe['wtr_w1_1'] != 0 && $row_select_pipe['wtr_w1_1'] != null) {
																			echo $row_select_pipe['wtr_w1_1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w1_1'] != '' && $row_select_pipe['wtr_w1_1'] != 0 && $row_select_pipe['wtr_w1_1'] != null) {
																			echo ($row_select_pipe['wtr_w1_1'] - $row_select_pipe['wtr_w2_1']);
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_1'] != '' && $row_select_pipe['wtr_1'] != 0 && $row_select_pipe['wtr_1'] != null) {
																			echo $row_select_pipe['wtr_1'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w2_2'] != '' && $row_select_pipe['wtr_w2_2'] != 0 && $row_select_pipe['wtr_w2_2'] != null) {
																			echo $row_select_pipe['wtr_w2_2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w1_2'] != '' && $row_select_pipe['wtr_w1_2'] != 0 && $row_select_pipe['wtr_w1_2'] != null) {
																			echo $row_select_pipe['wtr_w1_2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w1_2'] != '' && $row_select_pipe['wtr_w1_2'] != 0 && $row_select_pipe['wtr_w1_2'] != null) {
																			echo ($row_select_pipe['wtr_w1_2'] - $row_select_pipe['wtr_w2_2']);
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_2'] != '' && $row_select_pipe['wtr_2'] != 0 && $row_select_pipe['wtr_2'] != null) {
																			echo $row_select_pipe['wtr_2'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w2_3'] != '' && $row_select_pipe['wtr_w2_3'] != 0 && $row_select_pipe['wtr_w2_3'] != null) {
																			echo $row_select_pipe['wtr_w2_3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w1_3'] != '' && $row_select_pipe['wtr_w1_3'] != 0 && $row_select_pipe['wtr_w1_3'] != null) {
																			echo $row_select_pipe['wtr_w1_3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_w1_3'] != '' && $row_select_pipe['wtr_w1_3'] != 0 && $row_select_pipe['wtr_w1_3'] != null) {
																			echo ($row_select_pipe['wtr_w1_3'] - $row_select_pipe['wtr_w2_3']);
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['wtr_3'] != '' && $row_select_pipe['wtr_3'] != 0 && $row_select_pipe['wtr_3'] != null) {
																			echo $row_select_pipe['wtr_3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td colspan="4" style="border-left:1px solid;text-align:right;"><b>Average &nbsp; &nbsp; &nbsp; </b></td>
				<td style="border-left:1px solid;text-align:center;"><b><?php if ($row_select_pipe['avg_wtr'] != '' && $row_select_pipe['avg_wtr'] != 0 && $row_select_pipe['avg_wtr'] != null) {
																			echo $row_select_pipe['avg_wtr'];
																		} else {
																			echo '-';
																		} ?></b></td>
			</tr>
			
		</table>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="4%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++; ?>. Flexural Strength (IS 15658: 2021 Annexure G) :- </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date : &nbsp;<?php echo date("d/m/Y", strtotime($end_date)); ?></b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b></b></td>
			</tr>	
		</table>
		<?php $count = 1 ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="37%">
			<tr style="border-top:1px solid;" >
				<td style="width:5%;border-left:1px solid;text-align:center;"><b>Sr.<br>No</b></td>
				<td style="width:15%;border-left:1px solid;text-align:center;"><b>Span , l <br>(mm)</b></td>
				<td style="width:15%;border-left:1px solid;text-align:center;"><b>Width b<br> (mm)</b></td>
				<td style="width:20%;border-left:1px solid;text-align:center;"><b>Thickness d <br>(mm)</b></td>
				<td style="width:20%;border-left:1px solid;text-align:center;"><b>Failure Load, P<br>(KN)</b></td>
				<td style="width:25%;border-left:1px solid;text-align:center;"><b>Flexural strength,<br>Fb = 3Pl / 2 bd<sup>2</sup><br> N/mm<sup>2</sup></b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen1'] != '' && $row_select_pipe['flen1'] != 0 && $row_select_pipe['flen1'] != null) {
																			echo $row_select_pipe['flen1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid1'] != '' && $row_select_pipe['fwid1'] != 0 && $row_select_pipe['fwid1'] != null) {
																			echo $row_select_pipe['fwid1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk1'] != '' && $row_select_pipe['fthk1'] != 0 && $row_select_pipe['fthk1'] != null) {
																			echo $row_select_pipe['fthk1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa1'] != '' && $row_select_pipe['floa1'] != 0 && $row_select_pipe['floa1'] != null) {
																			echo $row_select_pipe['floa1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle1'] != '' && $row_select_pipe['fle1'] != 0 && $row_select_pipe['fle1'] != null) {
																			echo $row_select_pipe['fle1'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen2'] != '' && $row_select_pipe['flen2'] != 0 && $row_select_pipe['flen2'] != null) {
																			echo $row_select_pipe['flen2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid2'] != '' && $row_select_pipe['fwid2'] != 0 && $row_select_pipe['fwid2'] != null) {
																			echo $row_select_pipe['fwid2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk2'] != '' && $row_select_pipe['fthk2'] != 0 && $row_select_pipe['fthk2'] != null) {
																			echo $row_select_pipe['fthk2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa2'] != '' && $row_select_pipe['floa2'] != 0 && $row_select_pipe['floa2'] != null) {
																			echo $row_select_pipe['floa2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle2'] != '' && $row_select_pipe['fle2'] != 0 && $row_select_pipe['fle2'] != null) {
																			echo $row_select_pipe['fle2'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen3'] != '' && $row_select_pipe['flen3'] != 0 && $row_select_pipe['flen3'] != null) {
																			echo $row_select_pipe['flen3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid3'] != '' && $row_select_pipe['fwid3'] != 0 && $row_select_pipe['fwid3'] != null) {
																			echo $row_select_pipe['fwid3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk3'] != '' && $row_select_pipe['fthk3'] != 0 && $row_select_pipe['fthk3'] != null) {
																			echo $row_select_pipe['fthk3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa3'] != '' && $row_select_pipe['floa3'] != 0 && $row_select_pipe['floa3'] != null) {
																			echo $row_select_pipe['floa3'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle3'] != '' && $row_select_pipe['fle3'] != 0 && $row_select_pipe['fle3'] != null) {
																			echo $row_select_pipe['fle3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen4'] != '' && $row_select_pipe['flen4'] != 0 && $row_select_pipe['flen4'] != null) {
																			echo $row_select_pipe['flen4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid4'] != '' && $row_select_pipe['fwid4'] != 0 && $row_select_pipe['fwid4'] != null) {
																			echo $row_select_pipe['fwid4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk4'] != '' && $row_select_pipe['fthk4'] != 0 && $row_select_pipe['fthk4'] != null) {
																			echo $row_select_pipe['fthk4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa4'] != '' && $row_select_pipe['floa4'] != 0 && $row_select_pipe['floa4'] != null) {
																			echo $row_select_pipe['floa4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle4'] != '' && $row_select_pipe['fle4'] != 0 && $row_select_pipe['fle4'] != null) {
																			echo $row_select_pipe['fle4'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen5'] != '' && $row_select_pipe['flen5'] != 0 && $row_select_pipe['flen5'] != null) {
																			echo $row_select_pipe['flen5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid5'] != '' && $row_select_pipe['fwid5'] != 0 && $row_select_pipe['fwid5'] != null) {
																			echo $row_select_pipe['fwid5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk5'] != '' && $row_select_pipe['fthk5'] != 0 && $row_select_pipe['fthk5'] != null) {
																			echo $row_select_pipe['fthk5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa5'] != '' && $row_select_pipe['floa5'] != 0 && $row_select_pipe['floa5'] != null) {
																			echo $row_select_pipe['floa5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle5'] != '' && $row_select_pipe['fle5'] != 0 && $row_select_pipe['fle5'] != null) {
																			echo $row_select_pipe['fle5'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen6'] != '' && $row_select_pipe['flen6'] != 0 && $row_select_pipe['flen6'] != null) {
																			echo $row_select_pipe['flen6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid6'] != '' && $row_select_pipe['fwid6'] != 0 && $row_select_pipe['fwid6'] != null) {
																			echo $row_select_pipe['fwid6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk6'] != '' && $row_select_pipe['fthk6'] != 0 && $row_select_pipe['fthk6'] != null) {
																			echo $row_select_pipe['fthk6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa6'] != '' && $row_select_pipe['floa6'] != 0 && $row_select_pipe['floa6'] != null) {
																			echo $row_select_pipe['floa6'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle6'] != '' && $row_select_pipe['fle6'] != 0 && $row_select_pipe['fle6'] != null) {
																			echo $row_select_pipe['fle6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen7'] != '' && $row_select_pipe['flen7'] != 0 && $row_select_pipe['flen7'] != null) {
																			echo $row_select_pipe['flen7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid7'] != '' && $row_select_pipe['fwid7'] != 0 && $row_select_pipe['fwid7'] != null) {
																			echo $row_select_pipe['fwid7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk7'] != '' && $row_select_pipe['fthk7'] != 0 && $row_select_pipe['fthk7'] != null) {
																			echo $row_select_pipe['fthk7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa7'] != '' && $row_select_pipe['floa7'] != 0 && $row_select_pipe['floa7'] != null) {
																			echo $row_select_pipe['floa7'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle7'] != '' && $row_select_pipe['fle7'] != 0 && $row_select_pipe['fle7'] != null) {
																			echo $row_select_pipe['fle7'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['flen8'] != '' && $row_select_pipe['flen8'] != 0 && $row_select_pipe['flen8'] != null) {
																			echo $row_select_pipe['flen8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fwid8'] != '' && $row_select_pipe['fwid8'] != 0 && $row_select_pipe['fwid8'] != null) {
																			echo $row_select_pipe['fwid8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fthk8'] != '' && $row_select_pipe['fthk8'] != 0 && $row_select_pipe['fthk8'] != null) {
																			echo $row_select_pipe['fthk8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['floa8'] != '' && $row_select_pipe['floa8'] != 0 && $row_select_pipe['floa8'] != null) {
																			echo $row_select_pipe['floa8'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['fle8'] != '' && $row_select_pipe['fle8'] != 0 && $row_select_pipe['fle8'] != null) {
																			echo $row_select_pipe['fle8'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td colspan="5" style="border-left:1px solid;text-align:right;"><b>Average &nbsp; &nbsp; &nbsp; </b></td>
				<td style="border-left:1px solid;text-align:center;"><b><?php if ($row_select_pipe['avg_fle'] != '' && $row_select_pipe['avg_fle'] != 0 && $row_select_pipe['avg_fle'] != null) {
																			echo $row_select_pipe['avg_fle'];
																		} else {
																			echo '-';
																		} ?></b></td>
			</tr>
			
		</table>
		<br>
		<br>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amend No.: 01</center></td>
				<td style="width:25%;"><center>Amend Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 3 of 5</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<br>
		<br>
		<div class="pagebreak"></div>
		<br>
		<br>
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>
		<table align="center" width="94%" class="test1" style="border: 1px solid black;" height="3%">
			<tr style="border: 0px solid black;">
				<td width="60%" rowspan="2" style="border: 0px solid black;border-right: 1px solid black;"><b>&nbsp; <?php echo $cnt++; ?>. Abrasion Test (IS 15658: 2021 Annexure E)  :- </b></td>
				<td width="20%" style="border: 0px solid black;"><b>&nbsp; Date : &nbsp;<?php echo date("d/m/Y", strtotime($end_date)); ?></b></td>
				<td width="20%" style="text-align:right;border-left: 1px solid black;padding-right:20px;"><b></b></td>
			</tr>	
		</table>
		<?php $count = 1 ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="67%">
			<tr style="border-top:1px solid;" >
				<td colspan="3" style="border-left:1px solid;text-align:left;"><b>&nbsp; &nbsp; [ A ] &nbsp; For Dry Measurement</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>Sample-1</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>Sample-2</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>Sample-3</b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="width:5%;border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="width:53%;border-left:1px solid;text-align:left;">&nbsp; Date / Time Sample put in the Oven</td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm9'] != '' && $row_select_pipe['sm9'] != 0 && $row_select_pipe['sm9'] != null) {
																					echo $row_select_pipe['sm9'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm10'] != '' && $row_select_pipe['sm10'] != 0 && $row_select_pipe['sm10'] != null) {
																					echo $row_select_pipe['sm10'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm11'] != '' && $row_select_pipe['sm11'] != 0 && $row_select_pipe['sm11'] != null) {
																					echo $row_select_pipe['sm11'];
																				} else {
																					echo '-';
																				} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Date / Time Sample taken out from the Oven</td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm9'] != '' && $row_select_pipe['sm9'] != 0 && $row_select_pipe['sm9'] != null) {
																					echo $row_select_pipe['sm9'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm10'] != '' && $row_select_pipe['sm10'] != 0 && $row_select_pipe['sm10'] != null) {
																					echo $row_select_pipe['sm10'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm11'] != '' && $row_select_pipe['sm11'] != 0 && $row_select_pipe['sm11'] != null) {
																					echo $row_select_pipe['sm11'];
																				} else {
																					echo '-';
																				} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Length of the Specimen before Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l1'] != '' && $row_select_pipe['l1'] != 0 && $row_select_pipe['l1'] != null) {
																			echo $row_select_pipe['l1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l2'] != '' && $row_select_pipe['l2'] != 0 && $row_select_pipe['l2'] != null) {
																			echo $row_select_pipe['l2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l3'] != '' && $row_select_pipe['l3'] != 0 && $row_select_pipe['l3'] != null) {
																			echo $row_select_pipe['l3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Width of Specimen before Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['w1'] != '' && $row_select_pipe['w1'] != 0 && $row_select_pipe['w1'] != null) {
																			echo $row_select_pipe['w1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['w2'] != '' && $row_select_pipe['w2'] != 0 && $row_select_pipe['w2'] != null) {
																			echo $row_select_pipe['w2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['w3'] != '' && $row_select_pipe['w3'] != 0 && $row_select_pipe['w3'] != null) {
																			echo $row_select_pipe['w3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Thickness of the specimen before Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Volume of the specimen before Abrasion test (mm<sup>3</sup>)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Mass of the specimen (Before Abrasion Test) (g)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['im1'] != '' && $row_select_pipe['im1'] != 0 && $row_select_pipe['im1'] != null) {
																			echo $row_select_pipe['im1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['im2'] != '' && $row_select_pipe['im2'] != 0 && $row_select_pipe['im2'] != null) {
																			echo $row_select_pipe['im2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['im3'] != '' && $row_select_pipe['im3'] != 0 && $row_select_pipe['im3'] != null) {
																			echo $row_select_pipe['im3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Density of the specimen (g / mm<sup>3</sup>)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['pr1'] != '' && $row_select_pipe['pr1'] != 0 && $row_select_pipe['pr1'] != null) {
																			echo $row_select_pipe['pr1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['pr2'] != '' && $row_select_pipe['pr2'] != 0 && $row_select_pipe['pr2'] != null) {
																			echo $row_select_pipe['pr2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['pr3'] != '' && $row_select_pipe['pr3'] != 0 && $row_select_pipe['pr3'] != null) {
																			echo $row_select_pipe['pr3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td rowspan="4" style="border-left:1px solid;text-align:center;vertical-align: top;padding-top:5px;"><?php echo $count++; ?></td>
				<td rowspan="4" style="width:30%;border-left:1px solid;text-align:center;">&nbsp; Mass of the specimen<br>&nbsp; (After every Four Cycle of<br>&nbsp; Abrasion Test)<br>&nbsp; Wt. Noted in (g)<br></td>
				<td style="width:20%;border-left:1px solid;text-align:center;">Cycle 4</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">Cycle 8</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">Cycle 12</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">Cycle 16</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm1'] != '' && $row_select_pipe['lm1'] != 0 && $row_select_pipe['lm1'] != null) {
																			echo $row_select_pipe['lm1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm2'] != '' && $row_select_pipe['lm2'] != 0 && $row_select_pipe['lm2'] != null) {
																			echo $row_select_pipe['lm2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm3'] != '' && $row_select_pipe['lm3'] != 0 && $row_select_pipe['lm3'] != null) {
																			echo $row_select_pipe['lm3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Length of the Specimen after 16 cycle of Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Width of Specimen after 16 cycle of Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Thickness of the specimen after 16 cycle of Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Volume of the specimen after Abrasion test (mm<sup>3</sup>)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Loss in mass after 16 cycle (g)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm1'] != '' && $row_select_pipe['lm1'] != 0 && $row_select_pipe['lm1'] != null) {
																			echo $row_select_pipe['lm1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm2'] != '' && $row_select_pipe['lm2'] != 0 && $row_select_pipe['lm2'] != null) {
																			echo $row_select_pipe['lm2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm3'] != '' && $row_select_pipe['lm3'] != 0 && $row_select_pipe['lm3'] != null) {
																			echo $row_select_pipe['lm3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Loss in volume after 16 cycle in mm<sup>3</sup> = X</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['v1'] != '' && $row_select_pipe['v1'] != 0 && $row_select_pipe['v1'] != null) {
																			echo $row_select_pipe['v1'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['v2'] != '' && $row_select_pipe['v2'] != 0 && $row_select_pipe['v2'] != null) {
																			echo $row_select_pipe['v2'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['v3'] != '' && $row_select_pipe['v3'] != 0 && $row_select_pipe['v3'] != null) {
																			echo $row_select_pipe['v3'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2"	 style="border-left:1px solid;text-align:left;">&nbsp; Abrasion Resistance (X / 5000) in mm </td>
				<td style="border-left:1px solid;text-align:center;"><?php echo ($row_select_pipe['v1'] / 5000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo ($row_select_pipe['v2'] / 5000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo ($row_select_pipe['v3'] / 5000); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; <b>Average =</b> </td>
				<td colspan="3" style="border-left:1px solid;text-align:center;"><b><?php echo substr(((($row_select_pipe['v1'] / 5000) + ($row_select_pipe['v2'] / 5000) + ($row_select_pipe['v3'] / 5000)) / 3), 0, 6); ?></b></td>
			</tr>
		</table>
		<br>		
		<table align="center" width="94%" style="">
			<tr style="font-size:15px;" >
				<td style="text-align:left;"><b>&nbsp; Note : Abrasion Resistance mm<sup>3</sup> per 5000 mm<sup>2</sup> (As Per IS 15658: 2021, Table 3)</td>
			</tr>		
		</table>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amend No.: 01</center></td>
				<td style="width:25%;"><center>Amend Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 4 of 5</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<div class="pagebreak"></div>
		<br>
		<br>
		<?php if ($branch_name == "Nadiad") { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:100px;width:120px;border: 1px solid black;"><center><img src="../images/nadiad.png" style="height:150%;width:70%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format Om Geo Tech Services, Nadiad</b></center>
				</td>
			</tr>
			
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } else { ?>
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><center><img src="../images/manglam.jpg" style="height:95%;width:90%;"></center></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;text-transform:capitalize;">
					<center><b>Laboratory Quality System Format Manglam Consultancy Services, <Span style="text-transform:capitalize;"><?php echo $branch_name; ?></span></b></center>
				</td>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS-007</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;text-transform:uppercase;">
					<center><b>OBSERVATION OF CONCRETE <?php echo $detail_sample; ?></b></center>
				</td>
			</tr>
		</table>
		<?php } ?>
		<br>
		<?php $count = 1 ?>
		<table align="center" width="94%" class="test1" style="border-right:1px solid;border-bottom:1px solid;margin-top:-1px;" Height="67%">
			<tr style="border-top:1px solid;" >
				<td colspan="3" style="border-left:1px solid;text-align:left;"><b>&nbsp; &nbsp; [ B ] &nbsp;  For Wet Measurement</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>Sample-1</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>Sample-2</b></td>
				<td style="border-left:1px solid;text-align:center;"><b>Sample-3</b></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="width:5%;border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="width:53%;border-left:1px solid;text-align:left;">&nbsp; Date / Time Sample put in the Oven</td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm12'] != '' && $row_select_pipe['sm12'] != 0 && $row_select_pipe['sm12'] != null) {
																					echo $row_select_pipe['sm12'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm13'] != '' && $row_select_pipe['sm13'] != 0 && $row_select_pipe['sm13'] != null) {
																					echo $row_select_pipe['sm13'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm14'] != '' && $row_select_pipe['sm14'] != 0 && $row_select_pipe['sm14'] != null) {
																					echo $row_select_pipe['sm14'];
																				} else {
																					echo '-';
																				} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Date / Time Sample taken out from the Oven</td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm12'] != '' && $row_select_pipe['sm12'] != 0 && $row_select_pipe['sm12'] != null) {
																					echo $row_select_pipe['sm12'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm13'] != '' && $row_select_pipe['sm13'] != 0 && $row_select_pipe['sm13'] != null) {
																					echo $row_select_pipe['sm13'];
																				} else {
																					echo '-';
																				} ?></td>
				<td style="width:14%;border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['sm14'] != '' && $row_select_pipe['sm14'] != 0 && $row_select_pipe['sm14'] != null) {
																					echo $row_select_pipe['sm14'];
																				} else {
																					echo '-';
																				} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Length of the Specimen before Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l4'] != '' && $row_select_pipe['l4'] != 0 && $row_select_pipe['l4'] != null) {
																			echo $row_select_pipe['l4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l5'] != '' && $row_select_pipe['l5'] != 0 && $row_select_pipe['l5'] != null) {
																			echo $row_select_pipe['l5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['l6'] != '' && $row_select_pipe['l6'] != 0 && $row_select_pipe['l6'] != null) {
																			echo $row_select_pipe['l6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Width of Specimen before Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['w4'] != '' && $row_select_pipe['w4'] != 0 && $row_select_pipe['w4'] != null) {
																			echo $row_select_pipe['w4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['w5'] != '' && $row_select_pipe['w5'] != 0 && $row_select_pipe['w5'] != null) {
																			echo $row_select_pipe['w5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['w6'] != '' && $row_select_pipe['w6'] != 0 && $row_select_pipe['w6'] != null) {
																			echo $row_select_pipe['w6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Thickness of the specimen before Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Volume of the specimen before Abrasion test (mm<sup>3</sup>)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Mass of the specimen (Before Abrasion Test) (g)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['im4'] != '' && $row_select_pipe['im4'] != 0 && $row_select_pipe['im4'] != null) {
																			echo $row_select_pipe['im4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['im5'] != '' && $row_select_pipe['im5'] != 0 && $row_select_pipe['im5'] != null) {
																			echo $row_select_pipe['im5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['im6'] != '' && $row_select_pipe['im6'] != 0 && $row_select_pipe['im6'] != null) {
																			echo $row_select_pipe['im6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Density of the specimen (g / mm<sup>3</sup>)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['pr4'] != '' && $row_select_pipe['pr4'] != 0 && $row_select_pipe['pr4'] != null) {
																			echo $row_select_pipe['pr4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['pr5'] != '' && $row_select_pipe['pr5'] != 0 && $row_select_pipe['pr5'] != null) {
																			echo $row_select_pipe['pr5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['pr6'] != '' && $row_select_pipe['pr6'] != 0 && $row_select_pipe['pr6'] != null) {
																			echo $row_select_pipe['pr6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td rowspan="4" style="border-left:1px solid;text-align:center;vertical-align: top;padding-top:5px;"><?php echo $count++; ?></td>
				<td rowspan="4" style="width:30%;border-left:1px solid;text-align:center;">&nbsp; Mass of the specimen<br>&nbsp; (After every Four Cycle of<br>&nbsp; Abrasion Test)<br>&nbsp; Wt. Noted in (g)<br></td>
				<td style="width:20%;border-left:1px solid;text-align:center;">Cycle 4</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">Cycle 8</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">Cycle 12</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;">Cycle 16</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm4'] != '' && $row_select_pipe['lm4'] != 0 && $row_select_pipe['lm4'] != null) {
																			echo $row_select_pipe['lm4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm5'] != '' && $row_select_pipe['lm5'] != 0 && $row_select_pipe['lm5'] != null) {
																			echo $row_select_pipe['lm5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm6'] != '' && $row_select_pipe['lm6'] != 0 && $row_select_pipe['lm6'] != null) {
																			echo $row_select_pipe['lm6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Length of the Specimen after 16 cycle of Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Width of Specimen after 16 cycle of Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Thickness of the specimen after 16 cycle of Abrasion test (mm)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Volume of the specimen after Abrasion test (mm<sup>3</sup>)</td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
				<td style="border-left:1px solid;text-align:center;"></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Loss in mass after 16 cycle (g)</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm4'] != '' && $row_select_pipe['lm4'] != 0 && $row_select_pipe['lm4'] != null) {
																			echo $row_select_pipe['lm4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm5'] != '' && $row_select_pipe['lm5'] != 0 && $row_select_pipe['lm5'] != null) {
																			echo $row_select_pipe['lm5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['lm6'] != '' && $row_select_pipe['lm6'] != 0 && $row_select_pipe['lm6'] != null) {
																			echo $row_select_pipe['lm6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; Loss in volume after 16 cycle in mm<sup>3</sup> = X</td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['v4'] != '' && $row_select_pipe['v4'] != 0 && $row_select_pipe['v4'] != null) {
																			echo $row_select_pipe['v4'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['v5'] != '' && $row_select_pipe['v5'] != 0 && $row_select_pipe['v5'] != null) {
																			echo $row_select_pipe['v5'];
																		} else {
																			echo '-';
																		} ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php if ($row_select_pipe['v6'] != '' && $row_select_pipe['v6'] != 0 && $row_select_pipe['v6'] != null) {
																			echo $row_select_pipe['v6'];
																		} else {
																			echo '-';
																		} ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2"	 style="border-left:1px solid;text-align:left;">&nbsp; Abrasion Resistance (X / 5000) in mm </td>
				<td style="border-left:1px solid;text-align:center;"><?php echo ($row_select_pipe['v4'] / 5000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo ($row_select_pipe['v5'] / 5000); ?></td>
				<td style="border-left:1px solid;text-align:center;"><?php echo ($row_select_pipe['v6'] / 5000); ?></td>
			</tr>
			<tr style="border-top:1px solid;" >
				<td style="border-left:1px solid;text-align:center;"><?php echo $count++; ?></td>
				<td colspan="2" style="border-left:1px solid;text-align:left;">&nbsp; <b>Average =</b> </td>
				<td colspan="3" style="border-left:1px solid;text-align:center;"><b><?php echo substr(((($row_select_pipe['v4'] / 5000) + ($row_select_pipe['v5'] / 5000) + ($row_select_pipe['v6'] / 5000)) / 3), 0, 6); ?></b></td>
			</tr>
		</table>
		<br>		
		<table align="center" width="94%" style="">
			<tr style="font-size:15px;" >
				<td colspan="3" style="text-align:left;"><b>&nbsp; Note : Abrasion Resistance mm<sup>3</sup> per 5000 mm<sup>2</sup> (As Per IS 15658: 2021, Table 3)<br><br><br></b></td>
			</tr>
			<tr style="font-size:15px;" >
				<td style="text-align:left;"><b>&nbsp; Tested By: </b></td>
				<td style="text-align:center;"><b>&nbsp; Reviewed By: </b></td>
				<td style="text-align:center;"><b>&nbsp; Witness By: </b></td>
			</tr>
			
		</table>
		<br>
		<br>
		<table align="center" width="94%" class="test1" height="Auto" style="border-top:3px solid;">
			<tr style="padding-top:2px;">
				<td style="width:25%;"><center>Amend No.: 01</center></td>
				<td style="width:25%;"><center>Amend Date: 01.04.2023</center></td>
				<td style="width:16.67%;"><center>Prepared by:</center></td>
				<td style="width:16.67%;"><center>Approved by:</center></td>
				<td style="width:16.67%;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 5 of 5</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
			
		</page> -->

</body>

</html>


<script type="text/javascript">

</script>