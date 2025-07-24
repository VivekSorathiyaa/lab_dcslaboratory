<?php
session_start();
include("../connection.php");
error_reporting(1); ?>

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
$cons1 = $row_select['sample_sent_by'];
if ($cons1 == 0) {
	$sample_sent_by = "Client";
} else {
	$sample_sent_by = "agency";
}
$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
		if (
			strpos($row_select3["mt_name"], "WMM (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "GSB - I MIX (M4-1)") !== false ||
			strpos($row_select3["mt_name"], "GSB - II MIX (M4-2)") !== false ||
			strpos($row_select3["mt_name"], "GSB - III MIX (M4-1)") !== false ||
			strpos($row_select3["mt_name"], "GSB - IV MIX (M5)") !== false ||
			strpos($row_select3["mt_name"], "GSB - V MIX (M5)") !== false ||
			strpos($row_select3["mt_name"], "GSB - VI MIX (M5)") !== false ||
			strpos($row_select3["mt_name"], "GSB - I MIX (M5)") !== false ||
			strpos($row_select3["mt_name"], "GSB - III MIX (M5)") !== false ||
			strpos($row_select3["mt_name"], "GSB - II MIX (M5)") !== false ||
			strpos($row_select3["mt_name"], "GSB - I MIX (M4-2)") !== false ||
			strpos($row_select3["mt_name"], "GSB - II MIX (M4-1)") !== false ||
			strpos($row_select3["mt_name"], "GSB - III MIX (M4-2)") !== false ||
			strpos($row_select3["mt_name"], "MSS - A (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "MSS - B (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
			strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
			strpos($row_select3["mt_name"], "BM - 2 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "BM - 1 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "BC - 2 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "BC - 1 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "DBM - 1 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "DBM - 2 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "SDBC - 1 (MIX MATERIAL)") !== false ||
			strpos($row_select3["mt_name"], "Seal Coat") !== false ||
			strpos($row_select3["mt_name"], "Premix Carpet") !== false ||
			strpos($row_select3["mt_name"], "BUSG - KA") !== false ||
			strpos($row_select3["mt_name"], "BUSG - CA") !== false ||
			strpos($row_select3["mt_name"], "SDBC - 2 (MIX MATERIAL)") !== false
		) {
			$mt_name = $row_select3['mt_name'];
		} else {
			$ans = substr($row_select3["mt_name"], strpos($row_select3["mt_name"], "(") + 1);
			$explodeing = explode(")", $ans);
			$mt_name = $explodeing[0];
		}
	}
}

$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `trf_no`='$trf_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
$result_select4 = mysqli_query($conn, $select_query4);

if (mysqli_num_rows($result_select4) > 0) {
	$row_select4 = mysqli_fetch_assoc($result_select4);
	$source = $row_select4['agg_source'];
	$material_location = $row_select4['material_location'];
}


?>


<table border="1" cellspacing="0" style="width:439pt">
	<tbody>
		<tr>
			<td colspan="10" style="height:15.0pt; width:439pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="10" style="height:15.75pt">(M-2)</td>
		</tr>
		<tr>
			<td colspan="10" style="height:15.0pt">&nbsp;</td>
		</tr>
		<tr>
			<td colspan="10">TITLE: TEST&nbsp; RESULTS OF COARSE AGGREGATE</td>
		</tr>
		<tr>
			<td colspan="10" style="height:21.0pt">Name of work: <?php echo $name_of_work; ?>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="10" style="height:21.0pt">Details of Coarse Aggregate:</td>
		</tr>
		<tr>
			<td style="height:36.75pt; width:22pt">1</td>
			<td style="width:64pt">Sample sent by</td>
			<td colspan="3" style="width:146pt"><?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
												$result_selectc = mysqli_query($conn, $select_queryc);

												if (mysqli_num_rows($result_selectc) > 0) {
													$row_selectc = mysqli_fetch_assoc($result_selectc);
													$ct_nm = $row_selectc['city_name'];
												}
												echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?></td>
			<td style="width:26pt">2</td>
			<td style="width:47pt">Received&nbsp; vide letter No.</td>
			<td colspan="3"><?php echo $r_name; ?></td>
		</tr>
		<tr>
			<td style="height:24.75pt; width:22pt">3</td>
			<td style="width:64pt">Sample brought by</td>
			<td colspan="3" style="width:146pt"><?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
												$result_selectc1 = mysqli_query($conn, $select_queryc1);

												if (mysqli_num_rows($result_selectc1) > 0) {
													$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
													$ct_nm1 = $row_selectc1['city_name'];
												}
												echo $agency_name . " " . $ct_nm1; ?></td>
			<td style="width:26pt">4</td>
			<td style="width:47pt">Identification mark</td>
			<td colspan="3">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:34.5pt; width:22pt">5</td>
			<td style="width:64pt">Condition of sample</td>
			<td colspan="3" style="width:146pt"><?php echo $con_sample; ?></td>
			<td style="width:26pt">6</td>
			<td style="width:47pt">Name of quarry &amp; location</td>
			<td colspan="3"><?php echo $source; ?></td>
		</tr>
		<tr>
			<td style="height:24.75pt; width:22pt">7</td>
			<td style="width:64pt">Type of material</td>
			<td colspan="3" style="width:146pt"><?php echo $row_select3["mt_name"]; ?></td>
			<td style="width:26pt">8</td>
			<td style="width:47pt">Date of sampling</td>
			<td colspan="3"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
		</tr>
		<tr>
			<td style="height:24.0pt; width:22pt">9</td>
			<td style="width:64pt">Sampling done by</td>
			<td colspan="3" style="width:146pt"><?php echo $sample_sent_by; ?></td>
			<td style="width:26pt">10</td>
			<td style="width:47pt">Method of sampling</td>
			<td colspan="3">As per IS</td>
		</tr>
		<tr>
			<td style="height:42.0pt; width:22pt">11</td>
			<td style="width:64pt">Quantity from which sample collected</td>
			<td colspan="3" style="width:146pt">25 kg</td>
			<td style="width:26pt">12</td>
			<td style="width:47pt">Purpose of testing</td>
			<td colspan="3">ok / not</td>
		</tr>
		<tr>
			<td style="height:25.5pt; width:22pt">13</td>
			<td style="width:64pt">Lab No.</td>
			<td colspan="3" style="width:146pt"><?php echo $row_select_pipe['job_no']; ?></td>
			<td style="width:26pt">14</td>
			<td style="width:47pt">Job No.</td>
			<td colspan="3"><?php echo $row_select_pipe['lab_no']; ?></td>
		</tr>
		<tr>
			<td colspan="10">Physical Tests:</td>
		</tr>
		<tr>
			<td style="height:15.0pt; width:22pt">Sr. No.</td>
			<td style="width:64pt">Tests</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:24.75pt; width:22pt">1</td>
			<td style="width:64pt">Specific Gravity</td>
			<td colspan="2"><?php
							if ($row_select_pipe['sp_specific_gravity'] != "" && $row_select_pipe['sp_specific_gravity'] != "0") {
								echo $row_select_pipe['sp_specific_gravity'];
							} else {
								echo "-";
							}
							?></td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:36.75pt; width:22pt">2</td>
			<td style="width:64pt">Water absorption (%)</td>
			<td colspan="2"><?php if ($row_select_pipe['sp_water_abr'] != "" && $row_select_pipe['sp_water_abr'] != "0") {
								echo $row_select_pipe['sp_water_abr'];
							} else {
								echo "-";
							} ?>
			</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:26.25pt; width:22pt">3</td>
			<td style="width:64pt">Bulk density kg/m3</td>
			<td colspan="2"><?php if ($row_select_pipe['bdl'] != "" && $row_select_pipe['bdl'] != "0") {
								echo $row_select_pipe['bdl'];
							} else {
								echo "-";
							} ?></td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td rowspan="14" style="height:312.0pt; width:22pt">4</td>
			<td style="width:64pt">Gradation% passing on IS Sieve</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
			<td colspan="2">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:25.5pt; width:64pt">&nbsp;</td>
			<td style="width:45pt"><?php echo $mt_name; ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
														echo $row_select_pipe['sieve_1'] . " mm";
													} else {
														echo "";
													} ?></td>
			<td style="width:45pt"><?php if ($row_select_pipe['sieve_1'] != "" && $row_select_pipe['sieve_1'] != "0" && $row_select_pipe['sieve_1'] != null) {
										echo $row_select_pipe['pass_sample_1'];
									} else {
										echo " <br>";
									}  ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
														echo $row_select_pipe['sieve_2'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_2'] != "" && $row_select_pipe['sieve_2'] != "0" && $row_select_pipe['sieve_2'] != null) {
					echo $row_select_pipe['pass_sample_2'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
														echo $row_select_pipe['sieve_3'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_3'] != "" && $row_select_pipe['sieve_3'] != "0" && $row_select_pipe['sieve_3'] != null) {
					echo $row_select_pipe['pass_sample_3'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
														echo $row_select_pipe['sieve_4'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_4'] != "" && $row_select_pipe['sieve_4'] != "0" && $row_select_pipe['sieve_4'] != null) {
					echo $row_select_pipe['pass_sample_4'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
														echo $row_select_pipe['sieve_5'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_5'] != "" && $row_select_pipe['sieve_5'] != "0" && $row_select_pipe['sieve_5'] != null) {
					echo $row_select_pipe['pass_sample_5'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
														echo $row_select_pipe['sieve_6'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_6'] != "" && $row_select_pipe['sieve_6'] != "0" && $row_select_pipe['sieve_6'] != null) {
					echo $row_select_pipe['pass_sample_6'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
														echo $row_select_pipe['sieve_7'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_7'] != "" && $row_select_pipe['sieve_7'] != "0" && $row_select_pipe['sieve_7'] != null) {
					echo $row_select_pipe['pass_sample_7'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
														echo $row_select_pipe['sieve_8'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_8'] != "" && $row_select_pipe['sieve_8'] != "0" && $row_select_pipe['sieve_8'] != null) {
					echo $row_select_pipe['pass_sample_8'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
														echo $row_select_pipe['sieve_9'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_9'] != "" && $row_select_pipe['sieve_9'] != "0" && $row_select_pipe['sieve_9'] != null) {
					echo $row_select_pipe['pass_sample_9'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
														echo $row_select_pipe['sieve_10'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_10'] != "" && $row_select_pipe['sieve_10'] != "0" && $row_select_pipe['sieve_10'] != null) {
					echo $row_select_pipe['pass_sample_10'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
														echo $row_select_pipe['sieve_11'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_11'] != "" && $row_select_pipe['sieve_11'] != "0" && $row_select_pipe['sieve_11'] != null) {
					echo $row_select_pipe['pass_sample_11'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt; width:64pt"><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
														echo $row_select_pipe['sieve_12'] . " mm";
													} else {
														echo " <br>";
													} ?></td>
			<td><?php if ($row_select_pipe['sieve_12'] != "" && $row_select_pipe['sieve_12'] != "0" && $row_select_pipe['sieve_12'] != null) {
					echo $row_select_pipe['pass_sample_12'];
				} else {
					echo " <br>";
				} ?></td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td style="width:26pt">&nbsp;</td>
			<td style="width:47pt">&nbsp;</td>
			<td style="width:42pt">&nbsp;</td>
			<td style="width:44pt">&nbsp;</td>
			<td style="width:48pt">&nbsp;</td>
		</tr>

		<tr>
			<td style="height:74.25pt; width:22pt">5</td>
			<td colspan="2">Deleterious material</td>
			<td>-</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3" style="width:134pt">1% maximum by mass of coarse agg. (Uncrushed/ Crushed) individually for i) Coal and Lignite ii) Clay lumps iii) Materials finer than 75 mic. IS Sieve</td>
		</tr>
		<tr>
			<td rowspan="2" style="height:116.25pt; width:22pt">6</td>
			<td colspan="2" rowspan="2">Crushing value (%)</td>
			<td rowspan="2"><?php if ($row_select_pipe['cru_value'] != "" && $row_select_pipe['cru_value'] != "0") {
								echo $row_select_pipe['cru_value'];
							} else {
								echo "-";
							} ?></td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td rowspan="2">&nbsp;</td>
			<td colspan="3" style="width:134pt">a) In concrete for wearing surfaces - 30% Max</td>
		</tr>
		<tr>
			<td colspan="3" style="height:87.0pt; width:134pt">b) In concrete other than for wearing surfaces -In case agg.crushing value exceeds 30% ,then the &#39;10% fines&#39; test should be conducted and the minimum load for the &#39;10% fines should be 50 kN.</td>
		</tr>
		<tr>
			<td style="height:52.5pt; width:22pt">7</td>
			<td colspan="2">Impact Value (%)</td>
			<td><?php if ($row_select_pipe['imp_value'] != "" && $row_select_pipe['imp_value'] != "0") {
					echo $row_select_pipe['imp_value'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3" style="width:134pt">a) In concrete for wearing surfaces 30% Max&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (b) In concrete other than wearing surfaces 45%</td>
		</tr>
		<tr>
			<td style="height:52.5pt; width:22pt">8</td>
			<td colspan="2">Abrasion Value (%)</td>
			<td><?php if ($row_select_pipe['abr_index'] != "" && $row_select_pipe['abr_index'] != "0") {
					echo $row_select_pipe['abr_index'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3" style="width:134pt">a) In concrete for wearing surfaces 30% Max&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; (b) In concrete other than wearing surfaces 50%</td>
		</tr>
		<tr>
			<td style="height:45.0pt; width:22pt">9</td>
			<td colspan="2">Soundness (%)</td>
			<td><?php if ($row_select_pipe['soundness'] != "" && $row_select_pipe['soundness'] != "0") {
					echo $row_select_pipe['soundness'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3" style="width:134pt">12% when tested with Na2So4 or&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 18% when tested with MgSo4</td>
		</tr>
		<tr>
			<td style="height:56.25pt; width:22pt">10</td>
			<td colspan="2" style="width:109pt">Combined Flakiness &amp; Elongation Index (%)</td>
			<td><?php if ($row_select_pipe['combined_index'] != "" && $row_select_pipe['combined_index'] != "0") {
					echo $row_select_pipe['combined_index'];
				} else {
					echo "-";
				} ?></td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td colspan="3" style="width:134pt">Combined Flakiness &amp; Elongation Index shall not exceed 40% for uncrushed or crushed agg.</td>
		</tr>
		<tr>
			<td colspan="10">Items not conforming with IS specification shown by&nbsp;&nbsp;&nbsp;&nbsp; X</td>
		</tr>
		<tr>
			<td rowspan="2" style="height:32.25pt">&nbsp;</td>
			<td style="width:64pt">4</td>
			<td style="width:45pt">5</td>
			<td style="width:44pt">6</td>
			<td style="width:57pt">7</td>
			<td style="width:26pt">8</td>
			<td style="width:47pt">9</td>
			<td style="width:42pt">10</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td style="height:15.75pt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td style="width:57pt">&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
			<td>&nbsp;</td>
		</tr>
		<tr>
			<td colspan="10" style="height:15.0pt">Tested by: Chintan Maniyar</td>
		</tr>
		<tr>
			<td colspan="10" style="height:15.0pt">Checked by: Vishal Raiyani</td>
		</tr>
	</tbody>
</table>
