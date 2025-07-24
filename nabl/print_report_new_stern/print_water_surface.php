<?php
include("../connection.php");
include("function_calling.php");
session_start();

error_reporting(1); ?>
<style>
	@page {
		margin: 0 40px;
	}

	.pagebreak {
		page-break-before: always;
	}

	page[size="A4"] {
		width: 21cm;
		height: 29.7cm;
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
	$select_tiles_query = "select * from water_surface WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);
	$no_of_rows = mysqli_num_rows($result_tiles_select);
	//$page_cont = round_up($no_of_rows / 5);
	//$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];

	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$agreement_no = $row_select['agreement_no'];

	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	$tpi_or_auth = $row_select['tpi_or_auth'];
	$pmc_heading = $row_select['pmc_heading'];
	if ($cons == 0) {
		$con_sample = "Sealed";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0 AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		 /* $mark= $row_select4['brick_mark'];
					$brick_specification= $row_select4['brick_specification']; */
					$in_l= $row_select4['in_l'];
					$in_w= $row_select4['in_w'];
					$in_h= $row_select4['in_h'];
					$in_den= $row_select4['in_den'];
					$in_grade= $row_select4['in_grade'];
					$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}
	
	?>


		<?php //if(($row_select_pipe['chloride_content'] != "" && $row_select_pipe['chloride_content'] != "0" && $row_select_pipe['chloride_content'] != null) || ($row_select_pipe['phv_avg_after'] != "" && $row_select_pipe['phv_avg_after'] != "0" && $row_select_pipe['phv_avg_after'] != null) || ($row_select_pipe['dmc_content'] != "" && $row_select_pipe['dmc_content'] != "0" && $row_select_pipe['dmc_content'] != null) || ($row_select_pipe['ash_content'] != "" && $row_select_pipe['ash_content'] != "0" && $row_select_pipe['ash_content'] != null) || ($row_select_pipe['avg_rdv'] != "" && $row_select_pipe['avg_rdv'] != "0" && $row_select_pipe['avg_rdv'] != null)){?>

<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">TEST REPORT - SURFACE WATER</td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 1px 0;" colspan="4"></td>
					</tr>
					<tr>
						<td style="width: 25%;padding: 0 2px;">&nbsp;Sample ID No :-</td>
						<td style="width: 34%;padding: 0 2px;border-left: 1px solid;">&nbsp;<?php echo $sample_id; ?></td>
						<td style="text-align: left;border-left: 1px solid;">&nbsp;Report Date :-</td>
						<td style="padding: 0 2px;text-align: left;border-left: 1px solid;">&nbsp;<?php echo date('d/m/Y', strtotime($issue_date)); ?></td>
					</tr>
				</table>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;border-top: 0;border-bottom: 0;">
					<tr>
						<td style="width: 25%;border-bottom: 1px solid;padding: 0 2px;">&nbsp;Report No :-</td>
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
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:25%;">&nbsp;Customer Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;width:34%;">&nbsp;<?php echo $clientname; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:16%;">&nbsp;Received Material :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo $mt_name; ?> 	</td>
					</tr>
					<?php
						}
						if ($client_address != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;width:25%;">&nbsp;Customer Address :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;width:34%;">&nbsp;<?php echo $client_address; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Received Sample Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date));?></td>
					</tr>
					<?php
						}
						if ($agency_name != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agency Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $agency_name; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Condition :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $con_sample; ?></td>
					</tr>
						
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Consultants :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $row_select['tpi_name']; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $source; ?></td>
					</tr>
					<?php
						 }
						if ($agreement_no != "") {
						?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Agreement No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $agreement_no; ?></td>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Testing Date :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($start_date)); ?></td>
					</tr>
					
					<?php } ?>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Letter Reference No :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="">&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;<?php
																									if ($row_select["date"] != "" && $row_select["date"] != "null" && $row_select["date"] != "0000-00-00"  && $row_select["date"] != "1970-01-01" ) {
																									?>Date: <?php echo date('d/m/Y', strtotime($row_select["date"]));
																									} else {
																									}
							?>
</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 0px solid;text-align: left;width:4%;">&nbsp;Sample End Date </td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;">&nbsp;<?php echo date('d/m/Y', strtotime($end_date)); ?></td>
						
					</tr>
					
					<tr>
						
					</tr>
					<tr>
						
					</tr>
					<tr>
						
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Project Name :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;border-right: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $name_of_work; ?></td>
						
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

	<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-left:2px solid; border-right:2px solid;border-top: 0;">
			<tr>
				<td  colspan="5"  style="border: 0px solid black; font-weight:bold; text-align:center;border-bottom: 1px solid black;"> RESULT TABLE</td>	
				
			</tr>
	</table>
	<?php $cnt=1;?>
	<table align="center" width="98%" class="test" style="font-size:11px;font-family : Calibri;border-top:0px solid;border-bottom:1px solid;border-right:2px solid; ">
				<tr>
					<td style="font-size:11px;border: 1px solid black;border-top: 0px;border-left: 2px solid black;padding:1px;"colspan="7"></td>
				</tr>
				<tr>
					<td style="border-top:0px solid;font-size:11px;border-left: 2px solid black;text-align:center;font-weight:bold;padding:10px 4px;"rowspan="2">Sr. No.</td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;"rowspan="2">Test Name</td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;"rowspan="2">Method of test</td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;"rowspan="2">Results </td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;"rowspan="2">Unit</td>
					<td style="border-top:0px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:10px 4px;"colspan="2">Requirements as per IS: 10500</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;border-left: 1px solid black;text-align:center;padding:1px;">Acceptable  Limit (Max.)</td>
					<td style="font-size:11px;border: 1px solid black;border-left: 1px solid black;text-align:center;padding:1px;">Permissible Value in<br>absence of alternate source (Max.)</td>
				</tr>
				<tr>
					<td style="font-size:11px;border: 1px solid black;border-left: 2px solid black;padding:1px;"colspan="7"></td>
				</tr>
				<?php if($row_select_pipe['avgp'] != "" && $row_select_pipe['avgp'] != "0" && $row_select_pipe['avgp'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">pH at 25 °C</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-11) 2022</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgp']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">-</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">6.5-8.5</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"> No relaxation</td>
				</tr>
				<?php }if($row_select_pipe['avgodo'] != "" && $row_select_pipe['avgodo'] != "0" && $row_select_pipe['avgodo'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Odour</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-05) 2018</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgodo']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">-</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Agreeable</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Agreeable</td>
				</tr>
				<?php }if($row_select_pipe['avgtas'] != "" && $row_select_pipe['avgtas'] != "0" && $row_select_pipe['avgtas'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Taste</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-07) 2018</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgtas']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">-</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Agreeable</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Agreeable</td>
				</tr>
				<?php }if($row_select_pipe['avgcol'] != "" && $row_select_pipe['avgcol'] != "0" && $row_select_pipe['avgcol'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"> Colour</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-04) 2021</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgcol']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">CU</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">5</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">15</td>
				</tr>
				<?php }if($row_select_pipe['avgtur'] != "" && $row_select_pipe['avgtur'] != "0" && $row_select_pipe['avgtur'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Turbidity</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-10) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgtur']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">NTU</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">1</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">5</td>
				</tr>
				<?php }if($row_select_pipe['avgcra'] != "" && $row_select_pipe['avgcra'] != "0" && $row_select_pipe['avgcra'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Free Residual Chlorine</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-26) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgcra']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">0.2</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">1</td>
				</tr>
				<?php }if($row_select_pipe['avgtd'] != "" && $row_select_pipe['avgtd'] != "0" && $row_select_pipe['avgtd'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Total Dissolved Solids</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-16) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgtd']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">500</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">2000</td>
				</tr>
				<?php }if($row_select_pipe['avghr'] != "" && $row_select_pipe['avghr'] != "0" && $row_select_pipe['avghr'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Total Hardness</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-21) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avghr']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">200</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">600</td>
				</tr>
				<?php }if($row_select_pipe['avgca'] != "" && $row_select_pipe['avgca'] != "0" && $row_select_pipe['avgca'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Calcium</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-40) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgca']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">75</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">200</td>
				</tr>
				<?php }if($row_select_pipe['avgmag'] != "" && $row_select_pipe['avgmag'] != "0" && $row_select_pipe['avgmag'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Magnesium</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-46) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgmag']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">30</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">100</td>
				</tr>
				<?php }if($row_select_pipe['avgch'] != "" && $row_select_pipe['avgch'] != "0" && $row_select_pipe['avgch'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Chloride </td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-32) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgch']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">250</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">1000</td>
				</tr>
				<?php }if($row_select_pipe['avgtla'] != "" && $row_select_pipe['avgtla'] != "0" && $row_select_pipe['avgtla'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Total Alkalinity</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-32) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgtla']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">200</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">600</td>
				</tr>
				<?php }if($row_select_pipe['avgsu'] != "" && $row_select_pipe['avgsu'] != "0" && $row_select_pipe['avgsu'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Sulphate </td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-24) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgsu']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">200</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">400</td>
				</tr>
				<?php }if($row_select_pipe['avgbic'] != "" && $row_select_pipe['avgbic'] != "0" && $row_select_pipe['avgbic'] != null) { ?>
				<tr>
					<td style="border-left: 2px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php echo $cnt++;?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">Carbonate & Bicarbonate</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;">IS 3025 :  (P-51) 2023</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;"><?php  echo $row_select_pipe['avgbic']; ?></td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">mg/l</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">-</td>
					<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:5px 4px;;">-</td>
				</tr>
				<?php } ?>
				<tr>
					<td style="font-size:11px;border: 1px solid black;border-left: 2px solid black;padding:1px;"colspan="7"></td>
				</tr>
			</table>
		
		
		<!-- footer design -->
		
					<table align="center" width="98%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
			
			<tr>
				<td>
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border: 1px solid;border-top: 0;">
						<tr>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
							<td style="padding: 10px 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;text-transform: uppercase;font-weight: bold;">Report Issue By:- GEO RESEARCH HOUSE, INDORE.</td>
						</tr>
						<tr>
							<td colspan="2"  style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr style="vertical-align: bottom;">
							<td colspan="2" style="padding: 1px 2px;height: 45px;">{Mr. Chitrath Purani}</td>
						</tr>
						<tr>
							<td style="padding: 1px 2px;font-weight: bold;">Report Reviewed <BR>  Name & Sign </td>
							<td style="padding: 1px 2px;font-weight: bold;text-align: right;">Authorized by <BR>  Technical Manager (Name & Sign)</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 0 0;border-bottom: 1px solid;"></td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">NOTES :-</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">1. BDL : Below Detection Limit</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">2. ND : Not Detected</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">3. The Samples have been Submitted to us by the Customer.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">4. The above given Results Refer only to the sample submitted by the customer for testing.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">5. All the information is Provided to us by the Customer and can affect the Result Validity.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">6. This Report shall not be Reproduced without Approval of the Laboratory.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;">7. * As Informed by Client.</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 40px;font-weight: bold;text-align: right;">Doc. ID :-  FMT / CHEM/TST - 009 / Page no:-1 of 1</td>
						</tr>
						<tr>
							<td colspan="2" style="padding: 1px 2px;font-weight: bold;text-align: center;">****** End of Report ******</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>
			


			<?php //}?>






<!-- old code -->


		<!-- <table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:80px;">
			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:left;font-size:11px; ">
					<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;margin-top:20px;">

						<tr style="">
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Sr.<br>NO.</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bar Dia (mm) *</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Mass in Kg/m</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Cross Sectional Area (mm<sup>2</sup>)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Yield Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Tensile Stress (Mpa)</td>
							<td style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Elongation %</td>
							<td colspan="15" style="border-top:1px solid;font-size:11px;border-left: 1px solid black;text-align:center;font-weight:bold;padding:5px 4px;">Bend & Rebend Test</td>
						</tr>

						<?php
								$select_tilesy = "select * from tmt_steel WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0' ORDER BY `id` LIMIT " . $down . "," . $up;
								$result_tiles_select1 = mysqli_query($conn, $select_tilesy);
								// $coming_row = mysqli_num_rows($result_tiles_select1);

								while ($row_select_pipe2 = mysqli_fetch_array($result_tiles_select1)) {
								
								?>
						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"> <?php echo $cnt++; ?></td>
								

							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">
							<?php echo $row_select_pipe2['dia_1'];  ?></td>
							


		<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['w_1'] != "" && $row_select_pipe2['w_1'] != null && $row_select_pipe2['w_1'] != "0") {
																															if ($row_select_pipe2['dia_1'] == "8 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "10 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "12 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "16 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "20 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "25 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "32 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "4 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "5 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "6 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "28 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "36 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "40 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) ;
																															} else if ($row_select_pipe2['dia_1'] == "45 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3);
																															} else if ($row_select_pipe2['dia_1'] == "50 MM") {
																																$w = $row_select_pipe2['w_1'];
																																$l = $row_select_pipe2['l_1'];
																																$ans = $w / $l;
																																echo round($ans, 3) . "<br>" . "(15.42)";
																															};
																																	} else {
																																		echo "-";
																																	} ?></td>

							
					<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['cs_1'] != "" && $row_select_pipe2['cs_1'] != null && $row_select_pipe2['cs_1'] != "0") {echo $row_select_pipe2['cs_1'];} else {echo "-";} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ys_1'] != "" && $row_select_pipe2['ys_1'] != null && $row_select_pipe2['ys_1'] != "0") {echo $row_select_pipe2['ys_1'];} else {echo "-";} ?></td>

					
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['ten_1'] != "" && $row_select_pipe2['ten_1'] != null && $row_select_pipe2['ten_1'] != "0") {
																																								echo $row_select_pipe2['ten_1'];
																																							} else {
																																								echo "-";
																																							} ?></td>
							
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['elo_1'] != "" && $row_select_pipe2['elo_1'] != null && $row_select_pipe2['elo_1'] != "0") {
																																							echo $row_select_pipe2['elo_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>

						
								<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;"><?php if ($row_select_pipe2['bend_1'] != "" && $row_select_pipe2['bend_1'] != null && $row_select_pipe2['bend_1'] != "0" && $row_select_pipe2['bend_1'] != "undefined") {
																																							echo $row_select_pipe2['bend_1'];
																																						} else {
																																							echo "-";
																																						} ?></td>
							



						
					</tr>
					<?php
								/* if ($flag6 == 5) {
									break;
								} */
							}

							?>

						<tr style="">
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>Method of Test</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1786-2008</td>
							<td style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;" colspan=3>IS 1608-2022 (Part-1)</td>
							<td colspan="15" style="font-size:11px;text-align:center;border:1px solid black;border-left:1px solid black;padding:5px 4px;border-right:0px;border-bottom:0px;">IS 1599-2019</td>
						</tr>
					</table>


				</td>
			</tr>

			    <tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI-8.1, Table-3 (Amend No. 1 to IS 1786 : 2008)</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Property</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 415D</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 500D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 550D</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>Fe 600</b></td>
										</tr>
										
										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Yield Stress (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">415</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">500</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">550</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Tensile Stress N/mm<sup>2</sup> . Min/ % more than actual Yield stress</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">485 / 10%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">500 / 12%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">545 / 81%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">565 / 10%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">585 / 6%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">600 / 8%</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">660 / 6%</td>
										</tr>

										<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp; Elongation % (Min)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">14.5</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">18</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">12</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">16</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">14.5</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">10</td>
										</tr>

										<tr>
											<td style="font-size:11px;text-align:left;border:1px solid black;padding:5px 4px;" >&nbsp; Bend Test</td>
											<td style="font-size:11px;text-align:center;border:1px solid black;padding:5px 4px;" colspan=7> There Shall not be any transverse crack/ruputre in the bent portion</td>
                           				 </tr>
								</table>

							</td>
            </tr>


			<tr>
                    <td>
                        <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                            <tr>
                            <td style="font-size:11px;text-align:left;font-weight:bold;padding:15px 0 5px;font-family:Times New Roman;"> Requirement as per IS 1786-2008, CI6.3 & 7.2.3</td>
                            </tr>
                        </table>
                    </td>
                </tr>


            <tr>
                <td colspan="3" style="width:100%;vertical-align:top">
								<table align="top" width="100%" class="test" style="font-family : Calibri;font-size:11px;margin-bottom:10px;">             
           
										<tr>
											<td style="font-size:11px;text-align:left;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;">Diameter in mm</td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>4</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;font-weight:bold;padding:5px 4px;"><b>5</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>6</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>8</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>10</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>12</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>16</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>20</b></td>
                                            <td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>25</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>28</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>32</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>36</b></td>
											<td style="font-size:11px;text-align:center;border-top:1px solid black;border-left:1px solid black;border-right:1px solid black;font-weight:bold;padding:5px 4px;"><b>40</b></td>
										</tr>
										
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Mass per meter (Kg)</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.099</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;">0.154</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.222</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.395</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.617</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">0.888</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">1.580</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">2.470</td>
                                                <td style="text-align:center;border:1px solid black;border-right:1px solid black;">3.850</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">4.830</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">6.310</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">7.990</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;">9.860</td>
											</tr>
											<tr>
												<td style="font-size:11px;text-align:left;border:1px solid black;border-left:1px solid black;padding:5px 0;">&nbsp;Tolerances on Nominal Mass</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="5">-8%</td>
												<td style="text-align:center;border:1px solid black;border-right:0px solid black;" colspan="2">-6%</td>
												<td style="text-align:center;border:1px solid black;border-right:1px solid black;" colspan="6">-4%</td>
											</tr>
								</table>

							</td>
            </tr>			
		</table> -->

		<div id="footer" style="vertical-align: bottom;bottom:0px;position:fixed;">


		</div>
	</page>
	<?php

	/*if($flag==5)
				{
					$flag=0;
					$down=$up;
					$up +=5;*/
	?>



	<!--<div class="pagebreak"> </div>-->
	<?php /*}*/


	/*}*/

	?>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>