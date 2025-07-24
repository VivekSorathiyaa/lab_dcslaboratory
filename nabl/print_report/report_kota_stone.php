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
		width: 29.7cm;
		height: 21cm;
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
		font-size: 12px;
		font-family : Calibri;
	}

	.test1 {
		font-size: 12px;
		border-collapse: collapse;
		font-family : Calibri;

	}

	.tdclass1 {

		
		font-family : Calibri;
	}

	.details {
		margin: 0px auto;
		padding: 0px;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from kota_stone WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);


	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$agreement_no = $row_select['agreement_no'];
	$cons = $row_select['condition_of_sample_receved'];
	// // $job_no= $row_select['job_no'];			
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
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
		$source = $row_select4['agg_source'];
		$mark = $row_select4['mark'];
		$brick_specification = $row_select4['brick_specification'];
	}
	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
		$material_location = $row_select4['material_location'];
		$sample_note = explode("|",$row_select4['sample_note']);
		$firsting=$sample_note[0];
		$seconding=$sample_note[1];
	}
	?>



<page size="A4">
	<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;margin-top:60px;border: 1px solid;border: bottom: 0;">
		<tr>
			<td>
				<table align="center" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;font-weight: bold;border: 1px solid;">
					<tr>
						<td style="text-transform: uppercase;font-weight: bold;text-decoration: underline;text-align: center;font-size: 13px;padding: 2px 0;border-bottom: 1px solid;"  colspan="4">Test Report - KOTA STONE TEST</td>
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

			<?php $cnt = 1; ?>
			<tr>
				<td style="text-align:center;font-size:11px; ">

					<table align="left" width="100%" cellspacing="0" cellpadding="0" style="font-size:11px;font-family : Calibri;border-right:2px solid;border-left:1px solid;">

						<tr style="">
							<td style="border-left: 1px solid black;width:10%;font-weight:bold; text-align:center;padding-bottom:1px;padding-top:1px;  ">Sr. No.</td>
							<td style="border-left: 1px solid black;width:24%;text-align:center;font-weight:bold; padding-bottom:5px;padding-top:5px;" colspan=2>Test Description</td>
							<td style="border-left: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">Unit</td>
							<td style="border-left: 1px solid black;width:10%;text-align:center;font-weight:bold; ">Test Results</td>
							<td style="border-left: 1px solid black;width:13.5%;text-align:center;font-weight:bold; ">Test Requirements <br>IS-13801-1993</td>
							<td style="border-left: 1px solid black;width:17.5%;text-align:center;font-weight:bold; ">Test Method</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;" rowspan=3><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; " rowspan=3>Average<br> Dimesion</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; padding-bottom:5px;padding-top:5px; ">Length</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; " rowspan=3>mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php if ($row_select_pipe['dim_len'] != "" && $row_select_pipe['dim_len'] != null && $row_select_pipe['dim_len'] != "0") {
																																	echo $row_select_pipe['dim_len'];
																																} else {
																																	echo "-";
																																} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; ">600 &plusmn; 1</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; " rowspan=6>IS-13801-1993</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;  padding-bottom:5px;padding-top:5px;">Width</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php if ($row_select_pipe['dim_wid'] != "" && $row_select_pipe['dim_wid'] != null && $row_select_pipe['dim_wid'] != "0") {
																																	echo $row_select_pipe['dim_wid'];
																																} else {
																																	echo "-";
																																} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; ">600 &plusmn; 1</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; padding-bottom:5px;padding-top:5px; ">Depth</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; "><?php if ($row_select_pipe['dim_thic'] != "" && $row_select_pipe['dim_thic'] != null && $row_select_pipe['dim_thic'] != "0") {
																																	echo $row_select_pipe['dim_thic'];
																																} else {
																																	echo "-";
																																} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; ">600 &plusmn; 1</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center;  padding-bottom:5px;padding-top:5px;" colspan=2>Average Water Absorption </td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">%</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; "><?php if ($row_select_pipe['kwa_res1'] != "" && $row_select_pipe['kwa_res1'] != null && $row_select_pipe['kwa_res1'] != "0") {
																																		echo $row_select_pipe['kwa_res1'];
																																	} else {
																																		echo "-";
																																	} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">Max.10%</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; padding-bottom:5px;padding-top:5px; " colspan=2>Average Wet Transverse Strength</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">N/mm&sup2;</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; "><?php if ($row_select_pipe['wts_res1'] != "" && $row_select_pipe['wts_res1'] != null && $row_select_pipe['wts_res1'] != "0") {
																																		echo $row_select_pipe['wts_res1'];
																																	} else {
																																		echo "-";
																																	} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">Min.3</td>
						</tr>
						<tr style="">
							<td style="border-left: 1px solid black;border-top	: 1px solid black;width:10%;font-weight:bold; text-align:center;"><?php echo $cnt++; ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; padding-bottom:5px;padding-top:5px; " colspan=2>Average Resistance to Wear</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:12%;text-align:center; ">mm</td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:17.5%;text-align:center; "><?php if ($row_select_pipe['rtw_res1'] != "" && $row_select_pipe['rtw_res1'] != null && $row_select_pipe['rtw_res1'] != "0") {
																																		echo $row_select_pipe['rtw_res1'];
																																	} else {
																																		echo "-";
																																	} ?></td>
							<td style="border-left: 1px solid black;border-top: 1px solid black;width:10%;text-align:center; ">Max.2.5mm</td>
						</tr>

					</table>

				</td>
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

<script type="text/javascript">


</script>