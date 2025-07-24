<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0 30px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 29.7cm;
  height: 21cm;  
} 

.tdclass{
    border: 1px solid black;
    font-size:11px;
	 font-family : Calibri;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family : Calibri;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family : Calibri;
	 
}
.tdclass1{    
    font-size:11px;
	 font-family : Calibri;
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
			$select_tiles_query = "select * from micro_silica WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$branch_name = $row_select['branch_name'];			
			if($cons == 0)
			{
				$con_sample = "Sealed Ok";
			}
			else
			{
				$con_sample = "Unsealed";
			}
			$name_of_work= strip_tags(html_entity_decode($row_select['nameofwork']),"<strong><em>");						

			$select_query1 = "select * from agency_master where `isdeleted`=0 WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
					include_once 'sample_id.php';
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
		
		<br>
		<br><br>
		
		<page size="A4" >
			<!-- header design -->
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">OBSERVATION OF <?php echo $detail_sample; ?></td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
			</table>
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
				<tr>
					<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
					<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS</td>
					<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
					<td style="font-weight: bold;padding: 5px;"><?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
				</tr>
				<tr>
					<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
					<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
					<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
					<td style="font-weight: bold;padding: 5px;"><?php echo $detail_sample; ?></td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
				</tr>
			</table>
			<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
				<!-- <tr>
					<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
					<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 516 (Part – 1/Sec – 1): 2021 SECTION 4</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
				</tr> -->
				<tr>
					<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
				</tr>
			</table>
			<!-- table design -->
		<table align="center" width="100%" class="test1">
			<tr style="border: 1px solid black;border-top: 0;">
				<td style="text-align:center;padding:3px 3px;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>&nbsp; Starting Date</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;">&nbsp; <?php echo date("d/m/Y",strtotime($start_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding:3px 3px;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>&nbsp; Completion Date</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;">&nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test1">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;border-bottom:0px;">&nbsp; <b>1. &nbsp;&nbsp;Particle Retained on 45&#xb5; / 75&#xb5; Sieve (Wet)</b></td>
			
				<td style="border:1px solid;border-bottom:0px;text-align:left;padding:8px 3px;width:31%;"><b>&nbsp;&nbsp;&nbsp; Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($casting_date)); ?></b></td>
			</tr>
		</table>
		<?php $cnt = 1; ?>
		<table align="center" width="100%" class="test1">
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:10px 3px;"><b><center>Idetification</center></b></td>
				<td style="text-align:center;padding:10px 3px;width:15%;"><b>Initial Weight (gm)</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:15%;"><b>Final Weight (gm)</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:15%;"><b>Particle Ret On  45&#xb5; / 75&#xb5; Sieve (%)</b></td>
				<td style="border-left:1px solid;text-align:center;padding:10px 3px;width:17%;"><b>Average of two Sample (%)</b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:8px 3px;"><b><center><?php echo $cnt++; ?></center></b></td>
				<td style="text-align:center;padding:8px 3px;"><?php echo $row_select_pipe['w1_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $row_select_pipe['w2_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $row_select_pipe['w3_1']; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;" rowspan=2><?php echo $row_select_pipe["avg_wet"];?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="width:7%;border-right:1px solid;padding:8px 3px;"><b><center><?php echo $cnt++; ?></center></b></td>
				<td style="text-align:center;padding:8px 3px;"><?php echo $row_select_pipe['w1_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $row_select_pipe['w2_2']; ?></td>
				<td style="border-left:1px solid;text-align:center;padding:8px 3px;"><?php echo $row_select_pipe['w3_2']; ?></td>
			</tr>
		</table>
		<br>
		
		<table align="center" width="100%" class="test1">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;border-bottom:0px;">&nbsp; <b>2. &nbsp;&nbsp;Worksheet for Moisture Content of Micro Silica(IS 1727)</b></td>
			
				<td style="border:1px solid;border-bottom:0px;text-align:left;padding:8px 3px;width:31%;"><b>&nbsp;&nbsp;&nbsp; Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($casting_date)); ?></b></td>
			</tr>
		</table>
		<table align="center" width="100%"  class="test"  style="border: 1px solid black;" >
				<tr>
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><b>Initial weight in (gm) (W1)</b></td>
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><b>Oven dry weight in (gm) (W2)</b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><b>Moisture Content (%) = (W1 - W2/W1) x 100</b></td>			
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><?php if($row_select_pipe['in_w1']!="" && $row_select_pipe['in_w1']!="0" && $row_select_pipe['in_w1']!=null){echo $row_select_pipe['in_w1']; }else{echo "&nbsp;";}?></td>
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><?php if($row_select_pipe['fn_w1']!="" && $row_select_pipe['fn_w1']!="0" && $row_select_pipe['fn_w1']!=null){echo $row_select_pipe['fn_w1']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><?php if($row_select_pipe['mo1']!="" && $row_select_pipe['mo1']!="0" && $row_select_pipe['mo1']!=null){echo $row_select_pipe['mo1']; }else{echo "&nbsp;";}?></td>			
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><?php if($row_select_pipe['in_w2']!="" && $row_select_pipe['in_w2']!="0" && $row_select_pipe['in_w2']!=null){echo $row_select_pipe['in_w2']; }else{echo "&nbsp;";}?></td>
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><?php if($row_select_pipe['fn_w2']!="" && $row_select_pipe['fn_w2']!="0" && $row_select_pipe['fn_w2']!=null){echo $row_select_pipe['fn_w2']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><?php if($row_select_pipe['mo2']!="" && $row_select_pipe['mo2']!="0" && $row_select_pipe['mo2']!=null){echo $row_select_pipe['mo2']; }else{echo "&nbsp;";}?></td>			
				</tr>
				<tr>
					<td colspan="2"style="border: 1px solid black; width:10%; text-align:right;padding:10px 3px;"><b>Average:</b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;padding:10px 3px;"><b><?php if($row_select_pipe['avg_mo']!="" && $row_select_pipe['avg_mo']!="0" && $row_select_pipe['avg_mo']!=null){echo $row_select_pipe['avg_mo']; }else{echo "&nbsp;";}?></b></td>			
				</tr>
		</table>
		<br><br>

		<!-- footer design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
		<table align="center" width="100%"  style="margin-top: 2px;font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
			</tr>
			<tr>
				<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 2</td>
			</tr>
			
		</table>

		<div class="pagebreak"></div>
		<br><br><br>

		
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;">OBSERVATION OF <?php echo $detail_sample; ?></td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;width: 21%;">Format No :-</td>
				<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS</td>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
				<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Material Description :-</td>
				<td style="font-weight: bold;padding: 5px;"><?php echo $detail_sample; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
			</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 516 (Part – 1/Sec – 1): 2021 SECTION 4</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr> -->
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1">
			<tr style="border: 1px solid black;border-top: 0;">
				<td style="text-align:center;padding:3px 3px;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>&nbsp; Starting Date</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;">&nbsp; <?php echo date("d/m/Y",strtotime($start_date)); ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;padding:3px 3px;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;"><b>&nbsp; Completion Date</b></td>
				<td style="border-left:1px solid;text-align:left;padding:3px 3px;">&nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
			</tr>
		</table>
		<br><br>

		<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td  style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>*</b></td>						
					<td style="border: 1px solid black;text-align:center;padding:10px 5px;"><b>Date & Time of Casting</b></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Date & Time of Testing</b></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Age at The Time of Testing</b></td>					
					<td width="5%"style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>ID</b></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Lenth, (mm)</b></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Width, (mm)</b></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Area, (mm<sup>2</sup>)</b></td>	
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>load (kN)</b></td>	
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Comp Strength, N/mm<sup>2</sup></b></td>	
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Avg. Comp. Strength,  N/mm<sup>2</sup></b></td>	
				</tr>
				
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Compressive Strength(Lime Reactivity) (N/mm<sup>2</sup>)</b></td>				
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['caste_date1']!="" && $row_select_pipe['caste_date1']!="0" && $row_select_pipe['caste_date1']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date1'])); }else{echo "&nbsp;";}?></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['test_date1']!="" && $row_select_pipe['test_date1']!="0" && $row_select_pipe['test_date1']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date1'])); }else{echo "&nbsp;";}?></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['age1']!="" && $row_select_pipe['age1']!="0" && $row_select_pipe['age1']!=null){echo $row_select_pipe['age1']; }else{echo "&nbsp;";}?></td>	
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id1']!="" && $row_select_pipe['id1']!="0" && $row_select_pipe['id1']!=null){echo $row_select_pipe['id1']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi1']!="" && $row_select_pipe['wi1']!="0" && $row_select_pipe['wi1']!=null){echo $row_select_pipe['wi1']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a1']!="" && $row_select_pipe['a1']!="0" && $row_select_pipe['a1']!=null){echo $row_select_pipe['a1']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_1']!="" && $row_select_pipe['load_1']!="0" && $row_select_pipe['load_1']!=null){echo $row_select_pipe['load_1']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_1']!="" && $row_select_pipe['com_1']!="0" && $row_select_pipe['com_1']!=null){echo $row_select_pipe['com_1']; }else{echo "&nbsp;";}?></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['avg_lime']!="" && $row_select_pipe['avg_lime']!="0" && $row_select_pipe['avg_lime']!=null){echo $row_select_pipe['avg_lime']; }else{echo "&nbsp;";}?></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id2']!="" && $row_select_pipe['id2']!="0" && $row_select_pipe['id2']!=null){echo $row_select_pipe['id2']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l2']!="" && $row_select_pipe['l2']!="0" && $row_select_pipe['l2']!=null){echo $row_select_pipe['l2']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi2']!="" && $row_select_pipe['wi2']!="0" && $row_select_pipe['wi2']!=null){echo $row_select_pipe['wi2']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a2']!="" && $row_select_pipe['a2']!="0" && $row_select_pipe['a2']!=null){echo $row_select_pipe['a2']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_2']!="" && $row_select_pipe['load_2']!="0" && $row_select_pipe['load_2']!=null){echo $row_select_pipe['load_2']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_2']!="" && $row_select_pipe['com_2']!="0" && $row_select_pipe['com_2']!=null){echo $row_select_pipe['com_2']; }else{echo "&nbsp;";}?></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id3']!="" && $row_select_pipe['id3']!="0" && $row_select_pipe['id3']!=null){echo $row_select_pipe['id3']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l3']!="" && $row_select_pipe['l3']!="0" && $row_select_pipe['l3']!=null){echo $row_select_pipe['l3']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi3']!="" && $row_select_pipe['wi3']!="0" && $row_select_pipe['wi3']!=null){echo $row_select_pipe['wi3']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a3']!="" && $row_select_pipe['a3']!="0" && $row_select_pipe['a3']!=null){echo $row_select_pipe['a3']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_3']!="" && $row_select_pipe['load_3']!="0" && $row_select_pipe['load_3']!=null){echo $row_select_pipe['load_3']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_3']!="" && $row_select_pipe['com_3']!="0" && $row_select_pipe['com_3']!=null){echo $row_select_pipe['com_3']; }else{echo "&nbsp;";}?></td>	
				</tr>
				
				
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Compressive Strength(Cement Mortar)(7 Days)(N/mm<sup>2</sup>)</b></td>				
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['caste_date2']!="" && $row_select_pipe['caste_date2']!="0" && $row_select_pipe['caste_date2']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date2'])); }else{echo "&nbsp;";}?></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['test_date2']!="" && $row_select_pipe['test_date2']!="0" && $row_select_pipe['test_date2']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date2'])); }else{echo "&nbsp;";}?></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['age2']!="" && $row_select_pipe['age2']!="0" && $row_select_pipe['age2']!=null){echo $row_select_pipe['age2']; }else{echo "&nbsp;";}?></td>	
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id4']!="" && $row_select_pipe['id4']!="0" && $row_select_pipe['id4']!=null){echo $row_select_pipe['id4']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l4']!="" && $row_select_pipe['l4']!="0" && $row_select_pipe['l4']!=null){echo $row_select_pipe['l4']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi4']!="" && $row_select_pipe['wi4']!="0" && $row_select_pipe['wi4']!=null){echo $row_select_pipe['wi4']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a4']!="" && $row_select_pipe['a4']!="0" && $row_select_pipe['a4']!=null){echo $row_select_pipe['a4']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_4']!="" && $row_select_pipe['load_4']!="0" && $row_select_pipe['load_4']!=null){echo $row_select_pipe['load_4']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_4']!="" && $row_select_pipe['com_4']!="0" && $row_select_pipe['com_4']!=null){echo $row_select_pipe['com_4']; }else{echo "&nbsp;";}?></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['avg_cem']!="" && $row_select_pipe['avg_cem']!="0" && $row_select_pipe['avg_cem']!=null){echo $row_select_pipe['avg_cem']; }else{echo "&nbsp;";}?></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id5']!="" && $row_select_pipe['id5']!="0" && $row_select_pipe['id5']!=null){echo $row_select_pipe['id5']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l5']!="" && $row_select_pipe['l5']!="0" && $row_select_pipe['l5']!=null){echo $row_select_pipe['l5']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi5']!="" && $row_select_pipe['wi5']!="0" && $row_select_pipe['wi5']!=null){echo $row_select_pipe['wi5']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a5']!="" && $row_select_pipe['a5']!="0" && $row_select_pipe['a5']!=null){echo $row_select_pipe['a5']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_5']!="" && $row_select_pipe['load_5']!="0" && $row_select_pipe['load_5']!=null){echo $row_select_pipe['load_5']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_5']!="" && $row_select_pipe['com_5']!="0" && $row_select_pipe['com_5']!=null){echo $row_select_pipe['com_5']; }else{echo "&nbsp;";}?></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id6']!="" && $row_select_pipe['id6']!="0" && $row_select_pipe['id6']!=null){echo $row_select_pipe['id6']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l6']!="" && $row_select_pipe['l6']!="0" && $row_select_pipe['l6']!=null){echo $row_select_pipe['l6']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi6']!="" && $row_select_pipe['wi6']!="0" && $row_select_pipe['wi6']!=null){echo $row_select_pipe['wi6']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a6']!="" && $row_select_pipe['a6']!="0" && $row_select_pipe['a6']!=null){echo $row_select_pipe['a6']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_6']!="" && $row_select_pipe['load_6']!="0" && $row_select_pipe['load_6']!=null){echo $row_select_pipe['load_6']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_6']!="" && $row_select_pipe['com_6']!="0" && $row_select_pipe['com_6']!=null){echo $row_select_pipe['com_6']; }else{echo "&nbsp;";}?></td>	
				</tr>
				
				
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><b>Compressive Strength (Silica Mortar Cube)(7 Days)(N/mm<sup>2</sup>)</b></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['caste_date3']!="" && $row_select_pipe['caste_date3']!="0" && $row_select_pipe['caste_date3']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date3'])); }else{echo "&nbsp;";}?></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['test_date3']!="" && $row_select_pipe['test_date3']!="0" && $row_select_pipe['test_date3']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date3'])); }else{echo "&nbsp;";}?></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['age3']!="" && $row_select_pipe['age3']!="0" && $row_select_pipe['age3']!=null){echo $row_select_pipe['age3']; }else{echo "&nbsp;";}?></td>	
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id7']!="" && $row_select_pipe['id7']!="0" && $row_select_pipe['id7']!=null){echo $row_select_pipe['id7']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l7']!="" && $row_select_pipe['l7']!="0" && $row_select_pipe['l7']!=null){echo $row_select_pipe['l7']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi7']!="" && $row_select_pipe['wi7']!="0" && $row_select_pipe['wi7']!=null){echo $row_select_pipe['wi7']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a7']!="" && $row_select_pipe['a7']!="0" && $row_select_pipe['a7']!=null){echo $row_select_pipe['a7']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_7']!="" && $row_select_pipe['load_7']!="0" && $row_select_pipe['load_7']!=null){echo $row_select_pipe['load_7']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_7']!="" && $row_select_pipe['com_7']!="0" && $row_select_pipe['com_7']!=null){echo $row_select_pipe['com_7']; }else{echo "&nbsp;";}?></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['avg_fly']!="" && $row_select_pipe['avg_fly']!="0" && $row_select_pipe['avg_fly']!=null){echo $row_select_pipe['avg_fly']; }else{echo "&nbsp;";}?></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id8']!="" && $row_select_pipe['id8']!="0" && $row_select_pipe['id8']!=null){echo $row_select_pipe['id8']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l8']!="" && $row_select_pipe['l8']!="0" && $row_select_pipe['l8']!=null){echo $row_select_pipe['l8']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi8']!="" && $row_select_pipe['wi8']!="0" && $row_select_pipe['wi8']!=null){echo $row_select_pipe['wi8']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a8']!="" && $row_select_pipe['a8']!="0" && $row_select_pipe['a8']!=null){echo $row_select_pipe['a8']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_8']!="" && $row_select_pipe['load_8']!="0" && $row_select_pipe['load_8']!=null){echo $row_select_pipe['load_8']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_8']!="" && $row_select_pipe['com_8']!="0" && $row_select_pipe['com_8']!=null){echo $row_select_pipe['com_8']; }else{echo "&nbsp;";}?></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['id9']!="" && $row_select_pipe['id9']!="0" && $row_select_pipe['id9']!=null){echo $row_select_pipe['id9']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['l9']!="" && $row_select_pipe['l9']!="0" && $row_select_pipe['l9']!=null){echo $row_select_pipe['l9']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['wi9']!="" && $row_select_pipe['wi9']!="0" && $row_select_pipe['wi9']!=null){echo $row_select_pipe['wi9']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['a9']!="" && $row_select_pipe['a9']!="0" && $row_select_pipe['a9']!=null){echo $row_select_pipe['a9']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['load_9']!="" && $row_select_pipe['load_9']!="0" && $row_select_pipe['load_9']!=null){echo $row_select_pipe['load_9']; }else{echo "&nbsp;";}?></td>					
					<td style="border: 1px solid black; text-align:center;padding:10px 5px;"><?php if($row_select_pipe['com_9']!="" && $row_select_pipe['com_9']!="0" && $row_select_pipe['com_9']!=null){echo $row_select_pipe['com_9']; }else{echo "&nbsp;";}?></td>	
				</tr>
		</table>
		<br><br>

		<!-- footer design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border: 1px solid; ">
			<!-- <tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-left: 1px solid; width:15%">Remarks :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;" colspan="3"><?php echo $row_select_pipe['sl_2'];?></td>
			</tr> -->
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;width: 15%;border-left: 1px solid;border-top: 1px solid;">Checked By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;width: 12%;border: 1px solid;">Tested By :-</td>
				<td style="padding: 5px;border-left: 1px solid;border: 1px solid;border: 1px solid;"></td>
			</tr>
			<tr>
				<td style="height: 35px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
			</tr>
			
		</table>
		<table align="center" width="100%"  style="margin-top: 2px;font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  03</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue Date :-  <?php echo date('d/m/Y', strtotime($issue_date)); ?>   </td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Prepared & Issued By</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Reviewed & Approved By</td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend No :-  01</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($row_select_pipe["amend_date"])); ?></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
			</tr>
			<tr>
				<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 2 of 2</td>
			</tr>
			
		</table>

		</page>
	</body>
</html> 