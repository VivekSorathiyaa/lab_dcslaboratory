<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
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
	$select_tiles_query = "select * from granite_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$client_city = $row_select6['city_name'];
	$client_address = $row_select['clientaddress'];
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

	//$select_query1 = "select * from agency_master where `isdeleted`=0,city WHERE city.id = agency_master.agency_city AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
		$agency_address = $row_select1['agency_address'];
		$agency_city = $row_select1['city_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$bs_location = $row_select4['bs_location'];
		$bs_depth = $row_select4['bs_depth'];
		$bs_bhno = $row_select4['bs_bhno'];
	}


	?>



	<?php
	// $job_no = $_GET['job_no'];
	// $lab_no = $_GET['lab_no'];
	// $report_no = $_GET['report_no'];
	// $trf_no = $_GET['trf_no'];
	// $select_tiles_query = "select * from span_building_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	// $result_tiles_select = mysqli_query($conn, $select_tiles_query);
	// $row_select_pipe = mysqli_fetch_array($result_tiles_select);	

	// $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	// $result_select = mysqli_query($conn,$select_query);				

	// $row_select = mysqli_fetch_array($result_select);
	// $clientname= $row_select['clientname'];
	// $pmc_heading= $row_select['pmc_name'];

	// $client_address= $row_select['clientaddress'];
	// $r_name= $row_select['refno'];
	// $agreement_no= $row_select['agreement_no'];

	// $rec_sample_date= $row_select['sample_rec_date'];	
	// $cons= $row_select['condition_of_sample_receved'];			
	// if($cons == 0)
	// {
	// $con_sample = "Sealed";
	// }
	// else
	// {
	// $con_sample = "Unsealed";
	// }
	// $name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");							

	// $select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	// $result_select1 = mysqli_query($conn, $select_query1);

	// if (mysqli_num_rows($result_select1) > 0) {
	// $row_select1 = mysqli_fetch_assoc($result_select1);
	// $agency_name= $row_select1['agency_name'];
	// }


	// if($row_select["agency_name"] !="")
	// {
	// $agency_name= $row_select['agency_name'];
	// }

	// $select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	// $result_select2 = mysqli_query($conn, $select_query2);

	// if (mysqli_num_rows($result_select2) > 0) {
	// $row_select2 = mysqli_fetch_assoc($result_select2);
	// $start_date= $row_select2['start_date'];
	// $end_date= $row_select2['end_date'];
	// $issue_date= $row_select2['issue_date'];								
	// $select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
	// $result_select3 = mysqli_query($conn, $select_query3);

	// if (mysqli_num_rows($result_select3) > 0) {
	// $row_select3 = mysqli_fetch_assoc($result_select3);
	// $mt_name= $row_select3['mt_name'];
	// }

	// }

	// $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	// $result_select4 = mysqli_query($conn, $select_query4);

	// if (mysqli_num_rows($result_select4) > 0) {
	// $row_select4 = mysqli_fetch_assoc($result_select4);
	// /* $mark= $row_select4['brick_mark'];
	// $brick_specification= $row_select4['brick_specification']; */
	// $material_location= $row_select4['material_location']; 
	// }


	?>




	<br>
	<br>



	<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Cambria;margin-left:35px;">
			<tr>
				<td style="text-align:center; font-size:22px;padding-bottom:15px; "><b><u>TEST REPORT OF GRANITE</u></b></td>
			</tr>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;">

						<tr style="">

							<td style="border-left: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Authority</td>
							<td style="border-left: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																										$result_selectc = mysqli_query($conn, $select_queryc);

																										if (mysqli_num_rows($result_selectc) > 0) {
																											$row_selectc = mysqli_fetch_assoc($result_selectc);
																											$ct_nm = $row_selectc['city_name'];
																										}
																										echo $clientname; ?></td>
							<td style="border-left: 1px solid black;width:11%; font-weight:bold;">&nbsp; Project No.</td>
							<td style="border-left: 1px solid black;border-right: 1px solid;width:21%;">&nbsp; <?php echo $agreement_no; ?><?php echo $r_name; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Name Of Work</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php echo $name_of_work; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Report No.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid;">&nbsp; <?php echo $report_no; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Consultant</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php echo $row_select['pmc_name']; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Sample Cond.</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp; <?php echo $con_sample; ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Agency</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php echo $agency_name; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Report Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%;border-right: 1px solid; ">&nbsp; <?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr style="">

							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp; Receive Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:left; ">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:11%;font-weight:bold; ">&nbsp; Testing Date</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:21%; border-right: 1px solid;">&nbsp; <?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr>


					</table><br>

				</td>
			</tr>


			<tr>
				<td style="text-align:center;font-size:12px; ">

					<table align="left" width="61.6%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:32%;font-weight:bold; text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp; Material Source</td>
							<td style="border-left: 1px solid black;width:68%;text-align:left; ">&nbsp; <?php //if($bs_location!=""){echo $bs_location;}else{echo "-";}
																										?><?php if ($material_location == 1) {
																																												echo "In Laboratory";
																																											} else {
																																												echo "In Field";
																																											} ?></td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:32%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp; No.of Sample</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:68%;text-align:left; ">&nbsp; 1</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:32%;font-weight:bold;text-align:left;padding-bottom:2px;padding-top:2px;  ">&nbsp; Test Method Adopted</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:68%;text-align:left; ">&nbsp; IS : 1121 - 1974t</td>
						</tr>

					</table>

				</td>
			</tr>

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:13px; ">

					<br>
					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Cambria;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:11%;font-weight:bold; text-align:center;  ">Sr.No.</td>
							<td style="border-left: 1px solid black;width:40%;text-align:center;font-weight:bold; padding-bottom:5px;padding-top:5px;">Test Parameter</td>
							<td style="border-left: 1px solid black;width:23%;text-align:center;font-weight:bold; ">Results</td>
							<td style="border-left: 1px solid black;width:26%;text-align:center;font-weight:bold;padding-bottom:5px;padding-top:5px; ">Specification <br>IS 3316(1974)</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:11%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:center; font-weight:bold;">Compressive Strength(kg/cm&sup2;)</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:23%;text-align:center; font-weight:bold;padding-bottom:10px;padding-top:10px; "><?php echo number_format($row_select_pipe['avg_com1'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:26%;text-align:center;font-weight:bold; ">Min.1000 kg/cm&sup2;</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:11%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:center; font-weight:bold;">Specific Gravity</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:23%;text-align:center; font-weight:bold;padding-bottom:10px;padding-top:10px; "><?php echo number_format($row_select_pipe['avg_spg'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:26%;text-align:center;font-weight:bold; ">Min.2.6</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:11%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:40%;text-align:center; font-weight:bold;">Water Absorption</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:23%;text-align:center; font-weight:bold;padding-bottom:10px;padding-top:10px; "><?php echo number_format($row_select_pipe['avg_wtr'], 2); ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:26%;text-align:center;font-weight:bold; ">Max.0.5%</td>
						</tr>

					</table>

				</td>
			</tr>



			<tr>
				<td style="text-align:center; "><br>
					<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;font-size:14px;		 ">
						<tr>
							<td><b>Note :-</b></td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b>Test rcsults are related to samples submitted by customers only.</td>
						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test results are issued wilh specifïc understanding that GEC will not in any case be involved in action Following the information of the test results.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> The Test reports are not supposed to be used for publicity.</td>

						</tr>
						<tr>
							<td><b> > &nbsp;</b> Test report shall not be reproduced except in full Without written approvaI of GEC.</td>

						</tr>
					</table>
				</td>
			</tr>

			<tr>
				<td style="text-align:right;font-size:11px;padding-right:80px; "><br><br><br><br><br><br>
					<table align="right" width="80%" class="test" style="height:auto;font-family: Cambria; ">
						<tr>
							<td style="text-align:right"><b>Approved By<br><br></b></td>
						</tr>
						<tr>
							<td style="text-align:right"><b>For, Goma Engineering Consultancy,</b></td>
						</tr>

						<tr>

							<td style="text-align:right"><b>| Darshan Patel |</b></td>

						</tr>
						<tr>

							<td style="text-align:right"><b>Authorized Signatory</b></td>

						</tr>
					</table>
				</td>
			</tr>


		</table>



		<br>
		<table align="center" width="92%" style="font-family:Cambria;margin-left:35px;font-size:12px;">
			<tr>

				<td style="width:40%;text-align:left;font-weight:bold;">
					Page No. 1 of 1
				</td>
				<td style="width:60%;text-align:left;font-weight:bold;">
					. . . . . . .END OF REPORT. . . . . . .
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