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

		
		font-family: arial;
	}
</style>
<html>

<body>
	<?php
	$job_no = $_GET['job_no'];
	$lab_no = $_GET['lab_no'];
	$report_no = $_GET['report_no'];
	$select_tiles_query = "select * from span_pcc_block WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_no`='$job_no' and `is_deleted`='0'";
	$result_tiles_select = mysqli_query($conn, $select_tiles_query);
	$count = mysqli_num_rows($result_tiles_select);
	$flag = 0;
	$a = 1;
	if ($count > 0) {
		while ($row_select_pipe = mysqli_fetch_array($result_tiles_select)) {

			/*$result_tiles_select = mysqli_query($conn, $select_tiles_query);
			$row_select_pipe = mysqli_fetch_array($result_tiles_select);*/

			$select_query = "select * from job WHERE `report_no`='$report_no' AND `jobisdeleted`='0'";
			$result_select = mysqli_query($conn, $select_query);
			$flag++;
			$row_select = mysqli_fetch_array($result_select);
			$clientname = $row_select['clientname'];
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

			//for forwared to
			$sent_by = $row_select['report_sent_to'];

			$name_of_work = strip_tags(html_entity_decode($row_select['nameofwork']), "<strong><em>");

			$select_query1 = "select * from agency_master WHERE `agency_id`='$row_select[agency]' AND `isdeleted`='0'";
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
				$cc_grade = $row_select4['cc_grade'];
				$cc_set_of_cube = $row_select4['cc_set_of_cube'];
				$cc_no_of_cube = $row_select4['cc_no_of_cube'];
				$cc_identification_mark = $row_select4['cc_identification_mark'];
				$day_remark = $row_select4['day_remark'];
				$casting_date = $row_select4['casting_date'];
			}


			$dates = [
				$row_select_pipe['test_date1'],
				$row_select_pipe['test_date2'],
				$row_select_pipe['test_date3'],
				$row_select_pipe['test_date4']
			];
			$maxdate = date("Y-m-d", max(array_map('strtotime', $dates)));

			$labs = substr_replace($row_select_pipe['com_lab_1'], "", -1);


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
							<center><b>Test Results of Precast Concrete Block</b></center>
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
									<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($end_date)); ?></td>
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
									<td style="width:22%">&nbsp;&nbsp;PRECAST CONCRETE BLOCK</td>
									<td style="width:25%">&nbsp;&nbsp;<b>Test Method Standard</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;IS-15658: 2017</td>

								</tr>
								<tr>
									<td style="width:25%">&nbsp;&nbsp;<b>No. of Sample</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp; <?php echo $cc_no_of_cube; ?></td>
									<td style="width:25%">&nbsp;&nbsp;<b>Grade of Block</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;<?php echo $cc_grade; ?></td>
								</tr>
								<tr>
									<td style="width:25%">&nbsp;&nbsp;<b>Date of Sample Received</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
									<td style="width:25%">&nbsp;&nbsp;<b>Environmental Condition</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;As per test procedure</td>
								</tr>

								<tr>
									<td style="width:25%">&nbsp;&nbsp;<b>Condition Of Sample On Receipt</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;Satisfactory</td>
									<td style="width:25%">&nbsp;&nbsp;<b>Date of Test Started</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($rec_sample_date)); ?></td>
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
									<td style="width:22%">&nbsp;&nbsp;<?php echo date('d - m - Y', strtotime($maxdate)); ?></td>
								</tr>
								<tr>
									<td style="width:25%">&nbsp;&nbsp;<b>Identification Mark</b></td>
									<td style="width:3%">:-</td>
									<td style="width:22%">&nbsp;&nbsp;<?php echo $cc_identification_mark; ?></td>
									<td style="width:25%">&nbsp;&nbsp;<b></b></td>
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
									<td rowspan="2" style="height:50px;">
										<center><b>Lab<br>ID No</b></center>
									</td>
									<td rowspan="2">
										<center><b>Date<br>Of<br>Casting</b></center>
									</td>
									<td rowspan="2">
										<center><b>Date<br>Of<br>Testing</b></center>
									</td>
									<td rowspan="2">
										<center><b>Age of<br>Testing<br>(Days)</b></center>
									</td>
									<td colspan="3">
										<center><b>Dimensions of cube (mm)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Cross <br>Sectional<br>Area(mm<sup>2</sup>)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Weight of<br> Cube<br> (gm)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Maximum<br>Load<br>(KN)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Compressive<br>Strength<br>(N/mm<sup>2</sup>)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Average<br>Compressive<br>Strength(N/mm<sup>2</sup>)</b></center>
									</td>

								</tr>
								<tr>
									<td>
										<center><b>L</b></center>
									</td>
									<td>
										<center><b>B</b></center>
									</td>
									<td>
										<center><b>H</b></center>
									</td>


								</tr>

								<?php

								if ($row_select_pipe['chk_chk1'] == 1) {


								?>

									<tr>
										<td style="height:30px;">
											<center><?php echo $labs . $a++; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date1'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date1'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['l1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b1']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['h1']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['cross_1'], 0); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mass_1']; ?></center>
										</td>
										<td>
											<center><?php echo number_format($row_select_pipe['load_1'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_1']; ?></center>
										</td>
										<td rowspan="3">
											<center><?php echo $row_select_pipe['avg_com_s_1']; ?></center>
										</td>
									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $labs . $a++; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date2'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date2'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['l2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b2']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['h2']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['cross_2'], 0); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mass_2']; ?></center>
										</td>
										<td>
											<center><?php echo number_format($row_select_pipe['load_2'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_2']; ?></center>
										</td>

									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $labs . $a++; ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['caste_date3'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d - m - Y', strtotime($row_select_pipe['test_date3'])); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['day3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['l3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['b3']; ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['h3']; ?></center>
										</td>
										<td>
											<center><?php echo round($row_select_pipe['cross_3'], 0); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['mass_3']; ?></center>
										</td>
										<td>
											<center><?php echo number_format($row_select_pipe['load_3'], 1); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_3']; ?></center>
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
									<td style="font-size:13px;">for <b>Span Material Testing & Consultancy Services Limited<br><br><br><br><br><br><br><br><br>Authorised Signatory</b> <span style="padding-right:3px;float:right;">Page :- <?php echo $flag; ?> of <?php echo $count; ?></span></td>

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





			</page>
			<?php
			if ($flag < $count) {
			?>
				<div class="pagebreak"> </div>
			<?php } ?>
	<?php
		}
	}
	?>
</body>

</html>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script type="text/javascript">
	$("#print_button").on("click", function() {
		$('#print_button').hide();
		window.print();
	});
</script>