<?php 
session_start();
include("../connection.php");
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
}

</style>
<style>
.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family: Arial;
	
}
.test {
    border-collapse: collapse;
 font-size:12px;
	 font-family: Arial;
}
	.tdclass1{
    
    font-size:12px;
	 font-family: Arial;
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

@media print {
               .noprint {
                  visibility: hidden;
			   }
 }

</style>
<html>
	<body>
			<?php
			
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from ggbs WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe1 = mysqli_fetch_array($result_tiles_select);
				
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
			$client_address= $row_select['clientaddress'];
			$r_name= $row_select['refno'];
			$r_date= $row_select['date'];
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
				$issue_date= $row_select2['end_date'];								
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
					$cc_grade= $row_select4['cc_grade'];
					$cc_set_of_cube= $row_select4['cc_set_of_cube'];
					$cc_no_of_cube= $row_select4['cc_no_of_cube'];
					$cc_identification_mark= $row_select4['cc_identification_mark'];
					$day_remark= $row_select4['day_remark'];
					$casting_date= $row_select4['casting_date'];
					$material_location= $row_select4['material_location'];
					$week_number= $row_select4['week_number'];
					$consistency = $row_select4['final_consistency'];
				}
		?>
		
<!-- <input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"> -->
	<page size="A4">
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		    <tr>
				<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
			</tr>
			<tr>
				<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Physical Properties of GGBS</b></td>
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
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
							
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $mt_name; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Manufacturer name of GGBS</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Proportion</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;"><?php echo $grade_data; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Brand name of cement used</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
						    <td style="width:12%;">Environment Condition</td>
							<td style="width:6%;text-align: center;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;">Temp 27 2&#8451; & Humidity > 65RH Except Fineness by Blain < 65RH</td>
							<td style="width:21%;text-align:right;">Week No.</td>
							<td style="width:6%;text-align: center;"> &raquo;</td>
							<td style="width:40%;"><?php echo $week_number; ?></td>
						</tr>
						
					</table>
				</td>
			</tr>
		</table>

		<!-- <table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;border:1px solid black;margin-left:35px; ">
			
			<tr style="border: 1px solid black;height:20px;"> 
				<td width="30%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if($row_select_pipe1['ulr'] != "" && $row_select_pipe1['ulr'] != "0" && $row_select_pipe1['ulr'] != null){
					echo "<b>ULR:</b> ".$row_select_pipe1['ulr'];}?></td>
				
				<td width="65%" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){
					echo " ".$report_no;}?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d-m-Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submited To </b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'"; 
															$result_selectc = mysqli_query($conn, $select_queryc);

															if (mysqli_num_rows($result_selectc) > 0) {
																$row_selectc = mysqli_fetch_assoc($result_selectc);
																$ct_nm= $row_selectc['city_name'];
															}
															echo $clientname." ".$row_select['clientaddress']." ".$ct_nm;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of <span id="put_details"></span><select style="font-weight:bold;border:0px;font-size:11px;" onchange="put_details()" id="details_of_sample"><option>Work</option><option>Project</option></select></b></td>
				<td colspan="2" style="border-bottom: 1px solid black;padding-left:10px ">&nbsp;&nbsp;<?php echo $name_of_work;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $mt_name;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php 
				echo $r_name." Date:".date('d/m/Y', strtotime($row_select2["letter_date"])); 
				
				?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Date of Receipt of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php if($cons=="1"){ echo "Sealed";}elseif($cons=="2"){ echo "Unsealed";}elseif($cons=="3"){ echo "Good";}elseif($cons=="4"){ echo "Poor";}else{ echo "Sealed";} ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'"; 
															$result_selectc1 = mysqli_query($conn, $select_queryc1);

															if (mysqli_num_rows($result_selectc1) > 0) {
																$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																$ct_nm1= $row_selectc1['city_name'];
															}
															echo $agency_name." ".$ct_nm1;?> </td>
			</tr>
			<?php if($agreement_no != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Aggrement No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
			</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php 
				
		
				echo $lab_no;
				?></td>
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
				
				
				
				<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
				</TR>
				<tr style="border: 1px solid black;height:20px;">
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:LEFT;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
				<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>
		</table> -->
		

		<!--OTHER START-->
		<td>
			<table align="left" width="100%"  class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:15px;" >
				<tr style="text-align:center;">
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sr.<br>No.</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Particular of Test</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Specification Requirement (BS EN 15167-1 : 2006 Table 5)</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Method of Test</b></td>
					<td  style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Test Results</b></td>
				</tr>
				
				<?php $cnt = 1; ?>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><b>Setting Time</b></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Initial Setting Time (Minute)</td>
					<td rowspan=2 style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">2.25 times of the test cement</td>
					<td rowspan=2 style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-5) 1988</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['it_ft_1']!="" && $row_select_pipe1['it_ft_1']!="0" && $row_select_pipe1['it_ft_1']!=null){echo $row_select_pipe1['it_ft_1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Final Setting Time (Minute)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['it_ft_2']!="" && $row_select_pipe1['it_ft_2']!="0" && $row_select_pipe1['it_ft_2']!=null){echo $row_select_pipe1['it_ft_2']; }else{echo " <br>";}?></td>
				</tr>

				<tr>
			     	<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Soundness-Le-Chatelier (mm)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-3) 1998</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['sou_avg3']!="" && $row_select_pipe1['sou_avg3']!="0" && $row_select_pipe1['sou_avg3']!=null){echo $row_select_pipe1['sou_avg3']; }else{echo " <br>";}?></td>
				</tr>
				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Conistency (%)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-4) : 1988</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['final_consistency']!="" && $row_select_pipe1['final_consistency']!="0" && $row_select_pipe1['final_consistency']!=null){echo $row_select_pipe1['final_consistency']; }else{echo " <br>";}?></td>
				</tr>

				<?php
					$cnt=0;
					if($row_select_pipe1['ss_area']!="" && $row_select_pipe1['ss_area']!="0" && $row_select_pipe1['ss_area']!=null){
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Fineness by Blaine's permeability method</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">250</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-2) : 1999</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['ss_area']!="" && $row_select_pipe1['ss_area']!="0" && $row_select_pipe1['ss_area']!=null){echo $row_select_pipe1['ss_area']; }else{echo " <br>";}?></td>
				</tr>


				


				<?php
					}
				
				if($row_select_pipe1['avg_mo']!="" && $row_select_pipe1['avg_mo']!="0" && $row_select_pipe1['avg_mo']!=null)
					{	
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Moisture Content</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 16714 : 2018</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_mo']!="" && $row_select_pipe1['avg_mo']!="0" && $row_select_pipe1['avg_mo']!=null){echo $row_select_pipe1['avg_mo']; }else{echo " <br>";}?></td>
				</tr>
				<?php
					}
				
				if($row_select_pipe1['avg_com_1']!="" && $row_select_pipe1['avg_com_1']!="0" && $row_select_pipe1['avg_com_1']!=null && $row_select_pipe1['avg_com_2']!="" && $row_select_pipe1['avg_com_2']!="0" && $row_select_pipe1['avg_com_2']!=null)
					{	
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td ROWSPAN="3" style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Compressive Strength at 7 Days.</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Not less than 60% of control OPC 43 Grade Cement Mortar Cube.</td>
					<td ROWSPAN="3" style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS: 4031 (PART 6):1988 (RA 2019)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php 
					$a1 = $row_select_pipe1['avg_com_1'];
					$a2 = $row_select_pipe1['avg_com_2'];
					
					$and = $a2 / $a1;
					$ans = $and * 100;
					
					echo round($ans);
					
					?></td>
				</tr>

				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Cement Compressive Strength at 7 Days, Min.</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_com_1']!="" && $row_select_pipe1['avg_com_1']!="0" && $row_select_pipe1['avg_com_1']!=null){echo $row_select_pipe1['avg_com_1']; }else{echo " <br>";}?></td>
				</tr>

				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Cement + GGBS Compressive Strength at 7 Days, Min.</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_com_2']!="" && $row_select_pipe1['avg_com_2']!="0" && $row_select_pipe1['avg_com_2']!=null){echo $row_select_pipe1['avg_com_2']; }else{echo " <br>";}?></td>
				</tr>

				<?php
					}
				
				if($row_select_pipe1['avg_com_3']!="" && $row_select_pipe1['avg_com_3']!="0" && $row_select_pipe1['avg_com_3']!=null && $row_select_pipe1['avg_com_4']!="" && $row_select_pipe1['avg_com_4']!="0" && $row_select_pipe1['avg_com_4']!=null)
					{	
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td ROWSPAN="3" style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Compressive Strength at 28 Days.</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Not less than 75% of control OPC 43 Grade Cement Mortar Cube.</td>
					<td ROWSPAN="3" style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS: 4031 (PART 6):1988 (RA 2019)</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php 
					
					$a1 = $row_select_pipe1['avg_com_3'];
					$a2 = $row_select_pipe1['avg_com_4'];
					
					$and = $a2 / $a1;
					$ans = $and * 100;
					
					echo round($ans);
					?></td>
				</tr>

				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Cement Compressive Strength at 28 Days, Min.</td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_com_3']!="" && $row_select_pipe1['avg_com_3']!="0" && $row_select_pipe1['avg_com_3']!=null){echo $row_select_pipe1['avg_com_3']; }else{echo " <br>";}?></td>
				</tr>

				<tr style="text-align:center;">
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Cement + GGBS Compressive Strength at 28 Days, Min.</b></td>
					<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_com_4']!="" && $row_select_pipe1['avg_com_4']!="0" && $row_select_pipe1['avg_com_4']!=null){echo $row_select_pipe1['avg_com_4']; }else{echo " <br>";}?></td>
				</tr>

				
				<?php
					}
					
				?>
			</table>
		</td>

		<!-- <td>
			<table align="left" width="100%"  class="test" style="height:Auto;width:100%;" >
				<tr style="text-align:center;">
					<td  style="border:1px solid black;width:2%;"><b>Sr.<br>No.</b></td>
					<td  style="border:1px solid black;width:36%;"><b>Test Parameter</b></td>
					<td  style="border:1px solid black;width:10%;"><b>Units</b></td>
					<td  style="border:1px solid black;width:10%;"><b>Test Method</b></td>
					<td  style="border:1px solid black;width:10%;"><b>Test Result</b></td>
					<td  style="border:1px solid black;width:20%;"><b>Requirement as per IS <br>3812(P-1):2013 (RA:2017)</b></td>
				</tr>
				
				<?php
					$cnt=0;
					if($row_select_pipe1['ss_area']!="" && $row_select_pipe1['ss_area']!="0" && $row_select_pipe1['ss_area']!=null){
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;"><b><?php echo $cnt;?></b></td>
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Fineness by Blaine's permeability method</b></td>
					<td style="border:1px solid black;">m<sup>2</sup>/kg</td>
					<td  style="border:1px solid black;">IS 4031 (PART 2) : 1999 <br> (RA : 2018)</td>
					<td style="border:1px solid black;"><?php if($row_select_pipe1['ss_area']!="" && $row_select_pipe1['ss_area']!="0" && $row_select_pipe1['ss_area']!=null){echo $row_select_pipe1['ss_area']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;">320 Min.</td>
				</tr>
				<?php
					}
				
				if($row_select_pipe1['avg_mo']!="" && $row_select_pipe1['avg_mo']!="0" && $row_select_pipe1['avg_mo']!=null)
					{	
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td style="border:1px solid black;"><b><?php echo $cnt;?></b></td>
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Moisture Content</b></td>
					<td style="border:1px solid black;">%</td>
					<td style="border:1px solid black;">IS 16714 : 2018</td>
					<td style="border:1px solid black;"><?php if($row_select_pipe1['avg_mo']!="" && $row_select_pipe1['avg_mo']!="0" && $row_select_pipe1['avg_mo']!=null){echo $row_select_pipe1['avg_mo']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;">-</td>
				</tr>
				<?php
					}
				
				if($row_select_pipe1['avg_com_1']!="" && $row_select_pipe1['avg_com_1']!="0" && $row_select_pipe1['avg_com_1']!=null && $row_select_pipe1['avg_com_2']!="" && $row_select_pipe1['avg_com_2']!="0" && $row_select_pipe1['avg_com_2']!=null)
					{	
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td ROWSPAN="3" style="border:1px solid black;"><b><?php echo $cnt;?></b></td>
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Compressive Strength at 7 Days.</b></td>
					<td style="border:1px solid black;">%</td>
					<td ROWSPAN="3" style="border:1px solid black;">IS: 4031 (PART 6):1988 (RA 2019)</td>
					<td style="border:1px solid black;"><?php 
					$a1 = $row_select_pipe1['avg_com_1'];
					$a2 = $row_select_pipe1['avg_com_2'];
					
					$and = $a2 / $a1;
					$ans = $and * 100;
					
					echo round($ans);
					
					?></td>
					<td  style="border:1px solid black;">Not less than 60% of control OPC 43 Grade Cement Mortar Cube.</td>
				</tr>
				<tr style="text-align:center;">
				
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Cement Compressive Strength at 7 Days, Min.</b></td>
					<td style="border:1px solid black;">N/mm<sup>2</sup></td>
					
					<td style="border:1px solid black;"><?php if($row_select_pipe1['avg_com_1']!="" && $row_select_pipe1['avg_com_1']!="0" && $row_select_pipe1['avg_com_1']!=null){echo $row_select_pipe1['avg_com_1']; }else{echo " <br>";}?></td>
					<td  style="border:1px solid black;">-</td>
				</tr>
				<tr style="text-align:center;">
					
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Cement + GGBS Compressive Strength at 7 Days, Min.</b></td>
					<td style="border:1px solid black;">N/mm<sup>2</sup></td>
					<td style="border:1px solid black;"><?php if($row_select_pipe1['avg_com_2']!="" && $row_select_pipe1['avg_com_2']!="0" && $row_select_pipe1['avg_com_2']!=null){echo $row_select_pipe1['avg_com_2']; }else{echo " <br>";}?></td>
					<td  style="border:1px solid black;">-</td>
					
				</tr>
				<?php
					}
				
				if($row_select_pipe1['avg_com_3']!="" && $row_select_pipe1['avg_com_3']!="0" && $row_select_pipe1['avg_com_3']!=null && $row_select_pipe1['avg_com_4']!="" && $row_select_pipe1['avg_com_4']!="0" && $row_select_pipe1['avg_com_4']!=null)
					{	
						$cnt++;
				?>
				<tr style="text-align:center;">
					<td ROWSPAN="3" style="border:1px solid black;"><b><?php echo $cnt;?></b></td>
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Compressive Strength at 28 Days.</b></td>
					<td style="border:1px solid black;">%</td>
					<td ROWSPAN="3" style="border:1px solid black;">IS: 4031 (PART 6):1988 (RA 2019)</td>
					<td style="border:1px solid black;"><?php 
					
					$a1 = $row_select_pipe1['avg_com_3'];
					$a2 = $row_select_pipe1['avg_com_4'];
					
					$and = $a2 / $a1;
					$ans = $and * 100;
					
					echo round($ans);
					?></td>
					<td  style="border:1px solid black;">Not less than 75% of control OPC 43 Grade Cement Mortar Cube.</td>
				</tr>
				<tr style="text-align:center;">
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Cement Compressive Strength at 28 Days, Min.</b></td>
					<td style="border:1px solid black;">N/mm<sup>2</sup></td>
					<td style="border:1px solid black;"><?php if($row_select_pipe1['avg_com_3']!="" && $row_select_pipe1['avg_com_3']!="0" && $row_select_pipe1['avg_com_3']!=null){echo $row_select_pipe1['avg_com_3']; }else{echo " <br>";}?></td>
					<td  style="border:1px solid black;">-</td>
				</tr>
				<tr style="text-align:center;">
					<td style="border:1px solid black; text-align:left;"><b>&nbsp; Cement + GGBS Compressive Strength at 28 Days, Min.</b></td>
					<td style="border:1px solid black;">N/mm<sup>2</sup></td>
					<td style="border:1px solid black;"><?php if($row_select_pipe1['avg_com_4']!="" && $row_select_pipe1['avg_com_4']!="0" && $row_select_pipe1['avg_com_4']!=null){echo $row_select_pipe1['avg_com_4']; }else{echo " <br>";}?></td>
					<td  style="border:1px solid black;">-</td>
					
				</tr>
				<?php
					}
					
				?>
			</table>
		</td> -->
	</tr>	
</table>
		
		
		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:5px 0px 5px;">
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
	
	function loading(){
		
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		
	}

</script>