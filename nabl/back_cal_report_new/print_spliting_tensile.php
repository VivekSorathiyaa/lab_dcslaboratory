<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin: 0; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 29.7cm;
  height: 21cm;  
} 

</style>
<style>
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
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from hard_concrete WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					$mark= $row_select4['mark'];
					$brick_specification= $row_select4['brick_specification'];
				}
		?>
		
		<br>
		<br>
		
		
	<page size="A4" >
		
			<table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>TEC Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td width="60%" style="border: 1px solid black;"><b>Spliting Tensile Strength of Concrete (IS 516 Part 1, Section1/IS:5816/ASTM C 496-96)</b></td>					
					<td style="border: 1px solid black;"><b>F-Concrete-03, Issue No.01, Page No 1 of 1</b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Lab. Ref. ID No: <?php echo $job_no;?></b></td>
					<td style="border: 1px solid black;"><b>Curring Condtion:  </b></td>	
				</tr>
				
				<tr>
					<td style="border: 1px solid black;"><b>Sample Receive Date: </b><?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>	
					<td style="border: 1px solid black;"><b>Testing Start Date: </b> <?php echo date('d/m/Y', strtotime($start_date));?></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Casting Date: <?php //echo date('d/m/Y', strtotime($issue_date));?></b></td>	
					<td style="border: 1px solid black;"><b>Testing Completion Date: </b><?php echo date('d/m/Y', strtotime($end_date));?></td>					
				</tr>
			</table>
			<table align="center" width="90%" class="test" style="border: 1px solid black;" cellpadding="10px">
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
				<tr>
					<td colspan="5" style="border: 1px solid black;"><b>Remarks:</b></td>	
				</tr>
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;position:fixed;bottom:30px;left:50px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table>
			</page>
		
	</body>
</html> 
		
	
<script type="text/javascript">
		window.print();
</script>