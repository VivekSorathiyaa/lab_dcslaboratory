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
			$select_tiles_query = "select * from solid_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
				$issue_date= $row_select2['issue_date'];								
				$letter_date= $row_select2['letter_date'];								
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
					$source= $row_select4['agg_source'];
					$mark= $row_select4['mark'];
					$brick_specification= $row_select4['brick_specification'];
				}
		?>
		
		<br>
		<br>
<page size="A4" >
		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON HOLLOW & SOLID CONCRETE BLOCK</b></center>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" height="15%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $mt_name;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d - m - y",strtotime($end_date)); ?></td>
			</tr>
		</table>
        <br>

		<table align="center" width="94%" class="test"  style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td colspan="8" style="border: 1px solid black;"><b>Compressive Strength</b></td>
				
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Identified As</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Length (mm)</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Width (mm)</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Area (mm2)</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>
				<td width="15%" style="border: 1px solid black; text-align:center;"><b>Average Compressive Strength (N/mm<sup>2</sup>)</b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i1']!="" && $row_select_pipe['i1']!="0" && $row_select_pipe['i1']!=null){echo $row_select_pipe['i1']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length1']!="" && $row_select_pipe['length1']!="0" && $row_select_pipe['length1']!=null){echo $row_select_pipe['length1']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width1']!="" && $row_select_pipe['width1']!="0" && $row_select_pipe['width1']!=null){echo $row_select_pipe['width1']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area1']!="" && $row_select_pipe['area1']!="0" && $row_select_pipe['area1']!=null){echo $row_select_pipe['area1']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load1']!="" && $row_select_pipe['load1']!="0" && $row_select_pipe['load1']!=null){echo $row_select_pipe['load1']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str1']!="" && $row_select_pipe['str1']!="0" && $row_select_pipe['str1']!=null){echo $row_select_pipe['str1']; }else{echo " <br>";}?></b></td>
				<td  rowspan="8" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['avg_str']!="" && $row_select_pipe['avg_str']!="0" && $row_select_pipe['avg_str']!=null){echo $row_select_pipe['avg_str']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i2']!="" && $row_select_pipe['i2']!="0" && $row_select_pipe['i2']!=null){echo $row_select_pipe['i2']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length2']!="" && $row_select_pipe['length2']!="0" && $row_select_pipe['length2']!=null){echo $row_select_pipe['length2']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width2']!="" && $row_select_pipe['width2']!="0" && $row_select_pipe['width2']!=null){echo $row_select_pipe['width2']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area2']!="" && $row_select_pipe['area2']!="0" && $row_select_pipe['area2']!=null){echo $row_select_pipe['area2']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load2']!="" && $row_select_pipe['load2']!="0" && $row_select_pipe['load2']!=null){echo $row_select_pipe['load2']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str2']!="" && $row_select_pipe['str2']!="0" && $row_select_pipe['str2']!=null){echo $row_select_pipe['str2']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>3</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i3']!="" && $row_select_pipe['i3']!="0" && $row_select_pipe['i3']!=null){echo $row_select_pipe['i3']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length3']!="" && $row_select_pipe['length3']!="0" && $row_select_pipe['length3']!=null){echo $row_select_pipe['length3']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width3']!="" && $row_select_pipe['width3']!="0" && $row_select_pipe['width3']!=null){echo $row_select_pipe['width3']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area3']!="" && $row_select_pipe['area3']!="0" && $row_select_pipe['area3']!=null){echo $row_select_pipe['area3']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load3']!="" && $row_select_pipe['load3']!="0" && $row_select_pipe['load3']!=null){echo $row_select_pipe['load3']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str3']!="" && $row_select_pipe['str3']!="0" && $row_select_pipe['str3']!=null){echo $row_select_pipe['str3']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>4</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i4']!="" && $row_select_pipe['i4']!="0" && $row_select_pipe['i4']!=null){echo $row_select_pipe['i4']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length4']!="" && $row_select_pipe['length4']!="0" && $row_select_pipe['length4']!=null){echo $row_select_pipe['length4']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width4']!="" && $row_select_pipe['width4']!="0" && $row_select_pipe['width4']!=null){echo $row_select_pipe['width4']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area4']!="" && $row_select_pipe['area4']!="0" && $row_select_pipe['area4']!=null){echo $row_select_pipe['area4']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load4']!="" && $row_select_pipe['load4']!="0" && $row_select_pipe['load4']!=null){echo $row_select_pipe['load4']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str4']!="" && $row_select_pipe['str4']!="0" && $row_select_pipe['str4']!=null){echo $row_select_pipe['str4']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>5</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i5']!="" && $row_select_pipe['i5']!="0" && $row_select_pipe['i5']!=null){echo $row_select_pipe['i5']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length5']!="" && $row_select_pipe['length5']!="0" && $row_select_pipe['length5']!=null){echo $row_select_pipe['length5']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width5']!="" && $row_select_pipe['width5']!="0" && $row_select_pipe['width5']!=null){echo $row_select_pipe['width5']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area5']!="" && $row_select_pipe['area5']!="0" && $row_select_pipe['area5']!=null){echo $row_select_pipe['area5']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load5']!="" && $row_select_pipe['load5']!="0" && $row_select_pipe['load5']!=null){echo $row_select_pipe['load5']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str5']!="" && $row_select_pipe['str5']!="0" && $row_select_pipe['str5']!=null){echo $row_select_pipe['str5']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>6</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i6']!="" && $row_select_pipe['i6']!="0" && $row_select_pipe['i6']!=null){echo $row_select_pipe['i6']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length6']!="" && $row_select_pipe['length6']!="0" && $row_select_pipe['length6']!=null){echo $row_select_pipe['length6']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width6']!="" && $row_select_pipe['width6']!="0" && $row_select_pipe['width6']!=null){echo $row_select_pipe['width6']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area6']!="" && $row_select_pipe['area6']!="0" && $row_select_pipe['area6']!=null){echo $row_select_pipe['area6']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load6']!="" && $row_select_pipe['load6']!="0" && $row_select_pipe['load6']!=null){echo $row_select_pipe['load6']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str6']!="" && $row_select_pipe['str6']!="0" && $row_select_pipe['str6']!=null){echo $row_select_pipe['str6']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>7</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i7']!="" && $row_select_pipe['i7']!="0" && $row_select_pipe['i7']!=null){echo $row_select_pipe['i7']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length7']!="" && $row_select_pipe['length7']!="0" && $row_select_pipe['length7']!=null){echo $row_select_pipe['length7']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width7']!="" && $row_select_pipe['width7']!="0" && $row_select_pipe['width7']!=null){echo $row_select_pipe['width7']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area7']!="" && $row_select_pipe['area7']!="0" && $row_select_pipe['area7']!=null){echo $row_select_pipe['area7']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load7']!="" && $row_select_pipe['load7']!="0" && $row_select_pipe['load7']!=null){echo $row_select_pipe['load7']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str7']!="" && $row_select_pipe['str7']!="0" && $row_select_pipe['str7']!=null){echo $row_select_pipe['str7']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td  style="border: 1px solid black; text-align:center;"><b>8</b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['i8']!="" && $row_select_pipe['i8']!="0" && $row_select_pipe['i8']!=null){echo $row_select_pipe['i8']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['length8']!="" && $row_select_pipe['length8']!="0" && $row_select_pipe['length8']!=null){echo $row_select_pipe['length8']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['width8']!="" && $row_select_pipe['width8']!="0" && $row_select_pipe['width8']!=null){echo $row_select_pipe['width8']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['area8']!="" && $row_select_pipe['area8']!="0" && $row_select_pipe['area8']!=null){echo $row_select_pipe['area8']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['load8']!="" && $row_select_pipe['load8']!="0" && $row_select_pipe['load8']!=null){echo $row_select_pipe['load8']; }else{echo " <br>";}?></b></td>
				<td  style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['str8']!="" && $row_select_pipe['str8']!="0" && $row_select_pipe['str8']!=null){echo $row_select_pipe['str8']; }else{echo " <br>";}?></b></td>
			</tr>
		</table>
		<br>
	
		<table align="center" width="94%" class="test"  style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Sr No.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Initial Weight (gm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Final Weight (gm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Water Absorption (%)</b></td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>1.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wa_1_1']!="" && $row_select_pipe['wa_1_1']!="0" && $row_select_pipe['wa_1_1']!=null){echo $row_select_pipe['wa_1_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wa_2_1']!="" && $row_select_pipe['wa_2_1']!="0" && $row_select_pipe['wa_2_1']!=null){echo $row_select_pipe['wa_2_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wtr1']!="" && $row_select_pipe['wtr1']!="0" && $row_select_pipe['wtr1']!=null){echo $row_select_pipe['wtr1']; }else{echo " <br>";}?></b></td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>2.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wa_1_2']!="" && $row_select_pipe['wa_1_2']!="0" && $row_select_pipe['wa_1_2']!=null){echo $row_select_pipe['wa_1_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wa_2_2']!="" && $row_select_pipe['wa_2_2']!="0" && $row_select_pipe['wa_2_2']!=null){echo $row_select_pipe['wa_2_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wtr2']!="" && $row_select_pipe['wtr2']!="0" && $row_select_pipe['wtr2']!=null){echo $row_select_pipe['wtr2']; }else{echo " <br>";}?></b></td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>3.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wa_1_3']!="" && $row_select_pipe['wa_1_3']!="0" && $row_select_pipe['wa_1_3']!=null){echo $row_select_pipe['wa_1_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wa_2_3']!="" && $row_select_pipe['wa_2_3']!="0" && $row_select_pipe['wa_2_3']!=null){echo $row_select_pipe['wa_2_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['wtr3']!="" && $row_select_pipe['wtr3']!="0" && $row_select_pipe['wtr3']!=null){echo $row_select_pipe['wtr3']; }else{echo " <br>";}?></b></td>	
			</tr>
			<tr>
				<td colspan="3" style="border: 1px solid black; text-align:right"><b>Average:</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['avg_wtr']!="" && $row_select_pipe['avg_wtr']!="0" && $row_select_pipe['avg_wtr']!=null){echo $row_select_pipe['avg_wtr']; }else{echo " <br>";}?></b></td>	
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test"  style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Sr No.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Length (mm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Width (mm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Height (mm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Volume (mm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Initial Weight (gm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Final Dry Weight (gm)</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Dry Density (kg/m<sup>3</sup>)</b></td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>1.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dl1']!="" && $row_select_pipe['dl1']!="0" && $row_select_pipe['dl1']!=null){echo $row_select_pipe['dl1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dw1']!="" && $row_select_pipe['dw1']!="0" && $row_select_pipe['dw1']!=null){echo $row_select_pipe['dw1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dh1']!="" && $row_select_pipe['dh1']!="0" && $row_select_pipe['dh1']!=null){echo $row_select_pipe['dh1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['vol1']!="" && $row_select_pipe['vol1']!="0" && $row_select_pipe['vol1']!=null){echo $row_select_pipe['vol1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['iwet1']!="" && $row_select_pipe['iwet1']!="0" && $row_select_pipe['iwet1']!=null){echo $row_select_pipe['iwet1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['fwet1']!="" && $row_select_pipe['fwet1']!="0" && $row_select_pipe['fwet1']!=null){echo $row_select_pipe['fwet1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['den1']!="" && $row_select_pipe['den1']!="0" && $row_select_pipe['den1']!=null){echo $row_select_pipe['den1']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>2.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dl2']!="" && $row_select_pipe['dl2']!="0" && $row_select_pipe['dl2']!=null){echo $row_select_pipe['dl2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dw2']!="" && $row_select_pipe['dw2']!="0" && $row_select_pipe['dw2']!=null){echo $row_select_pipe['dw2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dh2']!="" && $row_select_pipe['dh2']!="0" && $row_select_pipe['dh2']!=null){echo $row_select_pipe['dh2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['vol2']!="" && $row_select_pipe['vol2']!="0" && $row_select_pipe['vol2']!=null){echo $row_select_pipe['vol2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['iwet2']!="" && $row_select_pipe['iwet2']!="0" && $row_select_pipe['iwet2']!=null){echo $row_select_pipe['iwet2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['fwet2']!="" && $row_select_pipe['fwet2']!="0" && $row_select_pipe['fwet2']!=null){echo $row_select_pipe['fwet2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['den2']!="" && $row_select_pipe['den2']!="0" && $row_select_pipe['den2']!=null){echo $row_select_pipe['den2']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>3.</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dl3']!="" && $row_select_pipe['dl3']!="0" && $row_select_pipe['dl3']!=null){echo $row_select_pipe['dl3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dw3']!="" && $row_select_pipe['dw3']!="0" && $row_select_pipe['dw3']!=null){echo $row_select_pipe['dw3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dh3']!="" && $row_select_pipe['dh3']!="0" && $row_select_pipe['dh3']!=null){echo $row_select_pipe['dh3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['vol3']!="" && $row_select_pipe['vol3']!="0" && $row_select_pipe['vol3']!=null){echo $row_select_pipe['vol3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['iwet3']!="" && $row_select_pipe['iwet3']!="0" && $row_select_pipe['iwet3']!=null){echo $row_select_pipe['iwet3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['fwet3']!="" && $row_select_pipe['fwet3']!="0" && $row_select_pipe['fwet3']!=null){echo $row_select_pipe['fwet3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['den3']!="" && $row_select_pipe['den3']!="0" && $row_select_pipe['den3']!=null){echo $row_select_pipe['den3']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td colspan="7" style="border: 1px solid black; text-align:right"><b>Average :</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['avg_den']!="" && $row_select_pipe['avg_den']!="0" && $row_select_pipe['avg_den']!=null){echo $row_select_pipe['avg_den']; }else{echo " <br>";}?></b></td>
			</tr>
		</table>
		<br><br>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 1 of 3</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
		<div class="pagebreak"></div>
		<br>
		<br>


		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON HOLLOW & SOLID CONCRETE BLOCK</b></center>
				</td>
			</tr>
		</table>
		<br><br>

		<table align="center" width="94%" class="test"  style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td rowspan="2" colspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>SR No</b></td>	
				<td style="border: 1px solid black; text-align:center;"><b>Date:</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Date:</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Date:</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Date:</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Date:</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Date:</b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Drying Shrinkage</b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;	"><b>Average of two face</b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Average Drying Shrinkage %</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Date</b></td>	
				<td rowspan="2"style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Average of two face</b></td>	
				<td rowspan="2"style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Average Moiture Movement %</b></td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Reading 1</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Reading 2</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Reading 3</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Reading 4</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Reading 5</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Reading 6</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Reading 1</b></td>	
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Sample 1</b></td>	
				<td style="border: 1px solid black; text-align:center;"><b>Face 1</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r1_1']!="" && $row_select_pipe['r1_1']!="0" && $row_select_pipe['r1_1']!=null){echo $row_select_pipe['r1_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r2_1']!="" && $row_select_pipe['r2_1']!="0" && $row_select_pipe['r2_1']!=null){echo $row_select_pipe['r2_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r3_1']!="" && $row_select_pipe['r3_1']!="0" && $row_select_pipe['r3_1']!=null){echo $row_select_pipe['r3_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r4_1']!="" && $row_select_pipe['r4_1']!="0" && $row_select_pipe['r4_1']!=null){echo $row_select_pipe['r4_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r5_1']!="" && $row_select_pipe['r5_1']!="0" && $row_select_pipe['r5_1']!=null){echo $row_select_pipe['r5_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r6_1']!="" && $row_select_pipe['r6_1']!="0" && $row_select_pipe['r6_1']!=null){echo $row_select_pipe['r6_1']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dry1']!="" && $row_select_pipe['dry1']!="0" && $row_select_pipe['dry1']!=null){echo $row_select_pipe['dry1']; }else{echo " <br>";}?></b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['age1_1']!="" && $row_select_pipe['age1_1']!="0" && $row_select_pipe['age1_1']!=null){echo $row_select_pipe['age1_1']; }else{echo " <br>";}?></b></td>	
				<td rowspan="6" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b><?php if($row_select_pipe['avg_dry']!="" && $row_select_pipe['avg_dry']!="0" && $row_select_pipe['avg_dry']!=null){echo $row_select_pipe['avg_dry']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r7_1']!="" && $row_select_pipe['r7_1']!="0" && $row_select_pipe['r7_1']!=null){echo $row_select_pipe['r7_1']; }else{echo " <br>";}?></b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['age2_1']!="" && $row_select_pipe['age2_1']!="0" && $row_select_pipe['age2_1']!=null){echo $row_select_pipe['age2_1']; }else{echo " <br>";}?></b></td>	
				<td rowspan="6" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b><?php if($row_select_pipe['avg_mo']!="" && $row_select_pipe['avg_mo']!="0" && $row_select_pipe['avg_mo']!=null){echo $row_select_pipe['avg_mo']; }else{echo " <br>";}?></b></td>	
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Face 2</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r1_2']!="" && $row_select_pipe['r1_2']!="0" && $row_select_pipe['r1_2']!=null){echo $row_select_pipe['r1_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r2_2']!="" && $row_select_pipe['r2_2']!="0" && $row_select_pipe['r2_2']!=null){echo $row_select_pipe['r2_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r3_2']!="" && $row_select_pipe['r3_2']!="0" && $row_select_pipe['r3_2']!=null){echo $row_select_pipe['r3_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r4_2']!="" && $row_select_pipe['r4_2']!="0" && $row_select_pipe['r4_2']!=null){echo $row_select_pipe['r4_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r5_2']!="" && $row_select_pipe['r5_2']!="0" && $row_select_pipe['r5_2']!=null){echo $row_select_pipe['r5_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r6_2']!="" && $row_select_pipe['r6_2']!="0" && $row_select_pipe['r6_2']!=null){echo $row_select_pipe['r6_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dry2']!="" && $row_select_pipe['dry2']!="0" && $row_select_pipe['dry2']!=null){echo $row_select_pipe['dry2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r7_2']!="" && $row_select_pipe['r7_2']!="0" && $row_select_pipe['r7_2']!=null){echo $row_select_pipe['r7_2']; }else{echo " <br>";}?></b></td>	
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Sample 1</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Face 1</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r1_3']!="" && $row_select_pipe['r1_3']!="0" && $row_select_pipe['r1_3']!=null){echo $row_select_pipe['r1_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r2_3']!="" && $row_select_pipe['r2_3']!="0" && $row_select_pipe['r2_3']!=null){echo $row_select_pipe['r2_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r3_3']!="" && $row_select_pipe['r3_3']!="0" && $row_select_pipe['r3_3']!=null){echo $row_select_pipe['r3_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r4_3']!="" && $row_select_pipe['r4_3']!="0" && $row_select_pipe['r4_3']!=null){echo $row_select_pipe['r4_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r5_3']!="" && $row_select_pipe['r5_3']!="0" && $row_select_pipe['r5_3']!=null){echo $row_select_pipe['r5_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r6_3']!="" && $row_select_pipe['r6_3']!="0" && $row_select_pipe['r6_3']!=null){echo $row_select_pipe['r6_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dry3']!="" && $row_select_pipe['dry3']!="0" && $row_select_pipe['dry3']!=null){echo $row_select_pipe['dry3']; }else{echo " <br>";}?></b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['age1_2']!="" && $row_select_pipe['age1_2']!="0" && $row_select_pipe['age1_2']!=null){echo $row_select_pipe['age1_2']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r7_3']!="" && $row_select_pipe['r7_3']!="0" && $row_select_pipe['r7_3']!=null){echo $row_select_pipe['r7_3']; }else{echo " <br>";}?></b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['age2_2']!="" && $row_select_pipe['age2_2']!="0" && $row_select_pipe['age2_2']!=null){echo $row_select_pipe['age2_2']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Face 2</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r1_4']!="" && $row_select_pipe['r1_4']!="0" && $row_select_pipe['r1_4']!=null){echo $row_select_pipe['r1_4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r2_4']!="" && $row_select_pipe['r2_4']!="0" && $row_select_pipe['r2_4']!=null){echo $row_select_pipe['r2_4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r3_4']!="" && $row_select_pipe['r3_4']!="0" && $row_select_pipe['r3_4']!=null){echo $row_select_pipe['r3_4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r4_4']!="" && $row_select_pipe['r4_4']!="0" && $row_select_pipe['r4_4']!=null){echo $row_select_pipe['r4_4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r5_4']!="" && $row_select_pipe['r5_4']!="0" && $row_select_pipe['r5_4']!=null){echo $row_select_pipe['r5_4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r6_4']!="" && $row_select_pipe['r6_4']!="0" && $row_select_pipe['r6_4']!=null){echo $row_select_pipe['r6_4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dry4']!="" && $row_select_pipe['dry4']!="0" && $row_select_pipe['dry4']!=null){echo $row_select_pipe['dry4']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r7_4']!="" && $row_select_pipe['r7_4']!="0" && $row_select_pipe['r7_4']!=null){echo $row_select_pipe['r7_4']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black; text-align:center;writing-mode:tb-rl;transform:rotate(-180deg);padding:5px 3px;"><b>Sample 1</b></td>	
				<td style="border: 1px solid black; text-align:center"><b>Face 1</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r1_5']!="" && $row_select_pipe['r1_5']!="0" && $row_select_pipe['r1_5']!=null){echo $row_select_pipe['r1_5']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r2_5']!="" && $row_select_pipe['r2_5']!="0" && $row_select_pipe['r2_5']!=null){echo $row_select_pipe['r2_5']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r3_5']!="" && $row_select_pipe['r3_5']!="0" && $row_select_pipe['r3_5']!=null){echo $row_select_pipe['r3_5']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r4_5']!="" && $row_select_pipe['r4_5']!="0" && $row_select_pipe['r4_5']!=null){echo $row_select_pipe['r4_5']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r5_5']!="" && $row_select_pipe['r5_5']!="0" && $row_select_pipe['r5_5']!=null){echo $row_select_pipe['r5_5']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r6_5']!="" && $row_select_pipe['r6_5']!="0" && $row_select_pipe['r6_5']!=null){echo $row_select_pipe['r6_5']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dry5']!="" && $row_select_pipe['dry5']!="0" && $row_select_pipe['dry5']!=null){echo $row_select_pipe['dry5']; }else{echo " <br>";}?></b></td>	
				<td rowspan="2" style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['age1_3']!="" && $row_select_pipe['age1_3']!="0" && $row_select_pipe['age1_3']!=null){echo $row_select_pipe['age1_3']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r7_5']!="" && $row_select_pipe['r7_5']!="0" && $row_select_pipe['r7_5']!=null){echo $row_select_pipe['r7_5']; }else{echo " <br>";}?></b></td>	
				<td rowspan="2"style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['age2_3']!="" && $row_select_pipe['age2_3']!="0" && $row_select_pipe['age2_3']!=null){echo $row_select_pipe['age2_3']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Face 2</b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r1_6']!="" && $row_select_pipe['r1_6']!="0" && $row_select_pipe['r1_6']!=null){echo $row_select_pipe['r1_6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r2_6']!="" && $row_select_pipe['r2_6']!="0" && $row_select_pipe['r2_6']!=null){echo $row_select_pipe['r2_6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r3_6']!="" && $row_select_pipe['r3_6']!="0" && $row_select_pipe['r3_6']!=null){echo $row_select_pipe['r3_6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r4_6']!="" && $row_select_pipe['r4_6']!="0" && $row_select_pipe['r4_6']!=null){echo $row_select_pipe['r4_6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r5_6']!="" && $row_select_pipe['r5_6']!="0" && $row_select_pipe['r5_6']!=null){echo $row_select_pipe['r5_6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r6_6']!="" && $row_select_pipe['r6_6']!="0" && $row_select_pipe['r6_6']!=null){echo $row_select_pipe['r6_6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['dry6']!="" && $row_select_pipe['dry6']!="0" && $row_select_pipe['dry6']!=null){echo $row_select_pipe['dry6']; }else{echo " <br>";}?></b></td>	
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['r7_6']!="" && $row_select_pipe['r7_6']!="0" && $row_select_pipe['r7_6']!=null){echo $row_select_pipe['r7_6']; }else{echo " <br>";}?></b></td>	
			</tr>
		</table>
		<br><br><br><br><br>	

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 2 of 3</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>
			
		<div class="pagebreak"></div>
		<br>
		<br>


		<table align="center" width="94%" class="test" height="8%" style="border: 1px solid black;">
			<tr>
				<td rowspan="2" style="height:70px;width:120px;border: 1px solid black;"><img src="../images/mttest.jpg" style="height:95%;width:90%;padding-left:7px;"></td>
				<td colspan="2" style="font-size:14px;border: 1px solid black;">
					<center><b>Laboratory Quality System Format – Manglam Consultancy Services, Vadodara</b></center>
				</td>
			</tr>
			<tr>
				<td style="font-size:11px;border: 1px solid black;">
					<center><b>FMT-OBS</b></center>
				</td>
				<td style="font-size:12px;border: 1px solid black;">
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON HOLLOW & SOLID CONCRETE BLOCK</b></center>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test"  style="border: 1px solid black;" cellpadding="5px">
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>SR No</b></td>
				<td style="border: 1px solid black; text-align:center"><b>Length (mm)</b></td>
				<td style="border: 1px solid black; text-align:center"><b>Width (mm)</b></td>
				<td style="border: 1px solid black; text-align:center"><b>Height (mm)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>1.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w1']!="" && $row_select_pipe['w1']!="0" && $row_select_pipe['w1']!=null){echo $row_select_pipe['w1']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h1']!="" && $row_select_pipe['h1']!="0" && $row_select_pipe['h1']!=null){echo $row_select_pipe['h1']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>2.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l2']!="" && $row_select_pipe['l2']!="0" && $row_select_pipe['l2']!=null){echo $row_select_pipe['l2']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w2']!="" && $row_select_pipe['w2']!="0" && $row_select_pipe['w2']!=null){echo $row_select_pipe['w2']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h2']!="" && $row_select_pipe['h2']!="0" && $row_select_pipe['h2']!=null){echo $row_select_pipe['h2']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>3.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l3']!="" && $row_select_pipe['l3']!="0" && $row_select_pipe['l3']!=null){echo $row_select_pipe['l3']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w3']!="" && $row_select_pipe['w3']!="0" && $row_select_pipe['w3']!=null){echo $row_select_pipe['w3']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h3']!="" && $row_select_pipe['h3']!="0" && $row_select_pipe['h3']!=null){echo $row_select_pipe['h3']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>4.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l4']!="" && $row_select_pipe['l4']!="0" && $row_select_pipe['l4']!=null){echo $row_select_pipe['l4']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w4']!="" && $row_select_pipe['w4']!="0" && $row_select_pipe['w4']!=null){echo $row_select_pipe['w4']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h4']!="" && $row_select_pipe['h4']!="0" && $row_select_pipe['h4']!=null){echo $row_select_pipe['h4']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>5.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l5']!="" && $row_select_pipe['l5']!="0" && $row_select_pipe['l5']!=null){echo $row_select_pipe['l5']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w5']!="" && $row_select_pipe['w5']!="0" && $row_select_pipe['w5']!=null){echo $row_select_pipe['w5']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h5']!="" && $row_select_pipe['h5']!="0" && $row_select_pipe['h5']!=null){echo $row_select_pipe['h5']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>6.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l6']!="" && $row_select_pipe['l6']!="0" && $row_select_pipe['l6']!=null){echo $row_select_pipe['l6']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w6']!="" && $row_select_pipe['w6']!="0" && $row_select_pipe['w6']!=null){echo $row_select_pipe['w6']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h6']!="" && $row_select_pipe['h6']!="0" && $row_select_pipe['h6']!=null){echo $row_select_pipe['h6']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>7.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l7']!="" && $row_select_pipe['l7']!="0" && $row_select_pipe['l7']!=null){echo $row_select_pipe['l7']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w7']!="" && $row_select_pipe['w7']!="0" && $row_select_pipe['w7']!=null){echo $row_select_pipe['w7']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h7']!="" && $row_select_pipe['h7']!="0" && $row_select_pipe['h7']!=null){echo $row_select_pipe['h7']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>8.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l8']!="" && $row_select_pipe['l8']!="0" && $row_select_pipe['l8']!=null){echo $row_select_pipe['l8']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w8']!="" && $row_select_pipe['w8']!="0" && $row_select_pipe['w8']!=null){echo $row_select_pipe['w8']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h8']!="" && $row_select_pipe['h8']!="0" && $row_select_pipe['h8']!=null){echo $row_select_pipe['h8']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>9.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l9']!="" && $row_select_pipe['l9']!="0" && $row_select_pipe['l9']!=null){echo $row_select_pipe['l9']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w9']!="" && $row_select_pipe['w9']!="0" && $row_select_pipe['w9']!=null){echo $row_select_pipe['w9']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h9']!="" && $row_select_pipe['h9']!="0" && $row_select_pipe['h9']!=null){echo $row_select_pipe['h9']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>10.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l10']!="" && $row_select_pipe['l10']!="0" && $row_select_pipe['l10']!=null){echo $row_select_pipe['l10']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w10']!="" && $row_select_pipe['w10']!="0" && $row_select_pipe['w10']!=null){echo $row_select_pipe['w10']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h10']!="" && $row_select_pipe['h10']!="0" && $row_select_pipe['h10']!=null){echo $row_select_pipe['h10']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>11.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l11']!="" && $row_select_pipe['l11']!="0" && $row_select_pipe['l11']!=null){echo $row_select_pipe['l11']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w11']!="" && $row_select_pipe['w11']!="0" && $row_select_pipe['w11']!=null){echo $row_select_pipe['w11']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h11']!="" && $row_select_pipe['h11']!="0" && $row_select_pipe['h11']!=null){echo $row_select_pipe['h11']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>12.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l12']!="" && $row_select_pipe['l12']!="0" && $row_select_pipe['l12']!=null){echo $row_select_pipe['l12']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w12']!="" && $row_select_pipe['w12']!="0" && $row_select_pipe['w12']!=null){echo $row_select_pipe['w12']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h12']!="" && $row_select_pipe['h12']!="0" && $row_select_pipe['h12']!=null){echo $row_select_pipe['h12']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>13.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l13']!="" && $row_select_pipe['l13']!="0" && $row_select_pipe['l13']!=null){echo $row_select_pipe['l13']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w13']!="" && $row_select_pipe['w13']!="0" && $row_select_pipe['w13']!=null){echo $row_select_pipe['w13']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h13']!="" && $row_select_pipe['h13']!="0" && $row_select_pipe['h13']!=null){echo $row_select_pipe['h13']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>14.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l14']!="" && $row_select_pipe['l14']!="0" && $row_select_pipe['l14']!=null){echo $row_select_pipe['l14']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w14']!="" && $row_select_pipe['w14']!="0" && $row_select_pipe['w14']!=null){echo $row_select_pipe['w14']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h14']!="" && $row_select_pipe['h14']!="0" && $row_select_pipe['h14']!=null){echo $row_select_pipe['h14']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>15.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l15']!="" && $row_select_pipe['l15']!="0" && $row_select_pipe['l15']!=null){echo $row_select_pipe['l15']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w15']!="" && $row_select_pipe['w15']!="0" && $row_select_pipe['w15']!=null){echo $row_select_pipe['w15']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h15']!="" && $row_select_pipe['h15']!="0" && $row_select_pipe['h15']!=null){echo $row_select_pipe['h15']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>16.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l16']!="" && $row_select_pipe['l16']!="0" && $row_select_pipe['l16']!=null){echo $row_select_pipe['l16']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w16']!="" && $row_select_pipe['w16']!="0" && $row_select_pipe['w16']!=null){echo $row_select_pipe['w16']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h16']!="" && $row_select_pipe['h16']!="0" && $row_select_pipe['h16']!=null){echo $row_select_pipe['h16']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>17.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l17']!="" && $row_select_pipe['l17']!="0" && $row_select_pipe['l17']!=null){echo $row_select_pipe['l17']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w17']!="" && $row_select_pipe['w17']!="0" && $row_select_pipe['w17']!=null){echo $row_select_pipe['w17']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h17']!="" && $row_select_pipe['h17']!="0" && $row_select_pipe['h17']!=null){echo $row_select_pipe['h17']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>18.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l18']!="" && $row_select_pipe['l18']!="0" && $row_select_pipe['l18']!=null){echo $row_select_pipe['l18']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w18']!="" && $row_select_pipe['w18']!="0" && $row_select_pipe['w18']!=null){echo $row_select_pipe['w18']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h18']!="" && $row_select_pipe['h18']!="0" && $row_select_pipe['h18']!=null){echo $row_select_pipe['h18']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>19.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l19']!="" && $row_select_pipe['l19']!="0" && $row_select_pipe['l19']!=null){echo $row_select_pipe['l19']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w19']!="" && $row_select_pipe['w19']!="0" && $row_select_pipe['w19']!=null){echo $row_select_pipe['w19']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h19']!="" && $row_select_pipe['h19']!="0" && $row_select_pipe['h19']!=null){echo $row_select_pipe['h19']; }else{echo " <br>";}?></b></td>
			</tr>
			
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>20.</b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['l20']!="" && $row_select_pipe['l20']!="0" && $row_select_pipe['l20']!=null){echo $row_select_pipe['l20']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['w20']!="" && $row_select_pipe['w20']!="0" && $row_select_pipe['w20']!=null){echo $row_select_pipe['w20']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['h20']!="" && $row_select_pipe['h20']!="0" && $row_select_pipe['h20']!=null){echo $row_select_pipe['h20']; }else{echo " <br>";}?></b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center"><b>Average : </b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['avg_l']!="" && $row_select_pipe['avg_l']!="0" && $row_select_pipe['avg_l']!=null){echo $row_select_pipe['avg_l']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['avg_w']!="" && $row_select_pipe['avg_w']!="0" && $row_select_pipe['avg_w']!=null){echo $row_select_pipe['avg_w']; }else{echo " <br>";}?></b></td>
				<td style="border: 1px solid black; text-align:center"><b><?php if($row_select_pipe['avg_h']!="" && $row_select_pipe['avg_h']!="0" && $row_select_pipe['avg_h']!=null){echo $row_select_pipe['avg_h']; }else{echo " <br>";}?></b></td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" style="margin-bottom:0px;" Height="15%">
			<tr style="font-size:16px;" >
				<td>
					<div style="float:left;">
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Reviewed By:</b><br><br>
						<b style="font-size:15px;">&nbsp;&nbsp;&nbsp;Witness By:</b>
					</div>
				</td>
			</tr>		
		</table>

		<table align="center" width="94%" class="test1" height="Auto" style="border-top:2px solid;">
			<tr style="">
				<td style="width:25%;padding-top:5px;"><center>Amendment No.: 01</center></td>
				<td style="width:25%;padding-top:5px;"><center>Amendment Date: 01.04.2023</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Prepared by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Approved by:</center></td>
				<td style="width:16.67%;padding-top:5px;"><center>Issued by:</center></td>
			</tr>	
			<tr>
				<td style=""><center>Issue No.: 03</center></td>
				<td style=""><center>Issue Date: 01.01.2022 </center></td>
				<td style=""><center>Nodal QM</center></td>
				<td style=""><center>Director</center></td>
				<td style=""><center>Nodal QM</center></td>
			</tr>
			<tr>
				<td style=""><center>Page 3 of 3</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>


		</page>
	</body>
</html> 
		
	
<!-- <script type="text/javascript">
		window.print();
</script> -->