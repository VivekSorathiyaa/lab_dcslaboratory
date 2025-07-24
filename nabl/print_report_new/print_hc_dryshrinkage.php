<?php 
session_start();
include("../connection.php");
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
		
		
	<page size="A4" >
		<table align="center" width="100%" class="test"  style="font-size:10px;font-family:Cambria;margin-top:80px;border-bottom:0px solid black;" cellpadding="5px">
			    <tr>
					<td style="text-align:center; font-size:15px;padding-bottom:8px; text-decoration: underline; text-underline-offset: 3px;padding-top:0px;"><b>Test Report</b></td>
				</tr>
				<tr>
					<td style="text-align:center; font-size:15px;padding-bottom:15px; text-decoration: underline; text-underline-offset: 3px;padding-top:0px;"><b>Drying Shrinkage of Concrete</b></td>
				</tr>

			<tr>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">
					<tr style="">
						<td style="width:12%;padding-bottom: 4px;">Discipline/Group</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;">&raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;">Mechanical-Buildings Material</td>
						<td style="width:21%;padding-bottom: 4px;"> 
						<!-- <?php if ($row_select_pipe['ulr'] != "" && $row_select_pipe['ulr'] != "0" && $row_select_pipe['ulr'] != null) {
																echo "ULR No.  " . $row_select_pipe['ulr'];  
															} ?> -->
							<?php echo "ULR No.  " . $_GET['ulr']; ?>
						</td>
					</tr>

					<tr style="">
						<td style="width:6%;padding-bottom: 4px;">Sample ID No.</td>
						<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $sample_id_no;?></td>
						<td style="width:0%;padding-bottom: 4px;;text-align:left;"> Date of Report</td>
						<td style="width:6%;padding-bottom: 4px;text-align:center;"> &raquo;</td>
						<td style="width:40%padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($issue_date)); ?></td>
					</tr>
					<tr style="">
						<td style="width:6%;padding-bottom: 6px;">Report Ref No</td>
						<td style="width:6%;padding-bottom: 6px;text-align: center;"> &raquo;</td>
						<td style="width:40%;text-align:left;padding-bottom: 6px;"><?php echo $report_no; ?></td>
					</tr>
				</table>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;">

						<?php
						if ($clientname != "") {
						?>
							<tr>
							    <td style="width:12%;padding-bottom: 4px;padding-top: 14px;">Customer</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;padding-top: 14px;"> &raquo;</td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;padding-top: 14px;"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																					$result_selectc = mysqli_query($conn, $select_queryc);

																					if (mysqli_num_rows($result_selectc) > 0) {
																						$row_selectc = mysqli_fetch_assoc($result_selectc);
																						$ct_nm = $row_selectc['city_name'];
																					}
																					echo $clientname; ?>
								</td>
							</tr>
					
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
							<td style="width:12%;padding-bottom: 4px;">Name of Work</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $name_of_work; ?>
								</td>
							</tr>

						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agency</td>
								<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $agency_name; ?>
								</td>
							</tr>
							
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom: 4px;">Agg No.</td>
								<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"> <?php echo $agreement_no; ?></td>
							</tr>


						<?php
						}
						if ($r_name != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:4px;">Reference No.</td>
								<td style="width:6%;text-align: center;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom: 4px;"><?php echo $r_name; ?></td>
							</tr>

						<?php
						}
						if ($row_select['pmc_name'] != "") {
						?>
							<tr>
								<td style="width:12%;padding-bottom:14px;"><?php echo $row_select['pmc_heading']; ?></td>
								<td style="width:6%;text-align: center;padding-bottom:14px;"> &raquo; </td>
								<td style="width:82%;text-align:left;padding-bottom:14px;"><?php echo $row_select['pmc_name']; ?>
								</td>
							</tr>


						<?php
						}
						?>
					</table>
				</td>
			</tr>

			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" class="test" style="font-size:10px;font-family: Cambria;border-bottom:1px solid;padding: 4px 0;margin-bottom:4px;    border-collapse: inherit;">
					    <tr>
							<td style="width:12%;padding-bottom: 4px;">Letter No. & Date</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;text-align:left;padding-bottom: 4px;"></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;"></td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"></td>
							<td style="width:40%;padding-bottom: 4px;"></td>
						</tr>

						<tr>
							<td style="width:12%;padding-bottom: 4px;">Size of Sample</td>
						    <td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
						    <td style="width:40%;text-align:left;padding-bottom: 4px;"><?php echo $paver_size; ?></td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Started</td>
							<td style="width:6%;padding-bottom: 4px;text-align: center;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($start_date)); ?></td>
						</tr>

						<tr>
						    <td style="width:12%;padding-bottom: 4px;">Method Of Test</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo; </td>
							<td style="width:40%;font-size: 10px;text-align:left;padding-bottom: 4px;">IS 516 Part-6 RA 2020</td>
							<td style="width:21%;padding-bottom: 4px;text-align:right;">Test Completed</td>
							<td style="width:6%;text-align: center;padding-bottom: 4px;"> &raquo;</td>
							<td style="width:40%;padding-bottom: 4px;"><?php echo date('d - m - Y', strtotime($end_date)); ?></td>
						</tr>
					</table>
				</td>
			</tr>
		</table>

		<?php $cnt = 1; ?>
		<table align="center" width="100%" class="test"  style="font-size:10px;font-family: Cambria;border-bottom:1px solid;border-right:1px solid;margin-top:20px;" cellpadding="5px">
				<tr>
					<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sr No.</b></td>
					<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Date of Casting</b></td>
					<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Sample ID</b></td>
					<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>ID Mark/Location*</b></td>
					<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Grade of Concrete*</b></td>
					<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;"><b>Test Result (%)</b></td>
				</tr>
				<tr>
					<td width="5%" style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['top_grade']; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['dry_shr_1']!="" && $row_select_pipe['dry_shr_1']!="0" && $row_select_pipe['dry_shr_1']!=null){echo $row_select_pipe['dry_shr_1']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['top_grade']; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['dry_shr_2']!="" && $row_select_pipe['dry_shr_2']!="0" && $row_select_pipe['dry_shr_2']!=null){echo $row_select_pipe['dry_shr_2']; }else{echo " <br>";}  ?></td>
				</tr>
				<tr>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $cnt++; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['cc_identification_mark']; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php echo $row_select_pipe['top_grade']; ?></td>
					<td style="font-size:10px;text-align:center;border-left:1px solid black;border-top:1px solid black;padding:5px 4px;"><?php if($row_select_pipe['dry_shr_3']!="" && $row_select_pipe['dry_shr_3']!="0" && $row_select_pipe['dry_shr_3']!=null){echo $row_select_pipe['dry_shr_3']; }else{echo " <br>";}  ?></td>
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
		


		<table cellpadding="0" cellpadding="0" align="center" width="100%" style="font-size:11px;font-family: Cambria;" class="test">
				<tr>
					<td style="width:60%;text-align:center;font-weight:bold;padding:7px 0px 7px;">
							** End of Report ** 
					</td>																		
				</tr>
		</table>

		<table align="center" width="100%" class="test">
			<tr>
					<td style="text-align:center;font-size:10px;">
						<table align="center" width="100%" class="test" style="height:auto;font-family: Cambria;border-top:1px solid black;border-bottom:1px solid black;">
							<tr>
								<td><b>Note :-</b></td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;width:50%;padding:3px 0;"> 1. &nbsp;The results are given only for the sample submitted by the Customer/Agency.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;"> 2. &nbsp;The test report shall not be reproduced except in full , Without written approval of the laboratory.</td>
								<td></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">3. &nbsp;Manglam Consultancy services is not responsible for any kind of interpretation of test results.</td>
								<td style="text-align:center;width:15%;font-style:italic;font-size:11px;"><b>Reviewed & Authorized By</b></td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">4. &nbsp;The Results/Report are not used for publicity.</td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">5. &nbsp;*As informed by Customer/Agency.</td>
							</tr>
							<tr>
								<td style="font-size:10px;padding:3px 0;">6. &nbsp;Requirement will be check as per IS 9103 if use of plasticizer super plasticizer, super plasticizer or any.</td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>(D.H.Shah/M.D.Shah)</b></td>
							</tr>
							<tr>
							<td style="font-size:10px;padding:3px 0;font-weight:bold;">&nbsp;Witness By : </td>
								<td style="text-align:center;font-style:italic;font-size:11px;"><b>Director/TM</b></td>
							</tr>
						</table>
					</td>
			</tr>
		</table>

		<table width="100%" align="center" style="font-family:Cambria;font-size:10px;">
							<tr>
								<td style="width:40%;text-align:right;font-weight:bold;font-style:italic;font-size:11px;">
									Doc ID : FMT-TST-28/ Page 1/1
								</td>
							</tr>
		</table>
			
		</page>
	</body>
</html> 
		
	
<!-- <script type="text/javascript">
window.print();
</script> -->