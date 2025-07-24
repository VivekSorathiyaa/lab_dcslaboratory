<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0 30px; }
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

</style>
<html>
	<body>
			<?php
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from ms_plate_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					$mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification'];
					$material_location= $row_select4['material_location'];
				}
		?>
		

	<page size="A4">
		<!-- <input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"> -->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;">
		        <tr>
					<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;"><b>Test Report</b></td>
				</tr>
				<tr>
					<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;"><b>Chemical Properties of Structural Steel</b></td>
				</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Chemical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
							<?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?>
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
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						<td style="width:12%;padding-bottom: 4px;">Date of letter</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $date_of_latter;?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>

						<!-- <tr>
							<td style="width:22%;">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family: Cambria;"><b>:</b></td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
						</tr> -->

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Material Received</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">Structural Steel</td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Material Make</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo $brick_specification; ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<!-- <table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;border:1px solid black;margin-left:35px;border-bottom: 0px solid black;">
			
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
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $mt_name." ".$row_select_pipe['cement_grade'];?> </td>
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
			
			<?php if($mark != ""){ ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Identification Mark</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php echo $mark; ?> </td>
			</tr>
			<?php } ?>
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
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php if($cons=="1"){ echo "Sealed";}elseif($cons=="2"){ echo "Unsealed";}elseif($cons=="3"){ echo "Good";}elseif($cons=="4"){ echo "Poor";}else{ echo "Sealed";} ?> </td>
			</tr>
			<?php if($agreement_no != ""){?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Aggrement No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agreement_no; ?></td>
			</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $lab_no;?></td>
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
		</table> -->


		
		<table align="center" width="100%" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:15px;">
			
			<tr>
				<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:6%;">Sr No.</td>
				<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:25%;">Type of Structural Steel</td>
				<td style="border: 1px solid black;text-align:center;font-weight:bold;width:15%;">Size</td>
				<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:20%;">Carbon (%)</td>
				<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:20%;">Phosphorus (%)</td>
				<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;width:20%;">Sulphur (%)</td>
			</tr>
			
			<tr>
				<td colspan=3 style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">Method of Test</td>
				<td colspan=3 style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;font-weight:bold;">IS 8811 : 1998</td>
			</tr>

			<?php
				$count = 1;
				$select_tiles_query = "select * from ms_plate_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				if(mysqli_num_rows($result_tiles_select) > 0){
					while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
			?>
						<tr>
							<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $count; ?></td>
							<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
							<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $brick_specification; ?></td>
							<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['c5']!="" && $row_select_pipe['c5']!="0" && $row_select_pipe['c5']!=null){echo $row_select_pipe['c5']; }else{echo " <br>";}?></td>
							<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['c4']!="" && $row_select_pipe['c4']!="0" && $row_select_pipe['c4']!=null){echo $row_select_pipe['c4']; }else{echo " <br>";}?></td>
							<td  style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['c7']!="" && $row_select_pipe['c7']!="0" && $row_select_pipe['c7']!=null){echo $row_select_pipe['c7']; }else{echo " <br>";}?></td>
					</tr>
			
			<?php $count++; } ?>

			<?php	
				$count++;
				}
			?>
		</table>
		
		<!-- <table align="center" width="100%" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:15px;">
			
			<tr>
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;">Sr No.</td>
				<td rowspan="2" style="border: 1px solid black;text-align:center;font-weight:bold;">Dimension (mm)</td>
				<td colspan="6" style="border: 1px solid black;text-align:center;font-weight:bold;">Chemical Analysis</td>
			</tr>
			<tr>
				<td style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">Carbon <br> %</td>
				<td style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">Manganese <br> %</td>
				<td style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">Sulphur <br> %</td>
				<td style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">Phosphorus <br> %</td>
				<td style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">Silicon <br> %</td>
				<td style="width:10%;border: 1px solid black;text-align:center;font-weight:bold;">C.E <br> %</td>
			</tr>
			<?php
				$count = 1;
				$select_tiles_query = "select * from ms_plate_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
				$result_tiles_select = mysqli_query($conn, $select_tiles_query);
				if(mysqli_num_rows($result_tiles_select) > 0){
					while($row_select_pipe = mysqli_fetch_array($result_tiles_select)){
			?>
						<tr style="height:25px;">
							<td  style="border: 1px solid black;text-align:center;"><?php echo $count; ?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['dia1']!="" && $row_select_pipe['dia1']!="0" && $row_select_pipe['dia1']!=null){echo $row_select_pipe['dia1']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c5']!="" && $row_select_pipe['c5']!="0" && $row_select_pipe['c5']!=null){echo $row_select_pipe['c5']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c2']!="" && $row_select_pipe['c2']!="0" && $row_select_pipe['c2']!=null){echo $row_select_pipe['c2']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c7']!="" && $row_select_pipe['c7']!="0" && $row_select_pipe['c7']!=null){echo $row_select_pipe['c7']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c4']!="" && $row_select_pipe['c4']!="0" && $row_select_pipe['c4']!=null){echo $row_select_pipe['c4']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c14']!="" && $row_select_pipe['c14']!="0" && $row_select_pipe['c14']!=null){echo $row_select_pipe['c14']; }else{echo " <br>";}?></td>
							<td  style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c3']!="" && $row_select_pipe['c3']!="0" && $row_select_pipe['c3']!=null){echo $row_select_pipe['c3']; }else{echo " <br>";}?></td>
						</tr>
			
			<?php $count++; } ?>
					<tr style="height:25px;">
						<td  style="border: 1px solid black;text-align:center;"><?php echo $count; ?></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
						<td  style="border: 1px solid black;text-align:center;"></td>
					</tr>


			<?php	
				$count++;
				}
			?>
		</table> -->
		
		    <tr>
                <td>
                    <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:10px;text-align:left;font-weight:bold;padding:15px 0 7px;font-family:Cambria;"> Requirement as per IS 1149-2004</td>
                            </tr>
                    </table>
                </td>
            </tr>

			<?php $cnt = 1; ?>
			<tr>
                <td>
								<table align="top" width="90%" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;">             
           
										<tr>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Sr. No.</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Properties</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Requirements</b></td>
										</tr>
										
										<tr>
												<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $cnt++; ?></td>
												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Carbon % (Max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.230%</td>
										</tr>
										<tr>
												<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $cnt++; ?></td>
												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Sulphur % (Max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.050%</td>
										</tr>
										<tr>
												<td style="font-size:10px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 0;"><?php echo $cnt++; ?></td>
												<td style="text-align:left;border:1px solid black;border-right:0px solid black;">Phosphurous % (Max)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.050%</td>
										</tr>
								</table>
				</td>
            </tr>
		


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
</script>