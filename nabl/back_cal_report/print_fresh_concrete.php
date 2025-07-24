<?php 
session_start();
include("../connection.php");
error_reporting(0);?>
<style>
@page { margin:20px 40px;}
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
			$select_tiles_query = "select * from fresh_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);	
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			$r_name= $row_select['refno'];
			$sr_no= $row_select['sr_no'];
			$sample_no= $row_select['job_no'];
			$branch_name = $row_select['branch_name'];
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
				$issue_date= $row_select2['issue_date'];					
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
					$source= $row_select4['agg_source'];
					$grade = $row_select4['grade_fresh'];
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
		
		<br><br>
    <page size="A4" >
		
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 1199 - 2018</td>
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

		<table align="center" width="100%" class="test1">
				<tr style="border: 1px solid black;border-top: 0;">
					<td style="text-align:center;padding:3px 0px;"><b>1</b></td>
					<td style="border-left:1px solid;text-align:left;padding:3px 0px;"><b>&nbsp; Quantity of sample</b></td>
					<td style="border-left:1px solid;text-align:left;padding:3px 0px;">&nbsp;<?php echo $row_select_pipe['slump_req']; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="text-align:center;padding:3px 0px;"><b>2</b></td>
					<td style="border-left:1px solid;text-align:left;padding:3px 0px;"><b>&nbsp; Grade of Concrete</b></td>
					<td style="border-left:1px solid;text-align:left;padding:3px 0px;">&nbsp; <?php echo $row_select_pipe['grade_fresh']; ?></td>
				</tr>
		</table>
		<br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 13px;"><b>1. Setting time of Concrete (IS : 1199 Part 7:2018)</b></td>
							<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Elapsed Time in Min</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Area of Needle (mm2)</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Pressure (N)</b></center></td>	
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Penetration Resistance (Mpa)</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Remarks</b></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>		
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>
		
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 13px;"><b>2. Slump of Concrete (IS : 1199 Part-2–2018) </b></td>
							<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 4px 3px;width:7%;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;width:12%;"><center><b>W/C ratio</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Admixture dosage %</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Temperature during <br> test &#8451;</b></center></td>	
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Nature of Slump</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Time of measurement </b></center></td>		
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b> Slump observed <br> mm </b></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_ratio']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_a7']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_temp']; ?></center></td>						
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['slump4']; ?></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_ratio']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_a7']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_temp']; ?></center></td>						
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['slump4']; ?></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_ratio']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_a7']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_temp']; ?></center></td>						
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['slump4']; ?></center></td>		
						</tr>
						<tr>
							<td colspan=6 style="border: 1px solid black;padding: 6px 3px;text-align:right;">Average :</td>
							<td colspan=1 style="border: 1px solid black;padding: 6px 3px;"><center></center></td>	
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 13px;"><b>3. Air content of Concrete (IS : 1199 Part 4 – 2018)</b></td>
							<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td colspan=3 style="border: 1px solid black;padding: 4px 3px;"><b>Air Content Test</b></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><b>Reading-1</b></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><b>Reading-2</b></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><b>Reading-3</b></td>
						</tr>
						<tr>
						    <td style="border: 1px solid black;padding: 4px 3px;width:6%;"><center><?php echo $cnt++; ?></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;text-align:left;">Operating Pressure</td>
							<td style="border: 1px solid black;padding: 4px 3px;width:12%;"><center><b>P</b></center></td>
							<td colspan=3 style="border: 1px solid black;padding: 4px 3px;"><center></center></td>
						</tr>
						<tr>
						<td rowspan=3 style="border: 1px solid black;padding: 2px 3px;width:7%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td rowspan=3 style="border: 1px solid black;padding: 2px 3px;text-align:left;">Container Holds Concrete C1</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center>h1</center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>	
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center>h2</center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>	
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center>(h1-h2)</center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>	
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td rowspan=3 style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td rowspan=3 style="border: 1px solid black;padding: 2px 3px;">Aggregate Correction factor G (When <br> container holds only aggregate and water)</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center>h1</center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>	
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center>h2</center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>	
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center>(h1-h2)</center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>	
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
						    <td style="border: 1px solid black;padding: 4px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><b>Air Content (%) , C<sub>c</sub></b></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>C<sub>1</sub>-G</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center></center></td>
						</tr>
						<tr>
						    <td colspan=3 style="border: 1px solid black;padding: 6px 3px;text-align:right;"><b>Average :</b></td>
							<td colspan=3 style="border: 1px solid black;padding: 6px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>
		<br>

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


		<br><br>
		<div class="pagebreak"></div>
		<br><br>

		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr>
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 1199 - 2018</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
		</table>
		

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-top: 12px;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 13px;"><b>4. Flow of Concrete (IS : 1199 Part-2– 2018 )</b></td>
							<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:7%;padding: 4px 3px;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Admixture %</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>W/C ratio</b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Flow measured after 15 stocks Cm </b></center></td>	
							<td style="border: 1px solid black;width:20%;padding: 4px 3px;"><center><b>Remarks</b></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_a7']; ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center><?php echo $row_select_pipe['mix_ratio']; ?></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>						
							<td style="border: 1px solid black;width:20%;padding: 2px 3px;"><center></center></td>	
						</tr>
						<tr>
							<td colspan=4 style="border: 1px solid black;width:5%;padding: 6px 3px;text-align:right;">Average :</td>
							<td colspan=1 style="border: 1px solid black;width:20%;padding: 6px 3px;"><center></center></td>	
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 13px;"><b>5. Bleeding Test (IS : 9103:1999  Annex D) </b></td>
							<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:8%;padding: 4px 3px;"><center><b>Sr. No.</b></center></td>
							<td colspan=2 style="border: 1px solid black;padding: 4px 3px;"><center><b>Description</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Test Results</b></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Mass of the sample, Kg</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">s</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Total Mass of the batch, Kg</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">W</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Net Mass of the water in the batch</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">w</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Total mass of the Bleeding water</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">Vw</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 3px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 3px 3px;">Bleeding water in percentage</td>
							<td style="border: 1px solid black;padding: 3px 3px;border-left:0px;text-align:center;"><u>Vw</u> x 100 <br> <u>w</u> <sub>s</sub><br> W </td>
							<td style="border: 1px solid black;padding: 3px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table width="100%" class="test1" style="border: 0;font-family : Calibri;margin-bottom: 0;" height="Auto">
						<tr>
							<td style="padding: 6px;font-size: 13px;"><b>6. Density Test (IS: 1199 Part-3 : 2018)</b></td>
							<td style="padding: 6px;font-size: 13px;text-align:end;"><b>Date :- &nbsp;&nbsp;<?php echo date("d/m/Y",strtotime($end_date)); ?></b></td>
						</tr>
					</table>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;width:8%;padding: 4px 3px;"><center><b>Sr. No.</b></center></td>
							<td colspan=2 style="border: 1px solid black;padding: 4px 3px;"><center><b>Description</b></center></td>
							<td style="border: 1px solid black;padding: 4px 3px;"><center><b>Test Results</b></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Mass of the Container, (m<sub>1</sub>)</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">Kg</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Mass of the Container + Sample (m<sub>2</sub>)</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">Kg</td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Volume of the Container (V)</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">M <sup>3</sup></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;border-right:0px;padding: 2px 3px;">Density of the Sample (Þ <sub>fr</sub>) = (m<sub>2</sub>-m<sub>1</sub>)/V</td>
							<td style="border: 1px solid black;padding: 2px 3px;border-left:0px;text-align:center;">Kg/M <sup>3</sup></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
		<br>
		<br>


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


			<!-- <table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table> -->
			<!-- <table align="center" width="90%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Sr No</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Type of Materal</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Perpotion per m<sup>2</sup></b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Quantity for Nos Cubes (kg)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>1.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Cement</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a1']!="" && $row_select_pipe['mix_a1']!="0" && $row_select_pipe['mix_a1']!=null){echo $row_select_pipe['mix_a1']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b1']!="" && $row_select_pipe['mix_b1']!="0" && $row_select_pipe['mix_b1']!=null){echo $row_select_pipe['mix_b1']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Fine Aggrigate - Sand</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a2']!="" && $row_select_pipe['mix_a2']!="0" && $row_select_pipe['mix_a2']!=null){echo $row_select_pipe['mix_a2']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b2']!="" && $row_select_pipe['mix_b2']!="0" && $row_select_pipe['mix_b2']!=null){echo $row_select_pipe['mix_b2']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>3.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Coarse Aggrigate10mm</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a3']!="" && $row_select_pipe['mix_a3']!="0" && $row_select_pipe['mix_a3']!=null){echo $row_select_pipe['mix_a3']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b3']!="" && $row_select_pipe['mix_b3']!="0" && $row_select_pipe['mix_b3']!=null){echo $row_select_pipe['mix_b3']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Coarse Aggrigate 20mm</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a4']!="" && $row_select_pipe['mix_a4']!="0" && $row_select_pipe['mix_a4']!=null){echo $row_select_pipe['mix_a4']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b4']!="" && $row_select_pipe['mix_b4']!="0" && $row_select_pipe['mix_b4']!=null){echo $row_select_pipe['mix_b4']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Total Coarse Aggrigate</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a5']!="" && $row_select_pipe['mix_a5']!="0" && $row_select_pipe['mix_a5']!=null){echo $row_select_pipe['mix_a5']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b5']!="" && $row_select_pipe['mix_b5']!="0" && $row_select_pipe['mix_b5']!=null){echo $row_select_pipe['mix_b5']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>4.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Water</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a6']!="" && $row_select_pipe['mix_a6']!="0" && $row_select_pipe['mix_a6']!=null){echo $row_select_pipe['mix_a6']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b6']!="" && $row_select_pipe['mix_b6']!="0" && $row_select_pipe['mix_b6']!=null){echo $row_select_pipe['mix_b6']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Admixture</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a7']!="" && $row_select_pipe['mix_a7']!="0" && $row_select_pipe['mix_a7']!=null){echo $row_select_pipe['mix_a7']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b7']!="" && $row_select_pipe['mix_b7']!="0" && $row_select_pipe['mix_b7']!=null){echo $row_select_pipe['mix_b7']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Fly Ash</b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_a8']!="" && $row_select_pipe['mix_a8']!="0" && $row_select_pipe['mix_a8']!=null){echo $row_select_pipe['mix_a8']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_b8']!="" && $row_select_pipe['mix_b8']!="0" && $row_select_pipe['mix_b8']!=null){echo $row_select_pipe['mix_b8']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>7.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>W/C Ratio</b></td>
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_ratio']!="" && $row_select_pipe['mix_ratio']!="0" && $row_select_pipe['mix_ratio']!=null){echo $row_select_pipe['mix_ratio']; }else{echo "&nbsp;";}?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>8.</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Added Water (ml)</b></td>
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['mix_wtr']!="" && $row_select_pipe['mix_wtr']!="0" && $row_select_pipe['mix_wtr']!=null){echo $row_select_pipe['mix_wtr']; }else{echo "&nbsp;";}?></b></td>
					
				</tr>
			</table>
			<br>
			<div style="width:90%; margin-left:40px;">
				<table align="left" width="45%" class="test"  style="border: 1px solid black; float:left" cellpadding="5px">
					<tr>
						<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Slump Test Result</b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center; width:70%;"><b>Initial Observation Slump (mm)</b></td>
						<td style="border: 1px solid black; text-align:center; width:30%;"><b><?php if($row_select_pipe['slump1']!="" && $row_select_pipe['slump1']!="0" && $row_select_pipe['slump1']!=null){echo $row_select_pipe['slump1']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Reamrks</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['slump2']!="" && $row_select_pipe['slump2']!="0" && $row_select_pipe['slump2']!=null){echo $row_select_pipe['slump2']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Time Duration (Minutes)</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['slump3']!="" && $row_select_pipe['slump3']!="0" && $row_select_pipe['slump3']!=null){echo $row_select_pipe['slump3']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Observatioin Slump (mm)</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['slump4']!="" && $row_select_pipe['slump4']!="0" && $row_select_pipe['slump4']!=null){echo $row_select_pipe['slump4']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Remarks</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['slump5']!="" && $row_select_pipe['slump5']!="0" && $row_select_pipe['slump5']!=null){echo $row_select_pipe['slump5']; }else{echo "&nbsp;";}?></b></td>
					</tr>
				</table>
				
				<table align="left" width="45%" class="test"  style="border: 1px solid black; float:right" cellpadding="5px">
					<tr>
						<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Density of Fresh Concrete</b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center; width:70%;"><b>Volume Cylinder (cc) (V)</b></td>
						<td style="border: 1px solid black; text-align:center; width:30%;"><b><?php if($row_select_pipe['den1']!="" && $row_select_pipe['den1']!="0" && $row_select_pipe['den1']!=null){echo $row_select_pipe['den1']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Empty Weight of Cylinder (gm)(W2)</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['den2']!="" && $row_select_pipe['den2']!="0" && $row_select_pipe['den2']!=null){echo $row_select_pipe['den2']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Mould + mix Weight (gm) (W2)</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['den3']!="" && $row_select_pipe['den3']!="0" && $row_select_pipe['den3']!=null){echo $row_select_pipe['den3']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Mix weight (gm)(W) = W2 - W1</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['den4']!="" && $row_select_pipe['den4']!="0" && $row_select_pipe['den4']!=null){echo $row_select_pipe['den4']; }else{echo "&nbsp;";}?></b></td>
					</tr>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><b>Density of Concrete (gm/cc) = W/V</b></td>
						<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['den5']!="" && $row_select_pipe['den5']!="0" && $row_select_pipe['den5']!=null){echo $row_select_pipe['den5']; }else{echo "&nbsp;";}?></b></td>
					</tr>
				</table>
			</div> -->
		</page>
	</body>
	<!-- <script>
		window.print();
	</script> -->
</html> 