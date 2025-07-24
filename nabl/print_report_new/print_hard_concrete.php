<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;  
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
			function round_up($number, $precision = 0)
			{
				$fig = (int) str_pad('1', $precision, '0');
				return (ceil($number * $fig) / $fig);
			}
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe1 = mysqli_fetch_array($result_tiles_select);
			$no_of_rows=mysqli_num_rows($result_tiles_select);
			 $page_cont = round_up($no_of_rows/7);
			
			$ans = mysqli_fetch_array($result_tiles_select);
				
				
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
					$cc_grade= $row_select4['cc_grade'];
					$cc_set_of_cube= $row_select4['cc_set_of_cube'];
					$cc_no_of_cube= $row_select4['cc_no_of_cube'];
					$cc_identification_mark= $row_select4['cc_identification_mark'];
					$day_remark= $row_select4['day_remark'];
					$casting_date= $row_select4['casting_date'];
					$material_location= $row_select4['material_location'];
				}
				
			$flag=0;
			$a = 1;
			$down=0;
			$up = 7;
			for($a=1;$a<=$page_cont;$a++)
			{

		?>
		
		<div id="header">
			<br>
		</div>
	
		<page size="A4">
		<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-left:35px; ">
		<tr>
				<td  style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
		</tr>
		</table>
		<table align="center" width="92%"  cellspacing="0" cellpadding="0" style="font-size:11px;font-family: Arial;border:1px solid black;margin-left:35px;border-bottom: 0px solid black;">
		<tr style="border: 1px solid black;height:20px;"> 
				<td  style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if($row_select_pipe1['ulr'] != "" && $row_select_pipe1['ulr'] != "0" && $row_select_pipe1['ulr'] != null){
					echo "<b>ULR:</b> ".$row_select_pipe1['ulr'];}?></td>
				
				<td colspan="3" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){
					echo " ".$report_no;}?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d/m/Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of Work</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; padding-left:10px;"><?php echo $name_of_work;?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $mt_name;?> </td>
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
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php //echo $clientname; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Consultant</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp;  <?php // echo $clientname; ?> </td>
			</tr>-->
			
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
				
		</table>
		
			
		<table align="center" width="92%"  class="test" style="height:Auto;width:92%;margin-left:35px;" >
		<tr>
			<td style="font-size:15px;text-align:center"><b><u>Test Result</u></b></td>
		</tr>
		</table>
		<br>
		
		
		<?php if($row_select_pipe1['spl_avg1']!="" && $row_select_pipe1['spl_avg1']!="0" && $row_select_pipe1['spl_avg1']!=null){ ?>
			<table align="center" width="92%"  class="test" style="height:Auto;width:92%;margin-left:35px;" >
				<tr>
					<td  style="border:1px solid black; text-align:center; widdth:5%;"><b>Sample ID</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Date of Casting</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Date of Testing</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:5%;"><b>Age of Testing</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Dia Meter (mm)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Height(mm)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Maximum Load(KN)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Split Tensile Strength(N/mm<sup>2</sup>)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Average Split Tensile Strength(N/mm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>1/3</b></td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['cast_date']!="" && $row_select_pipe1['cast_date']!="0" && $row_select_pipe1['cast_date']!=null){echo $row_select_pipe1['cast_date']; }else{echo " <br>";}  ?></b></td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['test_date']!="" && $row_select_pipe1['test_date']!="0" && $row_select_pipe1['test_date']!=null){echo $row_select_pipe1['test_date']; }else{echo " <br>";}  ?></b></td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_l']!="" && $row_select_pipe1['avg_l']!="0" && $row_select_pipe1['avg_l']!=null){echo $row_select_pipe1['avg_l']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_dia1']!="" && $row_select_pipe1['avg_dia1']!="0" && $row_select_pipe1['avg_dia1']!=null){echo $row_select_pipe1['avg_dia1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_len1']!="" && $row_select_pipe1['avg_len1']!="0" && $row_select_pipe1['avg_len1']!=null){echo $row_select_pipe1['avg_len1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['spl_load1']!="" && $row_select_pipe1['spl_load1']!="0" && $row_select_pipe1['spl_load1']!=null){echo $row_select_pipe1['spl_load1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['spl_str1']!="" && $row_select_pipe1['spl_str1']!="0" && $row_select_pipe1['spl_str1']!=null){echo $row_select_pipe1['spl_str1']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['spl_avg1']!="" && $row_select_pipe1['spl_avg1']!="0" && $row_select_pipe1['spl_avg1']!=null){echo $row_select_pipe1['spl_avg1']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>2/3</b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_dia2']!="" && $row_select_pipe1['avg_dia2']!="0" && $row_select_pipe1['avg_dia2']!=null){echo $row_select_pipe1['avg_dia2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_len2']!="" && $row_select_pipe1['avg_len2']!="0" && $row_select_pipe1['avg_len2']!=null){echo $row_select_pipe1['avg_len2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['spl_load2']!="" && $row_select_pipe1['spl_load2']!="0" && $row_select_pipe1['spl_load2']!=null){echo $row_select_pipe1['spl_load2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['spl_str2']!="" && $row_select_pipe1['spl_str2']!="0" && $row_select_pipe1['spl_str2']!=null){echo $row_select_pipe1['spl_str2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>3/3</b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_dia3']!="" && $row_select_pipe1['avg_dia3']!="0" && $row_select_pipe1['avg_dia3']!=null){echo $row_select_pipe1['avg_dia3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg_len3']!="" && $row_select_pipe1['avg_len3']!="0" && $row_select_pipe1['avg_len3']!=null){echo $row_select_pipe1['avg_len3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['spl_load3']!="" && $row_select_pipe1['spl_load3']!="0" && $row_select_pipe1['spl_load3']!=null){echo $row_select_pipe1['spl_load3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['average']!="" && $row_select_pipe1['average']!="0" && $row_select_pipe1['average']!=null){echo $row_select_pipe1['average']; }else{echo " <br>";}  ?></b></td>
				</tr>
			</table>
		
		<?php } if($row_select_pipe1['avg1']!="" && $row_select_pipe1['avg1']!="0" && $row_select_pipe1['avg1']!=null){ ?>
			<br>
			<table align="center" width="92%"  class="test" style="height:Auto;width:92%;margin-left:35px;" >
				<tr>
					<td  style="border:1px solid black; text-align:center; widdth:5%;"><b>Sample ID</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Date of Casting</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Date of Testing</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:5%;"><b>Age of Testing</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Width (mm)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Depth(mm)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Span Length (mm)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Position of Fracture (a)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Maximum Load(KN)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Flexural Strength(N/mm<sup>2</sup>)</b></td>
					<td  style="border:1px solid black; text-align:center; widdth:10%;"><b>Average Flexural Strength(N/mm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>1/3</b></td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;"><b><?php echo date("d/m/Y", strtotime($start_date));?></b></td>
					<td  rowspan="3" style="border:1px solid black; text-align:center;"><b><?php echo date("d/m/Y", strtotime($end_date));?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php echo "7";  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['l1']!="" && $row_select_pipe1['l1']!="0" && $row_select_pipe1['l1']!=null){echo $row_select_pipe1['l1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['d1']!="" && $row_select_pipe1['d1']!="0" && $row_select_pipe1['d1']!=null){echo $row_select_pipe1['d1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['len1']!="" && $row_select_pipe1['len1']!="0" && $row_select_pipe1['len1']!=null){echo $row_select_pipe1['len1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['pos1']!="" && $row_select_pipe1['pos1']!="0" && $row_select_pipe1['pos1']!=null){echo $row_select_pipe1['pos1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['max1']!="" && $row_select_pipe1['max1']!="0" && $row_select_pipe1['max1']!=null){echo $row_select_pipe1['max1']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['mod1']!="" && $row_select_pipe1['mod1']!="0" && $row_select_pipe1['mod1']!=null){echo $row_select_pipe1['mod1']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['avg1']!="" && $row_select_pipe1['avg1']!="0" && $row_select_pipe1['avg1']!=null){echo $row_select_pipe1['avg1']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>2/3</b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php echo "7";  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['l2']!="" && $row_select_pipe1['l2']!="0" && $row_select_pipe1['l2']!=null){echo $row_select_pipe1['l2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['d2']!="" && $row_select_pipe1['d2']!="0" && $row_select_pipe1['d2']!=null){echo $row_select_pipe1['d2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['len2']!="" && $row_select_pipe1['len2']!="0" && $row_select_pipe1['len2']!=null){echo $row_select_pipe1['len2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['pos2']!="" && $row_select_pipe1['pos2']!="0" && $row_select_pipe1['pos2']!=null){echo $row_select_pipe1['pos2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['max2']!="" && $row_select_pipe1['max2']!="0" && $row_select_pipe1['max2']!=null){echo $row_select_pipe1['max2']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['mod2']!="" && $row_select_pipe1['mod2']!="0" && $row_select_pipe1['mod2']!=null){echo $row_select_pipe1['mod2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td  style="border:1px solid black; text-align:center;"><b>3/3</b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php echo "7";  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['l3']!="" && $row_select_pipe1['l3']!="0" && $row_select_pipe1['l3']!=null){echo $row_select_pipe1['l3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['d3']!="" && $row_select_pipe1['d3']!="0" && $row_select_pipe1['d3']!=null){echo $row_select_pipe1['d3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['len3']!="" && $row_select_pipe1['len3']!="0" && $row_select_pipe1['len3']!=null){echo $row_select_pipe1['len3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['pos3']!="" && $row_select_pipe1['pos3']!="0" && $row_select_pipe1['pos3']!=null){echo $row_select_pipe1['pos3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['max3']!="" && $row_select_pipe1['max3']!="0" && $row_select_pipe1['max3']!=null){echo $row_select_pipe1['max3']; }else{echo " <br>";}  ?></b></td>
					<td  style="border:1px solid black; text-align:center;"><b><?php if($row_select_pipe1['mod3']!="" && $row_select_pipe1['mod3']!="0" && $row_select_pipe1['mod3']!=null){echo $row_select_pipe1['mod3']; }else{echo " <br>";}  ?></b></td>
				</tr>
			</table>
		
		<?php }  ?>
		
		
		<br>
				<table align="center" width="92%" class="test" style="border:1px solid black;margin-left:35px; ">
			<tr>
				<td style="text-align:left; font-size:10px; padding:2px;">&nbsp;&nbsp; <b>Note:-</b> [1]Test results are related to samples submitted by Customer only.[2]Results/Reports are issued with specific understanding that TMTL will not in any case be involved in action following the information of test result.[3]Results /Reports are not supposed to be used for publicity.[4]Test report shall not be reproduced except in full without written approval of Quality Manager/ Technical Manager.</td>
			</tr>
			<tr>				
				<td colspan="2" style="border:0px solid black;border-bottom:0px solid black;"><input Style="width:100%; border:none; font-weight:bold;" type="text" value=" "></td>
				
			</tr>
		</table>
			<br>
		
				<br>
		<br>
		<br>
		<br>
		
		
		<table align="center" width="92%"  class="test" style="height:auto;font-family: Arial;margin-left:35px;" >
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
		<table align="center" width="92%" class="test" style="font-family:arial;">
			<tr>
				<td >
					<div style="margin-top:30px;">
						<b style="font-size:10px;">F/HRD/01, Issue No.01</b><br>
						<font style="font-size:10px">W.e.f. 01.11.2012</font><br>
					</div>
				</td>
				<td>
					<div style="float:right;margin-top:30px;">
						<b style="font-size:10px;">Page: 1 of 2<br>
					</div>
				</td>
			</tr>
		</table>
			</td>
			
		</tr>		
		</table>
		
		<table align="center" width="95%"  style="height:auto;font-size:13px;font-family: Arial;">
		
	
		<!--OTHER START-->
		<td>
			
			
			
			
			
			
		</td>
		</tr>
		<tr>
			<td>
				<table align="center" width="100%" style="border-top:1px solid black;font-size:11px;" class="test">
					<tr>
						<td style="text-align:left;" VALIGN=TOP ><b>Note :-</b></td>
						<td style="width:95%;"><p>The Above test result are related only to the test performed on the given sample Endorsement of the product is neither inferred nor implied. Results/Reports are not supposed to be use for publicity. This test report is not to be reproduced wholly or in part and cannot be use as an evidence without approval TEC Material Testing Laboratory.							
						</td>
					</tr>
				</table>
			</td>
			
		</tr>
		<tr>
		<td style="text-align:center;width:33%;font-weight:bold;">*** END OF REPORT ***</td>
		</tr>
		<tr>
			<td >
				<br>
		<br>
		<br>
		<table align="center" width="92%"  class="test" style="height:auto;font-family: Arial;margin-left:35px;" >
			<tr>
					<td style="">
						<div style="float:right;" id="footer">
							
						</div>
					</td>
					<td style="width:50%;">
					<div style="float:right;text-align:center;">
						<b style="font-size:16px;">For.  TEC Material Testing Laboratory</b><br>
						<b style="font-size:14px;">Authorized Signatory</b><br>
						<b style="font-size:14px;">Jignesh Sorathiya</b>
					</div>
						
					</td>
				</tr>
		</table>
		<table align="center" width="95%" style="font-family:arial;">
			<tr>
				<td >
					<div style="margin-top:30px;">
						<b style="font-size:10px;">F/HRD/01, Issue No.01</b><br>
						<font style="font-size:10px">W.e.f. 01.11.2012</font><br>
					</div>
				</td>
				<td>
					<div style="float:right;margin-top:30px;">
						<b style="font-size:10px;">Page: 2 of 2<br>
					</div>
				</td>
			</tr>
		</table>
			</td>
			
		</tr>		
		</table>
		
		</page>
	

			<?php 
			
			
			}
			
		?>
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">


</script>