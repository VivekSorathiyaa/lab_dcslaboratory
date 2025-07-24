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
			$select_tiles_query = "select * from ws_bela_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			// $sr_no= $row_select['sr_no'];
			// $sample_no= $row_select['job_no'];
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
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		<page size="A4" >
		
			<table align="center" width="90%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="0">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 2</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:75%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BELLA</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">SPECIFIC GRAVITY (IS: 1128-1975)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>SR No.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Particular</b></td>						
					<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Observation</b></td>						
					<td style="border: 1px solid black; text-align:center;"><b>Average</b></td>						
				</tr>
				<tr>		
					<td width="5%" style="border: 1px solid black; text-align:center;"><b></b></td>					
					<td width="40%" style="border: 1px solid black; text-align:center;"><b>Identification</b></td>					
					<td width="15%" style="border: 1px solid black; text-align:center;"><b>1</b></td>								
					<td width="15%" style="border: 1px solid black; text-align:center;"><b>2</b></td>						
					<td width="15%" style="border: 1px solid black; text-align:center;"><b>3</b></td>										
					<td width="10%" style="border: 1px solid black; text-align:center;"><b></b></td>										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Weight of the bottle with stopper and powder in gm - W<sub>2</sub></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w2_1']!="" && $row_select_pipe['w2_1']!="0" && $row_select_pipe['w2_1']!=null){echo $row_select_pipe['w2_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w2_2']!="" && $row_select_pipe['w2_2']!="0" && $row_select_pipe['w2_2']!=null){echo $row_select_pipe['w2_2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w2_3']!="" && $row_select_pipe['w2_3']!="0" && $row_select_pipe['w2_3']!=null){echo $row_select_pipe['w2_3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_w2']!="" && $row_select_pipe['avg_w2']!="0" && $row_select_pipe['avg_w2']!=null){echo $row_select_pipe['avg_w2']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Weight of the empty specific gravity bottle with stopper in gm - W<sub>1</sub></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w1_1']!="" && $row_select_pipe['w1_1']!="0" && $row_select_pipe['w1_1']!=null){echo $row_select_pipe['w1_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w1_2']!="" && $row_select_pipe['w1_2']!="0" && $row_select_pipe['w1_2']!=null){echo $row_select_pipe['w1_2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w1_3']!="" && $row_select_pipe['w1_3']!="0" && $row_select_pipe['w1_3']!=null){echo $row_select_pipe['w1_3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_w1']!="" && $row_select_pipe['avg_w1']!="0" && $row_select_pipe['avg_w1']!=null){echo $row_select_pipe['avg_w1']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Weight of the bottle with stopper filled with distilled water at room temperature in gm - W<sub>4</sub></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w4_1']!="" && $row_select_pipe['w4_1']!="0" && $row_select_pipe['w4_1']!=null){echo $row_select_pipe['w4_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w4_2']!="" && $row_select_pipe['w4_2']!="0" && $row_select_pipe['w4_2']!=null){echo $row_select_pipe['w4_2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w4_3']!="" && $row_select_pipe['w4_3']!="0" && $row_select_pipe['w4_3']!=null){echo $row_select_pipe['w4_3']; }else{echo "&nbsp;";}?></b></td>
										
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_w4']!="" && $row_select_pipe['avg_w4']!="0" && $row_select_pipe['avg_w4']!=null){echo $row_select_pipe['avg_w4']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>Weight of the bottle with stopper powder and distilled water to fill rest opf the bottle at room temperature in gm - W<sub>3</sub></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w3_1']!="" && $row_select_pipe['w3_1']!="0" && $row_select_pipe['w3_1']!=null){echo $row_select_pipe['w3_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w3_2']!="" && $row_select_pipe['w3_2']!="0" && $row_select_pipe['w3_2']!=null){echo $row_select_pipe['w3_2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['w3_3']!="" && $row_select_pipe['w3_3']!="0" && $row_select_pipe['w3_3']!=null){echo $row_select_pipe['w3_3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_w3']!="" && $row_select_pipe['avg_w3']!="0" && $row_select_pipe['avg_w3']!=null){echo $row_select_pipe['avg_w3']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>
					
					<div>
						<div style="float:left; margin-top:20px; ">
							True Specific Gravity =
						</div>
						<div style="float:right;">
							<p style="border-bottom:1px solid black;">W2 - W1</p>
							<p style="">(W4 - W2) - (W3 - W2)</p>
						</div>
					</div>
					
					</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spg_1']!="" && $row_select_pipe['spg_1']!="0" && $row_select_pipe['spg_1']!=null){echo $row_select_pipe['spg_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spg_2']!="" && $row_select_pipe['spg_2']!="0" && $row_select_pipe['spg_2']!=null){echo $row_select_pipe['spg_2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spg_3']!="" && $row_select_pipe['spg_3']!="0" && $row_select_pipe['spg_3']!=null){echo $row_select_pipe['spg_3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_spg']!="" && $row_select_pipe['avg_spg']!="0" && $row_select_pipe['avg_spg']!=null){echo $row_select_pipe['avg_spg']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<!--<tr>
					<td colspan="3" style="border: 1px solid black;"><b>Tested By:</b></td>				
					<td colspan="3" style="border: 1px solid black;"><b>Checked By:</b></td>						
				</tr>-->
			</table>
			<br>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="9">COMPRESSIVE STRENGTH (IS: 1123-1975)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="9"></td>
						</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>ab ID No</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Condition Dry/Wet</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Length(b) or Diameter (d) (mm)</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Height (h) mm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Length (Diameter) / Height Ratio</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Cross sectional area (cm<sup>2</sup>)</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Maximum Load (KN)</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Compressive Strength cc (N/mm<sup>2</sup>)</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Average Compressive Strength (kg/cm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['con1']!="" && $row_select_pipe['con1']!="0" && $row_select_pipe['con1']!=null){echo $row_select_pipe['con1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len1']!="" && $row_select_pipe['len1']!="0" && $row_select_pipe['len1']!=null){echo $row_select_pipe['len1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['h1']!="" && $row_select_pipe['h1']!="0" && $row_select_pipe['h1']!=null){echo $row_select_pipe['h1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio1']!="" && $row_select_pipe['ratio1']!="0" && $row_select_pipe['ratio1']!=null){echo $row_select_pipe['ratio1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area1']!="" && $row_select_pipe['area1']!="0" && $row_select_pipe['area1']!=null){echo $row_select_pipe['area1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load1']!="" && $row_select_pipe['load1']!="0" && $row_select_pipe['load1']!=null){echo $row_select_pipe['load1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com1']!="" && $row_select_pipe['com1']!="0" && $row_select_pipe['com1']!=null){echo $row_select_pipe['com1']; }else{echo "&nbsp;";}?></b></td>						
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_com1']!="" && $row_select_pipe['avg_com1']!="0" && $row_select_pipe['avg_com1']!=null){echo $row_select_pipe['avg_com1']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['con2']!="" && $row_select_pipe['con2']!="0" && $row_select_pipe['con2']!=null){echo $row_select_pipe['con2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len2']!="" && $row_select_pipe['len2']!="0" && $row_select_pipe['len2']!=null){echo $row_select_pipe['len2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['h2']!="" && $row_select_pipe['h2']!="0" && $row_select_pipe['h2']!=null){echo $row_select_pipe['h2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio2']!="" && $row_select_pipe['ratio2']!="0" && $row_select_pipe['ratio2']!=null){echo $row_select_pipe['ratio2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area2']!="" && $row_select_pipe['area2']!="0" && $row_select_pipe['area2']!=null){echo $row_select_pipe['area2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load2']!="" && $row_select_pipe['load2']!="0" && $row_select_pipe['load2']!=null){echo $row_select_pipe['load2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com2']!="" && $row_select_pipe['com2']!="0" && $row_select_pipe['com2']!=null){echo $row_select_pipe['com2']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['con3']!="" && $row_select_pipe['con3']!="0" && $row_select_pipe['con3']!=null){echo $row_select_pipe['con3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len3']!="" && $row_select_pipe['len3']!="0" && $row_select_pipe['len3']!=null){echo $row_select_pipe['len3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['h3']!="" && $row_select_pipe['h3']!="0" && $row_select_pipe['h3']!=null){echo $row_select_pipe['h3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio3']!="" && $row_select_pipe['ratio3']!="0" && $row_select_pipe['ratio3']!=null){echo $row_select_pipe['ratio3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area3']!="" && $row_select_pipe['area3']!="0" && $row_select_pipe['area3']!=null){echo $row_select_pipe['area3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load3']!="" && $row_select_pipe['load3']!="0" && $row_select_pipe['load3']!=null){echo $row_select_pipe['load3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com3']!="" && $row_select_pipe['com3']!="0" && $row_select_pipe['com3']!=null){echo $row_select_pipe['com3']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['con4']!="" && $row_select_pipe['con4']!="0" && $row_select_pipe['con4']!=null){echo $row_select_pipe['con4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len4']!="" && $row_select_pipe['len4']!="0" && $row_select_pipe['len4']!=null){echo $row_select_pipe['len4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['h4']!="" && $row_select_pipe['h4']!="0" && $row_select_pipe['h4']!=null){echo $row_select_pipe['h4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio4']!="" && $row_select_pipe['ratio4']!="0" && $row_select_pipe['ratio4']!=null){echo $row_select_pipe['ratio4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area4']!="" && $row_select_pipe['area4']!="0" && $row_select_pipe['area4']!=null){echo $row_select_pipe['area4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load4']!="" && $row_select_pipe['load4']!="0" && $row_select_pipe['load4']!=null){echo $row_select_pipe['load4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com4']!="" && $row_select_pipe['com4']!="0" && $row_select_pipe['com4']!=null){echo $row_select_pipe['com4']; }else{echo "&nbsp;";}?></b></td>						
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_com2']!="" && $row_select_pipe['avg_com2']!="0" && $row_select_pipe['avg_com2']!=null){echo $row_select_pipe['avg_com2']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['con5']!="" && $row_select_pipe['con5']!="0" && $row_select_pipe['con5']!=null){echo $row_select_pipe['con5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len5']!="" && $row_select_pipe['len5']!="0" && $row_select_pipe['len5']!=null){echo $row_select_pipe['len5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['h5']!="" && $row_select_pipe['h5']!="0" && $row_select_pipe['h5']!=null){echo $row_select_pipe['h5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio5']!="" && $row_select_pipe['ratio5']!="0" && $row_select_pipe['ratio5']!=null){echo $row_select_pipe['ratio5']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area5']!="" && $row_select_pipe['area5']!="0" && $row_select_pipe['area5']!=null){echo $row_select_pipe['area5']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load5']!="" && $row_select_pipe['load5']!="0" && $row_select_pipe['load5']!=null){echo $row_select_pipe['load5']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com5']!="" && $row_select_pipe['com5']!="0" && $row_select_pipe['com5']!=null){echo $row_select_pipe['com5']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['con6']!="" && $row_select_pipe['con6']!="0" && $row_select_pipe['con6']!=null){echo $row_select_pipe['con6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['len6']!="" && $row_select_pipe['len6']!="0" && $row_select_pipe['len6']!=null){echo $row_select_pipe['len6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['h6']!="" && $row_select_pipe['h6']!="0" && $row_select_pipe['h6']!=null){echo $row_select_pipe['h6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ratio6']!="" && $row_select_pipe['ratio6']!="0" && $row_select_pipe['ratio6']!=null){echo $row_select_pipe['ratio6']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area6']!="" && $row_select_pipe['area6']!="0" && $row_select_pipe['area6']!=null){echo $row_select_pipe['area6']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load6']!="" && $row_select_pipe['load6']!="0" && $row_select_pipe['load6']!=null){echo $row_select_pipe['load6']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com6']!="" && $row_select_pipe['com6']!="0" && $row_select_pipe['com6']!=null){echo $row_select_pipe['com6']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black;"><b>Cc = compresive strength of standard test piece <br> Cp = compresive strength of the specimen having a height greater than the diameter of lateral dimention.</b></td>
					<td colspan="3" style="border: 1px solid black;"><b>Cp = Cc/(0.778 + 0.222(b+h))</b></td>
				</tr>
				<tr>
					<td colspan="5" style="border: 1px solid black;"><b>Tested By:</b></td>
					<td colspan="5" style="border: 1px solid black;"><b>Checked By:</b></td>
				</tr>
			</table>
			<div class="pagebreak"> </div>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="0">
				<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 2</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:75%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:25%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:100px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:75%; text-align:center;padding-left:150px;padding-bottom:3px;padding-top:3px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
						</tr>
						<tr>
							<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;width: 8%;" colspan="6">WATER ABSORPTION, APPARENT SPECIFIC GRAVITY AND POROSITY (IS:1597 (Part-1) 1967)</td>
						</tr>
						<tr>
							<td style="padding: 1px;border: 1px solid;" colspan="3"></td>
						</tr>
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON BELLA</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:3px;padding-top:3px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>SR No.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Particular</b></td>						
					<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Observation</b></td>						
					<td style="border: 1px solid black; text-align:center;"><b>Average</b></td>						
				</tr>
				<tr>		
					<td width="5%" style="border: 1px solid black; text-align:center;"><b></b></td>					
					<td width="40%" style="border: 1px solid black; text-align:center;"><b>Identification</b></td>					
					<td width="15%" style="border: 1px solid black; text-align:center;"><b>1</b></td>								
					<td width="15%" style="border: 1px solid black; text-align:center;"><b>2</b></td>						
					<td width="15%" style="border: 1px solid black; text-align:center;"><b>3</b></td>										
					<td width="10%" style="border: 1px solid black; text-align:center;"><b></b></td>										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Weight of Oven Dry Test Piece in gm = A</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['a1']!="" && $row_select_pipe['a1']!="0" && $row_select_pipe['a1']!=null){echo $row_select_pipe['a1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['a2']!="" && $row_select_pipe['a2']!="0" && $row_select_pipe['a2']!=null){echo $row_select_pipe['a2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['a3']!="" && $row_select_pipe['a3']!="0" && $row_select_pipe['a3']!=null){echo $row_select_pipe['a3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_a']!="" && $row_select_pipe['avg_a']!="0" && $row_select_pipe['avg_a']!=null){echo $row_select_pipe['avg_a']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Quantity of Water added in 1000ml jar containing the test piece in gm =C</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['c1']!="" && $row_select_pipe['c1']!="0" && $row_select_pipe['c1']!=null){echo $row_select_pipe['c1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['c2']!="" && $row_select_pipe['c2']!="0" && $row_select_pipe['c2']!=null){echo $row_select_pipe['c2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['c3']!="" && $row_select_pipe['c3']!="0" && $row_select_pipe['c3']!=null){echo $row_select_pipe['c3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_c']!="" && $row_select_pipe['avg_c']!="0" && $row_select_pipe['avg_c']!=null){echo $row_select_pipe['avg_c']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Weight of saturated surface dry test piece in gm = B</b></td>	
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b1']!="" && $row_select_pipe['b1']!="0" && $row_select_pipe['b1']!=null){echo $row_select_pipe['b1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b2']!="" && $row_select_pipe['b2']!="0" && $row_select_pipe['b2']!=null){echo $row_select_pipe['b2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b3']!="" && $row_select_pipe['b3']!="0" && $row_select_pipe['b3']!=null){echo $row_select_pipe['b3']; }else{echo "&nbsp;";}?></b></td>
										
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_b']!="" && $row_select_pipe['avg_b']!="0" && $row_select_pipe['avg_b']!=null){echo $row_select_pipe['avg_b']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>	
					<td style="border: 1px solid black; text-align:center;">
						<b>
							<div>
								<div style="float:left;">
									Apparent specific gravity =
								</div>
								<div style="float:right; margin-top:-18px; margin-right:18px; ">
									<p style="border-bottom:1px solid black;">A</p>
									<p style="">100 - C</p>
								</div>
							</div>
						</b>
					</td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['asg1']!="" && $row_select_pipe['asg1']!="0" && $row_select_pipe['asg1']!=null){echo $row_select_pipe['asg1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['asg2']!="" && $row_select_pipe['asg2']!="0" && $row_select_pipe['asg2']!=null){echo $row_select_pipe['asg2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['asg3']!="" && $row_select_pipe['asg3']!="0" && $row_select_pipe['asg3']!=null){echo $row_select_pipe['asg3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_asg']!="" && $row_select_pipe['avg_asg']!="0" && $row_select_pipe['avg_asg']!=null){echo $row_select_pipe['avg_asg']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>				
					<td style="border: 1px solid black; text-align:center;">
					<b>
							<div>
								<div style="float:left;">
									Water Absorption % =
								</div>
								<div style="float:right; margin-top:-18px; margin-right:18px; ">
									<p style="border-bottom:1px solid black;">(B - A) </p>
									<p style="">A X 100</p>
								</div>
							</div>
						</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['wtr1']!="" && $row_select_pipe['wtr1']!="0" && $row_select_pipe['wtr1']!=null){echo $row_select_pipe['wtr1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['wtr2']!="" && $row_select_pipe['wtr2']!="0" && $row_select_pipe['wtr2']!=null){echo $row_select_pipe['wtr2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['wtr3']!="" && $row_select_pipe['wtr3']!="0" && $row_select_pipe['wtr3']!=null){echo $row_select_pipe['wtr3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_wtr']!="" && $row_select_pipe['avg_wtr']!="0" && $row_select_pipe['avg_wtr']!=null){echo $row_select_pipe['avg_wtr']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>				
					<td style="border: 1px solid black; text-align:center;">
					<b>
							<div>
								<div style="float:left;">
									Apparent Porosity % =
								</div>
								<div style="float:right; margin-top:-18px; margin-right:18px; ">
									<p style="border-bottom:1px solid black;">(B - A) </p>
									<p style="">(100 - C) X 100</p>
								</div>
							</div>
						</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['por1']!="" && $row_select_pipe['por1']!="0" && $row_select_pipe['por1']!=null){echo $row_select_pipe['por1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['por2']!="" && $row_select_pipe['por2']!="0" && $row_select_pipe['por2']!=null){echo $row_select_pipe['por2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['por3']!="" && $row_select_pipe['por3']!="0" && $row_select_pipe['por3']!=null){echo $row_select_pipe['por3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_por']!="" && $row_select_pipe['avg_por']!="0" && $row_select_pipe['avg_por']!=null){echo $row_select_pipe['avg_por']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>True Specific Gravity</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tspg1']!="" && $row_select_pipe['tspg1']!="0" && $row_select_pipe['tspg1']!=null){echo $row_select_pipe['tspg1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tspg2']!="" && $row_select_pipe['tspg2']!="0" && $row_select_pipe['tspg2']!=null){echo $row_select_pipe['tspg2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tspg3']!="" && $row_select_pipe['tspg3']!="0" && $row_select_pipe['tspg3']!=null){echo $row_select_pipe['tspg3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_tspg']!="" && $row_select_pipe['avg_tspg']!="0" && $row_select_pipe['avg_tspg']!=null){echo $row_select_pipe['avg_tspg']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>8.</b></td>				
					<td style="border: 1px solid black; text-align:center;">
						<b>
							<div>
								<div style="float:left;">
									True Porosity =
								</div>
								<div style="float:right; margin-top:-18px;">
									<p style="border-bottom:1px solid black;">true specific gravity - apparent specific gravity </p>
									<p style="">true specific gravity</p>
								</div>
							</div>
						</b>
					
					<b></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tpor1']!="" && $row_select_pipe['tpor1']!="0" && $row_select_pipe['tpor1']!=null){echo $row_select_pipe['tpor1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tpor2']!="" && $row_select_pipe['tpor2']!="0" && $row_select_pipe['tpor2']!=null){echo $row_select_pipe['tpor2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tpor3']!="" && $row_select_pipe['tpor3']!="0" && $row_select_pipe['tpor3']!=null){echo $row_select_pipe['tpor3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_tpor']!="" && $row_select_pipe['avg_tpor']!="0" && $row_select_pipe['avg_tpor']!=null){echo $row_select_pipe['avg_tpor']; }else{echo "&nbsp;";}?></b></td>						
										
				</tr>
				<tr>
					<td colspan="3" style="border: 1px solid black;"><b>Tested By:</b></td>				
					<td colspan="3" style="border: 1px solid black;"><b>Checked By:</b></td>						
				</tr>
			</table>
			
			<!--<div class="pagebreak"> </div>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="5px">
				<tr>
					<td colspan="5" style="font-size:14px;border: 1px solid black;"><center><b>ShSTCji Technical Consultency Services</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="font-size:14px;border: 1px solid black;"><center><b>Worksheet for Transevers strength of natural stone (IS : 1121(Part II))</b></center></td>					
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>F-Natural Stone-02, Issue No.01, Page No 1 of 1</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Laboratory ID No.: <?php echo $job_no;?></b></td>					
					<td colspan="2" style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Stype Of Stone: -</b></td>					
					<td colspan="2" style="border: 1px solid black;"><b></b></td>					
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Lab ID No</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Condition Dry/Wet</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Length(C) cm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Width (b) cm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Depth (d) cm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Central Breaking Load (W)(KN)</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>transverse strength R (kg/cm<sup>2</sup>)</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Average Compressive Strength (kg/cm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tcon1']!="" && $row_select_pipe['tcon1']!="0" && $row_select_pipe['tcon1']!=null){echo $row_select_pipe['tcon1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tl1']!="" && $row_select_pipe['tl1']!="0" && $row_select_pipe['tl1']!=null){echo $row_select_pipe['tl1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tb1']!="" && $row_select_pipe['tb1']!="0" && $row_select_pipe['tb1']!=null){echo $row_select_pipe['tb1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ta1']!="" && $row_select_pipe['ta1']!="0" && $row_select_pipe['ta1']!=null){echo $row_select_pipe['ta1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cb1']!="" && $row_select_pipe['cb1']!="0" && $row_select_pipe['cb1']!=null){echo $row_select_pipe['cb1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tra1']!="" && $row_select_pipe['tra1']!="0" && $row_select_pipe['tra1']!=null){echo $row_select_pipe['tra1']; }else{echo "&nbsp;";}?></b></td>						
										
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_tra1']!="" && $row_select_pipe['avg_tra1']!="0" && $row_select_pipe['avg_tra1']!=null){echo $row_select_pipe['avg_tra1']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tcon2']!="" && $row_select_pipe['tcon2']!="0" && $row_select_pipe['tcon2']!=null){echo $row_select_pipe['tcon2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tl2']!="" && $row_select_pipe['tl2']!="0" && $row_select_pipe['tl2']!=null){echo $row_select_pipe['tl2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tb2']!="" && $row_select_pipe['tb2']!="0" && $row_select_pipe['tb2']!=null){echo $row_select_pipe['tb2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ta2']!="" && $row_select_pipe['ta2']!="0" && $row_select_pipe['ta2']!=null){echo $row_select_pipe['ta2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cb2']!="" && $row_select_pipe['cb2']!="0" && $row_select_pipe['cb2']!=null){echo $row_select_pipe['cb2']; }else{echo "&nbsp;";}?></b></td>						
											
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tra2']!="" && $row_select_pipe['tra2']!="0" && $row_select_pipe['tra2']!=null){echo $row_select_pipe['tra2']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tcon3']!="" && $row_select_pipe['tcon3']!="0" && $row_select_pipe['tcon3']!=null){echo $row_select_pipe['tcon3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tl3']!="" && $row_select_pipe['tl3']!="0" && $row_select_pipe['tl3']!=null){echo $row_select_pipe['tl3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tb3']!="" && $row_select_pipe['tb3']!="0" && $row_select_pipe['tb3']!=null){echo $row_select_pipe['tb3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ta3']!="" && $row_select_pipe['ta3']!="0" && $row_select_pipe['ta3']!=null){echo $row_select_pipe['ta3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cb3']!="" && $row_select_pipe['cb3']!="0" && $row_select_pipe['cb3']!=null){echo $row_select_pipe['cb3']; }else{echo "&nbsp;";}?></b></td>						
											
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tra3']!="" && $row_select_pipe['tra3']!="0" && $row_select_pipe['tra3']!=null){echo $row_select_pipe['tra3']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tcon4']!="" && $row_select_pipe['tcon4']!="0" && $row_select_pipe['tcon4']!=null){echo $row_select_pipe['tcon4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tl4']!="" && $row_select_pipe['tl4']!="0" && $row_select_pipe['tl4']!=null){echo $row_select_pipe['tl4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tb4']!="" && $row_select_pipe['tb4']!="0" && $row_select_pipe['tb4']!=null){echo $row_select_pipe['tb4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ta4']!="" && $row_select_pipe['ta4']!="0" && $row_select_pipe['ta4']!=null){echo $row_select_pipe['ta4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cb4']!="" && $row_select_pipe['cb4']!="0" && $row_select_pipe['cb4']!=null){echo $row_select_pipe['cb4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tra4']!="" && $row_select_pipe['tra4']!="0" && $row_select_pipe['tra4']!=null){echo $row_select_pipe['tra4']; }else{echo "&nbsp;";}?></b></td>						
											
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_tra2']!="" && $row_select_pipe['avg_tra2']!="0" && $row_select_pipe['avg_tra2']!=null){echo $row_select_pipe['avg_tra2']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tcon5']!="" && $row_select_pipe['tcon5']!="0" && $row_select_pipe['tcon5']!=null){echo $row_select_pipe['tcon5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tl5']!="" && $row_select_pipe['tl5']!="0" && $row_select_pipe['tl5']!=null){echo $row_select_pipe['tl5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tb5']!="" && $row_select_pipe['tb5']!="0" && $row_select_pipe['tb5']!=null){echo $row_select_pipe['tb5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ta5']!="" && $row_select_pipe['ta5']!="0" && $row_select_pipe['ta5']!=null){echo $row_select_pipe['ta5']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cb5']!="" && $row_select_pipe['cb5']!="0" && $row_select_pipe['cb5']!=null){echo $row_select_pipe['cb5']; }else{echo "&nbsp;";}?></b></td>						
											
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tra5']!="" && $row_select_pipe['tra5']!="0" && $row_select_pipe['tra5']!=null){echo $row_select_pipe['tra5']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tcon6']!="" && $row_select_pipe['tcon6']!="0" && $row_select_pipe['tcon6']!=null){echo $row_select_pipe['tcon6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tl6']!="" && $row_select_pipe['tl6']!="0" && $row_select_pipe['tl6']!=null){echo $row_select_pipe['tl6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tb6']!="" && $row_select_pipe['tb6']!="0" && $row_select_pipe['tb6']!=null){echo $row_select_pipe['tb6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ta6']!="" && $row_select_pipe['ta6']!="0" && $row_select_pipe['ta6']!=null){echo $row_select_pipe['ta6']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['cb6']!="" && $row_select_pipe['cb6']!="0" && $row_select_pipe['cb6']!=null){echo $row_select_pipe['cb6']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['tra6']!="" && $row_select_pipe['tra6']!="0" && $row_select_pipe['tra6']!=null){echo $row_select_pipe['tra6']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td colspan="9" style="border: 1px solid black;"><b>R = 3WL/2bda<sup>2</sup></b></td>
				</tr>
				<tr>
					<td colspan="5" style="border: 1px solid black;"><b>Tested By:</b></td>
					<td colspan="5" style="border: 1px solid black;"><b>Checked By:</b></td>
				</tr>
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<table align="center" width="90%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="5px">
				<tr>
					<td colspan="5" style="font-size:14px;border: 1px solid black;"><center><b>ShSTCji Technical Consultency Services</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="font-size:14px;border: 1px solid black;"><center><b>Worksheet for Spit Tensile strength of natural stone (IS : 1121(Part II))</b></center></td>					
					<td colspan="2" style="font-size:14px;border: 1px solid black;"><center><b>F-Natural Stone-02, Issue No.01, Page No 1 of 1</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Laboratory ID No.: <?php echo $job_no;?></b></td>					
					<td colspan="2" style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Type Of Stone: -</b></td>					
					<td colspan="2" style="border: 1px solid black;"><b></b></td>					
				</tr>
			</table>
			<table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Lab ID No</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b>Condition Dry/Wet</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Diameter (d) mm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Length(l) cm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Split Load (W) (KN)</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>split tensile strength s(N/mm<sup>2</sup>)</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Average Compressive Strength (kg/cm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon1']!="" && $row_select_pipe['scon1']!="0" && $row_select_pipe['scon1']!=null){echo $row_select_pipe['scon1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd1']!="" && $row_select_pipe['sd1']!="0" && $row_select_pipe['sd1']!=null){echo $row_select_pipe['sd1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl1']!="" && $row_select_pipe['sl1']!="0" && $row_select_pipe['sl1']!=null){echo $row_select_pipe['sl1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload1']!="" && $row_select_pipe['sload1']!="0" && $row_select_pipe['sload1']!=null){echo $row_select_pipe['sload1']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten1']!="" && $row_select_pipe['ten1']!="0" && $row_select_pipe['ten1']!=null){echo $row_select_pipe['ten1']; }else{echo "&nbsp;";}?></b></td>						
										
					<td rowspan="5" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_ten1']!="" && $row_select_pipe['avg_ten1']!="0" && $row_select_pipe['avg_ten1']!=null){echo $row_select_pipe['avg_ten1']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon2']!="" && $row_select_pipe['scon2']!="0" && $row_select_pipe['scon2']!=null){echo $row_select_pipe['scon2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd2']!="" && $row_select_pipe['sd2']!="0" && $row_select_pipe['sd2']!=null){echo $row_select_pipe['sd2']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl2']!="" && $row_select_pipe['sl2']!="0" && $row_select_pipe['sl2']!=null){echo $row_select_pipe['sl2']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload2']!="" && $row_select_pipe['sload2']!="0" && $row_select_pipe['sload2']!=null){echo $row_select_pipe['sload2']; }else{echo "&nbsp;";}?></b></td>						
											
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten2']!="" && $row_select_pipe['ten2']!="0" && $row_select_pipe['ten2']!=null){echo $row_select_pipe['ten2']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon3']!="" && $row_select_pipe['scon3']!="0" && $row_select_pipe['scon3']!=null){echo $row_select_pipe['scon3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd3']!="" && $row_select_pipe['sd3']!="0" && $row_select_pipe['sd3']!=null){echo $row_select_pipe['sd3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl3']!="" && $row_select_pipe['sl3']!="0" && $row_select_pipe['sl3']!=null){echo $row_select_pipe['sl3']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload3']!="" && $row_select_pipe['sload3']!="0" && $row_select_pipe['sload3']!=null){echo $row_select_pipe['sload3']; }else{echo "&nbsp;";}?></b></td>
											
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten3']!="" && $row_select_pipe['ten3']!="0" && $row_select_pipe['ten3']!=null){echo $row_select_pipe['ten3']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon4']!="" && $row_select_pipe['scon4']!="0" && $row_select_pipe['scon4']!=null){echo $row_select_pipe['scon4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd4']!="" && $row_select_pipe['sd4']!="0" && $row_select_pipe['sd4']!=null){echo $row_select_pipe['sd4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl4']!="" && $row_select_pipe['sl4']!="0" && $row_select_pipe['sl4']!=null){echo $row_select_pipe['sl4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload4']!="" && $row_select_pipe['sload4']!="0" && $row_select_pipe['sload4']!=null){echo $row_select_pipe['sload4']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten4']!="" && $row_select_pipe['ten4']!="0" && $row_select_pipe['ten4']!=null){echo $row_select_pipe['ten4']; }else{echo "&nbsp;";}?></b></td>											
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon5']!="" && $row_select_pipe['scon5']!="0" && $row_select_pipe['scon5']!=null){echo $row_select_pipe['scon5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd5']!="" && $row_select_pipe['sd5']!="0" && $row_select_pipe['sd5']!=null){echo $row_select_pipe['sd5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl5']!="" && $row_select_pipe['sl5']!="0" && $row_select_pipe['sl5']!=null){echo $row_select_pipe['sl5']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload5']!="" && $row_select_pipe['sload5']!="0" && $row_select_pipe['sload5']!=null){echo $row_select_pipe['sload5']; }else{echo "&nbsp;";}?></b></td>						
											
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten5']!="" && $row_select_pipe['ten5']!="0" && $row_select_pipe['ten5']!=null){echo $row_select_pipe['ten5']; }else{echo "&nbsp;";}?></b></td>						
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon6']!="" && $row_select_pipe['scon6']!="0" && $row_select_pipe['scon6']!=null){echo $row_select_pipe['scon6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd6']!="" && $row_select_pipe['sd6']!="0" && $row_select_pipe['sd6']!=null){echo $row_select_pipe['sd6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl6']!="" && $row_select_pipe['sl6']!="0" && $row_select_pipe['sl6']!=null){echo $row_select_pipe['sl6']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload6']!="" && $row_select_pipe['sload6']!="0" && $row_select_pipe['sload6']!=null){echo $row_select_pipe['sload6']; }else{echo "&nbsp;";}?></b></td>
					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten6']!="" && $row_select_pipe['ten6']!="0" && $row_select_pipe['ten6']!=null){echo $row_select_pipe['ten6']; }else{echo "&nbsp;";}?></b></td>
					
					<td rowspan="5" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_ten2']!="" && $row_select_pipe['avg_ten2']!="0" && $row_select_pipe['avg_ten2']!=null){echo $row_select_pipe['avg_ten2']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon7']!="" && $row_select_pipe['scon7']!="0" && $row_select_pipe['scon7']!=null){echo $row_select_pipe['scon7']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd7']!="" && $row_select_pipe['sd7']!="0" && $row_select_pipe['sd7']!=null){echo $row_select_pipe['sd7']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl7']!="" && $row_select_pipe['sl7']!="0" && $row_select_pipe['sl7']!=null){echo $row_select_pipe['sl7']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload7']!="" && $row_select_pipe['sload7']!="0" && $row_select_pipe['sload7']!=null){echo $row_select_pipe['sload7']; }else{echo "&nbsp;";}?></b></td>
					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten7']!="" && $row_select_pipe['ten7']!="0" && $row_select_pipe['ten7']!=null){echo $row_select_pipe['ten7']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>8.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon8']!="" && $row_select_pipe['scon8']!="0" && $row_select_pipe['scon8']!=null){echo $row_select_pipe['scon8']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd8']!="" && $row_select_pipe['sd8']!="0" && $row_select_pipe['sd8']!=null){echo $row_select_pipe['sd8']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl8']!="" && $row_select_pipe['sl8']!="0" && $row_select_pipe['sl8']!=null){echo $row_select_pipe['sl8']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload8']!="" && $row_select_pipe['sload8']!="0" && $row_select_pipe['sload8']!=null){echo $row_select_pipe['sload8']; }else{echo "&nbsp;";}?></b></td>
					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten8']!="" && $row_select_pipe['ten8']!="0" && $row_select_pipe['ten8']!=null){echo $row_select_pipe['ten8']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>9.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon9']!="" && $row_select_pipe['scon9']!="0" && $row_select_pipe['scon9']!=null){echo $row_select_pipe['scon9']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd9']!="" && $row_select_pipe['sd9']!="0" && $row_select_pipe['sd9']!=null){echo $row_select_pipe['sd9']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl9']!="" && $row_select_pipe['sl9']!="0" && $row_select_pipe['sl9']!=null){echo $row_select_pipe['sl9']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload9']!="" && $row_select_pipe['sload9']!="0" && $row_select_pipe['sload9']!=null){echo $row_select_pipe['sload9']; }else{echo "&nbsp;";}?></b></td>
					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten9']!="" && $row_select_pipe['ten9']!="0" && $row_select_pipe['ten9']!=null){echo $row_select_pipe['ten9']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>10.</b></td>				
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['scon10']!="" && $row_select_pipe['scon10']!="0" && $row_select_pipe['scon10']!=null){echo $row_select_pipe['scon10']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sd10']!="" && $row_select_pipe['sd10']!="0" && $row_select_pipe['sd10']!=null){echo $row_select_pipe['sd10']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sl10']!="" && $row_select_pipe['sl10']!="0" && $row_select_pipe['sl10']!=null){echo $row_select_pipe['sl10']; }else{echo "&nbsp;";}?></b></td>						
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['sload10']!="" && $row_select_pipe['sload10']!="0" && $row_select_pipe['sload10']!=null){echo $row_select_pipe['sload10']; }else{echo "&nbsp;";}?></b></td>
					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['ten10']!="" && $row_select_pipe['ten10']!="0" && $row_select_pipe['ten10']!=null){echo $row_select_pipe['ten10']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td colspan="9" style="border: 1px solid black;"><b>R = 2W/dl</b></td>
				</tr>
				<tr>
					<td colspan="5" style="border: 1px solid black;"><b>Tested By:</b></td>
					<td colspan="5" style="border: 1px solid black;"><b>Checked By:</b></td>
				</tr>
			</table>-->
			
		</page>
		
	</body>
</html> 