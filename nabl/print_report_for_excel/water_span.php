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
		font-size: 11px;
		font-family: arial;
	}

	.test {
		border-collapse: collapse;
		font-size: 11px;
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
	$select_tiles_query = "select * from water_span WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
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

	$select_query1 = "select * from agency_master where `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
	$result_select1 = mysqli_query($conn, $select_query1);

	if (mysqli_num_rows($result_select1) > 0) {
		$row_select1 = mysqli_fetch_assoc($result_select1);
		$agency_name = $row_select1['agency_name'];
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
		$source = $row_select4['water_source'];
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
					<center><b>Test Results of Water</b></center>
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
							<td style="width:22%">&nbsp;&nbsp;Water</td>
							<td style="width:25%">&nbsp;&nbsp;<b>Date of Sample Received</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($rec_sample_date)); ?></td>


						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Condition Of Sample On Receipt</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $con_sample; ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Sample Send by</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php if ($row_select['sample_sent_by'] == "0") {
																	echo "Customer";
																} else {
																	echo "Agency";
																} ?></td>

						</tr>
						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Testing Method Standard</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp; IS-3025-1986,IS 456-2000</td>
							<td style="width:25%">&nbsp;&nbsp;<b>Source of Sample</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $row_select_pipe['source']; ?></td>
						</tr>

						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Brand</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $row_select_pipe['brand']; ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Specification Of Sample</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo $row_select_pipe['specification']; ?></td>
						</tr>


						<tr>
							<td style="width:25%">&nbsp;&nbsp;<b>Date Test Started</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($start_date)); ?></td>
							<td style="width:25%">&nbsp;&nbsp;<b>Date Test Completed</b></td>
							<td style="width:3%">:-</td>
							<td style="width:22%">&nbsp;&nbsp;<?php echo date('d-m-Y', strtotime($end_date)); ?></td>
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
							<td><b>
									<center><br>Sr. No.<br> </center>
								</b></td>
							<td><b>
									<center><br>Name of Test<br> </center>
								</b></td>
							<td><b>
									<center><br>Result Obtained<br>(As per IS 3025-1986) </center>
								</b></td>
							<td><b>
									<center><br>Permissible Limit<br>(AS per IS 456-2000) </center>
								</b></td>
						</tr>

						<tr>
							<td>
								<center>1</center>
							</td>
							<td>pH Value</td>
							<td>
								<center><?php echo $row_select_pipe['ph_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>2</center>
							</td>
							<td>Total Dissolved Solids (TDS)</td>
							<td>
								<center><?php echo $row_select_pipe['tds_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>3</center>
							</td>
							<td>Chloride</td>
							<td>
								<center><?php echo $row_select_pipe['cl_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>4</center>
							</td>
							<td>Sulphate</td>
							<td>
								<center><?php echo $row_select_pipe['sup_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>5</center>
							</td>
							<td>Total Alkalinity</td>
							<td>
								<center><?php echo $row_select_pipe['alk_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>6</center>
							</td>
							<td>Total Suspended Solids (TSS)</td>
							<td>
								<center><?php echo $row_select_pipe['tss_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>7</center>
							</td>
							<td>Acidity</td>
							<td>
								<center><?php echo $row_select_pipe['aci_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>8</center>
							</td>
							<td>Total Hardness</td>
							<td>
								<center><?php echo $row_select_pipe['hard_value']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>9</center>
							</td>
							<td>Organic Solids</td>
							<td>
								<center><?php echo $row_select_pipe['ois_value_1']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>
						<tr>
							<td>
								<center>10</center>
							</td>
							<td>Inorganic Solids</td>
							<td>
								<center><?php echo $row_select_pipe['ois_value_2']; ?></center>
							</td>
							<td>
								<center></center>
							</td>

						</tr>


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
