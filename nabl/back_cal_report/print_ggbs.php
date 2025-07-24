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
			$select_tiles_query = "select * from ggbs WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
					$type_of_cement= $row_select4['type_of_cement'];
					$cement_brand= $row_select4['cement_brand'];
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

<br><br><br>

	<page size="A4" >
	   
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 4031 - 1988</td>
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
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Type of GGBS</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo $row_select_pipe['type_of_cement']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Identification Mark</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo $row_select_pipe['identification_mark']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;"><b>&nbsp; Brand Name</b></td>
				<td style="border-left:1px solid;text-align:left;padding:5px 0px;">&nbsp; <?php echo $cement_brand; ?></td>
			</tr>
		</table>
		<br>
		
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td colspan=2 style="border: 1px solid black;padding: 6px 3px;font-size:13px;"><b>&nbsp;&nbsp;1.&nbsp;&nbsp;Density  of GGBS by Le Chatelier Flask</b></td>
							<td colspan=2 style="border: 1px solid black;padding: 6px 3px;text-align:center;"><b>IS 4031(P-11) 1988</b></td>
						</tr>
						<tr>
							<td colspan=2 style="padding: 6px 3px;"><b>&nbsp;&nbsp;Temperature (°C) = <?php echo $row_select_pipe['den_temp']; ?></b></td>
							<td colspan=2 style="padding: 6px 3px;text-align:center;"><b>Humidity(%) = <?php echo $row_select_pipe['den_humidity']; ?></b></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Air temperature &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;°C</b></td>
							<td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_temp']; ?></center></td>		
                            <td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_temp']; ?></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Mass of GGBS used &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;gm</b></td>
							<td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center>64</center></td>
                            <td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center>64</center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Initial reading of flask&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ml</b></td>
							<td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_intial']; ?></center></td>
                            <td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_intial1']; ?></center></td>			
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Final reading of flask&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ml</b></td>
							<td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_final']; ?></center></td>
                            <td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_final1']; ?></center></td>			
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Displaced volume in cm<sup>3</sup> (4-3)</b></td>
							<td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_displaced']; ?></center></td>
                            <td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['den_displaced1']; ?></center></td>			
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Density of GGBS (2/5),g/cm<sup>3</sup></b></td>
							<td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['density']; ?></center></td>
                            <td style="border: 1px solid black;width:10%;padding: 2px 3px;"><center><?php echo $row_select_pipe['density1']; ?></center></td>			
						</tr>
						<tr>
							<td style="border: 1px solid black;width:5%;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;width:44%;padding: 2px 3px;"><b>Density of GGBS ,g/cm<sup>3</sup></b></td>
							<td colspan=2 style="border: 1px solid black;width:8%;padding: 2px 3px;"><center><?php echo $row_select_pipe['avg_density']; ?></center></td>			
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
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td colspan=3 style="border: 1px solid black;padding: 6px 3px;font-size:13px;"><b>&nbsp;&nbsp;2.&nbsp;&nbsp;Consistency Test</b></td>
							<td colspan=1 style="border: 1px solid black;padding: 6px 3px;text-align:center;"><b>IS 4031(P-4) 1988</b></td>
						</tr>
						<tr>
							<td colspan=4 style="padding: 6px 3px;"><b>&nbsp;&nbsp;Temperature (°C) = <?php echo $row_select_pipe['con_temp']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity (%) = <?php echo $row_select_pipe['con_humidity']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Weight of GGBS 200 gm + Weight of cement 200 gm = <?php echo $row_select_pipe['con_weight']; ?></b></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 3px 3px;width:5%;"><center><b>Sr. No.</b></center></td>
							<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center><b>Volume of Water (cc)</b></center></td>
							<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center><b>% of Water</b></center></td>
							<td style="border: 1px solid black;padding: 3px 3px;width:20%;"><center><b>Reading on Vicat (mm)</b></center></td>		
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['vol_1']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['wtr_1']; ?></center></td>		
                            <td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['reading_1']; ?></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['vol_2']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['wtr_2']; ?></center></td>		
                            <td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['reading_2']; ?></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['vol_3']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['wtr_3']; ?></center></td>		
                            <td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['reading_3']; ?></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['vol_4']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['wtr_4']; ?></center></td>		
                            <td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['reading_4']; ?></center></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['vol_5']; ?></center></td>
							<td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['wtr_5']; ?></center></td>		
                            <td style="border: 1px solid black;padding: 2px 3px;"><center><?php echo $row_select_pipe['reading_5']; ?></center></td>	
						</tr>
						<tr>
						    <td style="padding: 2px 3px;"></td>
							<td style="padding: 2px 3px;"></td>
							<td style="padding: 2px 3px;text-align:right;border-left:1px solid black;">Consistency &nbsp; </td>
							<td style="border: 1px solid black;padding: 2px 3px;text-align:center;"><b><?php echo $row_select_pipe['final_consistency']; ?></b></td>			
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
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=2 style="border: 1px solid black;padding: 5px 3px;font-size:13px;"><b>&nbsp;&nbsp;4.&nbsp;&nbsp;Setting Time</b></td>
							<td style="border: 1px solid black;padding: 5px 3px;text-align:center;width:30%;"><b>IS:4031 (P-5) 1988</b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=3 style="padding: 6px 3px;"><b>&nbsp;&nbsp;Temperature (°C) = <?php echo $row_select_pipe['set_temp']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Humidity (%) = <?php echo $row_select_pipe['set_humidity']; ?> &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; Weight of GGBS 200 gm + Weight of cement 200 gm = <u>&nbsp;400 Gm&nbsp;</u></b></td>
						</tr>
						<tr>
							<td colspan=3 style="border: 1px solid black;padding: 5px 3px;"><b>&nbsp;&nbsp;Water = 0.85 x Consistency in %  X 4  =  &nbsp; &nbsp; &nbsp; &nbsp; <?php echo ($row_select_pipe['set_wtr']); ?></b></td>
						</tr>
					</table>
					
					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:20%;"><center><b>a</b></center></td>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;Time when water added : -&nbsp; <?php echo $row_select_pipe['hr_a']; ?>&nbsp; hr <u></u> min <u></u>.</b></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:20%;"><center><b>b</b></center></td>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;Initial setting time  : - &nbsp;<?php echo $row_select_pipe['hr_b']; ?>&nbsp; hr <u></u> min  <u></u>.</b></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:20%;"><center><b>c</b></center></td>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;Final setting time : - &nbsp;<?php echo $row_select_pipe['hr_c']; ?>&nbsp; hr <u></u>  min  <u></u>.</b></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;width:20%;"><center><b>Initial setting time</b></center></td>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;&nbsp;&nbsp;: -&nbsp;&nbsp; (b) - (a)  <u></u>  = <u> &nbsp;<?php echo $row_select_pipe['initial_time']; ?>&nbsp;</u> minutes.</b></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;width:20%;"><center><b>Final setting time</b></center></td>
							<td style="padding: 3px 3px;"><b>&nbsp;&nbsp;&nbsp;&nbsp;: -&nbsp;&nbsp; (c) - (a)  <u></u>  =  <u>&nbsp;<?php echo $row_select_pipe['final_time']; ?>&nbsp;</u> minutes.</b></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
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
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="padding: 1px;border-left: 1px solid;border-right :1px solid;"  colspan="4"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  01</td>
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
				<td colspan="4" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 3</td>
			</tr>
			
		</table>


		<div class="pagebreak"></div>
		<br><br><br>


		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 4031 - 1988</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
			<!-- <tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr> -->
		</table>
		<br>
		
		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri; margin-bottom: 20px;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="border: 1px solid black;padding: 5px 3px;font-size:13px;border-right:0px;"><b>&nbsp;&nbsp;3.&nbsp;&nbsp;Specific surface area m2 / Kg. </b></td>
							<td style="border: 1px solid black;padding: 5px 3px;text-align:center;width:30%;"><b>IS 4031(P-2) 1988</b></td>
						</tr>
						<tr>
						    <td style="padding: 5px 3px;"><b>&nbsp;&nbsp;Temperature (°C) = <?php echo $row_select_pipe['fine_temp']; ?></b></td>
							<td style="padding: 5px 3px;text-align:left;"><b>Humidity(%) = <?php echo $row_select_pipe['fine_humidity']; ?></b></td>
						</tr>
					</table>

					<table cellspacing="0" cellpadding="0" align="center" width="100%" style="border: 1px solid black;border-top:0;font-family : Calibri;font-size:12px;" height="Auto">
					    <tr>
							<td colspan=2 style="padding: 5px 3px;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;Time in Seconds (T)</b></td>
							<td colspan=2 style="border-left: 1px solid black;border-bottom: 1px solid black;padding: 5px 3px;">Specific surface area of Standard GGBS in cm<sup>2</sup> g ,S˳</td>	
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:10%;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['fines_t_1']; ?></center></td>
							<td  colspan=2 style="padding: 3px 3px;border-bottom: 1px solid black;">Standard Time in seconds , T˳</td>		
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['fines_t_2']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;">Density of Standard GGBS  g/cm3,ƍ˳</td>
							<td style="padding: 3px 3px;border-bottom: 1px solid black;">Density of  GGBS  g/cm3,ƍ</td>		
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['fines_t_3']; ?></center></td>
							<td rowspan=2 colspan=2 style="padding: 3px 3px;border-bottom: 1px solid black;">Apparatus Constant K = 1.414 X s˳ƍ˳ <span style="white-space: nowrap">
							   &radic;<span style="text-decoration:overline;border-bottom:1px solid black;">&nbsp;0.1 n˳&nbsp;</span>
							</span> = &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <?php echo $row_select_pipe['constant_k']; ?><br> <span style="white-space: nowrap;margin-left:40%;">
								&radic;<span style="text-decoration:overline;">&nbsp;t&nbsp;</span></td>		
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Average</b></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['avg_fines_time']; ?></center></td>	
						</tr>
						
						<tr>
							<td colspan=3 style="padding: 8px 3px"><b>&nbsp;&nbsp;Specific Surface area S = 521.08 X K
							<span style="white-space: nowrap"> &radic;<span style="text-decoration:overline;border-bottom:1px solid black;">&nbsp;t&nbsp;</span> </span>=  &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; <u><?php echo $row_select_pipe['ss_area']; ?></u><br> <span style="white-space: nowrap;margin-left:45%;">&nbsp;&nbsp;&nbsp;ƍ&nbsp;</span>
						    </b></td>
							<td  style="padding: 3px 3px;"><center><b>cm<sup>2</sup>/g =  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;m<sup>2</sup>/kg</b></td>
						</tr>
			       </table>
					</td>
				</tr>
		</table>

		<table align="center" width="100%" class="test1" style="">
			<tr>
				<td>
					<div style="float:left;">
						<b style="font-size:13px;">&nbsp;&nbsp;&nbsp;Where,</b><br><br>
						<b style="font-size:13px;">&nbsp;&nbsp;&nbsp;<span style="white-space: nowrap">
							   &radic;<span style="text-decoration:overline;">&nbsp;0.1 n˳&nbsp;&nbsp;</span> = the Viscosity of air at the test temperature taken from Table 1 (IS 4031 Part – 2)</b>
					</div>
				</td>
			</tr>		
		</table>
		<br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=2 style="border: 1px solid black;padding: 5px 3px;font-size:13px;"><b>&nbsp;&nbsp;5.&nbsp;&nbsp;Compressive Strength</b></td>
							<td style="border: 1px solid black;padding: 5px 3px;text-align:center;width:30%;"><b>IS 4031 (P-6) 1988</b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=1 style="padding: 5px 3px;"><b>&nbsp;&nbsp;Temperature (°C) = &nbsp; <?php echo $row_select_pipe['com_temp']; ?></b></td>
							<td colspan=2 style="padding: 5px 3px;text-align:center;"><b>Humidity (%) = &nbsp; <?php echo $row_select_pipe['com_humidity']; ?></b></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 5px 3px;"><b>&nbsp;&nbsp;Weight of GGBS 100 gm + <br>&nbsp;&nbsp;Weight of cement 100 gm  = <?php echo $row_select_pipe['weight_of_cement']; ?></b></td>
							<td style="border: 1px solid black;padding: 5px 3px;"><b>&nbsp;&nbsp;Weight of Std. Sand - <?php echo $row_select_pipe['weight_of_sand']; ?> gm </b></td>
							<td style="border: 1px solid black;padding: 5px 3px;"><b>&nbsp;&nbsp;Water = <span style="border-bottom:1px solid black;">% consistency </span>+ 3 x 8 = &nbsp;&nbsp;<u>&nbsp; <?php echo $row_select_pipe['weight_of_water']; ?> &nbsp;</u>&nbsp; C.C. <br><span style="margin-left:38%;"> 4 </span></b></td>
						</tr>
						<tr>
							<td colspan=3 style="padding: 5px 3px;border-bottom:1px solid black;"><b>&nbsp;&nbsp;Age: Days 7 (168 Hrs + 2 Hrs)</b></td>
						</tr>
					</table>
					
					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Date of Casting</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Date of Testing</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Length (L) mm</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Width (b) mm</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Area mm<sup>2</sup></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Load (KN)</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Comp. Strength (N/mm<sup>2</sup>)</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Avg. Comp. Strength (N/mm<sup>2</sup>)</b></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_4']; ?></center></td>
							<td rowspan=3 style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['avg_com_2']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_5']; ?></center></td></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_6']; ?></center></td></center></td>
						</tr>
						<tr>
							<td colspan=10 style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;Age:-Days 28 (672 + 4 Hrs)</b></td>
						</tr>
						<?php $cnt = 1; ?>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_7']; ?></center></td>
							<td rowspan=3 style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['avg_com_3']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_8']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_9']; ?></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
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
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="padding: 1px;border-left: 1px solid;border-right :1px solid;"  colspan="4"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  01</td>
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
				<td colspan="4" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 2 of 3</td>
			</tr>
			
		</table>


		<div class="pagebreak"></div>
		<br><br><br>

		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 4031 - 1988</td>
			</tr>
			<tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr>
			<tr>
				<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
			</tr>
			<!-- <tr>
				<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
			</tr> -->
		</table>
		
		<br>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;">
				<tr>
					<td>
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=2 style="border: 1px solid black;padding: 6px 3px;font-size:13px;"><b>&nbsp;&nbsp;6.&nbsp;&nbsp;Soundness by Le-chatelier</b></td>
							<td style="border: 1px solid black;padding: 6px 3px;text-align:center;width:30%;"><b>IS 4031 (P-3) 1988</b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=1 style="padding: 6px 3px;"><b>&nbsp;&nbsp;Temperature (°C) = &nbsp; <?php echo $row_select_pipe['sou_temp']; ?></b></td>
							<td colspan=1 style="padding: 6px 3px;text-align:center;"><b>Humidity (%) = &nbsp; <?php echo $row_select_pipe['sou_humidity']; ?></b></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 6px 3px;"><b>&nbsp;&nbsp;Weight of GGBS 100 gm+ Weight of cement 100 gm  = 200 gm</b></td>
							<td style="border: 1px solid black;padding: 6px 3px;"><b>&nbsp;Water = 0.78 x Consistency in % X 2  = <u>&nbsp; <?php echo ($row_select_pipe['sou_water']); ?>&nbsp; </u> C.C.</b></td>
						</tr>
					</table>
					
					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:8%;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Distance between two Points <br> after 24 hrs. in water (mm)</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Reading after 3 hrs. in boiling (mm)</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Difference (mm)</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Average (mm)</b></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $cnt++; ?></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['dis_1_1']; ?></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['dis_2_1']; ?></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['diff_1']; ?></center></td>
							<td rowspan="2" style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['soundness']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $cnt++; ?></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['dis_1_2']; ?></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['dis_2_2']; ?></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['diff_2']; ?></center></td>
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
					<table align="center" width="100%" class="test1" style="border: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=2 style="border: 1px solid black;padding: 6px 3px;font-size:13px;"><b>&nbsp;&nbsp;7.&nbsp;&nbsp;Slag Activity Index</b></td>
							<td style="border: 1px solid black;padding: 6px 3px;text-align:center;width:30%;"><b>IS 4031 (P-6) 1988</b></td>
						</tr>
					</table>

					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;font-family : Calibri;" height="Auto">
					    <tr>
							<td colspan=1 style="padding: 6px 3px;"><b>&nbsp;&nbsp;Temperature (°C) =</b></td>
							<td colspan=2 style="padding: 6px 3px;text-align:right;"><b>Humidity (%) =</b></td>
						</tr>
						<tr>
							<td style="border: 1px solid black;padding: 6px 3px;"><b>&nbsp;&nbsp;Weight of Cement 200 gm</b></td>
							<td style="border: 1px solid black;padding: 6px 3px;"><b>&nbsp;&nbsp;Weight of Std. Sand - 600 gm</b></td>
							<td style="border: 1px solid black;padding: 6px 3px;"><b>&nbsp;&nbsp;Water = <span style="border-bottom:1px solid black;">% consistency </span>+ 3 x 8 = &nbsp;&nbsp;<u></u>&nbsp;&nbsp;  C.C. <br><span style="margin-left:38%;"> 4 </span></b></td>
						</tr>
						<tr>
							<td colspan=3 style="padding: 6px 3px;border-bottom:1px solid black;"><b>&nbsp;&nbsp;Age :Days 7 (168 Hrs + 2 Hrs)</b></td>
						</tr>
					</table>
					
					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;border-bottom: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Date of Casting</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Date of Testing</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Length (L) mm</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Width (b) mm</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Area mm<sup>2</sup></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Load (KN)</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Comp. Strength (N/mm<sup>2</sup>)</b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Avg. Comp. Strength (N/mm<sup>2</sup>)</b></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_4']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_4']; ?></center></td>
							<td rowspan=3 style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['avg_com_2']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_5']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_5']; ?></center></td></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date2'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_6']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_6']; ?></center></td></center></td>
						</tr>
						<tr>
							<td colspan=10 style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;Age:-Days 28 (672 + 4 Hrs)</b></td>
						</tr>
						<?php $cnt = 1; ?>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_7']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_7']; ?></center></td>
							<td rowspan=3 style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['avg_com_3']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_8']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_8']; ?></center></td>
						</tr>
						<tr>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['caste_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo date('d-m-Y', strtotime($row_select_pipe['test_date3'])); ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['l9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['b9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['area_9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['load_9']; ?></center></td>
							<td style="padding: 3px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><?php echo $row_select_pipe['com_9']; ?></center></td>
						</tr>
						<tr>
							<td colspan=9 style="padding: 10px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><b></b></td>
						</tR>
						<tr>
							<td colspan=9 style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><b>&nbsp;&nbsp;Slag Activity Index =  
									<span style="border-bottom:1px solid black;">Compressive strength of Mortar cube using blend </span>&nbsp;&nbsp;&nbsp; x 10 = &nbsp;&nbsp;<br><span style="margin-left:17%;"> Compressive strength of control OPC mortar cube </span></b></td>
						</tR>
					</table>

					<table align="center" width="100%" class="test1" style="border-left: 1px solid black;border-right: 1px solid black;font-family : Calibri;" height="Auto">
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center><b>Sr.No.</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Slag Activity Index at 7 days</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center><b>Slag activity Index at 28 days</b></center></td>
						</tr>
						<?php $cnt = 1; ?>

						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center><?php echo $cnt++; ?></b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
						</tr>
						<tr>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;width:7%;"><center>Average</b></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
							<td style="padding: 6px 3px;border-right: 1px solid black;border-bottom: 1px solid black;"><center></center></td>
						</tr>
					</table>
					</td>
				</tr>																					
		</table>
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
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
			<tr>
				<td style="padding: 1px;border-left: 1px solid;border-right :1px solid;"  colspan="4"></td>
			</tr>
			<tr>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid; ;width: 20%;">Issue No :-  01</td>
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
				<td colspan="4" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 3 of 3</td>
			</tr>
			
		</table>
	</page>
		
	
	<!-- <page size="A4" >
		
			<table align="center" width="100%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="5px">
				<tr>
					<td colspan="5" style="font-size:13px;border: 1px solid black;"><center><b>Tec Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="font-size:13px;border: 1px solid black;"><center><b>Job sheet for Physical Test of for GGBS</b></center></td>					
					<td colspan="2" style="font-size:13px;border: 1px solid black;"><center><b>F-GGBS-01, Issue No.01, Page No 1 of 2</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Laboratory Ref. No.: <?php echo $job_no;?></b></td>					
					<td colspan="2" style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>					
				</tr>
				<tr>
					<td rowspan="2" style="border: 1px solid black; width:20%; text-align:center; padding-top:0;"><b>Any Other Information:</b></td>		
					<td style="border: 1px solid black;"><b></b></td>
					<td style="border: 1px solid black; width:15%;"><b></b></td>					
					<td style="border: 1px solid black;"><b></b></td>					
					<td style="border: 1px solid black;"><b>Starting Date:  <?php echo date('d/m/Y', strtotime($start_date));?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b></b></td>
					<td style="border: 1px solid black;"><b></b></td>					
					<td style="border: 1px solid black;text-align:center"><b></b></td>					
					<td style="border: 1px solid black;"><b>Completion Date:  <?php echo date('d/m/Y', strtotime($end_date));?></b></td>					
				</tr>
				<tr>
					<td colspan="5" style="font-size:16px;border: 1px solid black;">&nbsp;</td>					
				</tr>
			</table>
			
			<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td rowspan="5" style="border: 1px solid black; width:10%; text-align:center;"><b>Consistancy <br> (IS : 4031 - Part V)</b></td>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b>Temp(<sup>0</sup>C)</b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;"><b>Hmdty(%)</b></td>					
					<td style="border: 1px solid black; width:20%; "><b>Identification</b></td>					
					<td style="border: 1px solid black; text-align:center; width:15%;"><b>S-1</b></td>					
					<td style="border: 1px solid black; text-align:center; width:15%;"><b>S-2</b></td>					
					<td style="border: 1px solid black; text-align:center; width:15%;"><b>S-3</b></td>					
				</tr>
				<tr>
					<td rowspan="4" style="border: 1px solid black;text-align:center"><b><?php echo $row_select_pipe["con_temp"];?></b></td>					
					<td rowspan="4" style="border: 1px solid black;text-align:center"><b><?php echo $row_select_pipe["con_humidity"];?></b></td>					
					<td style="border: 1px solid black;"><b>Vol. of water (ml) A</b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['vol_1']; ?></b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['vol_2']; ?></b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['vol_3']; ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Quantity of Cement + GGBS <br> (50% CEMENT + 50% GGBS) (g) (B)</b></td>					
					<td colspan="3" style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe["con_weight"];?></b></td>					
										
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Penetration, mm</b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['reading_1']; ?></b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['reading_2']; ?></b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['reading_3']; ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b>Standard Consistancy(%)(a/b)</b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['wtr_1']; ?></b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['wtr_2']; ?></b></td>					
					<td style="border: 1px solid black;text-align:center;"><b><?php echo $row_select_pipe['wtr_3']; ?></b></td>					
				</tr>
				
				<tr>
					<td rowspan="7" style="border: 1px solid black; width:10%; text-align:center;"><b>Fineness <br> (Blaine's Air Permeability Method) <br> (IS : 4031-Part II)</b></td>
					<td rowspan="7" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['fine_temp']; ?></b></td>					
					<td rowspan="7" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['fine_humidity']; ?></b></td>					
					<td style="border: 1px solid black; width:20%;"><b>Weight of Cement (A), gm</b></td>					
					<td colspan="1" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['den_cement']; ?></b></td>					
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Fineness by Blaine Air Permeability</b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%;"><b>Initial Vol. of Le-Chat, Flask (B), ml</b></td>
					<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['den_intial']; ?></b></td>					
					<td style="border: 1px solid black; width:15%; "><b>Time for Bed 1, sec</b></td>					
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['fines_t_1']; ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%;"><b>Final Vol. of Le-Chat Flask(C), ml</b></td>
					<td colspan="1" style="border: 1px solid black; width:15%; text-align:center;"><b><?php echo $row_select_pipe['den_final']; ?></b></td>					
					<td style="border: 1px solid black; width:20%; width:15%;"><b>Time for Bed 1, sec</b></td>					
					<td colspan="2" style="border: 1px solid black; width:15%; text-align:center;"><b><?php echo $row_select_pipe['fines_t_2']; ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%;"><b>Density of GGBS (&rho;)(A/(C-B))</b></td>
					<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['density']; ?></b></td>					
					<td style="border: 1px solid black; width:15%; "><b>Time for Bed 2, sec</b></td>					
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['fines_t_3']; ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%;"><b></b></td>
					<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b></b></td>					
					<td style="border: 1px solid black; width:15%; "><b>Time for Bed 2, sec</b></td>					
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['fines_t_4']; ?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%;"><b>Mass of GGBS req. for Cement bed <br>(0.5 x V x &rho;)</b></td>
					<td colspan="1" style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['mass']; ?></b></td>					
					<td style="border: 1px solid black; width:20%; "><b>Avg, Time(T), sec</b></td>					
					<td colspan="2" style="border: 1px solid black; text-align:center;"><b><?php echo $row_select_pipe['avg_fines_time']; ?></b></td>					
				</tr>
				<tr>
					<td colspan="3" style="border: 1px solid black; width:10%;"><b>Specific surface area m<sup>2</sup>/Kg <?php if($row_select_pipe["type_of_cement"] == "OPC"){ echo "(OPC)=K x'$squareRoot'T";}else{ echo "K x $squareRoot T x $squareRoot E<sup>3</sup> / 1-e";}?></b></td>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php echo $row_select_pipe['ss_area']; ?></b></td>					
				</tr>
				
			</table>
			<br>
				
			<table align="center" width="100%"  class="test"  style="border: 1px solid black; margin-top:20px;" >
				<tr>
					<td colspan="2" style="border: 1px solid black;  text-align:center;"><b>Moisture Content</b></td>
					
					<td style="border: 1px solid black; width:10%; text-align:center;"><b>IS 2720 (Part 2) </b></td>
							
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b>Initial weight in (gm) (W1)</b></td>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b>Oven dry weight in (gm) (W2)</b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;"><b>Moisture Content (%) = (W1 - W2/W1) x 100</b></td>			
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['in_w1']!="" && $row_select_pipe['in_w1']!="0" && $row_select_pipe['in_w1']!=null){echo $row_select_pipe['in_w1']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['fn_w1']!="" && $row_select_pipe['fn_w1']!="0" && $row_select_pipe['fn_w1']!=null){echo $row_select_pipe['fn_w1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['mo1']!="" && $row_select_pipe['mo1']!="0" && $row_select_pipe['mo1']!=null){echo $row_select_pipe['mo1']; }else{echo "&nbsp;";}?></b></td>			
				</tr>
				<tr>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['in_w2']!="" && $row_select_pipe['in_w2']!="0" && $row_select_pipe['in_w2']!=null){echo $row_select_pipe['in_w2']; }else{echo "&nbsp;";}?></b></td>
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['fn_w2']!="" && $row_select_pipe['fn_w2']!="0" && $row_select_pipe['fn_w2']!=null){echo $row_select_pipe['fn_w2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['mo2']!="" && $row_select_pipe['mo2']!="0" && $row_select_pipe['mo2']!=null){echo $row_select_pipe['mo2']; }else{echo "&nbsp;";}?></b></td>			
				</tr>
				<tr>
					
					<td colspan="2"style="border: 1px solid black; width:10%; text-align:right;"><b>Average:</b></td>					
					<td style="border: 1px solid black; width:10%; text-align:center;"><b><?php if($row_select_pipe['avg_mo']!="" && $row_select_pipe['avg_mo']!="0" && $row_select_pipe['avg_mo']!=null){echo $row_select_pipe['avg_mo']; }else{echo "&nbsp;";}?></b></td>			
				</tr>
			</table>
			<br>

			<table align="center" width="100%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table>
		
			<div class="pagebreak"> </div>
			<br>
		
			<table align="center" width="100%" class="test"  style="border: 1px solid black; margin-top:-30px;" cellpadding="5px">
				<tr>
					<td colspan="5" style="font-size:13px;border: 1px solid black;"><center><b>Tec Material Testing Lab</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="font-size:13px;border: 1px solid black;"><center><b>Job sheet for Physical Test of GGBS</b></center></td>					
					<td colspan="2" style="font-size:13px;border: 1px solid black;"><center><b>F-GGBS-01, Issue No.01, Page No 1 of 2</b></center></td>					
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; width:60%"><b>Laboratory Ref. No.:<?php echo $job_no;?></b></td>					
					<td colspan="2" style="border: 1px solid black;"><b>Sample Receive Date: <?php echo date('d/m/Y', strtotime($rec_sample_date));?></b></td>					
				</tr>
				<tr>
					<td rowspan="2" style="border: 1px solid black; width:20%; text-align:center; padding-top:0;"><b>Any Other Information:</b></td>		
					<td style="border: 1px solid black;"><b></b></td>
					<td style="border: 1px solid black; width:15%;"><b></b></td>					
					<td style="border: 1px solid black;"><b></b></td>					
					<td style="border: 1px solid black;"><b>Starting Date:  <?php echo date('d/m/Y', strtotime($start_date));?></b></td>					
				</tr>
				<tr>
					<td style="border: 1px solid black;"><b></b></td>
					<td style="border: 1px solid black;"><b></b></td>					
					<td style="border: 1px solid black;text-align:center"><b></b></td>					
					<td style="border: 1px solid black;"><b>Completion Date:  <?php echo date('d/m/Y', strtotime($end_date));?></b></td>					
				</tr>
				<tr>
					<td colspan="5" style="font-size:16px;border: 1px solid black;">&nbsp;</td>					
				</tr>
			</table>
			<br>

			<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Compressive<br> Strength<br> (IS : 4031 - Part VI)</b></td>
					<td style="border: 1px solid black;text-align:center;"><b>Temp(<sup>0</sup>C)</b></td>					
					<td style="border: 1px solid black;text-align:center;"><b>Hmdty(%)</b></td>					
					<td style="border: 1px solid black;text-align:center;"><b>Date & Time of Casting</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Date & Time of Testing</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Age at The Time of Testing</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>ID</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Lenth, mm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Width, mm</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b>Area, mm<sup>2</sup></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>Load kN</b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>Comp Stre., N/mm<sup>2</sup></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>Avg. Comp. Stre.,  N/mm<sup>2</sup></b></td>	
				</tr>
				
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>Cement Cube</b></td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_temp']!="" && $row_select_pipe['com_temp']!="0" && $row_select_pipe['com_temp']!=null){echo $row_select_pipe['com_temp']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_humidity']!="" && $row_select_pipe['com_humidity']!="0" && $row_select_pipe['com_humidity']!=null){echo $row_select_pipe['com_humidity']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;"><b><?php if($row_select_pipe['caste_date1']!="" && $row_select_pipe['caste_date1']!="0" && $row_select_pipe['caste_date1']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date1'])); }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['test_date1']!="" && $row_select_pipe['test_date1']!="0" && $row_select_pipe['test_date1']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date1'])); }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['day_1']!="" && $row_select_pipe['day_1']!="0" && $row_select_pipe['day_1']!=null){echo $row_select_pipe['day_1']." Days"; }else{echo "&nbsp;";}?></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>1</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b1']!="" && $row_select_pipe['b1']!="0" && $row_select_pipe['b1']!=null){echo $row_select_pipe['b1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_1']!="" && $row_select_pipe['area_1']!="0" && $row_select_pipe['area_1']!=null){echo $row_select_pipe['area_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_1']!="" && $row_select_pipe['load_1']!="0" && $row_select_pipe['load_1']!=null){echo $row_select_pipe['load_1']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_1']!="" && $row_select_pipe['com_1']!="0" && $row_select_pipe['com_1']!=null){echo $row_select_pipe['com_1']; }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_com_1']!="" && $row_select_pipe['avg_com_1']!="0" && $row_select_pipe['avg_com_1']!=null){echo $row_select_pipe['avg_com_1']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>2</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l2']!="" && $row_select_pipe['l2']!="0" && $row_select_pipe['l2']!=null){echo $row_select_pipe['l2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b2']!="" && $row_select_pipe['b2']!="0" && $row_select_pipe['b2']!=null){echo $row_select_pipe['b2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_2']!="" && $row_select_pipe['area_2']!="0" && $row_select_pipe['area_2']!=null){echo $row_select_pipe['area_2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_2']!="" && $row_select_pipe['load_2']!="0" && $row_select_pipe['load_2']!=null){echo $row_select_pipe['load_2']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_2']!="" && $row_select_pipe['com_2']!="0" && $row_select_pipe['com_2']!=null){echo $row_select_pipe['com_2']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>3</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l3']!="" && $row_select_pipe['l3']!="0" && $row_select_pipe['l3']!=null){echo $row_select_pipe['l3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b3']!="" && $row_select_pipe['b3']!="0" && $row_select_pipe['b3']!=null){echo $row_select_pipe['b3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_3']!="" && $row_select_pipe['area_3']!="0" && $row_select_pipe['area_3']!=null){echo $row_select_pipe['area_3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_3']!="" && $row_select_pipe['load_3']!="0" && $row_select_pipe['load_3']!=null){echo $row_select_pipe['load_3']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_3']!="" && $row_select_pipe['com_3']!="0" && $row_select_pipe['com_3']!=null){echo $row_select_pipe['com_3']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>CEMENT + GGBS CUBE</b></td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_temp1']!="" && $row_select_pipe['com_temp1']!="0" && $row_select_pipe['com_temp1']!=null){echo $row_select_pipe['com_temp1']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_humidity1']!="" && $row_select_pipe['com_humidity1']!="0" && $row_select_pipe['com_humidity1']!=null){echo $row_select_pipe['com_humidity1']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;"><b><?php if($row_select_pipe['caste_date2']!="" && $row_select_pipe['caste_date2']!="0" && $row_select_pipe['caste_date2']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date2'])); }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['test_date2']!="" && $row_select_pipe['test_date2']!="0" && $row_select_pipe['test_date2']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date2'])); }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['day_2']!="" && $row_select_pipe['day_2']!="0" && $row_select_pipe['day_2']!=null){echo $row_select_pipe['day_2']. " Days"; }else{echo "&nbsp;";}?></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>4</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l4']!="" && $row_select_pipe['l4']!="0" && $row_select_pipe['l4']!=null){echo $row_select_pipe['l4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b4']!="" && $row_select_pipe['b4']!="0" && $row_select_pipe['b4']!=null){echo $row_select_pipe['b4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_4']!="" && $row_select_pipe['area_4']!="0" && $row_select_pipe['area_4']!=null){echo $row_select_pipe['area_4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_4']!="" && $row_select_pipe['load_4']!="0" && $row_select_pipe['load_4']!=null){echo $row_select_pipe['load_4']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_4']!="" && $row_select_pipe['com_4']!="0" && $row_select_pipe['com_4']!=null){echo $row_select_pipe['com_4']; }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_com_2']!="" && $row_select_pipe['avg_com_2']!="0" && $row_select_pipe['avg_com_2']!=null){echo $row_select_pipe['avg_com_2']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>5</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l5']!="" && $row_select_pipe['l5']!="0" && $row_select_pipe['l5']!=null){echo $row_select_pipe['l5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b5']!="" && $row_select_pipe['b5']!="0" && $row_select_pipe['b5']!=null){echo $row_select_pipe['b5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_5']!="" && $row_select_pipe['area_5']!="0" && $row_select_pipe['area_5']!=null){echo $row_select_pipe['area_5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_5']!="" && $row_select_pipe['load_5']!="0" && $row_select_pipe['load_5']!=null){echo $row_select_pipe['load_5']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_5']!="" && $row_select_pipe['com_5']!="0" && $row_select_pipe['com_5']!=null){echo $row_select_pipe['com_5']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>6</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l6']!="" && $row_select_pipe['l6']!="0" && $row_select_pipe['l6']!=null){echo $row_select_pipe['l6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b6']!="" && $row_select_pipe['b6']!="0" && $row_select_pipe['b6']!=null){echo $row_select_pipe['b6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_6']!="" && $row_select_pipe['area_6']!="0" && $row_select_pipe['area_6']!=null){echo $row_select_pipe['area_6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_6']!="" && $row_select_pipe['load_6']!="0" && $row_select_pipe['load_6']!=null){echo $row_select_pipe['load_6']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_6']!="" && $row_select_pipe['com_6']!="0" && $row_select_pipe['com_6']!=null){echo $row_select_pipe['com_6']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				
				
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>CEMENT CUBE</b></td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_temp2']!="" && $row_select_pipe['com_temp2']!="0" && $row_select_pipe['com_temp2']!=null){echo $row_select_pipe['com_temp2']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_humidity2']!="" && $row_select_pipe['com_humidity2']!="0" && $row_select_pipe['com_humidity2']!=null){echo $row_select_pipe['com_humidity2']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;"><b><?php if($row_select_pipe['caste_date3']!="" && $row_select_pipe['caste_date3']!="0" && $row_select_pipe['caste_date3']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date3'])); }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['test_date3']!="" && $row_select_pipe['test_date3']!="0" && $row_select_pipe['test_date3']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date3'])); }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['day_3']!="" && $row_select_pipe['day_3']!="0" && $row_select_pipe['day_3']!=null){echo $row_select_pipe['day_3']. " Days"; }else{echo "&nbsp;";}?></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>7</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l7']!="" && $row_select_pipe['l7']!="0" && $row_select_pipe['l7']!=null){echo $row_select_pipe['l7']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b7']!="" && $row_select_pipe['b7']!="0" && $row_select_pipe['b7']!=null){echo $row_select_pipe['b7']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_7']!="" && $row_select_pipe['area_7']!="0" && $row_select_pipe['area_7']!=null){echo $row_select_pipe['area_7']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_7']!="" && $row_select_pipe['load_7']!="0" && $row_select_pipe['load_7']!=null){echo $row_select_pipe['load_7']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_7']!="" && $row_select_pipe['com_7']!="0" && $row_select_pipe['com_7']!=null){echo $row_select_pipe['com_7']; }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_com_3']!="" && $row_select_pipe['avg_com_3']!="0" && $row_select_pipe['avg_com_3']!=null){echo $row_select_pipe['avg_com_3']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>8</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l8']!="" && $row_select_pipe['l8']!="0" && $row_select_pipe['l8']!=null){echo $row_select_pipe['l8']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b8']!="" && $row_select_pipe['b8']!="0" && $row_select_pipe['b8']!=null){echo $row_select_pipe['b8']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_8']!="" && $row_select_pipe['area_8']!="0" && $row_select_pipe['area_8']!=null){echo $row_select_pipe['area_8']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_8']!="" && $row_select_pipe['load_8']!="0" && $row_select_pipe['load_8']!=null){echo $row_select_pipe['load_8']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_8']!="" && $row_select_pipe['com_8']!="0" && $row_select_pipe['com_8']!=null){echo $row_select_pipe['com_8']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>9</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l9']!="" && $row_select_pipe['l9']!="0" && $row_select_pipe['l9']!=null){echo $row_select_pipe['l9']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b9']!="" && $row_select_pipe['b9']!="0" && $row_select_pipe['b9']!=null){echo $row_select_pipe['b9']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_9']!="" && $row_select_pipe['area_9']!="0" && $row_select_pipe['area_9']!=null){echo $row_select_pipe['area_9']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_9']!="" && $row_select_pipe['load_9']!="0" && $row_select_pipe['load_9']!=null){echo $row_select_pipe['load_9']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_9']!="" && $row_select_pipe['com_9']!="0" && $row_select_pipe['com_9']!=null){echo $row_select_pipe['com_9']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b>CEMENT + GGBS CUBE</b></td>
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_temp3']!="" && $row_select_pipe['com_temp3']!="0" && $row_select_pipe['com_temp3']!=null){echo $row_select_pipe['com_temp3']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;text-align:center;"><b><?php if($row_select_pipe['com_humidity3']!="" && $row_select_pipe['com_humidity3']!="0" && $row_select_pipe['com_humidity3']!=null){echo $row_select_pipe['com_humidity3']; }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black;"><b><?php if($row_select_pipe['caste_date4']!="" && $row_select_pipe['caste_date4']!="0" && $row_select_pipe['caste_date4']!=null){echo date("d/m/Y",strtotime($row_select_pipe['caste_date4'])); }else{echo "&nbsp;";}?></b></td>					
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['test_date4']!="" && $row_select_pipe['test_date4']!="0" && $row_select_pipe['test_date4']!=null){echo date("d/m/Y",strtotime($row_select_pipe['test_date4'])); }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['day_4']!="" && $row_select_pipe['day_4']!="0" && $row_select_pipe['day_4']!=null){echo $row_select_pipe['day_4']. "Days" ; }else{echo "&nbsp;";}?></b></td>	
					<td style="border: 1px solid black; text-align:center;"><b>10</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l10']!="" && $row_select_pipe['l10']!="0" && $row_select_pipe['l10']!=null){echo $row_select_pipe['l10']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b10']!="" && $row_select_pipe['b10']!="0" && $row_select_pipe['b10']!=null){echo $row_select_pipe['b10']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_10']!="" && $row_select_pipe['area_10']!="0" && $row_select_pipe['area_10']!=null){echo $row_select_pipe['area_10']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_10']!="" && $row_select_pipe['load_10']!="0" && $row_select_pipe['load_10']!=null){echo $row_select_pipe['load_10']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_10']!="" && $row_select_pipe['com_10']!="0" && $row_select_pipe['com_10']!=null){echo $row_select_pipe['com_10']; }else{echo "&nbsp;";}?></b></td>	
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_com_4']!="" && $row_select_pipe['avg_com_4']!="0" && $row_select_pipe['avg_com_4']!=null){echo $row_select_pipe['avg_com_4']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>11</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l11']!="" && $row_select_pipe['l11']!="0" && $row_select_pipe['l11']!=null){echo $row_select_pipe['l11']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b11']!="" && $row_select_pipe['b11']!="0" && $row_select_pipe['b11']!=null){echo $row_select_pipe['b11']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_11']!="" && $row_select_pipe['area_11']!="0" && $row_select_pipe['area_11']!=null){echo $row_select_pipe['area_11']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_11']!="" && $row_select_pipe['load_11']!="0" && $row_select_pipe['load_11']!=null){echo $row_select_pipe['load_11']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_11']!="" && $row_select_pipe['com_11']!="0" && $row_select_pipe['com_11']!=null){echo $row_select_pipe['com_11']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>12</b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l12']!="" && $row_select_pipe['l12']!="0" && $row_select_pipe['l12']!=null){echo $row_select_pipe['l12']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['b12']!="" && $row_select_pipe['b12']!="0" && $row_select_pipe['b12']!=null){echo $row_select_pipe['b12']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area_12']!="" && $row_select_pipe['area_12']!="0" && $row_select_pipe['area_12']!=null){echo $row_select_pipe['area_12']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load_12']!="" && $row_select_pipe['load_12']!="0" && $row_select_pipe['load_12']!=null){echo $row_select_pipe['load_12']; }else{echo "&nbsp;";}?></b></td>					
					<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['com_12']!="" && $row_select_pipe['com_12']!="0" && $row_select_pipe['com_12']!=null){echo $row_select_pipe['com_12']; }else{echo "&nbsp;";}?></b></td>	
				</tr>
				
			</table>
			<table align="center" width="90%" class="test" style="border: 1px solid black; margin-top:30px;" cellpadding="10px">
				<tr>
					<td style="border: 1px solid black; width:50%;"><b>Tested By:</b></td>					
					<td style="border: 1px solid black; width:50%;"><b>Checked By:</b></td>					
				</tr>
			</table>
	</page> -->
	</body>
</html> 