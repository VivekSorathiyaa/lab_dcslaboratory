<?php
session_start();
include("../connection.php");
error_reporting(0); ?>
<style>
	@page {
		margin: 0px 30px;
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
	$agSTCment_no = $row_select['agSTCment_no'];
	$branch_name = $row_select['branch_name'];
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
		$fly_source = $row_select4['fly_source'];
	}


	?>

	<br><br><br>

	<page size="A4">
				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH</td>
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
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Discription :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Testing Complete Date :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"> <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
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
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>
		
		<!-- <table align="center" width="100%" class="test1" height="11%">
			<tbody>
				<tr style="border: 1px solid black;">
					<td colspan="3" style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Details of samples &nbsp; &nbsp; : &nbsp; &nbsp; &nbsp;</b></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;width:25%;text-align:left;"><b>&nbsp; Sample ID No.</b></td>
					<td style="border-left:1px solid;width:70%;text-align:left;"><b>&nbsp; <?php echo $job_no; ?></b></td>
				</tr>
				
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Laboratory No :</b>&nbsp;</td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo $lab_no; ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Start Date :</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($start_date)); ?></td>
				</tr>
				<tr style="border: 1px solid black;">
					<td style="border-left:1px solid;text-align:left;"><b>&nbsp; Testing Complete Date:</b></td>
					<td style="border-left:1px solid;text-align:left;">&nbsp; <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
				</tr>
			</tbody>
		</table>
		<br> -->

		<table align="center" width="100%" class="test" height="100px;" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;padding:6px 0px;">&nbsp; <b>1. INITIAL AND FINAL SETTING TIME</b></td>
			</tr>
			<tr>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Setting Time</b></td>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Initial Time (I.T)</b></td>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Final Time (F.T)</b></td>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Time in Min. (I.T - F.T)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">Initial Setting Time</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_1'] != "" && $row_select_pipe['it_1'] != "0" && $row_select_pipe['it_1'] != null) {
																			echo $row_select_pipe['it_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['ft_1'] != "" && $row_select_pipe['ft_1'] != "0" && $row_select_pipe['ft_1'] != null) {
																			echo $row_select_pipe['ft_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_ft_1'] != "" && $row_select_pipe['it_ft_1'] != "0" && $row_select_pipe['it_ft_1'] != null) {
																			echo $row_select_pipe['it_ft_1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">Final Setting Time</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_2'] != "" && $row_select_pipe['it_2'] != "0" && $row_select_pipe['it_2'] != null) {
																			echo $row_select_pipe['it_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['ft_2'] != "" && $row_select_pipe['ft_2'] != "0" && $row_select_pipe['ft_2'] != null) {
																			echo $row_select_pipe['ft_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_ft_2'] != "" && $row_select_pipe['it_ft_2'] != "0" && $row_select_pipe['it_ft_2'] != null) {
																			echo $row_select_pipe['it_ft_2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test" height="150px;" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;padding:6px 0px;">&nbsp; <b>2. FINENESS BY DRY SIEVEING</b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Description</b></td>
				<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Sample</b></td>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Average</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>I</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>II</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>III</b></td>
			</tr>
			<tr>
				<td width="5%" style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td width="40%" style="border: 1px solid black; text-align:left;">&nbsp; Weight of Sample Taken (A) gm</td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_1'] != "" && $row_select_pipe['dry_wt_1'] != "0" && $row_select_pipe['dry_wt_1'] != null) {
																						echo $row_select_pipe['dry_wt_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_2'] != "" && $row_select_pipe['dry_wt_2'] != "0" && $row_select_pipe['dry_wt_2'] != null) {
																						echo $row_select_pipe['dry_wt_2'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_3'] != "" && $row_select_pipe['dry_wt_3'] != "0" && $row_select_pipe['dry_wt_3'] != null) {
																						echo $row_select_pipe['dry_wt_3'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_avg'] != "" && $row_select_pipe['dry_wt_avg'] != "0" && $row_select_pipe['dry_wt_avg'] != null) {
																						echo $row_select_pipe['dry_wt_avg'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Weight of Residue (B) gm <br>&nbsp; (retained weight on 90micron I.S sieve)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_1'] != "" && $row_select_pipe['dry_res_1'] != "0" && $row_select_pipe['dry_res_1'] != null) {
																			echo $row_select_pipe['dry_res_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_2'] != "" && $row_select_pipe['dry_res_2'] != "0" && $row_select_pipe['dry_res_2'] != null) {
																			echo $row_select_pipe['dry_res_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_3'] != "" && $row_select_pipe['dry_res_3'] != "0" && $row_select_pipe['dry_res_3'] != null) {
																			echo $row_select_pipe['dry_res_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_avg'] != "" && $row_select_pipe['dry_res_avg'] != "0" && $row_select_pipe['dry_res_avg'] != null) {
																			echo $row_select_pipe['dry_res_avg'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; % Retained on Sieve ((A-B/A) x 100 )</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_1'] != "" && $row_select_pipe['dry_sieve_1'] != "0" && $row_select_pipe['dry_sieve_1'] != null) {
																			echo $row_select_pipe['dry_sieve_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_2'] != "" && $row_select_pipe['dry_sieve_2'] != "0" && $row_select_pipe['dry_sieve_2'] != null) {
																			echo $row_select_pipe['dry_sieve_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_3'] != "" && $row_select_pipe['dry_sieve_3'] != "0" && $row_select_pipe['dry_sieve_3'] != null) {
																			echo $row_select_pipe['dry_sieve_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_avg'] != "" && $row_select_pipe['dry_sieve_avg'] != "0" && $row_select_pipe['dry_sieve_avg'] != null) {
																			echo $row_select_pipe['dry_sieve_avg'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="5" style="border: 1px solid black; font-size:12px;padding:6px 0px;">&nbsp; <b>3. FINENESS BY BLAIN AIR PERMEABILITY</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Description</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>I</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>II</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>III</b></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td width="60%" style="border: 1px solid black; text-align:left;">&nbsp; M2 in gms (wt of mercury)</td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m2_1'] != "" && $row_select_pipe['per_m2_1'] != "0" && $row_select_pipe['per_m2_1'] != null) {
																						echo $row_select_pipe['per_m2_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m2_2'] != "" && $row_select_pipe['per_m2_2'] != "0" && $row_select_pipe['per_m2_2'] != null) {
																						echo $row_select_pipe['per_m2_2'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m2_3'] != "" && $row_select_pipe['per_m2_3'] != "0" && $row_select_pipe['per_m2_3'] != null) {
																						echo $row_select_pipe['per_m2_3'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; M3 in gms (wt of mercury after forming cement bed)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m3_1'] != "" && $row_select_pipe['per_m3_1'] != "0" && $row_select_pipe['per_m3_1'] != null) {
																			echo $row_select_pipe['per_m3_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m3_2'] != "" && $row_select_pipe['per_m3_2'] != "0" && $row_select_pipe['per_m3_2'] != null) {
																			echo $row_select_pipe['per_m3_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m3_3'] != "" && $row_select_pipe['per_m3_3'] != "0" && $row_select_pipe['per_m3_3'] != null) {
																			echo $row_select_pipe['per_m3_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; D is the density of mercury at the test temprature taken from Table 1</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_d_1'] != "" && $row_select_pipe['per_d_1'] != "0" && $row_select_pipe['per_d_1'] != null) {
																			echo $row_select_pipe['per_d_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_d_2'] != "" && $row_select_pipe['per_d_2'] != "0" && $row_select_pipe['per_d_2'] != null) {
																			echo $row_select_pipe['per_d_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_d_3'] != "" && $row_select_pipe['per_d_3'] != "0" && $row_select_pipe['per_d_3'] != null) {
																			echo $row_select_pipe['per_d_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>4</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; The bed Volume V is given by: V = ((m2 - m3)/D)(cm<sup>3</sup>)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_v_1'] != "" && $row_select_pipe['per_v_1'] != "0" && $row_select_pipe['per_v_1'] != null) {
																			echo $row_select_pipe['per_v_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_v_2'] != "" && $row_select_pipe['per_v_2'] != "0" && $row_select_pipe['per_v_2'] != null) {
																			echo $row_select_pipe['per_v_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_v_3'] != "" && $row_select_pipe['per_v_3'] != "0" && $row_select_pipe['per_v_3'] != null) {
																			echo $row_select_pipe['per_v_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Quantity of Cement Calculated from (Poroosity e = 0.500) m1</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m1_1'] != "" && $row_select_pipe['per_m1_1'] != "0" && $row_select_pipe['per_m1_1'] != null) {
																			echo $row_select_pipe['per_m1_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m1_2'] != "" && $row_select_pipe['per_m1_2'] != "0" && $row_select_pipe['per_m1_2'] != null) {
																			echo $row_select_pipe['per_m1_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m1_3'] != "" && $row_select_pipe['per_m1_3'] != "0" && $row_select_pipe['per_m1_3'] != null) {
																			echo $row_select_pipe['per_m1_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Measure time of cement under test (t) (sec)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mea_1'] != "" && $row_select_pipe['per_mea_1'] != "0" && $row_select_pipe['per_mea_1'] != null) {
																			echo $row_select_pipe['per_mea_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mea_2'] != "" && $row_select_pipe['per_mea_2'] != "0" && $row_select_pipe['per_mea_2'] != null) {
																			echo $row_select_pipe['per_mea_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mea_3'] != "" && $row_select_pipe['per_mea_3'] != "0" && $row_select_pipe['per_mea_3'] != null) {
																			echo $row_select_pipe['per_mea_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>7</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Mean time (sec)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_1'] != "" && $row_select_pipe['per_mean_1'] != "0" && $row_select_pipe['per_mean_1'] != null) {
																			echo $row_select_pipe['per_mean_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_2'] != "" && $row_select_pipe['per_mean_2'] != "0" && $row_select_pipe['per_mean_2'] != null) {
																			echo $row_select_pipe['per_mean_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_3'] != "" && $row_select_pipe['per_mean_3'] != "0" && $row_select_pipe['per_mean_3'] != null) {
																			echo $row_select_pipe['per_mean_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>8</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Measured Temprature (<sup>o</sup>C)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_temp_1'] != "" && $row_select_pipe['per_temp_1'] != "0" && $row_select_pipe['per_temp_1'] != null) {
																			echo $row_select_pipe['per_temp_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_temp_2'] != "" && $row_select_pipe['per_temp_2'] != "0" && $row_select_pipe['per_temp_2'] != null) {
																			echo $row_select_pipe['per_temp_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_temp_3'] != "" && $row_select_pipe['per_temp_3'] != "0" && $row_select_pipe['per_temp_3'] != null) {
																			echo $row_select_pipe['per_temp_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>9</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Mean Temprature (<sup>o</sup>C)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_temp_1'] != "" && $row_select_pipe['per_mean_temp_1'] != "0" && $row_select_pipe['per_mean_temp_1'] != null) {
																			echo $row_select_pipe['per_mean_temp_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_temp_2'] != "" && $row_select_pipe['per_mean_temp_2'] != "0" && $row_select_pipe['per_mean_temp_2'] != null) {
																			echo $row_select_pipe['per_mean_temp_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_temp_3'] != "" && $row_select_pipe['per_mean_temp_3'] != "0" && $row_select_pipe['per_mean_temp_3'] != null) {
																			echo $row_select_pipe['per_mean_temp_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>10</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Surfac, m<sup>2</sup>/kg</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_sur_1'] != "" && $row_select_pipe['per_sur_1'] != "0" && $row_select_pipe['per_sur_1'] != null) {
																			echo $row_select_pipe['per_sur_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_sur_2'] != "" && $row_select_pipe['per_sur_2'] != "0" && $row_select_pipe['per_sur_2'] != null) {
																			echo $row_select_pipe['per_sur_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_sur_3'] != "" && $row_select_pipe['per_sur_3'] != "0" && $row_select_pipe['per_sur_3'] != null) {
																			echo $row_select_pipe['per_sur_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<br>

		<table align="center" width="100%" class="test" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;padding:6px 0px;">&nbsp; <b>4. SOUNDNESS</b></td>
			</tr>
			<tr>
				<td width="40%" style="border: 1px solid black; text-align:center;"><b>Soundness by Le - Chatlier</b></td>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>I</b></td>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>II</b></td>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>Average</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Initial Measurement</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_1_1'] != "" && $row_select_pipe['sou_1_1'] != "0" && $row_select_pipe['sou_1_1'] != null) {
																			echo $row_select_pipe['sou_1_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_2_1'] != "" && $row_select_pipe['sou_2_1'] != "0" && $row_select_pipe['sou_2_1'] != null) {
																			echo $row_select_pipe['sou_2_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_avg1'] != "" && $row_select_pipe['sou_avg1'] != "0" && $row_select_pipe['sou_avg1'] != null) {
																			echo $row_select_pipe['sou_avg1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Final Measurement</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_1_2'] != "" && $row_select_pipe['sou_1_2'] != "0" && $row_select_pipe['sou_1_2'] != null) {
																			echo $row_select_pipe['sou_1_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_2_2'] != "" && $row_select_pipe['sou_2_2'] != "0" && $row_select_pipe['sou_2_2'] != null) {
																			echo $row_select_pipe['sou_2_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_avg2'] != "" && $row_select_pipe['sou_avg2'] != "0" && $row_select_pipe['sou_avg2'] != null) {
																			echo $row_select_pipe['sou_avg2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Difference</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_1_3'] != "" && $row_select_pipe['sou_1_3'] != "0" && $row_select_pipe['sou_1_3'] != null) {
																			echo $row_select_pipe['sou_1_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_2_3'] != "" && $row_select_pipe['sou_2_3'] != "0" && $row_select_pipe['sou_2_3'] != null) {
																			echo $row_select_pipe['sou_2_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_avg3'] != "" && $row_select_pipe['sou_avg3'] != "0" && $row_select_pipe['sou_avg3'] != null) {
																			echo $row_select_pipe['sou_avg3'];
																		} else {
																			echo "";
																		} ?></td>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 1 of 3</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>


		<div class="pagebreak"></div>
		<br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH</td>
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
								<td style="font-weight: bold;padding: 5px 5px;width:30%;">FMT-OBS</td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Material Discription :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px;border: 0;">Testing Complete Date :-</td>
								<td style="font-weight: bold;padding: 5px 5px;"> <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
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
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
						</table>
					</td>
				</tr>
		
		<table align="center" width="100%" class="test" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;padding:5px 0px;">&nbsp; <b>5. LIME REACTIVITY</b></td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;padding:5px 0px;">&nbsp; Standard Test mortar shall be (1:2M:9)(Lime:Pazzolana Standard Sand</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black; text-align:center;padding:5px 0px;">&nbsp; M = Specific gravity of Pazzolana <br> Specific Gravity</td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;padding:5px 0px;">&nbsp; Specific Gravity of Pazzolana: </td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;padding:5px 0px;">&nbsp; Specific Gravity of Lime:</td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><b>% of Water in ml</b></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><b>Measured flow in mm</b></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><b>% of Flow</b></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;">1</td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_1'] != "" && $row_select_pipe['lim_wtr_1'] != "0" && $row_select_pipe['lim_wtr_1'] != null) {
																						echo $row_select_pipe['lim_wtr_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_1'] != "" && $row_select_pipe['lim_mea_1'] != "0" && $row_select_pipe['lim_mea_1'] != null) {
																						echo $row_select_pipe['lim_mea_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_1'] != "" && $row_select_pipe['lim_flow_1'] != "0" && $row_select_pipe['lim_flow_1'] != null) {
																						echo $row_select_pipe['lim_flow_1'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;">2</td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_2'] != "" && $row_select_pipe['lim_wtr_2'] != "0" && $row_select_pipe['lim_wtr_2'] != null) {
																						echo $row_select_pipe['lim_wtr_2'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_2'] != "" && $row_select_pipe['lim_mea_2'] != "0" && $row_select_pipe['lim_mea_2'] != null) {
																						echo $row_select_pipe['lim_mea_2'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_2'] != "" && $row_select_pipe['lim_flow_2'] != "0" && $row_select_pipe['lim_flow_2'] != null) {
																						echo $row_select_pipe['lim_flow_2'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;">3</td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_3'] != "" && $row_select_pipe['lim_wtr_3'] != "0" && $row_select_pipe['lim_wtr_3'] != null) {
																						echo $row_select_pipe['lim_wtr_3'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_3'] != "" && $row_select_pipe['lim_mea_3'] != "0" && $row_select_pipe['lim_mea_3'] != null) {
																						echo $row_select_pipe['lim_mea_3'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_3'] != "" && $row_select_pipe['lim_flow_3'] != "0" && $row_select_pipe['lim_flow_3'] != null) {
																						echo $row_select_pipe['lim_flow_3'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;">4</td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_4'] != "" && $row_select_pipe['lim_wtr_4'] != "0" && $row_select_pipe['lim_wtr_4'] != null) {
																						echo $row_select_pipe['lim_wtr_4'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_4'] != "" && $row_select_pipe['lim_mea_4'] != "0" && $row_select_pipe['lim_mea_4'] != null) {
																						echo $row_select_pipe['lim_mea_4'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_4'] != "" && $row_select_pipe['lim_flow_4'] != "0" && $row_select_pipe['lim_flow_4'] != null) {
																						echo $row_select_pipe['lim_flow_4'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td width="10%" style="border: 1px solid black; text-align:center;">5</td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_5'] != "" && $row_select_pipe['lim_wtr_5'] != "0" && $row_select_pipe['lim_wtr_5'] != null) {
																						echo $row_select_pipe['lim_wtr_5'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_5'] != "" && $row_select_pipe['lim_mea_5'] != "0" && $row_select_pipe['lim_mea_5'] != null) {
																						echo $row_select_pipe['lim_mea_5'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_5'] != "" && $row_select_pipe['lim_flow_5'] != "0" && $row_select_pipe['lim_flow_5'] != null) {
																						echo $row_select_pipe['lim_flow_5'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;padding:5px 0px;">&nbsp; The Amount of Water: <?php if ($row_select_pipe['lim_wtr_amt'] != "" && $row_select_pipe['lim_wtr_amt'] != "0" && $row_select_pipe['lim_wtr_amt'] != null) {
																									echo $row_select_pipe['lim_wtr_amt'];
																								} else {
																									echo "";
																								} ?></td>
			</tr>
			<tr>
				<td colspan="4" style="border: 1px solid black;padding:5px 0px;">&nbsp; (water required to given flow of 70 + 5 percent with 10 drops in 6 second)</td>
			</tr>
		</table>
		<table align="center" width="100%" class="test" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td rowspan="2" width="5%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td rowspan="2" width="10%" style="border: 1px solid black; text-align:center;"><b>No. of Days</b></td>
				<td rowspan="2" width="10%" style="border: 1px solid black; text-align:center;"><b>Weight in gms</b></td>
				<td colspan="3" width="30%" style="border: 1px solid black; text-align:center;"><b>Cube Sze in mm</b></td>
				<td rowspan="2" width="15%" style="border: 1px solid black; text-align:center;"><b>C/ Area mm<sup>2</sup></b></td>
				<td rowspan="2" width="15%" style="border: 1px solid black; text-align:center;"><b>Load in kN</b></td>
				<td rowspan="2" width="15%" style="border: 1px solid black; text-align:center;"><b>Compressive <br> Strength in <br>(N/mm<sup>2</sup>)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Length</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Width</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Height</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">1</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_1'] != "" && $row_select_pipe['lim_day_1'] != "0" && $row_select_pipe['lim_day_1'] != null) {
																			echo $row_select_pipe['lim_day_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_1'] != "" && $row_select_pipe['lim_wt_1'] != "0" && $row_select_pipe['lim_wt_1'] != null) {
																			echo $row_select_pipe['lim_wt_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_1'] != "" && $row_select_pipe['lim_len_1'] != "0" && $row_select_pipe['lim_len_1'] != null) {
																			echo $row_select_pipe['lim_len_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_1'] != "" && $row_select_pipe['lim_w_1'] != "0" && $row_select_pipe['lim_w_1'] != null) {
																			echo $row_select_pipe['lim_w_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_1'] != "" && $row_select_pipe['lim_h_1'] != "0" && $row_select_pipe['lim_h_1'] != null) {
																			echo $row_select_pipe['lim_h_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_1'] != "" && $row_select_pipe['lim_area_1'] != "0" && $row_select_pipe['lim_area_1'] != null) {
																			echo $row_select_pipe['lim_area_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_1'] != "" && $row_select_pipe['lim_load_1'] != "0" && $row_select_pipe['lim_load_1'] != null) {
																			echo $row_select_pipe['lim_load_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_1'] != "" && $row_select_pipe['lim_com_1'] != "0" && $row_select_pipe['lim_com_1'] != null) {
																			echo $row_select_pipe['lim_com_1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">2</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_2'] != "" && $row_select_pipe['lim_day_2'] != "0" && $row_select_pipe['lim_day_2'] != null) {
																			echo $row_select_pipe['lim_day_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_2'] != "" && $row_select_pipe['lim_wt_2'] != "0" && $row_select_pipe['lim_wt_2'] != null) {
																			echo $row_select_pipe['lim_wt_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_2'] != "" && $row_select_pipe['lim_len_2'] != "0" && $row_select_pipe['lim_len_2'] != null) {
																			echo $row_select_pipe['lim_len_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_2'] != "" && $row_select_pipe['lim_w_2'] != "0" && $row_select_pipe['lim_w_2'] != null) {
																			echo $row_select_pipe['lim_w_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_2'] != "" && $row_select_pipe['lim_h_2'] != "0" && $row_select_pipe['lim_h_2'] != null) {
																			echo $row_select_pipe['lim_h_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_2'] != "" && $row_select_pipe['lim_area_2'] != "0" && $row_select_pipe['lim_area_2'] != null) {
																			echo $row_select_pipe['lim_area_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_2'] != "" && $row_select_pipe['lim_load_2'] != "0" && $row_select_pipe['lim_load_2'] != null) {
																			echo $row_select_pipe['lim_load_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_2'] != "" && $row_select_pipe['lim_com_2'] != "0" && $row_select_pipe['lim_com_2'] != null) {
																			echo $row_select_pipe['lim_com_2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">3</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_3'] != "" && $row_select_pipe['lim_day_3'] != "0" && $row_select_pipe['lim_day_3'] != null) {
																			echo $row_select_pipe['lim_day_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_3'] != "" && $row_select_pipe['lim_wt_3'] != "0" && $row_select_pipe['lim_wt_3'] != null) {
																			echo $row_select_pipe['lim_wt_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_3'] != "" && $row_select_pipe['lim_len_3'] != "0" && $row_select_pipe['lim_len_3'] != null) {
																			echo $row_select_pipe['lim_len_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_3'] != "" && $row_select_pipe['lim_w_3'] != "0" && $row_select_pipe['lim_w_3'] != null) {
																			echo $row_select_pipe['lim_w_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_3'] != "" && $row_select_pipe['lim_h_3'] != "0" && $row_select_pipe['lim_h_3'] != null) {
																			echo $row_select_pipe['lim_h_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_3'] != "" && $row_select_pipe['lim_area_3'] != "0" && $row_select_pipe['lim_area_3'] != null) {
																			echo $row_select_pipe['lim_area_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_3'] != "" && $row_select_pipe['lim_load_3'] != "0" && $row_select_pipe['lim_load_3'] != null) {
																			echo $row_select_pipe['lim_load_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_3'] != "" && $row_select_pipe['lim_com_3'] != "0" && $row_select_pipe['lim_com_3'] != null) {
																			echo $row_select_pipe['lim_com_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">4</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_4'] != "" && $row_select_pipe['lim_day_4'] != "0" && $row_select_pipe['lim_day_4'] != null) {
																			echo $row_select_pipe['lim_day_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_4'] != "" && $row_select_pipe['lim_wt_4'] != "0" && $row_select_pipe['lim_wt_4'] != null) {
																			echo $row_select_pipe['lim_wt_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_4'] != "" && $row_select_pipe['lim_len_4'] != "0" && $row_select_pipe['lim_len_4'] != null) {
																			echo $row_select_pipe['lim_len_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_4'] != "" && $row_select_pipe['lim_w_4'] != "0" && $row_select_pipe['lim_w_4'] != null) {
																			echo $row_select_pipe['lim_w_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_4'] != "" && $row_select_pipe['lim_h_4'] != "0" && $row_select_pipe['lim_h_4'] != null) {
																			echo $row_select_pipe['lim_h_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_4'] != "" && $row_select_pipe['lim_area_4'] != "0" && $row_select_pipe['lim_area_4'] != null) {
																			echo $row_select_pipe['lim_area_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_4'] != "" && $row_select_pipe['lim_load_4'] != "0" && $row_select_pipe['lim_load_4'] != null) {
																			echo $row_select_pipe['lim_load_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_4'] != "" && $row_select_pipe['lim_com_4'] != "0" && $row_select_pipe['lim_com_4'] != null) {
																			echo $row_select_pipe['lim_com_4'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;">5</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_5'] != "" && $row_select_pipe['lim_day_5'] != "0" && $row_select_pipe['lim_day_5'] != null) {
																			echo $row_select_pipe['lim_day_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_5'] != "" && $row_select_pipe['lim_wt_5'] != "0" && $row_select_pipe['lim_wt_5'] != null) {
																			echo $row_select_pipe['lim_wt_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_5'] != "" && $row_select_pipe['lim_len_5'] != "0" && $row_select_pipe['lim_len_5'] != null) {
																			echo $row_select_pipe['lim_len_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_5'] != "" && $row_select_pipe['lim_w_5'] != "0" && $row_select_pipe['lim_w_5'] != null) {
																			echo $row_select_pipe['lim_w_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_5'] != "" && $row_select_pipe['lim_h_5'] != "0" && $row_select_pipe['lim_h_5'] != null) {
																			echo $row_select_pipe['lim_h_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_5'] != "" && $row_select_pipe['lim_area_5'] != "0" && $row_select_pipe['lim_area_5'] != null) {
																			echo $row_select_pipe['lim_area_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_5'] != "" && $row_select_pipe['lim_load_5'] != "0" && $row_select_pipe['lim_load_5'] != null) {
																			echo $row_select_pipe['lim_load_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_5'] != "" && $row_select_pipe['lim_com_5'] != "0" && $row_select_pipe['lim_com_5'] != null) {
																			echo $row_select_pipe['lim_com_5'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<br>
		<table align="center" width="100%" class="test" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;padding:5px 0px;">&nbsp; <b>6. COMPRESSIVE STRENGTH</b></td>
			</tr>
			<tr>
				<td width="7%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Days</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Length (mm)</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Width (mm)</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Height (mm)</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Cross sectional Area (mm2)</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Max Load (kN)</b></td>
				<td width="13%" style="border: 1px solid black; text-align:center;"><b>Compressive <br> Strength in <br>(N/mm<sup>2</sup>)</b></td>
			</tr>
			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;">1</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day1'] != "" && $row_select_pipe['day1'] != "0" && $row_select_pipe['day1'] != null) {
																			echo $row_select_pipe['day1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																			echo $row_select_pipe['l1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi1'] != "" && $row_select_pipe['wi1'] != "0" && $row_select_pipe['wi1'] != null) {
																			echo $row_select_pipe['wi1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h1'] != "" && $row_select_pipe['h1'] != "0" && $row_select_pipe['h1'] != null) {
																			echo $row_select_pipe['h1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a1'] != "" && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {
																			echo $row_select_pipe['a1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																			echo $row_select_pipe['load_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																			echo $row_select_pipe['com_1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day2'] != "" && $row_select_pipe['day2'] != "0" && $row_select_pipe['day2'] != null) {
																			echo $row_select_pipe['day2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != "0" && $row_select_pipe['l2'] != null) {
																			echo $row_select_pipe['l2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi2'] != "" && $row_select_pipe['wi2'] != "0" && $row_select_pipe['wi2'] != null) {
																			echo $row_select_pipe['wi2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h2'] != "" && $row_select_pipe['h2'] != "0" && $row_select_pipe['h2'] != null) {
																			echo $row_select_pipe['h2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a2'] != "" && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {
																			echo $row_select_pipe['a2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																			echo $row_select_pipe['load_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																			echo $row_select_pipe['com_2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day3'] != "" && $row_select_pipe['day3'] != "0" && $row_select_pipe['day3'] != null) {
																			echo $row_select_pipe['day3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != "0" && $row_select_pipe['l3'] != null) {
																			echo $row_select_pipe['l3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi3'] != "" && $row_select_pipe['wi3'] != "0" && $row_select_pipe['wi3'] != null) {
																			echo $row_select_pipe['wi3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h3'] != "" && $row_select_pipe['h3'] != "0" && $row_select_pipe['h3'] != null) {
																			echo $row_select_pipe['h3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a3'] != "" && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {
																			echo $row_select_pipe['a3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																			echo $row_select_pipe['load_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																			echo $row_select_pipe['com_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td colspan="7" style="border: 1px solid black; text-align:right;">AVERAGE &nbsp;</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['avg_com1'] != "" && $row_select_pipe['avg_com1'] != "0" && $row_select_pipe['avg_com1'] != null) {
																			echo $row_select_pipe['avg_com1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;">2</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day4'] != "" && $row_select_pipe['day4'] != "0" && $row_select_pipe['day4'] != null) {
																			echo $row_select_pipe['day4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l4'] != "" && $row_select_pipe['l4'] != "0" && $row_select_pipe['l4'] != null) {
																			echo $row_select_pipe['l4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi4'] != "" && $row_select_pipe['wi4'] != "0" && $row_select_pipe['wi4'] != null) {
																			echo $row_select_pipe['wi4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h4'] != "" && $row_select_pipe['h4'] != "0" && $row_select_pipe['h4'] != null) {
																			echo $row_select_pipe['h4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a4'] != "" && $row_select_pipe['a4'] != "0" && $row_select_pipe['a4'] != null) {
																			echo $row_select_pipe['a4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
																			echo $row_select_pipe['load_4'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																			echo $row_select_pipe['com_4'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day5'] != "" && $row_select_pipe['day5'] != "0" && $row_select_pipe['day5'] != null) {
																			echo $row_select_pipe['day5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l5'] != "" && $row_select_pipe['l5'] != "0" && $row_select_pipe['l5'] != null) {
																			echo $row_select_pipe['l5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi5'] != "" && $row_select_pipe['wi5'] != "0" && $row_select_pipe['wi5'] != null) {
																			echo $row_select_pipe['wi5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h5'] != "" && $row_select_pipe['h5'] != "0" && $row_select_pipe['h5'] != null) {
																			echo $row_select_pipe['h5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a5'] != "" && $row_select_pipe['a5'] != "0" && $row_select_pipe['a5'] != null) {
																			echo $row_select_pipe['a5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
																			echo $row_select_pipe['load_5'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																			echo $row_select_pipe['com_5'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day6'] != "" && $row_select_pipe['day6'] != "0" && $row_select_pipe['day6'] != null) {
																			echo $row_select_pipe['day6'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l6'] != "" && $row_select_pipe['l6'] != "0" && $row_select_pipe['l6'] != null) {
																			echo $row_select_pipe['l6'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi6'] != "" && $row_select_pipe['wi6'] != "0" && $row_select_pipe['wi6'] != null) {
																			echo $row_select_pipe['wi6'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h6'] != "" && $row_select_pipe['h6'] != "0" && $row_select_pipe['h6'] != null) {
																			echo $row_select_pipe['h6'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a6'] != "" && $row_select_pipe['a6'] != "0" && $row_select_pipe['a6'] != null) {
																			echo $row_select_pipe['a6'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
																			echo $row_select_pipe['load_6'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
																			echo $row_select_pipe['com_6'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td colspan="7" style="border: 1px solid black; text-align:right;">AVERAGE &nbsp;</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['avg_com2'] != "" && $row_select_pipe['avg_com2'] != "0" && $row_select_pipe['avg_com2'] != null) {
																			echo $row_select_pipe['avg_com2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td rowspan="3" style="border: 1px solid black; text-align:center;">3</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day7'] != "" && $row_select_pipe['day7'] != "0" && $row_select_pipe['day7'] != null) {
																			echo $row_select_pipe['day7'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l7'] != "" && $row_select_pipe['l7'] != "0" && $row_select_pipe['l7'] != null) {
																			echo $row_select_pipe['l7'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi7'] != "" && $row_select_pipe['wi7'] != "0" && $row_select_pipe['wi7'] != null) {
																			echo $row_select_pipe['wi7'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h7'] != "" && $row_select_pipe['h7'] != "0" && $row_select_pipe['h7'] != null) {
																			echo $row_select_pipe['h7'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a7'] != "" && $row_select_pipe['a7'] != "0" && $row_select_pipe['a7'] != null) {
																			echo $row_select_pipe['a7'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
																			echo $row_select_pipe['load_7'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
																			echo $row_select_pipe['com_7'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day8'] != "" && $row_select_pipe['day8'] != "0" && $row_select_pipe['day8'] != null) {
																			echo $row_select_pipe['day8'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l8'] != "" && $row_select_pipe['l8'] != "0" && $row_select_pipe['l8'] != null) {
																			echo $row_select_pipe['l8'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi8'] != "" && $row_select_pipe['wi8'] != "0" && $row_select_pipe['wi8'] != null) {
																			echo $row_select_pipe['wi8'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h8'] != "" && $row_select_pipe['h8'] != "0" && $row_select_pipe['h8'] != null) {
																			echo $row_select_pipe['h8'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a8'] != "" && $row_select_pipe['a8'] != "0" && $row_select_pipe['a8'] != null) {
																			echo $row_select_pipe['a8'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
																			echo $row_select_pipe['load_8'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
																			echo $row_select_pipe['com_8'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day9'] != "" && $row_select_pipe['day9'] != "0" && $row_select_pipe['day9'] != null) {
																			echo $row_select_pipe['day9'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l9'] != "" && $row_select_pipe['l9'] != "0" && $row_select_pipe['l9'] != null) {
																			echo $row_select_pipe['l9'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi9'] != "" && $row_select_pipe['wi9'] != "0" && $row_select_pipe['wi9'] != null) {
																			echo $row_select_pipe['wi9'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h9'] != "" && $row_select_pipe['h9'] != "0" && $row_select_pipe['h9'] != null) {
																			echo $row_select_pipe['h9'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a9'] != "" && $row_select_pipe['a9'] != "0" && $row_select_pipe['a9'] != null) {
																			echo $row_select_pipe['a9'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_9'] != "" && $row_select_pipe['load_9'] != "0" && $row_select_pipe['load_9'] != null) {
																			echo $row_select_pipe['load_9'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) {
																			echo $row_select_pipe['com_9'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td colspan="7" style="border: 1px solid black; text-align:right;">AVERAGE &nbsp;</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['avg_com3'] != "" && $row_select_pipe['avg_com3'] != "0" && $row_select_pipe['avg_com3'] != null) {
																			echo $row_select_pipe['avg_com3'];
																		} else {
																			echo "";
																		} ?></td>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 2 of 3</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>


		<div class="pagebreak"></div>
		<br><br><br>

				<tr>
					<td>
						<table align="center" width="100%"  style="font-size:11px;height:auto;font-family : Calibri;border-collapse: collapse; ">
							<tr>
								<td style="font-size: 15px;font-weight: bold;text-align: center;padding: 5px;border: 1px solid;">FLYASH</td>
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
								<td style="font-weight: bold;padding: 10px 5px 5px;width:30%;">FMT-OBS</td>
								<td style="font-weight: bold;text-align: left;padding: 10px 5px 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 10px 5px 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;">Sample ID :-</td>
								<td style="font-weight: bold;padding: 5px;"><?php echo $sample_id; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px;border: 0;"></td>
								<td style="font-weight: bold;padding: 5px;"></td>
							</tr>
							<tr>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Material Discription :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"><?php echo $mt_name; ?></td>
								<td style="font-weight: bold;text-align: left;padding: 5px 5px 10px;border: 0;">Testing Complete Date :-</td>
								<td style="font-weight: bold;padding: 5px 5px 10px;"> <?php echo date('d-m-Y', strtotime($end_date)); ?></td>
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
								<td style="font-size: 12px;font-weight: bold;text-align: center; padding: 5px;border-top: 0;" colspan="6">Observation Table</td>
							</tr>
							
						</table>
					</td>
				</tr>
				<br>

		<table align="center" width="100%" class="test" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td width="5%" style="border: 1px solid black; text-align:center;padding:8px 3px;"><b>Sr No.</b></td>
				<td width="55%" style="border: 1px solid black; text-align:center;padding:8px 3px;"><b>Description</b></td>
				<td width="12%" style="border: 1px solid black; text-align:center;padding:8px 3px;"><b>I</b></td>
				<td width="12%" style="border: 1px solid black; text-align:center;padding:8px 3px;"><b>II</b></td>
				<td width="12%" style="border: 1px solid black; text-align:center;padding:8px 3px;"><b>III</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">1</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Mass of Fly Ash in gm (A)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_a_1'] != "" && $row_select_pipe['spg_a_1'] != "0" && $row_select_pipe['spg_a_1'] != null) {
																			echo $row_select_pipe['spg_a_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_a_2'] != "" && $row_select_pipe['spg_a_2'] != "0" && $row_select_pipe['spg_a_2'] != null) {
																			echo $row_select_pipe['spg_a_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_a_3'] != "" && $row_select_pipe['spg_a_3'] != "0" && $row_select_pipe['spg_a_3'] != null) {
																			echo $row_select_pipe['spg_a_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">2</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Displaced volume in cm3 (B)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_b_1'] != "" && $row_select_pipe['spg_b_1'] != "0" && $row_select_pipe['spg_b_1'] != null) {
																			echo $row_select_pipe['spg_b_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_b_2'] != "" && $row_select_pipe['spg_b_2'] != "0" && $row_select_pipe['spg_b_2'] != null) {
																			echo $row_select_pipe['spg_b_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_b_3'] != "" && $row_select_pipe['spg_b_3'] != "0" && $row_select_pipe['spg_b_3'] != null) {
																			echo $row_select_pipe['spg_b_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">3</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Gravity in gm/cm3 (A/B)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ab_1'] != "" && $row_select_pipe['spg_ab_1'] != "0" && $row_select_pipe['spg_ab_1'] != null) {
																			echo $row_select_pipe['spg_ab_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ab_2'] != "" && $row_select_pipe['spg_ab_2'] != "0" && $row_select_pipe['spg_ab_2'] != null) {
																			echo $row_select_pipe['spg_ab_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ab_3'] != "" && $row_select_pipe['spg_ab_3'] != "0" && $row_select_pipe['spg_ab_3'] != null) {
																			echo $row_select_pipe['spg_ab_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">4</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; The bed Volume V is given by:</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_v_1'] != "" && $row_select_pipe['spg_v_1'] != "0" && $row_select_pipe['spg_v_1'] != null) {
																			echo $row_select_pipe['spg_v_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_v_2'] != "" && $row_select_pipe['spg_v_2'] != "0" && $row_select_pipe['spg_v_2'] != null) {
																			echo $row_select_pipe['spg_v_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_v_3'] != "" && $row_select_pipe['spg_v_3'] != "0" && $row_select_pipe['spg_v_3'] != null) {
																			echo $row_select_pipe['spg_v_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">5</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Quantity of FlyAsh Calculated from m1 = 0.500pv (g)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_fly_1'] != "" && $row_select_pipe['spg_fly_1'] != "0" && $row_select_pipe['spg_fly_1'] != null) {
																			echo $row_select_pipe['spg_fly_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_fly_2'] != "" && $row_select_pipe['spg_fly_2'] != "0" && $row_select_pipe['spg_fly_2'] != null) {
																			echo $row_select_pipe['spg_fly_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_fly_3'] != "" && $row_select_pipe['spg_fly_3'] != "0" && $row_select_pipe['spg_fly_3'] != null) {
																			echo $row_select_pipe['spg_fly_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">6</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Surface of standard sample used in calibration Ss in cm2/gm</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_sur_1'] != "" && $row_select_pipe['spg_sur_1'] != "0" && $row_select_pipe['spg_sur_1'] != null) {
																			echo $row_select_pipe['spg_sur_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_sur_2'] != "" && $row_select_pipe['spg_sur_2'] != "0" && $row_select_pipe['spg_sur_2'] != null) {
																			echo $row_select_pipe['spg_sur_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_sur_3'] != "" && $row_select_pipe['spg_sur_3'] != "0" && $row_select_pipe['spg_sur_3'] != null) {
																			echo $row_select_pipe['spg_sur_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">7</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Gravity of standard sample Ps</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_std_1'] != "" && $row_select_pipe['spg_std_1'] != "0" && $row_select_pipe['spg_std_1'] != null) {
																			echo $row_select_pipe['spg_std_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_std_2'] != "" && $row_select_pipe['spg_std_2'] != "0" && $row_select_pipe['spg_std_2'] != null) {
																			echo $row_select_pipe['spg_std_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_std_3'] != "" && $row_select_pipe['spg_std_3'] != "0" && $row_select_pipe['spg_std_3'] != null) {
																			echo $row_select_pipe['spg_std_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">8</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Porosity of prepared bed of standard sample e</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_std_1'] != "" && $row_select_pipe['spg_por_std_1'] != "0" && $row_select_pipe['spg_por_std_1'] != null) {
																			echo $row_select_pipe['spg_por_std_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_std_2'] != "" && $row_select_pipe['spg_por_std_2'] != "0" && $row_select_pipe['spg_por_std_2'] != null) {
																			echo $row_select_pipe['spg_por_std_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_std_3'] != "" && $row_select_pipe['spg_por_std_3'] != "0" && $row_select_pipe['spg_por_std_3'] != null) {
																			echo $row_select_pipe['spg_por_std_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">9</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Porosity of prepared bed of Test sample e</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_test_1'] != "" && $row_select_pipe['spg_por_test_1'] != "0" && $row_select_pipe['spg_por_test_1'] != null) {
																			echo $row_select_pipe['spg_por_test_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_test_2'] != "" && $row_select_pipe['spg_por_test_2'] != "0" && $row_select_pipe['spg_por_test_2'] != null) {
																			echo $row_select_pipe['spg_por_test_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_test_3'] != "" && $row_select_pipe['spg_por_test_3'] != "0" && $row_select_pipe['spg_por_test_3'] != null) {
																			echo $row_select_pipe['spg_por_test_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">10</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Measured time interval in sec for test sample, T</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_1'] != "" && $row_select_pipe['spg_mea_1'] != "0" && $row_select_pipe['spg_mea_1'] != null) {
																			echo $row_select_pipe['spg_mea_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_2'] != "" && $row_select_pipe['spg_mea_2'] != "0" && $row_select_pipe['spg_mea_2'] != null) {
																			echo $row_select_pipe['spg_mea_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_3'] != "" && $row_select_pipe['spg_mea_3'] != "0" && $row_select_pipe['spg_mea_3'] != null) {
																			echo $row_select_pipe['spg_mea_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">11</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Mean Time (sec)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_1'] != "" && $row_select_pipe['spg_mean_1'] != "0" && $row_select_pipe['spg_mean_1'] != null) {
																			echo $row_select_pipe['spg_mean_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_2'] != "" && $row_select_pipe['spg_mean_2'] != "0" && $row_select_pipe['spg_mean_2'] != null) {
																			echo $row_select_pipe['spg_mean_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_3'] != "" && $row_select_pipe['spg_mean_3'] != "0" && $row_select_pipe['spg_mean_3'] != null) {
																			echo $row_select_pipe['spg_mean_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">12</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Measured time in sec for standard sample, T</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_std_1'] != "" && $row_select_pipe['spg_mea_std_1'] != "0" && $row_select_pipe['spg_mea_std_1'] != null) {
																			echo $row_select_pipe['spg_mea_std_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_std_2'] != "" && $row_select_pipe['spg_mea_std_2'] != "0" && $row_select_pipe['spg_mea_std_2'] != null) {
																			echo $row_select_pipe['spg_mea_std_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_std_3'] != "" && $row_select_pipe['spg_mea_std_3'] != "0" && $row_select_pipe['spg_mea_std_3'] != null) {
																			echo $row_select_pipe['spg_mea_std_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">13</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Measured Temprature (<sup>o</sup>C)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_temp_1'] != "" && $row_select_pipe['spg_mea_temp_1'] != "0" && $row_select_pipe['spg_mea_temp_1'] != null) {
																			echo $row_select_pipe['spg_mea_temp_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_temp_2'] != "" && $row_select_pipe['spg_mea_temp_2'] != "0" && $row_select_pipe['spg_mea_temp_2'] != null) {
																			echo $row_select_pipe['spg_mea_temp_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_temp_3'] != "" && $row_select_pipe['spg_mea_temp_3'] != "0" && $row_select_pipe['spg_mea_temp_3'] != null) {
																			echo $row_select_pipe['spg_mea_temp_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">14</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Mean Temprature (<sup>o</sup>C)</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_temp_1'] != "" && $row_select_pipe['spg_mean_temp_1'] != "0" && $row_select_pipe['spg_mean_temp_1'] != null) {
																			echo $row_select_pipe['spg_mean_temp_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_temp_2'] != "" && $row_select_pipe['spg_mean_temp_2'] != "0" && $row_select_pipe['spg_mean_temp_2'] != null) {
																			echo $row_select_pipe['spg_mean_temp_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_temp_3'] != "" && $row_select_pipe['spg_mean_temp_3'] != "0" && $row_select_pipe['spg_mean_temp_3'] != null) {
																			echo $row_select_pipe['spg_mean_temp_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;padding:8px 3px;">15</td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Surface of test sample in cm2/gm =</td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ss_1'] != "" && $row_select_pipe['spg_ss_1'] != "0" && $row_select_pipe['spg_ss_1'] != null) {
																			echo $row_select_pipe['spg_ss_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ss_2'] != "" && $row_select_pipe['spg_ss_2'] != "0" && $row_select_pipe['spg_ss_2'] != null) {
																			echo $row_select_pipe['spg_ss_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ss_3'] != "" && $row_select_pipe['spg_ss_3'] != "0" && $row_select_pipe['spg_ss_3'] != null) {
																			echo $row_select_pipe['spg_ss_3'];
																		} else {
																			echo "";
																		} ?></td>
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
								<td colspan="5" style="font-weight: bold;border-top: 1px solid;text-align: right;border-left:1px solid; border-right:1px solid;padding:5px;">Page 3 of 3</td>
							</tr>
						
						</table>
					</td>
				</tr>
		</table>
	
	</page>


	<!-- 
			<br>
		
		<page size="A4" >
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
		<table align="center" width="100%" class="test"  height="10%" style="border: 1px solid black; font-family : Calibri;">
			<tr>
				<td colspan="4" style="border: 1px solid black; text-align:center;"><h3><b>OBSERVATION & CALCULATION SHEET OF POZZOLANA (FLY ASH)<BR> IS 1727:1967 RA 2018</b></h3></td>
			</tr>
			<tr>
				<td width="20%" style="border: 1px solid black;">&nbsp; <b>Job No.</b></td>
				<td width="80%" colspan="3" style="border: 1px solid black;">&nbsp;<?php echo $job_no; ?></td>
			</tr>
			<tr>
				<td width="20%" style="border: 1px solid black;">&nbsp; <b>Lab No.</b></td>
				<td width="80%" colspan="3" style="border: 1px solid black;">&nbsp;<?php echo $lab_no; ?></td>
			</tr>
			<tr>
				<td width="20%" style="border: 1px solid black;">&nbsp; <b>Identification Mark</b></td>
				<td width="80%" colspan="3" style="border: 1px solid black;">&nbsp;<?php echo $fly_source; ?></td>
			</tr>
			<tr>
				<td width="20%" style="border: 1px solid black;">&nbsp; <b>Starting Date of Test</b></td>
				<td width="30%" style="border: 1px solid black;">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
				<td width="30%" style="border: 1px solid black;">&nbsp; <b>Completion Date of Test</b></td>
				<td width="20%" style="border: 1px solid black;">&nbsp; <?php echo date('d/m/Y', strtotime($start_date)); ?></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test"  height="100px;" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;">&nbsp; <b>1. INITIAL AND FINAL SETTING TIME</b></td>
			</tr>
			<tr>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Setting Time</b></td>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Initial Time (I.T)</b></td>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Final Time (F.T)</b></td>
				<td width="25%" style="border: 1px solid black; text-align:center;"><b>Time in Min. (I.T - F.T)</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Initial Setting Time</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_1'] != "" && $row_select_pipe['it_1'] != "0" && $row_select_pipe['it_1'] != null) {
																			echo $row_select_pipe['it_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['ft_1'] != "" && $row_select_pipe['ft_1'] != "0" && $row_select_pipe['ft_1'] != null) {
																			echo $row_select_pipe['ft_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_ft_1'] != "" && $row_select_pipe['it_ft_1'] != "0" && $row_select_pipe['it_ft_1'] != null) {
																			echo $row_select_pipe['it_ft_1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Final Setting Time</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_2'] != "" && $row_select_pipe['it_2'] != "0" && $row_select_pipe['it_2'] != null) {
																			echo $row_select_pipe['it_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['ft_2'] != "" && $row_select_pipe['ft_2'] != "0" && $row_select_pipe['ft_2'] != null) {
																			echo $row_select_pipe['ft_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['it_ft_2'] != "" && $row_select_pipe['it_ft_2'] != "0" && $row_select_pipe['it_ft_2'] != null) {
																			echo $row_select_pipe['it_ft_2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test"  height="150px;" style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;">&nbsp; <b>2. FINENESS BY DRY SIEVEING</b></td>
			</tr>
			<tr>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Description</b></td>
				<td colspan="3" style="border: 1px solid black; text-align:center;"><b>Sample</b></td>
				<td rowspan="2" style="border: 1px solid black; text-align:center;"><b>Average</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>I</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>II</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>III</b></td>
			</tr>
			<tr>
				<td width="5%"  style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td width="40%" style="border: 1px solid black; text-align:left;">&nbsp; <b>Weight of Sample Taken (A) gm</b></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_1'] != "" && $row_select_pipe['dry_wt_1'] != "0" && $row_select_pipe['dry_wt_1'] != null) {
																						echo $row_select_pipe['dry_wt_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_2'] != "" && $row_select_pipe['dry_wt_2'] != "0" && $row_select_pipe['dry_wt_2'] != null) {
																						echo $row_select_pipe['dry_wt_2'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_3'] != "" && $row_select_pipe['dry_wt_3'] != "0" && $row_select_pipe['dry_wt_3'] != null) {
																						echo $row_select_pipe['dry_wt_3'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_wt_avg'] != "" && $row_select_pipe['dry_wt_avg'] != "0" && $row_select_pipe['dry_wt_avg'] != null) {
																						echo $row_select_pipe['dry_wt_avg'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Weight of Residue (B) gm <br>&nbsp; (retained weight on 90micron I.S sieve)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_1'] != "" && $row_select_pipe['dry_res_1'] != "0" && $row_select_pipe['dry_res_1'] != null) {
																			echo $row_select_pipe['dry_res_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_2'] != "" && $row_select_pipe['dry_res_2'] != "0" && $row_select_pipe['dry_res_2'] != null) {
																			echo $row_select_pipe['dry_res_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_3'] != "" && $row_select_pipe['dry_res_3'] != "0" && $row_select_pipe['dry_res_3'] != null) {
																			echo $row_select_pipe['dry_res_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_res_avg'] != "" && $row_select_pipe['dry_res_avg'] != "0" && $row_select_pipe['dry_res_avg'] != null) {
																			echo $row_select_pipe['dry_res_avg'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>   
			<tr>    
				<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>% Retained on Sieve ((A-B/A) x 100 )</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_1'] != "" && $row_select_pipe['dry_sieve_1'] != "0" && $row_select_pipe['dry_sieve_1'] != null) {
																			echo $row_select_pipe['dry_sieve_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_2'] != "" && $row_select_pipe['dry_sieve_2'] != "0" && $row_select_pipe['dry_sieve_2'] != null) {
																			echo $row_select_pipe['dry_sieve_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_3'] != "" && $row_select_pipe['dry_sieve_3'] != "0" && $row_select_pipe['dry_sieve_3'] != null) {
																			echo $row_select_pipe['dry_sieve_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['dry_sieve_avg'] != "" && $row_select_pipe['dry_sieve_avg'] != "0" && $row_select_pipe['dry_sieve_avg'] != null) {
																			echo $row_select_pipe['dry_sieve_avg'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="5" style="border: 1px solid black; font-size:12px;">&nbsp; <b>3. FINENESS BY BLAIN AIR PERMEABILITY</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>Description</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>I</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>II</b></td>
				<td style="border: 1px solid black; text-align:center;"><b>III</b></td>
			</tr>
			<tr>
				<td width="10%"  style="border: 1px solid black; text-align:center;"><b>1</b></td>
				<td width="60%" style="border: 1px solid black; text-align:left;">&nbsp; <b>M2 in gms (wt of mercury)</b></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m2_1'] != "" && $row_select_pipe['per_m2_1'] != "0" && $row_select_pipe['per_m2_1'] != null) {
																						echo $row_select_pipe['per_m2_1'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m2_2'] != "" && $row_select_pipe['per_m2_2'] != "0" && $row_select_pipe['per_m2_2'] != null) {
																						echo $row_select_pipe['per_m2_2'];
																					} else {
																						echo "";
																					} ?></td>
				<td width="10%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m2_3'] != "" && $row_select_pipe['per_m2_3'] != "0" && $row_select_pipe['per_m2_3'] != null) {
																						echo $row_select_pipe['per_m2_3'];
																					} else {
																						echo "";
																					} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>2</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>M3 in gms (wt of mercury after forming cement bed)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m3_1'] != "" && $row_select_pipe['per_m3_1'] != "0" && $row_select_pipe['per_m3_1'] != null) {
																			echo $row_select_pipe['per_m3_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m3_2'] != "" && $row_select_pipe['per_m3_2'] != "0" && $row_select_pipe['per_m3_2'] != null) {
																			echo $row_select_pipe['per_m3_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m3_3'] != "" && $row_select_pipe['per_m3_3'] != "0" && $row_select_pipe['per_m3_3'] != null) {
																			echo $row_select_pipe['per_m3_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>3</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>D is the density of mercury at the test temprature taken from Table 1</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_d_1'] != "" && $row_select_pipe['per_d_1'] != "0" && $row_select_pipe['per_d_1'] != null) {
																			echo $row_select_pipe['per_d_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_d_2'] != "" && $row_select_pipe['per_d_2'] != "0" && $row_select_pipe['per_d_2'] != null) {
																			echo $row_select_pipe['per_d_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_d_3'] != "" && $row_select_pipe['per_d_3'] != "0" && $row_select_pipe['per_d_3'] != null) {
																			echo $row_select_pipe['per_d_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>4</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>The bed Volume V is given by: V = ((m2 - m3)/D)(cm<sup>3</sup>)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_v_1'] != "" && $row_select_pipe['per_v_1'] != "0" && $row_select_pipe['per_v_1'] != null) {
																			echo $row_select_pipe['per_v_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_v_2'] != "" && $row_select_pipe['per_v_2'] != "0" && $row_select_pipe['per_v_2'] != null) {
																			echo $row_select_pipe['per_v_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_v_3'] != "" && $row_select_pipe['per_v_3'] != "0" && $row_select_pipe['per_v_3'] != null) {
																			echo $row_select_pipe['per_v_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>5</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Quantity of Cement Calculated from (Poroosity e = 0.500) m1</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m1_1'] != "" && $row_select_pipe['per_m1_1'] != "0" && $row_select_pipe['per_m1_1'] != null) {
																			echo $row_select_pipe['per_m1_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m1_2'] != "" && $row_select_pipe['per_m1_2'] != "0" && $row_select_pipe['per_m1_2'] != null) {
																			echo $row_select_pipe['per_m1_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_m1_3'] != "" && $row_select_pipe['per_m1_3'] != "0" && $row_select_pipe['per_m1_3'] != null) {
																			echo $row_select_pipe['per_m1_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>6</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Measure time of cement under test (t) (sec)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mea_1'] != "" && $row_select_pipe['per_mea_1'] != "0" && $row_select_pipe['per_mea_1'] != null) {
																			echo $row_select_pipe['per_mea_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mea_2'] != "" && $row_select_pipe['per_mea_2'] != "0" && $row_select_pipe['per_mea_2'] != null) {
																			echo $row_select_pipe['per_mea_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mea_3'] != "" && $row_select_pipe['per_mea_3'] != "0" && $row_select_pipe['per_mea_3'] != null) {
																			echo $row_select_pipe['per_mea_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>7</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Mean time (sec)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_1'] != "" && $row_select_pipe['per_mean_1'] != "0" && $row_select_pipe['per_mean_1'] != null) {
																			echo $row_select_pipe['per_mean_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_2'] != "" && $row_select_pipe['per_mean_2'] != "0" && $row_select_pipe['per_mean_2'] != null) {
																			echo $row_select_pipe['per_mean_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_3'] != "" && $row_select_pipe['per_mean_3'] != "0" && $row_select_pipe['per_mean_3'] != null) {
																			echo $row_select_pipe['per_mean_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>8</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Measured Temprature (<sup>o</sup>C)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_temp_1'] != "" && $row_select_pipe['per_temp_1'] != "0" && $row_select_pipe['per_temp_1'] != null) {
																			echo $row_select_pipe['per_temp_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_temp_2'] != "" && $row_select_pipe['per_temp_2'] != "0" && $row_select_pipe['per_temp_2'] != null) {
																			echo $row_select_pipe['per_temp_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_temp_3'] != "" && $row_select_pipe['per_temp_3'] != "0" && $row_select_pipe['per_temp_3'] != null) {
																			echo $row_select_pipe['per_temp_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>9</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Mean Temprature (<sup>o</sup>C)</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_temp_1'] != "" && $row_select_pipe['per_mean_temp_1'] != "0" && $row_select_pipe['per_mean_temp_1'] != null) {
																			echo $row_select_pipe['per_mean_temp_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_temp_2'] != "" && $row_select_pipe['per_mean_temp_2'] != "0" && $row_select_pipe['per_mean_temp_2'] != null) {
																			echo $row_select_pipe['per_mean_temp_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_mean_temp_3'] != "" && $row_select_pipe['per_mean_temp_3'] != "0" && $row_select_pipe['per_mean_temp_3'] != null) {
																			echo $row_select_pipe['per_mean_temp_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:center;"><b>10</b></td>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Specific Surfac, m<sup>2</sup>/kg</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_sur_1'] != "" && $row_select_pipe['per_sur_1'] != "0" && $row_select_pipe['per_sur_1'] != null) {
																			echo $row_select_pipe['per_sur_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_sur_2'] != "" && $row_select_pipe['per_sur_2'] != "0" && $row_select_pipe['per_sur_2'] != null) {
																			echo $row_select_pipe['per_sur_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['per_sur_3'] != "" && $row_select_pipe['per_sur_3'] != "0" && $row_select_pipe['per_sur_3'] != null) {
																			echo $row_select_pipe['per_sur_3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
			<tr>
				<td colspan="4" style="border: 1px solid black; font-size:12px;">&nbsp; <b>4. SOUNDNESS</b></td>
			</tr>
			<tr>
				<td width="40%" style="border: 1px solid black; text-align:center;"><b>Soundness by Le - Chatlier</b></td>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>I</b></td>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>II</b></td>
				<td width="20%" style="border: 1px solid black; text-align:center;"><b>Average</b></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Initial Measurement</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_1_1'] != "" && $row_select_pipe['sou_1_1'] != "0" && $row_select_pipe['sou_1_1'] != null) {
																			echo $row_select_pipe['sou_1_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_2_1'] != "" && $row_select_pipe['sou_2_1'] != "0" && $row_select_pipe['sou_2_1'] != null) {
																			echo $row_select_pipe['sou_2_1'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_avg1'] != "" && $row_select_pipe['sou_avg1'] != "0" && $row_select_pipe['sou_avg1'] != null) {
																			echo $row_select_pipe['sou_avg1'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Final Measurement</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_1_2'] != "" && $row_select_pipe['sou_1_2'] != "0" && $row_select_pipe['sou_1_2'] != null) {
																			echo $row_select_pipe['sou_1_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_2_2'] != "" && $row_select_pipe['sou_2_2'] != "0" && $row_select_pipe['sou_2_2'] != null) {
																			echo $row_select_pipe['sou_2_2'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_avg2'] != "" && $row_select_pipe['sou_avg2'] != "0" && $row_select_pipe['sou_avg2'] != null) {
																			echo $row_select_pipe['sou_avg2'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
			<tr>
				<td style="border: 1px solid black; text-align:left;">&nbsp; <b>Difference</b></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_1_3'] != "" && $row_select_pipe['sou_1_3'] != "0" && $row_select_pipe['sou_1_3'] != null) {
																			echo $row_select_pipe['sou_1_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_2_3'] != "" && $row_select_pipe['sou_2_3'] != "0" && $row_select_pipe['sou_2_3'] != null) {
																			echo $row_select_pipe['sou_2_3'];
																		} else {
																			echo "";
																		} ?></td>
				<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['sou_avg3'] != "" && $row_select_pipe['sou_avg3'] != "0" && $row_select_pipe['sou_avg3'] != null) {
																			echo $row_select_pipe['sou_avg3'];
																		} else {
																			echo "";
																		} ?></td>
			</tr>
		</table>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		<br>
		
		
		<table align="center" width="92%" style="font-family : Calibri;">
				<tr>
					<td >
						<div style="margin-top:20px;">
							<b style="font-size:11px;font-weight:100;">F/FASH/01/TR, Issue No.01</b><br>
							<font style="font-size:11px;font-weight:100;">W.e.f. 01.12.2011</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:20px;">
							<b style="font-size:11px;font-weight:100;">Page: 1 of 3<br>
						</div>
					</td>
				</tr>
			</table>
			<div class="pagebreak"></div>
			<br>
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
			<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td colspan="4" style="border: 1px solid black; text-align:center;"><h3><b>OBSERVATION & CALCULATION SHEET OF POZZOLANA (FLY ASH)<BR> IS 1727:1967 RA 2018</b></h3></td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; font-size:12px;">&nbsp; <b>5. LIME REACTIVITY</b></td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black;">&nbsp; Standard Test mortar shall be (1:2M:9)(Lime:Pazzolana Standard Sand</td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black; text-align:center;">&nbsp; M = Specific gravity of Pazzolana <br> Specific Gravity</td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black;">&nbsp; Specific Gravity of Pazzolana: </td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black;">&nbsp; Specific Gravity of Lime:</td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><b>% of Water in ml</b></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><b>Measured flow in mm</b></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><b>% of Flow</b></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;">1</td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_1'] != "" && $row_select_pipe['lim_wtr_1'] != "0" && $row_select_pipe['lim_wtr_1'] != null) {
																							echo $row_select_pipe['lim_wtr_1'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_1'] != "" && $row_select_pipe['lim_mea_1'] != "0" && $row_select_pipe['lim_mea_1'] != null) {
																							echo $row_select_pipe['lim_mea_1'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_1'] != "" && $row_select_pipe['lim_flow_1'] != "0" && $row_select_pipe['lim_flow_1'] != null) {
																							echo $row_select_pipe['lim_flow_1'];
																						} else {
																							echo "";
																						} ?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;">2</td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_2'] != "" && $row_select_pipe['lim_wtr_2'] != "0" && $row_select_pipe['lim_wtr_2'] != null) {
																							echo $row_select_pipe['lim_wtr_2'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_2'] != "" && $row_select_pipe['lim_mea_2'] != "0" && $row_select_pipe['lim_mea_2'] != null) {
																							echo $row_select_pipe['lim_mea_2'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_2'] != "" && $row_select_pipe['lim_flow_2'] != "0" && $row_select_pipe['lim_flow_2'] != null) {
																							echo $row_select_pipe['lim_flow_2'];
																						} else {
																							echo "";
																						} ?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;">3</td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_3'] != "" && $row_select_pipe['lim_wtr_3'] != "0" && $row_select_pipe['lim_wtr_3'] != null) {
																							echo $row_select_pipe['lim_wtr_3'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_3'] != "" && $row_select_pipe['lim_mea_3'] != "0" && $row_select_pipe['lim_mea_3'] != null) {
																							echo $row_select_pipe['lim_mea_3'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_3'] != "" && $row_select_pipe['lim_flow_3'] != "0" && $row_select_pipe['lim_flow_3'] != null) {
																							echo $row_select_pipe['lim_flow_3'];
																						} else {
																							echo "";
																						} ?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;">4</td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_4'] != "" && $row_select_pipe['lim_wtr_4'] != "0" && $row_select_pipe['lim_wtr_4'] != null) {
																							echo $row_select_pipe['lim_wtr_4'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_4'] != "" && $row_select_pipe['lim_mea_4'] != "0" && $row_select_pipe['lim_mea_4'] != null) {
																							echo $row_select_pipe['lim_mea_4'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_4'] != "" && $row_select_pipe['lim_flow_4'] != "0" && $row_select_pipe['lim_flow_4'] != null) {
																							echo $row_select_pipe['lim_flow_4'];
																						} else {
																							echo "";
																						} ?></td>
				</tr>
				<tr>
					<td width="10%" style="border: 1px solid black; text-align:center;">5</td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wtr_5'] != "" && $row_select_pipe['lim_wtr_5'] != "0" && $row_select_pipe['lim_wtr_5'] != null) {
																							echo $row_select_pipe['lim_wtr_5'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_mea_5'] != "" && $row_select_pipe['lim_mea_5'] != "0" && $row_select_pipe['lim_mea_5'] != null) {
																							echo $row_select_pipe['lim_mea_5'];
																						} else {
																							echo "";
																						} ?></td>
					<td width="30%" style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_flow_5'] != "" && $row_select_pipe['lim_flow_5'] != "0" && $row_select_pipe['lim_flow_5'] != null) {
																							echo $row_select_pipe['lim_flow_5'];
																						} else {
																							echo "";
																						} ?></td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black;">&nbsp; The Amount of Water: <?php if ($row_select_pipe['lim_wtr_amt'] != "" && $row_select_pipe['lim_wtr_amt'] != "0" && $row_select_pipe['lim_wtr_amt'] != null) {
																										echo $row_select_pipe['lim_wtr_amt'];
																									} else {
																										echo "";
																									} ?></td>
				</tr>
				<tr>
					<td colspan="4" style="border: 1px solid black;">&nbsp; (water required to given flow of 70 + 5 percent with 10 drops in 6 second)</td>
				</tr>
			</table>
			<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td rowspan="2" width="5%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td rowspan="2" width="10%" style="border: 1px solid black; text-align:center;"><b>No. of Days</b></td>
					<td rowspan="2" width="10%" style="border: 1px solid black; text-align:center;"><b>Weight in gms</b></td>
					<td colspan="3" width="30%" style="border: 1px solid black; text-align:center;"><b>Cube Sze in mm</b></td>
					<td rowspan="2" width="15%" style="border: 1px solid black; text-align:center;"><b>C/ Area mm<sup>2</sup></b></td>
					<td rowspan="2" width="15%" style="border: 1px solid black; text-align:center;"><b>Load in kN</b></td>
					<td rowspan="2" width="15%" style="border: 1px solid black; text-align:center;"><b>Compressive <br> Strength in <br>(N/mm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><b>Length</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Width</b></td>
					<td style="border: 1px solid black; text-align:center;"><b>Height</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">1</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_1'] != "" && $row_select_pipe['lim_day_1'] != "0" && $row_select_pipe['lim_day_1'] != null) {
																				echo $row_select_pipe['lim_day_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_1'] != "" && $row_select_pipe['lim_wt_1'] != "0" && $row_select_pipe['lim_wt_1'] != null) {
																				echo $row_select_pipe['lim_wt_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_1'] != "" && $row_select_pipe['lim_len_1'] != "0" && $row_select_pipe['lim_len_1'] != null) {
																				echo $row_select_pipe['lim_len_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_1'] != "" && $row_select_pipe['lim_w_1'] != "0" && $row_select_pipe['lim_w_1'] != null) {
																				echo $row_select_pipe['lim_w_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_1'] != "" && $row_select_pipe['lim_h_1'] != "0" && $row_select_pipe['lim_h_1'] != null) {
																				echo $row_select_pipe['lim_h_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_1'] != "" && $row_select_pipe['lim_area_1'] != "0" && $row_select_pipe['lim_area_1'] != null) {
																				echo $row_select_pipe['lim_area_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_1'] != "" && $row_select_pipe['lim_load_1'] != "0" && $row_select_pipe['lim_load_1'] != null) {
																				echo $row_select_pipe['lim_load_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_1'] != "" && $row_select_pipe['lim_com_1'] != "0" && $row_select_pipe['lim_com_1'] != null) {
																				echo $row_select_pipe['lim_com_1'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">2</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_2'] != "" && $row_select_pipe['lim_day_2'] != "0" && $row_select_pipe['lim_day_2'] != null) {
																				echo $row_select_pipe['lim_day_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_2'] != "" && $row_select_pipe['lim_wt_2'] != "0" && $row_select_pipe['lim_wt_2'] != null) {
																				echo $row_select_pipe['lim_wt_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_2'] != "" && $row_select_pipe['lim_len_2'] != "0" && $row_select_pipe['lim_len_2'] != null) {
																				echo $row_select_pipe['lim_len_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_2'] != "" && $row_select_pipe['lim_w_2'] != "0" && $row_select_pipe['lim_w_2'] != null) {
																				echo $row_select_pipe['lim_w_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_2'] != "" && $row_select_pipe['lim_h_2'] != "0" && $row_select_pipe['lim_h_2'] != null) {
																				echo $row_select_pipe['lim_h_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_2'] != "" && $row_select_pipe['lim_area_2'] != "0" && $row_select_pipe['lim_area_2'] != null) {
																				echo $row_select_pipe['lim_area_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_2'] != "" && $row_select_pipe['lim_load_2'] != "0" && $row_select_pipe['lim_load_2'] != null) {
																				echo $row_select_pipe['lim_load_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_2'] != "" && $row_select_pipe['lim_com_2'] != "0" && $row_select_pipe['lim_com_2'] != null) {
																				echo $row_select_pipe['lim_com_2'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">3</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_3'] != "" && $row_select_pipe['lim_day_3'] != "0" && $row_select_pipe['lim_day_3'] != null) {
																				echo $row_select_pipe['lim_day_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_3'] != "" && $row_select_pipe['lim_wt_3'] != "0" && $row_select_pipe['lim_wt_3'] != null) {
																				echo $row_select_pipe['lim_wt_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_3'] != "" && $row_select_pipe['lim_len_3'] != "0" && $row_select_pipe['lim_len_3'] != null) {
																				echo $row_select_pipe['lim_len_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_3'] != "" && $row_select_pipe['lim_w_3'] != "0" && $row_select_pipe['lim_w_3'] != null) {
																				echo $row_select_pipe['lim_w_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_3'] != "" && $row_select_pipe['lim_h_3'] != "0" && $row_select_pipe['lim_h_3'] != null) {
																				echo $row_select_pipe['lim_h_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_3'] != "" && $row_select_pipe['lim_area_3'] != "0" && $row_select_pipe['lim_area_3'] != null) {
																				echo $row_select_pipe['lim_area_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_3'] != "" && $row_select_pipe['lim_load_3'] != "0" && $row_select_pipe['lim_load_3'] != null) {
																				echo $row_select_pipe['lim_load_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_3'] != "" && $row_select_pipe['lim_com_3'] != "0" && $row_select_pipe['lim_com_3'] != null) {
																				echo $row_select_pipe['lim_com_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">4</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_4'] != "" && $row_select_pipe['lim_day_4'] != "0" && $row_select_pipe['lim_day_4'] != null) {
																				echo $row_select_pipe['lim_day_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_4'] != "" && $row_select_pipe['lim_wt_4'] != "0" && $row_select_pipe['lim_wt_4'] != null) {
																				echo $row_select_pipe['lim_wt_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_4'] != "" && $row_select_pipe['lim_len_4'] != "0" && $row_select_pipe['lim_len_4'] != null) {
																				echo $row_select_pipe['lim_len_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_4'] != "" && $row_select_pipe['lim_w_4'] != "0" && $row_select_pipe['lim_w_4'] != null) {
																				echo $row_select_pipe['lim_w_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_4'] != "" && $row_select_pipe['lim_h_4'] != "0" && $row_select_pipe['lim_h_4'] != null) {
																				echo $row_select_pipe['lim_h_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_4'] != "" && $row_select_pipe['lim_area_4'] != "0" && $row_select_pipe['lim_area_4'] != null) {
																				echo $row_select_pipe['lim_area_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_4'] != "" && $row_select_pipe['lim_load_4'] != "0" && $row_select_pipe['lim_load_4'] != null) {
																				echo $row_select_pipe['lim_load_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_4'] != "" && $row_select_pipe['lim_com_4'] != "0" && $row_select_pipe['lim_com_4'] != null) {
																				echo $row_select_pipe['lim_com_4'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">5</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_day_5'] != "" && $row_select_pipe['lim_day_5'] != "0" && $row_select_pipe['lim_day_5'] != null) {
																				echo $row_select_pipe['lim_day_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_wt_5'] != "" && $row_select_pipe['lim_wt_5'] != "0" && $row_select_pipe['lim_wt_5'] != null) {
																				echo $row_select_pipe['lim_wt_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_len_5'] != "" && $row_select_pipe['lim_len_5'] != "0" && $row_select_pipe['lim_len_5'] != null) {
																				echo $row_select_pipe['lim_len_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_w_5'] != "" && $row_select_pipe['lim_w_5'] != "0" && $row_select_pipe['lim_w_5'] != null) {
																				echo $row_select_pipe['lim_w_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_h_5'] != "" && $row_select_pipe['lim_h_5'] != "0" && $row_select_pipe['lim_h_5'] != null) {
																				echo $row_select_pipe['lim_h_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_area_5'] != "" && $row_select_pipe['lim_area_5'] != "0" && $row_select_pipe['lim_area_5'] != null) {
																				echo $row_select_pipe['lim_area_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_load_5'] != "" && $row_select_pipe['lim_load_5'] != "0" && $row_select_pipe['lim_load_5'] != null) {
																				echo $row_select_pipe['lim_load_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['lim_com_5'] != "" && $row_select_pipe['lim_com_5'] != "0" && $row_select_pipe['lim_com_5'] != null) {
																				echo $row_select_pipe['lim_com_5'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
			</table>
			<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td colspan="4" style="border: 1px solid black; font-size:12px;">&nbsp; <b>6. COMPRESSIVE STRENGTH</b></td>
				</tr>
				<tr>
					<td width="7%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Days</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Length (mm)</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Width (mm)</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Height (mm)</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Cross sectional Area (mm2)</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Max Load (kN)</b></td>
					<td width="13%" style="border: 1px solid black; text-align:center;"><b>Compressive <br> Strength in <br>(N/mm<sup>2</sup>)</b></td>
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;">1</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day1'] != "" && $row_select_pipe['day1'] != "0" && $row_select_pipe['day1'] != null) {
																				echo $row_select_pipe['day1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l1'] != "" && $row_select_pipe['l1'] != "0" && $row_select_pipe['l1'] != null) {
																				echo $row_select_pipe['l1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi1'] != "" && $row_select_pipe['wi1'] != "0" && $row_select_pipe['wi1'] != null) {
																				echo $row_select_pipe['wi1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h1'] != "" && $row_select_pipe['h1'] != "0" && $row_select_pipe['h1'] != null) {
																				echo $row_select_pipe['h1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a1'] != "" && $row_select_pipe['a1'] != "0" && $row_select_pipe['a1'] != null) {
																				echo $row_select_pipe['a1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_1'] != "" && $row_select_pipe['load_1'] != "0" && $row_select_pipe['load_1'] != null) {
																				echo $row_select_pipe['load_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_1'] != "" && $row_select_pipe['com_1'] != "0" && $row_select_pipe['com_1'] != null) {
																				echo $row_select_pipe['com_1'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day2'] != "" && $row_select_pipe['day2'] != "0" && $row_select_pipe['day2'] != null) {
																				echo $row_select_pipe['day2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l2'] != "" && $row_select_pipe['l2'] != "0" && $row_select_pipe['l2'] != null) {
																				echo $row_select_pipe['l2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi2'] != "" && $row_select_pipe['wi2'] != "0" && $row_select_pipe['wi2'] != null) {
																				echo $row_select_pipe['wi2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h2'] != "" && $row_select_pipe['h2'] != "0" && $row_select_pipe['h2'] != null) {
																				echo $row_select_pipe['h2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a2'] != "" && $row_select_pipe['a2'] != "0" && $row_select_pipe['a2'] != null) {
																				echo $row_select_pipe['a2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_2'] != "" && $row_select_pipe['load_2'] != "0" && $row_select_pipe['load_2'] != null) {
																				echo $row_select_pipe['load_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_2'] != "" && $row_select_pipe['com_2'] != "0" && $row_select_pipe['com_2'] != null) {
																				echo $row_select_pipe['com_2'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day3'] != "" && $row_select_pipe['day3'] != "0" && $row_select_pipe['day3'] != null) {
																				echo $row_select_pipe['day3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l3'] != "" && $row_select_pipe['l3'] != "0" && $row_select_pipe['l3'] != null) {
																				echo $row_select_pipe['l3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi3'] != "" && $row_select_pipe['wi3'] != "0" && $row_select_pipe['wi3'] != null) {
																				echo $row_select_pipe['wi3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h3'] != "" && $row_select_pipe['h3'] != "0" && $row_select_pipe['h3'] != null) {
																				echo $row_select_pipe['h3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a3'] != "" && $row_select_pipe['a3'] != "0" && $row_select_pipe['a3'] != null) {
																				echo $row_select_pipe['a3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_3'] != "" && $row_select_pipe['load_3'] != "0" && $row_select_pipe['load_3'] != null) {
																				echo $row_select_pipe['load_3'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_3'] != "" && $row_select_pipe['com_3'] != "0" && $row_select_pipe['com_3'] != null) {
																				echo $row_select_pipe['com_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black; text-align:right;">AVERAGE &nbsp;</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['avg_com1'] != "" && $row_select_pipe['avg_com1'] != "0" && $row_select_pipe['avg_com1'] != null) {
																				echo $row_select_pipe['avg_com1'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;">2</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day4'] != "" && $row_select_pipe['day4'] != "0" && $row_select_pipe['day4'] != null) {
																				echo $row_select_pipe['day4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l4'] != "" && $row_select_pipe['l4'] != "0" && $row_select_pipe['l4'] != null) {
																				echo $row_select_pipe['l4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi4'] != "" && $row_select_pipe['wi4'] != "0" && $row_select_pipe['wi4'] != null) {
																				echo $row_select_pipe['wi4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h4'] != "" && $row_select_pipe['h4'] != "0" && $row_select_pipe['h4'] != null) {
																				echo $row_select_pipe['h4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a4'] != "" && $row_select_pipe['a4'] != "0" && $row_select_pipe['a4'] != null) {
																				echo $row_select_pipe['a4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_4'] != "" && $row_select_pipe['load_4'] != "0" && $row_select_pipe['load_4'] != null) {
																				echo $row_select_pipe['load_4'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_4'] != "" && $row_select_pipe['com_4'] != "0" && $row_select_pipe['com_4'] != null) {
																				echo $row_select_pipe['com_4'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day5'] != "" && $row_select_pipe['day5'] != "0" && $row_select_pipe['day5'] != null) {
																				echo $row_select_pipe['day5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l5'] != "" && $row_select_pipe['l5'] != "0" && $row_select_pipe['l5'] != null) {
																				echo $row_select_pipe['l5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi5'] != "" && $row_select_pipe['wi5'] != "0" && $row_select_pipe['wi5'] != null) {
																				echo $row_select_pipe['wi5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h5'] != "" && $row_select_pipe['h5'] != "0" && $row_select_pipe['h5'] != null) {
																				echo $row_select_pipe['h5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a5'] != "" && $row_select_pipe['a5'] != "0" && $row_select_pipe['a5'] != null) {
																				echo $row_select_pipe['a5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_5'] != "" && $row_select_pipe['load_5'] != "0" && $row_select_pipe['load_5'] != null) {
																				echo $row_select_pipe['load_5'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_5'] != "" && $row_select_pipe['com_5'] != "0" && $row_select_pipe['com_5'] != null) {
																				echo $row_select_pipe['com_5'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day6'] != "" && $row_select_pipe['day6'] != "0" && $row_select_pipe['day6'] != null) {
																				echo $row_select_pipe['day6'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l6'] != "" && $row_select_pipe['l6'] != "0" && $row_select_pipe['l6'] != null) {
																				echo $row_select_pipe['l6'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi6'] != "" && $row_select_pipe['wi6'] != "0" && $row_select_pipe['wi6'] != null) {
																				echo $row_select_pipe['wi6'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h6'] != "" && $row_select_pipe['h6'] != "0" && $row_select_pipe['h6'] != null) {
																				echo $row_select_pipe['h6'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a6'] != "" && $row_select_pipe['a6'] != "0" && $row_select_pipe['a6'] != null) {
																				echo $row_select_pipe['a6'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_6'] != "" && $row_select_pipe['load_6'] != "0" && $row_select_pipe['load_6'] != null) {
																				echo $row_select_pipe['load_6'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_6'] != "" && $row_select_pipe['com_6'] != "0" && $row_select_pipe['com_6'] != null) {
																				echo $row_select_pipe['com_6'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black; text-align:right;">AVERAGE &nbsp;</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['avg_com2'] != "" && $row_select_pipe['avg_com2'] != "0" && $row_select_pipe['avg_com2'] != null) {
																				echo $row_select_pipe['avg_com2'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td rowspan="3" style="border: 1px solid black; text-align:center;">3</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day7'] != "" && $row_select_pipe['day7'] != "0" && $row_select_pipe['day7'] != null) {
																				echo $row_select_pipe['day7'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l7'] != "" && $row_select_pipe['l7'] != "0" && $row_select_pipe['l7'] != null) {
																				echo $row_select_pipe['l7'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi7'] != "" && $row_select_pipe['wi7'] != "0" && $row_select_pipe['wi7'] != null) {
																				echo $row_select_pipe['wi7'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h7'] != "" && $row_select_pipe['h7'] != "0" && $row_select_pipe['h7'] != null) {
																				echo $row_select_pipe['h7'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a7'] != "" && $row_select_pipe['a7'] != "0" && $row_select_pipe['a7'] != null) {
																				echo $row_select_pipe['a7'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_7'] != "" && $row_select_pipe['load_7'] != "0" && $row_select_pipe['load_7'] != null) {
																				echo $row_select_pipe['load_7'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_7'] != "" && $row_select_pipe['com_7'] != "0" && $row_select_pipe['com_7'] != null) {
																				echo $row_select_pipe['com_7'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day8'] != "" && $row_select_pipe['day8'] != "0" && $row_select_pipe['day8'] != null) {
																				echo $row_select_pipe['day8'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l8'] != "" && $row_select_pipe['l8'] != "0" && $row_select_pipe['l8'] != null) {
																				echo $row_select_pipe['l8'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi8'] != "" && $row_select_pipe['wi8'] != "0" && $row_select_pipe['wi8'] != null) {
																				echo $row_select_pipe['wi8'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h8'] != "" && $row_select_pipe['h8'] != "0" && $row_select_pipe['h8'] != null) {
																				echo $row_select_pipe['h8'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a8'] != "" && $row_select_pipe['a8'] != "0" && $row_select_pipe['a8'] != null) {
																				echo $row_select_pipe['a8'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_8'] != "" && $row_select_pipe['load_8'] != "0" && $row_select_pipe['load_8'] != null) {
																				echo $row_select_pipe['load_8'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_8'] != "" && $row_select_pipe['com_8'] != "0" && $row_select_pipe['com_8'] != null) {
																				echo $row_select_pipe['com_8'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['day9'] != "" && $row_select_pipe['day9'] != "0" && $row_select_pipe['day9'] != null) {
																				echo $row_select_pipe['day9'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['l9'] != "" && $row_select_pipe['l9'] != "0" && $row_select_pipe['l9'] != null) {
																				echo $row_select_pipe['l9'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['wi9'] != "" && $row_select_pipe['wi9'] != "0" && $row_select_pipe['wi9'] != null) {
																				echo $row_select_pipe['wi9'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['h9'] != "" && $row_select_pipe['h9'] != "0" && $row_select_pipe['h9'] != null) {
																				echo $row_select_pipe['h9'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['a9'] != "" && $row_select_pipe['a9'] != "0" && $row_select_pipe['a9'] != null) {
																				echo $row_select_pipe['a9'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['load_9'] != "" && $row_select_pipe['load_9'] != "0" && $row_select_pipe['load_9'] != null) {
																				echo $row_select_pipe['load_9'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['com_9'] != "" && $row_select_pipe['com_9'] != "0" && $row_select_pipe['com_9'] != null) {
																				echo $row_select_pipe['com_9'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td colspan="7" style="border: 1px solid black; text-align:right;">AVERAGE &nbsp;</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['avg_com3'] != "" && $row_select_pipe['avg_com3'] != "0" && $row_select_pipe['avg_com3'] != null) {
																				echo $row_select_pipe['avg_com3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				
				
			</table>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
			<br>
		
		
			<table align="center" width="92%" style="font-family : Calibri;">
				<tr>
					<td >
						<div style="margin-top:20px;">
							<b style="font-size:11px;font-weight:100;">F/FASH/01/TR, Issue No.01</b><br>
							<font style="font-size:11px;font-weight:100;">W.e.f. 01.12.2011</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:20px;">
							<b style="font-size:11px;font-weight:100;">Page: 2 of 3<br>
						</div>
					</td>
				</tr>
			</table>
			<div class="pagebreak"></div>
			<br>
			<div id="header">
				<img src="../images/header.png" width="100%">
			</div>
			<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td colspan="5" style="border: 1px solid black; text-align:center;"><h3><b>OBSERVATION & CALCULATION SHEET OF POZZOLANA (FLY ASH)<BR> IS 1727:1967 RA 2018</b></h3></td>
				</tr>
				<tr>
					<td colspan="5" style="border: 1px solid black; font-size:12px;">&nbsp; <b>7. SPECIFIC GRAVITY</b></td>
				</tr>
			</table>
			<table align="center" width="100%" class="test"  style="border: 1px solid black; font-family : Calibri; margin-top:-1px;">
				<tr>
					<td width="5%" style="border: 1px solid black; text-align:center;"><b>Sr No.</b></td>
					<td width="55%" style="border: 1px solid black; text-align:center;"><b>Description</b></td>
					<td width="12%" style="border: 1px solid black; text-align:center;"><b>I</b></td>
					<td width="12%" style="border: 1px solid black; text-align:center;"><b>II</b></td>
					<td width="12%" style="border: 1px solid black; text-align:center;"><b>III</b></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">1</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Mass of Fly Ash in gm (A)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_a_1'] != "" && $row_select_pipe['spg_a_1'] != "0" && $row_select_pipe['spg_a_1'] != null) {
																				echo $row_select_pipe['spg_a_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_a_2'] != "" && $row_select_pipe['spg_a_2'] != "0" && $row_select_pipe['spg_a_2'] != null) {
																				echo $row_select_pipe['spg_a_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_a_3'] != "" && $row_select_pipe['spg_a_3'] != "0" && $row_select_pipe['spg_a_3'] != null) {
																				echo $row_select_pipe['spg_a_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">2</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Displaced volume in cm3 (B)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_b_1'] != "" && $row_select_pipe['spg_b_1'] != "0" && $row_select_pipe['spg_b_1'] != null) {
																				echo $row_select_pipe['spg_b_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_b_2'] != "" && $row_select_pipe['spg_b_2'] != "0" && $row_select_pipe['spg_b_2'] != null) {
																				echo $row_select_pipe['spg_b_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_b_3'] != "" && $row_select_pipe['spg_b_3'] != "0" && $row_select_pipe['spg_b_3'] != null) {
																				echo $row_select_pipe['spg_b_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">3</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Gravity in gm/cm3 (A/B)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ab_1'] != "" && $row_select_pipe['spg_ab_1'] != "0" && $row_select_pipe['spg_ab_1'] != null) {
																				echo $row_select_pipe['spg_ab_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ab_2'] != "" && $row_select_pipe['spg_ab_2'] != "0" && $row_select_pipe['spg_ab_2'] != null) {
																				echo $row_select_pipe['spg_ab_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ab_3'] != "" && $row_select_pipe['spg_ab_3'] != "0" && $row_select_pipe['spg_ab_3'] != null) {
																				echo $row_select_pipe['spg_ab_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">4</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; The bed Volume V is given by:</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_v_1'] != "" && $row_select_pipe['spg_v_1'] != "0" && $row_select_pipe['spg_v_1'] != null) {
																				echo $row_select_pipe['spg_v_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_v_2'] != "" && $row_select_pipe['spg_v_2'] != "0" && $row_select_pipe['spg_v_2'] != null) {
																				echo $row_select_pipe['spg_v_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_v_3'] != "" && $row_select_pipe['spg_v_3'] != "0" && $row_select_pipe['spg_v_3'] != null) {
																				echo $row_select_pipe['spg_v_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">5</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Quantity of FlyAsh Calculated from m1 = 0.500pv (g)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_fly_1'] != "" && $row_select_pipe['spg_fly_1'] != "0" && $row_select_pipe['spg_fly_1'] != null) {
																				echo $row_select_pipe['spg_fly_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_fly_2'] != "" && $row_select_pipe['spg_fly_2'] != "0" && $row_select_pipe['spg_fly_2'] != null) {
																				echo $row_select_pipe['spg_fly_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_fly_3'] != "" && $row_select_pipe['spg_fly_3'] != "0" && $row_select_pipe['spg_fly_3'] != null) {
																				echo $row_select_pipe['spg_fly_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">6</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Surface of standard sample used in calibration Ss in cm2/gm</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_sur_1'] != "" && $row_select_pipe['spg_sur_1'] != "0" && $row_select_pipe['spg_sur_1'] != null) {
																				echo $row_select_pipe['spg_sur_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_sur_2'] != "" && $row_select_pipe['spg_sur_2'] != "0" && $row_select_pipe['spg_sur_2'] != null) {
																				echo $row_select_pipe['spg_sur_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_sur_3'] != "" && $row_select_pipe['spg_sur_3'] != "0" && $row_select_pipe['spg_sur_3'] != null) {
																				echo $row_select_pipe['spg_sur_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">7</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Gravity of standard sample Ps</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_std_1'] != "" && $row_select_pipe['spg_std_1'] != "0" && $row_select_pipe['spg_std_1'] != null) {
																				echo $row_select_pipe['spg_std_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_std_2'] != "" && $row_select_pipe['spg_std_2'] != "0" && $row_select_pipe['spg_std_2'] != null) {
																				echo $row_select_pipe['spg_std_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_std_3'] != "" && $row_select_pipe['spg_std_3'] != "0" && $row_select_pipe['spg_std_3'] != null) {
																				echo $row_select_pipe['spg_std_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">8</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Porosity of prepared bed of standard sample e</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_std_1'] != "" && $row_select_pipe['spg_por_std_1'] != "0" && $row_select_pipe['spg_por_std_1'] != null) {
																				echo $row_select_pipe['spg_por_std_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_std_2'] != "" && $row_select_pipe['spg_por_std_2'] != "0" && $row_select_pipe['spg_por_std_2'] != null) {
																				echo $row_select_pipe['spg_por_std_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_std_3'] != "" && $row_select_pipe['spg_por_std_3'] != "0" && $row_select_pipe['spg_por_std_3'] != null) {
																				echo $row_select_pipe['spg_por_std_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">9</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Porosity of prepared bed of Test sample e</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_test_1'] != "" && $row_select_pipe['spg_por_test_1'] != "0" && $row_select_pipe['spg_por_test_1'] != null) {
																				echo $row_select_pipe['spg_por_test_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_test_2'] != "" && $row_select_pipe['spg_por_test_2'] != "0" && $row_select_pipe['spg_por_test_2'] != null) {
																				echo $row_select_pipe['spg_por_test_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_por_test_3'] != "" && $row_select_pipe['spg_por_test_3'] != "0" && $row_select_pipe['spg_por_test_3'] != null) {
																				echo $row_select_pipe['spg_por_test_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">10</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Measured time interval in sec for test sample, T</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_1'] != "" && $row_select_pipe['spg_mea_1'] != "0" && $row_select_pipe['spg_mea_1'] != null) {
																				echo $row_select_pipe['spg_mea_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_2'] != "" && $row_select_pipe['spg_mea_2'] != "0" && $row_select_pipe['spg_mea_2'] != null) {
																				echo $row_select_pipe['spg_mea_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_3'] != "" && $row_select_pipe['spg_mea_3'] != "0" && $row_select_pipe['spg_mea_3'] != null) {
																				echo $row_select_pipe['spg_mea_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">11</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Mean Time (sec)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_1'] != "" && $row_select_pipe['spg_mean_1'] != "0" && $row_select_pipe['spg_mean_1'] != null) {
																				echo $row_select_pipe['spg_mean_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_2'] != "" && $row_select_pipe['spg_mean_2'] != "0" && $row_select_pipe['spg_mean_2'] != null) {
																				echo $row_select_pipe['spg_mean_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_3'] != "" && $row_select_pipe['spg_mean_3'] != "0" && $row_select_pipe['spg_mean_3'] != null) {
																				echo $row_select_pipe['spg_mean_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">12</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Measured time in sec for standard sample, T</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_std_1'] != "" && $row_select_pipe['spg_mea_std_1'] != "0" && $row_select_pipe['spg_mea_std_1'] != null) {
																				echo $row_select_pipe['spg_mea_std_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_std_2'] != "" && $row_select_pipe['spg_mea_std_2'] != "0" && $row_select_pipe['spg_mea_std_2'] != null) {
																				echo $row_select_pipe['spg_mea_std_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_std_3'] != "" && $row_select_pipe['spg_mea_std_3'] != "0" && $row_select_pipe['spg_mea_std_3'] != null) {
																				echo $row_select_pipe['spg_mea_std_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">13</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Measured Temprature (<sup>o</sup>C)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_temp_1'] != "" && $row_select_pipe['spg_mea_temp_1'] != "0" && $row_select_pipe['spg_mea_temp_1'] != null) {
																				echo $row_select_pipe['spg_mea_temp_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_temp_2'] != "" && $row_select_pipe['spg_mea_temp_2'] != "0" && $row_select_pipe['spg_mea_temp_2'] != null) {
																				echo $row_select_pipe['spg_mea_temp_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mea_temp_3'] != "" && $row_select_pipe['spg_mea_temp_3'] != "0" && $row_select_pipe['spg_mea_temp_3'] != null) {
																				echo $row_select_pipe['spg_mea_temp_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">14</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Mean Temprature (<sup>o</sup>C)</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_temp_1'] != "" && $row_select_pipe['spg_mean_temp_1'] != "0" && $row_select_pipe['spg_mean_temp_1'] != null) {
																				echo $row_select_pipe['spg_mean_temp_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_temp_2'] != "" && $row_select_pipe['spg_mean_temp_2'] != "0" && $row_select_pipe['spg_mean_temp_2'] != null) {
																				echo $row_select_pipe['spg_mean_temp_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_mean_temp_3'] != "" && $row_select_pipe['spg_mean_temp_3'] != "0" && $row_select_pipe['spg_mean_temp_3'] != null) {
																				echo $row_select_pipe['spg_mean_temp_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
				<tr>
					<td style="border: 1px solid black; text-align:center;">15</td>
					<td style="border: 1px solid black; text-align:left;">&nbsp; Specific Surface of test sample in cm2/gm =</td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ss_1'] != "" && $row_select_pipe['spg_ss_1'] != "0" && $row_select_pipe['spg_ss_1'] != null) {
																				echo $row_select_pipe['spg_ss_1'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ss_2'] != "" && $row_select_pipe['spg_ss_2'] != "0" && $row_select_pipe['spg_ss_2'] != null) {
																				echo $row_select_pipe['spg_ss_2'];
																			} else {
																				echo "";
																			} ?></td>
					<td style="border: 1px solid black; text-align:center;"><?php if ($row_select_pipe['spg_ss_3'] != "" && $row_select_pipe['spg_ss_3'] != "0" && $row_select_pipe['spg_ss_3'] != null) {
																				echo $row_select_pipe['spg_ss_3'];
																			} else {
																				echo "";
																			} ?></td>
				</tr>
			</table>
			<table align="center" width="92%" style="font-family : Calibri;">
				<tr>
					<td>
						<div style="float:left;">
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tested By: </b><br><br>
							<b style="font-size:12px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Checked By:</b><br>
						</div>
					</td>
					<td>
						<div style="float:right; text-align:center; padding-right:60px;">
							<img src="../images/stamp.jpg" width="160px">
						</div>
					</td>
				</tr>
				<tr>
					<td >
						<div style="margin-top:200px;">
							<b style="font-size:11px;font-weight:100;">F/FASH/01/TR, Issue No.01</b><br>
							<font style="font-size:11px;font-weight:100;">W.e.f. 01.12.2011</font><br>
						</div>
					</td>
					<td>
						<div style="float:right;margin-top:200px;">
							<b style="font-size:11px;font-weight:100;">Page: 3 of 3<br>
						</div>
					</td>
				</tr>
			</table>
			</page> -->
</body>

</html>


<script type="text/javascript">

</script>