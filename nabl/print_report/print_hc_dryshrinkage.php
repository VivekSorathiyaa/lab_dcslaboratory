<?php 
session_start();
include("../connection.php");
include("function_calling.php");
error_reporting(0);?>
<style>
@page { margin: 0 40px; }
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
			$select_tiles_query = "select * from hard_concrete WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
				$cast_date = $row_select_pipe['cast_date'];
				$cast_time = $row_select_pipe['cast_time'];
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
					$paver_shape= $row_select4['paver_shape'];
					$paver_age= $row_select4['paver_age'];
					$paver_color= $row_select4['paver_color'];
					$paver_thickness= $row_select4['paver_thickness'];
					$paver_grade= $row_select4['paver_grade'];
					$paver_size = $row_select4['dry_size'];
				}
				
				$pagecnt=1;
				$totalcnt=1;
				if($row_select_pipe['avgv']!="" && $row_select_pipe['avgv']!="0" && $row_select_pipe['avgv']!=null)
					{
						$totalcnt++;
					}
		?>
		
		
		<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - DRYING SHRINKAGE OF CONCRETE</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $detail_sample; ?> 	</td>
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

		<?php $cnt = 1; ?>
		<table align="center" width="100%" class="test"  style="font-size:11px;font-family : Calibri ; border-left:2px solid;border-right:2px solid;" cellpadding="5px">
				<tr>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sr No.</b></td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Date of Casting</b></td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sample ID</b></td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>ID Mark/Location*</b></td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Grade of Concrete*</b></td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Test Result (%)</b></td>
				</tr>
				<tr>
					<td width="5%" style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">C1</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['top_grade']; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['dry_shr_1']!="" && $row_select_pipe['dry_shr_1']!="0" && $row_select_pipe['dry_shr_1']!=null){echo $row_select_pipe['dry_shr_1']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">C2</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['top_grade']; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['dry_shr_2']!="" && $row_select_pipe['dry_shr_2']!="0" && $row_select_pipe['dry_shr_2']!=null){echo $row_select_pipe['dry_shr_2']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;">C3</td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['top_grade']; ?></td>
					<td style="font-size:11px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['dry_shr_3']!="" && $row_select_pipe['dry_shr_3']!="0" && $row_select_pipe['dry_shr_3']!=null){echo $row_select_pipe['dry_shr_3']; }else{echo " <br>";}  ?></td>
				</tr>
		</table>	
		<!-- <table align="center" width="100%" class="test"  style="border: 1px solid black;" cellpadding="5px">
				<tr>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Average Weight of five consuctive reading</b></td>
					<td colspan="5" style="border: 1px solid black; text-align:center;"><b> (Average of 5 reading)</b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Rf</b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Effective Length in mm </b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Drying Shrinkage</b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Wet Measurement after 4 days of immersion in water</b></td>
					<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>moisture Movement in %</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>R1</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>R2</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>R3</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>R4</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>R5</b></td>
				</tr>
				<tr>
					<td width="5%" style="border: 1px solid black; text-align:center;">1</td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_avg_1']!="" && $row_select_pipe['dry_avg_1']!="0" && $row_select_pipe['dry_avg_1']!=null){echo $row_select_pipe['dry_avg_1']; }else{echo " <br>";}  ?></td>
					<td width="6%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r1_1']!="" && $row_select_pipe['dry_r1_1']!="0" && $row_select_pipe['dry_r1_1']!=null){echo $row_select_pipe['dry_r1_1']; }else{echo " <br>";}  ?></td>
					<td width="6%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r2_1']!="" && $row_select_pipe['dry_r2_1']!="0" && $row_select_pipe['dry_r2_1']!=null){echo $row_select_pipe['dry_r2_1']; }else{echo " <br>";}  ?></td>
					<td width="6%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r3_1']!="" && $row_select_pipe['dry_r3_1']!="0" && $row_select_pipe['dry_r3_1']!=null){echo $row_select_pipe['dry_r3_1']; }else{echo " <br>";}  ?></td>
					<td width="6%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r4_1']!="" && $row_select_pipe['dry_r4_1']!="0" && $row_select_pipe['dry_r4_1']!=null){echo $row_select_pipe['dry_r4_1']; }else{echo " <br>";}  ?></td>
					<td width="6%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r5_1']!="" && $row_select_pipe['dry_r5_1']!="0" && $row_select_pipe['dry_r5_1']!=null){echo $row_select_pipe['dry_r5_1']; }else{echo " <br>";}  ?></td>
					<td width="6%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r6_1']!="" && $row_select_pipe['dry_r6_1']!="0" && $row_select_pipe['dry_r6_1']!=null){echo $row_select_pipe['dry_r6_1']; }else{echo " <br>";}  ?></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_len_1']!="" && $row_select_pipe['dry_len_1']!="0" && $row_select_pipe['dry_len_1']!=null){echo $row_select_pipe['dry_len_1']; }else{echo " <br>";}  ?></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_shr_1']!="" && $row_select_pipe['dry_shr_1']!="0" && $row_select_pipe['dry_shr_1']!=null){echo $row_select_pipe['dry_shr_1']; }else{echo " <br>";}  ?></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_wtr_1']!="" && $row_select_pipe['dry_wtr_1']!="0" && $row_select_pipe['dry_wtr_1']!=null){echo $row_select_pipe['dry_wtr_1']; }else{echo " <br>";}  ?></td>
					<td width="10%" style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_moi_1']!="" && $row_select_pipe['dry_moi_1']!="0" && $row_select_pipe['dry_moi_1']!=null){echo $row_select_pipe['dry_moi_1']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">2</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_avg_2']!="" && $row_select_pipe['dry_avg_2']!="0" && $row_select_pipe['dry_avg_2']!=null){echo $row_select_pipe['dry_avg_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r1_2']!="" && $row_select_pipe['dry_r1_2']!="0" && $row_select_pipe['dry_r1_2']!=null){echo $row_select_pipe['dry_r1_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r2_2']!="" && $row_select_pipe['dry_r2_2']!="0" && $row_select_pipe['dry_r2_2']!=null){echo $row_select_pipe['dry_r2_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r3_2']!="" && $row_select_pipe['dry_r3_2']!="0" && $row_select_pipe['dry_r3_2']!=null){echo $row_select_pipe['dry_r3_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r4_2']!="" && $row_select_pipe['dry_r4_2']!="0" && $row_select_pipe['dry_r4_2']!=null){echo $row_select_pipe['dry_r4_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r5_2']!="" && $row_select_pipe['dry_r5_2']!="0" && $row_select_pipe['dry_r5_2']!=null){echo $row_select_pipe['dry_r5_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r6_2']!="" && $row_select_pipe['dry_r6_2']!="0" && $row_select_pipe['dry_r6_2']!=null){echo $row_select_pipe['dry_r6_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_len_2']!="" && $row_select_pipe['dry_len_2']!="0" && $row_select_pipe['dry_len_2']!=null){echo $row_select_pipe['dry_len_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_shr_2']!="" && $row_select_pipe['dry_shr_2']!="0" && $row_select_pipe['dry_shr_2']!=null){echo $row_select_pipe['dry_shr_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_wtr_2']!="" && $row_select_pipe['dry_wtr_2']!="0" && $row_select_pipe['dry_wtr_2']!=null){echo $row_select_pipe['dry_wtr_2']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_moi_2']!="" && $row_select_pipe['dry_moi_2']!="0" && $row_select_pipe['dry_moi_2']!=null){echo $row_select_pipe['dry_moi_2']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">3</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_avg_3']!="" && $row_select_pipe['dry_avg_3']!="0" && $row_select_pipe['dry_avg_3']!=null){echo $row_select_pipe['dry_avg_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r1_3']!="" && $row_select_pipe['dry_r1_3']!="0" && $row_select_pipe['dry_r1_3']!=null){echo $row_select_pipe['dry_r1_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r2_3']!="" && $row_select_pipe['dry_r2_3']!="0" && $row_select_pipe['dry_r2_3']!=null){echo $row_select_pipe['dry_r2_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r3_3']!="" && $row_select_pipe['dry_r3_3']!="0" && $row_select_pipe['dry_r3_3']!=null){echo $row_select_pipe['dry_r3_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r4_3']!="" && $row_select_pipe['dry_r4_3']!="0" && $row_select_pipe['dry_r4_3']!=null){echo $row_select_pipe['dry_r4_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r5_3']!="" && $row_select_pipe['dry_r5_3']!="0" && $row_select_pipe['dry_r5_3']!=null){echo $row_select_pipe['dry_r5_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_r6_3']!="" && $row_select_pipe['dry_r6_3']!="0" && $row_select_pipe['dry_r6_3']!=null){echo $row_select_pipe['dry_r6_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_len_3']!="" && $row_select_pipe['dry_len_3']!="0" && $row_select_pipe['dry_len_3']!=null){echo $row_select_pipe['dry_len_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_shr_3']!="" && $row_select_pipe['dry_shr_3']!="0" && $row_select_pipe['dry_shr_3']!=null){echo $row_select_pipe['dry_shr_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_wtr_3']!="" && $row_select_pipe['dry_wtr_3']!="0" && $row_select_pipe['dry_wtr_3']!=null){echo $row_select_pipe['dry_wtr_3']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['dry_moi_3']!="" && $row_select_pipe['dry_moi_3']!="0" && $row_select_pipe['dry_moi_3']!=null){echo $row_select_pipe['dry_moi_3']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td colspan="9" style="border: 1px solid black; text-align:right;">Average &nbsp; &nbsp;</td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avg_dry_shr']!="" && $row_select_pipe['avg_dry_shr']!="0" && $row_select_pipe['avg_dry_shr']!=null){echo $row_select_pipe['avg_dry_shr']; }else{echo " <br>";}  ?></td>
					<td style="border: 1px solid black; text-align:center;"></td>
					<td style="border: 1px solid black; text-align:center;"><?php if($row_select_pipe['avg_moi']!="" && $row_select_pipe['avg_moi']!="0" && $row_select_pipe['avg_moi']!=null){echo $row_select_pipe['avg_moi']; }else{echo " <br>";}  ?></td>
				</tr>
		</table> -->
		


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
		
	
<!-- <script type="text/javascript">
window.print();
</script> -->