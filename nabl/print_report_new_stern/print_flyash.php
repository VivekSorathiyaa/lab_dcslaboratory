	 <?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
		transform: scale(.7);
	}

	@media print {
		#header_hide_show {
			display: none !important;
		}
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 11.5px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 10px;
		font-family : Calibri;
	}

	div.vertical-sentence {
		-ms-writing-mode: tb-rl;
		/* for IE */
		-webkit-writing-mode: vertical-rl;
		/* for Webkit */
		writing-mode: vertical-rl;

	}

	.rotate-characters-back-to-horizontal {
		-webkit-text-orientation: upright;
		/* for Webkit */
		text-orientation: upright;
	}

	select {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		border: none;
		/* If you want to remove the border as well */
		background: none;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from fly_ash WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 and `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
	}


	if ($row_select["agency_name"] != "") {
		$agency_name = $row_select['agency_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];
		$issue_date = $row_select2['issue_date'];
		$rec_sample_date = $row_select2['receive_date'];
		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
					
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$grade = $row_select4['cement_grade'];
		$type_of_cement = $row_select4['type_of_cement'];
		$cement_brand = $row_select4['cement_brand'];
		$week_number = $row_select4['week_number'];
	}
	
	
	$first_tag = $row_select['first_tag'];
				$second_tag = $row_select['second_tag'];
				$third_tag = $row_select['third_tag'];
				$fourth_tag = $row_select['fourth_tag'];
				
				$first_txt = $row_select['first_txt'];
				$second_txt = $row_select['second_txt'];
				$third_txt = $row_select['third_txt'];
				$fourth_txt = $row_select['fourth_txt'];
				
				
				?>
	
	

		<page size="A4">
		
		<div id="header" style="text-align: center;margin: 0 auto;padding-top:10px;">
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		</div>
			
		<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">TEST CERTIFICATE - Fly Ash</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
							<td style="width: 14%;padding: 0 2px;text-align: right;">&nbsp;Sample ID No :-</td>
							<td style="width: 62.4%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $lab_no; ?></td>
							<td style="text-align: center;border-left: 1px solid;text-align: right;">&nbsp;Report Date :-</td>
							<td style="padding: 0 2px;text-align: center;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
						</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Report No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $report_no; ?></td>
							<?php if(strlen($row_select_pipe['ulr'])>15){?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;ULR No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;<?php echo $row_select_pipe['ulr']; ?></td>
							<?php }else{?>
							<td style="border-bottom: 1px solid;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;</td>
							<?php }?>
						</tr>
					<!--STATIC AMENDMENT NO AND DATE-->
					<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment No :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp;--</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Group :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Building Materials</td>
						</tr>
						<tr>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Amendment Date :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;">&nbsp; --</td>
							<td style="border-bottom: 1px solid;text-align: right;border-left: 1px solid;">&nbsp;Discipline :-</td>
							<td style="border-bottom: 1px solid;padding: 0 2px;text-align: center;border-left: 1px solid;">&nbsp;Mechanical</td>
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
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;width: 24.9%;font-weight: bold;">&nbsp;Customer Name & Address :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $clientname; ?></td>
							</tr>
						<?php
						}
						if ($agency_name != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agency Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agency_name; ?></td>
							</tr>
						<?php }
						if ($row_select['tpi_name'] != "") {
						?>

							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Consultants :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
							</tr>
						<?php
						}
						if ($agreement_no != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Agreement No :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $agreement_no; ?></td>
							</tr>
						<?php
						}
						if ($name_of_work != "") {
						?>
							<tr>
								<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;font-weight: bold;">&nbsp;Project Name :-</td>
								<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
							</tr>
						<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;width:26%;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
					</tr>
					
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Received Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: center;width:4%;">&nbsp;To</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
					</tr>
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Type Of Cement :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['type_of_cement'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cement_grade'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Brand :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['cement_brand'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Week No. :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['week_number'];?></td>
					</tr>-->
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Enrter Quantity :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php //echo $row_select4['steel_sample_qty'];?></td>
					</tr>-->
					
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Dia (mm) :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['steel_dia'];?></td>
					</tr>-->
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mark :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $mark; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Class :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['brick_specification'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 0px solid;padding: 0 2px;text-align: right;">&nbsp;Size :-</td>
						<td style="border-bottom: 0px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $row_select4['brick_size'];?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: right;">&nbsp;Mill Heat No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;</td>
					</tr>-->
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				
				</table>
				
			</td>
		</tr>
	</table>
			
			
		<table align="center" width="100%" class="test" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri; border:1px solid black; ">
			<tr style="text-align:center;">
				<td style="border:1px solid black;border-left:0px solid black;width:4%;" rowspan="2"><b>Sr.<br>No.</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:22%;" rowspan="2"><b>Name Of Test</b></td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;" rowspan="2"><b>Method of Test</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;" ><b>Result Obtained</b></td>
				<td style="border:1px solid black;border-left:0px solid black;width:12%;" rowspan="2"><b>Limits As Per <br>(IS 3812 Part 1): <br>2013   </b></td>
			</tr>
			<tr style="text-align:center;">
			
				<td style="border:1px solid black;border-left:0px solid black;width:10%;"><b>Fly Ash Mix</b></td>
			</tr>
			<!-- data add Pending [static] -->
			<?php 
			$cnt=1;
			if($row_select_pipe['ss_area']!="" && $row_select_pipe['ss_area']!="NaN" && $row_select_pipe['ss_area']!=null && $row_select_pipe['ss_area']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 4px;">Fineness Specific Surface by Blaims Permeability Method</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align: center;">IS 1727:1967 </td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php echo $row_select_pipe['ss_area']; ?>&nbsp;m<sup>2</sup>/kg</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;">Min. 320&nbsp;m<sup>2</sup>/kg</td>

			</tr>
			<?php 
			}
			if($row_select_pipe['avg_fbs']!="" && $row_select_pipe['avg_fbs']!="NaN" && $row_select_pipe['avg_fbs']!=null && $row_select_pipe['avg_fbs']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 4px;" >Particle retained on 45 mic.</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;" rowspan="2">IS 1727:1967</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"></td>
			</tr>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 4px;">a).Retained on 45 μ</td>
				
			
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php echo $row_select_pipe['avg_fbs']; ?>&nbsp;%</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;">Max 34 %</td>
			</tr>
			<?php 
			}
			if($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="NaN" && $row_select_pipe['soundness']!=null && $row_select_pipe['soundness']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding: 0 4px;">Soundness (by. Autoclave Method)</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;">IS 4031 (Part-3): 1988 </td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php
																											echo $row_select_pipe['soundness']; ?> %</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;">Max 0.8 %</td>
			</tr>
			<?php 
			}
			if($row_select_pipe['density']!="" && $row_select_pipe['density']!="NaN" && $row_select_pipe['density']!=null && $row_select_pipe['density']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 4px;">Specific Gravity</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;">IS 4031 (Part-11): 1988 </td>
			
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php
																											echo $row_select_pipe['density']; ?> %</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;">-</td>

			</tr>
			<?php 
			}
			if($row_select_pipe['initial_time']!="" && $row_select_pipe['initial_time']!="NaN" && $row_select_pipe['initial_time']!=null && $row_select_pipe['initial_time']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 4px;">Initial Setting Time</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"> IS 4031(Part-5): 1988 </td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php
																											echo $row_select_pipe['initial_time']; ?>&nbsp;min</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"></td>

			</tr>
			<?php 
			}
			if($row_select_pipe['final_time']!="" && $row_select_pipe['final_time']!="NaN" && $row_select_pipe['final_time']!=null && $row_select_pipe['final_time']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 4px;">Final Setting Time</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"> IS 4031(Part-5): 1988 </td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php
																											echo $row_select_pipe['final_time']; ?>&nbsp;min</td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"></td>

			</tr>
			<?php 
			}
			if($row_select_pipe['avg_com_2']!="" && $row_select_pipe['avg_com_2']!="NaN" && $row_select_pipe['avg_com_2']!=null && $row_select_pipe['avg_com_2']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;"><?php echo $cnt++;?></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding-left: 3px;" colspan="6">Compressive Strength &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;

					<span style="font-weight: bold;">Doc- &nbsp;&nbsp;&nbsp;<?php echo date('d-m-Y',strtotime($row_select_pipe['caste_date1']));?></span>&nbsp;&nbsp;
				</td>
			</tr>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;" rowspan="2"></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding: 0 2px;" rowspan="2">a) 168 &plusmn; 2Hrs (<?php echo date('d-m-Y',strtotime($row_select_pipe['test_date2']));?>)</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;" rowspan="4">IS 1727:1967 </td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php echo $row_select_pipe['avg_com_2']; ?>&nbsp;N/mm<sup>2</sup></td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;" rowspan="4">Not less then 80% of <br> the strength of <br>
					corresponding plain <br> cement mortar cubes</td>
			</tr>
			<tr style="text-align:left;height: 20px;">
			
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php $c1= $row_select_pipe['avg_com_1'] * 100 / $row_select_pipe["avg_com_2"];  echo number_format($c1,2);?>&nbsp;%</td>
			</tr>
				<?php 
			}
			if($row_select_pipe['avg_com_4']!="" && $row_select_pipe['avg_com_4']!="NaN" && $row_select_pipe['avg_com_4']!=null && $row_select_pipe['avg_com_4']!="0"){?>
			<tr style="text-align:left;height: 20px;">
				<td style="border:1px solid black;border-left:0px solid black;width:6%;text-align:center;" rowspan="2"></td>
				<td style="border:1px solid black;border-left:0px solid black;width:10%;padding: 0 2px;" rowspan="2">b) 672 &plusmn; 4Hrs (<?php echo date('d-m-Y',strtotime($row_select_pipe['test_date4']));?>)</td>
				
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php echo $row_select_pipe['avg_com_4']; ?>&nbsp;N/mm<sup>2</sup></td>
				
			</tr>
			<tr style="text-align:left;height: 20px;">
			
				<td style="border:1px solid black;border-left:0px solid black;width:10%;text-align:center;"><?php $c = $row_select_pipe['avg_com_3'] * 100 / $row_select_pipe["avg_com_4"];  echo number_format($c,2);?>&nbsp;%</td>

			</tr>
			<?php 
			}
			?>
		</table>
		
		
			                                                    
		
		
	
		<!-- footer design -->
		
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
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

<!--
		</td>
		</tr>
		</table>
			<?php if($row_select_pipe['rem_data']!="" && $row_select_pipe['rem_data']!=null){?>
		<table align="center" width="100%" style="font-family:Times New Roman;">
			<tr style="border: 0px solid black;height:20px;">
						
				<td style="border-bottom: 0px solid black;border-right: 0px solid black;font-size:11px;">&nbsp;&nbsp;<b> Remarks:</b>  <?php echo $row_select_pipe['rem_data'];?></td>
			
			</tr>
		</table>
			<?php }?>
		<table align="center" width="92%" style="font-family:Times New Roman;">
			<tr>
				<td style="width:40%;">
					<div style="">
						
					</div>
				</td>
				<td style="width:60%;">
					<div style="">
						<b style="font-size:11px;">&#x2022;&#x2022; END OF REPORT &#x2022;&#x2022;</b>
					</div>
				</td>
			</tr>
			<tr>
				<td style="width:40%;">
					<div style="">
						<b style="font-size:11px;">Page: 1 of 1</b>
					</div>
				</td>
				<td style="width:60%;">
					<div style="">
						
					</div>
				</td>
			</tr>
		</table>
		</td></tr>
</table>
	-->	
			<div id="footer" style="text-align: center; position: fixed;bottom: 0px;margin: 0 auto;">
			
		</div>
		</page>
</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
		if (document.querySelector('#header_hide_show').checked) {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" >');
			document.getElementById('footer').innerHTML = '';
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/footer.png" >');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '');
			document.getElementById('footer').innerHTML = '';
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}

	function header_2() {
		if (document.querySelector('#header_hide_show_2').checked) {
			document.getElementById('header_2').innerHTML = '';
			document.getElementById("header_2").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="150px">');
			document.getElementById("footer_2").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign_2').innerHTML = '';
			document.getElementById("sign_2").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else {
			document.getElementById('header_2').innerHTML = '';
			document.getElementById("header_2").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer_2").innerHTML = '';
			document.getElementById('sign_2').innerHTML = '';
			document.getElementById("sign_2").insertAdjacentHTML("afterbegin", '<img src="../../images/stamp.png" width="160px">');
		}
	}


	
	
	
	function put_details(){
		var get_data = document.getElementById('details_of_sample').value;
		document.getElementById('put_details').innerHTML = get_data;
		 var d = document.getElementById("put_details");
            d.remove(d.selectedIndex);
	}
</script>