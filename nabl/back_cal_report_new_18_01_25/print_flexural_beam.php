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
			$branch_name = $row_select['branch_name'];
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
								
				$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'"; 
				$result_select3 = mysqli_query($conn, $select_query3);

				if (mysqli_num_rows($result_select3) > 0) {
					$row_select3 = mysqli_fetch_assoc($result_select3);
					$detail_sample= $row_select3['mt_name'];
					include_once 'sample_id.php';
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
		<br><br>
		
	<page size="A4" >
		
		<!-- header design -->
		<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
				<!-- <tr>
					<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">CONCRETE</td>
				</tr>
				<tr>
					<td style="padding: 1px;border: 1px solid;"></td>
				</tr> -->
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS 2062:2011  Grade:<?php echo $row_select_pipe['ms_grade']; ?></td>
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
				<td style="text-align:center;"><b>1</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($start_date)); ?></td>
			</tr>
            <tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>
			</tr>
		</table>
        <br>
		
		<table align="center" width="100%" class="test"  style="border: 1px solid black;border-bottom:0px solid black;" cellpadding="5px">
				<tr>
					<td width="60%" style="padding:10px 10px;"><b>Worksheet for Flexural strength of Hard Concrete (IS 516 - 1959)</b></td>		
				</tr>
		</table>

		<table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
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
		<!--<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 0px solid;border-right: 0px solid;border-bottom: 1px solid; border-top:0px;">
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
							</tr>
						
						</table>
					</td>
				</tr>-->

		</page>
		
	</body>
</html> 
		
	
<!-- <script type="text/javascript">
		window.print();
</script> -->