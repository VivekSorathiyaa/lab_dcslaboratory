<?php
session_start();
include("../connection.php");
include("function_calling.php");
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
		font-size: 10px;
		font-family : Calibri;
	}

	.tdclass1 {

		
		font-family : Calibri;
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
	include_once 'sample_id.php';
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
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - Rubble</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_namemt_name; ?> 	</td>
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
					<!-- <tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $source; ?></td>
					</tr> -->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>

			<?php $cnt = 1; ?>
			<tr>
				<td>
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:0px solid; border-top:0px solid; border-right:2px solid; border-left:1px solid;">

						<tr style="">
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr. No.</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Name of Test</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Results</td>
							<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Test Method</td>
						</tr>
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Water Absorption</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo number_format($row_select_pipe['sp_water_abr'], 2); ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 1124</td>
						</tr>
						<!--<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php// echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Compressive Strength(kg/cm&sup2;)</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo number_format($row_select_pipe['avg_com1'], 2); ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 9143</td>
						</tr-->
						<tr style="">
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Specific Gravity</td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo number_format($row_select_pipe['sp_specific_gravity'], 2); ?></td>
							<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS : 13030</td>
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




	<!--page size="A4">
		<table align="center" width="95%" style="height:auto;font-size:11px;font-family : Calibri;border:solid black;border-width:2;">
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
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
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
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
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
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>					
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
					<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>					
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
					<td><center>IS : 1121 (P-1 ) : 1974 </center></td>
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
					<td><center>IS : 1122 : 1974 </center></td>
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