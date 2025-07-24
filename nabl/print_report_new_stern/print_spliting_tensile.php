<?php 
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(0);?>
<style>
@page { margin: 0 40px; }
.pagebreak { page-break-before: always; }
page[size="A4"] {
  width: 21cm;
  height: 29.7cm;  
} 

</style>
<style>
.tdclass{
    border: 1px solid black;
    font-size:12px;
	 font-family : Calibri;
	
}
.test {
    border-collapse: collapse;
 font-size:12px;
	 font-family : Calibri;
}
	.tdclass1{
    
    font-size:12px;
	 font-family : Calibri;
}
div.vertical-sentence{
  -ms-writing-mode: tb-rl; /* for IE */
  -webkit-writing-mode: vertical-rl; /* for Webkit */
  writing-mode: vertical-rl;
  
}
.rotate-characters-back-to-horizontal{ 
  -webkit-text-orientation: upright;  /* for Webkit */
  text-orientation: upright; 
}



</style>
<html>
	<body>
			<?php
			function round_up($number, $precision = 0)
			{
				$fig = (int) str_pad('1', $precision, '0');
				return (ceil($number * $fig) / $fig);
			}
			$job_no = $_GET['job_no'];
			$lab_no = $_GET['lab_no'];
			$report_no = $_GET['report_no'];
			$trf_no = $_GET['trf_no'];
			$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
			$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);
			$no_of_rows=mysqli_num_rows($result_tiles_select);
			 $page_cont = round_up($no_of_rows/7);
			
			$ans = mysqli_fetch_array($result_tiles_select);
				
				
			 $select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn,$select_query);				
			
			$row_select = mysqli_fetch_array($result_select);
			$clientname= $row_select['clientname'];
			
			$client_address= $row_select['clientaddress'];
			$r_name= $row_select['refno'];
			$r_date= $row_select['date'];
			$agreement_no= $row_select['agreement_no'];
			
			$rec_sample_date= $row_select['sample_rec_date'];	
			$cons= $row_select['condition_of_sample_receved'];			
			if($cons == 0)
			{
				$con_sample = "Sealed";
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
			
			
			if($row_select["agency_name"] !="")
			{
				$agency_name= $row_select['agency_name'];
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
				}
		?>
		
		<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report -  PROPERTIES OF SPLITING TENSILE</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 14%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;ULR No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo $_GET['ulr']; ?></td>
					</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;--</td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Group :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Building Materials</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;">&nbsp;Amendment Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp; <?php echo date('d/m/Y', strtotime($row_select_pipe["amend_date"])); ?></td>
						<td style="border-bottom: 1px solid;text-align: left;border-left: 1px solid;">&nbsp;Discipline :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;Mechanical</td>
					</tr>
				</table>
			</td>
		</tr>
		<tr>
			<!-- header part -->
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<?php
						if ($clientname != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width: 24.9%;">&nbsp;Customer Name & Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
					</tr>
					<?php } 
					if ($row_select['tpi_name'] != "") {
						?>
							
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
					</tr>
					<?php
						}
						if ($name_of_work != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
					</tr>
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!-- <tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $source; ?></td>
					</tr> -->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
	
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri; ">
			<tr>
				<!--OTHER START-->
				<td>
					<table align="center" width="100%" class="test" style="border: 1px solid black; border-top:0px; border-left:2px solid black;border-right:2px solid black;" cellpadding="10px">
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;border-top:0px;"><b>Particular</b></td>					
							<td style="border: 1px solid black; text-align:center;border-top:0px;"><b>Specimen 1</b></td>					
							<td style="border: 1px solid black; text-align:center;border-top:0px;"><b>Specimen 2</b></td>					
							<td style="border: 1px solid black; text-align:center;border-top:0px;"><b>Specimen 3</b></td>					
						</tr>
						<tr>
							<td rowspan="3" style="border: 1px solid black; text-align:center;">Diameter (mm)</b></td>	
							<td style="border: 1px solid black; text-align:center;">Reading - 1</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read1_1']!="" && $row_select_pipe['d_read1_1']!="0" && $row_select_pipe['d_read1_1']!=null){echo $row_select_pipe['d_read1_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read1_2']!="" && $row_select_pipe['d_read1_2']!="0" && $row_select_pipe['d_read1_2']!=null){echo $row_select_pipe['d_read1_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read1_3']!="" && $row_select_pipe['d_read1_3']!="0" && $row_select_pipe['d_read1_3']!=null){echo $row_select_pipe['d_read1_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black; text-align:center;">Reading - 2</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read2_1']!="" && $row_select_pipe['d_read2_1']!="0" && $row_select_pipe['d_read2_1']!=null){echo $row_select_pipe['d_read2_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read2_2']!="" && $row_select_pipe['d_read2_2']!="0" && $row_select_pipe['d_read2_2']!=null){echo $row_select_pipe['d_read2_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['d_read2_3']!="" && $row_select_pipe['d_read2_3']!="0" && $row_select_pipe['d_read2_3']!=null){echo $row_select_pipe['d_read2_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black; text-align:center;">Reading - 3</b></td>	
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
							<td rowspan="2" style="border: 1px solid black; text-align:center;">Length (mm)</b></td>	
							<td style="border: 1px solid black; text-align:center;">Reading - 1</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_1']!="" && $row_select_pipe['l_read1_1']!="0" && $row_select_pipe['l_read1_1']!=null){echo $row_select_pipe['l_read1_1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_2']!="" && $row_select_pipe['l_read1_2']!="0" && $row_select_pipe['l_read1_2']!=null){echo $row_select_pipe['l_read1_2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['l_read1_3']!="" && $row_select_pipe['l_read1_3']!="0" && $row_select_pipe['l_read1_3']!=null){echo $row_select_pipe['l_read1_3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td style="border: 1px solid black; text-align:center;">Reading - 1</b></td>	
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
							<td colspan="2" style="border: 1px solid black; text-align:center;">Load (P)(KN)</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_load1']!="" && $row_select_pipe['spl_load1']!="0" && $row_select_pipe['spl_load1']!=null){echo $row_select_pipe['spl_load1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_load2']!="" && $row_select_pipe['spl_load2']!="0" && $row_select_pipe['spl_load2']!=null){echo $row_select_pipe['spl_load2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_load3']!="" && $row_select_pipe['spl_load3']!="0" && $row_select_pipe['spl_load3']!=null){echo $row_select_pipe['spl_load3']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;">Splitting Strength (N/mm<sup>2</sup>) fc=</b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_str1']!="" && $row_select_pipe['spl_str1']!="0" && $row_select_pipe['spl_str1']!=null){echo $row_select_pipe['spl_str1']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_str2']!="" && $row_select_pipe['spl_str2']!="0" && $row_select_pipe['spl_str2']!=null){echo $row_select_pipe['spl_str2']; }else{echo " <br>";}  ?></b></td>	
							<td style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['average']!="" && $row_select_pipe['average']!="0" && $row_select_pipe['average']!=null){echo $row_select_pipe['average']; }else{echo " <br>";}  ?></b></td>	
						</tr>
						<tr>
							<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Average (N/mm<sup>2</sup>) fc=</b></td>	
							<td colspan="3" style="border: 1px solid black; text-align:center;"><b><?php if($row_select_pipe['spl_avg1']!="" && $row_select_pipe['spl_avg1']!="0" && $row_select_pipe['spl_avg1']!=null){echo $row_select_pipe['spl_avg1']; }else{echo " <br>";}  ?></b></td>	
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed & Authorized by :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">1. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">2. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">3. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">4. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">5. * As Informed by Client.</td>
						</tr>
						<tr>
							<td style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :- FMT/TST - 012 / Page no:- 1 of 1</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>

		</page>
	</body>
</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>		
<script type="text/javascript">


</script>