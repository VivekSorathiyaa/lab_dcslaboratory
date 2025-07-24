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
		 $select_tiles_query = "select * from ms_plate WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					$ms_grade= $row_select4['ms_grade'];
					$type_sample= $row_select4['ms_type'];
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
					<td width="60%" colspan="2" style="font-size:12px;border: 1px solid black;"><center><b>Hot Rolled Medium & High Tensile Structural Steel, Hollow Steel Section (IS 1608(P-1):2018, IS 1599:2019)</b></center></td>
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
				<tr>
					<td width="60%" colspan="2" style="font-size:12px;border: 1px solid black; height:30px;"><b>Sample Type:</b>&nbsp; <?php echo $type_sample;?></td>
					<td colspan="2" style="font-size:12px;border: 1px solid black;">&nbsp;</td>
				</tr>
				
			</table>
			<table align="center" width="90%" class="test1" style="border: 1px solid black;">
				
				<tr>
					<td width="10%" style="border: 1px solid black; font-size:12px;"><b><center>&#x2022;</center></b></td>
					<td width="30%"style="border: 1px solid black; font-size:12px;"><b>Overall Dimention</b></td>
					<td width="30%"style="border: 1px solid black; font-size:12px;text-align:center;"><b>Test Results</b></td>
					<td width="30%"style="border: 1px solid black; font-size:12px;text-align:center;"><b>Test Results</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>1</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Length (mm)</b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['l12']!="" && $row_select_pipe['l12']!="0" && $row_select_pipe['l12']!=null){echo $row_select_pipe['l12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>2</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Width (mm)</b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['w1']!="" && $row_select_pipe['w1']!="0" && $row_select_pipe['w1']!=null){echo $row_select_pipe['w1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['w12']!="" && $row_select_pipe['w12']!="0" && $row_select_pipe['w12']!=null){echo $row_select_pipe['w12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>3</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Thickness (mm)</b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['t1']!="" && $row_select_pipe['t1']!="0" && $row_select_pipe['t1']!=null){echo $row_select_pipe['t1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['t12']!="" && $row_select_pipe['t12']!="0" && $row_select_pipe['t12']!=null){echo $row_select_pipe['t12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>4</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Outer Diameter</b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['out1']!="" && $row_select_pipe['out1']!="0" && $row_select_pipe['out1']!=null){echo $row_select_pipe['out1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['out12']!="" && $row_select_pipe['out12']!="0" && $row_select_pipe['out12']!=null){echo $row_select_pipe['out12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; font-size:12px;"><b><center>&#x2022;</center></b></td>
					<td width="30%"style="border: 1px solid black; font-size:12px;"><b>Test Sample Perameter</b></td>
					<td width="30%"style="border: 1px solid black; font-size:12px;text-align:center"><b>Test Results</b></td>
					<td width="30%"style="border: 1px solid black; font-size:12px;text-align:center"><b>Test Results</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>1</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Wight(kg) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['weight1']!="" && $row_select_pipe['weight1']!="0" && $row_select_pipe['weight1']!=null){echo $row_select_pipe['weight1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['weight12']!="" && $row_select_pipe['weight12']!="0" && $row_select_pipe['weight12']!=null){echo $row_select_pipe['weight12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>2</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Length(m) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['len1']!="" && $row_select_pipe['len1']!="0" && $row_select_pipe['len1']!=null){echo $row_select_pipe['len1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['len12']!="" && $row_select_pipe['len12']!="0" && $row_select_pipe['len12']!=null){echo $row_select_pipe['len12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>3</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Mass/Meter(Kg/m) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['mass1']!="" && $row_select_pipe['mass1']!="0" && $row_select_pipe['mass1']!=null){echo $row_select_pipe['mass1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['mass12']!="" && $row_select_pipe['mass12']!="0" && $row_select_pipe['mass12']!=null){echo $row_select_pipe['mass12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>4</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Dia(mm) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['dia1']!="" && $row_select_pipe['dia1']!="0" && $row_select_pipe['dia1']!=null){echo $row_select_pipe['dia1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['dia12']!="" && $row_select_pipe['dia12']!="0" && $row_select_pipe['dia12']!=null){echo $row_select_pipe['dia12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>5</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Width(mm) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['width1']!="" && $row_select_pipe['width1']!="0" && $row_select_pipe['width1']!=null){echo $row_select_pipe['width1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['width12']!="" && $row_select_pipe['width12']!="0" && $row_select_pipe['width12']!=null){echo $row_select_pipe['width12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>6</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Thickness(mm) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['thk1']!="" && $row_select_pipe['thk1']!="0" && $row_select_pipe['thk1']!=null){echo $row_select_pipe['thk1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['thk12']!="" && $row_select_pipe['thk12']!="0" && $row_select_pipe['thk12']!=null){echo $row_select_pipe['thk12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>7</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Area(mm<sup>2</sup>) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['area1']!="" && $row_select_pipe['area1']!="0" && $row_select_pipe['area1']!=null){echo $row_select_pipe['area1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['area12']!="" && $row_select_pipe['area12']!="0" && $row_select_pipe['area12']!=null){echo $row_select_pipe['area12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>8</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Yield Load(kN) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['load1']!="" && $row_select_pipe['load1']!="0" && $row_select_pipe['load1']!=null){echo $row_select_pipe['load1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['load12']!="" && $row_select_pipe['load12']!="0" && $row_select_pipe['load12']!=null){echo $row_select_pipe['load12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>9</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Yield stress(N/mm2) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['str1']!="" && $row_select_pipe['str1']!="0" && $row_select_pipe['str1']!=null){echo $row_select_pipe['str1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['str12']!="" && $row_select_pipe['str12']!="0" && $row_select_pipe['str12']!=null){echo $row_select_pipe['str12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>10</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Ultimate Load(kN) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['ult1']!="" && $row_select_pipe['ult1']!="0" && $row_select_pipe['ult1']!=null){echo $row_select_pipe['ult1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['ult12']!="" && $row_select_pipe['ult12']!="0" && $row_select_pipe['ult12']!=null){echo $row_select_pipe['ult12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>11</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Ultimate Tensil Strength(N/mm2) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['ten1']!="" && $row_select_pipe['ten1']!="0" && $row_select_pipe['ten1']!=null){echo $row_select_pipe['ten1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['ten12']!="" && $row_select_pipe['ten12']!="0" && $row_select_pipe['ten12']!=null){echo $row_select_pipe['ten12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>12</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Initial Gauge Length (mm) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['initial1']!="" && $row_select_pipe['initial1']!="0" && $row_select_pipe['initial1']!=null){echo $row_select_pipe['initial1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['initial12']!="" && $row_select_pipe['initial12']!="0" && $row_select_pipe['initial12']!=null){echo $row_select_pipe['initial12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>13</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Final Gauge Length(mm) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['final1']!="" && $row_select_pipe['final1']!="0" && $row_select_pipe['final1']!=null){echo $row_select_pipe['final1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['final12']!="" && $row_select_pipe['final12']!="0" && $row_select_pipe['final12']!=null){echo $row_select_pipe['final12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>14</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Elongation(%) </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['elo1']!="" && $row_select_pipe['elo1']!="0" && $row_select_pipe['elo1']!=null){echo $row_select_pipe['elo1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['elo12']!="" && $row_select_pipe['elo12']!="0" && $row_select_pipe['elo12']!=null){echo $row_select_pipe['elo12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>15</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Location Of Fracture </b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['location1']!="" && $row_select_pipe['location1']!="0" && $row_select_pipe['location1']!=null){echo $row_select_pipe['location1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['location12']!="" && $row_select_pipe['location12']!="0" && $row_select_pipe['location12']!=null){echo $row_select_pipe['location12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>16</center></b></td>
					<td width="30%"style="border: 1px solid black;"><b>Bend Test</b></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['bend1']!="" && $row_select_pipe['bend1']!="0" && $row_select_pipe['bend1']!=null){echo $row_select_pipe['bend1']; }else{echo " <br>";}?></td>
					<td width="30%"style="border: 1px solid black;text-align:center"><?php if($row_select_pipe['bend12']!="" && $row_select_pipe['bend12']!="0" && $row_select_pipe['bend12']!=null){echo $row_select_pipe['bend12']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; height:30px;"><b><center>Remarks</center></b></td>
					<td colspan="3" style="border: 1px solid black;"><b></b></td>
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