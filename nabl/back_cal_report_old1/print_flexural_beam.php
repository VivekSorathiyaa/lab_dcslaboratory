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
					<center><b>OBSERVATION & CALCULATION SHEET FOR TEST ON FLEXURAL STRENGTH OF BEAM</b></center>
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
		
		<table align="center" width="94%" class="test"  style="border: 1px solid black;border-bottom:0px solid black;" cellpadding="5px">
				<tr>
					<td width="60%" style="padding:10px 10px;"><b>Worksheet for Flexural strength of Hard Concrete (IS 516 - 1959)</b></td>		
				</tr>
		</table>

		<table align="center" width="94%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Size of Specimen (mm)</b></td>
					<td width="20%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Distance of fracture from nearest roller in mm <br> (A)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Load (kN) <br> (P)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Beam Type)</b></td>
					<td width="10%" rowspan="2"style="border: 1px solid black; text-align:center;"><b>Modulus of rupture (N/mm<sup>2</sup>) </b></td>
					<td rowspan="2"style="border: 1px solid black; text-align:center;"><b>Average</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>B</b></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>D</b></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>L</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:8px 3px;">1</b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['b1']!="" && $row_select_pipe['b1']!="0" && $row_select_pipe['b1']!=null){echo $row_select_pipe['b1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['d1']!="" && $row_select_pipe['d1']!="0" && $row_select_pipe['d1']!=null){echo $row_select_pipe['d1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['l1']!="" && $row_select_pipe['l1']!="0" && $row_select_pipe['l1']!=null){echo $row_select_pipe['l1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['len1']!="" && $row_select_pipe['len1']!="0" && $row_select_pipe['len1']!=null){echo $row_select_pipe['len1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['max1']!="" && $row_select_pipe['max1']!="0" && $row_select_pipe['max1']!=null){echo $row_select_pipe['max1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['pos1']!="" && $row_select_pipe['pos1']!="0" && $row_select_pipe['pos1']!=null){echo $row_select_pipe['pos1']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['mod1']!="" && $row_select_pipe['mod1']!="0" && $row_select_pipe['mod1']!=null){echo $row_select_pipe['mod1']; }else{echo " <br>";}  ?></b></td>
					<td rowspan="3" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avg1']!="" && $row_select_pipe['avg1']!="0" && $row_select_pipe['avg1']!=null){echo $row_select_pipe['avg1']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:8px 3px;">2</b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['b2']!="" && $row_select_pipe['b2']!="0" && $row_select_pipe['b2']!=null){echo $row_select_pipe['b2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['d2']!="" && $row_select_pipe['d2']!="0" && $row_select_pipe['d2']!=null){echo $row_select_pipe['d2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['l2']!="" && $row_select_pipe['l2']!="0" && $row_select_pipe['l2']!=null){echo $row_select_pipe['l2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['len2']!="" && $row_select_pipe['len2']!="0" && $row_select_pipe['len2']!=null){echo $row_select_pipe['len2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['max2']!="" && $row_select_pipe['max2']!="0" && $row_select_pipe['max2']!=null){echo $row_select_pipe['max2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['pos2']!="" && $row_select_pipe['pos2']!="0" && $row_select_pipe['pos2']!=null){echo $row_select_pipe['pos2']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['mod2']!="" && $row_select_pipe['mod2']!="0" && $row_select_pipe['mod2']!=null){echo $row_select_pipe['mod2']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;padding:8px 3px;">3</b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['b3']!="" && $row_select_pipe['b3']!="0" && $row_select_pipe['b3']!=null){echo $row_select_pipe['b3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['d3']!="" && $row_select_pipe['d3']!="0" && $row_select_pipe['d3']!=null){echo $row_select_pipe['d3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['l3']!="" && $row_select_pipe['l3']!="0" && $row_select_pipe['l3']!=null){echo $row_select_pipe['l3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['len3']!="" && $row_select_pipe['len3']!="0" && $row_select_pipe['len3']!=null){echo $row_select_pipe['len3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['max3']!="" && $row_select_pipe['max3']!="0" && $row_select_pipe['max3']!=null){echo $row_select_pipe['max3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['pos3']!="" && $row_select_pipe['pos3']!="0" && $row_select_pipe['pos3']!=null){echo $row_select_pipe['pos3']; }else{echo " <br>";}  ?></b></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['mod3']!="" && $row_select_pipe['mod3']!="0" && $row_select_pipe['mod3']!=null){echo $row_select_pipe['mod3']; }else{echo " <br>";}  ?></b></td>
				</tr>
				<tr>
					<td colspan="10" style="border: 1px solid black;padding:8px 3px;"><b>f<sub>b</sub>=(p x l)/(b*d<sup>2</sup>)</b>when 'a' is greater than 200mm for 150mm specimen, or greater than 133mm for a 100mm specimen</td>
				</tr>
				<tr>
					<td colspan="10" style="border: 1px solid black;padding:8px 3px;"><b>f<sub>b</sub>=(3p x a)/(b*d<sup>2</sup>)</b>when 'a' is less than 200mm but greater than 170mm for 150mm specimen, or less than 133mm but greater than 100mm for a 100mm  specimen</td>
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
		
	
<!-- <script type="text/javascript">
		window.print();
</script> -->