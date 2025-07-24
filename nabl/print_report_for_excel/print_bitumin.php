<?php
session_start();
include("../connection.php");
error_reporting(1); ?>
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
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 12px;
		font-family: Book Antiqua;

	}

	.test {
		border-collapse: collapse;
		font-size: 12px;
		font-family: Book Antiqua;
	}

	.tdclass1 {

		font-size: 12px;
		font-family: Book Antiqua;
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
	$select_tiles_query = "select * from bitumin_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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
			$mt_name = $row_select3['mt_name'];
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
	}


	?>


	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="height:77%;font-size:13px;font-family: Book Antiqua;border:2px solid black;margin-left:35px;">
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:40px;">ULR: <?php echo $row_select_pipe['ulr']; ?></td>
			</tr>
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:43px;"><b>Discipline : Mechanical</b></td>
			</tr>
			<tr>
				<td style="font-size:8px;text-align:right;padding-right:38px;"><b>Group : Building Material</b></td>
			</tr>
			<tr>


				<td style="font-size:15px;">
					<center><b><u>Test Report</u></b></center>
				</td>

			</tr>
			<tr>


				<td style="font-size:15px;">&nbsp;</td>

			</tr>
			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="">
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Report No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $report_no; ?></td>
							<td style="width:20%;text-align:right;padding-right:20px;">&nbsp;&nbsp;<b>Issue Date</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($issue_date)); ?></td>
						</tr>

					</table>
				</td>
			</tr>


			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" cellpadding="0" class="test" style="border-top:1px solid black;">
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Customer</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																$result_selectc = mysqli_query($conn, $select_queryc);

																if (mysqli_num_rows($result_selectc) > 0) {
																	$row_selectc = mysqli_fetch_assoc($result_selectc);
																	$ct_nm = $row_selectc['city_name'];
																}
																echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?>
							</td>

						</tr>

						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Work</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $name_of_work; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Name of Agency</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%"> &nbsp;&nbsp;<?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																$result_selectc1 = mysqli_query($conn, $select_queryc1);

																if (mysqli_num_rows($result_selectc1) > 0) {
																	$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																	$ct_nm1 = $row_selectc1['city_name'];
																}
																echo $agency_name . " " . $ct_nm1; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Agreement No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $agreement_no; ?>
							</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Reference No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:77%">&nbsp;&nbsp;<?php echo $r_name; ?>&nbsp;&nbsp;Date: <?php echo date('d-M-y', strtotime($row_select["date"])); ?>
							</td>
						</tr>
						<tr>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
							<td>&nbsp;</td>
						</tr>

					</table>
				</td>
			</tr>



			<tr>
				<td>
					<table align="center" width="100%" border="0px" class="test" style="border-top:1px solid black;border-bottom:1px solid black;">
						<tr>
							<td style="width:20%"></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:40%">&nbsp;</td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:22%">&nbsp;</td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Description of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $mt_name; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Receipt</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($rec_sample_date)); ?></td>

						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Type of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($bitumin_grade == "vg-10") {
																	echo "VG 10";
																} else if ($bitumin_grade == "vg-20") {
																	echo "VG 20";
																} else if ($bitumin_grade == "vg-30") {
																	echo "VG 30";
																} else if ($bitumin_grade == "vg-40") {
																	echo "VG 40";
																} ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($start_date)); ?></td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Bitumen Pass No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $row_select_pipe['lot_no']; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo date('d-M-y', strtotime($end_date)); ?></td>
						</tr>

						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Condition of Sample</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Tanker No.</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo $row_select_pipe['tank_no']; ?></td>
						</tr>
						<tr>
							<td style="width:20%">&nbsp;&nbsp;<b>Location of Test</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:40%">&nbsp;&nbsp;<?php if ($material_location == 1) {
																	echo "In Laboratory";
																} else {
																	echo "In Field";
																} ?></td>
							<td style="width:20%">&nbsp;&nbsp;<b>Make</b></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;font-size:20px;"><b>»</b></td>
							<td style="width:14%">&nbsp;&nbsp;<?php echo $row_select_pipe['bitumin_make']; ?></td>
						</tr>
						<tr>
							<td style="width:20%"></td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:40%">&nbsp;</td>
							<td style="width:20%">&nbsp;</td>
							<td style="width:3%;font-family:Book Antiqua;font-weight:bold;"></td>
							<td style="width:14%">&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr>

			<tr>


				<td style="font-size:15px;padding-top:5px;">
					<center><b><u>Bitumen Test Result</u></b></center>
				</td>

			</tr>

			<tr>
				<!--OTHER START-->
				<td>


					<table align="left" width="100%" class="test" style="height:auto;width:100%;">
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;"><b>Description</b></td>

							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;"><b>Penetration<br>Test<br>at 25&#8451;<br>(1/10<sup>th</sup> mm)</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;"><b>Softening<br>Point Test<br>(&#8451;)</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;"><b>Ductility Test<br>25&#8451;<br>(cm)</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;"><b>Absolute<br>Viscosity<br>at 60&#8451;<br>(poise)</b></td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;"><b>Kinematics<br>Viscosity<br>at 135&#8451;<br>(C.st)</b></td>
							<td style="border:1px solid black;border-right:0px solid black;width:14.20%;"><b>Specific<br>Gravity</b></td>



						</tr>

						<tr style="text-align:center;height:50">
							<td style="border:1px solid black;border-left:0px solid black;"><b>Result</b></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_pen'] != "" && $row_select_pipe['avg_pen'] != null && $row_select_pipe['avg_pen'] != "0") {
																								echo number_format($row_select_pipe['avg_pen'], 0);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_sof'] != "" && $row_select_pipe['avg_sof'] != null && $row_select_pipe['avg_sof'] != "0") {
																								echo number_format($row_select_pipe['avg_sof'], 1);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_duc'] != "" && $row_select_pipe['avg_duc'] != null && $row_select_pipe['avg_duc'] != "0") {
																								echo number_format($row_select_pipe['avg_duc'], 1);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_abs'] != "" && $row_select_pipe['avg_abs'] != null && $row_select_pipe['avg_abs'] != "0") {
																								echo number_format($row_select_pipe['avg_abs'], 1);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_kin'] != "" && $row_select_pipe['avg_kin'] != null && $row_select_pipe['avg_kin'] != "0") {
																								echo number_format($row_select_pipe['avg_kin'], 1);
																							} else {
																								echo "-";
																							} ?></td>
							<td style="border:1px solid black;border-left:0px solid black;"><?php if ($row_select_pipe['avg_sp'] != "" && $row_select_pipe['avg_sp'] != null && $row_select_pipe['avg_sp'] != "0") {
																								echo number_format($row_select_pipe['avg_sp'], 2);
																							} else {
																								echo "-";
																							} ?></td>

						</tr>
						<tr style="text-align:center;height:50px">
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Test Method</td>

							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS:1203-1978</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS:1205-1978</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS:1208-1978</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS:1206-P2-1978</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">IS:1206-P3-1978</td>
							<td style="border:1px solid black;border-right:0px solid black;width:14.20%;">IS:1202-1978</td>

						</tr>
						<tr style="text-align:center;">
							<td colspan="7" style="border:1px solid black;border-left:0px solid black;">Requirement as per IS 73-2013, Table 1(clause 6.2)</td>

						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">VG 10</td>

							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 80</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 40&#8451;</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 75</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">800-1200</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 250</td>
							<td style="border:1px solid black;border-right:0px solid black;width:14.20%;">--</td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">VG 20</td>

							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 60</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 45&#8451;</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 50</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">1600-2400</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 300</td>
							<td style="border:1px solid black;border-right:0px solid black;width:14.20%;">--</td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">VG 30</td>

							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 45</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 47&#8451;</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 40</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">2400-3600</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 350</td>
							<td style="border:1px solid black;border-right:0px solid black;width:14.20%;">--</td>
						</tr>
						<tr style="text-align:center;">
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">VG 40</td>

							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 35</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 50&#8451;</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 25</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">3200-4800</td>
							<td style="border:1px solid black;border-left:0px solid black;width:14.20%;">Min. 400</td>
							<td style="border:1px solid black;border-right:0px solid black;width:14.20%;">--</td>
						</tr>


					</table>

				</td>

			</tr>



			<tr>

				<td style="text-align:center"><b>&#8226;&#8226; End of Report &#8226;&#8226;</b></td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="border-top:1px solid black;font-size:8px;" class="test">
						<tr>
							<td style="width:3%;text-align:center;"><b>N<br>O<br>T<br>E</b></td>
							<td style="width:97%;">
								1. The Result relate only to the items tested.<br>
								2. Test Report Shall not be reproduced except in full without approval of the Mattest Engineering Serivces can Provide assurance that parts of a report are not taken of context.<br>
								3. The information is Supplied by the customer and can effect the validity of Result.<br>
								4. The result applied to the Sample as received.<br>
								<textarea style="font-size:8px;border:0px;width:100%;height:15px;font-family: Book Antiqua;margin-left: -2px;
 margin-top: -2px;"></textarea>

							</td>
						</tr>
					</table>
				</td>

			</tr>
			<tr>
				<td>
					<table align="center" width="100%" style="font-size:12;" class="test">
						<tr>
							<?php
							$select_qm = "select * from sign_authority WHERE `is_active`='1'";
							$result_qm = mysqli_query($conn, $select_qm);

							if (mysqli_num_rows($result_qm) > 0) {
								$row_ans = mysqli_fetch_assoc($result_qm);
								$authname = $row_ans['auth_name'];
								$authdesignation = $row_ans['auth_designation'];
							}
							?>
							<td style="width:50%;text-align:center;padding-top:70px;border-top:1px solid black;border-right:1px solid black;"><br><b><i>Authorized By</i> <br> <?php echo $authname . " " . $authdesignation; ?></b></td>
							<td align="left" style="width:50%;text-align:center;padding-top:70px;border-top:1px solid black;">&nbsp;</td>

						</tr>
					</table>
				</td>

			</tr>



		</table>

		<table align="center" width="95%" cellspacing="0" cellpadding="0" style="font-size:10px;font-family: Book Antiqua;margin-left:35px;">
			<tr>

				<td style="text-align:left">Doc. No. F-7.8-09</td>
				<td style="text-align:right">Page No. 1/1</td>

			</tr>
		</table>




	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">

</script>
