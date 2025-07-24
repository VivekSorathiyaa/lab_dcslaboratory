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

</style>
<style>
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
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
				$cast_date = $row_select_pipe['cast_date'];
				$issue_date = $row_select2['issue_date'];
				$cast_time = $row_select_pipe['cast_time'];
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
					$paver_shape= $row_select4['paver_shape'];
					$paver_age= $row_select4['paver_age'];
					$paver_color= $row_select4['paver_color'];
					$paver_thickness= $row_select4['paver_thickness'];
					$paver_grade= $row_select4['paver_grade'];
				}
				
				$pagecnt=1;
				$totalcnt=1;
				if($row_select_pipe['avgv']!="" && $row_select_pipe['avgv']!="0" && $row_select_pipe['avgv']!=null)
					{
						$totalcnt++;
					}
				
		?>
		
		<br>
		
		<page size="A4" >
			<!--
			<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>TEC Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td width="60%" style="border: 1px solid black;"><b>Worksheet for Flexural strength of Hard Concrete (IS 516 - 1959)</b></td>					
					<td style="border: 1px solid black;"><b>F-Concrete-02, Issue No.01, Page No 1 of 1</b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Lab. Ref. ID No: <?php echo $job_no;?></b></td>
					<td style="border: 1px solid black;"><b>Curring Condtion:  </b></td>	
				</tr>
				
				<tr>
					<td style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>	
					<td style="border: 1px solid black;"><b>Sample Testing Date: </b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Casting Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>	
					<td style="border: 1px solid black;"><b>Testing Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>					
				</tr>
			</table>
			<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Age of Specimen (Days)</b></td>
					<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Size of Specimen (mm)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Span Length (mm)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Max Load (p)(kN)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Position of Fracture (a)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Modulus of rupture (N/mm<sup>2</sup>) </b></td>
					<td rowspan="2"style="border: 1px solid black; text-align:center;"><b>Average</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>L</b></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>B</b></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>D</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['age1']!="" && $row_select_pipe['age1']!="0" && $row_select_pipe['age1']!=null){echo $row_select_pipe['age1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b1']!="" && $row_select_pipe['b1']!="0" && $row_select_pipe['b1']!=null){echo $row_select_pipe['b1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d1']!="" && $row_select_pipe['d1']!="0" && $row_select_pipe['d1']!=null){echo $row_select_pipe['d1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len1']!="" && $row_select_pipe['len1']!="0" && $row_select_pipe['len1']!=null){echo $row_select_pipe['len1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['max1']!="" && $row_select_pipe['max1']!="0" && $row_select_pipe['max1']!=null){echo $row_select_pipe['max1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['pos1']!="" && $row_select_pipe['pos1']!="0" && $row_select_pipe['pos1']!=null){echo $row_select_pipe['pos1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mod1']!="" && $row_select_pipe['mod1']!="0" && $row_select_pipe['mod1']!=null){echo $row_select_pipe['mod1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg1']!="" && $row_select_pipe['avg1']!="0" && $row_select_pipe['avg1']!=null){echo $row_select_pipe['avg1']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['age2']!="" && $row_select_pipe['age2']!="0" && $row_select_pipe['age2']!=null){echo $row_select_pipe['age2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l2']!="" && $row_select_pipe['l2']!="0" && $row_select_pipe['l2']!=null){echo $row_select_pipe['l2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b2']!="" && $row_select_pipe['b2']!="0" && $row_select_pipe['b2']!=null){echo $row_select_pipe['b2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d2']!="" && $row_select_pipe['d2']!="0" && $row_select_pipe['d2']!=null){echo $row_select_pipe['d2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len2']!="" && $row_select_pipe['len2']!="0" && $row_select_pipe['len2']!=null){echo $row_select_pipe['len2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['max2']!="" && $row_select_pipe['max2']!="0" && $row_select_pipe['max2']!=null){echo $row_select_pipe['max2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['pos2']!="" && $row_select_pipe['pos2']!="0" && $row_select_pipe['pos2']!=null){echo $row_select_pipe['pos2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mod2']!="" && $row_select_pipe['mod2']!="0" && $row_select_pipe['mod2']!=null){echo $row_select_pipe['mod2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg2']!="" && $row_select_pipe['avg2']!="0" && $row_select_pipe['avg2']!=null){echo $row_select_pipe['avg2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['age3']!="" && $row_select_pipe['age3']!="0" && $row_select_pipe['age3']!=null){echo $row_select_pipe['age3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l3']!="" && $row_select_pipe['l3']!="0" && $row_select_pipe['l3']!=null){echo $row_select_pipe['l3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b3']!="" && $row_select_pipe['b3']!="0" && $row_select_pipe['b3']!=null){echo $row_select_pipe['b3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d3']!="" && $row_select_pipe['d3']!="0" && $row_select_pipe['d3']!=null){echo $row_select_pipe['d3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len3']!="" && $row_select_pipe['len3']!="0" && $row_select_pipe['len3']!=null){echo $row_select_pipe['len3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['max3']!="" && $row_select_pipe['max3']!="0" && $row_select_pipe['max3']!=null){echo $row_select_pipe['max3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['pos3']!="" && $row_select_pipe['pos3']!="0" && $row_select_pipe['pos3']!=null){echo $row_select_pipe['pos3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mod3']!="" && $row_select_pipe['mod3']!="0" && $row_select_pipe['mod3']!=null){echo $row_select_pipe['mod3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg3']!="" && $row_select_pipe['avg3']!="0" && $row_select_pipe['avg3']!=null){echo $row_select_pipe['avg3']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td colspan="10" style="border: 1px solid black;"><b>f<sub>b</sub>=(p x l)/(b*d<sup>2</sup>)</b>when 'a' is greater than 200mm for 150mm specimen, or greater than 133mm for a 100mm specimen</td>
				</tr>
				<tr>
					<td colspan="10" style="border: 1px solid black;"><b>f<sub>b</sub>=(3p x a)/(b*d<sup>2</sup>)</b>when 'a' is less than 200mm but greater than 170mm for 150mm specimen, or less than 133mm but greater than 100mm for a 100mm  specimen</td>
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
			<table align="center" width="100%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table>
			<div class="pagebreak"></div>
			<br>
			<br>
			<br>
			
			<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>TEC Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td width="60%" style="border: 1px solid black;"><b>Test for strength of Hard Concrete (IS 516/IS 456)</b></td>					
					<td style="border: 1px solid black;"><b>F-Concrete-07, Issue No.01, Page No 1 of 1</b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Laboratory Ref. No: <?php echo $job_no;?></b></td>
					<td style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>
				</tr>
				<tr>
					<td rowspan="2" style="border: 1px solid black;"><b>Any Other Information:</b></td>	
					<td style="border: 1px solid black;"><b>Testing Date: <?php echo date('d/m/Y', strtotime($start_date));?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Completion Date: <?php echo date('d/m/Y', strtotime($end_date));?></b></td>					
				</tr>
			</table>
			<table align="center" width="100%" class="test"  style="border: 1px solid black; " cellpadding="5px">
				<tr>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Location</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Weight (g)</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Dia (mm)</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Height ()</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>H/D (mm)</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Cross Section Area (mm<sup>2</sup>)</b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>	
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Correction Factor</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Correction Comp Strength (N/mm<sup>2</sup>)</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Equivalent Cube Strength (N/mm<sup>2</sup>)</b></td>	
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Average Cube Strength (N/mm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>(H/D) as per IS 516 (P-4) = 0.11 x H/D + 0.78</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Dia. as per IS 516 (P-4)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc1']!="" && $row_select_pipe['loc1']!="0" && $row_select_pipe['loc1']!=null){echo $row_select_pipe['loc1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight1']!="" && $row_select_pipe['weight1']!="0" && $row_select_pipe['weight1']!=null){echo $row_select_pipe['weight1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia1']!="" && $row_select_pipe['dia1']!="0" && $row_select_pipe['dia1']!=null){echo $row_select_pipe['dia1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height1']!="" && $row_select_pipe['height1']!="0" && $row_select_pipe['height1']!=null){echo $row_select_pipe['height1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio1']!="" && $row_select_pipe['ratio1']!="0" && $row_select_pipe['ratio1']!=null){echo $row_select_pipe['ratio1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area1']!="" && $row_select_pipe['area1']!="0" && $row_select_pipe['area1']!=null){echo $row_select_pipe['area1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load1']!="" && $row_select_pipe['load1']!="0" && $row_select_pipe['load1']!=null){echo $row_select_pipe['load1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com1']!="" && $row_select_pipe['com1']!="0" && $row_select_pipe['com1']!=null){echo $row_select_pipe['com1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a1']!="" && $row_select_pipe['cor_a1']!="0" && $row_select_pipe['cor_a1']!=null){echo $row_select_pipe['cor_a1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b1']!="" && $row_select_pipe['cor_b1']!="0" && $row_select_pipe['cor_b1']!=null){echo $row_select_pipe['cor_b1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str1']!="" && $row_select_pipe['cor_str1']!="0" && $row_select_pipe['cor_str1']!=null){echo $row_select_pipe['cor_str1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str1']!="" && $row_select_pipe['cube_str1']!="0" && $row_select_pipe['cube_str1']!=null){echo $row_select_pipe['cube_str1']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_avg1']!="" && $row_select_pipe['cube_avg1']!="0" && $row_select_pipe['cube_avg1']!=null){echo $row_select_pipe['cube_avg1']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc2']!="" && $row_select_pipe['loc2']!="0" && $row_select_pipe['loc2']!=null){echo $row_select_pipe['loc2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight2']!="" && $row_select_pipe['weight2']!="0" && $row_select_pipe['weight2']!=null){echo $row_select_pipe['weight2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia2']!="" && $row_select_pipe['dia2']!="0" && $row_select_pipe['dia2']!=null){echo $row_select_pipe['dia2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height2']!="" && $row_select_pipe['height2']!="0" && $row_select_pipe['height2']!=null){echo $row_select_pipe['height2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio2']!="" && $row_select_pipe['ratio2']!="0" && $row_select_pipe['ratio2']!=null){echo $row_select_pipe['ratio2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area2']!="" && $row_select_pipe['area2']!="0" && $row_select_pipe['area2']!=null){echo $row_select_pipe['area2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load2']!="" && $row_select_pipe['load2']!="0" && $row_select_pipe['load2']!=null){echo $row_select_pipe['load2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com2']!="" && $row_select_pipe['com2']!="0" && $row_select_pipe['com2']!=null){echo $row_select_pipe['com2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a2']!="" && $row_select_pipe['cor_a2']!="0" && $row_select_pipe['cor_a2']!=null){echo $row_select_pipe['cor_a2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b2']!="" && $row_select_pipe['cor_b2']!="0" && $row_select_pipe['cor_b2']!=null){echo $row_select_pipe['cor_b2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str2']!="" && $row_select_pipe['cor_str2']!="0" && $row_select_pipe['cor_str2']!=null){echo $row_select_pipe['cor_str2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str2']!="" && $row_select_pipe['cube_str2']!="0" && $row_select_pipe['cube_str2']!=null){echo $row_select_pipe['cube_str2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc3']!="" && $row_select_pipe['loc3']!="0" && $row_select_pipe['loc3']!=null){echo $row_select_pipe['loc3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight3']!="" && $row_select_pipe['weight3']!="0" && $row_select_pipe['weight3']!=null){echo $row_select_pipe['weight3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia3']!="" && $row_select_pipe['dia3']!="0" && $row_select_pipe['dia3']!=null){echo $row_select_pipe['dia3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height3']!="" && $row_select_pipe['height3']!="0" && $row_select_pipe['height3']!=null){echo $row_select_pipe['height3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio3']!="" && $row_select_pipe['ratio3']!="0" && $row_select_pipe['ratio3']!=null){echo $row_select_pipe['ratio3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area3']!="" && $row_select_pipe['area3']!="0" && $row_select_pipe['area3']!=null){echo $row_select_pipe['area3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load3']!="" && $row_select_pipe['load3']!="0" && $row_select_pipe['load3']!=null){echo $row_select_pipe['load3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com3']!="" && $row_select_pipe['com3']!="0" && $row_select_pipe['com3']!=null){echo $row_select_pipe['com3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a3']!="" && $row_select_pipe['cor_a3']!="0" && $row_select_pipe['cor_a3']!=null){echo $row_select_pipe['cor_a3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b3']!="" && $row_select_pipe['cor_b3']!="0" && $row_select_pipe['cor_b3']!=null){echo $row_select_pipe['cor_b3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str3']!="" && $row_select_pipe['cor_str3']!="0" && $row_select_pipe['cor_str3']!=null){echo $row_select_pipe['cor_str3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str3']!="" && $row_select_pipe['cube_str3']!="0" && $row_select_pipe['cube_str3']!=null){echo $row_select_pipe['cube_str3']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc4']!="" && $row_select_pipe['loc4']!="0" && $row_select_pipe['loc4']!=null){echo $row_select_pipe['loc4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight4']!="" && $row_select_pipe['weight4']!="0" && $row_select_pipe['weight4']!=null){echo $row_select_pipe['weight4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia4']!="" && $row_select_pipe['dia4']!="0" && $row_select_pipe['dia4']!=null){echo $row_select_pipe['dia4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height4']!="" && $row_select_pipe['height4']!="0" && $row_select_pipe['height4']!=null){echo $row_select_pipe['height4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio4']!="" && $row_select_pipe['ratio4']!="0" && $row_select_pipe['ratio4']!=null){echo $row_select_pipe['ratio4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area4']!="" && $row_select_pipe['area4']!="0" && $row_select_pipe['area4']!=null){echo $row_select_pipe['area4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load4']!="" && $row_select_pipe['load4']!="0" && $row_select_pipe['load4']!=null){echo $row_select_pipe['load4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com4']!="" && $row_select_pipe['com4']!="0" && $row_select_pipe['com4']!=null){echo $row_select_pipe['com4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a4']!="" && $row_select_pipe['cor_a4']!="0" && $row_select_pipe['cor_a4']!=null){echo $row_select_pipe['cor_a4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b4']!="" && $row_select_pipe['cor_b4']!="0" && $row_select_pipe['cor_b4']!=null){echo $row_select_pipe['cor_b4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str4']!="" && $row_select_pipe['cor_str4']!="0" && $row_select_pipe['cor_str4']!=null){echo $row_select_pipe['cor_str4']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str4']!="" && $row_select_pipe['cube_str4']!="0" && $row_select_pipe['cube_str4']!=null){echo $row_select_pipe['cube_str4']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_avg2']!="" && $row_select_pipe['cube_avg2']!="0" && $row_select_pipe['cube_avg2']!=null){echo $row_select_pipe['cube_avg2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc5']!="" && $row_select_pipe['loc5']!="0" && $row_select_pipe['loc5']!=null){echo $row_select_pipe['loc5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight5']!="" && $row_select_pipe['weight5']!="0" && $row_select_pipe['weight5']!=null){echo $row_select_pipe['weight5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia5']!="" && $row_select_pipe['dia5']!="0" && $row_select_pipe['dia5']!=null){echo $row_select_pipe['dia5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height5']!="" && $row_select_pipe['height5']!="0" && $row_select_pipe['height5']!=null){echo $row_select_pipe['height5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio5']!="" && $row_select_pipe['ratio5']!="0" && $row_select_pipe['ratio5']!=null){echo $row_select_pipe['ratio5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area5']!="" && $row_select_pipe['area5']!="0" && $row_select_pipe['area5']!=null){echo $row_select_pipe['area5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load5']!="" && $row_select_pipe['load5']!="0" && $row_select_pipe['load5']!=null){echo $row_select_pipe['load5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com5']!="" && $row_select_pipe['com5']!="0" && $row_select_pipe['com5']!=null){echo $row_select_pipe['com5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a5']!="" && $row_select_pipe['cor_a5']!="0" && $row_select_pipe['cor_a5']!=null){echo $row_select_pipe['cor_a5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b5']!="" && $row_select_pipe['cor_b5']!="0" && $row_select_pipe['cor_b5']!=null){echo $row_select_pipe['cor_b5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str5']!="" && $row_select_pipe['cor_str5']!="0" && $row_select_pipe['cor_str5']!=null){echo $row_select_pipe['cor_str5']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str5']!="" && $row_select_pipe['cube_str5']!="0" && $row_select_pipe['cube_str5']!=null){echo $row_select_pipe['cube_str5']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc6']!="" && $row_select_pipe['loc6']!="0" && $row_select_pipe['loc6']!=null){echo $row_select_pipe['loc6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight6']!="" && $row_select_pipe['weight6']!="0" && $row_select_pipe['weight6']!=null){echo $row_select_pipe['weight6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia6']!="" && $row_select_pipe['dia6']!="0" && $row_select_pipe['dia6']!=null){echo $row_select_pipe['dia6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height6']!="" && $row_select_pipe['height6']!="0" && $row_select_pipe['height6']!=null){echo $row_select_pipe['height6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio6']!="" && $row_select_pipe['ratio6']!="0" && $row_select_pipe['ratio6']!=null){echo $row_select_pipe['ratio6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area6']!="" && $row_select_pipe['area6']!="0" && $row_select_pipe['area6']!=null){echo $row_select_pipe['area6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load6']!="" && $row_select_pipe['load6']!="0" && $row_select_pipe['load6']!=null){echo $row_select_pipe['load6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com6']!="" && $row_select_pipe['com6']!="0" && $row_select_pipe['com6']!=null){echo $row_select_pipe['com6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a6']!="" && $row_select_pipe['cor_a6']!="0" && $row_select_pipe['cor_a6']!=null){echo $row_select_pipe['cor_a6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b6']!="" && $row_select_pipe['cor_b6']!="0" && $row_select_pipe['cor_b6']!=null){echo $row_select_pipe['cor_b6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str6']!="" && $row_select_pipe['cor_str6']!="0" && $row_select_pipe['cor_str6']!=null){echo $row_select_pipe['cor_str6']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str6']!="" && $row_select_pipe['cube_str6']!="0" && $row_select_pipe['cube_str6']!=null){echo $row_select_pipe['cube_str6']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc7']!="" && $row_select_pipe['loc7']!="0" && $row_select_pipe['loc7']!=null){echo $row_select_pipe['loc7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight7']!="" && $row_select_pipe['weight7']!="0" && $row_select_pipe['weight7']!=null){echo $row_select_pipe['weight7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia7']!="" && $row_select_pipe['dia7']!="0" && $row_select_pipe['dia7']!=null){echo $row_select_pipe['dia7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height7']!="" && $row_select_pipe['height7']!="0" && $row_select_pipe['height7']!=null){echo $row_select_pipe['height7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio7']!="" && $row_select_pipe['ratio7']!="0" && $row_select_pipe['ratio7']!=null){echo $row_select_pipe['ratio7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area7']!="" && $row_select_pipe['area7']!="0" && $row_select_pipe['area7']!=null){echo $row_select_pipe['area7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load7']!="" && $row_select_pipe['load7']!="0" && $row_select_pipe['load7']!=null){echo $row_select_pipe['load7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com7']!="" && $row_select_pipe['com7']!="0" && $row_select_pipe['com7']!=null){echo $row_select_pipe['com7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a7']!="" && $row_select_pipe['cor_a7']!="0" && $row_select_pipe['cor_a7']!=null){echo $row_select_pipe['cor_a7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b7']!="" && $row_select_pipe['cor_b7']!="0" && $row_select_pipe['cor_b7']!=null){echo $row_select_pipe['cor_b7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str7']!="" && $row_select_pipe['cor_str7']!="0" && $row_select_pipe['cor_str7']!=null){echo $row_select_pipe['cor_str7']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str7']!="" && $row_select_pipe['cube_str7']!="0" && $row_select_pipe['cube_str7']!=null){echo $row_select_pipe['cube_str7']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_avg3']!="" && $row_select_pipe['cube_avg3']!="0" && $row_select_pipe['cube_avg3']!=null){echo $row_select_pipe['cube_avg3']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>8.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc8']!="" && $row_select_pipe['loc8']!="0" && $row_select_pipe['loc8']!=null){echo $row_select_pipe['loc8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight8']!="" && $row_select_pipe['weight8']!="0" && $row_select_pipe['weight8']!=null){echo $row_select_pipe['weight8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia8']!="" && $row_select_pipe['dia8']!="0" && $row_select_pipe['dia8']!=null){echo $row_select_pipe['dia8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height8']!="" && $row_select_pipe['height8']!="0" && $row_select_pipe['height8']!=null){echo $row_select_pipe['height8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio8']!="" && $row_select_pipe['ratio8']!="0" && $row_select_pipe['ratio8']!=null){echo $row_select_pipe['ratio8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area8']!="" && $row_select_pipe['area8']!="0" && $row_select_pipe['area8']!=null){echo $row_select_pipe['area8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load8']!="" && $row_select_pipe['load8']!="0" && $row_select_pipe['load8']!=null){echo $row_select_pipe['load8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com8']!="" && $row_select_pipe['com8']!="0" && $row_select_pipe['com8']!=null){echo $row_select_pipe['com8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a8']!="" && $row_select_pipe['cor_a8']!="0" && $row_select_pipe['cor_a8']!=null){echo $row_select_pipe['cor_a8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b8']!="" && $row_select_pipe['cor_b8']!="0" && $row_select_pipe['cor_b8']!=null){echo $row_select_pipe['cor_b8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str8']!="" && $row_select_pipe['cor_str8']!="0" && $row_select_pipe['cor_str8']!=null){echo $row_select_pipe['cor_str8']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str8']!="" && $row_select_pipe['cube_str8']!="0" && $row_select_pipe['cube_str8']!=null){echo $row_select_pipe['cube_str8']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>9.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['loc9']!="" && $row_select_pipe['loc9']!="0" && $row_select_pipe['loc9']!=null){echo $row_select_pipe['loc9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['weight9']!="" && $row_select_pipe['weight9']!="0" && $row_select_pipe['weight9']!=null){echo $row_select_pipe['weight9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['dia9']!="" && $row_select_pipe['dia9']!="0" && $row_select_pipe['dia9']!=null){echo $row_select_pipe['dia9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['height9']!="" && $row_select_pipe['height9']!="0" && $row_select_pipe['height9']!=null){echo $row_select_pipe['height9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio9']!="" && $row_select_pipe['ratio9']!="0" && $row_select_pipe['ratio9']!=null){echo $row_select_pipe['ratio9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area9']!="" && $row_select_pipe['area9']!="0" && $row_select_pipe['area9']!=null){echo $row_select_pipe['area9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load9']!="" && $row_select_pipe['load9']!="0" && $row_select_pipe['load9']!=null){echo $row_select_pipe['load9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com9']!="" && $row_select_pipe['com9']!="0" && $row_select_pipe['com9']!=null){echo $row_select_pipe['com9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_a9']!="" && $row_select_pipe['cor_a9']!="0" && $row_select_pipe['cor_a9']!=null){echo $row_select_pipe['cor_a9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_b9']!="" && $row_select_pipe['cor_b9']!="0" && $row_select_pipe['cor_b9']!=null){echo $row_select_pipe['cor_b9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cor_str9']!="" && $row_select_pipe['cor_str9']!="0" && $row_select_pipe['cor_str9']!=null){echo $row_select_pipe['cor_str9']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cube_str9']!="" && $row_select_pipe['cube_str9']!="0" && $row_select_pipe['cube_str9']!=null){echo $row_select_pipe['cube_str9']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Remarks</b></td>
					<td colspan="13" style="border: 1px solid black; text-align:center;"><b></b></td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="100%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table>
			<div class="pagebreak"></div>
			<br>
			<br>
			<br>
			<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>TEC Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td width="60%" style="border: 1px solid black;"><b>Spliting Tensile Strength of Concrete (IS 516 Part 1, Section1/IS:5816/ASTM C 496-96)</b></td>					
					<td style="border: 1px solid black;"><b>F-Concrete-03, Issue No.01, Page No 1 of 1</b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Laboratory Ref. No: <?php echo $job_no;?></b></td>
					<td style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>
				</tr>
				<tr>
					<td rowspan="2" style="border: 1px solid black;"><b>Any Other Information:</b></td>	
					<td style="border: 1px solid black;"><b>Testing Date: <?php echo date('d/m/Y', strtotime($start_date));?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Completion Date: <?php echo date('d/m/Y', strtotime($end_date));?></b></td>					
				</tr>
			</table>
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
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['average']!="" && $row_select_pipe['average']!="0" && $row_select_pipe['average']!=null){echo $row_select_pipe['average']; }else{echo " <br>";}  ?></b></td>	
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Average (N/mm<sup>2</sup>) fc=</b></td>	
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_avg1']!="" && $row_select_pipe['spl_avg1']!="0" && $row_select_pipe['spl_avg1']!=null){echo $row_select_pipe['spl_avg1']; }else{echo " <br>";}  ?></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_avg2']!="" && $row_select_pipe['spl_avg2']!="0" && $row_select_pipe['spl_avg2']!=null){echo $row_select_pipe['spl_avg2']; }else{echo " <br>";}  ?></b></td>	
				</tr>
				<tr>
					<td colspan="5" style="border: 1px solid black;"><b>Remarks:</b></td>	
				</tr>
			</table>
			<table align="center" width="100%" class="test" style="border: 1px solid black;">
				<tr>
					<td style="border: 1px solid black; height:200px;"><b>
					<p>For Cylinder, fc=2P/&Alpha;LD</p>
					<p>For Cube, fc=P/2I<sup>2</sup></p>
					</b></td>					
								
				</tr>
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="100%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table>
			<div class="pagebreak"></div>
			
			-->
			<br><br>
			<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
				<tr>
					<td style="font-size: 14px;font-weight: bold;text-align: center;padding: 5px;text-transform: uppercase;border: 1px solid;"><?php echo $mt_name; ?></td>
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
				<td style="font-weight: bold;padding: 5px;"><?php echo $mt_name; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
			</tr>
		</table>
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;">
			<tr>
				<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 15%;">Test Method :-</td>
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 2062:2011  Grade:<?php echo $row_select_pipe['ms_grade']; ?></td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
		</table>
			<table align="center" width="100%" class="test" style="border: 1px solid black;border-top: 0;" cellpadding="3px">
				<tr>
					<td width="20%" rowspan="6" style="border: 1px solid black;border-top: 0;"><b>Accelerated Curing (By Boiling Water Method)</b></td>
					<td width="20%" style="border: 1px solid black;border-top: 0;"><b>Immersion Time (Curing Tank)</b></td>
					<td width="30%" style="border: 1px solid black;border-top: 0;"><b><?php if($row_select_pipe['acc1']!="" && $row_select_pipe['acc1']!="0" && $row_select_pipe['acc1']!=null){echo $row_select_pipe['acc1']." ".$row_select_pipe['acc1_2']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Removal Time (Curing Tank)</b></td>
					<td style="border: 1px solid black;"><b><?php if($row_select_pipe['acc2']!="" && $row_select_pipe['acc2']!="0" && $row_select_pipe['acc2']!=null){echo $row_select_pipe['acc2']." ".$row_select_pipe['acc2_2']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Immersion Time (Cooling Tank)</b></td>
					<td style="border: 1px solid black;"><b><?php if($row_select_pipe['acc3']!="" && $row_select_pipe['acc3']!="0" && $row_select_pipe['acc3']!=null){echo $row_select_pipe['acc3']." ".$row_select_pipe['acc3_2']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Removal Time (Cooling Tank)</b></td>
					<td style="border: 1px solid black;"><b><?php if($row_select_pipe['acc4']!="" && $row_select_pipe['acc4']!="0" && $row_select_pipe['acc4']!=null){echo $row_select_pipe['acc4']." ".$row_select_pipe['acc4_2']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Time of Compressive Strength Test :</b></td>
					<td style="border: 1px solid black;"><b><?php if($row_select_pipe['acc5']!="" && $row_select_pipe['acc5']!="0" && $row_select_pipe['acc5']!=null){echo $row_select_pipe['acc5']." ".$row_select_pipe['acc5_2']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Age of Specimen</b></td>
					<td style="border: 1px solid black;"><b><?php if($row_select_pipe['acc6']!="" && $row_select_pipe['acc6']!="0" && $row_select_pipe['acc6']!=null){echo $row_select_pipe['acc6']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td colspan="3" style="border: 1px solid black;"><b>&nbsp;</b></td>
				</tr>
			</table>
			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="10px">
				<tr>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Sr No</b></td>
					<td width="15%" style="border: 1px solid black;text-align:center;"><b>Identification</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Weight (kg)</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Length (mm)</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Width (mm)</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Area (mm<sup>2</sup>)</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Load (KN)</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>
					<td width="10%" style="border: 1px solid black;text-align:center;"><b>Average Compressive Strength (N/mm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;"><b>1.</b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_id1']!="" && $row_select_pipe['acc_id1']!="0" && $row_select_pipe['acc_id1']!=null){echo $row_select_pipe['acc_id1']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_w1']!="" && $row_select_pipe['acc_w1']!="0" && $row_select_pipe['acc_w1']!=null){echo $row_select_pipe['acc_w1']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_l1']!="" && $row_select_pipe['acc_l1']!="0" && $row_select_pipe['acc_l1']!=null){echo $row_select_pipe['acc_l1']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_width1']!="" && $row_select_pipe['acc_width1']!="0" && $row_select_pipe['acc_width1']!=null){echo $row_select_pipe['acc_width1']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_area1']!="" && $row_select_pipe['acc_area1']!="0" && $row_select_pipe['acc_area1']!=null){echo $row_select_pipe['acc_area1']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_load1']!="" && $row_select_pipe['acc_load1']!="0" && $row_select_pipe['acc_load1']!=null){echo $row_select_pipe['acc_load1']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_com1']!="" && $row_select_pipe['acc_com1']!="0" && $row_select_pipe['acc_com1']!=null){echo $row_select_pipe['acc_com1']; }else{echo " <br>";}?></b></td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_avg1']!="" && $row_select_pipe['acc_avg1']!="0" && $row_select_pipe['acc_avg1']!=null){echo $row_select_pipe['acc_avg1']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;"><b>2.</b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_id2']!="" && $row_select_pipe['acc_id2']!="0" && $row_select_pipe['acc_id2']!=null){echo $row_select_pipe['acc_id2']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_w2']!="" && $row_select_pipe['acc_w2']!="0" && $row_select_pipe['acc_w2']!=null){echo $row_select_pipe['acc_w2']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_l2']!="" && $row_select_pipe['acc_l2']!="0" && $row_select_pipe['acc_l2']!=null){echo $row_select_pipe['acc_l2']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_width2']!="" && $row_select_pipe['acc_width2']!="0" && $row_select_pipe['acc_width2']!=null){echo $row_select_pipe['acc_width2']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_area2']!="" && $row_select_pipe['acc_area2']!="0" && $row_select_pipe['acc_area2']!=null){echo $row_select_pipe['acc_area2']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_load2']!="" && $row_select_pipe['acc_load2']!="0" && $row_select_pipe['acc_load2']!=null){echo $row_select_pipe['acc_load2']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_com2']!="" && $row_select_pipe['acc_com2']!="0" && $row_select_pipe['acc_com2']!=null){echo $row_select_pipe['acc_com2']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;text-align:center;"><b>3.</b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_id3']!="" && $row_select_pipe['acc_id3']!="0" && $row_select_pipe['acc_id3']!=null){echo $row_select_pipe['acc_id3']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_w3']!="" && $row_select_pipe['acc_w3']!="0" && $row_select_pipe['acc_w3']!=null){echo $row_select_pipe['acc_w3']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_l3']!="" && $row_select_pipe['acc_l3']!="0" && $row_select_pipe['acc_l3']!=null){echo $row_select_pipe['acc_l3']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_width3']!="" && $row_select_pipe['acc_width3']!="0" && $row_select_pipe['acc_width3']!=null){echo $row_select_pipe['acc_width3']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_area3']!="" && $row_select_pipe['acc_area3']!="0" && $row_select_pipe['acc_area3']!=null){echo $row_select_pipe['acc_area3']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_load3']!="" && $row_select_pipe['acc_load3']!="0" && $row_select_pipe['acc_load3']!=null){echo $row_select_pipe['acc_load3']; }else{echo " <br>";}?></b></td>
					<td style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['acc_com3']!="" && $row_select_pipe['acc_com3']!="0" && $row_select_pipe['acc_com3']!=null){echo $row_select_pipe['acc_com3']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black;text-align:center;"><b>Corrected Strength (8.09+1.64*R<sub>a</sub>)(N/mm<sup>2</sup>)</b></td>
					<td colspan="5" style="border: 1px solid black;"><b><?php if($row_select_pipe['acc_r28']!="" && $row_select_pipe['acc_r28']!="0" && $row_select_pipe['acc_r28']!=null){echo $row_select_pipe['acc_r28']; }else{echo " <br>";}?></b></td>
				</tr>
				<tr>
					<td colspan="9" height="100px" style="border: 1px solid black;"><b></b></td>
				</tr>
			</table>
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
				<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
			</tr>
			
		</table>
			
			</page>
		
	</body>
</html> 
		
	
<script type="text/javascript">
// window.print();
</script>