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
	 font-family: Times New Roman;
}
.test {
   border-collapse: collapse;
	font-size:10px;
	 font-family: Times New Roman;
}
.test1 {
   font-size:10px;
   border-collapse: collapse;
	 font-family: Times New Roman;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Times New Roman;
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
		 $select_tiles_query = "select * from flyash_chemical WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

			$select_query1 = "select * from agency_master where `isdeleted`=0 and `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
					
					$week_number= $row_select4['fly_source'];
				}
					
				
				
		?>
		
		
		<br>
		<page size="A4" >
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
				<h3 style="font-size:14px; text-align:center;">OBSERVATION SHEET OF FLYASH CHEMICAL ANALYSIS <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?> GRAVIMETRIC METHOD</h3>
			<table align="center" width="90%" class="test"   style="border: 1px solid black; font-family: Times New Roman;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $week_number; ?></td>
				</tr>
				
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no;?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Lab No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no;?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date));?></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
			</table>
			<Br>
			<table align="center" width="90%" class="test1" style="" height="Auto">
			
			<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			
			<table align="center" width="90%" class="test1" style="" height="Auto">
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>1. LOSS ON IGNITION (LOI) <?php if($row_select_pipe['los_test_method']!="" && $row_select_pipe['los_test_method']!=null && $row_select_pipe['los_test_method']!="0" && $row_select_pipe['los_test_method']!="undefined"){echo $row_select_pipe['los_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE + SAMPLE (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo number_format((floatval($row_select_pipe['ig1']) + floatval($row_select_pipe['ig2'])),4);?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>LOSS ON IGNITION  =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo number_format((floatval($row_select_pipe['ig1']) + floatval($row_select_pipe['ig2'])),4);?> - <?php echo $row_select_pipe['ig3'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>L.O.I  =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['ig1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['ig4'];?> %</td>
				</tr>
			
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>2. SILICA, (SiO<sub>2</sub>) <?php if($row_select_pipe['sio_test_method']!="" && $row_select_pipe['sio_test_method']!=null && $row_select_pipe['sio_test_method']!="0" && $row_select_pipe['sio_test_method']!="undefined"){echo $row_select_pipe['sio_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER HF (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio4'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA BEFORE HF</b></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio3'];?> - <?php echo $row_select_pipe['sio2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio5'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA AFTER HF</b></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio3'];?> - <?php echo $row_select_pipe['sio4'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['sio1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio6'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >7</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>R = R1 - R2</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<?php echo $row_select_pipe['sio5'];?> - <?php echo $row_select_pipe['sio6'];?></td>
						
					<td  style="text-align:center; border: 1px solid black;"><?php echo $r_silica = $row_select_pipe['sio5'] - $row_select_pipe['sio6'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >8</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>PURE SILICA = R + R2(SILICA FROM R<sub>2</sub>O<sub>3</sub>)</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<?php echo $r_silica;?> + <?php echo $row_select_pipe['r2o6'];?></td>
						
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['sio7'];?>%</td>
				</tr>
				
				
			
				</table>
				
				<table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
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
				<br>
				<br>
				<br>
				<br>
				<br>
				<br><br>
				<br>
				<table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td >
						<div style="margin-top:20px;">
							<b style="font-size:10px;font-weight:100;">F/FC/01/TR, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.05.2019</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:20px;">
							<b style="font-size:10px;font-weight:100;">Page: 1 of 4<br>
						</div>
					</td>
				</tr>
			</table>
				<div class="pagebreak"> </div>
			<br>
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
			<h3 style="font-size:14px; text-align:center;">OBSERVATION SHEET OF FLYASH CHEMICAL ANALYSIS <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?> GRAVIMETRIC METHOD</h3>
			<table align="center" width="90%" class="test"   style="border: 1px solid black; font-family: Times New Roman;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $week_number; ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Grade</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $grade;?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no;?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Lab No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no;?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date));?></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test1" style="" height="Auto">
			
			<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			
			<table align="center" width="90%" class="test1" style="" height="Auto">
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>3. COMBINED FERRIC OXIDE AND ALUMINA (R<sub>2</sub>O<sub>3</sub>) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER HF (W3) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o4'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA BEFORE HF</b></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o3'];?> - <?php echo $row_select_pipe['r2o2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R1 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o5'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ></td>
					<td  colspan="3" style="width:50%;text-align:left; border: 1px solid black;"><b>FORMULA AFTER HF</b></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W3</td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o3'];?> - <?php echo $row_select_pipe['r2o4'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>R2 =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['r2o1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o6'];?> %</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >7</td>
					<td  style="text-align:left; border: 1px solid black;">
					<B>R = R1 - R2</B>
					</td>
					<td  style="text-align:center; border: 1px solid black;">										
						<?php echo $row_select_pipe['r2o5'];?> - <?php echo $row_select_pipe['r2o6'];?>					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o7'];?> %</td>
				</tr>
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>4(A). FERRIC OXIDE, (Fe<sub>2</sub>O<sub>3</sub>) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo2'];?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.7985 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>FERRIC OXIDE (Fe<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.7985 X <?php echo $row_select_pipe['feo2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td> FERRIC OXIDE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['feo1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['feo3'];?> %</td>
				</tr>
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>4(B). ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT (V) ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.5098 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>0.5098 X V</td>
								<td></td>
						</tr>
						<tr>
								<td>ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>W</td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php //echo $row_select_pipe['feo3'];?></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >4</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">ALUMINUM OXIDE (Al<sub>2</sub>O<sub>3</sub>) = R<sub>2</sub>O<sub>3</sub> - Fe<sub>2</sub>O<sub>3</sub> </td>
					<td  style="width:30%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['r2o7'];?> - <?php echo $row_select_pipe['feo3'];?></td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alo1'];?> %</td>
				</tr>
			
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>5. CALCIUM OXIDE (CaO) <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao3'];?> - <?php echo $row_select_pipe['cao2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>CaO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cao1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cao4'];?> %</td>
				</tr>
				
				
				
				</table>
			
			<br>
			
			<table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:120px;">
							<b style="font-size:10px;font-weight:100;">F/FC/01/TR, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.05.2019</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:120px;">
							<b style="font-size:10px;font-weight:100;">Page: 2 of 4<br>
						</div>
					</td>
				</tr>
			</table>
				<div class="pagebreak"> </div>
			<br>
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
	
				<h3 style="font-size:14px; text-align:center;">OBSERVATION SHEET OF FLYASH CHEMICAL ANALYSIS <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?> GRAVIMETRIC METHOD</h3>
			<table align="center" width="90%" class="test"   style="border: 1px solid black; font-family: Times New Roman;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $week_number; ?></td>
				</tr>
				
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no;?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Lab No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no;?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date));?></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
			</table>
			<br>
			<table align="center" width="90%" class="test1" style="" height="Auto">
			
			<tr style="">
					<td  colspan="2" style="width:55%;border: 1px solid black;text-align:center;font-weight:bold;" >DESCRIPTION</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;font-weight:bold;">READING</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;font-weight:bold;">RESULT</td>
					
				</tr>
			</table>
			
			
			
			<table align="center" width="90%" class="test1" style="" height="Auto">
			
				
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>6. MAGNESIUM OXIDE (MgO) <?php if($row_select_pipe['mang_test_method']!="" && $row_select_pipe['mang_test_method']!=null && $row_select_pipe['mang_test_method']!="0" && $row_select_pipe['mang_test_method']!="undefined"){echo $row_select_pipe['mang_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 36.22</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo3'];?> - <?php echo $row_select_pipe['mgo2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>MgO =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 36.22</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['mgo1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['mgo4'];?> %</td>
				</tr>
				
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>7. SULPHURIC ANHYDRIDE, SO<sub>3</sub> <?php if($row_select_pipe['tot_test_method']!="" && $row_select_pipe['tot_test_method']!=null && $row_select_pipe['tot_test_method']!="0" && $row_select_pipe['tot_test_method']!="undefined"){echo $row_select_pipe['tot_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF EMPTY CRUCIBLE (W1) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">WEIGHT OF CRUCIBLE AFTER IGNITION (W2) GM</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>W2 - W1</td>
								<td></td>
						</tr>
						<tr>
								<td>SULPHURIC ANHYDRIDE =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 34.3</td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['so3'];?> - <?php echo $row_select_pipe['so2'];?></td>
								<td></td>
						</tr>
						<tr>
								<td>SO<sub>3</sub> =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 34.3</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['so1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['so4'];?> %</td>
				</tr>
				
				<tr >
					
					<td style="text-align:left;" colspan="4"><b>8. CHLORIDE <?php if($row_select_pipe['chl_test_method']!="" && $row_select_pipe['chl_test_method']!=null && $row_select_pipe['chl_test_method']!="0" && $row_select_pipe['chl_test_method']!="undefined"){echo $row_select_pipe['chl_test_method'];}else{?>IS 4032:1985 (RA 2019)<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >2</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT USED FOR SAMPLE (X), ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl2'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >3</td>
					<td  style="text-align:left; border: 1px solid black;">TITRANT USED FOR BLANK (Y), ml</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl3'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >4</td>
					<td  style="text-align:left; border: 1px solid black;">Z = 10 - (X-Y) </td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl4'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >5</td>
					<td  style="text-align:left; border: 1px solid black;"> N = Normality of NH<sub>4</sub>SCN</td>
					<td  style="text-align:center; border: 1px solid black;">--</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl5'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="border: 1px solid black;text-align:center" >6</td>
					<td  style="text-align:left; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>(Z X 0.03546 X N X 100)</td>
								<td></td>
						</tr>
						<tr>
								<td>Cl =</td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td>WEIGHT OF SAMPLE</td>
								<td></td>
						</tr>
					</table>
					</td>
					<td  style="text-align:center; border: 1px solid black;">
					<table style="width:100%;text-align:center;"  class="test1" >
						<tr>
								<td></td>
								<td>(<?php echo $row_select_pipe['cl4'];?> X 0.03546 X <?php echo $row_select_pipe['cl5'];?> X 100)</td>
								<td></td>
						</tr>
						<tr>
								<td></td>
								<td><hr style="border-bottom: 1px solid black;"></td>
								<td>X 100</td>
						</tr>
						<tr>
								<td></td>
								<td><?php echo $row_select_pipe['cl1'];?></td>
								<td></td>
						</tr>
					</table>
					
					</td>
					<td  style="text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['cl6'];?> %</td>
				</tr>
				</table>
				<table align="center" width="90%" class="test1"  height="Auto">
				<tr >
					
					<td style="text-align:left;border-left:0px solid;" colspan="5"><b>9. ALAKALI CONTENT Na<sub>2</sub>O <?php if($row_select_pipe['alk_test_method']!="" && $row_select_pipe['alk_test_method']!=null && $row_select_pipe['alk_test_method']!="0" && $row_select_pipe['alk_test_method']!="undefined"){echo $row_select_pipe['alk_test_method'];}else{?>IS 3812 (Part-1):2013 (RA 2017)  ANNEX C<?php }?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">WEIGHT OF SAMPLE (W) GM</td>
					<td colspan="2" style="width:30%;text-align:center; border: 1px solid black;">--</td>
					<td  style="width:15%;text-align:center; border: 1px solid black;"><?php echo $row_select_pipe['alk1'];?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  rowspan="2" style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  rowspan="2" style="width:50%;text-align:left; border: 1px solid black;"> ALAKALI CONTENT Na<sub>2</sub>O</b> EQUIVALENT % <br> = Na<sub>2</sub>O% + 0.658 x K<sub>2</sub>O%</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk2'];?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk3'];?></td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['alk4'];?> %</td>
				</tr>
				</table>
				
				<br>
				<table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:240px;">
							<b style="font-size:10px;font-weight:100;">F/FC/01/TR, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.05.2019</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:240px;">
							<b style="font-size:10px;font-weight:100;">Page: 3 of 4<br>
						</div>
					</td>
				</tr>
			</table>
					<div class="pagebreak"> </div>
			<br>
			
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
	
				<h3 style="font-size:14px; text-align:center;">OBSERVATION SHEET OF FLYASH CHEMICAL ANALYSIS <?php if($row_select_pipe['com_test_method']!="" && $row_select_pipe['com_test_method']!=null && $row_select_pipe['com_test_method']!="0" && $row_select_pipe['com_test_method']!="undefined"){echo $row_select_pipe['com_test_method'];}else{?>IS 1727 : 1967 (RA 2018)<?php }?> GRAVIMETRIC METHOD</h3>
			<table align="center" width="90%" class="test"   style="border: 1px solid black; font-family: Times New Roman;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $week_number; ?></td>
				</tr>
				
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no;?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Lab No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no;?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date));?></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;border-bottom:0px">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
			</table>
			<h3 style="font-size:14px; text-align:center;">PERCENTAGE OF FLYASH</h3>
			<br>
			<br>
			<table align="center" width="70%" class="test1"  height="Auto">
				
				<tr style="border: 1px solid black;">
					<td  style="width:20%;border: 1px solid black;text-align:center" >SR.NO.</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;">PRESENT CHEMICAL COMPOUND</td>
					<td  style="width:30%;text-align:center; border: 1px solid black;">PERCENTAGE</td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:20%;border: 1px solid black;text-align:center" >1</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> SILICA</td>
					<td  style="width:30%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['sio7'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >2</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> COMBINED FERRIC OXIDE AND ALUMINA</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['r2o7'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >3</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> CALCUIM OXIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['cao4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >4</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> MAGNESIUM OXIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['mgo4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >5</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> SULPHURIC ANHYDRIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['so4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >6</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> LOSS ON IGNITION</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['ig4'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >7</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> CHLORIDE</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo $row_select_pipe['cl6'];?></td>
					
				</tr>
				<tr style="border: 1px solid black;">
					<td  style="width:5%;border: 1px solid black;text-align:center" >8</td>
					<td  style="width:50%;text-align:left; border: 1px solid black;"> ALKALI</td>
					<td  style="width:5%;border: 1px solid black;text-align:center" ><?php echo number_format($row_select_pipe['alk2'],2);?></td>
					
				</tr>
				
				<tr style="border: 1px solid black;">
					<td  colspan="2" style="width:70%;border: 1px solid black;text-align:center" >TOTAL</td>
					
					<td  style="width:30%;border: 1px solid black;text-align:center" >
					
					<?php 
					$ans = floatval($row_select_pipe['sio7']) + floatval($row_select_pipe['r2o7']) + floatval($row_select_pipe['cao4']) + floatval($row_select_pipe['mgo4']) + floatval($row_select_pipe['so4']) + floatval($row_select_pipe['ig4']) + floatval($row_select_pipe['cl6']) + floatval($row_select_pipe['alk2']);
					
					echo number_format($ans,2);
					
					?></td>
					
				</tr>
				
				</table>
			
			
			<br>
			<table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:10px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:450px;">
							<b style="font-size:10px;font-weight:100;">F/FC/01/TR, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:100;">W.e.f. 01.05.2019</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:450px;">
							<b style="font-size:10px;font-weight:100;">Page: 4 of 4<br>
						</div>
					</td>
				</tr>
			</table>
			
			</page>
		
	</body>
</html> 
		
	
<script type="text/javascript">


</script>