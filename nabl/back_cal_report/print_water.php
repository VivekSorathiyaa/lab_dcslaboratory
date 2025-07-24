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
	 font-family: Book Antiqua;
}
.test {
   border-collapse: collapse;
	font-size:12px;
	 font-family: Book Antiqua;
}
.test1 {
   font-size:12px;
   border-collapse: collapse;
	 font-family: Book Antiqua;
	 
}
	.tdclass1{
    
    font-size:11px;
	 font-family: Book Antiqua;
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
			$select_tiles_query = "select * from water WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
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
					$water_source= $row_select4['water_source'];
					$water_brand= $row_select4['water_brand'];
					$water_specification= $row_select4['water_specification'];
				}
				
				
				
				$totalpage=0;
				$pagecnt=0;
			if(($row_select_pipe['avgp']!="" && $row_select_pipe['avgp']!=null && $row_select_pipe['avgp']!="0")||
			($row_select_pipe['avgh']!="" && $row_select_pipe['avgh']!=null && $row_select_pipe['avgh']!="0") ||
			($row_select_pipe['avgn']!="" && $row_select_pipe['avgn']!=null && $row_select_pipe['avgn']!="0") ||
			($row_select_pipe['avgts']!="" && $row_select_pipe['avgts']!=null && $row_select_pipe['avgts']!="0")||
			($row_select_pipe['avgtd']!="" && $row_select_pipe['avgtd']!=null && $row_select_pipe['avgtd']!="0"))
			{
				$totalpage++;	
			}
			
			if(($row_select_pipe['avghr']!="" && $row_select_pipe['avghr']!=null && $row_select_pipe['avghr']!="0")||
			($row_select_pipe['avgch']!="" && $row_select_pipe['avgch']!=null && $row_select_pipe['avgch']!="0")||
			($row_select_pipe['avgsu']!="" && $row_select_pipe['avgsu']!=null && $row_select_pipe['avgsu']!="0")||
			($row_select_pipe['avgin']!="" && $row_select_pipe['avgin']!=null && $row_select_pipe['avgin']!="0")||
			($row_select_pipe['avgor']!="" && $row_select_pipe['avgor']!=null && $row_select_pipe['avgor']!="0")||
			($row_select_pipe['avguu']!="" && $row_select_pipe['avguu']!=null && $row_select_pipe['avguu']!="0"))
			{
				$totalpage++;	
			}
			
			if(($row_select_pipe['avgp']!="" && $row_select_pipe['avgp']!=null && $row_select_pipe['avgp']!="0")||
			($row_select_pipe['avgh']!="" && $row_select_pipe['avgh']!=null && $row_select_pipe['avgh']!="0") ||
			($row_select_pipe['avgn']!="" && $row_select_pipe['avgn']!=null && $row_select_pipe['avgn']!="0") ||
			($row_select_pipe['avgts']!="" && $row_select_pipe['avgts']!=null && $row_select_pipe['avgts']!="0")||
			($row_select_pipe['avgtd']!="" && $row_select_pipe['avgtd']!=null && $row_select_pipe['avgtd']!="0"))
			{
					$pagecnt++;
					
					$count=1;
		?>
		
		<br>
	<page size="A4" >
	

			<table align="center" width="92%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;border-collapse: collapse;">
				 <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 3</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:2px;padding-top:2px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:2px;padding-top:2px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON WATER</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>

			<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border:1px solid black;text-align:center;padding: 7px 4px;border-bottom: 0;width: 4%;"><b>Sr.No.</b></td>
					<td style="border:1px solid black;text-align:center;padding: 7px 4px;border-bottom: 0;width: 26%;"><b>Tests/Observation</b></td>
					<td style="border:1px solid black;text-align:center;padding: 7px 4px;border-bottom: 0;width: 8%;"><b>Calculation</b></td>
					<td style="border:1px solid black;text-align:center;padding: 7px 4px;border-bottom: 0;width: 6%;"><b>Results</b></td>
					<td style="border:1px solid black;text-align:center;padding: 7px 4px;border-bottom: 0;width: 6%;"><b>Unit</b></td>
				</tr>
				<?php
					
					if(($row_select_pipe['avgp']!="" && $row_select_pipe['avgp']!=null && $row_select_pipe['avgp']!="0")||
					($row_select_pipe['avgtd']!="" && $row_select_pipe['avgtd']!=null && $row_select_pipe['avgtd']!="0")||
					($row_select_pipe['avgin']!="" && $row_select_pipe['avgin']!=null && $row_select_pipe['avgin']!="0")||
					($row_select_pipe['avgor']!="" && $row_select_pipe['avgor']!=null && $row_select_pipe['avgor']!="0"))
					{
						$pagecnt++;
					
					?>
				<tr>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;" colspan="2">pH (at 25<sup>o</sup>C)(Pt.11)</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['avgp']!="" && $row_select_pipe['avgp']!="0" && $row_select_pipe['avgp']!=null){echo $row_select_pipe['avgp']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"></td>
				</tr>
				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;" rowspan="6"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;" colspan="4">Dissolve Solid</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">1)Volume of sample taken,ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['tda1']!="" && $row_select_pipe['tda1']!="0" && $row_select_pipe['tda1']!=null){echo $row_select_pipe['tda1']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;" rowspan="5"><?php if($row_select_pipe['avgtd']!="" && $row_select_pipe['avgtd']!="0" && $row_select_pipe['avgtd']!=null){echo $row_select_pipe['avgtd']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;" rowspan="5">mg/l</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">2)wt. of evaporating dish + residue after  drying 105&plusmn;2&deg; , gm=</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['tdb1']!="" && $row_select_pipe['tdb1']!="0" && $row_select_pipe['tdb1']!=null){echo $row_select_pipe['tdb1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">3)wt of empty evaporating, gm =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['tdc1']!="" && $row_select_pipe['tdc1']!="0" && $row_select_pipe['tdc1']!=null){echo $row_select_pipe['tdc1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">4)difference in wt.gm=</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['tdd1']!="" && $row_select_pipe['tdd1']!="0" && $row_select_pipe['tdd1']!=null){echo $row_select_pipe['tdd1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="width:50%;border: 1px solid black;text-align:left;padding-bottom: 8px;" colspan="2">&nbsp; 
						<table class="test">
							<tr>
								<td width="150px" rowspan="2" style="text-align:center;">Total dissolve Solid =</td>
								<td width="160px" style="border-bottom: 1px solid black; text-align:center;">diff.in wt *1000*1000</td>
							</tr>
							<tr>
								<td style="text-align:center;">volume of sample taken</td>
							</tr>
						</table>
					</td>
				</tr>
				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;" rowspan="6"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;" colspan="4">Organic solid, (Pt.18)</td>
				</tr>

				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">1)volume of sample taken,ml=</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['ora1']!="" && $row_select_pipe['ora1']!="0" && $row_select_pipe['ora1']!=null){echo $row_select_pipe['ora1']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;" rowspan="5"><?php if($row_select_pipe['avgor']!="" && $row_select_pipe['avgor']!="0" && $row_select_pipe['avgor']!=null){echo $row_select_pipe['avgor']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;" rowspan="5">mg/l</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">2)wt.of evaporting dish + residue after drying 105&plusmn;2&deg;C,ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['orb1']!="" && $row_select_pipe['orb1']!="0" && $row_select_pipe['orb1']!=null){echo $row_select_pipe['orb1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">3)wt.of.evaporating dish + residue after,ignite 550&deg;C,ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['orc1']!="" && $row_select_pipe['orc1']!="0" && $row_select_pipe['orc1']!=null){echo $row_select_pipe['orc1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">4)difference in Wt. gm =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['ord1']!="" && $row_select_pipe['ord1']!="0" && $row_select_pipe['ord1']!=null){echo $row_select_pipe['ord1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="width:50%;border: 1px solid black;text-align:left;padding-bottom: 8px;" colspan="2">&nbsp; 
						<table class="test">
							<tr>
								<td width="150px" rowspan="2" style="text-align:center;">Organic Solid =</td>
								<td width="160px" style="border-bottom: 1px solid black; text-align:center;">Diff.in wt. * 1000*1000</td>
							</tr>
							<tr>
								<td style="text-align:center;">volume of sample taken</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 1px solid;" rowspan="6"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;" colspan="4">In-organic solid, (Pt.18)</td>
				</tr>

				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">1)volume of sample taken,ml=</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['ina1']!="" && $row_select_pipe['ina1']!="0" && $row_select_pipe['ina1']!=null){echo $row_select_pipe['ina1']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 1px solid;" rowspan="5"><?php if($row_select_pipe['avgin']!="" && $row_select_pipe['avgin']!="0" && $row_select_pipe['avgin']!=null){echo $row_select_pipe['avgin']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 1px solid;" rowspan="5">mg/l</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">2)wt.of evaporting dish + residue after ignite 550&deg;C,ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['inb1']!="" && $row_select_pipe['inb1']!="0" && $row_select_pipe['inb1']!=null){echo $row_select_pipe['inb1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">3)wt.of.empty evaporating,gm =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['inc1']!="" && $row_select_pipe['inc1']!="0" && $row_select_pipe['inc1']!=null){echo $row_select_pipe['inc1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 5px 4px;border-bottom: 0;">4)difference in Wt. gm =</td>
					<td style="border:1px solid black;text-align:center;padding: 5px 4px;border-bottom: 0;"><?php if($row_select_pipe['ind1']!="" && $row_select_pipe['ind1']!="0" && $row_select_pipe['ind1']!=null){echo $row_select_pipe['ind1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="width:50%;border: 1px solid black;text-align:left;padding-bottom: 8px;" colspan="2">&nbsp; 
						<table class="test">
							<tr>
								<td width="150px" rowspan="2" style="text-align:center;">In-organic Solid =</td>
								<td width="160px" style="border-bottom: 1px solid black; text-align:center;">Diff.in wt. * 1000*1000</td>
							</tr>
							<tr>
								<td style="text-align:center;">volume of sample taken</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php }?>

				
			</table>
			<table align="center" width="92%" class="test1" height="Auto" style="">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				
			</table>
			<br>

			<table align="center" width="92%" class="test" style="height:Auto;font-size: 9px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 24px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;">Page 1 of 2</td>
				</tr>
			</table>

			<div class="pagebreak"></div>
			<br><br>

			<table align="center" width="92%" cellpadding="0" style="font-size:11px;height:auto;font-family : Calibri;padding: 0;border-collapse: collapse;">
				 <tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-top:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:30%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; DOC: STC/N/OS/001</td>
							<td  style="width:20%;text-align:center;font-weight:bold; ">REV: 1</td>				
							<td  style="width:25%; font-weight:bold;">RD:- 01/01/2025</td>
							<td  style="width:25%;font-weight:bold;">Page : 3</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:60%;font-weight:bold;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Prepared by: Technical Manager</td>
							<td  style="width:40%;text-align:left;font-weight:bold; ">Approved by: Quality Manager</td>
						</tr>
						
					</table>
				
				</td>
		</tr> 	
		<tr>
				<td  style="text-align:center;font-size:16px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:16px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;border-left:1px solid;">
			
						<tr style=""> 
							
							<td  style="width:80%;padding-left:150px; text-align:center;font-weight:bold;padding-bottom:2px;padding-top:2px; ">STERN TESTING & CONSULTANCY PVT. LTD.</td>
							<td  style="width:20%;text-align:center;font-weight:bold; " rowspan=5><img src="../images/mat_logo.png" style="height:40px;width:120px;background-blend-mode:multiply;"></td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:2px;padding-top:2px; ">PLOT NO. G-2049, KADVANI FORGE,KISHAN GATE</td>
						</tr>
						<tr style=""> 
							<td  style="width:80%; text-align:center;padding-left:150px;padding-bottom:2px;padding-top:2px; ">G.I.D.C.,KALAWAD ROAD,METODA,360021,RAJKOT</td>
						</tr>
						
					</table>
				
				</td>
		</tr>
		
		<tr>
				<td  style="text-align:center;font-size:20px; ">
				
					<table align="center" width="100%"  cellspacing="0" cellpadding="0" style="font-size:20px;font-family : Calibri;">
			
						<tr style=""> 
							
							<td  style="width:100%;padding-bottom:10px;padding-top:10px; text-align:center;font-weight:bold;border-right:1px solid;border-left:1px solid; " colspan="3"><span style=""> OBSERVATION AND CALCULATION SHEET FOR TEST ON WATER</td>
						</tr>
						<?php 
							if($row_select_pipe['lab_no']!=""){
								$cnt=1;
						?>
						<tr style="font-size:10px;"> 
							
							<td  style="width:10%;font-weight:bold;text-align:center;border-top:1px solid; border-left:1px solid;"><?php echo $cnt++;?></td>
							<td  style="border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px;border-top:1px solid; ">&nbsp;&nbsp; Job No.</td>				
							<td  style="border-left:1px solid;width:50%;border-top:1px solid;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $row_select_pipe['lab_no'];?></td>
						</tr>
							<?php }
								if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Laboratory No</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo $job_no;?></td>
						</tr>
						<?php }
								//if($job_no!=""){
							?>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Date of receipt of sample</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($rec_sample_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Date of starting test</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($start_date));?></td>
						</tr>
						<tr style="font-size:10px;"> 
							
							<td  style="border-top:1px solid;width:10%;font-weight:bold;text-align:center;border-left:1px solid; "><?php echo $cnt++;?></td>
							<td  style="border-top:1px solid;border-left:1px solid;width:40%;text-align:left;padding-bottom:2px;padding-top:2px; ">&nbsp;&nbsp; Probable date of completion</td>
							<td  style="border-top:1px solid;border-left:1px solid;width:50%;border-right:1px solid; ">&nbsp;&nbsp; <?php echo date('d-m-Y', strtotime($end_date));?></td>
						</tr>
					</table>
				
				</td>
		</tr>
			</table>

			<table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;width: 4%;"><b>Sr.No.</b></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;width: 26%;"><b>Tests/Observation</b></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;width: 8%;"><b>Calculation</b></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;width: 6%;"><b>Results</b></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;width: 6%;"><b>Unit</b></td>
				</tr>
				<?php
					
					if(($row_select_pipe['avghr']!="" && $row_select_pipe['avghr']!=null && $row_select_pipe['avghr']!="0")||
					($row_select_pipe['avgch']!="" && $row_select_pipe['avgch']!=null && $row_select_pipe['avgch']!="0")||
					($row_select_pipe['avgsu']!="" && $row_select_pipe['avgsu']!=null && $row_select_pipe['avgsu']!="0")||
					($row_select_pipe['avgin']!="" && $row_select_pipe['avgin']!=null && $row_select_pipe['avgin']!="0")||
					($row_select_pipe['avgor']!="" && $row_select_pipe['avgor']!=null && $row_select_pipe['avgor']!="0")||
					($row_select_pipe['avguu']!="" && $row_select_pipe['avguu']!=null && $row_select_pipe['avguu']!="0"))
					{
						$pagecnt++;
					
					?>
				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="7"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;" colspan="4">Chloride , (Pt.32-2)</td>
				</tr>

				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">1)volume of sample taken,ml=</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['cha1']!="" && $row_select_pipe['cha1']!="0" && $row_select_pipe['cha1']!=null){echo $row_select_pipe['cha1']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="6"><?php if($row_select_pipe['avgch']!="" && $row_select_pipe['avgch']!="0" && $row_select_pipe['avgch']!=null){echo $row_select_pipe['avgch']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="6">mg/l</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">2)burette reading of sample , ml=</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['chb1']!="" && $row_select_pipe['chb1']!="0" && $row_select_pipe['chb1']!=null){echo $row_select_pipe['chb1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">3)burette reading of blank,ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php echo $row_select_pipe['chc1'];?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">4)difference in reading, ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['chd1']!="" && $row_select_pipe['chd1']!="0" && $row_select_pipe['chd1']!=null){echo $row_select_pipe['chd1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">5)normality of AgNO<sub>3</sub>, N=</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['ch1']!="" && $row_select_pipe['ch1']!="0" && $row_select_pipe['ch1']!=null){echo $row_select_pipe['ch1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="width:50%;border: 1px solid black;text-align:left;padding-bottom: 8px;" colspan="2">&nbsp; 
						<table class="test">
							<tr>
								<td width="150px" rowspan="2" style="text-align:center;">Chloride =</td>
								<td width="160px" style="border-bottom: 1px solid black; text-align:center;">differencein reading. *N*35450</td>
							</tr>
							<tr>
								<td style="text-align:center;">volume of sample taken</td>
							</tr>
						</table>
					</td>
				</tr>

				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="6"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;" colspan="4">Sulphate , (Pt.24)</td>
				</tr>

				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">1)volume of sample taken =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['sua1']!="" && $row_select_pipe['sua1']!="0" && $row_select_pipe['sua1']!=null){echo $row_select_pipe['sua1']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="5"><?php if($row_select_pipe['avgsu']!="" && $row_select_pipe['avgsu']!="0" && $row_select_pipe['avgsu']!=null){echo $row_select_pipe['avgsu']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="5">mg/l</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">2)wt.of.crucible+residue after ignition =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['sub1']!="" && $row_select_pipe['sub1']!="0" && $row_select_pipe['sub1']!=null){echo $row_select_pipe['sub1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">3)wt. of empty crucible =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['suc1']!="" && $row_select_pipe['suc1']!="0" && $row_select_pipe['suc1']!=null){echo $row_select_pipe['suc1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">4)Diff in wt. =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['sud1']!="" && $row_select_pipe['sud1']!="0" && $row_select_pipe['sud1']!=null){echo $row_select_pipe['sud1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="width:50%;border: 1px solid black;text-align:left;padding-bottom: 8px;" colspan="2">&nbsp; 
						<table class="test">
							<tr>
								<td width="150px" rowspan="2" style="text-align:center;">SO4 =</td>
								<td width="160px" style="border-bottom: 1px solid black; text-align:center;">Diff.in wt. 343*1000</td>
							</tr>
							<tr>
								<td style="text-align:center;">volume of sample taken</td>
							</tr>
						</table>
					</td>
				</tr>

			<!--	<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="2">7</td>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;" colspan="4">Acidity , (Pt.22)</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">Volume of 0.02 normal NaOH required to neutralize 100 ml sample of water, using phenolphthalein as an indicator ,</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php echo $row_select_pipe['avgn'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;">ml</td>
				</tr>

				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;" rowspan="2">8</td>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;" colspan="4">Alkalinity , (Pt.23)</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">Volume of 0.02 normal H2SO4 required to neutralize 100 ml sample of water, using mixed indicator, </td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php echo $row_select_pipe['avgh'];?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;">ml</td>
				</tr>-->


				<tr style="vertical-align: sub;">
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 1px solid;" rowspan="6"><?php echo $count++;?></td>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;" colspan="4">Total Suspended Solid ,(Pt.17)</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">1) Volume of sample taken ,ml =</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['tsa1']!="" && $row_select_pipe['tsa1']!="0" && $row_select_pipe['tsa1']!=null){echo $row_select_pipe['uua1']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 1px solid;" rowspan="5"><?php if($row_select_pipe['avgts']!="" && $row_select_pipe['avgts']!="0" && $row_select_pipe['avgts']!=null){echo $row_select_pipe['avgts']; }else{echo " <br>";}?></td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 1px solid;" rowspan="5">mg/l</td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">2) weight of Petri dish+ GFC filter paper before sample filtration and oven drying,gm</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['tsb1']!="" && $row_select_pipe['tsb1']!="0" && $row_select_pipe['tsb1']!=null){echo $row_select_pipe['tsb1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">3) W = weight of Petri dish+ filter paper after sample filtration and oven drying, hm</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['tsc1']!="" && $row_select_pipe['tsc1']!="0" && $row_select_pipe['tsc1']!=null){echo $row_select_pipe['tsc1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border:1px solid black;text-align:left;padding: 3px 4px;border-bottom: 0;">4) differencein wt., gm=</td>
					<td style="border:1px solid black;text-align:center;padding: 3px 4px;border-bottom: 0;"><?php if($row_select_pipe['tsd1']!="" && $row_select_pipe['tsd1']!="0" && $row_select_pipe['tsd1']!=null){echo $row_select_pipe['tsd1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="width:50%;border: 1px solid black;text-align:left;padding-bottom: 8px;" colspan="2">&nbsp; 
						<table class="test">
							<tr>
								<td width="150px" rowspan="2" style="text-align:center;">TSS =</td>
								<td width="160px" style="border-bottom: 1px solid black; text-align:center;">Diff.in wt. 1000*1000</td>
							</tr>
							<tr>
								<td style="text-align:center;">volume of sample taken</td>
							</tr>
						</table>
					</td>
				</tr>
				<?php
			}
			
			?>

			</table>
<br>
			<table align="center" width="92%" class="test1" height="Auto" style="">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				
			</table>
			 <table align="center" width="92%" class="test" style="height:Auto;font-size:11px;font-family: Arial;margin-bottom: 8px;">
				<tr style="height: 18px;">
					<td style="border:0;text-align:center;padding: 4px;text-transform: uppercase;">Page 2 of 2</td>
				</tr>
			</table> 
			

			<!--<table align="center" width="92%" class="test" style="border: 1px solid black;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table> -->

			

								

















		<!-- <p style="text-align:center;font-size:16px"><u style="text-align:center;font-size:16px;font-weight:bold;">OBSERVATION & CALCULATION SHEET FOR TEST ON WATER FOR<br>CONSTRUCTION PURPOSE</u></p>
		<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $water_source;?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no;?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Laboratory No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no;?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date));?></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Specify the use of Water in Plan<br>&nbsp;&nbsp; Concrete/RCC Work </b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php
					echo $water_specification;
					
				?></td>
				</tr>
			</table>
			<br> -->
			<!-- <table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>1. PH Value as per IS 3025:2022 (Part 11) (pH meter)</b></td>
					
				</tr>
				
			
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">1</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['p1']!="" && $row_select_pipe['p1']!="0" && $row_select_pipe['p1']!=null){echo $row_select_pipe['p1']; }else{echo " <br>";}?></td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">2</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['p2']!="" && $row_select_pipe['p2']!="0" && $row_select_pipe['p2']!=null){echo $row_select_pipe['p2']; }else{echo " <br>";}?></td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">3</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['p3']!="" && $row_select_pipe['p3']!="0" && $row_select_pipe['p3']!=null){echo $row_select_pipe['p3']; }else{echo " <br>";}?></td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">Average</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgp']!="" && $row_select_pipe['avgp']!="0" && $row_select_pipe['avgp']!=null){echo $row_select_pipe['avgp']; }else{echo " <br>";}?></td>					
					
				</tr>
				
				
			
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>2. Quantity of 0.02N H<sub>2</sub>SO<sub>4</sub> required to neutralize 100 ml of water sample using mixed indicator as per IS 456:2000 (RA 2021) Page 14</b></td>
					
				</tr>
				
			
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">1</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['h1']!="" && $row_select_pipe['h1']!="0" && $row_select_pipe['h1']!=null){echo $row_select_pipe['h1']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">2</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['h2']!="" && $row_select_pipe['h2']!="0" && $row_select_pipe['h2']!=null){echo $row_select_pipe['h2']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">3</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['h3']!="" && $row_select_pipe['h3']!="0" && $row_select_pipe['h3']!=null){echo $row_select_pipe['h3']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">Average</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgh']!="" && $row_select_pipe['avgh']!="0" && $row_select_pipe['avgh']!=null){echo $row_select_pipe['avgh']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				
				
			
				
			</table>
			
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="2" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>3. Quantity of 0.02N NaOH required to neutralize 100 ml of water sample using phenolphthalein as an indicator as per IS 456:2000 (RA 2021) Page 14</b></td>
					
				</tr>
				
			
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">1</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['n1']!="" && $row_select_pipe['n1']!="0" && $row_select_pipe['n1']!=null){echo $row_select_pipe['n1']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">2</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['n2']!="" && $row_select_pipe['n2']!="0" && $row_select_pipe['n2']!=null){echo $row_select_pipe['n2']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">3</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['n3']!="" && $row_select_pipe['n3']!="0" && $row_select_pipe['n3']!=null){echo $row_select_pipe['n3']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				<tr>
					<td width="50%" style="border: 1px solid black; text-align:center;">Average</td>
					<td width="50%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgn']!="" && $row_select_pipe['avgn']!="0" && $row_select_pipe['avgn']!=null){echo $row_select_pipe['avgn']; }else{echo " <br>";}?> ml</td>					
					
				</tr>
				
				
			
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>4. Determination of total solids. As per IS 3025:1984 (RA 2019 Part-15)</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Wt. of Empty Evaporating Dish<br>A</td>
					<td style="border: 1px solid black; text-align:center;">Wt. of Evaporating Dish after evaporation of water at 105° C (g)<br>B</td>					
					<td style="border: 1px solid black; text-align:center;">Diff. in Wt. (M)<br>B-A</td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">Total Solids (mg/l)=<br>M X 1000 X 1000 <b>/</b> Volume of Sample</td>					
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">1</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsa1']!="" && $row_select_pipe['tsa1']!="0" && $row_select_pipe['tsa1']!=null){echo $row_select_pipe['tsa1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsb1']!="" && $row_select_pipe['tsb1']!="0" && $row_select_pipe['tsb1']!=null){echo $row_select_pipe['tsb1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsc1']!="" && $row_select_pipe['tsc1']!="0" && $row_select_pipe['tsc1']!=null){echo $row_select_pipe['tsc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsd1']!="" && $row_select_pipe['tsd1']!="0" && $row_select_pipe['tsd1']!=null){echo $row_select_pipe['tsd1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ts1']!="" && $row_select_pipe['ts1']!="0" && $row_select_pipe['ts1']!=null){echo $row_select_pipe['ts1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsa2']!="" && $row_select_pipe['tsa2']!="0" && $row_select_pipe['tsa2']!=null){echo $row_select_pipe['tsa2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsb2']!="" && $row_select_pipe['tsb2']!="0" && $row_select_pipe['tsb2']!=null){echo $row_select_pipe['tsb2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsc2']!="" && $row_select_pipe['tsc2']!="0" && $row_select_pipe['tsc2']!=null){echo $row_select_pipe['tsc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tsd2']!="" && $row_select_pipe['tsd2']!="0" && $row_select_pipe['tsd2']!=null){echo $row_select_pipe['tsd2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ts2']!="" && $row_select_pipe['ts2']!="0" && $row_select_pipe['ts2']!=null){echo $row_select_pipe['ts2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td Colspan="5" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgts']!="" && $row_select_pipe['avgts']!="0" && $row_select_pipe['avgts']!=null){echo $row_select_pipe['avgts']; }else{echo " <br>";}?></td>					
					
				</tr>
				
				
				
			
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>5. Determination of dissolved solids. As per IS 3025:1984 (RA 2017 Part-16)</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Wt. of Empty Evaporating Dish<br>A</td>
					<td style="border: 1px solid black; text-align:center;">Wt. of Evaporating Dish after evaporation of water at 105° C (g)<br>B</td>					
					<td style="border: 1px solid black; text-align:center;">Diff. in Wt. (M)<br>B-A</td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">Total Dissolved Solids (mg/l)=<br>M X 1000 X 1000 <b>/</b> Volume of Sample</td>					
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">1</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tda1']!="" && $row_select_pipe['tda1']!="0" && $row_select_pipe['tda1']!=null){echo $row_select_pipe['tda1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tdb1']!="" && $row_select_pipe['tdb1']!="0" && $row_select_pipe['tdb1']!=null){echo $row_select_pipe['tdb1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tdc1']!="" && $row_select_pipe['tdc1']!="0" && $row_select_pipe['tdc1']!=null){echo $row_select_pipe['tdc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tdd1']!="" && $row_select_pipe['tdd1']!="0" && $row_select_pipe['tdd1']!=null){echo $row_select_pipe['tdd1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['td1']!="" && $row_select_pipe['td1']!="0" && $row_select_pipe['td1']!=null){echo $row_select_pipe['td1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tda2']!="" && $row_select_pipe['tda2']!="0" && $row_select_pipe['tda2']!=null){echo $row_select_pipe['tda2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tdb2']!="" && $row_select_pipe['tdb2']!="0" && $row_select_pipe['tdb2']!=null){echo $row_select_pipe['tdb2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tdc2']!="" && $row_select_pipe['tdc2']!="0" && $row_select_pipe['tdc2']!=null){echo $row_select_pipe['tdc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['tdd2']!="" && $row_select_pipe['tdd2']!="0" && $row_select_pipe['tdd2']!=null){echo $row_select_pipe['tdd2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['td2']!="" && $row_select_pipe['td2']!="0" && $row_select_pipe['td2']!=null){echo $row_select_pipe['td2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td Colspan="5" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgtd']!="" && $row_select_pipe['avgtd']!="0" && $row_select_pipe['avgtd']!=null){echo $row_select_pipe['avgtd']; }else{echo " <br>";}?></td>					
					
				</tr>
				
				
				
			
				
			</table>
			<br>
			
			<table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
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
						<div style="margin-top:30px;">
							<b style="font-size:10px;font-weight:bold;">F/WTR/01/TR, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:bold;">W.e.f. 01.11.2012</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:30px;">
							<b style="font-size:10px;font-weight:bold;">Page: <?php echo $pagecnt; ?> of <?php echo $totalpage;?><br>
						</div>
					</td>
				</tr>
			</table>
			<?php
			}
			if(($row_select_pipe['avghr']!="" && $row_select_pipe['avghr']!=null && $row_select_pipe['avghr']!="0")||
			($row_select_pipe['avgch']!="" && $row_select_pipe['avgch']!=null && $row_select_pipe['avgch']!="0")||
			($row_select_pipe['avgsu']!="" && $row_select_pipe['avgsu']!=null && $row_select_pipe['avgsu']!="0")||
			($row_select_pipe['avgin']!="" && $row_select_pipe['avgin']!=null && $row_select_pipe['avgin']!="0")||
			($row_select_pipe['avgor']!="" && $row_select_pipe['avgor']!=null && $row_select_pipe['avgor']!="0")||
			($row_select_pipe['avguu']!="" && $row_select_pipe['avguu']!=null && $row_select_pipe['avguu']!="0"))
			{
				$pagecnt++;
			
			?>
			<div class="pagebreak"></div>
			<br>
			<div id="header" style="text-align: center;width: 110px;margin: 0 auto;">
				<img src="../images/header.png" width="150px">
			</div>
			<p style="text-align:center;font-size:16px"><u style="text-align:center;font-size:16px;font-weight:bold;">OBSERVATION & CALCULATION SHEET FOR TEST ON WATER FOR<br>CONSTRUCTION PURPOSE</u></p>
		<table align="center" width="90%" class="test"  style="border: 1px solid black; font-family:arial;">
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Identification Mark</b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $water_source;?></td>
				</tr>
				<tr>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Job No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $job_no;?></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <b>Laboratory No.</b></td>
					<td width="25%" style="border: 1px solid black;">&nbsp;&nbsp; <?php echo $lab_no;?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Starting Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date));?></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Completion Date of Test</b></td>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date));?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black;">&nbsp;&nbsp; <b>Specify the use of Water in Plan<br>&nbsp;&nbsp; Concrete/RCC Work </b></td>
					<td colspan="3" style="border: 1px solid black;">&nbsp;&nbsp; <?php
					echo $water_specification;
					
				?></td>
				</tr>
			</table>
			<br>
			<br>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;font-size:9px;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>6. Determination of suspended matter. As per IS 3025:1984 (RA 2017) Part 17</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Wt. of empty <br> Filter Paper (g)<br>A</td>
					<td style="border: 1px solid black; text-align:center;">Wt. of Filter paper after Heating (g)<br>B</td>					
					<td style="border: 1px solid black; text-align:center;">Diff. in Wt. (M)<br>B-A</td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">suspended matter (mg/l)=<br>M X 1000 X 1000 <b>/</b> Volume of Sample</td>					
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">1</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uua1']!="" && $row_select_pipe['uua1']!="0" && $row_select_pipe['uua1']!=null){echo $row_select_pipe['uua1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uub1']!="" && $row_select_pipe['uub1']!="0" && $row_select_pipe['uub1']!=null){echo $row_select_pipe['uub1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uuc1']!="" && $row_select_pipe['uuc1']!="0" && $row_select_pipe['uuc1']!=null){echo $row_select_pipe['uuc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uud1']!="" && $row_select_pipe['uud1']!="0" && $row_select_pipe['uud1']!=null){echo $row_select_pipe['uud1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uu1']!="" && $row_select_pipe['uu1']!="0" && $row_select_pipe['uu1']!=null){echo $row_select_pipe['uu1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uua2']!="" && $row_select_pipe['uua2']!="0" && $row_select_pipe['uua2']!=null){echo $row_select_pipe['uua2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uub2']!="" && $row_select_pipe['uub2']!="0" && $row_select_pipe['uub2']!=null){echo $row_select_pipe['uub2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uuc2']!="" && $row_select_pipe['uuc2']!="0" && $row_select_pipe['uuc2']!=null){echo $row_select_pipe['uuc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uud2']!="" && $row_select_pipe['uud2']!="0" && $row_select_pipe['uud2']!=null){echo $row_select_pipe['uud2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['uu2']!="" && $row_select_pipe['uu2']!="0" && $row_select_pipe['uu2']!=null){echo $row_select_pipe['uu2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td Colspan="5" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avguu']!="" && $row_select_pipe['avguu']!="0" && $row_select_pipe['avguu']!=null){echo $row_select_pipe['avguu']; }else{echo " <br>";}?></td>					
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>7. Determination of organic matter. As per IS 3025:1984 (RA 2017) Part 18</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Wt. of Evaporating Dish after evaporation of water at 105° C (g)<br>A</td>
					<td style="border: 1px solid black; text-align:center;">Wt. of Evaporating Dish after evaporation of water at 550° C (g)<br>B</td>					
					<td style="border: 1px solid black; text-align:center;">Diff. in Wt. (M)<br>A-B</td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">Total Organic matter (mg/l)=<br>M X 1000 X 1000 <b>/</b> Volume of Sample</td>					
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">1</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ora1']!="" && $row_select_pipe['ora1']!="0" && $row_select_pipe['ora1']!=null){echo $row_select_pipe['ora1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['orb1']!="" && $row_select_pipe['orb1']!="0" && $row_select_pipe['orb1']!=null){echo $row_select_pipe['orb1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['orc1']!="" && $row_select_pipe['orc1']!="0" && $row_select_pipe['orc1']!=null){echo $row_select_pipe['orc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ord1']!="" && $row_select_pipe['ord1']!="0" && $row_select_pipe['ord1']!=null){echo $row_select_pipe['ord1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['or1']!="" && $row_select_pipe['or1']!="0" && $row_select_pipe['or1']!=null){echo $row_select_pipe['or1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ora2']!="" && $row_select_pipe['ora2']!="0" && $row_select_pipe['ora2']!=null){echo $row_select_pipe['ora2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['orb2']!="" && $row_select_pipe['orb2']!="0" && $row_select_pipe['orb2']!=null){echo $row_select_pipe['orb2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['orc2']!="" && $row_select_pipe['orc2']!="0" && $row_select_pipe['orc2']!=null){echo $row_select_pipe['orc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ord2']!="" && $row_select_pipe['ord2']!="0" && $row_select_pipe['ord2']!=null){echo $row_select_pipe['ord2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['or2']!="" && $row_select_pipe['or2']!="0" && $row_select_pipe['or2']!=null){echo $row_select_pipe['or2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td Colspan="5" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgor']!="" && $row_select_pipe['avgor']!="0" && $row_select_pipe['avgor']!=null){echo $row_select_pipe['avgor']; }else{echo " <br>";}?></td>					
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>8. Determination of inorganic matter. As per IS 3025:1984 (RA 2017) Part 18</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Wt. Of Empty Evaporating Dish  (g)<br>A</td>
					<td style="border: 1px solid black; text-align:center;">Wt. Of Evaporating Dish after evaporation of water at 550° C (g)<br>B</td>					
					<td style="border: 1px solid black; text-align:center;">Diff. in Wt. (M)<br>B-A</td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">Total Inorganic matter (mg/l)=<br>M X 1000 X 1000 <b>/</b> Volume of Sample</td>					
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">1</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ina1']!="" && $row_select_pipe['ina1']!="0" && $row_select_pipe['ina1']!=null){echo $row_select_pipe['ina1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['inb1']!="" && $row_select_pipe['inb1']!="0" && $row_select_pipe['inb1']!=null){echo $row_select_pipe['inb1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['inc1']!="" && $row_select_pipe['inc1']!="0" && $row_select_pipe['inc1']!=null){echo $row_select_pipe['inc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ind1']!="" && $row_select_pipe['ind1']!="0" && $row_select_pipe['ind1']!=null){echo $row_select_pipe['ind1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['in1']!="" && $row_select_pipe['in1']!="0" && $row_select_pipe['in1']!=null){echo $row_select_pipe['in1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ina2']!="" && $row_select_pipe['ina2']!="0" && $row_select_pipe['ina2']!=null){echo $row_select_pipe['ina2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['inb2']!="" && $row_select_pipe['inb2']!="0" && $row_select_pipe['inb2']!=null){echo $row_select_pipe['inb2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['inc2']!="" && $row_select_pipe['inc2']!="0" && $row_select_pipe['inc2']!=null){echo $row_select_pipe['inc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ind2']!="" && $row_select_pipe['ind2']!="0" && $row_select_pipe['ind2']!=null){echo $row_select_pipe['ind2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['in2']!="" && $row_select_pipe['in2']!="0" && $row_select_pipe['in2']!=null){echo $row_select_pipe['in2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td Colspan="5" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgin']!="" && $row_select_pipe['avgin']!="0" && $row_select_pipe['avgin']!=null){echo $row_select_pipe['avgin']; }else{echo " <br>";}?></td>					
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>9. Determination of chloride as per IS 3025:1988 (RA 2019) Part 32</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Burate Reading<br>A</td>
					<td style="border: 1px solid black; text-align:center;">Blank Reading <br>B</td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">N (AgNO<sub>3</sub>)</td>					
					<td style="border: 1px solid black; text-align:center;">Chloride (mg/l)=<br>(A-B) X N X 35450 <b>/</b> Volume of Sample</td>					
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">1</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cha1']!="" && $row_select_pipe['cha1']!="0" && $row_select_pipe['cha1']!=null){echo $row_select_pipe['cha1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['chb1'];?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['chc1']!="" && $row_select_pipe['chc1']!="0" && $row_select_pipe['chc1']!=null){echo $row_select_pipe['chc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['chd1']!="" && $row_select_pipe['chd1']!="0" && $row_select_pipe['chd1']!=null){echo $row_select_pipe['chd1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ch1']!="" && $row_select_pipe['ch1']!="0" && $row_select_pipe['ch1']!=null){echo $row_select_pipe['ch1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td  style="border: 1px solid black; text-align:center;">2</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['cha2']!="" && $row_select_pipe['cha2']!="0" && $row_select_pipe['cha2']!=null){echo $row_select_pipe['cha2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['chb2'];?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['chc2']!="" && $row_select_pipe['chc2']!="0" && $row_select_pipe['chc2']!=null){echo $row_select_pipe['chc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['chd2']!="" && $row_select_pipe['chd2']!="0" && $row_select_pipe['chd2']!=null){echo $row_select_pipe['chd2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['ch2']!="" && $row_select_pipe['ch2']!="0" && $row_select_pipe['ch2']!=null){echo $row_select_pipe['ch2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td Colspan="5" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgch']!="" && $row_select_pipe['avgch']!="0" && $row_select_pipe['avgch']!=null){echo $row_select_pipe['avgch']; }else{echo " <br>";}?></td>					
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>10. Sulphites  as per IS 3025:2022 (Part 24 Sec-1,2)</b></td>
					
				</tr>
				
			
				<tr>
					<td  style="border: 1px solid black; text-align:center;">Wt. of empty platinum crucible(g)<br>M<sub>1</sub></td>
					<td style="border: 1px solid black; text-align:center;">Wt.of platinum Crucible + residue(g)<br>M<sub>2</sub></td>					
					<td style="border: 1px solid black; text-align:center;">Diff. in Wt. in mg<Br> M = M<sub>2</sub> - M<sub>1</sub></td>					
					<td style="border: 1px solid black; text-align:center;">Volume of Sample (ml)</td>					
					<td style="border: 1px solid black; text-align:center;">Total Sulphites (mg/l)=<br>M X 343110 <b>/</b> Volume of sample</td>					
				</tr>
				<tr>
					
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['sua1']!="" && $row_select_pipe['sua1']!="0" && $row_select_pipe['sua1']!=null){echo $row_select_pipe['sua1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['sub1']!="" && $row_select_pipe['sub1']!="0" && $row_select_pipe['sub1']!=null){echo $row_select_pipe['sub1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['suc1']!="" && $row_select_pipe['suc1']!="0" && $row_select_pipe['suc1']!=null){echo $row_select_pipe['suc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['sud1']!="" && $row_select_pipe['sud1']!="0" && $row_select_pipe['sud1']!=null){echo $row_select_pipe['sud1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['su1']!="" && $row_select_pipe['su1']!="0" && $row_select_pipe['su1']!=null){echo $row_select_pipe['su1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['sua2']!="" && $row_select_pipe['sua2']!="0" && $row_select_pipe['sua2']!=null){echo $row_select_pipe['sua2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['sub2']!="" && $row_select_pipe['sub2']!="0" && $row_select_pipe['sub2']!=null){echo $row_select_pipe['sub2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['suc2']!="" && $row_select_pipe['suc2']!="0" && $row_select_pipe['suc2']!=null){echo $row_select_pipe['suc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['sud2']!="" && $row_select_pipe['sud2']!="0" && $row_select_pipe['sud2']!=null){echo $row_select_pipe['sud2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['su2']!="" && $row_select_pipe['su2']!="0" && $row_select_pipe['su2']!=null){echo $row_select_pipe['su2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:left;"></td>
					<td Colspan="3" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avgsu']!="" && $row_select_pipe['avgsu']!="0" && $row_select_pipe['avgsu']!=null){echo $row_select_pipe['avgsu']; }else{echo " <br>";}?></td>					
					
				</tr>
				
			</table>
			<table align="center" width="90%" class="test" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>11. Total Hardness  as per IS 3025:2009 (RA 2019) Part 21</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;width:10%;">Sr No.</td>
					<td style="border: 1px solid black; text-align:center;width:18%;">Blank <br> Reading <br> A (ml)</td>					
					<td style="border: 1px solid black; text-align:center;width:18%;">Burette <br> Reading <br> B (ml)</td>					
					<td style="border: 1px solid black; text-align:center;width:18%;">Different <br> (M = B - A) <br> (ml)</td>					
					<td style="border: 1px solid black; text-align:center;width:18%;">Sample <br> Volume <br> (ml)</td>					
					<td style="border: 1px solid black; text-align:center;width:18%;">
						<table align="center">
							<tr>
								<td rowspan="2" >TH = </td>
								<td style="border-bottom: 1px solid black;text-align:center;">M x CF x 1000</td>
							</tr>
							<tr>
								<td style="text-align:center;">SV x mg/l</td>
							</tr>
						</table>
					</td>					
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">1</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hra1']!="" && $row_select_pipe['hra1']!="0" && $row_select_pipe['hra1']!=null){echo $row_select_pipe['hra1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrb1']!="" && $row_select_pipe['hrb1']!="0" && $row_select_pipe['hrb1']!=null){echo $row_select_pipe['hrb1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrc1']!="" && $row_select_pipe['hrc1']!="0" && $row_select_pipe['hrc1']!=null){echo $row_select_pipe['hrb1'] - $row_select_pipe['hra1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrd1']!="" && $row_select_pipe['hrd1']!="0" && $row_select_pipe['hrd1']!=null){echo $row_select_pipe['hrd1']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hr1']!="" && $row_select_pipe['hr1']!="0" && $row_select_pipe['hr1']!=null){echo $row_select_pipe['hr1']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">2</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hra2']!="" && $row_select_pipe['hra2']!="0" && $row_select_pipe['hra2']!=null){echo $row_select_pipe['hra2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrb2']!="" && $row_select_pipe['hrb2']!="0" && $row_select_pipe['hrb2']!=null){echo $row_select_pipe['hrb2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrc2']!="" && $row_select_pipe['hrc2']!="0" && $row_select_pipe['hrc2']!=null){echo $row_select_pipe['hrb2'] - $row_select_pipe['hra2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrd2']!="" && $row_select_pipe['hrd2']!="0" && $row_select_pipe['hrd2']!=null){echo $row_select_pipe['hrd2']; }else{echo " <br>";}?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hr2']!="" && $row_select_pipe['hr2']!="0" && $row_select_pipe['hr2']!=null){echo $row_select_pipe['hr2']; }else{echo " <br>";}?></td>
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">CF = 0.9909</td>
					<td colspan="3" style="border: 1px solid black; text-align:right;">Average = &nbsp;&nbsp;&nbsp;</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avghr']!="" && $row_select_pipe['avghr']!="0" && $row_select_pipe['avghr']!=null){echo $row_select_pipe['avghr']; }else{echo " <br>";}?></td>
				</tr>
			</table> -->
			
			
			
			
			
			
			<!--<table align="center" width="90%" class="test"  height="10%" style="border: 1px solid black; font-family:arial;">
				<tr>
					<td width="100%" colspan="6" style="border: 1px solid black; font:size:14px;">&nbsp;&nbsp; <b>11. Total Hardness  as per IS 3025:2009 (RA 2019) Part 21</b></td>
					
				</tr>
				
			
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">A</td>
					<td colspan="2" style="border: 1px solid black; text-align:center;">V</td>
										
					<td rowspan="2" style="border: 1px solid black; text-align:center;">Total Hardness as CaCO<sub>3</sub> (mg/l) <br>= (A X CF X 1000)/V</td>					
					
				</tr>
				<tr>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Reading in ml<br> N (EDTA)</td>
					<td colspan="2" style="border: 1px solid black; text-align:center;">Vol. of Sample (ml)</td>
										
										
					
				</tr>
				<tr>
					
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hra1']!="" && $row_select_pipe['hra1']!="0" && $row_select_pipe['hra1']!=null){echo $row_select_pipe['hra1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrb1']!="" && $row_select_pipe['hrb1']!="0" && $row_select_pipe['hrb1']!=null){echo $row_select_pipe['hrb1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrc1']!="" && $row_select_pipe['hrc1']!="0" && $row_select_pipe['hrc1']!=null){echo $row_select_pipe['hrc1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrd1']!="" && $row_select_pipe['hrd1']!="0" && $row_select_pipe['hrd1']!=null){echo $row_select_pipe['hrd1']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hr1']!="" && $row_select_pipe['hr1']!="0" && $row_select_pipe['hr1']!=null){echo $row_select_pipe['hr1']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hra2']!="" && $row_select_pipe['hra2']!="0" && $row_select_pipe['hra2']!=null){echo $row_select_pipe['hra2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrb2']!="" && $row_select_pipe['hrb2']!="0" && $row_select_pipe['hrb2']!=null){echo $row_select_pipe['hrb2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrc2']!="" && $row_select_pipe['hrc2']!="0" && $row_select_pipe['hrc2']!=null){echo $row_select_pipe['hrc2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hrd2']!="" && $row_select_pipe['hrd2']!="0" && $row_select_pipe['hrd2']!=null){echo $row_select_pipe['hrd2']; }else{echo " <br>";}?></td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['hr2']!="" && $row_select_pipe['hr2']!="0" && $row_select_pipe['hr2']!=null){echo $row_select_pipe['hr2']; }else{echo " <br>";}?></td>
					
				</tr>
				<tr>
					
					<td Colspan="4" style="border: 1px solid black; text-align:right;">Average =</td>
					<td  style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avghr']!="" && $row_select_pipe['avghr']!="0" && $row_select_pipe['avghr']!=null){echo $row_select_pipe['avghr']; }else{echo " <br>";}?></td>					
					
				</tr>
				
			</table>-->
			
			<!-- <table align="center" width="92%" style="font-family:arial;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
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
						<div style="margin-top:2px;">
							<b style="font-size:10px;font-weight:bold;">F/WTR/01/TR, Issue No.01</b><br>
							<font style="font-size:10px;font-weight:bold;">W.e.f. 01.11.2012</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:2px;">
							<b style="font-size:10px;font-weight:bold;">Page: <?php echo $pagecnt; ?> of <?php echo $totalpage;?><br>
						</div>
					</td>
				</tr>
			</table> -->
			</page>
			<?php
			}
			
			?>
		
	</body>
</html> 
		
	
<script type="text/javascript">
			
		
</script>