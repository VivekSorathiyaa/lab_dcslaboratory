			<?php
			session_start();
			include("../connection.php");
			error_reporting(1); ?>
			<style>
				@page {
					size: 4in 6in;
					margin: auto;
					margin-left: 40px;
					margin-right: 0px;
					margin-top: 0px;
					margin-bottom: 5px;
					padding-top: 10px;
				}

				.pagebreak {
					page-break-before: always;
				}

				@media print {
					@page {
						size: landscape
					}
				}
			</style>
			<style>
				.tdclass {
					border: 1px solid black;
					font-size: 11px;
					font-family : Calibri;
				}

				.test {
					border-collapse: collapse;
					font-size: 11px;
					font-family : Calibri;
				}

				.tdclass1 {

					font-size: 11px;
					font-family : Calibri;
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
								include_once 'sample_id.php';
							}
						}

						$select_query4 = "select * from span_material_assign WHERE `lab_no`='$lab_no' AND `report_no`='$report_no' AND `job_number`='$job_no' AND `isdeleted`='0' ";
						$result_select4 = mysqli_query($conn, $select_query4);

						if (mysqli_num_rows($result_select4) > 0) {
							$row_select4 = mysqli_fetch_assoc($result_select4);
							$cc_grade = $row_select4['cc_grade'];
							$cc_set_of_cube = $row_select4['cc_set_of_cube'];
							$cc_no_of_cube = $row_select4['cc_no_of_cube'];
							$day_remark = $row_select4['day_remark'];
							$casting_date = $row_select4['casting_date'];
						}

						$dates = [
							$row_select_pipe['test_date1'],
							$row_select_pipe['test_date2'],
							$row_select_pipe['test_date3'],
							$row_select_pipe['test_date4'],
							$row_select_pipe['test_date5'],
							$row_select_pipe['test_date6'],
							$row_select_pipe['test_date7'],
							$row_select_pipe['test_date8'],
							$row_select_pipe['test_date9'],
							$row_select_pipe['test_date10'],
							$row_select_pipe['test_date11'],
							$row_select_pipe['test_date12']
						];
						$maxdate = date("Y-m-d", max(array_map('strtotime', $dates)));

				?>

						<br>
						<br>
						<br>
						<br>
						<br>


						<page size="A4" layout="landscape">
							<table align="center" width="90%" class="test" border="1px">
								<tr>
									<td colspan="12" style="font-size:13px">
										<center><b>Span Material Testing & Consultancy Services Limited</b></center>
									</td>
								</tr>
								<tr>
									<td colspan="8"><b>Work sheet for Density and Compressive strength of concrete cube (IS : 15658:2017)</b></td>
									<td colspan="4"><b></b></td>
								</tr>
								<tr>
									<td colspan="6" width="45%"><b>Laboratory ID No.:</b><?php echo $row_select_pipe['lab_no']; ?> </td>
									<td colspan="6" width="45%"><b>Date of Received Sample:</b>&nbsp;&nbsp;<?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
								</tr>
								<tr>
									<td colspan="6" width="45%"><b>Grade :</b><?php echo $cc_grade; ?> </td>
									<td colspan="6" width="45%"></td>
								</tr>
								<tr>
									<td width="8%" rowspan="2">Curing Start</td>
									<td width="8%">Date</td>
									<td width="24%" colspan="2"><?php echo date('d/m/Y', strtotime($rec_sample_date)); ?></td>
									<td width="8%" rowspan="2">Curing End</td>
									<td width="8%">Date</td>
									<td width="24%" colspan="2"><?php echo date('d/m/Y', strtotime($maxdate)); ?></td>
									<td width="8%">Temp.</td>
									<td width="8%" colspan="3"></td>

								</tr>
								<tr>


									<td width="8%">Time</td>
									<td width="24%" colspan="2"></td>





									<td width="8%">Time</td>
									<td width="24%" colspan="6"></td>
								</tr>

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
										<center><b>Cross Sectional Area (mm<sup>2</sup>)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Maximum<br>Load<br>(KN)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Compressive<br>Strength<br>(N/mm<sup>2</sup>)</b></center>
									</td>
									<td rowspan="2">
										<center><b>Average<br>Compressive<br>Strength (N/mm<sup>2</sup>)</b></center>
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
										<td style="height:30px;width:15%;">
											<center><?php echo $row_select_pipe['com_lab_1']; ?></center>
										</td>
										<td>
											<center><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date1'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date1'])); ?></center>
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
											<center><?php //echo round($row_select_pipe['load_1'],1);
													echo sprintf('%0.1f', $row_select_pipe['load_1']);

													?></center>
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
											<center><?php echo $row_select_pipe['com_lab_2']; ?></center>
										</td>
										<td>
											<center><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date2'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date2'])); ?></center>
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
											<center><?php //echo round($row_select_pipe['load_2'],1);
													echo sprintf('%0.1f', $row_select_pipe['load_2']);

													?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_2']; ?></center>
										</td>

									</tr>
									<tr>
										<td style="height:30px;">
											<center><?php echo $row_select_pipe['com_lab_3']; ?></center>
										</td>
										<td>
											<center><?php echo date('d/m/Y', strtotime($row_select_pipe['caste_date3'])); ?></center>
										</td>
										<td>
											<center><?php echo date('d/m/Y', strtotime($row_select_pipe['test_date3'])); ?></center>
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
											<center><?php echo sprintf('%0.1f', $row_select_pipe['load_3']); ?></center>
										</td>
										<td>
											<center><?php echo $row_select_pipe['comp_3']; ?></center>
										</td>

									</tr>
								<?php
								}

								?>

								<tr>
									<td colspan="6" style="height:30px;">Tested By:<center></center>
									</td>
									<td colspan="6" style="height:30px;">Checked By:<center></center>
									</td>
								</tr>
							</table>

						</page>

						<input style="margin-top: 25px;margin-left: 600;height: 50px;font-size: 20px;color: white;background-color: green;border-radius:20px;" type="button" name="print_button" id="print_button" value="PRINT">

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