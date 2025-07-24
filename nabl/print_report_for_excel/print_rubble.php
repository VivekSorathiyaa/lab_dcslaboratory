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
		width: 29.7cm;
		height: 21cm;
	}
</style>
<style>
	.tdclass {
		border: 1px solid black;
		font-size: 10px;
		font-family: arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 10px;
		font-family: arial;
	}

	.tdclass1 {

		font-size: 11px;
		font-family: arial;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$select_tiles_query = "select * from span_rubble WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$row_select_pipe = mysqli_fetch_array($result_tiles_select);

	$select_query = "select * from job,city WHERE city.id = job.client_city AND `report_no`='$report_no' AND `jobisdeleted`='0'";
	$result_select = mysqli_query($conn, $select_query);

	$row_select = mysqli_fetch_array($result_select);
	$clientname = $row_select['clientname'];
	$client_city = $row_select6['city_name'];
	$client_address = $row_select['clientaddress'];
	$r_name = $row_select['refno'];
	$sr_no = $row_select['sr_no'];
	$sample_no = $row_select['job_no'];
	$rec_sample_date = $row_select['sample_rec_date'];
	$cons = $row_select['condition_of_sample_receved'];
	if ($cons == 0) {
		$con_sample = "Sealed Ok";
	} else {
		$con_sample = "Unsealed";
	}
	$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

	$select_query1 = "select * from agency_master where `isdeleted`=0,city WHERE city.id = agency_master.agency_city AND `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
		$agency_address = $row_select1['agency_address'];
		$agency_city = $row_select1['city_name'];
	}

	$select_query2  = "select * from job_for_engineer WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' AND `isdeleted`='0'";
	$result_select2 = mysqli_query($conn, $select_query2);

	if (mysqli_num_rows($result_select2) > 0) {
		$row_select2 = mysqli_fetch_assoc($result_select2);
		$start_date = $row_select2['start_date'];
		$end_date = $row_select2['end_date'];

		$select_query3 = "select * from material WHERE `id`='$row_select2[material_id]' AND `mt_isdeleted`='0'";
		$result_select3 = mysqli_query($conn, $select_query3);

		if (mysqli_num_rows($result_select3) > 0) {
			$row_select3 = mysqli_fetch_assoc($result_select3);
			$mt_name = $row_select3['mt_name'];
		}
	}

	$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
	$result_select4 = mysqli_query($conn, $select_query4);

	if (mysqli_num_rows($result_select4) > 0) {
		$row_select4 = mysqli_fetch_assoc($result_select4);
		$bs_location = $row_select4['ru_source'];
	}


	?>

	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>

	<page size="A4">
		<table align="center" width="95%" style="height:auto;font-size:11px;font-family: arial;border:solid black;border-width:2;">
			<tr>


				<td style="font-size:13px;border:1px solid black;">
					<center><b>Test Results of Rubble</b></center>
				</td>

			</tr>
			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border:1px solid black;">
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Report No.</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $report_no; ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Report Date</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Job No.</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $job_no; ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Lab No.</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $lab_no; ?></td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border:1px solid black;">
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Name Of Customer</b></td>
							<td style="width:3%">:-</td>
							<td style="width:72%">&nbsp;&nbsp;<?php $select_queryc = "select * from city WHERE `id`='$row_select[client_city]'";
																$result_selectc = mysqli_query($conn, $select_queryc);

																if (mysqli_num_rows($result_selectc) > 0) {
																	$row_selectc = mysqli_fetch_assoc($result_selectc);
																	$ct_nm = $row_selectc['city_name'];
																}
																echo $clientname . " " . $row_select['clientaddress'] . " " . $ct_nm; ?>
							</td>

						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Name Of Agency</b></td>
							<td style="width:3%">:-</td>
							<td style="width:72%"> &nbsp;&nbsp;<?php $select_queryc1 = "select * from city WHERE `id`='$row_select[agency_city]'";
																$result_selectc1 = mysqli_query($conn, $select_queryc1);

																if (mysqli_num_rows($result_selectc1) > 0) {
																	$row_selectc1 = mysqli_fetch_assoc($result_selectc1);
																	$ct_nm1 = $row_selectc1['city_name'];
																}
																echo $agency_name . " " . $ct_nm1; ?>
							</td>
						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Name Of Work</b></td>
							<td style="width:3%">:-</td>
							<td style="width:72%">&nbsp;&nbsp;<?php echo $name_of_work; ?>
							</td>
						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Ref. No & Date</b></td>
							<td style="width:3%">:-</td>
							<td style="width:72%">&nbsp;&nbsp;<?php echo $r_name; ?>
							</td>
						</tr>


					</table>
				</td>
			</tr>



			<tr>
				<td>
					<table align="left" width="100%" border="0px" cellspacing="0" class="test" style="border:1px solid black;">
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Type of Sample</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;Rock</td>
							<td style="width:25%">&nbsp;&nbsp;<b>Test Method Standard</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;IS : 2386 - 1963</td>

						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Date of Sample Received</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Environmental Condition</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;As per test procedure</td>
						</tr>

						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Condition Of Sample On Receipt</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;Sealed ok</td>
							<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>
						</tr>

						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Sample Send by</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php if ($row_select['sample_sent_by'] == "0") {
																	echo "Customer";
																} else {
																	echo "Agency";
																} ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Completed</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($end_date)); ?></td>
						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Source Of Sample</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php if ($bs_location != "") {
																	echo $bs_location;
																} else {
																	echo "-";
																} ?></td>
							<td style="width:25%">&nbsp;&nbsp;</td>
							<td style="width:3%"></td>
							<td style="width:22%">&nbsp;&nbsp;</td>
						</tr>



					</table>
				</td>
			</tr>


			<tr>
				<td style="font-size:13px;border:1px solid black;">
					<center><b>Test Result</b></center>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" class="test" border="1px" style="height:auto;">

						<tr>


							<td>
								<center><b>DESICRIPTION OF TEST</b></center>
							</td>
							<td>
								<center><b>RESULT</b></center>
							</td>


						</tr>


						<?php
						if ($row_select_pipe['chk_com'] == 1) {
						?>
							<tr>

								<td>
									<center>Unconfined Compressive Strength</center>
								</td>
								<td>
									<center><?php echo number_format($row_select_pipe['avg_com'], 2); ?></center>
								</td>


							</tr>


						<?php
						}

						if ($row_select_pipe['chk_sp'] == 1) {
						?>
							<tr>
								<td>
									<center>Specific Gravity</center>
								</td>
								<td>
									<center><?php echo number_format($row_select_pipe['sp_specific_gravity'], 2); ?></center>
								</td>

							</tr>
							<tr>
								<td>
									<center>Specific Gravity</center>
								</td>
								<td>
									<center><?php echo number_format($row_select_pipe['sp_water_abr'], 2); ?></center>
								</td>

							</tr>

						<?php
						}

						if ($row_select_pipe['chk_crushing'] == 1) {
						?>
							<tr>
								<td>
									<center>Crushing Value</center>
								</td>
								<td>
									<center><?php echo number_format($row_select_pipe['cru_value'], 1); ?></center>
								</td>

							</tr>


						<?php
						}


						if ($row_select_pipe['chk_impact'] == 1) {
						?>
							<tr>
								<td>
									<center>Impact Value</center>
								</td>
								<td>
									<center><?php echo number_format($row_select_pipe['imp_value'], 1); ?></center>
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
					<table align="center" width="100%" class="test" border="1px" style="height:auto;">
						<tr>
							<td style="font-size:13px;">for <b>Span Material Testing & Consultancy Services Limited<br><br><br><br><br><br><br><br><br>Authorised Signatory</b> <span style="padding-right:3px;float:right;">Page :- 1 of 1</span></td>

						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<table align="center" width="100%" border="1px" class="test">
						<tr>

							<td style="transform: rotate(270deg);">
								<center><B>NOTES</B></center>
							</td>
							<td style="padding:5px;"> * The test result relates to the samples submitted by Customer/Agency.<br>* The Results / Reports are issued with specific understanding that Span Material Testing & Consultancy Services Limited will not in way be involved in acting following interpretation of the test results.<br> * The Results / Reports are not supposed to be used for publicity.</td>
						</tr>
					</table>
				</td>
			</tr>

		</table>






		<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

	</page>

</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>