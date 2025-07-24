<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
<style>
	@page {
		margin: 0 30px; 
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
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
		font-size: 12px;
		font-family : Calibri;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family : Calibri;
	}

	.tdclass1 {

		font-size: 12px;
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
	function round_up($number, $precision = 0)
	{
		$fig = (int) str_pad('1', $precision, '0');
		return (ceil($number * $fig) / $fig);
	}
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from rcpt WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$identification_mark = $row_select_pipe['identification_mark'];
	$amend_date = $row_select_pipe['amend_date'];
	
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	$page_cont = round_up($no_of_rows / 7);

	$ans = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$r_date = $row_select['date'];
	$agSTCment_no = $row_select['agSTCment_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$branch_name = $row_select['branch_name'];
	if ($cons == 0) {
		$con_sample = "Sealed";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
	}
	?>
	<br><br><br>
	<page size="A4">
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
				<td style="font-weight: bold;padding: 5px;width:30%;">FMT-OBS-058</td>
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
				<td style="padding: 5px;border-left: 1px solid;" colspan="3">ASTM C 1202-2019</td>
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
			
		<!-- Rapid Chloride penetration Test -->
			<!-- Table start -->

			<table align="center" width="100%" class="test1">
				<tr style="border: 1px solid black;border-top: 0;">
					<td style="border-left:1px solid;width:60%;text-align:left; ppadding:5px 0px;"><b>&nbsp;Grade of concrete/core</b></td>
					<td style="border-left:1px solid;width:40%;text-align:left;padding:5px 0px;"><b>&nbsp; <?php echo $row_select_pipe['cube_grade'];?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;width:60%;text-align:left;padding:5px 0px;"><b>&nbsp;Date of casting of concrete/core</b></td>
					<td style="border-left:1px solid;width:40%;text-align:left; padding:5px 0px;"><b>&nbsp; <?php echo date("d/m/Y",strtotime($row_select_pipe['casting_date']));?></b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;width:60%;text-align:left;padding:5px 0px; "><b>&nbsp;Source of concrete/core</b></td>
					<td style="border-left:1px solid;width:40%;text-align:left;padding:5px 0px;"><b>&nbsp; R.C.P.T</b></td>
				</tr>

			</table>
			<br>
			<table align="center" width="100%" class="test1">
				<tr>
					<td><b>Calculation</b></td>
				</tr>
				<tr>
					<td style="padding-bottom:5px;">
						<b>
							Q<sub>x</sub>=900 (I<sub>0</sub>+ 2 I<sub>30</sub> + 2 I<sub>60</sub> + 2 I<sub>90</sub> + 2 I<sub>120.............</sub>+ 2 I<sub>300</sub> + 2 I<sub>360</sub>)
						</b>
					</td>
				</tr>
				<tr>
					<td style="padding-bottom:5px;"><b>Where, Q<sub>x</sub>= Chloride ion permeability (Charge Passed) coulombs</b></td>
				</tr>
				<tr>
					<td style="padding-left: 45px;padding-bottom:5px;"><b>I<sub>0</sub> to I<sub>360</sub>= Current passed from time 0 to 360 minutes </b></td>
				</tr>
				<tr>
					<td style="padding-bottom:5px;"><b>Q <sub>s</sub> = Q <sub>x</sub> X (95/x)²</b></td>
				</tr>
				<tr>
					<td style="padding-bottom:5px;"><b>Where, Qs = Corrected Penetrability (Charged Passed) As per Clause 11.2 ASTM C1202-17*</b></td>
				</tr>
				<tr>
					<td style="padding-bottom:5px;"><b>Q<sub>x</sub>= Chloride ion permeability (Charge Passed) coulombs</b></td>
				</tr>
				<tr>
					<td style="padding-bottom:5px;"><b>x = Diameter of the non standard core (i.e. other than 95 mm)</b></td>
				</tr>
			</table>

			<br>

			<table align="center" width="100%" class="test" style="border: 1px solid black;" cellpadding="5px">
				<tbody>
					<tr>
						<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr <br> No.</b></td>
						<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>ID Mark</b></td>

						<td width="10%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Date of <br> Testing </b></td>
						<td colspan="2" style="border: 1px solid black; text-align:center;"><b>Size Of Core <br> In mm</b></td>
						<td width="15%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Chloride Ion <br> Penetrability <br> (Charged Passed) <br> coulombs (Q<sub>x</sub>)</b></td>
						<td width="20%" rowspan="2" style="border: 1px solid black; text-align:center;"><b>Corrected Penetrability <br> (Charged Passed) <br> As per Clause 11.2 <br> ASTM C1202-12* (Q <sub>s</sub>)</b></td>
					</tr>
					<tr>
						<td width="10%" style="border: 1px solid black; text-align:center;"><b>Dia.</b></td>
						<td width="10%" style="border: 1px solid black; text-align:center;"><b>Height</b></td>
					</tr>
					<?php
						$select_tilesy = "select * from rcpt WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id`";
						$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
						// $coming_row = mysqli_num_rows($result_tiles_select1);	
						$count=1;
						$flag=1;
						$c=0;
						$sum=0;
						
						if(mysqli_num_rows($result_tiles_select1)>0){
						while ($row_select_pipe = mysqli_fetch_assoc($result_tiles_select1)) {
							$c++;
							$sum += floatval($row_select_pipe['cip_2']);
						?>
					<tr>
						<td style="border: 1px solid black; text-align:center;"><?php echo $count++;?></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['identification_mark'];?></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo date("d/m/Y",strtotime($end_date)); ?></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['dia1'];?></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['height1'];?></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['cip_1'];?></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo $row_select_pipe['cip_2'];?></td>
					</tr>
					<?php
							
						}
						}

						?>
					<tr>
						<td style="border: 1px solid black; text-align:right;" colspan="6"><b>Average</b></td>
						<td style="border: 1px solid black; text-align:center;"><?php echo $sum/$c; ?></td>
					</tr>
				</tbody>
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
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">Amend Date :- <?php echo date('d-m-Y', strtotime($amend_date)); ?></td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Quality Manager)</td>
				<td style="font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">(Chief Executive Officer)</td>
			</tr>
			<tr>
				<td colspan="4" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 1</td>
			</tr>
			
		</table>
	</page>
	
	
	<!--input type="checkbox" style="width:30px; height:30px" id="header_hide_show" onclick="header()"-->
	<!--<page size="A4">

		<div id="header">
			<br>
			<br>
		</div>

		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;margin-left:35px; ">
			<tr>
				<td style="text-align:center; font-size:20px; "><b>TEST REPORT</b></td>
			</tr>
		</table>
		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border:1px solid black;margin-left:35px; ">

			<tr style="border: 1px solid black;height:20px;">
				<td width="30%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($row_select_pipe1['ulr'] != "" && $row_select_pipe1['ulr'] != "0" && $row_select_pipe1['ulr'] != null) {
																							echo "<b>ULR:</b> " . $row_select_pipe1['ulr'];
																						} ?></td>

				<td width="65%" style="text-align:right; margin:15px;border-bottom: 1px solid black;  "><?php if ($report_no != "" && $report_no != "0" && $report_no != null) {
																											echo " " . $report_no;
																										} ?><b>&nbsp;/&nbsp;Date:</b> <?php echo date('d-m-Y', strtotime($issue_date)); ?>&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Report Submited To </b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																						$result_selectc = mysqli_query($conn, $select_queryc);

																						if (mysqli_num_rows($result_selectc) > 0) {
																							$row_selectc = mysqli_fetch_assoc($result_selectc);
																							$ct_nm = $row_selectc['city_name'];
																						}
																						echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Name of <span id="put_details"></span><select style="font-weight:bold;border:0px;font-size:11px;" onchange="put_details()" id="details_of_sample">
							<option>Work</option>
							<option>Project</option>
						</select></b></td>
				<td colspan="2" style="border-bottom: 1px solid black;padding-left:10px ">&nbsp;&nbsp;<?php echo $name_of_work; ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:Auto;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Detailes of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo "Concrte Core"; ?> </td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Reference Letter No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php
																						echo $r_name . " Date:" . date('d/m/Y', strtotime($row_select2["letter_date"]));

																						?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Date of Receipt of Sample</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date('d/m/Y', strtotime($rec_sample_date)); ?> </td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Condition of Sample during receipt</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php if ($cons == "1") {
																							echo "Sealed";
																						} elseif ($cons == "2") {
																							echo "Unsealed";
																						} elseif ($cons == "3") {
																							echo "Good";
																						} elseif ($cons == "4") {
																							echo "Poor";
																						} else {
																							echo "Sealed";
																						} ?> </td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp; <b> Name of Agency</b></td>
				<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																						$result_selectc1 = mysqli_query($conn, $select_queryc1);

																						if (mysqli_num_rows($result_selectc1) > 0) {
																							$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																							$ct_nm1 = $row_selectc1['city_name'];
																						}
																						echo $agency_name . " " . $ct_nm1; ?> </td>
			</tr>
			<?php if ($agSTCment_no != "") { ?>
				<tr style="border: 1px solid black;height:20px;">
					<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Aggrement No.</b></td>
					<td colspan="3" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $agSTCment_no; ?></td>
				</tr>
			<?php } ?>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Job No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $job_no; ?></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Lab No.</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php


																						echo $lab_no;
																						?></td>
			</tr>
			<?php
			$first_tag = $row_select['first_tag'];
			$second_tag = $row_select['second_tag'];
			$third_tag = $row_select['third_tag'];
			$fourth_tag = $row_select['fourth_tag'];

			$first_txt = $row_select['first_txt'];
			$second_txt = $row_select['second_txt'];
			$third_txt = $row_select['third_txt'];
			$fourth_txt = $row_select['fourth_txt'];
			if ($first_tag != null && $first_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $first_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $first_txt; ?></td>
				</tr>
			<?php }
			if ($second_tag != null && $second_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $second_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $second_txt; ?></td>
				</tr>
			<?php }
			if ($third_tag != null && $third_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $third_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $third_txt; ?></td>
				</tr>
			<?php }
			if ($fourth_tag != null && $fourth_tag != "") { ?>
				<tr>
					<td style="border-bottom: 1px solid black;border-right: 1px solid black;height:20px;">&nbsp;&nbsp;<b><?php echo $fourth_tag; ?></b></td>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp;<?php echo $fourth_txt; ?></td>
				</tr>
			<?php } ?>



			<tr style="border: 1px solid black;height:20px;">
				<td width="35%" style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Starting Date of Test</b></td>
				<td width="20%" style="border-bottom: 1px solid black; border-right: 1px solid black;">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($start_date)); ?></td>
			</TR>
			<tr style="border: 1px solid black;height:20px;">
				<td width="25%" style="border-bottom: 1px solid black;border-right: 1px solid black; text-align:LEFT;">&nbsp;&nbsp;<b> Completion Date of Test &nbsp;</b></td>
				<td width="20%" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo date("d/m/Y", strtotime($end_date)); ?></td>
			</tr>

			<tr style="border: 1px solid black;height:20px;">
				<td style="border-bottom: 1px solid black;border-right: 1px solid black; ">&nbsp;&nbsp;<b> Sample Quantity:</b></td>
				<td colspan="2" style="border-bottom: 1px solid black; ">&nbsp;&nbsp; <?php echo $no_of_rows . " Nos."; ?></td>
			</tr>

			<!--<tr>
					<td colspan="3" style="border-bottom: 1px solid black;">&nbsp;&nbsp; Dear Sir. <br> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; With the refference to your above letter the test result of Concrete Cubes for compressive strength test for <?php //echo $row_select_pipe['day1'];
																																																																														?> Days as &nbsp; under. The sample are tested as per IS 516(Part 1/Sec 1):2021</td>				
				</tr>>
		</table>
		<br>


		<table align="center" width="92%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border:1px solid black;margin-left:35px; ">
			<tr>
				<td style="font-size:15px;text-align:center"><b><u>Test Result</u></b></td>
			</tr>
			<tr>
				<!--OTHER START>
				<td>
					<table align="center" width="95%" class="test" style="border: 1px solid black;font-size:11px;" cellpadding="3px">
						<tr>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Location of Core</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Weight (gm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Dia (mm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Height (mm)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Area (mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Ratio</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Volume (m<sup>3</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Density (Kg/m<sup>3</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Load (KN)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Compressive Strength (N/mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Diameter Correction</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>H/D Correction</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Corrected Comp. Strength</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b>Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>

						</tr>
						<?php
						$total_data = 0;
						$select_tiles_query = "select * from rcpt WHERE `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
						$result_tiles_select = mysqli_query($conn, $select_tiles_query);
						if (mysqli_num_rows($result_tiles_select) > 0) {
							while ($row_select_pipe = mysqli_fetch_array($result_tiles_select)) {
						?>
								<tr>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['location1'] != "" && $row_select_pipe['location1'] != "0" && $row_select_pipe['location1'] != null) {
																								echo $row_select_pipe['location1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['weight1'] != "" && $row_select_pipe['weight1'] != "0" && $row_select_pipe['weight1'] != null) {
																								echo $row_select_pipe['weight1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia1'] != "" && $row_select_pipe['dia1'] != "0" && $row_select_pipe['dia1'] != null) {
																								echo $row_select_pipe['dia1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['height1'] != "" && $row_select_pipe['height1'] != "0" && $row_select_pipe['height1'] != null) {
																								echo $row_select_pipe['height1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['area1'] != "" && $row_select_pipe['area1'] != "0" && $row_select_pipe['area1'] != null) {
																								echo $row_select_pipe['area1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_ratio1'] != "" && $row_select_pipe['hd_ratio1'] != "0" && $row_select_pipe['hd_ratio1'] != null) {
																								echo $row_select_pipe['hd_ratio1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['vol1'] != "" && $row_select_pipe['vol1'] != "0" && $row_select_pipe['vol1'] != null) {
																								echo $row_select_pipe['vol1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['den1'] != "" && $row_select_pipe['den1'] != "0" && $row_select_pipe['den1'] != null) {
																								echo $row_select_pipe['den1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load1'] != "" && $row_select_pipe['load1'] != "0" && $row_select_pipe['load1'] != null) {
																								echo $row_select_pipe['load1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com1'] != "" && $row_select_pipe['com1'] != "0" && $row_select_pipe['com1'] != null) {
																								echo $row_select_pipe['com1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dia_corr1'] != "" && $row_select_pipe['dia_corr1'] != "0" && $row_select_pipe['dia_corr1'] != null) {
																								echo $row_select_pipe['dia_corr1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['hd_corr1'] != "" && $row_select_pipe['hd_corr1'] != "0" && $row_select_pipe['hd_corr1'] != null) {
																								echo $row_select_pipe['hd_corr1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['corr_com1'] != "" && $row_select_pipe['corr_com1'] != "0" && $row_select_pipe['corr_com1'] != null) {
																								echo $row_select_pipe['corr_com1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>
									<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['eq_cube1'] != "" && $row_select_pipe['eq_cube1'] != "0" && $row_select_pipe['eq_cube1'] != null) {
																								echo $row_select_pipe['eq_cube1'];
																							} else {
																								echo "&nbsp;";
																							} ?></b></td>

								</tr>
						<?php
								$total_data += floatval($row_select_pipe['eq_cube1']);
							}
						}

						?>
						<tr>
							<td colspan="13" width="5%" style="border: 1px solid black; text-align:right;"><b>Average Equiv.Cube Strength (N/mm<sup>2</sup>)</b></td>
							<td width="5%" style="border: 1px solid black; text-align:center;"><b><?php
																									$ans = $total_data / $no_of_rows;
																									echo number_format($ans, 2);



																									?></b></td>

						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td style="text-align:center;width:33%;font-weight:bold;">*** END OF REPORT ***</td>
			</tr>
		</table>

		<br>
		<!--table align="center" width="92%"  class="test" style="border:1px solid black;font-family : Calibri;margin-left:35px; " >
			<tr>
				<td width="60px"><b style="">&nbsp; NOTE:- </b> </td>
				<td><p style="align:justify">[1]Test result related to sample collected by supplier. [2]Results/Report is issued with specific understanding the TMTL will not in any case be involved in action following the interpretation of test results. [3]The Reports/Results are not supposed to be used for publicity.  (4) This report can not be reproduced in full or part without written approval of Quality Manager/ Technical Manager.</p></td>
			</tr>
		</table>
		<br>
		<br>
		<table align="center" width="95%" style="font-family : Calibri;margin-left:35px;">
			<tr>
				<td style="">
					<div style="float:right;" id="footer">

					</div>
				</td>
				<td style="width:25%;">
					<div style="float:right; text-align:center; padding-right:60px;" id="sign">
						<img src="../images/stamp.png" width="160px">
					</div>
				</td>
			</tr>
		</table>
	</page>-->


</body>

</html>
<script src="jquery.min.js"></script>
<script type="text/javascript">
	function header() {
		if (document.querySelector('#header_hide_show').checked) {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<img src="../images/header.png" width="100%">');
			document.getElementById("footer").insertAdjacentHTML("afterbegin", '<img src="../images/stamp_tag.png" width="160px">');
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/sign.png" width="160px">');
		} else {
			document.getElementById('header').innerHTML = '';
			document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
			document.getElementById("footer").innerHTML = '';
			document.getElementById('sign').innerHTML = '';
			document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');
		}
	}

	function loading() {

		document.getElementById('header').innerHTML = '';
		document.getElementById("header").insertAdjacentHTML("afterbegin", '<br><br><br><br><br><br><br><br><br>');
		document.getElementById("footer").innerHTML = '';
		document.getElementById('sign').innerHTML = '';
		document.getElementById("sign").insertAdjacentHTML("afterbegin", '<img src="../images/stamp.png" width="160px">');

	}
</script>