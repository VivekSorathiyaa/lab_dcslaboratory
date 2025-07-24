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
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON SPLITING TENSILE</b></center>
				</td>
			</tr>
		</table>
		<br>

		<table align="center" width="94%" class="test1" height="15%">

			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $detail_sample;?></b></td>
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
			
		<table align="center" width="94%" class="test" style="border: 1px solid black;" cellpadding="10px">
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
		</table>


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
				<td style=""><center>Page 1 of 1</center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
				<td style=""><center></center></td>
			</tr>
		</table>

			
		</page>
	</body>
</html> 
		
	
<script type="text/javascript">
		window.print();
</script>