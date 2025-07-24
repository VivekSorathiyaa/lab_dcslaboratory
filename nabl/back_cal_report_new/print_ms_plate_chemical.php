<?php 
session_start();
include("../connection.php");
error_reporting(1);?>
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
		 $select_tiles_query = "select * from ms_plate_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

			$select_query1 = "select * from agency_master where WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
			$result_select1 = mysqli_query($conn, $select_query1);

			
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
					$ms_grade= $row_select4['ms_grade'];
				}
				
		?>
		
		<br>
		<br>
		
		<page size="A4" >
			
			
			<table align="center"  class="test"  style="border: 1px solid black; width:90%; height:auto;">
				<tr>
					<td colspan="4" style="font-size:18px;border: 1px solid black;"><center><b>TEC Material Testing Laboratory</b></center></td>
				</tr>
				<tr>
					<td width="60%" colspan="2" style="font-size:12px;border: 1px solid black;"><center><b>Hot Rolled Medium & High Tensile Structural Steel, Hollow Steel Section & Steel Tubes</b></center></td>
					<td colspan="2" style="font-size:16px;border: 1px solid black;"><center><b>F-Steel-03, Issue No.01</b></center></td>
				</tr>
				<tr>
					<td colspan="4" width="60%" style="font-size:12px;border: 1px solid black; height:30px;"><b>Laboratory ID No. :</b>&nbsp;<?php echo $job_no;?></td>
					
				</tr>
				
				<tr>
					<td width="60%" colspan="2" style="font-size:12px;border: 1px solid black; height:30px;"><b>Any Other Information : IS 2062:2011 (RA 2016) Grade : <?php echo $row_select_pipe['ms_grade'];?></b>&nbsp;</td>
					<td colspan="2" style="font-size:12px;border: 1px solid black;"><b>Sample Received Date:</b>&nbsp;<?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
				</tr>
				<tr>
					<td width="60%" colspan="2" style="font-size:12px;border: 1px solid black; height:30px;"><b>Testing Start Date :</b>&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
					<td colspan="2" style="font-size:12px;border: 1px solid black;"><b>Testing Complete Date:</b>&nbsp;<?php echo date('d-m-Y', strtotime($end_date));?></td>
				</tr>
				
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;">
				
				<tr>
					<td width="10%" style="border: 1px solid black; font-size:12px;"><b><center>&#x2022;</center></b></td>
					<td width="45%"style="border: 1px solid black; font-size:12px;"><b>Chemical Element</b></td>
					<td width="45%"style="border: 1px solid black; font-size:12px;text-align:center;"><b>Test Results</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>1</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Carbon (C), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c1']!="" && $row_select_pipe['c1']!="0" && $row_select_pipe['c1']!=null){echo $row_select_pipe['c1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>2</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Manganese (Mn), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c5']!="" && $row_select_pipe['c5']!="0" && $row_select_pipe['c5']!=null){echo $row_select_pipe['c5']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>3</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Phosphorous (P), %</b></td>
				
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c3']!="" && $row_select_pipe['c3']!="0" && $row_select_pipe['c3']!=null){echo $row_select_pipe['c3']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>4</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Sulphur (S), %</b></td>
						<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c2']!="" && $row_select_pipe['c2']!="0" && $row_select_pipe['c2']!=null){echo $row_select_pipe['c2']; }else{echo " <br>";}?></td>
				</tr>
				
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>5</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>(P) + (S), % </b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c3']!="" && $row_select_pipe['c3']!=null && $row_select_pipe['c3']!="0" && $row_select_pipe['c2']!="" && $row_select_pipe['c2']!=null && $row_select_pipe['c2']!="0"){
											$a2 = number_format($row_select_pipe['c3'],3) + number_format($row_select_pipe['c2'],3);
											
											
											echo $a2;
											}else{echo "-";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>6</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Chromium (Cr), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c6']!="" && $row_select_pipe['c6']!="0" && $row_select_pipe['c6']!=null){echo $row_select_pipe['c6']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>7</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Molybdenum (Mo), % </b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c9']!="" && $row_select_pipe['c9']!="0" && $row_select_pipe['c9']!=null){echo $row_select_pipe['c9']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>8</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Nickel (Ni), % </b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c8']!="" && $row_select_pipe['c8']!="0" && $row_select_pipe['c8']!=null){echo $row_select_pipe['c8']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>9</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Copper (Cu), % </b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c7']!="" && $row_select_pipe['c7']!="0" && $row_select_pipe['c7']!=null){echo $row_select_pipe['c7']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>10</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Niobium (Nb), % </b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c10']!="" && $row_select_pipe['c10']!="0" && $row_select_pipe['c10']!=null){echo $row_select_pipe['c10']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>11</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Vanadium (V), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c11']!="" && $row_select_pipe['c11']!="0" && $row_select_pipe['c11']!=null){echo $row_select_pipe['c11']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>12</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Boron (B), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c12']!="" && $row_select_pipe['c12']!="0" && $row_select_pipe['c12']!=null){echo $row_select_pipe['c12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>13</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Titanium (Ti), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c13']!="" && $row_select_pipe['c13']!="0" && $row_select_pipe['c13']!=null){echo $row_select_pipe['c13']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>14</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Nitrogen (N), % </b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c14']!="" && $row_select_pipe['c14']!="0" && $row_select_pipe['c14']!=null){echo $row_select_pipe['c14']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>15</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Carbon Equivalent (CE), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php 
					$ans1 = number_format($row_select_pipe['c1'],3);
											$ans2 = number_format($row_select_pipe['c5'],3)/6;
											$ans3 = (number_format($row_select_pipe['c6'],3) +number_format($row_select_pipe['c9'],3) +number_format($row_select_pipe['c11'],3))/5;
											$ans4 = (number_format($row_select_pipe['c8'],3) +number_format($row_select_pipe['c7'],3))/15;
											
											$final = $ans1 + $ans2 + $ans3 + $ans4;
											echo number_format($final,3);
					
					?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>16</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>Silicon (Si), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php if($row_select_pipe['c4']!="" && $row_select_pipe['c4']!="0" && $row_select_pipe['c4']!=null){echo $row_select_pipe['c4']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>17</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>(Nb) + (V) + (B) + (Ti), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php $a1 = number_format($row_select_pipe['c10'],3) + number_format($row_select_pipe['c11'],3) + number_format($row_select_pipe['c12'],4) + number_format($row_select_pipe['c13'],3);
											echo number_format($a1,3);?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>18</center></b></td>
					<td width="45%"style="border: 1px solid black;"><b>(Cr) + (Cu) + (Ni) + (Mo) + (P), %</b></td>
					<td width="45%"style="border: 1px solid black;text-align:center;"><?php $a5 = number_format($row_select_pipe['c6'],3) + number_format($row_select_pipe['c7'],3) + number_format($row_select_pipe['c8'],4) + number_format($row_select_pipe['c9'],3) + number_format($row_select_pipe['c3'],3);
											echo number_format($a5,3);?></td>
				</tr>
				
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>Remarks</center></b></td>
					<td colspan="2" style="border: 1px solid black;"><b></b></td>
				</tr>
			</table>

			<table align="center" width="90%" class="test1" style="border: 1px solid black;">
				<tr>
					<td style="border: 1px solid black;" width="10%"><center><b>Tested By</b></center></td>
					<td style="border: 1px solid black;" width="10%"><center><b>Check By</b></center></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; height:30px;"><center> </center></td>
					<td style="border: 1px solid black; height:30px;"><center> </center></td>
				</tr>
			</table>
			
			</page>
		
	</body>
</html> 
		
	
<script type="text/javascript">

</script>