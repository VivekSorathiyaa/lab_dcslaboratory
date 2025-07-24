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
					include_once 'sample_id.php';
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
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - PHYSICAL PROPERTIES OF GGBS</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe1["amend_date"])); ?></td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
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


		<!--OTHER START-->
		<td>
			<table align="left" width="100%"  class="test" style="font-size:11px;font-family : Calibri;border-right:2px solid;border-left:2px solid;" >
				<tr style="text-align:center;">
					<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sr.<br>No.</b></td>
					<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Particular of Test</b></td>
					<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Specification Requirement (BS EN 15167-1 : 2006 Table 5)</b></td>
					<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Method of Test</b></td>
					<td  style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Test Results</b></td>
				</tr>
				
				<?php $cnt = 1; ?>
				<tr>
			     	<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt;?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Setting Time</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
				</tr>
				<tr>
			     	<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Initial Setting Time (Minute)</td>
					<td rowspan=2 style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">2.25 times of the test cement</td>
					<td rowspan=2 style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-5) 1988</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['initial_time']!="" && $row_select_pipe1['initial_time']!="0" && $row_select_pipe1['initial_time']!=null){echo $row_select_pipe1['initial_time']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
			     	<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Final Setting Time (Minute)</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['final_time']!="" && $row_select_pipe1['final_time']!="0" && $row_select_pipe1['final_time']!=null){echo $row_select_pipe1['final_time']; }else{echo " <br>";}?></td>
				</tr>

				<tr>
			     	<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">2</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Soundness-Le-Chatelier (mm)</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-3) 1998</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['soundness']!="" && $row_select_pipe1['soundness']!="0" && $row_select_pipe1['soundness']!=null){echo $row_select_pipe1['soundness']; }else{echo " <br>";}?></td>
				</tr>


				
				<tr style="text-align:center;">
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">3</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Fineness by Blain Air Permeability (m<sup>2</sup>/kg)</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">250</td>
					<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-2) : 1999</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_fines_time']!="" && $row_select_pipe1['avg_fines_time']!="0" && $row_select_pipe1['avg_fines_time']!=null){echo $row_select_pipe1['avg_fines_time']; }else{echo " <br>";}?></td>
				</tr>
				<tr style="text-align:center;">
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">4</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Consistency (%)</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">IS 4031 (P-4) : 1988</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['final_consistency']!="" && $row_select_pipe1['final_consistency']!="0" && $row_select_pipe1['final_consistency']!=null){echo $row_select_pipe1['final_consistency']; }else{echo " <br>";}?></td>
				</tr>
				

				</tr>
						<tr style="text-align:center;">
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">5</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">Slag Activity Index, (%)</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">-</td>
					<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['com_humidity']!="" && $row_select_pipe1['com_humidity']!="0" && $row_select_pipe1['com_humidity']!=null){echo $row_select_pipe1['com_humidity']; }else{echo " <br>";}?></td>
				</tr>
				
				</tr>
						<tr style="text-align:center;">
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">a</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">7 Days</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">40%</td>
					<td  style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"rowspan=2>IS 4031 (P-4) : 1988</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;" ><?php if($row_select_pipe1['avg_com_2']!="" && $row_select_pipe1['avg_com_2']!="0" && $row_select_pipe1['avg_com_2']!=null){echo $row_select_pipe1['avg_com_2']; }else{echo " <br>";}?></td>
				</tr>
				</tr>
						<tr style="text-align:center;">
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">b</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">28 Days</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">65%</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe1['avg_com_3']!="" && $row_select_pipe1['avg_com_3']!="0" && $row_select_pipe1['avg_com_3']!=null){echo $row_select_pipe1['avg_com_3']; }else{echo " <br>";}?></td>
				</tr>
				



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
					<td ROWSPAN="3" style="border:1px solid black;">IS: 4031 (PART 6):1988 </td>
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
					<td ROWSPAN="3" style="border:1px solid black;">IS: 4031 (PART 6):1988 </td>
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