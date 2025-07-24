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
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);
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
				}
		?>
		
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<page size="A4">
		<table align="center" width="95%"  style="height:auto;font-size:13px;font-family: Arial;">		
			<tr>
				<td>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family: Arial;margin-left:35px; ">
			<tr>
				<td  style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
			</tr>
		</table>
		<table align="center" class="test" width="100%" style="font-size:11px;font-family: Arial;border:1px solid black;">
			<tr style="height:20px;"> 
				<td width="25%" style="">&nbsp;&nbsp; <?php if($ulr_number != "" && $ulr_number != "0" && $ulr_number != null){echo "<b>ULR:</b> ".$ulr_number;}?></td>
				<td width="75%" colspan="3" style="text-align:right; border-bottom: 1px solid black;  "><?php if($report_no != "" && $report_no != "0" && $report_no != null){ echo " ".$report_no;}?><b>&nbsp; / &nbsp; Date: </b> <?php echo date('d-m-Y', strtotime($issue_date));?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Report Submited To </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $clientname; ?></td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $mt_name;?> </td>
			</tr>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Name of Work </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $name_of_work; ?></td>
			</tr>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Name of Agency </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $agency_name; ?></td>
			</tr>
			<?php if($refno != "" && $refno != null && $date != "1970-01-01" && $date != ""){?>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Reference Letter No. </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $refno." / Date :- ".$date; ?></td>
			</tr>
			<?php } ?>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Date of Receipt of Sample </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date('d/m/Y',strtotime($rec_sample_date)); ?></td>
			</tr>
			<?php if($mark != null && $mark != ""){?>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Identification Mark</b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $mark; ?></td>
			</tr>
			<?php } ?>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Job No. </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no; ?></td>
			</tr>
			
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Lab No. </b></td>
				<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no; ?></td>
			</tr>
			<?php if($first_tag != null && $first_tag != ""){?>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp;<b><?php echo $first_tag;?></b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $first_txt;?></td>				
				</tr>
				<?php }if($second_tag != null && $second_tag != ""){?>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp;<b><?php echo $second_tag;?></b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $second_txt;?></td>				
				</tr>
				<?php }if($third_tag != null && $third_tag != ""){?>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp;<b><?php echo $third_tag;?></b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $third_txt;?></td>				
				</tr>
				<?php }if($fourth_tag != null && $fourth_tag != ""){?>
				<tr >
					<td style="border: 1px solid black;">&nbsp;&nbsp;<b><?php echo $fourth_tag;?></b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $fourth_txt;?></td>				
				</tr>
			<?php }?>
			<tr style="height:20px;"> 
				<td style="border: 1px solid black;">&nbsp;&nbsp; <b> Starting Date of Test </b></td>
				<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date('d/m/Y',strtotime($start_date)); ?></td>
				<td style="border: 1px solid black;text-align:right;"> <b> Completion Date of Test </b>&nbsp;&nbsp;</td>
				<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date('d/m/Y',strtotime($end_date)); ?></td>
			</tr>
		</table>
				</td>
			</tr>
			<tr>
				<td style="font-size:15px;text-align:center"><b><u>Test Result</u></b></td>
			</tr>
			<tr>
				<!--OTHER START-->
				<td>
					<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="10px">
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Particular</b></td>					
							<td style="border: 1px solid black; text-align:center;"><b>Specimen 1</b></td>					
							<td style="border: 1px solid black; text-align:center;"><b>Specimen 2</b></td>					
							<td style="border: 1px solid black; text-align:center;"><b>Specimen 3</b></td>					
						</tr>
						<tr>
							<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>Diameter (mm)</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b>Reading - 1</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read1_1']!="" && $row_select_pipe['d_read1_1']!="0" && $row_select_pipe['d_read1_1']!=null){echo $row_select_pipe['d_read1_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read1_2']!="" && $row_select_pipe['d_read1_2']!="0" && $row_select_pipe['d_read1_2']!=null){echo $row_select_pipe['d_read1_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read1_3']!="" && $row_select_pipe['d_read1_3']!="0" && $row_select_pipe['d_read1_3']!=null){echo $row_select_pipe['d_read1_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black; text-align:center;"><b>Reading - 2</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read2_1']!="" && $row_select_pipe['d_read2_1']!="0" && $row_select_pipe['d_read2_1']!=null){echo $row_select_pipe['d_read2_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read2_2']!="" && $row_select_pipe['d_read2_2']!="0" && $row_select_pipe['d_read2_2']!=null){echo $row_select_pipe['d_read2_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read2_3']!="" && $row_select_pipe['d_read2_3']!="0" && $row_select_pipe['d_read2_3']!=null){echo $row_select_pipe['d_read2_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black; text-align:center;"><b>Reading - 3</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read3_1']!="" && $row_select_pipe['d_read3_1']!="0" && $row_select_pipe['d_read3_1']!=null){echo $row_select_pipe['d_read3_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read3_2']!="" && $row_select_pipe['d_read3_2']!="0" && $row_select_pipe['d_read3_2']!=null){echo $row_select_pipe['d_read3_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read3_3']!="" && $row_select_pipe['d_read3_3']!="0" && $row_select_pipe['d_read3_3']!=null){echo $row_select_pipe['d_read3_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Average Diameter (mm)</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_dia1']!="" && $row_select_pipe['avg_dia1']!="0" && $row_select_pipe['avg_dia1']!=null){echo $row_select_pipe['avg_dia1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_dia2']!="" && $row_select_pipe['avg_dia2']!="0" && $row_select_pipe['avg_dia2']!=null){echo $row_select_pipe['avg_dia2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_dia3']!="" && $row_select_pipe['avg_dia3']!="0" && $row_select_pipe['avg_dia3']!=null){echo $row_select_pipe['avg_dia3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Length (mm)</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b>Reading - 1</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_1']!="" && $row_select_pipe['l_read1_1']!="0" && $row_select_pipe['l_read1_1']!=null){echo $row_select_pipe['l_read1_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_2']!="" && $row_select_pipe['l_read1_2']!="0" && $row_select_pipe['l_read1_2']!=null){echo $row_select_pipe['l_read1_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_3']!="" && $row_select_pipe['l_read1_3']!="0" && $row_select_pipe['l_read1_3']!=null){echo $row_select_pipe['l_read1_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black; text-align:center;"><b>Reading - 1</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_1']!="" && $row_select_pipe['l_read1_1']!="0" && $row_select_pipe['l_read1_1']!=null){echo $row_select_pipe['l_read1_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_2']!="" && $row_select_pipe['l_read1_2']!="0" && $row_select_pipe['l_read1_2']!=null){echo $row_select_pipe['l_read1_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_3']!="" && $row_select_pipe['l_read1_3']!="0" && $row_select_pipe['l_read1_3']!=null){echo $row_select_pipe['l_read1_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Average Length (mm)</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_dia1']!="" && $row_select_pipe['avg_dia1']!="0" && $row_select_pipe['avg_dia1']!=null){echo $row_select_pipe['avg_len1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_len2']!="" && $row_select_pipe['avg_len2']!="0" && $row_select_pipe['avg_len2']!=null){echo $row_select_pipe['avg_len2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_len3']!="" && $row_select_pipe['avg_len3']!="0" && $row_select_pipe['avg_len3']!=null){echo $row_select_pipe['avg_len3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Load (P)(KN)</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_load1']!="" && $row_select_pipe['spl_load1']!="0" && $row_select_pipe['spl_load1']!=null){echo $row_select_pipe['spl_load1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_load2']!="" && $row_select_pipe['spl_load2']!="0" && $row_select_pipe['spl_load2']!=null){echo $row_select_pipe['spl_load2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_load3']!="" && $row_select_pipe['spl_load3']!="0" && $row_select_pipe['spl_load3']!=null){echo $row_select_pipe['spl_load3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Splitting Strength (N/mm<sup>2</sup>) fc=</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_str1']!="" && $row_select_pipe['spl_str1']!="0" && $row_select_pipe['spl_str1']!=null){echo $row_select_pipe['spl_str1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_str2']!="" && $row_select_pipe['spl_str2']!="0" && $row_select_pipe['spl_str2']!=null){echo $row_select_pipe['spl_str2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['average']!="" && $row_select_pipe['average']!="0" && $row_select_pipe['average']!=null){echo $row_select_pipe['average']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Average (N/mm<sup>2</sup>) fc=</b></td>	
							<td colspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_avg1']!="" && $row_select_pipe['spl_avg1']!="0" && $row_select_pipe['spl_avg1']!=null){echo $row_select_pipe['spl_avg1']; }else{echo " <br>";}  ?></b></td>	
						</tr>
					</table>
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
					<table align="center" width="95%" style="font-family:arial; position:fixed;bottom:25px;">
						<tr>
							<td >
								<div style="margin-top:30px;">
									<b style="font-size:10px;">F/HRD/01, Issue No.01</b><br>
									<font style="font-size:10px">W.e.f. 01.11.2012</font><br>
								</div>
							</td>
							<td>
								<div style="float:right;margin-top:30px;">
									<b style="font-size:10px;">Page: 1<br>
								</div>
							</td>
						</tr>
					</table>
				</td>
			</tr>		
		</table>
		</page>
	
		
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">


</script>