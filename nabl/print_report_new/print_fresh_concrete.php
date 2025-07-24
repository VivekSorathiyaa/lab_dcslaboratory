<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0 40px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 29.7cm;
  height: 21cm;  
} 

.tdclass{
    border: 1px solid black;
    font-size:10px;
	 font-family: Arial;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family: Arial;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family: Arial;
	 
}
.tdclass1{    
    font-size:11px;
	 font-family: Arial;
}

.details{
	margin:0px auto;
	padding:0px;
}
</style>
<html>
	<body>
		<?php
			$entity = '&radic;';

			// select the one you like the best
			$squareRoot = '√';
			$squareRoot = html_entity_decode($entity);
			$squareRoot = mb_convert_encoding($entity, 'UTF-8', 'HTML-ENTITIES');

			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from fresh_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];			
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
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
					$detail_sample= $row_select3['mt_name'];
				}
				
			}
			
			 $select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
				$result_select4 = mysqli_query($conn, $select_query4);

				if (mysqli_num_rows($result_select4) > 0) {
					$row_select4 = mysqli_fetch_assoc($result_select4);
					$source= $row_select4['agg_source'];
				}
				
				$pagecnt=1;
				$totalcnt=1;
				if(($row_select_pipe['avg_com_1']!="" && $row_select_pipe['avg_com_1']!="0" && $row_select_pipe['avg_com_1']!=null) || ($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null))
				{
					$totalcnt++;
				}
				if($row_select_pipe['avg_density']!="" && $row_select_pipe['avg_density']!="0" && $row_select_pipe['avg_density']!=null)
				{
					$totalcnt++;
				}	
				
				
		?>

		<page size="A4" >
			<table align="center" width="100%" class="test"  style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;" cellpadding="5px">
			<tr>
					<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;padding-top:0px;"><b>Test Report</b></td>
				</tr>
				<tr>
					<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;padding-top:0px;"><b>Fresh Concrete</b></td>
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
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
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
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;"><?php echo $row_select['pmc_heading']; ?></td>
								<td style="width:6%;text-align: center;padding-bottom:14px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom:14px;"><?php echo $row_select['pmc_name']; ?>
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
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No.</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $letter_no;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Cement Level</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Size of Aggregate</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php //echo $detail_sample; ?> 20 mm , 10 mm</td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">W/C ratio</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $row_select_pipe['mix_ratio'];?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Type of Cement</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $row_select_pipe['mix_a1'];?><?php echo $grade_data; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Grade of Concrete</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $row_select_pipe['grade_fresh'];?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;">Type of Admixture</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;"><?php echo $row_select_pipe['mix_a7'];?></td>
							<td style="width:21%;text-align:right;"></td>
							<td style="width:6%;text-align: center;"></td>
							<td style="width:40%;"></td>
						</tr>
					</table>
				</td>
			</tr>
				<!-- <tr>
					<td colspan="5" style="font-size:14px;border: 1px solid black;"><center><b>TEC Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="font-size:14px;border: 1px solid black;"><center><b>Worksheet for Slump Test and Density of Fresh Concrete (IS : 1199)</b></center></td>					
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>F-Concrete-05, Issue No.01, Page No 1 of 1</b></center></td>					
				</tr>
				<tr>
					<td colspan="5" style="font-size:14px;border: 1px solid black;"><center><b>&nbsp;</b></center></td>					
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;"><b>Laboratory ID No.: </b></td>
					<td colspan="4" style="border: 1px solid black; width:60%"><b><?php echo $job_no;?></b></td>					
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;"><b>Date of Testing: </b></td>
					<td colspan="4" style="border: 1px solid black; width:60%"><?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>					
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;"><b>Grade of Concrete Mix:</b></td>
					<td colspan="4" style="border: 1px solid black; width:60%"><?php echo $row_select_pipe['grade_fresh'];?></b></td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black;"><b>Required Slump:</b></td>
					<td colspan="4" style="border: 1px solid black; width:60%"><?php echo $row_select_pipe['slump_req'];?></b></td>
				</tr> -->
			</table>

		<?php $cnt = 1; ?>
			<table align="left" width="100%"  class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:15px;" >
				<tr style="text-align:center;">
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sr.<br>No.</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Name of test</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Method of Test</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Test Result</b></td>
				</tr>
				
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Initial Setting Time (Min.)</td>
					<td rowspan=2 style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 1199 Part-7-2018</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['slump3'];?></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Final Setting Time (Minute)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Bleeding Test (%)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 9103 : 1999</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['bd_1'];?></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Density (Kg/m<sup>2</sup>)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 1199 : Part 3 : 2018</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['den5'];?></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Slump Test (mm)</td>
					<td Rowspan=2 style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 1199 Part-1-2018</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['slump5'];?></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Flow (cm)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['flow'];?></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Air Content (%)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 1199 Part-4-2018</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['ac_1'];?></td>
				</tr>
			</table>
			
		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0px 7px;">
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
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>

							<tr>
							<td style="font-size:10px;padding:3px 0;font-weight:bold;">&nbsp;Witness By : </td>
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

			
		</page>
	</body>
	<!-- <script>
		window.print();
	</script> -->
</html> 