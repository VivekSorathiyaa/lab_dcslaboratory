 <?php
session_start();
include("../connection.php");
include("function_calling.php");
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
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from modified_bitumen WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
		$bitumin_grade = $row_select4['bitumin_grade'];
		$lot_no = $row_select4['lot_no'];
		$bitumin_make = $row_select4['bitumin_make'];
		$tank_no = $row_select4['tanker_no'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
		$tanker_no = $row_select4['tanker_no'];
		$lot_no = $row_select4['lot_no'];
		$bitumin_grade = $row_select4['bitumin_grade'];
		$make = $row_select4['make'];
	}
?>



<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - PROPERTIES OF POLYMER MODIFIED BITUMEN</td>
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
					<!--<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Sample Source :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $source; ?></td>
					</tr>-->
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Tanker No.:-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $tanker_no; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Lot No. :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $lot_no; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Grade :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $bitumin_grade; ?></td>
					</tr>
					<tr>
						<td style="border-bottom: 1px solid;padding: 0 2px;text-align: left;">&nbsp;Make :-</td>
						<td style="border-bottom: 1px solid;padding: 0 2px;border-left: 1px solid;text-align: left;" colspan="3">&nbsp;<?php echo $make; ?></td>
					</tr>
					
					<tr>
						<td style="padding: 1px 0;border: bottom: 0;" colspan="4"></td>
					</tr>
				</table>
				
			</td>
		</tr>
	</table>
		<tr>
            <td>
                <table cellpadding="0" cellpadding="0" align="center" width="100%" style="" class="test">
                    <tr>
					     <td style="padding:15px 0 4px;font-weight:bold;font-size:11px;border-left: 2px solid black;border-right: 2px solid black;border-bottom: 1px solid black;">A) Polymer Modified Bitumen Test Results :</td>
                     </tr>
                </table>
            </td>
        </tr>
		

		<?php $cnt = 1; ?>
		<tr>
		    <td style="text-align:left;font-size:12px; ">
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:13px;font-family : Calibri;border-bottom:0px solid;border-right:2px solid;border-left:1px solid;">

					<tr style="">
						<td width="30%" style="border-top:0px solid;border-left: 1px solid black;text-align:center;padding:10px 4px;">Name of Test</td>
						<td width="35%" style="border-top:0px solid;border-left: 1px solid black;text-align:center;padding:10px 4px;">Softening Point Test at 5&deg;C (<sup>o</sup>C)</td>
						<td width="35%" style="border-top:0px solid;border-left: 1px solid black;text-align:center;padding:10px 4px;">Elastic Recovery at 15&deg;C</td>
					</tr>


					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;font-weight:bold;">Test Result</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != null && $row_select_pipe['avg_sof'] != "0") {echo number_format($row_select_pipe['avg_sof'], 0);} else { echo "-";} ?>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;"><?php if ($row_select_pipe['avg_ela'] != "" && $row_select_pipe['avg_ela'] != null && $row_select_pipe['avg_ela'] != "0") {echo number_format($row_select_pipe['avg_ela'], 0);} else { echo "-";} ?>
						</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Test Method</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">lS:1205-2022</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">IS:15462-2019</td>
					</tr>
					<tr style="">
						<td colspan="3" style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Requirement as per IS 15462-2019, Table I (clause 6.5)</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 64 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 60&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 70 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 65&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 76 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 70</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 82 - 10</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 80&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 85</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">PMB 76 - 22</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 75&deg;C</td>
						<td style="border-left: 1px solid black;border-top: 1px solid black;text-align:center;padding:10px 4px;">Min . 80</td>
					</tr>
				</table>
			</td>
		
			<!-- <td style="text-align:left;font-size:12px; ">
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:12px;font-family : Calibri;border-bottom:1px solid;border-right:1px solid;">

					<tr style="">
						<td style="border-left: 1px solid black;border-top:1px solid;width:4%;font-weight:bold; text-align:center; " rowspan="2">SR.<BR>NO.</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:26%;text-align:center;font-weight:bold; " rowspan="2">Test Description</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:10%; text-align:center;font-weight:bold;" rowspan="2">Unit</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:10%;text-align:center;font-weight:bold;" rowspan="2">Test Results</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:28%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px;" colspan="4">Test Requirements</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:19%;text-align:center;font-weight:bold;" rowspan="2">Test Method</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%; text-align:center;font-weight:bold;">VG 10</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;">VG 20</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;padding-bottom:3px;padding-top:3px;">VG 30</td>
						<td style="border-left: 1px solid black;border-top:1px solid;width:7%;text-align:center;font-weight:bold;">VG 40</td>
					</tr>

					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"><?php echo $cnt++; ?></td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Flash Point**(Cleveland open Cup)</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;">&deg;C</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;">52</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.220</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1448[P:69]</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Penetration @ 25&deg;C.100g.5s</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">(1/10)mm</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != null && $row_select_pipe['avg_pen'] != "0") {
																														echo number_format($row_select_pipe['avg_pen'], 0);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.80</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.60</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.47</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.35</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1203:1958 RA 2009</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Softening Point(R&B)</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">&deg;C</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != null && $row_select_pipe['avg_sof'] != "0") {
																														echo number_format($row_select_pipe['avg_sof'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.40&deg;C</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.45&deg;C</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.47&deg;C</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.50&deg;C</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1205:1978</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;  ">Absolute Viscosity @ 70&deg;C.30 cmHg</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">Poise</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_abs'] != "" && $row_select_pipe['avg_abs'] != null && $row_select_pipe['avg_abs'] != "0") {
																														echo number_format($row_select_pipe['avg_abs'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;padding-bottom:5px;padding-top:5px;">800-1200</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">1600-2400</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">2400-3600</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">3200-4800</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1206:1978(Part-2)</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Kinematic Viscosity @ 135&deg;C</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">cSt</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_kin'] != "" && $row_select_pipe['avg_kin'] != null && $row_select_pipe['avg_kin'] != "0") {
																														echo number_format($row_select_pipe['avg_kin'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.250</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.300</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.350</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.400</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1206:1978(Part-3)</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Ductility @ 25</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">cm</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != null && $row_select_pipe['avg_duc'] != "0") {
																														echo number_format($row_select_pipe['avg_duc'], 1);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.75</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.50</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.40</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.25</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1208:1978</td>
					</tr>
					<tr style="">
						<td style="border-left: 1px solid black;width:4%;text-align:center; border-top:1px solid;"> <?php echo $cnt++; ?> </td>
						<td style="border-left: 1px solid black;width:26%;text-align:center;border-top:1px solid;padding-bottom:5px;padding-top:5px;  ">Specific Gravity</td>
						<td style="border-left: 1px solid black;width:10%;border-top:1px solid;text-align:center;">-</td>
						<td style="border-left: 1px solid black;width:10%; text-align:center;border-top:1px solid;"><?php if ($row_select_pipe['avg_sp'] != "" && $row_select_pipe['avg_sp'] != null && $row_select_pipe['avg_sp'] != "0") {
																														echo number_format($row_select_pipe['avg_sp'], 2);
																													} else {
																														echo "-";
																													} ?></td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">-</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">-</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">Min.0.99</td>
						<td style="border-left: 1px solid black;width:7%;text-align:center; border-top:1px solid;">-</td>
						<td style="border-left: 1px solid black;width:19%;border-top:1px solid;text-align:center;">IS:1202:1978</td>
					</tr>

				</table>

			</td> -->
		</tr>


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