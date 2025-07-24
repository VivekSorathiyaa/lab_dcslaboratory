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
		font-family: arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 10px;
		font-family: arial;
	}

	.tdclass1 {

		
		font-family: arial;
	}
</style>
<html>

<body>



	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from rubble WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);	

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn,$select_query);				

	$row_select = mysqli_fetch_array($result_select);
	$clientname= $row_select['clientname'];
	$pmc_heading= $row_select['pmc_name'];

	$client_address= $row_select['clientaddress'];
	$r_name= $row_select['refno'];
	$agreement_no= $row_select['agreement_no'];

	$rec_sample_date= $row_select['sample_rec_date'];	
	$cons= $row_select['condition_of_sample_receved'];			
	if($cons == 0)
	{
	$con_sample = "Sealed";
	}
	else
	{
	$con_sample = "Unsealed";
	}
	$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");							

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
	$row_select1 = mysqli_fetch_assoc($result_select1);
	$agency_name= $row_select1['agency_name'];
	}


	if($row_select["agency_name"] !="")
	{
	$agency_name= $row_select['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
	$row_select2 = mysqli_fetch_assoc($result_select2);
	$start_date= $row_select2['start_date'];
	$end_date= $row_select2['end_date'];
	$issue_date= $row_select2['issue_date'];								
	$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
	$result_select3 = mysqli_query($conn, $select_query3);

	if (mysqli_num_rows($result_select3) > 0) {
	$row_select3 = mysqli_fetch_assoc($result_select3);
	$mt_name= $row_select3['mt_name'];
	}

	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_assoc($result_select4);
	/* $mark= $row_select4['brick_mark'];
	$brick_specification= $row_select4['brick_specification']; */
	$material_location= $row_select4['material_location']; 
	}

	?>




	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
				<tr>
					<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
				</tr>
				<tr>
					<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Rubble</b></td>
				</tr>
			
			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<!-- <?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?> -->
							<?php echo "ULR No.  " . $_GET['ulr']; ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $r_name; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																					$result_selectc = mysqli_query($conn, $select_queryc);

																					if (mysqli_num_rows($result_selectc) > 0) {
																						$row_selectc = mysqli_fetch_assoc($result_selectc);
																						$ct_nm = $row_selectc['city_name'];
																					}
																					echo $clientname; ?>
								</td>
							</tr>
					
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 14px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 14px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"> <?php echo $agreement_no; ?></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Sample Source</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php //if($bs_location!=""){echo $bs_location;}else{echo "-";}
																										?><?php if ($material_location == 1) {
																																												echo "In Laboratory";
																																											} else {
																																												echo "In Field";
																																											} ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<!-- <tr>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family: Cambria;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr> -->

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>
						
					</table>
				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td>
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:15px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr. No.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Name of Test</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Results</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Method</td>
						</tr>
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Water Absorption</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo number_format($row_select_pipe['sp_water_abr'], 2); ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 1124</td>
						</tr>
						<!--<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php// echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Compressive Strength(kg/cm&sup2;)</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo number_format($row_select_pipe['avg_com1'], 2); ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 9143</td>
						</tr-->
						<tr style="">
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Specific Gravity</td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo number_format($row_select_pipe['sp_specific_gravity'], 2); ?></td>
							<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 13030</td>
						</tr>
					</table>

				</td>
			</tr>
		</table>


		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:15px 0px 5px;">
							** End of Report ** 
					</td>																		
				</tr>
		</table>

		<table align="center" width="100%" class="test">
			<tr>
					<td style="text-align:center;font-size:10px;">
						<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
							<tr>
								<td><b>Note :-</b></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
								<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
							</tr>
						</table>
					</td>
			</tr>
		</table>

		<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
							<tr>
								<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
									Doc ID : FMT-TST-28/ Page 1/1
								</td>
							</tr>
		</table>

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
	</page>




	<!--page size="A4">
		<table align="center" width="95%" style="height:auto;font-size:11px;font-family: arial;border:solid black;border-width:2;">
		<tr >
			
			
					<td style="font-size:13px;border:1px solid black;"><center><b>Test Results of Natural Building Stone</b></center></td>
			
		</tr>
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border:1px solid black;">
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Report No.</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $report_no; ?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>Report Date</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Job No.</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $job_no; ?></td>	
					<td style="width:25%">&nbsp;&nbsp;<b>Lab No.</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $lab_no; ?></td>	
				</tr>				
			</table>
			</td>
		</tr>
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border:1px solid black;">
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Name Of Customer</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
														$result_selectc = mysqli_query($conn, $select_queryc);

														if (mysqli_num_rows($result_selectc) > 0) {
															$row_selectc = mysqli_fetch_assoc($result_selectc);
															$ct_nm = $row_selectc['city_name'];
														}
														echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?>
					</td>
					
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Name Of Agency</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%"> &nbsp;&nbsp;<?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
														$result_selectc1 = mysqli_query($conn, $select_queryc1);

														if (mysqli_num_rows($result_selectc1) > 0) {
															$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
															$ct_nm1 = $row_selectc1['city_name'];
														}
														echo $agency_name . " " . $ct_nm1; ?>
					</td>					
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Name Of Work</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%">&nbsp;&nbsp;<?php echo $name_of_work; ?>
					</td>				
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Ref. No & Date</b></td>
					<td style="width:3%">:-</td>
					<td style="width:72%">&nbsp;&nbsp;<?php echo $r_name; ?>
					</td>				
				</tr>
				
								
			</table>
			</td>
		</tr>
		
		
		
		<tr>
			<td>
				<table align="left" width="100%"  border="0px" cellspacing="0" class="test" style="border:1px solid black;">
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Type of Sample</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;Natural Building Stone</td>
					<td style="width:25%">&nbsp;&nbsp;<b>Test Method Standard</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;As Mention below</td>
					
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Date of Sample Received</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>Environmental Condition</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;As per test procedure</td>					
				</tr>
				
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Condition Of Sample On Receipt</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;Sealed ok</td>
					<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>					
				</tr>
				
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Sample Send by</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php if ($row_select['sample_sent_by'] == "0") {
															echo "Customer";
														} else {
															echo "Agency";
														} ?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>					
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Source Of Sample</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php if ($bs_location != "") {
															echo $bs_location;
														} else {
															echo "-";
														} ?></td>
					<td style="width:25%">&nbsp;&nbsp;<b>BH No.</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $bs_bhno; ?></td>				
				</tr>
				<tr>
					<td style="width:25%">&nbsp;&nbsp;<b>Depth</b></td>
					<td style="width:3%">:-</td>
					<td style="width:22%">&nbsp;&nbsp;<?php echo $bs_depth; ?></td>				
					<td style="width:25%">&nbsp;&nbsp;</td>
					<td style="width:3%"></td>
					<td style="width:22%">&nbsp;&nbsp;</td>
				</tr>
				
								
			</table>
			</td>
		</tr>
		
		
		<tr>
			<td style="font-size:13px;border:1px solid black;"><center><b>Test Result</b></center></td>
		</tr>
		<tr>
			<td>
			<table align="center" width="100%" class="test" border="1px" style="height:auto;">
				
				<tr>			
						
						
						<td><center><b>TEST</b></center></td>
						<td><center><b>Test Method</b></center></td>
						<td><center><b>Results Obtained</b></center></td>
						<td><center><b>Units</b></center></td>
						
				</tr>
				
				
				<?php
				if ($row_select_pipe['chk_com'] == 1) {
				?>
				<tr >
					
					<td><center>Compressive Strength</center></td>
					<td><center>IS : 1121 (P-1 ) : 1974 (RA 2017)</center></td>
					<td><center><?php echo number_format($row_select_pipe['avg_comp'], 2); ?></center></td>
					<td><center>kg/cm<sup>2</sup></center></td>
				
				</tr>
				
			
				<?php
				}
				?>
				
				<?php
				if ($row_select_pipe['chk_wtr'] == 1) {
				?>
				<tr >
					<td><center>Water Absorption</center></td>
					<td><center>IS : 1124 : 1974 (RA 2013)</center></td>
					<td><center><?php echo number_format($row_select_pipe['sp_water_abr'], 2); ?></center></td>
					<td ><center>%</center></td>
				
				</tr>
				
				<?php
				}
				?>
				
				<?php
				if ($row_select_pipe['chk_t_sp'] == 1) {
				?>
				<tr >
					<td><center>True Specific Gravity</center></td>
					<td><center>IS : 1122 : 1974 (RA 2017)</center></td>
					<td><center><?php echo number_format($row_select_pipe['avg_true_sp'], 2); ?></center></td>
					<td><center>-</center></td>
				
				</tr>
				
				<?php
				}

				if ($row_select_pipe['chk_sp'] == 1) {
				?>
				<tr >
					<td><center>Apparent Specific Gravity</center></td>
					<td><center>IS : 1124 : 1974 (RA 2013)</center></td>
					<td><center><?php echo number_format($row_select_pipe['avg_app_sp'], 2); ?></center></td>
					<td><center>-</center></td>
				
				</tr>
				
				<?php
				}
				?>
				
				
				
			
			</table>
			</td>
		</tr>
		<tr>
			<td>
			<table align="center" width="100%" class="test" border="1px" style="height:auto;">
			<tr>
					<td style="font-size:13px;">for <b>Span Material Testing & Consultancy Services Limited<br><br><br><br><br><br><br><br><br>Authorised Signatory</b> <span style="padding-right:3px;float:right;">Page :- 1 of 1</span></td>
					
			</tr>
			</table>	
			</td>
		</tr>
		<tr>
			<td>
			<table align="center" width="100%"  border="1px" class="test">
				<tr>
				
			<td style="transform: rotate(270deg);"><center><B>NOTES</B></center></td>
			<td style="padding:5px;"> *   The test result relates to the samples submitted by Customer/Agency.<br>*   The Results / Reports are issued with specific understanding that Span Material Testing & Consultancy Services Limited will not in way be involved in acting following interpretation of the test results.<br> *   The Results / Reports are not supposed to be used for publicity.</td>
				</tr>
			</table>
			</td>
		</tr>
	
		</table>		
	
	
	
		
	
	
	<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">
		
		</page-->

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>