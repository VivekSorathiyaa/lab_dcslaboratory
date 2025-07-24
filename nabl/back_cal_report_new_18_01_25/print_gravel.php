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

		font-size: 11px;
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
	$tbl = $_GET['tbl_name'];
	$trf_no = $_GET['trf_no'];
	$select_tiles_query = "select * from $tbl WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job WHERE `trf_no`='$trf_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$branch_name = $row_select['branch_name'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
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
			$mt_name= $row_select3['mt_name'];
			include_once 'sample_id.php';
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$source = $row_select4['agg_source'];
	}


	$totalcnt = 1;
	$pagecnt = 1;
	if (($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null) || ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null) || ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['combined_index'] != ""  && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null) {
		$totalcnt++;
	}
	if (($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) || ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null)) {
		$totalcnt++;
	}
	if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0" && $row_select_pipe['alk_10'] != null) {
		$totalcnt++;
	}
	if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0" && $row_select_pipe['liquide_limit'] != null) {
		$totalcnt++;
	}
	?>

	<br>
	<br><br>


	<page size="A4">
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRAVEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 2386 </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>

		<!-- <table align="center" width="100%" class="test1" height="12%">
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;<?php echo $mt_name;?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;width:5%;"><b>1</b></td>
				<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
				<td colspan=4 style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $lab_no."_01"?></b></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>2</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Location Name</b></td>
				<td colspan=4 style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="text-align:center;"><b>3</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of starting test</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($start_date)); ?></td>
                <td style="text-align:center;border-left:1px solid;width:7%;"><b>4</b></td>
				<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Date of completion</b></td>
				<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date("d/m/Y",strtotime($end_date)); ?></td>    
			</tr>
		</table>
        <br> -->

		<table align="center" width="100%" class="test1" style="border: 1px solid black;" height="Auto">
			<tr style="border: 0px solid black;">
				<td colspan="10" style="border: 0px solid black;padding:7px 7px;"><b>Test - 1 Gradation</b></td>
				<td colspan="4" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-1</b></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test1" style="border: 1px solid black;border-top:0px;" height="Auto">
			<tr style="border: 0px solid black;">
				<td colspan="10" style="border: 0px solid black;padding:7px 7px;"><b>Size of Material :-</b> <?php echo $detail_sample; ?> </td>
				<td colspan="4" style="text-align:center; border: 0px solid black;"><b>Total Weight = </b> <?php echo $row_select_pipe['sample_taken']; ?><b> gm</b></td>
			</tr>

			<tr style="border: 1px solid black;">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;">
					<center>Sieve Size<br>(mm)</center>
				</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Wt. of mass <br> retained, gm</center>
				</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Cum. mass <br> retained, gm</center>
				</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Cum. % mass <br> retained</center>
				</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>% of passing</center>
				</td>
				<td colspan="2" style="border: 1px solid black;font-weight:bold;">
					<center>Requirement</center>
				</td>

			</tr>

			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
																						echo $row_select_pipe['sieve_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
																		echo $row_select_pipe['cum_wt_gm_1'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
																		echo $row_select_pipe['ret_wt_gm_1'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
																		echo $row_select_pipe['cum_ret_1'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
																		echo $row_select_pipe['pass_sample_1'];
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>

			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
																						echo $row_select_pipe['sieve_2'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
																		echo $row_select_pipe['cum_wt_gm_2'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
																		echo $row_select_pipe['ret_wt_gm_2'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
																		echo $row_select_pipe['cum_ret_2'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
																		echo $row_select_pipe['pass_sample_2'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>

			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
																						echo $row_select_pipe['sieve_3'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
																		echo $row_select_pipe['cum_wt_gm_3'];
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
																		echo $row_select_pipe['ret_wt_gm_3'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
																		echo $row_select_pipe['cum_ret_3'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
																		echo $row_select_pipe['pass_sample_3'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>

			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
																						echo $row_select_pipe['sieve_4'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
																		echo $row_select_pipe['cum_wt_gm_4'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
																		echo $row_select_pipe['ret_wt_gm_4'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
																		echo $row_select_pipe['cum_ret_4'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
																		echo $row_select_pipe['pass_sample_4'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>

			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
																						echo $row_select_pipe['sieve_5'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
																		echo $row_select_pipe['cum_wt_gm_5'];
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
																		echo $row_select_pipe['ret_wt_gm_5'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
																		echo $row_select_pipe['cum_ret_5'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
																		echo $row_select_pipe['pass_sample_5'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>
			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
																						echo $row_select_pipe['sieve_6'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
																		echo $row_select_pipe['cum_wt_gm_6'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
																		echo $row_select_pipe['ret_wt_gm_6'];
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
																		echo $row_select_pipe['cum_ret_6'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
																		echo $row_select_pipe['pass_sample_6'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>
			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
																						echo $row_select_pipe['sieve_7'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
																		echo $row_select_pipe['cum_wt_gm_7'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
																		echo $row_select_pipe['ret_wt_gm_7'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
																		echo $row_select_pipe['cum_ret_7'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
																		echo $row_select_pipe['pass_sample_7'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>
			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
																						echo $row_select_pipe['sieve_8'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
																		echo $row_select_pipe['cum_wt_gm_8'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
																		echo $row_select_pipe['ret_wt_gm_8'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
																		echo $row_select_pipe['cum_ret_8'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
																		echo $row_select_pipe['pass_sample_8'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>
			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
																						echo $row_select_pipe['sieve_9'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
																		echo $row_select_pipe['cum_wt_gm_9'];
																	} else {
																		echo " <br>";
																	}  ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
																		echo $row_select_pipe['ret_wt_gm_9'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
																		echo $row_select_pipe['cum_ret_9'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
																		echo $row_select_pipe['pass_sample_9'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>
			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
																						echo $row_select_pipe['sieve_10'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
																		echo $row_select_pipe['cum_wt_gm_10'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
																		echo $row_select_pipe['ret_wt_gm_10'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
																		echo $row_select_pipe['cum_ret_10'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
																		echo $row_select_pipe['pass_sample_10'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>

			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
																						echo $row_select_pipe['sieve_11'];
																					} else {
																						echo " <br>";
																					} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
																		echo $row_select_pipe['cum_wt_gm_11'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
																		echo $row_select_pipe['ret_wt_gm_11'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
																		echo $row_select_pipe['cum_ret_11'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
																		echo $row_select_pipe['pass_sample_11'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>
			<tr style="text-align:center">
				<td colspan="4" style="border: 1px solid black;font-weight:bold;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
																						echo $row_select_pipe['sieve_12'];
																					} else {
																						echo " <br>";
																					}  ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
																		echo $row_select_pipe['cum_wt_gm_12'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
																		echo $row_select_pipe['ret_wt_gm_12'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
																		echo $row_select_pipe['cum_ret_12'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
																		echo $row_select_pipe['pass_sample_12'];
																	} else {
																		echo " <br>";
																	} ?></td>
				<td colspan="2" style="border: 1px solid black;"></td>
			</tr>


		</table>
		<br>

		<?php
		/*if(($row_select_pipe['imp_value']!="" && $row_select_pipe['imp_value']!="0" && $row_select_pipe['imp_value']!=null) || ($row_select_pipe['abr_index']!="" && $row_select_pipe['abr_index']!="0" && $row_select_pipe['abr_index']!=null) || ($row_select_pipe['cru_value']!="" && $row_select_pipe['cru_value']!="0" && $row_select_pipe['cru_value']!=null))
					{
						$pagecnt++;*/
		?>
		
		<table align="center" width="100%" class="test1" style="border: 0px solid black;" height="18.5%">
			<tr style="border: 1px solid black;height:20px;">
				<td colspan="2" style="border: 0px solid black;padding:7px 7px;"><b>Test-5 Impact Test</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;padding:7px 7px;"><b>IS 2386 Part-4</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:5%;height:45px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:51%;">
					<center><b>Particular</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>2</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Total weight taken in mould in g (A)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_w_m_a_1'] != "" && $row_select_pipe['imp_w_m_a_1'] != "0" && $row_select_pipe['imp_w_m_a_1'] != null) {
								echo $row_select_pipe['imp_w_m_a_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_w_m_a_2'] != "" && $row_select_pipe['imp_w_m_a_2'] != "0" && $row_select_pipe['imp_w_m_a_2'] != null) {
								echo $row_select_pipe['imp_w_m_a_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Weight of material passing through IS sieve 2.36 mm in g (B)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_w_m_b_1'] != "" && $row_select_pipe['imp_w_m_b_1'] != "0" && $row_select_pipe['imp_w_m_b_1'] != null) {
								echo $row_select_pipe['imp_w_m_b_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_w_m_b_2'] != "" && $row_select_pipe['imp_w_m_b_2'] != "0" && $row_select_pipe['imp_w_m_b_2'] != null) {
								echo $row_select_pipe['imp_w_m_b_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Weight of material retained on IS sieve 2.36 mm in g (C)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_w_m_c_1'] != "" && $row_select_pipe['imp_w_m_c_1'] != "0" && $row_select_pipe['imp_w_m_c_1'] != null) {
								echo $row_select_pipe['imp_w_m_c_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_w_m_c_2'] != "" && $row_select_pipe['imp_w_m_c_2'] != "0" && $row_select_pipe['imp_w_m_c_2'] != null) {
								echo $row_select_pipe['imp_w_m_c_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>4</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Impact Value % = B/A x 100</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_value_1'] != "" && $row_select_pipe['imp_value_1'] != "0" && $row_select_pipe['imp_value_1'] != null) {
								echo $row_select_pipe['imp_value_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_value_2'] != "" && $row_select_pipe['imp_value_2'] != "0" && $row_select_pipe['imp_value_2'] != null) {
								echo $row_select_pipe['imp_value_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;padding:5px 7px;"><b>Average</b></td>

				<td colspan="2" style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0" && $row_select_pipe['imp_value'] != null) {
								echo $row_select_pipe['imp_value'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>

		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 6</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

		<div class="pagebreak"> </div>
		<br>
		<br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRAVEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 2386 </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br><br>

		<table align="center" width="100%" class="test1" style="" height="18.5%">
			<tr style="border: 1px solid black;height:20px;">
				<td colspan="2" style="border: 0px solid black;padding:7px 7px;"><b>Test-6 Loss Angel Abrasion</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;"><b>IS 2386 Part-4</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:5%;height:45px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:51%;height:15px;">
					<center><b>Particular</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;height:15px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;height:15px;">
					<center><b>2</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;padding:5px 7px;"><b>Total weight taken in mould in g (A)</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_wt_t_a_1'] != "" && $row_select_pipe['abr_wt_t_a_1'] != "0" && $row_select_pipe['abr_wt_t_a_1'] != null) {
								echo $row_select_pipe['abr_wt_t_a_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_wt_t_a_2'] != "" && $row_select_pipe['abr_wt_t_a_2'] != "0" && $row_select_pipe['abr_wt_t_a_2'] != null) {
								echo $row_select_pipe['abr_wt_t_a_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;padding:5px 7px;"><b>Weight of material retained on IS sieve in g(B)</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_wt_t_b_1'] != "" && $row_select_pipe['abr_wt_t_b_1'] != "0" && $row_select_pipe['abr_wt_t_b_1'] != null) {
								echo $row_select_pipe['abr_wt_t_b_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_wt_t_b_2'] != "" && $row_select_pipe['abr_wt_t_b_2'] != "0" && $row_select_pipe['abr_wt_t_b_2'] != null) {
								echo $row_select_pipe['abr_wt_t_b_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;padding:5px 7px;"><b>Weight of material passing through IS sieve 1.70 mm C = A - B</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_wt_t_c_1'] != "" && $row_select_pipe['abr_wt_t_c_1'] != "0" && $row_select_pipe['abr_wt_t_c_1'] != null) {
								echo $row_select_pipe['abr_wt_t_c_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_wt_t_c_2'] != "" && $row_select_pipe['abr_wt_t_c_2'] != "0" && $row_select_pipe['abr_wt_t_c_2'] != null) {
								echo $row_select_pipe['abr_wt_t_c_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>4</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;padding:5px 7px;"><b>Weight of material passing Abrasion % = C/A x 100</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_1'] != "" && $row_select_pipe['abr_1'] != "0" && $row_select_pipe['abr_1'] != null) {
								echo $row_select_pipe['abr_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_2'] != "" && $row_select_pipe['abr_2'] != "0" && $row_select_pipe['abr_2'] != null) {
								echo $row_select_pipe['abr_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;padding:5px 7px;"><b>Average</b></td>

				<td colspan="2" style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0" && $row_select_pipe['abr_index'] != null) {
								echo $row_select_pipe['abr_index'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>

		</table>
		<br><br>

		<table align="center" width="100%" class="test1" style="" height="18.5%">
			<tr style="border: 1px solid black;">
				<td colspan="2" style="border: 0px solid black;height:20px;padding:7px 7px;"><b>Test-7 Crushing Value</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;padding:7px 7px;"><b>IS 2386 Part-4</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:5%;height:45px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:51%;">
					<center><b>Particular</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>2</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Total weight taken in crushing mould in g (A)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cr_a_1'] != "" && $row_select_pipe['cr_a_1'] != "0" && $row_select_pipe['cr_a_1'] != null) {
								echo $row_select_pipe['cr_a_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cr_a_2'] != "" && $row_select_pipe['cr_a_2'] != "0" && $row_select_pipe['cr_a_2'] != null) {
								echo $row_select_pipe['cr_a_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Weight of material passing through IS sieve 2.36mm after crushing load applied in g (B)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cr_b_1'] != "" && $row_select_pipe['cr_b_1'] != "0" && $row_select_pipe['cr_b_1'] != null) {
								echo $row_select_pipe['cr_b_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cr_b_2'] != "" && $row_select_pipe['cr_b_2'] != "0" && $row_select_pipe['cr_b_2'] != null) {
								echo $row_select_pipe['cr_b_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>Crushing Value % = B/A x 100</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cru_value_1'] != "" && $row_select_pipe['cru_value_1'] != "0" && $row_select_pipe['cru_value_1'] != null) {
								echo $row_select_pipe['cru_value_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cru_value_2'] != "" && $row_select_pipe['cru_value_2'] != "0" && $row_select_pipe['cru_value_2'] != null) {
								echo $row_select_pipe['cru_value_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;padding:5px 7px;"><b>Average</b></td>

				<td colspan="2" style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0" && $row_select_pipe['cru_value'] != null) {
								echo $row_select_pipe['cru_value'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>

		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 2 of 6</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

		<div class="pagebreak"> </div>
		<br>
		<br>


		<?php

		/*}
					if($row_select_pipe['combined_index']!=""  && $row_select_pipe['combined_index']!="0" && $row_select_pipe['combined_index']!=null)
					{
						$pagecnt++;*/

		?>
		

		
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRAVEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 2386 </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
		<br><br>

		<table align="center" width="100%" class="test1" style="" height="50%">
				<tr style="border: 1px solid black;">
					<td colspan="8" style="border: 0px solid black;padding:7px 7px;"><b>Test - 8 Determination of Combined Flakiness Index &amp; Elongation Index</b> </td>
				</tr>

				<tr style="border: 1px solid black;">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;width:50%;padding:7px 7px;">
						<center>FLEKINESS INDEX</center>
					</td>
					<td colspan="4" style="border: 1px solid black;font-weight:bold;Width:50%;padding:7px 7px;">
						<center>ELONGATION INDEX</center>
					</td>

				</tr>
				<tr style="border: 1px solid black;">
					<td style="border: 1px solid black;font-weight:bold;width:7%;">
						<center>Sr.No.</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:13%;">
						<center>Sieve Set</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:15%;">
						<center>Material Retained<br>on Sieve,(gm) A</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:15%;">
						<center>Material Passing<br>Through Thickness<br>Gauge,(gm), B</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:7%;">
						<center>Sr.No.</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:13%;">
						<center>Sieve Set</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:15%;">
						<center>Material Retained<br>Through Thickness<br>Gauge,(gm),D=A-B</center>
					</td>
					<td style="border: 1px solid black;font-weight:bold;width:15%;">
						<center>Material Retained<br>on Length<br>Gauge,(gm) C</center>
					</td>

				</tr>

				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">1</td>
					<td style="border: 1px solid black;">63-50</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a1'] != ""  && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {
																echo $row_select_pipe['a1'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b1'] != ""  && $row_select_pipe['b1'] != "0" && $row_select_pipe['b1'] != null) {
																echo $row_select_pipe['b1'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">1</td>
					<td style="border: 1px solid black;">--</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa1'] != ""  && $row_select_pipe['aa1'] != "0" && $row_select_pipe['aa1'] != null) {
																echo $row_select_pipe['aa1'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd1'] != ""  && $row_select_pipe['dd1'] != "0" && $row_select_pipe['dd1'] != null) {
																echo $row_select_pipe['dd1'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">2</td>
					<td style="border: 1px solid black;">50-40</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a2'] != ""  && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {
																echo $row_select_pipe['a2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b2'] != ""  && $row_select_pipe['b2'] != "0" && $row_select_pipe['b2'] != null) {
																echo $row_select_pipe['b2'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">2</td>
					<td style="border: 1px solid black;">50-40</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa2'] != ""  && $row_select_pipe['aa2'] != "0" && $row_select_pipe['aa2'] != null) {
																echo $row_select_pipe['aa2'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd2'] != ""  && $row_select_pipe['dd2'] != "0" && $row_select_pipe['dd2'] != null) {
																echo $row_select_pipe['dd2'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">3</td>
					<td style="border: 1px solid black;">40-31.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a3'] != ""  && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {
																echo $row_select_pipe['a3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b3'] != ""  && $row_select_pipe['b3'] != "0" && $row_select_pipe['b3'] != null) {
																echo $row_select_pipe['b3'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">3</td>
					<td style="border: 1px solid black;">40-31.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa3'] != ""  && $row_select_pipe['aa3'] != "0" && $row_select_pipe['aa3'] != null) {
																echo $row_select_pipe['aa3'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd3'] != ""  && $row_select_pipe['dd3'] != "0" && $row_select_pipe['dd3'] != null) {
																echo $row_select_pipe['dd3'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">4</td>
					<td style="border: 1px solid black;">31.5-25</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a4'] != ""  && $row_select_pipe['a4'] != "0" && $row_select_pipe['a4'] != null) {
																echo $row_select_pipe['a4'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b4'] != ""  && $row_select_pipe['b4'] != "0" && $row_select_pipe['b4'] != null) {
																echo $row_select_pipe['b4'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">4</td>
					<td style="border: 1px solid black;">31.5-25</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa4'] != ""  && $row_select_pipe['aa4'] != "0" && $row_select_pipe['aa4'] != null) {
																echo $row_select_pipe['aa4'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd4'] != ""  && $row_select_pipe['dd4'] != "0" && $row_select_pipe['dd4'] != null) {
																echo $row_select_pipe['dd4'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">5</td>
					<td style="border: 1px solid black;">25-20</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a5'] != ""  && $row_select_pipe['a5'] != "0" && $row_select_pipe['a5'] != null) {
																echo $row_select_pipe['a5'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b5'] != ""  && $row_select_pipe['b5'] != "0" && $row_select_pipe['b5'] != null) {
																echo $row_select_pipe['b5'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">5</td>
					<td style="border: 1px solid black;">25-20</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa5'] != ""  && $row_select_pipe['aa5'] != "0" && $row_select_pipe['aa5'] != null) {
																echo $row_select_pipe['aa5'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd5'] != ""  && $row_select_pipe['dd5'] != "0" && $row_select_pipe['dd5'] != null) {
																echo $row_select_pipe['dd5'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">6</td>
					<td style="border: 1px solid black;">20-16</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a6'] != ""  && $row_select_pipe['a6'] != "0" && $row_select_pipe['a6'] != null) {
																echo $row_select_pipe['a6'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b6'] != ""  && $row_select_pipe['b6'] != "0" && $row_select_pipe['b6'] != null) {
																echo $row_select_pipe['b6'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">6</td>
					<td style="border: 1px solid black;">20-16</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa6'] != ""  && $row_select_pipe['aa6'] != "0" && $row_select_pipe['aa6'] != null) {
																echo $row_select_pipe['aa6'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd6'] != ""  && $row_select_pipe['dd6'] != "0" && $row_select_pipe['dd6'] != null) {
																echo $row_select_pipe['dd6'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">7</td>
					<td style="border: 1px solid black;">16-12.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a7'] != ""  && $row_select_pipe['a7'] != "0" && $row_select_pipe['a7'] != null) {
																echo $row_select_pipe['a7'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b7'] != ""  && $row_select_pipe['b7'] != "0" && $row_select_pipe['b7'] != null) {
																echo $row_select_pipe['b7'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">7</td>
					<td style="border: 1px solid black;">16-12.5</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa7'] != ""  && $row_select_pipe['aa7'] != "0" && $row_select_pipe['aa7'] != null) {
																echo $row_select_pipe['aa7'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd7'] != ""  && $row_select_pipe['dd7'] != "0" && $row_select_pipe['dd7'] != null) {
																echo $row_select_pipe['dd7'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">8</td>
					<td style="border: 1px solid black;">12.5-10</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a8'] != ""  && $row_select_pipe['a8'] != "0" && $row_select_pipe['a8'] != null) {
																echo $row_select_pipe['a8'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b8'] != ""  && $row_select_pipe['b8'] != "0" && $row_select_pipe['b8'] != null) {
																echo $row_select_pipe['b8'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">8</td>
					<td style="border: 1px solid black;">12.5-10</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa8'] != ""  && $row_select_pipe['aa8'] != "0" && $row_select_pipe['aa8'] != null) {
																echo $row_select_pipe['aa8'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd8'] != ""  && $row_select_pipe['dd8'] != "0" && $row_select_pipe['dd8'] != null) {
																echo $row_select_pipe['dd8'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td style="border: 1px solid black;font-weight:bold;">9</td>
					<td style="border: 1px solid black;">10-6.3</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['a9'] != ""  && $row_select_pipe['a9'] != "0" && $row_select_pipe['a9'] != null) {
																echo $row_select_pipe['a9'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['b9'] != ""  && $row_select_pipe['b9'] != "0" && $row_select_pipe['b9'] != null) {
																echo $row_select_pipe['b9'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;font-weight:bold;">9</td>
					<td style="border: 1px solid black;">10-6.3</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['aa9'] != ""  && $row_select_pipe['aa9'] != "0" && $row_select_pipe['aa9'] != null) {
																echo $row_select_pipe['aa9'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['dd9'] != ""  && $row_select_pipe['dd9'] != "0" && $row_select_pipe['dd9'] != null) {
																echo $row_select_pipe['dd9'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="text-align:center">
					<td colspan="2" style="border: 1px solid black;font-weight:bold;">Total</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['suma'] != ""  && $row_select_pipe['suma'] != "0" && $row_select_pipe['suma'] != null) {
																echo $row_select_pipe['suma'];
															} else {
																echo " <br>";
															} ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sumb'] != ""  && $row_select_pipe['sumb'] != "0" && $row_select_pipe['sumb'] != null) {
																echo $row_select_pipe['sumb'];
															} else {
																echo " <br>";
															} ?></td>
					<td colspan="2" style="border: 1px solid black;font-weight:bold;">Total</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sumaa'] != ""  && $row_select_pipe['sumaa'] != "0" && $row_select_pipe['sumaa'] != null) {
																echo $row_select_pipe['sumaa'];
															} else {
																echo " <br>";
															}  ?></td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['sumdd'] != ""  && $row_select_pipe['sumdd'] != "0" && $row_select_pipe['sumdd'] != null) {
																echo $row_select_pipe['sumdd'];
															} else {
																echo " <br>";
															}  ?></td>

				</tr>
				<tr style="border: 1px solid black;text-align:center;">
					<td colspan="3" style="border: 1px solid black;font-weight:bold;width:50%;">
						<center>Flakiness Index = 100*B/A, (%)</center>
					</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['fi_index'] != ""  && $row_select_pipe['fi_index'] != "0" && $row_select_pipe['fi_index'] != null) {
																echo $row_select_pipe['fi_index'];
															} else {
																echo " <br>";
															} ?></td>
					<td colspan="3" style="border: 1px solid black;font-weight:bold;Width:50%;">
						<center>Elongation Index = 100*C/D, (%)</center>
					</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['ei_index'] != ""  && $row_select_pipe['ei_index'] != "0" && $row_select_pipe['ei_index'] != null) {
																echo $row_select_pipe['ei_index'];
															} else {
																echo " <br>";
															} ?></td>

				</tr>
				<tr style="border: 1px solid black;text-align:center;">
					<td colspan="4" style="border: 1px solid black;font-weight:bold;width:50%;">
						<center></center>
					</td>

					<td colspan="3" style="border: 1px solid black;font-weight:bold;Width:50%;">
						<center>Combined Index = F.I. + E.I. (%)</center>
					</td>
					<td style="border: 1px solid black;"><?php if ($row_select_pipe['combined_index'] != ""  && $row_select_pipe['combined_index'] != "0" && $row_select_pipe['combined_index'] != null) {
																echo $row_select_pipe['combined_index'];
															} else {
																echo " <br>";
															} ?></td>

				</tr>



		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 3 of 6</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

		<div class="pagebreak"> </div>
		<br>
		<br>

		</div>
		<?php

		/*}
					if(($row_select_pipe['soundness']!="" && $row_select_pipe['soundness']!="0" && $row_select_pipe['soundness']!=null) || ($row_select_pipe['fines_value']!="" && $row_select_pipe['fines_value']!="0" && $row_select_pipe['fines_value']!=null))
					{
						$pagecnt++;*/

		?>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRAVEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 2386 </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
						

		<table align="center" width="100%" class="test1" style="" height="35%">
			<tr style="border: 1px solid black;">
				<td style="border: 0px solid black;border-right: 1px solid black;padding:3px 7px;"><b>Test - 9</b></td>
				<td colspan="3" style="border: 0px solid black;padding:3px 7px;"><b>Soundness</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;padding:3px 7px;"><b>IS 2386 Part-5</b></td>
			</tr>

			<tr style="border: 1px solid black;font-weight:bold;">
				<td colspan="2" style="border: 1px solid black;">
					<center>Sieve Size</center>
				</td>
				<td style="border: 1px solid black;width:16%;" rowspan="2">
					<center>Grading of <br> Original <br> sample percent</center>
				</td>
				<td style="border: 1px solid black;width:20%;" rowspan="2">
					<center>Weight of test <br> fractions before test</center>
				</td>
				<td style="border: 1px solid black;width:16%;" rowspan="2">
					<center>Percentage passing <br> finer sieve after test <br> (Actual Percentage loss)</center>
				</td>
				<td style="border: 1px solid black;width:16%;" rowspan="2">
					<center>Weighted average <br> (corrected percent <br> loss)</center>
				</td>

			</tr>
			<tr style="text-align:center;font-weight:bold;">
				<td style="border: 1px solid black;font-weight:bold;width:16%;">Passing</td>
				<td style="border: 1px solid black;font-weight:bold;width:16%;">Retained</td>


			</tr>
			<tr style="border: 1px solid black;font-weight:bold;">
				<td style="border: 1px solid black;">
					<center>1</center>
				</td>
				<td style="border: 1px solid black;">
					<center>2</center>
				</td>
				<td style="border: 1px solid black;">
					<center>3</center>
				</td>
				<td style="border: 1px solid black;">
					<center>4</center>
				</td>
				<td style="border: 1px solid black;">
					<center>5</center>
				</td>
				<td style="border: 1px solid black;">
					<center>6</center>
				</td>

			</tr>
			<tr style="text-align:center">
				<td colspan="6" style="border: 1px solid black;font-weight:bold;">Soundness Test for Coarse Aggregate</td>
			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>63 MM</b></td>
				<td style="border: 1px solid black;"><b>40 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s31'] != "" && $row_select_pipe['s31'] != "0" && $row_select_pipe['s31'] != null) {
								echo $row_select_pipe['s31'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s41'] != "" && $row_select_pipe['s41'] != "0" && $row_select_pipe['s41'] != null) {
								echo $row_select_pipe['s41'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s51'] != "" && $row_select_pipe['s51'] != "0" && $row_select_pipe['s51'] != null) {
								echo $row_select_pipe['s51'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s61'] != "" && $row_select_pipe['s61'] != "0" && $row_select_pipe['s61'] != null) {
								echo $row_select_pipe['s61'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>63 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>50 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s32'] != "" && $row_select_pipe['s32'] != "0" && $row_select_pipe['s32'] != null) {
								echo $row_select_pipe['s32'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s42'] != "" && $row_select_pipe['s42'] != "0" && $row_select_pipe['s42'] != null) {
								echo $row_select_pipe['s42'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s52'] != "" && $row_select_pipe['s52'] != "0" && $row_select_pipe['s52'] != null) {
								echo $row_select_pipe['s52'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s62'] != "" && $row_select_pipe['s62'] != "0" && $row_select_pipe['s62'] != null) {
								echo $row_select_pipe['s62'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>50 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>40 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s33'] != "" && $row_select_pipe['s33'] != "0" && $row_select_pipe['s33'] != null) {
								echo $row_select_pipe['s33'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s43'] != "" && $row_select_pipe['s43'] != "0" && $row_select_pipe['s43'] != null) {
								echo $row_select_pipe['s43'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s53'] != "" && $row_select_pipe['s53'] != "0" && $row_select_pipe['s53'] != null) {
								echo $row_select_pipe['s53'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s63'] != "" && $row_select_pipe['s63'] != "0" && $row_select_pipe['s63'] != null) {
								echo $row_select_pipe['s63'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>40 MM</b></td>
				<td style="border: 1px solid black;"><b>20 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s34'] != "" && $row_select_pipe['s34'] != "0" && $row_select_pipe['s34'] != null) {
								echo $row_select_pipe['s34'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s44'] != "" && $row_select_pipe['s44'] != "0" && $row_select_pipe['s44'] != null) {
								echo $row_select_pipe['s44'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s54'] != "" && $row_select_pipe['s54'] != "0" && $row_select_pipe['s54'] != null) {
								echo $row_select_pipe['s54'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s64'] != "" && $row_select_pipe['s64'] != "0" && $row_select_pipe['s64'] != null) {
								echo $row_select_pipe['s64'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>40 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>25 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s35'] != "" && $row_select_pipe['s35'] != "0" && $row_select_pipe['s35'] != null) {
								echo $row_select_pipe['s35'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s45'] != "" && $row_select_pipe['s45'] != "0" && $row_select_pipe['s45'] != null) {
								echo $row_select_pipe['s45'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s55'] != "" && $row_select_pipe['s55'] != "0" && $row_select_pipe['s55'] != null) {
								echo $row_select_pipe['s55'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s65'] != "" && $row_select_pipe['s65'] != "0" && $row_select_pipe['s65'] != null) {
								echo $row_select_pipe['s65'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>25 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>20 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s36'] != "" && $row_select_pipe['s36'] != "0" && $row_select_pipe['s36'] != null) {
								echo $row_select_pipe['s36'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s46'] != "" && $row_select_pipe['s46'] != "0" && $row_select_pipe['s46'] != null) {
								echo $row_select_pipe['s46'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s56'] != "" && $row_select_pipe['s56'] != "0" && $row_select_pipe['s56'] != null) {
								echo $row_select_pipe['s56'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s66'] != "" && $row_select_pipe['s66'] != "0" && $row_select_pipe['s66'] != null) {
								echo $row_select_pipe['s66'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>20 MM</b></td>
				<td style="border: 1px solid black;"><b>10 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s37'] != "" && $row_select_pipe['s37'] != "0" && $row_select_pipe['s37'] != null) {
								echo $row_select_pipe['s37'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s47'] != "" && $row_select_pipe['s47'] != "0" && $row_select_pipe['s47'] != null) {
								echo $row_select_pipe['s47'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s57'] != "" && $row_select_pipe['s57'] != "0" && $row_select_pipe['s57'] != null) {
								echo $row_select_pipe['s57'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s67'] != "" && $row_select_pipe['s67'] != "0" && $row_select_pipe['s67'] != null) {
								echo $row_select_pipe['s67'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>20 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>12.5 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s38'] != "" && $row_select_pipe['s38'] != "0" && $row_select_pipe['s38'] != null) {
								echo $row_select_pipe['s38'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s48'] != "" && $row_select_pipe['s48'] != "0" && $row_select_pipe['s48'] != null) {
								echo $row_select_pipe['s48'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s58'] != "" && $row_select_pipe['s58'] != "0" && $row_select_pipe['s58'] != null) {
								echo $row_select_pipe['s58'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s68'] != "" && $row_select_pipe['s68'] != "0" && $row_select_pipe['s68'] != null) {
								echo $row_select_pipe['s68'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;">
					<center><b>12.5 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b>10 MM</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s39'] != "" && $row_select_pipe['s39'] != "0" && $row_select_pipe['s39'] != null) {
								echo $row_select_pipe['s39'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s49'] != "" && $row_select_pipe['s49'] != "0" && $row_select_pipe['s49'] != null) {
								echo $row_select_pipe['s49'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s59'] != "" && $row_select_pipe['s59'] != "0" && $row_select_pipe['s59'] != null) {
								echo $row_select_pipe['s59'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s69'] != "" && $row_select_pipe['s69'] != "0" && $row_select_pipe['s69'] != null) {
								echo $row_select_pipe['s69'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>10 MM</b></td>
				<td style="border: 1px solid black;"><b>4.75 MM</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s30'] != "" && $row_select_pipe['s30'] != "0" && $row_select_pipe['s30'] != null) {
								echo $row_select_pipe['s30'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s40'] != "" && $row_select_pipe['s40'] != "0" && $row_select_pipe['s40'] != null) {
								echo $row_select_pipe['s40'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s60'] != "" && $row_select_pipe['s60'] != "0" && $row_select_pipe['s60'] != null) {
								echo $row_select_pipe['s60'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s60'] != "" && $row_select_pipe['s60'] != "0" && $row_select_pipe['s60'] != null) {
								echo $row_select_pipe['s60'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td style="border: 1px solid black;"><b>Total</b></td>
				<td style="border: 1px solid black;"><b></b></td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['s6total'] != "" && $row_select_pipe['s6total'] != "0" && $row_select_pipe['s6total'] != null) {
								echo $row_select_pipe['s6total'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr style="border: 1px solid black;">
				<td colspan="3" style="border: 0px solid black;">Results :- Soundness</td>
				<td colspan="3" style="border: 0px solid black;"> <?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0" && $row_select_pipe['soundness'] != null) {
																		echo $row_select_pipe['soundness'];
																	} else {
																		echo "";
																	} ?> %</td>


			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test1" style="" height="20%">
			<tr style="border: 1px solid black;height:20px;">
				<td colspan="2" style="border: 0px solid black;padding:7px 7px;"><b>Test-10 10% Fine Value</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;padding:7px 7px;"><b>IS 2386 Part-4</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:5%;height:45px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:51%;height:15px;">
					<center><b>Particular</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;height:15px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;height:15px;">
					<center><b>2</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of Sample taken in Mould in gm (A)</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_a_1'] != "" && $row_select_pipe['f_a_1'] != "0" && $row_select_pipe['f_a_1'] != null) {
								echo $row_select_pipe['f_a_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_a_2'] != "" && $row_select_pipe['f_a_2'] != "0" && $row_select_pipe['f_a_2'] != null) {
								echo $row_select_pipe['f_a_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>2</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;"><b>Weight of Sample after Penetration, passing through 2.36 mm IS Sieve in gm (B)</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_c_1'] != "" && $row_select_pipe['f_c_1'] != "0" && $row_select_pipe['f_c_1'] != null) {
								echo $row_select_pipe['f_c_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_c_2'] != "" && $row_select_pipe['f_c_2'] != "0" && $row_select_pipe['f_c_2'] != null) {
								echo $row_select_pipe['f_c_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>3</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;"><b>Percentage of Passing Y=(B/A)X100</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_d_1'] != "" && $row_select_pipe['f_d_1'] != "0" && $row_select_pipe['f_d_1'] != null) {
								echo $row_select_pipe['f_d_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_d_2'] != "" && $row_select_pipe['f_d_2'] != "0" && $row_select_pipe['f_d_2'] != null) {
								echo $row_select_pipe['f_d_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td style="border: 1px solid black;height:15px;">
					<center><b>4</b></center>
				</td>
				<td style="border: 1px solid black;height:15px;"><b>Load in KN (X)</b></td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_b_1'] != "" && $row_select_pipe['f_b_1'] != "0" && $row_select_pipe['f_b_1'] != null) {
								echo $row_select_pipe['f_b_1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['f_b_2'] != "" && $row_select_pipe['f_b_2'] != "0" && $row_select_pipe['f_b_2'] != null) {
								echo $row_select_pipe['f_b_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average Value Percentage of Passing (Y)</b></td>

				<td colspan="2" style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['avg_f_d'] != "" && $row_select_pipe['avg_f_d'] != "0" && $row_select_pipe['avg_f_d'] != null) {
								echo $row_select_pipe['avg_f_d'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="2" style="border: 1px solid black;text-align:right;height:15px;"><b>Average Value of Load (X)</b></td>

				<td colspan="2" style="border: 1px solid black;height:15px;">
					<center><?php if ($row_select_pipe['avg_f_c'] != "" && $row_select_pipe['avg_f_c'] != "0" && $row_select_pipe['avg_f_c'] != null) {
								echo $row_select_pipe['avg_f_c'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>

		</table>
							
		<table align="center" width="100%" class="test1" style="border: 1px solid black;border-top: 0px solid black;" height="Auto">
			<tr>
				<td colspan="8" style="border: 0px solid black;text-align:left;font-size:11px;padding:7px 7px;"><b>Note :- A repeat test shall be run if the load does not produce % of fines within tha range 7.5 to 12.5.</b></td>


			</tr>

			<tr>
				<td style="border: 0px solid black;text-align:right;"><b>&nbsp;&nbsp; 10 % Fine Value</b></td>

				<td style="border: 0px solid black;text-align:center;">=</td>
				<td style="border: 0px solid black;text-align:center;">14&nbsp;&nbsp;&nbsp;&nbsp; x&nbsp;&nbsp; &nbsp;&nbsp; X
					<hr>
				</td>
				<td style="border: 0px solid black;text-align:right;">=</td>
				<td style="border: 0px solid black;text-align:center;">14&nbsp;&nbsp; &nbsp;&nbsp;x&nbsp;&nbsp; &nbsp;&nbsp; <?php if ($row_select_pipe['avg_f_c'] != "" && $row_select_pipe['avg_f_c'] != "0" && $row_select_pipe['avg_f_c'] != null) {
																																	echo $row_select_pipe['avg_f_c'];
																																} else {
																																	echo "&nbsp;";
																																} ?>
					<hr>
				</td>
				<td style="border: 0px solid black;text-align:center;">=</td>
				<td style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['fines_value'] != "" && $row_select_pipe['fines_value'] != "0" && $row_select_pipe['fines_value'] != null) {
																			echo $row_select_pipe['fines_value'];
																		} else {
																			echo "&nbsp;";
																		} ?></td>
				<td style="border: 0px solid black;text-align:left;">KN</td>

			</tr>
			<tr>
				<td style="border: 0px solid black;"><b></b></td>

				<td style="border: 0px solid black;text-align:center;"></td>
				<td style="border: 0px solid black;text-align:center;">Y&nbsp;&nbsp; &nbsp;&nbsp; +&nbsp;&nbsp; &nbsp;&nbsp; 4</td>
				<td style="border: 0px solid black;text-align:center;"></td>
				<td style="border: 0px solid black;text-align:center;"><?php if ($row_select_pipe['avg_f_d'] != "" && $row_select_pipe['avg_f_d'] != "0" && $row_select_pipe['avg_f_d'] != null) {
																			echo $row_select_pipe['avg_f_d'];
																		} else {
																			echo "&nbsp;";
																		} ?>&nbsp;&nbsp; &nbsp;&nbsp; +&nbsp;&nbsp; &nbsp;&nbsp; 4</td>
				<td style="border: 0px solid black;text-align:center;"></td>
				<td style="border: 0px solid black;text-align:left;"></td>
				<td style="border: 0px solid black;text-align:left;"></td>

			</tr>



		</table>
		<br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 4 of 6</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

		<div class="pagebreak"> </div>
		<br><br>

		<?php
		/*}
					if($row_select_pipe['alk_10']!="" && $row_select_pipe['alk_10']!="0" && $row_select_pipe['alk_10']!=null)
					{
						$pagecnt++;*/

		?>
		
		
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRAVEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 2386 </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>

		
		<table align="center" width="100%" class="test1" style="" height="18.5%">
			<tr style="border: 1px solid black;height:20px;">
				<td colspan="2" style="border: 0px solid black;padding:7px 7px;"><b>Test-11 Alkali Reactivity</b></td>
				<td colspan="2" style="text-align:right;border: 0px solid black;padding-right:20px;padding:7px 7px;"><b>IS 2386 Part-7</b></td>
			</tr>


			<tr>
				<td style="border: 1px solid black;width:5%;height:20px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:51%;">
					<center><b>Sc Observed</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>Weight W1</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>Weight W2</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;height:55px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;"><b>
						<center><?php if ($row_select_pipe['alk_1'] != "" && $row_select_pipe['alk_1'] != "0" && $row_select_pipe['alk_1'] != null) {
									echo $row_select_pipe['alk_1'];
								} else {
									echo " <br>";
								} ?></center>
					</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['alk_2'] != "" && $row_select_pipe['alk_2'] != "0" && $row_select_pipe['alk_2'] != null) {
								echo $row_select_pipe['alk_2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['alk_3'] != "" && $row_select_pipe['alk_3'] != "0" && $row_select_pipe['alk_3'] != null) {
								echo $row_select_pipe['alk_3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:55px;">
					<center><b>Sc = W1 - W2&nbsp;&nbsp;&nbsp;x&nbsp;&nbsp;&nbsp;3330 = </b><?php echo $row_select_pipe['alk_4'] . "  "; ?><b>milli mol/Lit.</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;width:5%;height:20px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:51%;">
					<center><b>V1(ml)</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>V2 (ml)</b></center>
				</td>
				<td style="border: 1px solid black;width:22%;">
					<center><b>V3 (ml)</b></center>
				</td>

			</tr>
			<tr>
				<td style="border: 1px solid black;height:55px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['alk_5'] != "" && $row_select_pipe['alk_5'] != "0" && $row_select_pipe['alk_5'] != null) {
									echo $row_select_pipe['alk_5'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['alk_6'] != "" && $row_select_pipe['alk_6'] != "0" && $row_select_pipe['alk_6'] != null) {
								echo $row_select_pipe['alk_6'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['alk_7'] != "" && $row_select_pipe['alk_7'] != "0" && $row_select_pipe['alk_7'] != null) {
								echo $row_select_pipe['alk_7'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:55px;">
					<center><b>Rc = (20 x N (V2 - V3) x 1000)/V1 &nbsp; = </b><?php if ($row_select_pipe['alk_8'] != "" && $row_select_pipe['alk_8'] != "0" && $row_select_pipe['alk_8'] != null) {
																					echo $row_select_pipe['alk_8'] . "  ";
																				} else {
																					echo " <br>";
																				} ?><b>milli mol/Lit.</b></center>
				</td>

			</tr>
		</table>

		<table align="center" width="100%" class="test1" style="" height="18.5%">
			<tr>
				<td style="border: 1px solid black;width:5%;height:20px;">
					<center><b>Sr.<br>No.</b></center>
				</td>
				<td style="border: 1px solid black;width:47.5%;">
					<center><b>Sc/Rc/Ratio</b></center>
				</td>
				<td style="border: 1px solid black;width:47.5%;">
					<center><b>Aggregate</b></center>
				</td>



			</tr>
			<tr>
				<td style="border: 1px solid black;height:55px;">
					<center><b>1</b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['alk_9'] != "" && $row_select_pipe['alk_9'] != "0" && $row_select_pipe['alk_9'] != null) {
									echo $row_select_pipe['alk_9'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['alk_10'] != "" && $row_select_pipe['alk_10'] != "0" && $row_select_pipe['alk_10'] != null) {
								echo $row_select_pipe['alk_10'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:55px;">
					<center><b>Ratio = Sc / Rc = </b><?php if ($row_select_pipe['alk_11'] != "" && $row_select_pipe['alk_11'] != "0" && $row_select_pipe['alk_11'] != null) {
															echo $row_select_pipe['alk_11'];
														} else {
															echo " <br>";
														} ?></center>
				</td>

			</tr>


		</table>
		<br>

		<table align="center" width="100%" class="test1" style="" height="Auto">
			<tr>
				<td style="border: 0px solid black;height:20px"><b>R<sub>c</sub></b></td>
				<td style="border: 0px solid black;height:20px"><b>=</b></td>
				<td style="border: 0px solid black;height:20px">The Reduction In Alkalinity, In Millimoles Per Liter.</td>

			</tr>
			<tr>
				<td style="border: 0px solid black;height:20px"><b>N</b></td>
				<td style="border: 0px solid black;height:20px"><b>=</b></td>
				<td style="border: 0px solid black;height:20px">Normality Of The Hydrochloric acid Used for the titretion.</td>

			</tr>
			<tr>
				<td style="border: 0px solid black;height:20px"><b>V<sub>1</sub></b></td>
				<td style="border: 0px solid black;height:20px"><b>=</b></td>
				<td style="border: 0px solid black;height:20px">Volume in ml of dilute solution.</td>

			</tr>
			<tr>
				<td style="border: 0px solid black;height:20px"><b>V<sub>2</sub></b></td>
				<td style="border: 0px solid black;height:20px"><b>=</b></td>
				<td style="border: 0px solid black;height:20px">Volume of Hydrochloric acid in ml used to attain the phenolphthalein end point in the test sample.</td>

			</tr>
			<tr>
				<td style="border: 0px solid black;height:20px"><b>V<sub>3</sub></b></td>
				<td style="border: 0px solid black;height:20px"><b>=</b></td>
				<td style="border: 0px solid black;height:20px">Volume of Hydrochloric acid in ml used to attain the phenolphthalein end point in the test Blank.</td>

			</tr>
		</table>
		<Br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 5 of 6</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

		<?php

		/*}
					if($row_select_pipe['liquide_limit']!="" && $row_select_pipe['liquide_limit']!="0" && $row_select_pipe['liquide_limit']!=null)
					{
						$pagecnt++;*/
		?>
		<div class="pagebreak"> </div>
		<Br>
		<br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">GRAVEL</td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;width: 21%;">Format No :-</td>
								<td style="font-weight: bold;padding: 5px 5px;width:30%;">FMT-OBS-00</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Date of receipt :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Description :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Location Name :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $source; ?><?php if ($material_location == "0") {
																																echo "In Laboratory";
																															} else {
																																echo "In Field";
																															} ?> <?php echo $row_select['location_source']; ?></td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="4"></td>
							</tr>
						</table>
					</td>
				</tr>
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse;border-left: 1px solid;border-right: 1px solid;border-bottom:1px solid;margin-bottom:10px;">
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border-top: 0;width: 20%;">Test Method :-</td>
								<td style="padding: 5px;border-left: 1px solid;" colspan="3">IS : 2386 </td>
							</tr>
							<tr>
								<td style="padding: 1px;border: 1px solid;" colspan="6"></td>
							</tr>
							<tr>
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>


		<table align="center" width="100%" class="test1" style="" height="Auto">
			<tr style="border: 1px solid black;height:20px;">
				<td colspan="8" style="border: 0px solid black;padding:7px 7px;"><b>Test-12 Determination of Liquid Limit (Using Cone Penetraton Apparatus) and Plastic Limit - IS 2720 (Part 5) : 1985 Clause 6 &amp; 7 (One Point Method)</b></td>
			</tr>
			<tr style="border: 1px solid black;height:20px;">
				<td colspan="8" style="border: 0px solid black;padding:7px 7px;"><b>Sample Passing Through 425 Micron IS Sieve</b></td>
			</tr>

			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:7px 7px;">
					<center><b>Sample Weight about >> 150 gm</b></center>
				</td>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:7px 7px;">
					<center><b>Period of Soaking Before Test >> 24 Hrs</b></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b> </b></td>
				<td colspan="2" style="border: 1px solid black;padding:7px 7px;"><b>
						<center>Liquid Limit</center>
					</b></td>
				<td colspan="2" style="border: 1px solid black;padding:7px 7px;"><b>
						<center>Plastic Limit</center>
					</b></td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Determination No.</b></td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>
						<center>1</center>
					</b></td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>
						<center>2</center>
					</b></td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>
						<center>1</center>
					</b></td>
				<td style="border: 1px solid black;padding:5px 7px;"><b>
						<center>2</center>
					</b></td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> No. of Penetration (D) (mm)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen1'] != "" && $row_select_pipe['pen1'] != "0" && $row_select_pipe['pen1'] != null) {
								echo $row_select_pipe['pen1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen2'] != "" && $row_select_pipe['pen2'] != "0" && $row_select_pipe['pen2'] != null) {
								echo $row_select_pipe['pen2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen3'] != "" && $row_select_pipe['pen3'] != "0" && $row_select_pipe['pen3'] != null) {
								echo $row_select_pipe['pen3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['pen4'] != "" && $row_select_pipe['pen4'] != "0" && $row_select_pipe['pen4'] != null) {
								echo $row_select_pipe['pen4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Container No.</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cont1'] != "" && $row_select_pipe['cont1'] != "0" && $row_select_pipe['cont1'] != null) {
								echo $row_select_pipe['cont1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cont2'] != "" && $row_select_pipe['cont2'] != "0" && $row_select_pipe['cont2'] != null) {
								echo $row_select_pipe['cont2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cont3'] != "" && $row_select_pipe['cont3'] != "0" && $row_select_pipe['cont3'] != null) {
								echo $row_select_pipe['cont3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['cont4'] != "" && $row_select_pipe['cont4'] != "0" && $row_select_pipe['cont4'] != null) {
								echo $row_select_pipe['cont4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Weight of Container + Wet Sample (gm)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wc1'] != "" && $row_select_pipe['wc1'] != "0" && $row_select_pipe['wc1'] != null) {
								echo $row_select_pipe['wc1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wc2'] != "" && $row_select_pipe['wc2'] != "0" && $row_select_pipe['wc2'] != null) {
								echo $row_select_pipe['wc2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wc3'] != "" && $row_select_pipe['wc3'] != "0" && $row_select_pipe['wc3'] != null) {
								echo $row_select_pipe['wc3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wc4'] != "" && $row_select_pipe['wc4'] != "0" && $row_select_pipe['wc4'] != null) {
								echo $row_select_pipe['wc4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Weight of Container + Oven Dry Sample (gm)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['od1'] != "" && $row_select_pipe['od1'] != "0" && $row_select_pipe['od1'] != null) {
								echo $row_select_pipe['od1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['od2'] != "" && $row_select_pipe['od2'] != "0" && $row_select_pipe['od2'] != null) {
								echo $row_select_pipe['od2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['od3'] != "" && $row_select_pipe['od3'] != "0" && $row_select_pipe['od3'] != null) {
								echo $row_select_pipe['od3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['od4'] != "" && $row_select_pipe['od4'] != "0" && $row_select_pipe['od4'] != null) {
								echo $row_select_pipe['od4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Weight of Water (gm)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ww1'] != "" && $row_select_pipe['ww1'] != "0" && $row_select_pipe['ww1'] != null) {
								echo $row_select_pipe['ww1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ww2'] != "" && $row_select_pipe['ww2'] != "0" && $row_select_pipe['ww2'] != null) {
								echo $row_select_pipe['ww2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ww3'] != "" && $row_select_pipe['ww3'] != "0" && $row_select_pipe['ww3'] != null) {
								echo $row_select_pipe['ww3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ww4'] != "" && $row_select_pipe['ww4'] != "0" && $row_select_pipe['ww4'] != null) {
								echo $row_select_pipe['ww4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Weight of Container (gm)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wf1'] != "" && $row_select_pipe['wf1'] != "0" && $row_select_pipe['wf1'] != null) {
								echo $row_select_pipe['wf1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wf2'] != "" && $row_select_pipe['wf2'] != "0" && $row_select_pipe['wf2'] != null) {
								echo $row_select_pipe['wf2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wf3'] != "" && $row_select_pipe['wf3'] != "0" && $row_select_pipe['wf3'] != null) {
								echo $row_select_pipe['wf3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['wf3'] != "" && $row_select_pipe['wf3'] != "0" && $row_select_pipe['wf3'] != null) {
								echo $row_select_pipe['wf3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Weight of Oven Dry Sample (gm)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ds1'] != "" && $row_select_pipe['ds1'] != "0" && $row_select_pipe['ds1'] != null) {
								echo $row_select_pipe['ds1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ds2'] != "" && $row_select_pipe['ds2'] != "0" && $row_select_pipe['ds2'] != null) {
								echo $row_select_pipe['ds2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ds3'] != "" && $row_select_pipe['ds3'] != "0" && $row_select_pipe['ds3'] != null) {
								echo $row_select_pipe['ds3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ds4'] != "" && $row_select_pipe['ds4'] != "0" && $row_select_pipe['ds4'] != null) {
								echo $row_select_pipe['ds4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Moisture % (W<sub>N</sub>)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mo1'] != "" && $row_select_pipe['mo1'] != "0" && $row_select_pipe['mo1'] != null) {
								echo $row_select_pipe['mo1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mo2'] != "" && $row_select_pipe['mo2'] != "0" && $row_select_pipe['mo2'] != null) {
								echo $row_select_pipe['mo2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mo3'] != "" && $row_select_pipe['mo3'] != "0" && $row_select_pipe['mo3'] != null) {
								echo $row_select_pipe['mo3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['mo4'] != "" && $row_select_pipe['mo4'] != "0" && $row_select_pipe['mo4'] != null) {
								echo $row_select_pipe['mo4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Moisture % (W<sub>L</sub>) = (W<sub>N</sub>)/(0.65 + 0.0175 D)</b></td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ln1'] != "" && $row_select_pipe['ln1'] != "0" && $row_select_pipe['ln1'] != null) {
								echo $row_select_pipe['ln1'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ln2'] != "" && $row_select_pipe['ln2'] != "0" && $row_select_pipe['ln2'] != null) {
								echo $row_select_pipe['ln2'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ln3'] != "" && $row_select_pipe['ln3'] != "0" && $row_select_pipe['ln3'] != null) {
								echo $row_select_pipe['ln3'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['ln4'] != "" && $row_select_pipe['ln4'] != "0" && $row_select_pipe['ln4'] != null) {
								echo $row_select_pipe['ln4'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b> Average</b></td>
				<td colspan="2" style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_ll'] != "" && $row_select_pipe['avg_ll'] != "0" && $row_select_pipe['avg_ll'] != null) {
								echo $row_select_pipe['avg_ll'];
							} else {
								echo " <br>";
							} ?></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">
					<center><?php if ($row_select_pipe['avg_pl'] != "" && $row_select_pipe['avg_pl'] != "0" && $row_select_pipe['avg_pl'] != null) {
								echo $row_select_pipe['avg_pl'];
							} else {
								echo " <br>";
							} ?></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;padding:5px 7px;"><b>
						<center> Liquid Limit % (W<sub>L</sub>)</center>
					</b></td>
				<td colspan="2" style="border: 1px solid black;padding:5px 7px;">
					<center><b>Plastic Limit % (W<sub>p</sub>)</b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;padding:5px 7px;">
					<center><b>Plasticity Index % (I<sub>p</sub>)</b></center>
				</td>

			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;height:20px;"><b>
						<center><?php if ($row_select_pipe['liquide_limit'] != "" && $row_select_pipe['liquide_limit'] != "0" && $row_select_pipe['liquide_limit'] != null) {
									echo $row_select_pipe['liquide_limit'];
								} else {
									echo " <br>";
								} ?></center>
					</b></td>
				<td colspan="2" style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['plastic_limit'] != "" && $row_select_pipe['plastic_limit'] != "0" && $row_select_pipe['plastic_limit'] != null) {
									echo $row_select_pipe['plastic_limit'];
								} else {
									echo " <br>";
								} ?></b></center>
				</td>
				<td colspan="2" style="border: 1px solid black;">
					<center><b><?php if ($row_select_pipe['pi_value'] != "" && $row_select_pipe['pi_value'] != "0" && $row_select_pipe['pi_value'] != null) {
									echo $row_select_pipe['pi_value'];
								} else {
									echo " <br>";
								} ?></center>
				</td>

			</tr>

		</table>
		<br><br>

		<table align="center" width="100%" class="test1" height="Auto" style="border-top:0px solid;">
				<tr>
					<td>
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
								<td style="height: 25px;border: 1px solid;border-right: 1px solid; border-bottom:0px; border-top:1px solid;" colspan="4"></td>
							</tr>
						
						</table>
					</td>
				</tr>
				<tr>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 6 of 6</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>

		<?php
		/*}		*/
		?>

	</page>

</body>

</html>


<script type="text/javascript">

</script>