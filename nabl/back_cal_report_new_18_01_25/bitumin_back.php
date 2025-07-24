<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0px 40px;
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
	$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
    //echo $select_tiles_query;
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
	$branch_name = $row_select['branch_name'];
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
		$bitumin_grade = $row_select4['bitumin_grade'];
		$brick_specification = $row_select4['brick_specification'];
	}
	?>



	


	<br>
	<br>
	<br>
	<br>


	<!-- NEW REPORT 1 -->

	<page size="A4">
	
	

		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
			<!-- header design -->
			<?php //if(($row_select_pipe['pen_1'] != "" && $row_select_pipe['pen_1'] != "0" && $row_select_pipe['pen_1'] != null) || ($row_select_pipe['pen_2'] != "" && $row_select_pipe['pen_2'] != "0" && $row_select_pipe['pen_2'] != null) || ($row_select_pipe['pen_3'] != "" && $row_select_pipe['pen_3'] != "0" && $row_select_pipe['pen_3'] != null) || ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != "0" && $row_select_pipe['avg_pen'] != null) || ($row_select_pipe['pen_temp'] != "" && $row_select_pipe['pen_temp'] != "0" && $row_select_pipe['pen_temp'] != null)) { ?>
			<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BITUMEN</td>
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
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">PENETRATION TEST (IS 1203 - 1978 )</td>
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
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="4">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
			<!-- table design -->

			<tr>
				<td>
					<table style="font-size:11px; width:100%; border:1px solid; border-bottom:2px solid;">
					<?php //if (($row_select_pipe['pen_temp'] != "" && $row_select_pipe['pen_temp'] != "0" && $row_select_pipe['pen_temp'] != null)) { ?>
						<tr>
							<td style="width:40%;"><b>Test Temperature :- <u>&nbsp;&nbsp;<?php echo $row_select_pipe['pen_temp']; ?>&nbsp;&nbsp;</u> °C &nbsp; &nbsp; &nbsp; &nbsp;(25.0 ± 0.1°C)</td>
							<td style="text-align:right;padding-right:50px;" colspan="3"><b>Standard Weights :- &nbsp; &nbsp; &nbsp; 
								100 ± 0.25 g / 200 ± 0.25 g</td>
						</tr>
					<?php //} ?>	
						<tr>
						<td style="text-align:right;padding-right:8px;" colspan="3"><b>Standard Time :- &nbsp; &nbsp; &nbsp; 
								5 ± 0.1 S</td>
						</tr>
					<?php //if (($row_select_pipe['pen_1'] != "" && $row_select_pipe['pen_1'] != "0" && $row_select_pipe['pen_1'] != null) || ($row_select_pipe['pen_2'] != "" && $row_select_pipe['pen_2'] != "0" && $row_select_pipe['pen_2'] != null) || ($row_select_pipe['pen_3'] != "" && $row_select_pipe['pen_3'] != "0" && $row_select_pipe['pen_3'] != null)) { ?>	
						<tr>
							<td style="padding-top:15px;"><b>Penetration (1/10 of mm) :- </td>
							<td style="padding-top:15px; "><b>(i) <?php echo $row_select_pipe['pen_1']; ?> mm </td>
							<td style="padding-top:15px; "><b>(ii) <?php echo $row_select_pipe['pen_2']; ?> mm </td>
							<td style="padding-top:15px; "><b>(iii) <?php echo $row_select_pipe['pen_3']; ?> mm </td>
						</tr>
					
			        <?php //} if (($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != "0" && $row_select_pipe['avg_pen'] != null)) { ?>
						<tr>
							<td style="padding-top:5px;padding-bottom:15px; width:25%"><b>Penetration (1/10 of mm) Mean Value:- </td>
							<td style="padding-left:13px; padding-bottom:5px;"><b> <?php echo $row_select_pipe['avg_pen']; ?> mm</td>
						</tr>
					<?php //} ?>
					</table>
				</td>
			</tr>

		<tr>
			<td>
				<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
					<tr>
						<td style="border-right:2px solid; text-align:left; width:5%"><b>Note*:- </td>
					</tr>
					<tr>
						
						<td>
							<table style="font-size:11px;">
								<tr>
									<td style="padding-top:10px;"><b>(i) The Value of Penetration Reported shall be the mean of not less than three determonations whose Value do not differ more than the amount given below.</td>
								</tr>
								<tr>
									<td>
									<table align="center" width="50%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;">
									<tr>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> Penetration </td>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> Maximum Difference </td>
									</tr>
									<tr>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 0 to 49 </td>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 2 </td>
									</tr>
									<tr>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 50 to 149 </td>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 4 </td>
									</tr>
									<tr>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 150 to 249 </td>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 6 </td>
									</tr>
									<tr>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 250 and above </td>
									<td style="font-weight: bold;padding: 2px;border:2px solid;text-align:center"><b> 8 </td>
									</tr>
									</table>
									</td>
								</tr>
								<tr>
									<td style="padding-top:10px;"><b>(ii) The Duplicate Test Result should not be differ by more than the following.</td>
								</tr>
								<tr>
									<td>
										<table align="center" width="80%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; margin-bottom:15px;">
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center"><b> Penetration </td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%; border:2px solid;  text-align:center;"><b>Repeatability</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center;"><b>Reproducibility</td>

											</tr>
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center;">
													<b>Below 50
												</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center"><b>1 Unit</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center;"><b>4 Units</td>
											</tr>
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center;">
													<b>Above 50</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center"><b>3 Percent of their Mean</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 0%;border:2px solid;  text-align:center;"><b>8 Percent of their Mean</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>	
				</table>
			</td>
		</tr>
		
		<?php //} if (($row_select_pipe['spe_temp'] != "" && $row_select_pipe['spe_temp'] != "0" && $row_select_pipe['spe_temp'] != null) || ($row_select_pipe['sp_a_1'] != "" && $row_select_pipe['sp_a_1'] != "0" && $row_select_pipe['sp_a_1'] != null) || ($row_select_pipe['sp_b_1'] != "" && $row_select_pipe['sp_b_1'] != "0" && $row_select_pipe['sp_b_1'] != null) || ($row_select_pipe['sp_c_1'] != "" && $row_select_pipe['sp_c_1'] != "0" && $row_select_pipe['sp_c_1'] != null) || ($row_select_pipe['sp_d_1'] != "" && $row_select_pipe['sp_d_1'] != "0" && $row_select_pipe['sp_d_1'] != null) || ($row_select_pipe['sp_1'] != "" && $row_select_pipe['sp_1'] != "0" && $row_select_pipe['sp_1'] != null) || ($row_select_pipe['sp_a_2'] != "" && $row_select_pipe['sp_a_2'] != "0" && $row_select_pipe['sp_a_2'] != null) || ($row_select_pipe['sp_b_2'] != "" && $row_select_pipe['sp_b_2'] != "0" && $row_select_pipe['sp_b_2'] != null) || ($row_select_pipe['sp_c_2'] != "" && $row_select_pipe['sp_c_2'] != "0" && $row_select_pipe['sp_c_2'] != null) || ($row_select_pipe['sp_d_2'] != "" && $row_select_pipe['sp_d_2'] != "0" && $row_select_pipe['sp_d_2'] != null) || ($row_select_pipe['sp_2'] != "" && $row_select_pipe['sp_2'] != "0" && $row_select_pipe['sp_2'] != null) || ($row_select_pipe['avg_sp'] != "" && $row_select_pipe['avg_sp'] != "0" && $row_select_pipe['avg_sp'] != null)) { ?>
		
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						<tr>
							<td style="padding: 1px;border: 1px solid;"></td>
						</tr>
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">SPACIFIC GRAVITY TEST (IS 1202 - 1978)</td>
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
							<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Observation Table</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
						</tr>
						<tr>
							<td style="width:40%;"><b>Test Temperature :- <u>&nbsp;&nbsp;<?php echo $row_select_pipe['sp_temp']; ?>&nbsp;&nbsp;</u> °C &nbsp; &nbsp; &nbsp; &nbsp;(27.0 ± 0.1°C)</td>
						</tr>
						<!-- <tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr> -->
					</table>
				</td>
			</tr>


			<tr>
				<td>
					<table style="font-size:11px; border-bottom:1px solid; width:100%; border-left:1px solid; border-right:1px solid;">
						

			<tr>
			<td>
		
		<table align="center" width="80%"  style="font-size:11px;height:auto; font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;border-bottom: 2px solid; border-top:2px solid; margin-top:5px;">
			<tr>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;" rowspan="3">Sr. No.</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">Mass of bottle + Stopper Weight</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">Mass of bottle + Stopper +<br> Water Weight</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">Mass of bottle+ Stopper +<br> Sample Weight</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">Mass of bottle + Stopper + Sample +<br> Water Weight</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">Specific gravity</td>
             </tr>
             <tr>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">a</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">b</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">c</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;">d</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid; width:20%"> (c-a) / ((b-a)-(d-c)) </td>
                 </tr>
             <tr>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">gm</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">gm</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">gm</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">gm</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">--</td>
                 </tr>
             <tr>
                 <td style="text-align: center;font-weight:bold; border:1px solid;">1</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_a_1']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_b_1']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_c_1']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_d_1']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_1']; ?></td>
             </tr>     
             <!--<tr>
                 <td style="text-align: center;font-weight:bold; border:1px solid;">2</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_a_2']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_b_2']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_c_2']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_d_2']; ?></td>
                 <td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['sp_2']; ?></td>
             </tr>-->
             <tr>
                 <td style="text-align: center; font-weight:bold; border:1px solid; text-align: end; border-top:2px solid;" colspan="5">Mean Value</td>
                 <td style="text-align: center; font-weight:bold; border:1px solid; border-top:2px solid;"><?php echo $row_select_pipe['avg_sp']; ?></td>
             </tr>
		</table>
		<tr>
			<td style="padding:5px"></td>
		</tr>
		</td>
		</tr>
					</table>
				</td>
			</tr>
		</table>
		<tr>
			<td>
				<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;text-align:center;">
					<tr>
						
						<td style="text-align:center;">
							<table style="font-size:11px;text-align:center;" align="center">
								<tr>
									<td style="padding-top:0px;"><b>The Duplicate Test Result should not be differ by more than the following.</td>
								</tr>
								<tr>
									<td>
										<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;">
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%; border:2px solid;  text-align:center;"><b>Repeatability</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>Reproducibility</td>

											</tr>
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;border:2px solid;  text-align:center;"><b>0.002</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;border:2px solid;  text-align:center; "><b>0.005</td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							<tr><td style=" height:60px;border-top:2px solid; width:100%;" colspan="2"></td></tr>
						</td>
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
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php //echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			
			
			</table>
                </td>
            </tr>
            
       </table>


	</page>



	<?php //} if (($row_select_pipe['abs_9_1'] != "" && $row_select_pipe['abs_9_1'] != "0" && $row_select_pipe['abs_9_1'] != null) || ($row_select_pipe['abs_9_2'] != "" && $row_select_pipe['abs_9_2'] != "0" && $row_select_pipe['abs_9_2'] != null) || ($row_select_pipe['abs_9_3'] != "" && $row_select_pipe['abs_9_3'] != "0" && $row_select_pipe['abs_9_3'] != null) || ($row_select_pipe['avg_abs'] != "" && $row_select_pipe['avg_abs'] != "0" && $row_select_pipe['avg_abs'] != null) || ($row_select_pipe['avg_kin_1'] != "" && $row_select_pipe['avg_kin_1'] != "0" && $row_select_pipe['avg_kin_1'] != null) || ($row_select_pipe['avg_kin_2'] != "" && $row_select_pipe['avg_kin_2'] != "0" && $row_select_pipe['avg_kin_2'] != null) || ($row_select_pipe['avg_kin_3'] != "" && $row_select_pipe['avg_kin_3'] != "0" && $row_select_pipe['avg_kin_3'] != null)) {  ?> 
	
	
	<div class="pagebreak"></div>
	<br>
	<br>

	<center>

	<!-- NEW REPORT 3 -->

	<page size="A4">
		<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BITUMEN</td>
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
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">ABSOLUTE VISCOSITY TEST (IS: 1206 (Part-2) 2022)</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Observation Table</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
							</tr>
						</table>
					</td>
				</tr>
				<!-- table design -->
				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; border-left: 2px solid;border-right: 2px solid;">
				<tr>
				<td style="border-left: 0; font-weight:bold;border-right: 0; padding-top:5px; padding-bottom: 30px">Test Temperature:- &nbsp;<?php echo "60.1"; ?> &deg;C <span>&nbsp; &nbsp; &nbsp; &nbsp; (60.0 &deg;c)</span></td>
				<td style="text-align: center; border-right: 0; font-weight:bold; border-left: 0; padding-top:5px; padding-bottom: 30px">Vaccum:-30 cm Hg</td>
				</tr>
			</table>
			<tr>
				<td>
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;border-bottom: 1px solid; border-top:2px solid;">
			
			<table align="center" width="100%"  style="font-size:11px;height:auto; font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;border-bottom: 1px solid; border-top:2px solid;">
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;" rowspan="3">Sr. No.</td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">Time Required by<br> Bitumin to cross<br> the bulb-B mark</td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">Calibration Constant<br> for Bulb-B</td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">Time Required by<br> Bitumin to cross<br> the Bulb-C mark</td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">Calibration Constant<br> for Bulb-C</td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">Absolute Viscosity</td>
				</tr>
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid;">t<sub>1</sub></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">K<sub>1</sub></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">t<sub>2</sub></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">K<sub>2</sub></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;">V = (K<sub>1</sub>*t<sub>1</sub>+K<sub>2</sub>*t<sub>2</sub>) / 2</td>
					</tr>
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">Sec</td>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">Poises/Sec</td>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">Sec</td>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">Poises/Sec</td>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">Poises</td>
					</tr>
				<?php //if (($row_select_pipe['abs_9_1'] != "" && $row_select_pipe['abs_9_1'] != "0" && $row_select_pipe['abs_9_1'] != null)) {  ?> 
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_sr_1']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_4_1']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_3_1']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_7_1']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_6_1']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_9_1']; ?></td>
				</tr>   
               <?php //} if (($row_select_pipe['abs_9_2'] != "" && $row_select_pipe['abs_9_2'] != "0" && $row_select_pipe['abs_9_2'] != null)) {  ?> 				
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_sr_2']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_4_2']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_3_2']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_7_2']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_6_2']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_9_2']; ?></td>
				</tr>
				<?php //} if (($row_select_pipe['abs_9_3'] != "" && $row_select_pipe['abs_9_3'] != "0" && $row_select_pipe['abs_9_3'] != null)) {  ?> 
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_sr_3']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_4_3']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_3_3']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_7_3']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_6_3']; ?></td>
					<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['abs_9_3']; ?></td>
				</tr>
				<?php //} if (($row_select_pipe['avg_abs'] != "" && $row_select_pipe['avg_abs'] != "0" && $row_select_pipe['avg_abs'] != null)) {  ?> 
				<tr>
					<td style="text-align: center; font-weight:bold; border:1px solid; text-align: end; border-top:2px solid;" colspan="5">Mean Value</td>
					<td style="text-align: center; font-weight:bold; border:1px solid; border-top:2px solid;"><?php echo $row_select_pipe['avg_abs']; ?></td>
				</tr>
				<tr>
					<td style="border:2px solid; height:15px;" colspan="6"></td>
				</tr>
				<?php //} ?>
			</table>
			<tr>
				<td>
				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; border-left: 2px solid;border-right: 2px solid; border-bottom: 1px solid;">
				<tr>
					<td style=" font-weight:bold; border-right:2px solid;text-align:center">*The Duplicate Result Should Not Differ by More than the following.</td>
				</tr>
				<tr>
					<td>
				
					
					<table  width="50%" align="center"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
					<tr>
					<td style=" text-align:center;font-weight:bold; border-left:0px solid; border-top:1px solid; border-right:1px solid; border-bottom:1px solid;border-left:1px solid;">Repeatability</td>
					<td style=" text-align:center;font-weight:bold; border-right:0px solid;  border-top:1px solid; border-right:1px solid; border-bottom:1px solid;border-left:1px solid;">7 percent of the mean</td>
					</tr>
					<tr>
					<td style=" text-align:center;font-weight:bold; border-right:0px solid; border-top:1px solid; border-right:1px solid;border-left:1px solid;">Reproducibility</td>
					<td style=" text-align:center;font-weight:bold; border-right:0px solid;  border-top:1px solid; border-right:1px solid;border-left:1px solid;">10 percent of the mean</td>
					</tr>
					</td>
				</tr>
			</table>
				</td>
			</tr>
			</table>
			</td>
			</tr>
			
			<?php  //if (($row_select_pipe['avg_kin_1'] != "" && $row_select_pipe['avg_kin_1'] != "0" && $row_select_pipe['avg_kin_1'] != null) || ($row_select_pipe['avg_kin_2'] != "" && $row_select_pipe['avg_kin_2'] != "0" && $row_select_pipe['avg_kin_2'] != null) || ($row_select_pipe['avg_kin_3'] != "" && $row_select_pipe['avg_kin_3'] != "0" && $row_select_pipe['avg_kin_3'] != null)) {  ?> 
			


				<tr>
				<td>
							<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; border-left:2px solid; border-right:2px solid;">
								<tr>
									<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 2px;border: 1px solid; border-right:1px solid; border-left:1px solid; opacity: 0;">B</td>
								</tr>
								<tr>
									<td style="padding: 1px;border: 1px solid;"></td>
								</tr>
								<tr>
									<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">KINEMATIC VISCOSITY TEST (IS: 1206 (Part-3) 2021)</td>
								</tr>
								<tr>
									<td style="padding: 1px;border: 1px solid;"></td>
								</tr>
							</table>
						</td>
					</tr>
					<tr>
						<td>
							<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; ">
								<tr>
									<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Observation Table</td>
								</tr>
								<tr>
									<td style="padding: 1px;border: 1px solid;" colspan="2"></td>
								</tr>
							</table>
						</td>
					</tr>
					<!-- table design -->
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; border-left: 2px solid;border-right: 2px solid;">
					<tr>
					<td style="border-left: 0; font-weight:bold;border-right: 0; padding-top:5px; padding-bottom: 13px">Test Temperature:- &nbsp; <?php echo "135.0"; ?> &deg;C </td>
					</tr>
					
				</table>
				<tr>
					<td>
				<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;border-bottom: 1px solid; border-top:2px solid;">
				
				<table align="center" width="100%"  style="font-size:11px;height:auto; font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;border-bottom: 1px solid; border-top:2px solid; ">
				<tr>
						<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;" rowspan="3">Sr. No.</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;">Time Required by Bitumin to cross<br> the bulb-C mark</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;">Calibration Constant<br> for Bulb-C</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;">KINEMATIC Viscosity</td>
					</tr>
					<tr>
						<td style="text-align: center; font-weight:bold; border:1px solid;">t</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;">C</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;">V = K * t</td>

						</tr>
					<tr>
						<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">Sec</td>
						<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">cSt/Sec</td>
						<td style="text-align: center; font-weight:bold; border:1px solid; border-bottom:2px solid;">cSt</td>
						
						</tr>
					<tr>
						<td style="text-align: center;font-weight:bold; border:1px solid;">1</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['kin_5_1']; ?></td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['kin_6_1']; ?></td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php echo $row_select_pipe['avg_kin']; ?></td>
					
					</tr>     
					<!--<tr>
						<td style="text-align: center;font-weight:bold; border:1px solid;">2</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php //echo $row_select_pipe['kin_5_2']; ?></td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php //echo $row_select_pipe['kin_6_2']; ?></td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php //echo $row_select_pipe['avg_kin_2']; ?></td>
						
					</tr>
					<tr>
						<td style="text-align: center;font-weight:bold; border:1px solid;">3</td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php //echo $row_select_pipe['kin_5_3']; ?></td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php //echo $row_select_pipe['kin_6_3']; ?></td>
						<td style="text-align: center; font-weight:bold; border:1px solid;"><?php //echo $row_select_pipe['avg_kin_3']; ?></td>
					</tr-->
					<tr>
						<td style="text-align: center; font-weight:bold; border:1px solid; text-align: end; border-top:2px solid;" colspan="3">Mean Value</td>
						<td style="text-align: center; font-weight:bold; border:1px solid; border-top:2px solid;"><?php echo $row_select_pipe['avg_kin']; ?></td>
					</tr>
					<tr>
						<td style="border:2px solid; height:15px;" colspan="6"></td>
					</tr>
				</table>
				<tr>
					<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; border-left: 2px solid;border-right: 2px solid; border-bottom: 1px solid;">
					<tr>
					<td style=" font-weight:bold; border-right:2px solid;text-align:center">* The Duplicate Result Should Not Differ by More than the following.
					</tr>
					<tr>
						<td>
						
						
						<table  width="50%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;" align="center">
						<tr>
						<td style=" text-align:center;font-weight:bold; border-left:0px solid; border-top:1px solid; border-right:1px solid; border-bottom:1px solid;border-left:1px solid;">Repeatability</td>
						<td style=" text-align:center;font-weight:bold; border-right:0px solid;  border-top:1px solid; border-right:1px solid; border-bottom:1px solid;border-left:1px solid;">1.8 percent of the mean</td>
						</tr>
						<tr>
						<td style=" text-align:center;font-weight:bold; border-right:0px solid; border-top:1px solid; border-right:1px solid;border-left:1px solid;">Reproducibility</td>
						<td style=" text-align:center;font-weight:bold; border-right:0px solid;  border-top:1px solid; border-right:1px solid;border-left:1px solid;">8.8 percent of the mean</td>
						</tr>
				</table>
					</td>
				</tr>
				</table>
			</td>
			</tr>		
				</td>
			</tr>
		</table>
		
		 <!-- FOOTER DESIGN -->
						
                </td>
				
			<?php //} ?>		
				
            </tr>
			<tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php //echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			
			
			</table>
                </td>
            </tr>
            
        </table>	
	</page>
	
	
	<?php //} if (($row_select_pipe['sof_att'] != "" && $row_select_pipe['sof_att'] != "0" && $row_select_pipe['sof_att'] != null) || ($row_select_pipe['sof_rrt'] != "" && $row_select_pipe['sof_rrt'] != "0" && $row_select_pipe['sof_rrt'] != null) || ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != "0" && $row_select_pipe['avg_sof'] != null)) {  ?> 

	<div class="pagebreak"></div>
	<br>
	<br>
	<br>


	<!-- NEW REPORT 4 -->

	<page size="A4">
			
	<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border: 1px solid;padding: 0;border-collapse: collapse;">
				<!-- header design -->
				
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: REE/N/OS/001</td>
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
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BITUMEN</td>
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
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
							
							<tr>
								<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">SOFTENING POINT TEST (IS : 1205 : 2022)</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<!-- table design -->
				<?php $cnt=1; ?>
				<tr>
					<td>
					<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
					<tr>
					<td style="width:40%; padding-top:10px;"><b>Test Temperature :- &nbsp; <?php echo $row_select_pipe["sof_temp"] ?> °C &nbsp; &nbsp; &nbsp; &nbsp; 
					(5.0 ± 0.5°C)</td>
					<td style="text-align:right; padding-right:80px; padding-top:10px;"><b>Rate of Rise Temperature :- 5 ± 0.5°C</td>	
					</tr>
					<tr>
							<td colspan="2" style="font-weight:bold; padding:10px; width:51%">1. Softening Point :&nbsp; &nbsp; <?php echo $row_select_pipe["sof_0"] ?> °C</td>
							
						</tr>
						<tr>
							<td colspan="2" style="font-weight:bold; padding:10px; width:51%">2. Softening Point :&nbsp; &nbsp; <?php echo $row_select_pipe["sof_1"] ?> °C</td>
							
						</tr>
					<tr>
							<td colspan="2" style="font-weight:bold; padding:10px; width:51%">Average of Test Temperature :- &nbsp; &nbsp; <?php echo $row_select_pipe["avg_sof"] ?> °C</td>
							
						</tr>
						
					</table>
					
						
			<table align="center" width="100%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;border-left:2px solid; border-right:2px solid; border-top:1px solid;padding: 0;border-collapse: collapse;">
					<tr>
						<td style="border-right:2px solid; text-align:left; width:60px;"><b>Note*:- </td>
						</tr>
						<tr>
						<td>
							<table style="font-size:11px;" align="center">
								<tr style="text-align:left;">
									<td style="text-align:left;"><b>The Result shall not be differ from the mean by more than the following.</td>
								</tr>
								<tr>
									<td style="text-align:center">
										<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid; border-bottom:1px solid; text-align:center">
											<tr>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center "><b> Softening Point °C </b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%; border:2px solid;  text-align:center;"><b> Repeatability &deg;C</b> </td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>Reproducibility &deg;C</b></td>

											</tr>
											<tr>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b> 40 to 60</b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b> 1.0 </b></td>
												<td style="font-weight: bold;text-align: lcentereft;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b> 5.5</b> </td>
											</tr>
											<tr>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>61 to 80</b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b> 1.5 </b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b> 5.5 </b></td>
											</tr>
											<tr>
											<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>81 to 100</b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b> 2.0 </b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b> 5.5</b> </td>
											</tr>
											<tr>
											<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>101 to 120</b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b> 2.5</b> </td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b> 5.5</b> </td>
											</tr>
											<tr>
											<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center; border-bottom: 0px;"><b>121 to 140</b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center; border-bottom: 0px;"><b> 3.0 </b></td>
												<td style="font-weight: bold;text-align: center;padding: 2px;width: 50%;border:2px solid;  text-align:center; border-bottom: 0px;"><b> 5.5 </b></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
						</td>
					</tr>

				</table>
			</td>
		</tr>

		<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">DUCTILITY TEST (IS : 1208 (Part-1) 2023)</td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 0;width: 8%;" colspan="2">Observation Table</td>
						</tr>
						
					</table>
				</td>
			</tr>
			<!-- table design -->

			<tr>
				<td>
					<table style="font-size:11px; width:100%; border:1px solid; border-bottom:2px solid;">
						<tr>
							<td style="width:40%;"><b>Test Temperature :- <?php echo $row_select_pipe["duc_temp"] ?> °C &nbsp; &nbsp; &nbsp; &nbsp;(25.0 ± 0.5°C)</td>
							<td style="text-align:right;padding-right:50px;" colspan="3"><b>Rate of Pull:- &nbsp; &nbsp; &nbsp; 50 ± 2.5 mm / min</td>
						</tr>
						<tr>
							<td style="padding-top:20px;"><b>Ductility Value:- </td>
							<td style="padding-top:20px; "><b>(i) <?php echo $row_select_pipe["duc_1"] ?> cm </td>
							<td style="padding-top:20px; "><b>(ii) <?php echo $row_select_pipe["duc_2"] ?> cm </td>
							<td style="padding-top:20px; "><b>(iii) <?php echo $row_select_pipe["duc_3"] ?> cm </td>

						</tr>
						<tr>
							<td style="padding-top:5px;padding-bottom:20px; width:25%"><b>Ductility Mean Value:- </td>
							<td style="padding-left:13px; padding-bottom:5px;"><b> <?php echo $row_select_pipe["avg_duc"] ?> cm</td>
						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td style="border-right:2px solid;">
					<table style="font-size:11px; font-family : Calibri; border-left:1px solid;">
						<tr>
							<td rowspan="" style="border-right:2px solid; text-align:center; width:15%"><b>Note*:-</td>
							<td style="width:85%;"><b>The Duplicate Result Should not differ by more than the following.

									<table style="font-size:11px; font-family : Calibri; border:2px solid; width:100%; border-collapse:collapse; margin-left:30px;margin-bottom:15px;margin-top:5px;">
										<tr>
											<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%; border:2px solid;  text-align:center;"><b>Repeatability</td>
											<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>10 percent of the Mean</td>
										</tr>
										<tr>
											<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;">Reproducibility</td>
											<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;">20 percent of the Mean</td>
										</tr>
									</table>
							</td>
							</tr>
					</table>
				</td>
			</tr>		
				 <!-- footer design -->
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;">
						
						<tr>
							<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 2px;text-transform: uppercase;border: 1px solid;">FLASH & FIRE POINT TEST (IS: 1209: 2021)</td>
						</tr>
						
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
						
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center;padding: 2px;border-top: 1;width: 8%;" colspan="2">Observation Table</td>
						</tr>
						
					</table>
				</td>
			</tr>


			<tr>
				<td>
					<table style="font-size:11px; border-bottom:1px solid; width:100%; border-left:1px solid; border-right:1px solid;">
						<tr>
							<td style="text-align:left; width:30%" colspan=""><b>1. Flash Point :- &nbsp; &nbsp; &nbsp; °C</td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>
		<tr>
			<td>
				<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid;border-bottom: 2px solid;">
					<tr>
						
						<td>
							<table style="font-size:11px;">
								<tr>
									<td style="padding-top:10px;"><b>(i) The Bluish Halo that sometimes Surrounds the test flame shall not be Confused with the the True Flash.</b></td>
								</tr>
								<tr>
									<td style="padding-top:30px;"><b>(ii) The Duplicate Test Result should not be differ by more than the following</b></td>
								</tr>
								<tr>
									<td>
										<table align="center" width="100%" style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 2px solid;border-right: 2px solid; margin-bottom:15px;">
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b> Flash Point</b></td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%; border:2px solid;  text-align:center;"><b>Repeatability</b></td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>Reproducibility</b></td>

											</tr>
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;">
													<b>Below 104°C
												</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b>2°C</b></td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;"><b>3.5°C</b></td>
											</tr>
											<tr>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center;">
													<b>Above 104°C
												</td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center"><b>5.5°C</b></td>
												<td style="font-weight: bold;text-align: left;padding: 2px;width: 50%;border:2px solid;  text-align:center; "><b>8.5°C</b></td>
											</tr>
										</table>
									</td>
								</tr>
							</table>
							
						</td>
					</tr>

				</table>
			</td>
		</tr>
				
			<tr>
                <td>
                    <table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php //echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border: 0px solid;">Checked By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding:5px;width: 12%;border: 0px solid;">Tested By :-</td>
				<td style="padding: 5px;border: 0px solid;"></td>
			</tr>
			
			
			</table>
                </td>
            </tr>	
				
			</table>
			</page>

		
	</page>
	 <?php //} ?>

	


</body>

</html>

<script type="text/javascript">


</script>