<?php 
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(0);?>
<style>
@page { margin: 0 40px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;
	
} 
@media print
{    
    #header_hide_show
    {
        display: none !important;
    }
	#details_of_sample
    {
        display: none !important;
    }
	#details_of_sample
    {
        display: none !important;
    }
}

</style>
<style>
.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family : Calibri;
	
}
.test {
    border-collapse: collapse;
 font-size:12px;
	 font-family : Calibri;
}
	.tdclass1{
    
    font-size:12px;
	 font-family : Calibri;
}
div.vertical-sentence{
  -ms-writing-mode: tb-rl; /* for IE */
  -webkit-writing-mode: vertical-rl; /* for Webkit */
  writing-mode: vertical-rl;
  
}
.rotate-characters-back-to-horizontal{ 
  -webkit-text-orientation: upright;  /* for Webkit */
  text-orientation: upright; 
}

</style>
<html>
	<body>
			<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			 $select_tiles_query = "select * from carpet_6_4_75_mm WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
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
				$issue_date= $row_select2['issue_date'];$rec_sample_date= $row_select2['receive_date'];
$rec_sample_date= $row_select2['receive_date'];					
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
					$source= $row_select4['agg_source'];
					$identification= $row_select4['agg_source'];
					$material_location= $row_select4['material_location'];
				}
						
			
		?>
		
		
		
		<page size="A4">
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family:Times New Roman;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Properties of Aggregate</b></td>
			</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $job_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;">

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
								<td style="width:12%;padding-bottom: 4px;">Aggrement No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 14px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						?>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $r_name;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"> Source of Sample</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $source; ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {echo date('d/m/Y', strtotime($row_select["date"]));}?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;">Method of Test</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;">IS 2386</td>
							<td style="width:21%;text-align:right;">Specification Requirement</td>
							<td style="width:6%;text-align: center;"> &raquo;</td>
							<td style="width:40%;">as per <span>MORTH</span></td>
						</tr>
						
					</table>
				</td>
			</tr>

			<!-- <tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border-bottom:1px solid black;">
						<tr>
							<td style="width:9%;padding-top:3px;padding-bottom:3px;"><b>&nbsp;&nbsp;Report No.</b></td>
							<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
							<td style="width:15%"><?php echo $report_no; ?></td>
							<td style="width:9%;"><b>Report Date</b></td>
							<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
							<td style="width:15%"><?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
							<?php
							if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "-" && strlen($row_select_pipe['ulr']) >= 5 && $row_select['nabl_type'] == "nabl") {
							?>
								<td style="width:7%;"><b>ULR No.</b></td>
								<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
								<td style="width:15%"><?php echo $_GET['ulr']; ?></td>
							<?php
							} else {
							?>
								<td style="width:6%;"><b>&nbsp;</b></td>
								<td style="width:2%;font-family : Calibri;font-weight:bold;"><b>&nbsp;</b></td>
								<td style="width:15%">&nbsp;&nbsp;</td>
							<?php
							}

							?>
						</tr>

					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="border-bottom:1px solid black;">

						<?php

						if ($clientname != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Customer</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
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
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Agency</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $agency_name; ?>
								</td>
							</tr>
						<?php
						}
						if ($row_select['tpi_name'] != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['tpi_or_auth']; ?></b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['tpi_name']; ?>
								</td>
							</tr>
						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b><?php echo $row_select['pmc_heading']; ?></b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $row_select['pmc_name']; ?>
								</td>
							</tr>

						<?php
						}
						if ($name_of_work != "") {
						?>

							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Name of Work</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;padding-top:3px;"><b>:</b></td>
								<td style="width:77%;padding-top:3px;">&nbsp;&nbsp;<?php echo $name_of_work; ?>
								</td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>

							<tr>
								<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Agreement No.</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
								<td style="width:77%">&nbsp;&nbsp;<?php echo $agreement_no; ?>
								</td>
							</tr>
						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:20%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;<b>Reference</b></td>
								<td style="width:3%;font-family : Calibri;font-weight:bold;"><b>:</b></td>
								<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00") {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>

								</td>
							</tr>
						<?php
						}

						?>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" border="0px" class="test" style="border-bottom:1px solid black;">
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Discipline &amp; Group</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;Mechanical &amp; Building Material</td>
							<td style="width:22%">&nbsp; Environmental Condition in Lab</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:22%">&nbsp;Ambient</td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Material Received</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;Coarse Aggregates</td>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family : Calibri;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Size of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Source of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $source; ?></td>
							<td style="width:22%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:22%">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%;padding-top:3px;">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;">:</td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:22%;padding-top:3px;padding-bottom:3px;">&nbsp;&nbsp;</td>
							<td style="width:3%;font-family : Calibri;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr> -->

		

			<!--START-->
			<tr>
			    <td>
                    <table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="font-family : Calibri;">
                        <tr>
                             <td colspan="2" style="padding-bottom:4px;font-weight:bold;font-size:11px;">A) Sieve Analysis :</td>
                        </tr>


                        <tr style="display:flex;">
                            <td colspan="2" style="width:100%;vertical-align:top">
                                <table align="top" width="100%" class="test" style="max-width:400px;font-size:11px;font-family : Calibri;">
                                     <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;" colspan="3"><b>Particle Size Distribution Test</b></td>
									</tr>
									<tr>
										<td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;" ><b>IS 2386 Part-1</b></td>
									</tr>

									<tr>
										<td style="text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;"> Sieve Size</td>

												<td style="border-right:1px solid black;">
													<table style="width:100%;border-collapse: collapse;">
														<tr>
															<td style="font-size:11px;text-align:center;border-bottom:0px solid black;padding:5px 4px;">Test Result</td>
														</tr>
														<tr style="">
															<td style="font-size:11px;text-align:center;border-top:1px solid black;padding:5px 4px;">% Passing</td>
														</tr>
													</table>
											    </td>
												
									</tr>

										<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">9.5 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_1']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">5.6 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_2']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">4.75 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_3']; ?></td>
									</tr>
									<tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">2.36 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_4']; ?></td>
									</tr>
                                    <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">1.18 mm</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_5']; ?></td>
									</tr>
									 <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">600 mic</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_6']; ?></td>
									</tr>
									 <tr>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;">300 mic</td>
										<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 0;"><?php echo $row_select_pipe['pass_sample_7']; ?></td>
									</tr>
                                </table>
                            </td>

                            <?php
                            if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0") {
                            ?>
                                <td colspan="6" style="width:100%">
                                    <table align="center" width="100%" class="test" style="margin-left:15px;max-width:300px;font-size:11px;font-family : Calibri;">
                                        <tr>
                                            <td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Test Name</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Acceptance Critaria</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Test Method</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;"><b>Test Results</b></td>
                                        </tr>

                                        <tr>
                                            <td colspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><b>III) Alkali Reactivity Test (Gravimetric Method)</b></td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">--</td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;">IS 2386-7</td>
                                            <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $row_select_pipe['alk_10']; ?></td>
                                        </tr>
                                    </table>
                                </td>
                            <?php
                            }
                            ?>
                        </tr>

                        <tr>  
                          <?php
                            if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

                            ?>
                                <td colspan="3" style="padding-bottom:4px;font-weight:bold;font-size:11px;padding-top:4px;">B) Other Test :</td>
								<?php } else { ?>
							    <td colspan="3" style="padding-bottom:4px;font-weight:bold;font-size:11px;"><b>&nbsp;</b></td>
                            <?php
                            }
                            ?>
                        </tr>

                        <tr>
                          <td colspan="3" style="width:49%;vertical-align:top">
                                <table align="top" width="70%" class="test" style="height:100%;width:70%;">
                                    <?php
                                    if (($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") || ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") || ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") || ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") || ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") || ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") || ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") || ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") || ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0")) {

                                    ?>
                                       <tr>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Name Of Test</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Method</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;">Test Results</td>
												<td style="font-size:11px;text-align:center;border:1px solid black;border-left: 1px solid black;font-weight:bold;padding:5px 4px;width:25%;">Acceptance Critaria as per MoRTH</td>
											</tr>

                                        <?php
                                        if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Flakiness + Elongation %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-1</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['combined_index']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 35%</td>
                                            </tr>
                                            

                                        <?php
                                        }
                                        if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Impact Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['imp_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Crushing Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cru_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>

									<?php
                                        }
                                        if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">LA Abrasion Value %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['abr_index']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 30%</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Specific Gravity</td>
                                                <td rowspan="2"style="font-size:11px;text-align:center;border:1px solid black;border-bottom:1px solid black;border-left:1px solid black;padding:2px 4px;"><center>IS 2386 Part-3</center></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_specific_gravity']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">2.1 - 3.70</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Water Absorption %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['sp_water_abr']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 2%</td>
                                            </tr>
                                       

                                        
                                        <?php
                                        }
                                        if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Bulk Density kg/Lit.</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-3</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['bdl']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>


                                        <?php
                                        }
                                        if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0") {
                                        ?>
                                            <tr>
                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">10% Fine Value KN</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-4</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['fines_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
										

                                        <?php
                                        }
                                        if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Liquid Limit (LL)</td>
                                                <td rowspan="3" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-5</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['liquide_limit']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max 25%</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Plastic Limit (PL)</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['plastic_limit']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Plasticity Index (PI)</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['pi_value']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">&lt; 6%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Soundness Na<sub>2</sub>SO<sub>4</sub> %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2386 Part-5</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['soundness']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Max. 12%</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['mdd'] != "" && $row_select_pipe['mdd'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">MDD (g/cc)</td>
                                                <td rowspan="2" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-8</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['mdd']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['omc'] != "" && $row_select_pipe['omc'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">OMC %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['omc']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">--</td>
                                            </tr>
                                        <?php
                                        }
                                        if ($row_select_pipe['cbr'] != "" && $row_select_pipe['cbr'] != "0") {
                                        ?>
                                            <tr>

                                                <td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:2px 4px;">California Bearing Ratio %</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">IS 2720 Part-16</td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;"><?php echo $row_select_pipe['cbr']; ?></td>
                                                <td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:2px 4px;">Min. 30</td>
                                            </tr>
                                    <?php
                                        }
                                    }

                                    ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
			</tr>
		</table>

		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family : Calibri;" class="test">
						<tr>
							<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0;">
									** End of Report ** 
							</td>																		
						</tr>
		</table>

	    <table align="center" width="100%" class="test">
		        <tr>
					<td style="text-align:center;font-size:11px;">
						<table align="center" width="100%" class="test" style="height:auto;font-family : Calibri;border-top:1px solid black;border-bottom:1px solid black;">
							<tr>
								<td><b>Note :-</b></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:11px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
								<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">3. &nbsp;Manglam Consultancy is not responsible for any kind of interpretation of test results.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(<?php echo naming($row_select['branch_short_code'],$conn);?>)</b></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/T.M.</b></td>
							</tr>
							<tr>
								<td style="font-size:11px;padding:3px 0;">6. &nbsp;Witnessed By:</td>
							</tr>
						</table>
					</td>
			    </tr>
		</table>

		<table width="100%" align="center" style="font-family:Times New Roman;font-size:11px;">
						<tr>
							<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
								Doc ID : FMT-TST-http://localhost/manglam/nabl/print_report/print_rcc_26_5mm_.php?/ Page 1/1
							</td>
						</tr>
		</table>

	</page>
		
		
		<!--<page size="A4">
		<input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()">
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;margin-left:35px; ">
		<tr>
				<td  style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
		</tr>
		</table>
		<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border:1px solid black;margin-left:35px;border-bottom: 0px solid black;">
			
			<tr style="border: 1px solid black;height:20px;"> 
				<td  style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null){
					echo "<b>ULR:</b> ".$row_select_pipe['ulr'];}?></td>
				
				<td colspan="3" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){
					echo " ".$report_no;}?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d/m/Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of Work</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; padding-left:10px;"><?php echo $name_of_work;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $mt_name;?> <span id="put_details"></span> <select onchange="put_details()" id="details_of_sample"><option></option><option> - GSB I</option><option> - M.C.Metal</option><option> - H.B.Metal</option><option> - GSB - I</option><option> - GSB - II</option><option> - GSB - III</option><option> - GSB - IV</option><option> - GSB - V</option><option> - GSB - VI</option><option> - BC</option><option> - BM</option><option> - SDBC</option><option> - WBM</option><option> - WMM</option><option> - MSS</option><option> - BUSG</option><option> - GRIT</option></select> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submited To </b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'"; 
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm= $row_selectc['city_name'];
															}
															echo $clientname." ".$row_select['clientaddress']." ".$ct_nm;?> </td>
			</tr>
			
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $r_name." Date:".date('d/m/Y', strtotime($row_select2["letter_date"])); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Date of Receipt of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php if($cons=="1"){ echo "Sealed";}elseif($cons=="2"){ echo "Unsealed";}elseif($cons=="3"){ echo "Good";}elseif($cons=="4"){ echo "Poor";}else{ echo "Sealed";} ?> </td>
			</tr>
			<!--<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Client</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $clientname; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Consultant</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php // echo $clientname; ?> </td>
			</tr>
			<?php if($identification != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Identification Mark</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $identification; ?> </td>
			</tr>
			<?php }if($source != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Source</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $source; ?> </td>
			</tr>
			<?php }if($agency_name != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agency_name; ?> </td>
			</tr>
			<?php }?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $lab_no;?></td>
			</tr>
			<!--<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Grade:</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php ?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:right;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
			</tr>
			<?php 
				$first_tag = $row_select['first_tag'];
				$second_tag = $row_select['second_tag'];
				$third_tag = $row_select['third_tag'];
				$fourth_tag = $row_select['fourth_tag'];
				
				$first_txt = $row_select['first_txt'];
				$second_txt = $row_select['second_txt'];
				$third_txt = $row_select['third_txt'];
				$fourth_txt = $row_select['fourth_txt'];
				if($first_tag != null && $first_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt;?></td>				
				</tr>
				<?php }if($second_tag != null && $second_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt;?></td>				
				</tr>
				<?php }if($third_tag != null && $third_tag != ""){?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt;?></td>				
				</tr>
				<?php }if($fourth_tag != null && $fourth_tag != ""){?>
				<tr >
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag;?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt;?></td>				
				</tr>
				<?php }?>
				<!--<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>
		</table>
		<br>
		<table align="center" width="92%" class="test" style="margin-left:35px; ">
			<tr>
				<td width="10%" style="border: 1px solid black; font-weight:bold; text-align:center;">Item</td>	
				<td width="30%" style="border: 1px solid black; font-weight:bold; text-align:center;">Tests</td>	
				<td width="15%" style="border: 1px solid black; font-weight:bold; text-align:center;">Test Method Ref.</td>	
				<td width="15%" style="border: 1px solid black; font-weight:bold; text-align:center;">Results Obtained</td>	
				<td width="25%" style="border: 1px solid black; font-weight:bold; text-align:center;">Requirement as per <br> IS 383-2016</td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;">1</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Specific Gravity </td>	
				<td rowspan="3" style="border: 1px solid black;text-align:center;"> IS 2386 : 1963 <br> Part-3 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0" && $row_select_pipe['sp_specific_gravity'] != null){ echo number_format($row_select_pipe['sp_specific_gravity'],2); } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> 2.1-3.2 </td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;">2</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Water absorption (%)</td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0" && $row_select_pipe['sp_water_abr'] != null){ echo $row_select_pipe['sp_water_abr']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> 5.00% </td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;">3</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Bulk density kg/m<sup>3</sup> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0" && $row_select_pipe['bdl'] != null){ echo $row_select_pipe['bdl']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> ==== </td>	
			</tr>
			<?php if($row_select_pipe['chk_grd'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">4</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Gradation percent passingon IS Sieve </td>	
				<td rowspan="5" style="border: 1px solid black;text-align:center;"> IS 2386:1963 <br> Part-1 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> - </td>	
				<td style="border: 1px solid black;text-align:center;"> - </td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;"></td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; 10 mm </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['pass_sample_1'] != ""  && $row_select_pipe['pass_sample_1'] != null){ echo $row_select_pipe['pass_sample_1']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> <?php if($row_select_pipe['pass_range_1'] != "" && $row_select_pipe['pass_range_1'] != "0" && $row_select_pipe['pass_range_1'] != null){ echo $row_select_pipe['pass_range_1']; } else{ echo "-";}?> </td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;"></td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; 6.3 mm</td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['pass_sample_2'] != "" && $row_select_pipe['pass_sample_2'] != null){ echo $row_select_pipe['pass_sample_2']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> <?php if($row_select_pipe['pass_range_2'] != "" && $row_select_pipe['pass_range_2'] != "0" && $row_select_pipe['pass_range_2'] != null){ echo $row_select_pipe['pass_range_2']; } else{ echo "-";}?> </td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;"></td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; 4.75 mm</td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['pass_sample_3'] != "" && $row_select_pipe['pass_sample_3'] != null){ echo $row_select_pipe['pass_sample_3']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> <?php if($row_select_pipe['pass_range_3'] != "" && $row_select_pipe['pass_range_3'] != "0" && $row_select_pipe['pass_range_3'] != null){ echo $row_select_pipe['pass_range_3']; } else{ echo "-";}?> </td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;"></td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; 2.36 mm</td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['pass_sample_4'] != "" && $row_select_pipe['pass_sample_4'] != null){ echo $row_select_pipe['pass_sample_4']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> <?php if($row_select_pipe['pass_range_4'] != "" && $row_select_pipe['pass_range_4'] != "0" && $row_select_pipe['pass_range_4'] != null){ echo $row_select_pipe['pass_range_4']; } else{ echo "-";}?> </td>	
			</tr>
			<?php }/*
				$row1 = 0;
				if($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null){ $row1 += 1; }
				if($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null){ $row1 += 1; }
				if($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null){ $row1 += 1; }
				
				*/
			?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">5</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Crushing value (%) </td>	
				<td rowspan="3" style="border: 1px solid black;text-align:center;">IS 2386:1963 <br> Part-4 <br> </td>
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null){ echo $row_select_pipe['cru_value']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;">30% Max for WS/ 45% Max for NWS</td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;">6</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Impact value (%) </td>		
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null){ echo $row_select_pipe['imp_value']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;">30% Max for WS/ 45% Max for NWS</td>	
			</tr>
			<tr>
				<td style="border: 1px solid black;text-align:center;">7</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Loss Angels Abrasion Value (%)</td>		
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null){ echo $row_select_pipe['abr_index']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;">30% Max for WS/ 50% Max for NWS</td>	
			</tr>
			<?php if($row_select_pipe['chk_sou'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">8</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Soundness (%)</td>	
				<td style="border: 1px solid black;text-align:center;">IS 2386:1963 <br> Part-5 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null){ echo $row_select_pipe['soundness']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> (12% when tested with Na<sub>2</sub>So<sub>4</sub>) </td>	
			</tr>
			<?php }if($row_select_pipe['chk_flk'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">9</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Flakiness Index (%) & <br> &nbsp;&nbsp; Elongation Index (%)</td>	
				<td style="border: 1px solid black;text-align:center;"> IS 2386: 1963 <br> Part-1 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null){ echo $row_select_pipe['combined_index']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> Maximum 35% (Combine) </td>	
			</tr>
			<?php }if($row_select_pipe['chk_fines'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">10</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; 10% Fine Value</td>	
				<td style="border: 1px solid black;text-align:center;"> IS 2386: 1963 <br> Part-4 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null){ echo $row_select_pipe['fines_value']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;">30% Mas for WS/Min. 50kN Load for NWS</td>	
			</tr>
			<?php }if($row_select_pipe['chk_dtm'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">11</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Deleterious Material</td>	
				<td style="border: 1px solid black;text-align:center;"> IS 2386: 1963 <br> Part-2 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null){ echo $row_select_pipe['fines_value']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> Max 1% by Mass</td>	
			</tr>
			<?php }if($row_select_pipe['chk_alk'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">12</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Alkali Aggregate reactivity</td>	
				<td style="border: 1px solid black;text-align:center;"> IS 2386: 1963 <br> Part-7 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['alk_9'] != "" && $row_select_pipe['alk_9'] != "0" && $row_select_pipe['alk_9'] != null){ echo $row_select_pipe['alk_9']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> Alkali Silica Reaction shall not be positive</td>	
			</tr>
			<?php }if($row_select_pipe['chk_clr'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">13</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Chloride Content</td>	
				<td style="border: 1px solid black;text-align:center;"> IS 2386: 1963 <br> Part-7 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['av_clr'] != "" && $row_select_pipe['av_clr'] != "0" && $row_select_pipe['av_clr'] != null){ echo $row_select_pipe['av_clr']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> - </td>	
			</tr>
			<?php }if($row_select_pipe['chk_sul'] == "1"){?>
			<tr>
				<td style="border: 1px solid black;text-align:center;">14</td>	
				<td style="border: 1px solid black;">&nbsp;&nbsp; Sulphate</td>	
				<td style="border: 1px solid black;text-align:center;"> IS 2386: 1963 <br> Part-7 <br> </td>	
				<td style="border: 1px solid black;text-align:center; font-weight:bold;"> <?php if($row_select_pipe['avg_sul'] != "" && $row_select_pipe['avg_sul'] != "0" && $row_select_pipe['avg_sul'] != null){ echo $row_select_pipe['avg_sul']; } else{ echo "-";}?></td>	
				<td style="border: 1px solid black;text-align:center;"> - </td>	
			</tr>
			<?php }?>
		</table>
		<br>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;margin-left:35px; border:1px solid black;">
			<tr>
				<td style="text-align:left; font-size:11px; padding:2px;">&nbsp;&nbsp; <b>Note:-</b> [1]Test results are related to samples submitted by Customer only.[2]Results/Reports are issued with specific understanding that TMTL will not in any case be involved in action following the information of test result.[3]Results /Reports are not supposed to be used for publicity.[4]Test report shall not be reproduced except in full without written approval of Quality Manager/ Technical Manager.</td>
			</tr>
			<tr>				
				<td colspan="2" style="border:0px solid black;border-bottom:0px solid black;"><input Style="width:100%; border:none; font-weight:bold;" type="text" value=" "></td>
				
			</tr>
		</table>
		<br>
		<table align="center" style="font-family : Calibri;">
				<tr>
					<td style="">
						<div style="float:right;" id="footer">
							
						</div>
					</td>
					<td style="width:25%;">
						<div style="float:right; text-align:center; padding-right:60px;" id="sign">
							<img src="../images/stamp.png" width="160px">
						</div>
					</td>
				</tr>
		</table>
		<table align="center" style="font-family : Calibri;position: fixed;left: 20px;right: auto;bottom: 20px;width: 92%;">
				
				<tr>
					<td >
						<div style="margin-top:2px;">
							<b style="font-size:11px;font-weight:100;">F/AGG/01, Issue No.01</b><br>
							<font style="font-size:11px;font-weight:100;">W.e.f. 01.12.2012</font><br>
						</div>
					</td>
					<td style="width:25%;">
						<div style="float:right;margin-top:2px;">
							<b style="font-size:11px;font-weight:100;">Page: 1<br>
						</div>
					</td>
				</tr>
			</table>
		</page>-->
		
	</body>
</html>
<script src="jquery.min.js"></script>		
<script type="text/javascript">
	function header(){
		if(document.querySelector('#header_hide_show').checked){
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="100%">');
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else{
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}
	
	function put_details(){
		var get_data = document.getElementById('details_of_sample').value;
		document.getElementById('put_details').innerHTML = get_data;
	}
</script>